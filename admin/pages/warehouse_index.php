<?php include '../templates/nav_admin1.php' ?>

<div class="body" style="margin-top: 15px">
    <div class="table_header">
        <div class="search">
            <a href="@Url.Action(" Search","Admin")">
                <i class="fa-solid fa-magnifying-glass"></i>
                <div class="search_title">
                    Tìm kiếm nhanh
                </div>
            </a>
        </div>
        <div class="add_admin">
            <a href="enter_product.php">
                <i class="fa-solid fa-user-plus"></i>
                <div class="add_title">
                    Thêm sản phẩm vào kho
                </div>
            </a>
        </div>
    </div>
    <table class="table_dsadmin">
        <thead>
            <tr>
                <th style="width: 65px;">Mã phiếu nhập</th>
                <th style="width: 65px;">Ngày nhập khoa</th>
                <th style="width: 50px;">Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Calculate the total number of pages.
            $rowOfPage = 10;

            $totalRows = $dbh->query('SELECT COUNT(*) FROM phieu_nhap')->fetchColumn();
            $totalPages = ceil($totalRows / $rowOfPage);

            // Determine the current page number.
            $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;

            // Get the rows for the current page.
            
            $query = "SELECT * FROM phieu_nhap LIMIT " . $rowOfPage . " OFFSET " . ($currentPage - 1) * $rowOfPage;
            $statement = $dbh->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $result = $statement->fetchAll();
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>
                            <td>" . $row->maPhieuNhap . "</td>
                            <td>" . $row->ngayNhap . "</td>
                            <td>
                                <a href=\"product_details_entry.php?id=" . $row->maPhieuNhap . "\"><i class=\"fa-solid fa-circle-info detail\"></i></a>
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