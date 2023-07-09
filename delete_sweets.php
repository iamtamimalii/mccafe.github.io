<?php
// Include the database connection file
include 'connection.php';

// Check if the sweets ID is provided
if (isset($_GET['id'])) {
    $sweetsId = $_GET['id'];

    // Delete the sweets record from the database
    $sql = "DELETE FROM sweets WHERE id = '$sweetsId'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to view-sweets.php after successful deletion
        header("Location: view-sweets.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect back to view-sweets.php if the sweets ID is not provided
    header("Location: view-sweets.php");
    exit;
}

// Close the database connection
$conn->close();
?>
