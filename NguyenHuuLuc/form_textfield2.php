<?php
include '../templates/header.php';
?>

<html>

<head>

    <title>Input/Ouput data</title>
</head>

<body>

    <form action="" name="myform" method="post">
        First Name: <input type="text" name="Name[]" size=20
            value="<?php if (isset($_POST['Name']))
                echo $_POST['Name'][0]; ?>" /><br>
        Last Name: <input type="text" name="Name[]" size=20
            value="<?php if (isset($_POST['Name']))
                echo $_POST['Name'][1]; ?>" /><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    if (isset($_POST['Name'])) {
        echo "Chào bạn " . $_POST['Name'][0] . " " . $_POST['Name'][1];
    }
    ?>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>

<?php include '../templates/footer.php' ?>