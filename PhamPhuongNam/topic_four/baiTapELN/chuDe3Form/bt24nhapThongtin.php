<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <fieldset>
        <legend>Enter your infomation:</legend>
        <form action="bt24xulyThongtin.php" method="post">
            <table>
                <tr>
                    <td>Họ tên:</td>
                    <td><input type="text" id="hoTen" name="hoTen"></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type="text" id="diaChi" name="diaChi"></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td> <input type="text" id="sdt" name="sdt"></td>
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
                        <select name="quocTich">
                            <option value="VN">Việt Nam
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
                    <td><input type="submit" value="Gửi"> <input type="button" value="Hủy">
                    </td>
                </tr>

            </table>
        </form>
    </fieldset>
</body>

</html>