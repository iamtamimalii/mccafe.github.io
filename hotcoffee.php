<?php

@include 'connection.php';


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

    <title></title>
</head>

<body>
    <div class="menu container">
        <div style="padding: 50px 0;">
            <table align="center" style="width: 100%; margin-top: 10px;">

                <thead align="center">
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </thead>

                <tbody align="center">

                    <?php

                    $select_hot = mysqli_query($conn, "SELECT * FROM `hotcoffee`");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_hot) > 0) {
                        while ($fetch_hot = mysqli_fetch_assoc($select_hot)) {
                    ?>

                            <tr>
                                <td><?php echo $fetch_hot['name']; ?></td>
                                <td>$<?php echo number_format($fetch_hot['price']); ?>.00/-</td>
                                <td>
                                    <button class="btn-outline-dark btn" onclick="changeQuantity(-1, <?php echo $fetch_hot['id']; ?>, <?php echo $fetch_hot['price']; ?>, 'hotcoffee')">-</button>
                                    <span id="quantity_<?php echo $fetch_hot['id']; ?>"><?php echo $fetch_hot['quantity']; ?></span>
                                    <button class="btn-outline-dark btn" onclick="changeQuantity(1, <?php echo $fetch_hot['id']; ?>, <?php echo $fetch_hot['price']; ?>, 'hotcoffee')">+</button>
                                </td>
                                <td>
                                    <?php
                                    $sub_total = $fetch_hot['price'] * $fetch_hot['quantity'];
                                    $grand_total += $sub_total;
                                    ?>
                                    $<span id="total_<?php echo $fetch_hot['id']; ?>"><?php echo number_format($sub_total, 2); ?></span>/-
                                </td>
                            </tr>
                    <?php
                        };
                    };
                    ?>
                    <tr class="table-bottom">
                        <td></td>
                        <td></td>
                        <td><b>Grand Total</b></td>
                        <td id="grand_total">$<?php echo (mysqli_num_rows($select_hot) > 0) ? number_format($grand_total, 2) : '0.00'; ?>/-</td>
                    </tr>


                </tbody>

            </table>
        </div>
        <div class="checkout-btn" align="center">
            <form action="" method="post">
                <button id="order_now" class="btn-outline-dark btn disabled" type="submit" name="save_order">Order Now</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>