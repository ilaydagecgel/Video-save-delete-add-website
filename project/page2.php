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
    die("There is no connection on db " . $e->getMessage());
}

// Videoları listele
$query = $db->prepare("SELECT * FROM video WHERE is_deleted = 0");
$query->execute();
$videolar = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Videolar</title>
    <style>


h2 {
  color: #333;
  text-align: center;
}
button1 {
   
           

            position: absolute;
            bottom: 400px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  background-color: #29C5F6;
  background-color: ;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
        }

       

    </style>
</head>
<body>
    <h2>Videolar</h2>
    <?php foreach ($videolar as $video) : ?>
        <div>
            <a href="<?php echo $video['video_url']; ?>" target="_blank">
                <img src="https://img.youtube.com/vi/<?php echo $video['video_id']; ?>/default.jpg" alt="Video Resmi">
            </a>
            <p><?php echo $video['video_isim']; ?></p>
            <button onclick="silVideo(<?php echo $video['video_id']; ?>)">Delete</button>
            <button onclick="guncelleVideo(<?php echo $video['video_id']; ?>)">Update</button>
        </div>
    <?php endforeach; ?>

    <button1 onclick="window.location.href='page3.php'">Add New Video</button1> 

    <script>
        function silVideo(videoID) {
            if (confirm("Are you sure do you want to delete this video?")) {
                window.location.href = "sil.php?videoID=" + videoID;
            }
        }

        function guncelleVideo(videoID) {
            window.location.href = "page4.php?videoID=" + videoID;
        }
    </script>
</body>
</html>
