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

$manifest['version']     = '1.0.16';
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
