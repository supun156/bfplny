<?php
// Content Element Generation

function dir_card($ID = null) {
	$css_asset = get_stylesheet_directory_uri();
	
	// Set values for vertical card image
	$card_image = get_field('directory_image',$ID);
	if ( !empty($card_image) ) {
		$retail_url = $card_image['url'];
		$retail_caption = $card_image['caption'];
	}

	// Define classes for jQuery sorting and determine if shop is "Coming Soon"
	$extraclasses = $specialtext = $overlaytext = '';
	if (get_field('shop_category',$ID)) {
		$shop_category = get_field('shop_category',$ID);
		foreach ($shop_category as $category) {
			$extraclasses .= ' shop_card_'.$category['value'];
			if ($category['value'] == 'coming') {
				$specialtext = '';
				$overlaytext = 'Coming Soon';
			}
		}
	}
	if (get_field('food_type',$ID)) {
		$shop_category = get_field('food_type',$ID);
		foreach ($shop_category as $category) {
			$extraclasses .= ' shop_card_'.$category['value'];
			if ($category == 'coming') {
				$specialtext = '';
				$overlaytext = 'Coming Soon';
			}
		}
	}
	
	// Check for specials and set text IF shop is not "Coming Soon"
	if (!$overlaytext) {
		if (have_rows('specials',$ID)) {
			$overlaytext = 'Special Offer';
			if ( get_field('shop_type',$ID) == 'Food') {
				$specialtext = 'HAPPY HOUR';
			}
			if ( get_field('shop_type',$ID) == 'Shop') {
				$specialtext = 'SALE';
			}
		}
	}

	?>
    <div class="shop_directory_container shop_card_hidden<?php echo $extraclasses; ?>" data-link="<?php echo the_permalink(); ?>">
        <div class="shop_card_image" role="img" <?php if($retail_caption) echo('aria-label="'.$retail_caption.'"'); ?> style="background:url(<?php echo($retail_url); ?>)">
        <?php if($overlaytext) {
			switch ($overlaytext) {
			  case 'Coming Soon':
				$overlay_img = $css_asset.'/css/assets/coming_soon.png';
				$overlay_img_x2 = $css_asset.'/css/assets/coming_soon_x2.png';
				break;
			  case 'Special Offer':
				$overlay_img = $css_asset.'/css/assets/special_offer.png';
				$overlay_img_x2 = $css_asset.'/css/assets/special_offer_x2.png';
				break;
			}
			echo('<img class="shop_card_overlay" alt="'.$overlaytext.'" src="'.$overlay_img.'" secset="'.$overlay_img_x2.' 2x" />');
		}
		?>
        </div>
	    <div class="shop_card_detail">
            <div class="shop_card_title">
            	<a role="link" href="<?php the_permalink($ID); ?>"><?php echo(get_the_title($ID)); ?></a>
            </div>
            <div class="shop_card_snippet">
            	<?php echo(get_field('location_snippet',$ID)); ?>
            </div>
            <div class="shop_card_special">
            	<?php echo($specialtext); ?>
            </div>
        </div>
    </div>
    <?php
}