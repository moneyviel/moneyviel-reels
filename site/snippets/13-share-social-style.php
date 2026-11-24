/**
 * MoneyViel: share box + social icons makeover.
 * - Post share box (Blocksy .ct-share-box): brand card, WhatsApp first as the main button,
 *   phone "Share..." button (native share sheet) and "Copy link", tidy round icons.
 *   Viber and Reddit are hidden (rarely used by our readers). Kids posts keep no share box (Snippet 7).
 * - Header follow icons (.ct-social-box): round icons that light up in each network's colour, with a label on hover.
 */
add_action( 'wp_head', function () {
	?>
<style>
/* ---------- share box ---------- */
.ct-share-box{justify-content:flex-start!important;margin:26px auto 30px!important;padding:20px 22px!important;border-radius:20px;background:#1B1640;color:#fff;display:flex!important;flex-wrap:wrap;align-items:center;gap:12px 16px;box-shadow:0 10px 30px rgba(27,22,64,.18)}
.ct-share-box .ct-module-title{display:block!important;text-align:left!important;flex-basis:100%;font-size:17px!important;font-weight:800!important;letter-spacing:0!important;text-transform:none!important;color:#fff!important;margin:0!important;width:100%!important;max-width:none!important;padding:0!important}
.ct-share-box .ct-module-title small{display:block;font-size:13px;font-weight:600;color:#bdb3f0;margin-top:2px}
.ct-share-box>div[data-icons-type]{display:flex!important;flex-wrap:wrap;gap:7px!important;width:100%;align-items:center}
.ct-share-box a[data-network]{width:38px!important;height:38px!important;border-radius:50%!important;background:rgba(255,255,255,.1)!important;display:inline-flex!important;align-items:center;justify-content:center;transition:transform .15s,background .15s}
.ct-share-box a[data-network] .ct-icon-container{background:transparent!important;width:auto!important;height:auto!important;border-radius:0!important;padding:0!important;box-shadow:none!important}
.ct-share-box a[data-network]{overflow:hidden;margin:0!important}
.ct-share-box a[data-network] svg{fill:#fff!important;width:17px!important;height:17px!important}
.ct-share-box a[data-network]:hover{transform:translateY(-2px);background:var(--official-color)!important}
.ct-share-box a[data-network="viber"],.ct-share-box a[data-network="reddit"]{display:none!important}
.ct-share-box a[data-network="whatsapp"]{order:-2;width:auto!important;border-radius:999px!important;padding:0 18px 0 14px!important;background:#25D366!important;gap:8px;font-weight:800;font-size:14px;color:#fff!important;text-decoration:none!important;height:38px!important}
.ct-share-box a[data-network="whatsapp"]:after{content:"Share on WhatsApp"}
.ct-share-box .mv-sh{order:-1;height:38px;border:0;border-radius:999px;padding:0 16px;font-weight:800;font-size:14px;cursor:pointer;background:#FFB020;color:#1B1640;display:inline-flex;align-items:center;gap:6px}
.ct-share-box .mv-sh.cp{background:#fff;color:#1B1640}
/* ---------- header follow icons ---------- */
.ct-social-box{gap:6px!important}
.ct-social-box a{position:relative;width:30px;height:30px;border-radius:50%;display:inline-flex!important;align-items:center;justify-content:center;background:rgba(255,255,255,.08);transition:background .15s,transform .15s}
.ct-social-box a:hover{transform:translateY(-1px)}
.ct-social-box a[data-network="youtube"]:hover{background:#FF0000}
.ct-social-box a[data-network="facebook"]:hover{background:#1877F2}
.ct-social-box a[data-network="instagram"]:hover{background:radial-gradient(circle at 30% 110%,#fdf497 0%,#fd5949 45%,#d6249f 60%,#285AEB 90%)}
.ct-social-box a[data-network="threads"]:hover,.ct-social-box a[data-network="twitter"]:hover{background:#000}
.ct-social-box a[data-network="linkedin"]:hover{background:#0A66C2}
.ct-social-box a[data-network="pinterest"]:hover{background:#E60023}
.ct-social-box a:hover svg{fill:#fff!important}
.ct-social-box a:after{content:attr(aria-label);position:absolute;top:calc(100% + 6px);left:50%;transform:translateX(-50%);background:#1B1640;color:#fff;font-size:11px;font-weight:700;padding:3px 8px;border-radius:6px;white-space:nowrap;opacity:0;pointer-events:none;transition:opacity .15s;z-index:50}
.ct-social-box a:hover:after{opacity:1}
</style>
	<?php
}, 31 );

add_action( 'wp_footer', function () {
	if ( ! is_singular( 'post' ) || has_category( 67, get_queried_object_id() ) ) {
		return;
	}
	?>
<script>
(function(){
var box=document.querySelector('.ct-share-box');if(!box)return;
var t=box.querySelector('.ct-module-title');if(t)t.innerHTML='Found this useful? Pass it on 💜<small>Share it with a friend or family member who would find it helpful.</small>';
var row=box.querySelector('div[data-icons-type]');if(!row)return;
var url=location.href.split('#')[0].split('?')[0],title=document.title;
if(navigator.share){var s=document.createElement('button');s.type='button';s.className='mv-sh';s.textContent='📤 Share…';s.addEventListener('click',function(){navigator.share({title:title,url:url}).catch(function(){})});row.appendChild(s)}
var c=document.createElement('button');c.type='button';c.className='mv-sh cp';c.textContent='🔗 Copy link';c.addEventListener('click',function(){if(navigator.clipboard&&navigator.clipboard.writeText){navigator.clipboard.writeText(url).then(function(){c.textContent='✓ Link copied'},function(){})}});row.appendChild(c);
})();
</script>
	<?php
}, 51 );
