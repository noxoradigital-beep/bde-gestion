<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier {{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('etudiants.update', $etudiant) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    @include('etudiants.partials.form', ['etudiant' => $etudiant])

                    <div class="flex justify-end gap-2 pt-2">
                        <a href="{{ route('etudiants.index') }}" class="px-4 py-2 text-sm text-gray-600">Annuler</a>
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
