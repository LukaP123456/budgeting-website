const first_log_form = document.getElementById('first-time-log-form');
const radio = document.getElementById('alone-radio');
const friend_email = document.getElementById('email');
const group_name = document.getElementById('group-name');


console.log("asdasd")
first_log_form.addEventListener('submit', ev => {
    console.log(123123123)
    if (validateInputs()) {
        ev.currentTarget.submit();
    } else {
        ev.preventDefault();

    }

});


function validateInputs() {
    const friend_email_value = friend_email.value.trim();
    const group_name_value = group_name.value.trim();

    let friend_email_check = 0;
    let group_name_check = 0;

    if (!radioCheck()) {

        if (friend_email_value === '') {
            //Show error and set error class
            setError(friend_email, 'Email field cannot be empty');
        } else if (!isEmail(friend_email_value)) {
            setError(friend_email, 'Email is not valid');
        } else {
            //Add success class
            setSuccess(friend_email, "Looks good!");
            friend_email_check = 1;
        }
    }

    if (radioCheck()){
        friend_email_check = 1;
    }

        if (group_name_value === '') {
            //Show error and set error class
            setError(group_name, 'Your name cannot be empty');
        } else {
            //Add success class
            setSuccess(group_name, "Looks good!");
            group_name_check = 1;
        }

        if (group_name_check === 1 && friend_email_check === 1){
            return true;
        }else {
            return false;
        }


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

const setSuccess = (element, message) => {
    element.className = "form-control success";
    const small = document.getElementById("message-" + element.id);
    small.classList.remove('text-danger');

    //Add success icon
    small.innerHTML = message + ' <i class="fas fa-check-circle">';
    //Add success class
    small.classList.add("text-success");

}

function radioCheck() {
    let return_value = false;
    if (radio.checked) {
        friend_email.disabled = true;
        return_value = true;
    } else {
        friend_email.disabled = false;
        return_value = false;
    }
    return return_value

}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}