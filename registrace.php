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
  <title>Registrace | MatavRozvrh</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>

  <div class="costumblock w-100">
    <h1 class="text-center m-3">Registrace</h1>
    <form action="server.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Heslo</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="form-text pass-message"></div>
      </div>
      <div class="mb-3">
        <label for="password_confirm" class="form-label">Ověření hesla</label>
        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
        <div class="form-text confirm-message"></div>
      </div>
      <?php
      if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger mt-3" role="alert">
                ' . $_SESSION['error'] . '
              </div>';
      }
      unset($_SESSION['error']);
      ?>
      <button type="submit" class="btn btn-success w-100" name="register" id="regbtn" disabled>Registrovat!</button>
    </form>
    <a href="index.php" class="btn btn-primary w-100 mt-3">Zpět!</a>
  </div>
  <script src="./js/jquery-3.6.4.min.js"></script>
  <script>
      $('#password').on('keyup', function () {

      $('.pass-message').removeClass('text-success').removeClass('text-danger');
      let password = $('#password').val();

      if (password.length < 8) {
        $('.pass-message').text("Heslo musí mít alespoň 8 znaků!").addClass('text-danger');
      } else {
        $('.pass-message').text("");
      }

    });
    $('#password_confirm').on('keyup', function () {

      $('.confirm-message').removeClass('text-success').removeClass('text-danger');

      let password = $('#password').val();
      let confirm_password = $('#password_confirm').val();

      if (confirm_password === password && password.length >= 8) {
        $('.confirm-message').text("Hesla se shodují!").addClass('text-success');
      }
      else if (password.length >= 8) {
        $('.confirm-message').text("Hesla se neshodují!").addClass('text-danger');
      }
    });

    // call check function on any keyup
    $('input').on('keyup', function () {
      let password = $('#password').val();
      let confirm_password = $('#password_confirm').val();
      let email = $('#email').val();
      let email_regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
      let email_valid = email_regex.test(email);
      if (password.length >= 8 && confirm_password === password && email_valid) {
        $('#regbtn').prop('disabled', false);
      } else {
        $('#regbtn').prop('disabled', true);
      }
    });

  </script>
</body>

</html>