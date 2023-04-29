<?php
/* Template Name: Events Archive Page */
get_header(); ?>

<div class="clear"></div>
</header> 

<div id="content" class="site-content">
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

			talrimer_the_posts_navigation();

		else :
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main>
<?php
//Show Events
$args  = array(
			'post_type' => 'events',
			'post_status'=>'publish'
		 );
	
		  $getPosts = get_posts($args);
		  foreach ($getPosts as $post){
			$getEventDate = get_post_meta($post->ID,'event_date',true);
			$getEventTime = get_post_meta($post->ID,'event_time',true);
			$getEventLocation = get_post_meta($post->ID,'event_location',true);

            ?>
               <style>
                   .eventsTable td{
                    width:100px;
                    text-align:center;
                    }
               </style>
            <?php

			 echo '<Table class="eventsTable" style="width:600px; margin:0 auto;">
              <thead>
               <th>Title</th>
               <th>Date</th>
               <th>Time</th>
               <th>Location</th>
              </thead>
              <tbody>
               <td  class="post-title">'.$post->post_title.'</td>
               <td  class="post-date">'.$getEventDate.'</td>
               <td  class="post-time">'.$getEventTime.'</td>
               <td  class="post-location">'.$getEventLocation.'</td>
              </tbody>
			 </Table>';
	}



    ?>

</div>

<?php get_footer(); ?>