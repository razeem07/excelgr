<?php
// Default fallback values
$banner_image = get_template_directory_uri() . '/assets/images/banner-inner.jpg';
$banner_title = 'Our Services';
$banner_desc  = 'Explore more with us';


if ( is_post_type_archive('portfolio') || is_singular('portfolio') || is_page('portfolio')  ) {
    $banner_title = get_theme_mod('portfolio_banner_title', 'Our Works');
    $banner_desc  = get_theme_mod('portfolio_banner_desc', 'Portfolio Details');
    $banner_image = get_theme_mod('portfolio_banner_image', get_template_directory_uri() . '/assets/images/destination-banner.jpg');
	$banner_subtitle = "Our Best Works";

}elseif ( is_home() || ( is_single() && get_post_type() === 'post' ) || is_page('blog') || ( get_option('page_for_posts') && is_page( get_option('page_for_posts') ) ) ) {
    $banner_title = get_theme_mod('blog_banner_title', 'Our Blog');
    $banner_desc  = get_theme_mod('blog_banner_desc', 'Latest Updates, Travel Tips & News');
    $banner_image = get_theme_mod('blog_banner_image', get_template_directory_uri() . '/assets/images/blog-banner.jpg');
	$banner_subtitle = "Blogs & Updates";
}
elseif ( is_post_type_archive('service') || is_singular('service') || is_page('services') ) {
    $banner_title = get_theme_mod('services_banner_title', 'Our Services');
    $banner_desc  = get_theme_mod('services_banner_desc', 'Discover Our Comprehensive Range of Solutions');
    $banner_image = get_theme_mod('services_banner_image', get_template_directory_uri() . '/assets/images/services-banner.jpg');
	$banner_subtitle = "What We Provide";
}
?>

<!-- Blog Archive Banner Section -->
<section class="blog-hero-banner">
  <!-- Background Image -->
  <img 
    src="<?php echo esc_url( $banner_image ); ?>" 
    alt="<?php echo esc_attr( $banner_title ); ?>" 
    class="blog-hero-bg-img"
  />

  <!-- Dark Overlay -->
  <div class="blog-hero-overlay"></div>

  <!-- Content Container -->
  <div class="blog-hero-container">
    <div class="blog-hero-content">
      <div class="blog-hero-badge">
        <span class="blog-hero-diamond">◆</span>
        <span class="blog-hero-badge-text fade-left"><?php echo esc_html( $banner_subtitle ); ?></span>
      </div>
      <h1 class="blog-hero-title fade-right">
        <?php echo esc_html( $banner_title ); ?>
      </h1>
      <p class="blog-hero-subtext fade-left">
        <?php echo esc_html( $banner_desc ); ?>
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
  box-sizing: border-box;
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
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin: 0 0 20px 0;
  color: #ffffff;
}

.blog-hero-subtext {
  font-size: 1.15rem;
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
    font-size: 3rem;
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
    font-size: 2.15rem;
  }
  .blog-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .blog-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .blog-hero-container {
    padding: 30px 20px;
  }
  .blog-hero-title {
    font-size: 1.95rem;
  }
}
</style>
