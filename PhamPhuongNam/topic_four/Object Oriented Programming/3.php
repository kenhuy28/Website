<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>tinh dien tich HCN</title>

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

        .student_page {
            display: none;
        }

        #lecture {
            display: none;
        }
    </style>


</head>



<body>

    <?php
    function gcd($a, $b)
    {
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }
    abstract class Tinh
    {
        protected $a;
        protected $b;
        protected $c;
        protected $d;
        function __construct($a, $b, $c, $d)
        {
            $this->a = $a;
            $this->b = $b;
            $this->c = $c;
            $this->d = $d;
        }
        abstract function tinh();

    }
    class Cong extends Tinh
    {
        public function __construct($a, $b, $c, $d)
        {
            parent::__construct($a, $b, $c, $d);
        }
        // Hàm tính ước chung lớn nhất (greatest common divisor)
        
        function addFractions($numerator1, $denominator1, $numerator2, $denominator2)
        {
            // Tính tổng các tử số
            $numeratorSum = ($numerator1 * $denominator2) + ($numerator2 * $denominator1);

            // Tính tổng các mẫu số
            $denominatorSum = $denominator1 * $denominator2;

            // Rút gọn phân số
            $gcd = gcd($numeratorSum, $denominatorSum);
            $numeratorSum /= $gcd;
            $denominatorSum /= $gcd;

            // Trả về kết quả dưới dạng chuỗi
            return $numeratorSum . "/" . $denominatorSum;
        }


        function tinh()
        {
            return $this->addFractions($this->a, $this->b, $this->c, $this->d);
        }
    }
    class Tru extends Tinh {
        public function __construct($a, $b, $c, $d){
            parent::__construct($a, $b, $c, $d);
        }
        function subtractFractions($numerator1, $denominator1, $numerator2, $denominator2) {
            // Tính hiệu của tử số
            $numeratorDifference = ($numerator1 * $denominator2) - ($numerator2 * $denominator1);
        
            // Tính hiệu của mẫu số
            $denominatorDifference = $denominator1 * $denominator2;
        
            // Rút gọn phân số
            $gcd = gcd($numeratorDifference, $denominatorDifference);
            $numeratorDifference /= $gcd;
            $denominatorDifference /= $gcd;
        
            // Trả về kết quả dưới dạng chuỗi
            return $numeratorDifference . "/" . $denominatorDifference;
        }
        function tinh() {
            return $this->subtractFractions($this->a, $this->b, $this->c, $this->d);
        }
    }
    class Nhan extends Tinh {
        public function __construct($a, $b, $c, $d){
            parent::__construct($a, $b, $c, $d);
        }
        function multiplyFractions($numerator1, $denominator1, $numerator2, $denominator2) {
            // Tính tử số mới
            $newNumerator = $numerator1 * $numerator2;
        
            // Tính mẫu số mới
            $newDenominator = $denominator1 * $denominator2;
        
            // Rút gọn phân số
            $gcd = gcd($newNumerator, $newDenominator);
            $newNumerator /= $gcd;
            $newDenominator /= $gcd;
        
            // Trả về kết quả dưới dạng chuỗi
            return $newNumerator . "/" . $newDenominator;
        }
        function tinh() {
            return $this->multiplyFractions($this->a, $this->b, $this->c, $this->d);
        }
    }
    class Chia extends Tinh {
        public function __construct($a, $b, $c, $d){
            parent::__construct($a, $b, $c, $d);
        }
        function divideFractions($numerator1, $denominator1, $numerator2, $denominator2) {
            // Tính tử số mới
            $newNumerator = $numerator1 * $denominator2;
        
            // Tính mẫu số mới
            $newDenominator = $denominator1 * $numerator2;
        
            // Rút gọn phân số
            $gcd = gcd($newNumerator, $newDenominator);
            $newNumerator /= $gcd;
            $newDenominator /= $gcd;
        
            // Trả về kết quả dưới dạng chuỗi
            return $newNumerator . "/" . $newDenominator;
        }
        function tinh() {
            return $this->divideFractions($this->a, $this->b, $this->c, $this->d);
        }
    }
    if (isset($_POST['a'])) {
        $a = trim($_POST['a']);
    } else {
        $a = "";
    }
    if (isset($_POST['b'])) {
        $b = trim($_POST['b']);
    } else {
        $b = "";
    }
    if (isset($_POST['d'])) {
        $d = trim($_POST['d']);
    } else {
        $d = "";
    }
    if (isset($_POST['c'])) {
        $c = trim($_POST['c']);
    } else {
        $c = "";
    }
    if (isset($_POST['GT'])) {
        $GT = trim($_POST['GT']);
    } else {
        $GT = "";
    }
   
    switch ($GT)  {
        case "+":
            $tinh = new Cong($a, $b, $c, $d);
            $result = $tinh->tinh();
            break;
        case "-":
            $tinh = new Tru($a, $b, $c, $d);
            $result = $tinh->tinh();
            break;
        case "x":
            $tinh = new Nhan($a, $b, $c, $d);
            $result = $tinh->tinh();
            break;
        case "/":
            $tinh = new Chia($a, $b, $c, $d);
            $result = $tinh->tinh();
            break;
        default:
            $result = "";
    }
    
    ?>

    <form align='center' action="3.php" method="post">
        <table>
            <tr>
                <td>
                    Chọn các phép tính trên phân số
                </td>
            </tr>
            <tr>
                <td>Nhập phân số thứ 1:</td>
                <td>Tử số:</td>
                <td><input colspan="1" type="text" name="a" value="<?php echo $a; ?>" /></td>
                <td>Mấu số:</td>
                <td><input colspan="1" type="text" name="b" value="<?php echo $b; ?>" /></td>
            </tr>
            <tr>
                <td>Nhập phân số thứ 2:</td>
                <td>Tử số:</td>
                <td><input colspan="1" type="text" name="c" value="<?php echo $c;?>" /></td>
                <td>Mấu số:</td>
                <td><input colspan="1" type="text" name="d" value="<?php echo $d; ?>" /></td>
            </tr>
            <tr>
                <td colspan="5">
                    <fieldset>
                        <legend>Chọn phép tính</legend>
                        <input colspan="1" type="radio" value="+" name="GT" <?php
                        echo ""; ?> />+
                        <input colspan="1" type="radio" value="-" name="GT" <?php
                        echo ""; ?> />-
                        <input colspan="1" type="radio" value="x" name="GT" <?php
                        echo ""; ?> />x
                        <input colspan="1" type="radio" value="/" name="GT" <?php
                        echo ""; ?> />/
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td align="left"><input type="submit" value="Tính" name="Tinh" />
            </tr>
            <tr>
                <td colspan="5" align="center"><textarea name="" id="" cols="100" rows="10"><?php echo $result; ?></textarea>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>