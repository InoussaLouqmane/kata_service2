document.addEventListener('DOMContentLoaded', function() {

    let photoInputButton = document.getElementById('photoInput');


    photoInputButton.addEventListener('change', function(event) {
        const file = event.target.files[0];
        const fileLabelText = document.getElementById('fileLabelText');
        const checkIcon = document.getElementById('checkIcon');
        if (file) {
            fileLabelText.textContent = file.name;
            checkIcon.style.display = 'inline';
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('previewImg').style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            fileLabelText.textContent = 'Choose File';
            checkIcon.style.display = 'none';
            document.getElementById('previewImg').style.display = 'none';
        }
    });



        $('#ownerSelect').select2({
            placeholder: 'Select a user',

        });


});
