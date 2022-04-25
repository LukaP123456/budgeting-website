const login_form = document.getElementById('login-form');
const login_email = document.getElementById('email');
const login_password = document.getElementById('password');

login_form.addEventListener('submit', e => {

    e.preventDefault();

    validateInputs()

});


function validateInputs() {
    //Get the value from inputs
    const emailValue = login_email.value.trim();
    const passwordValue =login_password.value.trim();


    if (emailValue === '') {
        //Show error and set error class
        setError(login_email, 'Email field cannot be empty');
    } else if (!isEmail(emailValue)) {
        setError(login_email, 'Email is not valid');

    } else {
        //Add success class
        setSuccess(login_email);
    }

    if (passwordValue === '') {
        //Show error and set error class
        setError(login_password, 'Password field cannot be empty');
    } else if (passwordValue.length <= 6) {
        setError(login_password, 'Please enter a longer password');

    } else {
        //Add success class
        setSuccess(login_password);
    }



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
