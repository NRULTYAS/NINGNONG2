<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - NINGNONG Kue Basah</title>
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

        <!-- Reset Password Form -->
        <div class="bg-surface rounded-3xl p-8 shadow-lg shadow-primary/10 border border-border-subtle">
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-primary-light rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-primary text-xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-main mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif;">Reset Password</h2>
                <p class="text-muted text-sm">Buat password baru untuk akun Anda</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if (!isset($token) || !$token): ?>
                <!-- Token tidak valid -->
                <div class="text-center py-6">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-times-circle text-red-400 text-2xl"></i>
                    </div>
                    <p class="text-muted text-sm mb-4">Token tidak valid atau sudah kedaluwarsa.</p>
                    <a href="<?php echo base_url('auth/forgot_password'); ?>" class="inline-block py-3 px-6 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition shadow-md shadow-primary/20">
                        Request Ulang
                    </a>
                </div>
            <?php else: ?>
                <form action="<?php echo base_url('auth/proses_reset_password'); ?>" method="post">
                    <input type="hidden" name="token" value="<?php echo $token; ?>">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-muted mb-2">Password Baru</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"><i class="fas fa-lock"></i></div>
                            <input type="password" id="reset_password" name="password" required minlength="6" class="w-full pl-11 pr-12 py-3 rounded-xl border border-border-subtle bg-background focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="Minimal 6 karakter">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-subtle hover:text-muted transition toggle-pwd" onclick="togglePassword('reset_password', 'reset_pwd_icon')">
                                <i id="reset_pwd_icon" class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-muted mb-2">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-muted"><i class="fas fa-check-circle"></i></div>
                            <input type="password" id="reset_konfirmasi" name="konfirmasi_password" required minlength="6" class="w-full pl-11 pr-12 py-3 rounded-xl border border-border-subtle bg-background focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="Ulangi password baru">
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-subtle hover:text-muted transition toggle-pwd" onclick="togglePassword('reset_konfirmasi', 'reset_konf_icon')">
                                <i id="reset_konf_icon" class="fas fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-primary text-white rounded-full font-medium hover:bg-primary-hover transition-all duration-200 shadow-md shadow-primary/20 flex items-center justify-center gap-2">
                        <i class="fas fa-save text-sm"></i> Simpan Password Baru
                    </button>
                </form>

                <p class="text-center mt-6 text-subtle text-sm"><a href="<?php echo base_url('auth/login'); ?>" class="text-primary font-semibold hover:underline">Kembali ke Login</a></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>