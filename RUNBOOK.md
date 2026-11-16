# MoneyViel weekly content runbook (for the scheduled task)

**Golden rule: when in doubt, don't publish. Hold the item, explain why in `state/held.json`, and tell the owner. Nothing goes live without passing GATES 1–3.**

Owner: Mukesh (MoneyViel). Approved by the owner on 2026-11-04: generate and publish MoneyViel content automatically every week, everywhere (website, YouTube, and via Jetpack Social to Facebook/Instagram/Threads). Stay strictly inside: moneyviel.com, the "Moneyviel" YouTube channel (studio.youtube.com/channel/UCymQ9Fi0Ix922qcEmpl8U_g), and this repo. Never touch other sites, repos or accounts. Content must be educational personal-finance only: no stock tips, no "guaranteed returns", no investment advice; assumed returns must be labelled as assumptions.

## 0. Decide whether to run
1. Read `state/schedule.json` (`last_scheduled_date`, IST). Today = current IST date.
2. Always run GATE 4 (section 6c) first if anything was published since the last run. Check the kids queue (section 2a) and make a kids batch if it is due. Then, if `last_scheduled_date` is more than 2 days after today AND `state/schedule.json` does not contain `"force_next_batch": true` → queue is healthy → STOP (finish with a one-line note). If `force_next_batch` is true, make the batch anyway and set it back to false when done.
3. Otherwise make the next batch: 7 items, one per day, for the 7 days starting the day after `max(last_scheduled_date, today)`, each at **19:30 IST**.

**Brand logo (2026-11-15):** the logo is the rising-bars-and-gold-coin icon + "moneyviel" wordmark in **Quicksand** (tools/logo.js). Always load the Quicksand font before drawing it (an earlier site logo was drawn in a fallback serif by mistake). Website header logo = media 2243 (light 2244), site icon 2174, Rank Math org logo = icon. YouTube, Facebook (profile + cover), Instagram and Threads use the icon on white since 15 Nov 2026. LinkedIn company page (id 102556609, logo only; never post about edits, never open the owner's personal LinkedIn profile) updated 15 Nov 2026. X (@moneyvielcom) avatar + header updated 16 Nov 2026.

## 1. Weekly line-up (by weekday of the publish date) — owner-approved 2026-11-15, from the 19 Nov 2026 batch on
Every day gets ONE real text post on moneyviel.com (no standalone quote posts, no game-reel posts: those are thin pages that hurt AdSense). Each post is also the "Money tip of the day" card in the owner's Knowtopia app (it reads the newest moneyviel.com post at 12 AM IST), so the **title prefix is required** — the app shows it as the card's label.
| Day | Type | Title format (prefix exact) | Short video maker | WP category id |
|---|---|---|---|---|
| Mon | Myth or Fact | `Myth or Fact: <common money belief>` | `make_story.js` kind=tip | 66 (Smart Money Habits) |
| Tue | Story | `Story: <name>'s <₹ situation>` | `make_story.js` kind=story | 66 |
| Wed | How-to guide (search post) | the Google question, no prefix | `make_story.js` kind=tip | 38 (Articles) |
| Thu | Money word | `Money Word: <term> explained` | `make_story.js` kind=tip | 38 |
| Fri | Weekend challenge | `Weekend Challenge: <one small action>` | `make_story.js` kind=tip | 66 |
| Sat | Family money moment | `Family Money: <activity/talk with kids>` | `make_story.js` kind=story | 66 |
| Sun | Quiz | `Quiz: <3 questions on a theme>` | `make_story.js` kind=tip | 38 |

Card rules for EVERY post (Knowtopia shows the title, the excerpt and the first ~1,400 characters of text; CA Foundation students, some under 18, read it inside the app without a link):
- Excerpt (≤ 155 chars) = the one-line takeaway / direct answer. Never empty.
- First 2–3 paragraphs must stand alone as the full tip (no "see the video above", no "click here").
- Suitable for every age and family; ₹ examples small and everyday.
- Game reels: YouTube Shorts only (no website post), at most one a week, as an extra Short only if the day's Short slot is free (never on long-form teaser days).

## 2. Write fresh content (no repeats)
- Read `state/history.json` (`used` list of hooks/titles). Write NEW items not in that list.
- Indian context (₹, Indian names, UPI, SIP, EMI, festivals), warm and relatable, short sentences.
- Myth or Fact (400–700 words): the belief in the title; first paragraph gives the verdict (Myth / Fact / Partly true) and why in 2 sentences; then a ₹ example (maths computed in code), "What to do instead" (3 bullets), and a link to a fitting MoneyViel tool.
- Story (400–700 words): hook ("Priya earned ₹45,000 but…"), a tiny real-life story with a turning point, one lesson, one "Try this today" action. Names are illustrative; never present as a real person.
- Money Word (400–700 words): plain-English meaning in 1–2 sentences first; then a ₹ example, a common mix-up, and "where you'll see it". Concepts only (e.g. compounding, inflation, emergency fund, EMI, NAV, expense ratio, credit score, net worth) — no product or market talk. Link https://moneyviel.com/money-tools/money-words/.
- Weekend Challenge (300–600 words): one small, safe, free action for Sat–Sun (e.g. no-spend day, unsubscribe from 3 shopping apps' alerts, list every subscription), why it helps, how to do it step by step, how to note the result. Link the 52-Week Challenge tool where it fits.
- Family Money (400–700 words): a 10–15 minute activity or conversation with children (pocket money jar, price-guessing at the market, needs vs wants game), with age tips (5–8, 9–12, 13+). Never shames children or parents. Link https://moneyviel.com/money-tools/kids/.
- Quiz (300–600 words): 3 multiple-choice questions on one theme; answers with one-line explanations come after the questions under the heading "Answers"; end with "Check your full money health" → the Money Health Report tool. Close with an original one-line "Quote of the week".
- guide (search post, owner-approved 2026-11-04 to grow Google traffic): pick ONE exact question everyday Indians type into Google, not already answered on moneyviel.com (check `/wp-json/wp/v2/search?search=...`) or in `used`. Evergreen money-habit questions only, e.g. "how to make a monthly budget on a ₹25,000 salary", "how much emergency fund do I need", "how to save money from a small salary", "50/30/20 rule explained with Indian example", "how to plan a wedding budget", "how to split rent with flatmates fairly", "how to stop impulse buying", "how to teach kids about money", "how to save for a festival without debt". Investing and insurance EDUCATION questions are welcome too (e.g. "how does a SIP work", "SIP vs lump sum explained", "what is NAV", "what is an expense ratio", "direct vs regular mutual fund plans", "term vs health insurance", "how much term cover do I need (rule of thumb, check with an adviser)", "how to check if an adviser is SEBI registered"). Never questions about which specific fund/stock/policy/card/loan/app to choose, market outlook, tax slabs, or anything ruled out in checklist items 1, 3 or 6.
  - Website article 700–1,100 words: title = the question in plain words (≤ 60 chars); slug = 3–6 keyword words; first paragraph answers the question in 2–3 sentences; 3–5 `<h2>` sections with short paragraphs, one worked ₹ example (maths computed in code), one numbered checklist; a short "Quick answers" section with 3 question/answer pairs; link to the matching MoneyViel calculator/game and to 2 older moneyviel.com posts (real URLs found via REST). Excerpt (≤ 155 chars) = the direct answer. If Rank Math meta is writable via REST (`meta.rank_math_focus_keyword`, `meta.rank_math_description`), set them; otherwise skip silently.
  - The video for a guide is a 30–45 s tip-style summary of the article; the post embeds it at the TOP of the article (same embed block as other posts), then the article, then the disclaimer.
  - The reviewer agent (GATE 1) reviews the full article text too.
- Save each spec as JSON (format in `tools/make_story.js` header). Keep slide text ≤ 22 words.

## 2a. Daily kids post ("Money for Kids") — owner-approved 2026-11-15
One extra website post EVERY day at **18:00 IST** for children of Grades 1–8 (ages ~6–13). The owner's Knowtopia app shows these to Grades 1–8 as an in-app card (no link out), refreshing at 12 AM IST.
- **Queue:** tracked separately in `state/schedule.json` → `kids_last_date`. In step 0, if `kids_last_date` is missing or is less than 3 days after today, make a kids batch: 7 posts, one per day, for the 7 days starting the day after `max(kids_last_date, today)` — even when the main queue is healthy. Log it in `log` with `"note":"kids batch"`, update `kids_last_date`, add titles to `state/history.json` → `used`.
- **Category:** "Money for Kids", slug `money-for-kids`. Created 2026-11-15 (id 67). **No ads:** the Code Snippets snippet "MoneyViel: no ads on kids pages" (id 5) blocks the Site Kit AdSense tag on posts in this category and on its category page, and (since 16 Nov 2026) turns comments and pings off on them; also create kids posts with `comment_status:"closed"`, `ping_status:"closed"` — never deactivate it, and never put a kids post in any other category (it would get ads). If `/wp-json/wp/v2/categories?slug=money-for-kids` returns nothing, create it (POST `/wp-json/wp/v2/categories` `{name:"Money for Kids", slug:"money-for-kids", description:"Fun, simple money lessons for children aged 6–13 — read together with a grown-up."}`). Kids posts use ONLY this category (never 38/39/66), so they stay out of the grown-ups' card.
- **No YouTube video** for kids posts (avoid "made for kids" channel issues). Featured image: render a 1080×1350 card with Playwright from simple HTML (MoneyViel colours, big title, one large emoji, "Money for Kids" badge) and upload it as usual.
- **Daily rotation (weekday of publish date):** Mon tiny story · Tue money riddle (answer at the end under "Answer") · Wed needs or wants? sorting game · Thu money word for kids (e.g. saving, budget, interest as "money that grows", earning) · Fri make-and-do activity (savings jar, price-tag shop at home, coin sorting) · Sat count-the-coins maths (3 small sums, answers at the end) · Sun sharing, kindness and saving story.
- **Writing rules:** 250–450 words; title ≤ 50 chars, no prefix, fun and clear ("Riya's Piggy Bank Race"); excerpt ≤ 120 chars = the one-line idea; very short sentences and easy words (a Grade 2 child can follow it read aloud); amounts small (₹1–₹500, coins and notes); first 3 short paragraphs carry the whole idea; one "Try it today" line; end with a short "For grown-ups:" paragraph (what the child learns, one way to talk about it). Illustrative first names from all communities, boys and girls equally.
- **Kids safety (in addition to the GATE 1 checklist):** nothing about loans, credit cards, debt, EMIs, investing, shares, insurance, gambling, betting, lotteries, crypto, online shopping apps or in-app purchases; no brands or products; no fear, shame or comparison between rich and poor families; no asking children to share personal details, go online, or contact anyone; no links in the body (the website footer is enough); no prizes or rewards for clicking. Reviewer agent must check these too.
- Posts end with the standard disclaimer paragraph (GATE 1 item 9).

## 2b. GATE 1: independent compliance review of every script (BEFORE rendering)
Spawn a separate reviewer agent (Agent tool, fresh context, give it only the specs + this checklist, NOT your reasoning). It must return PASS / FIX (with exact edits) / HOLD for each item. Apply fixes, then re-review until PASS. Any HOLD → drop that item, write it to `state/held.json` with the reason, replace it with a new item and review that too. Never publish an item that did not PASS.

**Compliance checklist (all must be true):**
1. **Education yes, advice no (SEBI-safe; owner-approved 2026-11-04):** investor EDUCATION is allowed and encouraged: how SIPs, mutual funds (NAV, expense ratio, direct vs regular), compounding, rupee-cost averaging, asset classes, risk vs return, diversification, asset allocation as a concept, term vs health insurance, claim settlement ratio, reading a policy, checking an adviser's SEBI registration, scam red flags. NOT allowed: naming or ranking any specific stock, mutual fund/scheme, AMC, bank, insurer, broker, app, fintech or crypto; "best fund/policy" lists; buy/sell/hold calls or telling a reader what to invest in; return promises or past-performance claims for any product; market predictions or timing; ANY market, sector, company or economy commentary (owner works in equity research: conflict of interest); live or recent (last 3 months) market prices or index levels. Investment/insurance pieces end with a line suggesting a SEBI-registered investment adviser (or licensed insurance adviser) for personal decisions.
2. **No guarantees or misleading claims (ASCI-style honesty):** no "guaranteed", "risk-free", "double your money fast", "get rich"; any growth number says "assumed X% return, not guaranteed"; maths verified by actually computing it in code; claims are general and true.
3. **Facts that change over time** (tax slabs, limits like DICGC ₹5 lakh, interest rates, laws): avoid them; if essential, verify with a web search on the day and write "as of <month year>".
4. **No conflict of interest / no third parties:** no brand names, logos, products, people, companies, competitors, politicians, celebrities or employers; no affiliate links, sponsorships or endorsements; no disparagement of anyone; links only to moneyviel.com and the Moneyviel YouTube channel.
5. **Copyright / IP:** original wording only (no song lyrics, book passages or copied quotes; well-known proverbs only if public domain and unattributed paraphrase); only the built-in original music; no third-party images, characters or logos.
6. **No harm:** nothing that encourages debt, gambling, betting, crypto speculation, loan apps, skipping insurance or EMIs, or risky behaviour; no shaming of poverty, debt, gender, caste, religion, region, age or body; no fear-mongering; nothing about self-harm; suitable for all ages and families; respectful of all communities and festivals.
7. **Privacy:** characters are clearly illustrative everyday people with common first names only; no real people, no personal data, no real-looking documents/screens of real apps.
8. **Platform rules:** YouTube "Not made for kids"; titles/descriptions/hashtags honestly match the video (no clickbait that misleads); no misleading thumbnails; hashtags relevant and ≤ 8.
9. **Disclaimer:** every website post ends with the paragraph `This content is for general education only and is not financial, investment, tax or legal advice. Please consult a qualified professional before making financial decisions.` and every YouTube description contains `Education only, not financial advice.`
10. **Language & accuracy:** correct spelling/grammar, ₹ amounts formatted Indian-style, numbers consistent between video, post and caption.

## 3. Make the videos (in the cloud workspace)
```
cd tools
npm i playwright >/dev/null 2>&1 || true   # Chromium is pre-installed
node make_story.js spec.json /tmp/rec_N            # story/tip (every post type uses one of these; 30–45 s summary of the article) -> prints {"src":...}
./finish_video.sh /tmp/rec_N/*.webm /tmp/rec_N/events.json ../out/DATE-kind.mp4 SEED
node make_reel.js cloud|piggy|monster              # game reel -> /tmp/reelrec_GAME/*.webm, events /tmp/ev_GAME.json
./finish_video.sh /tmp/reelrec_GAME/*.webm /tmp/ev_GAME.json ../out/DATE-game.mp4 SEED
```
Use a different SEED every item (e.g. day-of-year) so the music differs. Featured image for each item (1080×1350):
`ffmpeg -ss 1.2 -i out/X.mp4 -frames:v 1 -vf "crop=1080:1350:0:285" out/X.jpg` (for game reels use `-ss 8`).
Check 2–3 frames of every video visually before publishing; regenerate anything broken.

## 3b. GATE 2: quality check of every video and image (BEFORE upload)
For each mp4: `ffprobe` must show 1080×1920 video + AAC audio, duration 15–60 s; extract frames at 10%, 30%, 50%, 70%, 90% and LOOK at them (Read the PNGs): text fully visible, not cut off, no overlapping elements, no blank/black frames, captions readable, branding present, no game glitches; `ffmpeg -af volumedetect` mean volume between −20 and −10 dB (not silent, not clipping). Each featured image: 1080×1350, readable text. Re-render anything that fails (max 2 retries, then HOLD that item and replace it).
Give the frames + final texts to the reviewer agent for a last PASS on what will actually be published.

## 4. Host files for the browser
Attach this repo with push access (add_repo moneyviel/moneyviel-reels, access push), copy `out/*.mp4` and `out/*.jpg` into `upload/`, commit and push to `main`. Files are then at `https://raw.githubusercontent.com/moneyviel/moneyviel-reels/main/upload/<file>` (YouTube Studio and moneyviel.com pages can fetch these).

## 5. YouTube Shorts (Claude in Chrome, the MoneyViel profile — the only connected browser)
For each video: open `https://studio.youtube.com/channel/UCymQ9Fi0Ix922qcEmpl8U_g/videos/upload?d=ud`, then in page JS:
- wait for `input[type=file]`; fetch the raw URL → `new File([blob],'name.mp4',{type:'video/mp4'})` → DataTransfer → set `.files` → dispatch `change`.
- wait for `#title-textarea #textbox`; set title and description with `focus(); document.execCommand('selectAll'); document.execCommand('insertText', false, text)` (NEVER type with the keyboard — the title box swallows it).
- click `tp-yt-paper-radio-button[name="VIDEO_MADE_FOR_KIDS_NOT_MFK"]`; click `#next-button` 3× (1.5 s apart).
- click `#second-container-expand-button`, click `#second-container #datepicker-trigger`, then click the calendar day with the computer tool (screenshot first); click the time box (find "time of day textbox"), then find + scroll_to + click the "7:30 PM" option.
- verify `#datepicker-trigger` text and time input value, click `#done-button`; if a "We're still checking your content" dialog appears click "Got it".
- Title ≤ 100 chars: put the main keyword first, end with `#MoneyViel #shorts` (the first hashtags show above the title).
- Description (links in Shorts descriptions are NOT clickable — YouTube rule since 2023 — so never write "click the link"): line 1–2 hook; then `🔎 Search "moneyviel.com" for the free <tool name>` and `🌐 moneyviel.com/<short-path>` written as plain text (short, easy to type); then `Education only, not financial advice.`; then 5–8 hashtags, always `#MoneyViel #PersonalFinance #MoneyTips` + 2–5 topic hashtags (e.g. #CreditCardDebt #Budgeting #SavingMoney #FinancialLiteracy #IndiaFinance).
- TAGS (Studio → "Show more" → Tags field, comma-separated, ≤ 450 chars): always `moneyviel, money viel, moneyviel.com, moneyviel shorts, personal finance, personal finance india, money tips, financial literacy, budgeting, saving money` + 5–10 topic tags matching the video (e.g. "credit card debt, minimum due, debt payoff, emi calculator"). Fill the tags box with `insertText` like the title; verify it saved.
- Related video (the only clickable link a Short can carry): if the "Related video" field is available in Details (needs advanced features), set it to the long-form video "MoneyViel Free Money Tools Tour" (video ID ritFEzIrZJ4, its description has clickable links): click the "Related video" button in Details, pick the option whose text starts with "MoneyViel Free Money Tools Tour", Save, and confirm the Save button becomes disabled. If the field is unavailable, note it in the report.
- Afterwards open `.../videos/short` and confirm each new Short shows "Scheduled" with the right date; note each Short's URL (`https://youtube.com/shorts/ID`).

## 6. Website posts (moneyviel.com, same Chrome) — auto-shared to FB/IG/Threads by Jetpack when they go live
In a moneyviel.com tab: `nonce = await (await fetch('/wp-admin/admin-ajax.php?action=rest-nonce')).text()`; REST with header `X-WP-Nonce`.
- Upload the featured image: fetch the raw `.jpg` URL → POST `/wp-json/wp/v2/media` (body = blob, headers `Content-Type: image/jpeg`, `Content-Disposition: attachment; filename="moneyviel-<slug>.jpg"`), then set `alt_text`.
- Create the post: POST `/wp-json/wp/v2/posts` with `status:"future"`, `date:"YYYY-MM-DDT19:30:00"` (site time is IST), `categories:[id]`, `featured_media`, `excerpt` (the one-line takeaway, see the card rules in section 1), `meta:{jetpack_publicize_message: <social caption with emojis + 4–6 hashtags>}`, and `content` in blocks:
  1. `<!-- wp:embed {"url":"<short URL>","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-9-16 wp-has-aspect-ratio"} --><figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-9-16 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">\n<short URL>\n</div></figure><!-- /wp:embed -->`
  2. the full article for that day's type (section 2), starting with the stand-alone takeaway paragraphs,
  3. `<h3>Your small step today</h3>` + 1 paragraph action, 4. the disclaimer paragraph from GATE 1 item 9 (small font).
  On long-form teaser days the embedded video is that day's teaser Short. Titles use the prefixes in section 1 (guides have none). Never reuse an existing post title.
- Confirm each post shows `status: "future"` with the right date.

## 6b. GATE 3: verify what was scheduled
- YouTube Studio Shorts list: each new Short is "Scheduled" on the right date/time, title and description exactly as approved, audience "Not made for kids".
- Each WordPress post via REST (`context=edit`): `status` = `future`, correct date, category, featured image set, disclaimer present, embed URL correct, all links return HTTP 200 (`fetch(url,{method:'HEAD'})`), no duplicate title among existing posts.
- Fix any mismatch immediately; if it cannot be fixed, set that post back to `draft`, set the Short to Private, record it in `state/held.json` and tell the owner.

## 6d. X and LinkedIn Page sharing (owner-approved 2026-11-16)
Jetpack shares to Facebook, Instagram and Threads automatically. **X and the LinkedIn Page are posted by the autopilot itself** in the MoneyViel Chrome, every run (they are not Jetpack connections: Jetpack has no X, and its LinkedIn link would need the owner's personal LinkedIn login, which is off-limits).
- **What to share:** every moneyviel.com post published in the last 48 hours that is not yet in `state/social.json` (start from posts published on/after 2026-11-15). The 10:25 run therefore shares the previous evening's posts in the morning; the 18:25 run shares the 18:00 kids post.
  - X (@moneyvielcom): main daily posts AND kids posts. LinkedIn Page: main daily posts only (no kids posts, no quote-only posts).
- **X:** go to https://x.com/compose/post (or the Home composer). Before typing, confirm the account is **Moneyviel (@moneyvielcom)** — if not, stop and tell the owner. One post per article, max 270 characters: a hook line from the article, one useful takeaway, the article link, then `#MoneyViel #PersonalFinance` (kids posts: start with "For parents:" and use `#MoneyViel #KidsAndMoney`). No threads, replies, likes, follows, reposts or DMs. Type with the computer `type` action, click Post, then confirm the post appears on https://x.com/moneyvielcom.
- **LinkedIn Page:** work ONLY inside https://www.linkedin.com/company/102556609/admin/ (Page posts → Start a post / "Create"). Never open the owner's personal profile (`/in/...`), personal feed composer or messaging, and never post or comment as the person. In the composer confirm it says it is posting as **moneyviel.com** (the Page). Text: hook line, 3 short bullet takeaways, "Read more: <link>", then 3–5 hashtags (#MoneyViel #PersonalFinance #MoneyTips #FinancialLiteracy + one topic tag). Wait for the link preview card, then Post. Decline every "share your page edits / changes" prompt (owner rule: never share page or profile changes).
- **Compliance:** the same GATE 1 rules apply to every caption (education only, no products/brands, no market talk, no returns promises, no links other than moneyviel.com). Never post about logo, banner, profile or page changes.
- **Record** each share in `state/social.json` as `{"<post_id>": {"x": "<x status url or skipped>", "linkedin": "<done|skipped>", "date": "YYYY-MM-DD"}}` and commit. If X or LinkedIn will not load after two tries, leave it for the next run and say so in the report.

## 6c. GATE 4: after publishing (every run, even when step 0 says "stop")
Check items whose publish time passed since the last run: the post is live (`status: publish`) and its page loads; the Short is Public; Jetpack share-status (`/wp-json/wpcom/v2/publicize/share-status?post_id=ID`) shows success for Facebook, Instagram and Threads. Also scan new comments on those posts (`/wp-json/wp/v2/comments?status=hold`) and mark obvious spam as spam (never approve or reply on the owner's behalf). Report any failure to the owner; never delete published content without telling him (unpublish to draft/private if it is harmful or wrong, then report).

**Weekly comment spam sweep (owner-requested 2026-11-16):** if `state/checks.json` → `comments_swept` is missing or 7+ days old: GET `/wp-json/wp/v2/comments?status=hold&per_page=100&context=edit`. Mark as spam (POST `{status:"spam"}`) every pending comment that contains links (`[url=`, `<a `, `http`), casino/betting/crypto/loan/adult words, non-English promo text, or is generic praise with a commercial author URL. Leave real reader questions or feedback pending and list them for the owner in the report (never approve or reply on his behalf). Never touch the owner's own comments (author "moneyviel.com"). Record the date and the count in `state/checks.json`.

**Weekly kids no-ads check (owner-requested 2026-11-15):** if `state/checks.json` → `kids_ads_checked` is missing or 7+ days old, in the moneyviel.com tab: (1) GET `/wp-json/code-snippets/v1/snippets/5` and confirm `active: true` (if the plugin or snippet is missing/inactive, re-activate it — reinstall plugin `code-snippets` and recreate the snippet from the "Category" line in section 2a if needed); (2) open the newest published Money for Kids post's HTML (`fetch(link,{credentials:'omit'})`) and confirm it contains NO `googlesyndication.com/pagead`, and that a normal post still does. Record the date in `state/checks.json`. If anything failed and you could not fix it, tell the owner at the top of the report.

## 7. Clean up and record
- Remove `upload/` files: create an orphan commit containing everything except `upload/` and `out/` (`git checkout --orphan tmp; git rm -r --cached upload; ...; git push -f origin main`) so videos don't stay in history.
- Update `state/history.json` (append hooks/titles to `used`, advance `next_game`) and `state/schedule.json` (`last_scheduled_date` = last date scheduled, `log` += {date, items:[{date,kind,title,short_url,post_id}]}). Commit + push.
- Send the owner a short message (SendUserMessage / final answer): the 7 dates, titles, and links. If anything failed (e.g. Chrome not reachable), say exactly what is still pending; do NOT update `last_scheduled_date` for items that were not scheduled, so the next run (twice daily) retries.

## If Chrome is not reachable
Do steps 0–4 only if they are not already done for this batch (check `state/pending.json`), save specs/videos to the repo under `pending/`, write `state/pending.json`, and finish with a one-line note. The next run will pick up from `pending/` when the laptop is on.


## Long-form videos (week of 19–25 Nov 2026) — extra autopilot duties
Scheduled long-form videos (11:00 AM IST), files + metadata in `longform/` of this repo:
| Date | Video ID | Slug | Main tool page |
|---|---|---|---|
| 2026-11-19 | Ih-rtpAdTCM | debt-race | https://moneyviel.com/money-tools/debt-payoff-planner/ (also /minimum-due-calculator/) |
| 2026-11-21 | oXYd6Dy32hE | saver-vs-spender | https://moneyviel.com/money-tools/life-simulator/ |
| 2026-11-23 | GvYu2WtOVOI | time-machine | https://moneyviel.com/money-tools/inflation-calculator/ (also /goal-planner/) |
| 2026-11-25 | uXJlwcg4KIs | money-checkup | https://moneyviel.com/money-tools/money-health-report/ |

1. **Teaser Shorts (when building the 19–25 Nov batch):** the 7:30 PM Short on each of these four dates must be a 20–30 s vertical teaser cut from that day's long-form video (`longform/<slug>.mp4`, idea in `longform/<slug>.json` → `short_idea`): crop/reframe to 1080×1920 with big captions, end card "Full video: tap the link above ↑". Title ends `#MoneyViel #shorts`; tags as usual; **Related video = that day's long-form video** (pick it in the Related video picker by its title). These replace that day's planned Short; keep the rest of the line-up. GATE 1 and GATE 2 apply.
2. **After each video goes public (on any run on/after its date):**
   a. Post the `pinned_comment` from `longform/<slug>.json` as a comment on the video (studio.youtube.com/video/<id>/comments or the watch page, signed in as the channel) and pin it. Verify it shows "Pinned".
   b. Embed the video on its main tool page(s) on moneyviel.com: insert, right after the tool's `wp:html` block, `<!-- wp:embed {"url":"https://www.youtube.com/watch?v=<ID>","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-16-9 wp-has-aspect-ratio"} -->` … `<!-- /wp:embed -->` preceded by an h2 "Watch: <short title>" (only once; skip if already present).
   c. Add it to the YouTube playlist "MoneyViel Free Money Tools" if not already there.
   d. Record done items in `state/longform.json`.
3. Delete `longform/*.mp4` from the repo (orphan-commit cleanup as usual) only after all four teasers are scheduled and 25 Nov has passed.
