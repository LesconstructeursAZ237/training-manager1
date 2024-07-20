
 /* close modal */
 function closeEditTrainingForm(){
    document.getElementById('openFormEditTraining').classList.add('hidden');
 }
/* input form update training */
document.getElementById('EditTraining').addEventListener('submit', function(event) {
   const Newcode = document.getElementById('newCodes').value;
   const newDescritp = document.getElementById('newDescriptions').value;
   const newPrice = document.getElementById('newPrices').value;
   const newDuree = document.getElementById('newduree').value;

   const regexNiveau = /^(niveau-|NIVEAU)[1-9]$/;
   const regexAlphabetic = /^[A-Za-zÀ-ÖØ-öø-ÿ]+([ '][A-Za-zÀ-ÖØ-öø-ÿ]+)*$/;
   const regexNumber = /^[1-7]$/;
   const regexPrix = /^[0-9]+$/;
   const regexCodee = /^[A-Za-z]+$/;

   let valid = true;
   let errorMessage = '';

   /* Validate code*/
   if (!regexCodee.test(Newcode) || Newcode.length < 2 || Newcode.length > 4) {
       errorMessage += "Le champ code ne doit contenir que des caractères alphabétique entre 2 à 4 caractères.\n";
       valid = false;
   }

   /* Validate description*/
   if (!regexAlphabetic.test(newDescritp) || newDescritp.length < 12) {
       errorMessage += "Le champ Description doit contenir uniquement des caractères alphabétiques d'au moins 12 caractères.\n";
       valid = false;
   }
   /* Validate price*/
   if (!regexPrix.test(newPrice) || newPrice < 5000) {
      errorMessage += "Le prix ne doit pas etre inférieur a 5000.\n";
      valid = false;
  }

   /* Validate duree*/
   if (!regexNumber.test(newDuree)) {
       errorMessage += "Le champ Durée doit être un nombre entre 1 et 7.\n";
       valid = false;
   }

   if (!valid) {
      document.getElementById('errorMessage').textContent=errorMessage;
       event.preventDefault();
   }
});

