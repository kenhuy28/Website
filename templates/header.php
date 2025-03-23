<?php
$fileName = basename($_SERVER['SCRIPT_FILENAME']);
echo $fileName;
$rootPath = ".";
if ($fileName != "index.php") {
    $rootPath = "..";
}
echo $rootPath;
include $rootPath . '/includes/config.php';
include $rootPath . '/includes/update_cart_first.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T1 Store</title>
    <link rel="icon" href=<?php echo $rootPath . "/assets/img/logo/header_logo.png" ?> type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/base.css" ?> ">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/main2.css" ?>">
    <link rel="stylesheet" href="<?php echo $rootPath . "/assets/css/main3.css" ?>">
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
    :root {
    --with--left: 230px;
    --main--color: #a12424;
    --catalog--color: #f7c947;
}

        /* Bỏ gạch chân */
        a {
            text-decoration: none;
        }

        /* Chuyển màu chữ sang màu trắng */
        a:link,
        a:visited {
            color: #FFFFFF;
        }
        .search {
    width: 450px;
    height: 48px;
    
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<script>
    function updateCountCart() {
        jQuery.ajax({
            url: '<?php echo $rootPath . "/includes/update_count_cart.php"; ?>', // Đường dẫn đến tệp xử lý PHP trên máy chủ
            type: 'POST',
            data: { maKhachHang: '<?php echo $_SESSION["taiKhoan"]["maKhachHang"] ?>' },
            success: function (response) {
                var count = document.querySelector('#count_cart');
                count.textContent = response;
                console.log(response);
            }
        });
    }
    $(document).ready(function () {
        updateCountCart();
    });
</script>

<div class="app">
    <div id="notifacation_all">
        <h6>Thêm sản phẩm thành công</h6>
    </div>
    <div class="gird">
        
        <div class="header">
            <div class="header_row1">
                <div class="header_row1_left">
                <div class="logo">
    <a href="<?php echo $rootPath ?>" style="display: flex; align-items: center;">
        <img src="<?php echo $rootPath . '/assets/img/logo/t1.png'; ?>" alt="" style="width: 100px; height: auto; margin-right: 10px;">
        <span style="font-family: 'Roboto', sans-serif; font-size: 36px; font-weight: bold; font-style: italic; color: #ffffff; text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);">
    T1 Store
</span>

    </a>
</div>
                </div>
                <div class="header_row_right">
                    <form action="<?php echo $rootPath ?>/pages/search_page.php" class="search" method="GET"
                        enctype="multipart/form-data">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="SearchString">
                        <button class="search_icon" style="border: none">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <div class="hotline">
                        <h5 class="name_icon">Gọi mua hàng</h5>
                        <h5 class="hotline_sdt" style="font-weight: 600;">0703564981</h5>
                    </div>
                    <!-- <div class="h">
                        <div class="name_icon">
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <h5>Wishlist</h5>
                    </div> -->
                    <?php
                    // nếu chưa login
                    if (empty($_SESSION["taiKhoan"])) {
                        echo '<a href="' . $rootPath . '/pages/login.php" class="h" id="login_user">
                                    <div>
                                        <div class="name_icon">
                                            <i class="fa-regular fa-user"></i>
                                        </div>
                                        <h5>
                                            Đăng nhập
                                        </h5>
                                    </div>
                                </a>';
                    } else {
                        // nếu đã login
                    
                        echo '<div class="h" id="profile_user">
                                <div class="name_icon">
                                    <i class="fa-regular fa-user"></i>
                                </div>

                                <h5>' .
                            $_SESSION["taiKhoan"]["hoKhachHang"] . " " . $_SESSION["taiKhoan"]["tenKhachHang"] .
                            '</h5>
                            </div>';
                    }
                    ?>


                    <!-- giỏ hàng -->
                    <div class="h" id="cart">
                        <a href="<?php echo $rootPath . "/pages/cart.php"; ?>">
                            <div class="name_icon catalog">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div <?php echo (empty($_SESSION['taiKhoan']) ? 'hidden' : "") ?> class="dem_hang">
                                    <p id="count_cart">
                                        <?php echo (empty($_SESSION['gioHang']) ? '0' : $_SESSION['gioHang']) ?>
                                    </p>
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
                        <a href=" <?php echo $rootPath . "/pages/product_page.php"; ?>">Sản phẩm</a>
                    </li>
                    <li>

                        <a href=" <?php echo $rootPath . "/pages/brand.php"; ?>">Thương hiệu</a>
                    </li>

                    <li>
                        <a href=" <?php echo $rootPath . "/pages/contact_to_shop_page.php"; ?>">Liên hệ</a>
                    </li>
                    <li>
                        <a href=" <?php echo $rootPath . "/pages/intro.php"; ?>">Về chúng tôi</a>
                    </li>
                    

                 
                </ul>
            </div>
        </div>
        <div class="body" style="margin-top: 150px; min-width: 700px;">