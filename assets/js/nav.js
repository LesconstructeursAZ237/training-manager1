

// function menu deroulent nav barre//Étape 4 : Attendre que le DOM soit entièrement chargé avant d'ajouter les écouteurs d'événements
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('main_nav');
    const hiddenMenu = document.getElementById('main_nav1');

    // Étape 5 : Ajouter un écouteur d'événement au bouton pour détecter les clics
    menuButton.addEventListener('click', function() {
        // Étape 6 : Ajouter ou enlever la classe 'hidden' pour afficher/masquer le menu
        hiddenMenu.classList.toggle('hidden');
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


//function js de choix de formation
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="training_check[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"][name="training_check[]"]:checked');
            if (checkedCheckboxes.length > 2) {
                this.checked = false;
                alert('Vous ne pouvez sélectionner que 02 (deux) formations au maximum.');
            }
        });
    });
});


/*  // ecouteur d'evenement sur les champs name et phone
var bouton = document.getElementById('btn_submit');
// Ajoutez un écouteur d'événement "click" au bouton
bouton.addEventListener('click', function(event) {
    event.preventDefault();

    const name = document.getElementById("name");
    const phone = document.getElementById("phone");

     if((phone.value.length) !== 9){
        alert("veillez entrer une longueur de numero telephonique valide");
        window.location.href = "pre_registration_form.html";
    } 
   
}); */




 