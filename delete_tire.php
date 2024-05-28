<?php
$servername = "95.130.171.20";
$username = "st21360859057"; // XAMPP varsayılan kullanıcı adı
$password = "st21360859057"; // XAMPP varsayılan şifre boş
$dbname = "dbstorage21360859057";
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
