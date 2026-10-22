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
  <?php if ( $generalpage_banner_id ) :
    $hero_img = wp_get_attachment_image_src( $generalpage_banner_id, 'full' );
  ?>
    <img src="<?php echo esc_url( $hero_img[0] ); ?>" width="<?php echo esc_attr( $hero_img[1] ); ?>" height="<?php echo esc_attr( $hero_img[2] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" fetchpriority="high" decoding="async" />
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