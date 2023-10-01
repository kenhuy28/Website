<?php include '../templates/nav_admin1.php' ?>

<div class="body" style="margin-top: 15px">
    <div class="search_admin">
        <h1 class="Title_Admin_create_form">Thống kế doanh thu</h1>
        <div class="search_admin_header">
            <form action="" method="post">
                <table class="Table_Details_Admin" style="margin-left:330px; margin-bottom:20px">
                    <tr style="display:flex; justify-content:center; align-items:center">
                        <td style="display:flex; justify-content: center; align-items:center;">
                            <label for="" class="name_form_field" style="margin-right:10px">Tháng Bắt đầu : </label>
                            <input type="number" class="textfile" name="thangbatdau" style="min-width:50px" min="1"
                                max="12" value="@ViewBag.thangbatdau" maxlength="2" id="startMonth">
                        </td>
                        <td style="display:flex; justify-content: center; align-items:center;">
                            <label for="" class="name_form_field" style="margin-right:10px">Năm bát đầu: </label>
                            <input type="number" class="textfile" name="nambatdau" style="min-width:50px"
                                value="@ViewBag.nambatdau" maxlength="4" id="startYear">
                        </td>
                    </tr>
                    <tr style="display:flex">
                        <td style="display:flex; justify-content: center; align-items:center;">
                            <label for="" class="name_form_field" style="margin-right:10px">Tháng két thúc: </label>
                            <input type="number" class="textfile" name="thangketthuc" style="min-width:50px" min="1"
                                max="12" value="@ViewBag.thangketthuc" maxlength="2" id="endMonth">
                        </td>
                        <td style="display:flex; justify-content: center; align-items:center;">
                            <label for="" class="name_form_field" style="margin-right:10px">Năm kết thúc: </label>
                            <input type="number" class="textfile" name="namketthuc" style="min-width:50px"
                                value="@ViewBag.namketthuc" maxlength="4" id="endYear">
                        </td>
                    </tr>

                </table>
                <h6 id="error" style="font-size: 16px; color: red"></h6>
                <div class="search_button" style="">
                    <input type="submit" value="Báo cáo " class="search_button_btn" />
                    <a href="statistics_index.php"><input type="button" value="Nhập lại"
                            class="search_button_btn" /></a>
                    <a href="@Url.Action(" InBaoCao", "ThongKe" , new { @thangbatdau=ViewBag.thangbatdau,
                        @thangketthuc=ViewBag.thangketthuc, @nambatdau=ViewBag.nambatdau,
                        @namketthuc=ViewBag.namketthuc})" style="position: absolute; right:-400px;"><input type="button"
                            value="In báo cáo" class="search_button_btn" /></a>
                </div>
            </form>
        </div>
        <table class="table_dsadmin">
            <thead>
                <tr>
                    <th style="width: 30px;">STT</th>
                    <th style="width: 65px;">Thời gian</th>
                    <th style="width: 65px;">Mã đơn hàng</th>
                    <th style="width: 80px;">Mã sản phẩm</th>
                    <th style="width: 150px;">Tên sản phẩm</th>
                    <th style="width: 65px;">Số lượng bán</th>
                    <th style="width: 75px;">Đơn giá bán</th>
                    <th style="width: 80px;">Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
            </tbody>

        </table>
        <div style="display:block; justify-content:center; width: 100%">
            <div>
                <h6 style="font-size: 16px; display: flex; justify-content: center; margin:70px">Thống kê theo tháng
                </h6>
                <div style="display: flex; justify-content: center">
                    <table class="table_dsadmin" style="max-width: 500px">
                        <thead>
                            <tr>
                                <th style="width: 30px;">STT</th>
                                <th style="width: 65px;">Thời gian</th>
                                <th style="width: 75px;">Tổng doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (var item in ViewBag.tongTienTheoThangNam)
                            {
                            <tr style="height:40px">
                                <td>
                                    @{y++;}
                                    @y
                                </td>
                                <td>
                                    @item.ThangBan.ToString("MM/yyyy")
                                </td>
                                <td>
                                    @string.Format("{0:#,##0}", item.TongTien) đ
                                </td>

                            </tr>
                            }
                        </tbody>

                    </table>

                </div>
                <h6 style="font-size: 20px; display: flex; justify-content: center; margin:70px">Tổng toàn bộ doanh thu:
                    @string.Format("{0:#,##0}", ViewBag.TongDoanhThu) VND</h6>
            </div>
        </div>

    </div>
    <script>
        function validateForm() {
            var startMonth = document.getElementById("startMonth").value;
            var startYear = document.getElementById("startYear").value;
            var endMonth = document.getElementById("endMonth").value;
            var endYear = document.getElementById("endYear").value;

            // Kiểm tra tính hợp lệ của các giá trị
            if (startYear > endYear || (startYear === endYear && startMonth > endMonth)) {
                document.getElementById("error").innerHTML = "Thời gian bắt đầu phải nhỏ hơn thời gian kết thúc!";
                return false;
            }

            return true;
        }
    </script>
</div>

<?php include '../templates/nav_admin2.php' ?>