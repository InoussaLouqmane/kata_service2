$(document).ready(function (){

    var GradeBaseUrl = 'http://localhost:8000/api/grades';
    var ExamBaseUrl = 'http://localhost:8000/api/exams';
    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };

    function updateStudent(examData){
        return $.ajax({
            url: ExamBaseUrl + '/update-student',
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alert('Saved with success');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", error, );

            }
        });
    }
    function endExam(examData){
        return $.ajax({
            url: ExamBaseUrl + '/end-exam',
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(examData),
            success: function(response){
                alert('Saved with success');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", error, );

            }
        });
    }

    function archieveExam(examID){
        return $.ajax({
            url: ExamBaseUrl + `/close/${examID}`,
            method: 'POST',
            success: function(response){
                alert('Saved with success');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", error, );
            }
        });
    }



    $("#endExamButton").on('click', function () {
        var examData = {};
        examData.examId = $(this).data('exam-id');

        examData.payload = {};  // Utiliser un objet au lieu d'un tableau pour le payload

        $("tr").each(function () {
            var student_id = $(this).data('student-id');
            if (!student_id) return; // Continue si student_id n'est pas défini pour cet élément

            var noteKata = $(this).find('.noteKata').val();
            var noteKumite = $(this).find('.noteKumite').val();
            var noteKihon = $(this).find('.noteKihon').val();

            // Calcul de la délibération (non utilisé dans cet exemple, mais correction pour référence)
            var deliberation = (parseFloat(noteKata) + parseFloat(noteKihon) + parseFloat(noteKumite)) / 3 >= 10 ? 'success' : 'failure';

            // Ajouter l'entrée au payload en utilisant student_id comme clé
            examData.payload[student_id] = [noteKata, noteKihon, noteKumite, deliberation];
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
