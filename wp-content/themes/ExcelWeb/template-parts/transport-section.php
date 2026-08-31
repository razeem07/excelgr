


<?php
$args = array(
  'post_type'      => 'transport', // your CPT slug
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'ASC'
);
$transport = new WP_Query( $args );
?>

<section class="transport-archive py-5">
  <div class="container">
    <div class="row g-4">

     <?php if ( $transport->have_posts() ) : while ( $transport->have_posts() ) : $transport->the_post(); ?>
        <div class="col-md-6 col-lg-4">
          <a href="<?php the_permalink(); ?>" class="transport-card animate-fade d-block">

            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail('medium', ['class' => 'img-fluid transport-img']); ?>
            <?php endif; ?>

            <!-- Title Overlay -->
            <div class="transport-overlay">
              <h3 class="transport-title"><?php the_title(); ?></h3>
            </div>

          </a>
        </div>
      <?php endwhile; else : ?>
        <p class="text-center">Sorry, no transport fleets found!</p>
      <?php endif; ?>

    </div>
  </div>
</section>