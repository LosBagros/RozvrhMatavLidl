<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

require_once "mysql.php";

$today = date("N");
$sql = "SELECT * FROM rozvrh WHERE den_v_tydnu = ? ORDER BY casovy_usek_id";
$stmt = $conn->prepare($sql); $stmt->bind_param("i", $today); $stmt->execute();
$result = $stmt->get_result(); $rozvrh = $result->fetch_all(MYSQLI_ASSOC);
?>

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
      <table class="table table-bordered mt-3">
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
              echo "<tr id='" . $row['casovy_usek_id'] . "'>";
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
      <a href="rozvrh_creator.php" class="btn btn-primary">Editor rozvrhu</a>
      <form action="server.php" method="post"><input type="submit" name="logout" value="Odhlásit se!" class="btn btn-danger my-3"></form>
    </div>
    <script src="./js/jquery-3.6.4.min.js"></script>
    <script>
      <?php
        $sql = "SELECT * FROM casove_useky";
        $result = $conn->query($sql);
        $casove_useky = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();

        echo "const casove_useky = " . json_encode($casove_useky) . ";";
      ?>
      // inspiroval jsem se ze stackoverflow, leave me alone, pls, nejvíc jsem to uvařl
      const today = new Date();
      const todayHours = today.getHours();
      const todayMinutes = today.getMinutes();
      const todaySeconds = today.getSeconds();
      const todayTime = todayHours * 3600 + todayMinutes * 60 + todaySeconds;
      for (let i = 0; i < casove_useky.length; i++) {
        const casovy_usek = casove_useky[i];
        const casovy_usek_id = casovy_usek.id;
        const casovy_usek_zacatek = casovy_usek.zacatek;
        const casovy_usek_konec = casovy_usek.konec;
        const casovy_usek_zacatek_hours = parseInt(casovy_usek_zacatek.split(":")[0]);
        const casovy_usek_zacatek_minutes = parseInt(casovy_usek_zacatek.split(":")[1]);
        const casovy_usek_zacatek_seconds = parseInt(casovy_usek_zacatek.split(":")[2]);
        const casovy_usek_zacatek_time = casovy_usek_zacatek_hours * 3600 + casovy_usek_zacatek_minutes * 60 + casovy_usek_zacatek_seconds;
        const casovy_usek_konec_hours = parseInt(casovy_usek_konec.split(":")[0]);
        const casovy_usek_konec_minutes = parseInt(casovy_usek_konec.split(":")[1]);
        const casovy_usek_konec_seconds = parseInt(casovy_usek_konec.split(":")[2]);
        const casovy_usek_konec_time = casovy_usek_konec_hours * 3600 + casovy_usek_konec_minutes * 60 + casovy_usek_konec_seconds;
        if (todayTime > casovy_usek_konec_time) {
          $("#" + casovy_usek_id).addClass("text-warning");
        } else if (todayTime > casovy_usek_zacatek_time) {
          $("#" + casovy_usek_id).addClass("text-success");
        }
      }


      $("tbody tr").hover(function () {
        $(this).find(".predmet-zkratka, .ucitel-zkratka").toggleClass("d-none");
        $(this).find(".predmet-nazev, .ucitel-jmeno").toggleClass("d-none");
      });

    </script>
  </body>
</html>