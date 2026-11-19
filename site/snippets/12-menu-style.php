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
</style>
	<?php
}, 30 );
