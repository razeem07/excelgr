<?php /* Template Name: gallerypage
        Template Post Type: page,post */
?>

<?php get_header(); ?>

<!-- Gallery Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('gallery_banner'); ?>
<section class="gallery-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Gallery Page Banner" class="gallery-hero-bg-img" />
    <div class="gallery-hero-overlay"></div>
  <?php endif; ?>

  <div class="gallery-hero-container">
    <div class="gallery-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="gallery-hero-title fade-right"><?php echo esc_html( $banner['title'] ); ?></h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="gallery-hero-subtext fade-left"><?php echo esc_html( $banner['content'] ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.gallery-hero-banner {
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

.gallery-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.gallery-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.gallery-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.gallery-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.gallery-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.gallery-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .gallery-hero-banner {
    min-height: 340px;
  }
  .gallery-hero-container {
    padding: 40px 24px;
  }
  .gallery-hero-title {
    font-size: 2.15rem;
  }
  .gallery-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .gallery-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .gallery-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<?php
  $args = array(
    'post_type'      => 'gallery',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC'
  );

  $gallery_query = new WP_Query($args);
?>

<section class="gallery-list-section">
  <div class="gallery-list-container">

    <div class="gallery-list-header">
      <div class="gallery-list-badge">
        <span class="gallery-list-diamond">◆</span>
        <span class="gallery-list-badge-text fade-left">Visual Showcase</span>
      </div>
      <h2 class="gallery-list-main-title fade-right">Our Gallery</h2>
      <p class="gallery-list-subtitle fade-left">Explore photos, moments, and highlights from our work and events.</p>
    </div>

    <div class="gallery-grid">
      <?php if ( $gallery_query->have_posts() ) :
        while ( $gallery_query->have_posts() ) : $gallery_query->the_post(); 
          $full_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
          $thumb_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        ?>

        <article class="gallery-card">
          <?php if ( has_post_thumbnail() ) : ?>
            <button 
              type="button" 
              class="gallery-card-img-btn gallery-trigger" 
              data-full-img="<?php echo esc_url( $full_img_url ); ?>"
              data-caption="<?php the_title_attribute(); ?>"
              aria-label="Zoom image <?php the_title_attribute(); ?>"
            >
              <img 
                src="<?php echo esc_url( $thumb_img_url ); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="gallery-card-img fade-left" 
              />
              <div class="gallery-card-overlay">
                <span class="gallery-view-icon">🔍</span>
              </div>
            </button>
          <?php else : ?>
            <div class="gallery-card-placeholder"></div>
          <?php endif; ?>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-gallery-found">No gallery items found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<!-- Lightbox Modal -->
<div id="gallery-lightbox" class="gallery-lightbox" aria-hidden="true" role="dialog">
  <div class="gallery-lightbox-overlay" id="lightbox-overlay"></div>
  <div class="gallery-lightbox-container">
    <button type="button" class="gallery-lightbox-close" id="lightbox-close" aria-label="Close zoomed image">&times;</button>
    <img src="" alt="" id="lightbox-img" class="gallery-lightbox-img" />
  </div>
</div>

<style>
/* Section Layout */
.gallery-list-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.gallery-list-container {
  width: 100%;
  margin: 0 auto;
}

/* Header Area */
.gallery-list-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 56px;
}

.gallery-list-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.gallery-list-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.gallery-list-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.gallery-list-main-title {
  font-size: 3.5rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.gallery-list-subtitle {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

/* Gallery 3-Column Grid */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

/* Gallery Card Styling */
.gallery-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gallery-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
}

/* Image Button Trigger */
.gallery-card-img-btn {
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

.gallery-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.gallery-card:hover .gallery-card-img {
  transform: scale(1.06);
}

.gallery-card-placeholder {
  width: 100%;
  height: 320px;
  background-color: #e9ecef;
}

.gallery-card-overlay {
  position: absolute;
  inset: 0;
  background: rgba(13, 13, 13, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.gallery-card:hover .gallery-card-overlay {
  opacity: 1;
}

.gallery-view-icon {
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

.gallery-card:hover .gallery-view-icon {
  transform: scale(1);
}

.no-gallery-found {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Lightbox Modal Styles */
.gallery-lightbox {
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

.gallery-lightbox.active {
  opacity: 1;
  visibility: visible;
}

.gallery-lightbox-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.85);
  backdrop-filter: blur(5px);
}

.gallery-lightbox-container {
  position: relative;
  z-index: 2;
  max-width: 90vw;
  max-height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.gallery-lightbox-img {
  max-width: 90vw;
  max-height: 85vh;
  object-fit: contain;
  border-radius: 12px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.5);
  transform: scale(0.95);
  transition: transform 0.3s ease;
}

.gallery-lightbox.active .gallery-lightbox-img {
  transform: scale(1);
}

.gallery-lightbox-close {
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

.gallery-lightbox-close:hover {
  color: #1ba3b0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .gallery-list-section {
    padding: 0 40px;
  }
  .gallery-list-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
  .gallery-list-main-title {
    font-size: 2.6rem;
  }
  .gallery-card-img-btn,
  .gallery-card-placeholder {
    height: 280px;
  }
}

@media (max-width: 640px) {
  .gallery-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .gallery-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .gallery-list-main-title {
    font-size: 2.2rem;
  }

  .gallery-card-img-btn,
  .gallery-card-placeholder {
    height: 240px;
  }

  .gallery-lightbox-close {
    top: -40px;
    right: 0;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const lightbox = document.getElementById('gallery-lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const closeBtn = document.getElementById('lightbox-close');
  const overlay = document.getElementById('lightbox-overlay');
  const triggers = document.querySelectorAll('.gallery-trigger');

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