<div class="ht-widget-panel ht-side-widget-panel ht-layout ht-panel">
	<div class="ht-widget-wrap">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("main-sidebar") ) :   
			dynamic_sidebar("main-sidebar");  
		else :   
			/* No widgets */  
		endif; ?>
	</div>
</div>