<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<?php 
include 'head.php';
?>
<body>
    <!-- Navbar start -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Order Confirmation Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Đặt hàng thành công</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="cart.php">Đơn hàng</a></li>
            <li class="breadcrumb-item active text-white">Đặt hàng thành công</li>
        </ol>
    </div>
    <!-- Order Confirmation Header End -->
    <!-- Order Details Start -->
    <div class="container-fluid order-details py-5">
        <div class="container py-5">
            <div class="order-details-header text-center">
                <h1 class="display-5 mb-5 text-dark">Cảm ơn bạn đã chọn chúng tôi!</h1>
            </div>

            <!-- Hiển thị Chi Tiết Đơn Hàng Ở Đây -->
            <div class="order-details-content">
                <h2 class="mb-4">Đơn đặt hàng cà phê của bạn đã được đặt thành công.</h2>
                <p class="mt-4">Chúng tôi đang chuẩn bị đơn hàng của bạn. Nó sẽ được giao đến bạn trong thời gian sớm nhất. Cảm ơn bạn đã chọn cửa hàng cà phê của chúng tôi!</p>
            </div>
        </div>
    </div>
    <!-- Order Details End -->
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
