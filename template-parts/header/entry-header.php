<?php


// $discussion = ! is_page() && talrimer_can_show_post_thumbnail() ? talrimer_get_discussion_data() : null; ?>

<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

<?php
if ( ! is_page() ) :
	?>
<div class="entry-meta">
	<!-- <?php talrimer_posted_by(); ?> -->
	<?php talrimer_posted_on(); ?>
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			// talrimer_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php talrimer_comment_count(); ?>
	</span>
	<?php
		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Post title. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'talrimer' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">' . talrimer_get_icon_svg( 'edit', 16 ),
			'</span>'
		);
	?>
</div><!-- .entry-meta -->
	<?php
endif;
