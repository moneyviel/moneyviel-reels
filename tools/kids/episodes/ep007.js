// Ep 7: A Gift for Grandma (generated from spec; maths checks listed in 'checks')
KIT({
"no": 7,
"title": "A Gift for Grandma",
"bg": "dusk",
"checks": [
[
"30/5",
6
],
[
"6*5",
30
]
],
"beats": [
{
"k": "hook",
"text": "What gift can Piggu<br>give Grandma? 🎁",
"prop": "🎁"
},
{
"k": "say",
"who": "piggu",
"text": "Grandma's birthday<br>is soon! 🎂",
"mp": "wow"
},
{
"k": "say",
"who": "sikka",
"text": "A cosy scarf<br>costs 30 coins. 🧣",
"prop": "🧣"
},
{
"k": "show",
"text": "Piggu saves<br>5 coins a day 💪",
"prop": "🧣"
},
{
"k": "guess",
"q": "5 coins a day.<br>How many days<br>to get 30 coins?",
"ans": {
"kind": "stacks",
"n": 6,
"step": 5,
"label": "Day"
},
"answer": "6 days! 🎉"
},
{
"k": "choice",
"setup": "Day 4: a toy robot<br>for 15 coins! 🤖",
"q": "Buy it or<br>keep saving?",
"answer": "Keep saving! 💪",
"explain": "Grandma's gift<br>comes first. 💝"
},
{
"k": "show",
"text": "Piggu also makes<br>a card with love! 💌",
"prop": "💌"
},
{
"k": "win",
"who": "piggu",
"text": "Happy birthday,<br>Grandma! 🎁",
"prop": "🎁"
},
{
"k": "lesson",
"text": "Saving for others<br>feels great! 💝",
"next": "The Wait-a-Day Rule! ⏰"
}
],
"post": {
"story": [
"Grandma's birthday is coming soon! Piggu wants to give her a cosy scarf. It costs 30 coins.",
"Piggu decides to save 5 coins every day."
],
"guess": [
"Piggu saves 5 coins a day. How many days to get 30 coins?",
"<strong>Answer: 6 days!</strong> Count by 5s: 5, 10, 15, 20, 25, 30.",
"On Day 4, Piggu sees a toy robot for 15 coins. Buy it or keep saving? <strong>Keep saving!</strong> Grandma's gift comes first. Piggu also makes a birthday card with love. Grandma is so happy!"
],
"activity": "Make a birthday card for someone you love. Gifts do not have to cost coins: a card, a drawing or a hug is a gift too!",
"yt": "A Gift for Grandma 🎁 Saving for Others Story for Kids | MoneyViel Kids Ep 7",
"desc": "Piggu wants to buy Grandma a scarf for her birthday! 🎁\nPause and guess: 5 coins a day. How many days to get 30 coins?\nOn Day 4, a toy robot appears… buy it or keep saving?\n\nLesson: Saving for others feels great! 💝",
"lesson_short": "Saving for others",
"next": "The Wait-a-Day Rule! ⏰"
}
});
