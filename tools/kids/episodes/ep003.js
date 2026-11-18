// Ep 3: The Lemonade Stand (generated from spec; maths checks listed in 'checks')
KIT({
"no": 3,
"title": "The Lemonade Stand",
"bg": "sun",
"checks": [
[
"6*5",
30
],
[
"30-10",
20
]
],
"beats": [
{
"k": "hook",
"text": "Can Piggu EARN<br>coins today? 🍋",
"prop": "🍋"
},
{
"k": "say",
"who": "piggu",
"text": "I want to earn<br>my own coins!",
"mp": "wow"
},
{
"k": "say",
"who": "sikka",
"text": "Let's make a<br>lemonade stand! 🍋",
"prop": "🍋",
"ms": "wink"
},
{
"k": "show",
"text": "Lemons cost<br>10 coins 🍋",
"sub": "Each cup sells<br>for 5 coins",
"prop": "🥤"
},
{
"k": "show",
"text": "Piggu squeezes, stirs<br>and serves! 💪",
"prop": "🥤"
},
{
"k": "guess",
"q": "Piggu sells 6 cups.<br>5 coins each.<br>How many coins?",
"ans": {
"kind": "stacks",
"n": 6,
"step": 5,
"label": "Cup"
},
"answer": "30 coins! 🎉"
},
{
"k": "choice",
"setup": "But the lemons<br>cost 10 coins!",
"q": "How many coins<br>are left?",
"answer": "20 coins left!",
"explain": "30 − 10 = 20 💪"
},
{
"k": "win",
"who": "piggu",
"text": "I earned 20 coins<br>by working! 🍋"
},
{
"k": "lesson",
"text": "Work hard,<br>earn coins! 💪",
"next": "The Need or Want Market! 🛒"
}
],
"post": {
"story": [
"Piggu wants to earn some coins. \"How can I do it?\" asks Piggu.",
"Sikka has an idea: \"Let's make a lemonade stand!\" The lemons cost 10 coins. Each cup of lemonade sells for 5 coins.",
"Piggu squeezes the lemons, stirs the lemonade and serves happy friends. That is hard work!"
],
"guess": [
"Piggu sells 6 cups. Each cup is 5 coins. How many coins does Piggu get?",
"<strong>Answer: 30 coins!</strong> Count by 5s: 5, 10, 15, 20, 25, 30.",
"But wait! The lemons cost 10 coins. So Piggu keeps 30 − 10 = <strong>20 coins</strong>. That is what Piggu really earned."
],
"activity": "Play shop at home! Make price tags of 5 coins for toy cups. Sell 4 cups to a grown-up. How many coins did you get? (4 × 5 = 20)",
"yt": "The Lemonade Stand 🍋 How to Earn Coins Story for Kids | MoneyViel Kids Ep 3",
"desc": "Piggu wants to earn coins! 🍋 Sikka has an idea: a lemonade stand.\nPause and guess: 6 cups at 5 coins each. How many coins?\nBut the lemons cost 10 coins… how many are left?\n\nLesson: Work hard, earn coins! 💪",
"lesson_short": "Earning by working",
"next": "The Need or Want Market! 🛒"
}
});
