<?php

define("database_notes", 'data/notes.json');

$file_notes = @file_get_contents(database_notes);

if(!$file_notes){
    header('Location: error.html');
}

$db_notes = @json_decode($file_notes, true);

if(!$db_notes){
    header('Location: error.html');
}

function get_notes($username, $page, $notes_per_page){
    global $db_notes;

    $notes = [];

    foreach ($db_notes['notes'] as $note){
        if ($note['username'] == $username){
            $notes[] = $note;
        }
    }

    $start = ($page - 1) * $notes_per_page;

    $paged_notes = array_slice($notes, $start, $notes_per_page);

    return $paged_notes;
}

function count_notes($username){
    global $db_notes;

    $total_notes = 0;

    foreach ($db_notes['notes'] as $note){
        if ($note['username'] == $username){
            $total_notes += 1;
        }
    }
    return $total_notes;
}



function rewriteNote($id, $title, $text){
    global $db_notes;


    foreach ($db_notes['notes'] as $key =>$note){
        if ($note['id'] == $id) {
            $db_notes['notes'][$key]['title'] = $title;
            $db_notes['notes'][$key]['text'] = $text;
            saveDatabase_notes();
            return true;
        }
    }
    return false;
}

function deleteNode($id){
    global $db_notes;

    foreach ($db_notes['notes'] as $key => $note){
        if ($note['id'] == $id){
            array_splice($db_notes['notes'],$key, 1);
            saveDatabase_notes();
            return true;
        }
    }
    return false;
}

function addNote($user){
    global $db_notes;

    $note = [
        'id' => uniqid(),
        'username' => $user,
        'title' => '',
        'text' => ''
    ];

    $db_notes['notes'][] = $note;
    saveDatabase_notes();
    return $note['id'];
}



function saveDatabase_notes(){
    global $db_notes;

    $json = @json_encode($db_notes);

    if (!$json){
        header('Location: error.html');
    }

    $result = @file_put_contents(database_notes, $json);

    if (!$result){
        header('Location: error.html');
    }
}

?>



