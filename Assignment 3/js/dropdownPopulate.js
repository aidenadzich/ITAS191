document.addEventListener('DOMContentLoaded', function () {
    const gameSelect = document.getElementById('game');
    
    // Populate the dropdown with events
    canucksEvents.forEach(event => {
        const option = document.createElement('option');
        option.value = `${event.title} - ${event.start}`;
        option.textContent = `${event.title} (${event.start})`;
        gameSelect.appendChild(option);
    });
});