<?php
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$ip = $_POST["ip"];

$pdo = new PDO("mysql:host=localhost;dbname=<DATABASE_NAME>", "<DATABASE_USERNAME>", "<DATABASE_PASSWORD>"); // Veritabanı bağlantısı

$ipControl = $pdo->query("SELECT * FROM location WHERE ip = '$ip'"); // Veritabanında ip kontrolü

if($ipControl->rowCount() > 0) {
    $pdo->exec("UPDATE location SET latitude = '$latitude', longitude = '$longitude' WHERE ip = '$ip'"); // Veritabanında kayıt varsa güncelleme
    echo "Güncelleme başarılı";
    exit();
}else{
    $pdo->exec("INSERT INTO location (latitude, longitude, ip) VALUES ('$latitude', '$longitude', '$ip')"); // Veritabanına kayıt ekleme


    if($pdo) {
        echo "Kayıt başarılı";
    } else {
        echo "Kayıt başarısız";
    }
}





?>
