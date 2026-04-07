<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Welcome to Parkirkeun</h1>
    <p class="text-slate-500 text-sm">Ringkasan operasional Parkirkeun v2 hari ini, <?= date('d M Y'); ?>.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-50 transition-all hover:shadow-md">
        <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest text-center md:text-left">Kendaraan Parkir</h3>
        <p class="text-6xl font-black text-blue-600 mt-4 text-center md:text-left"><?= $data['kendaraan_aktif'] ?? 0; ?></p>
        <div class="flex items-center justify-center md:justify-start gap-2 mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            <span class="flex h-2 w-2 rounded-full bg-blue-400 animate-pulse"></span>
            Unit terparkir saat ini
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-50 transition-all hover:shadow-md">
        <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest text-center md:text-left">Slot Tersedia</h3>
        <p class="text-6xl font-black text-green-500 mt-4 text-center md:text-left">
            <?php 
                $totalKapasitas = 0;
                if (isset($data['area']) && !empty($data['area'])) {
                    foreach($data['area'] as $row) {
                        $totalKapasitas += (int)$row['kapasitas'];
                    }
                }
                
                // Rumus: Total Kapasitas Area - Kendaraan yang sedang parkir
                $kendaraanAktif = (int)($data['kendaraan_aktif'] ?? 0);
                $hasilTersedia = $totalKapasitas - $kendaraanAktif;
                echo ($hasilTersedia < 0) ? 0 : $hasilTersedia; 
            ?>
        </p>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-4 text-center md:text-left">
            DARI TOTAL <span class="text-slate-800 font-black"><?= $totalKapasitas; ?></span> SLOT
        </p>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-50 transition-all hover:shadow-md">
        <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest text-center md:text-left">Pendapatan Hari Ini</h3>
        <p class="text-5xl font-black text-orange-500 mt-4 leading-none text-center md:text-left">
            <span class="text-2xl font-bold">Rp</span> <?= number_format($data['total_pendapatan'] ?? 0, 0, ',', '.'); ?>
        </p>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-4 text-center md:text-left">
            Akumulasi transaksi hari ini
        </p>
    </div>
</div>

<div class="mt-10 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-50">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xl font-bold text-slate-800 tracking-tight">Aktivitas Terbaru</h2>
        <a href="<?= BASEURL; ?>/admin/log" class="text-[10px] font-black uppercase tracking-widest text-blue-600 bg-blue-50 px-5 py-2.5 rounded-2xl hover:bg-blue-100 transition-colors">Lihat Semua</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                    <th class="pb-5 px-2">Waktu</th>
                    <th class="pb-5 px-4">User</th>
                    <th class="pb-5 px-2 text-right">Aktivitas</th>
                </tr>
            </thead>
            <tbody class="text-slate-600">
                <?php if (!empty($data['logs'])) : ?>
                    <?php foreach (array_slice($data['logs'], 0, 5) as $log) : ?>
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors group">
                        <td class="py-6 px-2">
                            <div class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors"><?= date('H:i', strtotime($log['waktu_aktivitas'])); ?></div>
                        </td>
                        <td class="py-6 px-4">
                            <span class="bg-slate-100 text-slate-500 px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-wider italic">
                                <?= $log['username']; ?>
                            </span>
                        </td>
                        <td class="py-6 px-2 text-sm font-medium text-slate-400 text-right italic">
                            "<?= $log['aktivitas']; ?>"
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="py-16 text-center text-slate-300 text-sm italic font-medium">
                            Belum ada aktivitas terekam hari ini.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>