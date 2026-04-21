<?php
require_once('config/db.php');

$stmt = $pdo->prepare("SELECT * FROM `bejegyzesek` ORDER BY `letrehozva` DESC");
$stmt->execute(); 

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hajasko-Blog</title>
</head>
<body>

    <h1>Hajasko-Blog</h1>
    <?php 
        while ($bejegyzes = $stmt->fetch()) {
           ?> 
           <h2><?php echo htmlspecialchars($bejegyzes['cim']);?></h2>
           <p><?php echo htmlspecialchars($bejegyzes['tartalom'])?></p>
           <p><?php echo htmlspecialchars($bejegyzes['letrehozva'])?></p>
           <?php
        }
    ?>



    
</body>
</html>