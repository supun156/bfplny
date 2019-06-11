<?php
/*
Template Name: Food Directory
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php
// Load jQuery support for card functions
wp_register_script('directory-sort', get_stylesheet_directory_uri().'/js/directory.js', array('jquery','jquery-ui-core','jquery-ui-position','jquery-ui-tooltip'), '1.0', false);
wp_enqueue_script('directory-sort');
?>
<?php get_header(); ?>
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // WPCS: XSS ok. ?>
			<?php avada_featured_images_for_pages(); ?>
			<div class="post-content" style="position:relative;">

            <?php
            if (has_post_thumbnail( $post->ID ) ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
			?>
            <section id="food_directory_hero_bkg">
                <div id="directory_hero_img" role="img" style="background:url(<?php echo $image[0]; ?>)">                
                </div>
            </section>
			<?php } ?>
                <?php
					// Check for filter in URL
					$type = htmlspecialchars($_GET['type']);

					if ($type) {
						switch($type) {
							case 'coffee':
							$current = "COFFEE &amp; SWEETS";
							break;
							case 'hudson':
							$current = "HUDSON EATS";
							break;
							case 'restaurants':
							$current = "RESTAURANTS";
							break;
							case 'private':
							$current = "PRIVATE EVENTS &amp; CATERING";
							break;
							case 'happy':
							$current = "HAPPY HOUR";
							break;
							case 'coming':
							$current = "COMING SOON";
							break;
						}
					}
					else {$type = 'all'; $current = 'ALL FOOD';}
				?>
				
                <div id="shop_directory_chooser">
                	<div id="shop_directory_dropdown"><span id="shop_type_current" data-acfname="<?php echo($type); ?>"><?php echo($current); ?></span><span id="shop_directory_widget"></span>
                    </div>
	                <div id="shop_directory_options">
                		<div class="shop_directory_column">
                        	<div data-acfname="all" class="shop_directory_option <?php if($type == 'all') echo ('shop_directory_selected') ?>">ALL FOOD</div>
                            <div data-acfname="coffee" class="shop_directory_option <?php if($type == 'coffee') echo ('shop_directory_selected') ?>">COFFEE &amp; SWEETS</div>
                        </div>
                		<div class="shop_directory_column">
                        	<div data-acfname="hudson" class="shop_directory_option <?php if($type == 'hudson') echo ('shop_directory_selected') ?>">HUDSON EATS</div>
                            <div data-acfname="restaurants" class="shop_directory_option <?php if($type == 'restaurants') echo ('shop_directory_selected') ?>">RESTAURANTS</div>
                        </div>
                		<div class="shop_directory_column">
                        	<div data-acfname="private" class="shop_directory_option <?php if($type == 'private') echo ('shop_directory_selected') ?>">PRIVATE EVENTS &amp; CATERING</div>
                            <div data-acfname="happy" class="shop_directory_option <?php if($type == 'happy') echo ('shop_directory_selected') ?>">HAPPY HOUR</div>
                        </div>
                		<div class="shop_directory_column">
                            <div data-acfname="coming" class="shop_directory_option <?php if($type == 'coming') echo ('shop_directory_selected') ?>">COMING SOON</div>
                        </div>
    	            </div>
				</div>
				<div class="shop_directory">
	                <div id="full_shop_content">
	                    <div class="full_shop_cards">
		                <?php
							$shops = get_directory('food');
							
							while ($shops->have_posts()) {
								$shops->the_post();
								dir_card();
							}
		                ?>
                        </div>
	                </div>
                </div>
				<?php
				// Repeat for shops mobile
				?>

                <?php 
				global $wp_meta_boxes;
				print_r($wp_meta_boxes); ?>
				<?php fusion_link_pages(); ?>
			</div>
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php do_action( 'avada_before_additional_page_content' ); ?>
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<?php $woo_thanks_page_id = get_option( 'woocommerce_thanks_page_id' ); ?>
					<?php $is_woo_thanks_page = ( ! get_option( 'woocommerce_thanks_page_id' ) ) ? false : is_page( get_option( 'woocommerce_thanks_page_id' ) ); ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) && ! is_cart() && ! is_checkout() && ! is_account_page() && ! $is_woo_thanks_page ) : ?>
						<?php wp_reset_postdata(); ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( Avada()->settings->get( 'comments_pages' ) ) : ?>
						<?php wp_reset_postdata(); ?>
						<?php comments_template(); ?>
					<?php endif; ?>
				<?php endif; ?>
				<?php do_action( 'avada_after_additional_page_content' ); ?>
			<?php endif; // Password check. ?>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
