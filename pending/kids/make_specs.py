import json, re

DISC = "This content is for general education only and is not financial, investment, tax or legal advice. Please consult a qualified professional before making financial decisions."

# Count-the-coins sums (computed, not typed)
s1 = 2*10 + 3*5          # two ₹10 notes + three ₹5 coins
s2 = 50 - 18             # ₹50, buys pencil box ₹18
s3 = 4*20 + 2*2          # four ₹20 notes + two ₹2 coins
s4 = 15 + 10 - 5

posts = [
 {"date":"2026-11-16","emoji":"🐷","day":"Mon","title":"Riya's Piggy Bank Race",
  "excerpt":"Riya learns that a little money saved every day can grow into something big.",
  "body":[
   "Riya wants a red skipping rope. It costs ₹60.",
   "Her piggy bank is empty. \"I will never get it!\" she says.",
   "Grandma smiles. \"Put in ₹5 every day. Let us see what happens.\"",
   "On Monday, Riya puts in ₹5. Clink! On Tuesday, ₹5 more. Clink, clink!",
   "Some days she wants a toffee instead. She thinks of the red rope and keeps the coin.",
   "After 12 days, Riya opens her piggy bank. She counts ₹5 twelve times. It is ₹60!",
   "On day 3, her friend Sana asks, \"Why are you putting coins in a pig?\" Riya says, \"It is my rope money!\"",
   "On day 7, Riya shakes the piggy bank. It is heavier now. It makes a happy jingle.",
   "Riya makes a chart on paper. She draws one small circle for every ₹5. She colours a circle each day. Twelve circles make one rope.",
   "Some days are hard. Her cousin buys a balloon at the fair. Riya wants one too. But she looks at her chart. Only four circles left!",
   "She tells herself, \"I can wait.\" Waiting feels long, but it is not forever.",
   "Grandma claps. \"You did it all by yourself!\"",
   "Riya buys the red rope. She skips all the way home. \"Small coins make big things,\" she sings."],
  "try":"Try it today: Pick one thing you want. Find out its price. Count how many days of saving it will take.",
  "grown":"Your child learns that regular small saving reaches a goal. Ask: \"What would you like to save for, and how many days might it take?\""},
 {"date":"2026-11-17","emoji":"🤔","day":"Tue","title":"The Round Tummy Riddle",
  "excerpt":"Can you guess what this riddle is about? A fun puzzle about where we keep money safe.",
  "body":[
   "Here is a riddle for you. Read it slowly. Then guess!",
   "I have a round tummy. I have a little slot on top. You feed me coins, but I never eat them. I keep them safe until you need them.",
   "What am I?",
   "Think about it. Where do you keep your coins at home?",
   "Here is a clue: some of them look like a pink pig!",
   "Ask a grown-up to help you make your own. A clean jar with a lid works too. Ask a grown-up to cut a small slot in the lid.",
   "Here is one more riddle, just for fun. I am made of paper. I have numbers on me. People trade me for things at the shop. What am I? (Hint: you can find me in a wallet.)",
   "Riddles are like little puzzles for your brain. You look at the clues one by one.",
   "Clue 1: round tummy. Clue 2: slot on top. Clue 3: keeps coins safe. Put the clues together and the answer pops out!",
   "Kavya guessed the first riddle in ten seconds. Her brother Dev took a little longer, but he got it too.",
   "Scroll down to see the answers."],
  "answer":"A piggy bank! It keeps your coins safe so you can save them for something special. Bonus riddle: a money note (a rupee note).",
  "try":"Try it today: Make up your own money riddle and ask someone at home to guess it.",
  "grown":"Riddles make children think about why we keep money in a safe place. Talk about where your family keeps money safe, like a savings account at a bank."},
 {"date":"2026-11-18","emoji":"🛒","day":"Wed","title":"Needs or Wants? The Sorting Game",
  "excerpt":"Needs are things we must have. Wants are nice to have. Can you sort them?",
  "body":[
   "Needs are things we must have to live and be healthy. Wants are things that are nice to have, but we can live without them.",
   "Food, water, clothes and a home are needs. A new toy car is a want.",
   "Let us play! Read each thing below. Say \"need\" or \"want\" out loud.",
   "1. A glass of milk. 2. A sticker book. 3. A school bag. 4. A second ice cream. 5. A warm blanket in winter. 6. A balloon at the fair.",
   "Did you say needs for 1, 3 and 5? And wants for 2, 4 and 6? Well done!",
   "Here is a tricky one: shoes. Shoes are a need. But shiny shoes with lights are a want. A plain pair can do the job.",
   "Sometimes we really want something. That is okay! We can make a plan to save for it.",
   "Grown-ups sort needs and wants too. They pay for food, rent and school first. Then they think about treats.",
   "Wants are not bad. They are fun! We just take care of needs first. Then we can save for wants.",
   "Arjun and his sister Meera played this game at dinner. Meera found a tricky one: a pencil is a need for school, but a glitter pencil is a want!"],
  "try":"Try it today: Walk around your home. Find three needs and three wants.",
  "grown":"Sorting needs and wants is the first step to budgeting. Ask your child why each item is a need or a want, and accept that some answers can be both."},
 {"date":"2026-11-19","emoji":"🌱","day":"Thu","title":"What Is Interest? Money That Grows",
  "excerpt":"Interest is extra money that a bank adds when you keep your savings there. It is money that grows!",
  "body":[
   "Interest is a little extra money a bank adds to your savings when you keep them there for a while. It is like money that grows.",
   "Think of a seed. You plant it, give it time, and it grows into a small plant.",
   "Money in a savings account is a bit like that. You keep it there. Slowly, the bank adds a little more.",
   "Here is an example. Kabir keeps ₹100 in a savings account. After one year, the bank adds ₹3. Now he has ₹103. That ₹3 is the interest. (This is just an example. Real amounts are different.)",
   "The longer you leave the money, the more it can grow.",
   "Why does the bank add interest? The bank uses the money people keep there to help others, and it says thank you with a little extra. That thank-you is the interest.",
   "Kabir's sister Noor keeps her money in a box under the bed. After one year, she still has the same ₹100. Money in a box stays the same. It does not grow.",
   "Kabir and Noor compare. \"My money got a little bigger!\" says Kabir. Noor laughs. \"Next time I will ask a grown-up about a savings account!\"",
   "Remember, interest grows slowly. It is small at first. Patience is the secret helper.",
   "So when grown-ups say \"interest\", you can think: \"money that grows when you save it.\""],
  "try":"Try it today: Use the word \"interest\" in a sentence at dinner, and explain it to someone.",
  "grown":"This introduces the idea that saved money can earn a little more over time. You can show your child a passbook or savings statement and point out the interest line together."},
 {"date":"2026-11-20","emoji":"🫙","day":"Fri","title":"Make a Three-Jar Money Station",
  "excerpt":"Make three jars at home, Save, Spend and Share, and learn how to split your money.",
  "body":[
   "Today we will make a money station with three jars. One is for saving, one is for spending and one is for sharing.",
   "You need three clean jars or boxes, paper, crayons and some tape. Ask a grown-up to help.",
   "Step 1: Write SAVE on the first jar. Draw something you are saving for.",
   "Step 2: Write SPEND on the second jar. This money is for small treats.",
   "Step 3: Write SHARE on the third jar. This money can help others, like buying a gift or feeding birds.",
   "Step 4: When you get money, split it. If you get ₹30, you can put ₹10 in each jar.",
   "There is no single right way to split. Some children put more in SAVE. Some put more in SHARE. You and your grown-up can decide together.",
   "Keep your jars in one safe place at home, like a shelf.",
   "Once a week, count the coins in each jar. Write the numbers on a small paper. Are your jars getting fuller?",
   "What if you want something from the SAVE jar right now? Stop and think. Is it the thing you are saving for? If not, wait one more day and think again.",
   "Zoya's brother Om made his jars too. His SHARE jar helped buy a birthday card for their grandpa. Grandpa kept the card on his table for a whole month!",
   "Zoya made her jars with stars and hearts. Her SAVE jar is her favourite. She checks it every Sunday."],
  "try":"Try it today: Make your jars, and put one coin in each.",
  "grown":"The jars teach children that money can have different jobs. Let your child choose the split, and talk about why they chose it."},
 {"date":"2026-11-21","emoji":"🪙","day":"Sat","title":"Count the Coins: Three Fun Sums",
  "excerpt":"Three easy money sums with notes and coins. Can you solve them all?",
  "body":[
   "Get ready, money detectives! Here are three small sums. Use real coins if you have them.",
   "Sum 1: Aman has two ₹10 notes and three ₹5 coins. How much money does he have?",
   "Sum 2: Priya has ₹50. She buys a pencil box for ₹18. How much money is left?",
   "Sum 3: Ravi has four ₹20 notes and two ₹2 coins. How much money is that?",
   "Here is a bonus sum for super detectives! Joel has ₹15. His grandpa gives him ₹10 more. Then he spends ₹5 on a pencil. How much is left?",
   "Tip: when you add notes and coins, start with the biggest ones first. Count the ₹20s, then the ₹10s, then the ₹5s, then the small coins.",
   "Tip: when someone spends money, take it away. When someone gets money, add it.",
   "Did you know? Coins and notes come in different sizes and colours. Look closely at the numbers printed on them. The number tells you how much each one is worth. A ₹10 coin and a ₹10 note are worth the same!",
   "Make it a game with your family. One person says a sum, and everyone races to solve it with real coins. The fastest counter picks the next sum!",
   "Take your time. You can count on your fingers or draw the coins on paper.",
   "When you are done, check the answers below."],
  "answer":f"Sum 1: ₹{s1}. Sum 2: ₹{s2}. Sum 3: ₹{s3}. Bonus: ₹{s4}.",
  "try":"Try it today: Ask a grown-up for a few coins and count them together.",
  "grown":"Counting with notes and coins builds number sense and money skills together. Make up a new sum using prices from your kitchen or the local market."},
 {"date":"2026-11-22","emoji":"🤝","day":"Sun","title":"Ishaan Shares His Mango Money",
  "excerpt":"Ishaan saves, spends a little and shares too. Sharing makes his day even happier.",
  "body":[
   "Ishaan helps his aunt sell mangoes at her stall on Sunday. She gives him ₹40 for his help.",
   "He keeps ₹20 in his SAVE jar. He wants a football one day.",
   "He spends ₹10 on a small snack. Yum!",
   "On the way home with his aunt, he sees his friend Anaya. Her pencil broke at school, and she has no other one.",
   "Ishaan has ₹10 left. He buys her a new pencil.",
   "Walking home, Ishaan thinks about his football. He has to wait a little longer now, but he does not mind.",
   "Next Sunday, he helps at the stall again. His aunt gives him ₹40 again. He saves ₹20, spends ₹10 and shares ₹10 again.",
   "His aunt says, \"Ishaan, you have a plan for your money. That is very smart.\"",
   "Ishaan counts his SAVE jar. It has ₹40 now. The football feels closer every week.",
   "Ishaan feels warm and happy inside. He did not need a big amount to help. A small kind act was enough.",
   "Sharing does not always need money. You can share your time, your toys, a smile or a helping hand.",
   "Good friends help each other.",
   "Anaya smiles a big smile. \"Thank you, Ishaan!\"",
   "That night Ishaan tells his aunt, \"I saved, I spent, and I shared. Sharing felt the best!\""],
  "try":"Try it today: Think of one small, kind way to share, like lending a book or sharing a snack.",
  "grown":"Children learn that money can save, spend and help others. Talk about a time your family shared, and how it felt."},
]

ORDER={"2026-11-16":[0,1,2,3,4,6,7,8,9,10,5,11,12],
 "2026-11-20":[0,1,2,3,4,5,6,7,8,9,11,10],
 "2026-11-22":[0,1,2,3,4,12,11,9,10,5,13,6,7,8]}
for p in posts:
    o=ORDER.get(p["date"])
    if o:
        assert sorted(o)==list(range(len(p["body"])))
        p["body"]=[p["body"][i] for i in o]

def to_html(p):
    out=[]
    for b in p["body"]:
        out.append(f"<!-- wp:paragraph -->\n<p>{b}</p>\n<!-- /wp:paragraph -->")
    if "answer" in p:
        out.append("<!-- wp:heading {\"level\":3} -->\n<h3 class=\"wp-block-heading\">Answer</h3>\n<!-- /wp:heading -->")
        out.append(f"<!-- wp:paragraph -->\n<p>{p['answer']}</p>\n<!-- /wp:paragraph -->")
    out.append(f"<!-- wp:paragraph -->\n<p><strong>{p['try'].split(':')[0]}:</strong>{p['try'].split(':',1)[1]}</p>\n<!-- /wp:paragraph -->")
    out.append(f"<!-- wp:paragraph -->\n<p><strong>For grown-ups:</strong> {p['grown']}</p>\n<!-- /wp:paragraph -->")
    out.append(f"<!-- wp:paragraph {{\"fontSize\":\"small\"}} -->\n<p class=\"has-small-font-size\">{DISC}</p>\n<!-- /wp:paragraph -->")
    return "\n\n".join(out)

for p in posts:
    p["content"]=to_html(p)
    text=" ".join(p["body"]+[p.get("answer",""),p["try"],p["grown"]])
    p["words"]=len(text.split())
    p["slug"]=re.sub(r"[^a-z0-9]+","-",p["title"].lower().replace("'","")).strip("-")
    assert len(p["title"])<=50, p["title"]
    assert len(p["excerpt"])<=120, (p["title"],len(p["excerpt"]))
    print(p["date"],p["words"],len(p["title"]),len(p["excerpt"]),p["slug"])
json.dump(posts,open("/home/claude/moneyviel-reels/pending/kids/specs.json","w"),ensure_ascii=False,indent=1)
