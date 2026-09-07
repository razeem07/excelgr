<?php /* Template Name: clientspage
        Template Post Type: page,post */
?>

<?php get_header(); ?>

<!-- Clients Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('clients_banner'); ?>
<section class="clients-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Clients Page Banner" class="clients-hero-bg-img" />
    <div class="clients-hero-overlay"></div>
  <?php endif; ?>

  <div class="clients-hero-container">
    <div class="clients-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="clients-hero-title fade-right"><?php echo esc_html( $banner['title'] ); ?></h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="clients-hero-subtext fade-left"><?php echo esc_html( $banner['content'] ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.clients-hero-banner {
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

.clients-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.clients-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.clients-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.clients-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.clients-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.clients-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .clients-hero-banner {
    min-height: 340px;
  }
  .clients-hero-container {
    padding: 40px 24px;
  }
  .clients-hero-title {
    font-size: 2.15rem;
  }
  .clients-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .clients-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .clients-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<?php
  $args = array(
    'post_type'      => 'clients',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC'
  );

  $clients_list_query = new WP_Query($args);
?>

<section class="clients-list-section">
  <div class="clients-list-container">

    <div class="clients-list-header">
      <div class="clients-list-badge">
        <span class="clients-list-diamond">◆</span>
        <span class="clients-list-badge-text fade-left">Trusted Partners</span>
      </div>
      <h2 class="clients-list-main-title fade-right">Our Clients</h2>
      <p class="clients-list-subtitle fade-left">Businesses and brands we've proudly partnered with over the years.</p>
    </div>

    <div class="clients-grid">
      <?php if ( $clients_list_query->have_posts() ) :
        while ( $clients_list_query->have_posts() ) : $clients_list_query->the_post();
          $full_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
          $thumb_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>

        <article class="clients-card">
          <?php if ( has_post_thumbnail() ) : ?>
            <button
              type="button"
              class="clients-card-img-btn clients-trigger"
              data-full-img="<?php echo esc_url( $full_img_url ); ?>"
              data-caption="<?php the_title_attribute(); ?>"
              aria-label="Zoom logo <?php the_title_attribute(); ?>"
            >
              <img
                src="<?php echo esc_url( $thumb_img_url ); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="clients-card-img fade-left"
              />
              <div class="clients-card-overlay">
                <span class="clients-view-icon">🔍</span>
              </div>
            </button>
          <?php else : ?>
            <div class="clients-card-placeholder"></div>
          <?php endif; ?>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-clients-found">No clients found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- Lightbox Modal -->
<div id="clients-lightbox" class="clients-lightbox" aria-hidden="true" role="dialog">
  <div class="clients-lightbox-overlay" id="clients-lightbox-overlay"></div>
  <div class="clients-lightbox-container">
    <button type="button" class="clients-lightbox-close" id="clients-lightbox-close" aria-label="Close zoomed image">&times;</button>
    <img src="" alt="" id="clients-lightbox-img" class="clients-lightbox-img" />
  </div>
</div>

<style>
/* Section Layout */
.clients-list-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.clients-list-container {
  width: 100%;
  margin: 0 auto;
}

/* Header Area */
.clients-list-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 56px;
}

.clients-list-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.clients-list-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.clients-list-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.clients-list-main-title {
  font-size: 3.5rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.clients-list-subtitle {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

/* Clients 3-Column Grid */
.clients-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

/* Client Card Styling */
.clients-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.clients-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
}

/* Image Button Trigger */
.clients-card-img-btn {
  display: block;
  width: 100%;
  height: 320px;
  padding: 0;
  border: none;
  background-color: #f4f4f4;
  overflow: hidden;
  position: relative;
  cursor: pointer;
}

.clients-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.clients-card:hover .clients-card-img {
  transform: scale(1.06);
}

.clients-card-placeholder {
  width: 100%;
  height: 320px;
  background-color: #e9ecef;
}

.clients-card-overlay {
  position: absolute;
  inset: 0;
  background: rgba(13, 13, 13, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.clients-card:hover .clients-card-overlay {
  opacity: 1;
}

.clients-view-icon {
  font-size: 1.5rem;
  color: #ffffff;
  background: rgba(27, 163, 176, 0.9);
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transform: scale(0.8);
  transition: transform 0.3s ease;
}

.clients-card:hover .clients-view-icon {
  transform: scale(1);
}

.no-clients-found {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Lightbox Modal Styles */
.clients-lightbox {
  position: fixed;
  inset: 0;
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

.clients-lightbox.active {
  opacity: 1;
  visibility: visible;
}

.clients-lightbox-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.85);
  backdrop-filter: blur(5px);
}

.clients-lightbox-container {
  position: relative;
  z-index: 2;
  max-width: 90vw;
  max-height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.clients-lightbox-img {
  max-width: 90vw;
  max-height: 85vh;
  object-fit: contain;
  border-radius: 12px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.5);
  transform: scale(0.95);
  transition: transform 0.3s ease;
}

.clients-lightbox.active .clients-lightbox-img {
  transform: scale(1);
}

.clients-lightbox-close {
  position: absolute;
  top: -45px;
  right: -10px;
  background: transparent;
  border: none;
  color: #ffffff;
  font-size: 2.5rem;
  line-height: 1;
  cursor: pointer;
  padding: 5px 15px;
  transition: color 0.2s ease;
}

.clients-lightbox-close:hover {
  color: #1ba3b0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .clients-list-section {
    padding: 0 40px;
  }
  .clients-list-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .clients-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
  .clients-list-main-title {
    font-size: 2.6rem;
  }
  .clients-card-img-btn,
  .clients-card-placeholder {
    height: 280px;
  }
}

@media (max-width: 640px) {
  .clients-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .clients-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .clients-list-main-title {
    font-size: 2.2rem;
  }

  .clients-card-img-btn,
  .clients-card-placeholder {
    height: 240px;
  }

  .clients-lightbox-close {
    top: -40px;
    right: 0;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const lightbox = document.getElementById('clients-lightbox');
  const lightboxImg = document.getElementById('clients-lightbox-img');
  const closeBtn = document.getElementById('clients-lightbox-close');
  const overlay = document.getElementById('clients-lightbox-overlay');
  const triggers = document.querySelectorAll('.clients-trigger');

  function openLightbox(fullSrc, altText) {
    lightboxImg.src = fullSrc;
    lightboxImg.alt = altText || '';
    lightbox.classList.add('active');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.remove('active');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    setTimeout(function () {
      lightboxImg.src = '';
    }, 300);
  }

  triggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      const fullSrc = this.getAttribute('data-full-img');
      const caption = this.getAttribute('data-caption');
      if (fullSrc) {
        openLightbox(fullSrc, caption);
      }
    });
  });

  closeBtn.addEventListener('click', closeLightbox);
  overlay.addEventListener('click', closeLightbox);

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && lightbox.classList.contains('active')) {
      closeLightbox();
    }
  });
});
</script>

<?php get_footer(); ?>
