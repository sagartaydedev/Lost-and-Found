<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "sql113.infinityfree.com";
$dbname = "if0_40477351_lostfound_db";
$username = "if0_40477351";
$password = "8767Sam8767";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
