<?php
/**
 * MoneyViel: Quora image bridge (Code Snippet 16, added 2026-11-24).
 *
 * Lets the autopilot put an article's own featured image into a post in the
 * MoneyViel Quora Space. Quora drops images that are only linked from another
 * site, so the image has to be handed to Quora's editor as a real file.
 *
 * How: a Quora tab opens  https://moneyviel.com/?mv_img_bridge=1&src=/wp-content/uploads/...jpg
 * as a popup. This page fetches that one image (same site) and sends it to the
 * Quora tab that opened it with postMessage, then closes itself.
 *
 * Safety: only images under /wp-content/uploads/ on this site, only to Quora
 * pages, nothing is stored, no login needed, no data collected.
 */
add_action( 'template_redirect', function () {
	if ( empty( $_GET['mv_img_bridge'] ) ) {
		return;
	}
	nocache_headers();
	header( 'Content-Type: text/html; charset=utf-8' );
	header( 'X-Robots-Tag: noindex, nofollow' );
	?><!DOCTYPE html><html><head><meta charset="utf-8"><meta name="robots" content="noindex,nofollow"><title>MoneyViel image</title></head>
<body style="font:16px system-ui;padding:24px;color:#1b1340">Sending the image to Quora…
<script>
(function () {
  var q = new URLSearchParams(location.search), src = q.get('src') || '';
  var ok = /^\/wp-content\/uploads\/[\w\/.\-]+\.(jpe?g|png|webp)$/i.test(src);
  var targets = ['https://moneyviel.quora.com', 'https://www.quora.com'];
  function say(m) { document.body.textContent = m; }
  if (!ok) { say('Not allowed.'); return; }
  if (!window.opener) { say('Open this from Quora.'); return; }
  fetch(src, { credentials: 'omit' }).then(function (r) { if (!r.ok) throw 0; return r.blob(); }).then(function (b) {
    var name = src.split('/').pop();
    targets.forEach(function (t) { try { window.opener.postMessage({ mvImg: 1, name: name, blob: b }, t); } catch (e) {} });
    say('Done. You can close this tab.');
    setTimeout(function () { window.close(); }, 1200);
  }).catch(function () { say('Could not load the image.'); });
})();
</script></body></html><?php
	exit;
} );
