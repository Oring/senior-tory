<?php
	get_header();
?>

<div class="ht-body-head-wrapper ht-layout ht-wrapper">
	<div class="container">
	<?php if(ht_get_layout_option('slider_name') != '' && ht_get_layout_option('slider_name') != 'no'): ?>	
		<?php echo do_shortcode('[rev_slider alias="'.ht_get_layout_option('slider_name').'"]'); ?>	
	<?php elseif(ht_get_layout_option('post_heading') != 'hide'): ?>		
		<?php echo ht_get_post_heading(); ?>
	<?php endif; ?>
	</div>
</div>


<div class="ht-body-wrapper ht-layout ht-wrapper">
	<div class="container">
		<div class="ht-body-main ht-body-sidebar-<?php echo ht_get_layout_option('sidebar_position'); ?>">
			<div class="ht-content-wrap">
				<?php if(ht_get_layout_option('sidebar_position') == 'left' || ht_get_layout_option('sidebar_position') == 'dual'): ?>
					<div class="<?php echo ht_get_layout_option('sidebar_class'); ?> ht-sidebar-left">
						<?php get_sidebar('left'); ?>
					</div>
				<?php endif; ?>
				
				<div class="ht-content responsive-list <?php echo ht_get_layout_option('content_class'); ?>">
					<?php if(have_posts()): while(have_posts()) : the_post(); ?>

						<?php						
						get_template_part( 'template-parts/content', 'single' );

						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

						if ( is_singular( 'attachment' ) ) {
							the_post_navigation( array(
								'prev_text' => _x( '<span class="ht-meta-nav">Published in</span><span class="ht-post-title">%title</span>', 'Parent post link', HT_THEME ),
							) );
						} elseif ( is_singular( 'post' ) ) {
							the_post_navigation( array(								
								'prev_text' => '<span class="ht-meta-nav">' . __( '이전글', HT_THEME ) . '</span>&nbsp;&nbsp;'.
									'<span class="screen-reader-text">' . __( 'Prev post:', HT_THEME ) . '</span>' .
									'<span class="ht-post-title">%title</span>',
								'next_text' => '<span class="ht-post-title">%title</span>'.
									'<span class="screen-reader-text">' . __( 'Next post:', HT_THEME ) . '</span> ' .
									'&nbsp;&nbsp;<span class="ht-meta-nav">' . __( '다음글', HT_THEME ) . '</span> ' ,
							) );
						}
						?>						
					<?php endwhile; else: ?>
						<?php get_template_part('template-parts/content','none'); ?>
					<?php endif; ?>
				</div>
				
				<?php if(ht_get_layout_option('sidebar_position') == 'right' || ht_get_layout_option('sidebar_position') == 'dual'): ?>
					<div class="<?php echo ht_get_layout_option('sidebar_class'); ?> ht-sidebar-right">
						<?php get_sidebar('right'); ?>
					</div>
				<?php endif; ?>
			</div><!-- end ht-content-wrap -->

		</div>	
		<div class="clear"></div>	
	</div><!-- end container -->
</div>

<?php
	get_footer();
?>