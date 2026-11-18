// Ep 11: Fun at the Fair (generated from spec; maths checks listed in 'checks')
KIT({
"no": 11,
"title": "Fun at the Fair",
"bg": "dusk",
"checks": [
[
"3*15",
45
],
[
"50-45",
5
],
[
"5<10",
true
]
],
"beats": [
{
"k": "hook",
"text": "50 coins at<br>the FAIR! 🎡",
"prop": "🎡"
},
{
"k": "say",
"who": "piggu",
"text": "I want to ride<br>EVERYTHING! 🎢",
"prop": "🎢",
"mp": "wow"
},
{
"k": "say",
"who": "sikka",
"text": "Let's make a<br>plan first! 📝",
"ms": "wink"
},
{
"k": "show",
"text": "3 rides × 15 coins<br>= 45 coins 🎠",
"sub": "Piggu has 50 coins",
"prop": "🎠"
},
{
"k": "guess",
"q": "3 rides cost 45 coins.<br>Piggu has 50.<br>How many are left?",
"ans": {
"kind": "text",
"text": "50 − 45 = 5"
},
"answer": "5 coins left! 🎉"
},
{
"k": "choice",
"setup": "Popcorn costs<br>10 coins! 🍿",
"q": "Can Piggu buy it<br>with 5 coins?",
"answer": "Not enough! 🙅",
"explain": "5 is less than 10.<br>Maybe next time!"
},
{
"k": "win",
"who": "piggu",
"text": "My plan worked!<br>What a day! 🎡",
"prop": "🎡"
},
{
"k": "lesson",
"text": "Make a plan<br>for your coins! 📝",
"next": "Sikka's Coin Garden! 🌱"
}
],
"post": {
"story": [
"Piggu has 50 coins to spend at the fair. \"I want to ride EVERYTHING!\"",
"Sikka says, \"Let's make a plan first!\" Each ride costs 15 coins. Piggu picks 3 rides: 3 × 15 = 45 coins."
],
"guess": [
"The 3 rides cost 45 coins. Piggu has 50 coins. How many coins are left?",
"<strong>Answer: 5 coins!</strong> 50 − 45 = 5.",
"Then Piggu sees popcorn for 10 coins. Can Piggu buy it with 5 coins? <strong>No, not enough.</strong> A plan helps us know what we can and cannot buy."
],
"activity": "Pretend you have 50 coins for a fair. Draw 4 rides and give each a price. Which ones can you choose without going over 50?",
"yt": "Fun at the Fair 🎡 Make a Money Plan Story for Kids | MoneyViel Kids Ep 11",
"desc": "Piggu has 50 coins at the fair! 🎡 Sikka says: make a plan first.\nPause and guess: 3 rides cost 45 coins. How many coins are left?\nThen Piggu sees popcorn for 10 coins…\n\nLesson: Make a plan for your coins! 📝",
"lesson_short": "Making a plan (budget)",
"next": "Sikka's Coin Garden! 🌱"
}
});
