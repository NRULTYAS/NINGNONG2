<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan Selesai</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 11px;
            color: #2C2C2C;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #7C8C6C;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            color: #7C8C6C;
            margin: 0 0 5px 0;
        }
        .header p {
            font-size: 11px;
            color: #6E6E6E;
            margin: 0;
        }
        .info {
            margin-bottom: 15px;
            font-size: 10px;
            color: #6E6E6E;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th {
            background-color: #F0F2EC;
            color: #2C2C2C;
            font-weight: bold;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            border: 1px solid #E5E3DE;
        }
        table td {
            padding: 6px;
            border: 1px solid #E5E3DE;
            font-size: 10px;
        }
        table tr:nth-child(even) {
            background-color: #F7F6F2;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row {
            background-color: #E8EDE5 !important;
            font-weight: bold;
        }
        .total-row td { font-weight: bold; }
        .footer {
            text-align: center;
            font-size: 9px;
            color: #9A9A9A;
            margin-top: 20px;
            border-top: 1px solid #E5E3DE;
            padding-top: 10px;
        }
        .empty-data {
            text-align: center;
            padding: 30px;
            color: #6E6E6E;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <td width="120" style="vertical-align: top; padding-right: 10px;">
                <?php
                    // Pakai SVG asli dari assets.
                    // Catatan: jika Dompdf kamu tidak merender SVG, maka fallback PNG base64 akan dipakai.
                    $svgPath = FCPATH . 'assets/img/LOGO.svg';
                    $svgOk = file_exists($svgPath);
                    $svgContent = $svgOk ? @file_get_contents($svgPath) : '';

                    $pngPath = FCPATH . 'assets/img/LOGO.png';
                    $pngOk = file_exists($pngPath);
                    $pngData = $pngOk ? @file_get_contents($pngPath) : '';
                    $pngSrc = ($pngOk && !empty($pngData)) ? ('data:image/png;base64,' . base64_encode($pngData)) : '';
                ?>

                <?php if ($svgOk && !empty($svgContent)): ?>
                    <div style="width:110px;height:110px;overflow:hidden;">
                        <?php echo $svgContent; ?>
                    </div>
                <?php elseif (!empty($pngSrc)): ?>
                    <img src="<?php echo $pngSrc; ?>" style="width:110px;height:auto;" />
                <?php else: ?>
                    <div style="width:110px;height:110px;border:3px solid #7C8C6C;border-radius:20px;display:flex;flex-direction:column;align-items:center;justify-content:center;color:#7C8C6C;font-weight:800;">
                        <div style="font-size:28px;line-height:1;">N</div>
                        <div style="font-size:10px;letter-spacing:0.5px;">NINGNONG</div>
                    </div>
                <?php endif; ?>
            </td>
            <td style="vertical-align: top;">
                <div style="font-size: 18px; font-weight: bold; color: #7C8C6C; margin-bottom: 2px;">
                    NINGNONG Kue Basah
                </div>
                <div style="font-size: 10px; color: #6E6E6E; line-height: 1.35;">
                    Griya Bandung Indah, Komp, Jl. Alam Raya No.4, RW.5, Buahbatu, Kec. Bojongsoang, Kabupaten Bandung, Jawa Barat 40287<br>
                    Telp : 0821-1976-4204
                </div>
            </td>
        </tr>
    </table>

    <div style="border-bottom: 2px solid #7C8C6C; padding-bottom: 10px; margin-bottom: 15px;"></div>

    <div class="header">
        <h1>Laporan Pesanan Selesai</h1>
        <p></p>
    </div>

    <div class="info">
        <strong>Periode:</strong> <?php echo date('d M Y', strtotime($dari)); ?> - <?php echo date('d M Y', strtotime($sampai)); ?><br>
        <strong>Tanggal Cetak:</strong> <?php echo date('d M Y H:i'); ?>
    </div>

    <?php if (!empty($laporan)): ?>
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Kode Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($laporan as $p): ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $p->kode_pesanan; ?></td>
                        <td>
                            <?php echo $p->nama_penerima; ?><br>
                            <span style="font-size:9px;color:#6E6E6E;"> <?php echo $p->no_hp_penerima; ?></span>
                        </td>
                        <td class="text-right">Rp <?php echo number_format($p->total_harga, 0, ',', '.'); ?></td>
                        <td><?php echo $p->metode_pembayaran; ?></td>
                        <td><?php echo date('d M Y', strtotime($p->created_at)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL</td>
                    <td class="text-right">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
                    <td colspan="2"></td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" class="text-right">Jumlah Pesanan</td>
                    <td class="text-right"><?php echo count($laporan); ?> pesanan</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    <?php else: ?>
        <div class="empty-data">
            <p>Tidak ada data pesanan selesai untuk periode ini.</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        Dicetak pada <?php echo date('d M Y H:i'); ?> — NINGNONG Kue Basah
    </div>
</body>
</html>

