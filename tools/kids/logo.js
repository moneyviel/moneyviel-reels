// MoneyViel Kids logo: "moneyviel" wordmark + chunky toy-block "KIDS", Piggu peeking over the K, Sikka as the dot of the i.
(function(root){
function kidsLogo(opts={}){
  const word = opts.word!==false;
  let g='';
  g+=`<rect x="60" y="270" width="880" height="300" rx="80" fill="#2b1d3a" opacity=".12" transform="translate(0,16)"/>`;
  g+=`<rect x="60" y="270" width="880" height="300" rx="80" fill="#fff"/>`;
  const T=(ch,x,col,rot)=>`<g transform="rotate(${rot} ${x} 430)"><text x="${x}" y="525" text-anchor="middle" font-family="F" font-weight="700" font-size="270" fill="#2b1d3a" opacity=".16" transform="translate(6,9)">${ch}</text><text x="${x}" y="525" text-anchor="middle" font-family="F" font-weight="700" font-size="270" fill="${col}" stroke="#fff" stroke-width="12" paint-order="stroke">${ch}</text></g>`;
  g+=T('K',225,'#ff5c8a',-6);
  // hand-drawn i stem
  g+=`<g transform="rotate(4 400 440)"><rect x="372" y="352" width="62" height="176" rx="31" fill="#2b1d3a" opacity=".16" transform="translate(6,9)"/><rect x="368" y="350" width="64" height="178" rx="32" fill="#ffb020" stroke="#fff" stroke-width="12" paint-order="stroke"/></g>`;
  g+=T('D',585,'#4cc3ff',-4);
  g+=T('S',790,'#7a5cff',6);
  // Sikka as the dot of the i
  g+=`<g transform="translate(338,192) scale(.6)">${root.MVK.sikka('wink')}</g>`;
  // Piggu peeking over the left edge
  g+=`<g transform="translate(70,150) scale(.78)">${root.MVK.piggu('happy')}</g>`;
  if(word) g+=`<text x="640" y="235" text-anchor="middle" font-family="F" font-weight="600" font-size="92" fill="#3b1f8f" letter-spacing="2">money<tspan fill="#e0408f">viel</tspan></text>`;
  // sparkles
  g+=`<path d="M915 205 l14 34 34 14 -34 14 -14 34 -14 -34 -34 -14 34 -14z" fill="#ffc533"/><path d="M820 130 l8 18 18 8 -18 8 -8 18 -8 -18 -18 -8 18 -8z" fill="#ff5c8a"/>`;
  return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 60 1000 560" width="${opts.w||1000}" height="${(opts.w||1000)*0.56}">${g}</svg>`;
}
root.kidsLogo=kidsLogo;})(typeof window!=='undefined'?window:globalThis);
