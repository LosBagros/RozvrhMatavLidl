<?php
  session_start();
  if(isset($_SESSION['email'])){
    header("Location:rozvrh.php");
    die();
  }
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Školní rozvrh</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body data-bs-theme="dark">

  <!-- create buttons to login and register -->
  <h1 class="text-center m-3">Matav rozvrh - LIDL Verze</h1>
  <!-- center buttons -->
  <div class="d-flex justify-content-center">
    <a href="login.php" class="btn btn-primary w-25 m-3 text-center">Přihlásit se!</a>
    <a href="registrace.php" class="btn btn-primary w-25 m-3 text-center">Registrovat se!</a>
  </div>
  <script src="js/jquery-3.6.4.min.js"></script>
</body>
</html>
