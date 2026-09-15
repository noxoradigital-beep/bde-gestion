// Effet "parallax" : les cercles colorés du fond suivent légèrement la souris.
// Chaque cercle a une vitesse différente (data-speed, posée dans le .blade.php),
// ce qui donne une impression de profondeur.

document.addEventListener('mousemove', function (e) {
    var xRatio = e.clientX / window.innerWidth;  // position souris en %, de 0 à 1
    var yRatio = e.clientY / window.innerHeight;

    document.querySelectorAll('.blob').forEach(function (cercle) {
        var vitesse = parseFloat(cercle.dataset.speed) || 20;
        cercle.style.marginLeft = (xRatio * vitesse) + 'px';
        cercle.style.marginTop = (yRatio * vitesse) + 'px';
    });
});
