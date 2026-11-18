// Episode 1: Piggu's Kite Dream  (maths checked: kite ₹60, save ₹10/day -> 6 days; Day 3 candy ₹10 skipped -> still 6 days)
(function(){
const P=(m,x,y,s,extra='')=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200*s}" height="${200*s}" viewBox="0 0 200 200">${extra}${MVK.piggu(m)}</svg>`;
const K=(m,x,y,s)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200*s}" height="${200*s}" viewBox="0 0 200 200">${MVK.sikka(m)}</svg>`;
const bob=(t,a=12,f=2.2)=>Math.sin(t*f*Math.PI)*a;
const B=(txt,x,y,a,ts,{pop})=>`<div class="bubble" style="left:${x}px;top:${y}px;transform:scale(${pop((ts-a)/0.45)});transform-origin:20% 100%;opacity:${ts<a?0:1}">${txt}</div>`;
const kite=(x,y,s,rot=0)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${260*s}" height="${380*s}" viewBox="0 0 260 380"><g transform="rotate(${rot} 130 130)"><path d="M130 0 L260 130 L130 260 L0 130 Z" fill="#ff5c8a"/><path d="M130 0 L130 260 M0 130 L260 130" stroke="#fff" stroke-width="8"/><path d="M130 0 L260 130 L130 130 Z" fill="#ffc533"/><path d="M0 130 L130 260 L130 130Z" fill="#5bc0ff"/><path d="M130 260 q-30 40 0 60 q30 20 0 60" stroke="#3b1f8f" stroke-width="6" fill="none"/></g></svg>`;
const coin=(x,y,s=1)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${90*s}" height="${90*s}" viewBox="0 0 90 90"><circle cx="45" cy="45" r="42" fill="#e39b00"/><circle cx="45" cy="42" r="38" fill="#ffc533"/><text x="45" y="58" text-anchor="middle" font-size="40" font-weight="700" fill="#b06f00" font-family="F">10</text></svg>`;
const big=(txt,top,size,ts,a,{pop},col='#3b1f8f')=>`<div class="big" style="top:${top}px;font-size:${size}px;color:${col};transform:scale(${pop((ts-a)/0.5)});opacity:${ts<a?0:1}">${txt}</div>`;
const cnt=(ts,a,{pop})=>{const n=3-Math.floor(ts-a);if(ts<a||n<1)return'';const f=(ts-a)%1;return `<div class="big" style="top:1240px;font-size:260px;transform:scale(${pop(f/0.5)})">${n}</div>`;};
const confetti=(ts)=>{let s='';for(let i=0;i<60;i++){const x=(i*157)%1080,y=((i*233)%600)-200+ts*700*(0.6+(i%5)/5);const c=['#ff5c8a','#ffc533','#5bc0ff','#7ce08a','#b38bff'][i%5];s+=`<rect x="${x}" y="${y%1920}" width="22" height="34" fill="${c}" transform="rotate(${(ts*200+i*40)%360} ${x} ${y%1920})"/>`;}return `<svg class="abs" style="left:0;top:0" width="1080" height="1920">${s}</svg>`;};
const sky='linear-gradient(180deg,#8fdcff 0%,#c9b6ff 60%,#ffe1ef 100%)';
window.EP={no:1,title:"Piggu's Kite Dream",bg:sky,
 decor:(t)=>{let s='';[[80,300,1],[700,420,1.3],[300,1650,1.1]].forEach(([x,y,k],i)=>{x=(x+t*20*(i+1))%1300-150;s+=`<g transform="translate(${x},${y}) scale(${k})" fill="#fff" opacity=".8"><circle r="50"/><circle cx="55" cy="-20" r="65"/><circle cx="120" r="50"/><rect width="120" height="50"/></g>`});return s;},
 scenes:[
 {t0:0,t1:4,draw:(ts,t,h)=>big('Can a tiny coin<br>buy a BIG dream?',330,100,ts,0.1,h)+P('wow',120,900+bob(ts),3)+K('happy',640,1180+bob(ts+.5),1.9)},
 {t0:4,t1:10,draw:(ts,t,h)=>kite(560,420+bob(ts,18,1),1.3,Math.sin(ts*2)*6)+P('wow',90,1050+bob(ts),2.6)+B('I want that kite! 🪁<br>It costs <b>₹60</b>.',60,760,0.3,ts,h)+K('think',700,1330,1.5)+B("But you have <b>₹0</b>…",380,1150,2.8,ts,h)},
 {t0:10,t1:15,draw:(ts,t,h)=>K('happy',120,820+bob(ts),2.4)+B('Idea! Save <b>₹10</b><br>every day! 💡',380,700,0.3,ts,h)+P('happy',560,1240,2.2)+coin(220,1380,1.4)},
 {t0:15,t1:22,draw:(ts,t,h)=>big('✋ PAUSE &amp; GUESS!',260,96,ts,0,h,'#e0408f')+big('₹10 a day…<br>how many days<br>to get ₹60?',480,84,ts,0.6,h,'#3b1f8f')+cnt(ts,2.2,h)+(ts>=5.2?big('6 days! 🎉',1250,150,ts,5.2,h,'#e0408f'):'')+P('think',380,1500,1.8)},
 {t0:22,t1:31,draw:(ts,t,h)=>{const day=ts<2.4?1+Math.floor(ts/1.2):ts<6.4?3:Math.min(6,4+Math.floor((ts-6.4)/1.2));const ov=ts>2.6&&ts<6.4;let c='';for(let d=0;d<day;d++)c+=coin(130+(d%3)*290,1180+Math.floor(d/3)*150,1.5);
   let s=(ov?'':big(`Day ${day}: ₹${day*10}`,280,110,ts,0,h,'#3b1f8f'))+c+P('happy',330,520+bob(ts),2.5);
   if(ov){s+=`<div class="abs" style="left:0;right:0;top:0;bottom:0;background:rgba(43,29,58,.55)"></div>`+big('🍬 Day 3: Candy for ₹10!',400,80,ts,2.7,h,'#fff').replace('color:#fff','color:#2b1d3a')+big('Need or want?<br>You decide!',620,96,ts,3.2,h,'#ffc533')+(ts>5?big('WANT! Piggu waits 💪',1100,86,ts,5,h,'#7ce08a'):'');}
   return s;}},
 {t0:31,t1:37,draw:(ts,t,h)=>confetti(ts)+kite(560,330+bob(ts,25,1),1.4,Math.sin(ts*3)*10)+P('happy',120,1080+bob(ts,20,3),2.6)+K('wink',690,1320+bob(ts+.3,20,3),1.6)+big('Day 6: KITE TIME! 🪁',1650,92,ts,0.3,h,'#3b1f8f')},
 {t0:37,t1:43,draw:(ts,t,h)=>big('Small coins<br>+ patience<br>= BIG dreams! ⭐',300,104,ts,0,h,'#e0408f')+K('wow',380,1000,1.6)+`<div class="tag" style="top:1450px;opacity:${ts>2?1:0}">Next time: Sikka finds a mystery coin! 🔍</div>`+`<div class="abs" style="left:240px;top:1560px;width:600px;opacity:${ts>2.5?1:0}">${kidsLogo({w:600})}</div>`},
 ]};
window.EP.duration=43;
window.EP.sfx=[[0.2,'level'],[4.5,'slide'],[10.4,'good'],[15.1,'slide'],[17.2,'slide'],[18.2,'slide'],[19.2,'slide'],[20.2,'good'],[22.1,'good'],[23.3,'good'],[24.5,'good'],[24.7,'bad'],[28.5,'good'],[29.7,'good'],[30.9,'good'],[31.1,'level'],[37.1,'good']];
window.EP.outro=40;
})();
