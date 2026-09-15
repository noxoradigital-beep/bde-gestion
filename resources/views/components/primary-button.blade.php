{{-- Bouton principal (ex: "Enregistrer") : fond orange BDE --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-bde-orange border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:brightness-95 focus:brightness-95 active:brightness-90 focus:outline-none focus:ring-2 focus:ring-bde-orange focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
