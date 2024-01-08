
<?php

include_once 'functions/db_notes.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(array('error' => 'Invalid JSON data'));
} else{
    $text = $data['text'];
    $title = $data['title'];
    $id = $data['id'];


    rewriteNote($id, $title, $text);

//    $success = rewriteNote($id, $title, $text);
//    if ($success) {
//        $response = array('message' => 'Action "create" processed successfully');
//    } else {
//        $response = array('message' => 'Action "create" failed');
//    }
//    $response = array('message' => "id: ".$id."  title: ".$title."  text: ".$text);
    $response = array(
        'id' => $id,
        'title' => htmlspecialchars($title),
        'text' => htmlspecialchars($text),
        'message' => "Data received successfully"
    );
    echo json_encode($response);

}

?>
