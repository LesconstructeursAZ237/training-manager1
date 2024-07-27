/*function to open element hidden*/
const ouvrirUnModal = function(submenuId) {
    const submenu = document.getElementById(submenuId);
    submenu.classList.toggle('hidden');
};

function openVerticalMenu(){
    document.getElementById('verticalMenu').classList.toggle('hidden');
  
}

/* Prevent clicks inside the menu from closing it*/
document.getElementById('verticalMenu').addEventListener('click', function(event) {
    document.getElementById('verticalMenu').classList.toggle('hidden');
});


