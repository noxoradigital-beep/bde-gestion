// Ouvre/ferme le menu plein ecran (bouton "Menu", croix, touche Echap, clic en dehors des liens).

document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('nav-overlay');
    var toggleBtn = document.getElementById('nav-toggle-btn');
    var closeBtn = document.getElementById('nav-overlay-close');

    if (!overlay || !toggleBtn) return;

    function openMenu() {
        overlay.classList.add('is-open');
        toggleBtn.setAttribute('aria-expanded', 'true');
    }

    function closeMenu() {
        overlay.classList.remove('is-open');
        toggleBtn.setAttribute('aria-expanded', 'false');
    }

    toggleBtn.addEventListener('click', function () {
        overlay.classList.contains('is-open') ? closeMenu() : openMenu();
    });

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
            closeMenu();
        }
    });
});
