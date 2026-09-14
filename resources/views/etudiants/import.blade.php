<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Importer une liste d'étudiants</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif

            @if (session('erreurs_import') && count(session('erreurs_import')))
                <div class="bg-amber-50 text-amber-800 text-sm rounded-md p-3">
                    <p class="font-semibold mb-1">Lignes ignorées :</p>
                    <ul class="list-disc list-inside">
                        @foreach (session('erreurs_import') as $erreur)
                            <li>{{ $erreur }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="text-sm text-gray-600 mb-4">
                    Fichier CSV avec une ligne d'en-tête : <code class="bg-gray-100 px-1 rounded">nom,prenom,email,classe,option</code>.
                    Un étudiant déjà présent (même email) est mis à jour plutôt que dupliqué.
                </p>

                <form method="POST" action="{{ route('etudiants.import.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="file" name="fichier" accept=".csv,text/csv" required class="block w-full text-sm">
                    <x-input-error :messages="$errors->get('fichier')" class="mt-1" />

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('etudiants.index') }}" class="px-4 py-2 text-sm text-gray-600">Annuler</a>
                        <x-primary-button>Importer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
