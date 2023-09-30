<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ kiện thú cưng</title>
    <link rel="icon" href="./assets/img/logo/header_logo.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main2.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-6.1.2-web/css/all.css" />
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
                    <div class="h" id="login_user">
                        <div class="name_icon">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <h5>
                            Đăng nhập
                        </h5>
                    </div>
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
                        giohang
                    </div>
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li>
                        Trang chủ
                    </li>
                    <li>
                        Giới thiệu
                    </li>
                    <li>
                        Sản phẩm
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
                </ul>
            </div>
        </div>