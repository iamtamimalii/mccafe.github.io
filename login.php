<?php

@include 'connection.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the submitted username and password
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Prepare and execute the SQL query
  $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if a matching user is found
  if ($result->num_rows == 1) {
    // Redirect to the enter data page or do further processing
    header("Location: enter_data.php");
    exit();
  } else {
    // Redirect back to the login page with an error message
    header("Location: admin-login.html?error=true");
    exit();
  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
?>
