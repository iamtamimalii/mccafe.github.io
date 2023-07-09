<?php
// Include the database connection file
include 'connection.php';

// Check if the tea ID is provided
if (isset($_GET['id'])) {
    $teaId = $_GET['id'];

    // Delete the tea record from the database
    $sql = "DELETE FROM tea WHERE id = '$teaId'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to view-tea.php after successful deletion
        header("Location: view-tea.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect back to view-tea.php if the tea ID is not provided
    header("Location: view-tea.php");
    exit;
}

// Close the database connection
$conn->close();
?>
