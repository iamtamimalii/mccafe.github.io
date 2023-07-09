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
    <title>View sweets</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f8f9fa;
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

        input[type="submit"],
        .btn {
            padding: 10px;
            background-color: #212529;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        .btn:hover {
            background-color: #212529;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>View sweets</h2>
        <table>
            <tr>
                <th>sweets ID</th>
                <th>sweets Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            // Include the database connection file
            include 'connection.php';

            // Fetch data from the "sweets" table
            $sql = "SELECT * FROM sweets";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_sweets.php?id=" . $row["id"] . "' class='btn btn-outline-primary'>Edit</a> ";
                    echo "<a href='delete_sweets.php?id=" . $row["id"] . "' class='btn btn-outline-danger'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No sweets available.</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>

        <h2>Add sweets</h2>
        <form action="insert_sweets.php" method="post">
            <label for="sweetsName">sweets Name:</label>
            <input type="text" id="sweetsName" name="sweetsName" required>
            <br>
            <label for="sweetsPrice">Price:</label>
            <input type="text" id="sweetsPrice" name="sweetsPrice" required>
            <br>
            <label for="sweetsQuantity">Quantity:</label>
            <input type="text" id="sweetsQuantity" name="sweetsQuantity" required>
            <br>
            <input type="submit" value="Add sweets">
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
