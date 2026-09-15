@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-bde-orange focus:ring-bde-orange rounded-md shadow-sm']) }}>
