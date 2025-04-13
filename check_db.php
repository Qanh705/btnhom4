<?php
// Kết nối database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_db"; // Database chính xác

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lấy thông tin cấu trúc bảng users
    $stmt = $conn->prepare("DESCRIBE users");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== Cấu trúc bảng users ===\n";
    foreach ($columns as $column) {
        echo "Cột: {$column['Field']}, Kiểu: {$column['Type']}, Null: {$column['Null']}, Key: {$column['Key']}\n";
    }
    
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
} 