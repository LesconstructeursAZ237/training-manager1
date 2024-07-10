
const toggleSubmenu = function(menuId, submenuId) {
    // Sélectionne tous les sous-menus
    const submenus = document.querySelectorAll('[id^="submenu"]');
    // Sélectionne tous les boutons de menu
    const menus = document.querySelectorAll('.btnMenu');

    // Cache tous les sous-menus
    submenus.forEach(function(submenu) {
        submenu.classList.add('hidden');
    });

    // Réinitialise les styles de tous les boutons de menu
    menus.forEach(function(menu) {
        menu.classList.remove('bg-blue-500', 'text-white');
        menu.classList.add('bg-gray-200', 'text-black');
    });

    // Affiche le sous-menu cliqué
    const submenu = document.getElementById(submenuId);
    submenu.classList.toggle('hidden');

    // Applique les styles actifs au bouton de menu cliqué
    const menu = document.getElementById(menuId);
    menu.classList.toggle('bg-gray-200');
    menu.classList.toggle('bg-blue-500');
    menu.classList.toggle('text-black');
    menu.classList.toggle('text-white');
};

const closeSubmenu = function(submenuId) {
    const submenu = document.getElementById(submenuId);
    submenu.classList.add('hidden');
};


/* menu des appareils mobile */
/* Fonction pour ouvrir et fermer les sous-menus */
const menuMobile = function(submenuId) {
    const submenu = document.getElementById(submenuId);
    submenu.classList.toggle('hidden');
};

// Écouteurs d'événements pour les boutons des sous-menus du modèle responsive
document.getElementById('btnMobilePhone').addEventListener('click', function() {
    menuMobile('menuMobilePhone');
});

// Fermer le menu lorsqu'on clique en dehors de celui-ci
document.addEventListener('click', function(event) {
    const menu = document.getElementById('menuMobilePhone');
    const menuToggle = document.getElementById('btnMobilePhone');

    if (!menu.contains(event.target) && !menuToggle.contains(event.target)) {
        menu.classList.add('hidden');
    }
});

/* ouverture du modal pour ajouter un utilisateur */
function addNewUser(event){
    menuMobile('formAddUser');

}