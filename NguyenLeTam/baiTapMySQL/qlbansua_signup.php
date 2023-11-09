<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Document</title>
</head>
<body>
       
<?php
$conn = mysqli_connect('localhost', 'root', '', 'qlbansua')

or die('Could not connect to MySQL: ' . mysqli_connect_error());
if(isset($_POST['dk'])){
$username = $_POST['username'];
$pass = $_POST['pwd'];
$email = $_POST['email'];

       $sql = "INSERT INTO user(username, pass ,email) VALUE ('".$username."','".$pass."','".$email."')";
       mysqli_query($conn, $sql);
       header('Location:./loginSua.php');
}
?>
<form action="" method="post">
       <table>
              <thead>
                     <tr>
                            <th>Đăng ký user</th>
                     </tr>
              </thead>
              <tbody>
                     <tr>
                            <td>Tên đăng nhập</td>
                            <td><input type="text" name="username"></td>
                     </tr>
                     <tr>
                            <td>Mật khẩu</td>
                            <td><input type="password" name="pwd"></td>
                     </tr>
                     <tr>
                            <td>Email:</td>
                            <td><input type="email" name="email"></td>
                     </tr>
                     <tr>
                            <td><input type="submit" value="Đăng ký" name="dk"></td>
                     </tr>
              </tbody>
       </table>
</form>
</body>
</html>
