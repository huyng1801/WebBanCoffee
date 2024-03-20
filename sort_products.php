<?php
include('db.php');
if (isset($_GET['sortType'])) {
    $_SESSION['sortType'] = $_GET['sortType'];
}
$sortType = isset($_SESSION['sortType']) ? $_SESSION['sortType'] : 'default';
$productsPerPage = 6;
$current_page = isset($_GET['currentPage']) ? $_GET['currentPage'] : 1;
$start = ($current_page - 1) * $productsPerPage;
switch ($sortType) {
    case 'name_asc':
        $orderBy = 'product_name ASC';
        break;
    case 'name_desc':
        $orderBy = 'product_name DESC';
        break;
    case 'price_asc':
        $orderBy = 'price ASC';
        break;
    case 'price_desc':
        $orderBy = 'price DESC';
        break;
    default:
        $orderBy = 'product_id DESC'; 
}
$sql = "SELECT p.*, category_name FROM products p JOIN categories c ON p.category_id = c.category_id ORDER BY $orderBy LIMIT $start, $productsPerPage";
$result = $conn->query($sql);
$totalProductsSql = "SELECT COUNT(*) as total FROM products";
$totalProductsResult = $conn->query($totalProductsSql);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $productsPerPage);
if ($result->num_rows > 0) {
    echo '<div id="products-container" class="row g-4 justify-content-center">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6 col-lg-6 col-xl-4">';
        echo '<a href="shop-detail.php?id=' . $row['product_id'] . '">';
        echo '<div class="rounded position-relative fruite-item">';
        echo '<div class="fruite-img">';
        echo '<img src="' . $row['image'] . '" class="img-fluid w-100 rounded-top" alt="' . $row['category_name'] . '">';
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
    echo '<a href="#" class="rounded">&laquo;</a>';
    for ($page = 1; $page <= $totalPages; $page++) {
        echo '<a href="?page=' . $page . '&sortType=' . $sortType . '" class="rounded pagination-link ' . ($page == $current_page ? 'active' : '') . '">' . $page . '</a>';
    }
    echo '<a href="#" class="rounded">&raquo;</a>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'No products found.';
}
?>
