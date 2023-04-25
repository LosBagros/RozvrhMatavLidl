<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lidlrozvrh";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
     die("Připojení k databázi se nezdařilo: " . $conn->connect_error); 
}
$today = date("N");
$sql = "SELECT * FROM rozvrh WHERE den_v_tydnu = ? ORDER BY casovy_usek_id";
$stmt = $conn->prepare($sql); $stmt->bind_param("i", $today); $stmt->execute();
$result = $stmt->get_result(); $rozvrh = $result->fetch_all(MYSQLI_ASSOC);
$conn->close(); ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozvrh | MatavRozvrh</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">
      <h1 class="text-center mt-3">Rozvrh hodin</h1>
      <table class="table table-bordered table-hover mt-3">
        <thead>
          <tr>
            <th>Hodina</th>
            <th>Předmět</th>
            <th>Učitel</th>
            <th>Učebna</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($rozvrh as $row) {
              echo "<tr>";
              echo "<td>" . $row['casovy_usek_id'] . "</td>";
              echo "<td>";
              echo "<span class='predmet-zkratka'>" . $row['zkratka_predmetu'] . "</span>";
              echo "<span class='predmet-nazev d-none'>" . $row['nazev_predmetu'] . "</span>";
              echo "</td>";
              echo "<td>";
              echo "<span class='ucitel-zkratka'>" . $row['zkratka_vyucujiciho'] . "</span>";
              echo "<span class='ucitel-jmeno d-none'>" . $row['jmeno_vyucujiciho'] . "</span>";
              echo "</td>";
              echo "<td>" . $row['ucebna'] . "</td>";
              echo "</tr>";
            } 
          ?>

        </tbody>
      </table>
      <a href="rozvrh_editor.php" class="btn btn-primary">Editor rozvrhu</a>
      <form action="server.php" method="post"><input type="submit" name="logout" value="Odhlásit se!" class="btn btn-danger my-3"></form>
    </div>
    <script src="./js/jquery-3.6.4.min.js"></script>
    <script>
      $("tbody tr").hover(function () {
        $(this).find(".predmet-zkratka, .ucitel-zkratka").toggleClass("d-none");
        $(this).find(".predmet-nazev, .ucitel-jmeno").toggleClass("d-none");
      });
    </script>
  </body>
</html>