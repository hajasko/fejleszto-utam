<?php
$dbHost = 'localhost';
$dbName = 'fejleszto-tesz';
$dbUserName = 'root';
$dbPassword = '';
$dsn = "mysql:host=$dbHost;dbname=$dbName";

$pdo = new PDO($dsn, $dbUserName, $dbPassword,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = trim($_POST['nev']);
    $email = trim($_POST['email']);
    $kor = trim($_POST['kor']);

    if(!empty($nev) && !empty($email) && !empty($kor)) {
        $stmt = $pdo->prepare("INSERT INTO felhasznalok (nev, email, kor) VALUES (:nev, :email, :kor)");
        $stmt->execute([
                ':nev'=>$nev,
                ':email'=>$email,
                ':kor'=>$kor
            ]);
        header('Location: index.php');
        exit;
    }
}

$result = $pdo->query("SELECT * FROM felhasznalok;");






?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-teszt</title>
</head>
<body>
    <section>
        <h2>Új felhasználó felvitele:</h2>
        <form action="#" method="post">
            <div>
                <label for="nev">Név: </label>
                <input type="text" name="nev" id="nev">
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="kor">Kor: </label>
                <input type="number" name="kor" id="kor">
            </div>
            <input type="submit" value="Felvitel">
        </form>
    </section>
    
    <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Email</th>
                <th>Kor</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($user = $result->fetch()) {
                    // echo "{$user['nev']} \t {$user['email']} \t {$user['kor']}".PHP_EOL;
                    echo "<tr>
                            <td>".htmlspecialchars($user['nev'])."</td>
                            <td>".htmlspecialchars($user['email'])."</td>
                            <td>".htmlspecialchars($user['kor'])."</td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
    
</body>
</html>
<?php
$pdo = null;
?>