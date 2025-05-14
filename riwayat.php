<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Service</title>
    <style>
        /* Reset & Basic Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            margin-bottom: 30px;
            color: #0a4a8f;
        }

        table {
            width: 100%;
            max-width: 1100px;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 14px 20px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f5faff;
        }

        tr:hover {
            background-color: #e1f0ff;
            transition: background-color 0.3s ease;
        }

        td {
            border-bottom: 1px solid #e0e0e0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 8px;
                background: #fff;
                padding: 10px;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 20px;
                width: 45%;
                padding-right: 10px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <h1>Riwayat Service</h1>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nopol</th>
                <th>Type Motor</th>
                <th>Paket Service</th>
                <th>Keluhan</th>
                <th>Tanggal Service</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'config.php';

            $query = "SELECT * FROM riwayat_service";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td data-label='Nama'>{$row['nama']}</td>";
                    echo "<td data-label='Alamat'>{$row['alamat']}</td>";
                    echo "<td data-label='Nopol'>{$row['nopol']}</td>";
                    echo "<td data-label='Type Motor'>{$row['type_motor']}</td>";
                    echo "<td data-label='Paket Service'>{$row['paket_service']}</td>";
                    echo "<td data-label='Keluhan'>{$row['keluhan']}</td>";
                    echo "<td data-label='Tanggal Service'>{$row['tanggal_service']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>Tidak ada data riwayat service.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
