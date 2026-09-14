<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Membres BDE</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @if (session('status'))
                <div class="bg-green-50 text-green-800 text-sm rounded-md p-3">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 text-red-800 text-sm rounded-md p-3">{{ $errors->first() }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Nom</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Email</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">2FA</th>
                            <th class="px-4 py-2 text-left font-medium text-gray-500">Rôle</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($membres as $membre)
                            <tr>
                                <td class="px-4 py-2">{{ $membre->name }} @if ($membre->id === auth()->id()) <span class="text-gray-400">(toi)</span> @endif</td>
                                <td class="px-4 py-2 text-gray-600">{{ $membre->email }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $membre->two_factor_enabled ? 'Activée' : 'Désactivée' }}</td>
                                <td class="px-4 py-2">
                                    <form method="POST" action="{{ route('membres.update', $membre) }}" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <select name="role" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm text-xs">
                                            <option value="membre" {{ $membre->role === 'membre' ? 'selected' : '' }}>Membre</option>
                                            <option value="admin" {{ $membre->role === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-800">Invitations</h3>
                    <form method="POST" action="{{ route('invitations.store') }}">
                        @csrf
                        <x-primary-button>Générer un lien d'invitation</x-primary-button>
                    </form>
                </div>

                <p class="text-xs text-gray-500 mb-4">
                    Un lien est valable 3 jours et ne peut servir qu'une seule fois. L'inscription libre est fermée :
                    seule une personne avec un lien valide peut créer un compte membre BDE.
                </p>

                <ul class="divide-y divide-gray-100 text-sm">
                    @forelse ($invitations as $invitation)
                        <li class="py-2">
                            @if ($invitation->used_at)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-600">Utilisée</span>
                                <span class="text-gray-500">par {{ $invitation->utilisateur?->name ?? 'un compte supprimé' }} le {{ $invitation->used_at->format('d/m/Y') }}</span>
                            @elseif ($invitation->estValide())
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-green-100 text-green-700">Active</span>
                                <span class="text-gray-500">expire le {{ $invitation->expires_at->format('d/m/Y H:i') }}, générée par {{ $invitation->createur?->name }}</span>
                                <div class="mt-1">
                                    <input type="text" readonly onclick="this.select()" value="{{ route('register', ['token' => $invitation->token]) }}"
                                        class="w-full text-xs rounded-md border-gray-300 bg-gray-50 font-mono">
                                </div>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-red-100 text-red-700">Expirée</span>
                                <span class="text-gray-500">le {{ $invitation->expires_at->format('d/m/Y') }}, générée par {{ $invitation->createur?->name }}</span>
                            @endif
                        </li>
                    @empty
                        <li class="py-2 text-gray-500">Aucune invitation générée pour le moment.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
