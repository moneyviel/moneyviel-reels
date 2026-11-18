// node feature.js N  -> upload/kids/mvk-epNNN-feature.jpg (1200x675): title left, two frames right
const { chromium } = require('playwright'); const { execSync } = require('child_process'); const path=require('path');
(async()=>{const n=+process.argv[2];const f=`episodes/ep${String(n).padStart(3,'0')}.js`;
const b=await chromium.launch();const p=await b.newPage({viewport:{width:1080,height:1920}});
await p.goto('file://'+__dirname+'/engine.html');await p.addScriptTag({path:path.resolve(f)});await p.evaluate(()=>document.fonts.ready);
const info=await p.evaluate(()=>{const sc=EP.scenes;const sp=EP.spec;let gi=sp.beats.findIndex(x=>x.k==='guess');if(gi<0)gi=sp.beats.findIndex(x=>x.k==='sort');const si=sp.beats.findIndex(x=>x.k==='say');return {title:EP.title,t1:sc[si].t1-0.2,t2:sc[gi].t1-0.3};});
for(const [i,t] of [[1,info.t1],[2,info.t2]]){await p.evaluate(t=>render(t),t);await p.screenshot({path:`/tmp/feat${i}.jpg`,type:'jpeg',quality:85});}
await b.close();
const out=path.resolve(__dirname,'../../upload/kids/'+`mvk-ep${String(n).padStart(3,'0')}-feature.jpg`);
execSync(`python3 ${__dirname}/feature.py "${info.title.replace(/"/g,'\\"')}" ${n} ${out}`,{stdio:'inherit'});console.log(out);})();
