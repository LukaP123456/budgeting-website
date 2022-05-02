const reset_form = document.getElementById('reset-form');
const password = document.getElementById('password');
const password_repeat = document.getElementById('password2');

reset_form.addEventListener('submit', e => {



    if (validateInputs()) {
        e.currentTarget.submit();
    } else {
        e.preventDefault();
    }

});


function validateInputs() {
    //Get the value from inputs
    const passwordValue = password.value.trim();
    const passwordRepeatValue = password_repeat.value.trim();
    let return_value = false;

    //These variables are set with one when the value of the input field is correct
    let password_check = 0;
    let password_repeat_check = 0;


    if (passwordValue === '') {
        //Show error and set error class
        setError(password, 'Password field cannot be empty');
    } else if (passwordValue.length <= 6) {
        setError(password, 'Please enter a longer password');

    } else {
        //Add success class
        setSuccess(password,"Looks good!");
        password_check = 1;
    }

    if (passwordRepeatValue === '') {
        //Show error and set error class
        setError(password_repeat, 'Password repeat field cannot be empty');
    } else if (passwordValue !== passwordRepeatValue) {
        setError(password_repeat, 'The passwords do not match');
    } else if (passwordRepeatValue.length <= 6) {
        setError(password_repeat, "Repeated password needs to be longer")
    } else {
        //Add success class
        setSuccess(password_repeat,"Looks good!");
        password_repeat_check = 1;
    }

    if (password_check === 1 && password_repeat_check === 1) {
        return_value = true;
    } else {
        return_value = false;
    }

    return return_value;


}


function setError(element, message) {
    element.className = "form-control error";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('text-success');

    //Add error message and icon
    small.innerHTML = message + ' <i class="fas fa-exclamation-circle">';
    //Add error class
    small.classList.add("text-danger");


}

const setSuccess = (element,message) => {
    element.className = "form-control success";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('text-danger');

    //Add success icon
    small.innerHTML =message + ' <i class="fas fa-check-circle">';
    //Add success class
    small.classList.add("text-success");

}

