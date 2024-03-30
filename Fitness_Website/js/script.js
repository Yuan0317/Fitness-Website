 /*
 * Group 15: Yuan Tang,Lishu Yuan
 * Date: 2023-03-30
 * Section: CST 8285 section 302
 * Description: To dynamicaly validate user sign up.
*/

let emailInput = document.querySelector("#email");
let loginInput = document.querySelector("#login");
let passInput = document.querySelector("#pass");
let pass2Input = document.querySelector("#pass2");
let phoneInput = document.querySelector("#phone");

let loginError = document.createElement('p');
loginError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[0].append(loginError);

let emailError = document.createElement('p');
emailError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[1].append(emailError);

let passError = document.createElement('p');
passError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[2].append(passError);

let pass2Error = document.createElement('p');
pass2Error.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[3].append(pass2Error);

let phoneError = document.createElement('p');
phoneError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[4].append(phoneError);

let defaultMsg = "";

function validateEmail() {
    let email = emailInput.value;
    let regexp = /\S+@\S+\.\S+/;
    if (regexp.test(email)) {
        return defaultMsg;
    } else {
        return "Email address should be non-empty with the format xyz@xyz.xyz";
    }
}

function validateLogin() {
    let userName = loginInput.value;
    if (userName.length > 0 && userName.length < 20) {
        return defaultMsg;
    } else {
        return "User name should be non-empty, and within 20 characters long.";
    }
}

function validatePass() {
    let pass = passInput.value;
    if (pass.length >= 6 && pass.match(/[a-z]/) && pass.match(/[A-Z]/)) {
        return defaultMsg;
    } else {
        return "Password should be at least 6 characters: 1 uppercase, 1 lowercase.";
    }
}

function validatePass2() {
    let pass2 = pass2Input.value;
    let pass = passInput.value;
    if (pass2 !== pass || pass2.length === 0) {
        return "Please retype password";
    } else {
        return defaultMsg;
    }
}

function validatePhone() {
    let phone = phoneInput.value.trim();
    console.log('Phone input:', '"' + phone + '"');
    let regexp = /^\d{3}-\d{3}-\d{4}$/;
    if (!regexp.test(phone)) {
        return "Phone number should be in the format XXX-XXX-XXXX";
    } else {
        return defaultMsg;
    }
}


function validate() {
    let valid = true;
    let emailValidation = validateEmail();
    let loginValidation = validateLogin();
    let passValidation = validatePass();
    let pass2Validation = validatePass2();
    let phoneValidation = validatePhone();

    emailError.textContent = emailValidation;
    loginError.textContent = loginValidation;
    passError.textContent = passValidation;
    pass2Error.textContent = pass2Validation;
    phoneError.textContent = phoneValidation;

    if (emailValidation !== defaultMsg) valid = false;
    if (loginValidation !== defaultMsg) valid = false;
    if (passValidation !== defaultMsg) valid = false;
    if (pass2Validation !== defaultMsg) valid = false;
    if (phoneValidation !== defaultMsg) valid = false;

    return valid;
}

function resetFormError() {
    emailError.textContent = defaultMsg;
    loginError.textContent = defaultMsg;
    passError.textContent = defaultMsg;
    pass2Error.textContent = defaultMsg;
    phoneError.textContent =defaultMsg;
}

document.form.addEventListener("reset", resetFormError);

emailInput.addEventListener('blur', function () {
    emailError.textContent = validateEmail();
});

loginInput.addEventListener('blur', function () {
    loginError.textContent = validateLogin();
});

passInput.addEventListener("blur", function () {
    passError.textContent = validatePass();
});

pass2Input.addEventListener("blur", function () {
    pass2Error.textContent = validatePass2();
});

phoneInput.addEventListener('blur', function () {
    phoneError.textContent = validatePhone();
    
});