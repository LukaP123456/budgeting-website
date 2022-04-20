const name = document.getElementById('full-name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const passwordRepeat = document.getElementById('pwdRepeat');
const form = document.getElementById('signup-form');
const errorElement = document.getElementById('error-message-client');

form.addEventListener('submit', (e) =>{
    let message = [];

    if (name.value === '' || email.value === null)
    {
        message.push("Name is required");
    }

    if (message.length > 0)
    {
        e.preventDefault();
        errorElement.innerHTML = message.join(',');
    }

});