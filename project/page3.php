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

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoUrl = $_POST["videoUrl"];
    $videoIsim = $_POST["videoIsim"];
    $isDeleted = 0;
    $dateAdded = date("Y-m-d H:i:s");

    // Veritabanına yeni video kaydet
    $query = $db->prepare("INSERT INTO video (video_url, video_isim, is_deleted, date_added) VALUES (?, ?, ?, ?)");
    $query->execute([$videoUrl, $videoIsim, $isDeleted, $dateAdded]);

    // İkinci sayfaya yönlendir
    header("location: page2.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Video Ekle</title>
    <style>
    h2 {
  color: #333;
  text-align: center;
}

form {
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-sizing: border-box;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: #3944BC;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #29C5F6;
}
</style>

</head>
<body>
    <h2>New Video</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="videoUrl">Video URL:</label>
        <input type="text" name="videoUrl" required><br><br>
        <label for="videoIsim">Video Name:</label>
        <input type="text" name="videoIsim" required><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>
