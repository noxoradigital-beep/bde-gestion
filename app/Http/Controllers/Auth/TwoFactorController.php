<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PragmaRX\Google2FAQRCode\Google2FA;

// Double authentification (2FA) : QR code à scanner avec une appli type Google Authenticator,
// puis code à 6 chiffres demandé à chaque connexion.
class TwoFactorController extends Controller
{
    /**
     * Show the setup screen (QR code) to enable 2FA for the current user.
     */
    // Affiche le QR code à scanner pour activer la 2FA (le secret est gardé en session le temps de la config).
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
    // Vérifie que l'utilisateur a bien scanné le QR code (code correct) avant d'activer la 2FA pour de vrai.
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
    // Désactive la 2FA (redemande le mot de passe par sécurité).
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
    // Affiche l'écran "entre ton code" après un mot de passe correct (login pas encore terminé).
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
    // Vérifie le code à 6 chiffres puis termine réellement la connexion (Auth::login).
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

        // Renvoie l'utilisateur vers la page qu'il voulait initialement visiter.
        $intended = $request->session()->pull('2fa.intended', route('dashboard', absolute: false));
        $request->session()->forget('2fa.user_id');

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->to($intended);
    }
}
