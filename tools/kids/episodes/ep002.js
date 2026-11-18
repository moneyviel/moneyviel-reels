// Ep 2: Sikka's Mystery Coin. Maths: collection counts COINS (objects), not value: 20 + 5 = 25.
(function(){
const mc={svg:'<circle cx="50" cy="50" r="46" fill="#8d99ae"/><circle cx="50" cy="48" r="42" fill="#dfe6ee"/><path d="M50 22 l7 15 16 2 -12 11 3 16 -14 -8 -14 8 3 -16 -12 -11 16 -2z" fill="#b8c4d2"/><text x="50" y="60" text-anchor="middle" font-family="F" font-weight="700" font-size="22" fill="#4a5568">5</text>'};
KIT({no:2,title:"Sikka's Mystery Coin",bg:'mint',
checks:[['20+5',25]],
beats:[
{k:'hook',text:'What is this<br>MYSTERY coin? 🔍',prop:mc},
{k:'say',who:'sikka',text:'Look what I found<br>under the sofa! ✨',prop:mc,ms:'wow'},
{k:'say',who:'piggu',text:'It looks so different<br>from you, Sikka!',prop:mc,mp:'wow',ms:'think'},
{k:'choice',setup:'🔍 A coin found at home!',q:'Keep it or<br>tell a grown-up?',answer:'Tell a grown-up!',explain:'Found money?<br>Always tell a<br>grown-up first. 👍'},
{k:'show',text:'Grandma says it is<br>from her trip! 🌍',sub:'Different countries use<br>different money!',prop:'🌍'},
{k:'say',who:'sikka',text:'Coins can look different<br>in other countries!',ms:'happy'},
{k:'show',text:'Grandma gives Piggu<br>5 travel coins! 🎁',prop:'🎁'},
{k:'guess',q:"Piggu's collection<br>has 20 coins. Add 5.<br>How many now?",ans:{kind:'text',text:'20 + 5 = 25'},answer:'25 coins! 🎉'},
{k:'win',who:'piggu',text:'My coin collection<br>is growing! 🌍'},
{k:'lesson',text:'Different countries<br>use different<br>money! 🌍',next:'Piggu opens a lemonade stand! 🍋'},
],
post:{lesson:'Different countries use different money',
 story:["Sikka finds a shiny coin under the sofa. It is silver, with a star on it. It looks very different from Sikka!","Should Sikka keep it? No! When you find money, always tell a grown-up first. So Piggu and Sikka show it to Grandma.","Grandma smiles. \"This coin is from my trip to a faraway country!\" Different countries use different money. Coins can have different shapes, colours and pictures.","Grandma gives Piggu 5 travel coins for Piggu's coin collection."],
 guess:["Piggu's coin collection has 20 coins. Grandma adds 5 more. How many coins are in the collection now?","<strong>Answer: 25 coins!</strong> 20 + 5 = 25."],
 activity:"Ask a grown-up if you can look at some coins together. Draw two coins: one you know, and one you imagine from a faraway land. What picture would your coin have?",
 yt:"Sikka's Mystery Coin 🔍 Money Around the World Story for Kids | MoneyViel Kids Ep 2",
 desc:"Sikka finds a shiny mystery coin under the sofa! 🔍 Should Sikka keep it, or tell a grown-up?\nGrandma says it is from her trip far away. 🌍\nPause and guess: Piggu's collection has 20 coins. Grandma adds 5. How many now?\n\nLesson: Different countries use different money! 🌍"},
});
})();
