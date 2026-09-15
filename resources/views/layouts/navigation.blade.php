<!--
    NAVIGATION : barre du haut + menu plein ecran.
    Style dans public/css/navigation.css, ouverture/fermeture dans public/js/navigation.js.
-->
<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">

@php
    // Liste des liens du menu : label, route, et si le lien est actif sur la page courante.
    $navLinks = [
        ['label' => 'Dashboard', 'route' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
        ['label' => 'Étudiants', 'route' => route('etudiants.index'), 'active' => request()->routeIs('etudiants.*')],
        ['label' => 'Planning', 'route' => route('planning.index'), 'active' => request()->routeIs('planning.*') || request()->routeIs('evenements.*')],
        ['label' => 'Statistiques', 'route' => route('statistiques.index'), 'active' => request()->routeIs('statistiques.*')],
    ];

    if (auth()->user()->isAdmin()) {
        $navLinks[] = ['label' => 'Membres BDE', 'route' => route('membres.index'), 'active' => request()->routeIs('membres.*')];
    }
@endphp

<header class="site-header">
    <a href="{{ route('dashboard') }}" class="site-header__logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo BDE">
    </a>

    <button type="button" id="nav-toggle-btn" class="nav-toggle-btn" aria-expanded="false" aria-controls="nav-overlay">
        <span class="nav-toggle-btn__icon"><span></span><span></span></span>
        Menu
    </button>
</header>

<div id="nav-overlay" class="nav-overlay">
    <div class="nav-overlay__blob" style="width:380px;height:380px;left:-80px;top:-80px;background:var(--nav-creme);"></div>
    <div class="nav-overlay__blob" style="width:300px;height:300px;right:-60px;bottom:10%;background:var(--nav-corail);"></div>

    <button type="button" id="nav-overlay-close" class="nav-overlay__close" aria-label="Fermer le menu">&times;</button>

    <ul class="nav-overlay__links">
        @foreach ($navLinks as $link)
            <li>
                <a href="{{ $link['route'] }}" class="nav-overlay__link @if($link['active']) nav-overlay__link--active @endif">
                    {{ $link['label'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="nav-overlay__footer">
        <div class="nav-overlay__user">
            {{ Auth::user()->name }}
            <span>{{ Auth::user()->email }}</span>
        </div>

        <div class="nav-overlay__actions">
            <a href="{{ route('profile.edit') }}">Profil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Se déconnecter</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/navigation.js') }}" defer></script>
