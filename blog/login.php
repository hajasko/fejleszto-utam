<?php
session_start();
require_once 'config/db.php';

$hiba = '';

if (!empty($_SESSION['felhasznalo'])) {
    header ('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    $stmt = $pdo->prepare("SELECT * FROM felhasznalok WHERE email = :email");
    $stmt->execute([':email'=>$email]);
    $felhasznalo = $stmt->fetch();

    if (!empty($felhasznalo) && password_verify($jelszo, $felhasznalo['jelszo'])) {
        $_SESSION['felhasznalo'] = $email;
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
    <title>Blog - Bejelentkezés</title>
</head>
<body>

    <form action="#" method="post">
        <div>
            <div>
                <input type="email" name="email" id="" placeholder="Email">
            </div>
            <div>
                <input type="password" name="jelszo" id="" placeholder="Jelszó">
            </div>
        </div>
        <button type="submit">Bejelentkezés</button>
    </form>
    <?php
        if (!empty($hiba)) echo "<p>$hiba</p>";
    ?>
    
</body>
</html>