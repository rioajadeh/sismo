<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f9ff;
        }

        tr:hover {
            background-color: #e1f0ff;
        }

        td {
            border-bottom: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Riwayat Service</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nopol</th>
            <th>Type Motor</th>
            <th>Paket Service</th>
            <th>Keluhan</th>
            <th>Tanggal Service</th>
        </tr>
        <?php
        include 'config.php';

        $query = "SELECT * FROM riwayat_service";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['nama']}</td>";
                echo "<td>{$row['alamat']}</td>";
                echo "<td>{$row['nopol']}</td>";
                echo "<td>{$row['type_motor']}</td>";
                echo "<td>{$row['paket_service']}</td>";
                echo "<td>{$row['keluhan']}</td>";
                echo "<td>{$row['tanggal_service']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data riwayat service.</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>