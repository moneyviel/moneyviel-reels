"""Featured image card 1080x1350. usage: python3 make_card.py out.jpg "LABEL" "emoji" "Title" """
import sys
from playwright.sync_api import sync_playwright
out,label,emoji,title=sys.argv[1:5]
e=lambda s:s.replace('&','&amp;').replace('<','&lt;')
h=f"""<!doctype html><meta charset=utf-8><style>html,body{{margin:0;width:1080px;height:1350px;font-family:Inter,sans-serif;overflow:hidden}}
body{{background:linear-gradient(160deg,#1B1640,#5B3FD6 60%,#E0408F);position:relative}}
.o{{position:absolute;border-radius:50%;background:rgba(255,255,255,.08)}}
#b{{position:absolute;top:70px;left:0;right:0;text-align:center;color:#fff;font-weight:900;font-size:46px}}
#c{{position:absolute;left:80px;right:80px;top:50%;transform:translateY(-50%);text-align:center;color:#fff}}
.l{{display:inline-block;background:#FFB020;color:#1B1640;font-weight:900;border-radius:999px;padding:12px 30px;font-size:32px;letter-spacing:3px}}
.em{{font-size:170px;margin:40px 0 20px}}.t{{font-weight:900;font-size:76px;line-height:1.15;text-shadow:0 4px 20px rgba(0,0,0,.3)}}
#f{{position:absolute;bottom:70px;left:0;right:0;text-align:center}}#f span{{background:#fff;color:#E0408F;font-weight:900;font-size:40px;border-radius:999px;padding:12px 34px}}
</style><body><div class=o style="width:420px;height:420px;left:-140px;top:160px"></div><div class=o style="width:320px;height:320px;right:-100px;bottom:200px"></div>
<div id=b>moneyviel</div><div id=c><div class=l>{e(label)}</div><div class=em>{emoji}</div><div class=t>{e(title)}</div></div><div id=f><span>moneyviel.com</span></div></body>"""
with sync_playwright() as p:
    b=p.chromium.launch();pg=b.new_page(viewport={'width':1080,'height':1350});pg.set_content(h);pg.wait_for_timeout(300)
    pg.screenshot(path=out,type='jpeg',quality=90);b.close()
