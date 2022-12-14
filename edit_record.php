<?php

// Get the record data
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');
$date = filter_input(INPUT_POST, 'date');
$location = filter_input(INPUT_POST, 'location');

// Validate inputs
if ($record_id == NULL || $record_id == FALSE || $category_id == NULL ||
$category_id == FALSE || empty($name) || $description == NULL || $date == NULL) {
$error = "Invalid record data. Check all fields and try again.";
include('error.php');
} else {


// If valid, update the record in the database
require_once('database.php');

$query = 'UPDATE records
SET categoryID = :category_id,
name = :name,
description = :description,
date = :date,
location = :location,
WHERE recordID = :record_id';
$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->bindValue(':name', $name);
$statement->bindValue(':description', $description);
$statement->bindValue(':date', $date);
$statement->bindValue(':location', $location);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$statement->closeCursor();

// Display the Product List page
include('index.php');
}
?>