<?php /* Template Name: Our Process Page
        Template Post Type: page, post */
?>

<?php get_header(); ?>

<!-- Process Hero Banner Section -->
<section class="process-hero-banner">
  <!-- Background Image -->
  <?php $banner = get_field('process_banner'); ?>
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img 
      src="<?php echo esc_url( $banner['image'] ); ?>" 
      alt="Our Process Page Banner" 
      class="process-hero-bg-img"
    />
  <?php endif; ?>

  <!-- Dark Overlay -->
  <div class="process-hero-overlay"></div>

  <!-- Content Container -->
  <div class="process-hero-container">
    <div class="process-hero-content">
      <?php if ( ! empty( $banner['subtitle'] ) ) : ?>
        <div class="process-hero-badge">
          <span class="process-hero-diamond">◆</span>
          <span class="process-hero-badge-text fade-left"><?php echo esc_html( $banner['subtitle'] ); ?></span>
        </div>
      <?php endif; ?>

      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="process-hero-title fade-right">
          <?php echo esc_html( $banner['title'] ); ?>
        </h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="process-hero-subtext fade-left">
          <?php echo esc_html( $banner['content'] ); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
/* Process Hero Container */
.process-hero-banner {
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
.process-hero-bg-img {
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
.process-hero-overlay {
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
.process-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  box-sizing: border-box;
}

.process-hero-content {
  max-width: 820px;
}

/* Diamond Badge */
.process-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.process-hero-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.process-hero-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.5px;
}

/* Headings & Text */
.process-hero-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 20px;
  color: #ffffff;
}

.process-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 680px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .process-hero-container {
    padding: 50px 40px;
  }
  .process-hero-title {
    font-size: 3rem;
  }
}

@media (max-width: 900px) {
  .process-hero-banner {
    min-height: 400px;
  }
  .process-hero-container {
    padding: 40px 30px;
  }
  .process-hero-title {
    font-size: 2.15rem;
  }
  .process-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .process-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .process-hero-container {
    padding: 30px 20px;
  }
  .process-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<?php
  $args = array(
    'post_type'      => 'process',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'DESC' // Listed in reverse order
  );

  $process_query = new WP_Query($args);
?>

<section class="process-list-section">
  <div class="process-list-container">

    <div class="process-list-header">
      <div class="process-list-badge">
        <span class="process-list-diamond">◆</span>
        <span class="process-list-badge-text fade-left">Methodology</span>
      </div>
      <h2 class="process-list-main-title fade-right">Our Process</h2>
      <p class="process-list-subtitle fade-left">Discover how we plan, execute, and deliver results step by step.</p>
    </div>

    <!-- Full-Width Description Block -->
    <div class="process-fullwidth-description fade-left">
      <p>
        Our operational approach combines technical precision, structured planning, and absolute transparency from initial consultation to final project execution. By maintaining rigorous quality controls and seamless cross-functional communication, we ensure that every solution is tailored precisely to project specifications, delivered on schedule, and engineered for long-term reliability and performance.
      </p>
    </div>

    <!-- Full-Width Blog Detail-Style Sequential List -->
    <div class="process-detail-list">
      <?php if ( $process_query->have_posts() ) :
        while ( $process_query->have_posts() ) : $process_query->the_post(); 
          $thumb_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ?>

        <article class="process-detail-item">
          <!-- Title -->
          <h3 class="process-detail-title fade-left"><?php the_title(); ?></h3>
          
          <!-- Divider -->
          <hr class="process-detail-divider" />

          <!-- Image -->
<!--           <?php if ( has_post_thumbnail() ) : ?>
            <div class="process-detail-img-wrapper">
              <img 
                src="<?php echo esc_url( $thumb_img_url ); ?>" 
                alt="<?php the_title_attribute(); ?>" 
                class="process-detail-img" 
              />
            </div>
          <?php endif; ?> -->

          <!-- Content -->
          <div class="process-detail-content fade-right">
            <?php the_content(); ?>
          </div>
        </article>

      <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p class="no-process-found">No process steps found.</p>
      <?php endif; ?>
    </div>

  </div>
</section>

<style>
/* Section Layout (Matches original full-width styling) */
.process-list-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 0 80px;
  box-sizing: border-box;
}

.process-list-container {
  width: 100%;
  margin: 0 auto;
}

/* Header Area */
.process-list-header {
  text-align: center;
  max-width: 760px;
  margin: 0 auto 32px;
}

.process-list-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.process-list-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.process-list-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.process-list-main-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.process-list-subtitle {
  font-size: 1.25rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

/* Full-Width Description Box */
.process-fullwidth-description {
  width: 100%;
  background-color: #f8f9fa;
  border-left: 4px solid #1ba3b0;
  border-radius: 16px;
  padding: 28px 36px;
  margin-bottom: 60px;
  box-sizing: border-box;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
}

.process-fullwidth-description p {
  font-size: 1.15rem;
  line-height: 1.75;
  color: #333333;
  margin: 0;
}

/* Sequential Full-Width Detail List Layout */
.process-detail-list {
  display: flex;
  flex-direction: column;
  gap: 60px;
  width: 100%;
}

.process-detail-item {
  width: 100%;
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 28px;
  padding: 48px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
  box-sizing: border-box;
}

/* Title */
.process-detail-title {
  font-size: 2.4rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 16px 0;
  line-height: 1.25;
  letter-spacing: -0.5px;
}

/* Divider Line */
.process-detail-divider {
  border: none;
  height: 2px;
  background-color: #1ba3b0;
  margin: 0 0 32px 0;
  width: 100%;
  opacity: 0.8;
}

/* Image Wrapper */
.process-detail-img-wrapper {
  width: 100%;
  max-height: 550px;
  overflow: hidden;
  border-radius: 20px;
  margin-bottom: 32px;
  background-color: #f4f4f4;
}

.process-detail-img {
  width: 100%;
  height: 100%;
  max-height: 550px;
  object-fit: cover;
  display: block;
}

/* Body Content */
.process-detail-content {
  font-size: 1.15rem;
  line-height: 1.8;
  color: #444444;
}

.process-detail-content p {
  margin: 0 0 1.5rem 0;
}

.process-detail-content p:last-child {
  margin-bottom: 0;
}

.no-process-found {
  text-align: center;
  font-size: 1.25rem;
  color: #666666;
  padding: 40px 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .process-list-section {
    padding: 0 40px;
  }
  .process-list-main-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .process-list-main-title {
    font-size: 2.1rem;
  }
  .process-detail-item {
    padding: 36px 28px;
  }
  .process-detail-title {
    font-size: 2rem;
  }
}

@media (max-width: 640px) {
  .process-list-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .process-list-main-title {
    font-size: 1.95rem;
  }

  .process-fullwidth-description {
    padding: 20px 24px;
    margin-bottom: 40px;
  }

  .process-detail-item {
    padding: 24px 20px;
    border-radius: 20px;
  }

  .process-detail-title {
    font-size: 1.6rem;
  }

  .process-detail-img-wrapper {
    max-height: 320px;
    margin-bottom: 24px;
  }

  .process-detail-content {
    font-size: 1.05rem;
  }
}
</style>

<!-- Parallax Video Banner Section -->
<?php 
  $video_banner_img = get_field('process_video_banner_image'); 
  $youtube_video_id = get_field('process_youtube_id');
  
  $banner_img_src = ! empty( $video_banner_img ) ? $video_banner_img : get_template_directory_uri() . '/images/process-video-banner.jpg';
  $yt_id = ! empty( $youtube_video_id ) ? $youtube_video_id : 'dQw4w9WgXcQ';
?>

<section class="process-parallax-video-section">
  <div 
    class="process-parallax-banner" 
    style="background-image: url('<?php echo esc_url( $banner_img_src ); ?>');"
  >
    <div class="process-video-overlay"></div>

    <!-- Center Play Button & Title -->
    <div class="process-video-content">
      <button 
        type="button" 
        class="process-play-btn" 
        aria-label="Play Process Video" 
        id="processPlayVideoBtn"
        data-ytid="<?php echo esc_attr( $yt_id ); ?>"
      >
        <svg viewBox="0 0 24 24" fill="currentColor" class="play-icon">
          <path d="M8 5v14l11-7z"/>
        </svg>
      </button>
      <h3 class="process-video-title fade-left">Watch Our Methodology in Action</h3>
    </div>

    <!-- YouTube Embed Container (Hidden until play clicked) -->
    <div class="process-youtube-container" id="processYoutubeContainer">
      <iframe 
        id="processYoutubeIframe" 
        src="" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen>
      </iframe>
      <button type="button" class="process-close-video-btn" id="processCloseVideoBtn" aria-label="Close Video">&times;</button>
    </div>
  </div>
</section>

<style>
/* Parallax Section Container */
.process-parallax-video-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  box-sizing: border-box;
}

/* Background Attachment Fixed Creates the Parallax Effect */
.process-parallax-banner {
  position: relative;
  width: 100%;
  height: 520px;
  border-radius: 32px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
}

.process-video-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.45);
  z-index: 1;
}

/* Play Button and Text */
.process-video-content {
  position: relative;
  z-index: 2;
  text-align: center;
  color: #ffffff;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.process-play-btn {
  width: 84px;
  height: 84px;
  border-radius: 50%;
  background-color: #1ba3b0;
  color: #ffffff;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 0 0 12px rgba(27, 163, 176, 0.25);
  padding: 0;
}

.process-play-btn:hover {
  transform: scale(1.1);
  background-color: #158590;
  box-shadow: 0 0 0 18px rgba(27, 163, 176, 0.35);
}

.play-icon {
  width: 36px;
  height: 36px;
  margin-left: 4px;
}

.process-video-title {
  font-size: 2rem;
  font-weight: 700;
  margin: 0;
  color: #ffffff;
  letter-spacing: -0.5px;
}

/* Active YouTube Frame Container */
.process-youtube-container {
  position: absolute;
  inset: 0;
  z-index: 3;
  width: 100%;
  height: 100%;
  background: #000000;
  display: none;
}

.process-youtube-container.active {
  display: block;
}

.process-youtube-container iframe {
  width: 100%;
  height: 100%;
  border: none;
}

.process-close-video-btn {
  position: absolute;
  top: 16px;
  right: 20px;
  background: rgba(0, 0, 0, 0.7);
  color: #ffffff;
  border: none;
  font-size: 2rem;
  line-height: 1;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  z-index: 4;
  transition: background-color 0.2s ease;
}

.process-close-video-btn:hover {
  background: #1ba3b0;
}

/* Responsive Media Queries */
@media (max-width: 991px) {
  /* iOS / Mobile Fallback */
  .process-parallax-banner {
    height: 380px;
    background-attachment: scroll;
  }
  .process-play-btn {
    width: 72px;
    height: 72px;
  }
  .play-icon {
    width: 30px;
    height: 30px;
  }
  .process-video-title {
    font-size: 1.6rem;
  }
}

@media (max-width: 640px) {
  .process-parallax-video-section {
    width: calc(100% - 20px);
  }
  .process-parallax-banner {
    height: 300px;
    border-radius: 20px;
  }
  .process-play-btn {
    width: 60px;
    height: 60px;
    box-shadow: 0 0 0 8px rgba(27, 163, 176, 0.25);
  }
  .play-icon {
    width: 24px;
    height: 24px;
  }
  .process-video-title {
    font-size: 1.25rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const playBtn = document.getElementById('processPlayVideoBtn');
  const videoContainer = document.getElementById('processYoutubeContainer');
  const iframe = document.getElementById('processYoutubeIframe');
  const closeBtn = document.getElementById('processCloseVideoBtn');

  if (playBtn && videoContainer && iframe && closeBtn) {
    playBtn.addEventListener('click', function() {
      const ytId = <?php echo json_encode( get_field('process_youtube_id') ); ?>;
      
      iframe.src = 'https://www.youtube.com/embed/' + (ytId ? ytId : 'dQw4w9WgXcQ') + '?autoplay=1&rel=0';
      videoContainer.classList.add('active');
    });

    closeBtn.addEventListener('click', function() {
      iframe.src = '';
      videoContainer.classList.remove('active');
    });
  }
});
</script>

<?php get_footer(); ?>