document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('myModal');
    const modalOverlay = document.getElementById('modalOverlay');
    const closeModalButton = document.getElementById('closeModalButton');

    // Function to open the modal
    function openModal() {
        modal.classList.remove('hidden');
        modalOverlay.classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal() {
        modal.classList.add('hidden');
        modalOverlay.classList.add('hidden');
    }

    // Close modal when clicking the close button
    closeModalButton.addEventListener('click', closeModal);

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modalOverlay) {
            closeModal();
        }
    });
});

// Example function to open the modal (you can trigger this function from a button click or other event)
function showModal() {
    document.getElementById('myModal').classList.remove('hidden');
    document.getElementById('modalOverlay').classList.remove('hidden');
}
