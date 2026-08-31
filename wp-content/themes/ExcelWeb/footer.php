<!-- Footer Section -->
<footer class="exg-ft-section">
  <div class="exg-ft-container">
    
    <!-- Hero / Top Banner CTA -->
<!--     <div class="exg-ft-cta-card">
      <div class="exg-ft-cta-content">
        <h3 class="exg-ft-cta-title">Subscribe to our newsletter</h3>
        <p class="exg-ft-cta-subtitle">Get exclusive branding insights and project updates delivered straight to your inbox.</p>
      </div>
      <div class="exg-ft-cta-form-wrapper">
        <?php echo do_shortcode('[forminator_form id="146"]'); ?>
      </div>
    </div> -->

    <!-- Main Navigation Grid -->
    <div class="exg-ft-grid">
      
      <!-- Brand & About -->
      <div class="exg-ft-col exg-ft-brand-col">
        <div class="exg-ft-brand-header">
          <?php if ( get_theme_mod('footer_logo') ) : ?>
            <img src="<?php echo esc_url( get_theme_mod('footer_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" class="exg-ft-logo-img" />
          <?php else : ?>
            <div class="exg-ft-logo">
              <span class="exg-ft-logo-main"><?php echo esc_html( strtolower( get_bloginfo('name') ) ); ?></span>
              <span class="exg-ft-logo-sub">GRAPHICS</span>
            </div>
          <?php endif; ?>
        </div>
        <p class="exg-ft-brand-desc">
          <?php echo esc_html( get_theme_mod('footer_description', 'We provide innovative, durable & creative signboards, logos, and full-scale corporate branding solutions tailored to elevate your business presence.') ); ?>
        </p>
        <div class="exg-ft-socials">
          <?php if ( get_theme_mod('footer_facebook') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_facebook') ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_instagram') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_instagram') ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_twitter') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_twitter') ); ?>" target="_blank" rel="noopener" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_linkedin') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_linkedin') ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Quick Links Column -->
      <div class="exg-ft-col exg-ft-links-col">
        <h4 class="exg-ft-heading">Navigation</h4>
        <?php
        wp_nav_menu([
          'theme_location' => 'primary_menu',
          'container'      => false,
          'menu_class'     => 'exg-ft-list',
          'fallback_cb'    => false,
          'depth'          => 1,
        ]);
        ?>
      </div>

      <!-- Address Column -->
      <div class="exg-ft-col exg-ft-address-col">
        <h4 class="exg-ft-heading">Location</h4>
        <?php if ( get_theme_mod('footer_address') ) : ?>
          <p class="exg-ft-contact-item">
            <i class="bi bi-geo-alt"></i>
            <span><?php echo nl2br( esc_html( get_theme_mod('footer_address') ) ); ?></span>
          </p>
        <?php endif; ?>
      </div>

      <!-- Contact Info Column -->
      <div class="exg-ft-col exg-ft-contact-col">
        <h4 class="exg-ft-heading">Get in Touch</h4>
        
        <?php if ( get_theme_mod('footer_phone') ) : 
          $phone = get_theme_mod('footer_phone');
          $phone_link = preg_replace('/\D+/', '', $phone);
        ?>
          <p class="exg-ft-contact-item">
            <i class="bi bi-telephone"></i>
            <a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($phone); ?></a>
          </p>
        <?php endif; ?>

        <?php if ( get_theme_mod('footer_whatsapp') ) : 
          $whatsapp = get_theme_mod('footer_whatsapp');
          $wa_link = preg_replace('/\D+/', '', $whatsapp);
        ?>
          <p class="exg-ft-contact-item">
            <i class="bi bi-whatsapp"></i>
            <a href="https://wa.me/<?php echo esc_attr($wa_link); ?>?text=<?php echo urlencode('Hello, I would like to know more.'); ?>" target="_blank" rel="noopener">
              <?php echo esc_html($whatsapp); ?>
            </a>
          </p>
        <?php endif; ?>

        <?php if ( get_theme_mod('footer_email') ) : 
          $email = get_theme_mod('footer_email');
          $footer_email2 = get_theme_mod( 'footer_email2', '' );
          $footer_website = get_theme_mod( 'footer_website', '' );
        ?>
          <p class="exg-ft-contact-item">
            <i class="bi bi-envelope"></i>
            <a href="mailto:<?php echo antispambot($email); ?>"><?php echo esc_html($email); ?></a>
          </p>
          <?php if ( $footer_email2 ) : ?>
            <p class="exg-ft-contact-item">
              <i class="bi bi-envelope-open"></i>
              <a href="mailto:<?php echo antispambot($footer_email2); ?>"><?php echo esc_html($footer_email2); ?></a>
            </p>
          <?php endif; ?>
          <?php if ( $footer_website ) : ?>
            <p class="exg-ft-contact-item">
              <i class="bi bi-globe"></i>
              <a href="<?php echo esc_url($footer_website); ?>" target="_blank" rel="noopener"><?php echo esc_html($footer_website); ?></a>
            </p>
          <?php endif; ?>
        <?php endif; ?>
      </div>

    </div>

    <!-- Bottom Copyright Divider -->
    <div class="exg-ft-bottom">
      <p class="exg-ft-copyright">
        <?php echo wp_kses_post( get_theme_mod( 'footer_copyright', '© ' . date("Y") . ' Excel Graphics. All Rights Reserved.' ) ); ?>
      </p>
    </div>

  </div>
</footer>

<style>
/* Dark Theme Modern Footer Core - Unique Namespace: exg-ft */
.exg-ft-section {
  width: 100%;
  background-color: #0b0f17;
  padding: 80px 0 30px;
  box-sizing: border-box;
  color: #94a3b8;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}

.exg-ft-container {
/*   max-width: 1280px; */
  width: 90%;
  margin: 0 auto;
}

/* Newsletter CTA Card with Glassmorphism */
.exg-ft-cta-card {
  background: linear-gradient(135deg, rgba(27, 163, 176, 0.15) 0%, rgba(15, 23, 42, 0.8) 100%);
  border: 1px solid rgba(27, 163, 176, 0.25);
  border-radius: 24px;
  padding: 40px 48px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 40px;
  margin-bottom: 70px;
  backdrop-filter: blur(10px);
}

.exg-ft-cta-content {
  max-width: 520px;
  text-align: left;
  flex-shrink: 0;
}

.exg-ft-cta-title {
  font-size: 1.85rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 8px 0;
  padding: 0;
  letter-spacing: -0.5px;
  line-height: 1.2;
}

.exg-ft-cta-subtitle {
  font-size: 0.95rem;
  color: #94a3b8;
  margin: 0;
  padding: 0;
  line-height: 1.5;
}

.exg-ft-cta-form-wrapper {
  flex-grow: 1;
  max-width: 480px;
  width: 100%;
}

/* Scoped Forminator Field Overrides */
.exg-ft-cta-form-wrapper .forminator-custom-form {
  margin: 0 !important;
  padding: 0 !important;
}

.exg-ft-cta-form-wrapper .forminator-row {
  margin: 0 !important;
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
}

.exg-ft-cta-form-wrapper .forminator-row-last {
  margin-bottom: 0 !important;
}

.exg-ft-cta-form-wrapper .forminator-field {
  flex: 1 1 auto !important;
  margin: 0 !important;
  padding: 0 !important;
}

.exg-ft-cta-form-wrapper input.forminator-input {
  width: 100% !important;
  background: rgba(255, 255, 255, 0.05) !important;
  border: 1px solid rgba(255, 255, 255, 0.15) !important;
  border-radius: 50px !important;
  padding: 14px 22px !important;
  font-size: 0.95rem !important;
  color: #ffffff !important;
  outline: none !important;
  box-shadow: none !important;
  transition: all 0.3s ease !important;
  height: 48px !important;
	margin: 10px !important;
  box-sizing: border-box !important;
}

.exg-ft-cta-form-wrapper input.forminator-input:focus {
  border-color: #1ba3b0 !important;
  background: rgba(255, 255, 255, 0.08) !important;
  box-shadow: 0 0 0 3px rgba(27, 163, 176, 0.2) !important;
}

.exg-ft-cta-form-wrapper input.forminator-input::placeholder {
  color: #64748b !important;
}

.exg-ft-cta-form-wrapper .forminator-col-last,
.exg-ft-cta-form-wrapper .forminator-button {
  margin: 0 !important;
}

.exg-ft-cta-form-wrapper .forminator-button-submit {
  background: #1ba3b0 !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 50px !important;
  padding: 0 32px !important;
  height: 48px !important;
  font-size: 0.95rem !important;
  font-weight: 600 !important;
  cursor: pointer !important;
  transition: all 0.3s ease !important;
  text-shadow: none !important;
  white-space: nowrap !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  flex-shrink: 0 !important;
	margin: 10px !important;
}

.exg-ft-cta-form-wrapper .forminator-button-submit:hover {
  background: #158590 !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 20px rgba(27, 163, 176, 0.3) !important;
}

.exg-ft-cta-form-wrapper .forminator-label {
  display: none !important;
}

/* Footer Navigation Grid */
.exg-ft-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1.2fr 1.3fr;
  gap: 50px;
  padding-bottom: 60px;
}

.exg-ft-col {
  display: flex;
  flex-direction: column;
}

/* Brand Column & Fallback Logo */
.exg-ft-logo-img {
/*   max-height: 50px; */
  width: auto;
}

.exg-ft-logo {
  display: inline-flex;
  flex-direction: column;
  background: linear-gradient(135deg, #1ba3b0, #158590);
  padding: 8px 16px;
  border-radius: 8px;
  color: #ffffff;
}

.exg-ft-logo-main {
  font-weight: 800;
  font-size: 1.2rem;
  letter-spacing: -0.5px;
}

.exg-ft-logo-sub {
  font-size: 0.5rem;
  letter-spacing: 2px;
}

.exg-ft-brand-desc {
  font-size: 0.92rem;
  line-height: 1.6;
  color: #94a3b8;
  margin: 20px 0 24px 0;
  max-width: 340px;
}

/* Social Media Pill Badges */
.exg-ft-socials {
  display: flex;
  gap: 12px;
}

.exg-ft-socials a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.exg-ft-socials a:hover {
  background: #1ba3b0;
  border-color: #1ba3b0;
  color: #ffffff;
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(27, 163, 176, 0.3);
}

/* Headings */
.exg-ft-heading {
  font-size: 1.05rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 20px 0;
  text-transform: uppercase;
  letter-spacing: 0.8px;
}

/* Quick Links List */
.exg-ft-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.exg-ft-list a {
  text-decoration: none;
  color: #94a3b8;
  font-size: 0.95rem;
  transition: all 0.2s ease;
  display: inline-block;
}

.exg-ft-list a:hover {
  color: #1ba3b0;
  transform: translateX(4px);
}

/* Contact & Address Items */
.exg-ft-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin: 0 0 14px 0;
  font-size: 0.93rem;
  line-height: 1.5;
  color: #94a3b8;
}

.exg-ft-contact-item i {
  color: #1ba3b0;
  font-size: 1.1rem;
  margin-top: 2px;
  flex-shrink: 0;
}

.exg-ft-contact-item a {
  color: #94a3b8;
  text-decoration: none;
  transition: color 0.2s ease;
}

.exg-ft-contact-item a:hover {
  color: #ffffff;
}

/* Copyright Row */
.exg-ft-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding-top: 28px;
  text-align: center;
}

.exg-ft-copyright {
  font-size: 0.88rem;
  color: #64748b;
  margin: 0;
}

/* Floating WhatsApp Button */
.exg-ft-whatsapp-float {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 56px;
  height: 56px;
  background-color: #25d366;
  color: #ffffff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.75rem;
  box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
  z-index: 999;
  text-decoration: none;
  transition: all 0.3s ease;
}

.exg-ft-whatsapp-float:hover {
  transform: scale(1.1);
  box-shadow: 0 14px 30px rgba(37, 211, 102, 0.6);
  color: #ffffff;
}

/* Responsive Adjustments */
@media (max-width: 1024px) {
  .exg-ft-cta-card {
    flex-direction: column;
    align-items: flex-start;
    padding: 36px;
  }

  .exg-ft-cta-form-wrapper {
    width: 100%;
    max-width: 100%;
  }

  .exg-ft-grid {
    grid-template-columns: 1fr 1fr;
    gap: 40px;
  }
}

@media (max-width: 640px) {
  .exg-ft-section {
    padding: 150px 0 20px;
  }

  .exg-ft-cta-card {
    padding: 24px;
    border-radius: 16px;
  }

  .exg-ft-cta-form-wrapper .forminator-row {
    flex-direction: column !important;
    gap: 12px !important;
  }

  .exg-ft-cta-form-wrapper .forminator-button-submit {
    width: 100% !important;
  }

  .exg-ft-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}

.news-letter {
	margin: 10px;	
}
	
</style>

<!-- Floating WhatsApp Action Button -->
<?php 
$whatsapp_number  = get_theme_mod('footer_whatsapp');
if ( $whatsapp_number ) : ?>
  <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>" 
     class="exg-ft-whatsapp-float" 
     target="_blank" 
     rel="noopener"
     aria-label="Chat on WhatsApp">
     <i class="bi bi-whatsapp"></i>
  </a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>