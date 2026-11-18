// node bigtool.js check|sheet|render big/baNNN.js [out]   — Big Adventure tools (16:9)
const { chromium } = require('playwright'); const { execSync } = require('child_process'); const fs = require('fs'); const path = require('path');
(async () => {
  const [mode, ep, out] = process.argv.slice(2);
  const b = await chromium.launch(); const p = await b.newPage({ viewport: { width: 1920, height: 1080 } });
  await p.goto('file://' + __dirname + '/big.html'); await p.addScriptTag({ path: path.resolve(ep) }); await p.evaluate(() => document.fonts.ready);
  const info = await p.evaluate(() => ({ d: EP.duration, stars: EP.stars.length, checks: EP.spec.checks.map(([e, v]) => [e, v, eval(e) === v]), starBeat: (EP.spec.beats.find(x => x.k === 'stars') || {}).total, sc: EP.scenes.map(s => [s.t0, s.t1, s.k]), sfx: EP.sfx, no: EP.no }));
  const bad = info.checks.filter(c => !c[2]); if (bad.length || info.stars !== info.starBeat) { console.log('CHECK FAILED', JSON.stringify(bad), 'stars', info.stars, 'beat says', info.starBeat); process.exit(1); }
  console.log('checks ok · stars', info.stars, '· duration', info.d.toFixed(1), 's');
  if (mode === 'sheet') {
    const ts = []; info.sc.forEach(([a, c]) => { if (c - a > 12) ts.push(a + (c - a) * .4); ts.push(c - .2); });
    let i = 0; for (const t of ts) { await p.evaluate(t => render(t), t); await p.screenshot({ path: `/tmp/bsh_${i++}.jpg`, type: 'jpeg', quality: 55 }); }
    const cols = 4, rows = Math.ceil(ts.length / cols);
    execSync(`python3 -c "
from PIL import Image
n=${ts.length};W=Image.new('RGB',(480*${cols},270*${rows}),'white')
for i in range(n): W.paste(Image.open('/tmp/bsh_%d.jpg'%i).resize((480,270)),((i%${cols})*480,(i//${cols})*270))
W.save('${out}')"`);
  }
  if (mode === 'render') {
    const fps = 24, dir = `/tmp/bframes_${info.no}`; fs.rmSync(dir, { recursive: true, force: true }); fs.mkdirSync(dir);
    const n = Math.round(info.d * fps); for (let i = 0; i < n; i++) { await p.evaluate(t => render(t), i / fps); await p.screenshot({ path: `${dir}/f${String(i).padStart(5, '0')}.jpg`, type: 'jpeg', quality: 86 }); }
    fs.writeFileSync(`/tmp/bev_${info.no}.json`, JSON.stringify({ outro: info.d - 4, ev: info.sfx }));
    execSync(`python3 ${__dirname}/../make_audio.py /tmp/bev_${info.no}.json ${info.d} /tmp/baud_${info.no}.wav ${40 + info.no}`, { stdio: 'inherit' });
    execSync(`ffmpeg -y -loglevel error -framerate ${fps} -i ${dir}/f%05d.jpg -i /tmp/baud_${info.no}.wav -c:v libx264 -preset veryfast -crf 21 -pix_fmt yuv420p -af "loudnorm=I=-14:TP=-1.5:LRA=11" -c:a aac -b:a 160k -shortest -movflags +faststart ${out}`, { stdio: 'inherit' });
    fs.rmSync(dir, { recursive: true, force: true }); console.log('rendered', out);
  }
  await b.close();
})();
