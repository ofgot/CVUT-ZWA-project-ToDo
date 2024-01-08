function checkPasswords(event) {
    const pas1 = document.querySelector('#password');
    const pas2 = document.querySelector('#password_repeat');
    const pasError = document.querySelector('.form_group #password_error');

    pasError.classList.remove('show');


    if (pas1.value !== pas2.value) {
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Passwords do not match';
    } else if (pas1.value.length < 8){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password is too short';
    } else if (!/[A-Z]/.test(pas1.value)){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains upper case letters';
    }else if (!/[a-z]/.test(pas1.value)){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains lower case letters';
    } else if (!/[0-9]/.test(pas1.value)){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'Password must contains numbers';
    }


}

function password_check() {
    const conf = document.querySelector('body form#register')
    conf.addEventListener('submit', checkPasswords)
}

function name_check() {
    const conf = document.querySelector('body form#register')
    conf.addEventListener('submit', checkNameLength)
}

function checkNameLength(event) {
    const pasError = document.querySelector('.form_group #name_error');
    const username = document.querySelector('#name').value;

    pasError.classList.remove('show');

    if (username.length < 5){
        event.preventDefault();
        pasError.classList.add('show');
        pasError.innerHTML = 'username is shorter than 5 characters';
    } else {

    }

}





