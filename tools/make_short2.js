// make_short2.js — "Can YOU?" interactive Shorts engine (RUNBOOK section 0m). 1080x1920, silent webm + events.json.
// usage: node make_short2.js spec.json outdir            -> records video (prints {"src":...,"total":...})
//        node make_short2.js spec.json outdir --snap      -> no video; saves PNG frames at key moments to outdir/snap_*.png
// spec = item.short from batch items.json (format, label, hook{text,emoji}, promise, scenes[], end{lines[],cta})
// scene types: question, spot, guess, thisorthat, chat, rate. All numbers come precomputed in the spec.
const {chromium}=require('playwright');const fs=require('fs');const path=require('path');
const spec=JSON.parse(fs.readFileSync(process.argv[2],'utf8'));const outDir=process.argv[3]||'/tmp/s2';const SNAP=process.argv.includes('--snap');
const esc=s=>String(s==null?'':s).replace(/&/g,'&amp;').replace(/</g,'&lt;');
const words=s=>String(s||'').trim().split(/\s+/).filter(Boolean).length;
const readT=s=>words(s)/2.5+1.5;
const logo='data:image/png;base64,'+fs.readFileSync(path.join(__dirname,'longform/logo_light.png')).toString('base64');
const L='ABCD';
const scored=spec.scenes.filter(s=>s.type!=='rate').length;
const html=`<!doctype html><meta charset=utf-8><style>
@font-face{font-family:P;src:url(file://${__dirname}/longform/Poppins-Bold.ttf);font-weight:700}
@font-face{font-family:P;src:url(file://${__dirname}/longform/Poppins-Medium.ttf);font-weight:500}
html{zoom:2}html,body{margin:0;width:540px;height:960px;overflow:hidden;font-family:P,"Noto Color Emoji",sans-serif;font-weight:700;color:#fff}
body{background:#1b1340}
.orb{position:absolute;border-radius:50%;background:radial-gradient(circle,rgba(123,63,160,.35),rgba(123,63,160,0) 70%)}
#top{position:absolute;left:40px;right:90px;top:190px;height:34px;display:flex;align-items:center;justify-content:space-between}
#top img{height:24px}
#pill{background:#2d2266;border:2px solid #ffb020;border-radius:999px;padding:3px 12px;font-size:15px;color:#ffd47a;opacity:0;transition:opacity .4s}
#stage{position:absolute;left:40px;right:90px;top:226px;height:504px}
#foot{position:absolute;left:40px;right:90px;top:734px;font-size:13px;font-weight:500;color:#cfc8f0}
.fx{opacity:0;transform:translateY(14px);transition:opacity .45s,transform .45s}.fx.in{opacity:1;transform:none}
.badge{display:inline-block;background:#ffb020;color:#1b1340;border-radius:999px;padding:4px 14px;font-size:16px;letter-spacing:1.5px}
.big{font-size:40px;line-height:1.15}.mid{font-size:32px;line-height:1.2}.q.gone{display:none}.q{font-size:36px;line-height:1.12;margin-bottom:12px}
.small{font-size:24px;line-height:1.3;font-weight:500;color:#e9e4ff}
.emo{font-size:72px;margin:18px 0 10px}
.card{display:flex;align-items:center;gap:12px;background:#2d2266;border:3px solid #5b4bb0;border-radius:18px;padding:6px 12px;margin-bottom:8px;font-size:32px;line-height:1.05;transition:all .5s}
.card .lt{flex:none;width:40px;height:40px;border-radius:12px;background:#ffb020;color:#1b1340;display:flex;align-items:center;justify-content:center;font-size:28px}
.card .tx{flex:1}.card.sv .tx{font-size:30px}.card.sv .v{font-size:30px}.card .v{flex:none;color:#ffd47a}
.card.ok{background:#14804a;border-color:#3ddc84;transform:scale(1.04)}.card.ok .lt{background:#fff}
.card.no{opacity:.35;filter:grayscale(1)}
.tt{display:block;background:#2d2266;border:3px solid #5b4bb0;border-radius:18px;padding:10px 14px;margin-bottom:12px;transition:all .5s}
.tt .h{font-size:30px;line-height:1.15;display:flex;gap:10px;align-items:center}.tt .ln{font-size:24px;font-weight:500;color:#e9e4ff;line-height:1.3;margin-top:4px}
.tt .res{font-size:28px;color:#ffd47a;margin-top:6px}
.tt.ok{background:#14804a;border-color:#3ddc84;transform:scale(1.03)}.tt.no{opacity:.4;filter:grayscale(1)}
#cd{display:flex;align-items:center;gap:14px;font-size:26px;margin-top:6px}
#ring{width:64px;height:64px;position:relative;flex:none}#ring svg{transform:rotate(-90deg)}#ring b{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:30px;color:#ffb020}
.why{font-size:26px;line-height:1.25;color:#fff;background:#2a1f5c;border-left:6px solid #3ddc84;border-radius:10px;padding:8px 12px;margin-top:8px}
.bub{max-width:330px;border-radius:20px;padding:10px 16px;font-size:28px;line-height:1.2;margin-bottom:12px;font-weight:500}
.bub.them{background:#f2f0fb;color:#1b1340;border-bottom-left-radius:4px}.bub.me{background:#25a35a;margin-left:auto;border-bottom-right-radius:4px}
.phone{font-size:20px;color:#cfc8f0;margin-bottom:12px;font-weight:500}
.yn{float:right;font-size:20px;color:#ffd47a;margin-left:8px}
</style><body>
<div class="orb" style="width:420px;height:420px;left:-160px;top:40px"></div><div class="orb" style="width:360px;height:360px;right:-140px;bottom:60px"></div>
<div id="top"><img src="${logo}"><span id="pill"></span></div>
<div id="stage"></div>
<div id="foot">© MoneyViel · moneyviel.com</div>
<script>
const st=document.getElementById('stage');
function add(h){const d=document.createElement('div');d.className='fx';d.innerHTML=h;st.appendChild(d);requestAnimationFrame(()=>requestAnimationFrame(()=>d.classList.add('in')));return d}
function clear(){st.innerHTML=''}
function pill(t){const p=document.getElementById('pill');p.textContent=t;p.style.opacity=t?1:0}
function ring(n){add('<div id="cd"><div id="ring"><svg width=64 height=64><circle cx=32 cy=32 r=27 stroke="#3b2f7a" stroke-width=7 fill=none /><circle id="rc" cx=32 cy=32 r=27 stroke="#ffb020" stroke-width=7 fill=none stroke-dasharray="170" stroke-dashoffset="0" style="transition:stroke-dashoffset '+n+'s linear"/></svg><b id="rn">'+n+'</b></div><span>Pause and decide 🤔</span></div>');
 requestAnimationFrame(()=>requestAnimationFrame(()=>{document.getElementById('rc').style.strokeDashoffset='170'}))}
function rn(k){const b=document.getElementById('rn');if(b)b.textContent=k}
function dropRing(){const c=document.getElementById('cd');if(c)c.parentNode.remove()}
function reveal(sel,ans){document.querySelectorAll(sel).forEach((c,i)=>c.classList.add(i===ans?'ok':'no'));const c=document.querySelectorAll(sel)[ans];if(c){const lt=c.querySelector('.lt');if(lt)lt.textContent='✅';}}
function count(id,to,prefix){const el=document.getElementById(id);const t0=performance.now();const f=()=>{const p=Math.min(1,(performance.now()-t0)/1400);el.textContent=prefix+Math.round(to*(1-Math.pow(1-p,3))).toLocaleString('en-IN');if(p<1)requestAnimationFrame(f)};f()}
</script></body>`;
// ---------- timeline ----------
const T=[];let t=0;const ev=[];
const step=(js,dur,sfx,snap)=>{T.push({js,dur,sfx,snap});};
const E=JSON.stringify;
// hook
step(`clear();add('<span class="badge">'+${E(esc(spec.label))}+'</span>');add('<div class="emo">'+${E(spec.hook.emoji||'🤔')}+'</div>');add('<div class="big">'+${E(esc(spec.hook.text))}+'</div>')`,Math.max(2.6,readT(spec.hook.text)),'slide','hook');
if(spec.promise)step(`clear();add('<div class="emo">🎯</div>');add('<div class="mid">'+${E(esc(spec.promise))}+'</div>');add('<div class="small" style="margin-top:14px">Play along. Keep your score ✋</div>')`,Math.min(2.6,Math.max(2.2,readT(spec.promise))),'slide','promise');
let qi=0;
function countdown(){step(`ring(5)`,1,'tick');for(let k=4;k>=1;k--)step(`rn(${k})`,1,'tick',k===3?'countdown':null);}
function cardsHtml(opts){return opts.map((o,i)=>`<div class="card${o.v?' sv':''}"><span class="lt">${L[i]}</span><span class="tx">${o.e?o.e+' ':''}${esc(o.t)}</span>${o.v?`<span class="v">${esc(o.v)}</span>`:''}</div>`)}
for(const s of spec.scenes){
  if(s.type!=='rate'){qi++;}
  const P=s.type==='rate'?'':(scored>1?`QUESTION ${qi}/${scored} · KEEP SCORE`:'YOUR TURN');
  if(s.type==='question'||s.type==='spot'||s.type==='guess'||s.type==='chat'){
    if(s.type==='chat'){
      step(`clear();pill(${E(P)});add('<div class="phone">📱 New messages</div>')`,0.8,null);
      for(const b of s.bubbles)step(`add('<div class="bub ${b.from==='me'?'me':'them'}">'+${E(esc(b.t))}+'</div>')`,readT(b.t),'slide','chat');
    }
    let opts=s.options;
    if(s.type==='spot')opts=s.lines.map(l=>({t:l.t,v:l.v}));
    if(s.type==='guess')opts=s.options.map(o=>({t:o,e:'💰'}));
    let head=s.q; if(s.type==='spot'&&s.title)head=s.title+': '+s.q;
    step(`clear();pill(${E(P)});add('<div class="q">'+${E(esc(head))}+'</div>')`,1.4,'slide','q');
    cardsHtml(opts).forEach((c,i)=>step(`add(${E(c.replace(/class="card"/,'class="card" data-k'))});`,0.6,null,i===opts.length-1?'cards':null));
    countdown();
    step(`dropRing();reveal('.card',${s.answer});`+(s.type==='guess'?`(function(){const c=document.querySelectorAll('.card')[${s.answer}].querySelector('.tx');c.innerHTML='💰 <span id="cnt">₹0</span>';count('cnt',${Number(s.value)},${E(s.prefix||'₹')})})();`:''),0.9,'good','reveal');
    step(`(function(){const st=document.getElementById('stage');const lc=st.lastElementChild;const used=lc?lc.offsetTop+lc.offsetHeight:0;if(used>st.clientHeight-120){const q=document.querySelector('.q');if(q)q.parentNode.style.display='none'}})();add('<div class="why">'+${E(esc(s.why))}+'</div>')`,readT(s.why)+0.2,null,'why');
  } else if(s.type==='thisorthat'){
    step(`clear();pill(${E(P)});add('<div class="q">'+${E(esc(s.q))}+'</div>')`,2.0,'slide','q');
    for(const [i,k] of [[0,'a'],[1,'b']]){const o=s[k];
      step(`add(${E(`<div class="tt"><div class="h"><span class="lt" style="flex:none;width:40px;height:40px;border-radius:10px;background:#ffb020;color:#1b1340;display:flex;align-items:center;justify-content:center;font-size:26px">${L[i]}</span>${o.e||''} ${esc(o.title)}</div>${(o.lines||[]).slice(0,1).map(x=>`<div class="ln">• ${esc(x)}</div>`).join('')}<div class="res" id="res${i}">= ?</div></div>`)})`,Math.max(1.6,words(o.title+' '+(o.lines||[]).join(' '))/3.5),null,i?'cards':null);}
    countdown();
    const ai=s.answer==='a'?0:1;
    step(`dropRing();document.getElementById('res0').textContent='= '+${E(s.a.result)};document.getElementById('res1').textContent='= '+${E(s.b.result)};reveal('.tt',${ai});`,1.2,'good','reveal');
    step(`(function(){const st=document.getElementById('stage');const lc=st.lastElementChild;const used=lc?lc.offsetTop+lc.offsetHeight:0;if(used>st.clientHeight-120){const q=document.querySelector('.q');if(q)q.parentNode.style.display='none'}})();add('<div class="why">'+${E(esc(s.why))}+'</div>')`,readT(s.why)+0.8,null,'why');
  } else if(s.type==='rate'){
    step(`clear();pill('COUNT YOUR YESES');add('<div class="q">Be honest: do YOU do this? ✋</div>')`,2.2,'slide','q');
    s.items.forEach((it,i)=>step(`add(${E(`<div class="card"><span class="lt">${i+1}</span><span class="tx">${esc(it)}</span></div>`)})`,readT(it)+0.8,'tick',i===3?'cards':null));
    step(`clear();add('<div class="q">Count YOUR yeses 🖐️</div>')`,2.0,'slide');
    s.meaning.forEach((m,i)=>step(`add('<div class="card"><span class="tx" style="font-size:30px">'+${E(esc(m))}+'</span></div>')`,readT(m),i===0?'good':null,i===s.meaning.length-1?'why':null));
  }
}
// end
step(`clear();pill('');add('<div class="emo">🏆</div>')`,0.6,'level');
spec.end.lines.forEach((l,i)=>step(`add('<div class="mid" style="margin-bottom:14px">'+${E(esc(l))}+'</div>')`,1.1,null));
step(`add('<div class="badge" style="font-size:22px;padding:8px 18px;margin-top:10px">'+${E(esc(spec.end.cta))}+'</div>')`,3.2,null,'end');
step(`clear();add('<span class="badge">'+${E(esc(spec.label))}+'</span>');add('<div class="emo">'+${E(spec.hook.emoji||'🤔')}+'</div>');add('<div class="big">'+${E(esc(spec.hook.text))}+'</div>')`,0.9,null);
const total=T.reduce((a,b)=>a+b.dur,0);
(async()=>{fs.rmSync(outDir,{recursive:true,force:true});fs.mkdirSync(outDir,{recursive:true});
 const pg=path.join(outDir,'page.html');fs.writeFileSync(pg,html);
 const b=await chromium.launch();
 const ctx=await b.newContext(SNAP?{viewport:{width:1080,height:1920}}:{viewport:{width:1080,height:1920},recordVideo:{dir:outDir,size:{width:1080,height:1920}}});
 const p=await ctx.newPage();await p.goto('file://'+pg);await p.evaluate(()=>document.fonts.ready);await p.waitForTimeout(400);
 const t0=Date.now();const marks=[];let sn=0;const snaps=[];
 for(const s of T){const now=(Date.now()-t0)/1000;if(s.sfx)marks.push([now+0.4,s.sfx]);
  await p.evaluate(s.js);
  if(SNAP&&s.snap){await p.waitForTimeout(700);const f=path.join(outDir,`snap_${String(++sn).padStart(2,'0')}_${s.snap}.png`);await p.screenshot({path:f});snaps.push(f);
    const over=await p.evaluate(()=>{const r=document.getElementById('stage');return r.scrollHeight>r.clientHeight+2});if(over)console.error('OVERFLOW at',s.snap);await p.waitForTimeout(Math.max(0,s.dur*1000-700-150));}
  else await p.waitForTimeout(SNAP?60:s.dur*1000);}
 const v=SNAP?null:p.video();await ctx.close();await b.close();
 const outro=(Date.now()-t0)/1000-3.5;
 fs.writeFileSync(outDir+'/events.json',JSON.stringify({ev:marks,outro}));
 console.log(JSON.stringify({src:v?await v.path():null,total,snaps:snaps.length}));})();
