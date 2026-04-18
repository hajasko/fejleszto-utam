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

</body>
</html>