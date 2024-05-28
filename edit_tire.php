<?php
// edit_tire.php

// Veritabanı bağlantı bilgileri
$servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "deneme61";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Düzenlenecek lastiğin ID'sini al
$id = $_GET['id'];

// ID'ye göre lastiği seç
$sql = "SELECT * FROM lastikler WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $editMarka = $row["marka"];
    $editCap = $row["cap"];
    $editYana = $row["yana"];
    $editGenislik = $row["genislik"];
    $editAdet = $row["adet"];
} else {
    echo "Lastik bulunamadı.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form verilerini al
    $marka = $_POST['marka'];
    $cap = $_POST['cap'];
    $yana = $_POST['yana'];
    $genislik = $_POST['genislik'];
    $adet = $_POST['adet'];

    // Veriyi güncelle
    $sql = "UPDATE lastikler SET marka='$marka', cap='$cap', yana='$yana', genislik='$genislik', adet='$adet' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Başarılı bir şekilde güncellendiğinde success.php sayfasına yönlendir
        header("Location: success.php");
        exit;
    } else {
        echo "Güncelleme hatası: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lastik Bilgileri Düzenle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Lastik Bilgileri Düzenle</h1>
                <form id="editTireForm" method="POST">
                    <div class="form-group">
                        <label for="marka">Lastik Markası:</label>
                        <select class="form-control" id="marka" name="marka" required>
                            <option value="">Marka Seçiniz</option>
                            <option value="BRIDGESTONE" <?php if($editMarka == "BRIDGESTONE") echo "selected"; ?>>BRIDGESTONE</option>
                            <option value="CONTINENTAL" <?php if($editMarka == "CONTINENTAL") echo "selected"; ?>>CONTINENTAL</option>
                            <option value="DAYTON" <?php if($editMarka == "DAYTON") echo "selected"; ?>>DAYTON</option>
                            <option value="GOODYEAR" <?php if($editMarka == "GOODYEAR") echo "selected"; ?>>GOODYEAR</option>
                            <option value="LASSA" <?php if($editMarka == "LASSA") echo "selected"; ?>>LASSA</option>
                            <option value="MICHELIN" <?php if($editMarka == "MICHELIN") echo "selected"; ?>>MICHELIN</option>
                            <option value="PETLAS" <?php if($editMarka == "PETLAS") echo "selected"; ?>>PETLAS</option>
                            <option value="PIRELLI" <?php if($editMarka == "PIRELLI") echo "selected"; ?>>PIRELLI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cap">Lastik Çapı:</label>
                        <select class="form-control" id="cap" name="cap" required>
                            <option value="">Çap Seçiniz</option>
                            <?php
                            for ($i = 14; $i <= 22; $i++) {
                                echo "<option value='$i' ";
                                if ($editCap == $i) echo "selected";
                                echo ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="yana">Lastik Yanağı:</label>
                        <select class="form-control" id="yana" name="yana" required>
                            <option value="">Yanak Seçiniz</option>
                            <?php
                            for ($i = 25; $i <= 80; $i += 5) {
                                echo "<option value='$i' ";
                                if ($editYana == $i) echo "selected";
                                echo ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="genislik">Lastik Genişliği:</label>
                        <select class="form-control" id="genislik" name="genislik" required>
                            <option value="">Genişlik Seçiniz</option>
                            <?php
                            for ($i = 145; $i <= 315; $i += 10) {
                                echo "<option value='$i' ";
                                if ($editGenislik == $i) echo "selected";
                                echo ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adet">Adet:</label>
                        <input type="number" class="form-control" id="adet" name="adet" value="<?php echo $editAdet; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
