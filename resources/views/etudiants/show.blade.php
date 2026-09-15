<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-[#8A2A0B] mb-1">Fiche étudiant</p>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ $etudiant->nom }} {{ $etudiant->prenom }}</h2>
            </div>
            <a href="{{ route('etudiants.edit', $etudiant) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                <x-heroicon-m-pencil-square class="h-4 w-4" /> Modifier
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="page-fade-in bg-white shadow-sm rounded-lg p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm" style="animation-delay: 0.1s">
                <div><span class="text-gray-500">Email</span><p class="text-gray-900">{{ $etudiant->email }}</p></div>
                <div><span class="text-gray-500">Classe</span><p class="text-gray-900">{{ $etudiant->classe }}</p></div>
                <div><span class="text-gray-500">Option</span><p class="text-gray-900">{{ $etudiant->option ?? 'Non renseignée' }}</p></div>
            </div>

            <div class="page-fade-in bg-white shadow-sm rounded-lg p-6" style="animation-delay: 0.2s">
                <h3 class="font-semibold text-gray-800 mb-3">Événements</h3>
                <ul class="divide-y divide-gray-100 text-sm">
                    @forelse ($etudiant->evenements as $evenement)
                        <li class="py-2 flex justify-between">
                            <a href="{{ route('evenements.show', $evenement) }}" class="hover:underline">{{ $evenement->nom }}</a>
                            <span class="text-gray-500">{{ $evenement->date->format('d/m/Y') }}
                                @if ($evenement->pivot->present) <span class="text-green-900">(présent)</span>
                                @else <span class="text-gray-500">(non marqué présent)</span> @endif
                            </span>
                        </li>
                    @empty
                        <li class="py-8 text-center text-gray-500">
                            <x-heroicon-o-calendar class="h-8 w-8 mx-auto mb-2 text-gray-300" />
                            Aucun événement pour cet étudiant.
                        </li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('etudiants.index') }}" class="text-sm text-gray-600">&larr; Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
