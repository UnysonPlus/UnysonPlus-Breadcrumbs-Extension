<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {
	$extension = fw()->extensions->get( 'breadcrumbs' );

	wp_enqueue_style(
		'fw-ext-breadcrumbs-add-css',
		fw_min_uri( $extension->locate_css_URI( 'style' ) ),
		[],
		$extension->manifest->get_version()
	);
}
