<?php

@include 'connection.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $table_name = $_POST['table_name']; // Get table name from POST request

    error_log("Value: $update_value, ID: $update_id, Table: $table_name"); // log the data to check

    $update_quantity_query = mysqli_query($conn, "UPDATE `$table_name` SET quantity = '$update_value' WHERE id = '$update_id'");
    if ($update_quantity_query) {
        header("location:$table_name.php");
    } else {
        error_log(mysqli_error($conn)); // log the error if query fails
    };
};

?>