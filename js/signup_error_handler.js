const form = document.getElementById('signup-form');
const name = document.getElementById('full-name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password_repeat = document.getElementById('pwdRepeat');



form.addEventListener('submit', e => {

    e.preventDefault();

    validateInputs();

});

const setError = (element,message) => {
    const inputControl = element.parentElement; //.mb-3 input-control
    const errorDisplay = inputControl.querySelector('.error-name');

    //Add error message
    errorDisplay.innerText = message;
    //Add error class
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

}

const setSuccess = (element) => {
    const inputControl = element.parentElement;
    const successDisplay = inputControl.querySelector('.error-name');

    successDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');

}

const validateInputs = () => {
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