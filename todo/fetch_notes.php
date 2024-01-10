<?php

/**
 * Include the functions related to notes database operations.
 */
include_once 'functions/db_notes.php';

/**
 * Retrieve JSON data from the request body
 */
$data = json_decode(file_get_contents("php://input"), true);

/**
 * Check for invalid JSON data
 */
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid JSON data'));
} else{
    /**
     * Extract relevant data from the JSON
     */
    $text = $data['text'];
    $title = $data['title'];
    $id = $data['id'];

    /**
     * Update the note using the rewriteNote function
     */
    rewriteNote($id, $title, $text);

    /**
     * Prepare a response array with sanitized data
     */
    $response = array(
        'id' => $id,
        'title' => htmlspecialchars($title),
        'text' => htmlspecialchars($text),
        'message' => "Data received successfully"
    );

}

?>
