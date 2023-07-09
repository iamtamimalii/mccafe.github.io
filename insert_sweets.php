<?php
// Include the database connection file
include 'connection.php';

// Get the form data
$sweetsName = $_POST['sweetsName'];
$sweetsPrice = $_POST['sweetsPrice'];
$sweetsQuantity = $_POST['sweetsQuantity'];

// Insert the data into the "sweets" table
$sql = "INSERT INTO sweets (name, price, quantity) VALUES ('$sweetsName', '$sweetsPrice', '$sweetsQuantity')";
if ($conn->query($sql) === TRUE) {
    // Redirect back to view-sweets.php after successful insertion
    header("Location: view-sweets.php");
    exit;
} else {
    // Display an error message if the insertion fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
