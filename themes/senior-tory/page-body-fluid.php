<?php
/**
 * Template Name: Page-body-fluid
 *
 */
//Body 영역만 100% 넓이 적용
get_header();
?>

<?php 
if(ht_get_layout_option('slider_name') != '' && ht_get_layout_option('slider_name') != 'no'){
	echo '<div class="container-fluid">'.do_shortcode('[rev_slider alias="'.ht_get_layout_option('slider_name').'"]').'</div>';
} elseif(ht_get_layout_option('post_heading') != 'hide'){
	echo '<div class="ht-body-head-wrapper ht-layout ht-wrapper"><div class="container-fluid">'.ht_get_post_heading().'</div></div>';
}
?>


<div class="ht-body-wrapper ht-layout ht-wrapper">
	<div class="container-fluid" style="padding:0 !important">
		<div class="ht-body-main ht-body-sidebar-<?php echo ht_get_layout_option('sidebar_position'); ?>">
			<div class="ht-content-wrap">
				<?php if(ht_get_layout_option('sidebar_position') == 'left' || ht_get_layout_option('sidebar_position') == 'dual'): ?>
					<div class="<?php echo ht_get_layout_option('sidebar_class'); ?> ht-sidebar-left">
						<?php get_sidebar('left'); ?>
					</div>
				<?php endif; ?>
				
				<div class="ht-content-fluid responsive-list <?php echo ht_get_layout_option('content_class'); ?>">
					<?php if(have_posts()): while(have_posts()) : the_post(); ?>
						
						<?php get_template_part('template-parts/content','page'); ?>

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