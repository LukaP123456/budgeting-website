const login_form = document.getElementById('login-form');
const login_email = document.getElementById('login-email');
const login_password = document.getElementById('login-password');


login_form.addEventListener('submit', e => {

    if (login_validateInputs()) {
        e.currentTarget.submit();
    } else {
        e.preventDefault();
    }

});

function login_validateInputs() {
    //Get the value from inputs
    const login_email_value = login_email.value.trim();
    const login_password_value = login_password.value.trim();
    let login_return_value = false;


    //These variables are set with one when the value of the input field is correct
    let login_email_check = 0;
    let login_password_check = 0;

    if (login_email_value === '') {
        //Show error and set error class
        login_setError(login_email, "Email field cannot be empty");
    } else if (!login_isEmail(login_email_value)) {
        login_setError(login_email, "Email is not valid");
    } else {
        //Add success class
        login_setSuccess(login_email,"Looks good!");
        login_email_check = 1;
    }

    if (login_password_value === '') {
        //Show error and set error class
        login_setError(login_password, 'Password field cannot be empty');
    } else if (login_password_value.length <= 6) {
        login_setError(login_password, 'Please enter a longer password');

    } else {
        //Add success class
        login_setSuccess(login_password,"Looks good!");
        login_password_check = 1;
    }

    if (login_password_check === 1 && login_email_check === 1) {
        login_return_value = true;
    } else {
        login_return_value = false;
    }

    return login_return_value;
}

function login_setError(element, message) {
    element.className = "form-control error";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('text-success');

    //Add error message and icon
    small.innerHTML = message + ' <i class="fas fa-exclamation-circle" >';
    //Add error class
    small.classList.add("text-danger");
}

const login_setSuccess = (element,message) => {
    element.className = "form-control success";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('text-danger');

    //Add success icon
    small.innerHTML = message+ ' <i class="fas fa-check-circle">';
    //Add success class
    small.classList.add('text-success');
}

function login_isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}