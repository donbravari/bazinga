<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <title><?php if (is_home () ) { echo bloginfo('name'); echo ' | '; bloginfo('description'); 
    }elseif ( is_category() ) { single_cat_title(); echo ' | ' ; echo bloginfo('name'); 
      }elseif (is_single() || is_page()) { single_post_title(); echo ' | ' ; echo bloginfo('name'); 
        }else { wp_title('',true); 
      } 
  ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header id="main-menu-header">
    <div class="container">
      <div id="main-logo">
        <a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-bazinga.webp" alt="Bazinga Comics" /></a>
      </div>
      <div class="menu-container">
        <div class="top-bar">
            <?php echo do_shortcode('[fibosearch]'); ?>
          <div class="topbar-links">
            <a href="<?php echo get_permalink(9); ?>" class="link-acount">Mi Cuenta</a>
            <div class="car-widget"><a href="<?php echo wc_get_cart_url(); ?>"><?php echo sprintf ( _n( '<span class="count">%d</span>', '<span class="count">%d</span>', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icono-car.png" /></a></div>
          </div>
        </div>
          <?php wp_nav_menu( array( 'theme_location' => 'navegation', 'container' => 'div',) ); ?>
        <div class="nav-mobile">
              <div class="botonHamburguesa pull-right"><span class="linea"></span></div>
        </div>
      </div>
    </div>
  </header>