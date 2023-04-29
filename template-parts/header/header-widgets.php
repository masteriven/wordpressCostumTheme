<?php

if ( is_active_sidebar( 'sidebar-2' ) ) :
	?>

	<aside class="widget-area" aria-label="<?php esc_attr_e( 'Header', 'talrimertheme' ); ?>">
		<?php
		if ( is_active_sidebar( 'sidebar-2' ) ) {
			?>
					<div class="widget-column header-widget">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					</div>
				<?php
		}
		?>
	</aside><!-- .widget-area -->

	<?php
endif;
