<?php

function talrimer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'talrimer_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'talrimer_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Primary color.
	 */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => 'default',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'talrimer_sanitize_color_option',
		)
	);

	$wp_customize->add_control(
		'primary_color',
		array(
			'type'     => 'radio',
			'label'    => __( 'Primary Color', 'talrimer' ),
			'choices'  => array(
				'default' => _x( 'Default', 'primary color', 'talrimer' ),
				'custom'  => _x( 'Custom', 'primary color', 'talrimer' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);

	// Add primary color hue setting and control.
	$wp_customize->add_setting(
		'primary_color_hue',
		array(
			'default'           => 199,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_hue',
			array(
				'description' => __( 'Apply a custom color for buttons, links, featured images, etc.', 'talrimer' ),
				'section'     => 'colors',
				'mode'        => 'hue',
			)
		)
	);

	// Add image filter setting and control.
	$wp_customize->add_setting(
		'image_filter',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_setting( 'Fonts', array( 'default' => '' ) );

	$wp_customize->add_section(
		'Fonts',
		array(
			'title' => __( 'Fonts', '_s' ),
			'priority' => 30,
			'description' => __( 'Choose The Main Font In Your Site.', '_s' )
		)
	);


	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'Fonts',
			array(
				'label' => __( 'Choose Font', '_s' ),
				'section' => 'Fonts',
				'type' => 'select',
				'choices' => array(
				  'Arial, sans-serif' => 'Ariel',
				  'Helvetica, sans-serif' => 'Helvetica',
				  'Verdana, sans-serif' => 'Verdana',
				  'Calibri, sans-serif' => 'Calibri',
				  'Noto, sans-serif' => 'Noto',
				  'Lucida Sans, sans-serif, sans-serif' => 'Lucida Sans',
				  'Gill Sans, sans-serif' => 'Gill Sans',
				  'Century Gothic, sans-serif' => 'Century Gothic',
				  'Candara, sans-serif' => 'Candara',
				  'Futara, sans-serif' => 'Futara',
				  'Franklin Gothic Medium, sans-serif' => 'Franklin Gothic Medium',
				  'Trebuchet MS, sans-serif' => 'Trebuchet MS',
				  'Geneva, sans-serif' => 'Geneva',
				  'Segoe UI, sans-serif' =>'Segoe UI',
				  'Optima, sans-serif' => 'Optima',
				  'Avanta Garde, sans-serif' => 'Avanta Garde',

				),
				'settings' => 'Fonts'
			)
		)
	);
	$getfonts = get_theme_mod('Fonts');
	
	
}
add_action( 'customize_register', 'talrimer_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function talrimer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function talrimer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function talrimer_customize_preview_js() {
	wp_enqueue_script( 'talrimer-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '20181214', true );
}
add_action( 'customize_preview_init', 'talrimer_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function talrimer_panels_js() {
	wp_enqueue_script( 'talrimer-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20181214', true );
}
add_action( 'customize_controls_enqueue_scripts', 'talrimer_panels_js' );

/**
 * Sanitize custom color choice.
 *
 * @param string $choice Whether image filter is active.
 * @return string
 */
function talrimer_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}

	return 'default';
}
