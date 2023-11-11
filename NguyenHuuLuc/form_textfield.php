<?php
include '../templates/header.php';
?>

<html>

<head>

    <title>Input/Ouput data</title>
</head>

<body>

    <form action="" name="myform" method="post">

        Your Name: <input type="test" name="Name" size=20 value="<?php if (isset($_POST['Name']))
            echo $_POST['Name']; ?>" />

        <br>

        <input type="submit" value="Submit">

    </form>

    <?php

    if (isset($_POST["Name"]))

        print "Hello " . $_POST["Name"];

    ?>
    <button type="button" onclick="window.history.go(-1);">Quay lại</button>
</body>

</html>

<?php include '../templates/footer.php' ?>