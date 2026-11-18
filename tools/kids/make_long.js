// MoneyViel Kids long video (16:9, 1920x1080) built from vertical episodes.
// usage: node make_long.js out.mp4 "Long video title" ep001.mp4:1:"Piggu's Kite Dream" ep002.mp4:2:"..." ...
// Each episode plays in the centre; left side = big logo, right side = "Episode N" + title. 4 s title card at the start.
const { chromium } = require('playwright'); const { execSync } = require('child_process'); const fs = require('fs'); const path = require('path');
(async () => {
  const [out, title, ...eps] = process.argv.slice(2);
  const tmp = '/tmp/klong'; fs.rmSync(tmp, { recursive: true, force: true }); fs.mkdirSync(tmp);
  const b = await chromium.launch(); const p = await b.newPage({ viewport: { width: 1920, height: 1080 } });
  await p.goto('file://' + __dirname + '/engine.html'); await p.evaluate(() => document.fonts.ready);
  const card = async (file, html) => { await p.evaluate(h => { document.body.style.width = '1920px'; document.body.style.height = '1080px'; document.getElementById('stage').style.cssText = 'position:relative;width:1920px;height:1080px;overflow:hidden'; document.getElementById('stage').innerHTML = h; }, html); await p.screenshot({ path: file, type: 'png' }); };
  const bg = `<div class="abs" style="inset:0;background:linear-gradient(135deg,#8fdcff 0%,#c9b6ff 55%,#ffe1ef 100%)"></div>`;
  const esc = s => s.replace(/&/g, '&amp;').replace(/</g, '&lt;');
  // intro
  await card(`${tmp}/intro.png`, bg + `<div class="abs" style="left:560px;top:120px;width:800px">${'${LOGO}'}</div><div class="big" style="top:640px;font-size:96px">${esc(title)}</div><div class="big" style="top:820px;font-size:52px;color:#e0408f">Watch, pause, guess and learn! 🤔</div>`.replace('${LOGO}', await p.evaluate(() => kidsLogo({ w: 800 }))));
  const segs = [];
  execSync(`ffmpeg -y -loglevel error -loop 1 -t 4 -i ${tmp}/intro.png -f lavfi -t 4 -i anullsrc=r=44100:cl=stereo -vf "fps=30,format=yuv420p" -c:v libx264 -preset veryfast -crf 20 -c:a aac -b:a 192k ${tmp}/s0.mp4`);
  segs.push(`${tmp}/s0.mp4`);
  for (let i = 0; i < eps.length; i++) {
    const [f, no, ...tt] = eps[i].split(':'); const t = tt.join(':');
    const logo = await p.evaluate(() => kidsLogo({ w: 520 }));
    await card(`${tmp}/bg${i}.png`, bg + `<div class="abs" style="left:60px;top:380px;width:520px">${logo}</div>` +
      `<div class="abs" style="left:1340px;top:330px;width:520px;text-align:center"><div style="display:inline-block;background:#3b1f8f;color:#fff;border-radius:50px;padding:12px 40px;font-size:56px;font-weight:700">Episode ${no}</div><div style="margin-top:40px;font-size:68px;font-weight:700;color:#e0408f;line-height:1.15">${esc(t)}</div></div><div class="abs" style="left:60px;bottom:30px;font-size:30px;font-weight:600;color:rgba(59,31,143,.6)">© MoneyViel Kids</div>`);
    execSync(`ffmpeg -y -loglevel error -loop 1 -i ${tmp}/bg${i}.png -i ${path.resolve(f)} -filter_complex "[1:v]scale=-2:1080[v];[0:v][v]overlay=(W-w)/2:0:shortest=1,fps=30,format=yuv420p[o]" -map "[o]" -map 1:a -c:v libx264 -preset veryfast -crf 20 -c:a aac -b:a 192k -ar 44100 -ac 2 ${tmp}/s${i + 1}.mp4`);
    segs.push(`${tmp}/s${i + 1}.mp4`);
  }
  await b.close();
  fs.writeFileSync(`${tmp}/list.txt`, segs.map(s => `file '${s}'`).join('\n'));
  execSync(`ffmpeg -y -loglevel error -f concat -safe 0 -i ${tmp}/list.txt -c copy -movflags +faststart ${out}`);
  console.log('done', out);
})();
