<?php
session_start();
require_once('config/db.php');

if (empty($_SESSION['felhasznalo'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}



$id = $_POST['id'];
try {
    $stmt = $pdo->prepare("DELETE FROM `bejegyzesek` WHERE id = :id");
    $stmt->execute([':id'=>$id]);
    $_SESSION['uzenet'] = 'Bejegyzés sikeresen törölve.';
} catch (PDOException $e) {
    $_SESSION['uzenet'] = 'A bejegyzés törlése sikertelen.';
} finally {
    header('Location: dashboard.php');
    exit;
}

?>