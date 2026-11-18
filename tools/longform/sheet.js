// node sheet.js spec.js out.jpg  -> one frame near the end of every scene + numbers report
const { chromium } = require('playwright'); const { execSync } = require('child_process');
(async()=>{const [spec,out]=process.argv.slice(2);const b=await chromium.launch();const p=await b.newPage({viewport:{width:1920,height:1080}});
await p.goto('file://'+__dirname+'/engine.html');await p.addScriptTag({path:require('path').resolve(spec)});await p.evaluate(()=>document.fonts.ready);
const info=await p.evaluate(()=>({d:V.duration,sc:V.scenes.map(s=>[s.t0,s.t1,s.type]),N:window.N,ch:V.chapterTimes}));
console.log(JSON.stringify(info.N));console.log('duration',info.d,'chapters',JSON.stringify(info.ch));
const ts=info.sc.map(([a,b])=>b-0.2);let i=0;for(const t of ts){await p.evaluate(t=>render(t),t);await p.screenshot({path:`/tmp/lsh_${i++}.jpg`,type:'jpeg',quality:60});}
await b.close();const cols=4,rows=Math.ceil(ts.length/cols);
execSync(`python3 -c "
from PIL import Image
n=${ts.length};W=Image.new('RGB',(480*${cols},270*${rows}),'white')
for i in range(n):
  im=Image.open('/tmp/lsh_%d.jpg'%i).resize((480,270));W.paste(im,((i%${cols})*480,(i//${cols})*270))
W.save('${out}')"`);})();
