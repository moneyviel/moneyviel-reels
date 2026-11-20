/**
 * MoneyViel: one language button for every language (works with the GTranslate plugin).
 * GTranslate keeps the chosen language in localStorage __GT_TRANSLATE_LANGS {srcLang,tgtLang}; we set it and reload.
 * - Computer: small "🌐 EN" pill in the header, next to Search.  Phone: small round 🌐 button bottom-left.
 * - Both open one panel: search, "Suggested for you", Indian & South Asian languages, World languages.
 *   Native names first, English names underneath, ✓ on the current one, no flags (flags are countries, not languages).
 * - Phone menu: "🌐 Language: <current>" row that opens the same panel.
 * - The old GTranslate drop-down in the top strip is hidden (its script still does the translating).
 * - One-time friendly question for visitors whose browser language is Indian; "machine-translated" note with "Show in English".
 * Our own tools with real Hindi (Money Words) switch to their own Hindi automatically.
 */
add_action( 'wp_footer', function () {
	if ( is_admin() ) {
		return;
	}
	?>
<style>
.gtranslate_wrapper,.gt_switcher_wrapper,[id^="gt-wrapper-"]{display:none!important}
.mvl-btn{display:inline-flex;align-items:center;gap:6px;border:1.5px solid #E7DEFF;background:#fff;color:#3B2A7A;border-radius:999px;padding:6px 12px 6px 9px;font-weight:800;font-size:13px;line-height:1;cursor:pointer;margin:0 8px 0 4px;vertical-align:middle;transition:border-color .15s,box-shadow .15s}
.mvl-btn:hover{border-color:#5B3FD6;box-shadow:0 3px 10px rgba(91,63,214,.15)}
.mvl-btn .g{font-size:15px}
.mvl-btn .c{min-width:18px;text-align:center}
.mvl-fab{position:fixed;left:14px;bottom:18px;z-index:9990;width:46px;height:46px;border-radius:50%;border:0;background:#fff;color:#3B2A7A;font-weight:900;box-shadow:0 6px 18px rgba(27,22,64,.22);display:none;flex-direction:column;align-items:center;justify-content:center;cursor:pointer;line-height:1;padding:0}
.mvl-fab .g{font-size:18px}.mvl-fab .c{font-size:9.5px;color:#E0408F;margin-top:2px;max-width:40px;overflow:hidden;white-space:nowrap}
.mvl-fab:active{transform:scale(.94)}
.mvl-row{display:flex;align-items:center;justify-content:space-between;width:100%;margin:0 0 14px;padding:10px 14px;border:1.5px solid rgba(255,255,255,.18);border-radius:14px;background:rgba(255,255,255,.06);color:inherit;font-weight:800;font-size:15px;cursor:pointer;text-align:left}
.mvl-row small{opacity:.75;font-weight:700}
.mvl-ov{position:fixed;inset:0;z-index:99998;background:rgba(27,22,64,.45);display:flex;align-items:flex-start;justify-content:center;padding:84px 14px 14px;animation:mvlfade .2s ease}
.mvl-pn{width:min(560px,100%);max-height:calc(100vh - 110px);display:flex;flex-direction:column;background:#fff;border-radius:22px;box-shadow:0 24px 60px rgba(27,22,64,.35);overflow:hidden;color:#1B1640;animation:mvlpop .22s ease}
.mvl-hd{display:flex;align-items:center;justify-content:space-between;padding:18px 20px 6px}
.mvl-hd b{font-size:19px}
.mvl-hd button{border:0;background:#F3EFFF;color:#3B2A7A;width:34px;height:34px;border-radius:50%;font-size:18px;cursor:pointer}
.mvl-sr{margin:6px 20px 8px;position:relative}
.mvl-sr input{width:100%;border:1.5px solid #E7DEFF;border-radius:999px;padding:10px 14px 10px 38px;font-size:15px;outline:none;color:#1B1640;background:#fff}
.mvl-sr input:focus{border-color:#5B3FD6}
.mvl-sr span{position:absolute;left:14px;top:50%;transform:translateY(-50%);font-size:15px;opacity:.6}
.mvl-bd{overflow:auto;padding:4px 20px 18px}
.mvl-gh{font-size:11.5px;font-weight:900;letter-spacing:.07em;text-transform:uppercase;color:#5B3FD6;margin:12px 0 6px}
.mvl-gr{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:6px;align-items:start}
.mvl-l>span{min-width:0}.mvl-l b{white-space:nowrap}.mvl-l small{white-space:nowrap}
.mvl-l{display:flex;align-items:center;justify-content:space-between;gap:6px;border:1.5px solid #EEE9FF;background:#fff;border-radius:11px;padding:6px 10px;cursor:pointer;text-align:left;color:#1B1640;transition:border-color .12s,background .12s}
.mvl-l:hover{border-color:#5B3FD6;background:#FAF8FF}
.mvl-l b{display:inline;font-size:15.5px;font-weight:800;line-height:1.3}
.mvl-l i{font-style:normal;color:#C9BFF5;font-weight:700;margin:0 5px}
.mvl-l small{display:inline;font-size:12px;color:#6B6488;font-weight:600}
.mvl-l.on{border-color:#3B2A7A;background:#3B2A7A;color:#fff}.mvl-l.on small{color:#D9D2FF}.mvl-l.on i{color:#8F80D9}
.mvl-l .t{font-size:15px;font-weight:900}
.mvl-ft{padding:10px 20px 14px;font-size:12px;color:#6B6488;border-top:1px solid #F3EFFF}
.mvl-none{display:none;padding:10px 0;color:#6B6488;font-weight:600}
.mvl-ask{position:fixed;left:14px;right:14px;bottom:76px;z-index:9991;max-width:380px;margin:0 auto;background:#1B1640;color:#fff;border-radius:18px;padding:16px 16px 14px;box-shadow:0 14px 40px rgba(27,22,64,.35);font-size:15px;animation:mvlup .35s ease}
.mvl-ask b{display:block;font-size:16.5px;margin-bottom:10px}
.mvl-ask button{border:0;border-radius:999px;padding:9px 16px;font-weight:800;font-size:14px;cursor:pointer;margin:0 6px 6px 0}
.mvl-ask .y{background:#FFB020;color:#1B1640}.mvl-ask .n{background:rgba(255,255,255,.12);color:#fff}
.mvl-note{background:#FFF6DD;color:#3B2A7A;font-size:13px;font-weight:600;text-align:center;padding:8px 36px 8px 12px;position:relative;border-radius:12px;margin:0 auto 16px;max-width:1100px}
.mvl-note a{color:#E0408F;font-weight:800;margin-left:6px;cursor:pointer;text-decoration:underline}
.mvl-note .x{position:absolute;right:8px;top:50%;transform:translateY(-50%);border:0;background:none;font-size:16px;color:#6B6488;cursor:pointer}
@keyframes mvlup{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}
@keyframes mvlfade{from{opacity:0}to{opacity:1}}
@keyframes mvlpop{from{opacity:0;transform:translateY(-8px) scale(.98)}to{opacity:1;transform:none}}
@media(max-width:999px){.mvl-fab{display:flex}.mvl-btn{display:none}
.mvl-ov{align-items:flex-end;padding:0}
.mvl-pn{width:100%;max-height:82vh;border-radius:22px 22px 0 0;animation:mvlup .25s ease}
.mvl-gr{grid-template-columns:repeat(2,1fr)}}
</style>
<script>
(function(){
var L=[['en','English','English',''],['hi','हिंदी','Hindi','in'],['mr','मराठी','Marathi','in'],['bn','বাংলা','Bengali','in'],['ta','தமிழ்','Tamil','in'],['te','తెలుగు','Telugu','in'],['gu','ગુજરાતી','Gujarati','in'],['kn','ಕನ್ನಡ','Kannada','in'],['ml','മലയാളം','Malayalam','in'],['pa','ਪੰਜਾਬੀ','Punjabi','in'],['ur','اردو','Urdu','in'],['sd','سنڌي','Sindhi','in'],['ne','नेपाली','Nepali','in'],
 ['ar','العربية','Arabic','w'],['zh-CN','中文 (简体)','Chinese','w'],['nl','Nederlands','Dutch','w'],['fi','Suomi','Finnish','w'],['fr','Français','French','w'],['de','Deutsch','German','w'],['id','Bahasa Indonesia','Indonesian','w'],['ga','Gaeilge','Irish','w'],['it','Italiano','Italian','w'],['ja','日本語','Japanese','w'],['ms','Bahasa Melayu','Malay','w'],['my','မြန်မာ','Burmese','w'],['no','Norsk','Norwegian','w'],['pt','Português','Portuguese','w'],['ru','Русский','Russian','w'],['es','Español','Spanish','w'],['th','ไทย','Thai','w'],['tr','Türkçe','Turkish','w'],['uk','Українська','Ukrainian','w']];
var BY={};L.forEach(function(x){BY[x[0]]=x});
var SHORT={en:'EN',hi:'हिं',mr:'मरा',bn:'বাং',ta:'தமி',te:'తెలు',gu:'ગુજ',kn:'ಕನ್ನ',ml:'മല',pa:'ਪੰਜਾ',ur:'اردو',sd:'سنڌي',ne:'नेपा','zh-CN':'中文',ja:'日本'};
function short(c){return SHORT[c]||c.split('-')[0].toUpperCase()}
var ASK={hi:'हिंदी में पढ़ना चाहेंगे?',mr:'मराठीत वाचायचे आहे का?',bn:'বাংলায় পড়তে চান?',ta:'தமிழில் படிக்க விரும்புகிறீர்களா?',te:'తెలుగులో చదవాలనుకుంటున్నారా?',gu:'ગુજરાતીમાં વાંચવું છે?',kn:'ಕನ್ನಡದಲ್ಲಿ ಓದಲು ಬಯಸುವಿರಾ?',ml:'മലയാളത്തിൽ വായിക്കണോ?',pa:'ਕੀ ਪੰਜਾਬੀ ਵਿੱਚ ਪੜ੍ਹਨਾ ਚਾਹੋਗੇ?',ur:'کیا آپ اردو میں پڑھنا چاہیں گے؟'};
function cur(){try{var o=JSON.parse(localStorage.getItem('__GT_TRANSLATE_LANGS')||'{}');return o.tgtLang||'en'}catch(e){return 'en'}}
function store(k,v){try{localStorage.setItem(k,v)}catch(e){}}
function read(k){try{return localStorage.getItem(k)}catch(e){return null}}
function go(l){store('mvLang',l);try{if(l==='en')localStorage.removeItem('__GT_TRANSLATE_LANGS');else localStorage.setItem('__GT_TRANSLATE_LANGS',JSON.stringify({srcLang:'en',tgtLang:l}))}catch(e){}location.reload()}
function nt(el){el.classList.add('notranslate');el.setAttribute('translate','no');return el}
function browserLangs(){var out=[];(navigator.languages||[navigator.language||'']).forEach(function(x){x=String(x);var k=x.toLowerCase().split('-')[0];if(x.toLowerCase().indexOf('zh')===0)k='zh-CN';if(BY[k]&&out.indexOf(k)<0)out.push(k)});return out}
/* ---- panel ---- */
function item(x){var c=cur();return '<button type="button" class="mvl-l'+(x[0]===c?' on':'')+'" data-l="'+x[0]+'" data-s="'+(x[1]+' '+x[2]+' '+x[0]).toLowerCase()+'"'+(x[0]==='ar'||x[0]==='ur'||x[0]==='sd'?' dir="auto"':'')+'><span><b>'+x[1]+'</b>'+(x[1]!==x[2]?'<i>|</i><small>'+x[2]+'</small>':'')+'</span>'+(x[0]===c?'<span class="t">✓</span>':'')+'</button>'}
function openPanel(){if(document.querySelector('.mvl-ov'))return;var sug=browserLangs();['en','hi'].forEach(function(k){if(sug.indexOf(k)<0)sug.push(k)});var c=cur();if(sug.indexOf(c)<0)sug.unshift(c);sug=sug.slice(0,4);
 var ov=nt(document.createElement('div'));ov.className='mvl-ov';ov.setAttribute('role','dialog');ov.setAttribute('aria-modal','true');ov.setAttribute('aria-label','Choose your language');
 ov.innerHTML='<div class="mvl-pn"><div class="mvl-hd"><b>🌐 Choose your language</b><button type="button" class="x" aria-label="Close">×</button></div><div class="mvl-sr"><span>🔍</span><input type="search" placeholder="Search language… e.g. Español, தமிழ்" aria-label="Search language"></div><div class="mvl-bd">'
 +'<div class="mvl-sec"><div class="mvl-gh">Suggested for you</div><div class="mvl-gr">'+sug.map(function(k){return item(BY[k])}).join('')+'</div></div>'
 +'<div class="mvl-sec"><div class="mvl-gh">Languages of India &amp; South Asia</div><div class="mvl-gr">'+L.filter(function(x){return x[3]==='in'}).map(item).join('')+'</div></div>'
 +'<div class="mvl-sec"><div class="mvl-gh">World languages</div><div class="mvl-gr">'+[BY.en].concat(L.filter(function(x){return x[3]==='w'}).sort(function(a,b){return a[2]<b[2]?-1:1})).map(item).join('')+'</div></div>'
 +'<div class="mvl-none">No language found. Try its English name.</div></div><div class="mvl-ft">Pages are translated automatically, so a few money words may not be exact. Our Money Words page has hand-written Hindi.</div></div>';
 document.body.appendChild(ov);document.documentElement.style.overflow='hidden';
 function close(){ov.remove();document.documentElement.style.overflow='';document.removeEventListener('keydown',esc)}
 function esc(e){if(e.key==='Escape')close()}document.addEventListener('keydown',esc);
 ov.addEventListener('click',function(e){if(e.target===ov||e.target.closest('.x')){close();return}var b=e.target.closest('[data-l]');if(b){var l=b.getAttribute('data-l');if(l===cur())close();else go(l)}});
 var inp=ov.querySelector('input');if(window.matchMedia('(min-width:1000px)').matches)setTimeout(function(){inp.focus()},50);
 inp.addEventListener('input',function(){var q=inp.value.trim().toLowerCase(),any=false;[].forEach.call(ov.querySelectorAll('.mvl-sec'),function(s,i){var shown=0;[].forEach.call(s.querySelectorAll('[data-l]'),function(b){var ok=!q||b.getAttribute('data-s').indexOf(q)>-1;b.style.display=ok?'':'none';if(ok)shown++});s.style.display=(q&&i===0)||!shown?'none':'';if(shown&&!(q&&i===0))any=true});ov.querySelector('.mvl-none').style.display=any?'none':'block'})}
/* ---- header button (computer) ---- */
var c0=cur();
var srch=document.querySelector('header [data-id="search"], header .ct-header-search');
if(srch){var hb=nt(document.createElement('button'));hb.type='button';hb.className='mvl-btn';hb.setAttribute('aria-label','Language: '+(BY[c0]?BY[c0][2]:c0)+'. Change language');hb.innerHTML='<span class="g">🌐</span><span class="c">'+short(c0)+'</span><span aria-hidden="true" style="font-size:9px;opacity:.6">▾</span>';srch.parentNode.insertBefore(hb,srch);hb.addEventListener('click',openPanel)}
/* ---- floating button (phone) ---- */
var fab=nt(document.createElement('button'));fab.type='button';fab.className='mvl-fab';fab.setAttribute('aria-label','Change language');fab.innerHTML='<span class="g">🌐</span><span class="c">'+short(c0)+'</span>';document.body.appendChild(fab);fab.addEventListener('click',openPanel);
/* ---- phone menu row ---- */
function addRow(){var mm=document.querySelector('#offcanvas .mobile-menu');if(!mm||document.querySelector('#offcanvas .mvl-row'))return;var r=nt(document.createElement('button'));r.type='button';r.className='mvl-row';r.innerHTML='<span>🌐 Language</span><small>'+(BY[c0]?BY[c0][1]:c0)+' ▸</small>';mm.parentNode.insertBefore(r,mm);r.addEventListener('click',openPanel)}
addRow();document.addEventListener('click',function(e){if(e.target.closest('.ct-header-trigger,[data-toggle-panel]'))setTimeout(addRow,50)});
/* ---- machine-translated note ---- */
(function note(){if(c0==='en')return;try{if(sessionStorage.getItem('mvlNoteX'))return}catch(e){}var n=document.createElement('div');n.className='mvl-note';n.innerHTML='This page is machine-translated, so a few money words may not be exact.<a class="notranslate" translate="no">Show in English</a><button type="button" class="x notranslate" aria-label="Close">×</button>';
 var mn=document.querySelector('main#main .entry-content')||document.querySelector('main#main article')||document.querySelector('main#main');if(mn)mn.insertBefore(n,mn.firstChild);else document.body.insertBefore(n,document.body.firstChild);
 n.querySelector('a').addEventListener('click',function(){go('en')});n.querySelector('.x').addEventListener('click',function(){try{sessionStorage.setItem('mvlNoteX','1')}catch(e){}n.remove()})})();
/* ---- one-time question ---- */
setTimeout(function(){if(read('mvLangAsked')||read('mvLang')||cur()!=='en')return;var langs=(navigator.languages||[navigator.language||'']).map(function(x){return String(x).toLowerCase().split('-')[0]});var l=null;for(var i=0;i<langs.length;i++){if(langs[i]==='en')break;if(ASK[langs[i]]){l=langs[i];break}}if(!l)return;
 var a=nt(document.createElement('div'));a.className='mvl-ask';a.innerHTML='<b>'+ASK[l]+'</b><button type="button" class="y">'+BY[l][1]+'</button><button type="button" class="n">Continue in English</button>';document.body.appendChild(a);
 a.querySelector('.y').addEventListener('click',function(){store('mvLangAsked','1');a.remove();go(l)});a.querySelector('.n').addEventListener('click',function(){store('mvLangAsked','1');store('mvLang','en');a.remove()})},2500);
})();
</script>
	<?php
}, 60 );
