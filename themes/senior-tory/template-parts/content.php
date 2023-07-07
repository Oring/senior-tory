<?php global $authordata;?>
<div class="ht-content-item">

	<header class="ht-content-header"></header>

	<div class="ht-content-body post-<?php the_ID() ?>" class="<?php ht_post_class() ?>">
		<h3 class="ht-post-title"><a href="<?php the_permalink() ?>" title="<?php printf( __( 'Permalink to %s', HT_THEME ), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
		<div class="ht-post-date "><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php unset($previousday); printf( __( '%1$s &#8211; %2$s', HT_THEME ), the_date( '', '', '', false ), get_the_time() ) ?></abbr></div>
		<div class="ht-post-body ">
			<?php the_excerpt( __( 'Read More <span class="meta-nav">&raquo;</span>', HT_THEME ) ) ?>
		</div>

		<?php if ( $post->post_type == 'post' ) { ?>
		<div class="ht-post-meta">
			<span class="author vcard"><?php printf( __( 'By %s', HT_THEME ), '<a class="url fn n" href="' . get_author_posts_url( $authordata->ID, $authordata->user_nicename ) . '" title="' . sprintf( __( 'View all posts by %s', HT_THEME ), $authordata->display_name ) . '">' . get_the_author() . '</a>' ) ?></span>
			<span class="meta-sep">|</span>
			<span class="cat-links"><?php printf( __( 'Posted in %s', HT_THEME ), get_the_category_list(', ') ) ?></span>
			<span class="meta-sep">|</span>
			<?php the_tags( __( '<span class="tag-links">Tagged ', HT_THEME ), ", ", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n" ) ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Comments (0)', HT_THEME ), __( 'Comments (1)', HT_THEME ), __( 'Comments (%)', HT_THEME ) ) ?></span>
		</div>
		<?php } ?>

	</div><!-- .ht-content-body -->


	<div class="ht-content-footer">	</div>

</div><!-- .ht-content-item-->