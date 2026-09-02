<?php /* Template Name: aboutpage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>

<!-- Hero Banner - Minimal (image kept, centered, no badge) -->
<?php $banner = get_field('about_banner'); ?>
<section class="about-hero-banner">
  <?php if ( ! empty( $banner['banner_image'] ) ) : ?>
    <img src="<?php echo esc_url( $banner['banner_image'] ); ?>" alt="About Page Banner" class="about-hero-bg-img" />
    <div class="about-hero-overlay"></div>
  <?php endif; ?>

  <div class="about-hero-container">
    <div class="about-hero-content">
      <?php if ( ! empty( $banner['title'] ) ) : ?>
        <h1 class="about-hero-title fade-right"><?php echo $banner['title']; ?></h1>
      <?php endif; ?>
      <?php if ( ! empty( $banner['content'] ) ) : ?>
        <p class="about-hero-subtext fade-left"><?php echo $banner['content']; ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.about-hero-banner {
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

.about-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.about-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.about-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 40px;
  box-sizing: border-box;
  text-align: center;
}

.about-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.about-hero-title {
  font-size: 3.2rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  color: #ffffff;
  margin: 0 0 20px 0;
}

.about-hero-subtext {
  font-size: 1.15rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.85);
  margin: 0;
}

@media (max-width: 900px) {
  .about-hero-banner {
    min-height: 340px;
  }
  .about-hero-container {
    padding: 40px 24px;
  }
  .about-hero-title {
    font-size: 2.15rem;
  }
  .about-hero-subtext {
    font-size: 1.05rem;
  }
}

@media (max-width: 640px) {
  .about-hero-banner {
    width: calc(100% - 20px);
  }
  .about-hero-title {
    font-size: 1.95rem;
  }
}
</style>

<!-- About Intro: badge/heading/description + image with overlapping stats -->
<?php $intro = get_field('who_we_are'); ?>
<section class="about-intro-section">
  <div class="about-intro-container">
    <div class="about-intro-top">
      <div class="about-intro-badge-col">
        <div class="about-intro-badge">
          <span class="about-intro-badge-icon">🖨</span>
          <span class="about-intro-badge-text"><?php echo esc_html( $intro['subtitle'] ?: 'About Us' ); ?></span>
        </div>
      </div>

      <div class="about-intro-text-col">
        <h2 class="about-intro-heading fade-right"><?php echo esc_html( $intro['heading'] ); ?></h2>

        <?php if ( ! empty( $intro['description'] ) ) : ?>
          <p class="about-intro-desc fade-left"><?php echo esc_html( $intro['description'] ); ?></p>
        <?php endif; ?>
      </div>
    </div>

    <div class="about-intro-media">
      <?php if ( ! empty( $intro['image'] ) ) : ?>
        <img src="<?php echo esc_url( $intro['image'] ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" class="about-intro-img" />
      <?php endif; ?>

      <?php
        $stats = array_filter( array( $intro['stat_1'], $intro['stat_2'], $intro['stat_3'], $intro['stat_4'] ), function ( $s ) { return ! empty( $s['number'] ); } );
      ?>
      <?php if ( ! empty( $stats ) ) : ?>
        <div class="about-intro-stats">
          <?php foreach ( $stats as $stat ) : ?>
            <div class="about-intro-stat">
              <span class="about-intro-stat-number"><?php echo esc_html( $stat['number'] ); ?></span>
              <span class="about-intro-stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<style>
.about-intro-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 100px;
  padding: 0 80px;
  box-sizing: border-box;
}

.about-intro-top {
  display: flex;
  gap: 40px;
  align-items: flex-start;
  margin-bottom: 48px;
}

.about-intro-badge-col {
  flex: 0 0 300px;
}

.about-intro-text-col {
  flex: 1;
  min-width: 0;
}

.about-intro-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  background-color: #f4f6f8;
  border: 1px solid #e9ecef;
  border-radius: 50px;
}

.about-intro-badge-icon {
  font-size: 1rem;
}

.about-intro-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #111111;
}

.about-intro-heading {
  font-size: 2.75rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -1px;
  color: #0d0d0d;
  max-width: 100%;
  margin: 0 0 20px 0;
}

.about-intro-desc {
  font-size: 1.1rem;
  line-height: 1.7;
  color: #666666;
  max-width: 100%;
  margin: 0;
}

.about-intro-media {
  position: relative;
}

.about-intro-img {
  width: 100%;
  height: 560px;
  object-fit: cover;
  border-radius: 24px;
  display: block;
}

.about-intro-stats {
  position: relative;
  z-index: 2;
  margin: -70px 24px 0;
  background-color: #ffffff;
  border-radius: 20px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
  display: flex;
  flex-wrap: wrap;
  padding: 36px 24px;
}

.about-intro-stat {
  flex: 1 1 25%;
  min-width: 160px;
  text-align: left;
  padding: 0 16px;
}

.about-intro-stat-number {
  display: block;
  font-size: 2.5rem;
  font-weight: 800;
  color: #0d0d0d;
  line-height: 1.1;
  margin-bottom: 8px;
}

.about-intro-stat-label {
  display: block;
  font-size: 0.98rem;
  color: #666666;
}

@media (max-width: 1200px) {
  .about-intro-section {
    padding: 0 40px;
  }
}

@media (max-width: 991px) {
  .about-intro-top {
    flex-direction: column;
    gap: 20px;
  }
  .about-intro-badge-col {
    flex: 0 0 auto;
  }
  .about-intro-heading {
    font-size: 2.1rem;
  }
  .about-intro-img {
    height: 420px;
  }
  .about-intro-stats {
    margin: -50px 16px 0;
    padding: 28px 20px;
  }
  .about-intro-stat-number {
    font-size: 2rem;
  }
}

@media (max-width: 640px) {
  .about-intro-section {
    width: calc(100% - 20px);
    padding: 0 10px;
    margin-bottom: 70px;
  }
  .about-intro-heading {
    font-size: 1.7rem;
  }
  .about-intro-img {
    height: 320px;
    border-radius: 18px;
  }
  .about-intro-stats {
    position: static;
    margin: 20px 0 0;
    flex-direction: column;
    gap: 20px;
  }
  .about-intro-stat {
    padding: 0;
  }
}
</style>

<!-- Our CEO, Founder & Creative Visionary -->
<?php $owner = get_field('owner'); ?>
<section class="about-founder-section">
  <div class="about-founder-container">

    <div class="about-founder-media">
      <?php
        $owner_img = isset( $owner['image'] ) ? $owner['image'] : null;
        $owner_img_url = is_array( $owner_img ) ? ( $owner_img['url'] ?? '' ) : $owner_img;
        $owner_img_alt = is_array( $owner_img ) && ! empty( $owner_img['alt'] ) ? $owner_img['alt'] : 'Founder Photo';
      ?>
      <?php if ( $owner_img_url ) : ?>
        <img src="<?php echo esc_url( $owner_img_url ); ?>" alt="<?php echo esc_attr( $owner_img_alt ); ?>" class="about-founder-photo fade-up" />
      <?php else : ?>
        <img src="https://via.placeholder.com/600x700" alt="Founder Photo" class="about-founder-photo" />
      <?php endif; ?>

      <?php if ( ! empty( $owner['title'] ) ) : ?>
        <div class="about-founder-tag">
          <span class="about-founder-tag-icon">👤</span>
          <span class="about-founder-tag-text"><?php echo esc_html( $owner['title'] ); ?></span>
        </div>
      <?php endif; ?>
    </div>

    <div class="about-founder-content">
      <div class="about-founder-badge">
        <span class="about-founder-badge-icon">🏆</span>
        <span class="about-founder-badge-text">Leadership</span>
      </div>

      <h2 class="about-founder-heading fade-right">Our CEO, Founder &amp; Creative Visionary</h2>

      <?php if ( ! empty( $owner['content'] ) ) : ?>
        <div class="about-founder-bio fade-left"><?php echo wp_kses_post( $owner['content'] ); ?></div>
      <?php endif; ?>

      <?php if ( ! empty( $owner['achievements'] ) ) : ?>
        <div class="about-founder-achievements">
          <h3 class="about-founder-achievements-heading">Key Achievements &amp; Milestones</h3>
          <div class="about-founder-achievements-list"><?php echo $owner['achievements']; ?></div>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<style>
.about-founder-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 100px;
  padding: 0 80px;
  box-sizing: border-box;
}

.about-founder-container {
  display: flex;
  gap: 60px;
  align-items: flex-start;
}

.about-founder-media {
  flex: 0 0 42%;
  position: relative;
}

.about-founder-photo {
  width: 100%;
  height: 560px;
  object-fit: cover;
  border-radius: 24px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
  display: block;
}

.about-founder-tag {
  position: relative;
  z-index: 2;
  margin: -36px 24px 0;
  background-color: #ffffff;
  border-radius: 16px;
  box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12);
  padding: 16px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
}

.about-founder-tag-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background-color: rgba(27, 163, 176, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  flex-shrink: 0;
}

.about-founder-tag-text {
  font-size: 0.98rem;
  font-weight: 700;
  color: #111111;
}

.about-founder-content {
  flex: 1;
  min-width: 0;
}

.about-founder-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 18px;
  background-color: #f4f6f8;
  border: 1px solid #e9ecef;
  border-radius: 50px;
  margin-bottom: 20px;
}

.about-founder-badge-icon {
  font-size: 1rem;
}

.about-founder-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #111111;
}

.about-founder-heading {
  font-size: 2.6rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #0d0d0d;
  margin: 0 0 24px 0;
}

.about-founder-bio {
  font-size: 1.1rem;
  line-height: 1.7;
  color: #555555;
  margin-bottom: 32px;
}

.about-founder-bio p {
  margin: 0 0 16px 0;
}

.about-founder-bio p:last-child {
  margin-bottom: 0;
}

.about-founder-achievements {
  background-color: #f7f9fa;
  border: 1px solid #eef0f2;
  border-radius: 20px;
  padding: 28px;
}

.about-founder-achievements-heading {
  font-size: 1.2rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 18px 0;
}

.about-founder-achievements-list ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px 20px;
}

.about-founder-achievements-list li {
  position: relative;
  padding-left: 30px;
  font-size: 0.98rem;
  line-height: 1.55;
  color: #333333;
}

.about-founder-achievements-list li::before {
  content: '\2713';
  position: absolute;
  left: 0;
  top: 0;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background-color: #1ba3b0;
  color: #ffffff;
  font-size: 0.7rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
}

@media (max-width: 1200px) {
  .about-founder-section {
    padding: 0 40px;
  }
}

@media (max-width: 991px) {
  .about-founder-container {
    flex-direction: column;
    gap: 40px;
  }
  .about-founder-media {
    flex: 0 0 100%;
  }
  .about-founder-photo {
    height: 420px;
  }
  .about-founder-heading {
    font-size: 2.1rem;
  }
  .about-founder-achievements-list ul {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 640px) {
  .about-founder-section {
    width: calc(100% - 20px);
    padding: 0 10px;
    margin-bottom: 70px;
  }
  .about-founder-photo {
    height: 300px;
    border-radius: 18px;
  }
  .about-founder-tag {
    margin: -24px 14px 0;
    padding: 12px 16px;
  }
  .about-founder-heading {
    font-size: 1.7rem;
  }
  .about-founder-achievements {
    padding: 20px;
  }
}
</style>

<!-- Our Team -->
<section class="about-team">
  <div class="team-container">
    <div class="team-header">
      <div class="team-badge">
        <span class="team-diamond">◆</span>
        <span class="team-badge-text fade-left">OUR TEAM</span>
      </div>
      <h2 class="team-title fade-right">The People Behind Our Success</h2>
    </div>

    <?php 
      $group_photo = get_field('group_photo');
      if ($group_photo) : 
        $group_photo_url = is_array($group_photo) ? $group_photo['url'] : $group_photo;
        $group_photo_alt = is_array($group_photo) && !empty($group_photo['alt']) ? $group_photo['alt'] : 'Our Team Group Photo';
    ?>
      <div class="team-photo-wrapper">
        <img src="<?php echo esc_url($group_photo_url); ?>" alt="<?php echo esc_attr($group_photo_alt); ?>" class="team-group-photo fade-up" />
      </div>
    <?php endif; ?>
  </div>
</section>

<style>
/* Our Team Section Styling */
.about-team {
  position: relative;
  width: calc(100% - 40px);
  margin: 0 auto 80px;
  padding: 60px 40px;
  background-color: #0f141c;
  border-radius: 36px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: #ffffff;
  box-sizing: border-box;
}

.team-container {
  width: 100%;
  margin: 0 auto;
}

.team-header {
  text-align: center;
  max-width: 720px;
  margin: 0 auto 36px;
}

.team-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.team-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.team-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.team-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #ffffff;
  margin: 0;
}

/* Expanded Photo Wrapper with Background Removed */
.team-photo-wrapper {
  max-width: 1100px;
  margin: 0 auto;
  background: transparent;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.team-group-photo {
  width: 100%;
  max-height: 600px;
  object-fit: cover;
  display: block;
  border-radius: 24px;
}

@media (max-width: 1024px) {
  .team-title {
    font-size: 3rem;
  }
  .team-photo-wrapper {
    max-width: 100%;
  }
  .team-group-photo {
    max-height: 480px;
  }
}

@media (max-width: 640px) {
  .about-team {
    padding: 40px 20px;
    border-radius: 24px;
    margin-bottom: 50px;
  }
  .team-title {
    font-size: 1.8rem;
  }
  .team-group-photo {
    max-height: 340px;
  }
}
</style>

<!-- Our Purpose + Mission/Vision -->
<?php $purpose = get_field('about_purpose'); $mission = get_field('mission_section'); $vision = get_field('vision_section'); ?>
<section class="about-purpose-section">
  <div class="about-purpose-container">

    <div class="about-purpose-media">
      <div class="about-purpose-badge">
        <span class="about-purpose-diamond">◆</span>
        <span class="about-purpose-badge-text"><?php echo esc_html( $purpose['badge'] ?: 'Our Purpose' ); ?></span>
      </div>
      <h2 class="about-purpose-heading fade-right"><?php echo esc_html( $purpose['heading'] ); ?></h2>
      <?php if ( ! empty( $purpose['image'] ) ) : ?>
        <img src="<?php echo esc_url( $purpose['image'] ); ?>" alt="<?php echo esc_attr( $purpose['heading'] ); ?>" class="about-purpose-img fade-left" />
      <?php endif; ?>
    </div>

    <div class="about-purpose-content">
      <?php if ( ! empty( $purpose['intro_text'] ) ) : ?>
        <p class="about-purpose-intro"><?php echo esc_html( $purpose['intro_text'] ); ?></p>
      <?php endif; ?>

      <?php if ( ! empty( $purpose['button_text'] ) ) : ?>
        <a href="<?php echo esc_url( $purpose['button_link'] ?: '#' ); ?>" class="about-purpose-btn"><?php echo esc_html( $purpose['button_text'] ); ?></a>
      <?php endif; ?>

      <div class="about-purpose-cards">
        <?php if ( ! empty( $mission['title'] ) ) : ?>
          <div class="about-purpose-card">
            <span class="about-purpose-card-icon"><?php echo esc_html( $mission['icon'] ?: '🎯' ); ?></span>
            <div class="about-purpose-card-body">
              <h3 class="about-purpose-card-title"><?php echo esc_html( $mission['title'] ); ?></h3>
              <p class="about-purpose-card-text"><?php echo esc_html( $mission['description'] ); ?></p>
            </div>
          </div>
        <?php endif; ?>

        <?php if ( ! empty( $vision['title'] ) ) : ?>
          <div class="about-purpose-card">
            <span class="about-purpose-card-icon"><?php echo esc_html( $vision['icon'] ?: '💡' ); ?></span>
            <div class="about-purpose-card-body">
              <h3 class="about-purpose-card-title"><?php echo esc_html( $vision['title'] ); ?></h3>
              <p class="about-purpose-card-text"><?php echo esc_html( $vision['description'] ); ?></p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>

<style>
.about-purpose-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 100px;
  padding: 0 80px;
  box-sizing: border-box;
}

.about-purpose-container {
  display: flex;
  gap: 60px;
  align-items: flex-start;
}

.about-purpose-media,
.about-purpose-content {
  flex: 0 0 calc(50% - 30px);
}

.about-purpose-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.about-purpose-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.about-purpose-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.about-purpose-heading {
  font-size: 2.4rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.6px;
  color: #0d0d0d;
  margin: 0 0 28px 0;
}

.about-purpose-img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  border-radius: 24px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
  display: block;
}

.about-purpose-intro {
  font-size: 1.1rem;
  line-height: 1.7;
  color: #555555;
  margin: 0 0 28px 0;
}

.about-purpose-btn {
  display: inline-block;
  padding: 14px 30px;
  background-color: #1ba3b0;
  color: #ffffff;
  font-weight: 700;
  font-size: 0.98rem;
  border-radius: 50px;
  text-decoration: none;
  margin-bottom: 40px;
  transition: background-color 0.3s ease;
}

.about-purpose-btn:hover {
  background-color: #158a95;
}

.about-purpose-cards {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.about-purpose-card {
  display: flex;
  gap: 18px;
  padding: 26px;
  background-color: #f7f9fa;
  border: 1px solid #eef0f2;
  border-radius: 20px;
}

.about-purpose-card-icon {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background-color: rgba(27, 163, 176, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
}

.about-purpose-card-title {
  font-size: 1.15rem;
  font-weight: 700;
  color: #0d0d0d;
  margin: 0 0 6px 0;
}

.about-purpose-card-text {
  font-size: 0.98rem;
  line-height: 1.6;
  color: #666666;
  margin: 0;
}

@media (max-width: 1200px) {
  .about-purpose-section {
    padding: 0 40px;
  }
}

@media (max-width: 991px) {
  .about-purpose-container {
    flex-direction: column;
    gap: 40px;
  }
  .about-purpose-media,
  .about-purpose-content {
    flex: 0 0 100%;
  }
  .about-purpose-heading {
    font-size: 2rem;
  }
}

@media (max-width: 640px) {
  .about-purpose-section {
    width: calc(100% - 20px);
    padding: 0 10px;
    margin-bottom: 70px;
  }
  .about-purpose-heading {
    font-size: 1.7rem;
  }
  .about-purpose-img {
    height: 280px;
  }
  .about-purpose-card {
    padding: 20px;
  }
}
</style>

<!-- Why Choose Us -->
<?php $why = get_field('about_why_choose'); $why_features = array_filter( array( $why['feature_1'], $why['feature_2'], $why['feature_3'], $why['feature_4'] ), function ( $f ) { return ! empty( $f['title'] ); } ); ?>
<section class="about-why-section">
  <div class="about-why-container">

    <div class="about-why-media">
      <div class="about-why-badge">
        <span class="about-why-diamond">◆</span>
        <span class="about-why-badge-text"><?php echo esc_html( $why['badge'] ?: 'Why Choose Us' ); ?></span>
      </div>
      <h2 class="about-why-heading fade-right"><?php echo esc_html( $why['heading'] ); ?></h2>
      <?php if ( ! empty( $why['description'] ) ) : ?>
        <p class="about-why-desc fade-left"><?php echo esc_html( $why['description'] ); ?></p>
      <?php endif; ?>
      <?php if ( ! empty( $why['image'] ) ) : ?>
        <img src="<?php echo esc_url( $why['image'] ); ?>" alt="<?php echo esc_attr( $why['heading'] ); ?>" class="about-why-img" />
      <?php endif; ?>
    </div>

    <div class="about-why-grid">
      <?php foreach ( $why_features as $feature ) : ?>
        <div class="about-why-card">
          <span class="about-why-card-icon"><?php echo esc_html( $feature['icon'] ); ?></span>
          <h3 class="about-why-card-title"><?php echo esc_html( $feature['title'] ); ?></h3>
          <p class="about-why-card-text"><?php echo esc_html( $feature['description'] ); ?></p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

</section>

<?php if ( ! empty( $why['cta_text'] ) ) : ?>
<!-- CTA Banner - matches Our Process page CTA card exactly -->
<section class="about-why-cta-section">
  <div class="about-why-cta-container">
    <div class="about-why-cta-card">
      <?php if ( ! empty( $why['cta_image'] ) ) : ?>
        <img src="<?php echo esc_url( $why['cta_image'] ); ?>" alt="Call To Action Background" class="about-why-cta-bg" />
      <?php endif; ?>
      <div class="about-why-cta-overlay"></div>

      <div class="about-why-cta-content">
        <h2 class="about-why-cta-title fade-right"><?php echo esc_html( $why['cta_text'] ); ?></h2>
        <?php if ( ! empty( $why['cta_link_text'] ) ) : ?>
          <a href="<?php echo esc_url( $why['cta_link'] ?: '#' ); ?>" class="about-why-cta-btn fade-left"><?php echo esc_html( $why['cta_link_text'] ); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<style>
.about-why-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 0 auto 100px;
  padding: 0 80px;
  box-sizing: border-box;
}

.about-why-container {
  display: flex;
  gap: 60px;
  align-items: flex-start;
  margin-bottom: 50px;
}

.about-why-media,
.about-why-grid {
  flex: 0 0 calc(50% - 30px);
}

.about-why-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.about-why-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.about-why-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.about-why-heading {
  font-size: 2.4rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.6px;
  color: #0d0d0d;
  margin: 0 0 20px 0;
}

.about-why-desc {
  font-size: 1.05rem;
  line-height: 1.7;
  color: #666666;
  margin: 0 0 28px 0;
}

.about-why-img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  border-radius: 24px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
  display: block;
}

.about-why-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  border: 1px solid #e6e9ec;
  border-radius: 24px;
  overflow: hidden;
}

.about-why-card {
  padding: 32px 26px;
  border-right: 1px solid #e6e9ec;
  border-bottom: 1px solid #e6e9ec;
}

.about-why-card:nth-child(2n) {
  border-right: none;
}

.about-why-card:nth-last-child(-n+2) {
  border-bottom: none;
}

.about-why-card-icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background-color: rgba(27, 163, 176, 0.12);
  font-size: 1.3rem;
  margin-bottom: 16px;
}

.about-why-card-title {
  font-size: 1.05rem;
  font-weight: 700;
  color: #0d0d0d;
  margin: 0 0 8px 0;
}

.about-why-card-text {
  font-size: 0.92rem;
  line-height: 1.6;
  color: #666666;
  margin: 0;
}

.about-why-cta-section {
  width: 100%;
  padding: 0 80px 80px;
  box-sizing: border-box;
}

.about-why-cta-container {
  width: 100%;
  margin: 0 auto;
}

.about-why-cta-card {
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

.about-why-cta-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 0;
}

.about-why-cta-overlay {
  position: absolute;
  inset: 0;
  background: rgba(10, 8, 20, 0.75);
  z-index: 1;
}

.about-why-cta-content {
  position: relative;
  z-index: 2;
  max-width: 900px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.about-why-cta-title {
  color: #ffffff;
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -1px;
  margin: 0 0 32px 0;
}

.about-why-cta-btn {
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

.about-why-cta-btn:hover {
  background-color: #1ba3b0;
  color: #ffffff;
  transform: translateY(-2px);
}

@media (max-width: 1200px) {
  .about-why-section {
    padding: 0 40px;
  }
  .about-why-cta-section {
    padding-left: 40px;
    padding-right: 40px;
  }
}

@media (max-width: 900px) {
  .about-why-cta-card {
    padding: 60px 30px;
  }
  .about-why-cta-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 991px) {
  .about-why-container {
    flex-direction: column;
    gap: 40px;
  }
  .about-why-media,
  .about-why-grid {
    flex: 0 0 100%;
  }
  .about-why-heading {
    font-size: 2rem;
  }
}

@media (max-width: 640px) {
  .about-why-section {
    width: calc(100% - 20px);
    padding: 0 10px;
    margin-bottom: 70px;
  }
  .about-why-heading {
    font-size: 1.7rem;
  }
  .about-why-img {
    height: 240px;
  }
  .about-why-grid {
    grid-template-columns: 1fr;
  }
  .about-why-card {
    border-right: none !important;
    border-bottom: 1px solid #e6e9ec !important;
  }
  .about-why-card:last-child {
    border-bottom: none !important;
  }
  .about-why-cta-section {
    padding-left: 20px;
    padding-right: 20px;
  }
  .about-why-cta-card {
    padding: 44px 24px;
    border-radius: 16px;
  }
  .about-why-cta-title {
    font-size: 1.6rem;
  }
}
</style>

<?php get_footer(); ?>
