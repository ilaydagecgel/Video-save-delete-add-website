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

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $videoUrl = $_POST["videoUrl"];
    $videoIsim = $_POST["videoIsim"];

    // Videoyu güncelle
    $query = $db->prepare("UPDATE video SET video_url = ?, video_isim = ? WHERE video_id = ?");
    $query->execute([$videoUrl, $videoIsim, $videoID]);

    // İkinci sayfaya yönlendir
    header("location: page2.php");
}

// Video bilgilerini al
$query = $db->prepare("SELECT * FROM video WHERE video_id = ?");
$query->execute([$videoID]);
$video = $query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Video Güncelle</title>
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
    <h2>Update video</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] . "?videoID=" . $videoID; ?>">
        <label for="videoUrl">Video URL:</label>
        <input type="text" name="videoUrl" value="<?php echo $video['video_url']; ?>" required><br><br>
        <label for="videoIsim">Video Name:</label>
        <input type="text" name="videoIsim" value="<?php echo $video['video_isim']; ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
