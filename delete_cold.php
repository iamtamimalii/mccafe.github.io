<?php
// Include the database connection file
include 'connection.php';

// Check if the cold ID is provided
if (isset($_GET['id'])) {
    $coldId = $_GET['id'];

    // Delete the cold record from the database
    $sql = "DELETE FROM coldcoffee WHERE id = '$coldId'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to view-cold.php after successful deletion
        header("Location: view-cold.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect back to view-cold.php if the cold ID is not provided
    header("Location: view-cold.php");
    exit;
}

// Close the database connection
$conn->close();
?>
