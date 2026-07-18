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
        .toggle-pwd { cursor: pointer; }
    </style>
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
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
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-muted">Password</label>
                        <a href="<?php echo base_url('auth/forgot_password'); ?>" class="text-sm font-medium text-primary hover:text-primary-hover transition">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"><i class="fas fa-lock"></i></div>
                        <input type="password" id="login_password" name="password" required class="w-full pl-11 pr-12 py-3 rounded-xl border border-border-subtle bg-background focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="••••••••">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-subtle hover:text-muted transition toggle-pwd" onclick="togglePassword('login_password', 'login_pwd_icon')">
                            <i id="login_pwd_icon" class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" class="w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 shadow-md shadow-primary/20 flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt text-sm"></i> Masuk
                </button>
            </form>

            <!-- Separator -->
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-border-subtle"></div>
                <span class="text-subtle text-sm">atau</span>
                <div class="flex-1 h-px bg-border-subtle"></div>
            </div>

            <!-- Google Login Button -->
            <a href="<?php echo base_url('auth/google'); ?>" class="w-full py-3.5 rounded-full border-2 border-border-subtle bg-white text-text-main font-medium hover:bg-secondary-light hover:border-primary/30 transition-all duration-200 flex items-center justify-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Login dengan Google
            </a>

            <p class="text-center mt-6 text-subtle text-sm">Belum punya akun? <a href="<?php echo base_url('auth/register'); ?>" class="text-primary font-semibold hover:underline">Daftar</a></p>

        </div>
    </div>
</body>
</html>