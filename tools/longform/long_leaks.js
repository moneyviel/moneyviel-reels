// Main channel long video: "8 Small Money Leaks" — every number computed here (window.N) and checked in the sheet report.
(function(){
const L=[
 {e:'☕',name:'Daily tea or coffee and a snack outside',how:'₹60 a day',year:60*365,fix:'Carry a flask from home 3 days a week. Keep the outside chai as a treat.'},
 {e:'🛵',name:'Food delivery 3 times a week',how:'If each order costs ₹150 more than cooking at home: ₹450 a week',year:150*3*52,fix:'Cook a big batch on Sunday. Keep one order a week as a treat.'},
 {e:'📺',name:'Forgotten app subscriptions',how:'3 subscriptions × ₹199 a month that you hardly use',year:3*199*12,fix:"Check your bank statement once a month. Cancel what you didn't use."},
 {e:'⏰',name:'Late payment fees',how:'A ₹500 late fee, just 2 times a year',year:500*2,fix:'Use auto-pay or a reminder 3 days before every due date. Late payments on cards and loans can also hurt your credit score.'},
 {e:'🛍️',name:'Impulse "sale" buys',how:'₹1,500 a month on things you did not plan to buy',year:1500*12,fix:'Use a 48-hour rule: if you still want it 2 days later, then decide.'},
 {e:'💧',name:'Bottled water and cold drinks on the go',how:'₹40 a day',year:40*365,fix:'Carry a refillable water bottle from home.'},
 {e:'🚕',name:'Cab instead of bus or metro',how:'Twice a week, ₹200 more than public transport',year:200*2*52,fix:'Plan trips ahead. Keep cabs for late nights, rain and heavy bags.'},
 {e:'📱',name:'A new phone every year',how:'A ₹20,000 phone every year instead of every 3 years (before resale value)',year:20000-20000/3,fix:'Buy a good phone, protect it with a case, and keep it for 3 years or more.'},
];
const total=L.reduce((a,l)=>a+l.year,0), fixTwo=L[0].year+L[2].year;
// 'year' is per year; the leak scene shows ≈ per month (year/12), per year, and ×10 (just adding)
window.N={years:L.map(l=>Math.round(l.year)),total:Math.round(total),ten:Math.round(total*10),fixTwo,fixTwoMonth:fixTwo/12,lakh:(total/1e5).toFixed(2)};
const leak=(i,ch)=>({type:'leak',ch,dur:30,n:i+1,emoji:L[i].e,name:L[i].name,how:L[i].how,year:L[i].year,fix:L[i].fix});
LONG({slug:'money-leaks',
chapters:['Intro','Leaks 1–4','Leaks 5–8','Your total','Fix plan'],
scenes:[
{type:'title',ch:0,dur:9,kicker:'MONEY LEAKS',title:'8 small money leaks that<br>quietly cost you lakhs',sub:"Guess each yearly cost · count your leaks · simple fixes"},
{type:'big',ch:0,dur:9,text:'Small leaks, big losses. 💧',sub:'Grab a pen ✍️ and count how many of these 8 leaks you have.<br>Keep score till the end!'},
{type:'big',ch:0,dur:9,size:72,text:'How to play',sub:'For each leak, guess the YEARLY cost before the timer ends.<br>These are example numbers: yours may be higher or lower.'},
leak(0,1),leak(1,1),leak(2,1),leak(3,1),
{type:'big',ch:1,dur:6,size:80,text:'Halfway! ✍️',sub:'How many leaks have you counted so far?'},
leak(4,2),leak(5,2),leak(6,2),leak(7,2),
{type:'bars',ch:3,dur:20,title:'All 8 leaks: cost per year',rowh:76,gap:.55,items:L.map((l,i)=>[`${l.e} Leak ${i+1}`,Math.round(l.year),['#E0408F','#FFB020','#2fd3b5','#9b86ff','#E0408F','#FFB020','#2fd3b5','#9b86ff'][i]])},
{type:'big',ch:3,dur:12,text:`If ALL 8 apply to you:<br><span class="gold">${inr(total)} a year</span>`,sub:`About ${inr(total*10)} in 10 years (₹12 lakh), just adding it up:<br>no growth and no price rises. Most people have only a few.`,subTop:600},
{type:'score',ch:3,dur:13,title:"What's your leak score?",items:[['0–2','Leak-proof! 💪','#1f9d55'],['3–5','Fix 2 this month','#FFB020'],['6–8','Big savings waiting! 🎯','#E0408F']],note:'No guilt: every leak you fix is money back in your pocket.'},
{type:'step',ch:4,dur:17,n:'2',label:'FIX',title:'The 2-leak plan',lines:["Don't try to fix everything at once.",'Pick the <b class="gold">2 biggest</b> leaks you really have.','On the same day you save, move that money to savings or a goal.']},
{type:'pause',ch:4,dur:16,q:`Fix leak 1 (${inr(L[0].year)}) + leak 3 (${inr(L[2].year)}).<br>How much saved in a year?`,qsize:58,answer:inr(fixTwo)+' a year',asize:96,work:`${inr(L[0].year)} + ${inr(L[2].year)} = ${inr(fixTwo)}, about ${inr(fixTwo/12)} a month for your goals. 🎯`},
{type:'check',ch:4,dur:18,title:'Your Leak-Fix Checklist ✅',gap:1.8,items:['Count your leaks today (be honest!)','Pick the 2 biggest ones','Set one simple rule for each (flask, 48-hour rule, auto-pay…)','Move the money you save on the same day','Check again next month and celebrate 🎉']},
{type:'cta',ch:4,dur:16,title:'Put the money you save to work (free)',tools:[['🗓️','52-Week Money Challenge','One small money habit a week, step by step.'],['🎯','Goal Planner','Turn the money you save into a clear goal and date.']],ask:'Comment your leak score (0–8)! 👇'},
{type:'end',ch:4,dur:8,text:'New money videos every Tuesday & Friday',sub:'Subscribe so you never miss one 🔔'},
]});
})();
