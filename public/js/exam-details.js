$(document).ready(function (){

    var GradeBaseUrl = 'http://localhost:8000/api/grades';
    var ExamBaseUrl = 'http://localhost:8000/api/exams';
    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    /*function getAllGrades(){
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
    getAllGrades();*/

    alertify.set('notifier','position', 'top-center');
    function endExam(examData){
        return $.ajax({
            url: ExamBaseUrl + '/end-exam',
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alertify.success('Enregistré avec succès !');

                setTimeout(()=>{
                    window.reload();
                }, "2000" );

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", xhr.responseJSON );

            }
        });
    }

    function archieveExam(examID){
        return $.ajax({
            url: ExamBaseUrl + `/close/${examID}`,
            method: 'POST',
            success: function(response){
                alertify.success('Sauvegardé avec succès !');

                setTimeout(()=>{
                    window.reload();
                }, "2000" );

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", xhr.responseJSON );
            }
        });
    }


    function updateStudent(examData){
        return $.ajax({
            url: ExamBaseUrl + '/update-student',
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alertify.success('Examen terminé !');

                setTimeout(()=>{
                    location.reload();
                }, "2000" )

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", error, );

            }
        });
    }
    function addSomeone(examData){
        return $.ajax({
            url: ExamBaseUrl + '/add-student',
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alertify.success('Elève ajouté !');

                setTimeout(()=>{
                    location.reload();
                }, "2000" )
            },
            error: function(xhr, status, error) {
                alertify.error('Une erreur s\'est produite!');

                setTimeout(()=>{
                    window.reload();
                }, "2000" );
            }
        });
    }
    function deleteSomeone(examData){
        return $.ajax({
            url: ExamBaseUrl + '/delete',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alertify.error('Supprimé avec succès !');

                setTimeout(()=>{
                    window.reload();
                }, "2000" )

            },
            error: function(xhr, status, error) {
                alertify.error('Examen terminé !');

                setTimeout(()=>{
                    window.reload();
                }, "2000" )
            }
        });
    }


    $(".deleteSomeoneFromExam").off('click').on('click', function (){
        var examData={};
        examData.examId = $(this).data('exam-id');
        examData.studentId = $(this).data('student-id');

        console.log(examData);
        deleteSomeone(examData);
    });





    $(".addParticipantSubmissionButton").on('click', function (event){
        event.preventDefault();

        var examData = {};

        examData.examId = $(this).data('exam-id');
        examData.studentId = $("#userSelect").val();
        examData.noteKata = 0;
        examData.noteKumite = 0;
        examData.noteKihon = 0;
        examData.cost = $('.exam-cost-row .exam-cost').val() ?? 0;
        examData.gradeId = $("#gradeSelect").val();
        console.log(examData);
        addSomeone(examData);
    });



    $('#addParticipantButton').on('click', function() {

        $("#addingSomeone-modal").modal('toggle');

    });



    $('#addingSomeone-modal').on('shown.bs.modal', function () {
        $("#gradeSelect").select2({
            dropdownParent: $('#addingSomeone-modal')
        });
        $("#userSelect").select2({
            dropdownParent: $('#addingSomeone-modal')
        });

        $('#gradeSelect').val(null).trigger('change');
        // Afficher le champ de coût par défaut
        $('.exam-cost').closest('.row').show();
    });




    $('#gradeSelect').on('change', function() {
        var selectedGradeId = $(this).val(); // Obtenez l'ID du grade sélectionné
        var existingGrades = $('#addParticipantButton').data('grades'); // Récupérer les grades existants du bouton

        // Vérifier si le grade est déjà ajouté
        if (existingGrades.includes(parseInt(selectedGradeId))) {
            // Masquer le champ de coût
            $('.exam-cost').closest('.row').hide();
        } else {
            // Afficher le champ de coût
            $('.exam-cost').closest('.row').show();
        }
    });





    $(".editGradeButton").on('click', function(){

        $('#changingGrade-modal').modal('toggle');


        var examId = $(this).data('exam-id');
        var studentId = $(this).data('student-id');
        var grades = $(this).data('grades');

        var name = $(this).closest('tr').find('.student-name').text();

        // Stocker examId et studentId dans le modal
        $('#changingGrade-modal').data('exam-id', examId);
        $('#changingGrade-modal').data('student-id', studentId);
        $('#changingGrade-modal').data('grades', grades);
        $('#changingGrade-modal').find('.modal-title').text(name);

    });

    $('#changingGrade-modal').on('shown.bs.modal', function () {
        $("#gradeSelection").select2({
            dropdownParent: $('#changingGrade-modal')
        });

        $('#gradeSelection').val(null).trigger('change');
        // Afficher le champ de coût par défaut
        $('.exam-cost').closest('.row').show();
    });

    $('#gradeSelection').on('change', function() {
        var selectedGradeId = $(this).val(); // Obtenez l'ID du grade sélectionné
        var existingGrades = $('#changingGrade-modal').data('grades'); // Récupérer les grades existants du bouton

        // Vérifier si le grade est déjà ajouté
        if (existingGrades.includes(parseInt(selectedGradeId))) {
            // Masquer le champ de coût
            $('.exam-cost').closest('.row').hide();
        } else {
            // Afficher le champ de coût
            $('.exam-cost').closest('.row').show();
        }
    });
    $(".changingGradeSubmitButton").on('click', function(){

        var examData={};
        $('#changingGrade-modal').modal("hide");

        examData.examId = $('#changingGrade-modal').data('exam-id');
        examData.studentId = $('#changingGrade-modal').data('student-id');

        examData.gradeId = $('#changingGrade-modal #gradeSelection').val();
        examData.cost = $('#changingGrade-modal .exam-cost').val();

        if(!examData.gradeId)
            console.log('Pas trouvé ');
        // Appeler la fonction pour mettre à jour l'étudiant
        updateStudent(examData);
    });

    $('#terminateExamButton').on('click', function (){
       $('.first-tab').hide();
       $('.second-tab').removeClass('d-none');
    });





    $("#endExamButton").on('click', function () {
        var examData = {};
        examData.examId = $(this).data('exam-id');

        examData.payload = {};  // Utiliser un objet au lieu d'un tableau pour le payload

        $("tr").each(function () {
            var student_id = $(this).data('student-id');
            var grade_id = $(this).data('grade-id');

            if (!student_id) return; // Continue si student_id n'est pas défini pour cet élément

            var noteKata = $(this).find('.noteKata').val();
            var noteKumite = $(this).find('.noteKumite').val();
            var noteKihon = $(this).find('.noteKihon').val();

            // Calcul de la délibération (non utilisé dans cet exemple, mais correction pour référence)
            var deliberation = (parseFloat(noteKata) + parseFloat(noteKihon) + parseFloat(noteKumite)) / 3 >= 10 ? 'success' : 'failure';

            // Ajouter l'entrée au payload en utilisant student_id comme clé
            examData.payload[student_id] = [noteKata, noteKihon, noteKumite, deliberation, grade_id];
        });

        console.log(examData.payload);
        endExam(examData);
    });



    $("#archieveExamButton").on('click', function () {

        var examId = $(this).data('exam-id');

        archieveExam(examId);
    });


    // Fonction pour ouvrir le modal et définir les données initiales
    $(".modifyNotesButton").on('click', function() {
        $('#modifyNote-modal').modal("toggle");

        var examId = $(this).data('exam-id');
        var studentId = $(this).data('student-id');
        var name = $(this).closest('tr').find('.student-name').text();

        // Stocker examId et studentId dans le modal
        $('#modifyNote-modal').data('exam-id', examId);
        $('#modifyNote-modal').data('student-id', studentId);

        // Mettre à jour le titre du modal
        $('#modifyNote-modal').find('.modal-title').text(name);
    });

// Fonction pour soumettre les nouvelles notes
    $('.modifyNotesSubmitButton').on('click', function() {
        var examData = {};

        $('#modifyNote-modal').modal("hide");
        // Récupérer examId et studentId depuis le modal
        examData.examId = $('#modifyNote-modal').data('exam-id');
        examData.studentId = $('#modifyNote-modal').data('student-id');

        // Récupérer les nouvelles notes
        examData.noteKata = parseFloat($('#modifyNote-modal .noteKata').val());
        examData.noteKumite = parseFloat($('#modifyNote-modal .noteKumite').val());
        examData.noteKihon = parseFloat($('#modifyNote-modal .noteKihon').val());

        // Calculer la délibération
        examData.deliberation = (examData.noteKata + examData.noteKihon + examData.noteKumite) / 3 >= 10 ? 'success' : 'failure';

        // Appeler la fonction pour mettre à jour l'étudiant
        updateStudent(examData);
    });


});
