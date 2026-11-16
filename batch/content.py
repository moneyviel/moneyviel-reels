# Batch 19–25 Nov 2026 content (generated 16 Nov 2026 by the autopilot)
import json, html

DISC = "This content is for general education only and is not financial, investment, tax or legal advice. Please consult a qualified professional before making financial decisions."
SEBI = "For personal investment decisions, please talk to a SEBI-registered investment adviser."

def p(t): return f"<!-- wp:paragraph -->\n<p>{t}</p>\n<!-- /wp:paragraph -->"
def h2(t): return f"<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">{t}</h2>\n<!-- /wp:heading -->"
def h3(t): return f"<!-- wp:heading {{\"level\":3}} -->\n<h3 class=\"wp-block-heading\">{t}</h3>\n<!-- /wp:heading -->"
def ul(items): return "<!-- wp:list -->\n<ul class=\"wp-block-list\">" + "".join(f"<!-- wp:list-item -->\n<li>{i}</li>\n<!-- /wp:list-item -->" for i in items) + "</ul>\n<!-- /wp:list -->"
def ol(items): return "<!-- wp:list {\"ordered\":true} -->\n<ol class=\"wp-block-list\">" + "".join(f"<!-- wp:list-item -->\n<li>{i}</li>\n<!-- /wp:list-item -->" for i in items) + "</ol>\n<!-- /wp:list -->"
def a(url, text): return f"<a href=\"{url}\">{text}</a>"
def small(t): return f"<!-- wp:paragraph {{\"fontSize\":\"small\"}} -->\n<p class=\"has-small-font-size\">{t}</p>\n<!-- /wp:paragraph -->"
T = "https://moneyviel.com/money-tools/"

# ---- maths, computed ----
md_bal, md_pct, md_rate = 20000, 0.05, 0.03
md_min = md_bal * md_pct; md_int = (md_bal - md_min) * md_rate
assert (md_min, round(md_int)) == (1000, 570)
subs = [199, 149, 299, 99]; sub_m = sum(subs); sub_y = sub_m * 12; cut_y = (299 + 99) * 12
assert (sub_m, sub_y, cut_y) == (746, 8952, 4776)
inf10 = 100 / 1.06 ** 10; tea10 = 15 * 1.06 ** 10; inf20 = 100 / 1.06 ** 20; tea20 = 15 * 1.06 ** 20
assert (round(inf10), round(tea10), round(inf20), round(tea20)) == (56, 27, 31, 48)
del_now = 140 * 30; del_new = 8 * 200; del_save = del_now - del_new
assert (del_now, del_new, del_save, del_save * 12) == (4200, 1600, 2600, 31200)
needs = 6500 + 4000 + 1500 + 2000; plan = needs + 3500 + 4000 + 2000 + 1500
assert (needs, plan, 3500 * 12) == (14000, 25000, 42000)
ef_ess = 20000; assert ef_ess * 3 == 60000

items = []

# 19 Nov (Thu) Money Word + debt-race teaser
items.append(dict(
 id="2026-11-19-word", date="2026-11-19", kind="teaser", longform="debt-race", cat=38,
 title="Money Word: Minimum Due explained",
 slug="money-word-minimum-due",
 excerpt="Minimum due is the smallest amount you must pay on a card bill to avoid a late fee. The rest of the bill keeps collecting interest.",
 body=[
  p("<strong>Minimum due</strong> is the smallest amount your credit card company asks you to pay by the due date, so your account stays in good standing and you avoid a late fee. It is usually a small slice of the total bill, and whatever you leave unpaid keeps collecting interest."),
  p("In short: paying the minimum keeps you out of trouble <em>for this month</em>. Paying the <strong>total due</strong> keeps you out of interest."),
  p("That is why many people who pay only the minimum, month after month, feel the bill never shrinks. Most of each small payment goes to interest, not to the money they actually spent."),
  h2("A simple ₹ example"),
  p(f"Say your card bill is ₹20,000 and the minimum due is 5% of it: ₹1,000. You pay ₹1,000 and leave ₹19,000 unpaid. At an example interest rate of 3% a month (rates differ by card, so check your own statement), next month's interest is about ₹570 on that ₹19,000."),
  p("So after paying ₹1,000, the balance has only come down by about ₹430 in real terms, and any new spending is added on top. Our free " + a(T + "minimum-due-calculator/", "Minimum Due Calculator") + " shows how many months or years this can take with your own numbers."),
  h2("The common mix-up"),
  p("<strong>Minimum due is not the same as total due.</strong> The statement shows both. The minimum due is what you must pay to avoid a late fee; the total due is the full amount you owe for that cycle. Paying the full total due by the due date is what usually avoids interest on purchases."),
  p("Another mix-up: thinking the minimum is a 'plan'. It is only a floor. A fixed amount that you choose, and that is higher than the minimum, clears the bill much faster."),
  h2("Where you'll see it"),
  ul(["On your monthly credit card statement, next to 'Total amount due' and 'Payment due date'.",
      "In your card's app or SMS alerts as 'Min. amount due'.",
      "On some pay-later and store-card bills, which can work in a similar way."]),
  p("If you have more than one debt, the " + a(T + "debt-payoff-planner/", "Debt Payoff Planner") + " compares two simple ways to clear them, and our " + a(T + "money-words/", "Money Words") + " page explains 100+ other money terms in simple English."),
  h3("Your small step today"),
  p("Open your last card statement and write down two numbers: the minimum due and the total due. If you can, set your payment to the total due, or at least a fixed amount above the minimum."),
 ],
 social="💳 Money Word: Minimum Due. It keeps you safe from a late fee, not from interest. Pay the total due when you can. #MoneyViel #MoneyWords #CreditCard #PersonalFinance #MoneyTips",
 alt="MoneyViel Money Word: Minimum Due explained",
 yt_title="Paying only the minimum on ₹80,000? The 14-year race #MoneyViel #shorts",
 yt_desc="Paying only the minimum due on a credit card? In our example, the same debts are cleared 12+ years sooner with a bigger fixed monthly payment and a smart payoff order.\nFull video: tap the related video link above.\n\n🔎 Search \"moneyviel.com\" for the free Minimum Due Calculator\n🌐 moneyviel.com/money-tools/minimum-due-calculator\n\nExample character and example rates; real statements differ.\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #CreditCardDebt #MinimumDue #DebtFree",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, minimum due, credit card minimum due, credit card debt, debt payoff, debt free, minimum due calculator",
 related="lf",
))

# 20 Nov (Fri) Weekend Challenge + tip short
items.append(dict(
 id="2026-11-20-challenge", date="2026-11-20", kind="tip", cat=66,
 title="Weekend Challenge: List Every Subscription You Pay For",
 slug="weekend-challenge-list-every-subscription",
 excerpt="This weekend, list every subscription you pay for. Small monthly charges add up fast, and you may not use them all.",
 body=[
  p("This weekend's challenge is simple and free: <strong>make a list of every subscription you pay for</strong>. Music, videos, cloud storage, gym, newspaper, app upgrades, mobile add-ons: anything that takes money from you every month or every year."),
  p(f"Small charges are easy to forget. Four subscriptions of ₹199, ₹149, ₹299 and ₹99 come to ₹{sub_m} a month, which is ₹{sub_y:,} a year. If two of them (₹299 and ₹99) are ones you hardly use, stopping them frees ₹{cut_y:,} a year.".replace("8,952", "8,952").replace("4,776", "4,776")),
  p("The goal is not to cancel everything. It is to keep what you truly use, and stop paying for what you forgot."),
  h2("Why it helps"),
  p("Subscriptions are designed to run quietly in the background. A free trial turns into a paid plan, a yearly renewal comes once and is forgotten, a family member signs up on your card. Listing them once brings them into the light."),
  h2("How to do it, step by step"),
  ol(["Open the last 2–3 months of your bank and card statements (and UPI history) and note every repeating charge.",
      "Check your phone's subscription settings and your email for 'renewal' or 'receipt' messages.",
      "Write each one down with its price and how often it is charged (monthly or yearly).",
      "Mark each one: <strong>Use a lot</strong>, <strong>Use sometimes</strong> or <strong>Forgot about it</strong>.",
      "Cancel the 'forgot about it' ones today, and set a reminder before the yearly ones renew."]),
  h2("Note your result"),
  p("Add up the monthly cost before and after. Move the money you freed into savings on the same day, so it does not quietly get spent elsewhere. The free " + a(T + "52-week-challenge/", "52-Week Money Challenge") + " is a fun place to track it."),
  h3("Your small step today"),
  p("Before Sunday night, list every subscription with its price and cancel at least one you no longer use."),
 ],
 social="📋 Weekend Challenge: list every subscription you pay for. ₹746 a month is ₹8,952 a year! Keep what you use, cancel what you forgot. ✂️ #MoneyViel #WeekendChallenge #SavingMoney #MoneyTips",
 alt="MoneyViel Weekend Challenge: list every subscription you pay for",
 spec=dict(kind="tip", label="WEEKEND CHALLENGE", hookEmoji="📋", hook="This weekend: list every subscription you pay for",
  slides=[dict(emoji="🔁", text="Music, videos, storage, gym, app upgrades: anything charged every month or year."),
          dict(emoji="➕", text="₹199 + ₹149 + ₹299 + ₹99 = ₹746 a month.", sub="That's ₹8,952 a year"),
          dict(emoji="🔎", text="Check bank statements, UPI history and renewal emails."),
          dict(emoji="✂️", text="Keep what you use. Cancel what you forgot."),
          dict(emoji="✅", text="Move the money you free up into savings the same day.")],
  cta="Track it free at moneyviel.com"),
 yt_title="List every subscription you pay for this weekend 📋 #MoneyViel #shorts",
 yt_desc="Small subscriptions add up: ₹746 a month is ₹8,952 a year. This weekend, list them all, keep what you use and cancel what you forgot.\n\n🔎 Search \"moneyviel.com\" for the free 52-Week Money Challenge\n🌐 moneyviel.com/money-tools/52-week-challenge\n\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #SavingMoney #Budgeting #WeekendChallenge",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, subscriptions, cancel subscriptions, monthly expenses, weekend challenge, save money india",
 related="tour",
))

# 21 Nov (Sat) Family Money + saver-vs-spender teaser
items.append(dict(
 id="2026-11-21-family", date="2026-11-21", kind="teaser", longform="saver-vs-spender", cat=66,
 title="Family Money: The Save-First Jar Game with Your Kids",
 slug="family-money-save-first-jar-game",
 excerpt="A 15-minute jar game that shows kids why saving first, then spending, makes money last longer. Works for ages 5 to 13+.",
 body=[
  p("Here is a 15-minute game you can play with your children this weekend: <strong>the Save-First Jar Game</strong>. It shows, in a fun way, that when we put some money aside first and spend after, the money lasts longer and big wishes come true sooner."),
  p("You need two jars or bowls, ten coins (₹1 or ₹2 coins work well, or paper 'coins'), and a small wish your child wants, like a ₹50 colouring book."),
  p("Label one jar <strong>Save</strong> and the other <strong>Spend</strong>. The rule of the game: every time 'pocket money' arrives, one coin goes into Save first, before anything else."),
  h2("How to play"),
  ol(["Give your child ten coins as 'this week's pocket money'.",
      "Ask them to put one or two coins into the Save jar first.",
      "Now the fun part: set up a pretend shop with small items and prices, and let them spend from the Spend jar only.",
      "Play two or three 'weeks'. Each week, Save comes first.",
      "At the end, count the Save jar together. Is it close to the wish? Talk about how it grew, one coin at a time."]),
  p("Then try one round the other way: spend first and save 'whatever is left'. Usually nothing is left, and children see the difference for themselves."),
  h2("Tips by age"),
  ul(["<strong>Ages 5–8:</strong> keep it to coins and simple counting. Use a picture of the wish on the Save jar.",
      "<strong>Ages 9–12:</strong> let them set the price of the wish and work out how many weeks it will take.",
      "<strong>Ages 13+:</strong> talk about real choices: a phone upgrade, a trip with friends. What would saving first look like?"]),
  h2("What to say (and what to avoid)"),
  p("Praise the habit, not the amount: 'You saved first again, well done!' works better than comparing children or families. There is no wrong answer in this game; even a round where everything gets spent is a great lesson."),
  p("Grown-ups can see the same idea over ten years in our free " + a(T + "life-simulator/", "Money Life Simulator") + ", where two made-up twins earn the same salary but make different choices. For more ideas made for children, visit " + a(T + "kids/", "MoneyViel for Kids") + "."),
  h3("Your small step today"),
  p("Find two jars at home, label them Save and Spend, and play one round with your child before dinner."),
 ],
 social="🫙 Family Money: play the Save-First Jar Game with your kids. One coin into Save first, then spend. Watch the wish come closer! 👨‍👩‍👧 #MoneyViel #FamilyMoney #KidsAndMoney #SavingMoney",
 alt="MoneyViel Family Money: the Save-First Jar Game with your kids",
 yt_title="Same salary, 10 years later: saver vs spender twins #MoneyViel #shorts",
 yt_desc="Same salary. Same city. Two made-up twins, two different habits. Then a hospital bill hits both. Who copes better?\nFull video: tap the related video link above.\n\n🔎 Search \"moneyviel.com\" for the free Money Life Simulator\n🌐 moneyviel.com/money-tools/life-simulator\n\nGame example with assumed rates, not a forecast.\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #EmergencyFund #SavingMoney #FinancialLiteracy",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, saver vs spender, emergency fund, money life simulator, money habits, money personality",
 related="lf",
))

# 22 Nov (Sun) Quiz + tip short
items.append(dict(
 id="2026-11-22-quiz", date="2026-11-22", kind="tip", cat=38,
 title="Quiz: 3 Questions on Emergency Funds",
 slug="quiz-3-questions-emergency-funds",
 excerpt="Three quick questions to test what you know about emergency funds: what they are for, how big, and where to keep them.",
 body=[
  p("An <strong>emergency fund</strong> is money kept aside only for sudden, necessary costs, like a job loss, a medical bill or an urgent repair. Most people aim for 3 to 6 months of essential expenses."),
  p("Test yourself with three quick questions. Pick your answers first, then scroll down to check."),
  h2("Question 1"),
  p("What is an emergency fund meant for?<br>A) A new phone in a big sale<br>B) Sudden, necessary costs like a job loss or a medical bill<br>C) The next family holiday"),
  h2("Question 2"),
  p("If your essential expenses are ₹20,000 a month, what is a 3-month emergency fund?<br>A) ₹20,000<br>B) ₹60,000<br>C) ₹2,00,000"),
  h2("Question 3"),
  p("Where is an emergency fund best kept?<br>A) Mixed with your everyday spending money<br>B) Separate, safe and easy to reach quickly<br>C) Somewhere you cannot touch for years"),
  h2("Answers"),
  ol(["<strong>B.</strong> It is for real emergencies. Sales and holidays are better planned as separate goals.",
      "<strong>B.</strong> ₹20,000 × 3 months = ₹60,000. Count essentials only: rent, food, bills, travel, EMIs.",
      "<strong>B.</strong> Separate, so you don't spend it by mistake; easy to reach, so it helps on the day you need it."]),
  p("Many people start with one month of essentials, then build up step by step. A fixed amount moved on salary day, even ₹1,000, makes steady progress without much effort."),
  p("Got all three? Great. Now find your own number with the free " + a(T + "emergency-fund-calculator/", "Emergency Fund Calculator") + "."),
  h2("Check your full money health"),
  p("Your emergency fund is one part of the picture. The free " + a(T + "money-health-report/", "Money Health Report") + " looks at spending, saving, debt and protection in about two minutes."),
  p("Remember: with an emergency fund, a sudden bill becomes a problem you can handle, not a crisis.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:paragraph -->\n<p><strong>Quote of the week:</strong> A rainy-day fund is the umbrella you pack before the clouds arrive."),
  h3("Your small step today"),
  p("Add up one month of your essential expenses and multiply by three. That is your first emergency fund target."),
 ],
 social="🧠 Sunday Quiz: 3 questions on emergency funds. What is it for, how big, and where to keep it? Test yourself! 🛟 #MoneyViel #MoneyQuiz #EmergencyFund #PersonalFinance",
 alt="MoneyViel Quiz: 3 questions on emergency funds",
 spec=dict(kind="tip", label="SUNDAY QUIZ", hookEmoji="🧠", hook="3 quick questions on emergency funds. Ready?",
  slides=[dict(emoji="❓", text="Q1: An emergency fund is for… a sale, a holiday, or a sudden medical bill?", sub="Answer: the medical bill"),
          dict(emoji="❓", text="Q2: Essentials cost ₹20,000 a month. A 3-month fund is…?", sub="Answer: ₹60,000"),
          dict(emoji="❓", text="Q3: Keep it mixed with spending money, or separate and easy to reach?", sub="Answer: separate and easy to reach"),
          dict(emoji="🛟", text="It makes a sudden bill something you can handle.")],
  cta="Find your number free at moneyviel.com"),
 yt_title="Emergency fund quiz: can you get 3 out of 3? 🧠 #MoneyViel #shorts",
 yt_desc="3 quick questions on emergency funds: what it's for, how big, and where to keep it. How many did you get right?\n\n🔎 Search \"moneyviel.com\" for the free Emergency Fund Calculator\n🌐 moneyviel.com/money-tools/emergency-fund-calculator\n\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #EmergencyFund #MoneyQuiz #FinancialLiteracy",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, emergency fund, emergency fund quiz, money quiz, how much emergency fund, emergency fund calculator",
 related="tour",
))

# 23 Nov (Mon) Myth or Fact + time-machine teaser
items.append(dict(
 id="2026-11-23-myth", date="2026-11-23", kind="teaser", longform="time-machine", cat=66,
 title="Myth or Fact: ₹100 Will Buy the Same Things Next Year",
 slug="myth-or-fact-100-rupees-same-value",
 excerpt="Myth. Prices usually rise over time (inflation), so the same ₹100 tends to buy a little less each year.",
 body=[
  p("<strong>Verdict: Myth.</strong> Prices usually go up a little every year. This is called <strong>inflation</strong>, and it means the same ₹100 note tends to buy a bit less as time passes."),
  p("A note does not lose its number, but it slowly loses its <em>buying power</em>. Over a year you may hardly notice. Over ten or twenty years, the difference is large, which is why planning in future rupees matters."),
  h2("A ₹ example"),
  p(f"Let's assume prices rise 6% a year (an assumption for this example, not a forecast). A ₹15 cup of tea would cost about ₹{tea10:.0f} in 10 years and about ₹{tea20:.0f} in 20 years."),
  p(f"Looked at the other way: ₹100 kept as cash for 10 years would buy only about ₹{inf10:.0f} worth of today's things. After 20 years, about ₹{inf20:.0f} worth. Try your own numbers in the free " + a(T + "inflation-calculator/", "₹ Time Machine (inflation calculator)") + "."),
  h2("Why people believe it"),
  p("Day to day, prices seem steady, and a ₹100 note looks exactly the same as it did last year. The change is slow and spread out, so it is easy to miss until we compare prices from many years apart."),
  h2("Where inflation shows up in daily life"),
  p("You see it in school fees, rent, groceries, a doctor's visit or a wedding budget. These costs rarely go down over the years. A salary that stays the same for several years can feel smaller, even though the number on the payslip has not changed."),
  p("It also matters for money kept aside for many years. If savings grow slower than prices, the money can buy less in the future, even though the amount looks bigger on paper. This is why money for different goals is usually planned differently: short-term money for safety, long-term money with time to grow."),
  h2("What to do instead"),
  ul(["<strong>Plan big goals in future rupees.</strong> A goal 10 years away will likely cost more than today's price. The free " + a(T + "goal-planner/", "Life Goals Planner") + " does this maths for you.",
      "<strong>Keep emergency money safe and easy to reach.</strong> Short-term money is about safety, not growth.",
      "<strong>Learn how long-term money can grow.</strong> Long-term goals usually need growth that beats inflation. Returns are never guaranteed, so learn the basics first."]),
  p(SEBI),
  h3("Your small step today"),
  p("Pick one goal that is 5 or more years away and check its future cost in the ₹ Time Machine."),
 ],
 social="☕ Myth or Fact: ₹100 will buy the same things next year? MYTH. At an assumed 6% inflation, ₹15 tea could cost about ₹27 in 10 years. #MoneyViel #MythOrFact #Inflation #PersonalFinance #MoneyTips",
 alt="MoneyViel Myth or Fact: ₹100 will buy the same things next year",
 yt_title="What will ₹100 buy in 2046? The ₹ Time Machine ☕ #MoneyViel #shorts",
 yt_desc="This ₹15 cup of tea could cost about ₹48 in 2046, at an assumed 6% inflation a year (an example, not a forecast). So what will your ₹100 buy?\nFull video: tap the related video link above.\n\n🔎 Search \"moneyviel.com\" for the free ₹ Time Machine\n🌐 moneyviel.com/money-tools/inflation-calculator\n\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #Inflation #FinancialLiteracy #IndiaFinance",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, inflation, inflation explained, inflation calculator, value of money, rule of 72",
 related="lf",
))

# 24 Nov (Tue) Story + story short
items.append(dict(
 id="2026-11-24-story", date="2026-11-24", kind="story", cat=66,
 title="Story: Anjali's ₹4,200 Food Delivery Surprise",
 slug="story-anjali-food-delivery-surprise",
 excerpt="Anjali tracked her spending for one week and found ₹4,200 a month on food delivery. One small change freed ₹2,600 a month.",
 body=[
  p("Anjali (an illustrative example) earned ₹32,000 a month and always wondered where her salary went. She did not feel like a big spender. So she tried one thing: for seven days, she noted every rupee she spent."),
  p(f"The surprise was food delivery. A meal here, a snack there, about ₹140 a day on average. That is ₹{del_now:,} a month, without ever feeling like a big expense."),
  p(f"She did not stop completely. She chose a new rule: order on weekends only, about 8 times a month at around ₹200 each, so ₹{del_new:,}. That freed ₹{del_save:,} a month, or ₹{del_save*12:,} a year."),
  p("Her seven-day note was very simple: date, what she bought, how much, and one word for how she felt about it later (\"worth it\" or \"not really\"). Most of the delivery orders were marked \"not really\": late-night snacks when she was tired, or meals ordered only because cooking felt like too much effort after work."),
  h2("The turning point"),
  p("The real change was not the food. It was seeing the number written down. Once Anjali saw ₹4,200 on paper, the choice became easy. She cooked simple dinners on weekdays, kept a few quick snacks at home, and enjoyed her weekend orders even more."),
  p("She set up an automatic transfer of ₹2,600 to a separate savings account on salary day, to build her emergency fund."),
  p("Three months later, Anjali had ₹7,800 set aside, the start of a real safety cushion. She also noticed something else: weekend orders felt like a treat again, not a habit she paid for without thinking."),
  h2("The lesson"),
  p("<strong>Track before you cut.</strong> We can't fix what we can't see. One honest week of notes often shows a single habit that is bigger than we thought, and changing just that one habit is far easier than cutting everything."),
  p("Your surprise may be different: a daily tea and snack break, cab rides, small online orders or mobile top-ups. The method is the same. Find the one habit, choose a kinder limit for it, and send the difference to savings automatically."),
  p("Want a fun way to practise? Try the free " + a(T + "budget-boss/", "Budget Boss game") + ", or start saving with the " + a(T + "52-week-challenge/", "52-Week Money Challenge") + "."),
  h3("Your small step today"),
  p("Start a 7-day spending note on your phone tonight. Write every spend, however small, and look for your 'surprise' at the end of the week."),
 ],
 social="🍱 Story: Anjali found ₹4,200 a month on food delivery after tracking her spending for one week. One new rule freed ₹2,600 a month! 📝 #MoneyViel #MoneyStory #Budgeting #SavingMoney #MoneyTips",
 alt="MoneyViel money story: Anjali's ₹4,200 food delivery surprise",
 spec=dict(kind="story", label="MONEY STORY", hookEmoji="🍱", hook="Anjali earned ₹32,000 but never knew where it went…",
  slides=[dict(emoji="📝", text="So for 7 days, she wrote down every rupee she spent."),
          dict(emoji="😮", text="Food delivery: about ₹140 a day.", sub="₹140 × 30 = ₹4,200 a month"),
          dict(emoji="📅", text="New rule: order on weekends only, about ₹1,600 a month."),
          dict(emoji="💰", text="That freed ₹2,600 a month for her emergency fund.", sub="₹31,200 a year"),
          dict(emoji="✅", text="Lesson: track before you cut. Try a 7-day spending note today.")],
  cta="Learn more free at moneyviel.com"),
 yt_title="Anjali tracked 7 days of spending: ₹4,200 a month on food delivery 🍱 #MoneyViel #shorts",
 yt_desc="Anjali earned ₹32,000 but never knew where it went. One honest week of notes showed ₹4,200 a month on food delivery. One new rule freed ₹2,600 a month. (Illustrative story.)\n\n🔎 Search \"moneyviel.com\" for the free Budget Boss game\n🌐 moneyviel.com/money-tools/budget-boss\n\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #Budgeting #SavingMoney #MoneyStory",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, track expenses, spending tracker, food delivery, save money india, money story",
 related="tour",
))

# 25 Nov (Wed) Guide + money-checkup teaser
items.append(dict(
 id="2026-11-25-guide", date="2026-11-25", kind="teaser", longform="money-checkup", cat=38,
 title="How to Make a Monthly Budget on a ₹25,000 Salary",
 slug="monthly-budget-25000-salary",
 focus_kw="budget on 25000 salary",
 excerpt="Pay essentials first, save a fixed amount on salary day, then set a limit for wants. A ₹25,000 example plan is inside.",
 body=[
  p("To make a budget on a ₹25,000 salary, start with your essentials (rent, food, bills, travel), then <strong>save a fixed amount on salary day before you spend</strong>, and give the rest a clear limit for wants. Write it down once and check it every week."),
  p("You don't need an app or a spreadsheet. A notebook and four lines are enough: Needs, Savings, Wants and a small Buffer for surprises."),
  h2("Step 1: Know your real take-home pay"),
  p("Use the amount that actually reaches your bank account each month, not the salary on your offer letter. If your income changes month to month, use your lowest normal month."),
  h2("Step 2: List your essentials"),
  p("Essentials are the costs you must pay to live and work: rent, groceries, electricity and phone bills, travel to work, any EMIs, and money you send home. Look at last month's bank and UPI history so the numbers are real, not guesses."),
  h2("Step 3: A ₹25,000 example plan"),
  p("Here is one example for a single person living in a shared flat. Your numbers will be different; the method is what matters."),
  ul(["<strong>Needs: ₹14,000</strong> (rent share ₹6,500, groceries ₹4,000, bills ₹1,500, travel ₹2,000)",
      "<strong>Savings, paid first: ₹3,500</strong> (moved on salary day; that is ₹42,000 in a year)",
      "<strong>Wants: ₹4,000</strong> (eating out, outings, shopping)",
      "<strong>Family / health: ₹2,000</strong>",
      "<strong>Buffer: ₹1,500</strong> (small surprises, so you don't dip into savings)"]),
  p("Total: ₹14,000 + ₹3,500 + ₹4,000 + ₹2,000 + ₹1,500 = ₹25,000. Every rupee has a job."),
  p("You may have heard of the 50/30/20 idea (50% needs, 30% wants, 20% savings). On ₹25,000 that is ₹12,500, ₹7,500 and ₹5,000. It's a useful starting point, but if rent is high in your city, adjust it. A plan you can follow beats a perfect plan you can't."),
  h2("Step 4: Make it run on autopilot"),
  ol(["On salary day, move your savings amount to a separate account first.",
      "Pay rent and bills in the first few days.",
      "Keep your wants money in one place and stop when it runs out.",
      "Every Sunday, spend 5 minutes checking what's left.",
      "At month-end, move any leftover to savings or your emergency fund."]),
  h2("Common budgeting mistakes to avoid"),
  ul(["<strong>Saving whatever is left.</strong> Usually nothing is left. Save first, on salary day.",
      "<strong>Forgetting yearly costs.</strong> Festivals, insurance renewals, school fees and birthdays come once a year. Divide them by 12 and set that amount aside every month.",
      "<strong>Making the plan too strict.</strong> If wants get ₹0, the plan breaks in a week. Keep a small, fixed amount for fun.",
      "<strong>Not counting small UPI payments.</strong> ₹30 here and ₹80 there can add up to thousands a month. Check your UPI history weekly.",
      "<strong>Giving up after one bad month.</strong> Every budget needs a few months to settle. Adjust and keep going."]),
  h2("Step 5: Review every month"),
  p("If you overspent on wants, don't give up; just set a slightly more realistic limit next month. If you have money left over, slowly raise your savings. Your first big savings goal is usually an emergency fund of 3 to 6 months of essentials."),
  p("To see how your money habits score overall, try the free " + a(T + "money-health-report/", "Money Health Report") + " (about 2 minutes), or practise budgeting in the " + a(T + "budget-boss/", "Budget Boss game") + ". You may also like " + a("https://moneyviel.com/learn/articles/the-no-spend-day-one-day-a-week-that-adds-up/", "The No-Spend Day") + " and " + a("https://moneyviel.com/learn/articles/start-here-your-money-journey-in-6-simple-steps/", "Start Here: Your Money Journey in 6 Simple Steps") + "."),
  p("Remember: a budget is not about saying no to everything. It is about deciding in advance where your money goes, so that the things you care about most always get paid for first."),
  h2("Quick answers"),
  p("<strong>How much should I save from a ₹25,000 salary?</strong><br>Start with what you can keep up every month, even ₹1,000–₹2,000, and raise it slowly. Around 10–20% is a common target once essentials are covered."),
  p("<strong>What if my rent takes half my salary?</strong><br>Keep needs as low as you can, cut wants first, and still save a small fixed amount. The habit matters more than the size at first."),
  p("<strong>Should I use cash or UPI for my budget?</strong><br>Either works. What matters is a clear limit for each line and a weekly check."),
  h3("Your small step today"),
  p("Write your four lines (Needs, Savings, Wants, Buffer) with amounts that add up to your take-home pay, and set up the salary-day transfer."),
 ],
 social="📒 How to make a monthly budget on a ₹25,000 salary: essentials first, save on salary day, then a limit for wants. Full example plan inside. 💡 #MoneyViel #Budgeting #PersonalFinance #MoneyTips #SalaryPlanning",
 alt="MoneyViel guide: how to make a monthly budget on a ₹25,000 salary",
 yt_title="Grab a pen ✍️ Can you answer this money question in 8 seconds? #MoneyViel #shorts",
 yt_desc="Savings earn 4%, prices rise 6% (example rates). A year later, your money buys A) more, B) the same, or C) less? Comment A, B or C!\nFull video: tap the related video link above. Take all 10 questions and get your money score out of 100.\n\n🔎 Search \"moneyviel.com\" for the free Money Health Report\n🌐 moneyviel.com/money-tools/money-health-report\n\nEducation only, not financial advice.\n\n#MoneyViel #PersonalFinance #MoneyTips #MoneyQuiz #FinancialLiteracy #Inflation",
 yt_tags="moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money, money quiz, money health check, financial health, money score, inflation quiz",
 related="lf",
))

# Teaser cut plans: (start, end, speed, top caption, bottom note)
TEASERS = {
 "debt-race": dict(segs=[(0, 8, 1, "Paying only the minimum on ₹80,000? 😟", "Example character · example rates"),
                         (48, 72, 2, "3 ways to pay the same debts. Watch the race 🏁", "Example rates and estimates"),
                         (88, 94, 1, "One plan finishes 12+ years sooner 🚀", "Example rates, not a forecast")],
                   end=("Full video: tap the link above ↑", "Run your own race free at moneyviel.com"), end_src=242),
 "saver-vs-spender": dict(segs=[(0, 8, 1, "Same salary. 10 years later… 😮", "Made-up twins in a money game"),
                                (132.5, 136.8, 1, "Plot twist: a hospital bill hits both 🏥", "Emergency fund or credit card?"),
                                (170.6, 175.8, 1, "Year 6: ₹8.27 lakh net worth vs ₹8.38 lakh in debt", "Game example with assumed rates")],
                   end=("Which twin are you? Full video: tap the link above ↑", "Play free at moneyviel.com"), end_src=268),
 "time-machine": dict(segs=[(0, 8, 1, "This ₹15 cup of tea in 2046? ☕", "Assumed 6% inflation a year, not a forecast"),
                            (90, 102, 1, "What will ₹100 buy in 2046? Guess fast ⏱️", "Assumed 6% inflation a year, not a forecast")],
                   end=("Full video: tap the link above ↑", "Try the ₹ Time Machine free at moneyviel.com"), end_src=252),
 "money-checkup": dict(segs=[(13, 18, 1, "Grab a pen ✍️ Can you answer in 8 seconds?", "10-question money check-up"),
                             (192, 207, 1, "Savings earn 4%, prices rise 6%. What happens? 🤔", "Example rates · comment A, B or C")],
                   end=("Take all 10 questions: full video above ↑", "Free Money Health Report at moneyviel.com"), end_src=282),
}

if __name__ == "__main__":
    for it in items:
        it["content_body"] = "\n\n".join(it["body"]) + "\n\n" + small(DISC)
    json.dump(dict(items=items, teasers=TEASERS), open("batch/batch.json", "w"), ensure_ascii=False, indent=1)
    for it in items:
        txt = html.unescape(__import__("re").sub("<[^>]+>", " ", it["content_body"]))
        print(it["date"], len(it["title"]), len(it["excerpt"]), len(it["yt_title"]), len(it["yt_tags"]), len(txt.split()), it["title"])
