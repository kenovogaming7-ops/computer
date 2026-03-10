<?php
// Database configuration
$host = 'localhost';
$dbname = 'database_name';
$user = 'username';
$password = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Helper functions
function fetchAllUsers() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM users');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>