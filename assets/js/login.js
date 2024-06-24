


document.getElementById('password').addEventListener('input', function() {
    if (this.value.length < 5) {
        this.classList.add('error');
        exit();
    } else {
        this.classList.remove('error');
    }
});
document.addEventListener('DOMContentLoaded', (event) => {
    // Accéder à l'élément du formulaire
    var inputElement = document.getElementById('password');
    var form = document.getElementById('log_in_form');

    // Ajouter un écouteur d'événement 'input' pour vérifier la longueur
    inputElement.addEventListener('input', function() {
       // Vérifier la longueur de la valeur
        if (inputElement.value.length < 8) {
            // Ajouter la classe pour la bordure rouge
            inputElement.classList.add('error');
        } 
        else {
            // Retirer la classe si la condition n'est pas remplie
            inputElement.classList.remove('error');
        } 
    });

    // Ajouter un écouteur d'événement 'submit' pour empêcher la soumission si la condition n'est pas remplie
    form.addEventListener('submit', function(event) {
        // Vérifier la longueur de la valeur
        if (inputElement.value.length < 8) {
            // Empêcher la soumission du formulaire
            event.preventDefault();
            alert('La longueur du mot de passe doit être d\'au moins 8 caractères.');
        }
    });
});

//function pour defiler d'images d'entete
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('slider');
    const images = slider.getElementsByTagName('img');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');
    let currentImageIndex = 0;
    let interval;

    function showImage(index) {
        for (let i = 0; i < images.length; i++) {
            images[i].classList.add('hidden');
        }
        images[index].classList.remove('hidden');
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }

    function startInterval() {
        interval = setInterval(nextImage, 3000);
    }

    function resetInterval() {
        clearInterval(interval);
        startInterval();
    }

    nextButton.addEventListener('click', function() {
        nextImage();
        resetInterval();
    });

    prevButton.addEventListener('click', function() {
        prevImage();
        resetInterval();
    });

    showImage(currentImageIndex);
    startInterval();
});


