<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Planning</h2>
            <div class="flex gap-2">
                <a href="{{ route('evenements.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Voir en liste</a>
                <a href="{{ route('evenements.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Créer un événement</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3 mb-4">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
                    <a href="{{ route('planning.index', ['mois' => $moisPrecedent]) }}" class="px-3 py-1 rounded-md text-sm text-gray-600 hover:bg-gray-100">&larr; Précédent</a>
                    <h3 class="font-semibold text-gray-800 capitalize">{{ $mois->translatedFormat('F Y') }}</h3>
                    <a href="{{ route('planning.index', ['mois' => $moisSuivant]) }}" class="px-3 py-1 rounded-md text-sm text-gray-600 hover:bg-gray-100">Suivant &rarr;</a>
                </div>

                <div class="grid grid-cols-7 text-xs font-medium text-gray-500 border-b border-gray-100">
                    @foreach (['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $jour)
                        <div class="px-2 py-2 text-center">{{ $jour }}</div>
                    @endforeach
                </div>

                @foreach ($semaines as $semaine)
                    <div class="grid grid-cols-7 border-b border-gray-100 last:border-b-0">
                        @foreach ($semaine as $jour)
                            <div class="min-h-[110px] border-r border-gray-100 last:border-r-0 p-1.5 align-top {{ $jour['horsMois'] ? 'bg-gray-50' : '' }}">
                                <div class="text-xs {{ $jour['horsMois'] ? 'text-gray-300' : 'text-gray-500' }} {{ $jour['aujourdhui'] ? 'inline-flex items-center justify-center w-5 h-5 rounded-full bg-gray-800 text-white' : '' }}">
                                    {{ $jour['date']->day }}
                                </div>
                                <div class="mt-1 space-y-1">
                                    @foreach ($jour['evenements'] as $evenement)
                                        <a href="{{ route('evenements.show', $evenement) }}"
                                            class="block truncate text-xs px-1.5 py-0.5 rounded bg-gray-800 text-white hover:bg-gray-700"
                                            title="{{ $evenement->nom }} ({{ $evenement->etudiants_count }} participant(s))">
                                            {{ $evenement->date->format('H:i') }} {{ $evenement->nom }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
