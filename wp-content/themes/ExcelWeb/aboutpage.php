<?php /* Template Name: aboutpage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>

<!-- Hero Banner -->
<section class="about-hero-banner">
  <!-- Background Image -->
  <img 
    src="<?php echo get_field('about_banner')['banner_image']; ?>" 
    alt="About Page Banner" 
    class="about-hero-bg-img"
  />

  <!-- Dark Overlay -->
  <div class="about-hero-overlay"></div>

  <!-- Content Container -->
  <div class="about-hero-container">
    <div class="about-hero-content">
      <div class="about-hero-badge">
        <span class="about-hero-diamond">◆</span>
        <span class="about-hero-badge-text fade-left"><?php echo get_field('about_banner')['subtitle']; ?></span>
      </div>
      <h1 class="about-hero-title fade-right">
        <?php echo get_field('about_banner')['title']; ?>
      </h1>
      <p class="about-hero-subtext fade-left">
        <?php echo get_field('about_banner')['content']; ?>
      </p>
    </div>
  </div>
</section>

<style>
/* About Hero Container */
.about-hero-banner {
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

/* Dark Gradient Overlay */
.about-hero-overlay {
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
.about-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 60px 80px;
  box-sizing: border-box;
}

.about-hero-content {
  max-width: 820px;
}

/* Diamond Badge */
.about-hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.about-hero-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
  line-height: 1;
}

.about-hero-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #ffffff;
  letter-spacing: 0.5px;
}

/* Headings & Text */
.about-hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin-bottom: 20px;
}

.about-hero-subtext {
  font-size: 1.05rem;
  line-height: 1.5;
  color: rgba(255, 255, 255, 0.9);
  max-width: 680px;
  margin: 0;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .about-hero-container {
    padding: 50px 40px;
  }
  .about-hero-title {
    font-size: 2.3rem;
  }
}

@media (max-width: 900px) {
  .about-hero-banner {
    min-height: 400px;
  }
  .about-hero-container {
    padding: 40px 30px;
  }
  .about-hero-title {
    font-size: 2rem;
  }
  .about-hero-subtext {
    font-size: 0.95rem;
  }
}

@media (max-width: 640px) {
  .about-hero-container {
    padding: 30px 20px;
  }
  .about-hero-title {
    font-size: 1.8rem;
  }
}
</style>

<!-- Who We Are -->
<section class="about-who-we-are">
  <div class="who-we-are-container">
    
    <!-- Left Column: Sticky Section Branding & Heading -->
    <div class="who-we-are-left">
      <div class="who-we-are-badge">
        <span class="who-we-are-diamond">◆</span>
        <span class="who-we-are-badge-text fade-left">
          <?php echo get_field('who_we_are')['subtitle'] ?: 'WHO WE ARE'; ?>
        </span>
      </div>
      <h2 class="who-we-are-title fade-right">
        <?php echo get_field('who_we_are')['heading'] ?: 'Driven by Innovation, Defined by Results.'; ?>
      </h2>
    </div>

    <!-- Right Column: Narrative Content & Key Pillars -->
    <div class="who-we-are-right">
      <div class="who-we-are-description fade-left">
        <?php echo get_field('who_we_are')['description']; ?>
      </div>

      <!-- Feature Grid / Key Highlights -->
      <div class="who-we-are-pillars">
          <div class="pillar-card">
            <div class="pillar-icon-box">
              <span class="pillar-icon">◆</span>
            </div>
            <div class="pillar-content">
              <h3 class="pillar-title fade-left"><?php echo get_field('who_we_are')['card_1']['title']; ?></h3>
              <p class="pillar-text fade-right"><?php echo get_field('who_we_are')['card_1']['content']; ?></p>
            </div>
          </div>

          <div class="pillar-card">
            <div class="pillar-icon-box">
              <span class="pillar-icon">◆</span>
            </div>
            <div class="pillar-content">
              <h3 class="pillar-title fade-left"><?php echo get_field('who_we_are')['card_2']['title']; ?></h3>
              <p class="pillar-text fade-right"><?php echo get_field('who_we_are')['card_2']['content']; ?></p>
            </div>
          </div>
      </div>
    </div>

  </div>
</section>

<style>
/* Base Section Layout */
.about-who-we-are {
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

.who-we-are-container {
  display: flex;
  gap: 60px;
  justify-content: space-between;
  align-items: flex-start;
}

/* Left Column Styling */
.who-we-are-left {
  flex: 0 0 42%;
  position: sticky;
  top: 100px;
}

.who-we-are-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.who-we-are-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.who-we-are-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.who-we-are-title {
  font-size: 2.1rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #ffffff;
  margin: 0;
}

/* Right Column Styling */
.who-we-are-right {
  flex: 0 0 52%;
}

.who-we-are-description {
  font-size: 1rem;
  line-height: 1.7;
  color: rgba(255, 255, 255, 0.85);
  margin-bottom: 40px;
}

.who-we-are-description p {
  margin-top: 0;
  margin-bottom: 20px;
}

.who-we-are-description p:last-child {
  margin-bottom: 0;
}

/* Feature Cards Grid */
.who-we-are-pillars {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.pillar-card {
  display: flex;
  gap: 20px;
  padding: 24px;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 20px;
  transition: all 0.3s ease;
}

.pillar-card:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(27, 163, 176, 0.4);
  transform: translateY(-2px);
}

.pillar-icon-box {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: rgba(27, 163, 176, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.pillar-icon {
  color: #1ba3b0;
  font-size: 1.1rem;
}

.pillar-title {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 0 0 8px 0;
  color: #ffffff;
}

.pillar-text {
  font-size: 0.98rem;
  line-height: 1.55;
  color: rgba(255, 255, 255, 0.7);
  margin: 0;
}

/* Responsive Media Queries */
@media (max-width: 1024px) {
  .who-we-are-container {
    flex-direction: column;
    gap: 40px;
  }

  .who-we-are-left {
    flex: 0 0 100%;
    position: static;
  }

  .who-we-are-right {
    flex: 0 0 100%;
  }

  .who-we-are-title {
    font-size: 1.9rem;
  }
}

@media (max-width: 640px) {
  .about-who-we-are {
    padding: 40px 20px;
    border-radius: 24px;
    margin-bottom: 50px;
  }

  .who-we-are-title {
    font-size: 1.7rem;
  }

  .who-we-are-description {
    font-size: 0.95rem;
  }

  .pillar-card {
    padding: 18px;
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
  font-size: 2.1rem;
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
    font-size: 1.9rem;
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
    font-size: 1.65rem;
  }
  .team-group-photo {
    max-height: 340px;
  }
}
</style>

<!-- Our CEO, Founder & Creative Visionary -->
<section class="about-ceo">
  <div class="ceo-container">
    
    <?php $owner = get_field('owner'); ?>

    <!-- CEO Image (Left) -->
    <div class="ceo-image-wrapper">
      <?php 
        $owner_img = isset($owner['image']) ? $owner['image'] : null;
        if ($owner_img) : 
          $owner_img_url = is_array($owner_img) ? $owner_img['url'] : $owner_img;
          $owner_img_alt = is_array($owner_img) && !empty($owner_img['alt']) ? $owner_img['alt'] : 'CEO & Founder Photo';
      ?>
        <img src="<?php echo esc_url($owner_img_url); ?>" alt="<?php echo esc_attr($owner_img_alt); ?>" class="ceo-image fade-up" />
      <?php else : ?>
        <img src="https://via.placeholder.com/600x700" alt="CEO & Founder Photo" class="ceo-image fade-left" />
      <?php endif; ?>
    </div>

    <!-- CEO Info Content (Right) -->
    <div class="ceo-content">
      <div class="ceo-badge">
        <span class="ceo-diamond">◆</span>
        <span class="ceo-badge-text fade-left">LEADERSHIP</span>
      </div>

      <h2 class="ceo-main-heading fade-right">Our CEO, Founder &amp; Creative Visionary</h2>

      <?php if (!empty($owner['title'])) : ?>
        <h3 class="ceo-title fade-left"><?php echo esc_html($owner['title']); ?></h3>
      <?php endif; ?>

      <?php if (!empty($owner['content'])) : ?>
        <div class="ceo-bio fade-right">
          <?php echo wp_kses_post($owner['content']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($owner['achievements'])) : ?>
        <div class="ceo-achievements-wrapper">
          <h4 class="ceo-achievements-heading fade-left">Key Achievements &amp; Milestones</h4>
          <div class="ceo-achievements-content fade-right">
            <?php echo $owner['achievements']; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

<style>
/* CEO Section Styling */
.about-ceo {
  position: relative;
  width: calc(100% - 40px);
  margin: 0 auto 90px;
  padding: 60px 40px;
  background-color: #ffffff;
  color: #111111;
  box-sizing: border-box;
}

.ceo-container {
  width: 100%;
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 60px;
}

/* Image Column */
.ceo-image-wrapper {
  flex: 0 0 42%;
  position: sticky;
  top: 100px;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.ceo-image {
  width: 100%;
  height: 100%;
  min-height: 480px;
  max-height: 600px;
  object-fit: cover;
  object-position: center;
  display: block;
}

/* Text Content Column */
.ceo-content {
  flex: 0 0 52%;
}

.ceo-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.ceo-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.ceo-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.ceo-main-heading {
  font-size: 2.8rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #111111;
  margin: 0 0 8px 0;
}

.ceo-title {
  font-size: 1.35rem;
  font-weight: 700;
  color: #1ba3b0;
  margin: 0 0 24px 0;
}

.ceo-bio {
  font-size: 1.15rem;
  line-height: 1.7;
  color: #444444;
  margin-bottom: 32px;
}

.ceo-bio p {
  margin-top: 0;
  margin-bottom: 16px;
}

/* Achievements Box Styling */
.ceo-achievements-wrapper {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  border-left: 4px solid #1ba3b0;
  padding: 28px;
  border-radius: 16px;
}

.ceo-achievements-heading {
  font-size: 1.25rem;
  font-weight: 800;
  color: #111111;
  margin: 0 0 16px 0;
}

.ceo-achievements-content {
  font-size: 1.05rem;
  line-height: 1.65;
  color: #333333;
}

.ceo-achievements-content p {
  margin-top: 0;
  margin-bottom: 12px;
}

.ceo-achievements-content ul,
.ceo-achievements-content ol {
  margin: 0 0 12px 20px;
  padding: 0;
}

.ceo-achievements-content li {
  margin-bottom: 8px;
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .ceo-container {
    flex-direction: column;
    gap: 40px;
  }

  .ceo-image-wrapper,
  .ceo-content {
    flex: 0 0 100%;
    position: static;
  }

  .ceo-main-heading {
    font-size: 2.3rem;
  }

  .ceo-image {
    min-height: 380px;
  }
}

@media (max-width: 640px) {
  .about-ceo {
    padding: 40px 20px;
    margin-bottom: 50px;
  }

  .ceo-main-heading {
    font-size: 1.85rem;
  }

  .ceo-bio {
    font-size: 1.05rem;
  }

  .ceo-achievements-wrapper {
    padding: 20px;
  }
}
</style>

<!-- Our Mission -->
<section class="about-mission">
  <div class="mission-container">
    
    <!-- Content Column (Left) -->
    <div class="mission-content">
      <div class="mission-badge">
        <span class="mission-diamond">◆</span>
        <span class="mission-badge-text fade-left">
          <?php echo get_field('mission_section')['subtitle'] ?: 'OUR MISSION'; ?>
        </span>
      </div>

      <h2 class="mission-title fade-right">
        <?php echo get_field('mission_section')['heading'] ?: 'Empowering Growth Through Cutting-Edge Engineering'; ?>
      </h2>

      <div class="mission-description">
        <?php echo get_field('mission_section')['description']; ?>
      </div>

      <!-- Key Bullet Points / Value Highlights -->
      <div class="mission-highlights">
          <div class="mission-item">
            <span class="mission-item-icon">◆</span>
            <span class="mission-item-text fade-left">Delivering secure, resilient, and scalable backend infrastructure.</span>
          </div>
          <div class="mission-item">
            <span class="mission-item-icon">◆</span>
            <span class="mission-item-text fade-right">Transforming complex technical ideas into intuitive user experiences.</span>
          </div>
          <div class="mission-item">
            <span class="mission-item-icon">◆</span>
            <span class="mission-item-text fade-left">Ensuring long-term stability and continuous performance optimization.</span>
          </div>
      </div>
    </div>

    <!-- Image Column (Right) -->
    <div class="mission-image-wrapper">
      <?php 
        $mission_img = get_field('mission_section')['image'];
        if ($mission_img): 
      ?>
        <img src="<?php echo esc_url($mission_img['url']); ?>" alt="<?php echo esc_attr($mission_img['alt']); ?>" class="mission-image fade-left" />
      <?php else: ?>
        <img src="https://via.placeholder.com/600x700" alt="Our Mission Image" class="mission-image" />
      <?php endif; ?>
    </div>

  </div>
</section>

<style>
/* Base Section Styling */
.about-mission {
  position: relative;
  width: calc(100% - 40px);
  margin: 0 auto 80px;
  padding: 60px 40px;
  background-color: #ffffff;
  color: #111111;
  box-sizing: border-box;
}

.mission-container {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 60px;
}

/* Left Column: Text & Content */
.mission-content {
  flex: 0 0 50%;
}

.mission-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.mission-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.mission-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.mission-title {
  font-size: 2.1rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #111111;
  margin: 0 0 24px 0;
}

.mission-description {
  font-size: 1rem;
  line-height: 1.7;
  color: #444444;
  margin-bottom: 32px;
}

.mission-description p {
  margin-top: 0;
  margin-bottom: 16px;
}

/* Bullet Point Highlights */
.mission-highlights {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.mission-item {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}

.mission-item-icon {
  color: #1ba3b0;
  font-size: 0.9rem;
  margin-top: 4px;
  flex-shrink: 0;
}

.mission-item-text {
  font-size: 1.05rem;
  font-weight: 600;
  color: #222222;
  line-height: 1.5;
}

/* Right Column: Image */
.mission-image-wrapper {
  flex: 0 0 45%;
  position: relative;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.mission-image {
  width: 100%;
  height: 100%;
  min-height: 480px;
  max-height: 560px;
  object-fit: cover;
  object-position: center;
  display: block;
  border-radius: 28px;
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .mission-container {
    flex-direction: column;
    gap: 40px;
  }

  .mission-content,
  .mission-image-wrapper {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .mission-title {
    font-size: 1.9rem;
  }

  .mission-image {
    min-height: 380px;
  }
}

@media (max-width: 640px) {
  .about-mission {
    padding: 40px 20px;
    margin-bottom: 50px;
  }

  .mission-title {
    font-size: 1.65rem;
  }

  .mission-description {
    font-size: 0.95rem;
  }

  .mission-image {
    min-height: 300px;
  }
}
</style>

<!-- Our Vision -->
<section class="about-vision">
  <div class="vision-container">
    
    <!-- Image Column (Left) -->
    <div class="vision-image-wrapper">
      <?php 
        $vision_img = get_field('vision_section')['image'];
        if ($vision_img): 
      ?>
        <img src="<?php echo esc_url($vision_img['url']); ?>" alt="<?php echo esc_attr($vision_img['alt']); ?>" class="vision-image fade-right" />
      <?php else: ?>
        <img src="https://via.placeholder.com/600x700" alt="Our Vision Image" class="vision-image" />
      <?php endif; ?>
    </div>

    <!-- Content Column (Right) -->
    <div class="vision-content">
      <div class="vision-badge">
        <span class="vision-diamond">◆</span>
        <span class="vision-badge-text fade-left">
          <?php echo get_field('vision_section')['subtitle'] ?: 'OUR VISION'; ?>
        </span>
      </div>

      <h2 class="vision-title fade-right">
        <?php echo get_field('vision_section')['heading'] ?: 'Shaping the Future of Digital Transformation'; ?>
      </h2>

      <div class="vision-description">
        <?php echo get_field('vision_section')['description']; ?>
      </div>

      <!-- Key Bullet Points / Value Highlights -->
      <div class="vision-highlights">
        <div class="vision-item">
          <span class="vision-item-icon">◆</span>
          <span class="vision-item-text fade-left"> <?php echo get_field('vision_section')['card_1']; ?></span>
        </div>
        <div class="vision-item">
          <span class="vision-item-icon">◆</span>
          <span class="vision-item-text fade-right"> <?php echo get_field('vision_section')['card_2']; ?></span>
        </div>
        <div class="vision-item">
          <span class="vision-item-icon">◆</span>
          <span class="vision-item-text fade-left"> <?php echo get_field('vision_section')['card_3']; ?></span>
        </div>
      </div>
    </div>

  </div>
</section>

<style>
/* Base Section Styling */
.about-vision {
  position: relative;
  width: calc(100% - 40px);
  margin: 0 auto 80px;
  padding: 60px 40px;
  background-color: #ffffff;
  color: #111111;
  box-sizing: border-box;
}

.vision-container {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 60px;
}

/* Left Column: Image */
.vision-image-wrapper {
  flex: 0 0 45%;
  position: relative;
  border-radius: 28px;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
}

.vision-image {
  width: 100%;
  height: 100%;
  min-height: 480px;
  max-height: 560px;
  object-fit: cover;
  object-position: center;
  display: block;
  border-radius: 28px;
}

/* Right Column: Text & Content */
.vision-content {
  flex: 0 0 50%;
}

.vision-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.vision-diamond {
  color: #1ba3b0;
  font-size: 1rem;
  line-height: 1;
}

.vision-badge-text {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.vision-title {
  font-size: 2.1rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.8px;
  color: #111111;
  margin: 0 0 24px 0;
}

.vision-description {
  font-size: 1rem;
  line-height: 1.7;
  color: #444444;
  margin-bottom: 32px;
}

.vision-description p {
  margin-top: 0;
  margin-bottom: 16px;
}

/* Bullet Point Highlights */
.vision-highlights {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.vision-item {
  display: flex;
  align-items: flex-start;
  gap: 14px;
}

.vision-item-icon {
  color: #1ba3b0;
  font-size: 0.9rem;
  margin-top: 4px;
  flex-shrink: 0;
}

.vision-item-text {
  font-size: 1.05rem;
  font-weight: 600;
  color: #222222;
  line-height: 1.5;
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .vision-container {
    flex-direction: column-reverse;
    gap: 40px;
  }

  .vision-content,
  .vision-image-wrapper {
    flex: 0 0 100%;
    max-width: 100%;
  }

  .vision-title {
    font-size: 1.9rem;
  }

  .vision-image {
    min-height: 380px;
  }
}

@media (max-width: 640px) {
  .about-vision {
    padding: 40px 20px;
    margin-bottom: 50px;
  }

  .vision-title {
    font-size: 1.65rem;
  }

  .vision-description {
    font-size: 0.95rem;
  }

  .vision-image {
    min-height: 300px;
  }
}
</style>

<?php get_footer(); ?>