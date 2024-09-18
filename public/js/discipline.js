$(document).ready(function () {



    var DisciplineUrl = 'http://localhost:8000/api/discipline';


    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };



    function createDiscipline(disciplineData) {
        return $.ajax({
            url: DisciplineUrl + '/store',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(disciplineData),
            success: function(response){
                alert('Discipline Created');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", xhr.responseJSON);
            }
        });
    }

    var GradesDetail = {};
    function getSomeGrades(id) {
        return $.ajax({
            url: DisciplineUrl + `/filter/${id}`,
            method: 'GET',

            success: function(response){
                GradesDetail = response;
            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", xhr.responseJSON);
            }
        });
    }

    function deleteDiscipline(id) {
        return $.ajax({
            url: DisciplineUrl + `/delete/${id}`,
            method: 'DELETE',

            success: function(response){
                alert('Delete successfuly');
            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", xhr.responseJSON);
            }
        });
    }

    function updateDiscipline(disciplineData) {
        return $.ajax({
            url: DisciplineUrl +`/update/${disciplineData.id}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(disciplineData),
            success: function(response){
                alert('Discipline updated');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", xhr.responseJSON);
            }
        });
    }

    var stepper = 0;

    let tab1 = $('.tab1');
    let tab2 = $('.tab2');
    let tab3 = $('.tab3');
    let nextButton = $('.addDisciplineNextButton');
    let backButton = $('.addDisciplineBackButton');
    let recapTitle = $('#disciplineTitle');
    let recapDescription = $("#disciplineDescription");
    let disciplineTitleField = $("#disciplineName");
    let descriptionField = $('#disciplineDescriptionField');
    let centerModal = $('#centermodal');
    let checkDescriptionEyeButton = $('.checkDescriptionButton');
    let seeDisciplineDetailsButton = $('.seeDisciplineDetailsButton');


    let generalDetailsFrom = $(".generalDetails");



    checkDescriptionEyeButton.on('click', function () {
        if (descriptionField.val()) {
            centerModal.find('.description-content').text(descriptionField.val())
        } else {
            centerModal.find('.description-content').text('Aucune description mentionnée');
        }
        centerModal.modal('toggle');
    });


    nextButton.on('click', function () {

        if (stepper == 0) {

            generalDetailsFrom.validate();

            stepper++;
            tab1.hide();
            tab2.removeClass('d-none');
            backButton.removeClass('d-none');

            recapTitle.text(disciplineTitleField.val());
            if (descriptionField.val()) {
                recapDescription.text(descriptionField.val());
            } else {
                recapDescription.text('Aucune description')
            }
        } else if (stepper == 1) {



            let AllGradeComponents = $('.gradeComponent');
            let gradeList = $('#gradeList');
            AllGradeComponents.each(function () {
                let field_content = $(this).find('.gradeName').val();
                let color = $(this).find('#gradeColor').val();
                let div = '';
                if (field_content) {

                    div =
                        '<div class="mb-3"> <i class="fas fa-circle" style="color: '
                        + color +
                        '"></i><span> '
                        + field_content +
                        '</span></div>';
                    gradeList.append(div);
                }
            })

            stepper++;
            tab2.addClass('d-none');
            tab3.removeClass('d-none');

        } else if(stepper ==2){
            let AllGradeComponents = $('.gradeComponent');

            let disciplineData = {};

            disciplineData.name = disciplineTitleField.val();
            disciplineData.description = descriptionField.val();
            disciplineData.grades= [];

            AllGradeComponents.each(function(){
                let field_content = $(this).find('.gradeName').val().trim();
                let color = $(this).find('#gradeColor').val();

                if(field_content)
                disciplineData.grades.push({
                    'beltName' : field_content,
                    'beltColor': color
                });

            });

            if(nextButton.data('action') == 'create'){

                createDiscipline(disciplineData);
            }else if(nextButton.data('action') == 'update'){
                    disciplineData.id = nextButton.data('discipline-id');
                    updateDiscipline(disciplineData);

            }
        }
    });

    backButton.on('click', function () {

        if (stepper == 1) {

            stepper--;
            tab2.addClass('d-none');
            backButton.addClass('d-none');
            tab1.fadeIn();
        } else if(stepper == 2){
            stepper--;
            tab3.addClass('d-none');
            tab2.removeClass('d-none');
        }
    });


    tab2.on('input', '.gradeName', function () {
        let allGradeComponent = $('.gradeComponent');
        let gradeComponent = $(this).closest('.gradeComponent');


        if (gradeComponent.is(':last-child')) {

            let newComponent = $('.gradeComponent').first().clone();
            newComponent.find('.gradeName').val('');
            tab2.append(newComponent);
        }

    });

    tab2.on('click', '.deleteGradeComponentButton', function () {
        let allGradeComponents = $('.gradeComponent');
        if (allGradeComponents.length > 1) {
            let gradeComponent = $(this).closest('.gradeComponent');
            gradeComponent.remove();
        }
    });

    $('body').on('click', '.seeDisciplineDetailsButton', async function () {
        let discipline_id = $(this).data('discipline-id');
        let disciplineName = $(this).closest('td').parent().find('.disciplineName').text();
        centerModal.find('#disciplineTitle').text(disciplineName);
        console.log('DisciplineID ', discipline_id);
        await getSomeGrades(discipline_id);
        console.log(GradesDetail);

        let gradeList = centerModal.find('#gradeList');
        gradeList.empty();

        let gradesArray = GradesDetail[0];

        gradesArray.forEach(function(grade) {
            let gradeName = grade.beltName;
            let color = grade.beltColor;

            gradeList.append(
                '<div class="mb-3"> <i class="fas fa-circle" style="color: '
                + color +
                '"></i><span> '
                + gradeName +
                '</span></div>'
            );
        });

        centerModal.modal('toggle');
    });

    $('.deleteDiscipline').on('click', function (){
        deleteDiscipline($(this).data('discipline-id'));
    })

});

