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
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    console.log(errorDisplay);

    console.log(message);
    errorDisplay.innerHTML = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');

}

const setSuccess = (element) => {
    const inputControl = element.parentElement;
    const successDisplay = inputControl.querySelector('.error');

    successDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
  
}

const validateInputs = () => {
    const nameValue = name.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const passwordRepeatValue = password_repeat.value.trim();

    if (nameValue === '')
    {
        setError(name,'Username is required');
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
        setSuccess(email);
    }


}