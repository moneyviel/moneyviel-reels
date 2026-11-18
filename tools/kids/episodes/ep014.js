// Ep 14: Too Many Snacks (generated from spec; maths checks listed in 'checks')
KIT({
"no": 14,
"title": "Too Many Snacks",
"bg": "dusk",
"checks": [
[
"7*5",
35
],
[
"2*5",
10
],
[
"35-10",
25
]
],
"beats": [
{
"k": "hook",
"text": "Do tiny snacks<br>add up? 🍪",
"prop": "🍪"
},
{
"k": "say",
"who": "piggu",
"text": "A cookie is only<br>5 coins! 🍪",
"prop": "🍪",
"mp": "wow"
},
{
"k": "say",
"who": "sikka",
"text": "What if you buy<br>one every day? 🤔",
"ms": "think"
},
{
"k": "guess",
"q": "5 coins a day<br>for 7 days.<br>How many coins?",
"ans": {
"kind": "stacks",
"n": 7,
"step": 5,
"label": "Day"
},
"answer": "35 coins! 😮"
},
{
"k": "show",
"text": "Treats are fine…",
"sub": "but small spends<br>add up fast!",
"prop": "🍪"
},
{
"k": "choice",
"setup": "New plan: cookies<br>on 2 days only! 🍪",
"q": "How many coins<br>does that cost?",
"answer": "10 coins! 👍",
"explain": "5 + 5 = 10.<br>25 coins saved!"
},
{
"k": "win",
"who": "piggu",
"text": "Small coins<br>add up fast! 🍪"
},
{
"k": "lesson",
"text": "Tiny spends<br>add up! 🍪",
"next": "Coins Around the World! 🌍"
}
],
"post": {
"story": [
"Piggu loves cookies. \"A cookie is only 5 coins!\"",
"Sikka asks, \"What if you buy one every day?\""
],
"guess": [
"A cookie costs 5 coins. Piggu buys one every day for 7 days. How many coins is that?",
"<strong>Answer: 35 coins!</strong> 5 × 7 = 35. Wow, small spends add up fast!",
"Piggu makes a new plan: cookies on 2 days only. That costs 5 + 5 = <strong>10 coins</strong>, and Piggu saves 25 coins. Treats are fine; just keep an eye on them!"
],
"activity": "For one week, draw a small star every time you get a treat. At the end of the week, count your stars with a grown-up.",
"yt": "Too Many Snacks 🍪 Small Spends Add Up Story for Kids | MoneyViel Kids Ep 14",
"desc": "A cookie is only 5 coins… but what if Piggu buys one every day? 🍪\nPause and guess: 5 coins a day for 7 days. How many coins?\nThen Piggu makes a smart new plan!\n\nLesson: Tiny spends add up! 🍪",
"lesson_short": "Small spends add up",
"next": "Coins Around the World! 🌍"
}
});
