document.addEventListener('DOMContentLoaded', function() {

    $('#roleSelect').select2();
    $('#clubSelect').select2();

    const roleSelector = $('#roleSelect');
    const clubContainer = $('#clubContainer');
    -
    roleSelector.on('change', function(e) {

        console.log('This has changed: ', roleSelector.val());

        if (roleSelector.val() === 'Sensei') {
            clubContainer.show(); // Afficher le conteneur du sélecteur
            console.log('Displaying club selector');
        } else {
            clubContainer.hide(); // Masquer le conteneur du sélecteur
            console.log('Hiding club selector');
        }
    });
});
