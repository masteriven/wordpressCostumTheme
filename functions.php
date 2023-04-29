<?php

add_action('wp',function(){
	$getfonts = get_theme_mod('Fonts');

 ?>
	<style>
		.author-description .author-link, .comment-metadata, .comment-reply-link, .comments-title, .comment-author .fn, .discussion-meta-info, .entry-meta, .entry-footer, .main-navigation, .no-comments, .not-found .page-title, .error-404 .page-title, .post-navigation .post-title, .page-links, .page-description, .pagination .nav-links, .sticky-post, .site-title, .site-info, #cancel-comment-reply-link, h1, h2, h3, h4, h5, h6{
			font-family: <?php echo $getfonts .' !important'?> ;
		}
	</style>
 <?php

});

if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'talrimer_setup' ) ) :

	function talrimer_setup() {
	
		load_theme_textdomain( 'talrimer', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'talrimer' ),
				'footer' => __( 'Footer Menu', 'talrimer' ),
				'header' => __( 'Header Menu', 'talrimer' ),
				'social' => __( 'Social Links Menu', 'talrimer' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'talrimer' ),
					'shortName' => __( 'S', 'talrimer' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'talrimer' ),
					'shortName' => __( 'M', 'talrimer' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'talrimer' ),
					'shortName' => __( 'L', 'talrimer' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'talrimer' ),
					'shortName' => __( 'XL', 'talrimer' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'talrimer' ) : null,
					'slug'  => 'primary',
					// 'color' => talrimer_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'talrimer' ) : null,
					'slug'  => 'secondary',
					// 'color' => talrimer_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'talrimer' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'talrimer' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'talrimer' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height.
		add_theme_support( 'custom-line-height' );
	}
endif;
add_action( 'after_setup_theme', 'talrimer_setup' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :

	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'talrimer' );
	}
endif;

function talrimer_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'talrimertheme' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'talrimertheme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		),
		
	);

	register_sidebar(
		array(
			'name'          => __( 'Header', 'talrimertheme' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your header.', 'talrimertheme' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'talrimer_widgets_init' );


function talrimer_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. Only visible to screen readers. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'talrimer' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'talrimer_excerpt_more' );

function talrimer_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'talrimer_content_width', 640 );
}
add_action( 'after_setup_theme', 'talrimer_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function talrimer_scripts() {
	wp_enqueue_style( 'talrimer-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'talrimer-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'talrimer-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '20200129', true );
		wp_enqueue_script( 'talrimer-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '20221101', true );
	}

	wp_enqueue_style( 'talrimer-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'talrimer_scripts' );

function talrimer_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'talrimer_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function talrimer_editor_customizer_styles() {

	wp_enqueue_style( 'talrimer-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'talrimer-editor-customizer-styles', talrimer_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'talrimer_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function talrimer_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	   $getfonts = get_theme_mod('Fonts');
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo talrimer_custom_colors_css(); ?>
		.author-description .author-link, .comment-metadata, .comment-reply-link, .comments-title, .comment-author .fn, .discussion-meta-info, .entry-meta, .entry-footer, .main-navigation, .no-comments, .not-found .page-title, .error-404 .page-title, .post-navigation .post-title, .page-links, .page-description, .pagination .nav-links, .sticky-post, .site-title, .site-info, #cancel-comment-reply-link, h1, h2, h3, h4, h5, h6{
			font-family: <?php echo $getfonts .' !important'?> ;
		}
	</style>
	<?php
}

function createEventsPostType(){
	register_post_type('events',
		array(
			'labels' => array(
			'name' => __('Events'),
			'singular_name' => __('Events'),
			'edit_item' => __('Edit Event'),
			'add_new_item' => __('New Event'),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => false,
			),
		);
}

add_action('init','createEventsPostType');

add_action( 'wp_head', 'talrimer_colors_css_wrap' );


function costumeMetaFields(){
	add_meta_box( 'costumeMetaFields', __( 'Fields','' ),'metaFieldsRender', ['page', 'Events'] );
}
add_action('add_meta_boxes', 'costumeMetaFields',10,1 );
	

function metaFieldsRender($post){
	$getDate = get_post_meta($post->ID,'event_date',true);
	$getTime = get_post_meta($post->ID,'event_time',true);
	$getLocation = get_post_meta($post->ID,'event_location',true);

	?>
	<div class="date_section">
	<label for="date">Date</label>
	<input type="date" value="<?php echo  $getDate ?>" class="dateInputEvent" name="dateInputEvent" id="date">
	</div>
	<br>
	<div class ="time_section">
	<label for="time">Time</label>
	<input type="time" value="<?php echo $getTime ?>" class="timeInputEvent" name="timeInputEvent" id="time" >
	</div>
	<br>
	<div class ="location_section">
	<label for="location">Location</label>
	<input type="text"  value="<?php echo $getLocation ?>" class="locationInputEvent" name="locationInputEvent" id="location" >
	</div>
	<?php
}


function saveEventPostType($post_id){
    if(isset($_POST['date']) !== null){
		update_post_meta($post_id,'event_date',$_POST['dateInputEvent']);
	 }
	 
	 if(isset($_POST['time']) !== null){
	   update_post_meta($post_id,'event_time',$_POST['timeInputEvent']);
	 }
   
	 if(isset($_POST['location']) !== null){
	   update_post_meta($post_id,'event_location',$_POST['locationInputEvent']);
	 }
 }

add_action('save_post','saveEventPostType',10,1);


//Events Widget


class events_widget extends WP_Widget {
 
	function __construct() {
	parent::__construct(
	 
	'events_widget', 
	 
	__('Show Events', ''), 
	 
	array( 'description' => __( 'Show The Events', '' ), )
	);

	function getEventsPosts(){
		$args  = array(
			'post_type' => 'events',
			'post_status'=>'publish'
		 );
	
		  $getPosts = get_posts($args);
		  foreach ($getPosts as $post){
			$getEventDate = get_post_meta($post->ID,'event_date',true);
			$getEventTime = get_post_meta($post->ID,'event_time',true);
			$getEventLocation = get_post_meta($post->ID,'event_location',true);
	
			 echo '<div>
			  <h4 class="post-title">'.$post->post_title.'</h4>
			  <p style="font-size:16px" class="post-title">'.$post->post_content.'</p>
			  <p style="font-size:16px" class="event-date">Event Date: '.$getEventDate.'</p>
			  <p style="font-size:16px" class="event-time">Event Time: '.$getEventTime.'</p>
			  <p style="font-size:16px" class="event-location">Event Location: '.$getEventLocation.'</p>
			 </div>';
		  }

		}
	}

	public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	 
	echo $args['before_widget'];
	if ( ! empty( $title ) )
	echo $args['before_title'] . $title . $args['after_title'];
	 
		getEventsPosts();
	}
	 
	public function form( $instance ) {
	
		getEventsPosts();

	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	 
	} 
	 
	function events_load_widget() {
		register_widget( 'events_widget' );
	}
	add_action( 'widgets_init', 'events_load_widget' );

/**
 * SVG Icons class.
 */
// require get_template_directory() . '/classes/class-talrimer-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
// require get_template_directory() . '/classes/class-talrimer-walker-comment.php';

/**
 * Common theme functions.
 */
// require get_template_directory() . '/inc/helper-functions.php';

/**
 * SVG Icons related functions.
 */
// require get_template_directory() . '/inc/icon-functions.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for the theme.
 */
// require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns.
 */
// require get_template_directory() . '/inc/block-patterns.php';
