<?php
include '../templates/header.php';

if (isset($_POST["submit"])) {
    $daySo = $_POST["daySo"];
    $a = explode(",", $daySo);
    $kq = 0;
    for ($i = 0; $i < sizeof($a); $i++) {
        $kq += $a[$i];
    }

    $path = 'dulieu_bai2.txt';
    $fp = @fopen($path, "w+");

    if ($fp) {
        fwrite($fp, $daySo);
        fclose($fp);
    }
}
?>

<body>
    <form method="post">
        <table style="width:40%; border: none;">
            <thead style="background-color: #339a99;">
                <th colspan="2">
                    <h2>NHẬP VÀ TÍNH TRÊN DÃY SỐ</h2>
                </th>
            </thead>
            <tbody style="background-color: #d1ded4;">
                <tr>
                    <td>Nhập dãy số:</td>
                    <td>
                        <input type="text" name="daySo" value="<?php if (isset($daySo))
                            echo $daySo; ?>">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Tổng dãy số" name="submit"></td>
                </tr>
                <tr>
                    <td>Tổng dãy số: </td>
                    <td>
                        <input type="text" name="kq" disabled value="<?php if (isset($kq))
                            echo $kq; ?>">
                    </td>
                </tr>

            </tbody>
        </table>
    </form>
</body>

<?php include '../templates/footer.php' ?>