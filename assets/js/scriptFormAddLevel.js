function personalizeLevel(){
    const openPersonalizeModel = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.add('hidden');
    };
    const closePersonalizeModel = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.remove('hidden');
    };

    openPersonalizeModel ('defaultGrade');
    openPersonalizeModel ('defaulfText');
    closePersonalizeModel  ('persolnalizeText');
    closePersonalizeModel  ('btnPreviewAddLevel');
    closePersonalizeModel  ('personalizeGrade');
    openPersonalizeModel  ('btnPersonalize');
    openPersonalizeModel  ('btnCloseAddLevel'); 
  
        /* initialiser la valeur qui etait selectionner dans la balise select */
        var selectElement = document.getElementById('selectedGrade');
        selectElement.selectedIndex = 0; // Réinitialise la sélection à la première option (qui est la valeur par défaut vide)
    
}

function retour(){

    const openPersonalizeModel = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.add('hidden');
    };

    const closePersonalizeModel = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.remove('hidden');
    };
    closePersonalizeModel ('defaultGrade');
    openPersonalizeModel  ('personalizeGrade');
    closePersonalizeModel ('defaulfText');
    openPersonalizeModel  ('persolnalizeText')
    openPersonalizeModel   ('btnPreviewAddLevel');
    closePersonalizeModel  ('btnPersonalize');
    closePersonalizeModel  ('btnCloseAddLevel');
      document.getElementById('gradePersonalize').value='';

}
/* gestion de crarractere du niveau personaliser */
document.getElementById('gradePersonalize').addEventListener('input', function() {
    var input = this.value;
    var errorSpan = document.getElementById('error');
    var inputField = document.getElementById('gradePersonalize');

    if (input.length > 2) {
        errorSpan.textContent = 'La taille du niveau doit être inférieur à 2 caractères.';
        inputField.classList.remove('border-green-500');
        inputField.classList.add('border-red-500');
    } else if (input.length >= 1 && input.length <= 2) {
        errorSpan.textContent = '';
        inputField.classList.add('border-green-500');
        inputField.classList.remove('border-red-500');
    } else {
        errorSpan.textContent = '';
        inputField.classList.remove('border-green-500', 'border-red-500');
    }
});

/* document.getElementById('formAddLevel').addEventListener('submit', function(event) {
    var input = document.getElementById('gradePersonalize').value;
    if (input.length > 2) {
        event.preventDefault();
        document.getElementById('error').textContent = 'Le niveau doit être inférieur à 2 caractères.';
    }
}); 
 */

