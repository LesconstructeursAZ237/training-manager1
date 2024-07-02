
function openModal(button) {
   
    const userName = button.getAttribute('data-name');
    const userFistName= button.getAttribute('data-FistName');
    const userEmail = button.getAttribute('data-email');
    const userTelephone = button.getAttribute('data-telephone');
    const userMatricule = button.getAttribute('data-matricule');
    const matricule = button.getAttribute('data-registrationNumber');
    // Sélectionner le champ d'audi, l'ID est :"modifiedBy"
        //var modifiedByElement = document.getElementById('modifiedBy');
        // Récupérer le contenu texte de l'élément
        //var modifiedByText = modifiedByElement.innerText;
    
 //affectation des valeurs
    document.getElementById('userPrenom').innerHTML = userName ;  
    document.getElementById('userNom').innerHTML = userFistName ; 
    document.getElementById('userEmail').innerHTML = userEmail ; 
    document.getElementById('userTelephone').innerHTML = userTelephone ; 
    /*document.getElementById('userUniqIdd').innerHTML  ;*/ 
    document.getElementById('registrationNumber').innerHTML = matricule ; 
    document.getElementById('indentifiantEmail').value=userMatricule;
    document.getElementById('indentifiantTelephone').value=userMatricule;
    document.getElementById('indentifiantPrenom').value=userMatricule;
    document.getElementById('indentifiantNom').value=userMatricule;
    document.getElementById('indentifiantMat').value=userMatricule;
    /* charger la valeur du input de type hidden: L'ID*/
    document.getElementById('identifiantModalChangeRole').value = userMatricule;
    /* charger la valeur du input de type hidden: modifiedBy*/
    //document.getElementById('AdminmodifiedBy').value = userMatricule;
    
     
    
    document.getElementById('OpenModal').classList.remove('hidden');
}

function closeOpenModal() {
    document.getElementById('OpenModal').classList.add('hidden');
}


/*fonction de modification User*/

/*bouton de modification email*/
function editModalEmail() {

    document.getElementById('editEmail').classList.remove('hidden');
}
function closeeditModalEmail() {
    document.getElementById('editEmail').classList.add('hidden');}

    /*bouton de modification numero de telephone*/
function editModalPhoneNumber() {
    document.getElementById('editPhoneNumber').classList.remove('hidden');

}
function closeeditModalPhone() {
    document.getElementById('editPhoneNumber').classList.add('hidden');}
       
    /*bouton de modification prenom*/
function editModalPrenom() {
    document.getElementById('editPrenom').classList.remove('hidden');

}
function closeeditModalPrenom() {
    document.getElementById('editPrenom').classList.add('hidden');}

        /*bouton de modification nom*/
function editModalNom() {
    document.getElementById('editNom').classList.remove('hidden');

}
function closeeditModalNom() {
    document.getElementById('editNom').classList.add('hidden');}
  
        /*bouton de modification matricule*/
function editModalMat() {
    document.getElementById('editMat').classList.remove('hidden');

}
function closeeditModalMat() {
    document.getElementById('editMat').classList.add('hidden');}

     /*bouton de modification nommer admin?*/
    function openModalChangeRole() {
        document.getElementById('changeRole').classList.remove('hidden');
    
    }

    /* modal de suppression */
    function ChangeRole() {
        document.getElementById('changeRole').classList.add('hidden');}

/* afficher le modal de suppression d'un utilisateur */
        function openDeleteModal(button) {
   
            const id = button.getAttribute('data-identifiant');
            const userNom = button.getAttribute('data-Nom');
            const userPrenom = button.getAttribute('data-Prenom');

             //affectation des valeurs
    document.getElementById('identifiant').value = id ; 
    document.getElementById('DeleteNom').innerHTML = userNom  ; 
    document.getElementById('DeletePrenom').value = userPrenom ;  
   
    document.getElementById('deleteModal').classList.remove('hidden');

        }
        /* fermer le modal de suppression */
        function closeDeleteModalUser() {
            document.getElementById('deleteModal').classList.add('hidden');
        }