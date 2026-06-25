<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-background min-h-screen relative overflow-hidden">
	<!-- Decorative blobs -->
	<div class="absolute -top-40 -left-40 w-96 h-96 bg-secondary-light blob opacity-40"></div>
	<div class="absolute -bottom-40 -right-40 w-80 h-80 bg-primary-light blob opacity-30"></div>

	<div class="relative z-10 max-w-4xl mx-auto px-6 py-12">
		<h1 class="text-3xl font-bold text-main mb-6" style="font-family: 'Plus Jakarta Sans', sans-serif;">Welcome to CodeIgniter!</h1>

		<div class="bg-surface rounded-3xl p-8 shadow-lg shadow-primary/10 border border-border-subtle mb-6">
			<p class="text-muted mb-4">The page you are looking at is being generated dynamically by CodeIgniter.</p>

			<p class="text-muted mb-4">If you would like to edit this page you'll find it located at:</p>
			<code class="block bg-secondary-light/30 border border-border-subtle text-primary p-4 rounded-xl mb-4 font-mono text-sm">application/views/welcome_message.php</code>

			<p class="text-muted mb-4">The corresponding controller for this page is found at:</p>
			<code class="block bg-secondary-light/30 border border-border-subtle text-primary p-4 rounded-xl mb-4 font-mono text-sm">application/controllers/Welcome.php</code>

			<p class="text-muted">If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="userguide3/" class="text-primary hover:underline font-medium">User Guide</a>.</p>
		</div>

		<p class="text-right text-subtle text-sm">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>
</html>