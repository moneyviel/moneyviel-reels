/**
 * MoneyViel: check each purchase with Razorpay before showing downloads.
 *
 * - Download pages only show the files after Razorpay confirms a real, captured
 *   payment of the right amount (payment ID from the redirect, or typed in by the buyer).
 * - Files are served through short-lived signed links, so the real file addresses
 *   are never shown.
 * - API keys are pasted by the owner in Settings > MoneyViel Shop (never stored in code).
 */

function mv_pay_products() {
	// Download page ID => product.
	return array(
		2361 => array( 'name' => 'Money Club Starter Kit', 'amount' => 14900, 'files' => array( 'a4' => 2357, 'letter' => 2358 ) ),
		2362 => array( 'name' => '30-Day Saving Challenge', 'amount' => 9900, 'files' => array( 'a4' => 2355, 'letter' => 2356 ) ),
	);
}
function mv_pay_settings() {
	$s = get_option( 'mv_shop_keys', array() );
	return wp_parse_args( is_array( $s ) ? $s : array(), array( 'live_id' => '', 'live_secret' => '', 'test_id' => '', 'test_secret' => '', 'allow_test' => 0 ) );
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
	echo '</table><p><button class="button button-primary" name="mv_shop_save" value="1">Save</button> <button class="button" name="mv_shop_test" value="1">Check keys</button></p></form></div>';
}

/* ---------- Payment check ---------- */
function mv_pay_fetch( $pay_id, $mode ) {
	$s = mv_pay_settings();
	if ( ! $s[ $mode . '_id' ] || ! $s[ $mode . '_secret' ] ) {
		return null;
	}
	$r = wp_remote_get( 'https://api.razorpay.com/v1/payments/' . rawurlencode( $pay_id ), array(
		'timeout' => 15,
		'headers' => array( 'Authorization' => 'Basic ' . base64_encode( $s[ $mode . '_id' ] . ':' . $s[ $mode . '_secret' ] ) ),
	) );
	if ( is_wp_error( $r ) ) {
		return 'error';
	}
	$code = wp_remote_retrieve_response_code( $r );
	if ( 200 !== $code ) {
		return ( $code >= 500 ) ? 'error' : null;
	}
	$j = json_decode( wp_remote_retrieve_body( $r ), true );
	return is_array( $j ) ? $j : 'error';
}
/** Returns 'ok', 'bad', 'limit' or 'error'. */
function mv_pay_verify( $pay_id, $product ) {
	if ( ! preg_match( '/^pay_[A-Za-z0-9]{8,30}$/', $pay_id ) ) {
		return 'bad';
	}
	$cache_key = 'mv_pay_' . md5( $pay_id . '|' . $product['amount'] );
	$cached    = get_transient( $cache_key );
	if ( false !== $cached ) {
		$status = $cached;
	} else {
		$s      = mv_pay_settings();
		$status = 'bad';
		$modes  = array( 'live' );
		if ( $s['allow_test'] ) {
			$modes[] = 'test';
		}
		foreach ( $modes as $mode ) {
			$p = mv_pay_fetch( $pay_id, $mode );
			if ( 'error' === $p ) {
				$status = 'error';
				continue;
			}
			if ( is_array( $p ) ) {
				$status = ( isset( $p['status'], $p['amount'], $p['currency'] )
					&& 'captured' === $p['status']
					&& (int) $p['amount'] === (int) $product['amount']
					&& 'INR' === $p['currency'] ) ? 'ok' : 'bad';
				break;
			}
		}
		if ( 'error' !== $status ) {
			set_transient( $cache_key, $status, 10 * MINUTE_IN_SECONDS );
		}
	}
	if ( 'ok' !== $status ) {
		return $status;
	}
	// A payment unlocks the files for 30 days, up to 15 visits.
	$log = get_option( 'mv_shop_unlocks', array() );
	$log = is_array( $log ) ? $log : array();
	$now = time();
	if ( empty( $log[ $pay_id ] ) ) {
		$log[ $pay_id ] = array( 'first' => $now, 'count' => 0 );
	}
	if ( $now - (int) $log[ $pay_id ]['first'] > 30 * DAY_IN_SECONDS || (int) $log[ $pay_id ]['count'] >= 15 ) {
		return 'limit';
	}
	$log[ $pay_id ]['count']++;
	foreach ( $log as $k => $v ) { // Forget entries older than 60 days.
		if ( $now - (int) $v['first'] > 60 * DAY_IN_SECONDS ) {
			unset( $log[ $k ] );
		}
	}
	update_option( 'mv_shop_unlocks', $log, false );
	return 'ok';
}
function mv_pay_rate_ok() {
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? md5( (string) $_SERVER['REMOTE_ADDR'] ) : 'x';
	$key = 'mv_pay_rl_' . $ip;
	$n   = (int) get_transient( $key );
	if ( $n >= 20 ) {
		return false;
	}
	set_transient( $key, $n + 1, HOUR_IN_SECONDS );
	return true;
}

/* ---------- Signed download links ---------- */
function mv_pay_sign( $att, $exp ) {
	return hash_hmac( 'sha256', $att . '|' . $exp, wp_salt( 'auth' ) . 'mv-shop' );
}
function mv_pay_link( $att ) {
	$exp = time() + DAY_IN_SECONDS;
	return add_query_arg( array( 'mv_dl' => (int) $att, 'e' => $exp, 's' => mv_pay_sign( (int) $att, $exp ) ), home_url( '/' ) );
}
add_action( 'init', function () {
	if ( empty( $_GET['mv_dl'] ) ) {
		return;
	}
	$att = (int) $_GET['mv_dl'];
	$exp = (int) ( $_GET['e'] ?? 0 );
	$sig = (string) ( $_GET['s'] ?? '' );
	$ok  = false;
	foreach ( mv_pay_products() as $p ) {
		if ( in_array( $att, $p['files'], true ) ) {
			$ok = true;
		}
	}
	if ( ! $ok || $exp < time() || ! hash_equals( mv_pay_sign( $att, $exp ), $sig ) ) {
		status_header( 403 );
		nocache_headers();
		wp_die( 'This download link has expired or is not valid. Please go back to your download page, or email support@moneyviel.com with your Razorpay payment ID.', 'Download link expired', array( 'response' => 403 ) );
	}
	$file = get_attached_file( $att );
	if ( ! $file || ! is_readable( $file ) ) {
		status_header( 404 );
		exit;
	}
	$name = preg_replace( '/-[0-9a-f]{12}(?=\.pdf$)/i', '', basename( $file ) );
	$name = 'moneyviel-kids-' . $name;
	nocache_headers();
	header( 'X-Robots-Tag: noindex, nofollow', true );
	header( 'Content-Type: application/pdf' );
	header( 'Content-Disposition: attachment; filename="' . $name . '"' );
	header( 'Content-Length: ' . filesize( $file ) );
	while ( ob_get_level() ) {
		ob_end_clean();
	}
	readfile( $file );
	exit;
}, 1 );

/* ---------- Download page content ---------- */
add_filter( 'the_content', function ( $content ) {
	if ( ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$id       = get_the_ID();
	$products = mv_pay_products();
	if ( ! isset( $products[ $id ] ) ) {
		return $content;
	}
	$product = $products[ $id ];
	$admin   = current_user_can( 'edit_pages' );
	$pay_id  = '';
	if ( isset( $_POST['mv_pay_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_POST['mv_pay_id'] ) ) );
	} elseif ( isset( $_GET['razorpay_payment_id'] ) ) {
		$pay_id = trim( sanitize_text_field( wp_unslash( $_GET['razorpay_payment_id'] ) ) );
	}
	$state = '';
	if ( $admin && '' === $pay_id ) {
		$state = 'ok';
	} elseif ( '' !== $pay_id ) {
		$state = mv_pay_rate_ok() ? mv_pay_verify( $pay_id, $product ) : 'busy';
	}
	if ( 'ok' === $state ) {
		$content = str_replace(
			array( '#mv-a4', '#mv-letter' ),
			array( esc_url( mv_pay_link( $product['files']['a4'] ) ), esc_url( mv_pay_link( $product['files']['letter'] ) ) ),
			$content
		);
		if ( $admin && '' === $pay_id ) {
			$content = '<p style="background:#fff3cd;padding:10px 14px;border-radius:10px;font-size:14px">Admin preview: you see the files because you are logged in. Buyers see them only after their payment is checked.</p>' . $content;
		}
		return $content;
	}
	$msgs = array(
		''      => '',
		'bad'   => 'We could not find a successful payment for this product with that payment ID. Please check the ID in your Razorpay receipt email (it starts with "pay_").',
		'limit' => 'This payment ID has already been used many times or is more than 30 days old. Please email support@moneyviel.com and we will help.',
		'error' => 'We could not reach our payment provider just now. Please try again in a minute.',
		'busy'  => 'Too many attempts. Please wait an hour or email support@moneyviel.com.',
	);
	$msg = $msgs[ $state ] ?? '';
	$out  = '<div class="mv-dl" style="max-width:640px;margin:0 auto;font-size:17px;line-height:1.6;color:#1f2937">';
	$out .= '<h1 style="text-align:center;font-size:1.8em;line-height:1.25">🔒 Your ' . esc_html( $product['name'] ) . ' download</h1>';
	if ( $msg ) {
		$out .= '<p style="background:#fde8ef;border-radius:12px;padding:12px 16px">' . esc_html( $msg ) . '</p>';
	}
	$out .= '<p>Thank you for your purchase! To open your download page, please enter the <strong>payment ID</strong> from your Razorpay receipt email or payment screen. It starts with <strong>pay_</strong>.</p>';
	$out .= '<form method="post" action="' . esc_url( get_permalink( $id ) ) . '" style="display:flex;flex-wrap:wrap;gap:10px;margin:14px 0">';
	$out .= '<input type="text" name="mv_pay_id" required pattern="pay_[A-Za-z0-9]+" placeholder="pay_XXXXXXXXXXXXXX" autocomplete="off" style="flex:1;min-width:220px;padding:12px 14px;border:1px solid #d1d5db;border-radius:999px;font-size:16px">';
	$out .= '<button type="submit" style="padding:12px 22px;border:0;border-radius:999px;background:#e8457a;color:#fff;font-weight:700;font-size:16px;cursor:pointer">Show my files</button></form>';
	$out .= '<p style="font-size:.9em;color:#4b5563">Haven\'t bought this yet? Visit our <a href="https://moneyviel.com/shop/">shop</a>. Need help? Email <a href="mailto:support@moneyviel.com">support@moneyviel.com</a> with your payment ID.</p></div>';
	return $out;
}, 20 );
