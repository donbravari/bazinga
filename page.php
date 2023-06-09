<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido de página de inicio -->
<?php if ( have_posts() ) : the_post(); ?>
  <section class="main-content">
		<div class="container">
    <h1 class="titulo-principal-seccion"><?php the_title(); ?></h1>
    <?php the_content(); ?>
</div>
  </section>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>