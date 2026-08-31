<?php /* Template Name: servicespage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>

<!-- Services Hero Banner Section -->
<section class="services-hero-banner">
  <!-- Background Image -->
  <img 
    src="<?php echo get_field('services_banner')['image']; ?>" 
    alt="Services Page Banner" 
    class="services-hero-bg-img"
  />

  <!-- Dark Overlay -->
  <div class="services-hero-overlay"></div>

  <!-- Content Container -->
  <div class="services-hero-container">
    <div class="services-hero-content">
      <div class="services-hero-badge">
        <span class="services-hero-diamond">◆</span>
        <span class="services-hero-badge-text fade-left"><?php echo get_field('services_banner')['subtitle']; ?></span>
      </div>
      <h1 class="services-hero-title fade-right">
        <?php echo get_field('services_banner')['title']; ?>
      </h1>
      <p class="services-hero-subtext fade-left">
        <?php echo get_field('services_banner')['content']; ?>
      </p>
    </div>
  </div>
</section>

<style>
/* Services Hero Container */
.services-hero-banner {
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

/* Dark Gradient Overlay */
.services-hero-overlay {
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
.services-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  box-sizing: border-box;
}

.services-hero-content {
  max-width: 820px;
}

/* Diamond Badge */
.services-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.services-hero-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.services-hero-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.5px;
}

/* Headings & Text */
.services-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 20px;
  color: #ffffff;
}

.services-hero-subtext {
  font-size: 1.05rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 680px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .services-hero-container {
    padding: 50px 40px;
  }
  .services-hero-title {
    font-size: 2.3rem;
  }
}

@media (max-width: 900px) {
  .services-hero-banner {
    min-height: 400px;
  }
  .services-hero-container {
    padding: 40px 30px;
  }
  .services-hero-title {
    font-size: 2rem;
  }
  .services-hero-subtext {
    font-size: 0.95rem;
  }
}

@media (max-width: 640px) {
  .services-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .services-hero-container {
    padding: 30px 20px;
  }
  .services-hero-title {
    font-size: 1.8rem;
  }
}
</style>


<?php
  $args = array(
    'post_type'      => 'service', // Your CPT slug
    'posts_per_page' => -1,        // Fetch all services
    'orderby'        => 'menu_order title',
    'order'          => 'ASC'
  );

  $services_query = new WP_Query($args);
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

    <div class="services-grid">
      <?php if ( $services_query->have_posts() ) :
        while ( $services_query->have_posts() ) : $services_query->the_post(); ?>

        <article class="service-card">
          <a href="<?php the_permalink(); ?>" class="service-card-img-link">
            <?php if ( has_post_thumbnail() ) : ?>
              <img 
                src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="service-card-img fade-left" 
              />
            <?php else : ?>
              <div class="service-card-placeholder"></div>
            <?php endif; ?>
          </a>

          <div class="service-card-content">
            <h3 class="service-card-title fade-right">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="service-card-text fade-left">
              <?php echo wp_trim_words( get_the_excerpt() ? get_the_excerpt() : get_the_content(), 22, '...' ); ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="service-card-btn fade-right">
              Learn More <span class="btn-arrow">→</span>
            </a>
          </div>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-services-found">No services found.</p>
      <?php endif; ?>
    </div>

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
  font-size: 2.4rem;
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

/* Services 3-Column Grid */
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

/* Service Card Styling */
.service-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
}

/* Image Wrapper with Hover Zoom */
.service-card-img-link {
  display: block;
  width: 100%;
  height: 250px;
  overflow: hidden;
  position: relative;
  background-color: #f4f4f4;
}

.service-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.service-card:hover .service-card-img {
  transform: scale(1.05);
}

.service-card-placeholder {
  width: 100%;
  height: 100%;
  background-color: #e9ecef;
}

/* Card Body Content */
.service-card-content {
  padding: 32px 28px 36px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.service-card-title {
  font-size: 1.6rem;
  font-weight: 800;
  line-height: 1.3;
  margin: 0 0 14px 0;
}

.service-card-title a {
  color: #0d0d0d;
  text-decoration: none;
  transition: color 0.3s ease;
}

.service-card-title a:hover {
  color: #1ba3b0;
}

.service-card-text {
  font-size: 1.1rem;
  line-height: 1.65;
  color: #555555;
  margin-bottom: 24px;
  flex-grow: 1;
}

/* Action Button */
.service-card-btn {
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

.service-card-btn .btn-arrow {
  transition: transform 0.3s ease;
}

.service-card-btn:hover {
  color: #14838e;
}

.service-card-btn:hover .btn-arrow {
  transform: translateX(5px);
}

.no-services-found {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .services-list-section {
    padding: 0 40px;
  }
  .services-list-main-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 991px) {
  .services-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
  .services-list-main-title {
    font-size: 1.95rem;
  }
}

@media (max-width: 640px) {
  .services-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .services-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .services-list-main-title {
    font-size: 1.8rem;
  }

  .service-card-img-link {
    height: 210px;
  }

  .service-card-content {
    padding: 24px 20px 28px;
  }
}
</style>

 <?php get_footer(); ?>