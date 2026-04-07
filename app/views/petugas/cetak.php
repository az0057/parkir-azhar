<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir - <?= $data['parkir']['plat_nomor'] ?? 'No Plat'; ?></title>
    <style>
        @page { size: 80mm 200mm; margin: 0; }
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 250px; 
            font-size: 12px; 
            margin: 10px auto;
            color: #000;
        }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        hr { border: none; border-top: 1px dashed #000; margin: 10px 0; }
        .total-box { 
            border: 1px solid #000; 
            padding: 5px; 
            margin-top: 5px; 
            font-size: 14px;
        }
        .error-box {
            border: 1px solid red;
            padding: 10px;
            color: red;
            text-align: center;
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="<?= isset($data['parkir']) ? 'window.print(); setTimeout(window.close, 1000);' : '' ?>">

    <?php if (!isset($data['parkir']) || empty($data['parkir'])) : ?>
        <div class="error-box">
            <p class="font-bold">DATA TIDAK DITEMUKAN</p>
            <p style="font-size: 10px;">ID Transaksi mungkin salah atau sudah dihapus.</p>
            <button class="no-print" onclick="window.close()">Tutup Halaman</button>
        </div>
    <?php else : ?>

        <div class="text-center">
            <h3 style="margin-bottom: 5px;">PARKIRKEUN V2</h3>
            <p style="margin: 0;">Jl. Raya Parkir No. 123</p>
        </div>

        <hr>

        <div style="line-height: 1.6;">
            <p style="margin: 0;">ID Trans : #<?= $data['parkir']['id_parkir'] ?? '-'; ?></p>
            <p style="margin: 0;">Plat No  : <span class="font-bold"><?= strtoupper($data['parkir']['plat_nomor'] ?? 'N/A'); ?></span></p>
            <p style="margin: 0;">Jenis    : <?= strtoupper($data['parkir']['jenis_kendaraan'] ?? 'UMUM'); ?></p>
            
            <p style="margin: 0;">Masuk    : <?= isset($data['parkir']['waktu_masuk']) ? date('d/m/Y H:i', strtotime($data['parkir']['waktu_masuk'])) : '--/--/-- --:--'; ?></p>
            
            <?php if(isset($data['parkir']['waktu_keluar']) && $data['parkir']['waktu_keluar'] != null) : ?>
                <p style="margin: 0;">Keluar   : <?= date('d/m/Y H:i', strtotime($data['parkir']['waktu_keluar'])); ?></p>
                <hr>
                <div class="text-center total-box">
                    <span class="font-bold">TOTAL: Rp <?= number_format($data['parkir']['biaya_total'] ?? 0, 0, ',', '.'); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <hr>

        <div class="text-center" style="font-size: 10px;">
            <p>Terima Kasih Atas Kunjungan Anda</p>
            <p>Karcis hilang denda Rp 20.000</p>
            <p>Simpan karcis ini dengan baik</p>
        </div>

        <div class="no-print text-center" style="margin-top: 20px;">
            <button onclick="window.print()">Cetak Manual</button>
            <button onclick="window.close()">Tutup</button>
        </div>

    <?php endif; ?>

</body>
</html>