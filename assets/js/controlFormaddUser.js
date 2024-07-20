document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const fields = [
        { id: 'name', errorId: 'nameError', minLength: 2, type: 'text' },
        { id: 'firstName', errorId: 'firstNameError', minLength: 2, type: 'text' },
        { id: 'mail', errorId: 'mailError', minLength: 5, type: 'email' },
        { id: 'phone_number', errorId: 'phoneNumberError', minLength: 9, type: 'number' },
        { id: 'birth_date', errorId: 'birthDateError', minLength: 1, type: 'date' },
        { id: 'photo_user', errorId: 'photoUserError', minLength: 1, type: 'file' },
        { id: 'pwdUser', errorId: 'pwdUserError', minLength: 8, type: 'password' }
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
        const errorElement = document.getElementById(field.errorId);
        const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
        const phoneNumberRegex = /^6[0-9]{8}$/;
        const NameRegex =/^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;

        if (field.type === 'text') {
            if (value.length < field.minLength) {
                errorMessage = "Minimum"+field.minLength+"caractères requis.";
            }  
            else if((field.type === 'text') && (field.id === 'name')){
                
                if (!NameRegex.test(value)) {
                    errorMessage = 'format incorrect: uniquement des caractères';
                }
            } else if((field.type === 'text') && (field.id === 'firstName')){
                
                if (!NameRegex.test(value)) {
                    errorMessage = 'format incorrect: uniquement des caractères';
                }
            }
            
        }
        else if(field.type === 'password'){
            if (value.length < field.minLength) {
                errorMessage = "Minimum"+field.minLength+"caractères requis.";
            } 
           else if (!passwordRegex.test(value)) {
            errorMessage ="le mot de passe doit contenir au moins un chiffre, un caractère (majuscule et minuscule) et un caractère spécial"; 
            
            }  
       }
     
         else if (field.type === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(value)) {
                errorMessage = 'Adresse email invalide.';
            }
        } else if (field.type === 'number') {
            if (isNaN(value) || value.length !=9) {
                errorMessage = "Numéro de téléphone invalide:"+field.minLength+"chiffres requis sans espacement.";
            }
            else if(!phoneNumberRegex.test(value)){
                errorMessage= "format incorrect, le numero de telephone doit commencer par 6!"; 
            }
        } else if (field.type === 'date') {
            if (!value) {
                errorMessage = "Veuillez sélectionner une date de naissance.";
            }
        } else if (field.type === 'file') {
            if (!input.files.length) {
                errorMessage = "Veuillez télécharger une photo.";
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
        let formValid = true;

        fields.forEach(field => {
            const input = document.getElementById(field.id);
            validateField(input, field);
            if (document.getElementById(field.errorId).textContent) {
                formValid = false;
            }
        });

        if (!formValid) {
            e.preventDefault();
        }
    });
});
