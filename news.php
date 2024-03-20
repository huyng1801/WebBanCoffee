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
        <h1 class="text-center text-white display-6">Tin tức</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Tin tức</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- News Start -->
    <div class="container-fluid news py-5">
        <div class="container py-5">
            <div class="row g-4">
                <?php
                include('db.php');
                $sql = "SELECT * FROM news";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-6 col-lg-4">';
                        echo '<a href="news_detail.php?id=' . $row['new_id']  . '">';
                        echo '<div class="card h-100">';
                        echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                        echo '<p class="card-text">' . $row['sub_content'] . '</p>';
                        echo '</div>';
                        echo '<div class="card-footer">';
                        echo '<small class="text-muted">Ngày đăng: ' . date('d/m/Y', strtotime($row['create_at'])) . '</small>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12">';
                    echo '<p>No news articles found.</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- News End -->
    <!-- Footer Start -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
   
</body>

</html>