<?php
include('../connection.php');

// Get the member_id and memberName from the URL
$memberId = $_GET['id'];
$memberName = $_GET['memberName'];

// Delete the member
$q = mysqli_query($conn, "DELETE FROM member WHERE member_id='$memberId'");

if ($q) {
    // Construct the table name by replacing spaces with underscores
    $tableName = str_replace(' ', '_', $memberName);

    // Drop the table with the constructed name
    $dropTableQuery = "DROP TABLE IF EXISTS $tableName";
    mysqli_query($conn, $dropTableQuery);

    header('location:index.php?page=display_member');
} else {
    // Handle the error, e.g., display an error message
    echo "Error deleting member: " . mysqli_error($conn);
}
