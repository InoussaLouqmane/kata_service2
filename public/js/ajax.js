$(document).ready(function () {

    let $photoInputButton = $('#photoInput');
    let $fileLabelText = $('#fileLabelText');
    let $checkIcon = $('#checkIcon');
    let $previewImg = $('#previewImg');

    $photoInputButton.on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            $fileLabelText.text(file.name);
            $checkIcon.show();
            const reader = new FileReader();
            reader.onload = function (e) {
                $previewImg.attr('src', e.target.result);
                $previewImg.show();
            };
            reader.readAsDataURL(file);
        } else {
            $fileLabelText.text('Choose File');
            $checkIcon.hide();
            $previewImg.hide();
        }
    });

    $('#ownerSelect').select2({
        placeholder: 'Sélectionnez un utilisteur',
    });
    $('#clubSelect').select2({
        placeholder: 'Sélectionnez un club',
    });
    $('#disciplineSelect').select2({
        placeholder: 'Sélectionnez une discipline',
    });

});
