<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kd_skema = $_POST['kd_skema'];
    $nm_peserta = $_POST['nm_peserta'];
    $jekel = $_POST['jekel'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $sql = "INSERT INTO Peserta (kd_skema, nm_peserta, jekel, alamat, no_hp)
    VALUES ('$kd_skema', '$nm_peserta', '$jekel', '$alamat', '$no_hp')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Sertifikasi</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Form Pendaftaran Sertifikasi</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="form_pendaftaran.php">
                    <div class="form-group">
                        <label for="kd_skema">Kode Skema:</label>
                        <select class="form-control" id="kd_skema" name="kd_skema">
                            <option value="SK01">skema1</option>
                            <option value="SK02">skema2</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nm_peserta">Nama Peserta:</label>
                        <input type="text" class="form-control" id="nm_peserta" name="nm_peserta" required>
                    </div>
                    <div class="form-group">
                        <label for="jekel">Jenis Kelamin:</label>
                        <select class="form-control" id="jekel" name="jekel">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    <a class="nav-link" href="index.php">kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
