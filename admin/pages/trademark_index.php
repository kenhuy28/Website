<?php
// session_start();
include '../templates/nav_admin1.php';
?>
<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="add_admin">
            <a href="trademark_admin_create.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm thương hiệu
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã thương hiệu</th>
                <th style="width: 120px;">Tên thương hiệu</th>
                <th style="width: 150px;">Logo</th>
                <th style="width: 80px;">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM thuong_hieu";
            $statement = $dbh->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $result = $statement->fetchAll();
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>
                            <td>" . $row->maThuongHieu . "</td>
                            <td>" . $row->tenThuongHieu . "</td>
                            <td>
                                <img src=\"" . $_SESSION['rootPath'] . "/../assets/img/thuong_hieu/" . $row->logo . "\"style=\"width: 231px; height: 74px; \"
                            </td>
                            <td>
                                <a href=\"trademark_admin_edit.php\"><i class=\"fa-solid fa-pen-to-square edit\"></i></a>
                                <a href=\"trademark_admin_delete.php\"> <i class=\"fa-solid fa-xmark remove\"></i></a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr>
                <td colspan=\"4\">Không có dữ liệu</td>
                </tr>";
            }
            ?>

        </tbody>
    </table>
    <style>
        .pagination {
            display: inline-block;
            margin: auto;

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

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
    <div align="center">
        <ul class="page pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#" class="active">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">7</a>
            <a href="#">&raquo;</a>
        </ul>
    </div>
</div>
<?php include '../templates/nav_admin2.php' ?>