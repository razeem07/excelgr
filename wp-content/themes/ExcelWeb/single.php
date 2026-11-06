 <?php get_header(); ?>

<?php
  $hero_post_id     = get_queried_object_id();
  $hero_banner_id   = (int) get_post_meta( $hero_post_id, 'post_banner_image', true );
  $hero_banner_url  = $hero_banner_id
    ? wp_get_attachment_url( $hero_banner_id )
    : ( has_post_thumbnail( $hero_post_id ) ? get_the_post_thumbnail_url( $hero_post_id, 'full' ) : get_template_directory_uri() . '/assets/images/blog-banner.jpg' );
?>
<section class="post-hero-banner">
  <img src="<?php echo esc_url( $hero_banner_url ); ?>" alt="<?php echo esc_attr( get_the_title( $hero_post_id ) ); ?>" class="post-hero-bg-img" />
  <div class="post-hero-overlay"></div>
  <div class="post-hero-container">
    <div class="post-hero-content">
      <h1 class="post-hero-title fade-right"><?php echo esc_html( get_the_title( $hero_post_id ) ); ?></h1>
    </div>
  </div>
</section>

<style>
.post-hero-banner {
  position: relative;
  width: calc(100% - 40px);
  max-width: 100%;
  min-height: 380px;
  margin: 20px auto 60px;
  border-radius: 36px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #ffffff;
  box-sizing: border-box;
}

.post-hero-bg-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 0;
}

.post-hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.55);
  z-index: 1;
}

.post-hero-container {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 50px 40px;
  box-sizing: border-box;
  text-align: center;
}

.post-hero-content {
  max-width: 820px;
  margin: 0 auto;
}

.post-hero-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.15;
  letter-spacing: -1.2px;
  margin: 0;
  color: #ffffff;
}

@media (max-width: 900px) {
  .post-hero-banner {
    min-height: 300px;
  }
  .post-hero-container {
    padding: 32px 24px;
  }
  .post-hero-title {
    font-size: 2.15rem;
  }
}

@media (max-width: 640px) {
  .post-hero-banner {
    width: calc(100% - 20px);
    margin: 10px auto 40px;
  }
  .post-hero-title {
    font-size: 1.85rem;
  }
}
</style>


<section class="single-post-section">
  <div class="single-post-container">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <article class="single-post-wrapper">

        <?php
          $post_words    = str_word_count( wp_strip_all_tags( get_the_content() ) );
          $post_minutes  = max( 1, (int) round( $post_words / 200 ) );
          $post_category = get_the_category();
        ?>
        <div class="single-post-meta">
          <span>By <?php the_author(); ?></span>
          <span>Updated <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date( 'j M Y' ) ); ?></time></span>
          <span><?php echo esc_html( $post_minutes ); ?> min read</span>
          <?php if ( $post_category && 'uncategorized' !== $post_category[0]->slug ) : ?>
            <span class="single-post-meta-cat"><?php echo esc_html( $post_category[0]->name ); ?></span>
          <?php endif; ?>
        </div>

        <?php // No fade-right here: long posts never reach its 15% visibility threshold and stay hidden. ?>
        <div class="single-post-content animate-fade">
          <?php the_content(); ?>
        </div>

        <?php if ( get_the_tags() ) : ?>
          <div class="single-post-tags">
            <span class="tags-label fade-left">Tags:</span>
            <div class="tags-list">
              <?php
                $tags = get_the_tags();
                foreach ( $tags as $tag ) {
                  echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-chip">' . esc_html( $tag->name ) . '</a>';
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
              <span class="nav-label">← Previous Article</span>
              <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="nav-title fade-left">
                <?php echo esc_html( $prev_post->post_title ); ?>
              </a>
            <?php endif; ?>
          </div>

          <div class="nav-link-wrapper nav-next">
            <?php 
              $next_post = get_next_post();
              if ( !empty( $next_post ) ) : 
            ?>
              <span class="nav-label">Next Article →</span>
              <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="nav-title fade-right">
                <?php echo esc_html( $next_post->post_title ); ?>
              </a>
            <?php endif; ?>
          </div>
        </nav>

      </article>

      <div class="related-posts-section">
        <div class="related-posts-header">
          <div class="related-badge">
            <span class="related-diamond">◆</span>
            <span class="related-badge-text fade-left">More to Read</span>
          </div>
          <h2 class="related-posts-main-title fade-right">Related Posts</h2>
        </div>

        <div class="related-posts-grid">
          <?php
            $categories = wp_get_post_categories( get_the_ID() );
            $related = new WP_Query( array(
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'post__not_in'   => array( get_the_ID() ),
              'category__in'   => $categories,
              'orderby'        => 'date',
              'order'          => 'DESC'
            ) );

            if ( $related->have_posts() ) :
              while ( $related->have_posts() ) : $related->the_post(); 
          ?>
            <article class="related-card animate-fade">
              <a href="<?php the_permalink(); ?>" class="related-card-img-link">
                <?php if ( has_post_thumbnail() ) : ?>
                  <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" class="related-card-img fade-left" />
                <?php else : ?>
                  <div class="related-card-placeholder"></div>
                <?php endif; ?>
              </a>
              <div class="related-card-content">
                <span class="related-card-date"><?php echo get_the_date('M d, Y'); ?></span>
                <h3 class="related-card-title fade-right">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <a href="<?php the_permalink(); ?>" class="related-card-btn fade-left">
                  Read Article <span class="btn-arrow">→</span>
                </a>
              </div>
            </article>
          <?php 
              endwhile; 
              wp_reset_postdata();
            else : 
          ?>
            <p class="no-related-posts">No related posts found.</p>
          <?php endif; ?>
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
  max-width: 100%; /* Expanded to full width */
  margin: 0 auto;
}

.single-post-wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

/* Post Content Body - Centered, comfortable reading width */
.single-post-content {
  width: 100%;
  max-width: 900px;
  margin: 0 auto 60px;
  font-size: 1.2rem;
  line-height: 1.85;
  color: #222222;
  text-align: justify;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.single-post-content.visible {
  opacity: 1;
  transform: translateY(0);
}

.single-post-content p {
  margin-bottom: 18px;
}

.single-post-content p:last-child {
  margin-bottom: 0;
}

.single-post-content h2, 
.single-post-content h3, 
.single-post-content h4 {
  color: #0d0d0d;
  font-weight: 800;
  line-height: 1.25;
  margin: 44px 0 20px 0;
}

.single-post-content blockquote {
  border-left: 4px solid #1ba3b0;
  background-color: #f8f9fa;
  padding: 28px 36px;
  margin: 40px 0;
  border-radius: 0 16px 16px 0;
  font-size: 1.3rem;
  font-style: italic;
  color: #333333;
}

.single-post-content img {
  width: 100%;
  max-width: 100%;
  height: auto;
  border-radius: 20px;
  margin: 32px 0;
}

.single-post-content ul,
.single-post-content ol {
  margin: 0 0 20px 24px;
  padding: 0;
  text-align: left;
}

.single-post-content li {
  margin-bottom: 8px;
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

/* Related Posts Section */
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

.related-card-date {
  font-size: 0.9rem;
  font-weight: 600;
  color: #1ba3b0;
  margin-bottom: 8px;
  text-transform: uppercase;
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
@media (max-width: 991px) {
  .related-posts-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .single-post-section {
    width: calc(100% - 20px);
    padding: 0 10px;
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

<style>
/* Byline under the hero */
.single-post-meta {
  width: 100%;
  max-width: 900px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px 22px;
  margin: 0 auto 36px;
  padding-bottom: 22px;
  border-bottom: 1px solid #e9ecef;
  font-size: 0.95rem;
  color: #666666;
}

.single-post-meta span + span::before {
  content: "◆";
  margin-right: 22px;
  color: #1ba3b0;
  font-size: 0.6rem;
  vertical-align: middle;
}

.single-post-meta .single-post-meta-cat {
  font-weight: 700;
  color: #0d7a85;
}

/* Long-form article blocks (seo-*) used in post content */
.single-post-content h2 {
  font-size: 1.95rem;
  letter-spacing: -0.5px;
  text-align: left;
}

.single-post-content h3 {
  font-size: 1.3rem;
  text-align: left;
}

.single-post-content a {
  color: #158590;
  font-weight: 600;
  text-underline-offset: 3px;
}

.single-post-content a:hover {
  color: #0d7a85;
}

/* Quick answer at the top of the post */
.single-post-content .seo-answer {
  background: linear-gradient(135deg, #eaf7f8 0%, #f8f9fa 100%);
  border: 1px solid #cde9ec;
  border-radius: 20px;
  padding: 26px 30px;
  margin: 0 0 28px 0;
  text-align: left;
}

.single-post-content .seo-answer-label {
  display: inline-block;
  background-color: #1ba3b0;
  color: #ffffff;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 50px;
  margin-bottom: 10px;
}

.single-post-content .seo-answer p {
  margin: 0;
  font-size: 1.15rem;
  line-height: 1.7;
  color: #0d0d0d;
}

/* CTA buttons */
.single-post-content .seo-cta-row {
  display: flex;
  flex-wrap: wrap;
  gap: 14px;
  margin: 8px 0 36px 0;
}

.single-post-content .seo-btn {
  display: inline-flex;
  align-items: center;
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

.single-post-content .seo-btn:hover {
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 10px 24px rgba(13, 122, 133, 0.25);
}

.single-post-content .seo-btn-outline {
  background: transparent;
  color: #0d7a85;
  box-shadow: inset 0 0 0 2px #1ba3b0;
}

.single-post-content .seo-btn-outline:hover {
  color: #0d7a85;
}

/* Tables */
.single-post-content .seo-table-wrap {
  width: 100%;
  overflow-x: auto;
  margin: 8px 0 18px 0;
  border: 1px solid #e9ecef;
  border-radius: 20px;
}

.single-post-content .seo-table {
  width: 100%;
  min-width: 560px;
  border-collapse: collapse;
  font-size: 1rem;
  line-height: 1.5;
  text-align: left;
}

.single-post-content .seo-table th,
.single-post-content .seo-table td {
  padding: 14px 16px;
  vertical-align: top;
  border-bottom: 1px solid #e9ecef;
}

.single-post-content .seo-table thead th {
  background-color: #0d7a85;
  color: #ffffff;
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 0.3px;
  text-transform: uppercase;
  border-bottom: none;
}

.single-post-content .seo-table tbody tr:nth-child(even) {
  background-color: #f8f9fa;
}

.single-post-content .seo-table tbody tr:last-child th,
.single-post-content .seo-table tbody tr:last-child td {
  border-bottom: none;
}

.single-post-content .seo-table tbody th {
  font-weight: 700;
  color: #0d0d0d;
}

.single-post-content .seo-table .seo-price {
  font-weight: 700;
  color: #0d7a85;
  white-space: nowrap;
}

.single-post-content .seo-table .seo-row-recommended {
  background-color: #eaf7f8;
}

.single-post-content .seo-pick {
  display: inline-block;
  margin-left: 6px;
  background-color: #1ba3b0;
  color: #ffffff;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  padding: 2px 9px;
  border-radius: 50px;
  vertical-align: middle;
}

.single-post-content .seo-table-note {
  font-size: 0.95rem;
  line-height: 1.6;
  color: #666666;
  text-align: left;
}

/* Callout note */
.single-post-content .seo-note {
  background-color: #f8f9fa;
  border-left: 4px solid #1ba3b0;
  border-radius: 0 16px 16px 0;
  padding: 20px 24px;
  margin: 0 0 28px 0;
  font-size: 1.05rem;
  line-height: 1.7;
  text-align: left;
}

.single-post-content .seo-note p {
  margin: 0;
}

/* Images with captions */
.single-post-content .seo-figure {
  margin: 32px 0;
}

.single-post-content .seo-figure img {
  display: block;
  margin: 0;
  border-radius: 20px;
}

.single-post-content .seo-figure figcaption {
  margin-top: 10px;
  font-size: 0.92rem;
  line-height: 1.5;
  color: #777777;
  text-align: center;
}

/* Factor cards (what decides the price) */
.single-post-content .seo-factors {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
  margin: 8px 0 32px 0;
  text-align: left;
}

.single-post-content .seo-factor {
  background-color: #f8f9fa;
  border-radius: 18px;
  padding: 24px 24px 22px;
}

.single-post-content .seo-factor-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  color: #ffffff;
  font-size: 0.95rem;
  font-weight: 800;
  margin-bottom: 12px;
}

.single-post-content .seo-factor h3 {
  font-size: 1.15rem;
  margin: 0 0 8px 0;
}

.single-post-content .seo-factor p {
  font-size: 1rem;
  line-height: 1.65;
  color: #444444;
  margin: 0;
}

/* Check list and "avoid" list */
.single-post-content .seo-check-list,
.single-post-content .seo-x-list {
  list-style: none;
  margin: 0 0 28px 0;
  padding: 0;
  text-align: left;
}

.single-post-content .seo-check-list li,
.single-post-content .seo-x-list li {
  position: relative;
  padding-left: 36px;
  margin-bottom: 12px;
  font-size: 1.08rem;
  line-height: 1.65;
}

.single-post-content .seo-check-list li::before,
.single-post-content .seo-x-list li::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0.32em;
  width: 22px;
  height: 22px;
  border-radius: 50%;
}

.single-post-content .seo-check-list li::before {
  background: #1ba3b0 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center / 13px no-repeat;
}

.single-post-content .seo-x-list li::before {
  background: #e05252 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round'%3E%3Cpath d='M7 7l10 10M17 7L7 17'/%3E%3C/svg%3E") center / 12px no-repeat;
}

.single-post-content .seo-list-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0d0d0d;
  margin: 8px 0 14px 0;
  text-align: left;
}

/* Numbered steps */
.single-post-content .seo-steps {
  list-style: none;
  counter-reset: seo-step;
  margin: 8px 0 24px 0;
  padding: 0;
  text-align: left;
}

.single-post-content .seo-steps li {
  counter-increment: seo-step;
  position: relative;
  padding: 0 0 22px 62px;
  margin: 0;
  font-size: 1.05rem;
  line-height: 1.7;
}

.single-post-content .seo-steps li::before {
  content: counter(seo-step);
  position: absolute;
  left: 0;
  top: 0;
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  color: #ffffff;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
}

.single-post-content .seo-steps li::after {
  content: "";
  position: absolute;
  left: 20px;
  top: 48px;
  bottom: 4px;
  width: 2px;
  background-color: #d5eef0;
}

.single-post-content .seo-steps li:last-child::after {
  display: none;
}

/* FAQ accordion (also read for FAQPage schema) */
.single-post-content .seo-faq {
  margin: 8px 0 32px 0;
  text-align: left;
}

.single-post-content .seo-faq-item {
  border: 1px solid #e9ecef;
  border-radius: 14px;
  padding: 2px 22px;
  margin-bottom: 12px;
  background-color: #ffffff;
}

.single-post-content .seo-faq-item summary {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding: 16px 0;
  cursor: pointer;
  list-style: none;
}

.single-post-content .seo-faq-item summary::-webkit-details-marker {
  display: none;
}

.single-post-content .seo-faq-item summary::after {
  content: "+";
  flex-shrink: 0;
  color: #1ba3b0;
  font-size: 1.5rem;
  font-weight: 400;
  line-height: 1;
  transition: transform 0.3s ease;
}

.single-post-content .seo-faq-item[open] summary::after {
  transform: rotate(45deg);
}

.single-post-content .seo-faq-item summary h3 {
  font-size: 1.08rem;
  margin: 0;
  line-height: 1.4;
}

.single-post-content .seo-faq-answer {
  padding: 0 0 18px 0;
  font-size: 1.02rem;
  line-height: 1.7;
  color: #444444;
}

.single-post-content .seo-faq-answer p {
  margin: 0;
}

/* Closing CTA box */
.single-post-content .seo-cta-box {
  background: linear-gradient(135deg, #1ba3b0 0%, #0d7a85 100%);
  border-radius: 24px;
  padding: 40px 36px;
  margin: 12px 0 0 0;
  color: #ffffff;
  text-align: center;
}

.single-post-content .seo-cta-box h2 {
  color: #ffffff;
  margin: 0 0 12px 0;
  text-align: center;
}

.single-post-content .seo-cta-box p {
  color: rgba(255, 255, 255, 0.92);
  font-size: 1.08rem;
  line-height: 1.7;
  margin: 0 0 22px 0;
}

.single-post-content .seo-cta-box a {
  color: #ffffff;
}

.single-post-content .seo-cta-box .seo-cta-row {
  justify-content: center;
  margin: 0 0 14px 0;
}

.single-post-content .seo-cta-box .seo-btn {
  background: #ffffff;
  color: #0d7a85;
}

.single-post-content .seo-cta-box .seo-btn-outline {
  background: transparent;
  color: #ffffff;
  box-shadow: inset 0 0 0 2px rgba(255, 255, 255, 0.85);
}

.single-post-content .seo-cta-box .seo-small {
  font-size: 0.92rem;
  margin: 0;
  color: rgba(255, 255, 255, 0.8);
}

@media (max-width: 640px) {
  .single-post-content {
    font-size: 1.05rem;
    text-align: left;
  }
  .single-post-content h2 {
    font-size: 1.55rem;
  }
  .single-post-content .seo-factors {
    grid-template-columns: 1fr;
  }
  .single-post-content .seo-answer,
  .single-post-content .seo-cta-box {
    padding: 22px 20px;
  }
  .single-post-content .seo-btn {
    width: 100%;
    justify-content: center;
    text-align: center;
  }
  .single-post-meta {
    gap: 6px 14px;
  }
  .single-post-meta span + span::before {
    margin-right: 14px;
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
    }, { threshold: 0 }); // 0, not a ratio: a long post can be taller than the viewport and never reach e.g. 15% visible

    elements.forEach(el => observer.observe(el));
  });
</script>



  <?php get_footer(); ?>