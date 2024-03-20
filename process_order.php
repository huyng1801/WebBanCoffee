<?php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $note = $_POST['note'];
    $insertOrderQuery = "INSERT INTO orders (customer_name, date_order, phone_number, email, note) 
                        VALUES ('$customer_name', CURRENT_DATE, '$phone_number', '$email', '$note')";
    $resultOrder = mysqli_query($conn, $insertOrderQuery);
    if ($resultOrder) {
        $order_id = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['productId'];
            $quantity = $item['quantity'];

            $insertOrderDetailQuery = "INSERT INTO order_detail (order_id, product_id, quantity) 
                                      VALUES ($order_id, $product_id, $quantity)";
            mysqli_query($conn, $insertOrderDetailQuery);
        }
        unset($_SESSION['cart']);
        header("Location: testimonial.php");
        exit();
    } else {
        echo "Error inserting order: " . mysqli_error($conn);
    }
}
?>
