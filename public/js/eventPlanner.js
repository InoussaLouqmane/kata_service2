document.addEventListener('DOMContentLoaded', function () {

    var baseUrl = 'http://localhost:8000/api/event';
    var UserbaseUrl = 'http://localhost:8000/api/user';
    var requestHeaders = {
        'Authorization': 'Bearer ' + $("meta[name='csrf-token']").attr('content')
    };


    function getActiveUser(user_id){
        return $.ajax({
            url: UserbaseUrl+`/${user_id}`,
            method: "GET",
            dataType: 'json',
            contentType: "application/json",
            headers: requestHeaders,
            success: function (response){
                currentUser = response.user;
                console.log(currentUser.role);
            }
        });
    }
    function getAllEvents() {
        return $.ajax({
            async: false,
            url: baseUrl,
            method: "GET",
            dataType: 'json',
            contentType: "application/json",
            headers: requestHeaders,
        });
    }

    function changeEventID(eventID, databaseID){
        var targetEvent = calendar.getEventById(eventID);

        if (targetEvent) {

            targetEvent.setProp('id', databaseID);

        } else {
            console.error('Event not found:', eventID);
        }

    }
    function createEvent(eventData) {
        return $.ajax({
            url: baseUrl + '/create',
            method: 'POST',
            contentType: "application/json",
            data: JSON.stringify(eventData),
            success: function(response){
                changeEventID(eventData.eventID, response.data);
            },
            error: function(xhr, status, error) {
                console.error("Une erreur s'est produite :", error);
            }
        });
    }

    function updateEvent(eventID, eventData) {
        return $.ajax({
            url: baseUrl + `/update/${eventID}`,
            method: 'PATCH',
            contentType: "application/json",
            data: JSON.stringify(eventData)
        });
    }

    function deleteEvent(eventID) {
        return $.ajax({
            url: baseUrl + `/delete/${eventID}`,
            method: 'DELETE',
        });
    }

    function getEvent(eventId, eventData) {
        return $.ajax({
            url: baseUrl + `/show/${eventID}`,
            method: 'GET',
            contentType: "application/json",
        });
    }


    function formatTimeForInput(date) {

        const time = new Date(date);
        let hours = time.getHours().toString().padStart(2, '0');
        let minutes = time.getMinutes().toString().padStart(2, '0');




        return `${hours}:${minutes}`;
    }

    function formatDateForInput(date) {

        if(!date) {
            return ;
        }
        const period = new Date(date);

        let fullYear = period.getFullYear().toString();
        let month = (period.getMonth() + 1).toString().padStart(2, '0');
        let day = period.getDate().toString().padStart(2, '0');

        return `${fullYear}-${month}-${day}`;
    }

    var AllEvents = getAllEvents().responseJSON.data;



    function transformEvent (events){

        let transformedEvents = [];
        for (let x in events){

            transformedEvents.push({
                id: events[x].id,
                title: events[x].title,
                start: events[x].startDate,
                end: events[x].endDate,

                extendedProps: {
                    location: events[x].address,
                }
            });

        }

        return transformedEvents;
    }


    var user_id = $('.user-credentials').data('user-id');
    var currentUser = getActiveUser(user_id);

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'listWeek,dayGridMonth'
        },
        views: {
            dayGridMonth: {
                buttonText: 'Mois'
            },
            listWeek: {
                buttonText: 'Semaine'
            }
        },
        locale: 'fr',
        themeSystem: 'bootstrap5',
        selectable: true,
        eventColor: 'green',
        events: transformEvent(AllEvents),
        dateClick: function (info) {

            eventDate = new Date(info.dateStr);

            if (eventDate >= new Date() && currentUser.role != 'Elève') {
                $("#addEvent-modal").modal("toggle");
                $("#end_date").val(info.dateStr);
                $("#start_date").val(info.dateStr);
                $("#eventTitle").val('');
                $("#location").val('');
                $("#start_time").val('');
                $("#end_time").val('');
                $("#hiddenIDInput").val(crypto.randomUUID());
            }


            $("#createEventButton").off('click').on('click', function (event) {

                event.preventDefault();

                var eventData = {};

                var startTime = $("#start_time").val();
                var endTime = $("#end_time").val();
                var endDate = $("#end_date").val();
                var startDate = $("#start_date").val();


                eventData.title = $("#eventTitle").val();
                eventData.location = $("#location").val();
                eventData.eventID = $("#hiddenIDInput").val();



                if (!eventData.title) {
                    alert("Veuillez entrer un titre pour l'événement.");
                    return;
                }
                if (!eventData.location) {
                    alert("Veuillez entrer un lieu pour l'événement.");
                    return;
                }

                eventData.startDateTime = startDate + (startTime ? 'T' + startTime + ':00' : '');
                eventData.endDateTime = ''+(endDate ? endDate : startDate) + (endTime ? 'T' + endTime + ':00' : '');

                var targetEvent = calendar.getEventById(eventData.eventID);


                if (targetEvent) {

                    targetEvent.setProp('title', eventData.title);
                    targetEvent.setDates(eventData.startDateTime, eventData.endDateTime);
                    targetEvent.setExtendedProp('location', eventData.location);

                    updateEvent(eventData.eventID, eventData);

                } else {

                    createEvent(eventData) ;

                    calendar.addEvent({
                        id : eventData.eventID,
                        title: eventData.title,
                        start: eventData.startDateTime,
                        end: eventData.endDateTime,
                        color: 'blue',
                        extendedProps: {
                            location: eventData.location,
                        }
                    });
                }

                $("#addEvent-modal").modal("hide");
            });
        },

        eventDidMount: function (info) {
            var event = info.event;
            var tooltipContent = `
                <div style="font-weight: bold; font-size: 16px; color: white">${event.title}</div>
                <div style="margin-top: 5px;">${event.extendedProps.location || 'Lieu non spécifié'}</div>
                <div class="d-flex flex-column align-items-start">

                <div style="margin-top: 5px;">
                    <i class="fas fa-calendar-alt"></i>
                    ${event.start.toLocaleDateString()} - ${event.end ? event.end.toLocaleDateString() : event.start.toLocaleDateString()}
                </div>
                <div style="margin-top: 5px;">
                    <i class="fas fa-clock"></i> ${event.start.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            })}  ${event.end ? event.end.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            }) : ''}
                </div>
                </div>
            `;

            $(info.el).tooltip({
                title: tooltipContent,
                html: true,
                container: 'body',
                delay: {"show": 50, "hide": 50}
            });
        },

        eventClick: function (info){


            var event = info.event;
            eventDate = new Date(info.dateStr);

            if (eventDate > new Date()){
                $('.cancelEvent').hide();
                $('.modifyEvent').hide();
            }

            $("#showInformations-modal").modal("toggle");
            $("#hiddenIDInput").val(event.id);
            $("#eventTitleDescription").text(event.title);
            $("#eventLocationDescription").text(`${event.extendedProps.location || 'Lieu non spécifié'}`);
            $("#startDateDescription").text(`${event.start.toLocaleDateString()} - ${event.end ? event.end.toLocaleDateString() : event.start.toLocaleDateString()}`);
            $("#startTimeDescription").text(`${event.start.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            })}  ${event.end ? ' - '+event.end.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            }) : ''}`);

            $(".modifyEvent").on('click', function (e) {

                e.preventDefault();
                $("#eventTitle").val(event.title);
                $("#start_time").val(formatTimeForInput(event.start));
                $("#end_time").val(formatTimeForInput(event.end));
                $("#start_date").val(formatDateForInput(event.start));
                $("#end_date").val(formatDateForInput(event.end));
                $("#location").val(event.extendedProps.location);
                $("#hiddenIDInput").val(event.id);
                $("#addEvent-modal").modal("toggle");
                $("#showInformations-modal").modal("hide");

            });

            $(".cancelEvent").off('click').on('click', function () {
                event.remove();
                deleteEvent(event.id);
                $("#showInformations-modal").modal("hide");

            });
        }
    });


    calendar.render();
});
