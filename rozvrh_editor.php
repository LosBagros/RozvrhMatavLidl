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

$sql = "SELECT * FROM casove_useky";
$result = $conn->query($sql);
$casove_useky = $result->fetch_all(MYSQLI_ASSOC);

//$sql = "SELECT DISTINCT den_v_tydnu, casovy_usek_id, zkratka_predmetu, nazev_predmetu, zkratka_vyucujiciho, jmeno_vyucujiciho, ucebna FROM rozvrh";
$sql = "SELECT DISTINCT den_v_tydnu FROM rozvrh";
$result = $conn->query($sql);
$dny_v_tydnu = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT casovy_usek_id FROM rozvrh";
$result = $conn->query($sql);
$casove_useky = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT zkratka_predmetu FROM rozvrh";
$result = $conn->query($sql);
$zkratky_predmetu = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT nazev_predmetu FROM rozvrh";
$result = $conn->query($sql);
$nazvy_predmetu = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT zkratka_vyucujiciho FROM rozvrh";
$result = $conn->query($sql);
$zkratky_vyucujicich = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT jmeno_vyucujiciho FROM rozvrh";
$result = $conn->query($sql);
$jmena_vyucujicich = $result->fetch_all(MYSQLI_ASSOC);

$sql = "SELECT DISTINCT ucebna FROM rozvrh";
$result = $conn->query($sql);
$ucebny = $result->fetch_all(MYSQLI_ASSOC);


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
                <select class="form-control" id="den_v_tydnu" name="den_v_tydnu">
                    <?php 
                        foreach ($dny_v_tydnu as $den_v_tydnu) {
                            echo '<option value="' . $den_v_tydnu['den_v_tydnu'] . '">' . $den_v_tydnu['den_v_tydnu'] . '</option>';
                        }
                    ?>
                </select>
                <div id="den_v_tydnu-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="den_v_tydnu-custom-input" name="den_v_tydnu_custom"
                        placeholder="Den v týdnu">
                </div>
            </div>
            <div class="form-group">
                <label for="casovy_usek_id">Časový úsek</label>
                <select class="form-control" id="casovy_usek_id" name="casovy_usek_id">
                    <?php 
                        foreach ($casove_useky as $casovy_usek) {
                            echo '<option value="' . $casovy_usek['casovy_usek_id'] . '">' . $casovy_usek['casovy_usek_id'] . '</option>';
                        }
                    ?>
                </select>
                <div id="casovy_usek_id-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="casovy_usek_id-custom-input"
                        name="casovy_usek_id_custom" placeholder="Časový úsek">
                </div>
            </div>

            <div class="form-group">
                <label for="zkratka_predmetu">Zkratka předmětu</label>
                <select class="form-control" id="zkratka_predmetu" name="zkratka_predmetu">
                    <?php 
                        foreach ($zkratky_predmetu as $zkratka_predmetu) {
                            echo '<option value="' . $zkratka_predmetu['zkratka_predmetu'] . '">' . $zkratka_predmetu['zkratka_predmetu'] . '</option>';
                        }
                    ?>
                </select>
                <div id="zkratka_predmetu-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="zkratka_predmetu-custom-input"
                        name="zkratka_predmetu_custom" placeholder="Zkratka předmětu">
                </div>
            </div>

            <div class="form-group">
                <label for="nazev_predmetu">Název předmětu</label>
                <select class="form-control" id="nazev_predmetu" name="nazev_predmetu">
                    <?php
                        foreach ($nazvy_predmetu as $nazev_predmetu) {
                            echo '<option value="' . $nazev_predmetu['nazev_predmetu'] . '">' . $nazev_predmetu['nazev_predmetu'] . '</option>';
                        }
                    ?>
                    <option value="other">Other</option>
                </select>

                <div id="nazev-predmetu-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="nazev-predmetu-custom-input" name="nazev_predmetu_custom" placeholder="Název předmětu">
                </div>
                <label for="zkratka_vyucujiciho">Zkratka vyučujícího</label>
                <select class="form-control" id="zkratka_vyucujiciho" name="zkratka_vyucujiciho">
                    <?php 
                        foreach ($zkratky_vyucujicich as $zkratka_vyucujiciho) {
                            echo '<option value="' . $zkratka_vyucujiciho['zkratka_vyucujiciho'] . '">' . $zkratka_vyucujiciho['zkratka_vyucujiciho'] . '</option>';
                        }
                    ?>
                    <option value="other">Other</option>
                </select>

                <div id="zkratka-vyucujiciho-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="zkratka-vyucujiciho-custom-input" name="zkratka_vyucujiciho_custom" placeholder="Zkratka vyučujícího">
                </div>
                <label for="jmeno_vyucujiciho">Jméno vyučujícího</label>
                <select class="form-control" id="jmeno_vyucujiciho" name="jmeno_vyucujiciho">
                    <?php 
                        foreach ($jmena_vyucujicich as $jmeno_vyucujiciho) {
                            echo '<option value="' . $jmeno_vyucujiciho['jmeno_vyucujiciho'] . '">' . $jmeno_vyucujiciho['jmeno_vyucujiciho'] . '</option>';
                        }
                    ?>
                    <option value="other">Other</option>
                </select>

                <div id="jmeno-vyucujiciho-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="jmeno-vyucujiciho-custom-input" name="jmeno_vyucujiciho_custom" placeholder="Jméno vyučujícího">
                </div>
                <label for="ucebna">Učebna</label>
                <select class="form-control" id="ucebna" name="ucebna">
                    <?php 
                        foreach ($ucebny as $ucebna) {
                            echo '<option value="' . $ucebna['ucebna'] . '">' . $ucebna['ucebna'] . '</option>';
                        }
                    ?>
                    <option value="other">Other</option>
                </select>

                <div id="ucebna-custom" style="display:none;">
                    <input type="text" class="form-control mt-2" id="ucebna-custom-input" name="ucebna_custom"
                        placeholder="Název učebny">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="update_rozvrh">Uložit změny</button>
        </form>
    </div>
    <script src="./js/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ucebna').change(function () {
                if ($(this).val() == 'other') {
                    $('#ucebna-custom').show();
                    $('#ucebna-custom-input').attr('required', true);
                } else {
                    $('#ucebna-custom').hide();
                    $('#ucebna-custom-input').attr('required', false);
                }
            });
        });
    </script>
</body>

</html>