<?php
/*
Template Name: Home Page
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php
// Load jssor library and js for mobile slides
wp_register_script('jssor-lib', get_stylesheet_directory_uri().'/js/jssor.slider-27.5.0.min.js', array('jquery'), '1.0', false);
wp_enqueue_script('jssor-lib');
wp_register_script('jssor-sliders', get_stylesheet_directory_uri().'/js/jssor-sliders.js', array('jquery'), '1.0', true);
wp_enqueue_script('jssor-sliders');
// Add CSS necessary only for mobile slider on home page
wp_register_style('home-carousel', get_stylesheet_directory_uri().'/css/home-carousel.css',false);
wp_enqueue_style('home-carousel');
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

				<?php // Build again for mobile ?>
                <section id="mobile_shop_container">
                	<div id="mobile_shop_content">
                    	<h1>SHOPS</h1>
                        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:680px;height:430px;overflow:hidden;visibility:hidden;">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo(get_stylesheet_directory_uri()); ?>/css/assets/double-tail-spin.svg" />
                            </div>
                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:680px;height:430px;overflow:hidden;">
                                <?php
                                    foreach($shoparray as $shop) {
                                        echo('<div>');
                                        gen_card($shop);
                                        echo('</div>');	
                                    }
                                ?>
                            </div>
                            <div data-u="navigator" class="jssorb057" style="position:absolute;top:-30px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-top="0.75">
                                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <circle class="b" cx="8000" cy="8000" r="5000"></circle>
                                    </svg>
                                </div>
                            </div>
                        </div>
                	</div>
                </section>
                
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

				<?php // Build again for mobile ?>
                <section id="mobile_food_container">
                	<div id="mobile_food_content">
                    	<h1>FOOD</h1>
                        <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:680px;height:430px;overflow:hidden;visibility:hidden;">
                            <!-- Loading Screen -->
                            <div data-u="loading" class="jssorl-004-double-tail-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo(get_stylesheet_directory_uri()); ?>/css/assets/double-tail-spin.svg" />
                            </div>
                            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:680px;height:430px;overflow:hidden;">
                                <?php
                                    foreach($foodarray as $shop) {
                                        echo('<div>');
                                        gen_card($shop);
                                        echo('</div>');	
                                    }
                                ?>
                            </div>
                            <div data-u="navigator" class="jssorb057" style="position:absolute;top:-30px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-top="0.75">
                                <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                        <circle class="b" cx="8000" cy="8000" r="5000"></circle>
                                    </svg>
                                </div>
                            </div>
                        </div>
                	</div>
                </section>

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
