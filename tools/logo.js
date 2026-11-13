// draws MoneyViel logo; returns {logo: canvas, icon: canvas}
async function mvDrawLogo(fontFamily,light){
  const C={night:'#1B1640',violet:'#5B3FD6',magenta:'#E0408F',gold:'#FFB020',muted:'#6B6488'};
  function icon(ctx,x,y,s){
    const r=s*0.26;const g=ctx.createLinearGradient(x,y,x+s,y+s);g.addColorStop(0,C.violet);g.addColorStop(1,C.magenta);
    ctx.fillStyle=g;ctx.beginPath();ctx.roundRect(x,y,s,s,r);ctx.fill();
    // soft highlight
    const hl=ctx.createRadialGradient(x+s*.25,y+s*.2,0,x+s*.25,y+s*.2,s*.7);hl.addColorStop(0,'rgba(255,255,255,.28)');hl.addColorStop(1,'rgba(255,255,255,0)');ctx.fillStyle=hl;ctx.beginPath();ctx.roundRect(x,y,s,s,r);ctx.fill();
    // rising bars forming growth
    const bw=s*0.15,gap=s*0.075,base=y+s*0.80,left=x+s*0.2;
    const hs=[0.22,0.34,0.46];
    ctx.fillStyle='#fff';
    hs.forEach((h,i)=>{const bx=left+i*(bw+gap),bh=s*h;ctx.beginPath();ctx.roundRect(bx,base-bh,bw,bh,bw/2);ctx.fill();});
    // gold coin above tallest bar
    const cx=left+2*(bw+gap)+bw/2, cy=base-s*0.46-s*0.135, cr=s*0.088;
    ctx.fillStyle=C.gold;ctx.beginPath();ctx.arc(cx,cy,cr,0,Math.PI*2);ctx.fill();
    ctx.strokeStyle='rgba(255,255,255,.85)';ctx.lineWidth=s*0.018;ctx.beginPath();ctx.arc(cx,cy,cr*0.62,0,Math.PI*2);ctx.stroke();
  }
  // full logo
  const H=200,pad=10,isz=170;
  const lc=document.createElement('canvas');const ctx=lc.getContext('2d');
  const wfont='700 104px '+fontFamily, tfont='700 25px '+fontFamily;
  ctx.font=wfont;const w1=ctx.measureText('money').width,w2=ctx.measureText('viel').width;
  ctx.font=tfont;ctx.letterSpacing='5px';const tw=ctx.measureText('MONEY MADE SIMPLE').width;
  const textX=pad+isz+30, W=Math.ceil(textX+Math.max(w1+w2,tw)+pad+6);
  lc.width=W;lc.height=H;const c=lc.getContext('2d');
  icon(c,pad,(H-isz)/2,isz);
  c.textBaseline='alphabetic';c.font=wfont;c.fillStyle=light?'#ffffff':C.night;c.fillText('money',textX,118);
  const tg=c.createLinearGradient(textX+w1,0,textX+w1+w2,0);tg.addColorStop(0,C.violet);tg.addColorStop(1,C.magenta);
  c.fillStyle=tg;c.fillText('viel',textX+w1,118);
  c.font=tfont;c.letterSpacing='5px';c.fillStyle=light?'#CFC8F2':C.muted;c.fillText('MONEY MADE SIMPLE',textX+4,166);
  // square icon for favicon
  const ic=document.createElement('canvas');ic.width=512;ic.height=512;icon(ic.getContext('2d'),0,0,512);
  return {logo:lc,icon:ic};
}
