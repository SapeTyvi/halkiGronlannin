<?php



if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<aside id="admin-sidebar-secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</aside><!-- #admin-sidebar-secondary -->
