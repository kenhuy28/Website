<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đề kiểm tra mẫu</title>
    <style type="text/css">
        table {
            color: #ffff00;
            background-color: gray;
            border-collapse: collapse;
        }

        table th {
            background-color: blue;
            font-style: vni-times;
            color: yellow;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    function showBXH()
    {
        $strDSBH = $_POST['strDSBH'];
        if (trim($strDSBH) == "")
            return "";
        $strDSBH = trim($strDSBH, ".");
        $strDSBH = str_replace(".", "-", $strDSBH);
        $BXHt = explode("-", $strDSBH);
        $BXH = array();
        for ($i = 0; $i < sizeof($BXHt); $i += 2)
            $BXH[trim($BXHt[$i])] = (int) trim($BXHt[$i + 1]);
        asort($BXH);
        $strBXH = "";
        foreach ($BXH as $key => $value)
            $strBXH .= $key . " - " . $value . "." . "\n";
        return trim($strBXH);
    }
    if (isset($_POST['themSV'])) {
        $maSV = trim($_POST['maSV']);
        $hoTenSV = trim($_POST['hoTenSV']);
        $ngaySinh = trim($_POST['ngaySinh']);
        $lop = $_POST['radLop'];
        $gioiTinh = $_POST['radGT'];
        echo $maSV . ' ' . $hoTenSV . ' ' . $ngaySinh . ' ' . $lop . ' ' . $gioiTinh;
    }

    ?>
    <form action="" method="post">
        <table>
            <thead>
                <th colspan="2">
                    <h2 style="text-align: center; margin: auto;"> Thêm Sinh viên</h2>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Mã lớp:
                    </td>
                    <td style="display: inline-flex; border: none;">
                        <input type="radio" name="radLop" value="62.CNTT-1" <?php if (isset($_POST['radLop']) && $_POST['radLop'] == '62.CNTT-1')
                            echo 'checked="checked"'; ?> checked /> 62.CNTT-1
                        <input type="radio" name="radLop" value="62.CNTT-2" <?php if (isset($_POST['radLop']) && $_POST['radLop'] == '62.CNTT-2')
                            echo 'checked="checked"'; ?> /> 62.CNTT-2

                        <input type="radio" name="radLop" value="62.CNTT-3" <?php if (isset($_POST['radLop']) && $_POST['radLop'] == '62.CNTT-3')
                            echo 'checked="checked"'; ?> /> 62.CNTT-3

                    </td>
                </tr>
                <tr>
                    <td>
                        Mã SV:
                    </td>
                    <td>
                        <input required type="text" style="width: 250px;" name="maSV" value="<?php if (isset($_POST['maSV']))
                            echo $maSV; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Họ và tên:
                    </td>
                    <td>
                        <input required type="text" style="width: 250px;" name="hoTenSV" value="<?php if (isset($_POST['hoTenSV']))
                            echo $hoTenSV; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Giới tính:
                    </td>
                    <td style="display: inline-flex;  border: none;">
                        <input type="radio" name="radGT" value="Nam" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nam')
                            echo 'checked="checked"'; ?> checked /> Nam
                        <input type="radio" name="radGT" value="Nu" <?php if (isset($_POST['radGT']) && $_POST['radGT'] == 'Nu')
                            echo 'checked="checked"'; ?> /> Nữ
                    </td>
                </tr>
                <tr>
                    <td>
                        Ngày sinh:
                    </td>
                    <td>
                        <input required type="text" style="width: 250px;" name="ngaySinh" value="<?php if (isset($_POST['ngaySinh']))
                            echo $ngaySinh; ?>">
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2">
                        <button type="submit" name="themSV">Thêm SV</button>
                        <button type="submit" name="luuDSSV">Lưu SV</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>


    <div>

        <!-- <td colspan="2"> <textarea name="strBXH" rows="5" cols="60"><?php if (isset($strBXH))
            echo $strBXH; ?></textarea></td> -->
        <h2>Danh sách Sinh viên</h2>
        <table>
            <tr style="font-size: large;">
                <td>Mã lớp</td>
                <td>Mã SV</td>
                <td>Họ tên</td>
                <td>Giới tính</td>
                <td>Ngày sinh</td>
            </tr>
            <?php
            // $age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
            $SinhVien = array();
            $SinhVien[] = array("62.CNTT-1" => array("6213341", "Nguyễn Minh Anh", "Nữ", "2002-08-09"));
            $SinhVien[] = array("62.CNTT-1" => array("6210123", "Trần Anh Tú", "Nam", "2002-05-21"));
            $SinhVien[] = array("62.CNTT-2" => array("6211012", "Nguyễn Ngọc Thanh", "Nam", "2002-02-30"));
            $SinhVien[] = array("62.CNTT-3" => array("6210123", "Lê Phương Thảo", "Nữ", "2001-10-15"));
            foreach ($SinhVien as $stt => $lop) {
                echo "<tr style='font-size: large;'>";
                foreach ($lop as $sttlop => $sv) {
                    echo "<td>" . $sttlop . "</td> ";
                    foreach ($sv as $sttsv => $ttsv) {
                        echo "<td>" . $ttsv . "</td> ";
                    }
                }
                echo "</tr> ";
            }


            ?>
        </table>

    </div>
    <?php foreach ($SinhVien as $stt => $lop) {
        foreach ($lop as $sttlop => $sv) {
            echo "w" . $sttlop ."w";
            foreach ($sv as $sttsv => $ttsv) {
                echo   $ttsv . "z";
            }
        }
        echo "w";
    } ?>
</body>

</html>