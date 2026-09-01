 <?php get_header(); ?>


    
<!-- Section 1: Banner -->
 <?php get_template_part('template-parts/banner-archive'); ?>






<section class="single-post-section">
  <div class="single-post-container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
      $current_service_id = get_the_ID();
    ?>

    <div class="services-detail-layout">

      <!-- Column 1: All Services -->
      <div class="services-tabs-col">
        <?php
          $all_services = new WP_Query( array(
              'post_type'      => 'service',
              'posts_per_page' => -1,
              'orderby'        => 'menu_order title',
              'order'          => 'ASC',
          ) );
          while ( $all_services->have_posts() ) : $all_services->the_post();
        ?>
          <a href="<?php the_permalink(); ?>" class="services-tab-item<?php echo ( get_the_ID() === $current_service_id ) ? ' is-active' : ''; ?>">
            <h3 class="services-tab-title"><?php the_title(); ?></h3>
          </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>

      <!-- Column 2: Current Service Detail -->
      <div class="services-detail-col">
        <article class="single-post-wrapper">

          <header class="single-post-header">
            <div class="single-post-badge">
              <span class="single-post-diamond">◆</span>
              <span class="single-post-badge-text fade-left">Our Services</span>
            </div>

            <h1 class="single-post-title fade-right"><?php the_title(); ?></h1>

            <?php
              $service_terms = get_the_terms( get_the_ID(), 'service_category' );
              if ( ! empty( $service_terms ) && ! is_wp_error( $service_terms ) ) :
            ?>
              <div class="single-post-meta">
                <span class="meta-item">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                  <?php echo esc_html( $service_terms[0]->name ); ?>
                </span>
              </div>
            <?php endif; ?>
          </header>

          <?php
            $service_banner_id  = (int) get_post_meta( get_the_ID(), 'service_banner_image', true );
            $service_banner_url = $service_banner_id ? wp_get_attachment_url( $service_banner_id ) : ( has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '' );
          ?>
          <?php if ( $service_banner_url ) : ?>
            <img src="<?php echo esc_url( $service_banner_url ); ?>" alt="<?php the_title_attribute(); ?>" class="services-detail-img" />
          <?php endif; ?>

          <?php if ( get_the_excerpt() ) : ?>
            <p class="services-detail-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
          <?php endif; ?>

          <div class="services-detail-content animate-fade fade-left">
            <?php the_content(); ?>
          </div>

          <?php
            $service_tags = get_the_terms( get_the_ID(), 'service_tag' );
            if ( ! empty( $service_tags ) && ! is_wp_error( $service_tags ) ) :
          ?>
            <div class="single-post-tags">
              <span class="tags-label">Service Tags:</span>
              <div class="tags-list">
                <?php
                  foreach ( $service_tags as $tag ) {
                    echo '<a href="' . esc_url( get_term_link( $tag ) ) . '" class="tag-chip">' . esc_html( $tag->name ) . '</a>';
                  }
                ?>
              </div>
            </div>
          <?php endif; ?>

          <nav class="single-post-navigation">
            <div class="nav-link-wrapper nav-previous">
              <?php
                $prev_post = get_previous_post();
                if ( !empty( $prev_post ) ) :
              ?>
                <span class="nav-label">← Previous Service</span>
                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="nav-title fade-right">
                  <?php echo esc_html( $prev_post->post_title ); ?>
                </a>
              <?php endif; ?>
            </div>

            <div class="nav-link-wrapper nav-next fade-left">
              <?php
                $next_post = get_next_post();
                if ( !empty( $next_post ) ) :
              ?>
                <span class="nav-label">Next Service →</span>
                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="nav-title">
                  <?php echo esc_html( $next_post->post_title ); ?>
                </a>
              <?php endif; ?>
            </div>
          </nav>

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

    </div>

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

/* Two-Column Layout: All Services + Current Service Detail */
.services-detail-layout {
  display: flex;
  align-items: flex-start;
  gap: 40px;
}

.services-tabs-col {
  flex: 0 0 340px;
  display: flex;
  flex-direction: column;
  gap: 18px;
  position: sticky;
  top: 20px;
}

.services-tab-item {
  position: relative;
  display: flex;
  align-items: center;
  padding: 18px 22px;
  border-radius: 10px;
  background-color: #f8f9fa;
  color: inherit;
  text-decoration: none;
  border: 2px solid transparent;
  border-left: 4px solid transparent;
  transition: background-color 0.3s ease, border-color 0.3s ease;
}

.services-tab-item:hover {
  background-color: #f0f4f4;
  color: inherit;
  text-decoration: none;
}

.services-tab-item.is-active {
  background-color: #ffffff;
  border-color: #e9ecef;
  border-left-color: #1ba3b0;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.services-tab-title {
  font-size: 1.1rem;
  font-weight: 700;
  line-height: 1.3;
  color: #0d0d0d;
  margin: 0;
}

.services-tab-item.is-active .services-tab-title {
  color: #1ba3b0;
}

.services-detail-col {
  flex: 1;
  min-width: 0;
}

/* Header & Meta */
.single-post-header {
  text-align: center;
  margin-bottom: 40px;
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
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

.single-post-meta {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 14px;
  font-size: 1.05rem;
  color: #666666;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 6px;
}

.meta-item svg {
  width: 18px;
  height: 18px;
  stroke: #1ba3b0;
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

.services-detail-excerpt {
  font-size: 1.2rem;
  font-weight: 600;
  line-height: 1.5;
  color: #1ba3b0;
  margin: 0 0 20px 0;
}

/* Post Content Body */
.services-detail-content {
  width: 100%;
  font-size: 1.2rem;
  line-height: 1.85;
  color: #222222;
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

/* Tags Styling */
.single-post-tags {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 28px 0;
  border-top: 1px solid #e9ecef;
  border-bottom: 1px solid #e9ecef;
  margin-bottom: 60px;
  width: 100%;
}

.tags-label {
  font-size: 1.05rem;
  font-weight: 700;
  color: #111111;
}

.tags-list {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.tag-chip {
  background-color: #f4f6f8;
  color: #444444;
  padding: 8px 18px;
  border-radius: 50px;
  font-size: 0.95rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
}

.tag-chip:hover {
  background-color: #1ba3b0;
  color: #ffffff;
}

/* Navigation Links */
.single-post-navigation {
  display: flex;
  justify-content: space-between;
  gap: 30px;
  margin-bottom: 80px;
  width: 100%;
}

.nav-link-wrapper {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.nav-next {
  text-align: right;
  align-items: flex-end;
}

.nav-label {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  text-transform: uppercase;
  margin-bottom: 8px;
}

.nav-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #111111;
  text-decoration: none;
  line-height: 1.35;
  transition: color 0.3s ease;
}

.nav-title:hover {
  color: #1ba3b0;
}

/* Related Services Section */
.related-posts-section {
  padding-top: 50px;
  border-top: 1px solid #e9ecef;
  width: 100%;
}

.related-posts-header {
  text-align: center;
  margin-bottom: 48px;
}

.related-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
}

.related-diamond {
  color: #1ba3b0;
  font-size: 1.1rem;
}

.related-badge-text {
  font-size: 1.1rem;
  font-weight: 700;
  color: #111111;
}

.related-posts-main-title {
  font-size: 3rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 0;
}

.related-posts-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
  width: 100%;
}

.related-card {
  background: #ffffff;
  border: 1px solid #e9ecef;
  border-radius: 24px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  opacity: 0;
  transform: translateY(20px);
}

.related-card.visible {
  opacity: 1;
  transform: translateY(0);
}

.related-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.related-card-img-link {
  display: block;
  height: 220px;
  overflow: hidden;
  background: #f4f4f4;
}

.related-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.related-card:hover .related-card-img {
  transform: scale(1.05);
}

.related-card-placeholder {
  width: 100%;
  height: 100%;
  background: #e9ecef;
}

.related-card-content {
  padding: 28px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.related-card-title {
  font-size: 1.3rem;
  font-weight: 700;
  line-height: 1.35;
  margin: 0 0 18px 0;
}

.related-card-title a {
  color: #111111;
  text-decoration: none;
  transition: color 0.3s ease;
}

.related-card-title a:hover {
  color: #1ba3b0;
}

.related-card-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.95rem;
  font-weight: 700;
  color: #1ba3b0;
  text-decoration: none;
  margin-top: auto;
  transition: color 0.3s ease;
}

.related-card-btn:hover {
  color: #14838e;
}

.no-related-posts {
  grid-column: 1 / -1;
  text-align: center;
  color: #777777;
}

/* Responsive Styles */
@media (max-width: 1200px) {
  .single-post-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .related-posts-grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .single-post-title {
    font-size: 2.15rem;
  }
  .services-detail-layout {
    flex-direction: column;
  }
  .services-tabs-col {
    flex: 1 1 auto;
    width: 100%;
    position: static;
    flex-direction: row;
    overflow-x: auto;
  }
  .services-tab-item {
    flex: 0 0 auto;
    white-space: nowrap;
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

  .single-post-navigation {
    flex-direction: column;
    gap: 24px;
  }

  .nav-next {
    text-align: left;
    align-items: flex-start;
  }

  .related-posts-grid {
    grid-template-columns: 1fr;
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