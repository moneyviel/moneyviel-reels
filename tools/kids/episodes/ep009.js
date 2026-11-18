// Ep 9: The Coin Count Race (generated from spec; maths checks listed in 'checks')
KIT({
"no": 9,
"title": "The Coin Count Race",
"bg": "mint",
"checks": [
[
"10*5",
50
],
[
"50+5",
55
]
],
"beats": [
{
"k": "hook",
"text": "Can you count faster<br>than Piggu? 🏁",
"prop": "🏁"
},
{
"k": "say",
"who": "sikka",
"text": "Coin Count Race!<br>Ready, set… GO! 🏁",
"prop": "🏁",
"ms": "wow"
},
{
"k": "show",
"text": "Each stack = 5 coins",
"sub": "Count by 5s!",
"prop": "🏁"
},
{
"k": "say",
"who": "piggu",
"text": "Count by 5s:<br>5, 10, 15, 20…",
"mp": "think"
},
{
"k": "guess",
"q": "10 stacks of 5 coins.<br>Count by 5s!<br>What is the total?",
"ans": {
"kind": "stacks",
"n": 10,
"step": 5,
"label": ""
},
"answer": "50 coins! 🎉"
},
{
"k": "choice",
"setup": "Sikka adds<br>1 more stack of 5!",
"q": "What is the<br>total now?",
"answer": "55 coins! 🎉",
"explain": "50 + 5 = 55"
},
{
"k": "win",
"who": "piggu",
"text": "Counting by 5s<br>is super fast! 🏁"
},
{
"k": "lesson",
"text": "Count by 5s:<br>5, 10, 15… 🏁",
"next": "Piggu's Broken Toy! 🧸"
}
],
"post": {
"story": [
"It's the Coin Count Race! Each stack has 5 coins.",
"Counting one by one is slow. Counting by 5s is super fast: 5, 10, 15, 20…"
],
"guess": [
"There are 10 stacks of 5 coins. What is the total?",
"<strong>Answer: 50 coins!</strong> 5, 10, 15, 20, 25, 30, 35, 40, 45, 50.",
"Then Sikka adds 1 more stack of 5. Now the total is <strong>55 coins</strong> (50 + 5 = 55)."
],
"activity": "Make piles of 5 with buttons, beads or pebbles. Count them by 5s with a grown-up. How fast can you go?",
"yt": "The Coin Count Race 🏁 Count by 5s Game for Kids | MoneyViel Kids Ep 9",
"desc": "It's the Coin Count Race! 🏁 Can you count faster than Piggu?\nPause and play: 10 stacks of 5 coins. What is the total?\nThen Sikka adds one more stack…\n\nLesson: Count by 5s: 5, 10, 15… 🏁",
"lesson_short": "Counting by 5s",
"next": "Piggu's Broken Toy! 🧸"
}
});
