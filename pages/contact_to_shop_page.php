<!--contact-->
<?php include '../templates/header.php' ?>
<div class="liehHe">
    <div class="liehHe_left">

        <h5>Liên hệ Shop</h5>
        <p>Chúng tôi luôn sẵn sàng lắng nghe bạn! Nếu bạn có bất kỳ thắc mắc hoặc yêu cầu nào, hãy liên hệ với chúng tôi qua các thông tin dưới đây:</p>
        <ul>
            <li><strong>Địa chỉ:</strong>  T1 Store 131A - 133 Cách Mạng Tháng 8 , Ninh Kiều, Cần Thơ</li>
            <li><strong>Email: </strong>huyb2016967@student.ctu.edu.vn</li>
            <li><strong>Số điện thoại:</strong> (+84) 703565981</li>
            <li><strong>Thời gian làm việc:</strong> 8:00 - 17:00 (Thứ 2 - Thứ 7)</li>
        </ul>
        <p>Ngoài ra, bạn có thể theo dõi chúng tôi qua các kênh mạng xã hội:</p>
        <ul class="social-links">
    <li>
        <a href="https://facebook.com/shop" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook Logo">
            Facebook
        </a>
    </li>
    <li>
        <a href="https://instagram.com/shop" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram Logo">
            Instagram
        </a>
    </li>
    <li>
        <a href="https://linkedin.com/company/shop" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ca/LinkedIn_logo_initials.png" alt="LinkedIn Logo">
            LinkedIn
        </a>
    </li>
</ul>
    </div>
    <div class="liehHe_right">
        <h5>Bản đồ</h5>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.8414543770723!2d105.76804037362456!3d10.029938972521718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2sCan%20Tho%20University!5e0!3m2!1sen!2sus!4v1733316111437!5m2!1sen!2sus"
            width="600" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
<?php include '../templates/footer.php' ?>
<style>
    .social-links {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 15px;
    }

    .social-links li {
        display: flex;
        align-items: center;
    }

    .social-links a {
        text-decoration: none;
        color: #555; /* Màu chữ mặc định */
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px; /* Khoảng cách giữa logo và chữ */
        transition: color 0.3s ease; /* Hiệu ứng đổi màu */
    }

    .social-links a:hover {
        color: #0073e6; /* Màu chữ khi hover */
    }

    .social-links img {
        width: 24px; /* Kích thước logo */
        height: 24px;
    }
</style>