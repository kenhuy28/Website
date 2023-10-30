<?php
include '../templates/nav_admin1.php';
$entry_id = $_GET['id'];

$query = "SELECT chi_tiet_phieu_nhap.*, phieu_nhap.ngayNhap, tenSanPham FROM `chi_tiet_phieu_nhap` 
JOIN phieu_nhap on phieu_nhap.maPhieuNhap = chi_tiet_phieu_nhap.maPhieuNhap 
JOIN san_pham on san_pham.maSanPham = chi_tiet_phieu_nhap.maSanPham
WHERE chi_tiet_phieu_nhap.`maPhieuNhap` = '" . $entry_id . "'";
$statement = $dbh->prepare($query);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_OBJ);
$result = $statement->fetch();
?>
<div class="body" style="margin-top: 15px">
    <style>
        input {
            font-size: 16px;
        }

        h3 {
            font-size: 20px;
        }
    </style>
    <h1 align="center" class="Title_Admin_create_form">CHI TIẾT PHIẾU NHẬP</h1>

    <div class="form_field" style="width: 50%; float: left;">
        <h3>Mã phiếu</h3>
        <input type="text" class="textfile" readonly value="<?php echo $entry_id; ?>" name="MAPHIEUNK">
    </div>
    <div class="form_field" style="width: 50%; float: right;">
        <h3>Ngày nhập</h3>
        <input type="date" class="textfile" id="ngay" value="<?php echo $result->ngayNhap; ?>" name="NGAYNK" readonly>
        <span class="error_message"></span>
    </div>
    <table id="productTable" width="100%">
        <tr>
            <th>Sản Phẩm</th>
            <th>Số Lượng</th>
            <th>Giá Nhập</th>
        </tr>
        <tr>
            <?php
            // Calculate the total number of pages.
            $rowOfPage = 10;

            $totalRows = $dbh->query("SELECT COUNT(*) FROM `chi_tiet_phieu_nhap` WHERE chi_tiet_phieu_nhap.`maPhieuNhap` = '" . $entry_id . "'")->fetchColumn();
            $totalPages = ceil($totalRows / $rowOfPage);

            // Determine the current page number.
            $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

            // Get the rows for the current page.
            
            $query = $query . " LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;
            $statement = $dbh->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $result = $statement->fetchAll();
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>
                            <td>" . $row->tenSanPham . "</td>
                            <td>" . $row->soLuong . "</td>
                            <td>" . $row->donGia . "</td>
                        </tr>";
                }
            } else {
                echo "<tr>
                <td colspan=\"4\">Không có dữ liệu</td>
                </tr>";
            }
            ?>
        </tr>

    </table>

    <div align="center" style="margin-top:10px" class="menu-wrapper">
        <ul class="pagination menu">
            <?php
            echo "<li>
             <a href=\"?id=" . $entry_id . "&page=1\">&laquo;</a>
         </li>";
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i != $currentPage) {
                    echo "<li><a href=\"?id=" . $entry_id . "&page=" . $i . "\">" . $i . "</a></li>";
                } else {
                    echo "<li><a class=\"active\" href=\"?id=" . $entry_id . "&page=" . $i . "\">" . $i . "</a></li>";
                }

            }
            echo "<li>
            <a href=\"?id=" . $entry_id . "&page=$totalPages\">&raquo;</a>
        </li>";
            ?>

        </ul>
    </div>
    <div class="button">
        <a href="<?php echo "warehouse_index.php"; ?> "><input type="button" value="Quay lại"
                class="button_add_admin" /></a>
    </div>

    <style>
        .menu-wrapper {

            height: auto;
            width: 100%;
        }

        .menu {
            margin: 0;
            padding: 0 0 0 20px;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            font-size: 22px;
        }

        .pagination a.active {
            background-color: #244cbb;
            color: white;
            border: 1px solid #244cbb;
        }

        .menu li {
            display: inline-block;
            margin: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        ul {
            list-style-type: none;
        }
    </style>
</div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<?php include '../templates/nav_admin2.php' ?>