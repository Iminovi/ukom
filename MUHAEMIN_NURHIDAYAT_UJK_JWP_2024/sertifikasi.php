<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST['add_skema'])) {
        $kd_skema = $_POST['kd_skema'];
        $nm_skema = $_POST['nm_skema'];
        $jenis = $_POST['jenis'];
        $jml_unit = $_POST['jml_unit'];

        $sql = "INSERT INTO Skema (kd_skema, nm_skema, jenis, jml_unit)
        VALUES ('$kd_skema', '$nm_skema', '$jenis', '$jml_unit')";

        if ($conn->query($sql) === TRUE) {
            echo "Data skema berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['delete_skema'])) {
        $kd_skema = $_POST['kd_skema'];
        $sql = "DELETE FROM Skema WHERE kd_skema='$kd_skema'";

        if ($conn->query($sql) === TRUE) {
            echo "Data skema berhasil dihapus!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['edit_skema'])) {
        $kd_skema = $_POST['kd_skema'];
        $nm_skema = $_POST['nm_skema'];
        $jenis = $_POST['jenis'];
        $jml_unit = $_POST['jml_unit'];

        $sql = "UPDATE Skema SET nm_skema='$nm_skema', jenis='$jenis', jml_unit='$jml_unit'
                WHERE kd_skema='$kd_skema'";

        if ($conn->query($sql) === TRUE) {
            echo "Data skema berhasil diupdate!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

  
    if (isset($_POST['add_peserta'])) {
        $kd_skema = $_POST['kd_skema'];
        $nm_peserta = $_POST['nm_peserta'];
        $jekel = $_POST['jekel'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        $sql = "INSERT INTO Peserta (kd_skema, nm_peserta, jekel, alamat, no_hp)
        VALUES ('$kd_skema', '$nm_peserta', '$jekel', '$alamat', '$no_hp')";

        if ($conn->query($sql) === TRUE) {
            echo "Data peserta berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['delete_peserta'])) {
        $id_peserta = $_POST['id_peserta'];
        $sql = "DELETE FROM Peserta WHERE id_peserta='$id_peserta'";

        if ($conn->query($sql) === TRUE) {
            echo "Data peserta berhasil dihapus!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if (isset($_POST['edit_peserta'])) {
        $id_peserta = $_POST['id_peserta'];
        $kd_skema = $_POST['kd_skema'];
        $nm_peserta = $_POST['nm_peserta'];
        $jekel = $_POST['jekel'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        $sql = "UPDATE Peserta SET kd_skema='$kd_skema', nm_peserta='$nm_peserta', jekel='$jekel', alamat='$alamat', no_hp='$no_hp'
                WHERE id_peserta='$id_peserta'";

        if ($conn->query($sql) === TRUE) {
            echo "Data peserta berhasil diupdate!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$skema_sql = "SELECT * FROM Skema";
$skema_result = $conn->query($skema_sql);

$peserta_sql = "SELECT * FROM Peserta";
$peserta_result = $conn->query($peserta_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Sertifikasi</title>
</head>
<body>
    <h1>Kelola Sertifikasi</h1>
    <a href="logout.php">Logout</a>

    <h2>Tambah Skema</h2>
    <form method="POST" action="sertifikasi.php">
        <label>Kode Skema:</label>
        <input type="text" name="kd_skema" required>
        <br>
        <label>Nama Skema:</label>
        <input type="text" name="nm_skema" required>
        <br>
        <label>Jenis:</label>
        <input type="text" name="jenis" required>
        <br>
        <label>Jumlah Unit:</label>
        <input type="number" name="jml_unit" required>
        <br>
        <input type="submit" name="add_skema" value="Tambah">
    </form>
    <br><br>

    <h2>Data Skema</h2>
    <table border="1">
        <tr>
            <th>Kode Skema</th>
            <th>Nama Skema</th>
            <th>Jenis</th>
            <th>Jumlah Unit</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($skema_result->num_rows > 0) {
            while($row = $skema_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['kd_skema']}</td>
                        <td>{$row['nm_skema']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['jml_unit']}</td>
                        <td>
                            <form method='POST' action='sertifikasi.php' style='display:inline;'>
                                <input type='hidden' name='kd_skema' value='{$row['kd_skema']}'>
                                <input type='submit' name='delete_skema' value='Hapus'>
                            </form>
                            <form method='POST' action='sertifikasi.php' style='display:inline;'>
                                <input type='hidden' name='kd_skema' value='{$row['kd_skema']}'>
                                <input type='text' name='nm_skema' value='{$row['nm_skema']}' required>
                                <input type='text' name='jenis' value='{$row['jenis']}' required>
                                <input type='number' name='jml_unit' value='{$row['jml_unit']}' required>
                                <input type='submit' name='edit_skema' value='Edit'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
    <br><br>

    <h2>Tambah Peserta</h2>
    <form method="POST" action="sertifikasi.php">
        <label>Kode Skema:</label>
        <select name="kd_skema">
            <option value="SK01">skema1</option>
            <option value="SK02">skema2</option>
        </select>
        <br>
            <?php
            if ($skema_result->num_rows > 0) {
                while($row = $skema_result->fetch_assoc()) {
                    echo "<option value='{$row['kd_skema']}'>{$row['nm_skema']}</option>";
                }
            } else {
                echo "<option value=''>Tidak ada skema tersedia</option>";
            }
            ?>
        </select>
        <br>
        <label>Nama Peserta:</label>
        <input type="text" name="nm_peserta" required>
        <br>
        <label>Jenis Kelamin:</label>
        <select name="jekel">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <br>
        <label>Alamat:</label>
        <textarea name="alamat" required></textarea>
        <br>
        <label>No HP:</label>
        <input type="text" name="no_hp" required>
        <br>
        <input type="submit" name="add_peserta" value="Tambah">
    </form>
    <br><br>

    <h2>Data Peserta</h2>
    <table border="1">
        <tr>
            <th>ID Peserta</th>
            <th>Kode Skema</th>
            <th>Nama Peserta</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($peserta_result->num_rows > 0) {
            while($row = $peserta_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_peserta']}</td>
                        <td>{$row['kd_skema']}</td>
                        <td>{$row['nm_peserta']}</td>
                        <td>{$row['jekel']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['no_hp']}</td>
                        <td>
                            <form method='POST' action='sertifikasi.php' style='display:inline;'>
                                <input type='hidden' name='id_peserta' value='{$row['id_peserta']}'>
                                <input type='submit' name='delete_peserta' value='Hapus'>
                            </form>
                            <form method='POST' action='sertifikasi.php' style='display:inline;'>
                                <input type='hidden' name='id_peserta' value='{$row['id_peserta']}'>
                                <input type='text' name='kd_skema' value='{$row['kd_skema']}' required>
                                <input type='text' name='nm_peserta' value='{$row['nm_peserta']}' required>
                                <select name='jekel' required>
                                    <option value='L' " . ($row['jekel'] == 'L' ? 'selected' : '') . ">Laki-laki</option>
                                    <option value='P' " . ($row['jekel'] == 'P' ? 'selected' : '') . ">Perempuan</option>
                                </select>
                                <textarea name='alamat' required>{$row['alamat']}</textarea>
                                <input type='text' name='no_hp' value='{$row['no_hp']}' required>
                                <input type='submit' name='edit_peserta' value='Edit'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</body>
</html>

<?php
$conn->close();
?>

