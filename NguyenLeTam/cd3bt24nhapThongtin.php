<?php include("../templates/header.php") ?>
<fieldset style="max-width: 65%;">
    <legend>Enter your infomation:</legend>
    <form action="cd3bt24xulyThongtin.php" method="post">
        <table style="font-size: 20px;">
            <tr>
                <td>Họ tên:</td>
                <td><input required type="text" id="hoTen" name="hoTen"></td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td><input required type="text" id="diaChi" name="diaChi"></td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td> <input required type="text" id="sdt" name="sdt"></td>
            </tr>
            <tr>
                <td>Giới tính:</td>
                <td>
                    <div>
                        <input type="radio" name="gioiTinh" value="nam" checked>Nam
                        <input type="radio" name="gioiTinh" value="nu">Nữ
                    </div>
                </td>
            </tr>
            <tr>
                <td>Quốc tịch:</td>
                <td>
                    <select required name="quocTich">
                        <option selected value="VN">Việt Nam
                        </option>
                        <option value="US">Anh
                        </option>
                        <option value="CN">Trung Quốc
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Các môn đã học:</td>
                <td>
                    <input type="checkbox" name="chk1" value="PHP&MySQL" />PHP&MySQL
                    <input type="checkbox" name="chk2" value="C#" />C#
                    <input type="checkbox" name="chk3" value="XML" />XML
                    <input type="checkbox" name="chk4" value="Python" />Python

                </td>
            </tr>
            <tr>
                <td>Ghi chú:</td>
                <td> <textarea name="comment" rows="3" cols="40"> Đăng ký học online</textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">Gửi</button>
                    <a href="./bt24nhapThongtin.php">
                        <button type="button">Hủy</button>
                    </a>
                </td>
            </tr>

        </table>
    </form>
</fieldset>
<br> 
<?php include("back.php") ?>
<?php include("../templates/footer.php") ?>