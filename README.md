# Gestion BDE

Projet fil rouge ESGI B1. Site de gestion pour le Bureau des Étudiants : membres BDE authentifiés (avec double authentification), base des étudiants, gestion des événements et de leurs participants, statistiques destinées à la scolarité, import/export de données.

Le cahier des charges fonctionnel détaillé est dans `documentation/Cahier_des_charges_BDE.pdf`.

## Stack

- Laravel 12, PHP 8.4
- MySQL/MariaDB
- Blade + Tailwind (Laravel Breeze)
- Double authentification : `pragmarx/google2fa-laravel`

## Installation locale

Prérequis : PHP 8.4, Composer, Node.js, MySQL/MariaDB actifs.

```bash
composer install
npm install

cp .env.example .env
# renseigner DB_DATABASE, DB_USERNAME, DB_PASSWORD dans .env

php artisan key:generate
php artisan migrate
npm run build

php artisan serve
```

Le site est alors accessible sur http://127.0.0.1:8000. Créer un compte membre BDE via `/register`.

## Données de démo

Aucune vraie donnée d'étudiant n'est versionnée dans le dépôt (RGPD). Pour avoir des étudiants et événements de test en local :

```bash
php artisan db:seed
```

Crée 30 étudiants fictifs, 5 événements et un compte membre BDE de démo :
`demo@bde.local` / `password`.

## Fonctionnalités couvertes (voir le cahier des charges pour le détail)

- Authentification + double authentification (TOTP) pour les membres BDE
- CRUD étudiants, import CSV, export CSV
- CRUD événements, gestion des participants et de leur présence, export CSV
- Statistiques d'activité (par classe, par événement)

## Points restants (à répartir en équipe)

- Fiche d'équipe et répartition des rôles
- Rôles/permissions différenciés entre membres BDE (admin / membre simple)
- Design (aucune maquette fournie dans le brief initial : Tailwind par défaut de Breeze pour l'instant)
- Décider si les étudiants ont un compte pour s'inscrire eux-mêmes aux événements
