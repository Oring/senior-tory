<div class="ht-content-none">
	<header class="ht-content-header">
		<h1 class="ht-content-title"><?php _e( 'Nothing Found', HT_THEME ); ?></h1>
	</header><!-- .page-header -->

	<div class="ht-content-body">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( '첫 번째 게시물을 게시하시겠습니까? <a href="%1$s">시작하기</a>.', HT_THEME ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<div class="post-0 ht-no-results">
				<div class="ht-post-wrap">
					<div class="ht-post-header">Try again</div>
					<div class="ht-post-body">
						<div class="ht-post-body-msg1"><?php _e( '죄송합니다. 검색과 일치하는 항목이 없습니다.', HT_THEME ) ?></div>
						<div class="ht-post-body-msg2"><?php _e( '다른 키워드를 사용하여 다시 시도하십시오.', HT_THEME ) ?></div>
						<form id="ht-search-form" class="ht-search-form" method="get" action="<?php echo home_url(); ?>">
							<div>
								<input id="s-no-results" name="s" class="text" type="text" value="<?php the_search_query() ?>" size="40" />
								<input class="button" type="submit" value="<?php _e( '검색', HT_THEME ) ?>" />
							</div>
						</form>
				</div>				
			</div>

		<?php else : ?>
			<p><?php _e( 'No posts were found!', HT_THEME ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .ht-content-body -->

</div><!-- .ht-content-item -->
