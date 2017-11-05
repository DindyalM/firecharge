// EFFECTS: validates that firstName, lastName and title are not blank, if they are
//          shows a user friendly message and an alert at the top of the page indicating the
//          number of errors.
function validateInput() {
    var email = document.getElementById('email');
    var password = document.getElementById('password');

    
    var error_count = 0;
    
    error_count += validateFormGroup(email, email.value.length > 0, "Email cannot be blank.");
    error_count += validateFormGroup(password, password.value.length > 0, "Password cannot be blank.");
    
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
    var btn_html ='<button type="button" id="alert-close" class="close" data-dismiss="alert" aria-label="Close">' +
                      '<span aria-hidden="true">&times;</span></button>';
    alert.innerHTML = msg + btn_html;
    var btn = document.getElementById("alert-close");
        btn.addEventListener("click", function(event) {
        var trget = event.target.parentNode.parentNode;
        trget.innerHTML = "";
        trget.className = "";
    });
}