<?php
include '../templates/header.php';
?>

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



    <?php
    $kq='';
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else {
        $a = 0;
    }
    function printArr($arr, $n)
    {

        for ($i = 0; $i < $n; $i++) {
            echo $arr[$i] . " ";
        }
    }
    function bubbleSort1(&$arr1)
    {
        $n1 = sizeof($arr1);
        for ($i1 = 0; $i1 < $n1; $i1++) {
            for ($j1 = 0; $j1 < $n1 - $i1 - 1; $j1++) {
                if ($arr1[$j1] > $arr1[$j1 + 1]) {
                    $t1 = $arr1[$j1];
                    $arr1[$j1] = $arr1[$j1 + 1];
                    $arr1[$j1 + 1] = $t1;
                }
            }
        }
    }
    function countEvenNumbers($arr)
    {
        $dem = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] % 2 == 0) {
                $dem++;
            }
        }
        return $dem;
    }
    function countNumberLess100($arr)
    {
        $dem = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] < 100) {
                $dem++;
            }
        }
        return $dem;
    }
    function sumNagativeNumbers($arr)
    {
        $sum = 0;
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i] < 100) {
                $sum += $arr[$i];
            }
        }
        return $sum;
    }
    function createArr($n)
    {
        $arr = array();
        for ($i = 0; $i < $n; $i++) {
            $arr[$i] = rand(-1000, 1000);
        }
        return $arr;
    }
    function printLastdigit0($arr)
    {
        $s="";
        for ($i = 0; $i < count($arr); $i++) {
            $x = $arr[$i] / 10;
            if ($x % 10 == 0 && $x != 0) {
                $s.= $i . " ";
            }
        }
        return $s;
    }
    if ($a == 0) {

    } else {
        $arr = createArr($a);
        //printArr($arr, $a);
        $kq ="a, Array's create: ";
        $str = implode(' ',$arr);
        $kq .= $str;
        $kq .= "\nb, There are " . countEvenNumbers($arr) . " even numbers";
        $kq .= "\nc, There are " . countNumberLess100($arr) . " numbers less than 100";
        $kq .= "\nd, Sum of old numbers in array is " . sumNagativeNumbers($arr);
        $kq .= "\ne, the positions of the elemants in the array that have last digit as 0: ";
        $kq .= printLastdigit0($arr);
        $kq .= "\nf,the array after sort:";
        bubbleSort1($arr);
        $str = implode(' ',$arr);
        $kq .= $str;
    }
    ?>



    <form align='center' action="" method="post" >
        <table>
            <thead>
                <td colspan="2" align="center">Create array</td>
            </thead>
            <tr>
                <td>Enter n</td>
                <td><input type="number" name="a" min="1" value="<?php echo $a; ?>" /></td>
            </tr>
            <tr>
                <td  align="center"><input type="submit" value="Caculate" name="tinh" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><textarea name="" id="" style="min-width: 600px; min-height: 500px;"><?php echo $kq; ?></textarea></td>
            </tr>
        </table>
    </form>
    <?php include '../templates/footer.php' ?>