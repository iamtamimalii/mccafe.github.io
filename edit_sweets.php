<?php
// Include the database connection file
include 'connection.php';

// Check if the sweets ID is provided
if (isset($_GET['id'])) {
    $sweetsId = $_GET['id'];

    // Fetch the sweets record from the database
    $sql = "SELECT * FROM sweets WHERE id = '$sweetsId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the sweets data
        $row = $result->fetch_assoc();
        $sweetsName = $row['name'];
        $sweetsPrice = $row['price'];
    } else {
        // Redirect back to view-sweets.php if the sweets record is not found
        header("Location: view-sweets.php");
        exit;
    }
} else {
    // Redirect back to view-sweets.php if the sweets ID is not provided
    header("Location: view-sweets.php");
    exit;
}

// Check if the form is submitted for updating the sweets data
if (isset($_POST['update'])) {
    $sweetsName = $_POST['sweetsName'];
    $sweetsPrice = $_POST['sweetsPrice'];

    // Update the sweets data in the database
    $sql = "UPDATE sweets SET name = '$sweetsName', price = '$sweetsPrice' WHERE id = '$sweetsId'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to view-sweets.php after successful update
        header("Location: view-sweets.php");
        exit;
    } else {
        // Display an error message if the update fails
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Edit sweets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #212529;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #212529;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Edit sweets</h2>
        <form action="" method="post">
            <label for="sweetsName">sweets Name:</label>
            <input type="text" id="sweetsName" name="sweetsName" value="<?php echo $sweetsName; ?>" required>
            <br>
            <label for="sweetsPrice">Price:</label>
            <input type="text" id="sweetsPrice" name="sweetsPrice" value="<?php echo $sweetsPrice; ?>" required>
            <br>
            <input type="submit" name="update" value="Update sweets">
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
