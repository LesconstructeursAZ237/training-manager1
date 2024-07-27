document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAddStudent');

    // Validation des champs de formulaire en temps réel
    const tabs = [
        { id: 'nom', minLength: 2, maxLength: 20, type: 'text' },
        { id: 'prenom', minLength: 2, maxLength: 20, type: 'text' },
        { id: 'adressEmail', minLength: 12, maxLength: 100, type: 'email' },
        { id: 'nomDiplome', minLength: 8, maxLength: 55, type: 'text' },
        { id: 'numeroTelephone', minLength: 9, type: 'number' },
        { id: 'pwdStudent', minLength: 8, type: 'password' }
    ];

    tabs.forEach(tab => {
        const input = document.getElementById(tab.id);
        input.addEventListener('input', function () {
            validateField(input, tab);
        });
    });

    function validateField(input, tab) {
        let errorMessage = '';
        const value = input.value.trim();
        const errorElement = document.getElementById(tab.id + 'Error');

        if (tab.type === 'text') {
            if (value.length < tab.minLength) {
                errorMessage = `Minimum ${tab.minLength} caractères requis.`;
            } else if (value.length > tab.maxLength) {
                errorMessage = `Maximum ${tab.maxLength} caractères autorisés.`;
            }

        } else if (tab.type === 'email' && tab.id === 'adressEmail') {
            if (value.length < tab.minLength) {
                errorMessage = `Minimum ${tab.minLength} caractères requis.`;
            } else if (value.length > tab.maxLength) {
                errorMessage = `Maximum ${tab.maxLength} caractères autorisés.`;
            }

        }else if (tab.type === 'text' && tab.id === 'nomDiplome') {
            if (value.length < tab.minLength) {
                errorMessage = `Minimum ${tab.minLength} caractères requis.`;
            } else if (value.length > tab.maxLength) {
                errorMessage = `Maximum ${tab.maxLength} caractères autorisés.`;
            }

        }
         else if (tab.type === 'number' && tab.id === 'numeroTelephone') {
            const numberValue = parseFloat(value);
            if (isNaN(numberValue) || value.length !== tab.minLength) {
                errorMessage = `Longueur acceptée: ${tab.minLength} chiffres requis.`;
            }
        }
        else if (tab.type === 'password' && tab.id === 'pwdStudent') {
           
            if ( value.length < tab.minLength) {
                errorMessage = `Minimum acceptée: ${tab.minLength} chiffres requis.`;
            }
        
        }

        if (errorMessage) {
            input.classList.add('border-red-500');
            errorElement.textContent = errorMessage;
        } else {
            input.classList.remove('border-red-500');
            errorElement.textContent = '';
        }
    }

    // Validation du formulaire lors de la soumission
    form.addEventListener('submit', function (e) {
        let isValid = true;

        const nom = document.getElementById('nom').value.trim();
        const prenom = document.getElementById('prenom').value.trim();
        const adressEmail = document.getElementById('adressEmail').value.trim();
        const numeroTelephone = document.getElementById('numeroTelephone').value.trim();
        const pwdStudent = document.getElementById('pwdStudent').value.trim();
        const nomDiplome = document.getElementById('nomDiplome').value.trim();

        const regexnom = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
        const regexprenom = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
        const regexnomDiplome = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
        const regexadressEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const regexnumeroTelephone = /^6[0-9]{8}$/; 
        const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;

        // Réinitialiser les messages d'erreur
        document.getElementById('partie1Error').innerText = '';
        document.getElementById('partie2Error').innerText = '';
        document.getElementById('partie3Error').innerText = '';
        document.getElementById('nomError').innerText = '';
        document.getElementById('prenomError').innerText = '';
        document.getElementById('emailError').innerText = '';
        document.getElementById('numeroTelephoneError').innerText = '';
        document.getElementById('pwdStudentError').innerText = '';
        document.getElementById('nomDiplomeError').innerText = '';

        // Vérification des champs obligatoires
        if (!nom || !prenom || !adressEmail || !numeroTelephone || !nomDiplome) {
            document.getElementById('partie1Error').innerText = 'Veuillez remplir tous les champs.';
            document.getElementById('partie2Error').innerText = 'Veuillez remplir tous les champs.';
           
            isValid = false;
        } else {
            // Validation des champs
            if (nom.length < 2 || nom.length > 20) {
                document.getElementById('nomError').innerText = 'Le champ nom doit être entre 2 et 20 caractères.';
                isValid = false;
            } else if (!regexnom.test(nom)) {
                document.getElementById('nomError').innerText = 'Le champ nom ne doit contenir que des caractères alphabétiques.';
                isValid = false;
            }/*  */
              // Validation des champs
              if (nomDiplome.length < 8 || nomDiplome.length > 55) {
                document.getElementById('nomDiplomeError').innerText = 'Le champ nom du diplome doit être entre 12 et 55 caractères.';
                isValid = false;
            } else if (!regexnomDiplome.test(nomDiplome)) {
                document.getElementById('nomDiplomeError').innerText = 'Le champ nom du diplome ne doit contenir que des caractères alphabétiques.';
                isValid = false;
            }

            if (prenom.length < 2 || prenom.length > 20) {
                document.getElementById('prenomError').innerText = 'Le champ prénom doit être entre 2 et 20 caractères.';
                isValid = false;
            } else if (!regexprenom.test(prenom)) {
                document.getElementById('prenomError').innerText = 'Le champ prénom ne doit contenir que des caractères alphabétiques.';
                isValid = false;
            }

            if (adressEmail.length < 12 || adressEmail.length > 100) {
                document.getElementById('emailError').innerText = 'L\'email doit être entre 12 et 100 caractères.';
                isValid = false;
            } else if (!regexadressEmail.test(adressEmail)) {
                document.getElementById('emailError').innerText = 'Le format de l\'email est invalide.';
                isValid = false;
            }

            if (numeroTelephone.length !== 9) {
                document.getElementById('numeroTelephoneError').innerText = 'Le numéro de téléphone doit contenir 9 chiffres.';
                isValid = false;
            } else if (!regexnumeroTelephone.test(numeroTelephone)) {
                document.getElementById('numeroTelephoneError').innerText = 'Le numéro de téléphone doit commencer par "6".';
                isValid = false;
            }
            if (pwdStudent.length < 8) {
                document.getElementById('pwdStudentError').innerText = 'minimum: 8 caractères.';
                isValid = false;
            } else if (!passwordRegex.test(pwdStudent)) {
                document.getElementById('pwdStudentError').innerText = "le mot de passe doit contenir au moins un chiffre, un caractère (majuscule et minuscule) et un caractère spécial.";
                isValid = false;
            }
        }

        // Validation des checkboxes
        const trainingCheckboxes = document.querySelectorAll('.training-checkbox');
        const selectedLevels = new Set();

        trainingCheckboxes.forEach(function (checkbox, index) {
            const levelCheckboxes = document.querySelectorAll(`.training-${index}-level-checkbox`);
            const checkedLevels = document.querySelectorAll(`.training-${index}-level-checkbox:checked`).length;

            if (checkbox.checked && checkedLevels === 0) {
                document.getElementById('partie3Error').innerText = 'Veuillez sélectionner au moins un niveau pour chaque formation sélectionnée.';
                isValid = false;
            }

            if (checkbox.checked && checkedLevels > 1) {
                document.getElementById('partie3Error').innerText = 'Veuillez sélectionner un niveau par formation.';
                isValid = false;
            }

            if (!checkbox.checked && checkedLevels > 0) {
                document.getElementById('partie3Error').innerText = 'Désélectionnez les niveaux pour les formations non sélectionnées.';
                isValid = false;
            }
          
                /* Fonction pour vérifier si au moins une formation est cochée*/
                function isAtLeastOneTrainingChecked() {
                    const trainingCheckboxes = document.querySelectorAll('.training-checkbox');
                    for (let i = 0; i < trainingCheckboxes.length; i++) {
                        if (trainingCheckboxes[i].checked) {
                            return true;
                        }
                    }
                    return false;
                }
            
                    /* Vérifier si au moins une formation est cochée*/
                    if (!isAtLeastOneTrainingChecked()) {
                        document.getElementById('partie3Error').innerText = 'Veuillez sélectionner au moins une formation.';
                        isValid = false;
                    }
            /* validate date */
            const birthDateInput = document.getElementById('dateNaissance');
            const birthDateValue = new Date(birthDateInput.value);
            const birthDateError = document.getElementById('dateNaissanceError');
            
            const today = new Date();
            const minAgeDate = new Date(today.getFullYear() - 17, today.getMonth(), today.getDate());
    
            birthDateError.textContent = '';
    
            if (birthDateValue > minAgeDate) {
                birthDateError.textContent = 'âge minimal 17 ans.';
                birthDateInput.classList.add('border-red-500');
                isValid = false; // Empêche la soumission du formulaire
            } else {
                birthDateInput.classList.remove('border-red-500');
            }
                    if (!isValid) {
                        e.preventDefault();
                    }
            
        });

        if (!isValid) {
            e.preventDefault();
        }
    });
});




