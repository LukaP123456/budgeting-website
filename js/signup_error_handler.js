const form = document.getElementById('signup-form');
const name = document.getElementById('full-name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password_repeat = document.getElementById('pwdRepeat');


form.addEventListener('submit', e => {


    if (validateInputs()){
        e.currentTarget.submit();
    }
    else
    {
        e.preventDefault();

    }

});


function validateInputs() {
    //Get the value from inputs
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordRepeatValue = password_repeat.value.trim();

    if (nameValue === '') {
        //Show error and set error class
        setError(name, 'Your name cannot be empty');
    } else {
        //Add success class
        setSuccess(name);
    }

    if (emailValue === '') {
        //Show error and set error class
        setError(email, 'Email field cannot be empty');
    } else if (!isEmail(emailValue)) {
        setError(email, 'Email is not valid');

    } else {
        //Add success class
        setSuccess(email);
    }

    if (passwordValue === '') {
        //Show error and set error class
        setError(password, 'Password field cannot be empty');
    } else if (passwordValue.length <= 6) {
        setError(password, 'Please enter a longer password');

    } else {
        //Add success class
        setSuccess(password);
    }

    if (passwordRepeatValue === '') {
        //Show error and set error class
        setError(password_repeat, 'Password repeat field cannot be empty');
    } else if (passwordValue !== passwordRepeatValue) {
        setError(password_repeat, 'The passwords do not match');

    } else {
        //Add success class
        setSuccess(password_repeat);
        return true;
    }

    return false;


}


function setError(element, message) {
    element.className = "form-control error";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('success');

    //Add error message and icon
    small.innerHTML = message + ' <i class="fas fa-exclamation-circle">';
    //Add error class
    small.classList.add("error");


}

const setSuccess = (element) => {
    element.className = "form-control success";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('error');

    //Add success icon
    small.innerHTML = '<i class="fas fa-check-circle">';
    //Add success class
    small.classList.add("success");

}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
