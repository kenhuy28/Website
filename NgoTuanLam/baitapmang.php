<?php include '../templates/header.php'; ?>
<?php
$SinhVien = array(
    array("MaLop" => "62CNTT-1", "MaSV" => "6212341", "HoTenSV" => "Nguyen Minh Anh", "gt" => "Nu", "NgaySinh" => "2002-08-09"),
    array("MaLop" => "62CNTT-1", "MaSV" => "6212342", "HoTenSV" => "Tran Anh Tu", "gt" => "Nam", "NgaySinh" => "2002-05-21"),
    array("MaLop" => "62CNTT-2", "MaSV" => "6212343", "HoTenSV" => "Nguyen Ngoc Thanh", "gt" => "Nam", "NgaySinh" => "2002-02-30"),
    array("MaLop" => "62CNTT-3", "MaSV" => "6212344", "HoTenSV" => "Le Phuong Thao", "gt" => "Nu", "NgaySinh" => "2001-10-15"),
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>THÔNG TIN SINH VIÊN</h1>
    <table>

        <form action="" method="POST">
            <table border="1px">
                <tr>
                    <th>Mã Lớp</th>
                    <th>Mã Sinh Viên</th>
                    <th>Tên Sinh Viên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                </tr>
                <?php
                for ($i = 0; $i < count($SinhVien); $i++) {
                    echo "
                    <tr>
                        <td>{$SinhVien[$i]["MaLop"]}</td>
                        <td>{$SinhVien[$i]["MaSV"]}</td>
                        <td>{$SinhVien[$i]["HoTenSV"]}</td>
                        <td>{$SinhVien[$i]["gt"]}</td>
                        <td>{$SinhVien[$i]["NgaySinh"]}</td>
                    </tr>";
                }
                ?>
            </table>
        </form>
    </table>
</body>

</html>

<?php include '../templates/footer.php' ?>