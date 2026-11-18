// Ep 10: Piggu's Broken Toy (generated from spec; maths checks listed in 'checks')
KIT({
"no": 10,
"title": "Piggu's Broken Toy",
"bg": "sky",
"checks": [
[
"50-10",
40
]
],
"beats": [
{
"k": "hook",
"text": "Oh no! The teddy<br>is broken! 🧸",
"prop": "🧸"
},
{
"k": "say",
"who": "piggu",
"text": "My teddy's arm<br>came off! 😢",
"prop": "🧸",
"mp": "think"
},
{
"k": "show",
"text": "A new teddy:<br>50 coins",
"sub": "Fixing it:<br>10 coins",
"prop": "🧵"
},
{
"k": "say",
"who": "sikka",
"text": "Let's fix it<br>instead! 🧵",
"prop": "🧵",
"ms": "wink"
},
{
"k": "guess",
"q": "New: 50 coins.<br>Fix: 10 coins.<br>How many are saved?",
"ans": {
"kind": "text",
"text": "50 − 10 = 40"
},
"answer": "40 coins saved! 🎉"
},
{
"k": "choice",
"setup": "How can toys<br>last longer?",
"q": "Toss them around<br>or put them away?",
"answer": "Put them away! 📦",
"explain": "Take care of<br>your things."
},
{
"k": "win",
"who": "piggu",
"text": "Teddy is<br>as good as new! 🧸",
"prop": "🧸"
},
{
"k": "lesson",
"text": "Take care of<br>your things! 🧸",
"next": "Fun at the Fair! 🎡"
}
],
"post": {
"story": [
"Oh no! Piggu's teddy has a broken arm. Piggu is sad.",
"A new teddy costs 50 coins. But fixing the old one with needle and thread costs only 10 coins. Sikka says, \"Let's fix it instead!\""
],
"guess": [
"A new teddy costs 50 coins. Fixing it costs 10 coins. How many coins does Piggu save by fixing it?",
"<strong>Answer: 40 coins!</strong> 50 − 10 = 40.",
"How can toys last longer? <strong>Put them away</strong> after playing, and handle them gently."
],
"activity": "Tidy-up time! Put all your toys back in their places today. Is any toy broken? Ask a grown-up if you can fix it together.",
"yt": "Piggu's Broken Toy 🧸 Fix It and Save Story for Kids | MoneyViel Kids Ep 10",
"desc": "Oh no! Piggu's teddy is broken! 🧸 Buy a new one, or fix it?\nPause and guess: new teddy 50 coins, fixing it 10 coins. How many coins are saved?\n\nLesson: Take care of your things! 🧸",
"lesson_short": "Taking care of things",
"next": "Fun at the Fair! 🎡"
}
});
