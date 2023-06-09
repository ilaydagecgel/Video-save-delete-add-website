<?php
// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'hotel_db';
$username = 'root';
$password = '';
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanına bağlantı sağlanamadı: " . $e->getMessage());
}

// Video kimliğini al
$videoID = $_GET["videoID"];

// Videoyu silme işlemi
$query = $db->prepare("UPDATE video SET is_deleted = 1 WHERE video_id = ?");
$query->execute([$videoID]);

// Silme işlemi tamamlandığında, sayfayı yeniden yükle
header("Location: page2.php");
exit();
?>
