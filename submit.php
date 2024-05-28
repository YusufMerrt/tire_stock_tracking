<?php
// Veritabanı bağlantısı için gerekli bilgileri buraya ekleyin
$servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "deneme61";

// Formdan gelen verileri alın
$user = $_POST['username'];
$pass = $_POST['password'];
$action = $_POST['action'];

// Veritabanına bağlan
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if ($action == 'register') {
    // Kullanıcı adının daha önce kayıtlı olup olmadığını kontrol et
    $sql = "SELECT * FROM users WHERE username='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        // Kullanıcı adı daha önce kayıtlı değilse, yeni kullanıcıyı ekle
        $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
        
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
    }
} elseif ($action == 'login') {
    // Kullanıcı girişini kontrol et
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "login_success";
    } else {
        echo "not_found";
    }
}

$conn->close();
?>
