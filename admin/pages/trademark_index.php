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
            // Calculate the total number of pages.
            $rowOfPage = 5;
            $totalRows = $dbh->query('SELECT COUNT(*) FROM thuong_hieu')->fetchColumn();
            $totalPages = ceil($totalRows / $rowOfPage);

            // Determine the current page number.
            $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

            // Get the rows for the current page.
            
            $query = "SELECT * FROM thuong_hieu LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;
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
    <div align="center" style="margin-top:10px" class="menu-wrapper">
        <ul class="pagination menu">
            <li>
                <a href="?page=1">&laquo;</a>
            </li>
            <?php
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i != $currentPage) {
                    echo "<li><a href=\"?page=" . $i . "\">" . $i . "</a></li>";
                } else {
                    echo "<li><a class=\"active\" href=\"?page=" . $i . "\">" . $i . "</a></li>";
                }

            }
            echo "<li>
            <a href=\"?page=$totalPages\">&raquo;</a>
        </li>";
            ?>

        </ul>
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
<?php include '../templates/nav_admin2.php' ?>