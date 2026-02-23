<?php
$dbHost = 'localhost';
$dbName = 'fejleszto-tesz';
$dbUserName = 'root';
$dbPassword = '';
$dsn = "mysql:host=$dbHost;dbname=$dbName";

$pdo = new PDO($dsn, $dbUserName, $dbPassword,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

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