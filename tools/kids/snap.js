// usage: node snap.js episodes/ep001.js t1 t2 ...  -> /tmp/snap_<t>.jpg
const { chromium } = require('playwright');
(async()=>{const [ep,...ts]=process.argv.slice(2);const b=await chromium.launch();const p=await b.newPage({viewport:{width:1080,height:1920}});
await p.goto('file://'+__dirname+'/engine.html');await p.addScriptTag({path:require('path').resolve(ep)});await p.evaluate(()=>document.fonts.ready);
for(const t of ts){await p.evaluate(t=>render(t),+t);await p.screenshot({path:`/tmp/snap_${t}.jpg`,type:'jpeg',quality:70});}
await b.close();})();
