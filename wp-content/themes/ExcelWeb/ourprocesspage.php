<?php /* Template Name: Our Process Page
        Template Post Type: page, post */
?>

<?php get_header(); ?>

<!-- Process Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('process_banner'); ?>
<section class="process-hero-banner">
  <?php if ( ! empty( $banner['image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['image'] ); ?>" alt="Our Process Page Banner" class="process-hero-bg-img" />
    <div class="process-hero-overlay"></div>
  <?php endif; ?>

  <div class="process-hero-container">
    <div class="process-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="process-hero-title fade-right"><?php echo esc_html( $banner['title'] ); ?></h1>
      <?php endif; ?>

      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="process-hero-subtext fade-left"><?php echo esc_html( $banner['content'] ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.process-hero-banner {
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

.process-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.process-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.process-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.process-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.process-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .process-hero-banner {
    min-height: 340px;
  }
  .process-hero-container {
    padding: 40px 24px;
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
  .process-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<?php
  $intro = get_field( 'process_intro' );
  $steps = array();
  for ( $i = 1; $i <= 8; $i++ ) {
    $step = get_field( 'step_' . $i );
    if ( ! empty( $step['title'] ) ) {
      $steps[] = $step;
    }
  }
?>

<!-- Process Intro Card -->
<section class="process-intro-section">
  <div class="process-intro-card">
    <?php if ( ! empty( $intro['badge'] ) ) : ?>
      <div class="process-intro-badge">
        <span class="process-intro-diamond">◆</span>
        <span class="process-intro-badge-text fade-left"><?php echo esc_html( $intro['badge'] ); ?></span>
      </div>
    <?php endif; ?>
    <?php if ( ! empty( $intro['title'] ) ) : ?>
      <h2 class="process-intro-title fade-right"><?php echo esc_html( $intro['title'] ); ?></h2>
    <?php endif; ?>
    <?php if ( ! empty( $intro['description'] ) ) : ?>
      <p class="process-intro-desc fade-left"><?php echo esc_html( $intro['description'] ); ?></p>
    <?php endif; ?>
  </div>
</section>

<style>
.process-intro-section {
  width: calc(100% - 40px);
  max-width: 900px;
  margin: 0 auto 90px;
  padding: 0 20px;
  box-sizing: border-box;
}

.process-intro-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 20px;
  padding: 48px 56px;
  text-align: center;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.process-intro-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.process-intro-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.process-intro-badge-text {
  font-family: monospace;
  font-size: 0.85rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 0.15em;
  text-transform: uppercase;
}

.process-intro-title {
  font-size: 2rem;
  font-weight: 700;
  line-height: 1.3;
  color: #0d0d0d;
  margin: 0 0 16px 0;
}

.process-intro-desc {
  font-size: 1.1rem;
  line-height: 1.65;
  color: #555555;
  margin: 0;
}

@media (max-width: 640px) {
  .process-intro-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }
  .process-intro-card {
    padding: 32px 24px;
    border-radius: 16px;
  }
  .process-intro-title {
    font-size: 1.5rem;
  }
}
</style>

<!-- Process Timeline: alternating text / icon-card zigzag -->
<?php if ( ! empty( $steps ) ) : ?>
<section class="process-zig-section">
  <div class="process-zig-container">
    <div class="process-zig-track"></div>

    <?php foreach ( $steps as $i => $step ) :
      $num       = str_pad( $i + 1, 2, '0', STR_PAD_LEFT );
      $text_side = ( $i % 2 === 0 ) ? 'left' : 'right'; // where the plain title/desc sits on desktop
    ?>
      <div class="process-zig-row">

        <div class="process-zig-text process-zig-text-<?php echo esc_attr( $text_side ); ?>">
          <h3 class="process-zig-title"><?php echo esc_html( $step['title'] ); ?></h3>
          <?php if ( ! empty( $step['description'] ) ) : ?>
            <p class="process-zig-desc"><?php echo esc_html( $step['description'] ); ?></p>
          <?php endif; ?>
        </div>

        <div class="process-zig-marker"><?php echo esc_html( $num ); ?></div>

        <div class="process-zig-iconcard process-zig-iconcard-<?php echo esc_attr( $text_side === 'left' ? 'right' : 'left' ); ?>">
          <div class="process-zig-card">
            <h3 class="process-zig-card-title-mobile"><?php echo esc_html( $step['title'] ); ?></h3>
            <?php if ( ! empty( $step['description'] ) ) : ?>
              <p class="process-zig-card-desc-mobile"><?php echo esc_html( $step['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $step['icon'] ) ) : ?>
              <span class="process-zig-icon"><?php echo esc_html( $step['icon'] ); ?></span>
            <?php endif; ?>
          </div>
        </div>

      </div>
    <?php endforeach; ?>

  </div>
</section>

<style>
.process-zig-section {
  width: calc(100% - 40px);
  max-width: 1100px;
  margin: 0 auto 90px;
  padding: 0 20px;
  box-sizing: border-box;
}

.process-zig-container {
  position: relative;
}

/* Center vertical track */
.process-zig-track {
  position: absolute;
  left: 50%;
  top: 0;
  bottom: 0;
  width: 2px;
  background-color: #e5e9ea;
  transform: translateX(-50%);
  z-index: 0;
}

.process-zig-row {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  min-height: 120px;
  margin-bottom: 40px;
}

.process-zig-row:last-child {
  margin-bottom: 0;
}

/* Plain text block (title + description, no card) */
.process-zig-text {
  width: 41.6667%;
  position: relative;
  z-index: 1;
}

.process-zig-text-left {
  order: 1;
  text-align: right;
  padding-right: 12px;
}

.process-zig-text-right {
  order: 3;
  text-align: left;
  padding-left: 12px;
}

.process-zig-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #0d0d0d;
  margin: 0 0 8px 0;
  line-height: 1.3;
  transition: color 0.3s ease;
}

.process-zig-row:hover .process-zig-title {
  color: #1ba3b0;
}

.process-zig-desc {
  font-size: 1rem;
  line-height: 1.6;
  color: #666666;
  margin: 0;
}

/* Center number marker, on the track */
.process-zig-marker {
  order: 2;
  position: relative;
  flex-shrink: 0;
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background-color: #ffffff;
  border: 2px solid #1ba3b0;
  color: #1ba3b0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: monospace;
  font-size: 1.1rem;
  font-weight: 700;
  z-index: 2;
  box-shadow: 0 0 0 6px rgba(27, 163, 176, 0.12);
  transition: box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
}

.process-zig-row:hover .process-zig-marker {
  box-shadow: 0 0 0 10px rgba(27, 163, 176, 0.22);
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Icon card on the opposite side */
.process-zig-iconcard {
  width: 41.6667%;
  z-index: 1;
}

.process-zig-iconcard-right {
  order: 3;
  padding-left: 12px;
}

.process-zig-iconcard-left {
  order: 1;
  padding-right: 12px;
}

.process-zig-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 16px;
  padding: 24px 28px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
  text-align: center;
  transition: border-color 0.3s ease, transform 0.3s ease;
}

.process-zig-row:hover .process-zig-card {
  border-color: rgba(27, 163, 176, 0.4);
  transform: translateY(-3px);
}

.process-zig-icon {
  font-size: 2rem;
  line-height: 1;
  display: block;
}

.process-zig-card-title-mobile,
.process-zig-card-desc-mobile {
  display: none;
}

/* Responsive: single column, track + markers on the left, icon card shows title/desc too */
@media (max-width: 900px) {
  .process-zig-track {
    left: 28px;
  }

  .process-zig-row {
    flex-wrap: wrap;
    margin-bottom: 28px;
  }

  .process-zig-text {
    display: none;
  }

  .process-zig-marker {
    position: absolute;
    left: 28px;
    top: 0;
    transform: translateX(-50%);
    width: 44px;
    height: 44px;
    font-size: 0.95rem;
  }

  .process-zig-iconcard,
  .process-zig-iconcard-left,
  .process-zig-iconcard-right {
    order: 2;
    width: 100%;
    padding-left: 64px;
    padding-right: 0;
  }

  .process-zig-card {
    text-align: left;
  }

  .process-zig-card-title-mobile,
  .process-zig-card-desc-mobile {
    display: block;
  }

  .process-zig-card-title-mobile {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0d0d0d;
    margin: 0 0 8px 0;
  }

  .process-zig-card-desc-mobile {
    font-size: 0.98rem;
    line-height: 1.55;
    color: #666666;
    margin: 0 0 14px 0;
  }

  .process-zig-icon {
    font-size: 1.75rem;
    text-align: left;
  }
}

@media (max-width: 640px) {
  .process-zig-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }
  .process-zig-card {
    padding: 18px 20px;
  }
}
</style>
<?php endif; ?>

<!-- Video Section -->
<?php
  $video_banner_img = get_field( 'process_video_banner_image' );
  $youtube_video_id = get_field( 'video_link' );

  $banner_img_src = ! empty( $video_banner_img ) ? $video_banner_img : get_template_directory_uri() . '/assets/images/process-video-banner.jpg';
  $yt_id = ! empty( $youtube_video_id ) ? $youtube_video_id : 'dQw4w9WgXcQ';
?>
<section class="process-video-section">
  <h2 class="process-video-heading">Watch Our Methodology in Action</h2>

  <div class="process-video-frame" style="background-image: url('<?php echo esc_url( $banner_img_src ); ?>');">
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
.process-video-section {
  width: calc(100% - 40px);
  max-width: 1100px;
  margin: 0 auto 90px;
  box-sizing: border-box;
}

.process-video-heading {
  font-size: 2.5rem;
  font-weight: 800;
  text-align: center;
  color: #0d0d0d;
  letter-spacing: -1px;
  margin: 0 0 40px 0;
}

.process-video-frame {
  position: relative;
  width: 100%;
  height: 480px;
  border-radius: 28px;
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

.process-play-btn {
  position: relative;
  z-index: 2;
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
  box-shadow: 0 0 0 14px rgba(27, 163, 176, 0.25), 0 8px 24px rgba(0, 0, 0, 0.25);
  padding: 0;
}

.process-play-btn:hover {
  transform: scale(1.1);
  background-color: #158590;
  box-shadow: 0 0 0 20px rgba(27, 163, 176, 0.35), 0 8px 24px rgba(0, 0, 0, 0.25);
}

.play-icon {
  width: 36px;
  height: 36px;
  margin-left: 4px;
}

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

@media (max-width: 991px) {
  .process-video-heading {
    font-size: 2rem;
    margin-bottom: 28px;
  }
  .process-video-frame {
    height: 360px;
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
}

@media (max-width: 640px) {
  .process-video-section {
    width: calc(100% - 20px);
  }
  .process-video-heading {
    font-size: 1.6rem;
  }
  .process-video-frame {
    height: 280px;
    border-radius: 20px;
  }
  .process-play-btn {
    width: 60px;
    height: 60px;
    box-shadow: 0 0 0 10px rgba(27, 163, 176, 0.25), 0 8px 20px rgba(0, 0, 0, 0.25);
  }
  .play-icon {
    width: 24px;
    height: 24px;
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
      const ytId = <?php echo json_encode( get_field('video_link') ); ?>;

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

<?php
  $quality_intro    = get_field( 'quality_intro' );
  $quality_features = array_filter( array(
    get_field( 'quality_feature_1' ),
    get_field( 'quality_feature_2' ),
    get_field( 'quality_feature_3' ),
  ), function ( $f ) { return ! empty( $f['title'] ); } );
?>

<!-- Quality Assurance Section -->
<?php if ( ! empty( $quality_features ) ) : ?>
<section class="process-quality-section">
  <div class="process-quality-container">
    <div class="process-quality-header">
      <?php if ( ! empty( $quality_intro['badge'] ) ) : ?>
        <div class="process-quality-badge">
          <span class="process-quality-diamond">◆</span>
          <span class="process-quality-badge-text fade-left"><?php echo esc_html( $quality_intro['badge'] ); ?></span>
        </div>
      <?php endif; ?>
      <?php if ( ! empty( $quality_intro['title'] ) ) : ?>
        <h2 class="process-quality-main-title fade-right"><?php echo esc_html( $quality_intro['title'] ); ?></h2>
      <?php endif; ?>
    </div>

    <div class="process-quality-grid">
      <?php foreach ( $quality_features as $feature ) : ?>
        <div class="process-quality-card">
          <?php if ( ! empty( $feature['icon'] ) ) : ?>
            <div class="process-quality-icon"><?php echo esc_html( $feature['icon'] ); ?></div>
          <?php endif; ?>
          <h3 class="process-quality-card-title"><?php echo esc_html( $feature['title'] ); ?></h3>
          <?php if ( ! empty( $feature['description'] ) ) : ?>
            <p class="process-quality-card-desc"><?php echo esc_html( $feature['description'] ); ?></p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
.process-quality-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 90px;
  padding: 70px 80px;
  background-color: #f8f9fa;
  border-radius: 36px;
  box-sizing: border-box;
}

.process-quality-container {
  max-width: 1100px;
  margin: 0 auto;
}

.process-quality-header {
  text-align: center;
  margin-bottom: 48px;
}

.process-quality-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.process-quality-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.process-quality-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.process-quality-main-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1px;
  color: #0d0d0d;
  margin: 0;
}

.process-quality-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
}

.process-quality-card {
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 20px;
  padding: 36px 28px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.process-quality-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.07);
}

.process-quality-icon {
  width: 64px;
  height: 64px;
  margin: 0 auto 20px;
  border-radius: 50%;
  background-color: rgba(27, 163, 176, 0.1);
  color: #1ba3b0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
}

.process-quality-card-title {
  font-size: 1.25rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 10px 0;
}

.process-quality-card-desc {
  font-size: 1rem;
  line-height: 1.6;
  color: #555555;
  margin: 0;
}

@media (max-width: 991px) {
  .process-quality-section {
    padding: 50px 40px;
  }
  .process-quality-main-title {
    font-size: 2.1rem;
  }
  .process-quality-grid {
    grid-template-columns: 1fr;
    gap: 24px;
  }
}

@media (max-width: 640px) {
  .process-quality-section {
    width: calc(100% - 20px);
    padding: 36px 20px;
    border-radius: 24px;
  }
  .process-quality-main-title {
    font-size: 1.75rem;
  }
}
</style>
<?php endif; ?>

<?php $cta = get_field( 'process_cta' ); ?>

<!-- CTA Banner - matches homepage eg-cta-section, sits flush against the footer -->
<?php if ( ! empty( $cta['title'] ) ) : ?>
<section class="process-cta-section">
  <div class="process-cta-container">
    <div class="process-cta-card">
      <?php if ( ! empty( $cta['image'] ) ) : ?>
        <img src="<?php echo esc_url( $cta['image'] ); ?>" alt="Call To Action Background" class="process-cta-bg" />
      <?php endif; ?>
      <div class="process-cta-overlay"></div>

      <div class="process-cta-content">
        <h2 class="process-cta-title fade-right"><?php echo esc_html( $cta['title'] ); ?></h2>
        <?php if ( ! empty( $cta['subtitle'] ) ) : ?>
          <p class="process-cta-subtitle"><?php echo esc_html( $cta['subtitle'] ); ?></p>
        <?php endif; ?>
        <?php
          $cta_whatsapp = get_theme_mod( 'footer_whatsapp' );
          $cta_wa_link  = $cta_whatsapp ? preg_replace( '/\D+/', '', $cta_whatsapp ) : '';
        ?>
        <?php if ( $cta_wa_link ) : ?>
          <a href="https://wa.me/<?php echo esc_attr( $cta_wa_link ); ?>?text=<?php echo urlencode( 'Hello, I would like to know more.' ); ?>" target="_blank" rel="noopener" class="process-cta-btn fade-left">WhatsApp Now</a>
        <?php elseif ( ! empty( $cta['contact_text'] ) ) : ?>
          <span class="process-cta-btn fade-left">WhatsApp Now</span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<style>
.process-cta-section {
  width: 100%;
  padding: 0 80px 80px;
  box-sizing: border-box;
}

.process-cta-container {
  width: 100%;
  margin: 0 auto;
}

.process-cta-card {
  position: relative;
  width: 100%;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
  padding: 90px 40px;
  text-align: center;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
  align-items: center;
}

.process-cta-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
}

.process-cta-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 8, 20, 0.75);
  z-index: 1;
}

.process-cta-content {
  position: relative;
  z-index: 2;
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.process-cta-title {
  color: #ffffff;
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -1px;
  margin: 0 0 20px 0;
}

.process-cta-subtitle {
  color: rgba(255, 255, 255, 0.9);
  font-size: 1.15rem;
  font-weight: 600;
  margin: 0 0 32px 0;
}

.process-cta-btn {
  display: inline-block;
  background-color: #ffffff;
  color: #111111;
  text-decoration: none;
  padding: 16px 40px;
  border-radius: 50px;
  font-size: 1.05rem;
  font-weight: 700;
  transition: all 0.3s ease;
}

.process-cta-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
  transform: translateY(-2px);
}

@media (max-width: 1200px) {
  .process-cta-section {
    padding-left: 40px;
    padding-right: 40px;
  }
}

@media (max-width: 900px) {
  .process-cta-card {
    padding: 60px 30px;
  }
  .process-cta-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 640px) {
  .process-cta-section {
    padding-left: 20px;
    padding-right: 20px;
  }
  .process-cta-card {
    padding: 44px 24px;
    border-radius: 16px;
  }
  .process-cta-title {
    font-size: 1.6rem;
  }
  .process-cta-subtitle {
    font-size: 1rem;
  }
}
</style>
<?php endif; ?>


<?php get_footer(); ?>