<?php
include '../templates/nav_admin1.php';
include '../includes/check_permisson.php';
check($nv->maLoai, 'XNH');

// Hàm tạo mã phiếu yêu cầu duy nhất
function generateRequestCode($dbh) {
    $code = 'REQ' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $stmt = $dbh->prepare("SELECT COUNT(*) FROM phieu_yeu_cau_nhap WHERE maPhieuYeuCau = :code");
    $stmt->execute(['code' => $code]);
    return ($stmt->fetchColumn() > 0) ? generateRequestCode($dbh) : $code;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['maSanPhams'], $_POST['soLuongs'])) {
    $maSanPhams = $_POST['maSanPhams'];
    $soLuongs = $_POST['soLuongs'];
    $maNhanVien = $nv->maNhanVien;
    $ngayYeuCau = date('Y-m-d');

    try {
        $dbh->beginTransaction();

        // Tạo mã phiếu yêu cầu mới
        $maPhieuYeuCau = generateRequestCode($dbh);

        // Thêm bản ghi vào phieu_yeu_cau_nhap
        $sql = "INSERT INTO phieu_yeu_cau_nhap (maPhieuYeuCau, ngayYeuCau, maNhanVien, approval_status) VALUES (:maPhieuYeuCau, :ngayYeuCau, :maNhanVien, 'pending')";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(['maPhieuYeuCau' => $maPhieuYeuCau, 'ngayYeuCau' => $ngayYeuCau, 'maNhanVien' => $maNhanVien]);

        // Thêm các chi tiết yêu cầu vào yeu_cau_nhap
        foreach ($maSanPhams as $index => $maSanPham) {
            $soLuong = $soLuongs[$index];
            $sql = "INSERT INTO yeu_cau_nhap (maSanPham, soLuongYeuCau, tinhTrang, maPhieuYeuCau, maNhanVien) VALUES (:maSanPham, :soLuong, 0, :maPhieuYeuCau, :maNhanVien)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(['maSanPham' => $maSanPham, 'soLuong' => $soLuong, 'maPhieuYeuCau' => $maPhieuYeuCau, 'maNhanVien' => $maNhanVien]);
        }

        $dbh->commit();
        echo "<script>alert('Yêu cầu nhập hàng đã được lưu thành công'); window.location.href = '../pages/index.php';</script>";
    } catch (Exception $e) {
        $dbh->rollBack();
        echo "<script>alert('Lỗi khi lưu yêu cầu nhập hàng: " . $e->getMessage() . "');</script>";
    }
}
?>
<style>
    input, select, textarea { font-size: 16px; }
    label { font-size: 20px; }
    table { border-collapse: collapse; }
</style>
<div class="body" style="margin-top: 15px">
    <h1 class="Title_Admin_create_form">Thông báo yêu cầu nhập hàng</h1>
    <p class="Notification_create_form">Vui lòng điền thông tin bên dưới để thông báo hết hàng</p>
    <form action="" method="post">
        <table id="productTable" width="100%">
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng Yêu Cầu</th>
                </tr>
            </thead>
            <tbody>
                <tr id="templateRow">
                    <td>
                        <select class="textfile" name="maSanPham" id="sanpham">
                            <option value="">Chọn sản phẩm</option>
                            <?php include '../includes/show_product_in_option.php' ?>
                        </select>
                    </td>
                    <td><input type="number" name="soLuong" placeholder="Số lượng cần nhập"></td>
                    <td><button type="button" class="removeRow">Xóa</button></td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:10px"><span id="error" style="font-size:20px; color: red;"></span></div>
        <table align="center">
            <tr>
                <td colspan="2"><button type="button" id="addRow">Thêm Dòng</button></td>
                <td colspan="2"><input type="submit" id="submitRequest" name="submitRequest" value="Gửi Yêu Cầu"></td>
                <td colspan="2"><a href="warehouse_index.php"><input type="button" value="Quay lại" /></a></td>
            </tr>
        </table>
    </form>
</div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var templateRow = $("#templateRow").html();
        var maNhanVien = "<?php echo $nv->maNhanVien; ?>"; 

        $("#addRow").click(function () {
            var newRow = $("<tr>" + templateRow + "</tr>");
            newRow.css("display", "table-row");
            $("#productTable tbody").append(newRow);
        });

        $("#productTable").on("click", ".removeRow", function () {
            $(this).closest("tr").remove();
        });

        $("#submitRequest").click(function (event) {
            event.preventDefault();

            var valid = true;
            var trs = $("#productTable tbody tr");
            var maSanPhams = [];
            var soLuongs = [];

            for (var i = 0; i < trs.length; i++) {
                var maSanPham = $(trs[i]).find("select").val();
                var soLuong = $(trs[i]).find("input[name='soLuong']").val();

                if (maSanPham == "" || soLuong == "") {
                    $('#error').text("Vui lòng điền đầy đủ sản phẩm và số lượng");
                    valid = false;
                    break;
                }
                maSanPhams.push(maSanPham);
                soLuongs.push(soLuong);
            }

            if (valid) {
                $.ajax({
                    url: "../includes/request_stock.php",
                    type: "POST",
                    data: { 
                        maSanPhams: maSanPhams, 
                        soLuongs: soLuongs, 
                        maNhanVien: maNhanVien 
                    },
                    success: function (response) {
                        alert("Yêu cầu nhập hàng đã được gửi thành công");
                        window.location.href = "../pages/request_entry.php";
                    },
                    error: function (error) {
                        console.error(error);
                        alert('Lỗi khi gửi yêu cầu nhập hàng');
                    },
                });
            }
        });
    });

</script>

<?php include '../templates/nav_admin2.php' ?>
