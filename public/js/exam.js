$(document).ready(function () {

    var GradeBaseUrl = 'http://localhost:8000/api/grades';
    var ExamBaseUrl = 'http://localhost:8000/api/exams';

    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    $('.grade-select').select2();
    $('.user-select').select2();


    function createExam(examData) {
        return $.ajax({
            url: ExamBaseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alert('Event Created');
                $(window).attr('location','http://localhost:8000/main/exam/exams');
            },
            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", xhr.responseJSON);
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
                console.log(AllGrades);

            }
        });
    }
    var AllGrades = [];
    getAllGrades();

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

            selectedUserArea.append(
                '<div class="selected-item" data-value="' + value + '">' +
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



    $(".examSubmit").off('click').on('click', function (event) {


        event.preventDefault();

        var examData = {};
        examData.startDateTime = $(".startDate").val() + 'T' + $(".startTime").val() + ':00';
        examData.location = $(".location").val();
        examData.payload = [];

        $(".grade-section").each(function () {
            var students = [];


            $(this).find('.selectedUserArea .selected-item').each(function () {
                students.push({
                    "id": $(this).data('value'),
                    "noteKata": 0,       // Initialisation par défaut
                    "noteKihon": 0,      // Initialisation par défaut
                    "noteKumite": 0,     // Initialisation par défaut
                    "deliberation": "failure" // Initialisation par défaut
                });
            });

            // Ajoute les informations de grade et les étudiants associés au payload
            examData.payload.push({
                "grade_id": $(this).find('.grade-select').val(), // Utilise find pour sélectionner dans le contexte actuel
                "cost": $(this).find('.exam-cost').val(), // Utilise find pour sélectionner dans le contexte actuel
                "students": students
            });
        });

        // Retourne ou utilise examData comme nécessaire
        console.log(examData); // Pour voir le résultat dans la console
       createExam(examData); // Assurez-vous que cet objet est utilisé comme souhaité, par exemple pour une requête AJAX
    });




});

