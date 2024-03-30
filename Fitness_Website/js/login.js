
 /*
 * Group 15: Yuan Tang,Lishu Yuan
 * Date: 2023-03-27
 * Section: CST 8285 section 302
 * Description: To validate the login for Assignment 2
 * This file contains javascript code used to validate email and passwrod.
*/
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