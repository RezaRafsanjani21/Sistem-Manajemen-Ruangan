

<?php $__env->startSection('title', 'Home - Sistem Manajemen Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">Sistem Manajemen Ruangan</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium transition duration-200">Login</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Selamat Datang di Sistem Manajemen Ruangan</h2>
            <p class="text-xl text-gray-600">Platform terpadu untuk mengelola peminjaman ruangan dengan mudah dan efisien</p>
        </div>

        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
            <!-- Card 1: Peminjaman Online -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Peminjaman Online</h3>
                <p class="text-gray-600">Ajukan peminjaman ruangan secara online kapan saja, di mana saja dengan proses yang cepat dan mudah.</p>
            </div>

            <!-- Card 2: Approval Workflow -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Approval Workflow</h3>
                <p class="text-gray-600">Sistem persetujuan otomatis dengan notifikasi real-time untuk mempercepat proses approval peminjaman.</p>
            </div>

            <!-- Card 3: Cek Ketersediaan -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Cek Ketersediaan</h3>
                <p class="text-gray-600">Lihat ketersediaan ruangan secara real-time untuk merencanakan jadwal acara Anda dengan lebih baik.</p>
            </div>

            <!-- Card 4: Riwayat Peminjaman -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Riwayat Peminjaman</h3>
                <p class="text-gray-600">Akses riwayat peminjaman lengkap dengan detail kegiatan dan status approval untuk referensi masa depan.</p>
            </div>

            <!-- Card 5: Laporan & Statistik -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Laporan & Statistik</h3>
                <p class="text-gray-600">Dashboard analitik komprehensif untuk monitoring utilisasi ruangan dan performa sistem secara menyeluruh.</p>
            </div>

            <!-- Card 6: Keamanan Data -->
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 border-t-4 border-blue-500">
                <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Keamanan Data</h3>
                <p class="text-gray-600">Sistem keamanan berlapis dengan enkripsi data dan backup otomatis untuk melindungi informasi Anda.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="mt-16 text-center">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Siap Memulai?</h3>
                <p class="text-gray-600 mb-6">Bergabunglah dengan sistem manajemen ruangan modern dan tingkatkan efisiensi organisasi Anda</p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('peminjaman.create')); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-medium transition duration-200">Buat Peminjaman</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-medium transition duration-200">Login Sekarang</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-16 py-8 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-600">
            <p>&copy; 2026 Sistem Manajemen Ruangan. All rights reserved.</p>
        </div>
    </footer>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Documents\GILAA\resources\views/home.blade.php ENDPATH**/ ?>