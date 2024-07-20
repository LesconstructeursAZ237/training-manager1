function viewLevel() {
    document.getElementById('viewLevels').classList.remove('hidden');
    document.getElementById('viewlevel').classList.add('hidden');

}
/* control des forms */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('TrainingsAdd');

    const fields = [
        { id: 'codes', minLength: 2, maxLength: 4, type: 'text' },
        { id: 'descriptions', minLength: 5, maxLength: 50, type: 'text' },
        { id: 'prices', minValue: 5000, type: 'number' },
        { id: 'durations', minValue: 1,maxLength: 8, type: 'number' }
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        input.addEventListener('input', function () {
            validateField(input, field);
        });
    });

    function validateField(input, field) {
        let errorMessage = '';
        const value = input.value.trim();
        const errorElement = document.getElementById(field.id + 'Error');

        if (field.type === 'text') {
            if (value.length < field.minLength) {
                errorMessage = `Minimum ${field.minLength} caractères requis.`;
            } else if (value.length > field.maxLength) {
                errorMessage = `Maximum ${field.maxLength} caractères autorisés.`;
            }

        } else if ((field.type === 'number')  && (field.id === 'durations') ) {
            const numberValue = parseFloat(value);
            if (isNaN(numberValue) || numberValue < field.minValue ) {
                errorMessage = `durree minimale ${field.minValue}.`;
            }
            else if (isNaN(numberValue) || numberValue > field.minValue) {
                errorMessage = `durree maximale:  ${field.maxLength}.`;
            }
          
        }
        else if((field.type === 'number')  && (field.id === 'prices') ){
            const numberValue = parseFloat(value);
            if (isNaN(numberValue) || numberValue < field.minValue ) {
                errorMessage = `Prix minimale: ${field.minValue}.`;
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
});

/* verified if empty value const regexNiveau = /^(niveau-|NIVEAU-)[1-9]$/;
*/
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('TrainingsAdd');

    const fields = [
        { id: 'codes', minLength: 2, maxLength: 4, type: 'text' },
        { id: 'descriptions', minLength: 5, maxLength: 50, type: 'text' },
        { id: 'prices', minValue: 5000, type: 'number' },
        { id: 'durations', minValue: 1, maxLength: 8, type: 'number' }
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        input.addEventListener('input', function () {
            validateField(input, field);
        });
    });

    function validateField(input, field) {
        let errorMessage = '';
        const value = input.value.trim();
        const errorElement = document.getElementById(field.id + 'Error');

        if (field.type === 'text') {
            if (value.length < field.minLength) {
                errorMessage = `Minimum ${field.minLength} caractères requis.`;
            } else if (value.length > field.maxLength) {
                errorMessage = `Maximum ${field.maxLength} caractères autorisés.`;
            }
        } else if (field.type === 'number') {
            const numberValue = parseFloat(value);
            if (field.id === 'durations') {
                if (isNaN(numberValue) || numberValue < field.minValue) {
                    errorMessage = `Durée minimale ${field.minValue}.`;
                } else if (numberValue > field.maxLength) {
                    errorMessage = `Durée maximale ${field.maxLength}.`;
                }
            } else if (field.id === 'prices') {
                if (isNaN(numberValue) || numberValue < field.minValue) {
                    errorMessage = `Prix minimal ${field.minValue}.`;
                }
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

    form.addEventListener('submit', function (e) {
        const codes = document.getElementById('codes').value.trim();
        const descript = document.getElementById('descriptions').value.trim();
        const prix = parseFloat(document.getElementById('prices').value.trim());
        const duree = parseInt(document.getElementById('durations').value.trim());

        const regexCodes = /^[A-Za-z]+$/;
        const regexDescript = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
        const regexPrix = /^\d+(\.\d{1,2})?$/;
        const regexDuree = /^[1-7]$/;

        let errorMessage = '';

        if (!codes || !descript || !prix || !duree) {
            errorMessage = 'Veuillez remplir tous les champs.';
        } else if (codes.length < 2 || codes.length > 4) {
            errorMessage = 'Le champ code doit contenir entre 2 et 4 caractères.';
        } else if (!regexCodes.test(codes)) {
            errorMessage = 'Le champ code ne doit contenir que des caractères alphabétiques.';
        } else if (descript.length < 5) {
            errorMessage = 'Le champ description doit contenir au moins 5 caractères.';
        } else if (!regexDescript.test(descript)) {
            errorMessage = 'Le champ description ne doit contenir que des caractères alphabétiques.';
        } else if (prix < 5000) {
            errorMessage = 'Le prix doit être au moins de 5000.';
        } else if (!regexPrix.test(prix)) {
            errorMessage = 'Le champ prix doit être un nombre valide.';
        } else if (duree < 1 || duree > 8) {
            errorMessage = 'La durée doit être comprise entre 1 et 7.';
        } else if (!regexDuree.test(duree)) {
            errorMessage = 'La durée doit être comprise entre 1 et 7.';
        }

        const checkboxes = document.querySelectorAll('input[name="trainingAddLevel[]"]');
        const isCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isCheckboxChecked) {
            errorMessage = 'Veuillez sélectionner au moins un niveau d\'étude.';
        }

        if (errorMessage) {
            document.getElementById('error-message').textContent = errorMessage;
            e.preventDefault();
        }
    });
});