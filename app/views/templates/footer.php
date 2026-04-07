</main> <footer class="mt-auto py-6 border-t border-slate-200 bg-white/50">
            <div class="px-8 flex justify-between items-center">
                <p class="text-slate-400 text-xs">
                    &copy; <?= date('Y'); ?> <span class="font-bold text-slate-600 tracking-tight text-sm">Parkirkeun v2</span>. 
                    All rights reserved.
                </p>
                <div class="flex gap-4">
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">System Status: Stable</span>
                </div>
            </div>
        </footer>

    </div> </div> <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

<script>
    $(function() {
        /**
         * GLOBAL FLASH MESSAGE DETECTION
         * Mendeteksi pesan sukses/gagal dari Controller
         */
        const flashData = '<?= isset($_SESSION['flash']) ? $_SESSION['flash'] : ''; ?>';
        
        if (flashData) {
            Swal.fire({
                title: 'Berhasil!',
                text: flashData,
                icon: 'success',
                confirmButtonColor: '#2563eb',
                customClass: {
                    confirmButton: 'px-6 py-2 rounded-xl font-bold'
                }
            });
            // Hapus session flash setelah ditampilkan agar tidak muncul lagi saat refresh
            <?php unset($_SESSION['flash']); ?>
        }
    });

    /**
     * SCRIPT INTERAKSI SIDEBAR (Mobile Responsive)
     */
    function toggleSidebar() {
        const sidebar = document.querySelector('aside');
        sidebar.classList.toggle('hidden');
    }
</script>

</body>
</html>