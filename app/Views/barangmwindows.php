<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        @page {
            size: A4;
            margin: 0; /* Remove margins for printing */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .content {
            position: relative;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background for content area */
            border-radius: 8px; /* Optional: rounded corners for content box */
            box-shadow: 0 0 5px rgba(0,0,0,0.1); /* Optional: slight shadow to lift content */
        }
        .header {
            margin-bottom: 20px;
        }
        .title, .subtitle {
            text-align: left;
            margin: 0;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        .subtitle {
            font-size: 18px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #FFFF00; /* Yellow background for header */
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            text-align: right;
            border-top: 2px solid #000;
            page-break-after: always; /* Ensure that the total row is on the last page */
        }
        .total-value {
            text-align: right;
        }
        .page-break {
            page-break-before: always;
            visibility: hidden; /* Hide page break but keep space */
            height: 0;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <div class="title">Laporan Barang Masuk</div>
            <div class="subtitle"><?= isset($setting->judul_website) ? htmlspecialchars($setting->judul_website, ENT_QUOTES, 'UTF-8') : 'Default Website' ?></div>
            <div class="subtitle">Tanggal : <?= isset($startDate) ? htmlspecialchars($startDate, ENT_QUOTES, 'UTF-8') : '0000-00-00' ?> - <?= isset($endDate) ? htmlspecialchars($endDate, ENT_QUOTES, 'UTF-8') : '9999-12-31' ?></div>
        </div>
        <table id="reportTable">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>Quantity</th>
                    <th>Harga Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalAmount = 0; foreach ($satu as $item): ?>
                <?php
                    $itemTotal = $item->quantity * $item->harga_beli;
                    $createDate = (new DateTime($item->create_at))->format('d-m-Y');
                ?>
                <tr>
                    <td><?= htmlspecialchars($item->nama_barang, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($item->kode_barang, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(number_format($item->quantity, 0, ',', '.'), ENT_QUOTES, 'UTF-8') ?></td>
                    <td>Rp <?= number_format($item->harga_beli, 2, ',', '.') ?></td>
                    <td>Rp <?= number_format($itemTotal, 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($createDate, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
                <?php $totalAmount += $itemTotal; endforeach; ?>
            </tbody>
        </table>
        <div id="totalRow" class="total-row">
            <div>Total</div>
            <div class="total-value">Rp <?= number_format($totalAmount, 2, ',', '.') ?></div>
        </div>
    </div>
    <script>
    window.addEventListener('load', function() {
        var table = document.getElementById('reportTable');
        var totalRow = document.getElementById('totalRow');
        
        // Append total row to the end of the table
        table.parentNode.appendChild(totalRow);
        
        // Print the page
        window.print();
    });
    </script>
</body>
</html>
