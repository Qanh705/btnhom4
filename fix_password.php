<?php
// Kết nối database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_db"; // Database chính xác

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Sửa độ dài cột password nếu cần
    $stmt = $conn->prepare("
        ALTER TABLE users
        MODIFY COLUMN password varchar(255) NOT NULL
    ");
    $stmt->execute();
    
    echo "Đã sửa độ dài cột password thành công!\n";
    
    // Kiểm tra lại cấu trúc
    $stmt = $conn->prepare("DESCRIBE users");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "=== Cấu trúc bảng users sau khi sửa ===\n";
    foreach ($columns as $column) {
        echo "Cột: {$column['Field']}, Kiểu: {$column['Type']}, Null: {$column['Null']}, Key: {$column['Key']}\n";
    }
    
} catch(PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
} 