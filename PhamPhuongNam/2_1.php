
<?php
include '../templates/header.php';
?>
    <style type="text/css">

        body {  

            background-color: #d24dff;

        }

        table{

            background: #ffd94d;

            border: 0 solid yellow;

        }

        thead{

            background: #fff14d;    

        }

        td {

            color: blue;

        }

        h3{

            font-family: verdana;

            text-align: center;

            /* text-anchor: middle; */

            color: #ff8100;

            font-size: medium;

        }

    </style>





<body>

<?php 
    $kq = 0;
    if(isset($_POST['a']))  
        $a=trim($_POST['a']); 
    else $a=0;

    if(isset($_POST['b']))  
        $b=trim($_POST['b']); 
    else $b=0;
    if ($a!=0 && $b!=0)
    $kq=$a*$b; 
    
?>



<form align='center' action="2_1.php" method="post">
<table>

    <thead>

        <th colspan="2" align="center"><h3>diện tích hình chử nhật</h3></th>

    </thead>

    <tr><td>A:</td>

     <td><input type="text" name="a" value="<?php echo $a; ?>"/></td>

    </tr>

    <tr><td>B:</td>

     <td><input type="text" name="b" value="<?php echo $b; ?>"/></td>

    </tr>

    <tr><td>Kết quả:</td>

     <td><input type="text" name="kq" disabled value="<?php echo $kq; ?>"/></td>

    </tr>


    <tr>



     <td colspan="2" align="center"><input type="submit" value="Tính" name="tinh" /></td>



    </tr>



</table>



</form>


</body>

<?php include '../templates/footer.php' ?>