// Ep 4: The Need or Want Market (generated from spec; maths checks listed in 'checks')
KIT({
"no": 4,
"title": "The Need or Want Market",
"bg": "dusk",
"checks": [
[
"20-10",
10
],
[
"10<20",
true
]
],
"beats": [
{
"k": "hook",
"text": "NEED or WANT?<br>Can you tell? 🛒",
"prop": "🛒"
},
{
"k": "say",
"who": "sikka",
"text": "Let's go to<br>the market! 🛒",
"prop": "🛒"
},
{
"k": "say",
"who": "piggu",
"text": "I want<br>EVERYTHING! 😆",
"mp": "wow"
},
{
"k": "say",
"who": "sikka",
"text": "First, buy what<br>you NEED.",
"ms": "wink"
},
{
"k": "sort",
"q": "Need or want?",
"items": [
[
"🍎",
"Apple",
"NEED"
],
[
"🚗",
"Toy car",
"WANT"
],
[
"💧",
"Water",
"NEED"
],
[
"⭐",
"Sticker",
"WANT"
]
],
"think": 6
},
{
"k": "choice",
"setup": "Piggu has 20 coins.<br>Apple 10, toy car 20.",
"q": "What first?",
"answer": "The apple! 🍎",
"explain": "Needs first.<br>Wants can wait."
},
{
"k": "win",
"who": "piggu",
"text": "Needs first,<br>then wants! 🍎"
},
{
"k": "lesson",
"text": "Needs first,<br>wants later! 🍎",
"next": "Sikka's Three Magic Jars! ✨"
}
],
"post": {
"story": [
"Piggu and Sikka go to the market. Piggu wants EVERYTHING!",
"Sikka says, \"First, buy what you NEED.\" A need is something we must have, like food and water. A want is nice to have, like a toy or a sticker.",
"Let's sort: an apple is a need. Water is a need. A toy car is a want. A sticker is a want."
],
"guess": [
"Piggu has 20 coins. An apple costs 10 coins and a toy car costs 20 coins. What should Piggu buy first?",
"<strong>Answer: the apple!</strong> Needs come first. Piggu still has 10 coins left, and can save up for the toy car later."
],
"activity": "Draw two boxes on paper: NEED and WANT. Draw 3 things in each box. Ask a grown-up which needs your family buys every week.",
"yt": "The Need or Want Market 🛒 Needs vs Wants Game for Kids | MoneyViel Kids Ep 4",
"desc": "Piggu wants EVERYTHING at the market! 🛒 Can you sort the needs and the wants?\nPause and play: apple, toy car, water, sticker… need or want?\nPiggu has 20 coins: what should Piggu buy first?\n\nLesson: Needs first, wants later! 🍎",
"lesson_short": "Needs and wants",
"next": "Sikka's Three Magic Jars! ✨"
}
});
