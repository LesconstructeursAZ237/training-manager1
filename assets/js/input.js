
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez l'élément input
    const input = document.getElementById('mail');

    // Ajoutez un écouteur d'événement 'input' pour détecter les changements de texte
    input.addEventListener('input', function() {
        // Récupérez la valeur actuelle du champ input
        const text = input.value;

        // Vérifiez la longueur du texte
        if (text.length > 8) {
            // Si la longueur est supérieure à 4 caractères, changez la couleur de la bordure en rouge (par exemple)
            input.style.borderColor = 'blue';
            input.style.borderWidth = '3px';
        } else {
            // Sinon, remettez la couleur de la bordure par défaut
            input.style.borderColor = '';
            input.style.borderWidth = '0px';

        }
       
    });
});