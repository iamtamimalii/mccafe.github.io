<?php
// Include the database connection file
include 'connection.php';

// Get the form data
$coldName = $_POST['coldName'];
$coldPrice = $_POST['coldPrice'];
$coldQuantity = $_POST['coldQuantity'];

// Insert the data into the "cold" table
$sql = "INSERT INTO coldcoffee (name, price, quantity) VALUES ('$coldName', '$coldPrice', '$coldQuantity')";
if ($conn->query($sql) === TRUE) {
    // Redirect back to view-cold.php after successful insertion
    header("Location: view-cold.php");
    exit;
} else {
    // Display an error message if the insertion fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
