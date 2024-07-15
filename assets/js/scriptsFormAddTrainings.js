function viewLevel() {
    document.getElementById('viewLevels').classList.remove('hidden');
    document.getElementById('viewlevel').classList.add('hidden');

}
/* control des forms */

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('FormAddTraining');

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
 document.getElementById('FormAddTraining').addEventListener('submit', function(e){
  
    const codes = document.getElementById('codes').value;
    const descript = document.getElementById('descriptions').value;
    const prix = document.getElementById('prices').value;
    const duree = document.getElementById('durations').value;
    /* regex  */
    const regexCodes = /^[A-Za-z]+$/;
    //const regexDescript = /^[A-Za-z']+$/;
    const regexDescript = /^[A-Za-z]([A-Za-z_' ]*[A-Za-z])?$/;
    const regexPrix = /^\d+(\.\d{1,2})?$/; /* debut 1 ou plusieurs carractere decimale, suivie du point
    et optionnelement 1 ou 2 decimal*/
    const regexDuree =  /^[1-8]$/;
    if( !codes || !descript || !prix || !duree){
        document.getElementById("error-message").textContent = "Veuillez remplir les champs.";
          e.preventDefault();
    }
    else{
        if(codes.length>4 || codes.length<2){
            document.getElementById("error-message").textContent = "valeur du champ code incorect!.";
            e.preventDefault();
           }
          else if( descript.length<5){
            document.getElementById("error-message").textContent = "valeur du champ description incorect!.";
            e.preventDefault();
           }
           else if( prix<5000){
            document.getElementById("error-message").textContent = "valeur du champ prix incorect!.";
            e.preventDefault();
           }
           else if( duree > 8 || duree < 1){
            document.getElementById("error-message").textContent = "valeur de la durée incorect!.";
            e.preventDefault();
           } 
      /* regex test stard */
           else  if (!regexCodes.test(codes)) {
            document.getElementById("error-message").textContent = "Le champ code ne doit contenir que des caractères alphabétiques!";
            e.preventDefault();
            }
            else  if (!regexDescript.test(descript)) {
                document.getElementById("error-message").textContent = "Le champ description ne doit contenir que des caractères alphabétiques!";
                e.preventDefault();
            }
            else  if (!regexPrix.test(prix)) {
                document.getElementById("error-message").textContent = "Le champ prix ne doit contenir que des caractères numérique!";
                e.preventDefault();
            }
            else  if (!regexDuree.test(duree)) {
                document.getElementById("error-message").textContent = "La durée doit etre comprise entre une(1) et huits(8) année";
                e.preventDefault();
            }
    /* regex test end */
             /* checkbox */
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let isChecked = false;

            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    sChecked = true;
                }
            });

            if (!isChecked) {
                document.getElementById("error-message").textContent =  "Veuillez sélectionner au moins un niveau d'étude";
               
            e.preventDefault();
            }
    }
   
});





