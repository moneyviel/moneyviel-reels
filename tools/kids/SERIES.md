# MoneyViel Kids: "Piggu & Sikka" series bible (owner-approved 2026-11-18)

Channel: **@moneyvielkids** (UCZmZj7a0pktCih6UgiNkJqA), Made for Kids. Audience: ages 5–12, worldwide. No voice: everything is told through pictures, speech bubbles, big text and sound effects.

## Characters (only these two; draw anything else as objects: shops, kites, jars, toys, fruit)
- **Piggu**: a pink piggy bank (`MVK.piggu(mood)`). Dreamy, excited, sometimes impulsive. Learns the lesson. Name tag pink.
- **Sikka**: a little gold coin (`MVK.sikka(mood)`). Clever, kind, has the ideas. Name tag gold.
- Moods: happy, wow, think, wink.

## Every episode (Shorts: 45–58 s, never over 59 s)
1. Hook (0–4 s): a big question on screen ("Can tiny coins buy a BIG dream?").
2. Problem: Piggu wants or meets something.
3. Idea: Sikka suggests a plan.
4. **PAUSE & GUESS**: question shown for 1.5 s, then `timer(ts,a,6,y)` (6 s think timer), then the answer built up visually and **held on screen at least 4 s**.
5. A twist or second choice (need or want, wait or buy, share or keep): 3 s timer, answer held at least 3.5 s.
6. Happy ending, then the lesson card ("Small coins + patience = BIG dreams! ⭐").
7. Cliffhanger: "Next time: …" (must match the next episode's story).

## Screen rules (owner's feedback, 18 Nov 2026)
- Every spoken line is a `say('piggu'|'sikka', text, ts, start, {x, baseY, w, tx, ty})` bubble: name tag on top, border and pointer in the speaker's colour, pointer on the speaker's head. Only ONE bubble at a time.
- Characters stand in fixed spots at the bottom (Piggu bottom-left, Sikka bottom-right). Bubbles and text go ABOVE their heads. Nothing ever covers a character's face.
- Max ~12 words per bubble. Big text is dark purple with a white outline (`big()`).
- Money is always **"coins"** (never ₹, $, or any real currency). Small, round numbers (5, 10, 20, 50, 60, 100).
- Every number checked in code before rendering (write the check as a comment at the top of the episode file).
- The logo corner and "Ep N" chip are automatic; the end card shows the big logo.
- Sound effects via `EP.sfx` on every reveal; music via `make_audio.py` (original).
- Emojis that render: 🪁 💡 🤔 ✋ 🎉 ⭐ 💪 🍬 🔍 🍋 🎁 🌱 🎈 🧸 🍎 🌍. Check every frame sheet for boxes (missing glyphs).

## Story arc (go in order; add new ones at the end, never repeat a lesson within 10 episodes)
| Ep | Title | Lesson | Pause & guess (maths) | Twist |
|---|---|---|---|---|
| 1 | Piggu's Kite Dream (LIVE: youtube.com/shorts/q6YibigUdIY) | Save a little every day | 10 a day for 60 → 6 days | Candy: want → skip |
| 2 | Sikka's Mystery Coin | Every country has its own money | The coin says 5. Piggu has 20. 20 + 5 = 25 | Keep it or show it to a grown-up? → show a grown-up |
| 3 | The Lemonade Stand 🍋 | Earning by working | 6 cups × 5 coins = 30 | Lemons cost 10 → 30 − 10 = 20 left |
| 4 | Need or Want Market | Needs first | Sort 4 items: apple, water, toy car, sticker | Only 20 coins: what first? |
| 5 | Three Jars | Save, spend, share | 30 coins in 3 equal jars → 10 each | Share jar: who to help? |
| 6 | The Price Tag Puzzle | Compare prices | Ball 25 vs ball 40 → 15 saved | Same ball, different shop |
| 7 | A Gift for Grandma 🎁 | Saving for others | 5 a day for 30 → 6 days | Big gift or homemade card + small gift? |
| 8 | The Wait-a-Day Rule | Don't buy in a rush | Toy 40, wants it now, has 30 → 10 short | Next day Piggu doesn't want it any more |
| 9 | Coin Count Race | Counting by 5s | 5, 10, 15 … 50 → 10 coins | Race against the timer |
| 10 | The Broken Toy 🧸 | Take care of things | Fix 10 vs new 50 → 40 saved | Glue and fix together |
| 11 | Fair Day 🎈 | Make a budget | 50 coins, 3 rides × 15 → 5 left | Popcorn costs 10: enough? (no) |
| 12 | Sikka's Coin Garden 🌱 | Saved money can grow | 100 saved, 10 extra added → 110 | Patience again |
| 13 | Trade Day | Fair swaps | 2 stickers = 1 marble; 6 stickers → 3 marbles | Unfair swap offer: say no kindly |
| 14 | Too Many Snacks | Small spends add up | 5 a day for 7 days → 35 | Choose 2 snack days instead |
| 15 | Coins Around the World 🌍 | Money looks different everywhere | Count coins of 3 shapes | Which one is the heaviest? |
After Ep 15: continue with new stories on the same lesson list (saving goal, earning, needs vs wants, sharing, comparing, budgeting, waiting, taking care), with fresh situations (school fair, rainy-day jar, birthday party, garden, picnic, festival lights, snow day, beach trip).

## Global and festivals
Rotate everyday settings from many cultures. Festival specials on the day before: Diwali, Christmas, Eid, Lunar New Year, Holi, back to school. No religious teaching; just the celebration and a money lesson (budget for gifts, sharing sweets).
