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
          $bg_img_url    = get_the_post_thumbnail_url( get_the_ID(), 'large' );
          $category      = get_field( 'service_category' );
          $excerpt       = get_the_excerpt();
        ?>

        <article class="portfolio-card" style="<?php echo $bg_img_url ? 'background-image:url(' . esc_url( $bg_img_url ) . ');' : ''; ?>">
          <details class="portfolio-card-panel">
            <summary class="portfolio-card-summary">
              <?php if ( ! empty( $category ) ) : ?>
                <span class="portfolio-card-category"><?php echo esc_html( $category ); ?></span>
              <?php endif; ?>
              <hr class="portfolio-card-divider" />
              <span class="portfolio-card-title-row">
                <span class="portfolio-card-name"><?php the_title(); ?></span>
                <span class="portfolio-card-toggle" aria-hidden="true">
                  <svg class="icon-plus" viewBox="0 0 448 512" fill="currentColor"><path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                  <svg class="icon-minus" viewBox="0 0 448 512" fill="currentColor"><path d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                </span>
              </span>
            </summary>
            <div class="portfolio-card-details">
              <?php if ( ! empty( $excerpt ) ) : ?>
                <p class="portfolio-card-excerpt"><?php echo esc_html( $excerpt ); ?></p>
              <?php endif; ?>
              <?php if ( $full_img_url ) : ?>
                <button
                  type="button"
                  class="portfolio-card-view-btn portfolio-trigger"
                  data-full-img="<?php echo esc_url( $full_img_url ); ?>"
                  data-caption="<?php the_title_attribute(); ?>"
                >
                  View Work
                </button>
              <?php endif; ?>
            </div>
          </details>
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

/* Portfolio Grid - uniform cards, 4 per row, click to zoom */
.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
}

.portfolio-card {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  height: 340px;
  border-radius: 18px;
  overflow: hidden;
  background-color: #e9ecef;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  transition: box-shadow 0.3s ease;
}

.portfolio-card:hover {
  box-shadow: 0 14px 32px rgba(0, 0, 0, 0.18);
}

.portfolio-card-panel {
  margin: 16px;
  background-color: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 12px;
  padding: 16px 18px;
}

.portfolio-card-summary {
  display: block;
  cursor: pointer;
  list-style: none;
}

.portfolio-card-summary::-webkit-details-marker {
  display: none;
}

.portfolio-card-category {
  display: block;
  font-size: 0.85rem;
  font-weight: 600;
  color: #1ba3b0;
}

.portfolio-card-divider {
  border: none;
  border-top: 1px solid #e2e8f0;
  margin: 10px 0;
}

.portfolio-card-title-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 10px;
}

.portfolio-card-name {
  font-size: 1.05rem;
  font-weight: 600;
  color: #0d0d0d;
  line-height: 1.25;
}

.portfolio-card-toggle {
  flex-shrink: 0;
  width: 15px;
  height: 15px;
  color: #1ba3b0;
}

.portfolio-card-toggle svg {
  width: 15px;
  height: 15px;
  display: block;
}

.portfolio-card-toggle .icon-minus {
  display: none;
}

.portfolio-card-panel[open] .portfolio-card-toggle .icon-plus {
  display: none;
}

.portfolio-card-panel[open] .portfolio-card-toggle .icon-minus {
  display: block;
}

.portfolio-card-details {
  padding-top: 10px;
}

.portfolio-card-excerpt {
  font-size: 0.92rem;
  line-height: 1.55;
  color: #667085;
  margin: 0 0 10px 0;
}

.portfolio-card-view-btn {
  display: inline-block;
  background: none;
  border: none;
  padding: 0;
  color: #1ba3b0;
  font-size: 0.9rem;
  font-weight: 600;
  text-decoration: underline;
  cursor: pointer;
}

.portfolio-card-view-btn:hover {
  color: #14838e;
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

@media (max-width: 1200px) {
  .portfolio-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

@media (max-width: 991px) {
  .portfolio-grid {
    grid-template-columns: repeat(2, 1fr);
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

  .portfolio-card {
    height: 300px;
  }

  .portfolio-list-main-title {
    font-size: 1.95rem;
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