<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-800">Manajemen Tarif</h1>
    <p class="text-slate-500 text-sm">Sesuaikan biaya parkir per jam secara real-time.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php foreach($data['tarif'] as $t) : ?>
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">
        <div class="absolute -top-4 -right-4 w-20 h-20 bg-blue-50 rounded-full opacity-50"></div>

        <div class="flex items-center gap-4 mb-8 relative">
            <div class="w-12 h-12 flex items-center justify-center bg-white shadow-sm border border-slate-100 rounded-2xl text-xl">
                <?= (strtolower($t['jenis_kendaraan']) == 'mobil') ? '🚗' : '🏍️'; ?>
            </div>
            <div>
                <h2 class="font-bold text-slate-800 tracking-tight uppercase"><?= $t['jenis_kendaraan']; ?></h2>
                <p class="text-[10px] text-slate-400 font-bold tracking-widest">ID TARIF: #0<?= $t['id_tarif']; ?></p>
            </div>
        </div>
        
        <form action="<?= BASEURL; ?>/admin/update_tarif" method="POST" class="relative">
            <input type="hidden" name="jenis" value="<?= $t['jenis_kendaraan']; ?>">
            
            <div class="bg-slate-50 p-4 rounded-2xl mb-6 border border-slate-100">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tarif Per Jam (IDR)</label>
                <div class="flex items-center gap-2">
                    <span class="text-lg font-bold text-slate-400">Rp</span>
                    <input type="number" name="tarif" value="<?= (int)$t['tarif_per_jam']; ?>" required
                           class="bg-transparent w-full text-2xl font-black text-slate-700 outline-none focus:text-blue-600 transition-colors">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-blue-700 active:scale-[0.98] transition-all shadow-lg shadow-blue-100">
                SIMPAN PERUBAHAN
            </button>
        </form>
    </div>
    <?php endforeach; ?>
</div>