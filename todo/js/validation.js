
//Check the strength and matching of passwords in a form.
function checkPasswords(event) {

    // Select the password input fields and error message element
    const pas1 = document.querySelector('#password');
    const pas2 = document.querySelector('#password_repeat');
    const pasError = document.querySelector('.form_group #password_error');

    // Remove any previous error messages
    pasError.classList.remove('show');

    if (pas1.value !== pas2.value) {
        // Check if passwords match
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Passwords do not match';
    } else if (pas1.value.length < 8){
        // Check if password is too short
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password is too short';
    } else if (!/[A-Z]/.test(pas1.value)){
        // Check if password contains at least one uppercase letter
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains upper case letters';
    }else if (!/[a-z]/.test(pas1.value)){
        // Check if password contains at least one lowercase letter
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains lower case letters';
    } else if (!/[0-9]/.test(pas1.value)){
        // Check if password contains at least one number
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains numbers';
    }


}

function password_check() {
    // Select the registration form with the id 'register'
    const conf = document.querySelector('body form#register')

    // Attach an event listener to the form for the 'submit' event
    conf.addEventListener('submit', checkPasswords)
}

function name_check() {
    // Select the registration form with the id 'register'
    const conf = document.querySelector('body form#register')

    // Attach an event listener to the form for the 'submit' event
    conf.addEventListener('submit', checkNameLength)
}

function checkNameLength(event) {
    // Select the error message element for the name
    // Retrieve the value of the username input field
    const pasError = document.querySelector('.form_group #name_error');
    const username = document.querySelector('#name').value;

    // Remove any previous error messages
    pasError.classList.remove('show');

    // Check if the username is shorter than 5 characters
    if (username.length < 5){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'username is shorter than 5 characters';
    } else {
        // Additional logic can be added here if needed
    }

}





