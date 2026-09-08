<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/fav.png" type="image/png">

  <!-- FontAwesome for Mobile Toggler & Menu Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NNBKKBB2');</script>
  <!-- End Google Tag Manager -->
  
  <meta name="google-site-verification" content="2ZAu435gdoGvs41eQ_Hha4pWoFOrY8lWdwPGzwdQe_I" />
	
  <?php wp_head(); ?>

<style>
/* Header Wrapper & Overlay */
.site-header {
  position: absolute;
  top: 20px; /* Aligns with the hero banner margin */
  left: 0;
  right: 0;
  z-index: 100;
  width: calc(100% - 40px);
  margin: 0 auto;
}

.site-header .navbar {
  padding: 15px 30px;
  background: transparent;
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

/* Floating Logo Style */
.logo-wrapper {
  position: relative;
}

.logo-wrapper .navbar-brand img {
  height: 115px;
  width: auto;
  object-fit: contain;
  filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.3));
}

/* Nav Menu Styling */
.nav-menu-wrapper .navbar-nav {
  display: flex;
  gap: 28px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav-menu-wrapper .navbar-nav .nav-link {
  color: #ffffff !important;
  font-size: 0.95rem;
  font-weight: 500;
  padding: 0;
  transition: opacity 0.2s ease;
}

.nav-menu-wrapper .navbar-nav .nav-link:hover {
  opacity: 0.8;
}

/* Right CTA Button */
.btn-quote {
  background-color: #1ba3b0;
  color: #ffffff !important;
  font-weight: 600;
  font-size: 0.9rem;
  padding: 10px 24px;
  border-radius: 50px;
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.2s ease;
  white-space: nowrap;
}

.btn-quote:hover {
  background-color: #158590;
  transform: translateY(-1px);
}

/* Mobile Toggler Icon Button */
.mobile-nav__toggler {
  cursor: pointer;
  color: #ffffff;
  font-size: 24px;
  background: transparent;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Reference Slide-Out Mobile Nav Drawer Styles */
.mobile-nav__wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  z-index: 99999;
  transform: translateX(-100%);
  transform-origin: left center;
  transition: transform 500ms ease, visibility 500ms ease;
  visibility: hidden;
}

.mobile-nav__wrapper.expanded {
  opacity: 1;
  transform: translateX(0);
  visibility: visible;
}

.mobile-nav__overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  cursor: pointer;
}

.mobile-nav__content {
  width: 300px;
  background-color: #1ba3b0;
  height: 100%;
  position: relative;
  opacity: 1;
  padding: 30px 20px;
  overflow-y: auto;
  z-index: 10;
  transform: translateX(-100%);
  transition: transform 500ms ease;
}

.mobile-nav__wrapper.expanded .mobile-nav__content {
  transform: translateX(0);
}

.mobile-nav__close {
  position: absolute;
  top: 20px;
  right: 15px;
  font-size: 18px;
  color: #ffffff;
  cursor: pointer;
}

.mobile-nav__content .logo-box {
  margin-bottom: 30px;
}

.mobile-nav__container ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.mobile-nav__container ul li {
  position: relative;
  border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.mobile-nav__container ul li a {
  display: block;
  font-size: 15px;
  color: #ffffff;
  font-weight: 600;
  padding: 12px 0;
  text-decoration: none;
}

.mobile-nav__container ul li button {
  position: absolute;
  right: 0;
  top: 10px;
  background: transparent;
  border: none;
  color: #ffffff;
  font-size: 14px;
  cursor: pointer;
}

.mobile-nav__container ul li ul {
  display: none;
  padding-left: 15px;
}

/* Responsive Rules */
@media (max-width: 991px) {
  .site-header {
    top: 10px;
    width: calc(100% - 20px);
  }
  
  .site-header .navbar {
    padding: 10px 15px;
  }

  .logo-wrapper .navbar-brand img {
    height: 66px;
  }
}
</style>
</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNBKKBB2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager -->

<header class="site-header">
  <nav class="navbar navbar-expand-lg">
    <div class="header-container">
      
      <!-- Left: Floating Logo -->
      <div class="logo-wrapper">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php
            if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
              echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
            } else {
              bloginfo( 'name' );
            }
          ?>
        </a>
      </div>

      <!-- Center: Navigation Links -->
      <div class="nav-menu-wrapper d-none d-lg-flex">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary_menu',
            'container'      => false,
            'menu_class'     => 'navbar-nav align-items-center',
            'depth'          => 2,
            'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
            'walker'         => new WP_Bootstrap_Navwalker(),
          ]);
        ?>
      </div>

      <!-- Right: Get a Quote Button & Mobile Toggle -->
      <div class="header-actions flex-row d-flex align-items-center gap-3">
        <a href="#quote" class="btn-quote d-none d-lg-inline-flex">Get a Quote</a>

        <!-- Mobile Nav Toggler matching script logic -->
        <a href="#" class="mobile-nav__toggler d-lg-none">
          <i class="fa fa-bars"></i>
        </a>
      </div>

    </div>
  </nav>
</header>

<!-- Mobile Navigation Drawer Overlay Structure -->
<div class="mobile-nav__wrapper">
  <div class="mobile-nav__overlay mobile-nav__toggler"></div>
  <div class="mobile-nav__content">
    <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
    
    <div class="logo-box">
      <a href="<?php echo esc_url( home_url('/') ); ?>">
        <?php
          if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '" style="max-height: 40px; width: auto;">';
          }
        ?>
      </a>
    </div>

    <div class="mobile-nav__container">
      <?php
        wp_nav_menu([
          'theme_location' => 'primary_menu',
          'container'      => false,
          'menu_class'     => 'main-menu__list',
          'fallback_cb'    => false,
          'depth'          => 2,
        ]);
      ?>
    </div>

    <a href="#quote" class="btn-quote d-block text-center mt-4">Get a Quote</a>
  </div>
</div>

<div id="pageContent">
  <!-- Main hero banner content goes right after header -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // 1. Mobile Nav Toggle
  const togglers = document.querySelectorAll('.mobile-nav__toggler');
  const navWrapper = document.querySelector('.mobile-nav__wrapper');
  
  togglers.forEach(toggler => {
    toggler.addEventListener('click', function(e) {
      e.preventDefault();
      if (navWrapper) {
        navWrapper.classList.toggle('expanded');
      }
    });
  });

  // 2. Mobile Sub-menu Toggle Logic
  const menuItemsWithChildren = document.querySelectorAll('.mobile-nav__container .menu-item-has-children');
  menuItemsWithChildren.forEach(item => {
    const link = item.querySelector('a');
    if (link && !link.querySelector('button')) {
      const btn = document.createElement('button');
      btn.setAttribute('aria-label', 'dropdown toggler');
      btn.innerHTML = '<i class="fa fa-angle-down"></i>';
      link.appendChild(btn);

      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        item.classList.toggle('expanded');
        const subMenu = item.querySelector('ul');
        if (subMenu) {
          subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
        }
      });
    }
  });
});
</script>
</body>
</html>