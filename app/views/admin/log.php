<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800">Log Aktivitas</h1>
    <p class="text-slate-500">Catatan riwayat aksi yang dilakukan oleh seluruh pengguna.</p>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-200">
                <th class="px-6 py-4 text-sm font-bold text-slate-600 uppercase tracking-wider">Waktu</th>
                <th class="px-6 py-4 text-sm font-bold text-slate-600 uppercase tracking-wider">User</th>
                <th class="px-6 py-4 text-sm font-bold text-slate-600 uppercase tracking-wider">Aksi / Aktivitas</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            <?php if (empty($data['logs'])) : ?>
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-slate-500 italic">
                        Belum ada data aktivitas yang tercatat.
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach($data['logs'] as $log) : ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                        <?= date('d/m/Y H:i:s', strtotime($log['waktu_aktivitas'])); ?>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-blue-600 font-bold"><?= $log['username']; ?></span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-700">
                        <?= $log['aktivitas']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>