<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * Breadcrumbs default view
 * Parameters:
 *
 * @var array $items , array with pages ordered hierarchical
 * $items = array(
 *      0 => array(
 *          'name'  => 'Item name',
 *          'url'   => 'Item URL'
 *      )
 * )
 * Each $items array will contain additional information about item, e.g.:
 * 'items' => array (
 *        0 => array (
 *            'name' => 'Homepage',
 *          'type' => 'front_page',
 *            'url' => 'http://yourdomain.com/',
 *        ),
 *        1 => array (
 *            'type' => 'taxonomy',
 *            'name' => 'Uncategorized',
 *            'id' => 1,
 *            'url' => 'http://yourdomain.com/category/uncategorized/',
 *            'taxonomy' => 'category',
 *        ),
 *        2 => array (
 *            'name' => 'Post Article',
 *            'id' => 4781,
 *            'post_type' => 'post',
 *            'type' => 'post',
 *            'url' => 'http://yourdomain.com/post-article/',
 *        ),
 *    ),
 * @var string $separator , the separator symbol
 */
?>

<?php if ( ! empty( $items ) ) : ?>
    <div class="breadcrumbs">
		<?php for ( $i = 0; $i < count( $items ); $i ++ ) : ?>
			<?php if ( $i == ( count( $items ) - 1 ) ) : ?>
                <span class="last-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<span itemprop="title"><?php echo esc_html( $items[ $i ]['name'] ) ?></span>
					<meta itemprop="url" content="<?php echo esc_url( $items[ $i ]['url'] ) ?>"/>
				</span>
			<?php elseif ( $i == 0 ) : ?>
                <span class="first-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<?php if ( isset( $items[ $i ]['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $items[ $i ]['url'] ) ?>" itemprop="url">
                        <span itemprop="title"><?php echo esc_html( $items[ $i ]['name'] ) ?></span>
                    </a>
                    </span>
				<?php else : echo esc_html( $items[ $i ]['name'] ); endif ?>
				<?php if ($separator) { ?>
					<span class="separator"><?php echo wp_kses_post( $separator ); ?></span>
				<?php } ?>
				<?php
			else : ?>
            <span class="<?php echo (int) ( $i - 1 ) ?>-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<?php if ( isset( $items[ $i ]['url'] ) ) : ?>
                    <a href="<?php echo esc_url( $items[ $i ]['url'] ) ?>" itemprop="url">
                        <span itemprop="title"><?php echo esc_html( $items[ $i ]['name'] ) ?></span>
                    </a>
                    </span>
				<?php else : echo '<span itemprop="title">' . esc_html( $items[ $i ]['name'] ) . '</span>'; endif ?>

				<?php if ($separator) { ?>
					<span class="separator"><?php echo wp_kses_post( $separator ); ?></span>
				<?php } ?>
			<?php endif; ?>
		<?php endfor; ?>
    </div>
<?php endif ?>
