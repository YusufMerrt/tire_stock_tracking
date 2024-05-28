<?php
$servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "deneme61";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['marka']) && isset($_POST['cap']) && isset($_POST['yana']) && isset($_POST['genislik']) && isset($_POST['adet'])) {
    $marka = $conn->real_escape_string($_POST['marka']);
    $cap = intval($_POST['cap']);
    $yana = intval($_POST['yana']);
    $genislik = intval($_POST['genislik']);
    $adet = intval($_POST['adet']);

    $sql = "INSERT INTO lastikler (marka, cap, yana, genislik, adet) VALUES ('$marka', $cap, $yana, $genislik, $adet)";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla eklendi";
    } else {
        echo "Hata: " . $conn->error;
    }
} else {
    echo "Geçersiz istek";
}

$conn->close();
?>
