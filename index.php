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
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Chất lượng</h4>
                    <h1 class="mb-5 display-3 text-primary">Nhiều chủng loại Cà Phê</h1>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" placeholder="Nhập từ khóa cần tìm">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Tìm kiếm</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php
                            include 'db.php';
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);
                            $categories = array();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $categories[] = $row;
                                }
                            }
                            $conn->close();
                            foreach ($categories as $index => $category) {
                                $isActive = ($index === 0) ? 'active' : '';
                            ?>
                                <div class="carousel-item <?php echo $isActive; ?> rounded">
                                    <img src="<?php echo $category['image']; ?>" class="img-fluid w-100 h-100 bg-secondary rounded" alt="<?php echo $category['category_name']; ?>">
                                    <a href="#" class="btn px-4 py-2 text-white rounded"><?php echo $category['category_name']; ?></a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Hero End -->
    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Giao hàng miễn phí</h5>
                            <p class="mb-0">Miễn phí giao hàng cho hóa đơn trên 300.000đ</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Bảo mật thanh toán</h5>
                            <p class="mb-0">100% thông tin thanh toán được bảo mật</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Hoàn trả hàng</h5>
                            <p class="mb-0">Hoàn trả hàng đối với sản phẩm được quy định</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Hỗ trợ 24/7</h5>
                            <p class="mb-0">Hỗ trợ nhiệt tình, nhanh chóng, mọi lúc</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->
    <!-- Fruits Shop Start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Các sản phẩm</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <?php
                        include 'db.php';
                        $categorySql = "SELECT * FROM categories";
                        $categoryResult = $conn->query($categorySql);
                        $categories = array();
                        if ($categoryResult->num_rows > 0) {
                            while ($category = $categoryResult->fetch_assoc()) {
                                $categories[] = $category;
                            }
                        }
                        $categoryResult->close();
                        echo '<ul class="nav nav-pills d-inline-flex text-center mb-5">';
                        echo '<li class="nav-item">';
                        echo '<a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-all">';
                        echo '<span class="text-dark" style="width: 130px;">Tất cả</span>';
                        echo '</a>';
                        echo '</li>';
                        foreach ($categories as $category) {
                            echo '<li class="nav-item">';
                            echo '<a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-' . $category['category_id'] . '">';
                            echo '<span class="text-dark" style="width: 130px;">' . $category['category_name'] . '</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        ?>
                    </div>
                </div>
                <div class="tab-content">
                    <?php
                    echo '<div id="tab-all" class="tab-pane fade show p-0 active">';
                    echo '<div class="row g-4">';
                    echo '<div class="col-lg-12">';
                    echo '<div class="row g-4">';
                    $allProductsSql = "SELECT * FROM products";
                    $allProductsResult = $conn->query($allProductsSql);
                    while ($product = $allProductsResult->fetch_assoc()) {
                        echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                        echo '<a href="shop-detail.php?id=' . $product['product_id'] . '">';
                        echo '<div class="rounded position-relative fruite-item">';
                        echo '<div class="fruite-img">';
                        echo '<img src="' . $product['image'] . '" class="img-fluid w-100 rounded-top" alt="">';
                        echo '</div>';
                        echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $product['product_name'] . '</div>';
                        echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                        echo '<h4>' . $product['product_name'] . '</h4>';
                        echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                        $formatted_price = number_format($product['price'], 0, ',', '.') . ' VNĐ';
                        echo '<p class="text-dark fs-5 fw-bold mb-0">' . $formatted_price . '</p>';
                        echo '<a href="update_cart.php?action=addItem&productId= ' . $product['product_id'] . '&quantity=1" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                    $allProductsResult->close();
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    foreach ($categories as $category) {
                        echo '<div id="tab-' . $category['category_id'] . '" class="tab-pane fade show p-0">';
                        echo '<div class="row g-4">';
                        echo '<div class="col-lg-12">';
                        echo '<div class="row g-4">';
                        $productId = $category['category_id'];
                        $productSql = "SELECT * FROM products WHERE category_id = $productId";
                        $productResult = $conn->query($productSql);
                        while ($product = $productResult->fetch_assoc()) {
                            echo '<div class="col-md-6 col-lg-4 col-xl-3">';
                            echo '<a href="shop-detail.php?id=' . $product['product_id'] . '">';
                            echo '<div class="rounded position-relative fruite-item">';
                            echo '<div class="fruite-img">';
                            echo '<img src="' . $product['image'] . '" class="img-fluid w-100 rounded-top" alt="">';
                            echo '</div>';
                            echo '<div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $category['category_name'] . '</div>';
                            echo '<div class="p-4 border border-secondary border-top-0 rounded-bottom">';
                            echo '<h4>' . $product['product_name'] . '</h4>';
                            echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                            $formatted_price = number_format($product['price'], 0, ',', '.') . ' VNĐ';
                            echo '<p class="text-dark fs-5 fw-bold mb-0">' . $formatted_price . '</p>';
                            echo '<a href="update_cart.php?action=addItem&productId= ' . $product['product_id'] . '&quantity=1" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                        $productResult->close();
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End -->
    <!-- Features Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="data:image/jpeg;base64,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" class="img-fluid rounded-top w-100" alt="Cà phê">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Cà phê</h5>
                                    <h3 class="mb-0">Chất lượng cao</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="https://caphehanhphuc.com/wp-content/uploads/2022/07/LATE-300x300.jpg" class="img-fluid rounded-top w-100" alt="Giao hàng miễn phí">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Giao hàng miễn phí</h5>
                                    <h3 class="mb-0">Đặc biệt ngon</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="https://crowncoffeevietnam.com/wp-content/uploads/2020/08/w-300x300.jpg" class="img-fluid rounded-top w-100" alt="Ưu đãi giảm giá">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Ưu đãi giảm giá</h5>
                                    <h3 class="mb-0">Giảm giá 30%</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
    <!-- Vesitable Shop Start -->
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Sản phẩm bán chạy nhất</h1>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <?php
                include 'db.php';
                $sql = "SELECT p.*, c.category_name, SUM(od.quantity) as total_quantity
                        FROM products p
                        JOIN order_detail od ON p.product_id = od.product_id
                        JOIN categories c ON c.category_id = p.category_id
                        GROUP BY p.product_id
                        ORDER BY total_quantity DESC LIMIT 6";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="border border-primary rounded position-relative vesitable-item">';
                        echo '<a href="shop-detail.php?id=' . $row['product_id'] . '">';
                        echo '<div class="vesitable-img">';
                        echo '<img src="' . $row['image'] . '" class="img-fluid w-100 rounded-top" alt="">';
                        echo '</div>';
                        echo '<div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">' . $row['category_name'] . '</div>';
                        echo '<div class="p-4 rounded-bottom">';
                        echo '<h4>' . $row['product_name'] . '</h4>';
                        echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                        $formatted_price = number_format($row['price'], 0, ',', '.') . ' VNĐ';
                        echo '<p class="text-dark fs-5 fw-bold mb-0">' . $formatted_price . '</p>';
                        echo '<a href="update_cart.php?action=addItem&productId= ' . $row['product_id'] . '&quantity=1" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Không có sản phẩm";
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <!-- Vesitable Shop End -->
    <!-- Phần Banner Bắt đầu -->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Cà Phê Tươi Ngon</h1>
                        <p class="fw-normal display-3 text-dark mb-4">tại Cửa Hàng Chúng Tôi</p>
                        <p class="mb-4 text-dark">Cà phê được tạo ra không bao giờ lặp lại, chứa các từ hóm hỉnh, hoặc các từ không điển hình khác.</p>
                        <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">MUA NGAY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://cafedalat.net/wp-content/uploads/2020/10/cafe-den.png" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50k</span>
                                <span class="h4 text-muted mb-0">ly</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Phần Banner Kết thúc -->
    <?php
    include 'db.php';
    $sqlCustomerCount = "SELECT COUNT(DISTINCT phone_number) AS total_customers FROM orders";
    $resultCustomerCount = $conn->query($sqlCustomerCount);
    if ($resultCustomerCount->num_rows > 0) {
        while ($row = $resultCustomerCount->fetch_assoc()) {
            $totalCustomers = $row["total_customers"];
        }
    } else {
        $totalCustomers = 0;
    }
    $sqlOrderCount = "SELECT COUNT(*) AS total_orders FROM orders";
    $resultOrderCount = $conn->query($sqlOrderCount);
    if ($resultOrderCount->num_rows > 0) {
        while ($row = $resultOrderCount->fetch_assoc()) {
            $totalOrders = $row["total_orders"];
        }
    } else {
        $totalOrders = 0;
    }
    $sqlProductCount = "SELECT COUNT(*) AS total_products FROM products";
    $resultProductCount = $conn->query($sqlProductCount);
    if ($resultProductCount->num_rows > 0) {
        while ($row = $resultProductCount->fetch_assoc()) {
            $totalProducts = $row["total_products"];
        }
    } else {
        $totalProducts = 0;
    }
    $conn->close();
    ?>
    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Khách hàng hài lòng</h4>
                            <h1><?php echo $totalCustomers; ?></h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Chất lượng dịch vụ</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Số lượng chứng chỉ chất lượng</h4>
                            <h1><?php echo $totalOrders; ?></h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Số lượng sản phẩm có sẵn</h4>
                            <h1><?php echo $totalProducts; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->
    <!-- Tastimonial Start -->
   <!-- Tastimonial Start -->
<div class="container-fluid testimonial py-5">
    <div class="container py-5">
        <div class="testimonial-header text-center">
            <h4 class="text-primary">Phản hồi</h4>
            <h1 class="display-5 mb-5 text-dark">Nhận xét từ khách hàng</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <?php
            include 'db.php';

            // Fetch testimonials from the database
            $testimonialQuery = "SELECT * FROM product_reviews";
            $testimonialResult = $conn->query($testimonialQuery);

            if ($testimonialResult->num_rows > 0) {
                while ($testimonial = $testimonialResult->fetch_assoc()) {
            ?>
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0"><?php echo $testimonial['comment']; ?></p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <!-- You may need to modify the path based on where your images are stored -->
                                    <img src="img/avatar.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo $testimonial['customer_name']; ?></h4>
                               
                                    <div class="d-flex pe-5">
                                        <?php
                                        $rating = $testimonial['rating'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '<i class="fas fa-star ' . ($i <= $rating ? 'text-primary' : '') . '"></i>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p>No testimonials available.</p>';
            }
            $testimonialResult->close();
            $conn->close();
            ?>
        </div>
    </div>
</div>
<!-- Tastimonial End -->

    <!-- Tastimonial End -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
</body>
</html>