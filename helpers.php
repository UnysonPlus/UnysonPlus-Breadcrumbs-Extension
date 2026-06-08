<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Returns the breadcrumbs HTML.
 *
 * @param string|array $args Separator string (back-compat) or an array of
 *                           arguments accepted by FW_Extension_Breadcrumbs::render()
 *                           (separator, prefix, home_icon, link_last, show_home,
 *                           show_on_front, truncate, post_taxonomy,
 *                           show_post_type_archive, schema, container_class).
 *
 * @return string
 */
function fw_ext_get_breadcrumbs( $args = [] ) {
	if ( ! ( $ext = fw()->extensions->get( 'breadcrumbs' ) ) ) {
		return '';
	}

	return $ext->render( $args );
}

/**
 * Displays the breadcrumbs HTML.
 *
 * @param string|array $args See fw_ext_get_breadcrumbs().
 */
function fw_ext_breadcrumbs( $args = [] ) {
	echo fw_ext_get_breadcrumbs( $args );
}
