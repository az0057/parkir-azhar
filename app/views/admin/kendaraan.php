<div class="flex justify-between items-end mb-8">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic">Data Member Kendaraan</h1>
        <p class="text-slate-500 mt-1">Kelola daftar kendaraan yang diperbolehkan parkir dalam sistem.</p>
    </div>
    <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-100 transition-all active:scale-95 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Member
    </button>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-200">
                <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Plat Nomor</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Pemilik</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Detail Kendaraan</th>
                <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php if(empty($data['kendaraan'])) : ?>
                <tr>
                    <td colspan="4" class="p-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <p class="text-slate-400 font-medium">Belum ada data member terdaftar.</p>
                        </div>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach($data['kendaraan'] as $k) : ?>
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="p-6">
                        <span class="bg-slate-900 text-white px-4 py-2 rounded-lg font-black tracking-widest text-sm uppercase shadow-sm">
                            <?= $k['plat_nomor']; ?>
                        </span>
                    </td>
                    <td class="p-6">
                        <p class="font-bold text-slate-800"><?= $k['pemilik']; ?></p>
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-tight">Verified Member</p>
                    </td>
                    <td class="p-6">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-700 uppercase"><?= $k['jenis_kendaraan']; ?></span>
                            <span class="text-xs text-slate-400 italic"><?= $k['warna']; ?></span>
                        </div>
                    </td>
                    <td class="p-6 text-center flex justify-center gap-2">
                        <button onclick="openEditModal(<?= htmlspecialchars(json_encode($k)); ?>)" 
                                class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-500 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>

                        <a href="<?= BASEURL; ?>/admin/hapus_kendaraan/<?= $k['id_kendaraan']; ?>" 
                           onclick="return confirm('Hapus member <?= $k['plat_nomor']; ?>? Semua riwayat transaksi kendaraan ini juga akan terhapus.')"
                           class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modalMember" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Registrasi Baru</h2>
            <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form action="<?= BASEURL; ?>/admin/tambah_kendaraan" method="POST" class="p-8 space-y-5">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" required placeholder="B 1234 ABC"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-bold text-lg uppercase tracking-wider">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Jenis</label>
                    <select name="jenis_kendaraan" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-bold text-slate-700">
                        <option value="MOTOR">MOTOR</option>
                        <option value="MOBIL">MOBIL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Warna</label>
                    <input type="text" name="warna" required placeholder="Hitam"
                           class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-bold">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Pemilik</label>
                <input type="text" name="pemilik" required placeholder="Masukkan nama lengkap"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 focus:bg-white outline-none transition-all font-bold">
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 py-4 text-slate-400 font-bold hover:text-slate-600 transition-colors">Batal</button>
                <button type="submit" class="flex-1 bg-slate-900 text-white py-4 rounded-2xl font-black hover:bg-blue-600 transition-all shadow-lg shadow-slate-200">
                    SIMPAN DATA
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditMember" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Edit Data Member</h2>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form action="<?= BASEURL; ?>/admin/ubah_kendaraan" method="POST" class="p-8 space-y-5">
            <input type="hidden" name="id_kendaraan" id="edit_id">
            
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Plat Nomor (Read Only)</label>
                <input type="text" name="plat_nomor" id="edit_plat" readonly
                       class="w-full px-5 py-4 bg-slate-100 border-2 border-transparent rounded-2xl outline-none font-bold text-slate-500 uppercase tracking-wider cursor-not-allowed">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Jenis</label>
                    <select name="jenis_kendaraan" id="edit_jenis" class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 outline-none font-bold text-slate-700">
                        <option value="MOTOR">MOTOR</option>
                        <option value="MOBIL">MOBIL</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Warna</label>
                    <input type="text" name="warna" id="edit_warna" required
                           class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 outline-none font-bold">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Pemilik</label>
                <input type="text" name="pemilik" id="edit_pemilik" required
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-transparent rounded-2xl focus:border-blue-500 outline-none font-bold">
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-4 text-slate-400 font-bold">Batal</button>
                <button type="submit" class="flex-1 bg-blue-600 text-white py-4 rounded-2xl font-black hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modalAdd = document.getElementById('modalMember');
    const modalEdit = document.getElementById('modalEditMember');

    // MODAL TAMBAH
    function openModal() {
        modalAdd.classList.remove('hidden');
        modalAdd.classList.add('flex');
    }
    function closeModal() {
        modalAdd.classList.add('hidden');
        modalAdd.classList.remove('flex');
    }

    // MODAL EDIT
    function openEditModal(data) {
        document.getElementById('edit_id').value = data.id_kendaraan;
        document.getElementById('edit_plat').value = data.plat_nomor;
        document.getElementById('edit_jenis').value = data.jenis_kendaraan;
        document.getElementById('edit_warna').value = data.warna;
        document.getElementById('edit_pemilik').value = data.pemilik;

        modalEdit.classList.remove('hidden');
        modalEdit.classList.add('flex');
    }
    function closeEditModal() {
        modalEdit.classList.add('hidden');
        modalEdit.classList.remove('flex');
    }

    // Close on Outside Click
    window.onclick = function(event) {
        if (event.target == modalAdd) closeModal();
        if (event.target == modalEdit) closeEditModal();
    }
</script>