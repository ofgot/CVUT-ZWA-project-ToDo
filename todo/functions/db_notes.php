<?php

/**
 * Defines the path to the user database file.
 */
define("database_notes", 'data/notes.json');

/**
 * Loads the user database from the specified JSON file.
 *
 * @global array $db_notes Global array representing the user database.
 */
$file_notes = @file_get_contents(database_notes);

if(!$file_notes){
    header('Location: error.html');
}

$db_notes = @json_decode($file_notes, true);

if(!$db_notes){
    header('Location: error.html');
}

/**
 * Retrieves a paginated list of notes for a specific user.
 *
 * @param string $username The username for which to retrieve notes.
 * @param int $page The page number of the notes to retrieve.
 * @param int $notes_per_page The number of notes to display per page.
 * @global array $db_notes Global array representing the notes database.
 * @return array Returns an array containing the paginated list of notes for the specified user.
 */
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

/**
 * Counts the total number of notes for a specific user.
 *
 * @param string $username The username for which to count the notes.
 * @global array $db_notes Global array representing the notes database.
 * @return int Returns the total number of notes for the specified user.
 */
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

/**
 * Rewrites the content of a specific note.
 *
 * @param int $id The unique identifier of the note to rewrite.
 * @param string $title The new title for the note.
 * @param string $text The new text content for the note.
 * @global array $db_notes Global array representing the notes database.
 * @return bool Returns true if the note is successfully rewritten, false otherwise.
 */
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

/**
 * Deletes a specific note by its unique identifier.
 *
 * @param int $id The unique identifier of the note to delete.
 * @global array $db_notes Global array representing the notes database.
 * @return bool Returns true if the note is successfully deleted, false otherwise.
 */
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

/**
 * Adds a new note for a specific user.
 *
 * @param string $user The username for which to add a new note.
 * @global array $db_notes Global array representing the notes database.
 * @return string Returns the unique identifier (ID) of the newly added note.
 */
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


/**
 * Saves the current state of the notes database to a JSON file.
 *
 * @global array $db_notes Global array representing the notes database.
 * @return void
 */
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



