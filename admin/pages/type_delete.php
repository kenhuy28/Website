<?php include '../templates/nav_admin1.php' ?>



<div class="detail_admin">
    <h1 class="Title_Admin_create_form">Bạn có muốn loại này ?</h1>
    <!-- @using (Html.BeginForm("Delete", "Loai", FormMethod.Post, new { @enctype = "multipart/form-data" }))
    { -->
        <form action="">
        <div class="detai_admin_form">
            <div class="detail_admin_right">
                <table class="Table_Details_Admin">
                    <tr>
                        <td>Mã loai: </td>
                        <td>@MALOAI</td>
                    </tr>
                    <tr>
                        <td>Tên Loai:</td>
                        <td>@TENLOAI</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="button">
            <input type="submit" value="Xóa" class="button_add_admin delete_display_alert" />
            <a href="@Url.Action("Index","Loai")"><input type="button" value="Quay lại" class="button_add_admin" /></a>
        </div>
        </form>
</div>
<?php include '../templates/nav_admin2.php' ?>
