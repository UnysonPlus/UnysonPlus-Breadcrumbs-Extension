<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['name']        = __( 'Breadcrumbs', 'fw' );
$manifest['slug']        = 'unysonplus-breadcrumbs';
$manifest['description'] = __(
	'Creates a simplified navigation menu for the pages that can be placed anywhere in the theme. This will make navigating the website much easier.',
	'fw'
);

$manifest['version']     = '1.0.17';
$manifest['display']     = true;
$manifest['standalone']  = true;

// Repository Info
$manifest['github_update'] = 'UnysonPlus/UnysonPlus-Breadcrumbs-Extension';
$manifest['github_repo']   = 'https://github.com/UnysonPlus/UnysonPlus-Breadcrumbs-Extension';
$manifest['github_branch'] = 'master';

// Author Info
$manifest['author']     = 'UnysonPlus';
$manifest['author_uri'] = 'https://www.lastimosa.com.ph/unysonplus';

// Meta
$manifest['license']      = 'GPL-2.0-or-later';
$manifest['text_domain']  = 'fw';
$manifest['requires_php'] = '7.4';
$manifest['requires_wp']  = '5.8';

/**
 * Changelog
 * -----------------------------------------------------------------------------
 * 1.0.17 - Security: escaped breadcrumb item names with esc_html(), separators
 *          with wp_kses_post() (allows safe HTML like <i class="..."></i>),
 *          and URL contexts with esc_url() instead of esc_attr(). Replaced
 *          unescaped numeric output in class attribute with explicit (int) cast.
 *          Prevents XSS via maliciously-crafted breadcrumb items.
 */
