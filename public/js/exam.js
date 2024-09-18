$(document).ready(function () {

    var GradeBaseUrl = 'http://localhost:8000/api/grades';
    var ExamBaseUrl = 'http://localhost:8000/api/exams';


    var stepper = 0;
    var nextButton = $('.addExamNextButton');
    var backButton = $('.addExamBackButton');
    var tab1=$('.tab1');
    var tab2=$('.tab2');
    var tab3=$('.tab3');

    var AllGrades = [];
    var AllStudents = [];
    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    alertify.set('notifier','position', 'top-center');

    function createExam(examData) {
        return $.ajax({
            url: ExamBaseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alertify.success('Examen programmé avec succès');
                setTimeout(()=>{
                    window.location.replace("http://localhost:8000/main/exam/exams");
                }, "2000" )
            },
            error: function(xhr, status, error) {
                alertify.error("Une erreur s'est produite :", xhr.responseJSON);
            }
        });
    }

    function getAllGrades(){
        return $.ajax({
            url: GradeBaseUrl,
            method: "GET",
            dataType: 'json',
            contentType: "application/json",
            headers: requestHeaders,
            success: function (response){
                AllGrades = response.grades;
                console.log(AllGrades)
            },
            error: function (xhr, status, error) {
                alertify.error('Oops, une erreur s\'est produite');
                console.log(xhr.responseJSON);
            }
        });
    }

    function getStudents(gradeData,gradeId){
        return $.ajax({

            url: GradeBaseUrl+ `/show/${gradeId}`,
            method: "POST",
            dataType: 'json',
            contentType: "application/json",
            data: JSON.stringify(gradeData),
            headers: requestHeaders,
            success: function (response){
                AllStudents = response[0];
                if(AllStudents.length == 0){
                    alertify.error('Aucun élève n\'est elligible pour ce grade');
                }

            },
            error: function (xhr, status, error) {
                alertify.error('Oops, une erreur s\'est produite');
                console.log(xhr.responseJSON);
            }
        });
    }

    function modifyExam(examData){
        return $.ajax({

            url: ExamBaseUrl+ `/modify/${examData.event_id}`,
            method: "PATCH",
            dataType: 'json',
            contentType: "application/json",
            data: JSON.stringify(examData),
            headers: requestHeaders,

            success: function (response){
               alertify.success('Examen mis à jour avec succès');
            },

            error: function (xhr, status, error) {
                alertify.error('Oops, une erreur s\'est produite');
                console.log(xhr.responseJSON);
            }
        });
    }


    getAllGrades();




    nextButton.on('click', function(event){

        event.preventDefault();

        if(stepper==0){
            stepper++;
            tab1.hide();
            backButton.removeClass('d-none');
            tab2.removeClass('d-none');
        } else if(stepper == 1){
            stepper++;
            getTab3ready();
            tab2.addClass('d-none');
            tab3.removeClass('d-none');
        }else if (stepper == 2){

            console.log($(this).data('action'));

            if($(this).data('action') === 'create'){
                createExam(fetchExamData());
                console.log('creaation');
            }else if($(this).data('action') == 'update'){
                var examData = fetchExamData();
                examData.event_id = $(this).data('event-id');
                modifyExam(examData);
                console.log('creaation');
            }
        }

    });

    backButton.on('click', function (event){

       event.preventDefault();
       if(stepper === 1){
           stepper--;
           tab2.addClass('d-none');
           tab1.fadeIn();
           $(this).addClass('d-none');

       }else if(stepper==2){

            stepper--;
            tab3.addClass('d-none');
            tab2.removeClass('d-none');

       }
    });

    $('body').on('change', '.grade-select', async function () {

        let gradeId = $(this).val();
        let clubId = $('#stepper').data('club-id');
        let gradeData = {};
        let parent = $(this).closest('.grade-section');
        let userSelect =  parent.find('.user-select');
        let gradeSelect = parent.find('.grade-select');
        let selectedUserOptions = userSelect.find('option');
        let selectedUserArea = parent.find('.selectedUserArea');

        gradeData.gradeId = gradeId;
        gradeData.clubId = clubId;
        userSelect.attr('disabled', true);
        selectedUserArea.html('<span class="fst-italic placeholder-fill">Aucun élève sélectionné</span>');

        selectedUserOptions.each(function (){
            $(this).remove();
        });

        if (!gradeId) {

            parent.find('.user-select').attr('disabled', true);

        } else {
            await getStudents(gradeData, gradeId);
            if(AllStudents.length != 0){
                userSelect.append('<option value="">...</option>');
                AllStudents.forEach((student) => {
                    userSelect.append('<option value="'+student.id+'">'+student.firstName+' '+student.lastName+'</option>');
                });

                parent.find('.user-select').removeAttr('disabled');
            }

        }

    });


    function getTab3ready(){

        let collectData = {};
        collectData.startDate = $(".startDate").val();
        collectData.startTime = $(".startTime").val();
        collectData.location = $(".location").val();
        collectData.payload = [];

        $(".grade-section").each(function () {
            let students = [];
            let gradeId = $(this).find('.grade-select').val();
            let examCost = $(this).find('.exam-cost').val();

            // Récupération du gradeName via la méthode find
            let grade = AllGrades.find(grade => grade.id == gradeId);
            let gradeName = grade ? grade.beltName : '';

            $(this).find('.selectedUserArea .selected-item').each(function () {
                students.push({
                    "id": $(this).data('value'),
                    "username" : $(this).clone().children().remove().end().text().trim(),
                    "gradename" : gradeName
                });
            });

            collectData.payload.push({
                "grade_id": gradeId,
                "cost": examCost,
                "students": students
            });
        });

        console.log('Get tab3 ready ' +JSON.stringify(collectData));

        populateTable(collectData);
    }

    function populateTable(collectData) {
        let table = $('table');
        let counter = 1;
        let rows = '';

        $('.recapExamLocation').text(collectData.location);
        $('.recapExamDateTime').text(`${collectData.startDate} (${collectData.startTime})`);

        collectData.payload.forEach((block) => {
            block.students.forEach((student) => {
                rows += '<tr> ' +
                    '<th scope="row">' + counter + '</th> ' +
                    '<td>' + student.username + '</td>' +
                    '<td> Ceinture ' + student.gradename + '</td>' +
                    '<td>' + block.cost + ' FCFA</td>' +
                    '</tr>';
                counter++;
            });
        });


        table.find('tbody').text('');
        table.find('tbody').append(rows);
    }



    $("#add-grade-section").on('click', function () {
        // Cloner la section de modèle
        var newSection = $(".grade-section").first().clone();


        newSection.find('select').each(function() {
            if ($(this).hasClass('select2-hidden-accessible')) {
                console.log('Déjà initialisé mais va être détruit');
                $(this).select2('destroy');  // Détruire select2

                // Supprimer tous les conteneurs et résidus de select2
                $(this).next('.select2-container').remove();
                $(this).removeClass('select2-hidden-accessible');
                $(this).removeAttr('data-select2-id');
                $(this).removeAttr('tabindex');
                $(this).removeAttr('aria-hidden');
            }

            if ($(this).hasClass('select2-hidden-accessible')) {
                console.log('Destruction lancé mais apparemment c\'est encore là');
            } else {
                console.log('Détruit correctement !');
            }
        });
        newSection.find('.grade-select').val('');
        newSection.find('.user-select').val('');
        newSection.find('.exam-fee').val('');
        newSection.find('.selectedUserArea').text('');


        $('#sections-container').prepend(newSection);

        newSection.find('select').select2();

    });




    // Gestion de la sélection d'utilisateur dans chaque section
    $('#sections-container').on('change', '.user-select', function () {
        $(".placeholder-fill").remove();
        var selectedUser = $(this).find('option:selected');
        var selectedUserArea = $(this).closest('.grade-section').find('.selectedUserArea');

        selectedUser.each(function () {
            var value = $(this).val();
            var text = $(this).text();
            var gradeName = $(this).data('grade-name');

            selectedUserArea.append(
                '<div class="selected-item" data-grade-name="'+gradeName+'"'+'data-value="' + value + '">' +
                text +
                '<a class="btn btn-sm bg-danger-light remove-item"><i class="feather-x-circle text-danger"></i></a>' +
                '</div>'
            );

            $(this).remove();
        });
    });

    // Gestion de la suppression d'utilisateur dans chaque section
    $('#sections-container').on('click', '.remove-item', function () {
        var parent = $(this).parent();
        var text = parent.clone().children().remove().end().text().trim();
        var value = parent.data('value');
        var userSelect = $(this).closest('.grade-section').find('.user-select');

        // Réajouter l'utilisateur à la liste de sélection
        userSelect.append(
            '<option value="' + value + '">' + text + '</option>'
        );

        // Supprimer l'élément sélectionné de la zone
        parent.remove();
    });

    $(document).on('click', '.grade-section', function() {


        var oldSection = $(this);

        oldSection.find('select').each(function() {
            if (!$(this).hasClass('select2-hidden-accessible')) {
                $(this).select2();
            }
        });
    });

    $(document).on('click', '.remove-grade', function() {

       if($('.grade-section').length != 1){
           var parent = $(this).closest('.grade-section');
           var oldSection = parent.next('.grade-section');

           parent.remove();


           oldSection.find('select').each(function() {
               if ($(this).hasClass('select2-hidden-accessible')) {
                   console.log('Déjà initialisé mais va être détruit');
                   $(this).select2('destroy');  // Détruire select2

                   // Supprimer tous les conteneurs et résidus de select2
                   $(this).next('.select2-container').remove();
                   $(this).removeClass('select2-hidden-accessible');
                   $(this).removeAttr('data-select2-id');
                   $(this).removeAttr('tabindex');
                   $(this).removeAttr('aria-hidden');
               }

               if ($(this).hasClass('select2-hidden-accessible')) {
                   console.log('Destruction lancé mais apparemment c\'est encore là');
               } else {
                   console.log('Détruit correctement !');
               }
           });

           oldSection.find('select').select2();
       }
    });



function fetchExamData(){


    var examData = {};

    examData.startDateTime = $(".startDate").val() + 'T' + $(".startTime").val() + ':00';
    examData.location = $(".location").val();
    examData.payload = [];

    $(".grade-section").each(function () {

        var students = [];

        $(this).find('.selectedUserArea .selected-item').each(function () {
            students.push({
                "id": $(this).data('value'),
                "noteKata": 0,
                "noteKihon": 0,
                "noteKumite": 0,
                "deliberation": "failure"
            });
        });

        examData.payload.push({
            "grade_id": $(this).find('.grade-select').val(),
            "cost": $(this).find('.exam-cost').val(),
            "students": students
        });
    });

return examData;



}




});

