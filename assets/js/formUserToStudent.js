document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAddStudent');

    // Validation des champs de formulaire en temps réel
    const tabs = [
        { id: 'nomDiplome', minLength: 12, maxLength: 55, type: 'text' }
       
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

        } 

         if (tab.type === 'text' && tab.id === 'nomDiplome') {
            if (value.length < tab.minLength) {
                errorMessage = `Minimum ${tab.minLength} caractères requis.`;
            } else if (value.length > tab.maxLength) {
                errorMessage = `Maximum ${tab.maxLength} caractères autorisés.`;
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
        const nomDiplome = document.getElementById('nomDiplome').value.trim();

        const regexnomDiplome = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;

        // Réinitialiser les messages d'erreur
        document.getElementById('partie2Error').innerText = '';
        document.getElementById('partie3Error').innerText = '';
        document.getElementById('nomDiplomeError').innerText = '';

        // Vérification des champs obligatoires
        if (!nomDiplome) {
            document.getElementById('nomDiplomeError').innerText = 'Veuillez remplir tous les champs.';
           
            isValid = false;
        } else {
          
              // Validation des champs
              if (nomDiplome.length < 8 || nomDiplome.length > 55) {
                document.getElementById('nomDiplomeError').innerText = 'Le champ nom du diplome doit être entre 12 et 55 caractères.';
                isValid = false;
            } else if (!regexnomDiplome.test(nomDiplome)) {
                document.getElementById('nomDiplomeError').innerText = 'Le champ nom du diplome ne doit contenir que des caractères alphabétiques.';
                isValid = false;
            }

        }

        // Validation des checkboxes
        
                /* Fonction pour vérifier si au moins une formation est cochée*/
                  // Obtenir tous les checkboxes de formation
    var trainingCheckboxes = document.querySelectorAll(".training-checkbox");
    
    // Vérifier si au moins un checkbox est coché
    var isAnyTrainingChecked = Array.from(trainingCheckboxes).some(checkbox => checkbox.checked);

    // Si aucune formation n'est cochée, empêcher la soumission du formulaire et afficher un message d'erreur
    if (!isAnyTrainingChecked) {
        isValid = false;  // Empêcher la soumission du formulaire
        document.getElementById("partie3Error").textContent = "Veuillez  cocher au moins une formation.";
    }
 

        if (!isValid) {
            e.preventDefault();
        }
    });
});




