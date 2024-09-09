$(document).ready(function (){


    var TransferBaseUrl = 'http://localhost:8000/api/transfer';

    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    function createTransfer(transferData) {
        return $.ajax({
            url: TransferBaseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(transferData),
            success: function(response){
                alert('Transfer Initiated');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
                console.log(xhr.responseJSON);
            }
        });
    }

    function acceptTransfer(transferData) {
        return $.ajax({
            url: TransferBaseUrl + `/accept/${transferData}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(transferData),
            success: function(response){
                alert('Transfer Accept');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :",error);
                console.log(xhr.responseJSON);
            }
        });
    }

    function rejectTransfer(transferData) {
        return $.ajax({
            url: TransferBaseUrl + `/reject/${transferData.id}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(transferData),
            success: function(response){
                alert('Transfer Rejected');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :",error);
                console.log(xhr.responseJSON);
            }
        });
    }

    function cancelTransfer(transferData) {
        return $.ajax({
            url: TransferBaseUrl + `/cancel/${transferData.id}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(transferData),
            success: function(response){
                alert('Transfer Cancelled');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :",error);
                console.log(xhr.responseJSON);
            }
        });
    }


    $('#initiateTransferButton').on('click', function (){
        $("#create-transfer-modal").modal('toggle');
    });


    $('#create-transfer-modal').on('shown.bs.modal', function () {
        $("#targetClubSelect").select2({
            dropdownParent: $('#create-transfer-modal')
        });

        $("#selectedStudentSelect").select2({
            dropdownParent: $('#create-transfer-modal')
        });
    });


    $('#create-transfer-form').on('submit', function(event){
        event.preventDefault();
        var transferData = {};

        transferData.student_id = $('#selectedStudentSelect').val();
        transferData.approvingSensei_id = $('#targetClubSelect').val();
        transferData.initiatingSensei_id = $('#initiating_sensei_id').val();

        console.log(transferData);
        createTransfer(transferData);
    });

    $('.transferRefusalButton').on('click', function (){
        rejectionModal = $('#reject-modal');
        rejectionModal.modal('toggle');
        rejectionModal.attr('data-transfer-id', $(this).data('transfer-id'));
    });

    $('.transferRejectModalButton').on('click', function (){

        var transferData ={};
        transferData.id = $('#reject-modal').data('transfer-id');
        transferData.comment = $('#refusal-comment').val();
        rejectTransfer(transferData);

    });





    $('.transferAcceptationButton').on('click', function (){

        let confirmationModal = $('#confirm-modal');
        confirmationModal.modal('toggle');
        confirmationModal.attr('data-transfer-id', $(this).data('transfer-id'));
    });

    $('.transferValidateModalButton').on('click', function (){

        var transferData = $('#confirm-modal').data('transfer-id');

        acceptTransfer(transferData);
    });





    $('.transferCancelButton').on('click', function (){
        let rejectionModal = $('#cancel-modal');
        console.log('clicked  ', $(this).data('transfer-id'))
        rejectionModal.modal('toggle');
        rejectionModal.attr('data-transfer-id', $(this).data('transfer-id'));

    });

    $('.transferCancelModalButton').on('click', function (){

        var transferData ={};
        transferData.id = $('#cancel-modal').data('transfer-id');
        transferData.comment = $('#cancel-comment').val();
        cancelTransfer(transferData);

    });


    $('.motifPopUpButton').on('click', function (){

        let commentModal = $('#commentModal');
        let content = $(this).data('comment');
        if(content){
            commentModal.find('.comment-content').text(content);
        }else{
            commentModal.find('.comment-content').text('Aucun commentaire');
        }
        commentModal.modal('toggle');

    });
});

