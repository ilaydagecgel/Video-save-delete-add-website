<!DOCTYPE html>
<html>
<head>
    <title>Kullanıcı Girişi</title>
    <style>

body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

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

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  box-sizing: border-box;
}

input[type="submit"] {
  width: 100%;
  padding: 10px;
  background-color: blue;
  color: #fff;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3944BC;
}




    </style>
    
</head>
<body>
    <?php
    // Kullanıcı adı ve şifre kontrolü
    $kullaniciAdi = "ilayda";
    $sifre = "123";

    // Form gönderildiğinde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $girilenKullaniciAdi = $_POST["kullaniciAdi"];
        $girilenSifre = $_POST["sifre"];

    
        if ($girilenKullaniciAdi == $kullaniciAdi && $girilenSifre == $sifre) {
            
            session_start();
            $_SESSION["loggedin"] = true;

            
            header("location: page2.php");
        } 
        else {
            echo "Unvalid username or password";
        }
    }
    ?>
    <h2 id="1">Kullanıcı Girişi</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="kullaniciAdi">Username:</label>
        <input type="text" name="kullaniciAdi" required><br><br>
        <label for="sifre">Password</label>
        <input type="password" name="sifre" required><br><br>
        <input type="submit" value="LOGIN">
    </form>
</body>
</html>
