<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Statistiques</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <p class="text-sm text-gray-500">
                Ces chiffres sont destinés à être transmis à la scolarité. Export CSV disponible depuis les pages
                Étudiants et Événements.
            </p>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Étudiants enregistrés</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $totalEtudiants }}</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Événements organisés</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $totalEvenements }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Participation par classe</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Classe</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Effectif</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Déjà venus à un événement</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($tauxParClasse as $ligne)
                            <tr>
                                <td class="px-4 py-2">{{ $ligne->classe }}</td>
                                <td class="px-4 py-2">{{ $ligne->effectif }}</td>
                                <td class="px-4 py-2">{{ $ligne->participants_actifs }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">Pas encore de données.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Derniers événements</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Événement</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Date</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Inscrits</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Présents</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($evenementsRecents as $evenement)
                            <tr>
                                <td class="px-4 py-2">{{ $evenement->nom }}</td>
                                <td class="px-4 py-2">{{ $evenement->date->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $evenement->etudiants_count }}</td>
                                <td class="px-4 py-2">{{ $evenement->presents_count }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Pas encore d'événement.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
