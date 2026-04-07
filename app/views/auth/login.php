<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md">
        <div class="flex justify-center mb-8">
            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                <span class="text-white font-bold text-xl">P</span>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Selamat Datang</h1>
                <p class="text-slate-500 text-sm mt-1">Silakan masuk untuk mengelola parkir.</p>
                
                <?php if(isset($_GET['error'])): ?>
                    <div class="mt-4 p-3 bg-red-50 border border-red-200 text-red-600 text-xs rounded-lg">
                        <?= $_GET['error'] == 'wrong_password' ? 'Password salah!' : 'Username tidak ditemukan!'; ?>
                    </div>
                <?php endif; ?>
            </div>

           <form action="<?= BASEURL; ?>/auth/proses" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text" name="username" required 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                           placeholder="Masukkan username">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                           placeholder="••••••••">
                </div>
                <button type="submit" 
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl shadow-md transition-all active:scale-[0.98]">
                    Masuk Sekarang
                </button>
            </form>
            </div>

        <p class="text-center mt-8 text-slate-400 text-sm italic">
            &copy; 2026 Parkirkeun v2.0
        </p>
    </div>

</body>
</html>