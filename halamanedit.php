<?php
include 'config.php';

// Cek apakah ada parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// Ambil data dari database
$query = "SELECT * FROM pendaftaran WHERE id_pendaftaran = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftaran</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eaf4fc;
            color: #333;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #0a4a8f;
            margin-bottom: 30px;
        }

        form {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            margin-top: 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <h1>Edit Data Pendaftaran</h1>
    <form action="prosesedit.php" method="post">
        <input type="hidden" name="id_pendaftaran" value="<?= $data['id_pendaftaran']; ?>">

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= $data['nama']; ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?= $data['alamat']; ?>" required>

        <label for="nopol">Nopol:</label>
        <input type="text" id="nopol" name="nopol" value="<?= $data['nopol']; ?>" required>

        <label for="type_motor">Type Motor:</label>
        <input type="text" id="type_motor" name="type_motor" value="<?= $data['type_motor']; ?>" required>

        <label for="paket_service">Paket Service:</label>
        <select id="paket_service" name="paket_service" onchange="updateHargaService()" required>
            <option value="service_ringan" <?= ($data['paket_service'] == 'service_ringan') ? 'selected' : ''; ?>>Service Ringan - 75rb</option>
            <option value="service_berat" <?= ($data['paket_service'] == 'service_berat') ? 'selected' : ''; ?>>Service Berat - 150rb</option>
            <option value="ganti_oli" <?= ($data['paket_service'] == 'ganti_oli') ? 'selected' : ''; ?>>Ganti Oli - 50rb</option>
        </select>

        <input type="hidden" id="harga_service" name="harga_service" value="<?= $data['harga_service']; ?>">

        <label for="keluhan">Keluhan:</label>
        <input type="text" id="keluhan" name="keluhan" value="<?= $data['keluhan']; ?>" required>

        <input type="submit" value="Simpan Perubahan">
    </form>

    <script>
        function updateHargaService() {
            var paketService = document.getElementById('paket_service').value;
            var hargaService = 0;

            if (paketService === 'service_ringan') {
                hargaService = 75000;
            } else if (paketService === 'service_berat') {
                hargaService = 150000;
            } else if (paketService === 'ganti_oli') {
                hargaService = 50000;
            }

            document.getElementById('harga_service').value = hargaService;
        }
    </script>
</body>

</html>
