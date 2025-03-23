<?php
$fileName = basename($_SERVER['SCRIPT_FILENAME']);
// echo $fileName . "</br>";
session_start();
ob_start();
$_SESSION['rootPath'] = ".";
// $_SESSION['rootPath'] = ".";
if ($fileName != "index.php") {
    $_SESSION['rootPath'] = "..";
}
// echo $_SESSION['rootPath'];
include $_SESSION['rootPath'] . '/includes/config.php';
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/logo/header_logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="<?php echo $_SESSION['rootPath'] . "/assets/css/base.css" ?> ">
    <link rel="stylesheet" href="<?php echo $_SESSION['rootPath'] . "/assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?php echo $_SESSION['rootPath'] . "/assets/css/grid.css" ?>">
    <link rel="stylesheet" href="<?php echo $_SESSION['rootPath'] . "/assets/css/responsive.css" ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,600;0,700;0,800;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <style>
        .right {
            overflow-y: auto;
            max-height: 100vh;
        }
        .left {
            width: var(--with--left);
            background-color: #CC3333;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh; /* Sử dụng 100vh để đảm bảo chiều cao đầy đủ */
            padding: 20px;
            overflow-y: auto; /* Thêm thuộc tính này để cho phép cuộn dọc */
}

    </style>
</head>
<div class="app">
    <div class="grid">
        <div class="left">
            <div class="nav">
            <div class="nav_logo">
        <a href="#">
        <img src="<?php echo $_SESSION['rootPath'] . '/assets/img/logot1.png'; ?>" alt="logo" class="logo">
        </a>
    </div>
        <style>
        .nav_logo img.logo {
        width: 190px;  /* Chiều rộng mong muốn */
        height: 50px;  /* Chiều cao mong muốn */
        background: #CC3333;  /* Màu nền nếu hình ảnh không hiển thị */
        object-fit: cover; /* Giúp hình ảnh không bị méo */
        }
         </style>

            </div>
            <ul class="nav_ul">
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath']; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <div class="nav_li_title">
                            Trang chủ
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/Admin_DsAdmin.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-blender-phone"></i>
                        </div>
                        <div class="nav_li_title">
                            Quản lý nhân viên
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/Order_Index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <div class="nav_li_title">
                            Đơn đặt hàng
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/brand_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-trademark"></i>
                        </div>
                        <div class="nav_li_title">
                            Thương hiệu
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/customer_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-brands fa-dashcube"></i>
                        </div>
                        <div class="nav_li_title">
                            Khách hàng
                        </div>

                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/type_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-bookmark"></i>
                        </div>
                        <div class="nav_li_title">
                            Loại sản phẩm
                        </div>

                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/product_stock_status.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div class="nav_li_title">
                            Kho hàng
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/entry_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <div class="nav_li_title">
                            Nhập kho
                        </div>

                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/product_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-brands fa-dropbox"></i>
                        </div>
                        <div class="nav_li_title">
                            Sản phẩm
                        </div>

                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/discount.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <div class="nav_li_title">
                            Giảm giá
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/comments.php"; ?>">
        <div class="nav_li_icon">
            <i class="fa-solid fa-comments"></i> <!-- Thay đổi icon nếu cần -->
                    </div>
                        <div class="nav_li_title">
            Bình luận
            </div>
                </a>
                </li>

                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/statistics_index.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-bug"></i>
                        </div>
                        <div class="nav_li_title">
                            Thống kê
                        </div>
                    </a>
                </li>

                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/confirm_requests.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-bug"></i>
                        </div>
                        <div class="nav_li_title">
                            Xác nhận 
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/approve.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-bug"></i>
                        </div>
                        <div class="nav_li_title">
                            Phê duyệt 
                        </div>
                    </a>
                </li>
                <li class="nav_li">
                    <a href="<?php echo $_SESSION['rootPath'] . "/pages/request_entry.php"; ?>">
                        <div class="nav_li_icon">
                            <i class="fa-solid fa-bug"></i>
                        </div>
                        <div class="nav_li_title">
                            Yêu cầu 
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="right">
            <div class="header">
                <div class="header_left">
                </div>
                <div class="header_right">
                    <span class="header_right_hello">Xin chào
                        <?php echo $_SESSION['admin']->ho . ' ' . $_SESSION['admin']->ten; ?>
                    </span>
                    <div class="header_right_img">
                        <img src="<?php echo $_SESSION['rootPath'] . "/../assets/img/ad_user/" . $_SESSION['admin']->avatar; ?>"
                            alt="">
                    </div>
                    <div class="header_right_img_expand">
                        <ul>
                            <li>
                                <i class="fa-solid fa-user"></i><a
                                    href="<?php echo $_SESSION['rootPath'] . "/pages/Admin_Details.php" ?>">Xem thông
                                    tin cá nhân</a>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <div>
                                    <?php echo $_SESSION['admin']->email ?>
                                </div>
                            </li>
                            <li>
                                <i class="fa-solid fa-lock"></i><a
                                    href="<?php echo $_SESSION['rootPath'] . "/pages/Admin_ChangePass.php" ?>">Đổi mật
                                    khẩu</a>
                            </li>

                            <li class="header_right_img_expand_logout">
                                <a href="<?php echo $_SESSION['rootPath'] . "/includes/log_out.php"; ?>"
                                    style="color: white;">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="body">