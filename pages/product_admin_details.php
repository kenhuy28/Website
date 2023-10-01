<?php include '../templates/nav_admin1.php' ?>
<div class="body" style="margin-top: 15px">
    <div class="detail_admin">
        <h1 class="Title_Admin_create_form">Thông tin sản phẩm</h1>
        <div class="detai_admin_form">
            <div class="detail_admin_left">
                <img src="https://webkit.org/demos/srcset/image-src.png" alt="">
            </div>
            <div class="detail_admin_right">
                <table class="Table_Details_Admin">
                    <tr>
                        <td>Mã sản phẩm: </td>
                        <td>@Model.MASP</td>
                    </tr>
                    <tr>
                        <td>Tên sản phẩm:</td>
                        <td>@Model.TENSP</td>
                    </tr>
                    <tr>
                        <td>Đơn giá mua:</td>
                        <td>@Model.DONGIAMUA</td>
                    </tr>
                    <tr>
                        <td>Đơn giá bán :</td>
                        <td>@Model.DONGIABAN</td>
                    </tr>
                    <tr>
                        <td>Thương hiệu :</td>
                        <td>@Model.THUONGHIEU.TENTH</td>
                    </tr>
                    <tr>
                        <td>Loại sản phẩm :</td>
                        <td>@Model.LOAI.TENLOAI</td>
                    </tr>
                    <tr>
                        <td>Số lượng :</td>
                        <td>@Model.SOLUONG</td>
                    </tr>
                    <tr>
                        <td>Mô tả :</td>
                        <td style="max-width: 200px;">@Model.MOTA</td>
                    </tr>
                </table>

            </div>

        </div>
        <div class="button">
            <a href="product_edit.php"><input type="submit" value="Chỉnh sửa" class="button_add_admin" /></a>
            <a href="product_index.php"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>

    </div>
</div>
<?php include '../templates/nav_admin2.php' ?>