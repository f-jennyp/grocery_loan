<?php
include('../../connection.php');

// Check if member_id and memberName are set in the URL
if (isset($_GET['id']) && isset($_GET['memberName'])) {
    // Sanitize and assign the values
    $memberId = mysqli_real_escape_string($conn, $_GET['id']);
    $memberName = mysqli_real_escape_string($conn, $_GET['memberName']);

    // Delete the member
    $stmt = $conn->prepare("DELETE FROM member WHERE member_id=?");
    $stmt->bind_param("i", $memberId);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        // Construct the table name by replacing spaces with underscores
        $tableName = str_replace(' ', '_', $memberName);

        // Drop the table with the constructed name
        $dropTableQuery = "DROP TABLE IF EXISTS $tableName";
        mysqli_query($conn, $dropTableQuery);

        // header('location:index.php?page=display_member');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Handle the error, e.g., display an error message
        echo "Error deleting member: " . mysqli_error($conn);
    }
} else {
    echo "Invalid parameters.";
}
