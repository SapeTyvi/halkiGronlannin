<?php

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="page-secondary" class="widget-area page-sidebar opacity-white" role="complementary">
	<?php if(is_page('blogi')) {dynamic_sidebar( 'sidebar-1' ); }?>
</aside><!-- #page-secondary -->
