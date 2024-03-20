<?php
include('db.php');

$searchTerm = $_GET['search'];

$productsPerPage = 6;

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($currentPage - 1) * $productsPerPage;

$sql = "SELECT p.*, category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE product_name LIKE '%$searchTerm%' LIMIT $start, $productsPerPage";
$result = $conn->query($sql);

$totalProductsSql = "SELECT COUNT(*) as total FROM products WHERE product_name LIKE '%$searchTerm%'";
$totalProductsResult = $conn->query($totalProductsSql);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];

$totalPages = ceil($totalProducts / $productsPerPage);

if ($result->num_rows > 0) {
    echo '<div class="row g-4 justify-content-center">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6 col-lg-6 col-xl-4">';
        echo '<a href="shop-detail.php?id=' . $row['product_id'] . '">';
        echo '<div class="rounded position-relative fruite-item">';
        echo '<div class="fruite-img">';
        echo '<img src="' . $row['image'] . '" class="img-fluid w-100 rounded-top" alt="' . $row['product_name'] . '">';
        echo '</div>';
        echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $row['category_name'] . '</div>';
        echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
        echo '<h4>' . $row['product_name'] . '</h4>';
        echo '<div class="d-flex justify-content-between flex-lg-wrap">';
        echo '<p class="text-dark fs-5 fw-bold mb-0">$' . $row['price'] . '</p>';
        echo '<a href="update_cart.php?action=addItem&productId=' . $row['product_id'] . '&quantity=1" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="col-12">';
    echo '<div class="pagination d-flex justify-content-center mt-5">';
    echo '<a href="?page=1&search=' . $searchTerm . '" class="rounded">&laquo;</a>';
    for ($page = 1; $page <= $totalPages; $page++) {
        echo '<a href="search_products.php?page=' . $page . '&search=' . $searchTerm . '" class="rounded pagination-link ' . ($page == $currentPage ? 'active' : '') . '">' . $page . '</a>';
    }
    echo '<a href="?page=' . $totalPages . '&search=' . $searchTerm . '" class="rounded">&raquo;</a>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="col-12">';
    echo '<p>No products found.</p>';
    echo '</div>';
}

$conn->close();
?>
