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
        </div>
    </div>
</x-app-layout>
