<?php
@include 'connection.php';

if (isset($_POST['save_order'])) {
    $selectItemsQuery1 = "SELECT * FROM `tea` WHERE quantity > 0";
    $selectedItemsResult1 = mysqli_query($conn, $selectItemsQuery1);
    $selectItemsQuery2 = "SELECT * FROM `coldcoffee` WHERE quantity > 0";
    $selectedItemsResult2 = mysqli_query($conn, $selectItemsQuery2);
    $selectItemsQuery3 = "SELECT * FROM `hotcoffee` WHERE quantity > 0";
    $selectedItemsResult3 = mysqli_query($conn, $selectItemsQuery3);
    $selectItemsQuery4 = "SELECT * FROM `sweets` WHERE quantity > 0";
    $selectedItemsResult4 = mysqli_query($conn, $selectItemsQuery4);

    while ($item = mysqli_fetch_assoc($selectedItemsResult1)) {
        // Save the item data in the cart table
        $insertCartQuery = "INSERT INTO `cart` (name, price, quantity) VALUES ('" . $item['name'] . "', " . $item['price'] . ", " . $item['quantity'] . ")";
        mysqli_query($conn, $insertCartQuery);

        // Set the quantity to 0 for the item in the tea table
        $updateQuantityQuery = "UPDATE `tea` SET quantity = 0 WHERE id = " . $item['id'];
        mysqli_query($conn, $updateQuantityQuery);
    }
    while ($item = mysqli_fetch_assoc($selectedItemsResult2)) {
        // Save the item data in the cart table
        $insertCartQuery = "INSERT INTO `cart` (name, price, quantity) VALUES ('" . $item['name'] . "', " . $item['price'] . ", " . $item['quantity'] . ")";
        mysqli_query($conn, $insertCartQuery);

        // Set the quantity to 0 for the item in the tea table
        $updateQuantityQuery = "UPDATE `coldcoffee` SET quantity = 0 WHERE id = " . $item['id'];
        mysqli_query($conn, $updateQuantityQuery);
    }
    while ($item = mysqli_fetch_assoc($selectedItemsResult3)) {
        // Save the item data in the cart table
        $insertCartQuery = "INSERT INTO `cart` (name, price, quantity) VALUES ('" . $item['name'] . "', " . $item['price'] . ", " . $item['quantity'] . ")";
        mysqli_query($conn, $insertCartQuery);

        // Set the quantity to 0 for the item in the tea table
        $updateQuantityQuery = "UPDATE `hotcoffee` SET quantity = 0 WHERE id = " . $item['id'];
        mysqli_query($conn, $updateQuantityQuery);
    }
    while ($item = mysqli_fetch_assoc($selectedItemsResult4)) {
        // Save the item data in the cart table
        $insertCartQuery = "INSERT INTO `cart` (name, price, quantity) VALUES ('" . $item['name'] . "', " . $item['price'] . ", " . $item['quantity'] . ")";
        mysqli_query($conn, $insertCartQuery);

        // Set the quantity to 0 for the item in the tea table
        $updateQuantityQuery = "UPDATE `sweets` SET quantity = 0 WHERE id = " . $item['id'];
        mysqli_query($conn, $updateQuantityQuery);
    }

    // Redirect to cart.php
    header("Location: cart.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <title>Mc Café</title>
</head>

<script>

    function changeQuantity(value, id, price, tableName) {
        let currentQuantity = Number(document.getElementById('quantity_' + id).innerText);
        let newQuantity = currentQuantity + value;
        if (newQuantity < 0) return; // Prevent quantity from going below 0

        let totalElement = document.getElementById('total_' + id);
        let grandTotalElement = document.getElementById('grand_total');
        let currentTotal = Number(totalElement.innerText.replace('$', '').replace('/-', '') || "0") || 0;
        let grandTotal = Number(grandTotalElement.innerText.replace('$', '').replace('/-', '') || "0" || 0);

        // Debugging logs:
        console.log("Current Total: " + currentTotal);
        console.log("Grand Total: " + grandTotal);
        console.log("New Quantity: " + newQuantity);
        console.log("Price: " + price);
        console.log("Total for this item: " + (newQuantity * price).toFixed(2));

        // Adjust the grand total
        grandTotal = grandTotal - currentTotal + newQuantity * price;
        grandTotalElement.innerText = '$' + grandTotal.toFixed(2) + '/-';
        // After updating the grand total
        // grandTotalElement.innerText = grandTotal.toFixed(2);

        // Enable/disable the "Order Now" button based on the new grand total
        var orderNowButton = document.getElementById('order_now');
        if (grandTotal > 0) {
            orderNowButton.classList.remove('disabled');
        } else {
            orderNowButton.classList.add('disabled');
        }


        // Adjust the total for this item
        totalElement.innerText = (newQuantity * price).toFixed(2);

        // Adjust the quantity
        document.getElementById('quantity_' + id).innerText = newQuantity;

        // Send the data to the server to update the quantity
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'update_quantity.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(this.responseText);
            }
        }
        xhr.send("update_update_btn=true&update_quantity=" + newQuantity + "&update_quantity_id=" + id + "&table_name=" + tableName);
    }
    function saveOrder() {
        // Get the table number
        var tableNumberInput = document.getElementById('table-number');
        var tableNumber = parseInt(tableNumberInput.value);

        if (isNaN(tableNumber) || tableNumber < 1 || tableNumber > 9) {
            alert('Please enter a valid table number between 1 and 9.');
            return;
        }
        
        // Get the selected items with quantity > 1
        var selectedItems = [];
        var items = document.querySelectorAll('.menu-item');
        items.forEach(function(item) {
            var quantityElement = item.querySelector('.quantity');
            var quantity = parseInt(quantityElement.innerText);
            if (quantity > 1) {
                var nameElement = item.querySelector('.name');
                var priceElement = item.querySelector('.price');

                var itemData = {
                    name: nameElement.innerText,
                    price: parseFloat(priceElement.innerText.replace('$', '')),
                    image: imageElement.getAttribute('src'),
                    quantity: quantity
                };

                selectedItems.push(itemData);
            }
        });

        // Save the order to the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", 'save_order.php', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                alert('Order saved successfully.');
            }
        };
        xhr.send(JSON.stringify({
            tableNumber: tableNumber,
            items: selectedItems
        }));
    }
</script>

<body>
    <?php include 'header.php'; ?>

    <div class="main-banner">
        <img src="images/banner2.png" class="d-block w-100" alt="">
    </div>

    <div class="info1 container" id="menu">
        <div class="row">
            <div class="col-md-6">
                <div class="content1">
                    <h1>Full Mc Café Menu</h1>
                    <a class="btn btn-outline-dark" href="#fullmenu">Browse Full Menu</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="images/info1.png" class="d-block w-100" alt="">
            </div>
        </div>
    </div>

    <div class="info2 container" id="location">
        <div class="row">
            <div class="col-md">
                <img src="images/info2.png" class="d-block w-100" alt="">
            </div>
            <div class="col-md">
                <div class="content2">
                    <h1>Find a Mc Café</h1>
                    <a class="btn btn-outline-dark" href="#">Check Our Locations</a>
                </div>
            </div>
        </div>
    </div>

    <div class="menu container" id="fullmenu">
        <div>
            <h1 class="heading" align="center">Mc Café Menu</h1>
        </div>
        <div class="table container" align="center">
            <div class="input-group" style="width: 350px; height: 50px;">
                <span class="input-group-text" style="background-color: #212529; color: white;" id="basic-addon1">Select your table</span>
                <input type="number" class="form-control" id="table-number" placeholder="Table Number.." min="1" max="9">
            </div>

        </div>
        <div class="menu-nav container">
            <nav>
                <ul>
                    <li><button onclick="loadTea()">Tea</button></li>
                    <li><button onclick="loadCold()">Cold Coffee</button></li>
                    <li><button onclick="loadHot()">Hot Coffee</button></li>
                    <li><button onclick="loadSweet()">Sweets</button></li>
                </ul>
            </nav>
        </div>
        <div align="center" id="show">...SELECT FROM ABOVE...</div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>

</html>