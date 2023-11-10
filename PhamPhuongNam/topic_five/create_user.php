<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Thêm nhân viên</title>

    <style type="text/css">
        body {

            background-color: #d24dff;

        }

        table {

            background: #ffd94d;

            border: 0 solid yellow;

        }

        thead {

            background: #fff14d;


        }

        td {

            color: blue;

        }

        h3 {

            font-family: verdana;

            text-align: center;

            /* text-anchor: middle; */

            color: #ff8100;

            font-size: medium;

        }
    </style>

</head>



<body>

    <?php

    require_once("connect.php");
    $warning = "";
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
    } else {
        $username = "";
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    } else {
        $password = "";
    }
    if (isset($_POST['confirm_password'])) {
        $confirm_password = trim($_POST['confirm_password']);
    } else {
        $confirm_password = "";
    }
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    } else {
        $email = "";
    }
    if (isset($_POST['create']) && $username != "" && $password != "" && $confirm_password != "" && $email != "") {
        $result = mysqli_query($conn, "SELECT * FROM User where username = '$username' or email = '$email'");
        if (mysqli_num_rows($result) > 0) {
            $warning = "Username and email already exists";
        } else {
            if ($password == $confirm_password) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $sql = "INSERT INTO User (username, password, email) VALUES ('$username', '$password', '$email')";
                    mysqli_query($conn, $sql);
                    $warning = "Create success";
                } else {
                    $warning = "Invalid email format";
                }
                
            } else {
                $warning = "confirm password do not match";
            }        
        }
    }
    if (isset($_POST['login'])) {
        header("Location: login.php");
        exit();
    }
    ?>

    <form align='center' action="create_user.php" method="post">

        <table style="width: 400px;">
            <thead>

                <th colspan="2" align="center">
                    <h3>CREATE USER</h3>
                </th>
            </thead>
            <tr>
                <td colspan="2" align="center">
                    <h3 style="color: red;">
                        <?php echo $warning; ?>
                    </h3>
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="username" value="<?php ?>" /></td>

            </tr>
            <tr>
                <td>Password:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="password" value="<?php ?>" /></td>
            </tr>
            <tr>
                <td>Confirm password:</td>
                <td><input style="width: 80%;" colspan="1" type="text" name="confirm_password" value="<?php ?>" /></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input style="width: 100%;" colspan="1" type="email" name="email" value="<?php ?>" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="1"><input type="submit" value="Create" name="create" />
                <input type="submit" value="Login" name="login" />
                </td>
            </tr>
        </table>
    </form>




</body>



</html>