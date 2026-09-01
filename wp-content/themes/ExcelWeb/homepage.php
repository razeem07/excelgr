<?php /* Template Name: homepage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>
<?php
$banner_posts = get_posts([
    'post_type'      => 'banner',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$banners = array_map(function ($p) {
    return [
        'banner_image'         => get_the_post_thumbnail_url($p->ID, 'full'),
        'title'                => get_post_meta($p->ID, 'banner_content_headline', true),
        'content'              => get_post_meta($p->ID, 'banner_content_description', true),
        'title_2'              => get_post_meta($p->ID, 'banner_content_badge_title', true),
        'content_2'            => get_post_meta($p->ID, 'banner_content_badge_content', true),
        'view_project_button'  => get_post_meta($p->ID, 'banner_content_view_project_button', true),
        'reach_out_button'     => get_post_meta($p->ID, 'banner_content_reach_out_button', true),
    ];
}, $banner_posts);
?>

<section class="hero-banner-slider">
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">

      <?php foreach ($banners as $slide): ?>
        <?php if (!empty($slide)): ?>
          <div class="swiper-slide hero-slide">
            <!-- HTML Background Image -->
            <img 
              src="<?php echo esc_url($slide['banner_image']); ?>" 
              alt="<?php echo esc_attr($slide['title'] ?? 'Hero Background'); ?>" 
              class="hero-bg-img"
            />

            <!-- Dark overlay over background image -->
            <div class="hero-overlay"></div>

            <div class="hero-container">
              <!-- Left Section: Main Heading & Description -->
              <div class="hero-left">
                <h1 class="hero-title fade-left">
                  <?php echo $slide['title']; ?>
                </h1>
                <p class="hero-subtext fade-right">
                  <?php echo $slide['content']; ?>
                </p>
              </div>

              <!-- Right Section: Badge & Buttons -->
              <div class="hero-right">
                <?php if (!empty($slide['title_2'])): ?>
                  <div class="since-block">
                    <h2 class="since-title fade-left"><?php echo $slide['title_2']; ?></h2>
                    <p class="since-subtext fade-right"><?php echo $slide['content_2']; ?></p>
                  </div>
                <?php endif; ?>

                <div class="hero-actions">
                  <?php if (!empty($slide['view_project_button'])): ?>
                    <a href="<?php echo esc_url($slide['view_project_button']); ?>" class="btn btn-primary">View project</a>
                  <?php endif; ?>
                  <?php if (!empty($slide['reach_out_button'])): ?>
                    <a href="<?php echo esc_url($slide['reach_out_button']); ?>" class="btn btn-secondary">Reach Out</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

    </div>

    <!-- Navigation Controls -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</section>

<style>
/* Main Slider Outer Container */
.hero-banner-slider {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 20px auto 60px;
  border-radius: 36px;
  overflow: hidden;
  position: relative;
}

.hero-swiper {
  width: 100%;
  height: calc(100vh - 40px);
  min-height: 500px;
}

/* Individual Slide Styling */
.hero-slide {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: flex-end;
  color: #ffffff;
  overflow: hidden;
}

/* HTML Background Image Styling */
.hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

/* Overlay for text legibility */
.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(0, 0, 0, 0.3) 0%,
    rgba(0, 0, 0, 0.75) 100%
  );
  z-index: 1;
}

/* Layout Wrapper */
.hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 50px;
  box-sizing: border-box;
}

/* Left Column */
.hero-left {
  max-width: 780px;
}

.hero-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 24px;
}

.hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 600px;
}

/* Right Column */
.hero-right {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 36px;
  text-align: right;
}

.since-block {
  max-width: 340px;
}

.since-title {
  color: #1ba3b0;
  font-size: 2.2rem;
  font-weight: 800;
  letter-spacing: 0.5px;
  margin-bottom: 6px;
  text-transform: uppercase;
}

.since-subtext {
  font-size: 1.15rem;
  color: rgba(255, 255, 255, 0.95);
  line-height: 1.4;
}

/* Action Buttons */
.hero-actions {
  display: flex;
  gap: 20px;
}

.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 18px 36px;
  border-radius: 50px;
  font-size: 1.15rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.btn-primary {
  background-color: #1ba3b0;
  color: #ffffff;
}

.btn-primary:hover {
  background-color: #158590;
}

.btn-secondary {
  background-color: rgba(225, 225, 225, 0.85);
  color: #111111;
  backdrop-filter: blur(4px);
}

.btn-secondary:hover {
  background-color: #ffffff;
}

/* Swiper Custom Navigation Elements */
.hero-swiper .swiper-button-next,
.hero-swiper .swiper-button-prev {
  color: #ffffff;
  transition: opacity 0.3s ease;
}

.hero-swiper .swiper-pagination-bullet {
  background: #ffffff;
  opacity: 0.5;
}

.hero-swiper .swiper-pagination-bullet-active {
  background: #1ba3b0;
  opacity: 1;
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
  .hero-container {
    padding: 50px 40px;
  }

  .hero-title {
    font-size: 3rem;
  }
}

@media (max-width: 900px) {
  .hero-swiper {
    height: auto;
    min-height: 500px;
  }

  .hero-container {
    flex-direction: column;
    align-items: flex-start;
    padding: 60px 30px 80px;
  }

  .hero-title {
    font-size: 2.15rem;
  }

  .hero-subtext {
    font-size: 1.05rem;
  }

  .hero-right {
    align-items: flex-start;
    text-align: left;
    width: 100%;
  }

  .hero-actions {
    width: 100%;
    flex-wrap: wrap;
  }
}

@media (max-width: 640px) {
  .hero-banner-slider {
    border-radius: 24px;
    margin-bottom: 50px;
  }

  .hero-container {
    padding: 40px 20px 70px;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const heroSwiper = new Swiper('.hero-swiper', {
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
});
</script>

<section class="eg-about-section">
  <div class="eg-about-container">
    
    <!-- Left Column: Titles -->
    <div class="eg-about-left">
      <div class="eg-about-badge">
        <span class="eg-about-diamond">◆</span>
        <span class="eg-about-badge-text fade-left">Who we are</span>
      </div>
      <h2 class="eg-about-main-title  fade-right">
        <?php echo get_field('who_we_are')['title']; ?>
      </h2>
    </div>

    <!-- Right Column: Paragraph + 3 Features Grid -->
    <div class="eg-about-right">
      <p class="eg-about-description fade-left">
        <?php echo get_field('who_we_are')['content']; ?>
      </p>

      <div class="eg-about-features-grid">
        
        <!-- Feature 1: Creative -->
        <div class="eg-about-feature-item">
          <div class="eg-about-icon-wrapper">
            <!-- Lightbulb SVG -->
            <img src="<?php echo get_field('who_we_are')['card_1']['icon']; ?>" alt="Bulb Icon" height="74" width="74">

          </div>
          <h3 class="eg-about-feature-title fade-right">Creative</h3>
          <p class="eg-about-feature-desc fade-left">
            <?php echo get_field('who_we_are')['card_1']['content']; ?>
          </p>
        </div>

        <!-- Feature 2: Passionate -->
        <div class="eg-about-feature-item">
          <div class="eg-about-icon-wrapper">
            <!-- Fist / Strength SVG -->
            <img src="<?php echo get_field('who_we_are')['card_2']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
          </div>
          <h3 class="eg-about-feature-title  fade-left">Passionate</h3>
          <p class="eg-about-feature-desc fade-right">
            <?php echo get_field('who_we_are')['card_2']['content']; ?>
          </p>
        </div>

        <!-- Feature 3: Quality -->
        <div class="eg-about-feature-item">
          <div class="eg-about-icon-wrapper">
            <!-- Thumbs Up / Quality SVG -->
            <img src="<?php echo get_field('who_we_are')['card_3']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
          </div>
          <h3 class="eg-about-feature-title fade-left">Quality</h3>
          <p class="eg-about-feature-desc fade-right">
            <?php echo get_field('who_we_are')['card_3']['content']; ?>
          </p>
        </div>

      </div>
    </div>

  </div>
</section>

<style>
/* Updated Section Wrapper - Aligned Side Margins & Padding */
.eg-about-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px; /* Matched 80px side padding from carousel */
  color: #111111;
  box-sizing: border-box;
}

/* Updated Container Layout */
.eg-about-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 90px; /* Spacing between left & right columns */
  width: 100%;
  margin: 0 auto;
}

/* Left Column */
.eg-about-left {
  flex: 1.1;
  max-width: 650px;
}

.eg-about-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 28px;
}

.eg-about-diamond {
  color: #1ba3b0;
  font-size: 1.25rem;
  line-height: 1;
}

.eg-about-badge-text {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111111;
}

.eg-about-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #0d0d0d;
}

/* Right Column */
.eg-about-right {
  flex: 1.3;
}

.eg-about-description {
  font-size: 1.15rem;
  line-height: 1.6;
  color: #222222;
  margin-bottom: 56px;
  max-width: 100%;
}

/* Features Grid */
.eg-about-features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

.eg-about-feature-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

/* Teal Icons */
.eg-about-icon-wrapper {
  width: 68px;
  height: 68px;
  color: #1ba3b0;
  margin-bottom: 18px;
}

.eg-about-icon-wrapper svg {
  width: 100%;
  height: 100%;
}

.eg-about-feature-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1ba3b0;
  margin-bottom: 12px;
}

.eg-about-feature-desc {
  font-size: 1.15rem;
  line-height: 1.5;
  color: #444444;
}

/* Responsive Adjustments */
@media (max-width: 1400px) {
  .eg-about-section {
    padding: 20px 40px; /* Reduced side padding on tablet screens */
  }
  
  .eg-about-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .eg-about-container {
    flex-direction: column;
    gap: 40px;
  }

  .eg-about-left {
    max-width: 100%;
  }

  .eg-about-main-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 640px) {
  .eg-about-section {
    padding: 20px 20px; /* Mobile side padding */
  }

  .eg-about-features-grid {
    grid-template-columns: 1fr;
    gap: 40px;
  }
}
</style>



<?php
$home_services = get_posts([
    'post_type'      => 'service',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
?>

<section class="eg-services-section">
  <!-- Header Block -->
  <div class="eg-services-header">
    <div class="eg-services-badge">
      <span class="eg-services-diamond">◆</span>
      <span class="eg-services-badge-text  fade-left">What we do</span>
    </div>
    <h2 class="eg-services-main-title fade-right">
      Innovative ideas and bold execution<br />that drive measurable growth
    </h2>
  </div>

  <!-- Carousel Wrapper -->
  <div class="eg-services-carousel-wrapper">
    <!-- Carousel Track -->
    <div class="eg-services-carousel-track" id="egServicesTrack">

      <?php foreach ($home_services as $service): ?>
        <a href="<?php echo esc_url(get_permalink($service->ID)); ?>" class="eg-services-card">
          <?php if (has_post_thumbnail($service->ID)): ?>
            <img
              src="<?php echo esc_url(get_the_post_thumbnail_url($service->ID, 'large')); ?>"
              alt="<?php echo esc_attr(get_the_title($service->ID)); ?>"
              class="eg-services-card-img fade-up"
            />
          <?php endif; ?>
          <div class="eg-services-card-overlay"></div>
          <h3 class="eg-services-card-title fade-left"><?php echo esc_html(get_the_title($service->ID)); ?></h3>
        </a>
      <?php endforeach; ?>

    </div>

    <!-- Carousel Arrow Button -->
    <button
      class="eg-services-arrow-btn"
      aria-label="Next slide"
      onclick="egScrollCarousel()"
    >
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
    </button>
  </div>

  <!-- Bottom CTA -->
  <div class="eg-services-footer">
    <a href="<?php echo esc_url(home_url('/services/')); ?>" class="eg-services-btn-outline">View all</a>
  </div>
</section>

<script>
function egScrollCarousel() {
  const track = document.getElementById('egServicesTrack');
  const maxScroll = track.scrollWidth - track.clientWidth;

  // Check if we reached or are near the end (10px tolerance for decimal precision)
  if (track.scrollLeft >= maxScroll - 10) {
    track.scrollTo({ left: 0, behavior: 'smooth' });
  } else {
    // Scroll dynamic width based on card size and layout gaps
    const card = track.querySelector('.eg-services-card');
    const scrollAmount = card ? card.offsetWidth + 45 : 260;
    track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
  }
}
</script>

<style>
/* Section Wrapper - Generous side margins & padding */
.eg-services-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px; /* High side padding pushes carousel inward */
  box-sizing: border-box;
  color: #111111;
}

/* Header Styling */
.eg-services-header {
  text-align: center;
  margin-bottom: 50px;
}

.eg-services-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 16px;
}

.eg-services-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.eg-services-badge-text {
  font-size: 1.25rem;
  font-weight: 700;
  color: #111111;
}

.eg-services-main-title {
  font-size: 3.6rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1px;
  color: #0d0d0d;
  margin: 0 auto;
}

/* Carousel Outer Wrapper */
.eg-services-carousel-wrapper {
  position: relative;
  width: 100%;
  margin-bottom: 50px;
}

/* Scrollable Track */
.eg-services-carousel-track {
  display: flex;
  gap: 45px; /* Large, noticeable gaps between cards */
  overflow-x: auto;
  scroll-behavior: smooth;
  scroll-snap-type: x mandatory;
  padding: 10px 0;
  /* Hide Scrollbars */
  -ms-overflow-style: none;
  scrollbar-width: none;
}

.eg-services-carousel-track::-webkit-scrollbar {
  display: none;
}

/* Individual Card (Slim & Narrow) */
.eg-services-card {
  position: relative;
  /* Formula: (100% width - 3 gaps of 45px [135px]) / 4 cards */
  flex: 0 0 calc((100% - 135px) / 4);
  height: 520px; /* Sleek vertical portrait height */
  border-radius: 4px;
  overflow: hidden;
  scroll-snap-align: start;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  display: flex;
  align-items: flex-end;
  justify-content: center;
  text-align: center;
  padding: 32px 16px;
  box-sizing: border-box;
  color: inherit;
  text-decoration: none;
}

.eg-services-card:hover {
  color: inherit;
  text-decoration: none;
}

.eg-services-card-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
  transition: transform 0.5s ease;
}

.eg-services-card:hover .eg-services-card-img {
  transform: scale(1.05);
}

/* Card Dark Overlay */
.eg-services-card-overlay {
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

/* Card Title */
.eg-services-card-title {
  position: relative;
  z-index: 2;
  color: #ffffff;
  font-size: 1.35rem;
  font-weight: 700;
  line-height: 1.25;
  letter-spacing: -0.3px;
  margin: 0;
}

/* Arrow Button Floating Right */
.eg-services-arrow-btn {
  position: absolute;
  top: 50%;
  right: -26px;
  transform: translateY(-50%);
  z-index: 10;
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background-color: #ffffff;
  border: 1px solid #e0e0e0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #111111;
  transition: all 0.3s ease;
}

.eg-services-arrow-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
  border-color: #1ba3b0;
  transform: translateY(-50%) scale(1.05);
}

.eg-services-arrow-btn svg {
  width: 20px;
  height: 20px;
}

/* Bottom View All Button */
.eg-services-footer {
  text-align: center;
}

.eg-services-btn-outline {
  display: inline-block;
  padding: 12px 42px;
  border: 1.5px solid #1ba3b0;
  color: #111111;
  background-color: transparent;
  font-size: 1.1rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.eg-services-btn-outline:hover {
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Responsive Rules */
@media (max-width: 1200px) {
  .eg-services-section {
    padding: 20px 40px;
  }
  .eg-services-carousel-track {
    gap: 30px;
  }
  .eg-services-card {
    flex: 0 0 calc((100% - 60px) / 3); /* 3 cards on smaller screens */
    height: 480px;
  }
}

@media (max-width: 768px) {
  .eg-services-section {
    padding: 20px 20px;
  }
  .eg-services-carousel-track {
    gap: 20px;
  }
  .eg-services-card {
    flex: 0 0 calc((100% - 20px) / 2); /* 2 cards on tablet */
    height: 420px;
  }
}

@media (max-width: 550px) {
  .eg-services-card {
    flex: 0 0 82%; /* Mobile view */
    height: 400px;
  }
  .eg-services-arrow-btn {
    right: -10px;
  }
}
</style>


<section class="eg-features-section">
  <div class="eg-features-container">
    
    <!-- Top Row: Left Main Title & Right Description -->
    <div class="eg-features-top">
      <div class="eg-features-left">
        <div class="eg-features-badge">
          <span class="eg-features-diamond">◆</span>
          <span class="eg-features-badge-text fade-left">Who we are</span>
        </div>
        <h2 class="eg-features-main-title fade-right">
          <?php echo get_field('who_we_are_2')['title']; ?>
        </h2>
      </div>

      <div class="eg-features-right">
        <p class="eg-features-description fade-left">
          <?php echo get_field('who_we_are_2')['content']; ?>
        </p>
      </div>
    </div>

    <!-- Bottom Row: 5 Cards Grid -->
    <div class="eg-features-grid">
      
      <!-- Feature Card 1 -->
      <div class="eg-features-card">
        <div class="eg-features-icon-wrapper">
           <img src="<?php echo get_field('who_we_are_2')['card_1']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
        </div>
        <h3 class="eg-features-card-title fade-left"><?php echo get_field('who_we_are_2')['card_1']['title']; ?></h3>
      </div>

      <!-- Feature Card 2 -->
      <div class="eg-features-card">
        <div class="eg-features-icon-wrapper">
          <img src="<?php echo get_field('who_we_are_2')['card_2']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
        </div>
        <h3 class="eg-features-card-title fade-right"><?php echo get_field('who_we_are_2')['card_2']['title']; ?></h3>
      </div>

      <!-- Feature Card 3 -->
      <div class="eg-features-card">
        <div class="eg-features-icon-wrapper">
          <img src="<?php echo get_field('who_we_are_2')['card_3']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
        </div>
        <h3 class="eg-features-card-title fade-left"><?php echo get_field('who_we_are_2')['card_3']['title']; ?></h3>
      </div>

      <!-- Feature Card 4 -->
      <div class="eg-features-card">
        <div class="eg-features-icon-wrapper">
          <img src="<?php echo get_field('who_we_are_2')['card_4']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
        </div>
        <h3 class="eg-features-card-title fade-right"><?php echo get_field('who_we_are_2')['card_4']['title']; ?></h3>
      </div>

      <!-- Feature Card 5 -->
      <div class="eg-features-card">
        <div class="eg-features-icon-wrapper">
          <img src="<?php echo get_field('who_we_are_2')['card_5']['icon']; ?>" alt="Bulb Icon" height="74" width="74">
        </div>
        <h3 class="eg-features-card-title fade-left"><?php echo get_field('who_we_are_2')['card_5']['title']; ?></h3>
      </div>

    </div>

  </div>
</section>

<style>
/* Main Section Wrapper - 80px Side Padding Matched */
.eg-features-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px; /* Aligned with Hero, About, and Carousel sections */
  box-sizing: border-box;
  color: #111111;
}

.eg-features-container {
  width: 100%;
  margin: 0 auto;
}

/* Top Section: Split 2 Columns */
.eg-features-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 48px;
  margin-bottom: 60px;
}

/* Left Column */
.eg-features-left {
  flex: 1.1;
  max-width: 600px;
}

.eg-features-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
}

.eg-features-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.eg-features-badge-text {
  font-size: 1.2rem;
  font-weight: 700;
  color: #111111;
}

.eg-features-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0;
}

/* Right Column Paragraph */
.eg-features-right {
  flex: 1.2;
  padding-top: 20px; /* Aligns paragraph vertically with title */
}

.eg-features-description {
  font-size: 1.15rem;
  line-height: 1.65;
  color: #333333;
  margin: 0;
}

/* Bottom Grid: 5 Feature Cards */
.eg-features-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 24px;
}

/* Card Styling */
.eg-features-card {
  background-color: #ffffff;
  border-radius: 6px;
  padding: 40px 16px 36px 16px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.eg-features-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
}

/* Teal SVGs */
.eg-features-icon-wrapper {
  width: 68px;
  height: 68px;
  color: #1ba3b0;
  margin-bottom: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.eg-features-icon-wrapper svg {
  width: 100%;
  height: 100%;
}

.eg-features-card-title {
  font-size: 1.35rem;
  font-weight: 800;
  color: #0d0d0d;
  line-height: 1.25;
  letter-spacing: -0.3px;
  margin: 0;
}

/* Responsive Rules */
@media (max-width: 1300px) {
  .eg-features-section {
    padding: 20px 40px;
  }
  .eg-features-main-title {
    font-size: 3rem;
  }
  .eg-features-grid {
    gap: 16px;
  }
  .eg-features-card {
    padding: 32px 12px 28px 12px;
  }
  .eg-features-card-title {
    font-size: 1.2rem;
  }
}

@media (max-width: 992px) {
  .eg-features-top {
    flex-direction: column;
    gap: 30px;
  }
  .eg-features-right {
    padding-top: 0;
  }
  .eg-features-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
  }
}

@media (max-width: 640px) {
  .eg-features-section {
    padding: 20px 20px;
  }
  .eg-features-main-title {
    font-size: 2.05rem;
  }
  .eg-features-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 480px) {
  .eg-features-grid {
    grid-template-columns: 1fr;
  }
}
</style>


<section class="eg-scale-section">
  <div class="eg-scale-container">
    
    <!-- Left Column: Image -->
    <div class="eg-scale-image-col">
      <img src="<?php echo get_field('scale')['image']; ?>" alt="Excel Graphics 3D Building" class="eg-scale-image fade-up" />
    </div>

    <!-- Right Column: Content & Stats -->
    <div class="eg-scale-content-col">
      
      <!-- Top Badge -->
      <div class="eg-scale-badge">
        <span class="eg-scale-diamond">◆</span>
        <span class="eg-scale-badge-text">Scale</span>
      </div>

      <!-- Section Title -->
      <h2 class="eg-scale-main-title fade-left">
        <?php echo get_field('scale')['title']; ?>
      </h2>

      <!-- Description Paragraph -->
      <p class="eg-scale-description fade-right">
        <?php echo get_field('scale')['content']; ?>
      </p>

      <!-- Stats Block -->
      <div class="eg-scale-stats-block">
        
        <!-- Large Stat 1 -->
        <div class="eg-scale-row-large">
          <span class="eg-scale-num-teal fade-left"><?php echo get_field('scale')['exp']; ?></span>
          <span class="eg-scale-text-bold fade-right">
            Years of<br />Experience
          </span>
        </div>

        <!-- Large Stat 2 -->
        <div class="eg-scale-row-large">
          <span class="eg-scale-num-teal fade-left"><?php echo get_field('scale')['customers']; ?></span>
          <span class="eg-scale-text-bold fade-right">
            Satisfied<br />Customers
          </span>
        </div>

        <!-- Small Stats Grid (Bottom Row) -->
        <div class="eg-scale-row-small">
          <div class="eg-scale-sub-item">
            <span class="eg-scale-num-dark fade-left"><?php echo get_field('scale')['percentage']; ?></span>
            <span class="eg-scale-text-sub fade-right">Customer retention</span>
          </div>

          <div class="eg-scale-sub-item">
            <span class="eg-scale-num-dark fade-left"><?php echo get_field('scale')['employees']; ?></span>
            <span class="eg-scale-text-sub fade-right">Employees</span>
          </div>
        </div>

      </div>

    </div>

  </div>
</section>

<style>
/* Outer Section Wrapper - Match paddings with top sections */
.eg-scale-section {
  width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px;
  box-sizing: border-box;
  color: #111111;
}

/* Fixed Inner Container: Prevents elements from spreading apart on wide screens */
.eg-scale-container {
  max-width: 1140px; /* Crucial: Locks content in a compact central grid */
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 50px;
}

/* Left Image Column */
.eg-scale-image-col {
  flex: 0 0 46%;
  max-width: 500px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.eg-scale-image {
  width: 100%;
  height: auto;
  object-fit: contain;
  display: block;
}

/* Right Content Column */
.eg-scale-content-col {
  flex: 0 0 50%;
  max-width: 540px;
}

/* Badge Styling */
.eg-scale-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.eg-scale-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.eg-scale-badge-text {
  font-size: 1.1rem;
  font-weight: 700;
  color: #111111;
}

/* Title Styling */
.eg-scale-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 20px 0;
}

/* Sub-description */
.eg-scale-description {
  font-size: 1.05rem;
  line-height: 1.45;
  color: #444444;
  margin: 0 0 36px 0;
}

/* Stats Layout */
.eg-scale-stats-block {
  display: flex;
  flex-direction: column;
  gap: 26px;
}

/* Large Stats Rows */
.eg-scale-row-large {
  display: flex;
  align-items: center;
  gap: 24px;
}

.eg-scale-num-teal {
  font-size: 3.6rem;
  font-weight: 800;
  color: #1ba3b0;
  line-height: 1;
  letter-spacing: -1.5px;
  min-width: 145px;
}

.eg-scale-text-bold {
  font-size: 1.15rem;
  font-weight: 800;
  line-height: 1.25;
  color: #111111;
}

/* Bottom Small Stats Side-by-side */
.eg-scale-row-small {
  display: flex;
  align-items: flex-start;
  gap: 60px;
  margin-top: 6px;
}

.eg-scale-sub-item {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.eg-scale-num-dark {
  font-size: 3.1rem;
  font-weight: 800;
  color: #0d0d0d;
  line-height: 1;
  letter-spacing: -1.5px;
  margin-bottom: 6px;
}

.eg-scale-text-sub {
  font-size: 1rem;
  font-weight: 500;
  color: #444444;
}

/* Responsive Handling */
@media (max-width: 1200px) {
  .eg-scale-section {
    padding: 20px 40px;
  }
  .eg-scale-main-title {
    font-size: 3rem;
  }
  .eg-scale-num-teal {
    font-size: 3rem;
    min-width: 120px;
  }
}

@media (max-width: 992px) {
  .eg-scale-container {
    flex-direction: column;
    gap: 40px;
  }
  .eg-scale-image-col,
  .eg-scale-content-col {
    max-width: 100%;
    flex: 1 1 100%;
  }
}

@media (max-width: 640px) {
  .eg-scale-section {
    padding: 20px 20px;
  }
  .eg-scale-main-title {
    font-size: 1.95rem;
  }
  .eg-scale-num-teal {
    font-size: 2.5rem;
    min-width: 100px;
  }
  .eg-scale-row-small {
    gap: 30px;
  }
}
</style>



<section class="eg-work-section">
  <div class="eg-work-container">
    
    <!-- Centered Header Block -->
    <div class="eg-work-header">
      <div class="eg-work-badge">
        <span class="eg-work-diamond">◆</span>
        <span class="eg-work-badge-text fade-left">Selected work</span>
      </div>

      <h2 class="eg-work-title fade-right">
        <?php echo get_field('selected_work')['title']; ?>
      </h2>
    </div>

    <!-- Sticky Cards Container -->
    <div class="eg-work-cards-wrapper">

      <!-- Card 1 (Dynamic ACF Image) -->
      <div class="eg-work-card eg-card-1">
        <div class="eg-work-card-inner">
          <img 
            src="<?php echo get_field('selected_work')['image']; ?>" 
            alt="<?php echo get_field('selected_work')['title']; ?>" 
            class="eg-work-image" 
          />
          <div class="eg-work-meta-overlay">
            <div class="eg-work-meta-left fade-left">
              <span class="eg-meta-label">YEAR</span>
              <span class="eg-meta-value">2026</span>
            </div>
            <div class="eg-work-pill-btn">
              <img src="<?php echo get_field('selected_work')['image']; ?>" class="eg-pill-avatar" alt="" />
              <span class="eg-pill-title fade-left"><?php echo get_field('selected_work')['title']; ?></span>
              <span class="eg-pill-action fade-right">SEE WORK</span>
            </div>
            <div class="eg-work-meta-right">
              <span class="eg-meta-label fade-left">Excel Graphics</span>
              <span class="eg-meta-value fade-right">Design</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 (Placeholder) -->
      <div class="eg-work-card eg-card-2">
        <div class="eg-work-card-inner">
          <img src="<?php echo get_field('selected_work')['image_2']; ?>" alt="Victoria Project" class="eg-work-image" />
          <div class="eg-work-meta-overlay">
            <div class="eg-work-meta-left fade-left">
              <span class="eg-meta-label">YEAR</span>
              <span class="eg-meta-value">2025</span>
            </div>
            <div class="eg-work-pill-btn">
              <img src="<?php echo get_field('selected_work')['image_2']; ?>" class="eg-pill-avatar" alt="" />
              <span class="eg-pill-title fade-right"><?php echo get_field('selected_work')['title']; ?></span>
              <span class="eg-pill-action fade-left">SEE WORK</span>
            </div>
            <div class="eg-work-meta-right">
              <span class="eg-meta-label fade-left">Excel Graphics</span>
              <span class="eg-meta-value fade-right">Design</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 (Placeholder) -->
      <div class="eg-work-card eg-card-3">
        <div class="eg-work-card-inner">
          <img src="<?php echo get_field('selected_work')['image_3']; ?>" alt="Nuvik Project" class="eg-work-image" />
          <div class="eg-work-meta-overlay">
            <div class="eg-work-meta-left fade-left">
              <span class="eg-meta-label">YEAR</span>
              <span class="eg-meta-value">2024</span>
            </div>
            <div class="eg-work-pill-btn">
              <img src="<?php echo get_field('selected_work')['image_3']; ?>" class="eg-pill-avatar" alt="" />
              <span class="eg-pill-title fade-right"><?php echo get_field('selected_work')['title']; ?></span>
              <span class="eg-pill-action fade-left">SEE WORK</span>
            </div>
            <div class="eg-work-meta-right">
              <span class="eg-meta-label fade-left">Excel Graphics</span>
              <span class="eg-meta-value fade-right">Design</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4 (Placeholder) -->
      <div class="eg-work-card eg-card-4">
        <div class="eg-work-card-inner">
          <img src="<?php echo get_field('selected_work')['image_4']; ?>" alt="Auria Project" class="eg-work-image" />
          <div class="eg-work-meta-overlay">
            <div class="eg-work-meta-left fade-left">
              <span class="eg-meta-label">YEAR</span>
              <span class="eg-meta-value">2024</span>
            </div>
            <div class="eg-work-pill-btn">
              <img src="<?php echo get_field('selected_work')['image_4']; ?>" class="eg-pill-avatar" alt="" />
              <span class="eg-pill-title fade-right"><?php echo get_field('selected_work')['title']; ?></span>
              <span class="eg-pill-action fade-left">SEE WORK</span>
            </div>
            <div class="eg-work-meta-right">
              <span class="eg-meta-label fade-left">Excel Graphics</span>
              <span class="eg-meta-value fade-right">Design</span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
<style>
.eg-work-section {
  width: 100%;
/*   margin: 60px auto; */
  padding: 0 40px;
  box-sizing: border-box;
  color: #111111;
}

.eg-work-container {
/*   max-width: 1300px; */
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.eg-work-header {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 40px;
}

.eg-work-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.eg-work-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
}

.eg-work-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.eg-work-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0;
}

/* Stacking & Sticky setup */
.eg-work-cards-wrapper {
  position: relative;
  width: 100%;
  display: flex;
  flex-direction: column;
  gap: 8vh;
/*   padding-bottom: 10vh; */
}

.eg-work-card {
  position: sticky;
  top: 12vh;
  width: 100%;
  height: 75vh;
  transform-origin: center top;
  will-change: transform, filter, opacity;
}

.eg-work-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  border-top-left-radius: 32px;
  border-top-right-radius: 32px;	
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
  background-color: #000;
}

.eg-work-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Overlays matching the video UI */
.eg-work-meta-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 30px 40px;
  box-sizing: border-box;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  pointer-events: none;
}

.eg-work-meta-left, .eg-work-meta-right {
  display: flex;
  flex-direction: column;
  gap: 4px;
  color: #fff;
  text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

.eg-meta-label {
  font-size: 0.75rem;
  letter-spacing: 1px;
  opacity: 0.8;
}

.eg-meta-value {
  font-size: 1.1rem;
  font-weight: 700;
}

.eg-work-pill-btn {
  pointer-events: auto;
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: rgba(255, 255, 255, 0.25);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  padding: 8px 20px 8px 10px;
  border-radius: 100px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.eg-pill-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  object-fit: cover;
}

.eg-pill-title {
  color: #fff;
  font-weight: 700;
  font-size: 0.95rem;
}

.eg-pill-action {
  color: rgba(255, 255, 255, 0.8);
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.5px;
  margin-left: 6px;
}

/* Responsive Styles */
@media (max-width: 768px) {
  .eg-work-section { padding: 0 20px; }
  .eg-work-title { font-size: 1.95rem; }
  .eg-work-card { height: 60vh; top: 15vh; }
  .eg-work-meta-overlay { padding: 20px; }
  .eg-work-meta-left, .eg-work-meta-right { display: none; }
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    const cards = gsap.utils.toArray(".eg-work-card");

    cards.forEach((card, index) => {
      // Skip scaling for the last card
      if (index === cards.length - 1) return;

      gsap.to(card, {
        scale: 0.88,
        filter: "brightness(0.6)",
        ease: "none",
        scrollTrigger: {
          trigger: cards[index + 1],
          start: "top 80%",
          end: "top 15%",
          scrub: true,
        }
      });
    });
  });
</script>


<?php
// Query ACF Testimonial CPT
$testimonials_query = new WP_Query(array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
));

if ($testimonials_query->have_posts()) :
?>

<section class="eg-reviews-section">
  <div class="eg-reviews-container">
    
    <!-- Header Block -->
    <div class="eg-reviews-header">
      <div class="eg-reviews-badge">
        <span class="eg-reviews-diamond">◆</span>
        <span class="eg-reviews-badge-text fade-left">what they think of us</span>
      </div>

      <h2 class="eg-reviews-title fade-left">
        We don’t just finish projects;<br />
        we build success together
      </h2>
    </div>

    <!-- Carousel Controls & Viewport -->
    <div class="eg-reviews-carousel-wrapper">
      
      <div class="eg-reviews-grid-viewport" id="egReviewsViewport">
        <div class="eg-reviews-grid" id="egReviewsGrid">
          
          <?php 
          while ($testimonials_query->have_posts()) : $testimonials_query->the_post(); 
            // ACF Designation field
            $designation = get_field('designation');
            // Featured image / Avatar
            $avatar_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            if (!$avatar_url) {
                $avatar_url = 'https://via.placeholder.com/64'; // Fallback image if no featured image set
            }
          ?>
            <!-- Card -->
            <div class="eg-reviews-card">
              <!-- 5 Orange Stars -->
              <div class="eg-reviews-stars">
                ★★★★★
              </div>

              <div class="eg-reviews-quote">
                <?php the_content(); ?>
              </div>

              <div class="eg-reviews-author">
                <div class="eg-reviews-author-info">
                  <h4 class="eg-reviews-name fade-right"><?php the_title(); ?></h4>
                  <?php if ($designation) : ?>
                    <span class="eg-reviews-role fade-left"><?php echo esc_html($designation); ?></span>
                  <?php endif; ?>
                </div>
                <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="eg-reviews-avatar fade-left" />
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>

        </div>
      </div>

      <!-- Arrow Navigation -->
      <div class="eg-reviews-controls">
        <button type="button" class="eg-reviews-arrow eg-reviews-prev" id="egPrevBtn" aria-label="Previous Testimonials">
          &#8592;
        </button>
        <button type="button" class="eg-reviews-arrow eg-reviews-next" id="egNextBtn" aria-label="Next Testimonials">
          &#8594;
        </button>
      </div>

    </div>

  </div>
</section>

<style>
/* Main Section Wrapper - Dark Background, No Top Space */
.eg-reviews-section {
  width: 100%;
  margin: 0 auto 0;
  padding: 0px 80px 100px;
  background-color: #000000;
  box-sizing: border-box;
  color: #ffffff;
  overflow: hidden;
}

.eg-reviews-container {
  max-width: 1140px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  box-sizing: border-box;
}

/* Header Area */
.eg-reviews-header {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 60px;
  margin-bottom: 60px;
}

/* Badge Component */
.eg-reviews-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.eg-reviews-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.eg-reviews-badge-text {
  font-size: 1.1rem;
  font-weight: 700;
  color: #ffffff;
}

/* Main Heading */
.eg-reviews-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0;
}

/* Carousel Outer Wrapper & Viewport */
.eg-reviews-carousel-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-sizing: border-box;
}

.eg-reviews-grid-viewport {
  width: 100%;
  overflow: hidden;
  touch-action: pan-y;
  box-sizing: border-box;
}

/* Grid Layout for Reviews Carousel */
.eg-reviews-grid {
  width: 100%;
  display: flex;
  gap: 60px;
  transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
  box-sizing: border-box;
}

/* Individual Review Card - Desktop Default */
.eg-reviews-card {
  flex: 0 0 calc(50% - 30px);
  width: calc(50% - 30px);
  max-width: calc(50% - 30px);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-sizing: border-box;
}

/* Stars Rating */
.eg-reviews-stars {
  color: #ff8c00;
  font-size: 1.8rem;
  letter-spacing: 4px;
  margin-bottom: 24px;
}

/* Quote Text */
.eg-reviews-quote {
  font-size: 1.25rem;
  line-height: 1.5;
  color: #cccccc;
  margin: 0 0 40px 0;
  max-width: 480px;
  word-wrap: break-word;
  overflow-wrap: break-word;
}

.eg-reviews-quote p {
  margin: 0;
}

/* Author Row Layout */
.eg-reviews-author {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 16px;
  text-align: right;
  margin-top: auto;
  width: 100%;
  box-sizing: border-box;
}

.eg-reviews-author-info {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.eg-reviews-name {
  font-size: 1.3rem;
  font-weight: 800;
  color: #ffffff;
  margin: 0 0 4px 0;
  word-break: break-word;
}

.eg-reviews-role {
  font-size: 1rem;
  color: #a0a0a0;
  font-weight: 500;
  word-break: break-word;
}

/* Avatar Image */
.eg-reviews-avatar {
  width: 64px !important;
  height: 64px !important;
  min-width: 64px !important;
  min-height: 64px !important;
  border-radius: 50%;
  object-fit: cover;
  display: block;
  flex-shrink: 0 !important;
}

/* Navigation Controls */
.eg-reviews-controls {
  display: flex;
  gap: 16px;
  margin-top: 50px;
}

.eg-reviews-arrow {
  background: transparent;
  border: 1px solid #1ba3b0;
  color: #1ba3b0;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

.eg-reviews-arrow:hover {
  background-color: #1ba3b0;
  color: #000000;
}

.eg-reviews-arrow:disabled {
  opacity: 0.3;
  cursor: not-allowed;
  border-color: #444444;
  color: #444444;
}

.eg-reviews-arrow:disabled:hover {
  background: transparent;
  color: #444444;
}

/* Responsive Styles & Mobile Fixes */
@media (max-width: 1200px) {
  .eg-reviews-section {
    padding: 0px 40px 80px;
  }
  .eg-reviews-title {
    font-size: 3rem;
  }
}

/* Mobile Layout Fixes */
@media (max-width: 992px) {
  .eg-reviews-grid {
    gap: 0px !important;
  }

  .eg-reviews-card {
    flex: 0 0 100% !important;
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100% !important;
    box-sizing: border-box !important;
  }

  .eg-reviews-quote {
    max-width: 100% !important;
  }

  /* Keep author image and text constrained to visible card area */
  .eg-reviews-author {
    justify-content: space-between !important;
    flex-direction: row-reverse !important;
  }

  .eg-reviews-author-info {
    text-align: right !important;
    max-width: calc(100% - 80px) !important;
  }
}

@media (max-width: 640px) {
  .eg-reviews-section {
    padding: 0px 20px 60px !important;
  }
  .eg-reviews-title {
    font-size: 1.95rem !important;
  }
  .eg-reviews-stars {
    font-size: 1.4rem !important;
  }
  .eg-reviews-quote {
    font-size: 1.1rem !important;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const grid = document.getElementById('egReviewsGrid');
  const viewport = document.getElementById('egReviewsViewport');
  const prevBtn = document.getElementById('egPrevBtn');
  const nextBtn = document.getElementById('egNextBtn');

  if (!grid || !prevBtn || !nextBtn || !viewport) return;

  let currentIndex = 0;
  let startX = 0;
  let currentX = 0;
  let isSwiping = false;

  function getItemsPerPage() {
    return window.innerWidth <= 992 ? 1 : 2;
  }

  function updateCarousel() {
    const totalItems = grid.children.length;
    if (totalItems === 0) return;

    const itemsPerPage = getItemsPerPage();
    const maxIndex = Math.max(0, totalItems - itemsPerPage);

    if (currentIndex > maxIndex) {
      currentIndex = maxIndex;
    }

    const viewportWidth = viewport.getBoundingClientRect().width;

    if (window.innerWidth <= 992) {
      grid.style.transform = `translateX(-${currentIndex * viewportWidth}px)`;
    } else {
      const firstCard = grid.children[0];
      const cardWidth = firstCard.getBoundingClientRect().width;
      const gap = 60;
      grid.style.transform = `translateX(-${currentIndex * (cardWidth + gap)}px)`;
    }

    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= maxIndex;
  }

  prevBtn.addEventListener('click', function() {
    if (currentIndex > 0) {
      currentIndex--;
      updateCarousel();
    }
  });

  nextBtn.addEventListener('click', function() {
    const totalItems = grid.children.length;
    const itemsPerPage = getItemsPerPage();
    if (currentIndex < totalItems - itemsPerPage) {
      currentIndex++;
      updateCarousel();
    }
  });

  viewport.addEventListener('touchstart', function(e) {
    startX = e.touches[0].clientX;
    isSwiping = true;
  }, { passive: true });

  viewport.addEventListener('touchmove', function(e) {
    if (!isSwiping) return;
    currentX = e.touches[0].clientX;
  }, { passive: true });

  viewport.addEventListener('touchend', function() {
    if (!isSwiping) return;
    const diffX = startX - currentX;
    if (Math.abs(diffX) > 40 && currentX !== 0) {
      const totalItems = grid.children.length;
      const itemsPerPage = getItemsPerPage();

      if (diffX > 0 && currentIndex < totalItems - itemsPerPage) {
        currentIndex++;
      } else if (diffX < 0 && currentIndex > 0) {
        currentIndex--;
      }
      updateCarousel();
    }
    isSwiping = false;
    startX = 0;
    currentX = 0;
  });

  window.addEventListener('resize', updateCarousel);
  window.addEventListener('load', updateCarousel);
  setTimeout(updateCarousel, 100);
});
</script>

<?php endif; ?>

<?php
// Query ACF Portfolio CPT
$portfolio_query = new WP_Query(array(
    'post_type'      => 'portfolio',
    'posts_per_page' => 8, // Retrieves top 8 projects for the 4x2 grid
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC'
));

if ($portfolio_query->have_posts()) :
?>

<section class="eg-latest-section">
  <div class="eg-latest-container">
    
    <!-- Header Area -->
    <div class="eg-latest-header">
      <div class="eg-latest-badge">
        <span class="eg-latest-diamond">◆</span>
        <span class="eg-latest-badge-text fade-right">Latest work</span>
      </div>

      <h2 class="eg-latest-title fade-left">
        Featured projects &amp;<br />
        creative works
      </h2>
    </div>

    <!-- 4 Columns x 2 Rows Image Grid -->
    <div class="eg-latest-grid">
      
      <?php 
      while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); 
        // Get featured image URL or fall back if empty
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        if (!$featured_img_url) {
            $featured_img_url = 'https://via.placeholder.com/400x400?text=No+Image';
        }
      ?>
        <!-- Image Square -->
        <div class="eg-latest-item">
          <a href="<?php the_permalink(); ?>">
            <img 
              src="<?php echo esc_url($featured_img_url); ?>" 
              alt="<?php echo esc_attr(get_the_title()); ?>" 
              class="eg-latest-img fade-up" 
            />
          </a>
        </div>
      <?php 
      endwhile; 
      wp_reset_postdata(); 
      ?>

    </div>

    <!-- Bottom Action Button -->
    <div class="eg-latest-btn-wrapper">
      <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="eg-latest-btn">View all</a>
    </div>

  </div>
</section>

<?php endif; ?>

<style>
/* Main Section - White Background, No Top Space with dark section above */
.eg-latest-section {
  width: 100%;
  margin: 0 auto;
  padding: 80px 120px 100px;
  box-sizing: border-box;
  background-color: #ffffff;
  color: #111111;
}

.eg-latest-container {
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Header Styling */
.eg-latest-header {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 50px;
}

/* Diamond Badge */
.eg-latest-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.eg-latest-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.eg-latest-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

/* Title */
.eg-latest-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0;
}

/* Grid: 4 Columns with tight spacing */
.eg-latest-grid {
  width: 100%;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 50px;
}

/* Square Image Containers */
.eg-latest-item {
  position: relative;
  width: 100%;
  aspect-ratio: 1 / 1; /* Forces exact square proportion for every image */
  overflow: hidden;
  border-radius: 4px;
}

.eg-latest-item a {
  display: block;
  width: 100%;
  height: 100%;
}

.eg-latest-img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Fits image inside square without distortion */
  display: block;
  transition: transform 0.4s ease;
}

.eg-latest-item:hover .eg-latest-img {
  transform: scale(1.04);
}

/* Button Wrapper & Bordered Button */
.eg-latest-btn-wrapper {
  display: flex;
  justify-content: center;
}

.eg-latest-btn {
  display: inline-block;
  padding: 14px 40px;
  border: 1.5px solid #1ba3b0;
  color: #0d0d0d;
  font-size: 1.05rem;
  font-weight: 700;
  text-decoration: none;
  border-radius: 2px;
  background-color: transparent;
  transition: all 0.3s ease;
}

.eg-latest-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Responsive Handling */
@media (max-width: 1200px) {
  .eg-latest-section {
    padding: 60px 40px 80px;
  }
  .eg-latest-title {
    font-size: 3rem;
  }
}

@media (max-width: 992px) {
  .eg-latest-grid {
    grid-template-columns: repeat(2, 1fr); /* 2x4 on tablet screens */
    gap: 14px;
  }
}

@media (max-width: 640px) {
  .eg-latest-section {
    padding: 40px 20px 60px;
  }
  .eg-latest-title {
    font-size: 1.95rem;
  }
  .eg-latest-grid {
    grid-template-columns: 1fr; /* 1 column on mobile screens */
    gap: 12px;
  }
}
</style>

<!-- <?php
$clients_query = new WP_Query(array(
    'post_type'      => 'clients',
    'posts_per_page' => -1, 
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC'
));

if ($clients_query->have_posts()) :
?>

<section class="eg-clients-section">
  <div class="eg-clients-container">
    
 
    <div class="eg-clients-header">
      <div class="eg-clients-badge">
        <span class="eg-clients-diamond">◆</span>
        <span class="eg-clients-badge-text fade-left">Major Clients</span>
      </div>

      <h2 class="eg-clients-title fade-right">
        Designing Better<br />
        Customer Experiences
      </h2>
    </div>

   
    <div class="eg-clients-box">
      <div class="eg-clients-grid">
        
        <?php 
        while ($clients_query->have_posts()) : $clients_query->the_post(); 
          
          $logo_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
          if (!$logo_url) {
              $logo_url = 'https://via.placeholder.com/200x100?text=No+Logo';
          }
        ?>
          <div class="eg-clients-item">
            <img 
              src="<?php echo esc_url($logo_url); ?>" 
              alt="<?php echo esc_attr(get_the_title()); ?>" 
              class="eg-clients-logo fade-left" 
            />
          </div>
        <?php 
        endwhile; 
        wp_reset_postdata(); 
        ?>

      </div>
    </div>

    <div class="eg-clients-btn-wrapper">
      <a href="<?php echo esc_url(get_post_type_archive_link('client')); ?>" class="eg-clients-btn">View all</a>
    </div>

  </div>
</section> 
<?php endif; ?>
-->


<section class="eg-clients-section">
  <div class="eg-clients-container">
    
    <div class="eg-clients-header">
      <div class="eg-clients-badge">
        <span class="eg-clients-diamond">◆</span>
        <span class="eg-clients-badge-text fade-left">Major Clients</span>
      </div>

      <h2 class="eg-clients-title fade-right">
        Designing Better<br />
        Customer Experiences
      </h2>
    </div>

    <div class="eg-clients-box">
      <div class="eg-clients-grid">
        <div class="eg-clients-item">
          <img 
            src="<?php echo get_field('clients_logo'); ?>" 
            alt="Major Clients" 
            class="eg-clients-logo fade-left" 
          />
        </div>
      </div>
    </div>

    <div class="eg-clients-btn-wrapper">
      <a href="<?php echo esc_url(get_post_type_archive_link('client')); ?>" class="eg-clients-btn">View all</a>
    </div>

  </div>
</section>



<style>
.eg-clients-logo {
  width: 100%;
  height: auto;
}

	
	/* Main Section Container - Zero top margin/padding to join previous section */
.eg-clients-section {
  width: 100%;
  margin: 0 auto;
  padding: 40px 120px 100px; /* Minimal top padding */
  box-sizing: border-box;
  background-color: transparent;
  color: #111111;
}

.eg-clients-container {
/*   max-width: 1140px; */
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Header Styling */
.eg-clients-header {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 45px;
}

/* Badge Component */
.eg-clients-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.eg-clients-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.eg-clients-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

/* Title */
.eg-clients-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0;
}

/* White Floating Box with Shadow */
.eg-clients-box {
  width: 100%;
  background-color: #ffffff;
  border-radius: 20px;
  padding: 35px 25px; /* Compact box padding */
  box-sizing: border-box;
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
  margin-bottom: 50px;
}

/* Logos Grid Layout (7 Columns on Desktop with Reduced Gaps) */
/* .eg-clients-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 10px 8px; /* Tight gap: 10px vertical, 8px horizontal */
  align-items: center;
  justify-items: center;
} */

.eg-clients-item {
  width: 100%;
  min-height: 70px; /* Reduced vertical space for tighter flow */
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4px; /* Reduced internal item padding */
  box-sizing: border-box;
}

/* Logo Dimensions */
.eg-clients-logo {
  width: 100%;
/*   max-width: 130px;  */
/*   max-height: 75px;  */
  object-fit: contain;
  display: block;
  filter: grayscale(0%);
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.eg-clients-logo:hover {
  opacity: 0.8;
  transform: scale(1.05);
}

/* Bordered View All Button */
.eg-clients-btn-wrapper {
  display: flex;
  justify-content: center;
}

.eg-clients-btn {
  display: inline-block;
  padding: 12px 38px;
  border: 1.5px solid #1ba3b0;
  color: #0d0d0d;
  font-size: 1.05rem;
  font-weight: 700;
  text-decoration: none;
  border-radius: 2px;
  background-color: transparent;
  transition: all 0.3s ease;
}

.eg-clients-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Responsive Handling */
@media (max-width: 1200px) {
  .eg-clients-section {
    padding: 30px 40px 80px;
  }
  .eg-clients-title {
    font-size: 3rem;
  }
  .eg-clients-grid {
    grid-template-columns: repeat(5, 1fr);
    gap: 10px 8px;
  }
  .eg-clients-logo {
    max-height: 65px;
  }
}

@media (max-width: 850px) {
  .eg-clients-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 12px 8px;
  }
  .eg-clients-logo {
    max-height: 60px;
  }
}

@media (max-width: 640px) {
  .eg-clients-section {
    padding: 20px 20px 60px;
  }
  .eg-clients-title {
    font-size: 1.95rem;
  }
  .eg-clients-box {
    padding: 20px 12px;
    border-radius: 14px;
  }
  .eg-clients-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 6px;
  }
  .eg-clients-item {
    min-height: 55px;
  }
  .eg-clients-logo {
    max-height: 55px;
  }
}
</style>
<!-- FAQ -->
<?php
// Query ACF FAQ CPT
$faq_query = new WP_Query(array(
    'post_type'      => 'faq',
    'posts_per_page' => -1, // Fetches all FAQ items
    'post_status'    => 'publish',
    'orderby'        => 'menu_order', // Respects custom ordering or defaults to date
    'order'          => 'ASC'
));

if ($faq_query->have_posts()) :
?>

<section class="eg-faq-section">
  <div class="eg-faq-container">
    
    <!-- Left Column: Title & Subtitle -->
    <div class="eg-faq-left">
      <div class="eg-faq-badge">
        <span class="eg-faq-diamond">◆</span>
        <span class="eg-faq-badge-text fade-left">Frequently asked questions</span>
      </div>

      <h2 class="eg-faq-title fade-right">
        Got questions?<br />
        We’ve got answers
      </h2>

      <p class="eg-faq-description fade-left">
        Everything you need to know about our process, pricing, and how we work together
      </p>
    </div>

    <!-- Right Column: Accordion Box -->
    <div class="eg-faq-right">
      <div class="eg-faq-accordion">
        
        <?php 
        while ($faq_query->have_posts()) : $faq_query->the_post(); 
        ?>
          <!-- Accordion Item -->
          <details class="eg-faq-item">
            <summary class="eg-faq-question fade-left">
              <span><?php the_title(); ?></span>
              <span class="eg-faq-icon">+</span>
            </summary>
            <div class="eg-faq-answer">
              <?php the_content(); ?>
            </div>
          </details>
        <?php 
        endwhile; 
        wp_reset_postdata(); 
        ?>

      </div>
    </div>

  </div>
</section>

<?php endif; ?>

<style>
/* Main FAQ Section Wrapper */
.eg-faq-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 60px auto 90px;
  padding: 20px 80px;
  box-sizing: border-box;
  color: #111111;
}

.eg-faq-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 80px;
  width: 100%;
  margin: 0 auto;
}

/* Left Column Styling */
.eg-faq-left {
  flex: 1;
  max-width: 580px;
}

.eg-faq-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
}

.eg-faq-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.eg-faq-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.eg-faq-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 28px 0;
}

.eg-faq-description {
  font-size: 1.15rem;
  line-height: 1.5;
  color: #222222;
  margin: 0;
  max-width: 480px;
}

/* Right Column: Gray Card Box & Accordion */
.eg-faq-right {
  flex: 1.1;
}

.eg-faq-accordion {
  background-color: #e5e5e5;
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.eg-faq-item {
  border-bottom: 2px solid #ffffff;
}

.eg-faq-item:last-child {
  border-bottom: none;
}

/* Question Row Header */
.eg-faq-question {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 26px 32px;
  font-size: 1.35rem;
  font-weight: 700;
  color: #0d0d0d;
  cursor: pointer;
  list-style: none;
  user-select: none;
}

.eg-faq-question::-webkit-details-marker {
  display: none;
}

.eg-faq-icon {
  font-size: 1.5rem;
  font-weight: 400;
  color: #0d0d0d;
  transition: transform 0.3s ease;
  line-height: 1;
}

/* Rotate icon on toggle */
.eg-faq-item[open] .eg-faq-icon {
  transform: rotate(45deg);
}

/* Expandable Answer Box */
.eg-faq-answer {
  padding: 0 32px 24px 32px;
  font-size: 1.1rem;
  line-height: 1.6;
  color: #444444;
}

.eg-faq-answer p {
  margin: 0;
}

/* Responsive Handling */
@media (max-width: 1200px) {
  .eg-faq-section {
    padding: 20px 40px;
  }

  .eg-faq-title {
    font-size: 3rem;
  }

  .eg-faq-container {
    gap: 40px;
  }
}

@media (max-width: 991px) {
  .eg-faq-container {
    flex-direction: column;
    gap: 40px;
  }

  .eg-faq-left {
    max-width: 100%;
  }

  .eg-faq-right {
    width: 100%;
  }
}

@media (max-width: 640px) {
  .eg-faq-section {
    padding: 20px 20px;
  }

  .eg-faq-title {
    font-size: 1.95rem;
  }

  .eg-faq-question {
    padding: 20px 20px;
    font-size: 1.15rem;
  }

  .eg-faq-answer {
    padding: 0 20px 20px 20px;
  }
}
</style>

<!-- Blog Posts Section -->
<section class="eg-blog-section">
  <div class="eg-blog-container">
    
    <!-- Left Column: Header & View All Button -->
    <div class="eg-blog-left">
      <div class="eg-blog-badge">
        <span class="eg-blog-diamond">◆</span>
        <span class="eg-blog-badge-text fade-left">Blog posts</span>
      </div>

      <h2 class="eg-blog-title fade-right">
        Latest content<br />
        From Excel
      </h2>

      <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="eg-blog-btn-outline">View all</a>
    </div>

    <!-- Right Column: Blog Cards Grid -->
    <div class="eg-blog-right">
      
      <?php
      // Query 2 latest WordPress blog posts
      $blog_query = new WP_Query(array(
          'post_type'      => 'post',
          'posts_per_page' => 2,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC'
      ));

      if ($blog_query->have_posts()) :
        while ($blog_query->have_posts()) : $blog_query->the_post();
          $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
          if (!$thumb_url) {
              $thumb_url = 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=800&auto=format&fit=crop';
          }
      ?>
        <!-- Dynamic Card -->
        <article class="eg-blog-card">
          <div class="eg-blog-card-img-wrapper">
            <a href="<?php the_permalink(); ?>">
              <img 
                src="<?php echo esc_url($thumb_url); ?>" 
                alt="<?php echo esc_attr(get_the_title()); ?>" 
                class="eg-blog-card-img fade-up" 
              />
            </a>
          </div>
          <div class="eg-blog-card-content">
            <h3 class="eg-blog-card-title fade-left"><?php the_title(); ?></h3>
            <div class="eg-blog-divider"></div>
            <span class="eg-blog-date"><?php echo get_the_date('F j, Y'); ?></span>
            <p class="eg-blog-desc fade-right"><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
            <a href="<?php the_permalink(); ?>" class="eg-blog-link fade-left">READ NOW</a>
          </div>
        </article>
      <?php 
        endwhile;
        wp_reset_postdata();
      endif; 
      ?>

    </div>

  </div>
</section>

<!-- Call To Action Banner Section -->
<section class="eg-cta-section">
  <div class="eg-cta-container">
    <div class="eg-cta-card">
      <img 
        src=" <?php echo get_field('cta_section')['image']; ?>" 
        alt="Brand Identity CTA Background" 
        class="eg-cta-bg" 
      />
      <div class="eg-cta-overlay"></div>
      
      <div class="eg-cta-content">
        <h2 class="eg-cta-title fade-right">
          <?php echo get_field('cta_section')['title']; ?>
        </h2>
        <a href=" <?php echo get_field('cta_section')['link']; ?>" class="eg-cta-btn fade-left">Book a Consultation</a>
      </div>
    </div>
  </div>
</section>

<style>
/* ==========================================
   BLOG POSTS SECTION
   ========================================== */
.eg-blog-section {
  width: 100%;
  margin: 0 auto;
  padding: 80px 80px 100px;
  background-color: #e9e9e9; /* Light grey background matching screenshot */
  box-sizing: border-box;
  color: #111111;
}

.eg-blog-container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 60px;
  width: 100%;
  margin: 0 auto;
}

/* Left Column */
.eg-blog-left {
/*   flex: 0 0 320px; */
}

.eg-blog-badge {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 24px;
}

.eg-blog-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.eg-blog-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.eg-blog-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.12;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 36px 0;
}

.eg-blog-btn-outline {
  display: inline-block;
  padding: 12px 36px;
  border: 1.5px solid #1ba3b0;
  color: #0d0d0d;
  font-size: 1.05rem;
  font-weight: 700;
  text-decoration: none;
  background-color: transparent;
  transition: all 0.3s ease;
}

.eg-blog-btn-outline:hover {
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Right Column: 2 Cards */
.eg-blog-right {
  flex: 1;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
  max-width: 780px;
}

.eg-blog-card {
  background-color: #ffffff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
  display: flex;
  flex-direction: column;
}

.eg-blog-card-img-wrapper {
  width: 100%;
  height: 250px;
  overflow: hidden;
}

.eg-blog-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s ease;
}

.eg-blog-card:hover .eg-blog-card-img {
  transform: scale(1.04);
}

.eg-blog-card-content {
  padding: 28px 28px 32px;
  display: flex;
  flex-direction: column;
  flex: 1;
}

.eg-blog-card-title {
  font-size: 1.35rem;
  font-weight: 800;
  color: #0d0d0d;
  line-height: 1.25;
  letter-spacing: -0.3px;
  margin: 0 0 20px 0;
}

.eg-blog-divider {
  width: 100%;
  border-top: 1.5px dashed #cccccc;
  margin-bottom: 16px;
}

.eg-blog-date {
  font-size: 0.95rem;
  font-weight: 600;
  color: #777777;
  margin-bottom: 14px;
  display: block;
}

.eg-blog-desc {
  font-size: 1.05rem;
  line-height: 1.5;
  color: #444444;
  margin: 0 0 24px 0;
}

.eg-blog-link {
  font-size: 0.85rem;
  font-weight: 800;
  letter-spacing: 0.5px;
  color: #0d0d0d;
  text-decoration: underline;
  text-underline-offset: 4px;
  margin-top: auto;
  align-self: flex-start;
  transition: color 0.3s ease;
}

.eg-blog-link:hover {
  color: #1ba3b0;
}

/* ==========================================
   CALL TO ACTION BANNER SECTION
   ========================================== */
.eg-cta-section {
  width: 100%;
  /* Split background: top half is light grey (#e9e9e9), bottom half is white (#ffffff) */
/*   background: linear-gradient(to bottom, #e9e9e9 10%, #ffffff 10%); */
  padding: 0 80px 80px;
  box-sizing: border-box;
}

.eg-cta-container {
  width: 100%;
  margin: 0 auto;
}

.eg-cta-card {
  position: relative;
  width: 100%;
  border-radius: 24px;
  overflow: hidden;
  padding: 90px 40px;
  text-align: center;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
  align-items: center;
}

.eg-cta-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
}

.eg-cta-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 8, 20, 0.75); /* Dark atmospheric overlay */
  z-index: 1;
}

.eg-cta-content {
  position: relative;
  z-index: 2;
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.eg-cta-title {
  color: #ffffff;
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -1px;
  margin: 0 0 36px 0;
}

.eg-cta-btn {
  display: inline-block;
  background-color: #ffffff;
  color: #111111;
  padding: 16px 40px;
  border-radius: 50px;
  font-size: 1.1rem;
  font-weight: 700;
  text-decoration: none;
  transition: all 0.3s ease;
}

.eg-cta-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
  transform: translateY(-2px);
}

/* ==========================================
   RESPONSIVE STYLES
   ========================================== */
@media (max-width: 1200px) {
  .eg-blog-section,
  .eg-cta-section {
    padding-left: 40px;
    padding-right: 40px;
  }
  
  .eg-blog-title,
  .eg-cta-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .eg-blog-container {
    flex-direction: column;
  }

  .eg-blog-left {
    flex: 1 1 100%;
  }

  .eg-blog-right {
    max-width: 100%;
  }
}

@media (max-width: 640px) {
  .eg-blog-section,
  .eg-cta-section {
    padding-left: 20px;
    padding-right: 20px;
  }

  .eg-blog-right {
    grid-template-columns: 1fr;
  }

  .eg-blog-title,
  .eg-cta-title {
    font-size: 1.95rem;
  }

  .eg-cta-card {
    padding: 60px 20px;
  }
}
	
/* ==========================================
   CALL TO ACTION BANNER SECTION (OVERLAPPING FOOTER)
   ========================================== */
.eg-cta-section {
  position: relative;
  z-index: 10; /* Ensures CTA sits ABOVE the footer */
  width: 100%;
  padding: 0 80px;
  margin-top: 50px;
  margin-bottom: -250px; /* Pulls the footer UP so the card overlaps it */
  box-sizing: border-box;
}

.eg-cta-container {
  width: 100%;
  margin: 0 auto;
}

/* Ensure your Footer has relative positioning and a lower z-index */
footer, .site-footer {
  position: relative;
  z-index: 1;
  padding-top: 140px; /* Extra top padding to compensate for the overlapping card */
  background-color: #111111; /* Example footer dark background */
}

/* ==========================================
   RESPONSIVE ADJUSTMENTS
   ========================================== */
@media (max-width: 1200px) {
  .eg-cta-section {
    padding-left: 40px;
    padding-right: 40px;
    margin-bottom: -130px; /* Reduce negative overlap on tablet */
  }
}

@media (max-width: 640px) {
  .eg-cta-section {
    padding-left: 20px;
    padding-right: 20px;
    margin-bottom: -130px; /* Reduce negative overlap on mobile */
  }
  
  footer, .site-footer {
    padding-top: 100px;
  }
}	
	
@media (min-width: 1024px) {
  .exg-ft-section {
    padding: 380px 0 30px !important;
  }
}
	
	
</style>





<?php get_footer(); ?>