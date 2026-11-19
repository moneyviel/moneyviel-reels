/**
 * MoneyViel: views & likes makeover (Post Views Counter + WP ULike).
 *
 * - The plugin's plain "Views: N" line is hidden with CSS (kept in the page so counting is untouched).
 * - A post shows its view count only once it has MORE than 10 views:
 *   a small "👀 1.2K views" pill under the title, and the same count in the reaction bar.
 * - The like button becomes a "Was this helpful?" reaction bar at the end of the article,
 *   with "Be the first to find this helpful" at 0, and a gentle WhatsApp / copy-link
 *   share nudge after someone taps it.
 * - Money for Kids posts (category 67) show no views, likes or share nudges at all.
 */
function mv_vl_is_kids( $id ) {
	return has_category( 67, $id );
}
function mv_vl_count( $id ) {
	if ( function_exists( 'pvc_get_post_views' ) ) {
		return (int) pvc_get_post_views( $id );
	}
	return 0;
}

add_action( 'wp_footer', function () {
	if ( ! is_singular( 'post' ) ) {
		return;
	}
	$id   = get_queried_object_id();
	$kids = mv_vl_is_kids( $id );
	$v    = $kids ? 0 : mv_vl_count( $id );
	$link = get_permalink( $id );
	$t    = get_the_title( $id );
	?>
<style>
.single-post .entry-content .post-views{display:none!important}
.mv-react{margin:34px 0 10px;padding:20px 22px;border-radius:20px;background:linear-gradient(135deg,#F3EFFF,#FFF0F7);border:1px solid #E7DEFF;display:flex;flex-wrap:wrap;align-items:center;gap:12px 18px;justify-content:space-between}
.mv-react .q{font-weight:800;font-size:17px;color:#1B1640;margin:0}
.mv-react .q small{display:block;font-weight:600;font-size:13px;color:#6B6488;margin-top:2px}
.mv-react .wpulike{margin:0!important;padding:0!important}
.mv-react .wp_ulike_general_class{display:flex!important;align-items:center;gap:0;background:#fff;border:2px solid #E0408F;border-radius:999px;padding:4px;box-shadow:0 4px 14px rgba(224,64,143,.15);transition:transform .15s}
.mv-react .wp_ulike_general_class:hover{transform:translateY(-1px)}
.mv-react .wp_ulike_btn{width:34px!important;height:34px!important;min-width:34px!important;padding:0!important;border:0!important;background:none!important;box-shadow:none!important;position:relative}
.mv-react .wp_ulike_btn:before{content:"🤍";font-size:20px;line-height:34px;display:block;text-align:center}
.mv-react .wp_ulike_is_liked .wp_ulike_btn:before,.mv-react .wp_ulike_btn_is_active:before{content:"💜";animation:mvpop .45s ease}
.mv-react .wp_ulike_put_image:after{display:none!important}
.mv-react .count-box{display:none!important}
.mv-react .act{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
.mv-react .mv-lbl{font-weight:800;color:#1B1640;font-size:14.5px}
.mv-react .mv-lbl.mv-zero{font-weight:700;font-size:13.5px;color:#6B6488}
.mv-react .vw{font-size:13.5px;font-weight:700;color:#3B2A7A;background:#fff;border-radius:999px;padding:6px 12px}
.mv-react .share{flex-basis:100%;display:none;align-items:center;gap:8px;flex-wrap:wrap;font-size:14px;color:#3B2A7A;font-weight:700}
.mv-react .share.on{display:flex;animation:mvin .4s ease}
.mv-react .share a,.mv-react .share button{border:0;border-radius:999px;padding:7px 14px;font-weight:800;font-size:13px;cursor:pointer;text-decoration:none!important}
.mv-react .share .wa{background:#25D366;color:#fff!important}
.mv-react .share .cp{background:#1B1640;color:#fff}
.mv-reads{display:inline-flex;align-items:center;gap:6px;font-size:12.5px;font-weight:700;color:#3B2A7A;background:#F3EFFF;border-radius:999px;padding:4px 11px;margin-top:10px}
@keyframes mvpop{0%{transform:scale(.6)}60%{transform:scale(1.35)}100%{transform:scale(1)}}
@keyframes mvin{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
<?php if ( $kids ) : ?>.single-post .wpulike,.single-post .post-views{display:none!important}<?php endif; ?>
</style>
	<?php if ( $kids ) { return; } ?>
<script>
(function(){
var V=<?php echo (int) $v; ?>,URL=<?php echo wp_json_encode( $link ); ?>,TITLE=<?php echo wp_json_encode( wp_strip_all_tags( $t ) ); ?>;
function grp(n){var s=String(n);if(s.length>3){var l=s.slice(-3),h=s.slice(0,-3);s=h.replace(/\B(?=(\d{2})+(?!\d))/g,',')+','+l}return s}
function nice(n){if(n>=100000)return (+(n/100000).toFixed(1))+' lakh';if(n>=1000)return (+(n/1000).toFixed(1))+'K';return grp(n)}
var ul=document.querySelector('.entry-content .wpulike');
var show=V>10;
if(show){var meta=document.querySelector('.entry-header .entry-meta, .hero-section .entry-meta');if(meta){var p=document.createElement('div');p.className='mv-reads';p.textContent='👀 '+nice(V)+' views';meta.parentNode.insertBefore(p,meta.nextSibling)}}
if(!ul)return;
var box=document.createElement('div');box.className='mv-react';
box.innerHTML='<p class="q">Was this helpful?<small>Tap the heart. It helps us know what to write next.</small></p><div class="act"></div>'+(show?'<span class="vw">👀 '+nice(V)+' views</span>':'')+'<div class="share">Thank you! 💜 Share it with someone who needs it: <a class="wa" target="_blank" rel="noopener">WhatsApp</a><button type="button" class="cp">Copy link</button></div>';
ul.parentNode.insertBefore(box,ul);var act=box.querySelector('.act');act.appendChild(ul);var lbl=document.createElement('span');lbl.className='mv-lbl';act.appendChild(lbl);
var wa=box.querySelector('.wa');wa.href='https://wa.me/?text='+encodeURIComponent(TITLE+' '+URL);
box.querySelector('.cp').addEventListener('click',function(){var b=this;function ok(){b.textContent='Copied ✓'}if(navigator.clipboard&&navigator.clipboard.writeText){navigator.clipboard.writeText(URL).then(ok,function(){})}});
function upd(){var c=ul.querySelector('.count-box');var n=0;if(c){n=parseInt((c.getAttribute('data-ulike-counter-value')||c.textContent||'0').replace(/[^0-9]/g,''),10)||0}
 lbl.classList.toggle('mv-zero',n===0);lbl.textContent=n===0?'Be the first to find this helpful':grp(n)+(n===1?' person found this helpful':' people found this helpful')}
upd();
var liked=false;
ul.addEventListener('click',function(e){if(e.target.closest('.wp_ulike_btn')){setTimeout(function(){var on=!!ul.querySelector('.wp_ulike_is_liked,.wp_ulike_btn_is_active');var sh=box.querySelector('.share');sh.classList.toggle('on',on);liked=on},700)}});
new MutationObserver(upd).observe(ul,{subtree:true,childList:true,characterData:true,attributes:true,attributeFilter:['data-ulike-counter-value','class']});
})();
</script>
	<?php
}, 50 );
