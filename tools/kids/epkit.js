// MoneyViel Kids episode kit: build window.EP from a simple spec of "beats".
// Load AFTER engine.html (uses say, timer, MVK, kidsLogo). Usage in an episode file:
//   KIT({no, title, bg?, beats:[...]})
// Beats (durations in seconds; defaults shown):
//   {k:'hook', text, dur:4}
//   {k:'say', who:'piggu'|'sikka', text, dur:4.5, prop?, mp?, ms?}            mp/ms = moods of Piggu/Sikka
//   {k:'show', text, sub?, prop?, dur:4}                                       narrator card (no speaker)
//   {k:'guess', q, think:6, ans:{kind:'stacks', n, step, label?}|{kind:'text', text}, answer, hold:5}
//   {k:'count', n, step, label:'Day', unit:'coins', per:1.2}                  stacks appear one by one
//   {k:'choice', setup, q, think:3, answer, explain, good:true, hold:4}
//   {k:'sort', q, items:[[emoji,name,'NEED'|'WANT']], think:5, hold:5, cols:['NEED','WANT']}
//   {k:'win', who, text, prop?, dur:5}
//   {k:'lesson', text, next, dur:6}
(function () {
  const P = (m, x, y, s) => `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200 * s}" height="${200 * s}" viewBox="0 0 200 200">${MVK.piggu(m)}</svg>`;
  const K = (m, x, y, s) => `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200 * s}" height="${200 * s}" viewBox="0 0 200 200">${MVK.sikka(m)}</svg>`;
  const bob = (t, a = 12, f = 2.2) => Math.sin(t * f * Math.PI) * a;
  const talk = (ts, on) => on ? Math.abs(Math.sin(ts * 9)) * 14 : 0;
  const kite = (x, y, s, rot = 0) => `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${260 * s}" height="${380 * s}" viewBox="0 0 260 380"><g transform="rotate(${rot} 130 130)"><path d="M130 0 L260 130 L130 260 L0 130 Z" fill="#ff5c8a"/><path d="M130 0 L130 260 M0 130 L260 130" stroke="#fff" stroke-width="8"/><path d="M130 0 L260 130 L130 130 Z" fill="#ffc533"/><path d="M0 130 L130 260 L130 130Z" fill="#5bc0ff"/><path d="M130 260 q-30 40 0 60 q30 20 0 60" stroke="#3b1f8f" stroke-width="6" fill="none"/></g></svg>`;
  const stack = (x, y, s = 1, lab = '10') => { let c = ''; for (let i = 3; i >= 0; i--) c += `<ellipse cx="60" cy="${70 + i * 14}" rx="52" ry="20" fill="#e39b00"/><ellipse cx="60" cy="${64 + i * 14}" rx="52" ry="20" fill="#ffc533"/>`;
    return `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${120 * s}" height="${140 * s}" viewBox="0 0 120 140">${c}<circle cx="96" cy="30" r="28" fill="#3b1f8f"/><text x="96" y="41" text-anchor="middle" font-size="${String(lab).length > 2 ? 22 : 30}" font-weight="700" fill="#fff" font-family="F">${lab}</text></svg>`; };
  const big = (txt, top, size, ts, a, col = '#3b1f8f') => ts < a ? '' : `<div class="big" style="top:${top}px;font-size:${size}px;color:${col};transform:scale(${pop((ts - a) / 0.5)})">${txt}</div>`;
  const panel = (top, h) => `<div class="abs" style="left:50px;right:50px;top:${top}px;height:${h}px;background:rgba(255,255,255,.9);border-radius:60px;box-shadow:0 12px 0 rgba(59,31,143,.15)"></div>`;
  const dim = `<div class="abs" style="left:0;right:0;top:0;bottom:0;background:rgba(43,29,58,.6)"></div>`;
  const confetti = (ts) => { let s = ''; for (let i = 0; i < 60; i++) { const x = (i * 157) % 1080, y = ((i * 233) % 600) - 200 + ts * 700 * (0.6 + (i % 5) / 5); const c = ['#ff5c8a', '#ffc533', '#5bc0ff', '#7ce08a', '#b38bff'][i % 5]; s += `<rect x="${x}" y="${y % 1920}" width="22" height="34" fill="${c}" transform="rotate(${(ts * 200 + i * 40) % 360} ${x} ${y % 1920})"/>`; } return `<svg class="abs" style="left:0;top:0" width="1080" height="1920">${s}</svg>`; };
  const emo = (e, x, y, size) => `<div class="abs" style="left:${x}px;top:${y}px;font-size:${size}px;line-height:1">${e}</div>`;
  // prop: emoji string, 'kite', or {svg:'<inner svg in a 100x100 box>'}. where = 'side' (top-right) or 'center' (below hook text)
  const prop = (pr, ts, where = 'side') => { if (!pr) return ''; const c = where !== 'side'; const x = c ? 390 : 660, y = (where === 'show' ? 900 : c ? 720 : 300) + bob(ts, 14, 1);
    if (pr === 'kite') return kite(c ? 400 : 640, (c ? 640 : 240) + bob(ts, 18, 1), 1.1, Math.sin(ts * 2) * 6);
    if (pr.svg) return `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="300" height="300" viewBox="10 10 80 80">${pr.svg}</svg>`; return emo(pr, x, y, 300); };
  const PG = { x: 40, y: 1260, s: 2.5 }, SK = { x: 690, y: 1380, s: 1.7 };
  const pHead = [PG.x + 250, PG.y + 40], sHead = [SK.x + 170, SK.y + 10];
  const BUB = { piggu: { x: 50, baseY: 1150, w: 640, tx: pHead[0], ty: pHead[1] }, sikka: { x: 340, baseY: 1280, w: 690, tx: sHead[0], ty: sHead[1] } };
  const chars = (mp, ms, ts, who, talking = true) => P(mp || 'happy', PG.x, PG.y - (who === 'piggu' && talking ? talk(ts, ts > .3) : 0), PG.s) + K(ms || 'happy', SK.x, SK.y - (who === 'sikka' && talking ? talk(ts, ts > .3) : 0), SK.s);
  // grid of stacks: n stacks, running total labels
  const grid = (ts, a, n, step, label, top, per = 0.35) => { const perRow = n > 6 ? Math.ceil(n / 2) : n; const gap = Math.min(160, 940 / perRow); let s = '';
    for (let d = 0; d < n; d++) { if (ts < a + d * per) continue; const r = Math.floor(d / perRow), c = d % perRow; const rowN = Math.min(perRow, n - r * perRow); const x0 = (1080 - rowN * gap) / 2 + (gap - 126) / 2; const x = x0 + c * gap, y = top + r * 300;
      s += stack(x, y, 1.05, step) + `<div class="abs" style="left:${x - 10}px;width:146px;top:${y + 160}px;text-align:center;font-size:44px;font-weight:700;color:#3b1f8f">${(d + 1) * step}</div>` + (label ? `<div class="abs" style="left:${x - 10}px;width:146px;top:${y + 215}px;text-align:center;font-size:30px;font-weight:600;color:#6b5a8a">${label} ${d + 1}</div>` : ''); }
    return s; };
  const BEAT = {
    hook: (b) => ({ dur: b.dur || 4, sfx: [[0.2, 'level']], draw: (ts) => big(b.text, 330, 100, ts, 0.1) + prop(b.prop, ts, 'center') + P('wow', PG.x, PG.y + bob(ts), PG.s) + K('happy', SK.x, SK.y + bob(ts + .5), SK.s) }),
    say: (b) => ({ dur: b.dur || 4.5, sfx: [[0.3, 'slide']], draw: (ts) => prop(b.prop, ts) + chars(b.mp, b.ms, ts, b.who) + say(b.who, b.text, ts, 0.3, BUB[b.who]) }),
    show: (b) => ({ dur: b.dur || 4, sfx: [[0.2, 'slide']], draw: (ts) => panel(330, b.sub ? 520 : 380) + big(b.text, 380, 92, ts, 0) + (b.sub ? big(b.sub, 640, 64, ts, 0.6, '#e0408f') : '') + prop(b.prop, ts, 'show') + chars(b.mp, b.ms, ts, null) }),
    guess: (b) => { const th = b.think || 6, hold = b.hold || 5, A = 1.5 + th; const sf = [[0.1, 'slide']]; for (let i = 0; i < th; i++) sf.push([1.5 + i, 'slide']); sf.push([A, 'good']); sf.push([A + (b.ans.kind === 'stacks' ? b.ans.n * 0.35 + 0.3 : 0.5), 'level']);
      return { dur: A + (b.ans.kind === 'stacks' ? b.ans.n * 0.35 + 0.3 : 0.5) + hold, sfx: sf, draw: (ts) => { let s = panel(230, 620) + big('✋ PAUSE &amp; GUESS!', 270, 88, ts, 0, '#e0408f') + big(b.q, 420, 76, ts, 0.5);
        if (ts < A) return s + timer(ts, 1.5, th, 920) + (ts >= 1.5 ? big('Think… 🤔', 1220, 80, ts, 1.5) : '') + P('think', PG.x, PG.y, PG.s) + K('think', SK.x, SK.y, SK.s);
        if (b.ans.kind === 'stacks') { const top = b.ans.n > 6 ? 880 : 920; s += grid(ts, A, b.ans.n, b.ans.step, b.ans.label, top); const t2 = A + b.ans.n * 0.35 + 0.3; s += big(b.answer, b.ans.n > 6 ? 1470 : 1210, 120, ts, t2, '#e0408f'); return s + (b.ans.n > 6 ? '' : P('happy', PG.x, PG.y + 30, PG.s * 0.9) + K('happy', SK.x, SK.y + 30, SK.s * 0.9)); }
        s += big(b.ans.text || '', 920, 96, ts, A) + big(b.answer, 1120, 120, ts, A + 0.5, '#e0408f'); return s + P('happy', PG.x, PG.y + 60, PG.s * 0.85) + K('happy', SK.x, SK.y + 60, SK.s * 0.85); } }; },
    count: (b) => { const per = b.per || 1.2, n = b.n; const sf = []; for (let i = 0; i < n; i++) sf.push([0.1 + i * per, 'good']);
      return { dur: n * per + 1.2, sfx: sf, draw: (ts) => { const d = Math.min(n, 1 + Math.floor(ts / per)); return big(`${b.label || 'Day'} ${d}: <b>${d * b.step} ${b.unit || 'coins'}</b>`, 300, 96, ts, 0) + grid(99, 0, d, b.step, '', 600, 0) + P('happy', PG.x, PG.y + bob(ts), PG.s) + K('happy', SK.x, SK.y, SK.s); } }; },
    choice: (b) => { const th = b.think || 3, hold = b.hold || 4, A = 1 + th; const sf = [[0.1, 'bad']]; for (let i = 0; i < th; i++) sf.push([1 + i, 'slide']); sf.push([A, 'level']);
      return { dur: A + hold, sfx: sf, draw: (ts) => { const L = x => (x.match(/<br>/g) || []).length + 1; const qy = 310 + L(b.setup) * 98 + 30, ay = qy + L(b.q) * 112 + 40;
      return dim + panel(260, 940) + big(b.setup, 310, 80, ts, 0) + big(b.q, qy, 92, ts, 0.5, '#e0408f') + (ts < A ? timer(ts, 1, th, ay) : big(b.answer, ay, 104, ts, A, b.good === false ? '#d6336c' : '#1f9d55') + big(b.explain, ay + 150, 64, ts, A + 0.5)) + P(ts >= A ? 'wink' : 'think', PG.x, PG.y, PG.s); } }; },
    sort: (b) => { const th = b.think || 5, hold = b.hold || 5, A = 1.5 + th, cols = b.cols || ['NEED', 'WANT']; const sf = [[0.1, 'slide']]; for (let i = 0; i < th; i++) sf.push([1.5 + i, 'slide']); b.items.forEach((_, i) => sf.push([A + i * 0.5, 'good']));
      return { dur: A + b.items.length * 0.5 + hold, sfx: sf, draw: (ts) => { let s = panel(230, 330) + big(b.q, 280, 90, ts, 0, '#e0408f') + big('Sort them! 🤔', 410, 64, ts, 0.4);
        const n = b.items.length; const cnt = { [cols[0]]: 0, [cols[1]]: 0 };
        b.items.forEach(([e, name, c], i) => { const moved = ts >= A + i * 0.5; let x, y; if (!moved) { x = 90 + i * (900 / n); y = 640; } else { const k = cnt[c]++; x = c === cols[0] ? 110 : 600; y = 820 + k * 210; }
          s += `<div class="abs" style="left:${x}px;top:${y}px;width:${moved ? 380 : 900 / n - 20}px;text-align:${moved ? 'left' : 'center'};font-size:${moved ? 44 : 38}px;font-weight:700;color:#3b1f8f;transition:none"><span style="font-size:${moved ? 110 : 130}px;vertical-align:middle">${e}</span>${moved ? ' ' + name : '<br>' + name}</div>`; });
        if (ts < A) s += timer(ts, 1.5, th, 1000) + P('think', PG.x, PG.y, PG.s) + K('think', SK.x, SK.y, SK.s);
        else s += `<div class="abs" style="left:90px;top:740px;width:420px;text-align:center;font-size:64px;font-weight:700;color:#1f9d55">${cols[0]}</div><div class="abs" style="left:580px;top:740px;width:420px;text-align:center;font-size:64px;font-weight:700;color:#e0408f">${cols[1]}</div><div class="abs" style="left:538px;top:740px;width:6px;height:${Math.max(cnt[cols[0]], cnt[cols[1]]) * 210 + 90}px;background:#c9b6ff;border-radius:3px"></div>`;
        return s; } }; },
    win: (b) => ({ dur: b.dur || 5, sfx: [[0.2, 'level']], draw: (ts) => confetti(ts) + prop(b.prop, ts) + P('happy', PG.x, PG.y - (b.who === 'piggu' ? talk(ts, ts > .4 && ts < 3.5) : bob(ts, 20, 3)), PG.s) + K('wink', SK.x, SK.y - (b.who === 'sikka' ? talk(ts, ts > .4 && ts < 3.5) : bob(ts + .3, 20, 3)), SK.s) + say(b.who, b.text, ts, 0.4, BUB[b.who]) }),
    lesson: (b) => ({ dur: b.dur || 6, sfx: [[0.1, 'good']], draw: (ts) => panel(250, 520) + big(b.text, 290, 96, ts, 0, '#e0408f') + K('wow', 400, 860, 1.4) + `<div class="tag" style="top:1200px;opacity:${ts > 1.5 ? 1 : 0};font-size:${b.next.length > 34 ? 40 : 48}px">Next time: ${b.next}</div>` + `<div class="abs" style="left:240px;top:1360px;width:600px;opacity:${ts > 2 ? 1 : 0}">${kidsLogo({ w: 600 })}</div>` }),
  };
  const BG = { sky: 'linear-gradient(180deg,#8fdcff 0%,#c9b6ff 60%,#ffe1ef 100%)', sun: 'linear-gradient(180deg,#ffe08a 0%,#ffc2d6 60%,#ffe9f2 100%)', mint: 'linear-gradient(180deg,#a8f0d8 0%,#bfe3ff 60%,#f1f7ff 100%)', dusk: 'linear-gradient(180deg,#b6a4ff 0%,#ffb3d1 60%,#ffe7d6 100%)' };
  window.KIT = function (spec) {
    let t = 0; const scenes = [], sfx = [];
    spec.beats.forEach(b => { const B = BEAT[b.k](b); scenes.push({ t0: t, t1: t + B.dur, draw: (ts) => B.draw(ts) }); B.sfx.forEach(([a, k]) => sfx.push([+(t + a).toFixed(2), k])); t += B.dur; });
    window.EP = { no: spec.no, title: spec.title, bg: BG[spec.bg || 'sky'] || spec.bg, scenes, sfx, duration: +t.toFixed(2), outro: +(t - 3).toFixed(2), spec,
      decor: (tt) => { let s = ''; [[80, 300, 1], [700, 420, 1.3], [300, 1000, 1.1]].forEach(([x, y, k], i) => { x = (x + tt * 20 * (i + 1)) % 1300 - 150; s += `<g transform="translate(${x},${y}) scale(${k})" fill="#fff" opacity=".7"><circle r="50"/><circle cx="55" cy="-20" r="65"/><circle cx="120" r="50"/><rect width="120" height="50"/></g>`; }); return s; } };
  };
})();
