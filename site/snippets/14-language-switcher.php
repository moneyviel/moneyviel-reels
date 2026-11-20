/**
 * MoneyViel: easy language switcher (works with the GTranslate plugin: doGTranslate('en|xx'), cookie googtrans=/en/xx).
 * GTranslate keeps the chosen language in localStorage __GT_TRANSLATE_LANGS {srcLang,tgtLang}; we set it and reload.
 * - Computer: small "EN | हिं" switch in the header, next to Search.
 * - Phone: small round "अ/A" button at the bottom-left (opposite the back-to-top arrow).
 * - Phone menu: "English | हिंदी | More languages" row at the top of the menu panel.
 * - One-time friendly question for visitors whose phone/browser language is Indian (remembered).
 * - Slim "machine-translated" note when the page is shown in another language, with a "Show in English" link.
 * Our own tools with real Hindi (Money Words) switch to their own Hindi automatically.
 */
add_action( 'wp_footer', function () {
	if ( is_admin() ) {
		return;
	}
	?>
<style>
.mvl-sw{display:inline-flex;align-items:center;background:#F3EFFF;border-radius:999px;padding:3px;margin:0 8px 0 4px;font-weight:800;font-size:12.5px;line-height:1;vertical-align:middle}
.mvl-sw button{border:0;background:none;color:#3B2A7A;border-radius:999px;padding:6px 10px;cursor:pointer;font:inherit}
.mvl-sw button.on{background:#3B2A7A;color:#fff;box-shadow:0 2px 6px rgba(59,42,122,.25)}
.mvl-fab{position:fixed;left:14px;bottom:18px;z-index:9990;width:44px;height:44px;border-radius:50%;border:0;background:#fff;color:#3B2A7A;font-weight:900;font-size:13px;box-shadow:0 6px 18px rgba(27,22,64,.22);display:none;align-items:center;justify-content:center;cursor:pointer;line-height:1}
.mvl-fab span{display:block;font-size:10px;color:#E0408F;margin-top:1px}
.mvl-fab:active{transform:scale(.94)}
.mvl-row{display:flex;gap:6px;align-items:center;flex-wrap:wrap;margin:0 0 14px;padding:0 0 12px;border-bottom:1px solid rgba(0,0,0,.08)}
.mvl-row button{border:1.5px solid #E7DEFF;background:#fff;color:#3B2A7A;border-radius:999px;padding:7px 14px;font-weight:800;font-size:14px;cursor:pointer}
.mvl-row button.on{background:#3B2A7A;border-color:#3B2A7A;color:#fff}
.mvl-row select{border:1.5px solid #E7DEFF;border-radius:999px;padding:7px 10px;font-size:13.5px;font-weight:700;color:#3B2A7A;background:#fff;max-width:160px}
.mvl-ask{position:fixed;left:14px;right:14px;bottom:76px;z-index:9991;max-width:380px;margin:0 auto;background:#1B1640;color:#fff;border-radius:18px;padding:16px 16px 14px;box-shadow:0 14px 40px rgba(27,22,64,.35);font-size:15px;animation:mvlup .35s ease}
.mvl-ask b{display:block;font-size:16.5px;margin-bottom:10px}
.mvl-ask button{border:0;border-radius:999px;padding:9px 16px;font-weight:800;font-size:14px;cursor:pointer;margin:0 6px 6px 0}
.mvl-ask .y{background:#FFB020;color:#1B1640}.mvl-ask .n{background:rgba(255,255,255,.12);color:#fff}
.mvl-note{background:#FFF6DD;color:#3B2A7A;font-size:13px;font-weight:600;text-align:center;padding:8px 36px 8px 12px;position:relative;border-radius:12px;margin:0 auto 16px;max-width:1100px}
.mvl-note a{color:#E0408F;font-weight:800;margin-left:6px;cursor:pointer;text-decoration:underline}
.mvl-note .x{position:absolute;right:8px;top:50%;transform:translateY(-50%);border:0;background:none;font-size:16px;color:#6B6488;cursor:pointer}
@keyframes mvlup{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
@media(max-width:999px){.mvl-fab{display:flex;flex-direction:column}.mvl-sw{display:none}}
</style>
<script>
(function(){
var NAMES={en:'English',hi:'हिंदी',mr:'मराठी',bn:'বাংলা',ta:'தமிழ்',te:'తెలుగు',gu:'ગુજરાતી',kn:'ಕನ್ನಡ',ml:'മലയാളം',pa:'ਪੰਜਾਬੀ',ur:'اردو',ne:'नेपाली',sd:'سنڌي',ar:'العربية',de:'Deutsch',es:'Español',fr:'Français',it:'Italiano',ja:'日本語','zh-CN':'中文',ru:'Русский',pt:'Português',id:'Bahasa Indonesia',ms:'Bahasa Melayu',th:'ไทย',tr:'Türkçe',uk:'Українська',nl:'Nederlands',fi:'Suomi',no:'Norsk',ga:'Gaeilge',my:'မြန်မာ'};
var INDIAN=['hi','mr','bn','ta','te','gu','kn','ml','pa','ur'];
var ASK={hi:'हिंदी में पढ़ना चाहेंगे?',mr:'मराठीत वाचायचे आहे का?',bn:'বাংলায় পড়তে চান?',ta:'தமிழில் படிக்க விரும்புகிறீர்களா?',te:'తెలుగులో చదవాలనుకుంటున్నారా?',gu:'ગુજરાતીમાં વાંચવું છે?',kn:'ಕನ್ನಡದಲ್ಲಿ ಓದಲು ಬಯಸುವಿರಾ?',ml:'മലയാളത്തിൽ വായിക്കണോ?',pa:'ਕੀ ਪੰਜਾਬੀ ਵਿੱਚ ਪੜ੍ਹਨਾ ਚਾਹੋਗੇ?',ur:'کیا آپ اردو میں پڑھنا چاہیں گے؟'};
function cur(){try{var o=JSON.parse(localStorage.getItem('__GT_TRANSLATE_LANGS')||'{}');return o.tgtLang||'en'}catch(e){return 'en'}}
function store(k,v){try{localStorage.setItem(k,v)}catch(e){}}
function read(k){try{return localStorage.getItem(k)}catch(e){return null}}
function go(l){store('mvLang',l);try{if(l==='en')localStorage.removeItem('__GT_TRANSLATE_LANGS');else localStorage.setItem('__GT_TRANSLATE_LANGS',JSON.stringify({srcLang:'en',tgtLang:l}))}catch(e){}location.reload()}
function paint(){var c=cur();[].forEach.call(document.querySelectorAll('[data-mvl]'),function(b){b.classList.toggle('on',b.getAttribute('data-mvl')===c||(b.getAttribute('data-mvl')==='hi'&&c==='hi'))});var f=document.querySelector('.mvl-fab');if(f){f.innerHTML=c==='en'?'अ<span>हिंदी</span>':'A<span>English</span>';f.setAttribute('aria-label',c==='en'?'हिंदी में पढ़ें':'Read in English')}
 var s=document.querySelector('.mvl-row select');if(s)s.value=(c==='en'||c==='hi')?'':c;note()}
function nt(el){el.classList.add('notranslate');el.setAttribute('translate','no');return el}
/* header switch (computer) */
var srch=document.querySelector('header [data-id="search"], header .ct-header-search');
if(srch){var sw=nt(document.createElement('div'));sw.className='mvl-sw';sw.setAttribute('role','group');sw.setAttribute('aria-label','Language');sw.innerHTML='<button type="button" data-mvl="en" title="English">EN</button><button type="button" data-mvl="hi" title="हिंदी">हिं</button>';srch.parentNode.insertBefore(sw,srch);
 sw.addEventListener('click',function(e){var b=e.target.closest('[data-mvl]');if(b&&b.getAttribute('data-mvl')!==cur())go(b.getAttribute('data-mvl'))})}
/* floating button (phone) */
var fab=nt(document.createElement('button'));fab.type='button';fab.className='mvl-fab';document.body.appendChild(fab);
fab.addEventListener('click',function(){go(cur()==='en'?'hi':'en')});
/* phone menu row */
function addRow(){var mm=document.querySelector('#offcanvas .mobile-menu');if(!mm||document.querySelector('#offcanvas .mvl-row'))return;var r=nt(document.createElement('div'));r.className='mvl-row';
 var opts='<option value="">More languages…</option>';Object.keys(NAMES).forEach(function(k){if(k!=='en'&&k!=='hi')opts+='<option value="'+k+'">'+NAMES[k]+'</option>'});
 r.innerHTML='<button type="button" data-mvl="en">English</button><button type="button" data-mvl="hi">हिंदी</button><select aria-label="More languages">'+opts+'</select>';mm.parentNode.insertBefore(r,mm);
 r.addEventListener('click',function(e){var b=e.target.closest('[data-mvl]');if(b&&b.getAttribute('data-mvl')!==cur())go(b.getAttribute('data-mvl'))});
 r.querySelector('select').addEventListener('change',function(){if(this.value)go(this.value)});paint()}
addRow();document.addEventListener('click',function(e){if(e.target.closest('[data-toggle-panel],.ct-header-trigger'))setTimeout(addRow,50)});
/* machine-translated note */
function note(){var c=cur(),n=document.querySelector('.mvl-note');if(c==='en'||sessionStorage.getItem('mvlNoteX')){if(n)n.remove();return}
 if(n)return;n=document.createElement('div');n.className='mvl-note';n.innerHTML='This page is machine-translated, so a few money words may not be exact.<a class="notranslate" translate="no">Show in English</a><button type="button" class="x notranslate" aria-label="Close">×</button>';
 var mn=document.querySelector('main#main .entry-content')||document.querySelector('main#main article')||document.querySelector('main#main');if(mn)mn.insertBefore(n,mn.firstChild);else document.body.insertBefore(n,document.body.firstChild);
 n.querySelector('a').addEventListener('click',function(){go('en')});n.querySelector('.x').addEventListener('click',function(){try{sessionStorage.setItem('mvlNoteX','1')}catch(e){}n.remove()})}
/* one-time question */
function ask(){if(read('mvLangAsked')||read('mvLang')||cur()!=='en')return;var langs=(navigator.languages||[navigator.language||'']).map(function(x){return String(x).toLowerCase().split('-')[0]});var l=null;for(var i=0;i<langs.length;i++){if(langs[i]==='en')break;if(INDIAN.indexOf(langs[i])>-1){l=langs[i];break}}if(!l)return;
 var a=nt(document.createElement('div'));a.className='mvl-ask';a.innerHTML='<b>'+ASK[l]+'</b><button type="button" class="y">'+NAMES[l]+'</button><button type="button" class="n">Continue in English</button>';document.body.appendChild(a);
 a.querySelector('.y').addEventListener('click',function(){store('mvLangAsked','1');a.remove();go(l)});a.querySelector('.n').addEventListener('click',function(){store('mvLangAsked','1');store('mvLang','en');a.remove()})}
paint();setTimeout(ask,2500);
})();
</script>
	<?php
}, 60 );
