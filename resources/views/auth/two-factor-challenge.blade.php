<x-guest-layout>
    <p class="text-sm text-gray-600 mb-4">
        Saisis le code à 6 chiffres généré par ton application d'authentification.
    </p>

    <form method="POST" action="{{ route('two-factor.verify') }}">
        @csrf

        <div>
            <x-input-label for="code" value="Code de vérification" />
            <x-text-input id="code" class="block mt-1 w-full" name="code" inputmode="numeric" autocomplete="one-time-code" required autofocus />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>Valider</x-primary-button>
        </div>
    </form>
</x-guest-layout>
