# MoneyViel weekly content runbook (for the scheduled task)

**Golden rule: when in doubt, don't publish. Hold the item, explain why in `state/held.json`, and tell the owner. Nothing goes live without passing GATES 1–3.**

Owner: Mukesh (MoneyViel). Approved by the owner on 2026-11-04: generate and publish MoneyViel content automatically every week, everywhere (website, YouTube, and via Jetpack Social to Facebook/Instagram/Threads). Stay strictly inside: moneyviel.com, the "Moneyviel" YouTube channel (studio.youtube.com/channel/UCymQ9Fi0Ix922qcEmpl8U_g), and this repo. Never touch other sites, repos or accounts. Content must be educational personal-finance only: no stock tips, no "guaranteed returns", no investment advice; assumed returns must be labelled as assumptions.

## 0. Decide whether to run
1. Read `state/schedule.json` (`last_scheduled_date`, IST). Today = current IST date.
2. Always run GATE 4 (section 6c) first if anything was published since the last run. Then, if `last_scheduled_date` is more than 2 days after today AND `state/schedule.json` does not contain `"force_next_batch": true` → queue is healthy → STOP (finish with a one-line note). If `force_next_batch` is true, make the batch anyway and set it back to false when done.
3. Otherwise make the next batch: 7 items, one per day, for the 7 days starting the day after `max(last_scheduled_date, today)`, each at **19:30 IST**.

## 1. Weekly line-up (by weekday of the publish date)
| Day | Kind | Video maker | WP category id |
|---|---|---|---|
| Mon | quote | `make_story.js` kind=quote | 39 (Quotes) |
| Tue | game reel | `make_reel.js` (rotate cloud → piggy → monster, see `state/history.json`.next_game) | 38 (Articles) |
| Wed | story | `make_story.js` kind=story | 66 (Smart Money Habits) |
| Thu | guide (search post) | `make_story.js` kind=tip (short summary video) | 38 (Articles) |
| Fri | game reel | `make_reel.js` (next game in rotation) | 38 |
| Sat | story | `make_story.js` kind=story | 66 |
| Sun | guide (search post) | `make_story.js` kind=tip (short summary video) | 38 |

## 2. Write fresh content (no repeats)
- Read `state/history.json` (`used` list of hooks/titles). Write NEW items not in that list.
- Indian context (₹, Indian names, UPI, SIP, EMI, festivals), warm and relatable, short sentences.
- quote: hook (≤10 words) + 2–3 slides that unpack it + 1 "Try this today:" action slide.
- story: hook ("Priya earned ₹45,000 but…"), 3–5 slides telling a tiny real-life story with a turning point, 1 lesson slide, 1 action slide. Names are illustrative; never present as a real person.
- tip: hook ("The ₹100 rule…"), 3–4 practical slides with one concrete number/example, 1 action slide. Link a MoneyViel tool where it fits (https://moneyviel.com/money-tools/ …).
- guide (search post, owner-approved 2026-11-04 to grow Google traffic): pick ONE exact question everyday Indians type into Google, not already answered on moneyviel.com (check `/wp-json/wp/v2/search?search=...`) or in `used`. Evergreen money-habit questions only, e.g. "how to make a monthly budget on a ₹25,000 salary", "how much emergency fund do I need", "how to save money from a small salary", "50/30/20 rule explained with Indian example", "how to plan a wedding budget", "how to split rent with flatmates fairly", "how to stop impulse buying", "how to teach kids about money", "how to save for a festival without debt". Investing and insurance EDUCATION questions are welcome too (e.g. "how does a SIP work", "SIP vs lump sum explained", "what is NAV", "what is an expense ratio", "direct vs regular mutual fund plans", "term vs health insurance", "how much term cover do I need (rule of thumb, check with an adviser)", "how to check if an adviser is SEBI registered"). Never questions about which specific fund/stock/policy/card/loan/app to choose, market outlook, tax slabs, or anything ruled out in checklist items 1, 3 or 6.
  - Website article 700–1,100 words: title = the question in plain words (≤ 60 chars); slug = 3–6 keyword words; first paragraph answers the question in 2–3 sentences; 3–5 `<h2>` sections with short paragraphs, one worked ₹ example (maths computed in code), one numbered checklist; a short "Quick answers" section with 3 question/answer pairs; link to the matching MoneyViel calculator/game and to 2 older moneyviel.com posts (real URLs found via REST). Excerpt (≤ 155 chars) = the direct answer. If Rank Math meta is writable via REST (`meta.rank_math_focus_keyword`, `meta.rank_math_description`), set them; otherwise skip silently.
  - The video for a guide is a 30–45 s tip-style summary of the article; the post embeds it at the TOP of the article (same embed block as other posts), then the article, then the disclaimer.
  - The reviewer agent (GATE 1) reviews the full article text too.
- Save each spec as JSON (format in `tools/make_story.js` header). Keep slide text ≤ 22 words.

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
node make_story.js spec.json /tmp/rec_N            # quote/story/tip  -> prints {"src":...}
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
- Title ≤ 100 chars ending with `#shorts`; description: 2 lines of hook + `▶ Learn more: https://moneyviel.com/...` + `🕹️ Free money games: https://moneyviel.com/money-tools/` + `Education only, not financial advice.` + 5–6 hashtags incl. #MoneyViel.
- Afterwards open `.../videos/short` and confirm each new Short shows "Scheduled" with the right date; note each Short's URL (`https://youtube.com/shorts/ID`).

## 6. Website posts (moneyviel.com, same Chrome) — auto-shared to FB/IG/Threads by Jetpack when they go live
In a moneyviel.com tab: `nonce = await (await fetch('/wp-admin/admin-ajax.php?action=rest-nonce')).text()`; REST with header `X-WP-Nonce`.
- Upload the featured image: fetch the raw `.jpg` URL → POST `/wp-json/wp/v2/media` (body = blob, headers `Content-Type: image/jpeg`, `Content-Disposition: attachment; filename="moneyviel-<slug>.jpg"`), then set `alt_text`.
- Create the post: POST `/wp-json/wp/v2/posts` with `status:"future"`, `date:"YYYY-MM-DDT19:30:00"` (site time is IST), `categories:[id]`, `featured_media`, `excerpt` (first story sentence), `meta:{jetpack_publicize_message: <social caption with emojis + 4–6 hashtags>}`, and `content` in blocks:
  1. `<!-- wp:embed {"url":"<short URL>","type":"video","providerNameSlug":"youtube","responsive":true,"className":"wp-embed-aspect-9-16 wp-has-aspect-ratio"} --><figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-9-16 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">\n<short URL>\n</div></figure><!-- /wp:embed -->`
  2. `<h3 class="wp-block-heading mv-example">What this looks like in real life</h3>` + 1–3 short paragraphs (the story/explanation),
  3. `<h3>Your small step today</h3>` + 1 paragraph action, 4. for game reels: a button to the game page, 5. the disclaimer paragraph from GATE 1 item 9 (small font).
  Titles: quotes as `Quote – <quote>`, stories as `Story: <title>`, tips/games as normal titles. Never reuse an existing post title.
- Confirm each post shows `status: "future"` with the right date.

## 6b. GATE 3: verify what was scheduled
- YouTube Studio Shorts list: each new Short is "Scheduled" on the right date/time, title and description exactly as approved, audience "Not made for kids".
- Each WordPress post via REST (`context=edit`): `status` = `future`, correct date, category, featured image set, disclaimer present, embed URL correct, all links return HTTP 200 (`fetch(url,{method:'HEAD'})`), no duplicate title among existing posts.
- Fix any mismatch immediately; if it cannot be fixed, set that post back to `draft`, set the Short to Private, record it in `state/held.json` and tell the owner.

## 6c. GATE 4: after publishing (every run, even when step 0 says "stop")
Check items whose publish time passed since the last run: the post is live (`status: publish`) and its page loads; the Short is Public; Jetpack share-status (`/wp-json/wpcom/v2/publicize/share-status?post_id=ID`) shows success for Facebook, Instagram and Threads. Also scan new comments on those posts (`/wp-json/wp/v2/comments?status=hold`) and mark obvious spam as spam (never approve or reply on the owner's behalf). Report any failure to the owner; never delete published content without telling him (unpublish to draft/private if it is harmful or wrong, then report).

## 7. Clean up and record
- Remove `upload/` files: create an orphan commit containing everything except `upload/` and `out/` (`git checkout --orphan tmp; git rm -r --cached upload; ...; git push -f origin main`) so videos don't stay in history.
- Update `state/history.json` (append hooks/titles to `used`, advance `next_game`) and `state/schedule.json` (`last_scheduled_date` = last date scheduled, `log` += {date, items:[{date,kind,title,short_url,post_id}]}). Commit + push.
- Send the owner a short message (SendUserMessage / final answer): the 7 dates, titles, and links. If anything failed (e.g. Chrome not reachable), say exactly what is still pending; do NOT update `last_scheduled_date` for items that were not scheduled, so the next run (twice daily) retries.

## If Chrome is not reachable
Do steps 0–4 only if they are not already done for this batch (check `state/pending.json`), save specs/videos to the repo under `pending/`, write `state/pending.json`, and finish with a one-line note. The next run will pick up from `pending/` when the laptop is on.
