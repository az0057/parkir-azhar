<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-800">Laporan Riwayat Parkir</h1>
        <p class="text-slate-500">Filter dan pantau riwayat pendapatan parkir secara real-time.</p>
    </div>
    <button onclick="window.print()" class="bg-slate-800 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-slate-700 transition flex items-center gap-2 shadow-lg active:scale-95 no-print">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
        </svg>
        Cetak Laporan
    </button>
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-6 no-print">
    <form action="<?= BASEURL; ?>/admin/laporan" method="POST" class="flex flex-wrap items-end gap-4">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-slate-600 mb-1">Dari Tanggal</label>
            <input type="date" name="tgl_mulai" 
                   value="<?= $data['tgl_mulai'] ?? ''; ?>" 
                   class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-slate-600 mb-1">Sampai Tanggal</label>
            <input type="date" name="tgl_selesai" 
                   value="<?= $data['tgl_selesai'] ?? ''; ?>" 
                   class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 active:scale-95">
                Filter
            </button>
            <a href="<?= BASEURL; ?>/admin/laporan" class="bg-slate-100 text-slate-600 px-6 py-2.5 rounded-xl font-bold hover:bg-slate-200 transition-all text-center">
                Reset
            </a>
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden printable-area">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-slate-600 text-xs uppercase font-bold tracking-wider">
                    <th class="p-4">Plat Nomor</th>
                    <th class="p-4">Jenis</th>
                    <th class="p-4">Waktu Masuk</th>
                    <th class="p-4">Waktu Keluar</th>
                    <th class="p-4 text-right">Biaya</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($data['riwayat'])) : ?>
                    <tr>
                        <td colspan="5" class="p-10 text-center text-slate-400 italic">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-4xl">📁</span>
                                <p>Data tidak ditemukan pada periode ini.</p>
                            </div>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php 
                    $grandTotal = 0;
                    foreach($data['riwayat'] as $r) : 
                        $grandTotal += $r['biaya_total'];
                    ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="p-4 font-mono font-bold text-slate-700"><?= $r['plat_nomor']; ?></td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded text-[10px] font-black uppercase tracking-tighter <?= $r['jenis_kendaraan'] == 'mobil' ? 'bg-indigo-100 text-indigo-700' : 'bg-orange-100 text-orange-700'; ?>">
                                <?= ($r['jenis_kendaraan'] == 'mobil') ? '🚗 Mobil' : '🏍️ Motor'; ?>
                            </span>
                        </td>
                        <td class="p-4 text-sm text-slate-500">
                            <div class="font-medium text-slate-700"><?= date('H:i', strtotime($r['waktu_masuk'])); ?></div>
                            <div class="text-[10px]"><?= date('d M Y', strtotime($r['waktu_masuk'])); ?></div>
                        </td>
                        <td class="p-4 text-sm text-slate-500">
                            <div class="font-medium text-slate-700"><?= date('H:i', strtotime($r['waktu_keluar'])); ?></div>
                            <div class="text-[10px]"><?= date('d M Y', strtotime($r['waktu_keluar'])); ?></div>
                        </td>
                        <td class="p-4 text-right font-bold text-slate-800">
                            Rp <?= number_format($r['biaya_total'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

            <?php if(!empty($data['riwayat'])) : ?>
            <tfoot class="bg-slate-50 font-bold border-t-2 border-slate-200">
                <tr>
                    <td colspan="4" class="p-4 text-right text-slate-600 uppercase text-xs tracking-widest">Total Pendapatan:</td>
                    <td class="p-4 text-right text-blue-600 text-xl font-black">
                        Rp <?= number_format($grandTotal, 0, ',', '.'); ?>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
</div>

<style>
    @media print {
        /* Sembunyikan elemen navigasi dan tombol */
        .no-print, form, button, a, header, .sidebar {
            display: none !important;
        }
        
        /* Reset layout body */
        body {
            background-color: white !important;
            color: black !important;
            padding: 0;
            margin: 0;
        }

        /* Hilangkan bayangan dan border melengkung agar bersih di kertas */
        .shadow-sm, .rounded-2xl {
            box-shadow: none !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0 !important;
        }

        /* Pastikan tabel mengambil lebar penuh kertas */
        .printable-area {
            width: 100% !important;
        }

        table {
            border-collapse: collapse !important;
            width: 100% !important;
        }

        th, td {
            border: 1px solid #e2e8f0 !important;
        }

        /* Tambahkan judul laporan di bagian atas saat cetak */
        .printable-area::before {
            content: "LAPORAN RIWAYAT PARKIR - SISTEM AZHAR";
            display: block;
            text-align: center;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    }
</style>