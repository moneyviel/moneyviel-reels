// Records a vertical 9:16 gameplay reel of a MoneyViel arcade game with a robot player.
// usage: node make_reel.js cloud|monster|piggy  out.webm
const {chromium}=require('playwright');const fs=require('fs');const path=require('path');
const game=process.argv[2]||'cloud';const outDir='/tmp/reelrec_'+game;
const path2=require('path');const T=path2.join(__dirname,'games')+'/';
const css=fs.readFileSync(T+'arcade.css','utf8').replace(/"Nunito Sans",/g,'"Nunito Sans",Inter,');
let frag=fs.readFileSync(T+{cloud:'cloud.html',monster:'monster.html',piggy:'piggy.html'}[game],'utf8');
// expose state for the robot player (local copy only)
frag=frag.replace('st={sc:0,lives:3,lv:1','window.__st=st={sc:0,lives:3,lv:1').replace('st={s:0,sc:0','window.__st=st={s:0,sc:0').replace('st={sc:0,lives:3,t:60','window.__st=st={sc:0,lives:3,t:60');
const HOOK={cloud:['Can you answer','before the cloud lands? ☁️'],monster:['Can you defeat','the Debt Monsters? 👾'],piggy:['Catch savings.','Dodge impulse buys! 🐷']}[game];
const html=`<!doctype html><meta charset=utf-8><style>${css}
html{zoom:2}html,body{margin:0;height:100%;background:linear-gradient(160deg,#2b1d5c,#4b2a7a 55%,#e0408f);font-family:Inter,sans-serif;overflow:hidden}
#top{position:absolute;top:26px;left:0;right:0;text-align:center;color:#fff;font-weight:900;font-size:30px;line-height:1.15;text-shadow:0 3px 12px rgba(0,0,0,.35)}
#wrap{position:absolute;top:104px;left:50%;transform:translateX(-50%);width:470px}#wrap .stage{max-height:none}#wrap #mv-dm{max-width:420px}
#wrap .mva{margin:0}#wrap .below,#wrap .snd{display:none}
#bot{position:absolute;bottom:22px;left:0;right:0;text-align:center;color:#fff;font-weight:900;font-size:22px}
#bot span{display:inline-block;background:#fff;color:#e0408f;border-radius:999px;padding:8px 18px;margin-top:6px}
#intro,#outro{position:absolute;inset:0;z-index:99;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;color:#fff;background:linear-gradient(160deg,#2b1d5c,#e0408f);transition:opacity .5s}
#intro h1,#outro h1{font-size:46px;margin:0 30px 14px;line-height:1.1}#outro{opacity:0;pointer-events:none}
#mv-cc .cl{font-size:17px!important}#cc-q{font-size:20px!important}#dm-q{font-size:18px!important}#mv-dm .ab{font-size:16px!important}#mv-pc .it i{font-size:13px!important}
.pill{background:#fff;color:#e0408f;font-weight:900;font-size:26px;border-radius:999px;padding:12px 26px;margin-top:18px}
</style><body>
<div id="top">${HOOK[0]}<br>${HOOK[1]}</div><div id="wrap">${frag}</div>
<div id="bot">Free money games 👇<br><span>moneyviel.com/money-tools</span></div>
<div id="intro"><div style="font-size:90px">🕹️</div><h1>${HOOK[0]}<br>${HOOK[1]}</h1><div style="font-size:24px;opacity:.9">MoneyViel Arcade</div></div>
<div id="outro"><div style="font-size:80px">🏆</div><h1 id="oh">Your turn!</h1><div style="font-size:24px">Can you beat this score?</div><div class="pill">Play free 👉 moneyviel.com</div><div style="margin-top:14px;font-size:20px;opacity:.9">7 free money games · no sign-up</div></div>
</body>`;
fs.writeFileSync('/tmp/reel_'+game+'.html',html);
(async()=>{fs.rmSync(outDir,{recursive:true,force:true});
const b=await chromium.launch();const ctx=await b.newContext({viewport:{width:1080,height:1920},deviceScaleFactor:1,recordVideo:{dir:outDir,size:{width:1080,height:1920}}});
const p=await ctx.newPage();const errs=[];p.on('pageerror',e=>errs.push(e.message));
await p.goto('file:///tmp/reel_'+game+'.html');await p.waitForTimeout(1800);

const W=ms=>p.waitForTimeout(ms);
await p.evaluate(()=>{window.__ev=[];let prev=null;setInterval(()=>{const s=window.__st;if(!s)return;const t=performance.now()/1000;
 const cur={sc:s.sc,lv:(s.lv||s.s||0),hurt:(s.lives!=null?s.lives:-(s.php||0)),hp:s.hp};
 if(prev){if(cur.sc>prev.sc)window.__ev.push([t,'good']);if(cur.hurt<prev.hurt)window.__ev.push([t,'bad']);if(cur.lv>prev.lv)window.__ev.push([t,'level']);}
 prev=cur},40)});

if(game==='cloud'){await p.evaluate(()=>document.getElementById('cc-go').click());await p.waitForTimeout(250);await p.evaluate(()=>{var i=document.getElementById('intro');i.style.opacity=0;i.style.pointerEvents='none'});const end=Date.now()+22000;
 await p.evaluate(()=>{window.__q=0;window.__thr=.45;window.__st.speed=.17});
 while(Date.now()<end){await W(80);
  await p.evaluate(()=>{const s=window.__st;if(!s||!s.alive||s.wait)return;const H=document.getElementById('cc-st').clientHeight;
   const n=window.__q+1;const wrong=(n===4&&!window.__didWrong);
   const c=s.clouds.find(c=>!c.dead&&(wrong?!c.ok:c.ok));if(!c)return;
   if(c.y<H*window.__thr)return;
   const r=c.el.getBoundingClientRect();c.el.dispatchEvent(new PointerEvent('pointerdown',{bubbles:true,clientX:r.left+r.width/2,clientY:r.top+r.height/2}));
   if(wrong){window.__didWrong=1;window.__thr=.55}else{window.__q++;window.__thr=.3+Math.random()*.35}});}
}
if(game==='monster'){await p.evaluate(()=>document.getElementById('dm-go').click());await p.waitForTimeout(250);await p.evaluate(()=>{var i=document.getElementById('intro');i.style.opacity=0;i.style.pointerEvents='none'});const end=Date.now()+24000;let n=0;
 while(Date.now()<end){await W(1300+Math.random()*700);n++;
  await p.evaluate(n=>{const s=window.__st;if(!s||!s.alive)return;const bs=[...document.querySelectorAll('#dm-ops .ab:not([disabled])')];if(!bs.length)return;const q=s.deck[s.qi-1];const right=q[1][q[2]];
   const b=(n===3)?bs.find(x=>x.textContent!==right):bs.find(x=>x.textContent===right);b&&b.click()},n);}
}
if(game==='piggy'){await p.evaluate(()=>document.getElementById('pc-go').click());await p.waitForTimeout(250);await p.evaluate(()=>{var i=document.getElementById('intro');i.style.opacity=0;i.style.pointerEvents='none'});const end=Date.now()+20000;
 while(Date.now()<end){await W(60);
  await p.evaluate(()=>{const s=window.__st;if(!s||!s.alive)return;const S=document.getElementById('pc-st'),r=S.getBoundingClientRect();
   const good=s.items.filter(k=>k.type!=='bad'&&k.y>r.height*.35).sort((a,b)=>b.y-a.y)[0];let tx=good?good.x:0.5;
   const bad=s.items.filter(k=>k.type==='bad'&&k.y>r.height*.6);bad.forEach(k=>{if(Math.abs(k.x-tx)<.15)tx=k.x<.5?k.x+.3:k.x-.3});
   const cur=parseFloat(document.getElementById('pc-pig').style.left)/100||.5;const nx=cur+(tx-cur)*.25;
   S.dispatchEvent(new PointerEvent('pointermove',{bubbles:true,clientX:r.left+nx*r.width,clientY:r.top+r.height*.9}))})}
}
const score=await p.evaluate(()=>{const s=window.__st;return s?s.sc:0});
await p.evaluate(([sc,g])=>{document.getElementById('oh').textContent=g==='piggy'?'Saved ₹'+sc.toLocaleString('en-IN')+'!':sc+' points!';document.getElementById('outro').style.opacity=1},[score,game]);
const evs=await p.evaluate(()=>({ev:window.__ev,outro:performance.now()/1000}));fs.writeFileSync('/tmp/ev_'+game+'.json',JSON.stringify(evs));
await W(3500);const v=p.video();await ctx.close();await b.close();
const src=await v.path();console.log(JSON.stringify({src,score,errs}));})();
