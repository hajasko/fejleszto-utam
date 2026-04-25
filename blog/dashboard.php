<?php
session_start();
require_once 'config/db.php';

if (empty($_SESSION['felhasznalo'])) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM `bejegyzesek` ORDER BY `letrehozva` DESC");
$stmt->execute();


?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Felhasználói felület</title>
</head>
<body>
    <h1>Üdvözöllek <?php echo $_SESSION['felhasznalo']?>!!!</h1>
    <?php 
        if (!empty($_SESSION['uzenet'])):
            echo "<p>".$_SESSION['uzenet']."</p>";
            unset($_SESSION['uzenet']);
        endif;
    ?>
    
    <div>
        <a href="./new_post.php">Új bejegyzés</a>
    </div>
    <form action="./logout.php" method="post">
        <button type="submit">Kijelentkezés</button>
    </form>

    <?php 
        while ($bejegyzes = $stmt->fetch()) {
    ?>
    <h2><?php echo htmlspecialchars($bejegyzes['cim']);?></h2>
    <p><?php echo htmlspecialchars($bejegyzes['tartalom']);?></p>
    <p><?php echo htmlspecialchars($bejegyzes['letrehozva']);?></p>
    <div>
        <a href="edit_post.php?id=<?php echo $bejegyzes['id'];?>">
            <button>Szerkesztés</button>
        </a>
        <form action="delete_post.php" method="post">
            <input type="hidden" name="id" value="<?php echo $bejegyzes['id'];?>">
            <button type="submit">Törlés</button>
        </form>
    </div>
    <?php } ?>

</body>
</html>