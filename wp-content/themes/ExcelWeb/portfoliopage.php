<?php /* Template Name: Portfolio Page
        Template Post Type: page, post */
?>

<?php get_header(); ?>

<!-- Portfolio Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('portfolio_banner'); ?>
<section class="portfolio-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Portfolio Page Banner" class="portfolio-hero-bg-img" />
    <div class="portfolio-hero-overlay"></div>
  <?php endif; ?>

  <div class="portfolio-hero-container">
    <div class="portfolio-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="portfolio-hero-title fade-right"><?php echo esc_html( $banner['title'] ); ?></h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="portfolio-hero-subtext fade-left"><?php echo esc_html( $banner['content'] ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.portfolio-hero-banner {
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

.portfolio-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.portfolio-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.portfolio-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.portfolio-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.portfolio-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.portfolio-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .portfolio-hero-banner {
    min-height: 340px;
  }
  .portfolio-hero-container {
    padding: 40px 24px;
  }
  .portfolio-hero-title {
    font-size: 2.15rem;
  }
  .portfolio-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .portfolio-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .portfolio-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<?php
  $args = array(
    'post_type'      => 'portfolio',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC'
  );

  $portfolio_query = new WP_Query($args);
?>

<section class="portfolio-list-section">
  <div class="portfolio-list-container">

    <div class="portfolio-list-header">
      <div class="portfolio-list-badge">
        <span class="portfolio-list-diamond">◆</span>
        <span class="portfolio-list-badge-text fade-left">Our Projects</span>
      </div>
      <h2 class="portfolio-list-main-title fade-right">Featured Work</h2>
      <p class="portfolio-list-subtitle fade-left">Explore our portfolio of successful projects and creative solutions.</p>
    </div>

    <div class="portfolio-grid">
      <?php if ( $portfolio_query->have_posts() ) :
        while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
          $full_img_url  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
          $thumb_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>

        <article class="portfolio-card">
          <?php if ( has_post_thumbnail() ) : ?>
            <button
              type="button"
              class="portfolio-card-img-btn portfolio-trigger"
              data-full-img="<?php echo esc_url( $full_img_url ); ?>"
              data-caption="<?php the_title_attribute(); ?>"
              aria-label="View project <?php the_title_attribute(); ?>"
            >
              <img
                src="<?php echo esc_url( $thumb_img_url ); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="portfolio-card-img fade-left"
              />
              <div class="portfolio-card-overlay"></div>
              <h3 class="portfolio-card-title"><?php the_title(); ?></h3>
            </button>
          <?php else : ?>
            <div class="portfolio-card-placeholder">
              <h3 class="portfolio-card-title"><?php the_title(); ?></h3>
            </div>
          <?php endif; ?>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-portfolio-found">No portfolio projects found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- Lightbox Modal -->
<div id="portfolio-lightbox" class="portfolio-lightbox" aria-hidden="true" role="dialog">
  <div class="portfolio-lightbox-overlay" id="portfolio-lightbox-overlay"></div>
  <div class="portfolio-lightbox-container">
    <button type="button" class="portfolio-lightbox-close" id="portfolio-lightbox-close" aria-label="Close">&times;</button>
    <img src="" alt="" id="portfolio-lightbox-img" class="portfolio-lightbox-img" />
    <p class="portfolio-lightbox-caption" id="portfolio-lightbox-caption"></p>
  </div>
</div>

<style>
/* Section Layout */
.portfolio-list-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.portfolio-list-container {
  width: 100%;
  margin: 0 auto;
}

/* Header Area */
.portfolio-list-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 56px;
}

.portfolio-list-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.portfolio-list-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.portfolio-list-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.portfolio-list-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.portfolio-list-subtitle {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

/* Portfolio Grid - image cards, no detail page, click to zoom */
.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.portfolio-card {
  border-radius: 20px;
  overflow: hidden;
}

.portfolio-card-img-btn {
  position: relative;
  display: flex;
  align-items: flex-end;
  width: 100%;
  height: 380px;
  padding: 28px 24px;
  border: none;
  background-color: #f4f4f4;
  overflow: hidden;
  cursor: pointer;
  box-sizing: border-box;
  border-radius: 20px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.portfolio-card-img-btn:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 32px rgba(0, 0, 0, 0.12);
}

.portfolio-card-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.portfolio-card-img-btn:hover .portfolio-card-img {
  transform: scale(1.06);
}

.portfolio-card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(0, 0, 0, 0.8) 0%,
    rgba(0, 0, 0, 0.15) 55%,
    rgba(0, 0, 0, 0) 100%
  );
}

.portfolio-card-title {
  position: relative;
  z-index: 1;
  color: #ffffff;
  font-size: 1.3rem;
  font-weight: 700;
  line-height: 1.25;
  text-align: left;
  margin: 0;
}

.portfolio-card-placeholder {
  width: 100%;
  height: 380px;
  border-radius: 20px;
  background-color: #e9ecef;
  display: flex;
  align-items: flex-end;
  padding: 28px 24px;
  box-sizing: border-box;
}

.portfolio-card-placeholder .portfolio-card-title {
  color: #555555;
}

.no-portfolio-found {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Lightbox */
.portfolio-lightbox {
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

.portfolio-lightbox.active {
  opacity: 1;
  visibility: visible;
}

.portfolio-lightbox-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.85);
  backdrop-filter: blur(5px);
}

.portfolio-lightbox-container {
  position: relative;
  z-index: 2;
  max-width: 90vw;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.portfolio-lightbox-img {
  max-width: 90vw;
  max-height: 80vh;
  object-fit: contain;
  border-radius: 12px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
  transform: scale(0.95);
  transition: transform 0.3s ease;
}

.portfolio-lightbox.active .portfolio-lightbox-img {
  transform: scale(1);
}

.portfolio-lightbox-caption {
  margin: 16px 0 0 0;
  color: #ffffff;
  font-size: 1.15rem;
  font-weight: 700;
  text-align: center;
}

.portfolio-lightbox-close {
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

.portfolio-lightbox-close:hover {
  color: #1ba3b0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .portfolio-list-section {
    padding: 0 40px;
  }
  .portfolio-list-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .portfolio-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }
  .portfolio-list-main-title {
    font-size: 2.1rem;
  }
}

@media (max-width: 640px) {
  .portfolio-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .portfolio-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .portfolio-list-main-title {
    font-size: 1.95rem;
  }

  .portfolio-card-img-btn,
  .portfolio-card-placeholder {
    height: 300px;
  }

  .portfolio-lightbox-close {
    top: -40px;
    right: 0;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const lightbox = document.getElementById('portfolio-lightbox');
  const lightboxImg = document.getElementById('portfolio-lightbox-img');
  const lightboxCaption = document.getElementById('portfolio-lightbox-caption');
  const closeBtn = document.getElementById('portfolio-lightbox-close');
  const overlay = document.getElementById('portfolio-lightbox-overlay');
  const triggers = document.querySelectorAll('.portfolio-trigger');

  function openLightbox(fullSrc, caption) {
    lightboxImg.src = fullSrc;
    lightboxImg.alt = caption || '';
    lightboxCaption.textContent = caption || '';
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