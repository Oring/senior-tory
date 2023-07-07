
	<?php if(is_active_sidebar('footer1') ): ?>
		<div class="ht-widget-panel ht-bottom-widget-panel ht-layout ht-panel"><!-- bottom-widget-panel start -->
			<div class="container">
				<div class="ht-widget-wrap <?php if(ht_get_theme_option('use_footer_widget_inline',null,"on-off")) echo "ht-widget-inline-".ht_get_widget_count('footer1');?>">
	                    <?php dynamic_sidebar( 'footer1' ); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php endif; ?>	

	<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
	<div class="ht-footer-nav-panel">
		<div class="container">
			<div class="ht-menu-wrapper ht-menu-horizontal">				
				<nav id="ht-footer-navigation" class="ht-menu-nav ht-menu-footer ht-footer-navigation" role="navigation" aria-label="Footer Menu">
				<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-menu',
							'menu_class'     => 'footer-menu',
						 ) );
				?>
				</nav>
			</div>
		</div>
	</div>
	<?php endif; ?>	
	
	<?php 
		// Footer
		$footer_type		= ht_get_theme_option('footer_input_type');
		$footer_html		= "";
		if(mbw_get_vars("device_type")!="mobile"){ 					
			if($footer_type=="post"){
				$post_id			= ht_get_theme_option('footer_post_id');
				if(!empty($post_id)){
					$footer_html	= get_post($post_id)->post_content;
				}
			}else{
				$footer_html	= ht_get_theme_option('footer_html_code');
			}
		}else{			//모바일 푸터
			if($footer_type=="post"){
				$post_id			= ht_get_theme_option('footer_post_id_mobile');
				if(!empty($post_id)){
					$footer_html	= get_post($post_id)->post_content;
				}
			}else{
				$footer_html	= ht_get_theme_option('footer_html_code_mobile');
			}
		}
		if(!empty(trim($footer_html))) echo do_shortcode($footer_html);
	?>
	
</div><!-- #ht-main-wrapper -->

<?php if (ht_get_theme_option('use_back_to_top',null,"on-off")): ?>
	<div class="ht-back-to-top">
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</div>
<?php endif ?>

<?php wp_footer() ?>


<script type="text/javascript">
<?php 
	if(ht_get_theme_option('use_back_to_top',null,"on-off")){
		echo 'var use_back_to_top		= true;';
	}else{
		echo 'var use_back_to_top		= false;';
	}
	if(ht_get_theme_option('use_fixed_nav',null,"on-off")){
		echo 'var use_fixed_nav		= true;';
	}else{
		echo 'var use_fixed_nav		= false;';
	}
?>

jQuery( document ).ready(function() {
	//반응형 스크립트
	<?php 
		if (mbw_get_vars("device_type")=="mobile"){
			echo 'jQuery("body").css("max-width", window.innerWidth);jQuery(window).on("orientationchange",function(){jQuery("body").css("max-width", window.innerWidth); });';				
		}
		if (ht_get_theme_option('use_responsive',null,"on-off")){ 
			echo ht_get_resize_responsive();
		}
		if (ht_get_theme_option('use_nice_scroll',null,"on-off")){ 
			//echo 'jQuery("body").niceScroll({hidecursordelay: 500,scrollspeed: 50,cursorwidth: "7px",mousescrollstep: 40, cursorcolor: "#888",cursorborder: "1px solid #999",horizrailenabled:false});';
		}
		echo ht_get_theme_option('custom_javascript_text');
	?>
	function resizeVideoHeight(){ 
        if ( jQuery(window).width() < 760 ) {
            jQuery(".video-container>iframe").each(function(){ 
				if(jQuery(this).attr("width")=="100%"){
					jQuery(this).css("height", Math.ceil( parseInt(jQuery(this).css("width")) * 0.625 ) + "px");                     
				}else{
					jQuery(this).css("height", Math.ceil( parseInt(jQuery(this).css("width")) * parseInt(jQuery(this).attr("height")) / parseInt(jQuery(this).attr("width")) ) + "px");                     
				}				
            }); 
        }
    }
	resizeVideoHeight();
	jQuery(window).resize(function(){
		resizeVideoHeight();
	});
});
</script>
</body>
</html>