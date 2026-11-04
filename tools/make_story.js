// Renders a captioned 9:16 quote / story / tip video (1080x1920) from a JSON spec, silent webm.
// usage: node make_story.js spec.json outdir
// spec: {"kind":"quote|story|tip","label":"MONEY QUOTE","hook":"...","slides":[{"emoji":"💡","text":"...","sub":"..."}],"cta":"..."}
const {chromium}=require('playwright');const fs=require('fs');
const spec=JSON.parse(fs.readFileSync(process.argv[2],'utf8'));const outDir=process.argv[3]||'/tmp/storyrec';
const esc=s=>String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;');
const slides=[{hook:1,emoji:spec.hookEmoji||'💰',text:spec.hook,sub:spec.label}].concat(spec.slides).concat([{cta:1,emoji:'👉',text:spec.cta||'Learn more free at moneyviel.com',sub:'Follow MoneyViel for daily money wisdom'}]);
const dur=slides.map(s=>Math.max(2.6,Math.min(7,1.6+String(s.text).split(/\s+/).length*0.32+(s.sub?0.8:0))));
const theme={quote:['#2b1d5c','#7b3fa0','#e0408f'],story:['#0f5560','#1d7a7a','#6a4fb3'],tip:['#3a1d6e','#e0408f','#ff9f43']}[spec.kind]||['#2b1d5c','#7b3fa0','#e0408f'];
const html=`<!doctype html><meta charset=utf-8><style>
html{zoom:2}html,body{margin:0;width:540px;height:960px;overflow:hidden;font-family:Inter,"Nunito Sans",sans-serif}
#bg{position:absolute;inset:0;background:linear-gradient(160deg,${theme[0]},${theme[1]} 55%,${theme[2]});background-size:200% 200%;animation:bgm 20s ease infinite}
@keyframes bgm{0%{background-position:0 0}50%{background-position:100% 100%}100%{background-position:0 0}}
.orb{position:absolute;border-radius:50%;background:rgba(255,255,255,.08);animation:fl 9s ease-in-out infinite}
@keyframes fl{50%{transform:translateY(-40px) scale(1.08)}}
#brand{position:absolute;top:30px;left:0;right:0;text-align:center;color:#fff;font-weight:900;font-size:26px;letter-spacing:.5px;opacity:.95}
#brand small{display:block;font-size:13px;font-weight:700;opacity:.8;letter-spacing:3px;margin-top:2px}
#bars{position:absolute;top:14px;left:20px;right:20px;display:flex;gap:5px}#bars i{flex:1;height:4px;border-radius:4px;background:rgba(255,255,255,.3);overflow:hidden}#bars i b{display:block;height:100%;width:0;background:#fff}
.sl{position:absolute;left:34px;right:34px;top:50%;transform:translateY(-50%);text-align:center;color:#fff;opacity:0}
.sl.on{animation:inA .6s cubic-bezier(.2,.9,.3,1.2) forwards}.sl.off{animation:outA .4s forwards}
@keyframes inA{from{opacity:0;transform:translateY(-40%) scale(.92)}to{opacity:1;transform:translateY(-50%) scale(1)}}
@keyframes outA{from{opacity:1;transform:translateY(-50%)}to{opacity:0;transform:translateY(-60%)}}
.em{font-size:76px;margin-bottom:14px}
.tx{font-weight:900;font-size:33px;line-height:1.22;text-shadow:0 3px 14px rgba(0,0,0,.25)}
.tx w{display:inline-block;opacity:0;transform:translateY(8px);animation:wd .35s forwards}@keyframes wd{to{opacity:1;transform:none}}
.sb{margin-top:16px;font-size:18px;font-weight:700;opacity:.9;line-height:1.35}
.hook .tx{font-size:38px}.label{display:inline-block;background:#fff;color:${theme[2]};font-weight:900;border-radius:999px;padding:6px 16px;font-size:15px;letter-spacing:2px;margin-bottom:16px}
.cta .tx{font-size:30px}.pill{display:inline-block;background:#fff;color:#e0408f;font-weight:900;border-radius:999px;padding:12px 22px;font-size:22px;margin-top:18px}
#foot{position:absolute;bottom:26px;left:0;right:0;text-align:center;color:#fff;font-weight:800;font-size:16px;opacity:.85}
</style><body><div id="bg"></div>
<div class="orb" style="width:260px;height:260px;left:-80px;top:120px"></div><div class="orb" style="width:200px;height:200px;right:-60px;bottom:160px;animation-delay:-4s"></div>
<div id="bars">${slides.map(()=>'<i><b></b></i>').join('')}</div>
<div id="brand">moneyviel<small>EMPOWERING PROSPERITY</small></div>
${slides.map((s,i)=>`<div class="sl ${s.hook?'hook':''} ${s.cta?'cta':''}" id="s${i}">${s.hook?`<div class="label">${esc(s.sub)}</div>`:''}<div class="em">${s.emoji||''}</div><div class="tx">${esc(s.text).split(' ').map((w,j)=>`<w style="animation-delay:${(j*0.06).toFixed(2)}s">${w}</w>`).join(' ')}</div>${s.cta?`<div class="pill">moneyviel.com</div>`:''}${!s.hook&&s.sub?`<div class="sb">${esc(s.sub)}</div>`:''}</div>`).join('')}
<div id="foot">moneyviel.com</div></body>`;
fs.writeFileSync('/tmp/story_page.html',html);
(async()=>{fs.rmSync(outDir,{recursive:true,force:true});
const b=await chromium.launch();const ctx=await b.newContext({viewport:{width:1080,height:1920},recordVideo:{dir:outDir,size:{width:1080,height:1920}}});
const p=await ctx.newPage();await p.goto('file:///tmp/story_page.html');await p.waitForTimeout(300);
const t0=Date.now();const marks=[];
for(let i=0;i<slides.length;i++){marks.push((Date.now()-t0)/1000+0.3);
 await p.evaluate(([i,d])=>{const prev=document.getElementById('s'+(i-1));if(prev){prev.classList.remove('on');prev.classList.add('off')}document.getElementById('s'+i).classList.add('on');
  const bar=document.querySelectorAll('#bars b')[i];bar.style.transition='width '+d+'s linear';requestAnimationFrame(()=>bar.style.width='100%')},[i,dur[i]]);
 await p.waitForTimeout(dur[i]*1000);}
const v=p.video();await ctx.close();await b.close();
fs.writeFileSync(outDir+'/events.json',JSON.stringify({ev:marks.slice(1,-1).map(t=>[t,'slide']),outro:marks[marks.length-1]}));
console.log(JSON.stringify({src:await v.path(),total:dur.reduce((a,b)=>a+b,0)}));})();
