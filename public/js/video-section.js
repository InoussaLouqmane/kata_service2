$(document).ready(function (){


    var resourceBaseUrl = 'http://localhost:8000/api/resources';

    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };



    function extractYouTubeID(url) {
        const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    function createResource(resourceData) {
        return $.ajax({
            url: resourceBaseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(resourceData),
            success: function(response){
                alert('Resource Added');
                location.reload();
            },

            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
            }
        });
    }

    function deleteResource(id) {
        return $.ajax({
            url: resourceBaseUrl + `/delete/${id}`,
            method: 'DELETE',
            success: function(response){
                alert('Resource Deleted');
                location.reload();
            },

            error: function(xhr, status, error) {
                alert("Une erreur s'est produite :", error);
            }
        });
    }


    function updateResource(resourceData){
        return $.ajax({
            url: resourceBaseUrl + `/update/${resourceData.id}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(resourceData),
            success: function(response){
                alert('Modified with success');
                location.reload();

            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite :", error, );

            }
        });
    }


   /* function getAllGrades(){
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
    }*/

    $(".AddContentButton").on('click', function(){

        /* Changer un peu le texte */

        let videoModal =  $('#video-modal');
        let videoSubmitButton =  videoModal.find('#videoSubmitButton');

        videoSubmitButton.text('Ajouter');
        videoSubmitButton.attr('data-action', 'create');
        videoModal.find('.modal-title').text('Ajouter');
        /* Fin du changement de texte */


        /*reset les options à zéro pour le gradeSelect*/

        let options = videoModal.find('#nonElligibleGradeSelect option');

        options.each(function (){
            $(this).show();
        });

        /*fin du reset*/

        /*initalisation des champs*/

        videoModal.find("input[name='videoLink']").val('');
        videoModal.find("input[name='title']").val('');
        videoModal.find("#description-field").val('');
        videoModal.find("#typeSelect").val('');

        $('.selectedGradesArea .selected-item').each(function (){
            $(this).remove();
        });

        $('.placeholder-fill').show();

        /*initalisation des champs*/

        videoModal.modal('toggle');
    });


    // Gestion de la sélection d'utilisateur dans chaque section
    $('#nonElligibleGradeSelect').on('change', function () {

        $(".placeholder-fill").hide();
        var selectedGrade = $(this).find('option:selected');
        var selectedGradesArea = $('.selectedGradesArea');

        selectedGrade.each(function () {
            var value = $(this).val();
            var text = $(this).text();

            selectedGradesArea.append(
                '<div class="selected-item" data-value="' + value + '">' +
                text +
                '<a class="btn btn-sm bg-danger-light remove-item"><i class="feather-x-circle text-danger"></i></a>' +
                '</div>'
            );
            $(this).remove();
        });
    });

    // Gestion de la suppression d'utilisateur dans chaque section
    $('.selectedGradesArea').on('click', '.remove-item', function () {

        if ($('.selectedGradesArea .selected-item').length == 1){
            $(".placeholder-fill").show();
        }
        var parent = $(this).parent();
        var text = parent.clone().children().remove().end().text().trim();
        var value = parent.data('value');
        var gradeSelect = $('#nonElligibleGradeSelect');

        // Réajouter l'utilisateur à la liste de sélection
        gradeSelect.append(
            '<option value="' + value + '">' + text + '</option>'
        );

        // Supprimer l'élément sélectionné de la zone
        parent.remove();
    });

    $("#create-resource-form").on('submit', function (event){

        event.preventDefault();
        let resourceData = {};
       let videoLink = $(this).find("input[name='videoLink']").val();

       let videoID = extractYouTubeID(videoLink);

       if(!videoID){
           alert('Url non valide');
           return;

       }else{
           resourceData.videoLink = videoID;
       }

        resourceData.title = $(this).find("input[name='title']").val();
        resourceData.type = $(this).find("#typeSelect").val();
        resourceData.description =$(this).find("#description-field").val();
        resourceData.grades = [];

        $('.selectedGradesArea .selected-item').each(function(){
            let value = $(this).data('value');
            resourceData.grades.push(value);
        });


        console.log(resourceData)

        let action = $('#videoSubmitButton').data('action');
        if(action=='create'){
            console.log('ajouter');
            createResource(resourceData);

        }else{

            resourceData.id = $('#videoSubmitButton').data('resource-id');
           updateResource(resourceData);
        }


    });

    $(".editResourceButton").on('click', function (){

        let selectedGradesArea = $('.selectedGradesArea');
        selectedGradesArea.text('');
       let videoModal = $('#video-modal');




       /*réinitialiser le select*/
        let options = videoModal.find('#nonElligibleGradeSelect option');

        options.each(function (){
           $(this).show();
        });
       /* Changer un peu le texte */

        let videoSubmitButton =  videoModal.find('#videoSubmitButton');
        videoSubmitButton.attr('data-resource-id', $(this).data('resource-id'));
        videoSubmitButton.text('Modifier');
        videoSubmitButton.attr('data-action', 'update');
        videoModal.find('.modal-title').text('Modifier la vidéo');
       /* Fin du changement de texte */

       let resourceParent = $(this).closest('.blog-container');
       let resourceType = resourceParent.data('type');
       let resourceUrl = resourceParent.find('iframe').attr('src');
       let resourceTitle = resourceParent.find('.blog-title a').text() ;
       let resourceDescription = resourceParent.find('.blog-description').text() ;
       let grades = $(this).data('grades');

       if (grades.length){
           $('.placeholder-fill').hide();
           let options = videoModal.find('#nonElligibleGradeSelect option');

           options.each(function (){
               let value = parseInt($(this).attr('value'));
               if(grades.includes(value)){

                   selectedGradesArea.append(
                       '<div class="selected-item" data-value="' + value + '">' +
                       $(this).text() +
                       '<a class="btn btn-sm bg-danger-light remove-item"><i class="feather-x-circle text-danger"></i></a>' +
                       '</div>'
                   );

                   $(this).hide();

                   console.log(' is included ', $(this).text());
               }else{
                   console.log(value, 'not included in', grades)
               }
           });
       }

        videoModal.modal('toggle');

        videoModal.find("input[name='videoLink']").val(resourceUrl);
        videoModal.find("input[name='title']").val(resourceTitle);
        videoModal.find("#description-field").val(resourceDescription);
        videoModal.find("#typeSelect").val(resourceType);
    });


    $('.list-links li').on('click', function (){

        var filter = $(this).text();

        $('.list-links li').removeClass('active');
        $(this).addClass("active");

        if (filter === 'Toutes') {

            $('.blog-container').addClass('d-flex');
            $('.blog-container').show();

        } else {
            console.log(filter);
            $('.blog-container').removeClass('d-flex');
            $('.blog-container').hide();


            $('.blog-container[data-type="' + filter + '"]').addClass('d-flex');
            $('.blog-container[data-type="' + filter + '"]').show();
        }
    });


    $('.deleteResourceButton').on('click', function (){

        let id = $(this).data('resource-id');
        deleteResource(id);

    });

    if($('.blog-container').length == 0){
        $(".pagination-component").hide();
    }else{
        $(".pagination-component").hide();
    }

});
