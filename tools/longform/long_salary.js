// Main channel long video: "Salary Day Plan" — every number computed here (see N) and printed by check.js.
(function(){
const pay=30000;
const before=[['Rent',9000],['Food & groceries',6000],['Travel',2000],['Electricity, phone & internet',1500],['Eating out & shopping',8000],['Random small spends',3500]];
const beforeTotal=before.reduce((a,r)=>a+r[1],0);
const ess=[['Rent',9000],['Food & groceries',6000],['Travel',2000],['Electricity, phone & internet',1500]];
const essTotal=ess.reduce((a,r)=>a+r[1],0);
const save=pay*0.10, efTarget=essTotal*3, efMonths=efTarget/save;
const yearly=[['Festivals',6000],['Birthdays & gifts',3600],['Repairs',2400]], yearlyTotal=yearly.reduce((a,r)=>a+r[1],0), yearlyMonthly=yearlyTotal/12;
const fun=pay-save-essTotal-yearlyMonthly, weeksPerMonth=52/12, funWeek=fun/weeksPerMonth;
const leakDay=150, leakYear=leakDay*365;
const raise=3000, saveAfterRaise=save+raise/2;
const fixable=8000+3500;
window.N={pay,beforeTotal,essTotal,save,efTarget,efMonths,yearlyTotal,yearlyMonthly,fun,funWeek,leakYear,saveAfterRaise,fixable,fixableShare:fixable/pay,needsShare:essTotal/pay};
LONG({slug:'salary-day-plan',
chapters:['Intro','Step 1–2','Step 3','Step 4–5','Step 6–7','Checklist'],
scenes:[
{type:'title',ch:0,dur:8,kicker:'SALARY DAY PLAN',title:'Where should your salary<br>go FIRST?',sub:'7 simple steps · a ₹30,000 example · free checklist at the end'},
{type:'big',ch:0,dur:7,text:'Salary on the 1st…<br>gone by the 20th? 😩',sub:"Let's fix that, one step at a time."},
{type:'say',ch:0,dur:11,emoji:'👩',name:'Neha, 26',lines:[`I take home <b>${inr(pay)}</b> a month.`,'Every month I end up with <b>₹0</b> saved.','Where does my money go? 🤔']},
{type:'table',ch:0,dur:16,title:"Neha's month (before)",rows:before.map(([l,v],i)=>[l,v,i>=4?'#E0408F':null]),total:['Total spent',beforeTotal],note:'Saved at the end of the month: <b class="mag">₹0</b>'},
{type:'pause',ch:0,dur:15,q:'Which TWO lines would be<br>the easiest to cut?',answer:'Eating out + small spends',asize:84,work:`Together that's <b class="gold">${inr(fixable)}</b> a month: more than a third of her pay!`},
{type:'step',ch:1,dur:16,n:1,title:'Pay yourself FIRST',lines:['On salary day, move your savings out <b>before</b> you spend anything.',`Start with 10% if you can: <b class="gold">${inr(save)}</b> for Neha. Even ₹500 is a good start.`,'Many banks let you set up an automatic transfer for salary day.']},
{type:'big',ch:1,dur:8,size:76,text:'Save first, spend the rest.<br><span class="mut">Not spend first, save the rest.</span>'},
{type:'step',ch:1,dur:15,n:2,title:'Pay fixed bills next',lines:['Rent, electricity, phone, internet, travel pass, loan EMIs.','Write every due date in one list.','Late fees are money thrown away.']},
{type:'step',ch:2,dur:17,n:3,title:'Build an emergency fund',lines:['Money only for real emergencies: job loss, illness, urgent repairs.','A common rule of thumb: <b class="gold">3 to 6 months</b> of essential costs.','Keep it separate from your spending account.']},
{type:'table',ch:2,dur:13,title:"Neha's essential costs per month",rows:ess,total:['Essentials',essTotal]},
{type:'pause',ch:2,dur:15,q:`3 months of ${inr(essTotal)} = ?`,answer:inr(efTarget),work:`${inr(essTotal)} × 3 = ${inr(efTarget)}. That's Neha's first target.`},
{type:'pause',ch:2,dur:16,q:`Saving ${inr(save)} a month,<br>how many months to reach ${inr(efTarget)}?`,answer:'About 19 months',asize:96,work:`${inr(efTarget)} ÷ ${inr(save)} = ${efMonths}, so about a year and a half.<br>Slow is OK. Steady wins. 💪`},
{type:'step',ch:3,dur:17,n:4,title:'Plan for yearly costs',lines:['Festivals, birthdays, yearly fees, repairs, insurance premiums.',"They're not surprises: they come every year!",'Add up the yearly total, divide by 12, save that every month.']},
{type:'pause',ch:3,dur:16,q:`Festivals ${inr(6000)} + gifts ${inr(3600)} + repairs ${inr(2400)}<br>a year. How much per month?`,qsize:58,answer:`${inr(yearlyMonthly)} a month`,work:`${inr(yearlyTotal)} ÷ 12 = ${inr(yearlyMonthly)}. No more "surprise" expenses!`},
{type:'step',ch:3,dur:16,n:5,title:'Give fun money a limit',lines:["What's left is guilt-free spending money.","Split it by week, so the month doesn't run out early.","When this week's money is gone, wait for next week."]},
{type:'table',ch:3,dur:17,title:"Neha's new plan",step:1.2,rows:[['Take-home pay',pay,'#1f9d55'],['Step 1: savings',-save,'#E0408F'],['Essentials',-essTotal,'#E0408F'],['Step 4: yearly costs',-yearlyMonthly,'#E0408F']],total:['Left for fun & personal',fun]},
{type:'pause',ch:3,dur:15,q:`${inr(fun)} a month for fun.<br>About how much per week?`,answer:`About ${inr(1700)} a week`,asize:92,work:`A month has about 4.33 weeks: ${inr(fun)} ÷ 4.33 ≈ ${inr(fun/4.33)}.<br>Round down to ${inr(1700)} to stay safe.`},
{type:'step',ch:4,dur:14,n:6,title:'Watch small daily spends',lines:['Tea, snacks, delivery fees, "just ₹99" buys…','Small amounts every day add up fast.']},
{type:'pause',ch:4,dur:16,q:`${inr(leakDay)} a day on small spends.<br>How much in a year?`,answer:`${inr(leakYear)}!`,work:`${inr(leakDay)} × 365 = ${inr(leakYear)}: almost Neha's whole emergency fund target (${inr(efTarget)}).`},
{type:'step',ch:4,dur:16,n:7,title:'Save half of every raise',lines:['When your pay goes up, raise your savings too.',`Example: a ${inr(raise)} raise → save ${inr(raise/2)} more.`,`Neha's savings: ${inr(save)} → <b class="gold">${inr(saveAfterRaise)}</b> a month.`]},
{type:'bars',ch:4,dur:14,title:'Neha saves per month',items:[['Before the plan',0,'#8f88bf'],['With the plan',save,'#2fd3b5'],['After her first raise',saveAfterRaise,'#FFB020']],note:`That's ${inr(save*12)} to ${inr(saveAfterRaise*12)} a year saved instead of spent.`},
{type:'check',ch:5,dur:19,title:'Your Salary Day Checklist ✅',fs:36,gap:1.7,items:['Move savings out first (start with 10%)','Pay fixed bills on time','Build a 3–6 month emergency fund','Save monthly for yearly costs','Give fun money a weekly limit','Watch small daily spends','Save half of every raise']},
{type:'pause',ch:5,dur:13,think:4,q:'Quick quiz: what comes FIRST<br>on salary day?',answer:'Pay yourself first! 💪',asize:96,work:'Move your savings out before you spend anything.'},
{type:'cta',ch:5,dur:16,title:'Try it with YOUR numbers (free)',tools:[['🛟','Emergency Fund Calculator','How much safety money do you need, and how long will it take?'],['🩺','Money Health Report','A free 2-minute money check-up with your next steps.']],ask:'Comment: which step will you start this month? 👇'},
{type:'end',ch:5,dur:8,text:'New money videos every Tuesday & Friday',sub:'Subscribe so you never miss one 🔔'},
]});
})();
