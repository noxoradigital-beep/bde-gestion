@props(['disabled' => false])

{{-- Champ de formulaire utilisé partout dans le site : contour orange BDE quand on clique dedans --}}
<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-bde-orange focus:ring-bde-orange rounded-md shadow-sm']) }}>
