<?php
include '../templates/nav_admin1.php';
include '../includes/get_new_id_entry.php';
?>
<style>
    input,
    select,
    textarea {
        font-size: 16px;
    }

    label {
        font-size: 20px;
    }

    table {
        border-collapse: collapse;
    }
</style>
<div class="body" style="margin-top: 15px">
    <h1 class="Title_Admin_create_form">Phiếu thêm sản phẩm vào kho hàng</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới</p>
    <form action="" method="post">
        <div class="form_field" style="width: 50%; float: left;">
            <label for="" class="name_form_field">Mã phiếu nhập kho : </label>
            <input type="text" class="textfile" readonly value="<?php echo $maPhieu; ?>" name="MAPHIEUNK">
        </div>
        <div class="form_field" style="width: 50%; float: right;">
            <label for="" class="name_form_field">Ngày nhập kho: </label>
            <input type="date" class="textfile" id="ngay" name="NGAYNK" value="<?php echo date('Y-m-d'); ?>">
            <span class="error_message"></span>
        </div>
        <table id="productTable" width="100%">
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá Nhập</th>
                </tr>
            </thead>
            <tbody>
                <tr id="templateRow">
                    <td>
                        <select class="textfile invalid" name="maSanPham" id="sanpham">
                            <option value="">Chọn sản phẩm</option>
                            <?php include '../includes/show_product_in_option.php' ?>
                    </td>
                    <td><input type="number" name="quantity[]"></td>
                    <td><input type="number" name="price[]"></td>
                    <td><button type="button" class="removeRow">Xóa</button></td>
                </tr>
            </tbody>
        </table>
        <table align="center">
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
        // Template row
        var templateRow = $("#templateRow").html();

        // Add row button click event
        $("#addRow").click(function () {
            // Clone the template row
            var newRow = $("<tr>" + templateRow + "</tr>");

            // Display the new row
            newRow.css("display", "table-row");
            $("#productTable tbody").append(newRow);
        });

        // Remove row button click event
        $("#productTable").on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });
    });
</script>
<?php include '../templates/nav_admin2.php' ?>