<?php /* Template Name: servicespage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>

<!-- Services Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('services_banner'); ?>
<section class="services-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Services Page Banner" class="services-hero-bg-img" />
    <div class="services-hero-overlay"></div>
  <?php endif; ?>

  <div class="services-hero-container">
    <div class="services-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="services-hero-title fade-right"><?php echo $banner['title']; ?></h1>
      <?php endif; ?>
      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="services-hero-subtext fade-left"><?php echo $banner['content']; ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.services-hero-banner {
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

.services-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.services-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.services-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.services-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.services-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.services-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .services-hero-banner {
    min-height: 340px;
  }
  .services-hero-container {
    padding: 40px 24px;
  }
  .services-hero-title {
    font-size: 2.15rem;
  }
  .services-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .services-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .services-hero-title {
    font-size: 1.95rem;
  }
}
</style>


<?php
$services_query = new WP_Query( array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
) );
?>

<section class="services-list-section">
  <div class="services-list-container">

    <div class="services-list-header">
      <div class="services-list-badge">
        <span class="services-list-diamond">◆</span>
        <span class="services-list-badge-text fade-left">What We Offer</span>
      </div>
      <h2 class="services-list-main-title fade-right">Our Specialized Services</h2>
      <p class="services-list-subtitle fade-left">Explore our wide range of tailored solutions designed to meet your specific needs.</p>
    </div>

    <?php if ( ! $services_query->have_posts() ) : ?>
      <p class="no-services-found">No services found.</p>
    <?php else : ?>

    <div class="services-cards-grid">
      <?php while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="services-tab-item">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="services-tab-img" />
          <?php endif; ?>
          <div class="services-tab-overlay"></div>
          <h3 class="services-tab-title"><?php the_title(); ?></h3>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <?php endif; ?>

  </div>
</section>

<style>
/* Section Layout */
.services-list-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.services-list-container {
  width: 100%;
  margin: 0 auto;
}

/* Header Area */
.services-list-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 56px;
}

.services-list-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.services-list-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.services-list-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.services-list-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.services-list-subtitle {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

.no-services-found {
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Services Cards Grid */
.services-cards-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 36px;
}

.services-tab-item {
  position: relative;
  height: 520px;
  border-radius: 4px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: flex-end;
  justify-content: center;
  text-align: center;
  padding: 32px 16px;
  box-sizing: border-box;
  color: inherit;
  text-decoration: none;
  transition: transform 0.3s ease;
}

.services-tab-item:hover {
  transform: translateY(-4px);
  color: inherit;
  text-decoration: none;
}

.services-tab-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
  transition: transform 0.5s ease;
}

.services-tab-item:hover .services-tab-img {
  transform: scale(1.05);
}

.services-tab-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(0, 0, 0, 0.85) 0%,
    rgba(0, 0, 0, 0.25) 50%,
    rgba(0, 0, 0, 0) 100%
  );
  z-index: 1;
}

.services-tab-title {
  position: relative;
  z-index: 2;
  color: #ffffff;
  font-size: 1.35rem;
  font-weight: 700;
  line-height: 1.25;
  letter-spacing: -0.3px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .services-list-section {
    padding: 0 40px;
  }
  .services-list-main-title {
    font-size: 3rem;
  }
  .services-cards-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
  }
}

@media (max-width: 991px) {
  .services-list-main-title {
    font-size: 2.1rem;
  }
  .services-cards-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 24px;
  }
  .services-tab-item {
    height: 420px;
  }
}

@media (max-width: 640px) {
  .services-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .services-list-main-title {
    font-size: 1.95rem;
  }

  .services-cards-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .services-tab-item {
    height: 380px;
  }
}
</style>

 <?php get_footer(); ?>