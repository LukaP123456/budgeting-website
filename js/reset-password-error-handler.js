const form = document.getElementById('add-new-user-form');
const email = document.getElementById('email');


form.addEventListener('submit', e=>{


    if (validateInputs()) {
        e.currentTarget.submit();
    } else {
        e.preventDefault();

    }

});


function validateInputs() {
    //Get the value from inputs
    const emailValue = email.value.trim();
    let return_value = false;

    //These variables are set with one when the value of the input field is correct
    let email_check = 0;


    if (emailValue === '') {
        //Show error and set error class
        swal("Warning",  "Please enter a valid email address before you click submit", "error");
        setError(email, 'Email field cannot be empty');
    } else if (!isEmail(emailValue)) {
        swal("Warning",  "Please enter a valid email address", "error");
        setError(email, 'Email is not valid');
    } else {
        //Add success class
        swal("Good job!",  "Successfully added "+emailValue+" to your house/group", "success");
        setSuccess(email,"Looks good!");
        email_check = 1;
    }

    if (email_check === 1) {
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

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}