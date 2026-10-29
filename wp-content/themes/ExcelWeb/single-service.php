 <?php get_header(); ?>


    
<!-- Section 1: Banner -->
<?php
  $hero_service_id  = get_queried_object_id();
  $hero_banner_id   = (int) get_post_meta( $hero_service_id, 'service_banner_image', true );
  $hero_banner_url  = $hero_banner_id
    ? wp_get_attachment_url( $hero_banner_id )
    : ( has_post_thumbnail( $hero_service_id ) ? get_the_post_thumbnail_url( $hero_service_id, 'full' ) : get_template_directory_uri() . '/assets/images/services-banner.jpg' );
?>
<section class="service-hero-banner">
  <img src="<?php echo esc_url( $hero_banner_url ); ?>" alt="<?php echo esc_attr( get_the_title( $hero_service_id ) ); ?>" class="service-hero-bg-img" />
  <div class="service-hero-overlay"></div>
  <div class="service-hero-container">
    <div class="service-hero-content">
      <p class="service-hero-title fade-right"><?php echo esc_html( get_the_title( $hero_service_id ) ); ?></p>
    </div>
  </div>
</section>

<style>
.service-hero-banner {
  position: relative;
  width: calc(100% - 40px);
  max-width: 100%;
  min-height: 340px;
  margin: 20px auto 60px;
  border-radius: 36px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  box-sizing: border-box;
}

.service-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.service-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.service-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 50px 40px;
  box-sizing: border-box;
  text-align: center;
}

.service-hero-content {
  max-width: 760px;
  margin: 0 auto;
}

.service-hero-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.1;
  letter-spacing: -1.2px;
  margin: 0;
  color: #ffffff;
}

@media (max-width: 900px) {
  .service-hero-banner {
    min-height: 280px;
  }
  .service-hero-container {
    padding: 30px 24px;
  }
  .service-hero-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 640px) {
  .service-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .service-hero-title {
    font-size: 1.85rem;
  }
}
</style>






<section class="single-post-section">
  <div class="single-post-container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      $current_service_id = get_the_ID();
      $current_post        = get_post( $current_service_id );
      $is_pillar            = ( 0 === (int) $current_post->post_parent );
    ?>

    <?php
      $related_ids  = $is_pillar ? $current_service_id : $current_post->post_parent;
      $related_query = new WP_Query( array(
        'post_type'      => 'service',
        'post_parent'    => $related_ids,
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'post__not_in'   => array( $current_service_id ),
      ) );
    ?>

    <div class="services-detail-layout">

      <div class="services-detail-col">
        <article class="single-post-wrapper">

          <header class="single-post-header">
            <div class="single-post-badge">
              <span class="single-post-diamond">◆</span>
              <span class="single-post-badge-text fade-left">Our Services</span>
            </div>

            <?php if ( ! $is_pillar ) : ?>
              <p class="single-post-breadcrumb">
                <a href="<?php echo esc_url( get_permalink( $current_post->post_parent ) ); ?>">&larr; <?php echo esc_html( get_the_title( $current_post->post_parent ) ); ?></a>
              </p>
            <?php endif; ?>

            <h1 class="single-post-title fade-right"><?php echo esc_html( mytheme_service_seo( 'heading' ) ? mytheme_service_seo( 'heading' ) : get_the_title() ); ?></h1>
          </header>

          <div class="services-detail-content animate-fade fade-left">
            <?php the_content(); ?>
          </div>

          <?php $faq_items = mytheme_service_faq_items( $current_service_id ); ?>
          <?php if ( ! empty( $faq_items ) ) : ?>
            <div class="services-detail-faq">
              <h2 class="services-detail-faq-title"><?php echo esc_html( mytheme_service_seo( 'faq_heading' ) ? mytheme_service_seo( 'faq_heading' ) : 'Frequently Asked Questions' ); ?></h2>
              <?php foreach ( $faq_items as $item ) : ?>
                <details class="services-detail-faq-item">
                  <summary class="services-detail-faq-question">
                    <h3 class="services-detail-faq-q"><?php echo esc_html( $item['question'] ); ?></h3>
                    <span class="services-detail-faq-icon">+</span>
                  </summary>
                  <div class="services-detail-faq-answer">
                    <?php echo wp_kses_post( wpautop( $item['answer'] ) ); ?>
                  </div>
                </details>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </article>
      </div>

      <?php if ( $related_query->have_posts() ) : ?>
        <aside class="related-sidebar-col">
          <div class="related-sidebar-badge">
            <span class="related-diamond">◆</span>
            <span class="related-badge-text">Related Services</span>
          </div>
          <ul class="related-sidebar-list">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </aside>
      <?php endif; ?>

    </div>

    <?php if ( $is_pillar ) :
      $other_pillars_query = new WP_Query( array(
        'post_type'      => 'service',
        'post_parent'    => 0,
        'posts_per_page' => -1,
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
        'post__not_in'   => array( $current_service_id ),
      ) );
    ?>
      <?php if ( $other_pillars_query->have_posts() ) : ?>
        <section class="other-services-section">
          <h2 class="other-services-title">Other Services</h2>
          <div class="other-services-chip-row">
            <?php while ( $other_pillars_query->have_posts() ) : $other_pillars_query->the_post(); ?>
              <a href="<?php the_permalink(); ?>" class="other-service-chip"><?php the_title(); ?></a>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
          <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="other-services-viewall">View All Services &rarr;</a>
        </section>
      <?php endif; ?>
    <?php endif; ?>

    <?php
      $service_cta_whatsapp = get_theme_mod( 'footer_whatsapp' );
      $service_cta_wa_link  = $service_cta_whatsapp ? preg_replace( '/\D+/', '', $service_cta_whatsapp ) : '';
      $service_cta_title    = mytheme_service_seo( 'cta_title' );
      $service_cta_text     = mytheme_service_seo( 'cta_text' );
    ?>
    <section class="service-cta-section">
      <div class="service-cta-card">
        <h2 class="service-cta-title"><?php echo $service_cta_title ? esc_html( $service_cta_title ) : 'Ready to get started with ' . esc_html( get_the_title() ) . '?'; ?></h2>
        <p class="service-cta-subtitle"><?php echo esc_html( $service_cta_text ? $service_cta_text : 'Get a free quote from Excel Graphics, Kollam.' ); ?></p>
        <div class="service-cta-actions">
          <?php if ( $service_cta_wa_link ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( $service_cta_wa_link ); ?>?text=<?php echo urlencode( 'Hello, I would like to know more about ' . get_the_title() . '.' ); ?>" target="_blank" rel="noopener" class="service-cta-btn">WhatsApp Now</a>
          <?php endif; ?>
          <?php if ( $service_cta_title ) : ?>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="service-cta-btn service-cta-btn-ghost">Get a Quote</a>
          <?php elseif ( ! $service_cta_wa_link ) : ?>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="service-cta-btn">Get a Quote</a>
          <?php endif; ?>
        </div>
        <?php if ( $service_cta_title && $service_cta_whatsapp ) : ?>
          <p class="service-cta-call">Or call <a href="tel:+<?php echo esc_attr( $service_cta_wa_link ); ?>"><?php echo esc_html( $service_cta_whatsapp ); ?></a></p>
        <?php endif; ?>
      </div>
    </section>

    <?php endwhile; endif; ?>

  </div>
</section>

<style>
/* Single Post Layout - Full Width */
.single-post-section {
  width: calc(100% - 40px);
  max-width: 100%;
  margin: 40px auto 90px;
  padding: 0 40px;
  box-sizing: border-box;
}

.single-post-container {
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
}

.single-post-wrapper {
  width: 100%;
}

.services-detail-layout {
  width: 100%;
  display: flex;
  align-items: flex-start;
  gap: 48px;
}

.services-detail-col {
  flex: 3 1 0;
  min-width: 0;
}

/* Related Services sidebar (col-9 / col-3 style ratio) */
.related-sidebar-col {
  flex: 1 1 0;
  min-width: 260px;
  position: sticky;
  top: 20px;
  background-color: #f8f9fa;
  border-radius: 20px;
  padding: 28px 26px;
}

.related-sidebar-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 18px;
}

.related-sidebar-badge .related-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.related-sidebar-badge .related-badge-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: #111111;
}

.related-sidebar-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.related-sidebar-list li {
  border-bottom: 1px solid #e9ecef;
}

.related-sidebar-list li:last-child {
  border-bottom: none;
}

.related-sidebar-list a {
  display: block;
  padding: 14px 4px;
  font-size: 1.05rem;
  font-weight: bold;
  color: #158590;
  text-decoration: none;
  transition: color 0.3s ease;
}

.related-sidebar-list a:hover {
  color: #14838e;
}

/* Header & Meta */
.single-post-header {
  text-align: left;
  margin-bottom: 40px;
}

.single-post-breadcrumb {
  margin: 0 0 16px 0;
}

.single-post-breadcrumb a {
  font-size: 1rem;
  font-weight: 700;
  color: #1ba3b0;
  text-decoration: none;
}

.single-post-breadcrumb a:hover {
  color: #14838e;
}

.single-post-badge {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.single-post-diamond {
  color: #1ba3b0;
  font-size: 1.2rem;
  line-height: 1;
}

.single-post-badge-text {
  font-size: 1.15rem;
  font-weight: 700;
  color: #111111;
}

.single-post-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  color: #0d0d0d;
  margin: 0 0 24px 0;
}

/* Featured Image */
.services-detail-img {
  width: 100%;
  height: 420px;
  object-fit: cover;
  border-radius: 16px;
  margin-bottom: 28px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

/* Post Content Body */
.services-detail-content {
  width: 100%;
  font-size: 1.2rem;
  line-height: 1.85;
  color: #000000;
  margin-bottom: 60px;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.services-detail-content.visible {
  opacity: 1;
  transform: translateY(0);
}

.services-detail-content p {
  margin-bottom: 24px;
}

.services-detail-content h2, 
.services-detail-content h3, 
.services-detail-content h4 {
  color: #0d0d0d;
  font-weight: 800;
  line-height: 1.25;
  margin: 44px 0 20px 0;
}

.services-detail-content blockquote {
  border-left: 4px solid #1ba3b0;
  background-color: #f8f9fa;
  padding: 28px 36px;
  margin: 40px 0;
  border-radius: 0 16px 16px 0;
  font-size: 1.3rem;
  font-style: italic;
  color: #333333;
}

.services-detail-content img {
  width: 100%;
  max-width: 100%;
  height: auto;
  border-radius: 20px;
  margin: 32px 0;
}

/* Other Services band (pillar pages only) */
.other-services-section {
  margin-top: 50px;
  padding-top: 40px;
  border-top: 1px solid #e9ecef;
  text-align: center;
}

.other-services-title {
  font-size: 1.5rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 24px 0;
}

.other-services-chip-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px;
  margin-bottom: 20px;
}

.other-service-chip {
  background-color: #f4f6f8;
  color: #333333;
  padding: 10px 20px;
  border-radius: 50px;
  font-size: 0.95rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.other-service-chip:hover {
  background-color: #1ba3b0;
  color: #ffffff;
  text-decoration: none;
}

.other-services-viewall {
  display: inline-block;
  font-size: 1rem;
  font-weight: 700;
  color: #1ba3b0;
  text-decoration: none;
}

.other-services-viewall:hover {
  color: #14838e;
}

/* Service CTA band */
.service-cta-section {
  margin-top: 60px;
}

.service-cta-card {
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  border-radius: 24px;
  padding: 60px 40px;
  text-align: center;
  color: #ffffff;
}

.service-cta-title {
  font-size: 2rem;
  font-weight: 800;
  line-height: 1.25;
  margin: 0 0 12px 0;
  color: #ffffff;
}

.service-cta-subtitle {
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 28px 0;
}

.service-cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background-color: #ffffff;
  color: #0d7a85;
  font-size: 1.05rem;
  font-weight: 700;
  padding: 16px 36px;
  border-radius: 50px;
  text-decoration: none;
  transition: transform 0.3s ease;
}

.service-cta-btn:hover {
  transform: translateY(-2px);
  color: #0d7a85;
  text-decoration: none;
}

@media (max-width: 640px) {
  .service-cta-card {
    padding: 44px 24px;
  }
  .service-cta-title {
    font-size: 1.5rem;
  }
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .single-post-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .single-post-title {
    font-size: 2.15rem;
  }
  .services-detail-layout {
    flex-direction: column;
    align-items: stretch; /* flex-start would let wide content (e.g. tables) size the column past the screen */
  }
  .related-sidebar-col {
    flex: 1 1 auto;
    width: 100%;
    position: static;
  }
}

@media (max-width: 640px) {
  .single-post-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .single-post-title {
    font-size: 1.95rem;
  }
}
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".animate-fade");
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, { threshold: 0 }); // 0, not a ratio: long content can be taller than the viewport and never reach e.g. 15% visible

    elements.forEach(el => observer.observe(el));
  });
</script>



<style>
/* Per-Service FAQ Accordion (matches services listing page detail panel) */
.services-detail-faq {
  margin-top: 20px;
  margin-bottom: 60px;
  border-top: 1px solid #e9ecef;
  padding-top: 32px;
}

.services-detail-faq-title {
  font-size: 1.3rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0 0 18px 0;
}

.services-detail-faq-item {
  border: 1px solid #e9ecef;
  border-radius: 12px;
  padding: 4px 20px;
  margin-bottom: 12px;
}

.services-detail-faq-question {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding: 14px 0;
  font-size: 1.05rem;
  font-weight: 700;
  color: #0d0d0d;
  cursor: pointer;
  list-style: none;
}

.services-detail-faq-question::-webkit-details-marker {
  display: none;
}

.services-detail-faq-icon {
  flex-shrink: 0;
  color: #1ba3b0;
  font-size: 1.3rem;
  transition: transform 0.3s ease;
}

.services-detail-faq-item[open] .services-detail-faq-icon {
  transform: rotate(45deg);
}

.services-detail-faq-answer {
  font-size: 1rem;
  line-height: 1.65;
  color: #555555;
  padding-bottom: 16px;
}

.services-detail-faq-answer p {
  margin: 0 0 10px 0;
}

.services-detail-faq-q {
  font-size: inherit;
  font-weight: inherit;
  line-height: 1.4;
  color: inherit;
  margin: 0;
}

/* Closing CTA extras (shown when a custom CTA is set in SEO Settings) */
.service-cta-actions {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 14px;
}

.service-cta-btn-ghost {
  background-color: transparent;
  color: #ffffff;
  box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.85);
}

.service-cta-btn-ghost:hover {
  color: #ffffff;
}

.service-cta-call {
  margin: 22px 0 0 0;
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.9);
}

.service-cta-call a {
  color: #ffffff;
  font-weight: 700;
  text-decoration: underline;
  text-underline-offset: 3px;
}
</style>

<style>
/* SEO content blocks — used inside a service's main content (post editor HTML) */
.services-detail-content a {
  color: #158590;
  font-weight: 600;
  text-underline-offset: 3px;
}

.services-detail-content a:hover {
  color: #0d7a85;
}

.services-detail-content h2 {
  font-size: 2rem;
  letter-spacing: -0.6px;
}

.services-detail-content h3 {
  font-size: 1.35rem;
}

.services-detail-content .seo-lead {
  font-size: 1.3rem;
  line-height: 1.7;
  color: #0d0d0d;
}

/* Trust chips under the intro */
.services-detail-content .seo-trust-row {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  list-style: none;
  margin: 0 0 28px 0;
  padding: 0;
}

.services-detail-content .seo-trust-row li {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background-color: #eaf7f8;
  color: #0d7a85;
  font-size: 0.95rem;
  font-weight: 700;
  line-height: 1.3;
  padding: 9px 16px;
  border-radius: 50px;
}

.services-detail-content .seo-trust-row li::before {
  content: "◆";
  font-size: 0.7rem;
  color: #1ba3b0;
}

/* Inline CTA buttons */
.services-detail-content .seo-cta-row {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 14px;
  margin: 8px 0 40px 0;
}

.services-detail-content .seo-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  color: #ffffff;
  font-size: 1.02rem;
  font-weight: 700;
  line-height: 1.3;
  padding: 15px 30px;
  border-radius: 50px;
  text-decoration: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.services-detail-content .seo-btn:hover {
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 10px 24px rgba(13, 122, 133, 0.25);
}

.services-detail-content .seo-btn-outline {
  background: transparent;
  color: #0d7a85;
  box-shadow: inset 0 0 0 2px #1ba3b0;
}

.services-detail-content .seo-btn-outline:hover {
  color: #0d7a85;
  box-shadow: inset 0 0 0 2px #0d7a85;
}

/* Material comparison table */
.services-detail-content .seo-table-wrap {
  width: 100%;
  overflow-x: auto;
  margin: 8px 0 28px 0;
  border: 1px solid #e9ecef;
  border-radius: 20px;
}

.services-detail-content .seo-table {
  width: 100%;
  min-width: 640px;
  border-collapse: collapse;
  font-size: 1rem;
  line-height: 1.5;
}

.services-detail-content .seo-table th,
.services-detail-content .seo-table td {
  padding: 16px 18px;
  text-align: left;
  vertical-align: top;
  border-bottom: 1px solid #e9ecef;
}

.services-detail-content .seo-table thead th {
  background-color: #0d7a85;
  color: #ffffff;
  font-size: 0.9rem;
  font-weight: 700;
  letter-spacing: 0.3px;
  text-transform: uppercase;
  border-bottom: none;
}

.services-detail-content .seo-table tbody tr:nth-child(even) {
  background-color: #f8f9fa;
}

.services-detail-content .seo-table tbody tr:last-child th,
.services-detail-content .seo-table tbody tr:last-child td {
  border-bottom: none;
}

.services-detail-content .seo-table tbody th {
  font-weight: 700;
  color: #0d0d0d;
}

.services-detail-content .seo-table .seo-row-recommended {
  background-color: #eaf7f8;
}

.services-detail-content .seo-table .seo-pick {
  display: inline-block;
  margin-left: 6px;
  background-color: #1ba3b0;
  color: #ffffff;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  padding: 3px 9px;
  border-radius: 50px;
  vertical-align: middle;
}

.services-detail-content .seo-price {
  font-weight: 700;
  color: #0d7a85;
  white-space: nowrap;
}

/* Callout note */
.services-detail-content .seo-note {
  display: flex;
  gap: 14px;
  background-color: #f8f9fa;
  border-left: 4px solid #1ba3b0;
  border-radius: 0 16px 16px 0;
  padding: 20px 24px;
  margin: 0 0 32px 0;
  font-size: 1.05rem;
  line-height: 1.7;
}

.services-detail-content .seo-note p {
  margin: 0;
}

/* Name board type cards */
.services-detail-content .seo-type-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 20px;
  margin: 12px 0 40px 0;
}

.services-detail-content .seo-type-card {
  display: flex;
  flex-direction: column;
  background-color: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 20px;
  padding: 26px 24px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}

.services-detail-content .seo-type-card:hover {
  border-color: #1ba3b0;
  box-shadow: 0 14px 30px rgba(0, 0, 0, 0.06);
  transform: translateY(-3px);
}

.services-detail-content .seo-type-card h3 {
  font-size: 1.15rem;
  margin: 0 0 10px 0;
}

.services-detail-content .seo-type-card p {
  flex: 1;
  font-size: 0.98rem;
  line-height: 1.65;
  color: #444444;
  margin: 0 0 16px 0;
}

.services-detail-content .seo-type-card .seo-type-link {
  font-size: 0.95rem;
  font-weight: 700;
  text-decoration: none;
}

.services-detail-content .seo-type-card .seo-type-link::after {
  content: " →";
}

.services-detail-content .seo-type-card.is-featured {
  background-color: #eaf7f8;
  border-color: #1ba3b0;
}

.services-detail-content .seo-type-tag {
  align-self: flex-start;
  background-color: #1ba3b0;
  color: #ffffff;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 50px;
  margin-bottom: 12px;
}

/* Check lists */
.services-detail-content .seo-check-list {
  list-style: none;
  margin: 0 0 28px 0;
  padding: 0;
}

.services-detail-content .seo-check-list li {
  position: relative;
  padding: 0 0 0 36px;
  margin-bottom: 14px;
  font-size: 1.1rem;
  line-height: 1.65;
}

.services-detail-content .seo-check-list li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0.3em;
  width: 22px;
  height: 22px;
  border-radius: 50%;
  background: #1ba3b0 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center / 13px no-repeat;
}

.services-detail-content .seo-check-list strong {
  color: #0d0d0d;
}

/* Feature grid (why choose us) */
.services-detail-content .seo-feature-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 16px;
  list-style: none;
  margin: 8px 0 28px 0;
  padding: 0;
}

.services-detail-content .seo-feature-grid li {
  background-color: #f8f9fa;
  border-radius: 18px;
  padding: 22px 22px 22px 58px;
  position: relative;
  font-size: 1rem;
  line-height: 1.6;
}

.services-detail-content .seo-feature-grid li::before {
  content: "";
  position: absolute;
  left: 20px;
  top: 24px;
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #1ba3b0 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center / 14px no-repeat;
}

.services-detail-content .seo-feature-grid strong {
  display: block;
  color: #0d0d0d;
  margin-bottom: 4px;
}

/* Numbered process steps */
.services-detail-content .seo-steps {
  list-style: none;
  counter-reset: seo-step;
  margin: 8px 0 28px 0;
  padding: 0;
}

.services-detail-content .seo-steps li {
  counter-increment: seo-step;
  position: relative;
  padding: 0 0 26px 70px;
  font-size: 1.05rem;
  line-height: 1.7;
}

.services-detail-content .seo-steps li::before {
  content: counter(seo-step);
  position: absolute;
  left: 0;
  top: 0;
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  color: #ffffff;
  font-size: 1.1rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
}

.services-detail-content .seo-steps li::after {
  content: "";
  position: absolute;
  left: 22px;
  top: 52px;
  bottom: 6px;
  width: 2px;
  background-color: #d5eef0;
}

.services-detail-content .seo-steps li:last-child {
  padding-bottom: 0;
}

.services-detail-content .seo-steps li:last-child::after {
  display: none;
}

.services-detail-content .seo-steps strong {
  display: block;
  font-size: 1.15rem;
  color: #0d0d0d;
  margin-bottom: 2px;
}

@media (max-width: 640px) {
  .services-detail-content {
    font-size: 1.05rem;
  }
  .services-detail-content h2 {
    font-size: 1.55rem;
  }
  .services-detail-content h3 {
    font-size: 1.2rem;
  }
  .services-detail-content .seo-lead {
    font-size: 1.12rem;
  }
  .services-detail-content .seo-btn {
    width: 100%;
    justify-content: center;
    text-align: center;
  }
  .services-detail-content .seo-steps li {
    padding-left: 60px;
  }
  .services-detail-content .seo-feature-grid,
  .services-detail-content .seo-type-grid {
    grid-template-columns: 1fr;
  }
}
</style>


  <?php get_footer(); ?>