<?php
$fileName = basename($_SERVER['SCRIPT_FILENAME']);
echo $fileName;
$rootPath = ".";
if ($fileName != "index.php") {
    $rootPath = "..";
}
echo $rootPath;
include $rootPath . '/includes/config.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ kiện thú cưng</title>
    <link rel="icon" href="./assets/img/logo/header_logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/base.css" ?> ">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/main2.css" ?>">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/grid.css" ?>">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/responsive.css" ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
                        <img src="<?php echo $rootPath . "/assets/img/logo/logopaddy.png"; ?>" alt="">
                    </div>
                </div>
                <div class="header_row_right">
                    <form action="../pages/search_page.php" class="search" method = "GET">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="SearchString">
                        <button class="search_icon" style="border: none">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <div class="hotline">
                        <h5 class="name_icon">Hotline</h5>
                        <h5 class="hotline_sdt" style="font-weight: 600;">0347 69 33 33</h5>
                    </div>
                    <!-- <div class="h">
                        <div class="name_icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <h5>Wishlist</h5>
                    </div> -->

                    <!-- nếu chưa login -->
                    <a href="<?php echo $rootPath . "/pages/login.php"; ?>" class="h" id="login_user">
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
                        <a href="<?php echo $rootPath . "/pages/cart.php"; ?>">
                            <div class="name_icon catalog">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="dem_hang">
                                    <p>3</p>
                                </div>
                            </div>
                            <h5>Giỏ Hàng</h5>
                        </a>
                    </div>
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li>
                        <a href="<?php echo $rootPath; ?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href=" <?php echo $rootPath . "/pages/contact_to_shop_page.php"; ?>">Liên hệ</a>
                    </li>
                    <li>
                        <a href=" <?php echo $rootPath . "/pages/product_page.php"; ?>">Sản phẩm</a>
                    </li>
                    <li>
                        <a href=" <?php echo $rootPath . "/pages/brand.php"; ?>">Thương hiệu</a>
                    </li>

                    <li>
                        <a href=" <?php echo $rootPath . "/pages/bt_nhom.php"; ?>"> Bài tập nhóm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="body" style="margin-top: 150px">