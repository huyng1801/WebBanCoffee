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
    <!-- Modal Search End -->
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Xử lý thanh toán</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Đơn hàng</a></li>
            <li class="breadcrumb-item active text-white">Xử lý thanh toán</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Chi tiết đơn hàng</h1>
            <form id="checkoutForm" action="process_order.php" method="post">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">
                            <label class="form-label my-3">Họ và tên<sup>*</sup></label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ <sup>*</sup></label>
                            <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                            <input type="tel" class="form-control" name="phone_number" placeholder="Nhập số điện thoại">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Địa chỉ email<sup>*</sup></label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập địa chỉ Email">
                        </div>

                        <hr>
                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                            <label class="form-check-label" for="Address-1">Giao hàng đến địa chỉ khác?</label>
                        </div>
                        <div class="form-item">
                            <textarea name="note" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Ghi chú (Tùy chọn)"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Check if the cart session variable exists and is not empty
                                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                        $subtotal = 0;

                                        // Loop through each item in the cart
                                        foreach ($_SESSION['cart'] as $item) {
                                            $subtotal += $item['price'] * $item['quantity'];
                                    ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="<?php echo $item['image']; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5"><?php echo $item['name']; ?></td>
                                                <td class="py-5"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                                <td class="py-5"><?php echo $item['quantity']; ?></td>
                                                <td class="py-5"><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php
                                        }

                                        // Display Subtotal and Total
                                        ?>

                                        <tr>
                                            <th scope="row"></th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TỔNG TIỀN</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark"><?php echo number_format($subtotal, 0, ',', '.'); ?> VNĐ</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <td colspan="5">Your cart is empty</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Delivery-1" name="Delivery" value="Delivery">
                                    <label class="form-check-label" for="Delivery-1">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Thanh toán</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
    <!-- Footer Start -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
</body>
</html>