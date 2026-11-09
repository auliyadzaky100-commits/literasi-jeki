<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ploto
 */
$ploto_enable_post_excerpt	= get_theme_mod('ploto_enable_post_excerpt','1'); 
$ploto_enable_post_cat		= get_theme_mod('ploto_enable_post_cat','1'); 
$ploto_enable_post_date		= get_theme_mod('ploto_enable_post_date','1'); 
$ploto_enable_post_author	= get_theme_mod('ploto_enable_post_author','1'); 
$ploto_enable_post_comments	= get_theme_mod('ploto_enable_post_comments','1'); 
$ploto_enable_post_views	= get_theme_mod('ploto_enable_post_views'); 
$ploto_enable_post_rt		= get_theme_mod('ploto_enable_post_rt'); 
$ploto_enable_post_tag		= get_theme_mod('ploto_enable_post_tag'); 
$ploto_enable_post_ttl		= get_theme_mod('ploto_enable_post_ttl','1'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('dt_post_item dt_posts--one'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="image">
			<?php the_post_thumbnail(); ?>
			<?php the_post_thumbnail(); ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="image-link"></a>
		</div>
	<?php } ?>
	<div class="inner">
		<div class="meta">
			<ul>
				<?php if($ploto_enable_post_cat=='1'): ?>
					<li>
						<div class="category">
							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="category tag"><?php the_category(' , '); ?></a>
						</div>
					</li>
				<?php endif; ?>	
				
				<?php if($ploto_enable_post_date=='1'): ?>
					<li>
						<div class="date">
							<?php echo esc_html(get_the_date()); ?>
						</div>
					</li>
				<?php endif; ?>	
				
				<?php if($ploto_enable_post_views=='1'): ?>
					<li><i class="far fa-eye"></i> <?php echo wp_kses_post(ploto_get_post_view(get_the_ID())); ?></li>
				<?php endif; ?>	
				
				<?php if($ploto_enable_post_rt=='1'): ?>
					<li><i class="fa-solid fa-eye"></i> <?php echo esc_html(ploto_read_time()); ?></li>
				<?php endif; ?>
				
				<?php if($ploto_enable_post_tag=='1'): ?>
					<li>
						<i class="fa-solid fa-tag"></i>
						<?php
							$posttags = get_tags();
							if($posttags):
								foreach($posttags as $index=>$tag){
									if($index>5){break;}
									echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">' .esc_html($tag->name). '</a>, ';
								}
							endif; 
						 ?>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php     
			if($ploto_enable_post_ttl=='1'):
				if ( is_single() ) :
				
				the_title('<h5 class="title">', '</h5>' );
				
				else:
				
				the_title( sprintf( '<h5 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
				
				endif; 
			endif; 
		?> 
		<div class="content">
			<?php 
			  if($ploto_enable_post_excerpt == '1' && !is_single()):
			  
				the_excerpt();
				if ( function_exists( 'ploto_execerpt_btn' ) ) : ploto_execerpt_btn(); endif; 
				
				else:
				
				the_content( 
						sprintf( 
							__( 'Read More', 'ploto' ), 
							'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
						) 
					);
					
				endif;	
			?>
		</div>
		<div class="meta meta-down">
			<ul>
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
			</ul>
		</div>
	</div>
</article>