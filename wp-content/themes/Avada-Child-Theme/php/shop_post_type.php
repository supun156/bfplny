<?php
// Register Custom Post Type
function shops_post_type() {

	$labels = array(
		'name'                  => _x( 'Shops / Food', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Shop / Food', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Shops / Food', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Retail', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Shop / Restaurant', 'text_domain' ),
		'edit_item'             => __( 'Edit Shop / Restaurant', 'text_domain' ),
		'update_item'           => __( 'Update Shop / Restaurant', 'text_domain' ),
		'view_item'             => __( 'View Shop / Restauant', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Shops list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		'rewrite' 				=> array('slug' => 'retail'),
	);
	$args = array(
		'label'                 => __( 'Shop / Food', 'text_domain' ),
		'description'           => __( 'Shops and Food Posts', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
//		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'retail', $args );

}
add_action( 'init', 'shops_post_type', 0 );

/** Add store type and sticky columns to Retail Post Type Posts List **/
add_filter ('manage_retail_posts_columns', 'add_retail_acf_columns');
function add_retail_acf_columns ($columns) {
	$columns = array(
		'title' => __('Shop Name'),
		'shop_type' => __ ('Shop Type'),
		'sticky' => __ ('Sticky Rank'),
		'shop_category' => __ ('Shop Category'),
		'food_type' => __ ('Food Category')
	);
	return $columns;
}

add_action ('manage_retail_posts_custom_column', 'retail_custom_columns', 10, 2);
function retail_custom_columns ($column, $post_id) {
  switch ($column) {
    case 'shop_type':
      echo get_post_meta ($post_id, 'shop_type', true);
      break;
    case 'shop_category':
	  $categories = get_post_meta ($post_id, 'shop_category', true);
	  $out = array();
	  foreach ($categories as $result) {
		  $out[]=$result;
	  }
	  echo join(', ', $out);
      break;
    case 'food_type':
	  $categories = get_post_meta ($post_id, 'food_type', true);
	  $out = array();
	  foreach ($categories as $result) {
		  $out[]=$result;
	  }
	  echo join(', ', $out);
      break;
    case 'sticky':
      if (get_post_meta($post_id, 'sticky', true)=='yes') echo get_post_meta ($post_id, 'sticky_preference', true);
      break;
  }
}

add_action('admin_head', 'admin_retail_column_width');
function admin_retail_column_width() {
    echo '<style type="text/css">
		.column-shop_type {text-align: left; width:100px !important; overflow:hidden}
        .column-sticky {text-align: left; width:90px !important; overflow:hidden}
    </style>';
}


// Remove the slug from published post permalinks. Only affect our custom post type, though.
function retail_remove_cpt_slug( $post_link, $post ) {
    if ( 'retail' === $post->post_type && 'publish' === $post->post_status ) {
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'retail_remove_cpt_slug', 10, 2 );

/* Have WordPress match postname to any of our public post types (post, page, race).
 * All of our public post types can have /post-name/ as the slug, so they need to be unique across all posts.
 * By default, WordPress only accounts for posts and pages where the slug is /post-name/.
 *
 * @param $query The current query. */
function retail_add_cpt_post_names_to_main_query( $query ) {
	// Bail if this is not the main query.
	if ( ! $query->is_main_query() ) {
		return;
	}
	// Bail if this query doesn't match our very specific rewrite rule.
	if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
		return;
	}
	// Bail if we're not querying based on the post name.
	if ( empty( $query->query['name'] ) ) {
		return;
	}
	// Add CPT to the list of post types WP will include when it queries based on the post name.
	$query->set( 'post_type', array( 'post', 'page', 'retail' ) );
}
add_action( 'pre_get_posts', 'retail_add_cpt_post_names_to_main_query' );


// Hide options we don't want seen in custom post editing
if ( is_admin() ) {
	function remove_revolution_slider_meta_boxes() {
		$post_types = get_post_types();
		foreach ( $post_types as $post_type ) {
			if ( 'page' != $post_type && 'post' != $post_type ) {
				remove_meta_box( 'mymetabox_revslider_0', $post_type, 'normal' );
				// Cheat for hiding Avada Options on Custom Posts
				wp_register_style('hide-sortables', get_stylesheet_directory_uri().'/css/sortables.css',false);
				wp_enqueue_style('hide-sortables');

			}
		}
	}
	add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );
}
