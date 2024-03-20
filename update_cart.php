<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'adjustQuantity':
                if (isset($_GET['productId']) && isset($_GET['quantity'])) {
                    $productId = $_GET['productId'];
                    $quantity = $_GET['quantity'];

                    adjustQuantity($productId, $quantity);
                }
                break;
            case 'updateQuantity':
                if (isset($_GET['productId']) && isset($_GET['quantity'])) {
                    $productId = $_GET['productId'];
                    $quantity = $_GET['quantity'];
                    updateQuantity($productId, $quantity);
                }
                break;
            case 'removeItem':
                if (isset($_GET['productId'])) {
                    $productId = $_GET['productId'];
                    removeItem($productId);
                }
                break;
            case 'addItem':
                if (isset($_GET['productId']) && isset($_GET['quantity'])) {
                    $productId = $_GET['productId'];
                    $quantity = $_GET['quantity'];
                    addItem($productId, $quantity);
                }
                break;

            default:
                echo 'Hành động không hợp lệ.';
        }
        header('Location: cart.php');

        
    }
}
$conn->close();
function adjustQuantity($productId, $quantity)
{
    $_SESSION['cart'][$productId]['quantity'] = max(0, $_SESSION['cart'][$productId]['quantity'] + $quantity);
    if ($_SESSION['cart'][$productId]['quantity'] === 0) {
        removeItem($productId);
    }
}
function updateQuantity($productId, $quantity)
{
    $_SESSION['cart'][$productId]['quantity'] = max(0, $quantity);
    if ($_SESSION['cart'][$productId]['quantity'] === 0) {
        removeItem($productId);
    }
}
function removeItem($productId)
{
    unset($_SESSION['cart'][$productId]);
}
function getProductDetailsById($productId)
{
    global $conn;

    $query = "SELECT * FROM products WHERE product_id = $productId";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        $productDetails = $result->fetch_assoc();
        return $productDetails;
    } else {
        return null;
    }
}
function addItem($productId, $quantity)
{
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $productDetails = getProductDetailsById($productId);

        if ($productDetails) {
            $_SESSION['cart'][$productId] = array(
                'productId' => $productId,
                'name' => $productDetails['product_name'],
                'image' => $productDetails['image'],
                'price' => $productDetails['price'],
                'quantity' => $quantity
            );
        } else {
            echo 'Không tìm thấy sản phẩm.';
        }
    }
}
?>

