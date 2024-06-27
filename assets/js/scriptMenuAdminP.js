// script.js

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu_toggle');
    const sidebar = document.getElementById('sidebar');

/*     menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
    }); */

    // Fonction pour ouvrir et fermer les sous-menus
    const toggleSubmenu = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.toggle('hidden');
    };

    // Écouteurs d'événements pour les boutons des sous-menus du modele responsive
    document.getElementById('menu_toggle').addEventListener('click', function() {
        toggleSubmenu('sidebar');
    });
     // Écouteurs d'événements pour les boutons des sous-menus
     document.getElementById('btn_accueil').addEventListener('click', function() {
        toggleSubmenu('accueil');
    });

    document.getElementById('btn_propos').addEventListener('click', function() {
        toggleSubmenu('propos');
    });

    document.getElementById('btn_services').addEventListener('click', function() {
        toggleSubmenu('services');
    });

    document.getElementById('btn_contact').addEventListener('click', function() {
        toggleSubmenu('contact');
    });

    // Fermer les sous-menus lorsqu'on clique en dehors
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative') && !e.target.matches('#menu_toggle')) {
            document.querySelectorAll('.submenu').forEach(function(submenu) {
                submenu.classList.add('hidden');
            });
        }
    });
});
