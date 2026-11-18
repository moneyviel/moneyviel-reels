// usage: node render.js episodes/ep001.js out.mp4 [fps]
const { chromium } = require('playwright'); const fs=require('fs'); const {execSync}=require('child_process');
(async()=>{const [ep,out,fpsArg]=process.argv.slice(2);const fps=+(fpsArg||30);const dir='/tmp/kframes';fs.rmSync(dir,{recursive:true,force:true});fs.mkdirSync(dir);
const b=await chromium.launch();const p=await b.newPage({viewport:{width:1080,height:1920}});
await p.goto('file://'+__dirname+'/engine.html');await p.addScriptTag({path:require('path').resolve(ep)});await p.evaluate(()=>document.fonts.ready);
const meta=await p.evaluate(()=>({d:EP.duration,sfx:EP.sfx,outro:EP.outro}));
const n=Math.round(meta.d*fps);for(let i=0;i<n;i++){await p.evaluate(t=>render(t),i/fps);await p.screenshot({path:`${dir}/f${String(i).padStart(5,'0')}.jpg`,type:'jpeg',quality:88});}
await b.close();
fs.writeFileSync('/tmp/kev.json',JSON.stringify({outro:meta.outro,ev:meta.sfx}));
execSync(`python3 ${__dirname}/../make_audio.py /tmp/kev.json ${meta.d} /tmp/kaud.wav 7`,{stdio:'inherit'});
execSync(`ffmpeg -y -loglevel error -framerate ${fps} -i ${dir}/f%05d.jpg -i /tmp/kaud.wav -c:v libx264 -preset veryfast -crf 20 -pix_fmt yuv420p -af "loudnorm=I=-14:TP=-1.5:LRA=11" -c:a aac -b:a 192k -shortest -movflags +faststart ${out}`,{stdio:'inherit'});
console.log('done',n,'frames');})();
