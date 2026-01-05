

<?php $__env->startSection('title', 'Buat Peminjaman - Sistem Manajemen Ruangan'); ?>

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
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Peminjaman Ruangan</h1>
            <p class="text-gray-600 mb-8">Isi formulir di bawah ini untuk mengajukan peminjaman ruangan</p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat beberapa error:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('peminjaman.store')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Ruangan -->
                <div>
                    <label for="ID_RUANGAN" class="block text-sm font-medium text-gray-700 mb-2">Pilih Ruangan <span class="text-red-500">*</span></label>
                    <select 
                        id="ID_RUANGAN" 
                        name="ID_RUANGAN" 
                        required 
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="">-- Pilih Ruangan --</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ruangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($r->ID_RUANGAN); ?>" <?php echo e(old('ID_RUANGAN') == $r->ID_RUANGAN ? 'selected' : ''); ?>>
                                <?php echo e($r->NAMA_RUANGAN); ?> (Kapasitas: <?php echo e($r->KAPASITAS); ?>) - <?php echo e($r->LOKASI); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <!-- Nama Kegiatan -->
                <div>
                    <label for="NAMA_KEGIATAN" class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="NAMA_KEGIATAN" 
                        name="NAMA_KEGIATAN" 
                        required 
                        maxlength="30"
                        value="<?php echo e(old('NAMA_KEGIATAN')); ?>"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Masukkan nama kegiatan"
                    >
                </div>

                <!-- Penanggung Jawab -->
                <div>
                    <label for="PENANGGUNG_JAWAB" class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="PENANGGUNG_JAWAB" 
                        name="PENANGGUNG_JAWAB" 
                        required 
                        maxlength="30"
                        value="<?php echo e(old('PENANGGUNG_JAWAB', auth()->user()->NAMA_USER)); ?>"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Nama penanggung jawab"
                    >
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="KETERANGAN" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea 
                        id="KETERANGAN" 
                        name="KETERANGAN" 
                        rows="3"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Deskripsi kegiatan (opsional)"
                    ><?php echo e(old('KETERANGAN')); ?></textarea>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="TANGGAL" class="block text-sm font-medium text-gray-700 mb-2">Tanggal <span class="text-red-500">*</span></label>
                    <input 
                        type="date" 
                        id="TANGGAL" 
                        name="TANGGAL" 
                        required 
                        min="<?php echo e(date('Y-m-d')); ?>"
                        value="<?php echo e(old('TANGGAL')); ?>"
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>

                <!-- Waktu -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="JAM_MULAI" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai <span class="text-red-500">*</span></label>
                        <input 
                            type="time" 
                            id="JAM_MULAI" 
                            name="JAM_MULAI" 
                            required 
                            min="08:00"
                            max="17:00"
                            value="<?php echo e(old('JAM_MULAI')); ?>"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <p class="mt-1 text-sm text-gray-500">Jam operasional: 08:00 - 17:00</p>
                    </div>

                    <div>
                        <label for="JAM_SELESAI" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai <span class="text-red-500">*</span></label>
                        <input 
                            type="time" 
                            id="JAM_SELESAI" 
                            name="JAM_SELESAI" 
                            required 
                            min="08:00"
                            max="17:00"
                            value="<?php echo e(old('JAM_SELESAI')); ?>"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <p class="mt-1 text-sm text-gray-500">Minimal 2 jam</p>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Perhatian:</h3>
                            <ul class="mt-2 text-sm text-blue-700 list-disc list-inside">
                                <li>Durasi peminjaman minimal 2 jam</li>
                                <li>Peminjaman hanya dapat dilakukan antara pukul 08:00 - 17:00</li>
                                <li>Status peminjaman akan diproses oleh admin</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="<?php echo e(route('dashboard')); ?>" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-200 font-medium"
                    >
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Documents\GILAA\resources\views/peminjaman/create.blade.php ENDPATH**/ ?>