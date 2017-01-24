<?php
/**
 * Add the checkout theme customization options to the WordPress Customizer.
 *
 * @package checkout
 */

 /**
  * @TODO
  */
function checkout_remove_contorl( $wp_customize ) {
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'customize_register', 'checkout_remove_contorl', 11 );


/**
 * @TODO
 */
function checkout_customizer_options() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$options['accent-color'] = array(
		'id' => 'accent-color',
		'label'   => __( 'Accent Color', 'checkout' ),
		'section' => 'colors',
		'type'    => 'color',
		'default' => '#15ab15'
	);

	$options['accent-hover-color'] = array(
		'id' => 'accent-hover-color',
		'label'   => __( 'Accent Hover Color', 'checkout' ),
		'section' => 'colors',
		'type'    => 'color',
		'default' => '#0d842b'
	);

	// @todo
	$section = 'social-media';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Social Media Icons', 'checkout' ),
		'priority' => '10'
	);

	$options['social_header_display'] = array(
	    'id' => 'social_header_display',
	    'label'   => __( 'Display in Header?', 'checkout' ),
	    'section' => $section,
		'type'    => 'select',
	    'choices' => array(
			0 => 'Hide',
			1 => 'Display',
		),
	    'default' => 0,
	);

	$options['social_footer_display'] = array(
	    'id' => 'social_footer_display',
	    'label'   => __( 'Display in Footer?', 'checkout' ),
	    'section' => $section,
		'type'    => 'select',
	    'choices' => array(
			0 => 'Hide',
			1 => 'Display',
		),
	    'default' => 0,
	);

	$options['facebook-url'] = array(
		'id' => 'facebook-url',
		'label'   => __( 'Facebook URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['twitter-url'] = array(
		'id' => 'twitter-url',
		'label'   => __( 'Twitter URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['instagram-url'] = array(
		'id' => 'instagram-url',
		'label'   => __( 'Instagram URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['youtube-url'] = array(
		'id' => 'youtube-url',
		'label'   => __( 'YouTube URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['pinterest-url'] = array(
		'id' => 'pinterest-url',
		'label'   => __( 'Pinterest URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['rss-url'] = array(
		'id' => 'rss-url',
		'label'   => __( 'RSS URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['mail-url'] = array(
		'id' => 'mail-url',
		'label'   => __( 'Contact URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['linkedin-url'] = array(
		'id' => 'linkedin-url',
		'label'   => __( 'LinkedIn URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	$options['googleplus-url'] = array(
		'id' => 'googleplus-url',
		'label'   => __( 'Google+ URL', 'checkout' ),
		'section' => $section,
		'type'    => 'url',
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();

	$customizer_library->add_options( $options );
}
add_action( 'init', 'checkout_customizer_options' );
