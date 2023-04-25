<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lidlrozvrh";

// Připojení k databázi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Připojení k databázi se nezdařilo: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM uzivatele WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Uživatel s tímto e-mailem již existuje.";
        header("Location: registrace.php");
        die();
    } else {
        $sql = "INSERT INTO uzivatele (email, heslo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password_hash);
        if ($stmt->execute()) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            header("Location: rozvrh.php");
            die();
        } else {
            $_SESSION['error'] = "Něco se pokazilo. Zkuste to prosím znovu.";
            header("Location: registrace.php");
            die();
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM uzivatele WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['heslo'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            header("Location: rozvrh.php");
            die();
        } else {
            $_SESSION['error'] = "Špatné heslo.";
            header("Location: login.php");
            die();
        }
    } else {
        $_SESSION['error'] = "Uživatel s tímto e-mailem neexistuje.";
        header("Location: login.php");
        die();
    }
}

if (isset($_POST['update_rozvrh'])) {
    $den_v_tydnu = $_POST['den_v_tydnu'];
    $casovy_usek_id = $_POST['casovy_usek_id'];
    $zkratka_predmetu = $_POST['zkratka_predmetu'];
    $nazev_predmetu = $_POST['nazev_predmetu'];
    $zkratka_vyucujiciho = $_POST['zkratka_vyucujiciho'];
    $jmeno_vyucujiciho = $_POST['jmeno_vyucujiciho'];
    $ucebna = $_POST['ucebna'];

    //$sql = "INSERT INTO rozvrh ( den_v_tydnu, casovy_usek_id, zkratka_predmetu, nazev_predmetu, zkratka_vyucujiciho, jmeno_vyucujiciho, ucebna) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sql = "INSERT INTO rozvrh (den_v_tydnu, casovy_usek_id, zkratka_predmetu, nazev_predmetu, zkratka_vyucujiciho, jmeno_vyucujiciho, ucebna) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE zkratka_predmetu = VALUES(zkratka_predmetu), nazev_predmetu = VALUES(nazev_predmetu), zkratka_vyucujiciho = VALUES(zkratka_vyucujiciho), jmeno_vyucujiciho = VALUES(jmeno_vyucujiciho), ucebna = VALUES(ucebna)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssss", $den_v_tydnu, $casovy_usek_id, $zkratka_predmetu, $nazev_predmetu, $zkratka_vyucujiciho, $jmeno_vyucujiciho, $ucebna);
    if ($stmt->execute()) {
        header("Location: rozvrh.php");
        die();
    } else {
        $_SESSION['error'] = "Něco se pokazilo. Zkuste to prosím znovu.";
        header("Location: rozvrh_editor.php");
        die();
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    die();
}


$conn->close();
?>
