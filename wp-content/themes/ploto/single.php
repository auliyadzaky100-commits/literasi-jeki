<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ploto
 */
get_header();
$ploto_enable_post_cat		= get_theme_mod('ploto_enable_post_cat','1'); 
$ploto_enable_post_date		= get_theme_mod('ploto_enable_post_date','1'); 
$ploto_enable_post_author	= get_theme_mod('ploto_enable_post_author','1'); 
$ploto_enable_post_comments	= get_theme_mod('ploto_enable_post_comments'); 
$ploto_enable_post_views	= get_theme_mod('ploto_enable_post_views'); 
$ploto_enable_post_rt		= get_theme_mod('ploto_enable_post_rt'); 
$ploto_enable_post_tag		= get_theme_mod('ploto_enable_post_tag'); 
$ploto_enable_post_ttl		= get_theme_mod('ploto_enable_post_ttl','1');
?>
<section id="dt_posts" class="dt_posts dt-py-default">
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<?php if (  !is_active_sidebar( 'ploto-sidebar-primary' ) ): ?>
				<div class="dt-col-lg-12 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php else: ?>	
				<div id="dt-main" class="dt-col-lg-8 dt-col-md-12 dt-col-12 wow fadeInUp">
			<?php endif; ?>	
				<div class="dt-row dt-g-4">
					<div class="dt-col-lg-12 dt-col-sm-12 dt-col-12"> 
						<?php 
							if( have_posts() ): 
							// Start the loop.
							while( have_posts() ): the_post();
						?>
						<article id="post-1" class="post-1 post single-post dt-mb-4">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="image">
									<?php the_post_thumbnail(); ?>
									<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
								</div>
							<?php } ?>
							
							<div class="inner">
								<?php if($ploto_enable_post_cat=='1'): ?>
									<div class="category">
										<i class="far fa-tags"></i>
										<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
									</div>
								<?php endif; ?>
								<?php     
									if($ploto_enable_post_ttl=='1'):
										the_title('<h3 class="title">', '</h3>' );
									endif; 
								?> 
								<div class="meta">
									<ul>    
										<?php if($ploto_enable_post_date=='1'): ?>
											<li>
												<div class="date">
													<i class="far fa-calendar" aria-hidden="true"></i> 
													<?php echo esc_html(get_the_date()); ?>
												</div>
											</li>
										<?php endif; ?>	
										
										<?php if($ploto_enable_post_author=='1'): ?>
											<li>
												<div class="author">                                                    
													<i class="far fa-user" aria-hidden="true"></i>
													<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><span><?php esc_html(the_author()); ?></span></a>
												</div>
											</li>
										<?php endif; ?>	
										
										<?php if($ploto_enable_post_comments=='1'): ?>
											<li><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
										<?php endif; ?>	
										
										<?php if($ploto_enable_post_views=='1'): ?>
											<li><i class="far fa-eye"></i> <?php echo wp_kses_post(ploto_get_post_view(get_the_ID())); ?></li>
										<?php endif; ?>	
										
										<?php if($ploto_enable_post_rt=='1'): ?>
											<li><i class="fa-solid fa-eye"></i> <?php echo esc_html(ploto_read_time()); ?></li>
										<?php endif; ?>
									</ul>
								</div>
								<div class="content">
									<?php the_content(); ?>
								</div>
							</div>
						</article>
						<?php 
							endwhile; // End the loop.
							endif; 
						?>
						<div class="dt-row nav-post-wrapper">
							<?php
							  the_post_navigation(array(
								'prev_text' => '<div class="nav-prev"><h5 class="title"><i class="far fa-arrow-left"></i> %title </h5></div>',
								'next_text' => '<div class="nav-next"><h5 class="title"> %title <i class="far fa-arrow-left"></i></h5></div>',
								'in_same_term' => true,
							  ));
							?>
						</div>
					</div>
						<?php comments_template( '', true ); // show comments  ?>
					</div>
				</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>