

function openEditModal(button) {
    const userId = button.getAttribute('data-id');
    const userName = button.getAttribute('data-name');
    const userFirst_name = button.getAttribute('data-Fist_name');
    
    document.getElementById('userId').value = userId;
    document.getElementById('userName').value = userName;
    document.getElementById('userFirst_name').value = userFirst_name;
    
    document.getElementById('editModal_2').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

