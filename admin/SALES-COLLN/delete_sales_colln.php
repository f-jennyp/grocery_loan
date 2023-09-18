<?php
include('../../connection.php');

// Check if member_id and memberName are set in the URL
if (isset($_GET['id']) && isset($_GET['tableName'])) {
    // Sanitize and assign the values
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $tableName = mysqli_real_escape_string($conn, $_GET['tableName']);

    // Delete the member
    $stmt = $conn->prepare("DELETE FROM sales_collection_summary WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    if ($stmt) {
        // Construct the table name by replacing spaces with underscores
        $tableName = str_replace(' ', '_', $tableName);

        // Drop the table with the constructed name
        $dropTableQuery = "DROP TABLE IF EXISTS `$tableName`";
        mysqli_query($conn, $dropTableQuery);

        // header('location:index.php?page=display_member');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Handle the error, e.g., display an error message
        echo "Error deleting table: " . mysqli_error($conn);
    }
} else {
    echo "Invalid parameters.";
}
?>


