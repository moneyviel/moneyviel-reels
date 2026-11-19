/**
 * MoneyViel: YouTube embed fallback.
 *
 * Posts are often scheduled before their YouTube Short goes public. WordPress then
 * caches a failed oEmbed and shows an empty 9:16 box with the bare link.
 * This turns any YouTube link that could not be embedded into a normal YouTube player.
 */
function mv_yt_id( $url ) {
	if ( preg_match( '~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|shorts/|embed/|live/))([A-Za-z0-9_-]{11})~', $url, $m ) ) {
		return $m[1];
	}
	return '';
}

add_filter( 'embed_maybe_make_link', function ( $output, $url ) {
	$id = mv_yt_id( $url );
	if ( ! $id ) {
		return $output;
	}
	return '<iframe src="https://www.youtube.com/embed/' . esc_attr( $id ) . '?rel=0" title="YouTube video" loading="lazy" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
}, 10, 2 );
