$(document).ready(function () {

    var transactionBaseUrl ='http://localhost:8000/api/transactions'

    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    function verifyTransactions(transactionData){
        return $.ajax({
            url: transactionBaseUrl+'/verify',
            method: 'POST',
            headers: requestHeaders,
            contentType: "application/json",
            data: JSON.stringify(transactionData),
            success: function(response){
                alert('Paiement effectué avec succès !');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
                console.log(xhr.responseJSON);
            }
        });
    }

    addSuccessListener(response => {

        let transactionData= {};
        transactionData.kkia_transaction_id = response.transactionId;
        transactionData.kata_transaction_id = response.data

        console.log('les données dans objet coeur ' ,transactionData);
        verifyTransactions(transactionData);


    });

    addFailedListener(error => {
        console.log("Transaction échouée : ", error);
    });


    $('.paybutton').on('click', function () {
        let amount = $(this).data('amount');
        let transaction_id = $(this).closest('tr').data('transaction-id');

        openKkiapayWidget({
            amount: amount,
            position: "center",
            callback: '',
            data: transaction_id,
            theme: "green",
            sandbox: true,
            key: "8d3a1dc06d4211efb027ed63ca10541d"
        });
    });
});
