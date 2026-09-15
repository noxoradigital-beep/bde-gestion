<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-[#8A2A0B] mb-1">Fiche événement</p>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ $evenement->nom }}</h2>
            </div>
            <a href="{{ route('evenements.edit', $evenement) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                <x-heroicon-m-pencil-square class="h-4 w-4" /> Modifier
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif

            <div class="page-fade-in bg-white shadow-sm rounded-lg p-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm" style="animation-delay: 0.1s">
                <div><span class="text-gray-500">Date</span><p class="text-gray-900">{{ $evenement->date->format('d/m/Y H:i') }}</p></div>
                <div><span class="text-gray-500">Lieu</span><p class="text-gray-900">{{ $evenement->lieu ?? 'Non renseigné' }}</p></div>
                <div><span class="text-gray-500">Capacité</span><p class="text-gray-900">{{ $evenement->capacite ?? 'Illimitée' }}</p></div>
                <div><span class="text-gray-500">Tarif</span><p class="text-gray-900">{{ $evenement->payant ? number_format((float) $evenement->prix, 2, ',', ' ').' €' : 'Gratuit' }}</p></div>
                <div><span class="text-gray-500">Créé par</span><p class="text-gray-900">{{ $evenement->createur?->name ?? 'Non renseigné' }}</p></div>
                @if ($evenement->description)
                    <div class="col-span-2"><span class="text-gray-500">Description</span><p class="text-gray-900">{{ $evenement->description }}</p></div>
                @endif
            </div>

            <div class="page-fade-in bg-white shadow-sm rounded-lg p-6" style="animation-delay: 0.2s">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-3">
                        <h3 class="font-semibold text-gray-800">Participants ({{ $evenement->etudiants->count() }})</h3>
                        @if ($evenement->payant)
                            @php
                                $nbPayes = $evenement->etudiants->where('pivot.paye', true)->count();
                                $nbNonPayes = $evenement->etudiants->count() - $nbPayes;
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-emerald-50 text-emerald-700 font-medium">{{ $nbPayes }} payé(s)</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-amber-50 text-amber-700 font-medium">{{ $nbNonPayes }} pas payé</span>
                        @endif
                    </div>
                    @if ($evenement->payant)
                        <a href="{{ route('evenements.paiements.export', $evenement) }}" class="text-sm text-gray-600 hover:underline">Exporter les paiements (CSV)</a>
                    @endif
                </div>

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
                            <span>{{ $etudiant->nom }} {{ $etudiant->prenom }} <span class="text-gray-500">({{ $etudiant->classe }})</span></span>
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('participations.presence', [$evenement, $etudiant]) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-2 py-1 rounded text-xs {{ $etudiant->pivot->present ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $etudiant->pivot->present ? 'Présent' : 'Marquer présent' }}
                                    </button>
                                </form>
                                @if ($evenement->payant)
                                    <form method="POST" action="{{ route('participations.paiement', [$evenement, $etudiant]) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="px-2 py-1 rounded text-xs {{ $etudiant->pivot->paye ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $etudiant->pivot->paye ? 'A payé' : "N'a pas payé" }}
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('participations.destroy', [$evenement, $etudiant]) }}" onsubmit="return confirm('Retirer ce participant ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 text-red-800 hover:text-red-900 text-xs">
                                        <x-heroicon-m-x-mark class="h-3.5 w-3.5" /> Retirer
                                    </button>
                                </form>
                            </div>
                        </li>
                    @empty
                        <li class="py-8 text-center text-gray-500">
                            <x-heroicon-o-user-group class="h-8 w-8 mx-auto mb-2 text-gray-300" />
                            Aucun participant pour le moment.
                        </li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('evenements.index') }}" class="text-sm text-gray-600">&larr; Retour à la liste</a>
        </div>
    </div>
</x-app-layout>
