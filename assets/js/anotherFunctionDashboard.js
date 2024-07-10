function closeFlashConnexion(){
    
    const menuMobile = function(submenuId) {
        const submenu = document.getElementById(submenuId);
        submenu.classList.toggle('hidden');
    };

    menuMobile('flashConnxion');
    
}

/*document.getElementById('formAddUser').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche la soumission par défaut du formulaire

    // Soumettre le formulaire via AJAX
    var xhr = new XMLHttpRequest();
    var url = "<?= VIEW_PATH . 'Users/addUser.php' ?>"; 
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Collecter les données du formulaire
    var formData = new FormData(document.getElementById('formAddUser'));
    var formParams = new URLSearchParams(formData).toString();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Réponse du serveur reçue avec succès
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Traiter la réponse en fonction du succès de l'opération
                if (mainSpan.innerText.trim() === '') {
                    setTimeout(function() {
                        document.getElementById('stepOne').classList.remove('hidden');
                        document.getElementById('stepOneMessage').classList.remove('hidden');
                    }, 100);
                    setTimeout(function() {
                        document.getElementById('stepTwo').classList.remove('hidden');
                        document.getElementById('stepTwoMessage').classList.remove('hidden');
                    }, 2000);
                    setTimeout(function() {
                        document.getElementById('stepThree').classList.remove('hidden');
                        document.getElementById('stepThreeMessage').classList.remove('hidden');
                    }, 3000);
                    setTimeout(function() {
                        document.getElementById('stepFour').classList.remove('hidden');
                        document.getElementById('stepFourMessage').classList.remove('hidden');
                    }, 4000);
                }
            } else {
                // Gérer les erreurs ou autres conditions selon la réponse du serveur
                console.error('Erreur lors du traitement sur le serveur:', response.message);
            }
        }
    };

    xhr.send(formParams);
});*/

