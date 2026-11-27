/**
 * MoneyViel – Snippet 18: Play & daily hooks (Nov 2026)
 *
 * Shortcodes:
 *  [mv_kids_makers]  Kids page: Pip's 4 Jars game + printable chart, Club card maker, Coin designer + Count-the-coins.
 *                    Kids rules: nothing is sent anywhere, no names leave the device, "coins" not real currency.
 *  [mv_checkup]      Start Here: 60-second Money Check-up game (score, badge, next steps). Saved on the device only.
 *  [mv_daily]        Homepage: Daily Money Challenge + streak, Mr. Hoot's question of the day (live answers), Money Word flip card.
 * REST: mv-play/v1/hoot (GET counts / POST one answer) — stores only anonymous counts per day.
 */

/* ---------- Mr. Hoot answers: anonymous counts per day ---------- */
add_action( 'rest_api_init', function () {
	register_rest_route( 'mv-play/v1', '/hoot', array(
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => function ( WP_REST_Request $r ) {
				$d   = (int) $r->get_param( 'day' );
				$all = get_option( 'mv_hoot_votes', array() );
				return array( 'counts' => array_map( 'intval', (array) ( $all[ $d ] ?? array( 0, 0, 0 ) ) ) );
			},
		),
		array(
			'methods'             => 'POST',
			'permission_callback' => '__return_true',
			'callback'            => function ( WP_REST_Request $r ) {
				$d = (int) $r->get_param( 'day' );
				$p = (int) $r->get_param( 'pick' );
				$t = (int) floor( time() / DAY_IN_SECONDS );
				if ( $p < 0 || $p > 2 || abs( $d - $t ) > 2 ) {
					return new WP_Error( 'mv_bad', 'Invalid answer.', array( 'status' => 400 ) );
				}
				$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? md5( (string) $_SERVER['REMOTE_ADDR'] . $d ) : 'x';
				$k  = 'mv_hoot_' . substr( $ip, 0, 16 );
				$n  = (int) get_transient( $k );
				$all = get_option( 'mv_hoot_votes', array() );
				$all = is_array( $all ) ? $all : array();
				if ( empty( $all[ $d ] ) ) {
					$all[ $d ] = array( 0, 0, 0 );
				}
				if ( $n < 3 ) { // at most 3 answers per network per day (families share Wi-Fi)
					$all[ $d ][ $p ]++;
					set_transient( $k, $n + 1, DAY_IN_SECONDS );
					foreach ( array_keys( $all ) as $day ) {
						if ( $day < $t - 60 ) {
							unset( $all[ $day ] );
						}
					}
					update_option( 'mv_hoot_votes', $all, false );
				}
				return array( 'counts' => array_map( 'intval', $all[ $d ] ) );
			},
		),
	) );
} );

/* ---------- Shared styles ---------- */
function mvp_css() {
	static $done = false;
	if ( $done ) {
		return '';
	}
	$done = true;
	return '<style id="mvp-css">
.mvp{font-family:inherit;color:#1b1340}
.mvp *{box-sizing:border-box}
.mvp-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:10px 0}
@media(max-width:900px){.mvp-grid{grid-template-columns:1fr}}
.mvp-card{background:#fff;border-radius:22px;padding:18px;box-shadow:0 6px 24px rgba(27,19,64,.08);border:1px solid #efeaff;position:relative;overflow:hidden}
.mvp-card h3{margin:0 0 4px;font-size:1.2em;line-height:1.25}
.mvp-tag{display:inline-block;font-size:12px;font-weight:800;letter-spacing:.04em;text-transform:uppercase;padding:4px 10px;border-radius:999px;background:#f3efff;color:#5b3fd6;margin-bottom:8px}
.mvp-b{all:unset;box-sizing:border-box;display:inline-flex;align-items:center;justify-content:center;gap:6px;cursor:pointer;border-radius:999px;padding:11px 18px;font-weight:800;font-size:15px;background:#5b3fd6;color:#fff;text-align:center;transition:transform .12s,box-shadow .12s}
.mvp-b:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(91,63,214,.3)}
.mvp-b:active{transform:scale(.97)}
.mvp-b.pk{background:#e8457a}.mvp-b.gh{background:#f3efff;color:#5b3fd6}.mvp-b.gn{background:#16a34a}
.mvp-b[disabled]{opacity:.45;pointer-events:none}
.mvp-row{display:flex;flex-wrap:wrap;gap:8px;margin:10px 0}
.mvp-small{font-size:13px;color:#6b6488;margin:8px 0 0}
.mvp-pop{animation:mvpPop .35s ease}
@keyframes mvpPop{0%{transform:scale(.85);opacity:.2}70%{transform:scale(1.05)}100%{transform:scale(1);opacity:1}}
.mvp-shake{animation:mvpShake .35s}
@keyframes mvpShake{0%,100%{transform:translateX(0)}25%{transform:translateX(-6px)}75%{transform:translateX(6px)}}
.mvp-conf{position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden}
.mvp-conf i{position:absolute;top:-20px;width:10px;height:14px;border-radius:3px;animation:mvpFall 1.6s linear forwards}
@keyframes mvpFall{to{transform:translateY(110vh) rotate(720deg)}}
.mvp-stars{font-size:22px;letter-spacing:2px;min-height:28px}
.mvp-say{display:flex;gap:10px;align-items:flex-start;background:#fff8e6;border-radius:16px;padding:10px 12px;margin:10px 0;font-size:15px;line-height:1.4}
.mvp-say b{font-size:26px;line-height:1}
/* jars */
.mvp-jars{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:10px}
.mvp-jar{all:unset;cursor:pointer;text-align:center;border-radius:16px 16px 22px 22px;padding:10px 4px 8px;font-weight:800;font-size:13px;border:3px solid;background:#fff;transition:transform .12s}
.mvp-jar:hover{transform:translateY(-3px)}
.mvp-jar span{display:block;font-size:26px}
.mvp-sc{background:linear-gradient(135deg,#f3efff,#ffe9f0);border-radius:18px;padding:16px;text-align:center;font-size:17px;font-weight:700;min-height:86px;display:flex;align-items:center;justify-content:center;gap:10px}
.mvp-sc .e{font-size:38px}
/* card maker */
.mvp-in{width:100%;font:inherit;font-size:16px;padding:10px 14px;border-radius:12px;border:1.5px solid #d9d1ff}
.mvp-sw{all:unset;cursor:pointer;width:30px;height:30px;border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 2px #e5e0ff}
.mvp-sw.on{box-shadow:0 0 0 3px #1b1340}
.mvp-pick{all:unset;cursor:pointer;font-size:24px;width:44px;height:44px;display:inline-flex;align-items:center;justify-content:center;border-radius:12px;background:#f7f5ff;border:2px solid transparent}
.mvp-pick.on{border-color:#5b3fd6;background:#efeaff}
.mvp-cv{width:100%;height:auto;border-radius:14px;display:block;margin:10px 0;box-shadow:0 6px 18px rgba(0,0,0,.12)}
/* coins game */
.mvp-coins{display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin:8px 0}
/* checkup */
.mvp-ck{max-width:720px;margin:0 auto}
.mvp-ck .mvp-card{padding:24px 20px}
.mvp-bar{height:10px;border-radius:999px;background:#efeaff;overflow:hidden;margin:6px 0 16px}
.mvp-bar i{display:block;height:100%;background:linear-gradient(90deg,#5b3fd6,#e8457a);width:0;transition:width .35s}
.mvp-q{font-size:1.35em;font-weight:800;line-height:1.3;margin:4px 0 14px}
.mvp-opt{all:unset;box-sizing:border-box;cursor:pointer;display:flex;align-items:center;gap:12px;width:100%;padding:14px 16px;margin:8px 0;border-radius:16px;border:2px solid #ece7ff;background:#fff;font-size:16px;font-weight:600;transition:all .12s}
.mvp-opt:hover{border-color:#5b3fd6;background:#faf8ff;transform:translateX(3px)}
.mvp-opt span{font-size:26px}
.mvp-ring{width:170px;height:170px;margin:6px auto;position:relative}
.mvp-ring svg{transform:rotate(-90deg)}
.mvp-ring b{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;font-size:44px}
.mvp-ring b small{font-size:13px;color:#6b6488;font-weight:600}
.mvp-step{display:flex;gap:12px;align-items:center;padding:12px 14px;border-radius:16px;background:#faf8ff;margin:8px 0;text-decoration:none;color:#1b1340;border:1px solid #efeaff}
.mvp-step:hover{background:#f3efff}
.mvp-step span{font-size:28px}
/* daily */
.mvp-daily{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:12px 0 28px}
@media(max-width:900px){.mvp-daily{grid-template-columns:1fr}}
.mvp-fire{font-size:34px;line-height:1}
.mvp-flip{perspective:900px;cursor:pointer;min-height:190px}
.mvp-flip .in{position:relative;width:100%;min-height:190px;transition:transform .6s;transform-style:preserve-3d}
.mvp-flip.on .in{transform:rotateY(180deg)}
.mvp-flip .fr,.mvp-flip .bk{position:absolute;inset:0;backface-visibility:hidden;border-radius:18px;padding:16px;display:flex;flex-direction:column;justify-content:center}
.mvp-flip .fr{background:linear-gradient(135deg,#5b3fd6,#e8457a);color:#fff;text-align:center}
.mvp-flip .bk{background:#fff8e6;transform:rotateY(180deg);font-size:15px;line-height:1.45}
.mvp-res{margin:6px 0}
.mvp-res div{display:flex;justify-content:space-between;font-size:14px;font-weight:700}
.mvp-res .bar{height:9px;border-radius:999px;background:#efeaff;overflow:hidden;margin:3px 0 7px}
.mvp-res .bar i{display:block;height:100%;background:#5b3fd6;transition:width .6s}
.mvp-res .ok .bar i{background:#16a34a}
</style>';
}

/* ---------- Shared JS helpers ---------- */
function mvp_js_helpers() {
	static $done = false;
	if ( $done ) {
		return '';
	}
	$done = true;
	return '<script>window.MVP=window.MVP||{ls:function(k,v){try{if(v===undefined){var x=localStorage.getItem(k);return x?JSON.parse(x):null}localStorage.setItem(k,JSON.stringify(v))}catch(e){return null}},conf:function(){var c=document.createElement("div");c.className="mvp-conf";var col=["#5b3fd6","#e8457a","#ffb800","#16a34a","#3b82f6"];for(var i=0;i<60;i++){var p=document.createElement("i");p.style.left=Math.random()*100+"%";p.style.background=col[i%5];p.style.animationDelay=(Math.random()*.5)+"s";p.style.animationDuration=(1.2+Math.random()*.9)+"s";c.appendChild(p)}document.body.appendChild(c);setTimeout(function(){c.remove()},2600)},day:function(){var d=new Date();return Math.floor((Date.UTC(d.getFullYear(),d.getMonth(),d.getDate()))/864e5)},esc:function(t){var d=document.createElement("div");d.textContent=String(t);return d.innerHTML},pop:function(el){el.classList.remove("mvp-pop");void el.offsetWidth;el.classList.add("mvp-pop")}};</script>';
}

/* ======================= KIDS MAKERS ======================= */
add_shortcode( 'mv_kids_makers', function () {
	ob_start();
	echo mvp_css() . mvp_js_helpers(); ?>
<div class="mvp" id="mvp-kids">
<div class="mvp-grid">
 <div class="mvp-card" id="mvp-jarsbox">
  <span class="mvp-tag">🎮 Play, then print</span>
  <h3>🫙 Pip's 4 Jars game</h3>
  <p style="margin:0">Help Pip choose the right jar! Then print your own 4 Jars chart for the fridge.</p>
  <div class="mvp-stars" aria-live="polite"></div>
  <div class="mvp-sc"></div>
  <div class="mvp-jars"></div>
  <div class="mvp-say"><b>🐷</b><span class="t">Tap the jar where this money should go.</span></div>
  <div class="mvp-row"><button type="button" class="mvp-b pk" data-a="print">🖨️ Print my 4 Jars chart</button></div>
 </div>
 <div class="mvp-card" id="mvp-cardbox">
  <span class="mvp-tag">✨ Make it yours</span>
  <h3>🪪 My Money Club card</h3>
  <input class="mvp-in" maxlength="14" placeholder="Child's first name" aria-label="Child's first name" autocomplete="off">
  <div class="mvp-row" data-g="buddy"></div>
  <div class="mvp-row" data-g="col"></div>
  <canvas class="mvp-cv" width="1012" height="638" aria-label="Money Club card preview"></canvas>
  <div class="mvp-row"><button type="button" class="mvp-b" data-a="dl">⬇️ Save card</button><button type="button" class="mvp-b gh" data-a="pr">🖨️ Print</button></div>
  <p class="mvp-small">🔒 The name stays on this device. We never see or store it.</p>
 </div>
 <div class="mvp-card" id="mvp-coinbox">
  <span class="mvp-tag">🪙 Design + count</span>
  <h3>🪙 Coin Designer</h3>
  <div class="mvp-row" data-g="val"></div>
  <div class="mvp-row" data-g="pic"></div>
  <div style="text-align:center" class="prev"></div>
  <div class="mvp-row"><button type="button" class="mvp-b" data-a="add">➕ Add to my sheet</button><button type="button" class="mvp-b pk" data-a="print">🖨️ Print coin sheet</button></div>
  <p class="mvp-small mine"></p>
  <hr style="border:0;border-top:1px dashed #e5e0ff;margin:12px 0">
  <b>🧮 Count the coins!</b> <span class="cstar"></span>
  <div class="mvp-coins game"></div>
  <div class="mvp-row ans"></div>
  <p class="mvp-small msg" aria-live="polite"></p>
 </div>
</div>
</div>
<script>
(function(){
var M=window.MVP,box=document.getElementById('mvp-jarsbox');
/* ---- 4 Jars ---- */
var J=[{k:'save',n:'Save',e:'🐷',c:'#3b82f6',d:'For something bigger, later'},{k:'spend',n:'Spend',e:'🛍️',c:'#e8457a',d:'For small things, now'},{k:'share',n:'Share',e:'💛',c:'#f59e0b',d:'To help and give to others'},{k:'grow',n:'Grow',e:'🌱',c:'#16a34a',d:'Kept a long time so it can grow'}];
var S=[{e:'🚲',t:'A new bike in 3 months',a:'save'},{e:'🍦',t:'An ice cream with friends today',a:'spend'},{e:'🎁',t:"A gift for a friend's birthday",a:'share'},{e:'🌳',t:'Money you will not touch until you are big',a:'grow'},{e:'🖍️',t:'New crayons this week',a:'spend'},{e:'🎮',t:'A board game that costs a lot, next month',a:'save'},{e:'🐶',t:'Food for animals at a shelter',a:'share'},{e:'🌻',t:'Planting a "money seed" for many years',a:'grow'}];
var i=0,stars=0,tries=0,sc=box.querySelector('.mvp-sc'),say=box.querySelector('.t'),st=box.querySelector('.mvp-stars'),jw=box.querySelector('.mvp-jars');
J.forEach(function(j){var b=document.createElement('button');b.type='button';b.className='mvp-jar';b.style.borderColor=j.c;b.style.color=j.c;b.innerHTML='<span>'+j.e+'</span>'+j.n;b.title=j.d;b.onclick=function(){pick(j.k,b)};jw.appendChild(b)});
function show(){if(i>=S.length){sc.innerHTML='<span class="e">🏆</span><span>You did it! '+stars+' ⭐ out of '+S.length+'</span>';say.textContent='Amazing! Now print your own 4 Jars chart and fill it every week.';M.conf();M.ls('mvJars',{stars:stars,d:Date.now()});return}var s=S[i];sc.innerHTML='<span class="e">'+s.e+'</span><span>'+M.esc(s.t)+'</span>';M.pop(sc);tries=0;st.textContent='⭐'.repeat(stars)+'☆'.repeat(S.length-stars)}
function pick(k,b){if(i>=S.length){i=0;stars=0;show();return}var s=S[i];var j=J.filter(function(x){return x.k===s.a})[0];if(k===s.a){if(!tries)stars++;say.textContent=['Yes! ','Great thinking! ','Spot on! ','Brilliant! '][i%4]+j.n+' jar: '+j.d.toLowerCase()+'.';i++;setTimeout(show,650);M.pop(b)}else{tries++;b.classList.remove('mvp-shake');void b.offsetWidth;b.classList.add('mvp-shake');say.textContent='Hmm, think again! Is it for now, for later, for others, or for a long, long time?'}st.textContent='⭐'.repeat(stars)+'☆'.repeat(S.length-stars)}
show();
box.querySelector('[data-a=print]').onclick=function(){var w=window.open('','_blank');if(!w)return;var cols=J.map(function(j){return '<div class="j" style="border-color:'+j.c+'"><div class="e">'+j.e+'</div><h2 style="color:'+j.c+'">'+j.n+'</h2><p>'+j.d+'</p><div class="g">'+'<i></i>'.repeat(16)+'</div></div>'}).join('');w.document.write('<!doctype html><html><head><title>My 4 Jars chart · MoneyViel Kids</title><style>@page{size:A4 landscape;margin:12mm}body{font-family:Arial,sans-serif;color:#1b1340;margin:0}h1{text-align:center;margin:0 0 4px}.s{text-align:center;margin:0 0 14px}.w{display:flex;gap:10px}.j{flex:1;border:4px solid;border-radius:18px 18px 40px 40px;padding:10px;text-align:center}.e{font-size:44px}h2{margin:4px 0}p{margin:0 0 8px;font-size:13px}.g{display:grid;grid-template-columns:repeat(4,1fr);gap:6px}.g i{display:block;aspect-ratio:1;border:2px dashed #bbb;border-radius:50%}.f{text-align:center;font-size:11px;margin-top:10px;color:#666}</style></head><body><h1>🫙 My 4 Jars chart</h1><p class="s">Colour in a coin each time you put money in a jar. Name: ______________________</p><div class="w">'+cols+'</div><p class="f">MoneyViel Kids · Pip\'s Money Club · moneyviel.com/kids · For learning at home and in class.</p><script>setTimeout(function(){print()},400)<\/script></body></html>');w.document.close()};

/* ---- Club card ---- */
var cb=document.getElementById('mvp-cardbox'),cv=cb.querySelector('canvas'),x=cv.getContext('2d'),inp=cb.querySelector('input');
var B=[['🐷🤖','Pip'],['👦','Duggu'],['👧','Chia'],['🦉','Mr. Hoot']],C=[['#5b3fd6','#e8457a'],['#2563eb','#06b6d4'],['#16a34a','#84cc16'],['#f59e0b','#ef4444'],['#1b1340','#6d28d9']];
var st2=M.ls('mvCard')||{b:0,c:0,no:String(1000+Math.floor(Math.random()*9000))};if(!M.ls('mvCard'))M.ls('mvCard',{b:0,c:0,no:st2.no});
B.forEach(function(b,n){var e=document.createElement('button');e.type='button';e.className='mvp-pick';e.textContent=b[0].slice(0,2);e.title=b[1];e.onclick=function(){st2.b=n;save()};cb.querySelector('[data-g=buddy]').appendChild(e)});
C.forEach(function(c,n){var e=document.createElement('button');e.type='button';e.className='mvp-sw';e.style.background='linear-gradient(135deg,'+c[0]+','+c[1]+')';e.setAttribute('aria-label','Colour '+(n+1));e.onclick=function(){st2.c=n;save()};cb.querySelector('[data-g=col]').appendChild(e)});
try{inp.value=localStorage.getItem('mvCardName')||''}catch(e){}
inp.oninput=function(){try{localStorage.setItem('mvCardName',inp.value)}catch(e){}draw()};
function save(){M.ls('mvCard',{b:st2.b,c:st2.c,no:st2.no});draw()}
function rr(x0,y0,w,h,r){x.beginPath();x.moveTo(x0+r,y0);x.arcTo(x0+w,y0,x0+w,y0+h,r);x.arcTo(x0+w,y0+h,x0,y0+h,r);x.arcTo(x0,y0+h,x0,y0,r);x.arcTo(x0,y0,x0+w,y0,r);x.closePath()}
function draw(){[].forEach.call(cb.querySelectorAll('[data-g=buddy] button'),function(e,n){e.classList.toggle('on',n===st2.b)});[].forEach.call(cb.querySelectorAll('[data-g=col] button'),function(e,n){e.classList.toggle('on',n===st2.c)});
var c=C[st2.c],g=x.createLinearGradient(0,0,1012,638);g.addColorStop(0,c[0]);g.addColorStop(1,c[1]);x.clearRect(0,0,1012,638);rr(0,0,1012,638,48);x.fillStyle=g;x.fill();
x.globalAlpha=.12;x.fillStyle='#fff';for(var k=0;k<9;k++){x.beginPath();x.arc(80+k*120,560-((k%3)*40),60,0,7);x.fill()}x.globalAlpha=1;
x.fillStyle='#fff';x.font='800 44px Arial';x.fillText("PIP'S MONEY CLUB",60,92);x.font='600 26px Arial';x.fillText('Official member card',62,132);
x.fillStyle='rgba(255,255,255,.92)';rr(60,180,240,240,40);x.fill();x.font='150px Arial';x.textAlign='center';x.textBaseline='middle';x.fillText(B[st2.b][0].slice(0,2),180,305);x.textAlign='left';x.textBaseline='alphabetic';
var nm=(inp.value||'Your name').trim().slice(0,14);x.fillStyle='#fff';x.font='800 '+(nm.length>9?64:78)+'px Arial';x.fillText(nm,340,270);
x.font='600 30px Arial';x.fillText('Buddy: '+B[st2.b][1],342,322);x.fillText('Member no. PMC-'+st2.no,342,368);
x.font='700 26px Arial';x.fillText('I save a little  ·  I think before I buy  ·  I share kindly',60,486);
x.font='600 22px Arial';x.globalAlpha=.85;x.fillText('moneyviel.com/kids',60,580);x.globalAlpha=1;x.font='70px Arial';x.fillText('⭐',880,110)}
draw();
cb.querySelector('[data-a=dl]').onclick=function(){var a=document.createElement('a');a.download='my-money-club-card.png';a.href=cv.toDataURL('image/png');document.body.appendChild(a);a.click();a.remove();M.conf()};
cb.querySelector('[data-a=pr]').onclick=function(){var w=window.open('','_blank');if(!w)return;w.document.write('<!doctype html><title>My Money Club card</title><style>@page{margin:15mm}body{margin:0;text-align:center;font-family:Arial}img{width:86mm;border-radius:4mm;margin:6mm}</style><img src="'+cv.toDataURL('image/png')+'"><img src="'+cv.toDataURL('image/png')+'"><p style="font-size:11px;color:#666">Cut out along the edge. Print a spare for a friend!</p><script>setTimeout(function(){print()},400)<\/script>');w.document.close()};

/* ---- Coin designer + counting game ---- */
var co=document.getElementById('mvp-coinbox'),V=[1,2,5,10],P=['🐷','🦉','⭐','🌳','🚀','🐱','🌈','👑'],T=[['#ffd54a','#f59e0b','#7a4b00'],['#e5e7eb','#9ca3af','#374151'],['#f4a261','#b45309','#4a2500']];
var cs=M.ls('mvCoins')||{v:1,p:0,list:[]};
function coinSVG(v,p,size){var t={1:T[2],2:T[1],5:T[0],10:T[0]}[v];return '<svg width="'+size+'" height="'+size+'" viewBox="0 0 100 100" role="img" aria-label="'+v+' coin'+(v>1?'s':'')+'"><circle cx="50" cy="50" r="47" fill="'+t[1]+'"/><circle cx="50" cy="50" r="40" fill="'+t[0]+'" stroke="'+t[1]+'" stroke-width="3" stroke-dasharray="4 4"/><text x="50" y="47" text-anchor="middle" font-size="30">'+P[p]+'</text><text x="50" y="80" text-anchor="middle" font-size="22" font-weight="800" fill="'+t[2]+'" font-family="Arial">'+v+'</text></svg>'}
function chips(){var vg=co.querySelector('[data-g=val]'),pg=co.querySelector('[data-g=pic]');vg.innerHTML='';pg.innerHTML='';V.forEach(function(v){var b=document.createElement('button');b.type='button';b.className='mvp-pick'+(cs.v===v?' on':'');b.style.fontSize='16px';b.style.fontWeight='800';b.textContent=v;b.title=v+' coin'+(v>1?'s':'');b.onclick=function(){cs.v=v;upd()};vg.appendChild(b)});P.forEach(function(p,n){var b=document.createElement('button');b.type='button';b.className='mvp-pick'+(cs.p===n?' on':'');b.textContent=p;b.onclick=function(){cs.p=n;upd()};pg.appendChild(b)})}
function upd(){M.ls('mvCoins',cs);chips();var pv=co.querySelector('.prev');pv.innerHTML=coinSVG(cs.v,cs.p,120);M.pop(pv);co.querySelector('.mine').textContent=cs.list.length?'My sheet: '+cs.list.length+' coin design'+(cs.list.length>1?'s':'')+' added. They print 4 times each.':'Design a coin, then add it to your sheet.'}
upd();
co.querySelector('[data-a=add]').onclick=function(){if(cs.list.length>=8)cs.list.shift();cs.list.push([cs.v,cs.p]);upd();M.conf()};
co.querySelector('[data-a=print]').onclick=function(){var l=cs.list.length?cs.list:[[1,0],[2,1],[5,2],[10,3]],h='';for(var r=0;r<30;r++){var c=l[r%l.length];h+='<div>'+coinSVG(c[0],c[1],'100%')+'</div>'}var w=window.open('','_blank');if(!w)return;w.document.write('<!doctype html><title>My coin sheet · MoneyViel Kids</title><style>@page{size:A4;margin:10mm}body{font-family:Arial;margin:0}h1{font-size:20px;text-align:center;margin:0 0 6px}.g{display:grid;grid-template-columns:repeat(5,1fr);gap:6mm}.g div{border:1px dashed #aaa;border-radius:50%;padding:1mm}p{text-align:center;font-size:11px;color:#666}</style><h1>🪙 My coin sheet: cut along the dotted circles</h1><div class="g">'+h+'</div><p>Pretend coins for shop games and counting practice. MoneyViel Kids · moneyviel.com/kids</p><script>setTimeout(function(){print()},400)<\/script>');w.document.close()};
var round=0,cstars=0,gw=co.querySelector('.game'),aw=co.querySelector('.ans'),msg=co.querySelector('.msg'),cst=co.querySelector('.cstar');
function game(){if(round>=5){gw.innerHTML='<span style="font-size:40px">🏆</span>';aw.innerHTML='';msg.textContent='Super counting! '+cstars+' ⭐ out of 5. Tap Play again for new coins.';var b=document.createElement('button');b.type='button';b.className='mvp-b gh';b.textContent='🔁 Play again';b.onclick=function(){round=0;cstars=0;game()};aw.appendChild(b);if(cstars>=4)M.conf();return}
var n=2+Math.min(round,3)+Math.floor(Math.random()*2),tot=0,h='';for(var k=0;k<n;k++){var v=V[Math.floor(Math.random()*(round<2?2:4))];tot+=v;h+=coinSVG(v,Math.floor(Math.random()*P.length),46)}gw.innerHTML=h;M.pop(gw);
var opts=[tot];while(opts.length<3){var o=tot+[-3,-2,-1,1,2,3,5][Math.floor(Math.random()*7)];if(o>0&&opts.indexOf(o)<0)opts.push(o)}opts.sort(function(a,b){return a-b});aw.innerHTML='';msg.textContent='Round '+(round+1)+' of 5: how many coins in total?';
var first=true;opts.forEach(function(o){var b=document.createElement('button');b.type='button';b.className='mvp-b gh';b.textContent=o+' coins';b.onclick=function(){if(o===tot){if(first)cstars++;msg.textContent='Yes! '+tot+' coins. 🎉';round++;cst.textContent='⭐'.repeat(cstars);setTimeout(game,800)}else{first=false;b.classList.add('mvp-shake');msg.textContent='Try again! Count the big coins first, then add the small ones.'}};aw.appendChild(b)})}
game();
})();
</script>
	<?php
	return ob_get_clean();
} );

/* ======================= MONEY CHECK-UP (Start Here) ======================= */
add_shortcode( 'mv_checkup', function () {
	ob_start();
	echo mvp_css() . mvp_js_helpers(); ?>
<div class="mvp mvp-ck" id="mvp-ck"><div class="mvp-card"></div></div>
<script>
(function(){
var M=window.MVP,root=document.querySelector('#mvp-ck .mvp-card');
var Q=[
{q:'Pay day! What happens to your money first?',o:[['💚','I save a fixed part straight away',2],['🧾','I pay bills, then save what is left',1],['🛍️','I spend, and see what is left at the end',0]],tip:['🐷','Pay yourself first','Start a tiny automatic saving habit with the 52-Week Challenge','/money-tools/52-week-challenge/']},
{q:'If your income stopped tomorrow, how long could you manage?',o:[['🛟','3 months or more',2],['⏳','About 1 month',1],['😬','Less than a month',0]],tip:['🛟','Build your safety net','Find your emergency fund target in 1 minute','/money-tools/emergency-fund-calculator/']},
{q:'How do you handle credit card bills?',o:[['✅','I pay the full amount every month (or I have no card)',2],['🤏','Sometimes I pay only the minimum',0],['🔁','I usually carry a balance',0]],tip:['💳','Escape the minimum-due trap','See how long "minimum only" really takes','/money-tools/minimum-due-calculator/']},
{q:'Do you know where your money went last month?',o:[['📊','Yes, I track it',2],['🤔','Roughly',1],['🙈','No idea',0]],tip:['📒','Take control of spending','Play Budget Boss: plan a month in 3 minutes','/money-tools/budget-boss/']},
{q:'Your biggest goal (home, studies, a trip, retirement)...',o:[['🎯','Has a plan and a monthly amount',2],['💭','I am thinking about it',1],['🤷','I have not started',0]],tip:['🎯','Turn dreams into a plan','Use the Life Goals Planner','/money-tools/goal-planner/']}
];
var LV=[[0,'🌱','Money Seedling','Every expert started here. Small steps from today will change everything.'],[40,'🌿','Money Sprout','You have good habits growing. Fix one weak spot and you will level up fast.'],[70,'🌳','Money Tree','Strong roots! A couple of tweaks and you will be a Wise Owl.'],[90,'🦉','Wise Owl','Outstanding. Keep it up and help someone you love do the same.']];
var a=[],k=0,last=M.ls('mvCheckup');
function start(){var h='<span class="mvp-tag">🩺 60-second Money Check-up</span><div class="mvp-q" style="font-size:1.6em">How healthy is your money?</div><p>5 quick taps. Get your score, your money level and your top next steps. No sign-up, nothing to type.</p>';if(last)h+='<div class="mvp-say"><b>'+LV.filter(function(l){return last.s>=l[0]}).pop()[1]+'</b><span>Last time you scored <b>'+last.s+'</b>. Can you beat it today?</span></div>';h+='<div class="mvp-row"><button type="button" class="mvp-b pk" style="font-size:17px;padding:14px 26px">▶ Start my check-up</button></div>';root.innerHTML=h;root.querySelector('button').onclick=function(){a=[];k=0;ask()}}
function ask(){var q=Q[k];var h='<div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;color:#6b6488"><span>Question '+(k+1)+' of '+Q.length+'</span><span>'+['🔥','💪','🚀','⭐','🏁'][k]+'</span></div><div class="mvp-bar"><i style="width:'+(k/Q.length*100)+'%"></i></div><div class="mvp-q">'+q.q+'</div>';q.o.forEach(function(o,n){h+='<button type="button" class="mvp-opt" data-n="'+n+'"><span>'+o[0]+'</span>'+o[1]+'</button>'});root.innerHTML=h;M.pop(root);setTimeout(function(){var i=root.querySelector('.mvp-bar i');if(i)i.style.width=((k+1)/Q.length*100)+'%'},50);[].forEach.call(root.querySelectorAll('.mvp-opt'),function(b){b.onclick=function(){a[k]=q.o[+b.dataset.n][2];k++;if(k<Q.length)ask();else done()}})}
function done(){var s=Math.round(a.reduce(function(x,y){return x+y},0)/(Q.length*2)*100),lv=LV.filter(function(l){return s>=l[0]}).pop(),prev=last&&last.s;last={s:s,d:Date.now()};M.ls('mvCheckup',last);
var weak=Q.map(function(q,n){return [a[n],q.tip]}).filter(function(x){return x[0]<2}).sort(function(x,y){return x[0]-y[0]}).slice(0,3).map(function(x){return x[1]});
if(!weak.length)weak=[['💡','Test your money brain','Take the Financial IQ Test','/money-tools/financial-iq-test/'],['🎮','Live a whole life in 5 minutes','Try the Life Simulator','/money-tools/life-simulator/'],['🌴','Plan your freedom','Retirement Planner','/money-tools/retirement-planner/']];
var C=2*Math.PI*70;var h='<div style="text-align:center"><span class="mvp-tag">Your result</span><div class="mvp-ring"><svg width="170" height="170"><circle cx="85" cy="85" r="70" stroke="#efeaff" stroke-width="16" fill="none"/><circle class="arc" cx="85" cy="85" r="70" stroke="url(#mvpg)" stroke-width="16" fill="none" stroke-linecap="round" stroke-dasharray="'+C+'" stroke-dashoffset="'+C+'" style="transition:stroke-dashoffset 1.2s"/><defs><linearGradient id="mvpg"><stop offset="0" stop-color="#5b3fd6"/><stop offset="1" stop-color="#e8457a"/></linearGradient></defs></svg><b><span class="num">0</span><small>out of 100</small></b></div><div style="font-size:44px">'+lv[1]+'</div><div class="mvp-q" style="margin:0">You are a '+lv[2]+'!</div><p style="margin:6px 0 0">'+lv[3]+'</p>'+(prev!=null&&prev!==undefined&&prev!==s?'<p class="mvp-small">'+(s>prev?'📈 Up '+(s-prev)+' points from last time. Brilliant!':'Last time: '+prev+'. You can bounce back!')+'</p>':'')+'</div><h3 style="margin:18px 0 6px">Your top next steps</h3>';
weak.forEach(function(t){h+='<a class="mvp-step" href="'+t[3]+'"><span>'+t[0]+'</span><div><b>'+t[1]+'</b><br><small>'+t[2]+' →</small></div></a>'});
h+='<div class="mvp-say"><b>🦉</b><span>Come back tomorrow: there is a new <b>Daily Money Challenge</b> and a question from Mr. Hoot on the <a href="/">home page</a>. Build your streak! 🔥</span></div><div class="mvp-row" style="justify-content:center"><button type="button" class="mvp-b gh" data-a="again">🔁 Retake</button><button type="button" class="mvp-b" data-a="share">📣 Challenge a friend</button></div>';
root.innerHTML=h;M.pop(root);setTimeout(function(){root.querySelector('.arc').style.strokeDashoffset=C*(1-s/100)},60);var n=root.querySelector('.num'),c=0,t=setInterval(function(){c=Math.min(s,c+2);n.textContent=c;if(c>=s)clearInterval(t)},20);if(s>=70)setTimeout(M.conf,900);
root.querySelector('[data-a=again]').onclick=function(){a=[];k=0;ask()};
root.querySelector('[data-a=share]').onclick=function(){var txt='I scored '+s+'/100 on the MoneyViel 60-second Money Check-up ('+lv[2]+' '+lv[1]+'). Can you beat me?',u='https://moneyviel.com/start-here/';if(navigator.share){navigator.share({title:'Money Check-up',text:txt,url:u}).catch(function(){})}else{try{navigator.clipboard.writeText(txt+' '+u);this.textContent='✅ Copied! Paste it to a friend'}catch(e){}}}}
start();
})();
</script>
	<?php
	return ob_get_clean();
} );

/* ======================= DAILY HOOKS (homepage) ======================= */
add_shortcode( 'mv_daily', function () {
	ob_start();
	echo mvp_css() . mvp_js_helpers(); ?>
<div class="mvp mvp-daily" id="mvp-daily">
 <div class="mvp-card" id="mvp-ch"></div>
 <div class="mvp-card" id="mvp-hoot"></div>
 <div class="mvp-card" style="padding:12px" id="mvp-word"></div>
</div>
<script>
(function(){
var M=window.MVP,D=M.day();
var CH=[['📝','Write down every single thing you spend today, even small ones.'],['📭','Unsubscribe from 3 shopping or sale emails.'],['🚫','Make today a no-spend day: buy only true needs.'],['🔍','List every subscription you pay for. Is there one you no longer use?'],['🐷','Move a small amount, any amount, into savings today.'],['⏳','Before any non-essential buy today, wait 24 hours.'],['🍱','Eat a meal from home instead of ordering in.'],['📅','Find your credit card or loan due dates and set phone reminders.'],['🎯','Write one money goal with a target date.'],['📦','Sell or give away one thing you no longer use.'],['⚖️','While shopping, compare price per kg or per litre, not the pack price.'],['🗣️','Talk about money with your family for 5 minutes tonight.'],['🛡️','Check that the nominee is up to date on one account or policy.'],['🔁','Set up an automatic transfer to savings for your next payday.'],['📊','Find your top 3 spending categories from last month.'],['💳','Delete saved card details from one shopping app.'],['🧾','Add up your must-pay monthly costs: rent, bills, loans, school.'],['📖','Read one MoneyViel article and try its tip.'],['🎮','Play the Budget Boss game once.'],['🙏','Write 3 things that made you happy today that cost nothing.'],['🧮','Do a rough net worth: what you own minus what you owe.'],['📞','Call or check one bill (phone, internet, insurance) for a cheaper plan.'],['🛒','Go shopping with a list and buy only what is on it.'],['💡','Switch off lights and plugs you are not using today.'],['🎁','Plan your next festival or birthday spend before it arrives.'],['🧒','Teach a child one money word today, like "save" or "budget".'],['🏦','Check your bank statement for any charge you do not recognise.'],['☕','Make your tea or coffee at home today and note what you saved.'],['🚶','Walk or take public transport for one short trip.'],['🌱','Learn one new money word on MoneyViel.']];
var HQ=[['If prices rise 6% in a year and your savings earn 4%, your money can buy...',['More than before','The same as before','Less than before'],2,'Prices grew faster than your money, so it buys a little less. This is why beating inflation matters.'],['Paying only the minimum due on a credit card means...',['The debt is cleared soon','Interest keeps growing on the rest','The bank forgives the rest'],1,'Interest is charged on what you do not pay, so the debt can last for years.'],['An emergency fund is best kept...',['Somewhere safe and easy to reach','In shares that can go up','Lent to a friend'],0,'Emergencies need money you can reach quickly without risk of loss.'],['"Pay yourself first" means...',['Buy a treat on payday','Save before you spend','Pay all bills first'],1,'Saving first, even a little, builds the habit before the money disappears.'],['Compound interest is...',['Interest on interest','A bank fee','Interest only on what you put in'],0,'Your interest starts earning interest too, so growth speeds up over time.'],['Net worth is...',['Your monthly salary','What you own minus what you owe','Money in your wallet'],1,'Assets minus debts: the clearest picture of your money health.'],['Which usually costs MORE in interest?',['A home loan','Unpaid credit card debt','A savings account'],1,'Credit card interest is among the most expensive kinds of borrowing.'],['A budget is mainly a...',['Plan for where money will go','Punishment','Bank account'],0,'A budget simply tells your money where to go before it leaves.'],['Diversification means...',['Putting all money in one place','Spreading money across different things','Only saving cash'],1,'Spreading money lowers the damage if one thing does badly.'],['The "Rule of 72" helps you guess...',['Your tax','How long money takes to double','Your credit score'],1,'72 divided by the yearly growth rate ≈ years to double. At 8%, about 9 years.'],['Before a big purchase, a smart habit is to...',['Buy it fast before it sells out','Wait a day and compare','Borrow for it'],1,'A short pause beats impulse buying and helps you compare prices.'],['An EMI is...',['A fixed monthly loan repayment','A savings scheme','A type of tax'],0,'An Equated Monthly Instalment repays a loan in equal monthly parts.'],['Which is a NEED?',['Latest phone upgrade','Rent or housing','Weekend shopping'],1,'Needs keep you safe and running; wants are nice extras.'],['A "sinking fund" is...',['Money saved bit by bit for a known future cost','A failing investment','A loan'],0,'Saving small amounts for things like festivals or fees avoids a big shock later.'],['If an offer promises "guaranteed huge returns, fast"...',['Invest quickly','It is a common sign of a scam','Tell everyone'],1,'Guaranteed high returns are a classic scam warning. Check before you trust.'],['Your credit score mostly shows...',['How rich you are','How reliably you repay borrowing','Your salary'],1,'It reflects your repayment track record, which lenders use to judge you.'],['Insurance is mainly for...',['Getting rich','Protecting against big losses','Saving tax only'],1,'Insurance shares the cost of big, unlucky events so one shock does not ruin you.'],['Which helps savings grow the most over time?',['Starting early','Starting late with more','Waiting for the perfect time'],0,'Time is compounding\'s best friend: starting early often beats saving more later.'],['A good first money goal is usually...',['A small emergency fund','A luxury car','A big gadget on loan'],0,'A safety net first makes every other goal easier and less stressful.'],['Impulse buying is...',['Planned shopping','Buying on a sudden urge','Buying in bulk'],1,'Unplanned urges add up. A list and a pause are great defences.'],['Inflation means...',['Prices generally rising over time','Your salary rising','Interest falling'],0,'When prices rise, the same money buys less, so money kept idle loses value.'],['Debt "avalanche" pays first the debt with...',['The smallest balance','The highest interest rate','The newest date'],1,'Highest-interest first saves the most money overall.'],['Debt "snowball" pays first the debt with...',['The smallest balance','The highest interest rate','The biggest balance'],0,'Clearing small debts first gives quick wins that keep you motivated.'],['Fixed expenses are costs that...',['Change every month','Stay about the same each month','Never need paying'],1,'Rent, loan EMIs and subscriptions are typical fixed costs.'],['Opportunity cost is...',['The price tag','What you give up when you choose something','A discount'],1,'Every choice means giving up the next best option. Smart spenders think about it.'],['To avoid most fees and interest on a card...',['Pay the full bill by the due date','Pay the minimum','Pay after the due date'],0,'Paying in full and on time usually avoids interest and late fees.'],['A savings rate of 20% means...',['You spend 20%','You keep 20% of your income','You pay 20% tax'],1,'Saving a fifth of income is a strong long-term habit.'],['Liquidity means how quickly something can be...',['Turned into cash without big loss','Grown','Insured'],0,'Cash is most liquid; a house is not. Emergencies need liquid money.'],['Which is usually the safest place for money you need next month?',['A savings account','Shares','Crypto'],0,'Money needed soon should not be exposed to big ups and downs.'],['Talking about money with family is...',['Rude','A healthy habit that avoids surprises','Only for adults with debt'],1,'Open money talk builds teamwork and teaches children good habits.']];
var W=[['Budget','A plan for where your money will go each month.','Mira plans her pay: bills, savings, then fun money.'],['Interest','The cost of borrowing money, or the reward for saving it.','A loan charges interest; a savings account pays it.'],['Compound interest','Interest that earns interest too.','Savings grow faster each year as interest piles on interest.'],['Inflation','Prices rising over time, so money buys less.','A snack that cost 10 last year costs 11 now.'],['Emergency fund','Money kept aside for surprises, like a job loss or repair.','3 to 6 months of must-pay costs is a common target.'],['Net worth','What you own minus what you owe.','Savings + gold + home value − loans.'],['Asset','Something you own that has value.','Savings, a house or shares.'],['Liability','Money you owe.','A loan or credit card balance.'],['Credit score','A number that shows how reliably you repay borrowing.','Paying on time helps it grow.'],['EMI','A fixed monthly loan repayment.','A bike loan paid in 24 equal parts.'],['Minimum due','The smallest amount you must pay on a card bill.','Paying only this keeps interest growing.'],['Diversification','Spreading money across different things.','Not putting all your eggs in one basket.'],['Index fund','A fund that follows a whole market index.','One fund, many companies at once.'],['SIP','Investing a fixed amount regularly, usually monthly.','A small amount every month, automatically.'],['Liquidity','How quickly you can turn something into cash.','Cash is liquid; a house is not.'],['Premium','The amount you pay for insurance.','A yearly health insurance payment.'],['Principal','The original amount borrowed or invested.','Interest is worked out on the principal.'],['Savings rate','The share of income you save.','Save 20 out of 100 = a 20% savings rate.'],['Pay yourself first','Save first, then spend what is left.','Saving moves on payday, automatically.'],['Opportunity cost','What you give up when you choose something.','Choosing a new phone may mean a smaller trip.'],['Sinking fund','Saving bit by bit for a known future cost.','A little each month for festival gifts.'],['Rule of 72','72 ÷ yearly growth % ≈ years to double money.','At 8% a year, about 9 years.'],['Debt snowball','Paying off the smallest debt first for quick wins.','Clear the tiny loan, then roll that money on.'],['Debt avalanche','Paying off the highest-interest debt first.','It usually saves the most interest.'],['Fixed expense','A cost that stays about the same each month.','Rent or an EMI.'],['Variable expense','A cost that changes month to month.','Groceries, fuel, eating out.'],['Impulse buy','Buying on a sudden urge, without a plan.','The snack by the checkout counter.'],['Net pay','Pay you actually receive after deductions.','Salary minus tax and other cuts.'],['Scam','A trick to take your money or details.','"Guaranteed huge returns" is a red flag.'],['Nominee','The person who receives your money or policy if something happens to you.','Keep nominees up to date on every account.']];
/* Challenge + streak */
var ch=CH[D%CH.length],chb=document.getElementById('mvp-ch'),sk=M.ls('mvStreak')||{n:0,last:-9,best:0};if(sk.last<D-1)sk.n=0;
function rch(){var done=sk.last===D,n=sk.last>=D-1?sk.n:0;chb.innerHTML='<span class="mvp-tag">🔥 Daily Money Challenge</span><div style="display:flex;gap:12px;align-items:center;margin:4px 0 10px"><div class="mvp-fire">'+(n>0?'🔥':'🪵')+'</div><div><b style="font-size:22px">'+n+'-day streak</b><br><small style="color:#6b6488">Best: '+Math.max(sk.best,n)+' days</small></div></div><div class="mvp-say" style="background:#f3efff"><b>'+ch[0]+'</b><span>'+ch[1]+'</span></div><div class="mvp-row">'+(done?'<span class="mvp-b gn">✅ Done for today! See you tomorrow</span>':'<button type="button" class="mvp-b pk">✅ I did it!</button>')+'</div><p class="mvp-small">'+(n>=30?'🏆 30-day legend!':n>=7?'🥇 7-day champion! Keep going for 30.':n>=3?'🥈 3 days strong! Next badge at 7.':'Do it 3 days in a row to earn your first badge.')+'</p>';var b=chb.querySelector('button');if(b)b.onclick=function(){sk.n=(sk.last===D-1?sk.n:0)+1;sk.last=D;sk.best=Math.max(sk.best,sk.n);M.ls('mvStreak',sk);M.conf();rch();M.pop(chb)}}
rch();
/* Mr. Hoot question */
var hq=HQ[D%HQ.length],hb=document.getElementById('mvp-hoot'),my=(M.ls('mvHoot')||{})[D];
function bars(cnt){var t=cnt.reduce(function(a,b){return a+b},0),h='<div class="mvp-res">';hq[1].forEach(function(o,n){var p=t?Math.round(cnt[n]/t*100):0;h+='<div class="'+(n===hq[2]?'ok':'')+'"><div><span>'+(n===hq[2]?'✅ ':'')+M.esc(o)+(n===my?' (you)':'')+'</span><span>'+p+'%</span></div><div class="bar"><i style="width:0" data-w="'+p+'"></i></div></div>'});h+='</div><p class="mvp-small">'+(t>=5?t+' people answered today. ':'You are one of the first to answer today! ')+'</p>';return h}
function rh(cnt){var h='<span class="mvp-tag">🦉 Mr. Hoot asks</span><div style="font-weight:800;font-size:17px;line-height:1.35;margin:4px 0 10px">'+M.esc(hq[0])+'</div>';if(my===undefined){hq[1].forEach(function(o,n){h+='<button type="button" class="mvp-opt" data-n="'+n+'" style="padding:10px 12px;font-size:15px"><span style="font-size:14px;font-weight:800;width:26px;height:26px;border-radius:50%;background:#f3efff;color:#5b3fd6;display:inline-flex;align-items:center;justify-content:center;flex:none">'+'ABC'[n]+'</span>'+M.esc(o)+'</button>'})}else{h+='<div class="mvp-say" style="background:'+(my===hq[2]?'#e6f6ea':'#fff8e6')+'"><b>'+(my===hq[2]?'🎉':'🦉')+'</b><span>'+(my===hq[2]?'<b>Correct!</b> ':'<b>Good try!</b> ')+M.esc(hq[3])+'</span></div>'+bars(cnt||[0,0,0])+'<p class="mvp-small">New question tomorrow. 🦉</p>'}hb.innerHTML=h;setTimeout(function(){[].forEach.call(hb.querySelectorAll('[data-w]'),function(i){i.style.width=i.dataset.w+'%'})},60);
[].forEach.call(hb.querySelectorAll('.mvp-opt'),function(b){b.onclick=function(){my=+b.dataset.n;var s=M.ls('mvHoot')||{};s[D]=my;var keep={};Object.keys(s).slice(-20).forEach(function(k){keep[k]=s[k]});M.ls('mvHoot',keep);if(my===hq[2])M.conf();fetch('/wp-json/mv-play/v1/hoot',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({day:D,pick:my})}).then(function(r){return r.json()}).then(function(j){rh(j.counts)}).catch(function(){var c=[0,0,0];c[my]=1;rh(c)});rh([0,0,0])}})}
if(my===undefined)rh();else fetch('/wp-json/mv-play/v1/hoot?day='+D).then(function(r){return r.json()}).then(function(j){rh(j.counts)}).catch(function(){rh([0,0,0])});
/* Word flip */
var w=W[D%W.length],wb=document.getElementById('mvp-word');wb.innerHTML='<div class="mvp-flip" role="button" tabindex="0" aria-label="Money word of the day, tap to flip"><div class="in"><div class="fr"><span class="mvp-tag" style="background:rgba(255,255,255,.2);color:#fff;align-self:center">📖 Money Word of the Day</span><div style="font-size:30px;font-weight:800;margin:10px 0">'+M.esc(w[0])+'</div><small style="opacity:.9">Do you know what it means? Tap to flip 🔄</small></div><div class="bk"><b style="font-size:18px">'+M.esc(w[0])+'</b><p style="margin:6px 0">'+M.esc(w[1])+'</p><p style="margin:0;color:#6b6488"><i>Example:</i> '+M.esc(w[2])+'</p><a href="/money-words/" style="margin-top:8px;font-weight:700;color:#5b3fd6">More money words →</a></div></div></div>';
var fl=wb.querySelector('.mvp-flip');function flip(e){if(e.target.closest('a'))return;fl.classList.toggle('on')}fl.addEventListener('click',flip);fl.addEventListener('keydown',function(e){if(e.key==='Enter'||e.key===' '){e.preventDefault();flip(e)}});
})();
</script>
	<?php
	return ob_get_clean();
} );
