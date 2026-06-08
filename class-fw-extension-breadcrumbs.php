<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Extension_Breadcrumbs extends FW_Extension {

	/**
	 * @internal
	 */
	public function _init() {
		add_shortcode( 'breadcrumbs', [ $this, '_shortcode' ] );
	}

	/**
	 * Read the extension settings, falling back to the option defaults.
	 *
	 * @return array
	 */
	public function get_settings() {
		$name = $this->get_name();

		return [
			'homepage-title'         => fw_get_db_ext_settings_option( $name, 'homepage-title' ),
			'blogpage-title'         => fw_get_db_ext_settings_option( $name, 'blogpage-title' ),
			'404-title'              => fw_get_db_ext_settings_option( $name, '404-title' ),
			'separator'              => fw_get_db_ext_settings_option( $name, 'separator' ),
			'prefix'                 => fw_get_db_ext_settings_option( $name, 'prefix' ),
			'home_icon'              => fw_get_db_ext_settings_option( $name, 'home_icon' ),
			'show_home'              => fw_get_db_ext_settings_option( $name, 'show_home' ),
			'link_last'              => fw_get_db_ext_settings_option( $name, 'link_last' ),
			'show_on_front'          => fw_get_db_ext_settings_option( $name, 'show_on_front' ),
			'truncate'               => fw_get_db_ext_settings_option( $name, 'truncate' ),
			'post_taxonomy'          => fw_get_db_ext_settings_option( $name, 'post_taxonomy' ),
			'show_post_type_archive' => fw_get_db_ext_settings_option( $name, 'show_post_type_archive' ),
			'schema'                 => fw_get_db_ext_settings_option( $name, 'schema' ),
		];
	}

	/**
	 * Resolve the render arguments from the saved settings.
	 *
	 * @param array $settings
	 *
	 * @return array
	 */
	private function get_default_args( $settings ) {
		return [
			'separator'              => ( $settings['separator'] ?? '' ) !== '' ? $settings['separator'] : '>',
			'prefix'                 => $settings['prefix'] ?? '',
			'home_icon'              => $settings['home_icon'] ?? '',
			'link_last'              => (bool) ( $settings['link_last'] ?? false ),
			'show_home'              => (bool) ( $settings['show_home'] ?? true ),
			'show_on_front'          => (bool) ( $settings['show_on_front'] ?? false ),
			'truncate'               => (int) ( $settings['truncate'] ?? 0 ),
			'post_taxonomy'          => $settings['post_taxonomy'] ?? '',
			'show_post_type_archive' => (bool) ( $settings['show_post_type_archive'] ?? true ),
			'schema'                 => $settings['schema'] ?? 'microdata',
			'container_class'        => 'breadcrumbs',
			'aria_label'             => __( 'Breadcrumb', 'fw' ),
		];
	}

	/**
	 * Creates the breadcrumbs HTML.
	 *
	 * Accepts either a separator string (legacy signature) or an array of
	 * arguments that override the saved settings for this single call:
	 *
	 *   separator, prefix, home_icon, link_last, show_home, show_on_front,
	 *   truncate, post_taxonomy, show_post_type_archive, schema,
	 *   container_class, aria_label
	 *
	 * @param string|array $args Separator string (back-compat) or args array.
	 *
	 * @return string
	 */
	public function render( $args = [] ) {
		// Back-compat: the old signature accepted a separator string.
		if ( ! is_array( $args ) ) {
			$args = [ 'separator' => (string) $args ];
		}

		$settings = $this->get_settings();
		$defaults = $this->get_default_args( $settings );

		// Only let non-null overrides through, so an explicit false still wins.
		$overrides = array_filter( $args, static fn( $value ) => $value !== null );

		$args = array_merge( $defaults, $overrides );
		$args = apply_filters( 'fw_ext_breadcrumbs_args', $args );

		$breadcrumbs = new Breadcrumbs_Builder( [
			'labels'                 => [
				'homepage-title' => $settings['homepage-title'],
				'blogpage-title' => $settings['blogpage-title'],
				'404-title'      => $settings['404-title'],
			],
			'post_taxonomy'          => $args['post_taxonomy'],
			'show_post_type_archive' => $args['show_post_type_archive'],
			'show_home'              => $args['show_home'],
			'show_on_front'          => $args['show_on_front'],
		] );

		$items = $breadcrumbs->get_breadcrumbs();
		$items = apply_filters( 'fw_ext_breadcrumbs_items', $items, $args );

		if ( empty( $items ) ) {
			return '';
		}

		return $this->render_view( 'breadcrumbs', [
			'items' => $items,
			'args'  => $args,
		] );
	}

	/**
	 * Shortcode handler: [breadcrumbs separator="/" prefix="You are here:" ...]
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	public function _shortcode( $atts ) {
		$atts = shortcode_atts( [
			'separator'              => null,
			'prefix'                 => null,
			'home_icon'              => null,
			'link_last'              => null,
			'show_home'              => null,
			'show_on_front'          => null,
			'truncate'               => null,
			'post_taxonomy'          => null,
			'show_post_type_archive' => null,
			'schema'                 => null,
			'class'                  => null,
		], $atts, 'breadcrumbs' );

		$bool_keys = [ 'link_last', 'show_home', 'show_on_front', 'show_post_type_archive' ];
		$args      = [];

		foreach ( $atts as $key => $value ) {
			if ( $value === null ) {
				continue;
			}

			if ( $key === 'class' ) {
				$args['container_class'] = $value;
			} elseif ( in_array( $key, $bool_keys, true ) ) {
				$args[ $key ] = filter_var( $value, FILTER_VALIDATE_BOOLEAN );
			} elseif ( $key === 'truncate' ) {
				$args[ $key ] = (int) $value;
			} else {
				$args[ $key ] = $value;
			}
		}

		return fw()->extensions->get( 'breadcrumbs' )->render( $args );
	}

	/**
	 * Returns an hardcoded id for the breadcrumbs option
	 * @return string
	 */
	public function get_option_id() {
		return $this->get_name() . '-option';
	}
}
