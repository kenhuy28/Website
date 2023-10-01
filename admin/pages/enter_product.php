<?php include '../templates/nav_admin1.php' ?>
<style>
    input,
    select,
    textarea {
        font-size: 16px;
    }

    label {
        font-size: 20px;
    }
</style>
<div class="body" style="margin-top: 15px">
    <h1 class="Title_Admin_create_form">Phiếu thêm sản phẩm vào kho hàng</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <form action="" method="post">
        <div class="form_field" style="width: 50%; float: left;">
            <label for="" class="name_form_field">Mã phiếu nhập kho : </label>
            <input type="text" class="textfile" readonly value="@ViewBag.MAPK" name="MAPHIEUNK">
        </div>
        <div class="form_field" style="width: 50%; float: right;">
            <label for="" class="name_form_field">Ngày nhập kho: </label>
            <input type="date" class="textfile" id="ngay" name="NGAYNK">
            <span class="error_message"></span>
        </div>
        <table id="productTable">
            <tr>
                <th>Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá Nhập</th>
                <th></th>
            </tr>
            <tr>
                <td><select class="textfile invalid" name="MASP" id="sanpham">
                        <option value="">Chọn sản phẩm</option>
                        <option value="SP00000001">Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</option>
                        <option value="SP00000002">Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ</option>
                    </select></td>
                <td><input type="number" name="quantity[]"></td>
                <td><input type="number" name="price[]"></td>
                <td><button type="button" class="removeRow">Xóa</button></td>
            </tr>

        </table>
        <table>
            <tr>
            </tr>
            <tr>
                <td colspan="2"><button type="button" id="addRow">Thêm Dòng</button></td>
                <td colspan="2"><input type="submit" value="Lưu Phiếu Nhập"></td>
                <td colspan="2"><a href="warehouse_index.php"><input type="button" value="Quay lại"
                            class="button_add_admin" /></a></td>
            </tr>

        </table>

    </form>
</div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Thêm dòng mới khi nhấn nút "Thêm Dòng"
        $("#addRow").click(function () {
            var newRow = '<tr><td>' + '<select class="textfile invalid" name="MASP" id="sanpham">' +
                '<option value="">Chọn sản phẩm</option>' + '<option value="SP00000001">Pate Cho Mèo Con Dạng Kem Nekko Kitten Mousse 70g</option>' +
                '<option value="SP00000002">Hạt Chó Trên 6 Tháng ANF 6Free Hữu Cơ</option>' +
                '</td>' + '<td><input type="number" name="quantity[]"></td>' +
                '<td><input type="number" name="price[]"></td>' +
                '<td><button type="button" class="removeRow">Xóa</button></td></tr>';
            $("#productTable").append(newRow);
        });

        // Xóa dòng khi nhấn nút "Xóa"
        $("#productTable").on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });
    });
</script>
<?php include '../templates/nav_admin2.php' ?>