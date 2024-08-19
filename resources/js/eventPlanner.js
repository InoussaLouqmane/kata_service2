// resources/js/eventPlanner.js

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener("DOMContentLoaded", function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        editable: true,
        events: [
            { title: 'Meeting', start: new Date() }
        ]
    });

    calendar.render();
    console.log('Calendar has been rendered');
});
