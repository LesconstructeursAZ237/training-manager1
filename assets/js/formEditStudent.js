document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEditStudent');

    // Validation des champs de formulaire en temps réel
    const tabs = [
        { id: 'nom', minLength: 2, maxLength: 20, type: 'text' },
        { id: 'prenom', minLength: 2, maxLength: 20, type: 'text' },
        { id: 'adressEmail', minLength: 12, maxLength: 100, type: 'email' },
        { id: 'nomDiplome', minLength: 8, maxLength: 55, type: 'text' },
        { id: 'numeroTelephone', minLength: 9, maxLength: 9, type: 'number' }, // Added maxLength for consistency
        { id: 'dateNaissance', type: 'date' } // Added date field
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

        if (tab.type === 'text' || tab.type === 'email') {
            if (value.length < tab.minLength) {
                errorMessage = `Minimum ${tab.minLength} caractères requis.`;
            } else if (value.length > tab.maxLength) {
                errorMessage = `Maximum ${tab.maxLength} caractères autorisés.`;
            }
        }

        if (tab.type === 'number' && tab.id === 'numeroTelephone') {
            const numberValue = parseFloat(value);
            if (isNaN(numberValue) || value.length !== tab.minLength) {
                errorMessage = `Longueur acceptée: ${tab.minLength} chiffres requis.`;
            }
        }

        if (tab.type === 'date' && tab.id === 'dateNaissance') {
            const birthDateValue = new Date(value);
            const today = new Date();
            const minAgeDate = new Date(today.getFullYear() - 17, today.getMonth(), today.getDate());
            if (birthDateValue > minAgeDate) {
                errorMessage = 'Âge minimal 17 ans.';
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

        tabs.forEach(tab => {
            const input = document.getElementById(tab.id);
            validateField(input, tab);
            const errorElement = document.getElementById(tab.id + 'Error');
            if (errorElement.textContent !== '') {
                isValid = false;
            }
        });
     
   
        if (!isValid) {
            e.preventDefault();
        }
    });
});
