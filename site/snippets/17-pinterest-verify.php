<?php
// MoneyViel: Pinterest site verification (Code Snippets #17, front-end)
add_action( 'wp_head', function () {
	if ( is_front_page() ) {
		echo '<meta name="p:domain_verify" content="b6b5a1cb561f42e8dbec3c1ab512489f"/>' . "\n";
	}
}, 1 );
