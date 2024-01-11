<?php
/**
 * Validates the length of a username.
 *
 * @param string $username The username to validate.
 * @return bool Returns true if the username length is 5 characters or more, false otherwise.
 */
function validate_name($username) {
    return strlen($username) >= 5;
}

/**
 * Validates the type of photo file.
 *
 * @param array $photo The photo file to validate, typically obtained from $_FILES.
 * @return bool Returns true if the photo file type is 'image/jpeg' or 'image/png', false otherwise.
 */
function validate_photo($photo){
    return $photo['type'] == 'image/jpeg' || $photo['type'] == 'image/png';
}

/**
 * Validates the strength of a password.
 *
 * @param string $password The password to validate.
 * @return bool Returns true if the password meets the specified criteria, false otherwise.
 */
function validate_password($password){
    return strlen($password) >= 8
        && preg_match('/[A-Z]/', $password)
        && preg_match('/[0-9]/', $password)
        && preg_match('/[a-z]/', $password);
}

/**
 * Checks if two passwords are equal.
 *
 * @param string $password1 The first password to compare.
 * @param string $password2 The second password to compare.
 * @return bool Returns true if the two passwords are equal, false otherwise.
 */
function check_password($password1, $password2){
    return $password1 === $password2;
}

/**
 * Validates an email address.
 *
 * @param string $email The email address to validate.
 * @return bool Returns true if the email address is valid, false otherwise.
 */
function validate_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>