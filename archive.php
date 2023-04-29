<?php

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header>

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'excerpt' );

			endwhile;

			twentynineteen_the_posts_navigation();

		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main>
	</div>

<?php
get_footer();
