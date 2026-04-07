<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-800">Manajemen Pengguna</h1>
        <p class="text-slate-500">Kelola akses admin dan petugas parkir</p>
    </div>
    
    <button onclick="bukaModalTambah()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Tambah User
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200">
                <th class="p-4 text-sm font-bold text-slate-600 uppercase">Nama Lengkap</th>
                <th class="p-4 text-sm font-bold text-slate-600 uppercase">Username</th>
                <th class="p-4 text-sm font-bold text-slate-600 uppercase">Role</th>
                <th class="p-4 text-sm font-bold text-slate-600 uppercase text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php foreach($data['user'] as $user) : ?>
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="p-4 font-medium text-slate-700"><?= $user['nama_lengkap']; ?></td>
                <td class="p-4 text-slate-600"><?= $user['username']; ?></td>
                <td class="p-4">
                    <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm
                        <?= $user['role'] == 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-amber-100 text-amber-700'; ?>">
                        <?= strtoupper($user['role']); ?>
                    </span>
                </td>
                <td class="p-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button onclick="bukaModalEdit('<?= $user['id_user']; ?>', '<?= $user['nama_lengkap']; ?>', '<?= $user['username']; ?>', '<?= $user['role']; ?>')" 
                                class="text-amber-500 hover:bg-amber-50 p-2 rounded-lg transition-colors" title="Edit User">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <a href="<?= BASEURL; ?>/admin/hapusUser/<?= $user['id_user']; ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                           class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition-colors inline-block" title="Hapus User">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modalUser" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 m-4">
        
        <div class="flex justify-between items-center mb-6">
            <h2 id="modalTitle" class="text-2xl font-bold text-slate-800">User Baru</h2>
            <button onclick="tutupModal()" class="text-slate-400 hover:text-slate-600 p-2 text-2xl">&times;</button>
        </div>

        <form id="formUser" action="<?= BASEURL; ?>/admin/tambahUser" method="POST" class="space-y-4">
            <input type="hidden" name="id_user" id="id_user">
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required placeholder="Contoh: Budi Santoso"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                <input type="text" name="username" id="username" required placeholder="username_pilihan"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
            </div>
            
            <div id="passwordWrapper">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Role Akses</label>
                <div class="relative">
                    <select name="role" id="role" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all appearance-none bg-white">
                        <option value="petugas">Petugas</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="button" onclick="tutupModal()" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 py-3 rounded-xl font-bold transition-all">Batal</button>
                <button type="submit" id="submitBtn" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold shadow-lg shadow-blue-100 transition-all">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('modalUser');
    const modalTitle = document.getElementById('modalTitle');
    const formUser = document.getElementById('formUser');
    const passwordWrapper = document.getElementById('passwordWrapper');
    const passwordInput = document.getElementById('password');

    /**
     * Menampilkan modal dengan konfigurasi "Tambah User"
     */
    function bukaModalTambah() {
        modalTitle.innerText = 'User Baru';
        formUser.setAttribute('action', '<?= BASEURL; ?>/admin/tambahUser');
        formUser.reset(); 
        
        passwordWrapper.style.display = 'block'; 
        passwordInput.setAttribute('required', 'required'); 
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    /**
     * Menampilkan modal dengan konfigurasi "Edit User" dan mengisi data yang ada
     */
    function bukaModalEdit(id, nama, username, role) {
        modalTitle.innerText = 'Edit User';
        formUser.setAttribute('action', '<?= BASEURL; ?>/admin/ubahUser');
        
        // Memasukkan data ke input form
        document.getElementById('id_user').value = id;
        document.getElementById('nama_lengkap').value = nama;
        document.getElementById('username').value = username;
        document.getElementById('role').value = role;

        // Hilangkan input password saat edit (Gunakan fitur reset password terpisah jika perlu)
        passwordWrapper.style.display = 'none'; 
        passwordInput.removeAttribute('required');

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    /**
     * Menyembunyikan modal
     */
    function tutupModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>