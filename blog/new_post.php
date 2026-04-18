<?php
session_start();
require_once 'config/db.php';

$hiba = '';

if (empty($_SESSION['felhasznalo'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cim = $_POST['cim'];
    $tartalom = $_POST['tartalom'];

    if (!empty($cim) && !empty($tartalom)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bejegyzesek (cim,tartalom) VALUES (:cim, :tartalom)");
            $stmt->execute([':cim'=>$cim, ':tartalom'=>$tartalom]); 
            $_SESSION['uzenet'] = 'A bejegyzés sikeresen mentve!';
            header('Location: dashboard.php');
            exit;
        } catch (PDOException $e) {
            $hiba = 'Mentés sikertelen, próbáld újra!';
        }
    } else {
        $hiba = 'Minden mezőt ki kell tölteni... ';
    }
}


?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Új bejegyzés</title>
</head>
<body>
    <h1>Új bejegyzés létrehozása: </h1>
    <form action="#" method="post">
        <div>
            <label for="cim">Cím:</label>
            <input type="text" name="cim" id="cim">
        </div>
        <div>
            <label for="tartalom">Tartalom:</label>
            <textarea name="tartalom" id="tartalom" rows="10" cols="50"></textarea>
        </div>
        <button type="submit">Létrehoz</button>
    </form>

    <?php if (!empty($hiba)) echo "<p>$hiba</p>";?>
    
</body>
</html>