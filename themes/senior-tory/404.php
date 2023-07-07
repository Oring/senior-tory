<?php
	get_header();
?>

<div class="ht-body-wrapper ht-layout ht-wrapper">
	<div class="container">
		<div class="ht-body-main">
			<div class="ht-content responsive-list <?php echo ht_get_layout_option('content_class'); ?>">
				<div class="ht-content-none">
					<header class="ht-content-header">
						<h1 class="ht-content-title"><?php _e( 'Page Not Found', HT_THEME ); ?></h1>
					</header><!-- .page-header -->
					<div class="ht-content-body">
						<div class="post-0 ht-error404">
							<div class="ht-post-wrap">
								<div class="ht-post-header">404</div>
								<div class="ht-post-body">
									<div class="ht-post-body-msg1"><?php _e( '요청하신 페이지를 찾을 수 없습니다', HT_THEME ) ?></div>
									<div class="ht-post-body-msg2">
										<a href="javascript:history.back();"><span class="ht-post-body-msg-btn">❮ <?php _e( ' 이전 페이지', HT_THEME ) ?></span></a>
										<a href="/"><span class="ht-post-body-msg-btn"><?php _e( '메인 페이지', HT_THEME ) ?> ❯</span></a>
									</div>
									
								</div>
							</div>						
						</div><!-- .post -->

					</div><!-- .ht-content-body -->
				</div><!-- .ht-content-item -->
			</div><!-- .ht-content -->
			<div class="clear"></div>	
		</div><!-- .ht-body-main -->
	</div><!-- .container -->
</div><!-- .ht-body-wrapper -->
<?php get_footer() ?>