<?php
// Return Query Builders

// Array builder for home page, sticky posts first
function retail_query($type = 'shop') {
	$returnarray = array();
	$limiter = 3;
	$args = array (
		'post_type'			=> 'retail',
		'order'				=> 'ASC',
		'orderby'			=> 'meta_value',
		'meta_key'			=> 'sticky_preference',
		'posts_per_page'	=> $limiter,
		'meta_query' 		=> array(
			'relation'		=> 'AND',
			array(
				'key'	 	=> 'shop_type',
				'value'	  	=> $type,
				'compare' 	=> '=',
			),
			array(
				'key'	  	=> 'sticky',
				'value'	  	=> 'yes',
				'compare' 	=> '=',
			),
		),
	);
	$sticky = new WP_Query($args);
	$stickycount = $sticky->post_count;
	while ( $sticky->have_posts() ) {
		$sticky->the_post();
		$returnarray[] = get_the_ID();
	}
	wp_reset_postdata();

	if ($stickycount < $limiter) {
		$args = array (
			'post_type'			=> 'retail',
			'orderby'			=> 'rand',
			'posts_per_page'	=> $limiter - $stickycount,
			'meta_query' 		=> array(
				'relation'		=> 'AND',
				array(
					'key'	 	=> 'shop_type',
					'value'	  	=> $type,
					'compare' 	=> '=',
				),
				array(
					'key'	  	=> 'sticky',
					'value'	  	=> 'yes',
					'compare' 	=> '!=',
				),
			),
		);
		$nonsticky = new WP_Query($args);
		while ( $nonsticky->have_posts() ) {
			$nonsticky->the_post();
			$returnarray[] = get_the_ID();
		}
		wp_reset_postdata();
	}

	return $returnarray;
}

// Array builder for home page, sticky posts first
function get_directory($type = 'shop') {
	$args = array (
		'post_type'			=> 'retail',
		'order'				=> 'ASC',
		'orderby'			=> 'title',
		'meta_query' 		=> array(
			'relation'		=> 'AND',
			array(
				'key'	 	=> 'shop_type',
				'value'	  	=> $type,
				'compare' 	=> '=',
			),
		),
	);
	$card_dir = new WP_Query($args);
	if ($card_dir) return $card_dir;
	wp_reset_postdata();
}