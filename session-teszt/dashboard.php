<?php
session_start();
 if (empty($_SESSION['felhasznalo'])) {
    header('Location: login.php');
    exit;
 }



?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Felhasználói felület</title>
</head>
<body>
    <h2>Üdvözöllek <?php echo $_SESSION['felhasznalo']?>!</h2>
    <form action="logout.php" method="post">
        <button type="submit">Kijelentkezés</button>
    </form>

    
</body>
</html>