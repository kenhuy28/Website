<!--payment page-->
<?php include '../templates/header.php' ?>
<div class="thanhToan">
    <div class="thanhToan_user">
        <form action="">
            <h1 class="Title_Admin_create_form">Thông tin đơn đặt hàng</h1>
            <p class="Notification_create_form">Vui lòng kiểm tra thông tin</p>
            <div style="display: flex;">
                <div class="form_field" style="margin-right: 20px; ">
                    <label for="" class="name_form_field">Họ tên: </label>
                    <input type="text" class="textfile" id="fullname" name="HOTENKH"
                        style="width: 400px; border-radius: 10px;">
                    <span class="error_message"></span>
                </div>
                <div class="form_field">
                    <label for="" class="name_form_field">Số điện thoại : </label>
                    <input type="text" class="textfile" id="phoneNumber" name="DIENTHOAI"
                        style="width: 180px;  border-radius: 10px;">
                    <span class="error_message"></span>
                </div>
            </div>

            <div class="form_field">
                <label for="" class="name_form_field">Email : </label>
                <input type="text" class="textfile" id="email" name="EMAIL" style="width: 600px;">
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Địa chỉ : </label>
                <textarea class="textfile_address" cols="2" id="address" name="DAICHI"
                    style="width: 600px;  border-radius: 10px;"></textarea>
                <span class="error_message"></span>
            </div>
            <div class="form_field">
                <label for="" class="name_form_field">Chọn phương thức thanh toán : </label>
                <input type="text" class="textfile" id="email" name="EMAIL" style="width: 400px;  border-radius: 10px;">
                <span class="error_message"></span>
            </div>
            <div class="button">
                <input type="submit" value="Đặt hàng" class="button_add_admin" style="width: 200px;" />
                <input type="button" value="Quay chở lại giỏ hàng" class="button_add_admin" style="width: 200px; " />
            </div>

        </form>
    </div>
    <div class="thanhToan_cart">
        <h1 class="Title_Admin_create_form" style="font-size: 26px;">Thông tin chi tiết đơn hàng</h1>
        <div class="thanhToan_cart_list_item">
            <img src="/assest/img/img_product/12-1682483525450_1066x.webp" alt=""
                style="width: 64px; height: 66px; margin-right: 20px;">
            <div class="thanhToan_cart_list_item_title" style="max-width: 250px;">
                Smartheart - treat healthy hip happy joint 100g
            </div>
            <div class="thanhToan_cart_list_item_soluong" style="min-width: 50px; margin-left: 10px;">
                1
            </div>
            <div class="thanhToan_cart_list_item_gia" style="min-width: 100px;">
                19,000 VNĐ
            </div>
        </div>
        <div class="thanhToan_cart_tong">Tổng cộng: 19,000 VNĐ</div>
    </div>
</div>
<?php include '../templates/footer.php' ?>