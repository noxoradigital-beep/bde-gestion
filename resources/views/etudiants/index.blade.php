<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Étudiants</h2>
            <div class="flex gap-2">
                <a href="{{ route('etudiants.export') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Exporter (CSV)</a>
                <a href="{{ route('etudiants.import') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-sm text-gray-700 hover:bg-gray-50">Importer une liste</a>
                <a href="{{ route('etudiants.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Ajouter un étudiant</a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher par nom, email, classe..."
                        class="flex-1 rounded-md border-gray-300 shadow-sm text-sm">
                    <button type="submit" class="px-4 py-2 bg-gray-100 rounded-md text-sm">Rechercher</button>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Nom</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Email</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Classe</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Option</th>
                            <th class="px-4 py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($etudiants as $etudiant)
                            <tr>
                                <td class="px-4 py-2">
                                    <a href="{{ route('etudiants.show', $etudiant) }}" class="text-gray-900 hover:underline">
                                        {{ $etudiant->nom }} {{ $etudiant->prenom }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 text-gray-600">{{ $etudiant->email }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $etudiant->classe }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $etudiant->option ?? 'Non renseignée' }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('etudiants.edit', $etudiant) }}" class="text-gray-500 hover:text-gray-800">Modifier</a>
                                    <form action="{{ route('etudiants.destroy', $etudiant) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet étudiant ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Aucun étudiant pour le moment.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $etudiants->links() }}
        </div>
    </div>
</x-app-layout>
