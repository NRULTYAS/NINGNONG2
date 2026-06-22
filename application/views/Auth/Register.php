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
                        'krem-tua': '#F5E6CA',
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .blob { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
    </style>
</head>
<body class="bg-krem min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute -top-20 -left-20 w-72 h-72 bg-coklat-muda/30 blob animate-[float_6s_ease-in-out_infinite] opacity-50"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-oranye-pastel/30 blob animate-[float_6s_ease-in-out_infinite] opacity-40" style="animation-delay:2s"></div>
    <div class="absolute top-1/2 left-1/2 w-48 h-48 bg-krem-tua/20 blob animate-[float_6s_ease-in-out_infinite] opacity-30" style="animation-delay:4s"></div>

    <div class="w-full max-w-5xl grid md:grid-cols-2 gap-8 items-center relative z-10">
        <!-- Left Panel -->
        <div class="hidden md:flex flex-col items-center text-center p-8">
            <div class="w-24 h-24 bg-gradient-to-br from-coklat-tua to-coklat rounded-3xl flex items-center justify-center text-white font-bold text-4xl shadow-2xl shadow-coklat-tua/30 mb-6">N</div>
            <h1 class="text-4xl font-bold text-coklat-tua mb-3">NINGNONG</h1>
            <p class="text-coklat text-lg mb-2">Kue Basah Tradisional</p>
            <p class="text-gray-500 text-sm max-w-xs">Nikmati kelezatan kue basah dengan bahan berkualitas dan rasa autentik.</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl shadow-coklat-muda/20 border border-coklat-muda/20">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-coklat-tua mb-1">Daftar Akun</h2>
                <p class="text-gray-500 text-sm">Buat akun baru Anda</p>
            </div>
            <?php if (!empty($error_message)): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 text-sm">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo base_url('auth/proses_register'); ?>" method="post">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-user"></i></div>
                        <input type="text" name="nama" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="Nama lengkap">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-envelope"></i></div>
                        <input type="email" name="email" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="nama@email.com">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-phone"></i></div>
                        <input type="text" name="no_hp" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="0812xxxxxxx">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></div>
                        <input type="password" name="password" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-coklat-muda/30 focus:outline-none focus:border-coklat-tua focus:ring-2 focus:ring-coklat-tua/10 bg-krem/30 transition" placeholder="••••••••">
                    </div>
                </div>


                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-coklat-tua to-coklat text-white rounded-xl font-medium hover:shadow-xl hover:shadow-coklat-tua/25 transition flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus text-sm"></i> Daftar
                </button>
            </form>
            <p class="text-center mt-6 text-gray-400 text-sm">Sudah punya akun? <a href="<?php echo base_url('auth/login'); ?>" class="text-coklat-tua font-semibold hover:underline">Masuk</a></p>
        </div>
    </div>
</body>
</html>
