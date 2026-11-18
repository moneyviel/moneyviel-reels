// Ep 12: Sikka's Coin Garden (generated from spec; maths checks listed in 'checks')
KIT({
"no": 12,
"title": "Sikka's Coin Garden",
"bg": "mint",
"checks": [
[
"10*10",
100
]
],
"beats": [
{
"k": "hook",
"text": "Can coins GROW<br>like plants? 🌱",
"prop": "🌱"
},
{
"k": "say",
"who": "sikka",
"text": "Seeds grow a little<br>every day. 🌱",
"prop": "🌱"
},
{
"k": "say",
"who": "piggu",
"text": "Can my coins<br>grow too? 🤔",
"mp": "think"
},
{
"k": "show",
"text": "Plant coins in your<br>SAVE jar every week!",
"sub": "Keep adding and<br>watch savings grow!",
"prop": "🌱"
},
{
"k": "guess",
"q": "10 coins a week<br>for 10 weeks.<br>How many coins?",
"ans": {
"kind": "stacks",
"n": 10,
"step": 10,
"label": "Week"
},
"answer": "100 coins! 🎉"
},
{
"k": "choice",
"setup": "Piggu takes coins out<br>every day! 😮",
"q": "Will the savings<br>grow more or less?",
"answer": "Less! 🐢",
"explain": "Keep adding and<br>leave them in."
},
{
"k": "win",
"who": "sikka",
"text": "Patience helps<br>savings grow! 🌱",
"prop": "🌱"
},
{
"k": "lesson",
"text": "Keep adding,<br>watch it grow! 🌱",
"next": "Trade Day at school! 🔄"
}
],
"post": {
"story": [
"Sikka plants a seed. Every day it grows a tiny bit. After many days, it is a big plant!",
"\"Can my coins grow too?\" asks Piggu. Sikka says, \"Yes! Put a few coins in your SAVE jar every week. Keep adding, and your savings grow!\""
],
"guess": [
"Piggu puts 10 coins in the SAVE jar every week for 10 weeks. How many coins are in the jar?",
"<strong>Answer: 100 coins!</strong> 10, 20, 30, 40, 50, 60, 70, 80, 90, 100.",
"What if Piggu takes coins out every day? Then the savings grow <strong>less</strong>. Keep adding and leave them in."
],
"activity": "Draw a plant with 10 leaves. Each week you save, colour one leaf. When all 10 leaves are coloured, your savings plant is fully grown!",
"yt": "Sikka's Coin Garden 🌱 How Savings Grow Story for Kids | MoneyViel Kids Ep 12",
"desc": "Can coins grow like plants? 🌱 Sikka shows Piggu how savings grow.\nPause and guess: 10 coins a week for 10 weeks. How many coins?\nBut what if Piggu takes coins out every day?\n\nLesson: Keep adding, watch it grow! 🌱",
"lesson_short": "Savings grow when you keep adding",
"next": "Trade Day at school! 🔄"
}
});
