<?php
function mis_menus() {
  register_nav_menus(
    array(
      'navegation' => __( 'Menú de navegación' ),
    )
  );
}
add_action( 'init', 'mis_menus' );
//SCRIPTS
function bazinga_scripts(){
	wp_enqueue_style( 'bazinga-owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
	wp_enqueue_style( 'bazinga-owltheme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' );
	wp_enqueue_style( 'bazinga-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css' );
	wp_enqueue_style( 'bazinga-popup-css', get_template_directory_uri() . '/assets/css/popup.css' );

	
	wp_enqueue_style( 'bazinga-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'bazinga-jquery', get_template_directory_uri() . '/assets/js/jquery-1.11.0.min.js', array(), false, true);
	wp_enqueue_script( 'bazinga-owljs', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), false, true);
	wp_enqueue_script( 'bazinga-funciones', get_template_directory_uri() . '/assets/js/funciones.js', array(), false, true);
	wp_enqueue_script( 'bazinga-popup-js', get_template_directory_uri() . '/assets/js/popup.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'bazinga_scripts' );
//SLIDERS
function slider_post_type() { 

	$labels = array(
		'name'                => esc_html__( 'Banners', 'Post Type General Name', 'bazinga' ),
		'singular_name'       => esc_html__( 'Banner', 'Post Type Singular Name', 'bazinga' ),
		'menu_name'           => esc_html__( 'Banners', 'bazinga' ),
		'parent_item_colon'   => esc_html__( 'Parent Item:', 'bazinga' ),
		'all_items'           => esc_html__( 'Todos los Banners', 'bazinga' ),
		'view_item'           => esc_html__( 'Ver Banner', 'bazinga' ),
		'add_new_item'        => esc_html__( 'Nuevo Banner', 'bazinga' ),
		'add_new'             => esc_html__( 'Agregar nuevo', 'bazinga' ),
		'edit_item'           => esc_html__( 'Editar Banner', 'bazinga' ),
		'update_item'         => esc_html__( 'Actualizar Banner', 'bazinga' ),
		'search_items'        => esc_html__( 'Buscar Banners', 'bazinga' ),
		'not_found'           => esc_html__( 'No encontrado', 'bazinga' ),
		'not_found_in_trash'  => esc_html__( 'No encontrado en la papelera', 'bazinga' ),
	);
	$args = array(
		'label'               => esc_html__( 'banners', 'bazinga' ),
		'description'         => esc_html__( 'Add a slide to your schedule.', 'bazinga' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail'),
		'taxonomies'          => array( 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_icon' 		  => 'dashicons-format-gallery',
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'banner', $args );

}
add_action( 'init', 'slider_post_type', 0 );	
//COMENTARIOS
function comments_post_type() { 

	$labels = array(
		'name'                => esc_html__( 'Comentarios', 'Post Type General Name', 'bazinga' ),
		'singular_name'       => esc_html__( 'Comentario', 'Post Type Singular Name', 'bazinga' ),
		'menu_name'           => esc_html__( 'Comentarios', 'bazinga' ),
		'parent_item_colon'   => esc_html__( 'Parent Item:', 'bazinga' ),
		'all_items'           => esc_html__( 'Todos los Comentarios', 'bazinga' ),
		'view_item'           => esc_html__( 'Ver Comentario', 'bazinga' ),
		'add_new_item'        => esc_html__( 'Nuevo Comentario', 'bazinga' ),
		'add_new'             => esc_html__( 'Agregar nuevo', 'bazinga' ),
		'edit_item'           => esc_html__( 'Editar Comentario', 'bazinga' ),
		'update_item'         => esc_html__( 'Actualizar Comentario', 'bazinga' ),
		'search_items'        => esc_html__( 'Buscar Comentarios', 'bazinga' ),
		'not_found'           => esc_html__( 'No encontrado', 'bazinga' ),
		'not_found_in_trash'  => esc_html__( 'No encontrado en la papelera', 'bazinga' ),
	);
	$args = array(
		'label'               => esc_html__( 'comentarios', 'bazinga' ),
		'description'         => esc_html__( 'Add a slide to your schedule.', 'bazinga' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail'),
		'taxonomies'          => array( 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_icon' 		  => 'dashicons-format-chat',
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'comentarios', $args );

}
add_action( 'init', 'comments_post_type', 0 );	

function my_theme_setup() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

function my_before_main_content() {
    echo '<!-- Starting content wrapper for your theme -->';
    echo '<section class="main-content"><div class="container">';
}
add_action( 'woocommerce_before_main_content', 'my_before_main_content' );

function my_after_main_content() {
    echo '</div></section>';
    echo '<!-- Ending content wrapper for your theme -->';
}
add_action( 'woocommerce_after_main_content', 'my_after_main_content' );


// Eliminar los CSS de WooCommerce uno por uno
add_filter( 'woocommerce_enqueue_styles', 'woocommerce_dequeue_styles' );
function woocommerce_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Eliminar todos los CSS de WooCommerce de golpe
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


add_filter( 'woocommerce_breadcrumb_defaults', 'mk_cambiar_breadcrumbs' );
function mk_cambiar_breadcrumbs() {
    return array(
       'delimiter' => '',
       'wrap_before' => '<ul id="breadcrumb">',
       'wrap_after' => '</ul>',
       'before' => '<li>',
       'after' => '</li>',
       'home' => _x( '<span class="icon icon-home"> </span>', 'breadcrumb', 'woocommerce' ),
   );
}

add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'minicart_count_before_content' );
function minicart_count_before_content() {
    $items_count = WC()->cart->get_cart_contents_count();
    ?>
        <span class="count"><?php echo $items_count; ?></span>
    <?php
}

function mis_widgets(){
 register_sidebar(
   array(
       'name'          => __( 'Sidebar' ),
       'id'            => 'sidebar',
       'before_widget' => '<div class="widget">',
       'after_widget'  => '</div>',
       'before_title'  => '<h3>',
       'after_title'   => '</h3>',
   )
 );
 register_sidebar(
   array(
       'name'          => __( 'Sidebar Blog' ),
       'id'            => 'sidebar_blog',
       'before_widget' => '<div class="widget">',
       'after_widget'  => '</div>',
       'before_title'  => '<h3>',
       'after_title'   => '</h3>',
   )
 );
}
add_action('init','mis_widgets');

function custom_excerpt_length( $length ) {
     return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action( 'wp_footer', 'woocommerce_tip_script' );
function woocommerce_tip_script() {
    // Only on checkout page
    if( ! is_checkout() ) return;
    ?>
    <script type="text/javascript">

    jQuery(function($){
    	jQuery("#billing_city_field").hide();
    	jQuery("#billing_comuna_field").hide();

    	$('form.woocommerce-checkout').on( 'change', 'select#billing_state', function(){
    			var a = $(this).val();
    			if(a == '1'){
    				jQuery("#billing_comuna_field").slideDown();
    			}else{
    				jQuery("#billing_comuna_field").hide();
    			}
    	});
        // On 'select#propina' change (live event)
        $('form.woocommerce-checkout').on( 'change', 'select#billing_comuna', function(){
            // Set the select value in a variable
            var a = $(this).val();
            $("input#billing_city").val(a);
            $("input#billing_city").attr("value", a);
            // Update checkout event
            $('body').trigger('update_checkout');

            // Restoring the chosen option value
            $('select#billing_comuna option[value="'+a+'"]').prop('selected', true);

            // Just for testing (To be removed)
            console.log('trigger "update_checkout"');

            // Once checkout has been updated
            $('body').on('updated_checkout', function(){
                // Restoring the chosen option value
                $('select#billing_comuna option[value="'+a+'"]').prop('selected', true);

                // Just for testing (To be removed)
                console.log('"updated_checkout" event, restore selected option value: '+a);
            });
        });
    })
    </script>
    <?php
}


remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
 
// #2 add them back under short description
// note: this will need a bit of CSS customization - see below
 
add_action( 'woocommerce_product_thumbnails', 'bbloomer_product_thumbnails_wrapper_start', 49 );
add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 50 );
add_action( 'woocommerce_product_thumbnails', 'bbloomer_product_thumbnails_wrapper_end', 51 );
 
function bbloomer_product_thumbnails_wrapper_start() {
echo '<div class="bbloomer-thumbs">';
}
 
function bbloomer_product_thumbnails_wrapper_end() {
echo '</div>';
}

function force_jquery_to_footer() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'force_jquery_to_footer' );

// Remove jQuery from old wp_print_scripts
function remove_jquery_from_wp_print_scripts() {
    wp_deregister_script( 'jquery' );
}
add_action( 'wp_print_scripts', 'remove_jquery_from_wp_print_scripts' );
// Remove scripts from head.
function move_scripts_from_head_to_footer() {
    remove_action( 'wp_head', 'wp_print_scripts' );
    remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
    remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );

    add_action( 'wp_footer', 'wp_print_scripts', 5);
    add_action( 'wp_footer', 'wp_enqueue_scripts', 5);
    add_action( 'wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'move_scripts_from_head_to_footer' );

?>