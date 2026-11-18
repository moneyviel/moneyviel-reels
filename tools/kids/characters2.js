// MoneyViel Kids: extra original characters (drawn by MoneyViel, no third-party IP). 200x200 box, moods: happy | wow | think | wink.
// Granny Owl: kind grandmother owl with round glasses and a pink shawl. Mr Hop: friendly bunny shopkeeper with a blue apron.
(function (root) {
  function eyes(m, x1, x2, y, r, col = '#2b1d3a') {
    if (m === 'wink') return `<circle cx="${x1}" cy="${y}" r="${r}" fill="${col}"/><path d="M${x2 - r} ${y} q${r} ${-r} ${2 * r} 0" stroke="${col}" stroke-width="${r * .55}" fill="none" stroke-linecap="round"/>`;
    const w = m === 'wow' ? r * 1.25 : r;
    const p = cx => `<circle cx="${cx}" cy="${y}" r="${w}" fill="${col}"/><circle cx="${cx + w * .35}" cy="${y - w * .4}" r="${w * .35}" fill="#fff"/>`;
    return p(x1) + p(x2) + (m === 'think' ? `<path d="M${x1 - r * 1.5} ${y - r * 2.3} l${r * 2.4} ${-r * .6}" stroke="${col}" stroke-width="${r * .5}" stroke-linecap="round"/>` : '');
  }
  function mouth(m, cx, y, s, col = '#7a1f3d') {
    if (m === 'wow') return `<ellipse cx="${cx}" cy="${y + s * .3}" rx="${s * .45}" ry="${s * .6}" fill="${col}"/>`;
    if (m === 'think') return `<path d="M${cx - s * .6} ${y + s * .3} q${s * .6} ${-s * .3} ${s * 1.2} 0" stroke="${col}" stroke-width="${s * .25}" fill="none" stroke-linecap="round"/>`;
    return `<path d="M${cx - s} ${y} q${s} ${s * 1.1} ${2 * s} 0 z" fill="${col}"/>`;
  }
  function owl(m = 'happy') {
    return `<g>
    <ellipse cx="100" cy="188" rx="56" ry="8" fill="rgba(0,0,0,.15)"/>
    <path d="M78 176 l-6 12 h14z M122 176 l6 12 h-14z" fill="#f2a33a"/>
    <path d="M52 40 L64 8 L84 34 Z" fill="#8a5a34"/><path d="M148 40 L136 8 L116 34 Z" fill="#8a5a34"/>
    <ellipse cx="100" cy="104" rx="70" ry="78" fill="#a47148"/>
    <ellipse cx="100" cy="128" rx="46" ry="50" fill="#f3d9b1"/>
    <path d="M70 140 q6 -8 12 0 M92 150 q6 -8 12 0 M114 140 q6 -8 12 0 M82 162 q6 -8 12 0 M104 162 q6 -8 12 0" stroke="#d9b98a" stroke-width="3" fill="none"/>
    <path d="M30 120 q-10 30 18 46 q10 -30 -18 -46z" fill="#8a5a34"/><path d="M170 120 q10 30 -18 46 q-10 -30 18 -46z" fill="#8a5a34"/>
    <circle cx="74" cy="72" r="22" fill="#fff"/><circle cx="126" cy="72" r="22" fill="#fff"/>
    ${eyes(m, 74, 126, 74, 9)}
    <circle cx="74" cy="72" r="25" fill="none" stroke="#5b3fd6" stroke-width="4"/><circle cx="126" cy="72" r="25" fill="none" stroke="#5b3fd6" stroke-width="4"/><path d="M99 70 h2" stroke="#5b3fd6" stroke-width="4"/>
    <path d="M92 96 L108 96 L100 110 Z" fill="#f2a33a"/>
    ${m === 'wow' ? `<ellipse cx="100" cy="116" rx="5" ry="6" fill="#7a1f3d"/>` : ''}
    <path d="M38 150 Q100 196 162 150 L156 176 Q100 206 44 176 Z" fill="#ff8fb1"/><circle cx="100" cy="182" r="7" fill="#ffc533"/>
    </g>`;
  }
  function bunny(m = 'happy') {
    return `<g>
    <ellipse cx="100" cy="190" rx="54" ry="8" fill="rgba(0,0,0,.15)"/>
    <ellipse cx="72" cy="30" rx="16" ry="42" fill="#e9e4f0" transform="rotate(-10 72 30)"/><ellipse cx="72" cy="32" rx="8" ry="32" fill="#ffc2d6" transform="rotate(-10 72 32)"/>
    <ellipse cx="128" cy="30" rx="16" ry="42" fill="#e9e4f0" transform="rotate(10 128 30)"/><ellipse cx="128" cy="32" rx="8" ry="32" fill="#ffc2d6" transform="rotate(10 128 32)"/>
    <ellipse cx="100" cy="150" rx="54" ry="44" fill="#e9e4f0"/>
    <path d="M62 128 h76 v54 q-38 16 -76 0z" fill="#4cc3ff"/><rect x="86" y="146" width="28" height="20" rx="5" fill="#2f9fd8"/>
    <circle cx="100" cy="88" r="50" fill="#f4f1f8"/>
    ${eyes(m, 82, 118, 80, 7)}
    <circle cx="66" cy="100" r="8" fill="#ff9dbd" opacity=".6"/><circle cx="134" cy="100" r="8" fill="#ff9dbd" opacity=".6"/>
    <ellipse cx="100" cy="98" rx="7" ry="5" fill="#ff7aa0"/>
    ${m === 'wow' ? `<ellipse cx="100" cy="114" rx="6" ry="7" fill="#7a1f3d"/>` : `<path d="M92 106 q8 8 16 0" stroke="#7a1f3d" stroke-width="3" fill="none" stroke-linecap="round"/><rect x="95" y="108" width="10" height="9" rx="2" fill="#fff" stroke="#ddd"/>`}
    <path d="M86 128 l14 6 l14 -6 l-4 12 l-10 -4 l-10 4z" fill="#ffb020"/>
    </g>`;
  }
  root.MVK2 = { owl, bunny };
})(typeof window !== 'undefined' ? window : globalThis);
