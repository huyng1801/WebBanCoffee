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
        <h1 class="text-center text-white display-6">Chi tiết sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Chi tiết sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <?php
                        include 'db.php';
                        $productId = $_GET['id'];
                        $query = "SELECT p.*, category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE product_id = $productId";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            $productName = htmlspecialchars($product['product_name']);
                            $category = htmlspecialchars($product['category_name']);
                            $price = htmlspecialchars($product['price']);
                            $image = $product['image'];
                            $rating = 4;
                            $description = htmlspecialchars($product['description']);
                            $result->close();
                        } else {
                            $productName = "Product Not Found";
                            $category = "";
                            $price = "";
                            $image = "";
                            $rating = 0;
                            $description = "";
                        }
                        ?>
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="<?php echo $image; ?>" class="img-fluid rounded" alt="Product Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3"><?php echo $productName; ?></h4>
                            <p class="mb-3">Category: <?php echo $category; ?></p>
                            <h5 class="fw-bold mb-3"><?php echo $price; ?></h5>

                            <div class="d-flex mb-4">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<i class="fa fa-star';
                                    if ($i <= $rating) {
                                        echo ' text-secondary';
                                    }
                                    echo '"></i>';
                                }
                                ?>
                            </div>
                            <p class="mb-4"><?php echo $description; ?></p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="quantityInput" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" onclick="addToCart('<?php echo $productId; ?>')">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng
                            </a>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Chi tiết</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Đánh giá</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p><?php echo $description; ?></p>
                                </div>
                                <div class="tab-pane comments-section" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    <?php
                                    include 'db.php';
                                    $commentsQuery = "SELECT * FROM product_reviews WHERE product_id = $productId";
                                    $commentsResult = $conn->query($commentsQuery);
                                    if ($commentsResult->num_rows > 0) {
                                        while ($comment = $commentsResult->fetch_assoc()) {
                                    ?>
                                            <div class="d-flex">
                                                <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;"><?php echo date('F d, Y', strtotime($comment['created_at'])); ?></p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5><?php echo $comment['customer_name']; ?></h5>
                                                        <div class="d-flex mb-3">
                                                            <?php
                                                            $rating = $comment['rating'];
                                                            for ($i = 1; $i <= 5; $i++) {

                                                                if ($i <= $rating) {
                                                                    echo '<i class="fa fa-star text-secondary"></i>';
                                                                } else {
                                                                    echo '<i class="fa fa-star"></i>';
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <p><?php echo $comment['comment']; ?></p>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo '<p>No comments available.</p>';
                                    }
                                    $commentsResult->close();
                                    ?>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form id="commentForm" action="#" method="post">
                            <h4 class="mb-5 fw-bold">Bình luận</h4>
                            <input type="hidden" value="<?php echo $productId ?>" name="product_id">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Nhập tên của bạn" name="customer_name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Nhập địa chỉ email" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Đánh giá:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star" data-rating="1"></i>
                                                <i class="fa fa-star" data-rating="2"></i>
                                                <i class="fa fa-star" data-rating="3"></i>
                                                <i class="fa fa-star" data-rating="4"></i>
                                                <i class="fa fa-star" data-rating="5"></i>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3">Bình luận</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <h4>Loại</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <?php
                                    $categoryQuery = "SELECT category_name, COUNT(product_id) AS product_count FROM categories c JOIN products p ON c.category_id = p.category_id GROUP BY c.category_id";
                                    $categoryResult = $conn->query($categoryQuery);
                                    if ($categoryResult->num_rows > 0) {
                                        while ($row = $categoryResult->fetch_assoc()) {
                                            echo '<li>';
                                            echo '<div class="d-flex justify-content-between fruite-name">';
                                            echo '<a href="#"><i class="fas fa-apple-alt me-2"></i>' . $row['category_name'] . '</a>';
                                            echo '<span>(' . $row['product_count'] . ')</span>';
                                            echo '</div>';
                                            echo '</li>';
                                        }
                                    } else {
                                        echo '<li>Không có loại</li>';
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Sản phẩm bán chạy</h4>
                            <?php
                            include 'db.php';
                            $sql = "SELECT p.product_id, p.product_name, p.image, p.price, p.description, SUM(od.quantity) AS total_sold
                                    FROM products p
                                    JOIN order_detail od ON p.product_id = od.product_id
                                    GROUP BY p.product_id
                                    ORDER BY total_sold DESC
                                    LIMIT 6";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded" style="width: 100px; height: 100px;">
                                            <img src="<?php echo $row['image']; ?>" class="img-fluid rounded" alt="<?php echo $row['product_name']; ?>">
                                        </div>
                                        <div>
                                            <h6 class="mb-2"><?php echo $row['product_name']; ?></h6>
                                            <div class="d-flex mb-2">
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">$<?php echo $row['price']; ?> VNĐ</h5>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "Không tìm thấy sản phẩm.";
                            }
                            $conn->close();
                            ?>
                            <div class="d-flex justify-content-center my-4">
                                <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="https://img.pikbest.com/05/67/44/06DpIkbEsTNGB.jpg!w700wp" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Cà <br> phê <br> Banner</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Sản phẩm liên quan</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    <?php
                    include 'db.php';
                    $relatedQuery = "SELECT p.*, category_name FROM products p JOIN categories c ON p.category_id = c.category_id WHERE c.category_id = " . $product['category_id'] . " AND product_id != " . $productId . " LIMIT 6";
                    $relatedResult = $conn->query($relatedQuery);
                    if ($relatedResult->num_rows > 0) {
                        while ($relatedProduct = $relatedResult->fetch_assoc()) {
                            echo '<div class="border border-primary rounded position-relative vesitable-item">';
                            echo '<div class="vesitable-img">';
                            echo '<img src="' . $relatedProduct['image'] . '" class="img-fluid w-100 rounded-top" alt="">';
                            echo '</div>';
                            echo '<div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">' . $relatedProduct['category_name'] . '</div>';
                            echo '<div class="p-4 pb-0 rounded-bottom">';
                            echo '<h4>' . $relatedProduct['product_name'] . '</h4>';
                            echo '<div class="d-flex justify-content-between flex-lg-wrap">';
                            echo '<p class="text-dark fs-5 fw-bold">$' . $relatedProduct['price'] . ' / kg</p>';
                            echo '<a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Không tìm thấy sản phẩm liên quan</p>';
                    }
                    $relatedResult->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
    <!-- Footer Start -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
    <script>
        function addToCart(productId) {
            var quantity = document.getElementById('quantityInput').value;
            window.location.href = 'update_cart.php?action=addItem&productId=' + productId + '&quantity=' + quantity;
        }
        $(document).ready(function() {
            var selectedRating = 0;
            $('.fa-star').on('click', function() {
                $('.fa-star').removeClass('text-warning');
                selectedRating = $(this).data('rating');
                $(this).prevAll('.fa-star').addBack().addClass('text-warning');
            });
            $('#commentForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                formData += '&rating=' + selectedRating;
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: 'process_comment.php', 
                    data: formData,
                    success: function(response) {
                        $('.comments-section').html(response);
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>
</html>