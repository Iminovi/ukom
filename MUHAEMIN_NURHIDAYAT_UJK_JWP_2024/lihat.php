<?php
include 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM Peserta WHERE nm_peserta LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - Data Peserta</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Data Peserta</h1>
        <form class="form-inline my-3" method="GET" action="index.php">
            <input type="text" class="form-control mr-2" name="search" placeholder="Cari nama peserta" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
        <a href="form_pendaftaran.php" class="btn btn-success mb-3">Form Pendaftaran Sertifikasi</a>
        <a href="login.php" class="btn btn-secondary mb-3">Login Admin</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID Peserta</th>
                    <th>Nama Peserta</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Kode Skema</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_peserta']}</td>
                                <td>{$row['nm_peserta']}</td>
                                <td>{$row['jekel']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['no_hp']}</td>
                                <td>{$row['kd_skema']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
