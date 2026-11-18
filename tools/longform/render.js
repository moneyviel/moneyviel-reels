// usage: node render.js long_salary.js out.mp4 [fps=24]   (1920x1080, music + sfx, loudnorm -14)
const { chromium } = require('playwright'); const fs = require('fs'); const { execSync } = require('child_process'); const path = require('path');
(async () => {
  const [spec, out, fpsArg] = process.argv.slice(2); const fps = +(fpsArg || 24); const tag = path.basename(spec, '.js');
  const dir = `/tmp/lframes_${tag}`; fs.rmSync(dir, { recursive: true, force: true }); fs.mkdirSync(dir);
  const b = await chromium.launch(); const p = await b.newPage({ viewport: { width: 1920, height: 1080 } });
  await p.goto('file://' + __dirname + '/engine.html'); await p.addScriptTag({ path: path.resolve(spec) }); await p.evaluate(() => document.fonts.ready);
  const meta = await p.evaluate(() => ({ d: V.duration, sfx: V.sfx }));
  const n = Math.round(meta.d * fps);
  for (let i = 0; i < n; i++) { await p.evaluate(t => render(t), i / fps); await p.screenshot({ path: `${dir}/f${String(i).padStart(5, '0')}.jpg`, type: 'jpeg', quality: 86 }); }
  await b.close();
  fs.writeFileSync(`/tmp/lev_${tag}.json`, JSON.stringify({ outro: meta.d - 8, ev: meta.sfx }));
  execSync(`python3 ${__dirname}/../make_audio.py /tmp/lev_${tag}.json ${meta.d} /tmp/laud_${tag}.wav ${tag.length * 3}`, { stdio: 'inherit' });
  execSync(`ffmpeg -y -loglevel error -framerate ${fps} -i ${dir}/f%05d.jpg -i /tmp/laud_${tag}.wav -c:v libx264 -preset veryfast -crf 21 -pix_fmt yuv420p -af "loudnorm=I=-14:TP=-1.5:LRA=11" -c:a aac -b:a 160k -shortest -movflags +faststart ${out}`, { stdio: 'inherit' });
  fs.rmSync(dir, { recursive: true, force: true });
  console.log('done', n, 'frames', out);
})();
