<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Manajemen Area</h1>
    <p class="text-slate-500 text-sm">Kelola kapasitas dan informasi lokasi parkir secara real-time.</p>
</div>

<div class="max-w-5xl">
    <?php if(!empty($data['area'])) : ?>
        <?php foreach($data['area'] as $a) : ?>
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row mb-6">
            
            <div class="p-8 md:w-1/2 border-b md:border-b-0 md:border-r border-slate-50">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-slate-700 tracking-tight leading-none uppercase">Pengaturan Area</h2>
                        <p class="text-[10px] text-slate-400 font-bold tracking-widest mt-1">ID AREA: #<?= $a['id_area']; ?></p>
                    </div>
                </div>

                <form action="<?= BASEURL; ?>/admin/ubah_area" method="POST">
                    <input type="hidden" name="id_area" value="<?= $a['id_area']; ?>">
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Nama Area / Lokasi</label>
                            <input type="text" name="nama_area" value="<?= htmlspecialchars($a['nama_area']); ?>" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 outline-none transition-all font-medium text-slate-700">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Total Kapasitas Maksimal</label>
                            <div class="relative">
                                <input type="number" name="kapasitas" value="<?= $a['kapasitas']; ?>" required
                                       class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-blue-500 outline-none transition-all font-black text-2xl text-slate-700">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-bold text-slate-300 uppercase">Slot</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 active:scale-[0.98] transition-all shadow-lg shadow-blue-100 uppercase tracking-widest text-xs">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-8 md:w-1/2 bg-[#0f172a] flex flex-col justify-center text-white">
                <div class="space-y-8">
                    <div>
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.2em] mb-1">Live Monitoring</p>
                                <h3 class="text-3xl font-black italic tracking-tighter uppercase"><?= htmlspecialchars($a['nama_area']); ?></h3>
                            </div>
                            <span class="text-2xl font-black text-white">
                                <?php 
                                    $persen = ($a['kapasitas'] > 0) ? ($a['terisi'] / $a['kapasitas']) * 100 : 0;
                                    echo round($persen) . '%';
                                ?>
                            </span>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Penggunaan Ruang</p>
                        <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 rounded-full transition-all duration-1000" style="width: <?= $persen; ?>%"></div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-800/50 p-5 rounded-2xl border border-slate-700">
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-2">Unit Terpakai</p>
                            <p class="text-3xl font-black text-white"><?= $a['terisi']; ?> <span class="text-[10px] text-slate-500 italic">UNIT</span></p>
                        </div>
                        <div class="bg-slate-800/50 p-5 rounded-2xl border border-slate-700">
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wider mb-2">Slot Kosong</p>
                            <p class="text-3xl font-black text-green-400"><?= $a['kapasitas'] - $a['terisi']; ?> <span class="text-[10px] text-slate-500 italic">SLOT</span></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 bg-slate-800 border border-slate-700 text-green-400 rounded-full w-fit">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Sistem Aktif</span>
                    </div>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-red-500 font-bold">Data area tidak ditemukan di database!</p>
    <?php endif; ?>
</div>