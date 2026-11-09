<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ploto
 */

/**
 * Theme Page Header Title
*/
function ploto_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Archives','ploto'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Archives','ploto'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Archives','ploto'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('All posts by','ploto'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Category','ploto'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Tag','ploto'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Shop','ploto'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'ploto' ) , esc_html__('404','ploto') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'ploto' ), esc_html__('Search results for','ploto'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/**
 * Theme Breadcrumbs Url
*/
function ploto_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/**
 * Theme Breadcrumbs
*/
if( !function_exists('ploto_page_header_breadcrumbs') ):
	function ploto_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
			if (is_home() || is_front_page()) :
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','ploto').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','ploto').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. ploto_page_url() .'">' . __('Archive by category','ploto').' "' . single_cat_title('', false) . '"</a></li>';
				} elseif ( is_day() ) {
					echo '<li class="breadcrumb-item active"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. ploto_page_url() .'">'. get_the_time('d') .'</a></li>';
				} elseif ( is_month() ) {
					echo '<li class="breadcrumb-item active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
					echo '<li class="breadcrumb-item active"><a href="'. ploto_page_url() .'">'. get_the_time('F') .'</a></li>';
				} elseif ( is_year() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. ploto_page_url() .'">'. get_the_time('Y') .'</a></li>';
				} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {					
				if ( get_post_type() != 'post' ) {
					$cat = get_the_category(); 
					$cat = $cat[0];
					echo '<li class="breadcrumb-item">';
					echo get_category_parents($cat, TRUE, '');
					echo '</li>';
					echo '<li class="breadcrumb-item active"><a href="' . ploto_page_url() . '">'. get_the_title() .'</a></li>';
				} }  
					elseif ( is_page() && $post->post_parent ) {
				    $parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					    echo '<li class="breadcrumb-item active"><a href="' . ploto_page_url() . '">'. get_the_title() .'</a></li>';
                    }
					elseif( is_search() )
					{
					    echo '<li class="breadcrumb-item active"><a href="' . ploto_page_url() . '">'. get_search_query() .'</a></li>';
					}
					elseif( is_404() )
					{
						echo '<li class="breadcrumb-item active"><a href="' . ploto_page_url() . '">'.__('Error 404','ploto').'</a></li>';
					}
					else { 
					    echo '<li class="breadcrumb-item active"><a href="' . ploto_page_url() . '">'. get_the_title() .'</a></li>';
					}
				endif;
        }
endif;


// Ploto Excerpt Read More
if ( ! function_exists( 'ploto_execerpt_btn' ) ) :
function ploto_execerpt_btn() {
	$ploto_show_post_btn		= get_theme_mod('ploto_show_post_btn','1'); 
	$ploto_read_btn_txt		= get_theme_mod('ploto_read_btn_txt','Read more'); 
	if ( $ploto_show_post_btn == '1' ) {
	?>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" class="more-link"><?php echo wp_kses_post($ploto_read_btn_txt); ?></a>
<?php }
	} 
endif;

// Ploto excerpt length
function ploto_site_excerpt_length( $length ) {
	 $ploto_post_excerpt_length= get_theme_mod('ploto_post_excerpt_length','30'); 
    if( $ploto_post_excerpt_length == 1000 ) {
        return 9999;
    }
    return esc_html( $ploto_post_excerpt_length );
}
add_filter( 'excerpt_length', 'ploto_site_excerpt_length', 999 );



// Ploto excerpt more
function ploto_site_excerpt_more( $more ) {
	return get_theme_mod('ploto_blog_excerpt_more','&hellip;');;
}
add_filter( 'excerpt_more', 'ploto_site_excerpt_more' );

/*=========================================
Register Google fonts for Ploto.
=========================================*/
function ploto_google_fonts_url() {
	
    $font_families = array('Figtree:ital,wght@0,300..900;1,300..900&family=Outfit:wght@100..900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function ploto_google_fonts_scripts_styles() {
    wp_enqueue_style( 'ploto-google-fonts', ploto_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'ploto_google_fonts_scripts_styles' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ploto_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[]='menu__active-one btn--effect-three section-title-two';
	return $classes;
}
add_filter( 'body_class', 'ploto_body_classes' );

function ploto_post_classes( $classes ) {
	if ( is_single() ) : 
	$classes[]='single-post'; 
	endif;
	return $classes;
}
add_filter( 'post_class', 'ploto_post_classes' );

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('ploto_str_replace_assoc')) {

    /**
     * ploto_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function ploto_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

/*=========================================
Ploto Site Preloader
=========================================*/
if ( ! function_exists( 'ploto_site_preloader' ) ) :
function ploto_site_preloader() {
	$ploto_hs_preloader_option 	= get_theme_mod( 'ploto_hs_preloader_option','1'); 
	if($ploto_hs_preloader_option == '1') { 
	?>
		<div id="dt_preloader" class="dt_preloader">			
			<div class="dt_preloader-animation">
				<div class="dt_preloader-dot-loading"><div class="cssload-loading"><i></i><i></i><i></i><i></i></div></div>
				<div class="dt_preloader-text">
					<?php 
						$ploto_preloader_string = get_bloginfo('name');
						//Using the explode method
						$ploto_preloader_arr_string = str_split($ploto_preloader_string);

						//foreach loop to display the returned array
						foreach($ploto_preloader_arr_string as $str){
							echo sprintf(__('<span class="splitted" data-char=%1$s>%1$s</span>', 'ploto'),$str);
						}
					?>
				</div>
			</div>
			<button type="button" class="dt_preloader-close dt-btn dt-btn-primary"><i class="fal fa-times"></i></button>
			<div class="layer"><span class="overlay"></span></div>
		</div>
	<?php }
	} 
endif;
add_action( 'ploto_site_preloader', 'ploto_site_preloader' );



/*=========================================
Ploto Site Header
=========================================*/
if ( ! function_exists( 'ploto_site_main_header' ) ) :
function ploto_site_main_header() {
	get_template_part('template-parts/site','header');
} 
endif;
add_action( 'ploto_site_main_header', 'ploto_site_main_header' );



/*=========================================
Ploto Header Image
=========================================*/
if ( ! function_exists( 'ploto_wp_hdr_image' ) ) :
function ploto_wp_hdr_image() {
	if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php echo esc_url(get_header_image()); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'ploto_wp_hdr_image', 'ploto_wp_hdr_image' );


/*=========================================
Ploto Header Email
=========================================*/
if ( ! function_exists( 'ploto_header_email' ) ) :
function ploto_header_email() {
	$ploto_hs_hdr_email 	= get_theme_mod( 'ploto_hs_hdr_email','1'); 
	$ploto_hdr_email_icon 	= get_theme_mod( 'ploto_hdr_email_icon','far fa-envelope-open'); 
	$ploto_hdr_email_title  = get_theme_mod( 'ploto_hdr_email_title','info@example.com');
	$ploto_hdr_email_link 	= get_theme_mod( 'ploto_hdr_email_link','mailto:info@example.com');
	if($ploto_hs_hdr_email=='1'): ?>
		<aside class="widget widget_contact email">
			<div class="contact__list">
				<?php if(!empty($ploto_hdr_email_icon)): ?>
					<i class="<?php echo esc_attr($ploto_hdr_email_icon); ?>" aria-hidden="true"></i>  
				<?php endif; ?>
				
				<?php if(!empty($ploto_hdr_email_title)): ?>
					<div class="contact__body">
						<?php if(!empty($ploto_hdr_email_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($ploto_hdr_email_link); ?>"><?php echo wp_kses_post($ploto_hdr_email_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($ploto_hdr_email_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'ploto_header_email', 'ploto_header_email' );


/*=========================================
Ploto Header Info
=========================================*/
if ( ! function_exists( 'ploto_header_top_info' ) ) :
function ploto_header_top_info() {
	$ploto_hs_hdr_top_info 	= get_theme_mod( 'ploto_hs_hdr_top_info','1'); 
	$ploto_hdr_top_info_icon= get_theme_mod( 'ploto_hdr_top_info_icon','fal fa-medal'); 
	$ploto_hdr_top_info_title = get_theme_mod( 'ploto_hdr_top_info_title','Trusted partner in business excellence');
	$ploto_hdr_top_info_btn_lbl= get_theme_mod( 'ploto_hdr_top_info_btn_lbl','Join us now'); 
	$ploto_hdr_top_info_link = get_theme_mod( 'ploto_hdr_top_info_link','#');
	if($ploto_hs_hdr_top_info=='1'): ?>
		<aside class="widget widget_text info">
			<?php if(!empty($ploto_hdr_top_info_icon)): ?>
				<i class="<?php echo esc_attr($ploto_hdr_top_info_icon); ?>" aria-hidden="true"></i>    
			<?php endif; ?> 
			<span class="title">
			<?php if(!empty($ploto_hdr_top_info_title)): echo wp_kses_post($ploto_hdr_top_info_title); endif; ?>
			<?php if(!empty($ploto_hdr_top_info_btn_lbl)): ?>
				<a href="<?php echo esc_url($ploto_hdr_top_info_link); ?>" class="line-normal font-medium dt-ml-1"><?php echo wp_kses_post($ploto_hdr_top_info_btn_lbl); ?> <i class="fas fa-arrow-right fa-xs"></i></a>
			<?php endif; ?>
			</span>
		</aside>
	<?php endif;
} 
endif;
add_action( 'ploto_header_top_info', 'ploto_header_top_info' );


/*=========================================
Ploto Header Time
=========================================*/
if ( ! function_exists( 'ploto_header_time' ) ) :
function ploto_header_time() {
	$ploto_hs_hdr_time 	= get_theme_mod( 'ploto_hs_hdr_time','1'); 
	$ploto_hdr_time_icon= get_theme_mod( 'ploto_hdr_time_icon','far fa-clock'); 
	$ploto_hdr_time_title = get_theme_mod( 'ploto_hdr_time_title','Mon-Sat: 9.00am To 7.00pm');
	$ploto_hdr_time_link = get_theme_mod( 'ploto_hdr_time_link');
	if($ploto_hs_hdr_time=='1'): ?>
		<aside class="widget widget_contact time">
			<div class="contact__list">
				<?php if(!empty($ploto_hdr_time_icon)): ?>
					<i class="<?php echo esc_attr($ploto_hdr_time_icon); ?>" aria-hidden="true"></i>    
				<?php endif; ?>  
				<?php if(!empty($ploto_hdr_time_title)): ?>
					<div class="contact__body">
						<?php if(!empty($ploto_hdr_time_link)): ?>
							<h6 class="title"><a href="<?php echo esc_url($ploto_hdr_time_link); ?>"><?php echo wp_kses_post($ploto_hdr_time_title); ?></a></h6>
						<?php else: ?>
							<h6 class="title"><?php echo wp_kses_post($ploto_hdr_time_title); ?></h6>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</aside>
	<?php endif;
} 
endif;
add_action( 'ploto_header_time', 'ploto_header_time' );

/*
 *
 * Social Icon
 */
function ploto_get_social_icon_default() {
	return apply_filters(
		'ploto_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'ploto' ),
					'link'	  =>  esc_html__( '#', 'ploto' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-google-plus-g', 'ploto' ),
					'link'	  =>  esc_html__( '#', 'ploto' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-x-twitter', 'ploto' ),
					'link'	  =>  esc_html__( '#', 'ploto' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'ploto' ),
					'link'	  =>  esc_html__( '#', 'ploto' ),
					'id'              => 'customizer_repeater_header_social_005',
				)
			)
		)
	);
}

/*=========================================
Ploto Social Icon
=========================================*/
if ( ! function_exists( 'ploto_site_social' ) ) :
function ploto_site_social() {
	// Social 
	$ploto_hs_hdr_social 	= get_theme_mod( 'ploto_hs_hdr_social','1'); 
	$ploto_hdr_social 		= get_theme_mod( 'ploto_hdr_social',ploto_get_social_icon_default());
	if($ploto_hs_hdr_social=='1'): ?>
		<aside class="widget widget_social">
			<ul>
				<?php
					$ploto_hdr_social = json_decode($ploto_hdr_social);
					if( $ploto_hdr_social!='' )
					{
					foreach($ploto_hdr_social as $item){	
					$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'ploto_translate_single_string', $item->icon_value, 'Header section' ) : '';	
					$social_link = ! empty( $item->link ) ? apply_filters( 'ploto_translate_single_string', $item->link, 'Header section' ) : '';
				?>
					<li><a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a></li>
				<?php }} ?>
			</ul>
		</aside>
	<?php endif;
} 
endif;
add_action( 'ploto_site_social', 'ploto_site_social' );

/*=========================================
Ploto Site Header
=========================================*/
if ( ! function_exists( 'ploto_site_header' ) ) :
function ploto_site_header() {
$ploto_hs_hdr 	= get_theme_mod( 'ploto_hs_hdr','1');
if($ploto_hs_hdr == '1') { 
?>
	<div class="dt_header-widget">
		<div class="dt-container">
			<div class="dt-row">
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--left dt-text-lg-left">
						<?php  do_action('ploto_header_top_info'); ?>
					</div>
				</div>
				<div class="dt-col-lg-6 dt-col-12">
					<div class="widget--right dt-text-lg-right">
						<?php  do_action('ploto_header_email'); ?>
						<?php  do_action('ploto_header_time'); ?>
						<?php  do_action('ploto_site_social'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'ploto_site_header', 'ploto_site_header' );



/*=========================================
Ploto Site Navigation
=========================================*/
if ( ! function_exists( 'ploto_site_header_navigation' ) ) :
function ploto_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt_navbar-mainmenu',
			'fallback_cb' => 'ploto_fallback_page_menu',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'ploto_site_header_navigation', 'ploto_site_header_navigation' );


/*=========================================
Ploto Header Button
=========================================*/
if ( ! function_exists( 'ploto_header_button' ) ) :
function ploto_header_button() {
	$ploto_hs_hdr_btn 		= get_theme_mod( 'ploto_hs_hdr_btn','1'); 
	$ploto_hdr_btn_icon 		= get_theme_mod( 'ploto_hdr_btn_icon','fab fa-whatsapp'); 
	$ploto_hdr_btn_lbl 		= get_theme_mod( 'ploto_hdr_btn_lbl','Get A Quote'); 
	$ploto_hdr_btn_link 		= get_theme_mod( 'ploto_hdr_btn_link','#'); 
	$ploto_hdr_btn_target 		= get_theme_mod( 'ploto_hdr_btn_target');
	if($ploto_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($ploto_hs_hdr_btn=='1'  && !empty($ploto_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($ploto_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn dt-btn-primary"> <?php echo wp_kses_post($ploto_hdr_btn_lbl); ?> <i class="<?php echo esc_attr($ploto_hdr_btn_icon); ?>"></i></a>
	</li>
<?php endif;
	} 
endif;
add_action( 'ploto_header_button', 'ploto_header_button' );

/*=========================================
Ploto Site Search
=========================================*/
if ( ! function_exists( 'ploto_site_main_search' ) ) :
function ploto_site_main_search() {
	$ploto_hs_hdr_search 	= get_theme_mod( 'ploto_hs_hdr_search','1'); 
	$ploto_search_result 	= get_theme_mod( 'ploto_search_result','post');
	if($ploto_hs_hdr_search=='1'):	
?>
<li class="dt_navbar-search-item">
	<button type="button" class="dt_navbar-search-toggle"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
	<div class="dt_search search--header">
		<form method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'ploto' ); ?>">
			<label for="dt_search-form-1">
				<?php if($ploto_search_result=='product' && class_exists('WooCommerce')):	?>
					<input type="hidden" name="post_type" value="product" />
				 <?php endif; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'ploto' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'ploto' ); ?>" value="" name="s" />
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="far fa-magnifying-glass" aria-hidden="true"></i></button>
		</form>
		<button type="button" class="dt_search-close"><i class="far fa-arrow-up" aria-hidden="true"></i></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'ploto_site_main_search', 'ploto_site_main_search' );



/*=========================================
Ploto WooCommerce Cart
=========================================*/
if ( ! function_exists( 'ploto_woo_cart' ) ) :
function ploto_woo_cart() {
	$ploto_hs_hdr_cart 	= get_theme_mod( 'ploto_hs_hdr_cart','1'); 
	if($ploto_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt_navbar-cart-item">
		<a href="javascript:void(0);" class="dt_navbar-cart-icon">
			<span class="cart_icon">
				<i class="far fa-cart-shopping" aria-hidden="true"></i>
			</span>
			<?php 
				$count = WC()->cart->cart_contents_count;
				
				if ( $count > 0 ) {
				?>
					 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
				<?php 
				}
				else {
					?>
					<strong class="cart_count"><?php  esc_html_e('0','ploto'); ?></strong>
					<?php 
				}
		?>
		</a>
		<div class="dt_navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'ploto_woo_cart', 'ploto_woo_cart' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function ploto_woo_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
			$count = WC()->cart->cart_contents_count;
			
			if ( $count > 0 ) {
			?>
				 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
			<?php 
			}
			else {
				?>
				<strong class="cart_count"><?php esc_html_e('0','ploto'); ?></strong>
				<?php 
			}
	?>
	<?php
 
    $fragments['.cart_count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ploto_woo_add_to_cart_fragment' );


/*=========================================
Ploto My Account
=========================================*/
if ( ! function_exists( 'ploto_hdr_account' ) ) {
	function ploto_hdr_account() {	
		$ploto_hs_hdr_account 		= get_theme_mod( 'ploto_hs_hdr_account','1');
		$ploto_hdr_account_icon 	= get_theme_mod( 'ploto_hdr_account_icon','far fa-user');
		$ploto_hdr_account_title 	= get_theme_mod( 'ploto_hdr_account_title','Account');
		$ploto_hdr_account_link 	= get_theme_mod( 'ploto_hdr_account_link','#');
		if($ploto_hs_hdr_account=='1'  ||  !empty($ploto_hs_hdr_account)): ?>
			<li class="dt_navbar-user-item">
				<a href="<?php echo esc_url($ploto_hdr_account_link); ?>" class="dt_user_btn"><i class="<?php echo esc_attr($ploto_hdr_account_icon); ?>"></i> &nbsp;<?php echo wp_kses_post($ploto_hdr_account_title); ?></a>
			</li>
		<?php endif;
	}
}
add_action( 'ploto_hdr_account', 'ploto_hdr_account' );

/*=========================================
Ploto Site Logo
=========================================*/
if ( ! function_exists( 'ploto_site_logo' ) ) :
function ploto_site_logo() {
	$ploto_title_tagline_seo = get_theme_mod( 'ploto_title_tagline_seo');
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h4 class="site-title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h4>
			</a>	
		<?php 						
			}
		?>
		<?php if($ploto_title_tagline_seo=='1'): ?>	
			<h1 class="site-title" style="display: none;">
				<?php 
					echo esc_html(get_bloginfo('name'));
				?>
			</h1>
		<?php
			endif;
			$ploto_description = get_bloginfo( 'description');
			if ($ploto_description) : ?>
				<p class="site-description"><?php echo esc_html($ploto_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'ploto_site_logo', 'ploto_site_logo' );


/*=========================================
Ploto Footer Widget
=========================================*/
if ( ! function_exists( 'ploto_footer_widget' ) ) :
function ploto_footer_widget() {
$ploto_footer_widget_column	= get_theme_mod('ploto_footer_widget_column','3'); 
?>
<div class="dt_footer_middle">
	<div class="dt-container">
		<?php 
		if($ploto_footer_widget_column !==''): 
		?>
		<div class="dt-row dt-g-lg-4 dt-g-5">
			<?php if ( is_active_sidebar( 'ploto-footer-widget-1' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($ploto_footer_widget_column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
					<?php dynamic_sidebar( 'ploto-footer-widget-1'); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'ploto-footer-widget-2' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($ploto_footer_widget_column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
					<?php dynamic_sidebar( 'ploto-footer-widget-2'); ?>	
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'ploto-footer-widget-3' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($ploto_footer_widget_column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
					<?php dynamic_sidebar( 'ploto-footer-widget-3'); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'ploto-footer-widget-4' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($ploto_footer_widget_column); ?> dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
					<?php dynamic_sidebar( 'ploto-footer-widget-4'); ?>
				</div>
			<?php endif; ?>	
		</div>
		<?php endif; ?>	
	</div>
</div>
<?php 
} 
endif;
add_action( 'ploto_footer_widget', 'ploto_footer_widget' );


/*=========================================
Ploto Footer Bottom
=========================================*/
if ( ! function_exists( 'ploto_footer_bottom' ) ) :
function ploto_footer_bottom() {
	?>
	<div class="dt_footer_copyright">
		<div class="dt-container">
			<div class="dt-row dt-g-4 dt-mt-0">
				<div class="dt-col-md-12 dt-col-sm-12 dt-text-sm-center dt-text-center">
					<?php do_action('ploto_footer_copyright_data'); ?>
				</div>	
			</div>
		</div>
	</div>
	<?php
	} 
endif;
add_action( 'ploto_footer_bottom', 'ploto_footer_bottom' );

/*=========================================
Ploto Footer Copyright
=========================================*/
if ( ! function_exists( 'ploto_footer_copyright_data' ) ) :
function ploto_footer_copyright_data() {
	$ploto_footer_copyright_text = get_theme_mod('ploto_footer_copyright_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<?php if(!empty($ploto_footer_copyright_text)): 
			$ploto_copyright_allowed_tags = array(
				'[current_year]' => date_i18n('Y'),
				'[site_title]'   => get_bloginfo('name'),
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'ploto')),
			);
	?>
		<div class="dt_footer_copyright-text">
			<?php
				echo apply_filters('ploto_footer_copyright', wp_kses_post(ploto_str_replace_assoc($ploto_copyright_allowed_tags, $ploto_footer_copyright_text)));
			?>
		</div>
<?php endif;
	} 
endif;
add_action( 'ploto_footer_copyright_data', 'ploto_footer_copyright_data' );

/*=========================================
Ploto Scroller
=========================================*/
if ( ! function_exists( 'ploto_top_scroller' ) ) :
function ploto_top_scroller() {
	$ploto_hs_scroller_option	=	get_theme_mod('ploto_hs_scroller_option','1');
?>		
	<?php if ($ploto_hs_scroller_option == '1') { ?>
		<button type="button" id="dt_uptop" class="dt_uptop">
			<div class="arrowUp">
				<i class="fal fa-arrow-up"></i>
			</div>
			<div class="water" style="transform: translate(0px, 40%);">
				<svg viewBox="0 0 560 20" class="water_wave water_wave_back">
					<use xlink:href="#wave"></use>
				</svg>
				<svg viewBox="0 0 560 20" class="water_wave water_wave_front">
					<use xlink:href="#wave"></use>
				</svg>
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
					viewBox="0 0 560 20" style="display: none;">
					<symbol id="wave">
						<path
							d="M420,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C514,6.5,518,4.7,528.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H420z"
							fill="#"
							style="transition: stroke-dashoffset 10ms linear; stroke-dasharray: 301.839, 301.839; stroke-dashoffset: 119.488px;">
						</path>
						<path
							d="M420,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C326,6.5,322,4.7,311.5,2.7C304.3,1.4,293.6-0.1,280,0c0,0,0,0,0,0v20H420z"
							fill="#"></path>
						<path
							d="M140,20c21.5-0.4,38.8-2.5,51.1-4.5c13.4-2.2,26.5-5.2,27.3-5.4C234,6.5,238,4.7,248.5,2.7c7.1-1.3,17.9-2.8,31.5-2.7c0,0,0,0,0,0v20H140z"
							fill="#"></path>
						<path
							d="M140,20c-21.5-0.4-38.8-2.5-51.1-4.5c-13.4-2.2-26.5-5.2-27.3-5.4C46,6.5,42,4.7,31.5,2.7C24.3,1.4,13.6-0.1,0,0c0,0,0,0,0,0l0,20H140z"
							fill="#"></path>
					</symbol>
				</svg>

			</div>
		</button>
	<?php }
	} 
endif;
add_action( 'ploto_top_scroller', 'ploto_top_scroller' );


function ploto_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ploto_page_menu_args' );
function ploto_fallback_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = 'Home';
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
		{
		$class = 'class="nav-item menu-item active"';
		}
		else
		{
			$class = 'class="nav-item menu-item "';
		}
		$menu .= '<li ' . $class . '><a class="nav-link " href="' . esc_url(home_url( '/' )) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new ploto_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class ploto_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<span class='dt_mobilenav-dropdown-toggle'><button type='button' class='fa fa-angle-right' aria-label='Mobile Dropdown Toggle'></button></span><ul class='dropdown-menu default'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 )
	 {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		if($depth === 0)
		{
			$child_class='nav-link';
		}
		else if($depth > 0)
		{
			$child_class='dropdown-item';
		}
		else
		{
			$child_class='';
		}
		extract($args, EXTR_SKIP);
		if($has_children){
			$css_class = array('menu-item page_item dropdown menu-item-has-children', 'page-item-'.$page->ID);
		}else{
			 $css_class = array('menu-item page_item dropdown', 'page-item-'.$page->ID);
		 }
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'nav-item active';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$output .= $indent . '<li class="nav-item ' . $css_class . '"><a class="' . $child_class . '" href="' . esc_url(get_permalink($page->ID)) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($date_format, $time);
		}
	}
}


// Function to retrieve the post views count
function ploto_get_post_view($post_id) {
    $count = get_post_meta( $post_id, 'post_views_count', true );
    if (!empty($count)) {
        return $count . " views";
    } else {
        return "0 views";
    }
}

// Function to increment the post views count
function ploto_set_post_view() {
    if (is_single()) {  // Only count views on single post page
        $post_id = get_the_ID();
        $key = 'post_views_count';
        $count = (int) get_post_meta( $post_id, $key, true );
        $count++;
        update_post_meta( $post_id, $key, $count );
    }
}
add_action('wp_head', 'ploto_set_post_view');  // Increment views when viewing a single post

// Add custom column for post views in admin posts list
function ploto_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';  // Add "Views" column
    return $columns;
}
add_filter('manage_posts_columns', 'ploto_posts_column_views');

// Display views count in the custom column for posts
function ploto_posts_custom_column_views( $column, $post_id ) {
    if ( $column === 'post_views') {
        echo ploto_get_post_view($post_id);  // Display views in the column
    }
}
add_action( 'manage_posts_custom_column', 'ploto_posts_custom_column_views', 10, 2 ); // Add second argument $post_id


/**
 * Calculate reading time by content length
 */

if ( !function_exists( 'ploto_read_time' ) ):
	function ploto_read_time() {
		global $post;
		$content = get_post_field( 'post_content', $post->ID );
		$word_count = str_word_count( strip_tags( $content ) );
		$readingtime = ceil($word_count / 200);

		if ($readingtime == 1) {
		$timer = " minute Read";
		} else {
		$timer = " minutes Read";
		}
		$totalreadingtime = $readingtime . $timer;

		return $totalreadingtime;
	}
endif;