<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$default_values = apply_filters( 'fw_ext_breadcrumbs_settings_options_default_values', array(
	'homepage-title' => __( 'Homepage', 'fw' ),
	'blogpage-title' => __( 'Blog', 'fw' ),
	'404-title'      => __( '404 Not Found', 'fw' ),
	'separator'      => '/',
	'prefix'         => '',
) );

$section_title = static function ( $text ) {
	return '<h3 class="fw-ext-breadcrumbs-section-title" style="margin:0;font-size:15px;font-weight:600;">'
	       . esc_html( $text ) . '</h3>';
};

$options = array(
	apply_filters( 'fw:ext:breadcrumbs:settings-options:before', array() ),

	'general_group' => array(
		'type'    => 'group',
		'options' => array(
			'general_heading' => array(
				'type'  => 'html',
				'label' => false,
				'desc'  => false,
				'html'  => $section_title( __( 'General', 'fw' ) ),
			),
			'separator'       => array(
				'label' => __( 'Separator', 'fw' ),
				'desc'  => __( 'Symbol or markup placed between items. Safe HTML is allowed, e.g. an icon tag like <i class="fa fa-angle-right"></i>.', 'fw' ),
				'type'  => 'text',
				'value' => $default_values['separator'],
			),
			'prefix'          => array(
				'label' => __( 'Prefix text', 'fw' ),
				'desc'  => __( 'Optional text shown before the trail, e.g. "You are here:". Leave empty for none.', 'fw' ),
				'type'  => 'text',
				'value' => $default_values['prefix'],
			),
			'show_home'       => array(
				'label' => __( 'Show home item', 'fw' ),
				'desc'  => __( 'Include the homepage link as the first item.', 'fw' ),
				'type'  => 'switch',
				'value' => true,
			),
			'home_icon'       => array(
				'label' => __( 'Home icon class', 'fw' ),
				'desc'  => __( 'Optional icon class shown before the home text (e.g. "dashicons dashicons-admin-home" or a Font Awesome class). Leave empty for text only.', 'fw' ),
				'type'  => 'text',
				'value' => '',
			),
			'link_last'       => array(
				'label' => __( 'Link current item', 'fw' ),
				'desc'  => __( 'Make the last (current page) item a clickable link instead of plain text.', 'fw' ),
				'type'  => 'switch',
				'value' => false,
			),
			'show_on_front'   => array(
				'label' => __( 'Show on front page', 'fw' ),
				'desc'  => __( 'Render the breadcrumbs even on the site front page.', 'fw' ),
				'type'  => 'switch',
				'value' => false,
			),
			'truncate'        => array(
				'label' => __( 'Truncate length', 'fw' ),
				'desc'  => __( 'Trim item titles longer than this many characters (an ellipsis is appended). Use 0 to disable.', 'fw' ),
				'type'  => 'text',
				'value' => '0',
			),
		),
	),

	'labels_group' => array(
		'type'    => 'group',
		'options' => array(
			'labels_heading' => array(
				'type'  => 'html',
				'label' => false,
				'desc'  => false,
				'html'  => $section_title( __( 'Labels', 'fw' ) ),
			),
			'homepage-title' => array(
				'label' => __( 'Text for Homepage', 'fw' ),
				'desc'  => __( 'The homepage anchor will have this text', 'fw' ),
				'type'  => 'text',
				'value' => $default_values['homepage-title']
			),
			'blogpage-title' => array(
				'label' => __( 'Text for Blog Page', 'fw' ),
				'desc'  => __( 'The blog page anchor will have this text. In case homepage will be set as blog page, will be taken the homepage text', 'fw' ),
				'type'  => 'text',
				'value' => $default_values['blogpage-title']
			),
			'404-title'      => array(
				'label' => __( 'Text for 404 Page', 'fw' ),
				'desc'  => __( 'The 404 anchor will have this text', 'fw' ),
				'type'  => 'text',
				'value' => $default_values['404-title']
			),
		),
	),

	'taxonomy_seo_group' => array(
		'type'    => 'group',
		'options' => array(
			'taxonomy_seo_heading'   => array(
				'type'  => 'html',
				'label' => false,
				'desc'  => false,
				'html'  => $section_title( __( 'Taxonomy & SEO', 'fw' ) ),
			),
			'post_taxonomy'          => array(
				'label' => __( 'Post taxonomy', 'fw' ),
				'desc'  => __( 'Taxonomy slug used to build the trail for single posts (e.g. "category" or a custom taxonomy). Leave empty to auto-detect the deepest hierarchical taxonomy.', 'fw' ),
				'type'  => 'text',
				'value' => '',
			),
			'show_post_type_archive' => array(
				'label' => __( 'Show post type archive', 'fw' ),
				'desc'  => __( 'For custom post types that have an archive, add the archive link before single items (e.g. Home / Shop / Product).', 'fw' ),
				'type'  => 'switch',
				'value' => true,
			),
			'schema'                 => array(
				'label'   => __( 'Structured data', 'fw' ),
				'desc'    => __( 'Markup used to expose the trail to search engines. schema.org BreadcrumbList is recommended.', 'fw' ),
				'type'    => 'select',
				'value'   => 'microdata',
				'choices' => array(
					'microdata' => __( 'Microdata (schema.org BreadcrumbList)', 'fw' ),
					'json-ld'   => __( 'JSON-LD (schema.org BreadcrumbList)', 'fw' ),
					'none'      => __( 'None', 'fw' ),
				),
			),
		),
	),

	apply_filters( 'fw:ext:breadcrumbs:settings-options:after', array() ),
);
