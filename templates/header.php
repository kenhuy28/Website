<?php
$fileName = basename($_SERVER['SCRIPT_FILENAME']);
echo $fileName;
$rootPath = ".";
if ($fileName != "index.php") {
    $rootPath = "../";
}
echo $rootPath;
include $rootPath . '/includes/config.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ kiện thú cưng</title>
    <link rel="icon" href="./assets/img/logo/header_logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://www.8ivlvi8.site/base.css">
    <link rel="stylesheet" href="https://www.8ivlvi8.site/main2.css">
    <link rel="stylesheet" href="https://www.8ivlvi8.site/grid.css">
    <link rel="stylesheet" href="https://www.8ivlvi8.site/responsive.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,600;0,700;0,800;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* Bỏ gạch chân */
        a {
            text-decoration: none;
        }

        /* Chuyển màu chữ sang màu trắng */
        a:link,
        a:visited {
            color: #FFFFFF;
        }
    </style>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<div class="app">
    <div class="gird">
        <div class="header">
            <div class="header_row1">
                <div class="header_row1_left">
                    <div class="logo">
                        <img src="./assets/img/logo/logopaddy.png" alt="">

                    </div>
                </div>
                <div class="header_row_right">
                    <form action=" " class="search">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="SearchString">
                        <button class="search_icon" style="border: none">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <div class="hotline">
                        <h5 class="name_icon">Hotline</h5>
                        <h5 class="hotline_sdt" style="font-weight: 600;">0374 41 41 42</h5>
                    </div>
                    <div class="h">
                        <div class="name_icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <h5>Wishlist</h5>
                    </div>

                    <!-- nếu chưa login -->
                    <a href="<?php echo $rootPath . "/pages/login.php"; ?> " class="h" id="login_user">
                        <div>
                            <div class="name_icon">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <h5>
                                Đăng nhập
                            </h5>
                        </div>
                    </a>
                    <!-- nếu đã login
                    <div class="h" id="profile_user">
                        <div class="name_icon">
                            <i class="fa-regular fa-user"></i>
                        </div>

                        <h5>
                             tên user 
                        </h5>
                    </div> -->
                    <!-- giỏ hàng -->
                    <div class="h" id="cart">
                        <?php include 'cart_partial.php' ?>
                    </div>
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li>
                        <a href="<?php echo $rootPath; ?> ">Trang chủ</a>
                    </li>
                    <li>
                        Giới thiệu
                    </li>
                    <li>
                        <a href=" <?php echo $rootPath . "/pages/san_pham.php"; ?>">Sản phẩm</a>
                    </li>
                    <li>
                        Blog
                    </li>
                    <li>
                        Liên hệ
                    </li>
                    <li>
                        Thương hiệu
                    </li>
                    <li>
                        Bài tập nhóm
                    </li>
                </ul>
            </div>
        </div>
        <div class="body" style="margin-top: 150px">