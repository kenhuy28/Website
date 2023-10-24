<?php include '../templates/header.php' ?>
<h6 >Trang Chủ > Giỏ Hàng Của Bạn</h6>

<div class="cart_title">GIỎ HÀNG CỦA BẠN</div>
<div class="yellow_space"></div>
<div class="cart">
    <div class="cart_table">
        <div class="header_table">
            <div class="header_table_title" style="width: 40%;">
                SẢN PHẨM
            </div>
            <div class="header_table_title" style="width: 15%">
                GIÁ
            </div>
            <div class="header_table_title" style="width: 15%">
                SỐ LƯỢNG
            </div>
            <div class="header_table_title" style="width: 15%">
                GIẢM GIÁ
            </div>
            <div class="header_table_title" style="width: 10%">
                THÀNH TIỀN
            </div>
            <div class="header_table_title" style="width: 5%">

            </div>
        </div>
        <div class="body_table">
            <?php
            //foreach ($variable as $key => $value) {
            # code...
            ?>
            <div class="body_table_item">
                <div class="body_table_title body_table_title_sanpham" style="width: 37%;">
                    <img src="../assets/img/sanpham/hat-cho-anf-6free.png" alt="" style="height: 120px; width: 90px;">
                    <div class="decription_product">
                        <div>
                            <a href="" class="title_product_cart" style="color: black">
                                Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ
                            </a>
                        </div>
                        <div style="margin-top: 10px;">
                            <a href="" class="th_product_cart" style="color: #0b84ee; font-weight: 700; ">
                                ANF
                            </a>
                        </div>

                    </div>
                </div>
                <div class="body_table_title" style="width: 15%; font-weight: 700;">
                    80.000 VNĐ
                </div>
                <div class="body_table_title " style="width: 15%">
                    <div class="body_table_title_soluong">
                        <div onclick="window.location.href='@Url.Action(" botSanPhamGiohang", "GioHang" , new {
                            @iMASP=item.iMASP, @strURL=Request.Url.ToString() })'">
                            <i class="fa-solid fa-minus"></i>
                        </div>
                        <div>
                            6
                        </div>
                        <div onclick="window.location.href='@Url.Action(" ThemGiohang", "GioHang" , new {
                            @iMASP=item.iMASP, @strURL=Request.Url.ToString() })'">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                </div>
                <div class="body_table_title" style="width: 15%">
                    10 %
                </div>
                <div class="body_table_title" style="width: 10%; font-weight: 700; ">
                    480.000 VNĐ
                </div>
                <div class="body_table_title" style="min-width: 5%;" onclick="window.location.href='@Url.Action("
                    XoaGiohang", "GioHang" , new { @iMASP=item.iMASP })'">
                    <i class="fa-solid fa-x"></i>
                </div>
            </div>


        </div>
    </div>
    <div class="cart_checkcout" style="width: 350px;">
        <h6 style="margin-top: 0">TỔNG SỐ TIỀN</h6>
        <div class="cart_checkcout_title">
            <div>Tổng số tiền:</div>
            <div>480.000 VNĐ</div>
        </div>
        <a href="<?php  echo $rootPath . "/pages/cart_order.php"; ?> "><button>Đặt Hàng</button></a>
        <a href="<?php  echo $rootPath . "/pages/product_page.php"; ?> "><button>Tiếp Tục Mua Sắm</button></a>
        <button onclick="window.location.href = '@Url.Action(" XoaTatcaGiohang", "GioHang" )'">Xóa Tất Cả Sản
            Phẩm</button>
    </div>

</div>
<textarea name="" id="" rows="5" class="note_cart" placeholder="Ghi chú khi mua hàng......."></textarea>




<?php include '../templates/footer.php' ?>