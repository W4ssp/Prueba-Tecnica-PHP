<?php

include("db_connection.php");

$id = $_GET["id"];
echo $id;

// sql to delete a record
$sql = "DELETE FROM bienes WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

header('Location: index.php');

mysqli_close($conn);
