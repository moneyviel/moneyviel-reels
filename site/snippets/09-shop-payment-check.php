/**
 * MoneyViel Shop: catalogue, on-site Razorpay checkout, payment checks and signed downloads.
 *
 * - Products live in mv_shop_catalogue(). Prices are in paise.
 * - Buy buttons (class "mv-buy", data-product="slug") open Razorpay Checkout with a server-created order.
 *   After payment the signature is checked on the server, then the buyer goes to /my-downloads/ with a signed token.
 * - A payment ID unlocks the files ONCE (the download page then works for 24 hours). After that, only the logged-in admin can re-open it (for support).
 * - Old Razorpay Payment Pages (Starter Kit, Saving Challenge) keep working through their download pages.
 * - Files are served through 24-hour signed links; real file addresses are never shown.
 * - API keys are pasted by the owner in Settings > MoneyViel Shop (never stored in code).
 */

function mv_shop_catalogue() {
	$kids_files = array(
		array( 'Starter Kit (A4)', 2441 ), array( 'Starter Kit (US Letter)', 2442 ),
		array( 'Saving Challenge (A4)', 2443 ), array( 'Saving Challenge (US Letter)', 2444 ),
		array( 'Money Detective (A4)', 2439 ), array( 'Money Detective (US Letter)', 2440 ),
		array( 'Bank Book (A4)', 2445 ), array( 'Bank Book (US Letter)', 2446 ),
		array( 'MoneyViel Mart (A4)', 2447 ), array( 'MoneyViel Mart (US Letter)', 2448 ),
		array( 'Chore & Earn (A4)', 2449 ), array( 'Chore & Earn (US Letter)', 2450 ),
	);
	$pip_files = array(
		array( 'Starter Kit (A4)', 2441 ), array( 'Starter Kit (US Letter)', 2442 ),
		array( 'Saving Challenge (A4)', 2443 ), array( 'Saving Challenge (US Letter)', 2444 ),
		array( 'Bank Book (A4)', 2445 ), array( 'Bank Book (US Letter)', 2446 ),
		array( 'Chore & Earn (A4)', 2449 ), array( 'Chore & Earn (US Letter)', 2450 ),
	);
	return array(
		'starter-kit'           => array( 'name' => 'Money Club Starter Kit', 'price' => 14900, 'legacy' => true, 'files' => array( array( 'A4 PDF', 2441 ), array( 'US Letter PDF', 2442 ) ) ),
		'saving-challenge'      => array( 'name' => '30-Day Saving Challenge', 'price' => 9900, 'legacy' => true, 'files' => array( array( 'A4 PDF', 2443 ), array( 'US Letter PDF', 2444 ) ) ),
		'money-detective'       => array( 'name' => 'Money Detective Escape Game', 'price' => 14900, 'files' => array( array( 'A4 PDF', 2439 ), array( 'US Letter PDF', 2440 ) ) ),
		'bank-book'             => array( 'name' => "Pip's Pocket-Money Bank Book", 'price' => 9900, 'files' => array( array( 'A4 PDF', 2445 ), array( 'US Letter PDF', 2446 ) ) ),
		'moneyviel-mart'        => array( 'name' => 'MoneyViel Mart Pretend Shop', 'price' => 12900, 'files' => array( array( 'A4 PDF', 2447 ), array( 'US Letter PDF', 2448 ) ) ),
		'chore-earn'            => array( 'name' => 'Chore & Earn Board', 'price' => 9900, 'files' => array( array( 'A4 PDF', 2449 ), array( 'US Letter PDF', 2450 ) ) ),
		'kids-bundle'           => array( 'name' => 'Family Bundle: all 6 MoneyViel Kids kits', 'price' => 39900, 'files' => $kids_files ),
		'emergency-organiser'   => array( 'name' => 'Family Safety Net', 'price' => 29900, 'files' => array( array( 'Access card (PDF, A4): your Google Sheets links', 2533 ), array( 'Access card (PDF, US Letter)', 2534 ) ), 'note' => 'Open the access card and click "Make my copy" to save your own private Google Sheets copy (free Google account needed). This is a Google Sheets tool; Excel is not supported. Never type passwords or full account numbers in it. For personal and family use only. See our <a href="https://moneyviel.com/terms/">Terms</a>.' ),
		'money-date-night'      => array( 'name' => 'Money Date Night Cards', 'price' => 19900, 'files' => array( array( 'A4 PDF', 2453 ), array( 'US Letter PDF', 2454 ) ) ),
		'money-command-centre'  => array( 'name' => 'Money Command Centre', 'price' => 39900, 'files' => array( array( 'Access card (PDF): your Google Sheets links', 2520 ) ), 'note' => 'Open the access card and click "Make my copy" to save your own private Google Sheets copy (free Google account needed). This is a Google Sheets tool; Excel is not supported. For personal and family use only. See our <a href="https://moneyviel.com/terms/">Terms</a>.' ),
		'wedding-event-planner' => array( 'name' => 'Wedding & Big-Event Planner', 'price' => 24900, 'files' => array( array( 'Access card (PDF, A4): your Google Sheets links', 2586 ), array( 'Access card (PDF, US Letter)', 2587 ) ), 'note' => 'Open the access card and click "Make my copy" to save your own private Google Sheets copy (free Google account needed). This is a Google Sheets tool; Excel is not supported. For personal and family use only. See our <a href="https://moneyviel.com/terms/">Terms</a>.' ),
		/* Apps (Nov 2026 launch offer). 'apps' = app keys from mv_shop_apps(); 'files' = bonus printables. */
		'app-pip'         => array( 'name' => "Pip's Money Club app", 'price' => 4900, 'usd' => 199, 'apps' => array( 'pip' ), 'files' => $pip_files ),
		'app-detective'   => array( 'name' => 'Money Detective app (100 cases)', 'price' => 4900, 'usd' => 199, 'apps' => array( 'detective' ), 'files' => array( array( 'Bonus printable (A4)', 2439 ), array( 'Bonus printable (US Letter)', 2440 ) ) ),
		'app-mart'        => array( 'name' => 'MoneyViel Mart app (100 missions)', 'price' => 4900, 'usd' => 199, 'apps' => array( 'mart' ), 'files' => array( array( 'Bonus printable (A4)', 2447 ), array( 'Bonus printable (US Letter)', 2448 ) ) ),
		'app-datenight'   => array( 'name' => 'Money Date Night app', 'price' => 4900, 'usd' => 199, 'apps' => array( 'datenight' ), 'files' => array( array( 'Bonus printable cards (A4)', 2453 ), array( 'Bonus printable cards (US Letter)', 2454 ) ) ),
		'app-kids-bundle' => array( 'name' => 'MoneyViel Kids bundle: 3 apps', 'price' => 9900, 'usd' => 399, 'apps' => array( 'pip', 'detective', 'mart' ), 'files' => $kids_files ),
		'app-all'         => array( 'name' => 'All 4 MoneyViel apps', 'price' => 14900, 'usd' => 599, 'apps' => array( 'pip', 'detective', 'mart', 'datenight' ), 'files' => array_merge( $kids_files, array( array( 'Money Date Night cards (A4)', 2453 ), array( 'Money Date Night cards (US Letter)', 2454 ) ) ) ),
	);
}
/** Old download pages (from the Razorpay Payment Pages) => product slug. */
function mv_pay_legacy_pages() {
	return array( 2361 => 'starter-kit', 2362 => 'saving-challenge' );
}
function mv_shop_all_files() {
	$ids = array();
	foreach ( mv_shop_catalogue() as $p ) {
		foreach ( $p['files'] as $f ) {
			$ids[] = (int) $f[1];
		}
	}
	return array_unique( $ids );
}
function mv_pay_settings() {
	$s = get_option( 'mv_shop_keys', array() );
	return wp_parse_args( is_array( $s ) ? $s : array(), array( 'live_id' => '', 'live_secret' => '', 'test_id' => '', 'test_secret' => '', 'allow_test' => 0, 'intl_on' => 0, 'ph' => array() ) );
}

/* ---------- Settings page (owner pastes keys here) ---------- */
add_action( 'admin_menu', function () {
	add_options_page( 'MoneyViel Shop', 'MoneyViel Shop', 'manage_options', 'mv-shop', 'mv_pay_settings_page' );
} );
function mv_pay_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$s   = mv_pay_settings();
	$msg = '';
	if ( isset( $_POST['mv_shop_save'] ) && check_admin_referer( 'mv_shop_keys' ) ) {
		foreach ( array( 'live_id', 'test_id' ) as $k ) {
			$s[ $k ] = sanitize_text_field( wp_unslash( $_POST[ $k ] ?? '' ) );
		}
		foreach ( array( 'live_secret', 'test_secret' ) as $k ) {
			$v = trim( (string) wp_unslash( $_POST[ $k ] ?? '' ) );
			if ( '' !== $v ) {
				$s[ $k ] = sanitize_text_field( $v ); // Empty box = keep the saved secret.
			}
			if ( ! empty( $_POST[ 'clear_' . $k ] ) ) {
				$s[ $k ] = '';
			}
		}
		$s['allow_test'] = empty( $_POST['allow_test'] ) ? 0 : 1;
		$s['intl_on']    = empty( $_POST['intl_on'] ) ? 0 : 1;
		$ph              = is_array( $s['ph'] ) ? $s['ph'] : array();
		foreach ( mv_shop_catalogue() as $slug => $prod ) {
			if ( ! empty( $prod['legacy'] ) ) {
				continue;
			}
			$u = esc_url_raw( trim( (string) wp_unslash( $_POST[ 'ph_url_' . $slug ] ?? '' ) ) );
			$ph[ $slug ]['url'] = ( '' === $u || preg_match( '#^https://payhip\.com/b/[A-Za-z0-9]+$#', $u ) ) ? $u : ( $ph[ $slug ]['url'] ?? '' );
			$k = trim( (string) wp_unslash( $_POST[ 'ph_key_' . $slug ] ?? '' ) );
			if ( '' !== $k ) {
				$ph[ $slug ]['key'] = sanitize_text_field( $k ); // Empty box = keep the saved key.
			}
			if ( ! empty( $_POST[ 'ph_clear_' . $slug ] ) ) {
				$ph[ $slug ]['key'] = '';
			}
		}
		$s['ph'] = $ph;
		update_option( 'mv_shop_keys', $s, false );
		$msg = 'Saved.';
	}
	$test_result = '';
	if ( isset( $_POST['mv_shop_test'] ) && check_admin_referer( 'mv_shop_keys' ) ) {
		foreach ( array( 'live', 'test' ) as $mode ) {
			if ( $s[ $mode . '_id' ] && $s[ $mode . '_secret' ] ) {
				$r    = wp_remote_get( 'https://api.razorpay.com/v1/payments?count=1', array( 'timeout' => 15, 'headers' => array( 'Authorization' => 'Basic ' . base64_encode( $s[ $mode . '_id' ] . ':' . $s[ $mode . '_secret' ] ) ) ) );
				$code = is_wp_error( $r ) ? $r->get_error_message() : wp_remote_retrieve_response_code( $r );
				$test_result .= ucfirst( $mode ) . ' keys: ' . ( 200 === $code ? 'working ✅' : 'not working (' . esc_html( (string) $code ) . ') ❌' ) . '<br>';
			}
		}
		if ( ! $test_result ) {
			$test_result = 'No keys saved yet.';
		}
	}
	echo '<div class="wrap"><h1>MoneyViel Shop: Razorpay keys</h1>';
	if ( $msg ) {
		echo '<div class="notice notice-success"><p>' . esc_html( $msg ) . '</p></div>';
	}
	if ( $test_result ) {
		echo '<div class="notice notice-info"><p>' . wp_kses_post( $test_result ) . '</p></div>';
	}
	echo '<p>Create keys in the Razorpay Dashboard → Account &amp; Settings → API Keys. The secret is shown only once in Razorpay, so paste it here straight away. Saved secrets are never shown again; leave a secret box empty to keep the saved one.</p>';
	echo '<form method="post">';
	wp_nonce_field( 'mv_shop_keys' );
	echo '<table class="form-table">';
	echo '<tr><th>Live Key ID</th><td><input type="text" name="live_id" class="regular-text" autocomplete="off" value="' . esc_attr( $s['live_id'] ) . '" placeholder="rzp_live_..."></td></tr>';
	echo '<tr><th>Live Key Secret</th><td><input type="password" name="live_secret" class="regular-text" autocomplete="new-password" placeholder="' . ( $s['live_secret'] ? 'saved (hidden)' : 'not set' ) . '"> <label><input type="checkbox" name="clear_live_secret" value="1"> remove</label></td></tr>';
	echo '<tr><th>Test Key ID</th><td><input type="text" name="test_id" class="regular-text" autocomplete="off" value="' . esc_attr( $s['test_id'] ) . '" placeholder="rzp_test_..."></td></tr>';
	echo '<tr><th>Test Key Secret</th><td><input type="password" name="test_secret" class="regular-text" autocomplete="new-password" placeholder="' . ( $s['test_secret'] ? 'saved (hidden)' : 'not set' ) . '"> <label><input type="checkbox" name="clear_test_secret" value="1"> remove</label></td></tr>';
	echo '<tr><th>Accept test payments</th><td><label><input type="checkbox" name="allow_test" value="1" ' . checked( 1, (int) $s['allow_test'], false ) . '> Yes, for testing only. Untick after testing.</label></td></tr>';
	echo '<tr><th>International buyers (USD)</th><td><label><input type="checkbox" name="intl_on" value="1" ' . checked( 1, (int) $s['intl_on'], false ) . '> Show US-dollar prices to buyers outside India. Tick this only after Razorpay has switched on International payments for your account.</label></td></tr>';
	echo '</table><h2>Payhip (EU &amp; UK buyers)</h2><p>EU and UK buyers are sent to Payhip, which charges and pays VAT for us. For each product: paste its Payhip product link (https://payhip.com/b/XXXX). For app products also paste the licence-key <b>product secret key</b> (Payhip → product → Edit → Software licence keys). Saved keys are never shown again.</p><table class="form-table">';
	$ph = is_array( $s['ph'] ) ? $s['ph'] : array();
	foreach ( mv_shop_catalogue() as $slug => $prod ) {
		if ( ! empty( $prod['legacy'] ) ) {
			continue;
		}
		$cur = $ph[ $slug ] ?? array();
		echo '<tr><th>' . esc_html( $prod['name'] ) . '</th><td><input type="url" name="ph_url_' . esc_attr( $slug ) . '" class="regular-text" placeholder="https://payhip.com/b/XXXX" value="' . esc_attr( $cur['url'] ?? '' ) . '">';
		if ( empty( $prod['apps'] ) ) {
			echo '</td></tr>';
			continue;
		}
		echo '<br><input type="password" name="ph_key_' . esc_attr( $slug ) . '" class="regular-text" autocomplete="new-password" placeholder="' . ( ! empty( $cur['key'] ) ? 'product secret key saved (hidden)' : 'product secret key: not set' ) . '"> <label><input type="checkbox" name="ph_clear_' . esc_attr( $slug ) . '" value="1"> remove</label></td></tr>';
	}
	echo '</table><p><button class="button button-primary" name="mv_shop_save" value="1">Save</button> <button class="button" name="mv_shop_test" value="1">Check keys</button></p></form></div>';
}


function mv_pay_keys_ready( $mode = 'live' ) {
	$s = mv_pay_settings();
	return ( 'test' === $mode ) ? ( $s['test_id'] && $s['test_secret'] ) : ( $s['live_id'] && $s['live_secret'] );
}
function mv_pay_ready() {
	$s = mv_pay_settings();
	return mv_pay_keys_ready( 'live' ) || ( $s['allow_test'] && mv_pay_keys_ready( 'test' ) );
}
function mv_pay_api( $method, $path, $mode, $body = null ) {
	$s = mv_pay_settings();
	if ( ! mv_pay_keys_ready( $mode ) ) {
		return null;
	}
	$args = array(
		'method'  => $method,
		'timeout' => 15,
		'headers' => array( 'Authorization' => 'Basic ' . base64_encode( $s[ $mode . '_id' ] . ':' . $s[ $mode . '_secret' ] ), 'Content-Type' => 'application/json' ),
	);
	if ( null !== $body ) {
		$args['body'] = wp_json_encode( $body );
	}
	$r = wp_remote_request( 'https://api.razorpay.com/v1/' . ltrim( $path, '/' ), $args );
	if ( is_wp_error( $r ) ) {
		return 'error';
	}
	$code = wp_remote_retrieve_response_code( $r );
	if ( $code >= 500 ) {
		return 'error';
	}
	if ( $code < 200 || $code > 299 ) {
		return null;
	}
	$j = json_decode( wp_remote_retrieve_body( $r ), true );
	return is_array( $j ) ? $j : 'error';
}
function mv_pay_fetch( $pay_id, $mode ) {
	return mv_pay_api( 'GET', 'payments/' . rawurlencode( $pay_id ), $mode );
}
/** Looks a payment up once (live, then test if allowed). Returns array (status, amount, currency, product, mode), null (not found) or 'error'. */
function mv_pay_lookup( $pay_id, $force_mode = '' ) {
	if ( ! preg_match( '/^pay_[A-Za-z0-9]{8,30}$/', $pay_id ) ) {
		return null;
	}
	$cache_key = 'mv_payl2_' . md5( $pay_id . $force_mode );
	$cached    = get_transient( $cache_key );
	if ( false !== $cached ) {
		return 'none' === $cached ? null : $cached;
	}
	$s     = mv_pay_settings();
	$modes = $force_mode ? array( $force_mode ) : array( 'live' );
	// Test (no-money) payments are only ever accepted for the logged-in site admin.
	if ( ! $force_mode && $s['allow_test'] && current_user_can( 'manage_options' ) ) {
		$modes[] = 'test';
	}
	$result = null;
	foreach ( $modes as $mode ) {
		$p = mv_pay_fetch( $pay_id, $mode );
		if ( 'error' === $p ) {
			$result = 'error';
			continue;
		}
		if ( is_array( $p ) ) {
			$product = '';
			if ( ! empty( $p['notes']['mv_product'] ) ) {
				$product = (string) $p['notes']['mv_product'];
			} elseif ( ! empty( $p['order_id'] ) ) {
				$o = mv_pay_api( 'GET', 'orders/' . rawurlencode( $p['order_id'] ), $mode );
				if ( is_array( $o ) && ! empty( $o['notes']['mv_product'] ) ) {
					$product = (string) $o['notes']['mv_product'];
				}
			}
			$result = array( 'status' => $p['status'] ?? '', 'amount' => (int) ( $p['amount'] ?? 0 ), 'currency' => $p['currency'] ?? '', 'product' => $product, 'mode' => $mode, 'order_id' => $p['order_id'] ?? '' );
			break;
		}
	}
	if ( 'error' !== $result ) {
		// Cache a captured payment for 10 minutes; anything else only briefly, so a just-captured payment is seen quickly.
		$ttl = ( is_array( $result ) && 'captured' === $result['status'] ) ? 10 * MINUTE_IN_SECONDS : 20;
		set_transient( $cache_key, null === $result ? 'none' : $result, $ttl );
	}
	return $result;
}
/** Which catalogue product did this payment buy? Returns slug or ''. */
function mv_pay_product_for( $p ) {
	// Only fully captured payments unlock files (an 'authorized' payment can still lapse and be returned to the buyer).
	if ( ! is_array( $p ) || ! in_array( $p['currency'], array( 'INR', 'USD' ), true ) || 'captured' !== $p['status'] ) {
		return '';
	}
	$cat = mv_shop_catalogue();
	if ( 'USD' === $p['currency'] ) {
		$prod = $p['product'] && isset( $cat[ $p['product'] ] ) ? $cat[ $p['product'] ] : null;
		return ( $prod && ! empty( $prod['usd'] ) && (int) $prod['usd'] === (int) $p['amount'] ) ? $p['product'] : '';
	}
	if ( $p['product'] ) {
		return ( isset( $cat[ $p['product'] ] ) && (int) $cat[ $p['product'] ]['price'] === (int) $p['amount'] ) ? $p['product'] : '';
	}
	// Old Razorpay Payment Pages carry no product note: match by price among the legacy products only.
	if ( 'captured' !== $p['status'] ) {
		return '';
	}
	foreach ( $cat as $slug => $prod ) {
		if ( ! empty( $prod['legacy'] ) && (int) $prod['price'] === (int) $p['amount'] ) {
			return $slug;
		}
	}
	return '';
}
/** Payhip licence key (EU/UK buyers) -> array( product slug, app id ) or null. Checks each app product's Payhip key; a refunded key is disabled by Payhip. */
function mv_payhip_licence( $key ) {
	$key = strtoupper( trim( $key ) );
	if ( ! preg_match( '/^[A-Z0-9-]{10,64}$/', $key ) ) {
		return null;
	}
	$st = mv_pay_settings();
	foreach ( mv_shop_catalogue() as $slug => $prod ) {
		$secret = $st['ph'][ $slug ]['key'] ?? '';
		if ( empty( $prod['apps'] ) || ! $secret ) {
			continue;
		}
		$r = wp_remote_get( 'https://payhip.com/api/v2/license/verify?license_key=' . rawurlencode( $key ), array( 'timeout' => 12, 'headers' => array( 'product-secret-key' => $secret ) ) );
		if ( is_wp_error( $r ) || 200 !== (int) wp_remote_retrieve_response_code( $r ) ) {
			continue;
		}
		$j = json_decode( wp_remote_retrieve_body( $r ), true );
		if ( ! empty( $j['data']['enabled'] ) ) {
			return array( $slug, 'phl_' . substr( hash_hmac( 'sha256', $key, wp_salt( 'auth' ) . 'mv-ph' ), 0, 20 ) );
		}
	}
	return null;
}
/** Counts a use of the payment ID: it unlocks once only. The logged-in admin can always re-open it to help a buyer. Returns true if allowed. */
function mv_pay_count_use( $pay_id ) {
	$log = get_option( 'mv_shop_unlocks', array() );
	$log = is_array( $log ) ? $log : array();
	$now = time();
	if ( empty( $log[ $pay_id ] ) ) {
		$log[ $pay_id ] = array( 'first' => $now, 'count' => 0 );
	}
	if ( current_user_can( 'manage_options' ) ) {
		return true;
	}
	if ( (int) $log[ $pay_id ]['count'] >= 1 ) {
		return false;
	}
	$log[ $pay_id ]['count']++;
	foreach ( $log as $k => $v ) {
		if ( $now - (int) $v['first'] > 60 * DAY_IN_SECONDS ) {
			unset( $log[ $k ] );
		}
	}
	update_option( 'mv_shop_unlocks', $log, false );
	return true;
}
function mv_pay_rate_ok( $limit = 20 ) {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? md5( (string) $_SERVER['REMOTE_ADDR'] ) : 'x';
	$key = 'mv_pay_rl_' . $ip;
	$n   = (int) get_transient( $key );
	if ( $n >= $limit ) {
		return false;
	}
	set_transient( $key, $n + 1, HOUR_IN_SECONDS );
	return true;
}

/* ---------- Browser binding: files open only in the browser that unlocked them ---------- */
function mv_dev_id() {
	if ( current_user_can( 'manage_options' ) ) {
		return '-'; // Admin: links are not tied to a browser, so they can be sent to a buyer who needs help.
	}
	$d = isset( $_COOKIE['mv_dev'] ) ? (string) $_COOKIE['mv_dev'] : '';
	return preg_match( '/^[a-f0-9]{32}$/', $d ) ? $d : '';
}
add_action( 'init', function () {
	$uri  = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	$need = ! empty( $_GET['mv_t'] ) || isset( $_POST['mv_pay_id'] ) || isset( $_GET['razorpay_payment_id'] ) || false !== strpos( $uri, 'mv-shop/v1/verify' );
	if ( ! $need || headers_sent() || ( isset( $_COOKIE['mv_dev'] ) && preg_match( '/^[a-f0-9]{32}$/', (string) $_COOKIE['mv_dev'] ) ) ) {
		return;
	}
	$d = bin2hex( random_bytes( 16 ) );
	setcookie( 'mv_dev', $d, array( 'expires' => time() + 2 * DAY_IN_SECONDS, 'path' => '/', 'secure' => is_ssl(), 'httponly' => true, 'samesite' => 'Lax' ) );
	$_COOKIE['mv_dev'] = $d;
}, 0 );

/* ---------- Signed download links and access tokens ---------- */
function mv_pay_sign( $att, $exp, $dev = '' ) {
	return hash_hmac( 'sha256', $att . '|' . $exp . '|' . $dev, wp_salt( 'auth' ) . 'mv-shop' );
}
function mv_pay_link( $att ) {
	$exp = time() + DAY_IN_SECONDS;
	$dev = mv_dev_id();
	$a   = array( 'mv_dl' => (int) $att, 'e' => $exp, 's' => mv_pay_sign( (int) $att, $exp, $dev ) );
	if ( '-' === $dev ) {
		$a['o'] = 1;
	}
	return add_query_arg( $a, home_url( '/' ) );
}
function mv_pay_token( $pay_id, $slug ) {
	$exp = time() + DAY_IN_SECONDS;
	$sig = substr( hash_hmac( 'sha256', $pay_id . '|' . $slug . '|' . $exp . '|' . mv_dev_id(), wp_salt( 'auth' ) . 'mv-token' ), 0, 32 );
	return rtrim( strtr( base64_encode( $pay_id . '|' . $slug . '|' . $exp . '|' . $sig ), '+/', '-_' ), '=' );
}
function mv_pay_read_token( $t ) {
	$raw   = base64_decode( strtr( (string) $t, '-_', '+/' ) );
	$parts = explode( '|', (string) $raw );
	if ( 4 !== count( $parts ) ) {
		return null;
	}
	list( $pay_id, $slug, $exp, $sig ) = $parts;
	$dev  = mv_dev_id();
	$good = substr( hash_hmac( 'sha256', $pay_id . '|' . $slug . '|' . $exp . '|' . $dev, wp_salt( 'auth' ) . 'mv-token' ), 0, 32 );
	if ( (int) $exp < time() || '' === $dev || ! hash_equals( $good, $sig ) ) {
		return null;
	}
	return array( $pay_id, $slug );
}
add_action( 'init', function () {
	if ( empty( $_GET['mv_dl'] ) ) {
		return;
	}
	$att = (int) $_GET['mv_dl'];
	$exp = (int) ( $_GET['e'] ?? 0 );
	$sig = (string) ( $_GET['s'] ?? '' );
	$dev = empty( $_GET['o'] ) ? ( isset( $_COOKIE['mv_dev'] ) && preg_match( '/^[a-f0-9]{32}$/', (string) $_COOKIE['mv_dev'] ) ? (string) $_COOKIE['mv_dev'] : 'none' ) : '-';
	if ( ! in_array( $att, mv_shop_all_files(), true ) || $exp < time() || ! hash_equals( mv_pay_sign( $att, $exp, $dev ), $sig ) ) {
		status_header( 403 );
		nocache_headers();
		wp_die( 'This download link has expired, or it was opened in a different browser or device from the one used to buy. Download links work only in the browser used for the purchase, for 24 hours. Need help? Email support@moneyviel.com with your payment ID.', 'Download link not valid here', array( 'response' => 403 ) );
	}
	$file = get_attached_file( $att );
	if ( ! $file || ! is_readable( $file ) ) {
		status_header( 404 );
		exit;
	}
	$base = basename( $file );
	$name = preg_replace( '/-[0-9a-f]{12}(?=\.(pdf|xlsx|zip)$)/i', '', $base );
	$name = preg_replace( '/^mvp-/', '', $name );
	$name = str_replace( '-xlsx.', '.', $name );
	$name = 'moneyviel-' . preg_replace( '/^moneyviel-/', '', $name );
	$ext  = strtolower( pathinfo( $base, PATHINFO_EXTENSION ) );
	$type = array( 'pdf' => 'application/pdf', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'zip' => 'application/zip' );
	nocache_headers();
	header( 'X-Robots-Tag: noindex, nofollow', true );
	header( 'Content-Type: ' . ( $type[ $ext ] ?? 'application/octet-stream' ) );
	header( 'Content-Disposition: attachment; filename="' . $name . '"' );
	header( 'Content-Length: ' . filesize( $file ) );
	while ( ob_get_level() ) {
		ob_end_clean();
	}
	readfile( $file );
	exit;
}, 1 );

/** The download box shown after a successful check. */
function mv_pay_files_box( $slug ) {
	$cat = mv_shop_catalogue();
	$p   = $cat[ $slug ];
	$out = '<div style="background:linear-gradient(135deg,#fff6dd,#ffe9f0);border-radius:22px;padding:24px 20px;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.06);margin:10px 0 18px">';
	$out .= '<h2 style="margin:0 0 6px">🎉 Your ' . esc_html( $p['name'] ) . '</h2>';
	if ( ! empty( $p['apps'] ) && ! empty( $GLOBALS['mv_cur_pay_id'] ) ) {
		$out .= mv_app_links_box( $GLOBALS['mv_cur_pay_id'], $p['apps'] );
		$out .= '<h3 style="margin:18px 0 4px">🎁 Bonus printables</h3>';
	}
	$out .= '<p style="margin:0 0 12px;font-size:.92em;color:#4b5563">Download links work for 24 hours, only in this browser. Please save your files now. Problem? Email support@moneyviel.com with your payment ID.</p><p>';
	foreach ( $p['files'] as $i => $f ) {
		$bg   = ( $i % 2 ) ? '#6d28d9' : '#e8457a';
		$out .= '<a style="display:inline-block;margin:6px;padding:13px 20px;border-radius:999px;font-weight:700;text-decoration:none;color:#fff;background:' . $bg . '" href="' . esc_url( mv_pay_link( $f[1] ) ) . '">⬇ ' . esc_html( $f[0] ) . '</a>';
	}
	$note = isset( $p['note'] ) ? $p['note'] : 'PDFs: print at 100% / Actual size. Spreadsheets open in Excel, or upload to Google Sheets (File → Import). For personal, family or single-classroom use only. See our <a href="https://moneyviel.com/terms/">Terms</a>.';
	$out .= '</p><p style="font-size:.88em;margin:8px 0 0">' . $note . '</p></div>';
	return $out;
}

/* ---------- Old download pages (Razorpay Payment Pages) ---------- */
add_filter( 'the_content', function ( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$id     = get_the_ID();
	$legacy = mv_pay_legacy_pages();
	if ( ! isset( $legacy[ $id ] ) ) {
		return $content;
	}
	$slug    = $legacy[ $id ];
	$product = mv_shop_catalogue()[ $slug ];
	$admin   = current_user_can( 'edit_pages' );
	$pay_id  = '';
	if ( isset( $_POST['mv_pay_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_POST['mv_pay_id'] ) ) );
	} elseif ( isset( $_GET['razorpay_payment_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_GET['razorpay_payment_id'] ) ) );
	}
	$state = '';
	if ( ! mv_pay_ready() ) {
		$state = 'ok';
	} elseif ( $admin && '' === $pay_id ) {
		$state = 'ok';
	} elseif ( '' !== $pay_id ) {
		if ( ! mv_pay_rate_ok() ) {
			$state = 'busy';
		} else {
			$p = mv_pay_lookup( $pay_id );
			if ( 'error' === $p ) {
				$state = 'error';
			} elseif ( mv_pay_product_for( $p ) !== $slug ) {
				$state = 'bad';
			} else {
				$state = mv_pay_count_use( $pay_id ) ? 'ok' : 'limit';
			}
		}
	}
	if ( 'ok' === $state ) {
		$content = str_replace(
			array( '#mv-a4', '#mv-letter' ),
			array( esc_url( mv_pay_link( $product['files'][0][1] ) ), esc_url( mv_pay_link( $product['files'][1][1] ) ) ),
			$content
		);
		if ( mv_pay_ready() && $admin && '' === $pay_id ) {
			$content = '<p style="background:#fff3cd;padding:10px 14px;border-radius:10px;font-size:14px">Admin preview: you see the files because you are logged in. Buyers see them only after their payment is checked.</p>' . $content;
		}
		return $content;
	}
	$msgs = array(
		''      => '',
		'bad'   => 'We could not find a successful payment for this product with that payment ID. Please check the ID in your Razorpay receipt email (it starts with "pay_").',
		'limit' => 'This payment ID has already been used to unlock the files. If you could not download them, email support@moneyviel.com with your payment ID and we will help.',
		'error' => 'We could not reach our payment provider just now. Please try again in a minute.',
		'busy'  => 'Too many attempts. Please wait an hour or email support@moneyviel.com.',
	);
	$msg  = $msgs[ $state ] ?? '';
	$out  = '<div class="mv-dl" style="max-width:640px;margin:0 auto;font-size:17px;line-height:1.6;color:#1f2937">';
	$out .= '<h1 style="text-align:center;font-size:1.8em;line-height:1.25">🔒 Your ' . esc_html( $product['name'] ) . ' download</h1>';
	if ( $msg ) {
		$out .= '<p style="background:#fde8ef;border-radius:12px;padding:12px 16px">' . esc_html( $msg ) . '</p>';
	}
	$out .= '<p>Thank you for your purchase! To open your download page, please enter the <strong>payment ID</strong> from your Razorpay receipt email or payment screen. It starts with <strong>pay_</strong>.</p>';
	$out .= '<form method="post" action="' . esc_url( get_permalink( $id ) ) . '" style="display:flex;flex-wrap:wrap;gap:10px;margin:14px 0">';
	$out .= '<input type="text" name="mv_pay_id" required pattern="pay_[A-Za-z0-9]+" placeholder="pay_XXXXXXXXXXXXXX" autocomplete="off" aria-label="Razorpay payment ID" style="flex:1;min-width:220px;padding:12px 14px;border:1px solid #d1d5db;border-radius:999px;font-size:16px">';
	$out .= '<button type="submit" style="padding:12px 22px;border:0;border-radius:999px;background:#e8457a;color:#fff;font-weight:700;font-size:16px;cursor:pointer">Show my files</button></form>';
	$out .= '<p style="font-size:.9em;color:#4b5563">Haven\'t bought this yet? Visit our <a href="https://moneyviel.com/shop/">shop</a>. Need help? Email <a href="mailto:support@moneyviel.com">support@moneyviel.com</a> with your payment ID.</p></div>';
	return $out;
}, 20 );

/* ---------- Public "My downloads" page: [mv_my_downloads] ---------- */
add_shortcode( 'mv_my_downloads', function () {
	$out = '<div class="mv-my-dl" style="max-width:640px;margin:0 auto;font-size:17px;line-height:1.6;color:#1f2937">';
	$msg = '';
	if ( ! empty( $_GET['mv_t'] ) ) {
		$tok = mv_pay_read_token( sanitize_text_field( wp_unslash( $_GET['mv_t'] ) ) );
		if ( $tok && isset( mv_shop_catalogue()[ $tok[1] ] ) ) {
			$GLOBALS['mv_cur_pay_id'] = $tok[0];
			return $out . '<p style="background:#e6f6ea;border-radius:12px;padding:12px 16px">✅ Payment successful. Thank you! Your payment ID is <b>' . esc_html( $tok[0] ) . '</b>. Keep it in case you need help.</p>' . mv_pay_files_box( $tok[1] ) . '</div>';
		}
		$msg = 'This download page has expired, or it was opened in a different browser or device from the one used to buy. If you have not used your payment ID yet, enter it below; otherwise email support@moneyviel.com with your payment ID.';
	}
	$pay_id = '';
	if ( isset( $_POST['mv_pay_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_POST['mv_pay_id'] ) ) );
	} elseif ( isset( $_GET['razorpay_payment_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_GET['razorpay_payment_id'] ) ) );
	}
	if ( '' !== $pay_id && ! preg_match( '/^pay_/', $pay_id ) ) {
		if ( ! mv_pay_rate_ok() ) {
			$msg = 'Too many attempts. Please wait an hour or email support@moneyviel.com.';
		} else {
			$lic = mv_payhip_licence( $pay_id );
			if ( $lic ) {
				$GLOBALS['mv_cur_pay_id'] = $lic[1];
				$out .= mv_pay_files_box( $lic[0] );
			} else {
				$msg = 'We could not find an active MoneyViel licence with that key. Please copy the licence key exactly from your Payhip receipt email, or email support@moneyviel.com.';
			}
		}
		$pay_id = '';
	}
	if ( '' !== $pay_id ) {
		if ( ! mv_pay_ready() ) {
			$msg = 'Downloads by payment ID are being set up. Please email support@moneyviel.com with your payment ID and we will send your files.';
		} elseif ( ! mv_pay_rate_ok() ) {
			$msg = 'Too many attempts. Please wait an hour or email support@moneyviel.com.';
		} else {
			$p = mv_pay_lookup( $pay_id );
			if ( 'error' === $p ) {
				$msg = 'We could not reach our payment provider just now. Please try again in a minute.';
			} else {
				$slug = mv_pay_product_for( $p );
				if ( ! $slug ) {
					$msg = 'We could not find a successful MoneyViel purchase with that payment ID. Please check the ID in your Razorpay receipt email (it starts with "pay_").';
				} elseif ( empty( mv_shop_catalogue()[ $slug ]['apps'] ) && ! mv_pay_count_use( $pay_id ) ) {
					$msg = 'This payment ID has already been used to unlock the files. If you could not download them, email support@moneyviel.com with your payment ID and we will help.';
				} else {
					$GLOBALS['mv_cur_pay_id'] = $pay_id;
					$out .= mv_pay_files_box( $slug );
				}
			}
		}
	}
	if ( $msg ) {
		$out .= '<p style="background:#fde8ef;border-radius:12px;padding:12px 16px">' . esc_html( $msg ) . '</p>';
	}
	$out .= '<p style="font-size:.92em;color:#4b5563;margin:14px 0 0">Bought on moneyviel.com? Enter your Razorpay <b>payment ID</b> (starts with pay_). Bought on Payhip (EU &amp; UK)? Enter the <b>licence key</b> from your Payhip receipt email.</p>';
	$out .= '<form method="post" action="' . esc_url( get_permalink() ) . '" style="display:flex;flex-wrap:wrap;gap:10px;margin:10px 0 18px">';
	$out .= '<input type="text" name="mv_pay_id" required pattern="(pay_[A-Za-z0-9]+|[A-Za-z0-9-]{10,64})" placeholder="pay_XXXXXXXXXXXXXX or licence key" autocomplete="off" aria-label="Razorpay payment ID or Payhip licence key" style="flex:1;min-width:220px;padding:12px 14px;border:1px solid #d1d5db;border-radius:999px;font-size:16px">';
	$out .= '<button type="submit" style="padding:12px 22px;border:0;border-radius:999px;background:#e8457a;color:#fff;font-weight:700;font-size:16px;cursor:pointer">Get my files</button></form>';
	$out .= '</div>';
	return $out;
} );

/* ---------- On-site checkout ---------- */
add_action( 'rest_api_init', function () {
	register_rest_route( 'mv-shop/v1', '/order', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => function ( WP_REST_Request $req ) {
			$slug = sanitize_key( (string) $req->get_param( 'product' ) );
			$cat  = mv_shop_catalogue();
			if ( ! isset( $cat[ $slug ] ) ) {
				return new WP_Error( 'mv_bad_product', 'Unknown product.', array( 'status' => 400 ) );
			}
			$mode = ( $req->get_param( 'test' ) && current_user_can( 'manage_options' ) ) ? 'test' : 'live';
			if ( ! mv_pay_keys_ready( $mode ) ) {
				return new WP_Error( 'mv_not_ready', 'Checkout is not available right now. Please try again later.', array( 'status' => 503 ) );
			}
			if ( ! mv_pay_rate_ok( 40 ) ) {
				return new WP_Error( 'mv_busy', 'Too many attempts. Please try again later.', array( 'status' => 429 ) );
			}
			$usd = ( 'USD' === strtoupper( (string) $req->get_param( 'cur' ) ) );
			if ( $usd && ( empty( $cat[ $slug ]['usd'] ) || empty( mv_pay_settings()['intl_on'] ) ) ) {
				return new WP_Error( 'mv_no_usd', 'US-dollar checkout is not open yet for this product. Please email support@moneyviel.com and we will help.', array( 'status' => 400 ) );
			}
			$o = mv_pay_api( 'POST', 'orders', $mode, array(
				'amount'   => $usd ? (int) $cat[ $slug ]['usd'] : (int) $cat[ $slug ]['price'],
				'currency' => $usd ? 'USD' : 'INR',
				'receipt'  => 'mv-' . substr( $slug, 0, 20 ) . '-' . time(),
				'notes'    => array( 'mv_product' => $slug, 'site' => 'moneyviel.com' ),
			) );
			if ( ! is_array( $o ) || empty( $o['id'] ) ) {
				return new WP_Error( 'mv_order_failed', 'We could not start the payment. Please try again in a minute.', array( 'status' => 502 ) );
			}
			$s = mv_pay_settings();
			return array( 'order_id' => $o['id'], 'amount' => (int) $o['amount'], 'currency' => $usd ? 'USD' : 'INR', 'key' => $s[ $mode . '_id' ], 'name' => $cat[ $slug ]['name'], 'mode' => $mode );
		},
	) );
	register_rest_route( 'mv-shop/v1', '/verify', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => function ( WP_REST_Request $req ) {
			$order = (string) $req->get_param( 'razorpay_order_id' );
			$pay   = (string) $req->get_param( 'razorpay_payment_id' );
			$sig   = (string) $req->get_param( 'razorpay_signature' );
			$mode  = ( $req->get_param( 'test' ) && current_user_can( 'manage_options' ) ) ? 'test' : 'live';
			$s     = mv_pay_settings();
			if ( ! preg_match( '/^order_[A-Za-z0-9]+$/', $order ) || ! preg_match( '/^pay_[A-Za-z0-9]+$/', $pay ) || ! $s[ $mode . '_secret' ] ) {
				return new WP_Error( 'mv_bad', 'Invalid payment details.', array( 'status' => 400 ) );
			}
			if ( ! hash_equals( hash_hmac( 'sha256', $order . '|' . $pay, $s[ $mode . '_secret' ] ), $sig ) ) {
				return new WP_Error( 'mv_bad_sig', 'We could not verify this payment. If money was taken, email support@moneyviel.com with your payment ID.', array( 'status' => 400 ) );
			}
			$p    = mv_pay_lookup( $pay, $mode );
			// Auto-capture usually completes within seconds of the checkout closing: wait briefly for it.
			for ( $i = 0; $i < 4 && is_array( $p ) && 'authorized' === $p['status']; $i++ ) {
				sleep( 3 );
				delete_transient( 'mv_payl2_' . md5( $pay . $mode ) );
				$p = mv_pay_lookup( $pay, $mode );
			}
			$slug = mv_pay_product_for( $p );
			if ( ! $slug || ( is_array( $p ) && $p['order_id'] !== $order ) ) {
				return new WP_Error( 'mv_unpaid', 'Payment not confirmed yet. Please go to moneyviel.com/my-downloads in a few minutes and enter your payment ID.', array( 'status' => 402 ) );
			}
			mv_pay_count_use( $pay );
			return array( 'ok' => true, 'redirect' => add_query_arg( 'mv_t', mv_pay_token( $pay, $slug ), home_url( '/my-downloads/' ) ) );
		},
	) );
} );

/* Buy buttons: <button class="mv-buy" data-product="slug">. Loads Razorpay Checkout only when clicked. */
add_action( 'wp_footer', function () {
	if ( ! is_page( array( 2373 ) ) ) {
		return;
	}
	$test = ( isset( $_GET['mvtest'] ) && current_user_can( 'manage_options' ) ) ? 1 : 0;
	$st   = mv_pay_settings();
	$usd  = array();
	$phu  = array();
	foreach ( mv_shop_catalogue() as $slug => $prod ) {
		if ( ! empty( $prod['usd'] ) ) {
			$usd[ $slug ] = (int) $prod['usd'];
		}
		if ( ! empty( $st['ph'][ $slug ]['url'] ) ) {
			$phu[ $slug ] = $st['ph'][ $slug ]['url'];
		}
	}
	$cfg = array( 'rest' => esc_url_raw( rest_url( 'mv-shop/v1/' ) ), 'nonce' => is_user_logged_in() ? wp_create_nonce( 'wp_rest' ) : '', 'test' => $test, 'intl' => (int) $st['intl_on'], 'usd' => $usd, 'ph' => $phu );
	?>
<script>
(function(){
var C=<?php echo wp_json_encode( $cfg ); ?>;
function msg(b,t){var p=b.parentNode.querySelector('.mv-buy-msg');if(!p){p=document.createElement('p');p.className='mv-buy-msg';p.style.cssText='margin:6px 0 0;font-size:14px;color:#b4235a;text-align:center';b.parentNode.insertBefore(p,b.nextSibling);}p.textContent=t||'';}
function post(path,data){var h={'Content-Type':'application/json'};if(C.nonce)h['X-WP-Nonce']=C.nonce;return fetch(C.rest+path,{method:'POST',headers:h,credentials:'same-origin',body:JSON.stringify(data)}).then(function(r){return r.json().then(function(j){if(!r.ok)throw new Error(j.message||'Something went wrong.');return j;});});}
var EUUK=/^(Europe\/(London|Dublin|Lisbon|Madrid|Paris|Brussels|Amsterdam|Luxembourg|Berlin|Busingen|Copenhagen|Stockholm|Helsinki|Mariehamn|Tallinn|Riga|Vilnius|Warsaw|Prague|Bratislava|Vienna|Budapest|Ljubljana|Zagreb|Rome|Malta|Athens|Sofia|Bucharest|Nicosia|Belfast|Guernsey|Jersey|Isle_of_Man|Gibraltar)|Asia\/Famagusta|Atlantic\/(Madeira|Canary|Azores)|Africa\/Ceuta)$/;
function tz(){try{return Intl.DateTimeFormat().resolvedOptions().timeZone||''}catch(e){return ''}}
function guess(){var z=tz(),l=(navigator.language||'');if(/Kolkata|Calcutta/.test(z)||/-IN$/i.test(l))return 'in';return EUUK.test(z)?'eu':'row';}
var R='in';try{R=localStorage.getItem('mv_region')||guess()}catch(e){R=guess()}
if(!C.intl)R='in';
function usd(c){return '$'+(c/100).toFixed(2)}
function swap(){if(!C.intl)return;document.querySelectorAll('.mv-buy[data-product]').forEach(function(b){var sl=b.dataset.product,u=C.usd[sl];if(!u)return;var box=b.closest('.bundle,.body')||b.parentNode;
if(!box.dataset.inr){box.dataset.inr=box.innerHTML;}else{box.innerHTML=box.dataset.inr;b=box.querySelector('.mv-buy');}
if(R==='in')return;var single=u===199,map=single?{'₹99':usd(399),'₹49':usd(199)}:(u===399?{'₹297':usd(597),'₹99':usd(399)}:{'₹396':usd(796),'₹149':usd(599)});
var w=document.createTreeWalker(box,NodeFilter.SHOW_TEXT),n,ns=[];while(n=w.nextNode())ns.push(n);ns.forEach(function(t){t.nodeValue=t.nodeValue.replace(/₹\d+/g,function(m){return map[m]||m})});
var note=document.createElement('p');note.className='mv-cur-note';note.style.cssText='margin:6px 0 0;font-size:12.5px;color:#6b7280;text-align:center';note.textContent=R==='eu'?'US dollars. VAT is added at checkout by our reseller Payhip.':'US dollars. Your bank may add a small conversion fee.';box.appendChild(note);});}
function bar(){if(!C.intl||document.getElementById('mv-cur'))return;var h=[].find.call(document.querySelectorAll('h2'),function(e){return /For kids/.test(e.textContent)});if(!h)return;
var d=document.createElement('div');d.id='mv-cur';d.style.cssText='display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin:6px 0 14px;font-size:14px';
d.innerHTML='<span style="align-self:center;color:#4b5563">Prices for:</span><button type="button" data-r="in">🇮🇳 India (₹)</button><button type="button" data-r="row">🌍 Outside India ($)</button><button type="button" data-r="eu">🇪🇺 EU &amp; UK ($ + VAT)</button>';
h.parentNode.insertBefore(d,h.nextSibling);var paint=function(){[].forEach.call(d.querySelectorAll('button'),function(x){var on=x.dataset.r===R;x.style.cssText='border:2px solid '+(on?'#e8457a':'#e5e7eb')+';background:'+(on?'#fde8ef':'#fff')+';color:#1f2937;border-radius:999px;padding:6px 12px;font-weight:700;cursor:pointer'})};paint();
d.addEventListener('click',function(e){var x=e.target.closest('button');if(!x)return;R=x.dataset.r;try{localStorage.setItem('mv_region',R)}catch(_){}paint();swap();vids();});}
var VID={'app-detective':'MtjT0fYmYsQ','app-mart':'fr8um2YEemk','app-pip':'TPoupn2DlSE','app-datenight':'7eGrdgrCCiM'};
function vplay(id){var o=document.createElement('div');o.style.cssText='position:fixed;inset:0;z-index:99999;background:rgba(15,10,40,.88);display:flex;align-items:center;justify-content:center;padding:16px';
o.innerHTML='<div style="position:relative;height:min(86vh,760px);aspect-ratio:9/16;max-width:94vw;border-radius:18px;overflow:hidden;background:#000;box-shadow:0 10px 40px rgba(0,0,0,.5)"><iframe src="https://www.youtube-nocookie.com/embed/'+id+'?autoplay=1&rel=0&playsinline=1" title="App demo video" allow="autoplay; encrypted-media; picture-in-picture; fullscreen" allowfullscreen style="border:0;width:100%;height:100%"></iframe></div><button type="button" aria-label="Close video" style="position:absolute;top:14px;right:14px;width:44px;height:44px;border-radius:50%;border:0;background:#fff;color:#1b1340;font-size:22px;font-weight:700;cursor:pointer">✕</button>';
var close=function(){o.remove();document.removeEventListener('keydown',esc)};var esc=function(e){if(e.key==='Escape')close()};o.addEventListener('click',function(e){if(e.target===o||e.target.closest('button'))close()});document.addEventListener('keydown',esc);document.body.appendChild(o);}
function vids(){Object.keys(VID).forEach(function(sl){var b=document.querySelector('.mv-buy[data-product="'+sl+'"]');if(!b)return;var box=b.closest('.bundle,.body');var card=box&&box.parentElement;if(!card||card.querySelector('.mv-vbtn'))return;var img=card.querySelector('img');
var btn=document.createElement('button');btn.type='button';btn.className='mv-vbtn';btn.innerHTML='▶&nbsp; Watch the 1-minute demo';btn.style.cssText='display:block;width:100%;margin:8px 0 4px;padding:10px 14px;border:0;border-radius:999px;background:#1b1340;color:#fff;font-weight:700;font-size:15px;cursor:pointer';btn.addEventListener('click',function(){vplay(VID[sl])});
box.insertBefore(btn,box.firstChild);
if(img&&!img.dataset.mvv){img.dataset.mvv=1;img.style.cursor='pointer';img.title='Watch the demo';img.addEventListener('click',function(){vplay(VID[sl])});var w=document.createElement('span');w.style.cssText='position:relative;display:block';img.parentNode.insertBefore(w,img);w.appendChild(img);var pl=document.createElement('span');pl.setAttribute('aria-hidden','true');pl.textContent='▶';pl.style.cssText='position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:64px;height:64px;border-radius:50%;background:rgba(232,69,122,.92);color:#fff;font-size:26px;display:flex;align-items:center;justify-content:center;padding-left:5px;box-shadow:0 4px 16px rgba(0,0,0,.3);pointer-events:none';w.appendChild(pl);}});}
function init(){bar();swap();vids();}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
function load(cb){if(window.Razorpay)return cb();var s=document.createElement('script');s.src='https://checkout.razorpay.com/v1/checkout.js';s.onload=function(){cb();};s.onerror=function(){cb(new Error('load'));};document.head.appendChild(s);}
document.addEventListener('click',function(e){var b=e.target.closest('.mv-buy');if(!b)return;e.preventDefault();if(b.dataset.busy)return;
if(C.intl&&R==='eu'){if(C.ph[b.dataset.product]){window.location.href=C.ph[b.dataset.product];}else{msg(b,'Checkout for the EU and UK is opening soon. Please email support@moneyviel.com and we will help you buy.');}return;}b.dataset.busy=1;var label=b.textContent;b.textContent='Opening secure checkout…';msg(b,'');
var done=function(){delete b.dataset.busy;b.textContent=label;};
load(function(err){if(err){done();msg(b,'Could not load the payment window. Please check your connection and try again.');return;}
post('order',{product:b.dataset.product,test:C.test,cur:(C.intl&&R==='row'&&C.usd[b.dataset.product])?'USD':'INR'}).then(function(o){
var rzp=new Razorpay({key:o.key,amount:o.amount,currency:o.currency||'INR',name:'MoneyViel',description:o.name,order_id:o.order_id,theme:{color:'#e8457a'},
handler:function(r){b.textContent='Checking your payment…';post('verify',{razorpay_order_id:r.razorpay_order_id,razorpay_payment_id:r.razorpay_payment_id,razorpay_signature:r.razorpay_signature,test:C.test}).then(function(v){window.location.href=v.redirect;}).catch(function(x){done();msg(b,x.message+' Your payment ID: '+r.razorpay_payment_id);});},
modal:{ondismiss:done}});
rzp.on('payment.failed',function(r){msg(b,'Payment failed: '+((r.error&&r.error.description)||'please try again')+'. No money was taken, or it will be returned automatically by your bank.');});
rzp.open();}).catch(function(x){done();msg(b,x.message);});});});
})();
</script>
	<?php
}, 50 );

/* ---------- Apps: permanent app links (Nov 2026) ----------
 * An app link is moneyviel.com/?mv_app=<app>&p=<payment id>&k=<signature>. The signature proves we issued it after a checked payment,
 * so opening the app needs no Razorpay call. Each payment's link works on up to 5 devices (a long-lived 'mv_appdev' cookie);
 * a 6th device is refused, so a widely shared link stops working. App files are hidden attachments named mvp-app-<file>-<12 hex>.txt
 * (Snippet 8 keeps them private) and are served as HTML only through this check. The logged-in admin can open any app with p=preview.
 */
function mv_shop_apps() {
	return array(
		'pip'       => array( 'name' => "Pip's Money Club", 'file' => 'pips-money-club', 'e' => '🐷' ),
		'detective' => array( 'name' => 'Money Detective', 'file' => 'money-detective', 'e' => '🔍' ),
		'mart'      => array( 'name' => 'MoneyViel Mart', 'file' => 'moneyviel-mart', 'e' => '🛒' ),
		'datenight' => array( 'name' => 'Money Date Night', 'file' => 'money-date-night', 'e' => '💞' ),
	);
}
function mv_app_att( $app ) {
	$apps = mv_shop_apps();
	if ( ! isset( $apps[ $app ] ) ) {
		return 0;
	}
	$ck = 'mv_app_att_' . $app;
	$id = (int) get_transient( $ck );
	if ( $id && get_attached_file( $id ) ) {
		return $id;
	}
	global $wpdb;
	$like = '%' . $wpdb->esc_like( 'mvp-app-' . $apps[ $app ]['file'] . '-' ) . '%.txt';
	$id   = (int) $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s ORDER BY post_id DESC LIMIT 1", $like ) );
	if ( $id ) {
		set_transient( $ck, $id, 10 * MINUTE_IN_SECONDS );
	}
	return $id;
}
function mv_app_sig( $pay_id, $app ) {
	return substr( hash_hmac( 'sha256', $pay_id . '|' . $app, wp_salt( 'auth' ) . 'mv-app' ), 0, 24 );
}
function mv_app_url( $pay_id, $app ) {
	return add_query_arg( array( 'mv_app' => $app, 'p' => $pay_id, 'k' => mv_app_sig( $pay_id, $app ) ), home_url( '/' ) );
}
function mv_app_links_box( $pay_id, $apps ) {
	$all = mv_shop_apps();
	$out = '<div style="background:#fff;border-radius:18px;padding:16px;margin:12px 0;text-align:left">';
	$out .= '<p style="margin:0 0 10px"><b>📱 Your app' . ( count( $apps ) > 1 ? 's' : '' ) . '</b> (tap to open). <b>Save these links now:</b> bookmark them, or open each app and choose <b>Add to Home screen</b> (Android: ⋮ menu; iPhone: Share button). Each link works on up to 5 of your family\'s devices. Lost a link? Enter your payment ID at <a href="https://moneyviel.com/my-downloads/">moneyviel.com/my-downloads</a>.</p>';
	foreach ( $apps as $a ) {
		if ( ! isset( $all[ $a ] ) ) {
			continue;
		}
		$u    = mv_app_url( $pay_id, $a );
		$out .= '<p style="margin:8px 0"><a href="' . esc_url( $u ) . '" target="_blank" rel="noopener" style="display:inline-block;padding:13px 20px;border-radius:999px;font-weight:700;text-decoration:none;color:#fff;background:#16a34a">' . $all[ $a ]['e'] . ' Open ' . esc_html( $all[ $a ]['name'] ) . '</a><br><input readonly onclick="this.select()" value="' . esc_attr( $u ) . '" aria-label="App link" style="width:100%;margin-top:6px;padding:8px 10px;border:1px solid #d1d5db;border-radius:10px;font-size:13px"></p>';
	}
	return $out . '</div>';
}
function mv_app_device_ok( $pay_id ) {
	if ( current_user_can( 'manage_options' ) ) {
		return true;
	}
	$d = isset( $_COOKIE['mv_appdev'] ) ? (string) $_COOKIE['mv_appdev'] : '';
	if ( ! preg_match( '/^[a-f0-9]{32}$/', $d ) ) {
		$d = bin2hex( random_bytes( 16 ) );
		setcookie( 'mv_appdev', $d, array( 'expires' => time() + 5 * YEAR_IN_SECONDS, 'path' => '/', 'secure' => is_ssl(), 'httponly' => true, 'samesite' => 'Lax' ) );
	}
	$h   = substr( md5( $d ), 0, 12 );
	$log = get_option( 'mv_app_devices', array() );
	$log = is_array( $log ) ? $log : array();
	$set = isset( $log[ $pay_id ] ) ? (array) $log[ $pay_id ] : array();
	if ( in_array( $h, $set, true ) ) {
		return true;
	}
	if ( count( $set ) >= 5 ) {
		return false;
	}
	$set[]          = $h;
	$log[ $pay_id ] = $set;
	update_option( 'mv_app_devices', $log, false );
	return true;
}
function mv_app_deny( $msg, $code = 403 ) {
	do_action( 'litespeed_control_set_nocache', 'MoneyViel app' );
	header( 'X-LiteSpeed-Cache-Control: no-cache', true );
	status_header( $code );
	nocache_headers();
	header( 'X-Robots-Tag: noindex, nofollow', true );
	wp_die( esc_html( $msg ) . '<br><br><a href="https://moneyviel.com/shop/">MoneyViel shop</a> · <a href="https://moneyviel.com/my-downloads/">Find my apps with my payment ID</a> · support@moneyviel.com', 'MoneyViel app', array( 'response' => $code ) );
}
add_action( 'init', function () {
	if ( empty( $_GET['mv_app'] ) ) {
		return;
	}
	$app    = sanitize_key( (string) $_GET['mv_app'] );
	$pay_id = (string) ( $_GET['p'] ?? '' );
	$sig    = (string) ( $_GET['k'] ?? '' );
	if ( ! isset( mv_shop_apps()[ $app ] ) ) {
		mv_app_deny( 'This app link is not valid.' );
	}
	$preview = ( 'preview' === $pay_id && current_user_can( 'manage_options' ) );
	if ( ! $preview && ( ! preg_match( '/^(pay_[A-Za-z0-9]{8,30}|phl_[a-f0-9]{20})$/', $pay_id ) || ! hash_equals( mv_app_sig( $pay_id, $app ), $sig ) ) ) {
		mv_app_deny( 'This app link is not valid. Please use the exact link from your purchase.' );
	}
	if ( ! $preview && ! mv_app_device_ok( $pay_id ) ) {
		mv_app_deny( 'This app link has already been opened on 5 devices, which is the limit for one purchase. If this is your family\'s link and you need help, email support@moneyviel.com with your payment ID.' );
	}
	$att  = mv_app_att( $app );
	$file = $att ? get_attached_file( $att ) : '';
	if ( ! $file || ! is_readable( $file ) ) {
		mv_app_deny( 'This app is being updated. Please try again in a few minutes, or email support@moneyviel.com.', 503 );
	}
	while ( ob_get_level() ) {
		ob_end_clean();
	}
	do_action( 'litespeed_control_set_nocache', 'MoneyViel app' );
	header( 'X-LiteSpeed-Cache-Control: no-cache', true );
	header( 'Content-Type: text/html; charset=utf-8' );
	header( 'Cache-Control: private, no-store' );
	header( 'X-Robots-Tag: noindex, nofollow, noarchive', true );
	header( 'Referrer-Policy: no-referrer' );
	header( 'X-Content-Type-Options: nosniff' );
	readfile( $file );
	exit;
}, 1 );
/* Admin: preview links for every app (Settings > MoneyViel Shop). */
add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_options' ) || ( $_GET['page'] ?? '' ) !== 'mv-shop' ) {
		return;
	}
	$out = '<div class="notice notice-info"><p><b>App previews (admin only):</b> ';
	foreach ( mv_shop_apps() as $k => $a ) {
		$out .= '<a target="_blank" href="' . esc_url( add_query_arg( array( 'mv_app' => $k, 'p' => 'preview' ), home_url( '/' ) ) ) . '">' . esc_html( $a['name'] ) . '</a> ' . ( mv_app_att( $k ) ? '✅' : '❌ file missing' ) . ' · ';
	}
	echo $out . '</p></div>';
} );
/* Let the admin upload the app files (HTML saved as mvp-app-<name>-<12 hex>.txt). Nobody else, and no other file names. */
add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {
	if ( current_user_can( 'manage_options' ) && preg_match( '/^mvp-app-[a-z0-9-]+-[0-9a-f]{12}\.txt$/i', (string) $filename ) ) {
		return array( 'ext' => 'txt', 'type' => 'text/plain', 'proper_filename' => false );
	}
	return $data;
}, 10, 4 );
