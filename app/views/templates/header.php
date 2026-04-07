<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?> | Parkirkeun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden; 
        }
        .sidebar-active {
            background-color: #eff6ff; /* blue-50 */
            color: #2563eb; /* blue-600 */
            border-right: 4px solid #2563eb;
            font-weight: 700;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800">

<div class="flex">
    <aside class="w-64 bg-white border-r border-slate-200 fixed h-full z-30 transition-all">
        <div class="p-8">
            <h1 class="text-2xl font-black text-blue-600 tracking-tighter italic uppercase leading-none">Parkirkeun</h1>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Sistem Manajemen</p>
        </div>

        <nav class="px-4 space-y-1.5 overflow-y-auto" style="max-height: calc(100vh - 120px);">
            
            <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin') : ?>
                <p class="text-[10px] font-bold text-slate-400 px-4 mt-8 mb-2 uppercase tracking-widest">Administrator</p>
                
                <a href="<?= BASEURL; ?>/admin" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all group <?= ($data['judul'] == 'Dashboard Admin') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Dashboard Utama</span>
                </a>
                
                <a href="<?= BASEURL; ?>/admin/user" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Kelola User') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Kelola Pengguna</span>
                </a>

                <a href="<?= BASEURL; ?>/admin/kendaraan" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Data Master Kendaraan') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Data Member</span>
                </a>
                
                <p class="text-[10px] font-bold text-slate-400 px-4 mt-6 mb-2 uppercase tracking-widest">Pengaturan Sistem</p>
                
                <a href="<?= BASEURL; ?>/admin/tarif" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Manajemen Tarif') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Manajemen Tarif</span>
                </a>
                
                <a href="<?= BASEURL; ?>/admin/area" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Manajemen Area') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Area & Slot Parkir</span>
                </a>

                <a href="<?= BASEURL; ?>/admin/log" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Log Aktivitas Sistem') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm">Log Aktivitas</span>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'petugas') : ?>
                <p class="text-[10px] font-bold text-slate-400 px-4 mt-8 mb-2 uppercase tracking-widest">Operasional</p>
                <a href="<?= BASEURL; ?>/petugas" class="flex items-center px-4 py-3 rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-100 font-bold active:scale-95 transition-all">
                    <span class="text-sm">Input Parkir</span>
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['role']) && (strtolower($_SESSION['role']) == 'owner' || strtolower($_SESSION['role']) == 'admin')) : ?>
                <p class="text-[10px] font-bold text-slate-400 px-4 mt-6 mb-2 uppercase tracking-widest">Analisis</p>
                <a href="<?= BASEURL; ?>/admin/laporan" class="flex items-center px-4 py-3 rounded-xl hover:bg-slate-50 transition-all <?= ($data['judul'] == 'Laporan Transaksi' || $data['judul'] == 'Laporan Riwayat Parkir') ? 'sidebar-active' : ''; ?>">
                    <span class="text-sm text-slate-600">Laporan Transaksi</span>
                </a>
            <?php endif; ?>

            <div class="pt-10 pb-8">
                <a href="<?= BASEURL; ?>/auth/logout" onclick="return confirm('Apakah Anda yakin ingin keluar?')" class="flex items-center px-4 py-3 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all font-bold group">
                    <span class="text-sm">Keluar Sistem</span>
                </a>
            </div>
        </nav>
    </aside>

    <div class="flex-1 ml-64 min-h-screen flex flex-col">
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-20">
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    <span class="text-slate-400 font-medium text-xs">Halaman</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-900 font-bold text-sm tracking-tight"><?= $data['judul']; ?></span>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-extrabold text-slate-900 leading-none capitalize"><?= $_SESSION['nama'] ?? 'User'; ?></p>
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-widest mt-1"><?= $_SESSION['role'] ?? 'Guest'; ?></p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-blue-400 rounded-2xl flex items-center justify-center text-white font-bold shadow-md border-2 border-white uppercase">
                        <?= substr($_SESSION['nama'] ?? 'U', 0, 1); ?>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-8">