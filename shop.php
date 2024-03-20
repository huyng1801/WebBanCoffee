<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<?php
include 'head.php';
?>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Navbar start -->
    <?php
    include 'navbar.php';
    ?>
    <!-- Navbar End -->
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Website bán Cà phê</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="Từ khóa" id="search-input">
                                <button id="search-button" class="btn btn-primary p-3" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Sắp xếp theo:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3">
                                    <option value="default">Mặc định</option>
                                    <option value="name_asc">Thứ tự (A-Z)</option>
                                    <option value="name_desc">Thứ tự (Z-A)</option>
                                    <option value="price_asc">Giá (Tăng dần)</option>
                                    <option value="price_desc">Giá (Giảm dần)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <?php
                                    include('db.php');
                                    $sql = "SELECT category_name, COUNT(product_id) AS product_count FROM categories c JOIN products p ON c.category_id = p.category_id GROUP BY c.category_id";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="mb-3">';
                                        echo '<h4>Loại</h4>';
                                        echo '<ul class="list-unstyled fruite-categorie">';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<li>';
                                            echo '<div class="d-flex justify-content-between fruite-name">';
                                            echo '<a href="#"><i class="fas fa-apple-alt me-2"></i>' . $row['category_name'] . '</a>';
                                            echo '<span>(' . $row['product_count'] . ')</span>';
                                            echo '</div>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                        echo '</div>';
                                    } else {
                                        echo 'Không có thể loại.';
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="https://img.pikbest.com/05/67/44/06DpIkbEsTNGB.jpg!w700wp" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-light fw-bold">Cà <br> phê <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="products-container" class="col-lg-9">
                            <?php
                            include('db.php');
                            $productsPerPage = 6;
                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                            $start = ($current_page - 1) * $productsPerPage;
                            if (isset($_GET['sortType'])) {
                                $_SESSION['sortType'] = $_GET['sortType'];
                            }
                            $sortType = isset($_SESSION['sortType']) ? $_SESSION['sortType'] : 'default';
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
                                echo '<div class="row g-4 justify-content-center">';
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
                                echo '<a href="?page=1&sortType=' . $sortType . '" class="rounded">&laquo;</a>';
                                for ($page = 1; $page <= $totalPages; $page++) {
                                    echo '<a href="sort_products.php?page=' . $page . '&sortType=' . $sortType . '" class="rounded pagination-link ' . ($page == $current_page ? 'active' : '') . '">' . $page . '</a>';
                                }
                                echo '<a href="?page=' . $totalPages . '&sortType=' . $sortType . '" class="rounded">&raquo;</a>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo 'Không tìm thấy sản phẩm.';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
    <!-- Footer Start -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script>
        $(document).ready(function() {
            $('#fruits').change(function() {
                var selectedValue = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'sort_products.php',
                    data: {
                        sortType: selectedValue
                    },
                    success: function(response) {
                        $('#products-container').html(response);
                    }
                });
            });
        });
        $(document).ready(function() {
            $(".pagination-link").click(function(e) {
                e.preventDefault();
                var pageUrl = $(this).attr("href");
                $.ajax({
                    type: "GET",
                    url: pageUrl,
                    success: function(response) {
                        $("#products-container").html(response);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#search-button').on('click', function() {
                var searchTerm = $('#search-input').val().trim();
                $.ajax({
                    type: 'GET',
                    url: 'search_products.php',
                    data: {
                        search: searchTerm
                    },
                    success: function(response) {
                        $('#products-container').html(response);
                        $('#search-input').val() = "";
                    }
                });

            });
        });
    </script>
</body>

</html>