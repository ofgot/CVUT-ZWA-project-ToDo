<?php
function validate_name($username) {
    return strlen($username) >= 5;
}

function validate_photo($photo){
    return $photo['type'] == 'image/jpeg' || $photo['type'] == 'image/png';
}

function validate_password($password){
    return strlen($password) >= 8
        && preg_match('/[A-Z]/', $password)
        && preg_match('/[0-9]/', $password)
        && preg_match('/[a-z]/', $password);
}

function check_password($password1, $password2){
    return $password1 === $password2;
}

function validate_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>