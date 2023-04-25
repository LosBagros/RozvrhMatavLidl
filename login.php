<!-- 
   _______________
8 |_|#|_|#|_|#|_|#|
7 |#|_|#|_|#|_|#|_|
6 |_|#|_|#|_|#|_|#|
5 |#|_|#|_|#|_|#|_|
4 |_|#|_|#|_|#|_|#|
3 |#|_|#|_|#|_|#|_|
2 |_|#|_|#|_|#|_|#|
1 |#|_|#|_|#|_|#|_|
   a b c d e f g h

-->

<?php
  session_start();
  if(isset($_SESSION['email'])){
    header("Location:rozvrh.php");
    die();
  }
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Přihlášení | MatavRozvrh</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>
<body>

  <div class="costumblock text-center w-100">
    <h1 class="text-center m-3">Přihlášení</h1>
    <form action="server.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Heslo</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger mt-3" role="alert">
                ' . $_SESSION['error'] . '
              </div>';
      }
      unset($_SESSION['error']);
      ?>
      <button type="submit" class="btn btn-success w-100" name="login" id="loginbtn" disabled>Přihlásit se!</button>
    </form>
    <a href="index.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
  </div>
  <script src="./js/jquery-3.6.4.min.js"></script>
  <script>
  $('input').on('keyup', function () {
      let password = $('#password').val();
      let email = $('#email').val();
      let email_regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      let email_valid = email_regex.test(email);
      if (password.length > 0 && email_valid) {
        $('#loginbtn').prop('disabled', false);
      } else {
        $('#loginbtn').prop('disabled', true);
      }
    });
  </script>
</body>
</html>