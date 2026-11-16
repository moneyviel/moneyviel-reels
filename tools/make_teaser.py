"""Cut a 20-30 s vertical teaser Short (1080x1920) from a MoneyViel long-form video.
usage: python3 make_teaser.py <batch.json> <longform-slug> <out.mp4>
Teaser plan lives in batch.json -> teasers[slug] = {segs:[[start,end,speed,top,bottom]], end:[line1,line2], end_src}
Layout: blurred background, the 16:9 video in the middle, big caption on top, small note below, then a 3 s end card.
"""
import json, sys, subprocess, os, tempfile
from playwright.sync_api import sync_playwright

batch, slug, out = sys.argv[1], sys.argv[2], sys.argv[3]
plan = json.load(open(batch))["teasers"][slug]
root = os.path.dirname(os.path.abspath(__file__))
src = os.path.join(root, "..", "longform", slug + ".mp4")
tmp = tempfile.mkdtemp(prefix="teaser_")
logo_js = open(os.path.join(root, "logo.js")).read()
FONT = ""  # Inter is installed locally; no web fonts (no logo drawn here, so Quicksand is not needed)
esc = lambda s: s.replace("&", "&amp;").replace("<", "&lt;")

def overlay_html(top, bottom):
    return f"""<!doctype html><meta charset=utf-8>{FONT}<style>
html,body{{margin:0;width:1080px;height:1920px;background:transparent;font-family:Inter,sans-serif}}
#top{{position:absolute;left:60px;right:60px;top:230px;height:400px;display:flex;align-items:center;justify-content:center;text-align:center}}
#top div{{color:#fff;font-weight:900;font-size:76px;line-height:1.15;text-shadow:0 4px 24px rgba(0,0,0,.6)}}
#pill{{position:absolute;top:120px;left:0;right:0;text-align:center}}
#pill span{{background:#FFB020;color:#1B1640;font-weight:900;font-size:34px;border-radius:999px;padding:10px 28px;letter-spacing:2px}}
#bot{{position:absolute;left:60px;right:60px;top:1330px;text-align:center;color:#fff;font-weight:700;font-size:40px;line-height:1.3;opacity:.95;text-shadow:0 3px 14px rgba(0,0,0,.6)}}
#brand{{position:absolute;bottom:250px;left:0;right:0;text-align:center}}
#brand span{{background:#fff;color:#E0408F;font-weight:900;font-size:44px;border-radius:999px;padding:14px 36px}}
</style><body><div id=pill><span>MONEYVIEL</span></div><div id=top><div>{esc(top)}</div></div><div id=bot>{esc(bottom)}</div><div id=brand><span>moneyviel.com</span></div></body>"""

def end_html(l1, l2):
    return f"""<!doctype html><meta charset=utf-8>{FONT}<style>
html,body{{margin:0;width:1080px;height:1920px;font-family:Inter,sans-serif;background:linear-gradient(160deg,#1B1640,#5B3FD6 60%,#E0408F)}}
#logo{{position:absolute;top:420px;left:0;right:0;text-align:center}}#logo span{{background:#fff;color:#E0408F;font-weight:900;font-size:64px;border-radius:999px;padding:18px 48px}}
#l1{{position:absolute;top:760px;left:80px;right:80px;text-align:center;color:#fff;font-weight:900;font-size:78px;line-height:1.15}}
#l2{{position:absolute;top:1180px;left:80px;right:80px;text-align:center;color:#FFB020;font-weight:900;font-size:52px;line-height:1.25}}
#ed{{position:absolute;bottom:200px;left:0;right:0;text-align:center;color:#fff;opacity:.8;font-weight:700;font-size:30px}}
</style><body><div id=logo><span>moneyviel.com</span></div><div id=l1>{esc(l1)}</div><div id=l2>{esc(l2)}</div><div id=ed>Education only, not financial advice.</div></body>"""

with sync_playwright() as p:
    b = p.chromium.launch(); pg = b.new_page(viewport={"width": 1080, "height": 1920})
    for i, (s, e, sp, top, bot) in enumerate(plan["segs"]):
        pg.set_content(overlay_html(top, bot)); pg.wait_for_timeout(300)
        pg.screenshot(path=f"{tmp}/ov{i}.png", omit_background=True)
    pg.set_content(end_html(*plan["end"])); pg.wait_for_timeout(500)
    pg.wait_for_timeout(300); pg.screenshot(path=f"{tmp}/end.png"); b.close()

parts = []
for i, (s, e, sp, top, bot) in enumerate(plan["segs"]):
    o = f"{tmp}/seg{i}.mp4"; parts.append(o)
    vf = (f"[0:v]setpts=PTS/{sp},fps=30,split[a][b];[a]scale=1080:1920:force_original_aspect_ratio=increase,crop=1080:1920,boxblur=30:5,eq=brightness=-0.28[bg];"
          f"[b]scale=1080:-2[fg];[bg][fg]overlay=0:(H-h)/2[v1];[v1][1:v]overlay=0:0,format=yuv420p,setsar=1[v]")
    af = f"[0:a]atempo={sp},aresample=44100[a]" if sp != 1 else "[0:a]aresample=44100[a]"
    subprocess.run(["ffmpeg", "-y", "-loglevel", "error", "-ss", str(s), "-t", str(e - s), "-i", src, "-i", f"{tmp}/ov{i}.png",
                    "-filter_complex", vf + ";" + af, "-map", "[v]", "-map", "[a]", "-c:v", "libx264", "-preset", "veryfast", "-crf", "20",
                    "-c:a", "aac", "-ar", "44100", "-ac", "2", f"{o}"], check=True)
o = f"{tmp}/end.mp4"; parts.append(o)
subprocess.run(["ffmpeg", "-y", "-loglevel", "error", "-loop", "1", "-t", "3", "-i", f"{tmp}/end.png", "-ss", str(plan["end_src"]), "-t", "3", "-i", src,
                "-filter_complex", "[0:v]fps=30,format=yuv420p,setsar=1[v];[1:a]aresample=44100,afade=t=out:st=2.2:d=0.8[a]", "-map", "[v]", "-map", "[a]",
                "-c:v", "libx264", "-preset", "veryfast", "-crf", "20", "-c:a", "aac", "-ar", "44100", "-ac", "2", "-shortest", o], check=True)
n = len(parts)
fc = "".join(f"[{i}:v][{i}:a]" for i in range(n)) + f"concat=n={n}:v=1:a=1[v][a0];[a0]loudnorm=I=-14:TP=-1.5:LRA=11[a]"
cmd = ["ffmpeg", "-y", "-loglevel", "error"] + sum([["-i", x] for x in parts], []) + ["-filter_complex", fc, "-map", "[v]", "-map", "[a]",
       "-c:v", "libx264", "-preset", "veryfast", "-crf", "21", "-c:a", "aac", "-b:a", "192k", "-ar", "44100", "-movflags", "+faststart", out]
subprocess.run(cmd, check=True)
print(out)
