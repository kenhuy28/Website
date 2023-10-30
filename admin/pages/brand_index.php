<?php
// session_start();
include '../templates/nav_admin1.php';
?>

<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="add_admin">
            <a href="brand_create.php">
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
            $rowOfPage = 10;

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
                                <a href=\"brand_edit.php?id=" . $row->maThuongHieu . "\"><i class=\"fa-solid fa-pen-to-square edit\"></i></a>
                                <a href=\"brand_delete.php?id=" . $row->maThuongHieu . "\"> <i class=\"fa-solid fa-xmark remove\"></i></a>
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
    <?php include $_SESSION['rootPath'] . "/includes/pagination.php" ?>

</div>
<?php include '../templates/nav_admin2.php' ?>