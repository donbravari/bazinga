<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido del post -->
<?php if ( have_posts() ) : the_post(); ?>
	<?php 
		$classimage = '';
	     $imagen_header = get_field( "header_imagen" ); 
	      if ( $imagen_header ) {
	      	echo '<figure class="imagen-cabecera-article">';

	      	echo '<img src="'. get_field('header_imagen') .'" alt="'. get_the_title() .'" />';
	      	echo '</figure>';
	      	$classimage = 'article-width-image';
	      }
	?>
  <section  id="post-<?php the_ID(); ?>" class="main-content article-content<?php echo ' '.$classimage; ?>">
  	
  	<div class="container">
  		<?php if ( function_exists('yoast_breadcrumb') ) {
	$breadcrumbs = yoast_breadcrumb( '<ul id="breadcrumb"><li>', '</li></ul>', false );
	echo str_replace( '|', ' <span class="bc_arrow" aria-hidden="true" data-icon="&#59234;"></li><li>', $breadcrumbs );
} ?>
    <h1 id="article-titulo"><?php the_title(); ?></h1>
    <ul class="article-specs">
    	<li><address>Por <?php the_field('autor'); ?></address></li>
    	<li><time datatime="<?php the_time('Y-m-j'); ?>"><?php the_time('j F, Y'); ?></time></li>
    </ul>
    <?php echo  wpautop(get_the_content());?>
    
</div>
  </section>
<?php else : ?>
  <p><?php _e('Ups!, esta entrada no existe.'); ?></p>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>