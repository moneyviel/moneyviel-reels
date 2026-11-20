/**
 * MoneyViel: structured main menu (mega menu for Money Tools, pills for Shop / Subscribe).
 * Menu structure lives in Appearance > Menus (menu 14). Classes used on menu items:
 *   mv-grp (tool group heading), mv-new (NEW badge), mv-all (link to all tools),
 *   mv-shop, mv-sub (highlighted pills), mv-more (More dropdown), mv-hide-desk (shown only in the mobile menu).
 */
add_action( 'wp_head', function () {
	?>
<style>
/* ---------- desktop header menu ---------- */
#header-menu-1 .mv-hide-desk{display:none!important}
#header-menu-1 .menu-item-2080{position:static}
#header-menu-1 .menu-item-2080>.sub-menu{display:grid!important;grid-template-columns:repeat(4,minmax(170px,1fr));gap:6px 18px;width:min(940px,calc(100vw - 40px))!important;left:50%!important;right:auto!important;transform:translateX(-50%)!important;padding:18px 20px 16px!important;border-radius:18px!important;box-shadow:0 18px 50px rgba(27,22,64,.18)!important;background:#fff!important}
#header-menu-1 .menu-item-2080>.sub-menu>li{width:auto!important;display:flex!important;flex-direction:column!important;align-items:stretch!important;justify-content:flex-start!important}
#header-menu-1 .menu-item-2080>.sub-menu>li>a{justify-content:flex-start!important}
#header-menu-1 .menu-item-2080 .mv-grp>a{font-size:12px!important;font-weight:800!important;letter-spacing:.06em;text-transform:uppercase;color:#5B3FD6!important;padding:6px 8px 8px!important;border-bottom:2px solid #F3EFFF;margin-bottom:4px;pointer-events:none}
#header-menu-1 .menu-item-2080 .mv-grp>a .ct-toggle-dropdown-desktop,#header-menu-1 .menu-item-2080 .mv-grp>a .ct-toggle-dropdown-desktop-ghost{display:none!important}
#header-menu-1 .menu-item-2080 .mv-grp>.sub-menu{position:static!important;opacity:1!important;visibility:visible!important;transform:none!important;box-shadow:none!important;background:none!important;padding:0!important;margin:0!important;width:auto!important;min-width:0!important;display:block!important;pointer-events:auto}
#header-menu-1 .menu-item-2080 .mv-grp>.sub-menu>li{display:block!important;width:auto!important}
#header-menu-1 .menu-item-2080 .mv-grp>.sub-menu a{padding:7px 8px!important;border-radius:10px;font-size:14px!important;white-space:nowrap;color:#1B1640!important;display:flex!important;justify-content:flex-start!important}
#header-menu-1 .menu-item-2080 .mv-grp>.sub-menu a:hover{background:#F3EFFF;color:#3B2A7A!important}
#header-menu-1 .mv-new>a:after{content:"NEW";display:inline-block;margin-left:6px;font-size:9.5px;font-weight:900;letter-spacing:.05em;color:#1B1640;background:#FFB020;border-radius:999px;padding:1px 6px;vertical-align:2px}
#header-menu-1 .mv-all>a{font-weight:800!important;color:#E0408F!important}
#header-menu-1 .mv-shop>a{background:#FFF6DD;border-radius:999px;padding:6px 14px!important;margin:0 4px;font-weight:800}
#header-menu-1 .mv-shop>a:hover{background:#FFE8A8}
#header-menu-1 .mv-sub>a{border:1.5px solid #E7DEFF;border-radius:999px;padding:5px 13px!important;margin-left:2px}
#header-menu-1 .mv-sub>a:hover{border-color:#5B3FD6}
/* ---------- mobile menu ---------- */
#offcanvas .mv-grp>a,#mobile-menu .mv-grp>a{font-weight:800;color:#5B3FD6}
#mobile-menu .mv-new>a:after,#offcanvas .mv-new>a:after{content:"NEW";margin-left:6px;font-size:10px;font-weight:900;color:#1B1640;background:#FFB020;border-radius:999px;padding:1px 6px}
/* ---------- home page: swipe rows on phones (cards peek so people see there is more) ---------- */
@media(max-width:680px){
.home .hp-tiles{display:flex!important;grid-template-columns:none!important;overflow-x:auto;scroll-snap-type:x mandatory;gap:12px!important;padding:2px 2px 14px!important;margin-right:-16px!important;-webkit-overflow-scrolling:touch;scrollbar-width:none}
.home .hp-tiles::-webkit-scrollbar{display:none}
.home .hp-tiles>*{flex:0 0 80%!important;scroll-snap-align:start;max-width:80%!important}
.home .hp-tiles+.mv-swipe{display:block}
}
.mv-swipe{display:none;font-size:12.5px;font-weight:700;color:#6B6488;margin:-6px 0 12px}
/* translated pages: longer words, so tighten the menu and hide the Subscribe pill (still in the footer/newsletter boxes) */
html.translated-ltr #header-menu-1 .mv-sub,html.translated-rtl #header-menu-1 .mv-sub{display:none!important}
html.translated-ltr #header-menu-1>ul>li>a,html.translated-rtl #header-menu-1>ul>li>a{font-size:14px!important;padding-left:9px!important;padding-right:9px!important}
/* laptops: if the menu ever runs out of room (long translated words, or narrower screens), it wraps onto 2 neat rows instead of sliding under the 🌐 button */
@media(min-width:1000px){
#header [data-row="middle"]{--height:auto}
#header [data-row="middle"]>.ct-container{height:auto!important;min-height:74px}
#header [data-row="middle"] [data-column="end"]{min-width:0;flex:1 1 auto}
#header [data-row="middle"] [data-column="end"]>[data-items]{min-width:0;flex-wrap:nowrap}
#header-menu-1{flex:1 1 auto;min-width:0;height:auto!important}
#header-menu-1>ul{flex-wrap:wrap;justify-content:flex-end;row-gap:2px;height:auto!important}
#header-menu-1>ul>li>a{height:40px!important;white-space:nowrap}
.mvl-btn{flex:0 0 auto}
html.translated-ltr #header [data-row="middle"]>.ct-container,html.translated-rtl #header [data-row="middle"]>.ct-container{padding-top:6px;padding-bottom:6px}
html.translated-ltr #header-menu-1>ul>li>a,html.translated-rtl #header-menu-1>ul>li>a{font-size:13px!important;padding-left:8px!important;padding-right:8px!important;height:36px!important}}
/* smaller laptops: Subscribe pill hidden in the header (still in the footer and newsletter boxes) */
@media(min-width:1000px) and (max-width:1439px){#header-menu-1 .mv-sub{display:none!important}}
/* go-to-top button: see-through, solid on hover */
.ct-back-to-top{background:rgba(59,42,122,.30)!important;-webkit-backdrop-filter:blur(6px);backdrop-filter:blur(6px);box-shadow:none!important;border:1px solid rgba(255,255,255,.35)}
.ct-back-to-top .ct-icon{fill:#fff!important}
.ct-back-to-top:hover{background:rgba(59,42,122,.92)!important}
</style>
	<?php
}, 30 );

/* "Swipe" hint under each home row on phones */
add_action( 'wp_footer', function () {
	if ( ! is_front_page() ) {
		return;
	}
	echo '<script>(function(){[].forEach.call(document.querySelectorAll(".hp-tiles"),function(t){if(t.children.length<2)return;var h=document.createElement("div");h.className="mv-swipe";h.textContent="Swipe for more \u2192";t.parentNode.insertBefore(h,t.nextSibling)})})();</script>';
}, 52 );
