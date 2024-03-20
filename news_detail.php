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
        <h1 class="text-center text-white display-6">Xem tin tức</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="news.php">Tin tức</a></li>
            <li class="breadcrumb-item active text-white">Xem tin tức</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- News Details Start -->
    <div class="container-fluid news-details py-5 px-5">
        <div class="row">
            <div class="col-md-8">
                <div class="container py-5">
                    <?php
                    include('db.php');
                    if (isset($_GET['id'])) {
                        $newsId = $_GET['id'];
                        $sql = "SELECT * FROM news WHERE new_id = $newsId";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<div class="container py-5">';
                            echo '<div class="card">';
                            echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                            echo '<div class="card-body">';
                            echo '<h2 class="card-title">' . $row['title'] . '</h2>';
                            echo '<p class="text-muted">Ngày đăng: ' . $row['create_at'] . '</p>';
                            echo '<p class="card-text lead">' . $row['sub_content'] . '</p>';
                            echo '<p class="card-text">' . $row['content'] . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            echo '<div class="container py-5">';
                            echo '<p>News article not found.</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Không tồn tại tin tức.</p>';
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container py-5">
                    <h4 class="mb-4">Các tin tức khác</h4>
                    <?php
                    include('db.php');
                    $sql = "SELECT * FROM news WHERE new_id != $newsId ORDER BY create_at DESC LIMIT 5";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="mb-4">';
                            echo '<a href="news_detail.php?id=' . $row['new_id'] . '" class="card-link">';
                            echo '<div class="card">';
                            echo '<img src="' . $row['image'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                            echo '<div class="card-body">';
                            echo '<h6 class="card-title">' . $row['title'] . '</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Không có tin tức khác.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Main Content End -->
    <!-- News Details End -->
    <!-- Footer Start -->
    <?php
    include 'footer.php';
    include 'copyright.php';
    ?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>
</body>

</html>