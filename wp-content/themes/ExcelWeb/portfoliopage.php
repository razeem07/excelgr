<?php /* Template Name: Portfolio Page
        Template Post Type: page, post */
?>

<?php get_header(); ?>

<!-- Portfolio Hero Banner Section -->
<section class="portfolio-hero-banner">
  <!-- Background Image -->
  <?php $banner = get_field('portfolio_banner'); ?>
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img 
      src="<?php echo esc_url( $banner['image'] ); ?>" 
      alt="Portfolio Page Banner" 
      class="portfolio-hero-bg-img"
    />
  <?php endif; ?>

  <!-- Dark Overlay -->
  <div class="portfolio-hero-overlay"></div>

  <!-- Content Container -->
  <div class="portfolio-hero-container">
    <div class="portfolio-hero-content">
      <?php if ( ! empty( $banner['subtitle'] ) ) : ?>
        <div class="portfolio-hero-badge">
          <span class="portfolio-hero-diamond">◆</span>
          <span class="portfolio-hero-badge-text fade-left"><?php echo esc_html( $banner['subtitle'] ); ?></span>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="portfolio-hero-title fade-right">
          <?php echo esc_html( $banner['title'] ); ?>
        </h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="portfolio-hero-subtext fade-left">
          <?php echo esc_html( $banner['content'] ); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
/* Portfolio Hero Container */
.portfolio-hero-banner {
  position: relative;
  width: calc(100% - 40px);
  max-width: 100%;
  min-height: 480px;
  margin: 20px auto 60px;
  border-radius: 36px;
  overflow: hidden;
  display: flex;
  align-items: flex-end;
  color: #ffffff;
  box-sizing: border-box;
}

/* Background Image */
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

/* Dark Gradient Overlay */
.portfolio-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(0, 0, 0, 0.35) 0%,
    rgba(0, 0, 0, 0.8) 100%
  );
  z-index: 1;
}

/* Inner Layout Wrapper */
.portfolio-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  box-sizing: border-box;
}

.portfolio-hero-content {
  max-width: 820px;
}

/* Diamond Badge */
.portfolio-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.portfolio-hero-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.portfolio-hero-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.5px;
}

/* Headings & Text */
.portfolio-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 20px;
  color: #ffffff;
}

.portfolio-hero-subtext {
  font-size: 1.05rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 680px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .portfolio-hero-container {
    padding: 50px 40px;
  }
  .portfolio-hero-title {
    font-size: 2.3rem;
  }
}

@media (max-width: 900px) {
  .portfolio-hero-banner {
    min-height: 400px;
  }
  .portfolio-hero-container {
    padding: 40px 30px;
  }
  .portfolio-hero-title {
    font-size: 2rem;
  }
  .portfolio-hero-subtext {
    font-size: 0.95rem;
  }
}

@media (max-width: 640px) {
  .portfolio-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .portfolio-hero-container {
    padding: 30px 20px;
  }
  .portfolio-hero-title {
    font-size: 1.8rem;
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
        while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post(); ?>

        <article class="portfolio-card">
          <a href="<?php the_permalink(); ?>" class="portfolio-card-img-link">
            <?php if ( has_post_thumbnail() ) : ?>
              <img 
                src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="portfolio-card-img fade-left" 
              />
            <?php else : ?>
              <div class="portfolio-card-placeholder"></div>
            <?php endif; ?>
          </a>

          <div class="portfolio-card-content">
            <h3 class="portfolio-card-title fade-left">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="portfolio-card-text fade-right">
              <?php echo wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 22, '...' ); ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="portfolio-card-btn">
              View Project <span class="btn-arrow">→</span>
            </a>
          </div>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-portfolio-found">No portfolio projects found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

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
  font-size: 2.4rem;
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

/* Portfolio 3-Column Grid */
.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

/* Portfolio Card Styling */
.portfolio-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.portfolio-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
}

/* Image Wrapper with Hover Zoom */
.portfolio-card-img-link {
  display: block;
  width: 100%;
  height: 250px;
  overflow: hidden;
  position: relative;
  background-color: #f4f4f4;
}

.portfolio-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.portfolio-card:hover .portfolio-card-img {
  transform: scale(1.05);
}

.portfolio-card-placeholder {
  width: 100%;
  height: 100%;
  background-color: #e9ecef;
}

/* Card Body Content */
.portfolio-card-content {
  padding: 32px 28px 36px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.portfolio-card-title {
  font-size: 1.6rem;
  font-weight: 800;
  line-height: 1.3;
  margin: 0 0 14px 0;
}

.portfolio-card-title a {
  color: #0d0d0d;
  text-decoration: none;
  transition: color 0.3s ease;
}

.portfolio-card-title a:hover {
  color: #1ba3b0;
}

.portfolio-card-text {
  font-size: 1.1rem;
  line-height: 1.65;
  color: #555555;
  margin-bottom: 24px;
  flex-grow: 1;
}

/* Action Button */
.portfolio-card-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 1.05rem;
  font-weight: 700;
  color: #1ba3b0;
  text-decoration: none;
  margin-top: auto;
  transition: gap 0.3s ease, color 0.3s ease;
}

.portfolio-card-btn .btn-arrow {
  transition: transform 0.3s ease;
}

.portfolio-card-btn:hover {
  color: #14838e;
}

.portfolio-card-btn:hover .btn-arrow {
  transform: translateX(5px);
}

.no-portfolio-found {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .portfolio-list-section {
    padding: 0 40px;
  }
  .portfolio-list-main-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 991px) {
  .portfolio-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
  .portfolio-list-main-title {
    font-size: 1.95rem;
  }
}

@media (max-width: 640px) {
  .portfolio-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .portfolio-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .portfolio-list-main-title {
    font-size: 1.8rem;
  }

  .portfolio-card-img-link {
    height: 210px;
  }

  .portfolio-card-content {
    padding: 24px 20px 28px;
  }
}
</style>

<?php get_footer(); ?>