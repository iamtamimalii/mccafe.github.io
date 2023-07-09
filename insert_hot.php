<?php
// Include the database connection file
include 'connection.php';

// Get the form data
$hotName = $_POST['hotName'];
$hotPrice = $_POST['hotPrice'];
$hotQuantity = $_POST['hotQuantity'];

// Insert the data into the "hot" table
$sql = "INSERT INTO hotcoffee (name, price, quantity) VALUES ('$hotName', '$hotPrice', '$hotQuantity')";
if ($conn->query($sql) === TRUE) {
    // Redirect back to view-hot.php after successful insertion
    header("Location: view-hot.php");
    exit;
} else {
    // Display an error message if the insertion fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
