<?php if(isset($_SESSION['flash_bayar'])) : ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Pembayaran Berhasil!',
            html: `<div class="text-left bg-slate-50 p-4 rounded-xl border border-dashed border-slate-300">
                    <p class="text-sm text-slate-500">Plat Nomor: <span class="font-bold text-slate-800"><?= $_SESSION['flash_bayar']['plat']; ?></span></p>
                    <hr class="my-2">
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest mb-1">Total Tagihan:</p>
                    <p class="text-2xl font-black text-blue-600">Rp <?= number_format($_SESSION['flash_bayar']['biaya'], 0, ',', '.'); ?></p>
                   </div>`,
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            confirmButtonText: '🖨️ Cetak Struk',
            cancelButtonText: 'Tutup'
        }).then((result) => {
            if (result.isConfirmed) { 
                window.open('<?= BASEURL; ?>/petugas/cetak/<?= $_SESSION['flash_bayar']['id']; ?>', '_blank'); 
            }
        });
    });
</script>
<?php unset($_SESSION['flash_bayar']); endif; ?>

<div style="display: table; width: 100%; table-layout: fixed; border-spacing: 24px 0; margin-left: -24px;">
    
    <div style="display: table-cell; width: 350px; vertical-align: top;">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 sticky top-24">
            <h2 class="text-lg font-bold mb-4 text-slate-700 uppercase tracking-tight flex items-center gap-2">
                <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                Masuk Kendaraan
            </h2>
            
            <form action="<?= BASEURL; ?>/petugas/masuk" method="POST" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 mb-1 tracking-widest uppercase">Cari Plat Nomor Member</label>
                    <input list="listMember" name="plat_nomor" id="plat_nomor" required autocomplete="off" placeholder="Ketik Plat Nomor..." 
                           class="w-full px-4 py-4 rounded-xl border-2 border-slate-100 focus:border-blue-500 outline-none uppercase font-black text-2xl transition-all">
                    
                    <datalist id="listMember">
                        <?php 
                        $allMember = $this->model('Parkir_model')->getAllKendaraan();
                        foreach($allMember as $m) : 
                        ?>
                            <option value="<?= $m['plat_nomor']; ?>"> <?= $m['pemilik']; ?> (<?= $m['jenis_kendaraan']; ?>)</option>
                        <?php endforeach; ?>
                    </datalist>
                    <p class="text-[9px] text-slate-400 mt-1 italic text-center">*Pastikan kendaraan sudah terdaftar</p>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 mb-1 uppercase tracking-widest">Area Parkir</label>
                    <select name="id_area" required class="w-full p-4 rounded-xl border-2 border-slate-100 font-bold text-blue-600 bg-slate-50 focus:border-blue-500 outline-none">
                        <?php foreach($data['area'] as $a) : ?>
                            <option value="<?= $a['id_area']; ?>" <?= ($a['terisi'] >= $a['kapasitas'] ? 'disabled' : ''); ?>>
                                <?= $a['nama_area']; ?> (Sisa: <?= $a['kapasitas'] - $a['terisi']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold uppercase shadow-lg shadow-blue-100 transition-all active:scale-95">
                    SIMPAN MASUK
                </button>
            </form>
        </div>
    </div>

    <div style="display: table-cell; vertical-align: top;">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 bg-slate-50 border-b flex justify-between items-center">
                <span class="font-bold text-slate-700 uppercase text-xs tracking-widest">🕒 Kendaraan Parkir Aktif</span>
                <span class="bg-blue-600 text-white text-[10px] px-3 py-1 rounded-full font-bold">
                    <?= count($data['kendaraan']); ?> UNIT
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] uppercase text-slate-400 border-b bg-slate-50/50">
                            <th class="p-4">Informasi Kendaraan</th>
                            <th class="p-4 text-center">Waktu Masuk</th>
                            <th class="p-4 text-center">Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($data['kendaraan'] as $k) : ?>
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="p-4">
                                <div class="font-black text-slate-800 text-lg uppercase tracking-tight"><?= $k['plat_nomor']; ?></div>
                                <div class="text-[9px] font-bold text-blue-500 uppercase tracking-widest">
                                    <?= $k['nama_area']; ?> • <?= $k['jenis_kendaraan']; ?>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <div class="text-xs font-bold text-slate-700"><?= date('H:i', strtotime($k['waktu_masuk'])); ?></div>
                                <div class="text-[10px] text-slate-400 uppercase"><?= date('d M Y', strtotime($k['waktu_masuk'])); ?></div>
                            </td>
                            <td class="p-4">
                                <div class="flex flex-col gap-1.5 w-40 mx-auto">
                                    <a href="<?= BASEURL; ?>/petugas/keluar/<?= $k['id_parkir']; ?>" 
                                       onclick="return confirm('Proses checkout untuk kendaraan <?= $k['plat_nomor']; ?>?')" 
                                       class="bg-red-500 hover:bg-red-600 text-white text-[10px] py-2.5 rounded-lg font-black text-center uppercase tracking-widest shadow-sm">
                                       CHECKOUT (KELUAR)
                                    </a>
                                    
                                    <div class="grid grid-cols-2 gap-1">
                                        <a href="<?= BASEURL; ?>/petugas/cetak/<?= $k['id_parkir']; ?>" target="_blank" 
                                           class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-[9px] py-2 rounded font-bold border border-slate-200 text-center uppercase">
                                            STRUK
                                        </a>
                                        <a href="<?= BASEURL; ?>/petugas/hapus/<?= $k['id_parkir']; ?>" 
                                           onclick="return confirm('Hapus transaksi ini?')" 
                                           class="bg-slate-900 hover:bg-black text-white text-[9px] py-2 rounded font-bold text-center uppercase">
                                            HAPUS
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($data['kendaraan'])) : ?>
                        <tr>
                            <td colspan="3" class="p-12 text-center text-slate-400 italic text-sm">
                                Belum ada kendaraan member yang parkir saat ini.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>