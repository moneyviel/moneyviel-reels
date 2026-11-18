// usage: node sheet.js episodes/epNNN.js /tmp/sheet.jpg  -> contact sheet: one frame near the end of every beat (+ mid of long beats)
const { chromium } = require('playwright'); const { execSync } = require('child_process');
(async()=>{const [ep,out]=process.argv.slice(2);const b=await chromium.launch();const p=await b.newPage({viewport:{width:1080,height:1920}});
await p.goto('file://'+__dirname+'/engine.html');await p.addScriptTag({path:require('path').resolve(ep)});await p.evaluate(()=>document.fonts.ready);
const sc=await p.evaluate(()=>EP.scenes.map(s=>[s.t0,s.t1]));const dur=await p.evaluate(()=>EP.duration);
const ts=[];sc.forEach(([a,b])=>{if(b-a>7)ts.push(a+(b-a)*0.45);ts.push(b-0.15);});
let i=0;for(const t of ts){await p.evaluate(t=>render(t),t);await p.screenshot({path:`/tmp/sh_${i++}.jpg`,type:'jpeg',quality:60});}
await b.close();
const cols=6,rows=Math.ceil(ts.length/cols);
execSync(`python3 -c "
from PIL import Image,ImageDraw
n=${ts.length};W=Image.new('RGB',(270*${cols},480*${rows}),'white')
ts=${JSON.stringify(ts.map(t=>+t.toFixed(1)))}
for i in range(n):
  im=Image.open('/tmp/sh_%d.jpg'%i).resize((270,480));d=ImageDraw.Draw(im);d.rectangle((0,0,60,22),fill='black');d.text((3,4),str(ts[i]),fill='white');W.paste(im,((i%${cols})*270,(i//${cols})*480))
W.save('${out}')"`);
console.log('duration',dur,'frames',ts.length);})();
