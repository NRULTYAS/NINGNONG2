<!-- Combined CTA + Footer Section -->
<style>
/* Unified CTA + Footer Section - Full Width */
.unified-footer-section {
  background: linear-gradient(180deg, #5F6E54 0%, #3a442e 35%, #2d3524 100%);
  color: #e8e6dd;
  width: 100%;
  padding: 0;
  position: relative;
  overflow: hidden;
}

/* Leaf pattern background - very subtle */
.unified-footer-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M60 10c-27.6 0-50 22.4-50 50s22.4 50 50 50 50-22.4 50-50-22.4-50-50-50zm0 80c-16.6 0-30-13.4-30-30s13.4-30 30-30 30 13.4 30 30-13.4 30-30 30z' fill='none' stroke='%23D6B56C' stroke-width='0.5' opacity='0.04'/%3E%3C/svg%3E");
  background-size: 120px 120px;
  opacity: 0.3;
  pointer-events: none;
}

/* Decorative shapes */
.footer-accent {
  position: absolute;
  top: -30px;
  right: -30px;
  width: 150px;
  height: 150px;
  background: radial-gradient(circle, rgba(214,181,108,0.08) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

.footer-accent-2 {
  position: absolute;
  bottom: -20px;
  left: -20px;
  width: 120px;
  height: 120px;
  background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 70%);
  border-radius: 30% 70% 70% 30% / 30% 30% 70% 30%;
  pointer-events: none;
}

/* CTA Content */
.cta-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 30px 20px 20px;
}

@media (min-width: 768px) {
  .cta-content {
    padding: 50px 40px 40px;
  }
}

.cta-content h2 {
  color: #ffffff;
  font-size: 20px;
  font-weight: 700;
  margin-bottom: 8px;
  font-family: 'Plus Jakarta Sans', sans-serif;
}

@media (min-width: 768px) {
  .cta-content h2 {
    font-size: 24px;
    margin-bottom: 12px;
  }
}

.cta-content p {
  color: rgba(232,230,221,0.7);
  font-size: 12px;
  margin-bottom: 16px;
  font-family: 'Inter', sans-serif;
}

@media (min-width: 768px) {
  .cta-content p {
    font-size: 14px;
    margin-bottom: 24px;
  }
}

.cta-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 8px;
}

@media (min-width: 768px) {
  .cta-buttons {
    gap: 12px;
  }
}

.cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

@media (min-width: 768px) {
  .cta-btn {
    gap: 8px;
    padding: 12px 24px;
    font-size: 14px;
  }
}

.cta-btn-primary {
  background: #ffffff;
  color: #5F6E54;
}

.cta-btn-primary:hover {
  background: #f5f5f5;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.cta-btn-whatsapp {
  background: #25D366;
  color: #ffffff;
}

.cta-btn-whatsapp:hover {
  background: #1da851;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Footer Content */
.footer-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 40px 0;
  position: relative;
}

.footer-container {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 35px;
  padding-bottom: 35px;
}

/* Section title with icon */
.footer-col h4 {
  color: #D6B56C;
  font-size: 12px;
  letter-spacing: 1px;
  margin-bottom: 18px;
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  gap: 8px;
}

.footer-col h4 i {
  font-size: 14px;
  opacity: 0.9;
}

.footer-col a, .footer-col p {
  display: block;
  color: #d8d6cd;
  text-decoration: none;
  margin-bottom: 10px;
  font-size: 14px;
  line-height: 1.5;
  font-family: 'Inter', sans-serif;
  transition: all 0.3s ease;
}

.footer-col a:hover {
  color: #ffffff;
  transform: translateX(5px);
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 16px;
}

.footer-logo img {
  width: 40px;
  height: 40px;
  border-radius: 10px;
}

.footer-brand p {
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 20px;
  max-width: 320px;
  font-family: 'Inter', sans-serif;
}

.footer-social {
  display: flex;
  gap: 12px;
}

.footer-social a {
  width: 38px;
  height: 38px;
  background: rgba(255,255,255,0.12);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #e8e6dd;
  text-decoration: none;
  transition: all 0.3s ease;
}

.footer-social a:hover {
  background: rgba(214,181,108,0.25);
  color: #ffffff;
  transform: scale(1.1);
}

/* Operating hours chip */
.hours-chip {
  display: inline-block;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(214,181,108,0.2);
  border-radius: 20px;
  padding: 10px 16px;
  font-size: 13px;
  color: #e8e6dd;
  transition: all 0.3s ease;
}

.hours-chip:hover {
  background: rgba(255,255,255,0.12);
  transform: translateY(-2px);
}

.hours-chip i {
  color: #D6B56C;
  margin-right: 6px;
  font-size: 12px;
}

/* Bottom section - full width background */
.footer-bottom {
  background: rgba(0,0,0,0.15);
  border-top: 1px solid rgba(214,181,108,0.1);
  padding: 18px 0;
  display: flex;
  justify-content: space-between;
  font-size: 12px;
  color: #b5b3a8;
  font-family: 'Inter', sans-serif;
}

.footer-bottom .footer-bottom-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 40px;
  display: flex;
  justify-content: space-between;
}

.footer-bottom span {
  transition: color 0.3s ease;
}

.footer-bottom span:hover {
  color: #d8d6cd;
}

@media (max-width: 900px) {
  .footer-container {
    grid-template-columns: 1fr 1fr;
    gap: 25px;
  }
  
  .footer-bottom .footer-bottom-content {
    flex-direction: column;
    gap: 8px;
    text-align: center;
    padding: 0 25px;
  }
}

@media (max-width: 600px) {
  .footer-container {
    grid-template-columns: 1fr;
    gap: 25px;
  }
  
  .footer-bottom .footer-bottom-content {
    padding: 0 20px;
  }
}
</style>

<!-- Unified CTA + Footer Section -->
<div class="unified-footer-section">
  <div class="footer-accent"></div>
  <div class="footer-accent-2"></div>
  
  <!-- CTA Content -->
  <div class="cta-content">
    <h2>Siap Memesan Kue Favoritmu?</h2>
    <p>Pesan sekarang dan nikmati kelezatan kue basah segar langsung ke rumahmu</p>
    <div class="cta-buttons">
      <a href="<?php echo base_url('produk'); ?>" class="cta-btn cta-btn-primary">
        <i class="fas fa-shopping-bag text-xs md:text-sm"></i> <span class="hidden md:inline">Pesan Sekarang</span><span class="md:hidden">Pesan</span>
      </a>
      <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>" target="_blank" class="cta-btn cta-btn-whatsapp">
        <i class="fab fa-whatsapp text-xs md:text-sm"></i> <span class="hidden md:inline">Chat WhatsApp</span><span class="md:hidden">Chat</span>
      </a>
    </div>
  </div>
  
  <!-- Footer Content -->
  <div class="footer-content">
    <div class="footer-container">
      <!-- Brand/Deskripsi -->
      <div class="footer-col footer-brand">
        <div class="footer-logo">
          <img src="<?php echo base_url('assets/img/LOGO.svg'); ?>" alt="Ningnong">
          <div>
            <strong style="color: #ffffff; font-size: 18px; display: block; font-family: 'Plus Jakarta Sans', sans-serif;">NINGNONG</strong>
            <span style="color: #a8b29a; font-size: 11px; letter-spacing: 1px; text-transform: uppercase;">KUE BASAH</span>
          </div>
        </div>
        <p>Kue basah tradisional dengan sentuhan modern. Dibuat dari bahan pilihan untuk cita rasa otentik.</p>
        <div class="footer-social">
          <a href="https://www.instagram.com/ningnong_kue?igsh=MXdrdmNuYXA2YXJreA==" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://wa.me/<?php echo NOMOR_WA_PENJUAL; ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>
      
      <!-- Menu & Jam Buka - sejajar di mobile -->
      <div class="footer-col">
        <h4><i class="fas fa-list"></i> MENU</h4>
        <a href="<?php echo base_url('home'); ?>">Beranda</a>
        <a href="<?php echo base_url('produk'); ?>">Aneka Kue</a>
        <a href="<?php echo base_url('keranjang'); ?>">Keranjang</a>
        <a href="<?php echo base_url('riwayat'); ?>">Riwayat</a>
      </div>
      
      <div class="footer-col">
        <h4><i class="fas fa-clock"></i> JAM BUKA</h4>
        <span class="hours-chip"><i class="fas fa-check-circle"></i> Setiap Hari 05.00 - 12.00</span>
      </div>
      
      <!-- Kontak - full width di mobile -->
      <div class="footer-col">
        <h4><i class="fas fa-map-marker-alt"></i> KONTAK</h4>
        <p>Gbi, Komp, Jl. Alam Raya No.4, RW.5, Buahbatu, Kec. Bojongsoang, Kabupaten Bandung, Jawa Barat 40287</p>
        <p>0821-1976-4204</p>
      </div>
    </div>
    
    <!-- Bottom section - full width background -->
    <div class="footer-bottom">
      <div class="footer-bottom-content">
        <span>&copy; <?php echo date('Y'); ?> NINGNONG Kue Basah. All rights reserved.</span>
        <span>Made with <i class="fas fa-heart" style="color: #D6B56C; font-size: 11px;"></i> in Indonesia</span>
      </div>
    </div>
  </div>
</div>

</body>
</html>