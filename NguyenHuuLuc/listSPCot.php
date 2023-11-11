<?php include '../templates/header.php'; ?>

<table border="1px">
    <thead>
        <tr>
            <th colspan="2" style="background-color: #ffeee6;">Tiêu đề</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require 'connect.php';
        $sql = 'SELECT Ten_sua, Ten_hang_sua, Ten_loai, Trong_luong, Don_gia, Hinh
        FROM sua
        JOIN hang_sua ON hang_sua.Ma_hang_sua = sua.Ma_hang_sua
        JOIN loai_sua ON loai_sua.Ma_loai_sua = sua.Ma_loai_sua';

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <> 0) {

            while ($rows = mysqli_fetch_assoc($result)) {
                echo "<tr>";

                echo "<td align='center'  ><img style=\"width:200px\" src=\"./Hinh_sua/" . $rows["Hinh"] . "\"></td>";

                echo "<td>
                    <div>
                        <b>" . $rows["Ten_sua"] . "</b>
                        <br>
                        <p>Nhà sản xuất: " . $rows["Ten_hang_sua"] . "</p>
                        <p>" . $rows["Ten_loai"] . " - " . $rows["Trong_luong"] . " - " . $rows["Don_gia"] . "</p>
                    </div>  
                </td>";

                echo "</tr>";

            }

        }
        ?>
    </tbody>
</table>
<button type="button" onclick="window.history.go(-1);">Quay lại</button>
<?php include '../templates/footer.php' ?>