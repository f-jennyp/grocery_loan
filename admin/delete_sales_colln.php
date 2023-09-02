<?php
include('../connection.php');

// Get the member_id and memberName from the URL
$id = $_GET['id'];
$tableName = $_GET['tableName'];

// Delete the member
$q = mysqli_query($conn, "DELETE FROM sales_collection_summary WHERE id='$id'");

if ($q) {
    // Construct the table name by replacing spaces with underscores
    $tableName = str_replace(' ', '_', $tableName);

    // Drop the table with the constructed name
    $dropTableQuery = "DROP TABLE IF EXISTS $tableName";
    mysqli_query($conn, $dropTableQuery);

    header('location:index.php?page=display_sales_colln');
} else {
    // Handle the error, e.g., display an error message
    echo "Error deleting member: " . mysqli_error($conn);
}
