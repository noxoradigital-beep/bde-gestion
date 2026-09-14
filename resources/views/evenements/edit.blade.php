<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier {{ $evenement->nom }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('evenements.update', $evenement) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    @include('evenements.partials.form', ['evenement' => $evenement])

                    <div class="flex justify-end gap-2 pt-2">
                        <a href="{{ route('evenements.show', $evenement) }}" class="px-4 py-2 text-sm text-gray-600">Annuler</a>
                        <x-primary-button>Enregistrer</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
