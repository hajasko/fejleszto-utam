<?php
session_start();

if (!empty($_SESSION['felhasznalo'])) {
   header('Location: dashboard.php');
   exit; 
}

$hiba = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    if ($email == 'admin@teszt.hu' && $jelszo == 'titok123') {
        $_SESSION['felhasznalo'] = 'admin';
        header('Location: dashboard.php');
        exit;
    } else {
        $hiba = 'Hibás email vagy jelszó...';   
    }

}

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session login</title>
</head>
<body>
    <form action="#" method="post">
        <input type="email" name="email" id="email" placeholder="Email">
        <input type="password" name="jelszo" id="jelszo" placeholder="Jelszó">
        <button type="submit">Küldés</button>
    </form>
    
    <?php if (!empty($hiba)) echo "<p>$hiba</p>"?>
</body>
</html>