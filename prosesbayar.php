<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $part_tambahan = $_POST['part_motor'];
    $total_pembayaran = $_POST['total_pembayaran'];
    $tanggal_pembayaran = date('Y-m-d');

    $query_pembayaran = "INSERT INTO pembayaran (id_pendaftaran, part_tambahan, total_pembayaran, tanggal_pembayaran) 
                         VALUES ('$id_pendaftaran', '$part_tambahan', '$total_pembayaran', '$tanggal_pembayaran')";
    mysqli_query($conn, $query_pembayaran);

    $query_select = "SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
    $result_select = mysqli_query($conn, $query_select);
    $data = mysqli_fetch_assoc($result_select);

    if ($data) {
        $query_riwayat = "INSERT INTO riwayat_service (nama, alamat, nopol, type_motor, paket_service, keluhan, total_pembayaran, tanggal_service)
                          VALUES ('{$data['nama']}', '{$data['alamat']}', '{$data['nopol']}', '{$data['type_motor']}', '{$data['paket_service']}', '{$data['keluhan']}', '$total_pembayaran', NOW())";
        mysqli_query($conn, $query_riwayat);

        $query_delete_pembayaran = "DELETE FROM pembayaran WHERE id_pendaftaran = '$id_pendaftaran'";
        mysqli_query($conn, $query_delete_pembayaran);

        $query_delete_pendaftaran = "DELETE FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
        mysqli_query($conn, $query_delete_pendaftaran);
    }

    header("Location: index.php");
    exit();
} else {
    $id_pendaftaran = $_GET['id'];
    $query = "SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $nopol = $row['nopol'];
    $paket_service = $row['paket_service'];
    $harga_service = $row['harga_service'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
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

        p {
            margin: 10px 0;
            font-weight: 500;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="number"],
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
    <h1>Input Pembayaran</h1>
    <form method="post" action="prosesbayar.php">
        <input type="hidden" name="id_pendaftaran" value="<?php echo $id_pendaftaran; ?>">

        <p><strong>Nama:</strong> <?php echo $nama; ?></p>
        <p><strong>Nopol:</strong> <?php echo $nopol; ?></p>
        <p><strong>Paket Service:</strong> <?php echo $paket_service; ?></p>

        <label for="part_motor">Part Motor:</label>
        <select id="part_motor" name="part_motor" onchange="updateTotalPembayaran()">
            <option value="0">Pilih Part Motor</option>
            <option value="50000">Kampas Rem - 50rb</option>
            <option value="30000">Lampu Depan - 30rb</option>
            <option value="150000">Ban - 150rb</option>
        </select>

        <label for="harga_service">Harga Service:</label>
        <input type="text" id="harga_service_display" value="<?php echo number_format($harga_service, 0, ',', '.'); ?> IDR" readonly>
        <input type="hidden" id="harga_service" name="harga_service" value="<?php echo $harga_service; ?>">

        <label for="total_pembayaran">Total Pembayaran:</label>
        <input type="number" id="total_pembayaran" name="total_pembayaran" step="0.01" readonly>

        <input type="submit" value="Bayar">
    </form>

    <script>
        function updateTotalPembayaran() {
            var partMotor = parseFloat(document.getElementById('part_motor').value) || 0;
            var hargaService = parseFloat(document.getElementById('harga_service').value) || 0;
            var totalPembayaran = partMotor + hargaService;
            document.getElementById('total_pembayaran').value = totalPembayaran.toFixed(2);
        }

        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('part_motor').addEventListener('change', updateTotalPembayaran);
            updateTotalPembayaran();
        });
    </script>
</body>

</html>
<?php
}
mysqli_close($conn);
?>
