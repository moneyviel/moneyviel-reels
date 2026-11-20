<?php
/**
 * MoneyViel – Snippet 15: My country & currency (display only)
 *
 * - Guesses the visitor's currency from their time zone (then browser language).
 *   India / unknown = ₹ INR = nothing changes at all.
 * - Visitor can change it: small "💱 Amounts in … · Change" chip above every tool,
 *   and a "Currency" row at the bottom of the 🌐 language panel. Saved in this browser only.
 * - Inside tools (.mvt boxes) it re-labels ₹ amounts on screen: symbol, digit grouping
 *   (1,08,236 → 108,236) and lakh/crore → plain numbers / million / billion.
 *   The maths is unchanged (tools are currency-neutral); no conversion rates are used.
 * - Articles are never touched (their ₹ examples are Indian on purpose).
 */
add_action('wp_footer', function () {
	if (is_admin()) return; ?>
<style id="mvc-css">
.mvc-chip{display:flex;flex-wrap:wrap;align-items:center;gap:6px 10px;margin:0 0 12px;padding:7px 12px;border-radius:14px;background:#F4F1FF;border:1px solid #E2DBFF;font-size:13px;line-height:1.35;font-family:inherit;font-weight:500;color:#3A3170;width:fit-content;max-width:100%}
.mvc-chip b{color:#1B1640}
.mvc-chip button{all:unset;cursor:pointer;color:#6C4CF1;font-weight:700;text-decoration:underline;text-underline-offset:2px}
.mvc-chip select{font:inherit;padding:4px 8px;border-radius:10px;border:1px solid #CFC6FF;background:#fff;color:#1B1640;max-width:100%}
.mvc-note{flex-basis:100%;font-size:12px;color:#5D5590}
.mvl-cur{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:12px 18px;border-top:1px solid #EEE9FF;background:#FAF8FF;font-size:14px;color:#3A3170}
.mvl-cur select{font:inherit;padding:6px 10px;border-radius:10px;border:1px solid #CFC6FF;background:#fff;color:#1B1640;max-width:60%}
</style>
<script id="mvc-js">
(function(){
 var CUR={INR:['₹','Indian rupee'],USD:['$','US dollar'],EUR:['€','Euro'],GBP:['£','British pound'],AED:['AED ','UAE dirham'],SAR:['SAR ','Saudi riyal'],QAR:['QAR ','Qatari riyal'],KWD:['KWD ','Kuwaiti dinar'],OMR:['OMR ','Omani rial'],BHD:['BHD ','Bahraini dinar'],CAD:['C$','Canadian dollar'],AUD:['A$','Australian dollar'],NZD:['NZ$','New Zealand dollar'],SGD:['S$','Singapore dollar'],HKD:['HK$','Hong Kong dollar'],MYR:['RM','Malaysian ringgit'],IDR:['Rp','Indonesian rupiah'],PHP:['₱','Philippine peso'],THB:['฿','Thai baht'],JPY:['¥','Japanese yen'],CNY:['CN¥','Chinese yuan'],KRW:['₩','South Korean won'],PKR:['Rs ','Pakistani rupee'],BDT:['৳','Bangladeshi taka'],NPR:['NPR ','Nepalese rupee'],LKR:['LKR ','Sri Lankan rupee'],NGN:['₦','Nigerian naira'],KES:['KSh ','Kenyan shilling'],ZAR:['R ','South African rand'],EGP:['EGP ','Egyptian pound'],BRL:['R$','Brazilian real'],MXN:['MX$','Mexican peso'],CHF:['CHF ','Swiss franc'],SEK:['SEK ','Swedish krona'],NOK:['NOK ','Norwegian krone'],DKK:['DKK ','Danish krone'],PLN:['PLN ','Polish zloty'],TRY:['₺','Turkish lira'],RUB:['₽','Russian rouble']};
 var CC={IN:'INR',US:'USD',GB:'GBP',AE:'AED',SA:'SAR',QA:'QAR',KW:'KWD',OM:'OMR',BH:'BHD',CA:'CAD',AU:'AUD',NZ:'NZD',SG:'SGD',HK:'HKD',MY:'MYR',ID:'IDR',PH:'PHP',TH:'THB',JP:'JPY',CN:'CNY',KR:'KRW',PK:'PKR',BD:'BDT',NP:'NPR',LK:'LKR',NG:'NGN',KE:'KES',ZA:'ZAR',EG:'EGP',BR:'BRL',MX:'MXN',CH:'CHF',SE:'SEK',NO:'NOK',DK:'DKK',PL:'PLN',TR:'TRY',RU:'RUB',DE:'EUR',FR:'EUR',ES:'EUR',IT:'EUR',NL:'EUR',BE:'EUR',IE:'EUR',PT:'EUR',AT:'EUR',FI:'EUR',GR:'EUR',LU:'EUR',SK:'EUR',SI:'EUR',EE:'EUR',LV:'EUR',LT:'EUR',HR:'EUR',CY:'EUR',MT:'EUR'};
 var TZ={'Asia/Kolkata':'IN','Asia/Calcutta':'IN','Asia/Dubai':'AE','Asia/Riyadh':'SA','Asia/Qatar':'QA','Asia/Kuwait':'KW','Asia/Muscat':'OM','Asia/Bahrain':'BH','Europe/London':'GB','America/Toronto':'CA','America/Vancouver':'CA','America/Edmonton':'CA','America/Winnipeg':'CA','America/Halifax':'CA','America/Sao_Paulo':'BR','America/Mexico_City':'MX','Asia/Singapore':'SG','Asia/Hong_Kong':'HK','Asia/Kuala_Lumpur':'MY','Asia/Jakarta':'ID','Asia/Manila':'PH','Asia/Bangkok':'TH','Asia/Tokyo':'JP','Asia/Shanghai':'CN','Asia/Seoul':'KR','Asia/Karachi':'PK','Asia/Dhaka':'BD','Asia/Kathmandu':'NP','Asia/Katmandu':'NP','Asia/Colombo':'LK','Africa/Lagos':'NG','Africa/Nairobi':'KE','Africa/Johannesburg':'ZA','Africa/Cairo':'EG','Pacific/Auckland':'NZ','Europe/Zurich':'CH','Europe/Stockholm':'SE','Europe/Oslo':'NO','Europe/Copenhagen':'DK','Europe/Warsaw':'PL','Europe/Istanbul':'TR','Europe/Moscow':'RU','Europe/Berlin':'DE','Europe/Paris':'FR','Europe/Madrid':'ES','Europe/Rome':'IT','Europe/Amsterdam':'NL','Europe/Brussels':'BE','Europe/Dublin':'IE','Europe/Lisbon':'PT','Europe/Vienna':'AT','Europe/Helsinki':'FI','Europe/Athens':'GR'};
 function get(k){try{return localStorage.getItem(k)}catch(e){return null}}
 function set(k,v){try{localStorage.setItem(k,v)}catch(e){}}
 function guess(){
  var c=null,tz='';try{tz=Intl.DateTimeFormat().resolvedOptions().timeZone||''}catch(e){}
  if(TZ[tz])c=TZ[tz];else if(/^America\//.test(tz))c='US';else if(/^Australia\//.test(tz))c='AU';
  if(!c){var L=navigator.languages||[navigator.language||''];for(var i=0;i<L.length&&!c;i++){var m=/-([A-Z]{2})$/i.exec(L[i]||'');if(m&&CC[m[1].toUpperCase()])c=m[1].toUpperCase()}}
  return CC[c]||'INR';
 }
 var code=get('mvCur');if(!CUR[code])code=guess();
 var SYM=CUR[code][0],INR=code==='INR',NF=new Intl.NumberFormat('en-US',{maximumFractionDigits:2});
 function big(n){var a=Math.abs(n);if(a>=1e9)return NF.format(+(n/1e9).toFixed(2))+' billion';if(a>=1e6)return NF.format(+(n/1e6).toFixed(2))+' million';return NF.format(Math.round(n))}
 var RX=/(-\s?)?₹\s?((?:\d[\d,]*)(?:\.\d+)?)(\s*(lakhs?|lacs?|crores?|cr|L)\b\.?)?/gi;
 function conv(s){
  if(s.indexOf('₹')<0)return s;
  s=s.replace(RX,function(_,neg,num,suf,unit){var n=parseFloat(num.replace(/,/g,''));if(isNaN(n))return _;
   if(unit){var u=unit.toLowerCase();n*= (u.charAt(0)==='c')?1e7:1e5;return (neg?'-':'')+SYM+big(n)}
   var dec=(num.split('.')[1]||'');return (neg?'-':'')+SYM+(dec?n.toLocaleString('en-US',{minimumFractionDigits:dec.length,maximumFractionDigits:dec.length}):NF.format(n))});
  return s.replace(/₹/g,SYM.trim());
 }
 function walk(root){
  if(!root)return;
  if(root.nodeType===3){var t=root.nodeValue;if(t.indexOf('₹')>-1){var v=conv(t);if(v!==t)root.nodeValue=v}return}
  if(root.nodeType!==1||/^(SCRIPT|STYLE|TEXTAREA|CANVAS)$/.test(root.tagName))return;
  ['placeholder','aria-label','title','data-label'].forEach(function(a){var v=root.getAttribute&&root.getAttribute(a);if(v&&v.indexOf('₹')>-1)root.setAttribute(a,conv(v))});
  for(var c=root.firstChild;c;c=c.nextSibling)walk(c);
 }
 function lab(k){var y=CUR[k][0].trim();return y===k?k:y+' '+k}
 function sel(){var h='<select aria-label="Currency">';Object.keys(CUR).forEach(function(k){h+='<option value="'+k+'"'+(k===code?' selected':'')+'>'+lab(k)+' · '+CUR[k][1]+'</option>'});return h+'</select>'}
 function choose(v){if(!CUR[v])return;set('mvCur',v);location.reload()}
 window.mvCurrency={code:code,symbol:SYM,set:choose};
 function chip(box){
  if(box.previousElementSibling&&box.previousElementSibling.classList.contains('mvc-chip'))return;
  var d=document.createElement('div');d.className='mvc-chip';
  d.innerHTML='<span>💱 Amounts in <b>'+lab(code)+'</b></span><button type="button">Change</button>'+(INR?'':'<span class="mvc-note">Example figures and some rules (like tax) are based on India. The maths works the same in any currency.</span>');
  d.querySelector('button').onclick=function(){var b=this;b.insertAdjacentHTML('afterend',sel());b.nextSibling.onchange=function(){choose(this.value)};b.remove()};
  box.parentNode.insertBefore(d,box);
 }
 function init(){
  var boxes=[].slice.call(document.querySelectorAll('.mvt')).filter(function(b){return !b.parentNode.closest||!b.parentNode.closest('.mvt')});
  boxes.forEach(function(b){if(b.textContent.indexOf('₹')>-1||b.querySelector('input[type=number]'))chip(b)});
  if(!INR){
   boxes.forEach(function(b){walk(b);new MutationObserver(function(ms){ms.forEach(function(m){if(m.type==='characterData')walk(m.target);else for(var i=0;i<m.addedNodes.length;i++)walk(m.addedNodes[i]);if(m.type==='attributes')walk(m.target)})}).observe(b,{subtree:true,childList:true,characterData:true,attributes:true,attributeFilter:['placeholder','aria-label','title']})});
  }
  // currency row inside the 🌐 language panel
  function addRow(){var pn=document.querySelector('.mvl-pn');if(pn&&!pn.querySelector('.mvl-cur')){var r=document.createElement('div');r.className='mvl-cur';r.innerHTML='<span>💱 Show money in</span>'+sel();pn.appendChild(r);r.querySelector('select').onchange=function(){choose(this.value)}}}
  document.addEventListener('click',function(e){if(e.target.closest&&e.target.closest('.mvl-btn,.mvl-fab,.mvl-row,.mvl-ask')){setTimeout(addRow,30);setTimeout(addRow,300)}},true);
 }
 if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',init);else init();
})();
</script>
<?php }, 30);
