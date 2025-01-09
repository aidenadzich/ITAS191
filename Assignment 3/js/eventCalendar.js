<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.5/index.global.min.js'></script>


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
        },
        themeSystem: 'bootstrap',
        events: canucksEvents
    });

    calendar.render();

    // Populate game options from FullCalendar events
    const gameSelect = document.getElementById("game"); // Target the <select> dropdown
    const events = calendar.getEvents(); // Retrieve all events from FullCalendar

    events.forEach(event => {
        const option = document.createElement("option");
        option.value = `${event.title} - ${event.start.toISOString().split("T")[0]}`;
        option.textContent = `${event.title} (${event.start.toISOString().split("T")[0]})`;
        gameSelect.appendChild(option);
    });
});