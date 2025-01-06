document.addEventListener('DOMContentLoaded', function () {
    const gameSelect = document.getElementById('game');
    
    // Check if the dropdown element exists
    if (!gameSelect) {
        console.error('Dropdown element with id "game" not found');
        return;
    }

    // Clear any existing options to avoid duplication
    gameSelect.innerHTML = '';

    // Create and add the default "Choose a game" option
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Choose a game';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    gameSelect.appendChild(defaultOption);

    // Populate the dropdown with events
    canucksEvents.forEach(event => {
        const option = document.createElement('option');
        
        // Determine if the event is a home or away game based on the background color
        const isAwayGame = event.backgroundColor === '#00843d'; // Green background (Canucks Green)
        const gameType = isAwayGame ? '(Away)' : '(Home)';
        
        // Set the option's value and text content
        option.value = `${event.title} - ${event.start}`;
        option.textContent = `${event.title} (${event.start}) ${gameType}`;
        
        gameSelect.appendChild(option);
    });
});
