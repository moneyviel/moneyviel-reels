// usage: node render.js episodes/ep001.js out.mp4 [fps]
const { chromium } = require('playwright'); const fs = require('fs'); const { execSync } = require('child_process'); const path = require('path');
(async () => {
  const [ep, out, fpsArg] = process.argv.slice(2); const fps = +(fpsArg || 30); const tag = path.basename(ep, '.js');
  const dir = `/tmp/kframes_${tag}`; fs.rmSync(dir, { recursive: true, force: true }); fs.mkdirSync(dir);
  const b = await chromium.launch(); const p = await b.newPage({ viewport: { width: 1080, height: 1920 } });
  await p.goto('file://' + __dirname + '/engine.html'); await p.addScriptTag({ path: path.resolve(ep) }); await p.evaluate(() => document.fonts.ready);
  const meta = await p.evaluate(() => ({ d: EP.duration, sfx: EP.sfx, outro: EP.outro, no: EP.no }));
  const n = Math.round(meta.d * fps);
  for (let i = 0; i < n; i++) { await p.evaluate(t => render(t), i / fps); await p.screenshot({ path: `${dir}/f${String(i).padStart(5, '0')}.jpg`, type: 'jpeg', quality: 88 }); }
  await b.close();
  fs.writeFileSync(`/tmp/kev_${tag}.json`, JSON.stringify({ outro: meta.outro, ev: meta.sfx }));
  const seed = meta.no === 1 ? 7 : 7 + meta.no; // ep1 keeps its original music
  execSync(`python3 ${__dirname}/../make_audio.py /tmp/kev_${tag}.json ${meta.d} /tmp/kaud_${tag}.wav ${seed}`, { stdio: 'inherit' });
  execSync(`ffmpeg -y -loglevel error -framerate ${fps} -i ${dir}/f%05d.jpg -i /tmp/kaud_${tag}.wav -c:v libx264 -preset veryfast -crf 20 -pix_fmt yuv420p -af "loudnorm=I=-14:TP=-1.5:LRA=11" -c:a aac -b:a 192k -shortest -movflags +faststart ${out}`, { stdio: 'inherit' });
  fs.rmSync(dir, { recursive: true, force: true });
  console.log('done', n, 'frames', out);
})();
