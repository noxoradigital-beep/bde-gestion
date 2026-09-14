<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view. Open only for the very first account
     * (bootstrap) or with a valid invitation token.
     */
    public function create(Request $request, ?string $token = null): View|RedirectResponse
    {
        if (User::count() === 0) {
            return view('auth.register');
        }

        $invitation = $token ? Invitation::where('token', $token)->first() : null;

        if (! $invitation || ! $invitation->estValide()) {
            return redirect()->route('login')->with('status', "Ce lien d'invitation est invalide ou a expiré. Demande à un administrateur BDE de t'en générer un nouveau.");
        }

        return view('auth.register', ['token' => $token]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request, ?string $token = null): RedirectResponse
    {
        $premierCompte = User::count() === 0;
        $invitation = null;

        if (! $premierCompte) {
            $invitation = $token ? Invitation::where('token', $token)->first() : null;
            abort_unless($invitation && $invitation->estValide(), 403, "Lien d'invitation invalide ou expiré.");
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $premierCompte ? 'admin' : 'membre',
        ]);

        $invitation?->update(['used_at' => now(), 'used_by' => $user->id]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
