<?php
include '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi - T1 Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .about-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .about-container h2 {
            color: #cc1a1a;
            margin-bottom: 10px;
            text-align: center;
        }

        .about-container p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .product-categories img {
            width: 165px;
            height: auto;
            margin: 10px;
            border-radius: 10px;
        }

        .promo-banner {
            text-align: center;
            margin-top: 20px;
        }

        .promo-banner img {
            width: 100%;
            max-width: 800px;
            border-radius: 10px;
            margin-bottom: 20px;
        }


        .loyalty-program h3 {
            color: #28a745;
            margin-bottom: 10px;
        }

        .loyalty-program p {
            font-size: 16px;
        }
        .loyalty-program ul {
    list-style: none; /* Bỏ dấu chấm đầu dòng */
    padding: 0;
    margin: 20px auto;
    text-align: left; /* Đảm bảo văn bản căn trái */
    width: 80%; /* Đặt chiều rộng để căn giữa */
}

.loyalty-program ul li {
    font-size: 16px;
    line-height: 1.8;
    color: #b30000;
    display: flex; 
    align-items: center; 
    margin: 5px 0;
}

.loyalty-program ul li i { 
    width: 30px;
    height: 30px;
    margin-right: 10px; 
    display: inline-block;
}

.loyalty-program ul li span {
    flex-grow: 1; 
}


    </style>
</head>
<body>


<div class="about-container">
    <h2>Chào mừng đến với T1 Store!</h2>
    <p>
        T1 Store là cửa hàng điện tử hàng đầu chuyên cung cấp các sản phẩm chính hãng như điện thoại, laptop, đồng hồ, máy in, bàn phím, chuột, và camera. 
        Chúng tôi hợp tác với các thương hiệu nổi tiếng như <strong>Apple, Xiaomi, Samsung</strong>, mang đến cho khách hàng sự lựa chọn đa dạng và đáng tin cậy.
    </p>

    <h2>Các sản phẩm nổi bật</h2>
    <div class="product-categories">
        <img src="https://cdn.tgdd.vn/Products/Images/42/329149/iphone-16-pro-max-black-thumb-600x600.jpg" alt="Điện Thoại">
        <img src="https://cdn.tgdd.vn/Products/Images/44/325242/dell-inspiron-15-3520-i5-n5i5052w1-thumb-600x600.jpg" alt="Laptop">
        <img src="https://cdn.tgdd.vn/Products/Images/7077/313840/befit-watch-s-day-silicone-xam-tn-600x600.jpg" alt="Đồng Hồ">
        <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Products/Images/4728/319642/camera-ip-360-do-2mp-tiandy-tc-h322n-thumb-1-638665858822811853-600x600.jpg" alt="Camera">
        <img src="https://cdn.tgdd.vn/Products/Images/4547/243200/co-day-gaming-razer-huntsman-tournament-edition-thumb-600x600.jpeg" alt="Bàn Phím">
        <img src="https://cdn.tgdd.vn/Products/Images/86/311113/chuot-bluetooth-silent-logitech-m240-thumb-600x600.jpg" alt="Điện Thoại">
    </div>

    <div class="promo-banner">
        <h2>Chương trình khuyến mãi</h2>
        <img src="https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/d1/7b/d17b0c28258037a13bae88d5ba2799c9.png" alt="Banner Giảm Giá">
        <p>Với mỗi 1 triệu đồng mua hàng, quý khách sẽ được giảm 1% tổng giá trị đơn hàng. Ngoài ra, bạn có thể tích điểm và đổi quà với hệ thống tích lũy của chúng tôi.</p>
    </div>

    <div class="loyalty-program">
    <h3>Hệ thống tích điểm</h3>
    <p>
        - Mỗi 1.000.000 VND sẽ được quy đổi thành 1 điểm.  
        - Điểm tích lũy có thể sử dụng để giảm giá hoặc đổi lấy phần thưởng hấp dẫn.  
        - Tích điểm dễ dàng, đổi quà thoải mái!  
    </p>
    <p>
        Khi tích lũy điểm, bạn sẽ đạt được các cấp bậc tương ứng:  
        <ul>
    <li><i class="fas fa-medal" style="color: #cd7f32;"></i>**10 điểm**: Cấp bậc *Đồng*</li>
    <li><i class="fas fa-medal" style="color: #c0c0c0;"></i> **20 điểm**: Cấp bậc *Bạc*</li>
    <li><i class="fas fa-medal" style="color: #ffd700;"></i> **30 điểm**: Cấp bậc *Vàng*</li>
    <li><i class="fas fa-gem" style="color: #b9f2ff;"></i> **40 điểm**: Cấp bậc *Bạch Kim*</li>
    <li><i class="fas fa-diamond" style="color: #e5e4e2;"></i> **50 điểm**: Cấp bậc *Kim Cương*</li>
    <li><i class="fas fa-crown" style="color: #ffdf00;"></i> **80 điểm**: Cấp bậc *Cao Thủ*</li>
    <li><i class="fas fa-fire" style="color: #ff4500;"></i> **100 điểm**: Cấp bậc *Thách Đấu*</li>
</ul>
    </p>
</div>
</div>

</body>
</html>

<?php include '../templates/footer.php' ?>