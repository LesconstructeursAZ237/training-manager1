
/* control form edit user */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('EditForm');
    const fields = [
        { id: 'name', errorId: 'nameError', minLength: 2, type: 'text' },
        { id: 'firstName', errorId: 'firstNameError', minLength: 2, type: 'text' },
        { id: 'mail', errorId: 'mailError', minLength: 5, type: 'email' },
        { id: 'phoneNumber', errorId: 'phoneNumberError', minLength: 9, type: 'number' },
    
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
        const phoneNumberRegex = /^6[0-9]{8}$/;
        const matriculeRegex = /^(IFPLI-|ifpli-)\d{2}[a-zA-Z]{0,4}-\d{4,5}$/;
        const NameRegex =/^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;

        if (field.type === 'text') {
            if (value.length < field.minLength) {
                errorMessage = "Minimum"+field.minLength+"caractères requis.";
            }
           else if (!NameRegex.test(value)) {
                errorMessage = " format incorect: uniquement des caractères alphabetique";
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

    
function openEditUser(button) {

    const userName = button.getAttribute('data-name');
    const userFistName= button.getAttribute('data-FistName');
    const userEmail = button.getAttribute('data-email');
    const userTelephone = button.getAttribute('data-telephone');
    const userIdUser = button.getAttribute('data-IdUser');
    const roleUser = button.getAttribute('data-nomDuRole');
    const idDurole = button.getAttribute('data-idDuRole');

   
 
     document.getElementById('firstName').value=userName;
    document.getElementById('name').value=userFistName;
    document.getElementById('mail').value=userEmail;
    document.getElementById('phoneNumber').value=userTelephone;  
    document.getElementById('roleUser').innerText=roleUser;  
    document.getElementById('roleUser').value=idDurole;  

    document.getElementById('idUser').value=userIdUser; 
   
   document.getElementById('formEditUser').classList.toggle('hidden');
}

function closeEditUser() {
    document.getElementById('formEditUser').classList.toggle('hidden');
}


function closeDeleteModalUser() {
    document.getElementById('deleteModal').classList.toggle('hidden');
}


