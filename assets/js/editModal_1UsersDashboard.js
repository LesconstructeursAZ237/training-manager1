
/* function openEditModal1(button) {
    const userId = button.getAttribute('data-id');
    const userName = button.getAttribute('data-name');
    const userFirst_name = button.getAttribute('data-Fist_name');
    
    document.getElementById('userId').value = userId;
    document.getElementById('userName').value = userName;
    document.getElementById('userFirst_name').value = userFirst_name;
    
    document.getElementById('editModal_2').classList.remove('hidden');
}

function closeEditModal1() {
    document.getElementById('editModal1').classList.add('hidden');
} */
function openModal(button) {
     const userId = button.getAttribute('data-id');
    const userName = button.getAttribute('data-name');
    const userFist_name= button.getAttribute('data-Fist_name');
    const userEmail = button.getAttribute('data-email');

   // const userDetails = 'bonjou modifier';
   // const userNames=`ID: ${userId}<br>Nom: ${userName}<br>Email: ${userFist_name}`;
    
    document.getElementById('userFirst_name').innerHTML = text 01;  
    
    document.getElementById('OpenModal').classList.remove('hidden');
}

function closeOpenModal() {
    document.getElementById('OpenModal').classList.add('hidden');
}