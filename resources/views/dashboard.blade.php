<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('etudiants.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:brightness-95 transition">
                    <p class="text-sm text-gray-500">Étudiants enregistrés</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $totalEtudiants }}</p>
                </a>
                <a href="{{ route('planning.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:brightness-95 transition">
                    <p class="text-sm text-gray-500">Événements organisés</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $totalEvenements }}</p>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Prochains événements</h3>

                    @forelse ($prochainsEvenements as $evenement)
                        <a href="{{ route('evenements.show', $evenement) }}" class="flex items-center justify-between py-3 border-b border-gray-100 last:border-0 hover:bg-gray-50/50 -mx-2 px-2 rounded">
                            <div>
                                <p class="font-medium text-gray-900">{{ $evenement->nom }}</p>
                                <p class="text-sm text-gray-500">{{ $evenement->date->format('d/m/Y H:i') }} @if ($evenement->lieu) · {{ $evenement->lieu }} @endif</p>
                            </div>
                            <span class="text-sm text-gray-500">{{ $evenement->etudiants_count }} inscrit(s)</span>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">Aucun événement à venir pour le moment.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
