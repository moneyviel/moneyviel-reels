// Ep 8: The Wait-a-Day Rule (generated from spec; maths checks listed in 'checks')
KIT({
"no": 8,
"title": "The Wait-a-Day Rule",
"bg": "sun",
"checks": [
[
"30-25",
5
]
],
"beats": [
{
"k": "hook",
"text": "Want it NOW?<br>Wait a day! ⏰",
"prop": "⏰"
},
{
"k": "say",
"who": "piggu",
"text": "I MUST have that<br>toy right now! 🧸",
"prop": "🧸",
"mp": "wow"
},
{
"k": "show",
"text": "The toy costs<br>25 coins 🧸",
"sub": "Piggu has 30 coins",
"prop": "🧸"
},
{
"k": "guess",
"q": "Toy: 25 coins.<br>Piggu has 30. How many<br>are left after buying?",
"ans": {
"kind": "text",
"text": "30 − 25 = 5"
},
"answer": "Only 5 left! 😮"
},
{
"k": "say",
"who": "sikka",
"text": "Try the<br>Wait-a-Day Rule! ⏰",
"prop": "⏰",
"ms": "wink"
},
{
"k": "show",
"text": "The next day… ☀️",
"sub": "Piggu doesn't want<br>the toy anymore!",
"prop": "😮"
},
{
"k": "choice",
"setup": "Piggu still has<br>all 30 coins!",
"q": "Was waiting<br>a good idea?",
"answer": "YES! 👍",
"explain": "Waiting helps you<br>choose better."
},
{
"k": "win",
"who": "piggu",
"text": "I'm so glad<br>I waited! ⏰"
},
{
"k": "lesson",
"text": "Wait a day<br>before you buy! ⏰",
"next": "The Coin Count Race! 🏁"
}
],
"post": {
"story": [
"Piggu sees a toy and shouts, \"I MUST have it right now!\" The toy costs 25 coins. Piggu has 30 coins.",
"Sikka says, \"Try the Wait-a-Day Rule! Wait one day before you buy.\""
],
"guess": [
"The toy costs 25 coins. Piggu has 30 coins. If Piggu buys it, how many coins are left?",
"<strong>Answer: only 5 coins.</strong> 30 − 25 = 5.",
"The next day, Piggu does not want the toy anymore! Piggu still has all 30 coins. Waiting helped Piggu choose better."
],
"activity": "Next time you really want something, write it on a paper and wait one day. The next day, ask yourself: do I still want it?",
"yt": "The Wait-a-Day Rule ⏰ Smart Buying Story for Kids | MoneyViel Kids Ep 8",
"desc": "Piggu MUST have a toy right now! 🧸 But Sikka has a trick: the Wait-a-Day Rule. ⏰\nPause and guess: the toy is 25 coins and Piggu has 30. How many are left after buying?\nWhat happens the next day?\n\nLesson: Wait a day before you buy! ⏰",
"lesson_short": "Waiting before buying",
"next": "The Coin Count Race! 🏁"
}
});
