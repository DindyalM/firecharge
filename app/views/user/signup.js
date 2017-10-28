// EFFECTS: validates that firstName, lastName and title are not blank, if they are
//          shows a user friendly message and an alert at the top of the page indicating the
//          number of errors.
function validateInput() {
    var email = document.getElementById('email');
    var username = document.getElementById('username');
    var password = document.getElementById('password');
    var password_confirm = document.getElementById('password_confirmation');
    
    var error_count = 0;

    error_count += validateFormGroup(username, username.value.length > 0, "Username cannot be blank.");
    error_count += validateFormGroup(email, email.value.length > 0, "Email cannot be blank.");
    error_count += validateFormGroup(password, password.value.length > 0, "Password cannot be blank.");
    error_count += validateFormGroup(password_confirm, password_confirm.value.length > 0, "Password confirmation cannot be blank.");
    if(password.value !== password_confirm.value && password.value != '' && password_confirm.value != '') {
        validateFormGroup(password, false, "Passwords don't match.");    
        validateFormGroup(password_confirm, false, "Passwords don't match.");    
        error_count += 1;
    }
    
    // return false;
    if(error_count == 0) {
        return true;
    }

    if(error_count == 1) {
        showAlert("danger", "There is 1 error.");
    } else if(error_count > 1) {
        showAlert("danger", "There are " + error_count + " errors.");
    }

    window.scrollTo(0, 0);

    return false;
}

// REQUIRES: there must be a element on the DOM with an id of inputElement.name + "_error",
//           inputElement must be a DOM element
// EFFECTS: selects the "ELEMENT_error" tag and inserts an error message into it if
//          the conditon is not met. Returns 1 if there was an error and 0 if not.
function validateFormGroup(inputElement, condition, error_msg) {
    var elementName = inputElement.name;
    var error_element = document.getElementById(elementName + "_error");
    console.log(error_element);
    if(!condition) {
        inputElement.style['border-color'] = 'red';
        inputElement.parentNode.style['color'] = 'red';
        error_element.innerHTML = error_msg;
        error_element.style['color'] = 'red';

        return 1;
    }

    error_element.innerHTML = '';
    inputElement.style['border-color'] = '';
    inputElement.parentNode.style['color'] = '';

    return 0;
}

// REQUIRES: page should have a div with an "alert" id
// EFFECTS: sets the "alert" element equal to an alert with a message
function showAlert(type, msg) {
    var alert = document.getElementById('alert');
    alert.className = 'alert alert-' + type;
    alert.innerHTML = msg;
}