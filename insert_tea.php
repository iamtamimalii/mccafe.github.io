<?php
// Include the database connection file
include 'connection.php';

// Get the form data
$teaName = $_POST['teaName'];
$teaPrice = $_POST['teaPrice'];
$teaQuantity = $_POST['teaQuantity'];

// Insert the data into the "tea" table
$sql = "INSERT INTO tea (name, price, quantity) VALUES ('$teaName', '$teaPrice', '$teaQuantity')";
if ($conn->query($sql) === TRUE) {
    // Redirect back to view-tea.php after successful insertion
    header("Location: view-tea.php");
    exit;
} else {
    // Display an error message if the insertion fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
