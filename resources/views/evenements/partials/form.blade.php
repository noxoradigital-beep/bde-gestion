@php($ev = $evenement ?? null)

<div>
    <x-input-label for="nom" value="Nom de l'événement" />
    <x-text-input id="nom" name="nom" value="{{ old('nom', $ev?->nom) }}" class="mt-1 block w-full" required />
    <x-input-error :messages="$errors->get('nom')" class="mt-1" />
</div>

<div>
    <x-input-label for="date" value="Date et heure" />
    <x-text-input id="date" type="datetime-local" name="date"
        value="{{ old('date', $ev?->date?->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full" required />
    <x-input-error :messages="$errors->get('date')" class="mt-1" />
</div>

<div>
    <x-input-label for="lieu" value="Lieu (facultatif)" />
    <x-text-input id="lieu" name="lieu" value="{{ old('lieu', $ev?->lieu) }}" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('lieu')" class="mt-1" />
</div>

<div>
    <x-input-label for="capacite" value="Capacité (facultatif)" />
    <x-text-input id="capacite" type="number" min="1" name="capacite" value="{{ old('capacite', $ev?->capacite) }}" class="mt-1 block w-full" />
    <x-input-error :messages="$errors->get('capacite')" class="mt-1" />
</div>

<div>
    <x-input-label for="description" value="Description (facultatif)" />
    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">{{ old('description', $ev?->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
</div>
