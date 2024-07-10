document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('trainingAdd').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('registrationForm'));
        const xhr = new XMLHttpRequest();
        var url = "<?= VIEW_PATH . 'Trainings/addTraining.php?' ?>";
        xhr.open("POST", url, true);

        // Afficher le message "Veuillez patienter..." avec un cercle de chargement avant d'envoyer la requête
        document.getElementById('response').innerHTML = `
            <div class="flex flex-col items-center">
                <div id="spinner" text-sm"></div>
                <p class="text-blue-500 text-sm">Veuillez patienter...</p>
            </div>
        `;

        // Gestionnaire d'événement pour surveiller les changements d'état de la requête
        let interval = setInterval(function() {
            // Vérifier l'état de la requête et mettre à jour le message en conséquence
            switch (xhr.readyState) {
                case 0: // Non initialisé
                    document.getElementById('stepOne').innerHTML = '<p class="text-blue-500 text-sm">La requête n\'a pas été initialisée.</p>';
                    break;
                case 1: // Connexion établie
                    document.getElementById('stepTwo').innerHTML = '<p class="text-blue-500 text-sm">Connexion au serveur en cours...</p>';
                    break;
                case 2: // Requête reçue
                    document.getElementById('stepThree').innerHTML = '<p class="text-blue-500 text-sm">Requête reçue par le serveur...</p>';
                    break;
                case 3: // Traitement en cours
                    document.getElementById('stepFour').innerHTML = `
                        <div class="flex flex-col items-center">
                            <div id="spinner "></div>
                            <p class="text-blue-500 text-sm">Traitement en cours...</p>
                        </div>
                    `;
                    break;
                case 4: // Terminé
                    clearInterval(interval);
                    if (xhr.status === 200) {
                        // En cas de succès, afficher la réponse du serveur
                        document.getElementById('stepFinal').innerHTML = '<p class="text-green-500 text-sm">' + xhr.responseText + '</p>';
                        document.getElementById('response').innerHTML = '';
                        document.getElementById('stepOne').innerHTML = '';
                        document.getElementById('stepTwo').innerHTML = '';
                        document.getElementById('stepThree').innerHTML = '';
                        document.getElementById('stepFour').innerHTML = '';
                    } else {
                        // En cas d'erreur, afficher un message d'erreur
                        document.getElementById('stepFinal').innerHTML = '<p class="text-red-500">Une erreur s\'est produite. Code: ' + xhr.status + '</p>';
                    }
                    break;
            }
        }, 100); // Vérification toutes les 100ms

        // Envoyer les données du formulaire
        

        xhr.send(formData);
    });
});
