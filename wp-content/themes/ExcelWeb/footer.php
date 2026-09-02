<!-- Footer Section -->
<footer class="exg-ft-section">
  <div class="exg-ft-container">

    <div class="exg-ft-cards-row">

      <!-- Brand Card -->
      <div class="exg-ft-card exg-ft-brand-card">
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
          <?php if ( get_theme_mod('footer_twitter') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_twitter') ); ?>" target="_blank" rel="noopener" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_youtube') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_youtube') ); ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_instagram') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_instagram') ); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <?php endif; ?>
          <?php if ( get_theme_mod('footer_linkedin') ) : ?>
            <a href="<?php echo esc_url( get_theme_mod('footer_linkedin') ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
          <?php endif; ?>
        </div>
      </div>

      <!-- Links Card: Quick Links / Our Services / Contact Info -->
      <div class="exg-ft-card exg-ft-links-card">
        <div class="exg-ft-links-grid">

          <!-- Quick Links -->
          <div class="exg-ft-col">
            <h4 class="exg-ft-heading">Quick Links</h4>
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

          <!-- Our Services -->
          <div class="exg-ft-col">
            <h4 class="exg-ft-heading">Our Services</h4>
            <ul class="exg-ft-list">
              <?php
              $footer_services = new WP_Query( array(
                  'post_type'      => 'service',
                  'posts_per_page' => 6,
                  'orderby'        => 'menu_order title',
                  'order'          => 'ASC',
              ) );
              if ( $footer_services->have_posts() ) :
                while ( $footer_services->have_posts() ) : $footer_services->the_post();
              ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php
                endwhile;
                wp_reset_postdata();
              endif;
              ?>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="exg-ft-col">
            <h4 class="exg-ft-heading">Contact Info</h4>

            <?php if ( get_theme_mod('footer_phone') ) :
              $phone = get_theme_mod('footer_phone');
              $phone_link = preg_replace('/\D+/', '', $phone);
            ?>
              <p class="exg-ft-contact-item">
                <i class="bi bi-telephone"></i>
                <a href="tel:<?php echo esc_attr($phone_link); ?>"><?php echo esc_html($phone); ?></a>
              </p>
            <?php endif; ?>

            <?php if ( get_theme_mod('footer_email') ) :
              $email = get_theme_mod('footer_email');
            ?>
              <p class="exg-ft-contact-item">
                <i class="bi bi-envelope"></i>
                <a href="mailto:<?php echo antispambot($email); ?>"><?php echo esc_html($email); ?></a>
              </p>
            <?php endif; ?>

            <?php if ( get_theme_mod('footer_address') ) : ?>
              <p class="exg-ft-contact-item">
                <i class="bi bi-geo-alt"></i>
                <span><?php echo nl2br( esc_html( get_theme_mod('footer_address') ) ); ?></span>
              </p>
            <?php endif; ?>

            <?php if ( get_theme_mod('footer_hours') ) : ?>
              <p class="exg-ft-contact-item">
                <i class="bi bi-clock"></i>
                <span><?php echo nl2br( esc_html( get_theme_mod('footer_hours', 'Monday – Friday: 8:00 AM – 6:00 PM') ) ); ?></span>
              </p>
            <?php endif; ?>
          </div>

        </div>
      </div>

    </div>

    <!-- Bottom Bar -->
    <div class="exg-ft-bottom">
      <p class="exg-ft-copyright">
        <?php echo wp_kses_post( get_theme_mod( 'footer_copyright', '© ' . date("Y") . ' Excel Graphics. All Rights Reserved.' ) ); ?>
      </p>
      <div class="exg-ft-legal-links">
        <a href="<?php echo esc_url( get_theme_mod('footer_privacy_url', '#') ); ?>">Privacy Policy</a>
        <span class="exg-ft-legal-sep">|</span>
        <a href="<?php echo esc_url( get_theme_mod('footer_terms_url', '#') ); ?>">Terms &amp; Conditions</a>
      </div>
    </div>

  </div>
</footer>

<style>
/* Dark Theme Modern Footer - Two Card Layout */
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
  width: 100%;
  padding: 0 80px;
  box-sizing: border-box;
  margin: 0 auto;
}

/* Cards Row */
.exg-ft-cards-row {
  display: flex;
  align-items: stretch;
  gap: 24px;
  margin-bottom: 40px;
}

.exg-ft-card {
  background-color: #171c28;
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 24px;
  padding: 40px;
  box-sizing: border-box;
}

.exg-ft-brand-card {
  flex: 0 0 30%;
}

.exg-ft-links-card {
  flex: 1;
}

/* Brand Card & Fallback Logo */
.exg-ft-logo-img {
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
}

/* Social Media Circle Badges */
.exg-ft-socials {
  display: flex;
  gap: 12px;
}

.exg-ft-socials a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #ffffff;
  color: #0b0f17;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.05rem;
  text-decoration: none;
  transition: all 0.3s ease;
}

.exg-ft-socials a:hover {
  background: #1ba3b0;
  color: #ffffff;
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(27, 163, 176, 0.3);
}

/* Links Grid Inside Right Card */
.exg-ft-links-grid {
  display: grid;
  grid-template-columns: 1fr 1fr 1.2fr;
  gap: 40px;
}

.exg-ft-col {
  display: flex;
  flex-direction: column;
}

/* Headings */
.exg-ft-heading {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  margin: 0 0 22px 0;
}

/* Lists */
.exg-ft-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
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

/* Contact Items */
.exg-ft-contact-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin: 0 0 16px 0;
  font-size: 0.93rem;
  line-height: 1.5;
  color: #94a3b8;
}

.exg-ft-contact-item:last-child {
  margin-bottom: 0;
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

/* Bottom Bar */
.exg-ft-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding-top: 28px;
}

.exg-ft-copyright {
  font-size: 0.88rem;
  color: #64748b;
  margin: 0;
}

.exg-ft-legal-links {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.88rem;
}

.exg-ft-legal-links a {
  color: #94a3b8;
  text-decoration: none;
  transition: color 0.2s ease;
}

.exg-ft-legal-links a:hover {
  color: #1ba3b0;
}

.exg-ft-legal-sep {
  color: #3a4354;
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
  .exg-ft-container {
    padding: 0 40px;
  }

  .exg-ft-cards-row {
    flex-direction: column;
  }

  .exg-ft-brand-card {
    flex: 1 1 auto;
  }

  .exg-ft-links-grid {
    grid-template-columns: 1fr 1fr;
    gap: 32px;
  }

  .exg-ft-col:nth-child(3) {
    grid-column: 1 / -1;
  }
}

@media (max-width: 640px) {
  .exg-ft-section {
    padding: 150px 0 20px;
  }

  .exg-ft-container {
    padding: 0 20px;
  }

  .exg-ft-card {
    padding: 28px 24px;
    border-radius: 18px;
  }

  .exg-ft-links-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }

  .exg-ft-col:nth-child(3) {
    grid-column: auto;
  }

  .exg-ft-bottom {
    flex-direction: column;
    text-align: center;
  }
}
</style>

<!-- Floating WhatsApp Action Button -->
<?php
$whatsapp_number  = get_theme_mod('footer_whatsapp');
if ( $whatsapp_number ) : ?>
  <a href="https://wa.me/<?php echo esc_attr( preg_replace('/\D+/', '', $whatsapp_number) ); ?>"
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
