<?php /* Template Name: generalpage
        Template Post Type: page,post */
 ?>

 <?php get_header(); ?>


<!-- Section 1: Banner -->
<?php
  $generalpage_banner_id = (int) get_post_meta( get_the_ID(), 'service_banner_image', true );
  if ( ! $generalpage_banner_id && has_post_thumbnail() ) {
    $generalpage_banner_id = get_post_thumbnail_id();
  }
?>
<section class="about-banner">
  <?php if ( $generalpage_banner_id ) : ?>
    <?php echo wp_get_attachment_image( $generalpage_banner_id, 'full', false, array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
  <?php endif; ?>
  <div class="overlay"></div>
  <div class="content container">
    <h1 class="fw-bold"><?php the_title(); ?></h1>

  </div>
</section>




<!-- Section 2: Content -->
<section class="policy-content py-5">
  <div class="container">
    <div class="content-wrapper mx-auto" style="max-width: 800px;">
      <h2 class="fw-bold mb-4 text-center"><?php the_title(); ?></h2>
      <div class="page-content">
        <?php 
          while ( have_posts() ) : the_post();
            the_content();
          endwhile;
        ?>
      </div>
    </div>
  </div>
</section>



<?php get_footer(); ?>