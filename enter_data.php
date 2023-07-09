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
    <title>Enter Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
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
            margin-top: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
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

        p {
            margin-top: 20px;
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            text-decoration: none;
            color: #007bff;
        }

        ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Add New Admin</h2>
        <form action="enter_data.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Add User">
        </form>

        <h2>View/Edit Tables</h2>
        <div style="display: inline;">
            <a class="btn btn-outline-dark" href="view-tea.php">Tea</a>
            <a class="btn btn-outline-dark" href="view-cold.php">Cold Coffee</a>
            <a class="btn btn-outline-dark" href="view-hot.php">Hot Coffee</a>
            <a class="btn btn-outline-dark" href="view-sweets.php">Sweets</a>
        </div>
        <ul>
        </ul>

        <?php
        // Check if the form is submitted to add a new user
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the submitted username and password
            $newUsername = $_POST["username"];
            $newPassword = $_POST["password"];

            @include 'connection.php';


            // Prepare and execute the SQL query to add a new user
            $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $newUsername, $newPassword);
            $stmt->execute();

            // Check if the user was added successfully
            if ($stmt->affected_rows > 0) {
                echo "<p>New user added successfully!</p>";
            } else {
                echo "<p>Error adding new user.</p>";
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
