<?php
/**
 * Template used for shop and food detail
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

wp_register_style('retail-styles', get_stylesheet_directory_uri().'/css/retail.css',false);
wp_enqueue_style('retail-styles');
?>
<?php get_header(); ?>
<section id="retail_hero_bkg">
    <?php
	$hero_image = get_field('shop_image');
	if ( !empty($hero_image) ) {
		$retail_url = $hero_image['url'];
		$retail_caption = $hero_image['caption'];
	}
	?>
	<div id="retail_hero_img" role="img" <?php if($retail_caption) echo('aria-label=".$retail_caption."'); ?> style="background:url(<?php echo($retail_url); ?>)">
    </div>
</section>
<section id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>

			<div class="post-content">
				<?php //the_content(); ?>
                <?php
				$shop = get_the_title();
				$css_asset = get_stylesheet_directory_uri();
				echo ('<h1>'.$shop.'</h1>');
				// Draw specials content (if any)
				if( have_rows('specials') ):
					while ( have_rows('specials') ) : the_row(); ?>
                    	<div class="retail_special">
                        <?php
						$special_label = get_sub_field('special_label');
						$special_detail = get_sub_field('special_detail');
						if($special_label) echo ($special_label . '<br />');
						echo $special_detail;
						?>
                        </div>
                        <?php
					endwhile;
				else :	// Currently no defined action for no specials
				endif;
				?>
                <div id="retail_info" class="retail_one_half">
                	<?php // Draw hours of operation
						if( have_rows('hours') ):
							echo ('<div class="retail_schedule">');
							while ( have_rows('hours') ) : the_row(); ?>
								<div class="retail_hours">
									<?php
                                        $days_of_week = get_sub_field('days');
                                        $open_time = get_sub_field('open_time');
                                        $close_time = get_sub_field('close_time');
                                        echo ('<span class="retail_days_of_week">'.$days_of_week['value'].'</span><br />'.$open_time.'-'.$close_time);
                                    ?>
								</div>
							<?php
							endwhile;
							echo ('</div>');
						endif;
						if (get_field('phone')) {
							$phone = get_field('phone');
							echo ('<div class="retail_phone">Phone<br /><a href="tel:'.str_replace('.','-',$phone).'">'.$phone.'</a></div>');
						}
						if (get_field('location_summary')) {
							the_field('location_summary');
						}
					?>
                </div>

				<?php // Add Mapplic details
				if (get_field('mapplic_id')) {
					$landmark_id = get_field('mapplic_id');
				}
				else $landmark_id = 'bfplny';
				?>
                <div id="retail_mapplic" class="retail_one_half">
                	Location<br />
	                <div id="retail_mapplic_map" aria-hidden="true"><?php //echo do_shortcode('[mapplic id="11957" h="300" landmark="'.$landmark_id.'"]'); ?><?php echo do_shortcode('[mapplic id="11905" h="300" landmark="'.$landmark_id.'"]'); //DEV SITE ?></div>
                </div>

				<?php // Add web information and file links ?>
                <div id="retail_online" class="retail_one_half">
                	<?php if (get_field('web_site')) {
						$site = get_field('web_site');
						echo('<div class="retail_website">Website<br /><a href="'.$site.'" target="_blank">'.$site.'</a></div>');
					}; ?>
                    <?php
					if( have_rows('offsite_links') ):
						while ( have_rows('offsite_links') ) : the_row(); ?>
								<?php
									$label = get_sub_field('outside_link_label');
									$url = get_sub_field('outside_link_url');
									echo ('<div class="retail_link"><a class="retail_outlink" target="_blank" href="'.$url.'">'.$label.'</a></div>');
								?>
						<?php
						endwhile;
					endif;

					if( have_rows('file_links') ):
						while ( have_rows('file_links') ) : the_row(); ?>
								<?php
									$label = get_sub_field('file_label');
									$file = get_sub_field('file');
									$fileURL = $file['url'];
									echo ('<div class="retail_file"><a class="retail_file_link" href="'.$fileURL.'">'.$label.'</a></div>');
								?>
						<?php
						endwhile;
					endif;

					if( have_rows('email_link') ):
						while ( have_rows('email_link') ) : the_row(); ?>
								<?php
									$email_label = get_sub_field('email_label');
									$to_address = get_sub_field('to_address');
									$subject = get_sub_field('message_subject');
									$mailtohref = 'mailto:'.$to_address;
									if($subject) $mailtohref .= '?subject='.$subject;
									echo ('<div class="retail_email"><a class="retail_email_link" href="'.$mailtohref.'">'.$email_label.' &rarr;</a></div>');
								?>
						<?php
						endwhile;
					endif;

					?>

                </div>

				<?php // Add Social Media Links ?>
                <div id="retail_social_media" class="retail_one_half">
                	<?php
                    	if (get_field('social_media_instagram') || get_field('social_media_facebook') || get_field('social_media_twitter')) {
							echo ($shop.' Social Media<br /><br />');
							if (get_field('social_media_instagram')) {
								$instagram = get_field('social_media_instagram'); ?>
								<div class="retail_social_link">
                                	<a target="_blank" href="<?php echo ($instagram); ?>"><img alt="Link to <?php echo $shop; ?> Instagram Site" src="<?php echo $css_asset; ?>/css/assets/social_instagram.png" /></a>
                                </div>
                                <?php
							}
							if (get_field('social_media_facebook')) {
								$facebook = get_field('social_media_facebook'); ?>
								<div class="retail_social_link">
                                	<a target="_blank" href="<?php echo ($facebook); ?>"><img alt="Link to <?php echo $shop; ?> Facebook Site" src="<?php echo $css_asset; ?>/css/assets/social_facebook.png" /></a>
                                </div>
                                <?php
							}
							if (get_field('social_media_twitter')) {
								$twitter = get_field('social_media_twitter'); ?>
								<div class="retail_social_link">
                                	<a target="_blank" href="<?php echo ($twitter); ?>"><img alt="Link to <?php echo $shop; ?> Twitter Site" src="<?php echo $css_asset; ?>/css/assets/social_twitter.png" /></a>
                                </div>
                                <?php
							}
						}
					?>
                </div>
                
                <div id="retail_detail" class="retail_full">
                	<?php the_field('additional_information'); ?>
                </div>
			</div>

		</article>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
