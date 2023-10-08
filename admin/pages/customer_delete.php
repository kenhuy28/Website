<?php include '../templates/nav_admin1.php' ?>


<div class="detail_admin">
    <h1 class="Title_Admin_create_form">Bạn có muốn xóa khách hàng này ?</h1>
    <!-- @using (Html.BeginForm("Delete", "KhachHang", FormMethod.Post, new { @enctype = "multipart/form-data" }))
    { -->
        <form action="">
        <div class="detai_admin_form">
            <!-- @if (Model.HINHANH != null)
            {
                <div class="detail_admin_left">
                    <img src="~/assest/img/khach_hang/@Model.HINHANH" alt="">
                </div>
            }
            else
            { -->
                <div class="detail_admin_left">
                    <img src="../../assets/img/khach_hang/images.jpg" alt="">
                </div>
            <!-- } -->

            <div class="detail_admin_right">
                <table class="Table_Details_Admin">
                    <tr>
                        <td>Mã khách hàng: </td>
                        <td>@MAKH</td>
                    </tr>
                    <tr>
                        <td>Họ tên Khách hàng:</td>
                        <td>@HOTENKH</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại :</td>
                        <td>@DIENTHOAI</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td>@Diachi</td>
                    </tr>

                    <tr>
                        <td>Email :</td>
                        <td>@EMAIL</td>
                    </tr>
                    <tr>
                        <td>Ngày sinh :</td>
                        <td>@NGAYSINH </td>
                    </tr>
                </table>

            </div>

        </div>
        <div class="button">
            <input type="button" value="Xóa" class="button_add_admin delete_display_alert" />
            <a href="@Url.Action("Index","KhachHang")"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
        <div class="alert_delete">
            <div class="notification">
                <h1 class="notification_title">Xác nhận xóa khách hàng!</h1>
                <input type="submit" value="Xóa" class="alert_delete_btn delete_conform" />
                <input type="button" value="Không" class="alert_delete_btn delete_cancel" />
            </div>
        </div>
        </form>
</div>
<!-- <script>
    const load = document.querySelector.bind(document);
    const alert_delete_btn = load(".delete_display_alert");
    const alert_delete_conform_btn = load(".delete_conform");
    const alert_delete_cancel_btn = load(".delete_cancel");
    const alert_delete = load(".alert_delete");
    alert_delete_btn.onclick = () => {
        alert_delete.style.display = "block";
    };
    alert_delete_cancel_btn.onclick = () => {
        alert_delete.style.display = "none";
    };
</script> -->

<?php include '../templates/nav_admin2.php' ?>
