$(document).ready(function() {

    $(document).on('click', '.delete-button', function() {
        const hiddenInputConfirmationModal = $('#hiddenInputConfirmationModal');
        hiddenInputConfirmationModal.val($(this).data('requestid'));
        console.log('la valeur actuelle du champ hidden : ', hiddenInputConfirmationModal.val());
    });

    $(document).on('click', '.check-button', function() {
        const hiddenInputConfirmationModal = $('#hiddenInputConfirmationModal');
        hiddenInputConfirmationModal.val($(this).data('requestid'));
        console.log('la valeur actuelle du champ hidden : hiddenInputConfirmationModal', hiddenInputConfirmationModal.val());
    });

    $(document).on('click', '.reject-button', function() {
        const hiddenInputRejectionModal = $('#hiddenInputRejectModal');
        hiddenInputRejectionModal.val($(this).data('requestid'));
        console.log("value de rejectionModal: ", hiddenInputRejectionModal.val());
    });
});
