document.addEventListener('DOMContentLoaded', function(){

    const confirmationModal = document.getElementById('check-button');
    const hiddenInputConfirmationModal = document.getElementById('hiddenInputConfirmationModal');

    const rejectionModal = document.getElementById('reject-button');
    const hiddenInputRejectionModal = document.getElementById('hiddenInputRejectModal');


    confirmationModal.addEventListener('click', (e) => {
        hiddenInputConfirmationModal.value = confirmationModal.getAttribute('data-requestId');
        console.log('la valeur actuelle du champ hidden : hiddenInputConfirmationModal', hiddenInputConfirmationModal.value);
    });



    rejectionModal.addEventListener('click', (e)=>{
        hiddenInputRejectionModal.value = rejectionModal.getAttribute('data-requestId');
        console.log("value de rejectionModal: ", hiddenInputRejectionModal.value);
    });





})
