<!-- Archivo de cabecera global de Wordpress -->
<?php get_header(); ?>
<!-- Contenido de página de inicio -->
<?php if ( have_posts() ) : the_post(); ?>
 <section id="main-slide">
		<div class="slide-content owl-carousel owl-theme">
	<?php query_posts( array ( 'post_type' => 'banner', 'posts_per_page' => -1 ) );
      while ( have_posts() ) : the_post(); ?> 
			<div class="item">
				<a href="<?php the_field('link'); ?>" class="btn-overall"></a>
				<div class="container">
					<div class="caption">
						<h2 class="subtitulo"><?php the_field('subtitulo'); ?></h2>
						<h2 class="titulo" style="color: <?php the_field('color_titulo'); ?>"><?php the_field('titulo'); ?></h2>
						<p class="parrafo"><?php the_field('bajada_de_texto'); ?></p>
					</div>
				</div>
				<figure>
					<img src="<?php the_field('imagen'); ?>" alt="<?php the_field('subtitulo'); ?> - <?php the_field('titulo'); ?>" class="desktop-img">
					<img src="<?php the_field('imagen_mobile'); ?>" alt="<?php the_field('subtitulo'); ?> - <?php the_field('titulo'); ?>" class="mobile-img">
				</figure>
			</div>
	 	<?php endwhile; ?> 
		</div>
	</section>
	<section class="main-content home-main-content">
		<div class="container">
			<div class="titulo-link">
				<h3>Lo más nuevo</h3>
				<a href="#">Ver todos</a>
			</div>
			<div class="carousel-news">
				<div class="owl-carousel">
					<?php 
						$args = array(
						"post_type" => "product",
						"posts_per_page" => 10,
						"meta_key" => "total_sales",
						"orderby" => "meta_value_num",
						);
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
					 ?>
					<div class="product-thumb">
						<a href="<?php echo get_permalink( $loop->post->ID ); ?>" class="btn-overall"></a>
						<figure>
							<?php 
				                if ( has_post_thumbnail( $loop->post->ID ) ) 
				                    echo get_the_post_thumbnail( $loop->post->ID, 'full' ); 
				                else 
				                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder"/>'; 
				            ?>
						</figure>
						<h2><?php the_title(); ?></h2>
						<?php 
			                echo $product->get_price_html(); 
			            ?>  
					</div>
					<?php
						endwhile;
					}
					?>
				</div>
			</div>
			<div class="titulo-link">
				<h3>Lo más vendido</h3>
				<a href="#">Ver todos</a>
			</div>
			<div class="grilla-productos">
				<?php 
						$args = array(
						"post_type" => "product",
						"posts_per_page" => 12,
						'orderby'     =>  'date',
    					'order'       =>  'DESC',
						);
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
					 ?>
					<div class="product-thumb">
						<a href="<?php echo get_permalink( $loop->post->ID ); ?>" class="btn-overall"></a>
						<figure>
							<?php 
				                if ( has_post_thumbnail( $loop->post->ID ) ) 
				                    echo get_the_post_thumbnail( $loop->post->ID, 'full' ); 
				                else 
				                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="'. the_title() .'"/>'; 
				            ?>
						</figure>
						<h2><?php the_title(); ?></h2>
						<?php 
			                echo $product->get_price_html(); 
			                woocommerce_template_loop_add_to_cart( $loop->post, $product );
			            ?> 
					</div>
					<?php
						endwhile;
					}
					?>
			</div>
		</div>
	</section>
	<section class="category-section">
		<div class="container">
			<div class="carousel-categorias owl-carousel">
				<?php

				  $taxonomy     = 'product_cat';
				  $orderby      = 'name';  
				  $show_count   = 0;      // 1 for yes, 0 for no
				  $pad_counts   = 0;      // 1 for yes, 0 for no
				  $hierarchical = 1;      // 1 for yes, 0 for no  
				  $title        = '';  
				  $empty        = 0;

				  $args = array(
				         'taxonomy'     => $taxonomy,
				         'orderby'      => $orderby,
				         'show_count'   => $show_count,
				         'pad_counts'   => $pad_counts,
				         'hierarchical' => $hierarchical,
				         'title_li'     => $title,
				         'hide_empty'   => $empty,
				         'parent'      => 96
				  );
				 $all_categories = get_categories( $args );
				 foreach ($all_categories as $cat) { ?>
				<div class="categoria-thumb">
					<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="btn-overall"></a>
					<figure>
						<?php
						$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						?>
						<img src="<?php echo $image; ?>" alt="">
					</figure>
					<div class="caption">
						<h3><?php echo $cat->name; ?></h3>
						<p><?php  echo $cat->description; ?></p>
					</div>
				</div>
				<?php  } ?>
			</div>
		</div>
	</section>
	<?php if ( have_posts() ) : ?>
	<section class="blog-section">
		<div class="container">
			<div class="carousel-blog owl-carousel owl-theme">
				<?php $the_query = new WP_Query( 'cat=142&showposts=10' ); ?>
				<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				 	<?php if(get_field('imagen_destacada_home')): ?>
					<div class="blog-thumb">
						<a href="<?php the_permalink(); ?>" class="btn-overall"></a>
						<div class="caption">
							<?php
							$categories = get_the_category();
							 
							if ( ! empty( $categories ) ) {?>
								<span class="caluga-roja"><?php echo esc_html( $categories[0]->name );  ?></span>
							     
							<?php }
							?>
							<h2 style="color: <?php the_field('color_titulo'); ?>"><?php the_field('titulo'); ?></h2>
							<h3 style="color: <?php the_field('color_subtitulo'); ?>"><?php the_field('subtitulo'); ?></h3>
							<p><?php the_excerpt(); ?></p>
						</div>
						<figure>
							<img src="<?php the_field('imagen_destacada_home'); ?>">
						</figure>
					</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
			<div class="titulo-link">
				<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Ver todos</a>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<section>
		<div class="container">
			<div class="carousel-comments owl-carousel owl-theme">
				<?php query_posts( array ( 'post_type' => 'comentarios', 'posts_per_page' => -1 ) );
      while ( have_posts() ) : the_post(); ?> 
				<div class="comment-thumb">
					<div class="head-comment">
						<h4><?php the_field('autor'); ?></h4>
						<span><?php the_field('organizacion'); ?></span>
					</div>
					<div class="body-comment">
						<p><?php the_field('comentario_texto'); ?>...</p>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; ?>
<!-- Archivo de barra lateral por defecto -->
<?php get_sidebar(); ?>
<!-- Archivo de pié global de Wordpress -->
<?php get_footer(); ?>