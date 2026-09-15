<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Activer la double authentification</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6 space-y-4">
                <p class="text-sm text-gray-600">
                    Scanne ce QR code avec une application d'authentification (Google Authenticator, Authy...),
                    puis saisis le code à 6 chiffres généré pour confirmer.
                </p>

                <div class="flex justify-center">
                    {!! $qrCodeInline !!}
                </div>

                <p class="text-xs text-gray-500 text-center break-all">
                    Ou saisis cette clé manuellement : <code class="bg-gray-100 px-1 rounded">{{ $secret }}</code>
                </p>

                <form method="POST" action="{{ route('two-factor.enable') }}" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label for="code" value="Code de vérification" />
                        <x-text-input id="code" name="code" inputmode="numeric" autocomplete="one-time-code" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('code')" class="mt-1" />
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm text-gray-600">Annuler</a>
                        <x-primary-button>Activer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
