// Ep 6: The Price Tag Puzzle (generated from spec; maths checks listed in 'checks')
KIT({
"no": 6,
"title": "The Price Tag Puzzle",
"bg": "sky",
"checks": [
[
"40-25",
15
],
[
"30>25",
true
]
],
"beats": [
{
"k": "hook",
"text": "Same ball…<br>different price?! 🏷️",
"prop": "⚽"
},
{
"k": "say",
"who": "piggu",
"text": "I want a ball!<br>⚽",
"prop": "⚽",
"mp": "wow"
},
{
"k": "show",
"text": "Shop A: 40 coins",
"sub": "Shop B: 25 coins<br>for the SAME ball!",
"prop": "⚽"
},
{
"k": "say",
"who": "sikka",
"text": "Let's compare<br>before we buy! 🔍"
},
{
"k": "guess",
"q": "40 coins or 25 coins.<br>How many coins<br>does Piggu save?",
"ans": {
"kind": "text",
"text": "40 − 25 = 15"
},
"answer": "15 coins saved! 🎉"
},
{
"k": "choice",
"setup": "Shop C: \"SALE!<br>Only 30 coins!\" 🏷️",
"q": "Is 30 cheaper<br>than 25?",
"answer": "No! 25 is less. 👍",
"explain": "Always compare<br>the numbers."
},
{
"k": "win",
"who": "piggu",
"text": "I compared and<br>saved 15 coins! ⚽"
},
{
"k": "lesson",
"text": "Compare prices<br>before you buy! 🔍",
"next": "A Gift for Grandma! 🎁"
}
],
"post": {
"story": [
"Piggu wants a new ball. At Shop A, the ball costs 40 coins.",
"Sikka says, \"Let's compare before we buy!\" At Shop B, the SAME ball costs only 25 coins!"
],
"guess": [
"The ball is 40 coins at Shop A and 25 coins at Shop B. How many coins does Piggu save by buying at Shop B?",
"<strong>Answer: 15 coins!</strong> 40 − 25 = 15.",
"Then Shop C shows a big sign: \"SALE! Only 30 coins!\" Is 30 cheaper than 25? <strong>No!</strong> A big SALE sign does not always mean the lowest price. Always compare the numbers."
],
"activity": "Next time you go shopping with a grown-up, find one thing and look at two prices for it. Which one is less?",
"yt": "The Price Tag Puzzle 🏷️ Compare Prices Story for Kids | MoneyViel Kids Ep 6",
"desc": "Same ball… different price?! 🏷️ Piggu learns to compare before buying.\nPause and guess: 40 coins or 25 coins: how many coins does Piggu save?\nA SALE sign says 30. Is that cheaper than 25?\n\nLesson: Compare prices before you buy! 🔍",
"lesson_short": "Comparing prices",
"next": "A Gift for Grandma! 🎁"
}
});
