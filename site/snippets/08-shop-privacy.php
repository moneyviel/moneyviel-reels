/**
 * MoneyViel: keep paid downloads private.
 * Paid PDFs are named like "kit-name-A4-<12 hex>.pdf" and their download pages
 * have slugs like "kit-name-download-<12 hex>". Logged-out visitors cannot list
 * or look them up through the REST API, search, sitemaps or attachment pages,
 * and download pages are marked noindex.
 */
function mv_shop_file_is_private( $file ) {
	return (bool) preg_match( '/-(A4|US-Letter)-[0-9a-f]{12}(-\d+)?\.pdf$/i', (string) $file );
}
function mv_shop_slug_is_private( $slug ) {
	return (bool) preg_match( '/-download-[0-9a-f]{12}$/', (string) $slug );
}
function mv_shop_is_private_post( $post ) {
	$post = get_post( $post );
	if ( ! $post ) {
		return false;
	}
	if ( 'page' === $post->post_type ) {
		return mv_shop_slug_is_private( $post->post_name );
	}
	if ( 'attachment' === $post->post_type ) {
		return mv_shop_file_is_private( get_post_meta( $post->ID, '_wp_attached_file', true ) );
	}
	return false;
}
function mv_shop_private_ids() {
	static $ids = null;
	if ( null !== $ids ) {
		return $ids;
	}
	global $wpdb;
	$ids  = array();
	$rows = $wpdb->get_results( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE '%.pdf'" );
	foreach ( (array) $rows as $r ) {
		if ( mv_shop_file_is_private( $r->meta_value ) ) {
			$ids[] = (int) $r->post_id;
		}
	}
	$pages = $wpdb->get_results( "SELECT ID, post_name FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name LIKE '%-download-%'" );
	foreach ( (array) $pages as $p ) {
		if ( mv_shop_slug_is_private( $p->post_name ) ) {
			$ids[] = (int) $p->ID;
		}
	}
	return $ids;
}
function mv_shop_can_see() {
	return current_user_can( 'edit_pages' );
}
function mv_shop_exclude_args( $args ) {
	if ( mv_shop_can_see() ) {
		return $args;
	}
	$ids = mv_shop_private_ids();
	if ( $ids ) {
		$args['post__not_in'] = array_merge( isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : array(), $ids );
	}
	return $args;
}
add_filter( 'rest_attachment_query', 'mv_shop_exclude_args' );
add_filter( 'rest_page_query', 'mv_shop_exclude_args' );
add_filter( 'rest_post_search_query', 'mv_shop_exclude_args' );
add_filter( 'wp_sitemaps_posts_query_args', 'mv_shop_exclude_args' );

function mv_shop_rest_block( $response, $post ) {
	if ( ! mv_shop_can_see() && mv_shop_is_private_post( $post ) ) {
		return new WP_Error( 'rest_post_invalid_id', 'Invalid post ID.', array( 'status' => 404 ) );
	}
	return $response;
}
add_filter( 'rest_prepare_attachment', 'mv_shop_rest_block', 99, 2 );
add_filter( 'rest_prepare_page', 'mv_shop_rest_block', 99, 2 );

// No attachment page for paid files.
add_action( 'template_redirect', function () {
	if ( is_attachment() && mv_shop_is_private_post( get_queried_object_id() ) && ! mv_shop_can_see() ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
	if ( is_page() && mv_shop_is_private_post( get_queried_object_id() ) ) {
		header( 'X-Robots-Tag: noindex, nofollow, noarchive', true );
		nocache_headers();
	}
}, 1 );

// Keep them out of site search.
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_search() ) {
		$ids = mv_shop_private_ids();
		if ( $ids ) {
			$q->set( 'post__not_in', array_merge( (array) $q->get( 'post__not_in' ), $ids ) );
		}
	}
} );

// Page lists and widgets.
add_filter( 'wp_list_pages_excludes', function ( $ex ) {
	return array_merge( (array) $ex, mv_shop_private_ids() );
} );

// noindex for download pages (WordPress core and Rank Math).
add_filter( 'wp_robots', function ( $robots ) {
	if ( is_singular() && mv_shop_is_private_post( get_queried_object_id() ) ) {
		$robots['noindex']   = true;
		$robots['nofollow']  = true;
		$robots['noarchive'] = true;
		unset( $robots['index'], $robots['follow'], $robots['max-image-preview'] );
	}
	return $robots;
}, 99 );
add_filter( 'rank_math/frontend/robots', function ( $robots ) {
	if ( is_singular() && mv_shop_is_private_post( get_queried_object_id() ) ) {
		return array( 'index' => 'noindex', 'follow' => 'nofollow', 'archive' => 'noarchive' );
	}
	return $robots;
}, 99 );
add_filter( 'rank_math/sitemap/entry', function ( $url, $type, $object ) {
	if ( $object instanceof WP_Post && mv_shop_is_private_post( $object ) ) {
		return false;
	}
	return $url;
}, 99, 3 );
