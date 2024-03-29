document.addEventListener('DOMContentLoaded', () => {
    let form = document.getElementById('login_form');
    let emailInput = document.getElementById('email');
    let passwordInput = document.getElementById('pass');
    let emailError = document.getElementById('email_error');
    let passError = document.getElementById('pass_error');

    form.onsubmit = function(event) {
        let isValid = true;
        emailError.textContent = '';
        passError.textContent = '';

        if (!emailInput.value.trim()) {
            emailError.textContent = 'Email address should be non-empty';
            isValid = false;
        }

        if (!passwordInput.value) {
            passError.textContent = 'Please enter your password';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    };
});