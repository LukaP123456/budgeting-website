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
        setError(name,'Your name cannot be empty<i class="fas fa-exclamation">');
    }
    else
    {
        //Add success class
        setSuccess(name);
    }

    if (emailValue.value === '')
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
    const inputControl = element.getElementsByClassName("form-control"); //.mb-3 input-control
    const errorDisplay = inputControl.querySelector('small');

    //Add error message
    errorDisplay.innerText = message;
    //Add error class
    inputControl.classList.add('error');
    errorDisplay.classList.add('bg-warning');
    inputControl.classList.remove('success');

}



const setSuccess = (element) => {
    const inputControl = element.parentElement;
    const successDisplay = inputControl.querySelector('.error-name');

    successDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');

}