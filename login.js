document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('login');
    const overlay = document.getElementById('overlay');
    const submitButton = document.getElementById('submit-btn');
    const mainBody = document.getElementById('main-body');
    
    loginButton.addEventListener('click', () => {
        overlay.style.display = 'flex'; // Show overlay
        mainBody.classList.add('blurred-background'); // Add blur to the background
    });

    submitButton.addEventListener('click', () => {
        overlay.style.display = 'none'; // Hide overlay
        mainBody.classList.remove('blurred-background'); // Remove blur from the background
    });
});
