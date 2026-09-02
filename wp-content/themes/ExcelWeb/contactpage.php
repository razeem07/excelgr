<?php /* Template Name: contactpage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>

<?php $banner = get_field('contact_banner'); ?>
<section class="contact-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Contact Page Banner" class="contact-hero-bg-img" />
    <div class="contact-hero-overlay"></div>
  <?php endif; ?>

  <div class="contact-hero-container">
    <div class="contact-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="contact-hero-title fade-right"><?php echo $banner['title']; ?></h1>
      <?php endif; ?>
      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="contact-hero-subtext fade-left"><?php echo $banner['content']; ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
/* Contact Hero - Minimal (image kept, centered, no badge) */
.contact-hero-banner {
  position: relative;
  width: calc(100% - 40px);
  max-width: 100%;
  min-height: 420px;
  margin: 20px auto 60px;
  border-radius: 36px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  background-color: #0d0d0d;
  box-sizing: border-box;
}

.contact-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.contact-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.contact-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.contact-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.contact-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.contact-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .contact-hero-banner {
    min-height: 340px;
  }
  .contact-hero-container {
    padding: 40px 24px;
  }
  .contact-hero-title {
    font-size: 2.15rem;
  }
  .contact-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .contact-hero-banner {
    width: calc(100% - 20px);
  }
  .contact-hero-title {
    font-size: 1.95rem;
  }
}
</style>



<section class="contact-details-section">
  <div class="contact-details-container">
    
    <div class="contact-details-header">
      <div class="contact-details-badge">
        <span class="contact-details-diamond">◆</span>
        <span class="contact-details-badge-text fade-left">Get in touch</span>
      </div>
      <h2 class="contact-details-main-title fade-right">
        Reach Out To Us
      </h2>
      <p class="contact-details-description fade-left">
        Have a question or want to work together? Feel free to call, email, or visit our office location.
      </p>
    </div>

    <div class="contact-details-cards-grid">
      
      <?php if ( get_theme_mod('footer_address') ) : ?>
      <div class="contact-card">
        <div class="contact-card-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
        </div>
        <h3 class="contact-card-title fade-right">Location</h3>
        <p class="contact-card-text fade-left">
          <?php echo nl2br( esc_html( get_theme_mod('footer_address') ) ); ?>
        </p>
      </div>
      <?php endif; ?>

      <?php 
        $phone = get_theme_mod('footer_phone');
        $whatsapp = get_theme_mod('footer_whatsapp');
        if ( $phone || $whatsapp ) : 
      ?>
      <div class="contact-card">
        <div class="contact-card-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
        <h3 class="contact-card-title fade-left">Phone & WhatsApp</h3>
        <p class="contact-card-text fade-right">
          <?php if ( $phone ) : 
            $phone_link = preg_replace('/\D+/', '', $phone);
          ?>
            <a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($phone); ?></a><br />
          <?php endif; ?>

          <?php if ( $whatsapp ) : 
            $wa_link = preg_replace('/\D+/', '', $whatsapp);
          ?>
            <a href="https://wa.me/<?php echo esc_attr($wa_link); ?>?text=<?php echo urlencode('Hello, I would like to know more.'); ?>" target="_blank" rel="noopener">
              WA: <?php echo esc_html($whatsapp); ?>
            </a>
          <?php endif; ?>
        </p>
      </div>
      <?php endif; ?>

      <?php 
        $email = get_theme_mod('footer_email');
        $email2 = get_theme_mod('footer_email2', '');
        $website = get_theme_mod('footer_website', '');
        if ( $email || $email2 || $website ) : 
      ?>
      <div class="contact-card">
        <div class="contact-card-icon-wrapper">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
        </div>
        <h3 class="contact-card-title fade-right">Email & Web</h3>
        <p class="contact-card-text fade-left">
          <?php if ( $email ) : ?>
            <a href="mailto:<?php echo antispambot($email); ?>"><?php echo esc_html($email); ?></a><br />
          <?php endif; ?>

          <?php if ( $email2 ) : ?>
            <a href="mailto:<?php echo antispambot($email2); ?>"><?php echo esc_html($email2); ?></a><br />
          <?php endif; ?>

          <?php if ( $website ) : ?>
            <a href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"><?php echo esc_html($website); ?></a>
          <?php endif; ?>
        </p>
      </div>
      <?php endif; ?>

    </div>

  </div>
</section>

<style>
/* Section Wrapper */
.contact-details-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px;
  color: #111111;
  box-sizing: border-box;
}

.contact-details-container {
  width: 100%;
  margin: 0 auto;
}

/* Top Centered Header */
.contact-details-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 56px auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.contact-details-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.contact-details-diamond {
  color: #1ba3b0;
  font-size: 1.25rem;
  line-height: 1;
}

.contact-details-badge-text {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111111;
}

.contact-details-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 20px 0;
}

.contact-details-description {
  font-size: 1.15rem;
  line-height: 1.6;
  color: #222222;
  margin: 0;
}

/* Cards Grid Layout */
.contact-details-cards-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

/* Card Styling */
.contact-card {
  background-color: #f8f9fa;
  border: 1px solid #e9ecef;
  border-radius: 24px;
  padding: 40px 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
}

/* Card Content */
.contact-card-icon-wrapper {
  width: 60px;
  height: 60px;
  color: #1ba3b0;
  margin-bottom: 20px;
}

.contact-card-icon-wrapper svg {
  width: 100%;
  height: 100%;
}

.contact-card-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1ba3b0;
  margin: 0 0 12px 0;
}

.contact-card-text {
  font-size: 1.15rem;
  line-height: 1.55;
  color: #444444;
  margin: 0;
}

.contact-card-text a {
  color: #444444;
  text-decoration: none;
  transition: color 0.3s ease;
}

.contact-card-text a:hover {
  color: #1ba3b0;
}

/* Responsive Breakpoints */
@media (max-width: 1200px) {
  .contact-details-section {
    padding: 20px 40px;
  }
  .contact-details-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .contact-details-cards-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .contact-details-main-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 640px) {
  .contact-details-section {
    padding: 20px 20px;
  }
  .contact-details-cards-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  .contact-details-main-title {
    font-size: 1.95rem;
  }
  .contact-card {
    padding: 30px 20px;
  }
}
</style>


<section class="contact-form-map-section">
  <div class="contact-form-map-container">
    
    <div class="contact-map-wrapper">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.0123456789!2d76.53!3d9.08!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zOcKwMDQnNDguMCJOIDc2wrAzMSc0OC4wIkU!5e0!3m2!1sen!2sin!4v1600000000000!5m2!1sen!2sin" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade"
        title="Shop Location">
      </iframe>
    </div>

    <div class="contact-form-wrapper">
      <div class="contact-form-header">
        <h3 class="contact-form-title fade-left">Send Us a Message</h3>
        <p class="contact-form-subtext fade-right">Fill out the form below and our team will get back to you shortly.</p>
      </div>
      
      <?php echo do_shortcode('[forminator_form id="215"]'); ?>
    </div>

  </div>
</section>

<style>
/* Section Wrapper */
.contact-form-map-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.contact-form-map-container {
  display: flex;
  gap: 48px;
  align-items: stretch;
  width: 100%;
}

/* Map Column */
.contact-map-wrapper {
  flex: 1;
  min-height: 480px;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  border: 1px solid #e9ecef;
}

.contact-map-wrapper iframe {
  width: 100%;
  height: 100%;
  min-height: 480px;
  border: none;
  display: block;
}

/* Form Column */
.contact-form-wrapper {
  flex: 1;
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  padding: 44px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  box-sizing: border-box;
}

.contact-form-header {
  margin-bottom: 24px;
}

.contact-form-title {
  font-size: 2.1rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 8px 0;
  line-height: 1.2;
}

.contact-form-subtext {
  font-size: 1.1rem;
  color: #555555;
  margin: 0;
  line-height: 1.5;
}

/* =========================================
   FORMINATOR FORM STYLES CUSTOMIZATION
   ========================================= */

/* Main Wrapper Reset */
.contact-form-wrapper .forminator-custom-form-215,
.contact-form-wrapper .forminator-ui {
  margin: 0 !important;
}

/* Input Fields & Textareas */
.contact-form-wrapper .forminator-input,
.contact-form-wrapper .forminator-textarea,
.contact-form-wrapper .forminator-select .forminator-select2 {
  background-color: #f8f9fa !important;
  border: 1px solid #e2e8f0 !important;
  border-radius: 14px !important;
  padding: 14px 18px !important;
  font-size: 1.05rem !important;
  color: #111111 !important;
  transition: all 0.3s ease !important;
  box-sizing: border-box !important;
}

.contact-form-wrapper .forminator-input:focus,
.contact-form-wrapper .forminator-textarea:focus {
  border-color: #1ba3b0 !important;
  background-color: #ffffff !important;
  box-shadow: 0 0 0 4px rgba(27, 163, 176, 0.15) !important;
  outline: none !important;
}

/* Labels */
.contact-form-wrapper .forminator-label {
  font-size: 1rem !important;
  font-weight: 600 !important;
  color: #222222 !important;
  margin-bottom: 8px !important;
}

/* Placeholder Styling */
.contact-form-wrapper .forminator-input::placeholder,
.contact-form-wrapper .forminator-textarea::placeholder {
  color: #888888 !important;
}

/* Submit Button */
.contact-form-wrapper .forminator-button-submit {
  background-color: #1ba3b0 !important;
  color: #ffffff !important;
  font-size: 1.1rem !important;
  font-weight: 700 !important;
  padding: 16px 36px !important;
  border-radius: 50px !important;
  border: none !important;
  cursor: pointer !important;
  transition: all 0.3s ease !important;
  box-shadow: 0 8px 20px rgba(27, 163, 176, 0.25) !important;
  width: auto !important;
  display: inline-block !important;
}

.contact-form-wrapper .forminator-button-submit:hover {
  background-color: #14838e !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 12px 24px rgba(27, 163, 176, 0.35) !important;
}

/* Response Messages (Success / Error) */
.contact-form-wrapper .forminator-response-message {
  border-radius: 12px !important;
  padding: 14px 18px !important;
  font-size: 1rem !important;
  font-weight: 600 !important;
  margin-bottom: 20px !important;
}

.contact-form-wrapper .forminator-response-message.forminator-show.forminator-success {
  background-color: #e6f7f8 !important;
  border: 1px solid #1ba3b0 !important;
  color: #14838e !important;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .contact-form-map-section {
    padding: 0 40px;
  }
}

@media (max-width: 991px) {
  .contact-form-map-container {
    flex-direction: column-reverse;
    gap: 40px;
  }

  .contact-map-wrapper {
    min-height: 380px;
  }
}

@media (max-width: 640px) {
  .contact-form-map-section {
    padding: 0 20px;
  }

  .contact-form-wrapper {
    padding: 28px 20px;
  }

  .contact-form-title {
    font-size: 1.75rem;
  }

  .contact-form-wrapper .forminator-button-submit {
    width: 100% !important;
  }
}
</style>


 <?php get_footer(); ?>