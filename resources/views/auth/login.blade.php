<!--
    PAGE DE CONNEXION (BDE)
    Structure de la page uniquement : le style est dans public/css/connexion.css,
    l'effet souris est dans public/js/connexion.js.
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion — {{ config('app.name', 'Gestion BDE') }}</title>

    {{-- Polices Google Fonts utilisées par connexion.css --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&family=Space+Mono&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
</head>
<body>
    <div class="bde-login">

        {{-- Filtre invisible qui fait "fusionner" les cercles du fond entre eux --}}
        <svg class="svg-filter-hidden">
            <defs>
                <filter id="bde-gooey">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="12" result="blur" />
                    <feColorMatrix in="blur" mode="matrix"
                        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9"
                        result="goo" />
                    <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                </filter>
            </defs>
        </svg>

        {{-- Décor animé : 8 cercles colorés, taille/position/couleur tirées au hasard à chaque visite --}}
        <div class="stage">
            @php
                $couleursBde = ['#F7521C', '#EF3A2F', '#E52947', '#D52F5E', '#FCDDA9', '#4F116F'];
            @endphp
            @for ($i = 0; $i < 8; $i++)
                @php
                    $taille = random_int(180, 420);
                    $positionGauche = random_int(0, 90);
                    $positionHaut = random_int(0, 90);
                    $delaiAnimation = -random_int(0, 20);
                    $dureeAnimation = random_int(15, 30);
                    $couleur = $couleursBde[$i % count($couleursBde)];
                @endphp
                <div class="blob"
                     data-speed="{{ ($i + 1) * 16 }}"
                     style="
                        width: {{ $taille }}px;
                        height: {{ $taille }}px;
                        left: {{ $positionGauche }}%;
                        top: {{ $positionHaut }}%;
                        background: {{ $couleur }};
                        animation-delay: {{ $delaiAnimation }}s;
                        animation-duration: {{ $dureeAnimation }}s;
                     "></div>
            @endfor
        </div>

        {{-- Carte centrale : logo + titre + formulaire de connexion --}}
        <main class="auth-card">
            <div class="logo-row">
                <img src="{{ asset('images/logo.png') }}" alt="Logo BDE">
            </div>

            <header class="header">
                <span class="brand-id">ESGI B1 · Bureau des Étudiants</span>
                <h1>Espace<br><span>Membres</span></h1>
            </header>

            {{-- Message de confirmation (ex : après un changement de mot de passe) --}}
            @if (session('status'))
                <div class="status-note">{{ session('status') }}</div>
            @endif

            {{-- Formulaire de connexion : envoie email + mot de passe à la route "login" --}}
            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="prenom@esgi.fr" required autofocus autocomplete="username">
                    <div class="input-glow"></div>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
                    <div class="input-glow"></div>
                    @error('password')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-row">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Se souvenir de moi</label>
                </div>

                <div class="submit-wrap">
                    <button type="submit" class="btn-base">Se connecter</button>
                </div>
            </form>

            <footer class="footer-nav">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Mot de passe oublié</a>
                @else
                    <span>&nbsp;</span>
                @endif
                <span>Connexion sécurisée</span>
            </footer>
        </main>
    </div>

    {{-- Effet souris sur les cercles du fond --}}
    <script src="{{ asset('js/connexion.js') }}" defer></script>
</body>
</html>
