 function EditTraining(button){
    const codes= button.getAttribute('data-cod');
    const descript= button.getAttribute('data-descritp');
    const price= button.getAttribute('data-prix');
    const duree= button.getAttribute('data-dure');

        document.getElementById('newCodes').value=codes;
        document.getElementById('newDescriptions').value=descript;
        document.getElementById('newPrices').value=price;
        document.getElementById('newduree').value=duree;
        /* afficcher */
        document.getElementById('openFormEditTraining').classList.remove('hidden');
        
        document.getElementById('btnCode').addEventListener('click', function(){
            document.getElementById('editCode').classList.remove('hidden');
            document.getElementById('btnCode').classList.add('hidden');
         });
 }
 function closeEditTrainingForm(){
    document.getElementById('openFormEditTraining').classList.add('hidden');
 }
