<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form data
    $productId = $_POST['product_id'];
    $customerName = $_POST['customer_name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $insertQuery = "INSERT INTO product_reviews (product_id, customer_name, email, rating, comment) 
                    VALUES ('$productId', '$customerName', '$email', '$rating', '$comment')";
    $conn->query($insertQuery);
}
$productId = $_POST['product_id']; 
$commentsQuery = "SELECT * FROM product_reviews WHERE product_id = $productId";
$commentsResult = $conn->query($commentsQuery);
if ($commentsResult->num_rows > 0) {
    while ($comment = $commentsResult->fetch_assoc()) {
        echo '<div class="d-flex">
            <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
            <div class="">
                <p class="mb-2" style="font-size: 14px;">' . date('F d, Y', strtotime($comment['created_at'])) . '</p>
                <div class="d-flex justify-content-between">
                    <h5>' . $comment['customer_name'] . '</h5>
                    <div class="d-flex mb-3">';
                        $rating = $comment['rating'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo '<i class="fa fa-star text-secondary"></i>';
                            } else {
                                echo '<i class="fa fa-star"></i>';
                            }
                        }
        echo '</div>
                </div>
                <p>' . $comment['comment'] . '</p>
            </div>
        </div>';
    }
} else {
    echo '<p>No comments available.</p>';
}
$commentsResult->close();
?>
