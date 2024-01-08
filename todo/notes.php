<?php
require_once 'functions/db_file.php';
require_once 'functions/db_notes.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
}

if (isset($_SESSION['user'])) {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $username = $_SESSION['user']['username'];

    if(isset($_POST['add'])){
        $newNoteId = addNote($username);
        $notes_per_page = 3;
        $total_notes = count_notes($username);
        $total_pages = ceil($total_notes / $notes_per_page);
        $target_page = min(ceil($newNoteId / $notes_per_page), $total_pages);
        header('Location: notes.php?page=' . $target_page);
    }

    if (isset($_POST['delete'])){
        $id = $_POST['note_id'];
        deleteNode($id);
        $total_notes_after_delete = count_notes($username);
        $total_pages_after_delete = ceil($total_notes_after_delete / 3);
        $target_page_after_delete = min($current_page, $total_pages_after_delete);
        header('Location: notes.php?page=' . $target_page_after_delete);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="css/print.css" media="print" rel="stylesheet" />
    <script src="js/edit_notes.js"></script>
</head>
<body >
<script>
    note_touch();
</script>
<div class="user_page">
    <header class="user_header">
        <div class="user_name" >
            <?php
            if (isset($_SESSION['user'])) {
                $username = $_SESSION['user']['username'];
                echo '<h1 class="name" data-username="'.htmlspecialchars($username).'">' .htmlspecialchars($username) . '&rsquo;s Notes</h1>';
            }
            ?>
        </div>
        <div class="button_up">
            <a class="button_user" href="logout.php">Log out</a>
        </div>
    </header>
    <div class="user_notes">
        <?php
        if (isset($_SESSION['user'])){
            $username = $_SESSION['user']['username'];
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $notes_per_page = 3;
            $notes = get_notes($username, $current_page, $notes_per_page);
            if ($notes) {
                foreach ($notes as $note) {
                    echo '<form class="sticky" method="post" enctype="multipart/form-data">';
                    echo '<article class="sticky_note" data-id="'.$note['id'].'">';
                    echo "<h2>" . htmlspecialchars($note['title']) . "</h2>";
                    echo "<p>" . htmlspecialchars($note['text']) . "</p>";
                    echo '<input type="hidden" class="id" name="note_id" value="' . $note['id'] . '">';
                    echo '<input class="button_delete" value="Delete" name="delete" type="submit" >';
                    echo "</article>";
                    echo '</form>';
                }
            }
        }
        ?>
    </div>
</div>
<div class="pagination">
    <?php
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user']['username'];
        $notes_per_page = 3;
        $total_notes = count_notes($username);
        $total_pages = ceil($total_notes / $notes_per_page);
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }
    ?>
</div>
<div class="end">
    <form method="post" enctype="multipart/form-data">
        <input class="button_user" value="Create Note" name="add" type="submit">
    </form>
</div>
</body>
</html>
