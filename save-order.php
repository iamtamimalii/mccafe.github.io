<?php
@include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the table number and items from the request
    $data = json_decode(file_get_contents('php://input'), true);
    $tableNumber = $data['tableNumber'];
    $items = $data['items'];

    // Save the table number to the database
    $insertTableQuery = mysqli_query($conn, "INSERT INTO `table` (number) VALUES ('$tableNumber')");
    if (!$insertTableQuery) {
        echo 'Failed to save table number.';
        exit;
    }

    // Save the selected items to the cart
    foreach ($items as $item) {
        $itemName = $item['name'];
        $itemPrice = $item['price'];
        $itemQuantity = $item['quantity'];

        $insertCartQuery = mysqli_query($conn, "INSERT INTO `cart` (name, price, quantity) VALUES ('$itemName', '$itemPrice', '$itemQuantity')");
        if (!$insertCartQuery) {
            echo 'Failed to save item: ' . $itemName;
            exit;
        }
    }

    echo 'Order saved successfully.';
}
?>
