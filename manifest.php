<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$manifest = [];

$manifest['name']        = __( 'Breadcrumbs', 'fw' );
$manifest['slug']        = 'unysonplus-breadcrumbs';
$manifest['description'] = __(
	'Creates a simplified navigation menu for the pages that can be placed anywhere in the theme. This will make navigating the website much easier.',
	'fw'
);

$manifest['version']     = '1.0.26';
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
 * 1.0.24 - Blog crumb + primary-term support. When a static front page and a
 *          separate Posts page are configured, the Posts page is now inserted
 *          before single posts, category, tag, author and date archives (Home /
 *          Blog / Category / Post) — previously it was skipped entirely, which
 *          was the last significant gap against the dedicated SEO plugins. It is
 *          controlled by a new "Show blog item" setting and a matching show_blog
 *          argument / shortcode attribute, both defaulting to on. A post filed in
 *          several unrelated terms has no deepest term, so the taxonomy crumb used
 *          to be picked arbitrarily and could change between requests; an
 *          editor-chosen primary term recorded by Yoast or Rank Math is now
 *          honoured first, with the meta keys exposed through the new
 *          fw_ext_breadcrumbs_primary_term_meta_keys filter. Structured data is no
 *          longer emitted on 404 and search results, truncated titles no longer
 *          leak into the microdata name (the full title moves to a meta tag while
 *          only the visible text is trimmed), and the current item now carries
 *          aria-current="page". WooCommerce product crumbs use the Shop page title
 *          instead of the generic post type label. Also hardened: the parent walks
 *          for posts and terms are cycle-guarded, and the queried object is type
 *          checked instead of relying on a global $post that may be null.
 *
 * 1.0.18 - Major flexibility + SEO upgrade. Migrated the structured data from the
 *          long-deprecated data-vocabulary.org markup to schema.org BreadcrumbList,
 *          selectable as Microdata, JSON-LD, or none (data-vocabulary.org no longer
 *          produces breadcrumb rich results in Google). Rewrote the view as a
 *          semantic <nav>/<ol>/<li> trail with an aria-label. Added many new
 *          settings + per-call arguments: separator, prefix text, home icon,
 *          show/hide home, link-the-current-item, show-on-front, title truncation,
 *          a forced post taxonomy, and an optional custom-post-type archive crumb.
 *          render()/fw_ext_breadcrumbs()/fw_ext_get_breadcrumbs() now accept an
 *          arguments array (a string is still treated as the separator for
 *          backward compatibility). Added a [breadcrumbs] shortcode exposing the
 *          same arguments, plus fw_ext_breadcrumbs_args / fw_ext_breadcrumbs_items
 *          filters. Builder now also resolves attachments, WooCommerce shop and
 *          custom-post-type archives.
 *
 * 1.0.17 - Security: escaped breadcrumb item names with esc_html(), separators
 *          with wp_kses_post() (allows safe HTML like <i class="..."></i>),
 *          and URL contexts with esc_url() instead of esc_attr(). Replaced
 *          unescaped numeric output in class attribute with explicit (int) cast.
 *          Prevents XSS via maliciously-crafted breadcrumb items.
 */
