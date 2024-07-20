function closeFlashConnexion(){
    
    const menuMobile = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.toggle('hidden');
    };

    menuMobile('flashConnxion');
    
}
