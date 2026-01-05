

<?php $__env->startSection('title', 'Detail Peminjaman - Sistem Manajemen Ruangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">Sistem Manajemen Ruangan</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="<?php echo e(route('peminjaman.index')); ?>" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Peminjaman Saya</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>  

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="<?php echo e(route('peminjaman.index')); ?>" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Peminjaman</h1>
                    <p class="text-gray-600 mt-1">ID Peminjaman: #<?php echo e($peminjaman->ID_PEMINJAMAN); ?></p>
                </div>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($peminjaman->STATUS == 'menunggu'): ?>
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Menunggu Approval
                        </span>
                    <?php elseif($peminjaman->STATUS == 'disetujui'): ?>
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Disetujui
                        </span>
                    <?php elseif($peminjaman->STATUS == 'ditolak'): ?>
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    <?php else: ?>
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            <?php echo e(ucfirst($peminjaman->STATUS)); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Ruangan</dt>
                        <dd class="mt-1 text-sm text-gray-900 font-semibold"><?php echo e($peminjaman->ruangan->NAMA_RUANGAN); ?></dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($peminjaman->ruangan->LOKASI); ?></dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Kapasitas</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($peminjaman->ruangan->KAPASITAS); ?> orang</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Fasilitas</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($peminjaman->ruangan->FASILITAS); ?></dd>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Kegiatan</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="font-semibold text-lg"><?php echo e($peminjaman->kegiatan?->NAMA_KEGIATAN ?? '-'); ?></p>
                                <p class="text-gray-600 mt-2"><strong>Penanggung Jawab:</strong> <?php echo e($peminjaman->kegiatan?->PENANGGUNG_JAWAB ?? '-'); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($peminjaman->kegiatan?->KETERANGAN): ?>
                                    <p class="text-gray-600 mt-2"><strong>Keterangan:</strong> <?php echo e($peminjaman->kegiatan->KETERANGAN); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>
                        </dd>
                    </div>

                    <div class="sm:col-span-2 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500 mb-2">Jadwal</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-semibold"><?php echo e(\Carbon\Carbon::parse($peminjaman->waktu->TANGGAL)->format('l, d F Y')); ?></span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-semibold">
                                        <?php echo e(\Carbon\Carbon::parse($peminjaman->waktu->JAM_MULAI)->format('H:i')); ?> - 
                                        <?php echo e(\Carbon\Carbon::parse($peminjaman->waktu->JAM_SELESAI)->format('H:i')); ?> WIB
                                    </span>
                                </div>
                                <p class="text-gray-600 mt-2 text-xs">
                                    Durasi: <?php echo e(\Carbon\Carbon::parse($peminjaman->waktu->JAM_MULAI)->diffInHours(\Carbon\Carbon::parse($peminjaman->waktu->JAM_SELESAI))); ?> jam
                                </p>
                            </div>
                        </dd>
                    </div>

                    <div class="sm:col-span-1 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500">Pemohon</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($peminjaman->user->NAMA_USER); ?></dd>
                    </div>

                    <div class="sm:col-span-1 border-t border-gray-200 pt-6">
                        <dt class="text-sm font-medium text-gray-500">Username</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($peminjaman->user->USERNAME); ?></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Documents\GILAA\resources\views/peminjaman/show.blade.php ENDPATH**/ ?>