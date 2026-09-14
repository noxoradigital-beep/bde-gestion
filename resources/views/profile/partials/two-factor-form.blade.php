<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Double authentification</h2>
        <p class="mt-1 text-sm text-gray-600">
            Ajoute une vérification par code (application d'authentification) en plus du mot de passe.
        </p>
    </header>

    @if (auth()->user()->two_factor_enabled)
        <div class="mt-4 flex items-center gap-4">
            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-green-100 text-green-700">Activée</span>

            <form method="POST" action="{{ route('two-factor.disable') }}" class="flex items-center gap-2">
                @csrf
                @method('DELETE')
                <input type="password" name="password" placeholder="Mot de passe" required
                    class="rounded-md border-gray-300 shadow-sm text-sm">
                <x-danger-button>Désactiver</x-danger-button>
            </form>
        </div>
        @error('password', 'disable2fa')
            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
        @enderror
    @else
        <div class="mt-4">
            <span class="inline-flex items-center px-2 py-1 rounded text-xs bg-gray-100 text-gray-600 mb-3">Désactivée</span>
            <div>
                <a href="{{ route('two-factor.setup') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Activer la double authentification
                </a>
            </div>
        </div>
    @endif
</section>
