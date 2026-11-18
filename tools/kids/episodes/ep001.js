// Episode 1: Piggu's Kite Dream  (v2, 58s)
// Maths checked: kite = 60 coins; save 10 coins a day -> 60/10 = 6 days.
// Day 3 candy (10 coins) is a WANT, Piggu skips it -> savings stay on track -> still 6 days.
(function(){
const P=(m,x,y,s)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200*s}" height="${200*s}" viewBox="0 0 200 200">${MVK.piggu(m)}</svg>`;
const K=(m,x,y,s)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${200*s}" height="${200*s}" viewBox="0 0 200 200">${MVK.sikka(m)}</svg>`;
const bob=(t,a=12,f=2.2)=>Math.sin(t*f*Math.PI)*a;
const talk=(ts,on)=>on?Math.abs(Math.sin(ts*9))*14:0; // speaker hops a little while talking
const kite=(x,y,s,rot=0)=>`<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${260*s}" height="${380*s}" viewBox="0 0 260 380"><g transform="rotate(${rot} 130 130)"><path d="M130 0 L260 130 L130 260 L0 130 Z" fill="#ff5c8a"/><path d="M130 0 L130 260 M0 130 L260 130" stroke="#fff" stroke-width="8"/><path d="M130 0 L260 130 L130 130 Z" fill="#ffc533"/><path d="M0 130 L130 260 L130 130Z" fill="#5bc0ff"/><path d="M130 260 q-30 40 0 60 q30 20 0 60" stroke="#3b1f8f" stroke-width="6" fill="none"/></g></svg>`;
// a little stack of coins with a "10" badge = 10 coins
const stack=(x,y,s=1,lab='10')=>{let c='';for(let i=3;i>=0;i--)c+=`<ellipse cx="60" cy="${70+i*14}" rx="52" ry="20" fill="#e39b00"/><ellipse cx="60" cy="${64+i*14}" rx="52" ry="20" fill="#ffc533"/>`;
  return `<svg class="abs" style="left:${x}px;top:${y}px;overflow:visible" width="${120*s}" height="${140*s}" viewBox="0 0 120 140">${c}<circle cx="96" cy="30" r="28" fill="#3b1f8f"/><text x="96" y="41" text-anchor="middle" font-size="30" font-weight="700" fill="#fff" font-family="F">${lab}</text></svg>`;};
const big=(txt,top,size,ts,a,{pop},col='#3b1f8f')=>`<div class="big" style="top:${top}px;font-size:${size}px;color:${col};transform:scale(${pop((ts-a)/0.5)});opacity:${ts<a?0:1}">${txt}</div>`;
const panel=(top,h,ts,a)=>ts<a?'':`<div class="abs" style="left:50px;right:50px;top:${top}px;height:${h}px;background:rgba(255,255,255,.88);border-radius:60px;box-shadow:0 12px 0 rgba(59,31,143,.15)"></div>`;
const confetti=(ts)=>{let s='';for(let i=0;i<60;i++){const x=(i*157)%1080,y=((i*233)%600)-200+ts*700*(0.6+(i%5)/5);const c=['#ff5c8a','#ffc533','#5bc0ff','#7ce08a','#b38bff'][i%5];s+=`<rect x="${x}" y="${y%1920}" width="22" height="34" fill="${c}" transform="rotate(${(ts*200+i*40)%360} ${x} ${y%1920})"/>`;}return `<svg class="abs" style="left:0;top:0" width="1080" height="1920">${s}</svg>`;};
const sky='linear-gradient(180deg,#8fdcff 0%,#c9b6ff 60%,#ffe1ef 100%)';
// fixed stage spots: Piggu bottom-left, Sikka bottom-right. Bubbles always ABOVE heads, never on a character.
const PG={x:40,y:1260,s:2.5}, SK={x:690,y:1380,s:1.7};
const pHead=[PG.x+250,PG.y+40], sHead=[SK.x+170,SK.y+10];
window.EP={no:1,title:"Piggu's Kite Dream",bg:sky,
 decor:(t)=>{let s='';[[80,300,1],[700,420,1.3],[300,1000,1.1]].forEach(([x,y,k],i)=>{x=(x+t*20*(i+1))%1300-150;s+=`<g transform="translate(${x},${y}) scale(${k})" fill="#fff" opacity=".7"><circle r="50"/><circle cx="55" cy="-20" r="65"/><circle cx="120" r="50"/><rect width="120" height="50"/></g>`});return s;},
 scenes:[
 // 0-4 hook
 {t0:0,t1:4,draw:(ts,t,h)=>big('Can tiny coins<br>buy a BIG dream?',360,104,ts,0.1,h)+P('wow',PG.x,PG.y+bob(ts),PG.s)+K('happy',SK.x,SK.y+bob(ts+.5),SK.s)},
 // 4-9 Piggu wants the kite
 {t0:4,t1:9,draw:(ts,t,h)=>kite(640,240+bob(ts,18,1),1.1,Math.sin(ts*2)*6)+P('wow',PG.x,PG.y-talk(ts,ts>0.3),PG.s)+K('happy',SK.x,SK.y,SK.s)
   +say('piggu','I want that kite! 🪁<br>It costs <b>60 coins</b>.',ts,0.3,{x:50,baseY:1150,w:640,tx:pHead[0],ty:pHead[1]})},
 // 9-13 Sikka: you have 0
 {t0:9,t1:13,draw:(ts,t,h)=>kite(640,240+bob(ts,18,1),1.1,Math.sin(ts*2)*6)+P('think',PG.x,PG.y,PG.s)+K('think',SK.x,SK.y-talk(ts,ts>0.3),SK.s)
   +say('sikka','But Piggu…<br>you have <b>0 coins</b>! 😮',ts,0.3,{x:340,baseY:1280,w:690,tx:sHead[0],ty:sHead[1]})},
 // 13-18 Sikka's idea
 {t0:13,t1:18,draw:(ts,t,h)=>stack(160,360,2.2)+(ts>0.2?`<div class="big" style="left:470px;right:auto;top:440px;font-size:100px;text-align:left">= 10 coins</div>`:'')+P('happy',PG.x,PG.y,PG.s)+K('wink',SK.x,SK.y-talk(ts,ts>0.3),SK.s)
   +say('sikka','Idea! 💡 Save<br><b>10 coins</b> every day!',ts,0.4,{x:340,baseY:1280,w:690,tx:sHead[0],ty:sHead[1]})},
 // 18-31 PAUSE & GUESS: question 1s, think timer 6s, answer held 6s
 {t0:18,t1:31,draw:(ts,t,h)=>{let s=panel(230,620,ts,0)+big('✋ PAUSE &amp; GUESS!',270,88,ts,0,h,'#e0408f')+big('10 coins a day…<br>how many days<br>to get <b>60 coins</b>?',420,80,ts,0.5,h);
   if(ts<7.5){s+=timer(ts,1.5,6,920)+(ts>=1.5?big('Think…🤔',1220,80,ts,1.5,h,'#3b1f8f'):'')+P('think',PG.x,PG.y,PG.s)+K('think',SK.x,SK.y,SK.s);}
   else{const a=7.5;for(let d=0;d<6;d++){const on=ts>=a+d*0.35;if(on)s+=stack(70+d*160,920,1.05)+`<div class="abs" style="left:${70+d*160}px;width:126px;top:1080px;text-align:center;font-size:44px;font-weight:700;color:#3b1f8f;opacity:1">${(d+1)*10}</div><div class="abs" style="left:${70+d*160}px;width:126px;top:1135px;text-align:center;font-size:32px;font-weight:600;color:#6b5a8a">Day ${d+1}</div>`;}
     s+=(ts>=a+2.3?big('6 days! 🎉',1210,130,ts,a+2.3,h,'#e0408f'):'')+P('happy',PG.x,PG.y+30,PG.s*0.9)+K('happy',SK.x,SK.y+30,SK.s*0.9);}
   return s;}},
 // 31-47 saving days with the Day 3 candy test
 {t0:31,t1:47,draw:(ts,t,h)=>{
   // Day1 0-1.5, Day2 1.5-3, Day3 3-4.5, candy test 4.5-12 (question 1s, timer 3s, answer held 3.5s), Day4 12-13.5, Day5 13.5-15, Day6 15-16
   const day=ts<4.5?1+Math.floor(ts/1.5):ts<12?3:Math.min(6,4+Math.floor((ts-12)/1.5));
   const ov=ts>=4.5&&ts<12;let c='';for(let d=0;d<day;d++)c+=stack(110+(d%3)*300,640+Math.floor(d/3)*190,1.3);
   let s=big(`Day ${day}: <b>${day*10} coins</b>`,300,100,ts,0,h,'#3b1f8f')+c+P('happy',PG.x,PG.y+bob(ts),PG.s)+K('happy',SK.x,SK.y,SK.s);
   if(ov){const o=ts-4.5;s+=`<div class="abs" style="left:0;right:0;top:0;bottom:0;background:rgba(43,29,58,.6)"></div>`+panel(260,880,o,0)
     +big('🍬 Day 3: a candy<br>costs 10 coins!',310,84,o,0,h,'#3b1f8f')+big('Need or want?',560,96,o,0.5,h,'#e0408f')
     +(o<4.5?timer(o,1,3,760):'')
     +(o>=4.5?big('A WANT!',730,120,o,4.5,h,'#1f9d55')+big('Piggu skips it<br>and keeps saving 💪',900,72,o,5,h,'#3b1f8f'):'')
     +P(o>=4.5?'wink':'think',PG.x,PG.y,PG.s);}
   return s;}},
 // 47-52 kite time
 {t0:47,t1:52,draw:(ts,t,h)=>confetti(ts)+kite(600,260+bob(ts,25,1),1.2,Math.sin(ts*3)*10)+P('happy',PG.x,PG.y-talk(ts,ts>0.4&&ts<3.5),PG.s)+K('wink',SK.x,SK.y+bob(ts+.3,20,3),SK.s)
   +say('piggu','Day 6: 60 coins!<br>KITE TIME! 🪁',ts,0.4,{x:50,baseY:1150,w:560,tx:pHead[0],ty:pHead[1]})},
 // 52-58 lesson + next time + logo
 {t0:52,t1:58,draw:(ts,t,h)=>panel(250,520,ts,0)+big('Small coins<br>+ patience<br>= BIG dreams! ⭐',290,100,ts,0,h,'#e0408f')+K('wow',400,860,1.4)+`<div class="tag" style="top:1200px;opacity:${ts>1.5?1:0}">Next time: Sikka finds a mystery coin! 🔍</div>`+`<div class="abs" style="left:240px;top:1360px;width:600px;opacity:${ts>2?1:0}">${kidsLogo({w:600})}</div>`},
 ]};
window.EP.duration=58;
window.EP.sfx=[[0.2,'level'],[4.3,'slide'],[9.3,'slide'],[13.4,'good'],[18.1,'slide'],[19.5,'slide'],[20.5,'slide'],[21.5,'slide'],[22.5,'slide'],[23.5,'slide'],[24.5,'slide'],[25.5,'good'],[27.8,'level'],
 [31.1,'good'],[32.5,'good'],[34,'good'],[35.5,'bad'],[37.5,'slide'],[38.5,'slide'],[39.5,'slide'],[40,'level'],[43,'good'],[44.5,'good'],[46,'good'],[47.2,'level'],[52.1,'good']];
window.EP.outro=55;
})();
