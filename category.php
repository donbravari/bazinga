<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Título de categoría -->
<h2><?php single_cat_title(); ?></h2>
<!-- Listado de posts -->
<?php if ( have_posts() ) : ?>
  <section class="main-content ">
    <div class="blog-content">
      <div class="container main-content">
        <?php if ( function_exists('yoast_breadcrumb') ) {
      $breadcrumbs = yoast_breadcrumb( '<ul id="breadcrumb"><li>', '</li></ul>', false );
      echo str_replace( '|', ' <span class="bc_arrow" aria-hidden="true" data-icon="&#59234;"></li><li>', $breadcrumbs );
    } ?>
    <h1 class="category-name"><?php single_cat_title(); ?></h1>
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="bazinga-block">
          <div class="new-content">
            <div class="new-figure"><a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('thumbnail'); ?></a></div>
            <div class="caption">
                <div class="tags-news">
                <?php $post_tags = get_the_tags();
                if ( $post_tags ) {
                  for($a = 0; $a < count($post_tags); $a++){
                    echo '<a href="'. get_tag_link($post_tags[$a]->term_id) .'" class="block-infos-category">'.$post_tags[$a]->name.'</a>'; 
                  }
                }; ?>
                </div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="after-title">
                <time datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></time>
              </div>
                <?php the_excerpt(); ?>
                <div class="act-accion"><a class="view-more" href="<?php the_permalink(); ?>">Leer Más</a> </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      <div class="pagination">
        <span class="in-left"><?php next_posts_link('« Entradas antiguas'); ?></span>
        <span class="in-right"><?php previous_posts_link('Entradas más recientes »'); ?></span>
      </div>
    </div>
    <div class="sidebar-blog">
      <aside>
        <!-- Zona de Widgets -->
        <?php dynamic_sidebar('sidebar_blog'); ?>
      </aside>
    </div>
  </div>
  </section>
<?php else : ?>
  <p><?php _e('Ups!, no hay entradas.'); ?></p>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>