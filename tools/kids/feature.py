import sys
from PIL import Image,ImageDraw,ImageFont
title,n,out=sys.argv[1],sys.argv[2],sys.argv[3]
W,H=1200,675;bg=Image.new('RGB',(W,H));d=ImageDraw.Draw(bg)
for y in range(H):
    t=y/H;c=tuple(int(a+(b-a)*t) for a,b in zip((143,220,255),(255,225,239)));d.line([(0,y),(W,y)],fill=c)
for i in (1,2):
    im=Image.open(f'/tmp/feat{i}.jpg').resize((338,600));bg.paste(im,(500+(i-1)*360,38))
def F(s):
    f=ImageFont.truetype('/home/claude/moneyviel-reels/tools/kids/Fredoka.ttf',s)
    try: f.set_variation_by_name(b'Bold')
    except Exception: pass
    return f
words=title.split();lines=[];cur=''
for w_ in words:
    test=(cur+' '+w_).strip()
    if d.textlength(test,font=F(70))>440 and cur: lines.append(cur);cur=w_
    else: cur=test
lines.append(cur)
y=110
for i,l in enumerate(lines):
    d.text((40,y),l,font=F(70),fill=(59,31,143) if i==0 else (224,64,143));y+=84
d.text((44,y+20),"A money story for kids",font=F(38),fill=(43,29,58))
d.rounded_rectangle((40,y+90,300,y+160),radius=35,fill=(59,31,143));d.text((68,y+98),f"Episode {n}",font=F(42),fill='white')
bg.save(out,quality=88)
