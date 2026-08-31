 <?php get_header(); ?>


    
<!-- Section 1: Banner -->
   
<section class="blog-hero-banner">
  <img 
    src="<?php echo get_field('blog_banner')['banner_image']; ?>" 
    alt="Blog Page Banner" 
    class="blog-hero-bg-img"
  />

  <div class="blog-hero-overlay"></div>

  <div class="blog-hero-container">
    <div class="blog-hero-content">
      <div class="blog-hero-badge">
        <span class="blog-hero-diamond">◆</span>
        <span class="blog-hero-badge-text fade-left"><?php echo get_field('blog_banner')['subtitle']; ?></span>
      </div>
      <h1 class="blog-hero-title fade-right">
        <?php echo get_field('blog_banner')['title']; ?>
      </h1>
      <p class="blog-hero-subtext fade-left">
        <?php echo get_field('blog_banner')['content']; ?>
      </p>
    </div>
  </div>
</section>

<style>
/* Blog Hero Container */
.blog-hero-banner {
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
}

/* Background Image */
.blog-hero-bg-img {
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
.blog-hero-overlay {
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
.blog-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  box-sizing: border-box;
}

.blog-hero-content {
  max-width: 820px;
}

/* Diamond Badge */
.blog-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.blog-hero-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.blog-hero-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.5px;
}

/* Headings & Text */
.blog-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 20px;
}

.blog-hero-subtext {
  font-size: 1.05rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 680px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .blog-hero-container {
    padding: 50px 40px;
  }
  .blog-hero-title {
    font-size: 2.3rem;
  }
}

@media (max-width: 900px) {
  .blog-hero-banner {
    min-height: 400px;
  }
  .blog-hero-container {
    padding: 40px 30px;
  }
  .blog-hero-title {
    font-size: 2rem;
  }
  .blog-hero-subtext {
    font-size: 0.95rem;
  }
}

@media (max-width: 640px) {
  .blog-hero-container {
    padding: 30px 20px;
  }
  .blog-hero-title {
    font-size: 1.8rem;
  }
}
</style>




<?php
  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => -1, // Get all posts
    'orderby'        => 'date',
    'order'          => 'DESC' // Display latest posts first
  );

  $query = new WP_Query($args);
?>

<section class="blog-grid-section">
  <div class="blog-grid-container">

    <div class="blog-grid">
      <?php if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post(); ?>
        
        <article class="blog-grid-card">
          
          <a href="<?php the_permalink(); ?>" class="blog-card-image-link">
            <?php if ( has_post_thumbnail() ) : ?>
              <img 
                src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="blog-card-img fade-left" 
              />
            <?php else : ?>
              <div class="blog-card-img-placeholder"></div>
            <?php endif; ?>
          </a>

          <div class="blog-card-content">
            <div class="blog-card-meta">
              <span class="blog-card-date"><?php echo get_the_date('M d, Y'); ?></span>
            </div>

            <h3 class="blog-card-title fade-right">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <p class="blog-card-excerpt fade-left">
              <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
            </p>

            <a href="<?php the_permalink(); ?>" class="blog-card-btn">
              Read More 
              <span class="btn-arrow">→</span>
            </a>
          </div>

        </article>

      <?php endwhile; 
        wp_reset_postdata();
      else : ?>
        <p class="blog-no-posts">No blog posts found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<style>
/* Blog Grid Section Wrapper */
.blog-grid-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.blog-grid-container {
  width: 100%;
  margin: 0 auto;
}

/* 3-Column Grid Layout */
.blog-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

/* Blog Card Styling */
.blog-grid-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 24px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-grid-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
}

/* Card Image Link & Zoom Effect */
.blog-card-image-link {
  display: block;
  width: 100%;
  height: 240px;
  overflow: hidden;
  position: relative;
  background-color: #f4f4f4;
}

.blog-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.blog-grid-card:hover .blog-card-img {
  transform: scale(1.05);
}

.blog-card-img-placeholder {
  width: 100%;
  height: 100%;
  background-color: #e9ecef;
}

/* Card Content Area */
.blog-card-content {
  padding: 30px 24px 32px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.blog-card-meta {
  margin-bottom: 12px;
}

.blog-card-date {
  font-size: 0.95rem;
  font-weight: 600;
  color: #1ba3b0;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.blog-card-title {
  font-size: 1.45rem;
  font-weight: 700;
  line-height: 1.35;
  margin: 0 0 14px 0;
}

.blog-card-title a {
  color: #111111;
  text-decoration: none;
  transition: color 0.3s ease;
}

.blog-card-title a:hover {
  color: #1ba3b0;
}

.blog-card-excerpt {
  font-size: 1.05rem;
  line-height: 1.6;
  color: #555555;
  margin: 0 0 24px 0;
  flex-grow: 1;
}

/* Read More Link / Button */
.blog-card-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 1.05rem;
  font-weight: 700;
  color: #1ba3b0;
  text-decoration: none;
  transition: gap 0.3s ease, color 0.3s ease;
  margin-top: auto;
}

.blog-card-btn .btn-arrow {
  transition: transform 0.3s ease;
}

.blog-card-btn:hover {
  color: #14838e;
}

.blog-card-btn:hover .btn-arrow {
  transform: translateX(4px);
}

.blog-no-posts {
  grid-column: 1 / -1;
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Responsive Styling */
@media (max-width: 1200px) {
  .blog-grid-section {
    padding: 0 40px;
  }
}

@media (max-width: 991px) {
  .blog-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
  }
}

@media (max-width: 640px) {
  .blog-grid-section {
    padding: 0 20px;
  }
  
  .blog-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .blog-card-image-link {
    height: 210px;
  }
}
</style>
  



















  <?php get_footer(); ?>