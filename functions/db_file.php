<?php

/**
 * Defines the path to the user database file.
 */
define("database", "data/users.json");

/**
 * Loads the user database from the specified JSON file.
 *
 * @global array $db Global array representing the user database.
 */
$file = @file_get_contents(database);

if(!$file){
    header('Location: errors/error.html');
    exit();
}

$db = @json_decode($file, true);

if(!$db) {
    header('Location: errors/error.html');
    exit();
}

/**
 * Checks the availability of a username.
 *
 * @param string $username The username to check.
 * @global array $db Global array representing the user database.
 * @return bool Returns false if the username is already taken, true otherwise.
 */
function isUsernameAvailable($username){
    global $db;

    foreach ($db['users'] as $user){
        if ($user['username'] == $username){
            return false;
        }
    }
    return true;
}

/**
 * Checks the existence of a user and returns the user details if found.
 *
 * @param string $username The username to check.
 * @global array $db Global array representing the user database.
 * @return array|null Returns an array of user details if the username exists, or null if not found.
 */
function existence_of_user($username){
    global $db;

    foreach ($db['users'] as $user){
        if ($user['username'] == $username){
            return $user;
        }
    }
    return null;
}

/**
 * Adds a new user to the database.
 *
 * @param string $username The username of the new user.
 * @param string $email The email address of the new user.
 * @param string $password The password of the new user (hashed using PASSWORD_DEFAULT).
 * @param string $photo The photo URL or path of the new user.
 * @global array $db Global array representing the user database.
 * @return array Returns the details of the newly added user.
 */
function addUser($username, $email, $password, $photo){
    global $db;

    $new_user = [
        "username" => $username,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT),
        "photo" => $photo,
    ];

    $db['users'][] = $new_user;
    saveDatabase();
    return $new_user;
}

/**
 * Saves the current state of the database to a JSON file.
 *
 * @global array $db Global array representing the user database.
 * @return void
 */
function saveDatabase(){
    global $db;

    $json = @json_encode($db);

    if (!$json){
        header('Location: errors/error.html');
        exit();
    }

    $result = @file_put_contents(database, $json);

    if (!$result){
        header('Location: errors/error.html');
        exit();
    }
}