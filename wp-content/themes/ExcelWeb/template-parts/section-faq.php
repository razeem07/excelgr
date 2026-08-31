<?php
/**
 * FAQ Section (using FAQ CPT)
 */
$args = array(
  'post_type'      => 'faq',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC'
);
$faqs = new WP_Query($args);

if ($faqs->have_posts()) : ?>
<section class="faq-section py-5">
  <div class="container">
    <h2 class="section-title mb-5 text-center" data-aos="fade-up">
      Frequently  <span class="highlight">Asked Questions</span>
    </h2>
    <h2 class="text-center fw-bold mb-4"></h2>
    <div class="accordion" id="faqAccordion">

      <?php $i = 0;
      while ($faqs->have_posts()) : $faqs->the_post();
        $i++; ?>

        <div class="accordion-item mb-3 border-0 shadow-sm rounded-3 overflow-hidden">
          <h2 class="accordion-header" id="heading<?php echo $i; ?>">
            <button class="accordion-button <?php echo ($i != 1) ? 'collapsed' : ''; ?>"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse<?php echo $i; ?>"
                    aria-expanded="<?php echo ($i == 1) ? 'true' : 'false'; ?>"
                    aria-controls="collapse<?php echo $i; ?>">
              <?php the_title(); ?>
            </button>
          </h2>
          <div id="collapse<?php echo $i; ?>"
               class="accordion-collapse collapse <?php echo ($i == 1) ? 'show' : ''; ?>"
               aria-labelledby="heading<?php echo $i; ?>"
               data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>

    </div>
  </div>
</section>
<?php endif; ?>



<style>

    .faq-section {
  background: #f8f9fa;
}
.faq-section h2 {
  color: #222;
}
.accordion-button {
  background-color: #fff;
  font-weight: 600;
  color: #333;
  transition: all 0.3s ease;
}
.accordion-button:not(.collapsed) {
  background-color: #6bbd45;
  color: #fff;
}
.accordion-button:focus {
  box-shadow: none;
}
.accordion-body {
  background: #fff;
  color: #555;
  font-size: 15px;
  line-height: 1.7;
}



</style>