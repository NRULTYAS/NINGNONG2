<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NINGNONG Kue Basah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'krem': '#FFF8E7',
                        'coklat-muda': '#D7CCC8',
                        'coklat': '#8D6E63',
                        'coklat-tua': '#5D4037',
                        'oranye-pastel': '#FFCCBC',
                        'oranye': '#FFAB91',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-krem min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden max-w-4xl w-full grid md:grid-cols-2">
        <div class="bg-coklat-tua p-10 text-white flex flex-col justify-center items-center text-center">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-coklat-tua font-bold text-3xl mb-6">N</div>
            <h2 class="text-3xl font-bold mb-2">NINGNONG</h2>
            <p class="text-coklat-muda mb-8">Kue Basah Tradisional</p>
            <p class="text-sm text-coklat-muda leading-relaxed">Bergabunglah dengan kami dan nikmati kemudahan memesan kue basah favoritmu kapan saja.</p>
        </div>
        <div class="p-10">
            <h3 class="text-2xl font-bold text-coklat-tua mb-2">Buat Akun</h3>
            <p class="text-gray-500 mb-6">Daftar untuk mulai berbelanja</p>

            <?php echo validation_errors('<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg mb-3 text-sm">', '</div>'); ?>

            <form action="<?php echo base_url('auth/proses_register'); ?>" method="post">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="nama" value="<?php echo set_value('nama'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="Nama lengkap">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="email" name="email" value="<?php echo set_value('email'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="email@contoh.com">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">No HP</label>
                    <div class="relative">
                        <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="no_hp" value="<?php echo set_value('no_hp'); ?>" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="0812xxxxxxxxx">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="alamat" required rows="2" class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="Alamat lengkap"><?php echo set_value('alamat'); ?></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi</label>
                        <input type="password" name="konfirmasi_password" required class="w-full px-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua bg-krem/30" placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="w-full py-3 bg-coklat-tua text-white rounded-xl font-medium hover:bg-coklat transition">Daftar</button>
            </form>
            <p class="text-center mt-6 text-gray-500 text-sm">Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>" class="text-coklat-tua font-medium hover:underline">Masuk</a></p>
        </div>
    </div>
</body>
</html>
