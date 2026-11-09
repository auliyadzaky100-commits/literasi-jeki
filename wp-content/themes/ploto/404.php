<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Ploto
 */
get_header();
?>
<section id="dt_not_found" class="dt_not_found dt-py-default">
	<div class="dt-container">
		<div class="dt-row">
			<div class="dt-col-lg-8 dt-col-md-12 dt-mx-auto dt-text-center">
				<div class="title-wrap" data-wow-duration="1.5s" data-wow-delay=".4s">
				
					<h1 class="big-title"><?php esc_html_e('404','ploto'); ?></h1>
					
					<h2><?php esc_html_e('Opps! Page Not Found','ploto'); ?></h2>
					
					<p><?php esc_html_e('The page you are looking for does not exist. It might have been moved or deleted.','ploto'); ?></p>
					
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dt-btn dt-btn-primary"><?php esc_html_e('Back to Home','ploto'); ?> <i class="fal fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
