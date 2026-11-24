"""Featured image card 1080x1350 with the real MoneyViel logo.
usage: python3 make_card.py out.jpg "LABEL" "emoji" "Title line 1|line 2|line 3"
'|' sets the line breaks yourself (best: 2-3 lines of similar length, never one lonely word);
without '|' the browser balances the lines (text-wrap: balance)."""
import sys, os, html, base64
from playwright.sync_api import sync_playwright
out,label,emoji,title=sys.argv[1:5]
D=os.path.dirname(os.path.abspath(__file__))
e=html.escape
lines=[e(x.strip()) for x in title.split('|')]
t='<br>'.join(lines)
longest=max(len(x) for x in title.split('|')) if '|' in title else max(12,round(len(title)/2.4))
fs=min(96, int(1500/ max(longest,10)))   # big but always fits 920px
f64=lambda n:base64.b64encode(open(os.path.join(D,'longform',n),'rb').read()).decode()
logojs=open(os.path.join(D,'logo.js')).read()
h=f"""<!doctype html><meta charset=utf-8><style>
@font-face{{font-family:Q;src:url(data:font/ttf;base64,{f64('Quicksand.ttf')});font-weight:300 700}}
@font-face{{font-family:P;src:url(data:font/ttf;base64,{f64('Poppins-Bold.ttf')});font-weight:700}}
html,body{{margin:0;width:1080px;height:1350px;overflow:hidden}}
body{{background:linear-gradient(160deg,#1B1640 0%,#3B2A9A 45%,#5B3FD6 70%,#C93F95 100%);position:relative;font-family:P,sans-serif}}
.o{{position:absolute;border-radius:50%;background:rgba(255,255,255,.06)}}
#lg{{position:absolute;top:64px;left:0;right:0;text-align:center}}#lg img{{height:104px}}
#c{{position:absolute;left:80px;right:80px;top:250px;bottom:230px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;color:#fff}}
.l{{display:inline-block;background:#FFB020;color:#1B1640;font-weight:700;border-radius:999px;padding:14px 34px;font-size:30px;letter-spacing:4px}}
.em{{font-size:150px;line-height:1;margin:44px 0 36px}}
.t{{font-weight:700;font-size:{fs}px;line-height:1.14;letter-spacing:-.5px;text-wrap:balance;text-shadow:0 4px 18px rgba(0,0,0,.28)}}
#f{{position:absolute;bottom:72px;left:0;right:0;text-align:center}}
#f span{{background:#fff;color:#5B3FD6;font-family:Q;font-weight:700;font-size:40px;border-radius:999px;padding:14px 40px}}
</style><body><div class=o style="width:460px;height:460px;left:-170px;top:300px"></div><div class=o style="width:340px;height:340px;right:-120px;bottom:240px"></div>
<div id=lg><img id=li></div><div id=c><div class=l>{e(label)}</div><div class=em>{emoji}</div><div class=t>{t}</div></div><div id=f><span>moneyviel.com</span></div>
<script>{logojs}
(async()=>{{await document.fonts.load('700 104px Q');await document.fonts.load('700 80px P');const r=await mvDrawLogo('Q',true);document.getElementById('li').src=r.logo.toDataURL();window.done=1;}})();</script></body>"""
with sync_playwright() as p:
    b=p.chromium.launch();pg=b.new_page(viewport={'width':1080,'height':1350});pg.set_content(h)
    pg.wait_for_function('window.done===1');pg.wait_for_timeout(400)
    pg.screenshot(path=out,type='jpeg',quality=92);b.close()
