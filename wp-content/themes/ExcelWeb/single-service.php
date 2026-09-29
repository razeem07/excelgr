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
      <h1 class="service-hero-title fade-right"><?php echo esc_html( get_the_title( $hero_service_id ) ); ?></h1>
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

            <h1 class="single-post-title fade-right"><?php the_title(); ?></h1>
          </header>

          <div class="services-detail-content animate-fade fade-left">
            <?php the_content(); ?>
          </div>

          <?php
            $raw_wysiwyg = get_field( 'services_faq', $current_service_id );
            $faq_items   = array();

            if ( ! empty( $raw_wysiwyg ) ) {
                $pattern = '/<(strong|b)[^>]*>(.*?)<\/\1>\s*([\s\S]*?)(?=(?:<(?:strong|b)[^>]*>|$))/i';
                if ( preg_match_all( $pattern, $raw_wysiwyg, $matches, PREG_SET_ORDER ) ) {
                    foreach ( $matches as $match ) {
                        $question = trim( strip_tags( $match[2] ) );
                        $answer   = trim( $match[3] );
                        $answer   = preg_replace( '/^<\/p>|<p>$/i', '', $answer );
                        $answer   = trim( $answer );
                        if ( ! empty( $question ) ) {
                            $faq_items[] = array( 'question' => $question, 'answer' => $answer );
                        }
                    }
                }
            }
          ?>
          <?php if ( ! empty( $faq_items ) ) : ?>
            <div class="services-detail-faq">
              <h4 class="services-detail-faq-title">Frequently Asked Questions</h4>
              <?php foreach ( $faq_items as $item ) : ?>
                <details class="services-detail-faq-item">
                  <summary class="services-detail-faq-question">
                    <span><?php echo esc_html( $item['question'] ); ?></span>
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
    ?>
    <section class="service-cta-section">
      <div class="service-cta-card">
        <h2 class="service-cta-title">Ready to get started with <?php the_title(); ?>?</h2>
        <p class="service-cta-subtitle">Get a free quote from Excel Graphics, Kollam.</p>
        <?php if ( $service_cta_wa_link ) : ?>
          <a href="https://wa.me/<?php echo esc_attr( $service_cta_wa_link ); ?>?text=<?php echo urlencode( 'Hello, I would like to know more about ' . get_the_title() . '.' ); ?>" target="_blank" rel="noopener" class="service-cta-btn">WhatsApp Now</a>
        <?php else : ?>
          <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="service-cta-btn">Get a Quote</a>
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
  flex: 1;
  min-width: 0;
}

/* Related Services sidebar */
.related-sidebar-col {
  flex: 0 0 300px;
  position: sticky;
  top: 20px;
  background-color: #f8f9fa;
  border-radius: 20px;
  padding: 28px 26px;
}

.related-sidebar-badge {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 18px;
}

.related-sidebar-badge .related-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
}

.related-sidebar-badge .related-badge-text {
  font-size: 1.1rem;
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
  font-weight: 600;
  color: #333333;
  text-decoration: none;
  transition: color 0.3s ease;
}

.related-sidebar-list a:hover {
  color: #1ba3b0;
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
    }, { threshold: 0.15 });

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
</style>


  <?php get_footer(); ?>