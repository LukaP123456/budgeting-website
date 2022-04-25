const form = document.getElementById('signup-form');
const name = document.getElementById('full-name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password_repeat = document.getElementById('pwdRepeat');



form.addEventListener('submit', e => {

    e.preventDefault();

    validateInputs();

});



function validateInputs() {
    //Get the value from inputs
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordRepeatValue = password_repeat.value.trim();

    if (nameValue === '')
    {
        //Show error and set error class
        setError(name,'Your name cannot be empty');
    }
    else
    {
        //Add success class
        setSuccess(name);
    }

    if (emailValue === '')
    {
        setError(email,'Email is required')
    }
    else
    {
        //Add success class
        setSuccess(email);
    }
}

function setError(element,message){

    element.classList.add("error");
    const messageDisplay = document.querySelector(".message");

    //Add error message and icon
    messageDisplay.innerHTML = message + ' <i class="fas fa-exclamation-circle">';
    //Add error class
    messageDisplay.classList.add('error');
    messageDisplay.classList.remove('success');

}


const setSuccess = (element) => {
    element.classList.remove('error');
    element.classList.add("success");
    const messageDisplay = document.querySelector(".message");

    //Add success icon
    messageDisplay.innerHTML = '  <iclass="fas fa-check-circle">';
    //Add success class
    messageDisplay.classList.add('success');
    messageDisplay.classList.remove('error');

}