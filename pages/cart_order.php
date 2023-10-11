<?php include '../templates/header.php' ?>
<div class="thanhToan">
    <div class="thanhToan_user">
        <form action="">
            <h1 class="Title_Admin_create_form">Thông tin đơn đặt hàng</h1>
            <p class="Notification_create_form">Vui lòng kiểm tra thông tin</p>
            <div style="display: flex;">
                <div class="form_field" style="margin-right: 20px; ">
                    <label for="" class="name_form_field">Họ tên: </label>
                    <input type="text" value="@HOTENKH" class="textfile" id="fullname"
                        style="width: 400px; border-radius: 10px;">
                    <span class="error_message"></span>
                </div>
                <div class="form_field">
                    <label for="" class="name_form_field">Số điện thoại: </label>
                    <input type="text" value="@DIENTHOAI" class="textfile" id="phoneNumber"
                        style="width: 180px;  border-radius: 10px;">
                    <span class="error_message"></span>
                </div>
            </div>

            <div class="form_field">
                <label for="" class="name_form_field">Email: </label>
                <input type="text" value="@EMAIL" class="textfile" id="email"
                    style="width: 600px; border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Địa chỉ: </label>
                <textarea class="textfile_address" cols="2" id="address"
                    style="width: 600px;  border-radius: 10px;">@DiaChi</textarea>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Chọn phương thức thanh toán: </label>
                <select class="textfile" style="width: 400px; border-radius: 10px;">
                    <option>Thanh toán khi nhận hàng</option>
                    <option>Thanh toán bằng hình thức chuyển khoản</option>
                </select>
            </div>
            <div class="button">
                <input type="submit" value="Đặt hàng" class="button_add_admin" style="width: 200px;" />
                <input type="button" value="Quay trở lại giỏ hàng" class="button_add_admin" style="width: 200px; " />
            </div>
        </form>
    </div>
    <div class="thanhToan_cart">
        <h1 class="Title_Admin_create_form" style="font-size: 26px;">Thông tin chi tiết đơn hàng</h1>
        <?php
        //foreach ($variable as $key => $value) 
        {
            # code...
        } ?>
        <div class="thanhToan_cart_list_item">
            <img src="../assets/img/sanpham/1_7ee6dfab-63fe-4317-a0b3-37d951d024c3.png" alt=""
                style="width: 64px; height: 66px; margin-right: 20px;">
            <div class="thanhToan_cart_list_item_title" style="max-width: 250px;">
            Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ
            </div>
            <div class="thanhToan_cart_list_item_soluong" style="min-width: 50px; margin-left: 10px;">
                6
            </div>
            <div class="thanhToan_cart_list_item_gia" style="min-width: 100px;">
                480.000 VNĐ
            </div>
        </div>
        <!-- } -->
        <div class="thanhToan_cart_tong">Tổng tiền: 480.000 VNĐ</div>
    </div>
</div>
<?php include '../templates/footer.php' ?>