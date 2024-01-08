<?php

define("database", "data/users.json");

$file = @file_get_contents(database);

if(!$file){
    header('Location: error.html');
}

$db = @json_decode($file, true);

if(!$db) {
    header('Location: error.html');
}

function isUsernameAvailable($username){
    global $db;

    foreach ($db['users'] as $user){
        if ($user['username'] == $username){
            return false;
        }
    }
    return true;
}

function existence_of_user($username){
    global $db;

    foreach ($db['users'] as $user){
        if ($user['username'] == $username){
            return $user;
        }
    }
    return null;
}


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

function saveDatabase(){
    global $db;

    $json = @json_encode($db);

    if (!$json){
        header('Location: error.html');
    }

    $result = @file_put_contents(database, $json);

    if (!$result){
        header('Location: error.html');
    }
}


?>





