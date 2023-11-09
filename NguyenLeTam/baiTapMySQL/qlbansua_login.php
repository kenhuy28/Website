<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }



    .form-signin .form-floating:focus-within {
      z-index: 2;
    }

    .form-signin input[type="email"] {
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body class="text-center">
  <?php
  $conn = mysqli_connect('localhost', 'root', '', 'qlbansua') or die('Could not connect to MySQL: ' . mysqli_connect_error());
  $sql = 'select username, password from user ';
  $acc = mysqli_query($conn, $sql);
  if (isset($_POST['username']) && isset($_POST['password']))
    while ($rows = mysqli_fetch_row($acc))
      if ($_POST['username'] == $rows[0] && $_POST['password'] == $rows[1])
        header('Location: ./qlbansua_hienthicacsanpham.php');
  ?>

  <main class="form-signin">
    <form action="" method="post">
      <h1 class="h3 mb-3 fw-normal">Đăng nhập</h1>
      <div class="form-floating">
        <label for="floatingInput" style="margin-right: 7px;"> Tài khoản </label>
        <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username">
      </div>
      <br>
      <div class="form-floating">
        <label for="floatingPassword" style="margin-right: 10px;">Mật khẩu</label>
        <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password">
      </div>
      <div align='center'><button type="submit">Đăng nhập</button></div>
    </form>
  </main>
</body>

</html>