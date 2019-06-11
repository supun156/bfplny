<?php
/*
Template Name: Diagnose Meta Boxes
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php echo fusion_render_rich_snippets_for_pages(); // WPCS: XSS ok. ?>
			<?php avada_featured_images_for_pages(); ?>
			<div class="post-content">
				<?php //the_content(); ?>

                <?php
					$shoparray = array();
					$foodarray = array();
					
					$shoparray = retail_query();
					$foodarray = retail_query('food');
				?>

                <section id="full_shop_container">
	                <div id="full_shop_content">
		                <h1>SHOPS</h1>
	                    <div class="full_shop_cards">
		                <?php
			                foreach($shoparray as $shop) {
		                    gen_card($shop);
        			        }
		                ?>
                        </div>
                       	<a href="#" class="full_shop_directory">See all shops</a>
	                </div>
                </section>
				<?php
				// Repeat for shops mobile
				?>
               	<section id="full_food_container">
                    <div id="full_food_content">
	                    <h1>FOOD</h1>
	                    <div class="full_shop_cards">
	                    <?php
			                foreach($foodarray as $shop) {
		                    gen_card($shop);
        			        }
						?>
                        </div>
                       	<a href="#" class="full_shop_directory">See all food</a>
                    </div>
                </section>
                <?php

/*				// Repeat for mobile
*/

				?>
                Allowed Mime Types:
                <?php
				$whatmime = get_allowed_mime_types();
				print_r($whatmime);
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
