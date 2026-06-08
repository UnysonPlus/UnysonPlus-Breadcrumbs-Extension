<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Breadcrumbs default view.
 *
 * @var array $items {
 *     Ordered hierarchical list of crumbs. Each crumb:
 *     @type string $name Item title.
 *     @type string $url  Item URL (optional for the current page).
 *     @type string $type Item context (front_page, post, taxonomy, 404, ...).
 * }
 * @var array $args {
 *     @type string $separator       Symbol/markup placed between items.
 *     @type string $prefix          Text shown before the trail.
 *     @type bool   $link_last       Link the current (last) item.
 *     @type string $home_icon       Icon class prepended to the first item.
 *     @type int    $truncate        Trim titles longer than N chars (0 = off).
 *     @type string $schema          'microdata' | 'json-ld' | 'none'.
 *     @type string $container_class Wrapper class.
 *     @type string $aria_label      Nav aria-label.
 * }
 */

if ( empty( $items ) ) {
	return;
}

$separator       = isset( $args['separator'] ) ? $args['separator'] : '>';
$prefix          = isset( $args['prefix'] ) ? $args['prefix'] : '';
$link_last       = ! empty( $args['link_last'] );
$home_icon       = isset( $args['home_icon'] ) ? $args['home_icon'] : '';
$truncate        = isset( $args['truncate'] ) ? (int) $args['truncate'] : 0;
$schema          = isset( $args['schema'] ) ? $args['schema'] : 'microdata';
$container_class = isset( $args['container_class'] ) && $args['container_class'] !== '' ? $args['container_class'] : 'breadcrumbs';
$aria_label      = isset( $args['aria_label'] ) ? $args['aria_label'] : __( 'Breadcrumb', 'fw' );

$microdata = ( $schema === 'microdata' );

$truncate_title = static function ( $text ) use ( $truncate ) {
	if ( $truncate <= 0 ) {
		return $text;
	}

	if ( function_exists( 'mb_strlen' ) ) {
		return ( mb_strlen( $text ) > $truncate ) ? rtrim( mb_substr( $text, 0, $truncate ) ) . '…' : $text;
	}

	return ( strlen( $text ) > $truncate ) ? rtrim( substr( $text, 0, $truncate ) ) . '…' : $text;
};

$total = count( $items );
?>
<nav class="<?php echo esc_attr( $container_class ); ?>" aria-label="<?php echo esc_attr( $aria_label ); ?>">
	<?php if ( $prefix !== '' ) : ?>
		<span class="breadcrumbs__prefix"><?php echo esc_html( $prefix ); ?></span>
	<?php endif; ?>
	<ol class="breadcrumbs__list"<?php echo $microdata ? ' itemscope itemtype="https://schema.org/BreadcrumbList"' : ''; ?>>
		<?php
		$position = 0;
		foreach ( $items as $item ) :
			$position++;

			$is_first = ( $position === 1 );
			$is_last  = ( $position === $total );

			$name    = isset( $item['name'] ) ? $item['name'] : '';
			$url     = isset( $item['url'] ) ? $item['url'] : '';
			$display = $truncate_title( $name );
			$linked  = ( $url !== '' ) && ( ! $is_last || $link_last );

			$classes = array( 'breadcrumbs__item' );
			if ( $is_first ) {
				$classes[] = 'first-item';
			}
			if ( $is_last ) {
				$classes[] = 'last-item';
			}

			$icon = ( $is_first && $home_icon !== '' )
				? '<i class="breadcrumbs__home-icon ' . esc_attr( $home_icon ) . '" aria-hidden="true"></i> '
				: '';
			?>
			<li class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo $microdata ? ' itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"' : ''; ?>>
				<?php if ( $linked ) : ?>
					<a class="breadcrumbs__link" href="<?php echo esc_url( $url ); ?>"<?php echo $microdata ? ' itemprop="item"' : ''; ?>>
						<?php echo $icon; // already escaped ?><span<?php echo $microdata ? ' itemprop="name"' : ''; ?>><?php echo esc_html( $display ); ?></span>
					</a>
				<?php else : ?>
					<span class="breadcrumbs__current"<?php echo $microdata ? ' itemprop="name"' : ''; ?>><?php echo $icon; // already escaped ?><?php echo esc_html( $display ); ?></span>
					<?php if ( $microdata && $url !== '' ) : ?>
						<meta itemprop="item" content="<?php echo esc_url( $url ); ?>"/>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( $microdata ) : ?>
					<meta itemprop="position" content="<?php echo (int) $position; ?>"/>
				<?php endif; ?>

				<?php if ( ! $is_last && $separator !== '' ) : ?>
					<span class="separator" aria-hidden="true"><?php echo wp_kses_post( $separator ); ?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
<?php
if ( $schema === 'json-ld' ) :
	$ld_elements = array();
	$position    = 0;

	foreach ( $items as $item ) {
		$position++;

		$element = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => isset( $item['name'] ) ? wp_strip_all_tags( $item['name'] ) : '',
		);

		if ( ! empty( $item['url'] ) ) {
			$element['item'] = esc_url_raw( $item['url'] );
		}

		$ld_elements[] = $element;
	}

	$ld = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $ld_elements,
	);
	?>
	<script type="application/ld+json"><?php echo wp_json_encode( $ld ); ?></script>
<?php endif; ?>
