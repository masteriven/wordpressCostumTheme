<?php

$discussion    = talrimer_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %d: Number of comments. */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses, 'talrimer' ), $discussion->responses );
} else {
	$meta_label = __( 'No comments', 'talrimer' );
}
?>

<div class="discussion-meta">
	<?php
	if ( $has_responses ) {
		talrimer_discussion_avatars_list( $discussion->authors );
	}
	?>
	<p class="discussion-meta-info">
		<?php echo talrimer_get_icon_svg( 'comment', 24 ); ?>
		<span><?php echo esc_html( $meta_label ); ?></span>
	</p>
</div><!-- .discussion-meta -->
