<?php
require_once('database.php');

// Get IDs
$task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($task_id != false && $category_id != false) {
    $query = "DELETE FROM tasks
              WHERE taskID = :task_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':task_id', $task_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>