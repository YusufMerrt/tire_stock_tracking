<?php
$servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "deneme61";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM lastikler WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla silindi";
    } else {
        echo "Hata: " . $conn->error;
    }
} else {
    echo "Geçersiz istek";
}

$conn->close();
?>
