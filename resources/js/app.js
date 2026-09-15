

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Compteur anime : utilise sur les chiffres cles (Dashboard, Statistiques).
// x-data="compteur(42, 2200)" puis x-text="valeur" sur l'element a animer.
// Le 2e argument (ms) doit correspondre au animation-delay de la carte
// "page-fade-in" qui le contient : sinon le compteur finit de compter
// avant meme que la carte soit visible, et on ne voit jamais l'effet.
// setInterval plutot que requestAnimationFrame : ce dernier peut ne jamais
// se declencher si l'onglet n'a pas le focus (ecran partage, deuxieme
// ecran...), auquel cas le chiffre resterait bloque a 0.
Alpine.data('compteur', (cible, delai = 0) => ({
    valeur: 0,
    init() {
        const duree = 1200;
        const pas = 25;
        setTimeout(() => {
            const debut = Date.now();
            const intervalle = setInterval(() => {
                const progression = Math.min((Date.now() - debut) / duree, 1);
                const accelerationDouce = 1 - Math.pow(1 - progression, 3);
                this.valeur = Math.round(cible * accelerationDouce);
                if (progression >= 1) clearInterval(intervalle);
            }, pas);
        }, delai);
    },
}));

Alpine.start();
