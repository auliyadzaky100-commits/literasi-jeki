<?php 
$ploto_hs_site_breadcrumb   = get_theme_mod('ploto_hs_site_breadcrumb','1');
$ploto_breadcrumb_bg_img	= get_theme_mod('ploto_breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/pagetitle.jpg'));	
$ploto_breadcrumb_type    	= get_theme_mod('ploto_breadcrumb_type','theme');
$ploto_breadcrumb_style   = get_theme_mod('ploto_breadcrumb_style','center');
if($ploto_hs_site_breadcrumb == '1'):	
?>
<section id="dt_pagetitle" class="dt_pagetitle dt-text-<?php echo esc_attr($ploto_breadcrumb_style); ?>">
	<div class="dt_pagetitle_bgimage" style="background-image: url('<?php echo esc_url($ploto_breadcrumb_bg_img); ?>');"></div>
	<div class="dt-container">
		<div class="dt_pagetitle_content">
			<?php if($ploto_breadcrumb_type == 'yoast' && (function_exists('yoast_breadcrumb'))):  yoast_breadcrumb(); ?>
			<?php elseif($ploto_breadcrumb_type == 'rankmath' && (function_exists('rank_math_the_breadcrumbs'))):  rank_math_the_breadcrumbs(); ?>	
			<?php elseif($ploto_breadcrumb_type == 'navxt' && (function_exists('bcn_display'))):  bcn_display(); else: ?>
				<div class="title">
					<?php
						if(is_home() || is_front_page()) {
							echo '<h1>'; echo single_post_title(); echo '</h1>';
						} else {
							ploto_theme_page_header_title();
						} 
					?>
				</div>
				<ul class="dt_pagetitle_breadcrumb">
					<?php ploto_page_header_breadcrumbs(); ?>
				</ul>
			<?php endif; ?>	
		</div>
		<div class="image-box dt-d-lg-block dt-d-none">
			<div class="shapes">
				<div class="shape shape-1">
					<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
						<path fill="currentColor"
							d="M11 0c6.075 0 11 4.925 11 11s-4.925 11-11 11S0 17.075 0 11 4.925 0 11 0m0 4.25a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5" />
					</svg>
				</div>
				<div class="shape shape-2 spin"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/flower.png" alt=""></div>
				<div class="shape shape-3 ">
					<svg xmlns="http://www.w3.org/2000/svg" width="50" height="41" viewBox="0 0 50 41">
						<path fill="currentColor"
							d="M46.873.043a2.5 2.5 0 0 1 2.915 2c.515 2.768.107 5.617-1.415 7.754-1.61 2.263-4.264 3.42-7.372 2.906-.344-.057-.843-.18-1.193-.262a19 19 0 0 0-1.348-.272c-.999-.158-1.867-.174-2.503.003-.499.14-.835.374-1.073.975-.303.767-.507 2.323.093 5.23.497 2.404.351 4.865-.882 6.76-1.348 2.073-3.64 2.928-6.13 2.593l-.053-.007-.054-.01c-1.59-.285-3.014-.878-4.204-1.43-1.3-.6-2.163-1.065-3.109-1.421-.878-.331-1.44-.401-1.863-.337-.361.055-.906.25-1.663 1.064-.44.474-.736 1.347-.866 3.082-.064.849-.08 1.66-.126 2.66-.044.937-.115 1.977-.305 2.992-.388 2.068-1.352 4.384-3.934 5.69-2.37 1.198-5.596 1.261-9.774.433a2.5 2.5 0 0 1 .973-4.904c3.856.764 5.7.436 6.546.008.634-.32 1.035-.867 1.275-2.148.124-.66.183-1.415.225-2.303.038-.823.063-1.866.133-2.803.139-1.84.49-4.28 2.19-6.11 1.358-1.461 2.876-2.346 4.576-2.604 1.639-.249 3.139.135 4.375.6 1.169.44 2.473 1.114 3.447 1.565 1.063.492 2.004.86 2.935 1.034.457.053.726-.01.865-.068a.73.73 0 0 0 .35-.302c.247-.38.525-1.333.175-3.024-.687-3.327-.665-6.009.157-8.082.886-2.238 2.574-3.446 4.378-3.949 1.667-.465 3.383-.323 4.63-.125.649.103 1.235.232 1.694.339.528.122.745.178.88.2 1.29.214 2.02-.222 2.482-.872.551-.775.904-2.158.572-3.94A2.5 2.5 0 0 1 46.873.043" />
					</svg>
				</div>
				<div class="shape shape-4 jump"><img src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/dots.png" alt=""></div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>	