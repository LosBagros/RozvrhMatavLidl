<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    die();
}

require_once "mysql.php";


$sql = "SELECT * FROM casove_useky";
$result = $conn->query($sql);
$casove_useky = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozvrh editor | MatavRozvrh</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body data-bs-theme="dark">
    <div class="container">
        <h1 class="text-center mt-3">Editor rozvrhu</h1>
        <form method="POST" action="server.php">
            <div class="form-group">
                <label for="den_v_tydnu">Den v týdnu</label>
                    <select class="form-control" id="den_v_tydnu" name="den_v_tydnu" required>
                    <option value="1">Pondělí</option>
                    <option value="2">Úterý</option>
                    <option value="3">Středa</option>
                    <option value="4">Čtvrtek</option>
                    <option value="5">Pátek</option>
                </select>
            </div>

            <div class="form-group">
                <label for="casovy_usek_id">Časový úsek</label>
                <select class="form-control" id="casovy_usek_id" name="casovy_usek_id" required>
                    <?php foreach ($casove_useky as $usek): ?>
                        <option value="<?php echo $usek['id']; ?>"><?php echo $usek['zacatek'] . ' - ' . $usek['konec']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="zkratka_predmetu">Zkratka předmětu</label>
                <input type="text" class="form-control" id="zkratka_predmetu" name="zkratka_predmetu" required>
            </div>
            <div class="form-group">
                <label for="nazev_predmetu">Název předmětu</label>
                <input type="text" class="form-control" id="nazev_predmetu" name="nazev_predmetu" required>
            </div>
            <div class="form-group">
                <label for="zkratka_vyucujiciho">Zkratka vyučujícího</label>
                <input type="text" class="form-control" id="zkratka_vyucujiciho" name="zkratka_vyucujiciho" required>
            </div>
            <div class="form-group">
                <label for="jmeno_vyucujiciho">Jméno vyučujícího</label>
                <input type="text" class="form-control" id="jmeno_vyucujiciho" name="jmeno_vyucujiciho" required>
            </div>
            <div class="form-group">
                <label for="ucebna">Učebna</label>
                <input type="text" class="form-control" id="ucebna" name="ucebna" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="update_rozvrh">Uložit změny</button>
        </form>
        <a href="rozvrh.php" class="btn btn-danger mt-3">Zpět na rozvrh!</a>
    </div>
    <script src="./js/jquery-3.6.4.min.js"></script>
</body>
</html>

