$(document).ready(function (){

    var FeesBaseUrl = 'http://localhost:8000/api/fees';

    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    function createFees(feeData) {

        return $.ajax({
            url: FeesBaseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(feeData),
            success: function(response){
                alert('Fees Initiated');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
                console.log(xhr.responseJSON);
            }
        });
    }

    function updateFees(feeData) {

        return $.ajax({
            url: FeesBaseUrl + `/update/${feeData.id}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(feeData),
            success: function(response){
                alert('Fees Updated');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
                console.log(xhr.responseJSON);
            }
        });
    }

    function deleteFees(id) {

        return $.ajax({
            url: FeesBaseUrl + `/delete/${id}`,
            method: 'DELETE',
            success: function(response){
                alert('Fees Deleted');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", xhr.responseJSON);
                console.log(xhr.responseJSON);
            }
        });
    }


    $('.addFeePlusButton').on('click', function(){
        let feeModal = $('#create-fees-modal');
        feeModal.attr('data-action', 'create');

        feeModal.find('.modal-title').text('Ajouter un frais');
        feeModal.find('#feesSubmitButton').text('Ajouter');

        $('.fees-name').val('');
        $('.fees-cost').val(0);
        $('.fees-frequency').val(0);

        feeModal.modal('toggle');
    });


    $('.deleteFeesButton').on('click', function (){
        let tr = $(this).closest('tr');
        let fee_id = parseInt(tr.data('fee-id'));

        deleteFees(fee_id);
    });

    $('.EditFeesButton').on('click', function(){

        let feeModal = $('#create-fees-modal');
        let tr = $(this).closest('tr');
        let fee_id = parseInt(tr.data('fee-id').trim());
        let designation = tr.find('.designation').text().trim();
        let frequency = tr.find('.frequency').data('frequency');
        let amount = parseFloat(tr.find('.amount').text().trim());

        amount = (amount ? amount : 0);

        $('.fees-name').val(designation);
        $('.fees-cost').val(amount);
        $('.fees-frequency').val(frequency);
        feeModal.attr('data-fee-id', fee_id);

        feeModal.find('.modal-title').text('Modifier le frais');
        feeModal.find('#feesSubmitButton').text('Modifier');

        feeModal.attr('data-action', 'update');
        feeModal.modal('toggle');
    });



    $('#create-fees-form').on('submit', function(event){

        event.preventDefault();

        let feesData = {};
        let feeModal = $('#create-fees-modal');

        feesData.name = $('.fees-name').val();
        feesData.cost = $('.fees-cost').val();
        feesData.frequency = $('.fees-frequency').val();
        feesData.club_id = $('#club_id').val();


        if(feeModal.data('action') === 'update'){
            feesData.id = parseInt(feeModal.data('fee-id'));
            updateFees(feesData);
        }else if(feeModal.data('action') === 'create'){
            createFees(feesData);
        }else {
            console.error('Neither update nor create action detected');
        }

    });




});
