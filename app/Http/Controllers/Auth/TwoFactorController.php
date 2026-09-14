<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PragmaRX\Google2FAQRCode\Google2FA;

class TwoFactorController extends Controller
{
    /**
     * Show the setup screen (QR code) to enable 2FA for the current user.
     */
    public function setup(Request $request): View|RedirectResponse
    {
        $user = $request->user();

        if ($user->two_factor_enabled) {
            return redirect()->route('profile.edit')->with('status', 'La double authentification est déjà activée.');
        }

        $google2fa = new Google2FA;
        $secret = $request->session()->get('2fa.setup_secret') ?? $google2fa->generateSecretKey();
        $request->session()->put('2fa.setup_secret', $secret);

        $qrCodeInline = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.two-factor-setup', [
            'secret' => $secret,
            'qrCodeInline' => $qrCodeInline,
        ]);
    }

    /**
     * Confirm the setup code and activate 2FA on the account.
     */
    public function enable(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $secret = $request->session()->get('2fa.setup_secret');

        if (! $secret) {
            return redirect()->route('two-factor.setup')->withErrors(['code' => 'Session expirée, recommence la configuration.']);
        }

        $google2fa = new Google2FA;

        if (! $google2fa->verifyKey($secret, $request->string('code')->toString())) {
            return back()->withErrors(['code' => 'Code invalide.']);
        }

        $request->user()->update([
            'google2fa_secret' => $secret,
            'two_factor_enabled' => true,
        ]);

        $request->session()->forget('2fa.setup_secret');

        return redirect()->route('profile.edit')->with('status', 'Double authentification activée.');
    }

    /**
     * Disable 2FA on the current account.
     */
    public function disable(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $request->user()->update([
            'google2fa_secret' => null,
            'two_factor_enabled' => false,
        ]);

        return redirect()->route('profile.edit')->with('status', 'Double authentification désactivée.');
    }

    /**
     * Show the code challenge presented after a valid password, during login.
     */
    public function challenge(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('2fa.user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-challenge');
    }

    /**
     * Verify the challenge code and complete the login.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $userId = $request->session()->get('2fa.user_id');

        if (! $userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        $google2fa = new Google2FA;

        if (! $google2fa->verifyKey($user->google2fa_secret, $request->string('code')->toString())) {
            return back()->withErrors(['code' => 'Code invalide.']);
        }

        $intended = $request->session()->pull('2fa.intended', route('dashboard', absolute: false));
        $request->session()->forget('2fa.user_id');

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->to($intended);
    }
}
