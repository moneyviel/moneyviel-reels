// Ep 5: Sikka's Three Magic Jars (generated from spec; maths checks listed in 'checks')
KIT({
"no": 5,
"title": "Sikka's Three Magic Jars",
"bg": "mint",
"checks": [
[
"30/3",
10
],
[
"10+10+10",
30
]
],
"beats": [
{
"k": "hook",
"text": "Can 3 jars make you<br>a money hero? ✨",
"prop": {
"svg": "<g><rect x=\"4\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#e8fff1\" stroke=\"#1f9d55\" stroke-width=\"2.5\"/><rect x=\"7\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#1f9d55\"/><text x=\"17\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#1f9d55\">SAVE</text></g><g><rect x=\"37\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#fff0f6\" stroke=\"#e0408f\" stroke-width=\"2.5\"/><rect x=\"40\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#e0408f\"/><text x=\"50\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#e0408f\">SPEND</text></g><g><rect x=\"70\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#eef7ff\" stroke=\"#2f80ed\" stroke-width=\"2.5\"/><rect x=\"73\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#2f80ed\"/><text x=\"83\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#2f80ed\">SHARE</text></g><circle cx=\"17\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"50\" cy=\"66\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"83\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/>"
}
},
{
"k": "say",
"who": "sikka",
"text": "Let's make<br>3 magic jars! ✨",
"prop": {
"svg": "<g><rect x=\"4\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#e8fff1\" stroke=\"#1f9d55\" stroke-width=\"2.5\"/><rect x=\"7\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#1f9d55\"/><text x=\"17\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#1f9d55\">SAVE</text></g><g><rect x=\"37\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#fff0f6\" stroke=\"#e0408f\" stroke-width=\"2.5\"/><rect x=\"40\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#e0408f\"/><text x=\"50\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#e0408f\">SPEND</text></g><g><rect x=\"70\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#eef7ff\" stroke=\"#2f80ed\" stroke-width=\"2.5\"/><rect x=\"73\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#2f80ed\"/><text x=\"83\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#2f80ed\">SHARE</text></g><circle cx=\"17\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"50\" cy=\"66\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"83\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/>"
},
"ms": "wink"
},
{
"k": "show",
"text": "SAVE · SPEND · SHARE",
"sub": "One jar for each!",
"prop": {
"svg": "<g><rect x=\"4\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#e8fff1\" stroke=\"#1f9d55\" stroke-width=\"2.5\"/><rect x=\"7\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#1f9d55\"/><text x=\"17\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#1f9d55\">SAVE</text></g><g><rect x=\"37\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#fff0f6\" stroke=\"#e0408f\" stroke-width=\"2.5\"/><rect x=\"40\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#e0408f\"/><text x=\"50\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#e0408f\">SPEND</text></g><g><rect x=\"70\" y=\"34\" width=\"26\" height=\"40\" rx=\"7\" fill=\"#eef7ff\" stroke=\"#2f80ed\" stroke-width=\"2.5\"/><rect x=\"73\" y=\"28\" width=\"20\" height=\"7\" rx=\"2\" fill=\"#2f80ed\"/><text x=\"83\" y=\"90\" text-anchor=\"middle\" font-family=\"F\" font-weight=\"700\" font-size=\"9\" fill=\"#2f80ed\">SHARE</text></g><circle cx=\"17\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"50\" cy=\"66\" r=\"5\" fill=\"#ffc533\"/><circle cx=\"83\" cy=\"64\" r=\"5\" fill=\"#ffc533\"/>"
}
},
{
"k": "say",
"who": "piggu",
"text": "I have 30 coins.<br>How do I split them?",
"mp": "think"
},
{
"k": "guess",
"q": "30 coins in 3 jars.<br>The same in each.<br>How many per jar?",
"ans": {
"kind": "text",
"text": "10 + 10 + 10 = 30"
},
"answer": "10 coins each! 🎉"
},
{
"k": "choice",
"setup": "A friend's pencil<br>broke! ✏️",
"q": "SAVE jar or<br>SHARE jar?",
"answer": "The SHARE jar! 💝",
"explain": "Sharing makes<br>friends happy!"
},
{
"k": "win",
"who": "sikka",
"text": "Save, spend<br>and share! 💝"
},
{
"k": "lesson",
"text": "Save, spend<br>and share! ✨",
"next": "The Price Tag Puzzle! 🏷️"
}
],
"post": {
"story": [
"Sikka has a great idea: three magic jars! One says SAVE, one says SPEND and one says SHARE.",
"The SAVE jar is for big dreams. The SPEND jar is for small treats. The SHARE jar is for helping others.",
"Piggu has 30 coins. How should Piggu put them in the jars?"
],
"guess": [
"Piggu puts the same number of coins in each of the 3 jars. How many coins go in each jar?",
"<strong>Answer: 10 coins in each jar!</strong> 10 + 10 + 10 = 30.",
"Then a friend's pencil breaks. Which jar should Piggu use? <strong>The SHARE jar!</strong> Sharing makes friends happy."
],
"activity": "Make your own three jars from cups or boxes. Write SAVE, SPEND and SHARE on them. Decorate them with crayons!",
"yt": "Sikka's Three Magic Jars ✨ Save, Spend, Share Story for Kids | MoneyViel Kids Ep 5",
"desc": "Sikka makes 3 magic jars: SAVE, SPEND and SHARE! ✨\nPause and guess: Piggu splits 30 coins into 3 jars equally. How many in each?\nA friend's pencil breaks… which jar should Piggu use?\n\nLesson: Save, spend and share! 💝",
"lesson_short": "Save, spend and share",
"next": "The Price Tag Puzzle! 🏷️"
}
});
