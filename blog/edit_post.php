<?php
session_start();
require_once 'config/db.php';

if (empty($_SESSION['felhasznalo'])) {
    header('Location: login.php');
    exit;
}

$hiba = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $cim = $_POST['cim'];
    $tartalom = $_POST['tartalom'];Ö

    if (!empty($cim) && !empty($tartalom)){
        try {
            $stmt = $pdo->prepare("UPDATE `bejegyzesek` SET cim = :cim, tartalom = :tartalom WHERE id = :id");
            $stmt->execute([
                ':cim' => $cim,
                ':tartalom' => $tartalom,
                ':id' => $id
            ]);
            $_SESSION['uzenet'] = "Módosítás lefutott";
        } catch (PDOException $e) {
            $_SESSION['uzenet'] = 'Valami hiba történt. A frissítés sikertelen...';
        } finally {
            header('Location: dashboard.php');
            exit;
        }
    } else {
        $hiba = 'Kérlek tölts ki minden mezőt...';
    }
}

$stmt = $pdo->prepare("SELECT * FROM `bejegyzesek` WHERE `id` = :id");
$stmt->execute([':id'=>$id]);

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Bejegyzés szerkesztése</title>
</head>
<body>
    <h1>Bejegyzés szerkesztése</h1>
    <?php while ($bejegyzes = $stmt->fetch()) {?>
    <form action="#" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($bejegyzes['id'])?>">
        <div>
            <label for="cim">Cím:</label>
            <input type="text" name="cim" id="cim" value="<?php echo htmlspecialchars($bejegyzes['cim'])?>">
        </div>
        <div>
            <label for="tartalom">Tartlom:</label>
            <textarea name="tartalom" id="tartalom" rows="10" cols="50"><?php echo htmlspecialchars($bejegyzes['tartalom'])?></textarea>
        </div>
        <button type="submit">Mentés</button>
    </form>
    <?php }
    if (!empty($hiba)) echo "<p>$hiba</p>";?>
</body>
</html>