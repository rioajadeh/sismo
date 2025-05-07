<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Data Pendaftaran</title>
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        .form-container {
            background-color: #fff;
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        select {
            padding: 10px;
            font-size: 15px;
            border: 1.8px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        input[type="submit"] {
            margin-top: 25px;
            padding: 12px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Tambah Data Pendaftaran</h1>
    <div class="form-container">
        <form action="prosestambah.php" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" required>

            <label for="nopol">Nopol:</label>
            <input type="text" id="nopol" name="nopol" required>

            <label for="type_motor">Type Motor:</label>
            <input type="text" id="type_motor" name="type_motor" required>

            <label for="paket_service">Paket Service:</label>
            <select id="paket_service" name="paket_service" required onchange="updateHargaService()">
                <option value="service_ringan">Service Ringan - 75rb</option>
                <option value="service_berat">Service Berat - 150rb</option>
                <option value="ganti_oli">Ganti Oli - 50rb</option>
            </select>

            <input type="hidden" id="harga_service" name="harga_service" value="0">

            <label for="keluhan">Keluhan:</label>
            <input type="text" id="keluhan" name="keluhan" required>

            <input type="submit" value="Tambah Data">
        </form>
    </div>

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

        // Inisialisasi saat halaman dimuat
        window.onload = updateHargaService;
    </script>
</body>

</html>
