
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {

        locale: 'fr',
        themeSystem: 'bootstrap5',
        selectable: true,
        dateClick: function (){
            $("#reject-modal").modal("toggle");

        }
    });
    calendar.render();

});
