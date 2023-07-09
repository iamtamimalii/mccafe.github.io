<?php
// Include the database connection file
include 'connection.php';

// Check if the hot ID is provided
if (isset($_GET['id'])) {
    $hotId = $_GET['id'];

    // Delete the hot record from the database
    $sql = "DELETE FROM hotcoffee WHERE id = '$hotId'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to view-hot.php after successful deletion
        header("Location: view-hot.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect back to view-hot.php if the hot ID is not provided
    header("Location: view-hot.php");
    exit;
}

// Close the database connection
$conn->close();
?>
