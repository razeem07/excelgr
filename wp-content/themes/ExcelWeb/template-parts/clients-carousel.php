<?php
$args = array(
    'post_type'      => 'clients',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'ASC',
);

$clients = new WP_Query($args);

if ($clients->have_posts()) : ?>
    <section class="clients-carousel container my-5">
        <!-- Section Title -->
        <h2 class="section-title text-center mt-4 mb-4">Our Brands / Clients</h2>

        <div class="swiper myClientsSwiper">
            <div class="swiper-wrapper">
                <?php while ($clients->have_posts()) : $clients->the_post(); ?>
                    <div class="swiper-slide">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium_large', array('class' => 'carousel-img')); ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Optional Navigation Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

   
<?php endif;
wp_reset_postdata();
?>


<style>
/* Section Title */
.clients-carousel .section-title {
    font-size: 2rem;
    font-weight: 600;
    color: #333;
}

/* Carousel Images */
.clients-carousel .carousel-img {
    width: auto;
    max-width: 200px; /* Adjust as needed */
    height: 120px; /* Adjust height */
    object-fit: contain;
    margin: 0 auto;
}

/* Swiper Slide */
.clients-carousel .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Pagination */
.clients-carousel .swiper-pagination {
    bottom: -20px; /* Move dots below images */
}

/* Navigation Buttons */
.clients-carousel .swiper-button-next,
.clients-carousel .swiper-button-prev {
    color: #81c341; /* Custom arrow color */
    width: 40px;      /* Reduce width */
    height: 40px;     /* Reduce height */
}

.clients-carousel .swiper-button-next::after,
.clients-carousel .swiper-button-prev::after {
    font-size: 40px;  /* Adjust arrow icon size */
}

/* Hover effect for arrows */
.clients-carousel .swiper-button-next:hover,
.clients-carousel .swiper-button-prev:hover {
    color: #81c341;  /* Darker shade on hover */
}

/* Responsive */
@media (max-width: 768px) {
    .clients-carousel .carousel-img {
        max-width: 150px;
        height: 90px;
    }
    .clients-carousel .swiper-button-next,
    .clients-carousel .swiper-button-prev {
        width: 20px;
        height: 20px;
    }
    .clients-carousel .swiper-button-next::after,
    .clients-carousel .swiper-button-prev::after {
        font-size: 16px;
    }
}
</style>

