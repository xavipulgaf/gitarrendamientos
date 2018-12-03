<?php
/**
 * Create Custom Post Type : Agent
 */
if ( ! function_exists( 'create_agent_post_type' ) ) {
	function create_agent_post_type() {
		$labels = array(
			'name' => __( 'Agents', 'framework' ),
			'singular_name' => __( 'Agent', 'framework' ),
			'add_new' => __( 'Add New', 'framework' ),
			'add_new_item' => __( 'Add New Agent', 'framework' ),
			'edit_item' => __( 'Edit Agent', 'framework' ),
			'new_item' => __( 'New Agent', 'framework' ),
			'view_item' => __( 'View Agent', 'framework' ),
			'search_items' => __( 'Search Agent', 'framework' ),
			'not_found' => __( 'No Agent found', 'framework' ),
			'not_found_in_trash' => __( 'No Agent found in Trash', 'framework' ),
			'parent_item_colon' => ''
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_icon' => 'dashicons-businessman',
			'menu_position' => 5,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'rewrite' => array(
				'slug' => apply_filters( 'inspiry_agent_slug', __( 'agent', 'framework' ) )
			)
		);

		register_post_type( 'agent', $args );
	}

	add_action( 'init', 'create_agent_post_type' );
}


if ( ! function_exists( 'inspiry_set_agent_slug' ) ) :
	/**
	 * This function set agent's url slug by hooking itself with related filter
	 *
	 * @param $existing_slug
	 * @return mixed|void
	 */
	function inspiry_set_agent_slug( $existing_slug ) {
		$new_slug = get_option( 'inspiry_agent_slug' );
		if ( ! empty( $new_slug ) ) {
			return $new_slug;
		}
		return $existing_slug;
	}

	add_filter( 'inspiry_agent_slug', 'inspiry_set_agent_slug' );
endif;