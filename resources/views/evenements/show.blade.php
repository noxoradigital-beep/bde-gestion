<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $evenement->nom }}</h2>
            <a href="{{ route('evenements.edit', $evenement) }}" class="text-sm text-gray-600 hover:underline">Modifier</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Date</span><p class="text-gray-900">{{ $evenement->date->format('d/m/Y H:i') }}</p></div>
                <div><span class="text-gray-500">Lieu</span><p class="text-gray-900">{{ $evenement->lieu ?? 'Non renseigné' }}</p></div>
                <div><span class="text-gray-500">Capacité</span><p class="text-gray-900">{{ $evenement->capacite ?? 'Illimitée' }}</p></div>
                <div><span class="text-gray-500">Créé par</span><p class="text-gray-900">{{ $evenement->createur?->name ?? 'Non renseigné' }}</p></div>
                @if ($evenement->description)
                    <div class="col-span-2"><span class="text-gray-500">Description</span><p class="text-gray-900">{{ $evenement->description }}</p></div>
                @endif
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-3">Participants ({{ $evenement->etudiants->count() }})</h3>

                <form method="POST" action="{{ route('participations.store', $evenement) }}" class="flex gap-2 mb-4">
                    @csrf
                    <select name="etudiant_id" required class="flex-1 rounded-md border-gray-300 shadow-sm text-sm">
                        <option value="">Ajouter un étudiant...</option>
                        @foreach ($etudiantsDisponibles as $etudiant)
                            <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }} ({{ $etudiant->classe }})</option>
                        @endforeach
                    </select>
                    <x-primary-button>Ajouter</x-primary-button>
                </form>

                <ul class="divide-y divide-gray-100 text-sm">
                    @forelse ($evenement->etudiants as $etudiant)
                        <li class="py-2 flex justify-between items-center">
                            <span>{{ $etudiant->nom }} {{ $etudiant->prenom }} <span class="text-gray-400">({{ $etudiant->classe }})</span></span>
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('participations.presence', [$evenement, $etudiant]) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded text-xs {{ $etudiant->pivot->present ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $etudiant->pivot->present ? 'Présent' : 'Marquer présent' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('participations.destroy', [$evenement, $etudiant]) }}" onsubmit="return confirm('Retirer ce participant ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Retirer</button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">Aucun participant pour le moment.</li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('evenements.index') }}" class="text-sm text-gray-600">&larr; Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
