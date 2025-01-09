document.addEventListener('DOMContentLoaded', function () {
    const themeSwitch = document.getElementById('themeSwitch');
    const body = document.body;

    // Check for stored theme preference
    if (localStorage.getItem('theme') === 'classic') {
        body.classList.add('classic-theme');
        themeSwitch.checked = true;
    }

    // Toggle the theme with fade effect
    themeSwitch.addEventListener('change', function () {
        // Fade out transition
        body.style.transition = 'opacity 0.5s';
        body.style.opacity = 0;

        setTimeout(() => {
            // Switch theme
            if (themeSwitch.checked) {
                body.classList.add('classic-theme');
                localStorage.setItem('theme', 'classic');
            } else {
                body.classList.remove('classic-theme');
                localStorage.setItem('theme', 'default');
            }

            // Fade back in
            body.style.opacity = 1;
        }, 500);
    });
});