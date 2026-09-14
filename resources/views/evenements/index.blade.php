<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Événements</h2>
            <div class="flex gap-2">
                <a href="{{ route('planning.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Voir en calendrier</a>
                <a href="{{ route('evenements.export') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Exporter (CSV)</a>
                <a href="{{ route('evenements.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Créer un événement</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Nom</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Lieu</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Participants</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($evenements as $evenement)
                            <tr>
                                <td class="px-4 py-2">
                                    <a href="{{ route('evenements.show', $evenement) }}" class="text-gray-900 hover:underline">{{ $evenement->nom }}</a>
                                </td>
                                <td class="px-4 py-2 text-gray-600">{{ $evenement->date->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $evenement->lieu ?? 'Non renseigné' }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $evenement->etudiants_count }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('evenements.edit', $evenement) }}" class="text-gray-500 hover:text-gray-800">Modifier</a>
                                    <form action="{{ route('evenements.destroy', $evenement) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet événement ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Aucun événement pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $evenements->links() }}
        </div>
    </div>
</x-app-layout>
