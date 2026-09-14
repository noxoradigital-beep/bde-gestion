@php($e = $etudiant ?? null)

<div>
    <x-input-label for="nom" value="Nom" />
    <x-text-input id="nom" name="nom" value="{{ old('nom', $e?->nom) }}" class="mt-1 block w-full" required />
    <x-input-error :messages="$errors->get('nom')" class="mt-1" />
</div>

<div>
    <x-input-label for="prenom" value="Prénom" />
    <x-text-input id="prenom" name="prenom" value="{{ old('prenom', $e?->prenom) }}" class="mt-1 block w-full" required />
    <x-input-error :messages="$errors->get('prenom')" class="mt-1" />
</div>

<div>
    <x-input-label for="email" value="Email" />
    <x-text-input id="email" type="email" name="email" value="{{ old('email', $e?->email) }}" class="mt-1 block w-full" required />
    <x-input-error :messages="$errors->get('email')" class="mt-1" />
</div>

<div>
    <x-input-label for="classe" value="Classe" />
    <x-text-input id="classe" name="classe" value="{{ old('classe', $e?->classe) }}" class="mt-1 block w-full" required placeholder="ex. B1, B2, M1..." />
    <x-input-error :messages="$errors->get('classe')" class="mt-1" />
</div>

<div>
    <x-input-label for="option" value="Option (facultatif)" />
    <x-text-input id="option" name="option" value="{{ old('option', $e?->option) }}" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('option')" class="mt-1" />
</div>
