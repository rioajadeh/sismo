<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Pendaftaran</title>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .add-button {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
            gap: 10px;
        }

        .add-button a {
            background-color: #0069d9;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .add-button a:hover {
            background-color: #004b9d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        th,
        td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e1e1e1;
        }

        th {
            background-color: #f9fafc;
            font-weight: bold;
            color: #444;
        }

        tr:hover {
            background-color: #f5f7fa;
        }

        .action-button {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-button a {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            transition: background-color 0.2s ease;
        }

        .edit {
            background-color: #007bff;
        }

        .edit:hover {
            background-color: #0056b3;
        }

        .hapus {
            background-color: #dc3545;
        }

        .hapus:hover {
            background-color: #a71d2a;
        }

        .bayar {
            background-color: #28a745;
        }

        .bayar:hover {
            background-color: #1c7d32;
        }

        @media (max-width: 768px) {
            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                padding: 10px;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 10px 14px;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #555;
            }

            .action-button {
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Pendaftaran</h1>

        <div class="add-button">
            <a href="halamantambah.php">+ Tambah Data</a>
            <a href="riwayat.php" style="background-color: #17a2b8;">Riwayat Service</a>
        </div>

        <?php
        include 'config.php';

        $query = "SELECT * FROM pendaftaran";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<thead><tr>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Nopol</th>
                  <th>Type Motor</th>
                  <th>Paket Service</th>
                  <th>Keluhan</th>
                  <th>Aksi</th>
                </tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td data-label='Nama'>" . htmlspecialchars($row["nama"]) . "</td>";
                echo "<td data-label='Alamat'>" . htmlspecialchars($row["alamat"]) . "</td>";
                echo "<td data-label='Nopol'>" . htmlspecialchars($row["nopol"]) . "</td>";
                echo "<td data-label='Type Motor'>" . htmlspecialchars($row["type_motor"]) . "</td>";
                echo "<td data-label='Paket Service'>" . htmlspecialchars($row["paket_service"]) . "</td>";
                echo "<td data-label='Keluhan'>" . htmlspecialchars($row["keluhan"]) . "</td>";
                echo "<td class='action-button' data-label='Aksi'>
                      <a href='halamanedit.php?id=" . $row["id_pendaftaran"] . "' class='edit'>Edit</a>
                      <a href='#' onclick='confirmDelete(" . $row["id_pendaftaran"] . ")' class='hapus'>Hapus</a>
                      <a href='prosesbayar.php?id=" . $row["id_pendaftaran"] . "' class='bayar'>Bayar</a>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Tidak ada data pendaftaran.</p>";
        }

        mysqli_close($conn);
        ?>

        <script>
            function confirmDelete(id) {
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    window.location.href = `proseshapus.php?id=${id}`;
                }
            }
        </script>
    </div>
</body>

</html>
