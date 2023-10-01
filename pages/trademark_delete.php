<?php include '../templates/nav_admin1.php' ?>
<div class="body" style="margin-top: 15px">
    <div class="detail_admin">
        <h1 class="Title_Admin_create_form">Bạn có muốn xóa thương hiệu này ?</h1>
        <form action="" method="post">
            <div class="detai_admin_form">
                <div class="detail_thuonghieu_left">
                    <img src="https://webkit.org/demos/srcset/image-src.png" alt="">
                </div>
                <div class="detail_admin_right">
                    <table class="Table_Details_Admin">
                        <tr>
                            <td>Mã thương hiệu: </td>
                            <td>@Model.MATH</td>
                        </tr>
                        <tr>
                            <td>Tên thương hiệu:</td>
                            <td>@Model.TENTH</td>
                        </tr>
                        <tr>
                            <td>Hiển thị:</td>
                            <td>"Logo hiển thị";</td>
                        </tr>
                    </table>

                </div>

            </div>
            <div class="button">
                <input type="button" value="Xóa" class="button_add_admin delete_display_alert" />
                <a href="trademark_index.php"><input type="button" value="Quay lại" class="button_add_admin" /></a>
            </div>
            <div class="alert_delete">
                <div class="notification">
                    <h1 class="notification_title">Xác nhận xóa tài khoản!</h1>
                    <input type="submit" value="Xóa" class="alert_delete_btn delete_conform" />
                    <input type="button" value="Không" class="alert_delete_btn delete_cancel" />
                </div>
            </div>
        </form>
    </div>
    <script>
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
    </script>
</div>
<?php include '../templates/nav_admin2.php' ?>