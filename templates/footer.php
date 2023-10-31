</div>
<div class="footer">
    <div class="footter_row">
        <h1>Shop</h1>
        <ul>
            <li>
                Danh Cho Chó
            </li>
            <li>
                Danh Cho Mèo
            </li>
            <li>
                <a href=" <?php echo $rootPath . "/pages/brand.php"; ?>">Thương hiệu</a>
            </li>
       </ul>
    </div>
    <div class="footter_row">
        <h1>Paddy Pet Shop</h1>
        <ul>
            <li>
                Điều Khoản Sử Dụng
            </li>
            <li>
                Tuyển Dụng
            </li>
        </ul>
    </div>
    <div class="footter_row">
        <h1>Hỗ Trợ Khách Hàng</h1>
        <ul>
            <li>
                Chính Sách Đổi Trả Hàng
            </li>
            <li>
                Phương Thức Vận Chuyển
            </li>
            <li>
                Chính Sách Bảo Mật
            </li>
            <li>
                Phương Thức Thanh Toán
            </li>
            <li>
                Chính Sách Hoàn Tiền
            </li>
        </ul>
    </div>
    <div class="footter_row">
        <h1>Liên Hệ</h1>
        <ul>
            <li>
                CÔNG TY CỔ PHẦN THUƠNG MẠI & DỊCH VỤ PADDY
            </li>
            <li>
                116 Nguyễn Văn Thủ, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh, Việt Nam
            </li>
            <li>
                <i class="fa-solid fa-phone"></i> Hotline: 0347693333
            </li>
            <li>
                <i class="fa-solid fa-envelope"></i> Email: marketing@paddy.vn
            </li>
        </ul>
    </div>
</div>
</div>
<div class="mangXaHoi">
    <a href="https://www.facebook.com/nam.phamphuong.792/" target="_blank">
        <div class="mangXaHoi_item Facebook">
            <div>
                <i class="fa-brands fa-facebook" style="color: #0b84ee;"></i>
            </div>
            <span>Facebook</span>
        </div>
    </a>
    <a href="https://www.messenger.com/t/100012184808640" target="_blank">
        <div class="mangXaHoi_item Messenger">
            <div>
                <i class="fa-regular fa-message" style="color: #e34aaa;"></i>

            </div>
            <span>Messenger</span>
        </div>
    </a>
    <a href="https://www.youtube.com/channel/UCq3vEyjTLa69K0dVHVStWqQ" target="_blank">
        <div class="mangXaHoi_item Youtube">
            <div>
                <i class="fa-brands fa-youtube" style="color: #FF0000;"></i>

            </div>
            <span>Youtube</span>
        </div>
    </a>
    <a href="javascript:void(0)">
        <div class="mangXaHoi_item Top" onclick="window.scrollTo(0, 0)">
            <div>
                <i class="fa-solid fa-arrow-up" style="color: black;"></i>
            </div>
            <span>Top</span>
        </div>
    </a>

</div>
<div class="hotline-phone-ring-wrap" style="margin-bottom:50px">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="tel:0347693333" class="pps-btn-img">
                <img src="https://nguyenhung.net/wp-content/uploads/2019/05/icon-call-nh.png" alt="Gọi điện thoại"
                    width="50">
            </a>
        </div>
    </div>
    <div class="hotline-bar">
        <a href="tel:0347693333">
            <span class="text-hotline">0347 69 33 33</span>
        </a>
    </div>
</div>
</div>
<!-- nếu đã login -->
<!-- <div class="login_flex" id="login_flex">
            <div class="login_flex_right" id="login_flex_right">
                <div class="login_flex_right_title" style="margin: 10px 0 30px 0;">
                    <h6>Thông tin tài khoản</h6>
                    <div id="exit_login_flex">
                        <i class="fa-solid fa-x"></i>
                    </div>
                </div>
                <div style="display: flex; justify-content: center;align-items: center; border-radius: 50%;">
                    @if (kh.HINHANH != null)
                    {
                        <img src="./assets/img/khach_hang/@kh.HINHANH" alt="" style="width: 150px; height: 150px; text-align: center;">
                    }
                    else
                    {
                        <img src="./assets/img/banner/Default_pfp.svg.png" alt="" style="width: 150px; height: 150px; text-align: center;">
                    }

                </div>
                <div class="thonTinKhac">
                    <h5><span>Tên: </span>@kh.HOTENKH</h5>
                </div>
                <div class="thonTinKhac">
                    <h5><span>Số điện thoại: </span>@kh.DIENTHOAI</h5>
                </div>
                <div class="thonTinKhac">
                    <h5><span>Địa chỉ: </span>@Session["DiaChi"]</h5>
                </div>
                <div class="thonTinKhac" style="margin: 0 0 40px 0;">
                    <h5><span>Email: </span>@kh.EMAIL</h5>
                </div>
                <a href="@Url.Action("dangxuat", "Users")"><input type="submit" value="Chỉnh sửa thông tin" class="button_add_admin" /></a>
                <a href="@Url.Action("dangxuat", "Users")"><input type="submit" value="Đổi mật khẩu" class="button_add_admin" /></a>
                <a href="@Url.Action("dangxuat", "Users")"><input type="submit" value="Đăng xuất" class="button_add_admin" /></a>
            </div>
        </div> -->

<!-- <script>
    const $ = document.querySelector.bind(document);
    const login_user = $("#profile_user");
    const login_flex = $("#login_flex");
    const exit_login_flex = $("#exit_login_flex");
    const login_flex_right = $("#login_flex_right");
    var isLogin_flex = false;
    login_user.onclick = () => {
        isLogin_flex = true;
        login_flex.style.display = "block";
        login_flex_right.style.right = "0";

    };
    exit_login_flex.onclick = () => {
        isLogin_flex = false;
        login_flex.style.display = "none";
        login_flex_right.style.right = "-360px";
    };


</script> -->


<script src="../assets/js/app.js"></script>