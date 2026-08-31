 <?php get_header(); ?>


 

         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


          <div class="col-md-4">
            <div class="blog-card">
              <img
                src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                alt="<?php the_title_attribute(); ?>"
                class="blog-image" style="width:50%"
              />
              <div class="blog-content">
                <h3 class="blog-title"><?php the_title(); ?></h3>
                <p class="blog-description">
                 <?php echo wp_trim_words(get_the_content(),15); ?>
                </p>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-custom">Read More</a>
              </div>
            </div>
          </div>


          <?php endwhile; else : ?>
        <article>
            <p>Sorry, no posts were found!</p>
        </article>
         <?php endif; ?>

  


























  <?php get_footer(); ?>