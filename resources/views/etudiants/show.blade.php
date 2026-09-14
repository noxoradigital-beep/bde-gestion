<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Email</span><p class="text-gray-900">{{ $etudiant->email }}</p></div>
                <div><span class="text-gray-500">Classe</span><p class="text-gray-900">{{ $etudiant->classe }}</p></div>
                <div><span class="text-gray-500">Option</span><p class="text-gray-900">{{ $etudiant->option ?? 'Non renseignée' }}</p></div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">Événements</h3>
                <ul class="divide-y divide-gray-100 text-sm">
                    @forelse ($etudiant->evenements as $evenement)
                        <li class="py-2 flex justify-between">
                            <a href="{{ route('evenements.show', $evenement) }}" class="hover:underline">{{ $evenement->nom }}</a>
                            <span class="text-gray-500">{{ $evenement->date->format('d/m/Y') }}
                                @if ($evenement->pivot->present) <span class="text-green-600">(présent)</span>
                                @else <span class="text-gray-400">(non marqué présent)</span> @endif
                            </span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">Aucun événement pour cet étudiant.</li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('etudiants.index') }}" class="text-sm text-gray-600">&larr; Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
