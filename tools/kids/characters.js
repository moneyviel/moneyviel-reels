// MoneyViel Kids original characters (drawn by MoneyViel, no third-party IP).
// Piggu: cheerful pink piggy bank. Sikka: clever gold rupee-style coin (no real currency design copied).
// Each returns an SVG <g> string. mood: 'happy' | 'wow' | 'think' | 'wink'. size ~ 200 units box.
(function (root) {
  function eyes(mood, x1, x2, y, r) {
    if (mood === 'wink') return `<circle cx="${x1}" cy="${y}" r="${r}" fill="#2b1d3a"/><path d="M${x2 - r} ${y} q${r} ${-r * 0.9} ${2 * r} 0" stroke="#2b1d3a" stroke-width="${r * 0.6}" fill="none" stroke-linecap="round"/>`;
    const w = mood === 'wow' ? r * 1.25 : r;
    const pupil = (cx) => `<circle cx="${cx}" cy="${y}" r="${w}" fill="#2b1d3a"/><circle cx="${cx + w * 0.35}" cy="${y - w * 0.4}" r="${w * 0.35}" fill="#fff"/>`;
    const brow = mood === 'think' ? `<path d="M${x1 - r * 1.4} ${y - r * 2.2} l${r * 2.4} ${-r * 0.6}" stroke="#2b1d3a" stroke-width="${r * 0.5}" stroke-linecap="round"/>` : '';
    return pupil(x1) + pupil(x2) + brow;
  }
  function mouth(mood, cx, y, s) {
    if (mood === 'wow') return `<ellipse cx="${cx}" cy="${y + s * 0.3}" rx="${s * 0.45}" ry="${s * 0.6}" fill="#7a1f3d"/>`;
    if (mood === 'think') return `<path d="M${cx - s * 0.6} ${y + s * 0.3} q${s * 0.6} ${-s * 0.3} ${s * 1.2} 0" stroke="#7a1f3d" stroke-width="${s * 0.25}" fill="none" stroke-linecap="round"/>`;
    return `<path d="M${cx - s} ${y} q${s} ${s * 1.1} ${2 * s} 0 z" fill="#7a1f3d"/><path d="M${cx - s * 0.5} ${y + s * 0.45} q${s * 0.5} ${s * 0.35} ${s} 0" fill="#ff8fb1"/>`;
  }
  function piggu(mood = 'happy') {
    return `<g class="piggu">
      <ellipse cx="100" cy="182" rx="62" ry="9" fill="rgba(0,0,0,.15)"/>
      <rect x="52" y="150" width="22" height="30" rx="10" fill="#f47aa3"/><rect x="126" y="150" width="22" height="30" rx="10" fill="#f47aa3"/>
      <path d="M40 62 L52 22 L82 50 Z" fill="#f47aa3"/><path d="M160 62 L148 22 L118 50 Z" fill="#f47aa3"/>
      <path d="M48 56 L55 33 L72 50 Z" fill="#ffc2d6"/><path d="M152 56 L145 33 L128 50 Z" fill="#ffc2d6"/>
      <ellipse cx="100" cy="105" rx="78" ry="64" fill="#ff9dbd"/>
      <ellipse cx="78" cy="70" rx="30" ry="14" fill="rgba(255,255,255,.35)"/>
      <rect x="82" y="40" width="36" height="8" rx="4" fill="#c2426e"/>
      ${eyes(mood, 72, 128, 92, 7)}
      <ellipse cx="100" cy="122" rx="26" ry="19" fill="#f47aa3"/>
      <ellipse cx="91" cy="122" rx="5" ry="7" fill="#c2426e"/><ellipse cx="109" cy="122" rx="5" ry="7" fill="#c2426e"/>
      <circle cx="52" cy="118" r="9" fill="#ff7aa0" opacity=".6"/><circle cx="148" cy="118" r="9" fill="#ff7aa0" opacity=".6"/>
      ${mouth(mood, 100, 145, 9)}
      <path d="M177 100 q16 -6 10 10 q-6 14 8 10" stroke="#f47aa3" stroke-width="6" fill="none" stroke-linecap="round"/>
    </g>`;
  }
  function sikka(mood = 'happy') {
    return `<g class="sikka">
      <ellipse cx="100" cy="186" rx="44" ry="7" fill="rgba(0,0,0,.15)"/>
      <path d="M74 160 l-8 20 h16 z" fill="#d48a00"/><path d="M126 160 l8 20 h-16 z" fill="#d48a00"/>
      <circle cx="100" cy="100" r="74" fill="#e39b00"/>
      <circle cx="100" cy="96" r="70" fill="#ffc533"/>
      <circle cx="100" cy="96" r="56" fill="none" stroke="#f0a800" stroke-width="6" stroke-dasharray="2 10" stroke-linecap="round"/>
      <ellipse cx="75" cy="62" rx="22" ry="10" fill="rgba(255,255,255,.45)" transform="rotate(-25 75 62)"/>
      ${eyes(mood, 80, 120, 88, 7)}
      <circle cx="62" cy="112" r="8" fill="#ff9a3c" opacity=".55"/><circle cx="138" cy="112" r="8" fill="#ff9a3c" opacity=".55"/>
      ${mouth(mood, 100, 116, 10)}
      <path d="M30 104 q-16 -6 -20 -22" stroke="#d48a00" stroke-width="7" fill="none" stroke-linecap="round"/>
      <path d="M170 104 q16 -6 20 -22" stroke="#d48a00" stroke-width="7" fill="none" stroke-linecap="round"/>
    </g>`;
  }
  root.MVK = { piggu, sikka };
})(typeof window !== 'undefined' ? window : globalThis);
