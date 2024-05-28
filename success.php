<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lastik Bilgileri Ekle</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('duvar.jpg') no-repeat center center fixed; 
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Beyaz konteyner arka planı, biraz saydam */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px; /* Formun genişliğini küçülttüm */
            margin: 30px auto; /* Ortaladı */
        }
        .conteynır{
            background-color: rgba(255, 255, 255, 0.8); /* Beyaz konteyner arka planı, biraz saydam */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px; /* Formun genişliğini küçülttüm */
            margin: 30px auto; /* Ortaladı */
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .table {
            background-color: #ffffff;
        }
        h1, h2 {
            color: #343a40; /* Koyu gri başlık rengi */
        }
        .form-control {
            border: 1px solid #ced4da;
        }
        .form-group label {
            color: #343a40; /* Koyu gri yazı rengi */
        }
        .btn-block {
            margin-top: 10px;
        }
        .delete-btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lastik Bilgileri Ekle</h1>
        <form id="tireForm" method="POST">
            <div class="form-group">
                <label for="marka">Lastik Markası:</label>
                <select class="form-control" id="marka" name="marka" required>
                    <option value="">Marka Seçiniz</option>
                    <option value="BRIDGESTONE">BRIDGESTONE</option>
                    <option value="CONTINENTAL">CONTINENTAL</option>
                    <option value="DAYTON">DAYTON</option>
                    <option value="GOODYEAR">GOODYEAR</option>
                    <option value="LASSA">LASSA</option>
                    <option value="MICHELIN">MICHELIN</option>
                    <option value="PETLAS">PETLAS</option>
                    <option value="PIRELLI">PIRELLI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cap">Lastik Çapı:</label>
                <select class="form-control" id="cap" name="cap" required>
                    <option value="">Çap Seçiniz</option>
                    <?php
                    for ($i = 14; $i <= 22; $i++) {
                        echo "<option value='$i'>$i</option>";
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
                        echo "<option value='$i'>$i</option>";
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
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="adet">Adet:</label>
                <input type="number" class="form-control" id="adet" name="adet" required>
            </div>
            <button type="button" id="saveButton" class="btn btn-primary btn-block">Kaydet</button>
        </form>
    </div>

    <div class="conteynır">
        <h2 class="text-center">Kayıtlı Lastikler</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Marka</th>
                    <th>Çap</th>
                    <th>Yana</th>
                    <th>Genişlik</th>
                    <th>Adet</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Veritabanından kayıtlı lastik verilerini çek
                $servername = "localhost";
$username = "root"; // XAMPP varsayılan kullanıcı adı
$password = ""; // XAMPP varsayılan şifre boş
$dbname = "deneme61";

                // Veritabanına bağlan
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Bağlantıyı kontrol et
                if ($conn->connect_error) {
                    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
                }

                // Kayıtlı lastik verilerini al ve tablo şeklinde göster
                $sql = "SELECT * FROM lastikler";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row["id"]."</td>
                                <td>".$row["marka"]."</td>
                                <td>".$row["cap"]."</td>
                                <td>".$row["yana"]."</td>
                                <td>".$row["genislik"]."</td>
                                <td>".$row["adet"]."</td>
                                <td>
                                    <a href='edit_tire.php?id=".$row["id"]."&editMarka=".$row["marka"]."&editCap=".$row["cap"]."&editYana=".$row["yana"]."&editGenislik=".$row["genislik"]."&editAdet=".$row["adet"]."' class='btn btn-primary btn-sm'>Düzenle</a>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='".$row["id"]."'>Sil</button>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Kayıtlı lastik bulunamadı.</td></tr>";
                }

                // Veritabanı bağlantısını kapat
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    if (confirm("Bu kaydı silmek istediğinize emin misiniz?")) {
                        fetch('delete_tire.php?id=' + id, {
                            method: 'GET'
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert(data); // Silme durumunu göster
                            if (data.includes('başarıyla')) { // Silme işlemi başarılı olduğunda
                                this.closest('tr').remove(); // Silinen satırı tablodan kaldırır
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });
        });

        // Kaydetme işlemi
document.getElementById('saveButton').onclick = function() {
    var marka = document.getElementById('marka').value;
    var cap = document.getElementById('cap').value;
    var yana = document.getElementById('yana').value;
    var genislik = document.getElementById('genislik').value;
    var adet = document.getElementById('adet').value;

    if (marka === "" || cap === "" || yana === "" || genislik === "" || adet === "") {
        alert("Lütfen tüm alanları doldurun.");
        return;
    }

    var formData = new FormData(document.getElementById('tireForm'));
    formData.append('action', 'save');

    fetch('save_tire.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Kayıt durumunu göster
        location.reload(); // Sayfayı yeniden yükle
    })
    .catch(error => {
        console.error('Error:', error);
    });
};

    </script>
</body>
</html>
