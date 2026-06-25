<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NINGNONG Kue Basah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'background': '#F7F6F2',
                        'surface': '#FFFFFF',
                        'primary': '#7C8C6C',
                        'primary-hover': '#6A7A5C',
                        'primary-light': '#E8EDE5',
                        'secondary': '#A8B29A',
                        'secondary-light': '#F0F2EC',
                        'text-main': '#2C2C2C',
                        'text-muted': '#6E6E6E',
                        'text-subtle': '#9A9A9A',
                        'accent': '#D6B56C',
                        'border-subtle': '#E5E3DE',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .blob { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
    </style>
</head>
<body class="bg-background min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute -top-20 -left-20 w-72 h-72 bg-secondary-light blob animate-[float_6s_ease-in-out_infinite] opacity-50"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-accent blob animate-[float_6s_ease-in-out_infinite] opacity-40" style="animation-delay:2s"></div>
    <div class="absolute top-1/2 left-1/2 w-48 h-48 bg-primary-light blob animate-[float_6s_ease-in-out_infinite] opacity-30" style="animation-delay:4s"></div>

    <div class="w-full max-w-5xl grid md:grid-cols-2 gap-8 items-center relative z-10">
        <!-- Left Panel -->
        <div class="hidden md:flex flex-col items-center text-center p-8">
            <div class="w-24 h-24 bg-primary rounded-3xl flex items-center justify-center text-white font-bold text-4xl shadow-2xl shadow-primary/30 mb-6">N</div>
            <h1 class="text-4xl font-bold text-main mb-3" style="font-family: 'Plus Jakarta Sans', sans-serif;">NINGNONG</h1>
            <p class="text-primary text-lg mb-2">Kue Basah Tradisional</p>
            <p class="text-muted text-sm max-w-xs">Nikmati kelezatan kue basah dengan bahan berkualitas dan rasa autentik.</p>
        </div>

        <!-- Login Form -->
        <div class="bg-surface rounded-3xl p-8 shadow-lg shadow-primary/10 border border-border-subtle">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-main mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif;">Selamat Datang</h2>
                <p class="text-muted text-sm">Masuk ke akun Anda</p>
            </div>
            <?php echo $this->session->flashdata('error'); ?>
            <form action="<?php echo base_url('auth/proses_login'); ?>" method="post">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-muted mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"><i class="fas fa-envelope"></i></div>
                        <input type="email" name="email" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle bg-background focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="nama@email.com">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-muted mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"><i class="fas fa-lock"></i></div>
                        <input type="password" name="password" required class="w-full pl-11 pr-4 py-3 rounded-xl border border-border-subtle bg-background focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 shadow-md shadow-primary/20 flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt text-sm"></i> Masuk
                </button>
            </form>
            <p class="text-center mt-6 text-subtle text-sm">Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>" class="text-primary font-semibold hover:underline">Daftar</a></p>
        </div>
    </div>
</body>
</html>