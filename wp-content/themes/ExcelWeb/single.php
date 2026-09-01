 <?php get_header(); ?>


    
<!-- Section 1: Banner -->
 <?php get_template_part('template-parts/banner-archive'); ?>






<section class="single-post-section">
  <div class="single-post-container">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <article class="single-post-wrapper">

        <header class="single-post-header">
          <div class="single-post-badge">
            <span class="single-post-diamond">◆</span>
            <span class="single-post-badge-text fade-left">Blog & Insights</span>
          </div>

          <h1 class="single-post-title fade-right"><?php the_title(); ?></h1>

          <div class="single-post-meta">
            <span class="meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
              <?php echo get_the_date('F j, Y'); ?>
            </span>
            <span class="meta-separator">•</span>
            <span class="meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              By <?php the_author(); ?>
            </span>
          </div>
        </header>

        <?php if ( has_post_thumbnail() ) : ?>
          <div class="single-post-hero-image fade-left">
            <?php the_post_thumbnail('full', ['class' => 'single-post-img', 'alt' => get_the_title()]); ?>
          </div>
        <?php endif; ?>

        <div class="single-post-content animate-fade fade-right">
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

.meta-separator {
  color: #cccccc;
}

/* Featured Image - Full Width Banner */
.single-post-hero-image {
  width: 100%;
  max-height: 600px;
  border-radius: 28px;
  overflow: hidden;
  margin-bottom: 60px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.single-post-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Post Content Body - Full Width Layout */
.single-post-content {
  width: 100%;
  font-size: 1.2rem;
  line-height: 1.85;
  color: #222222;
  margin-bottom: 60px;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.single-post-content.visible {
  opacity: 1;
  transform: translateY(0);
}

.single-post-content p {
  margin-bottom: 24px;
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
}

@media (max-width: 640px) {
  .single-post-section {
    width: calc(100% - 20px);
    padding: 0 10px;
  }

  .single-post-title {
    font-size: 1.95rem;
  }

  .single-post-meta {
    flex-direction: column;
    gap: 6px;
  }

  .meta-separator {
    display: none;
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



  <?php get_footer(); ?>