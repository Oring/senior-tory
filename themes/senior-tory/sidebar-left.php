<div class="ht-widget-panel ht-side-widget-panel ht-layout ht-panel">
	<div class="ht-widget-wrap">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(ht_get_layout_option('sidebar_name1')) ) :   
			dynamic_sidebar(ht_get_layout_option('sidebar_name1'));  
		else :   
			/* No widgets */  
		endif; ?>
	</div>
</div>
