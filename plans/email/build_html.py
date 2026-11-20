import re,html,json
src=open('seven-day-money-reset.md').read()
foot=re.search(r'Footer on every email \(small print\): (.*)',src).group(1).strip()
chs=re.split(r'\n## Chapter (\d) \(([^)]*)\)\n',src)[1:]
out={}
def inline(t):
    t=html.escape(t,quote=False)
    t=re.sub(r'\*\*(.+?)\*\*',r'<strong>\1</strong>',t)
    t=re.sub(r'(?<![">])(https://moneyviel\.com/[\w\-/]*)',r'<a href="\1" style="color:#5B3FD6;font-weight:700">\1</a>',t)
    return t
for i in range(0,len(chs),3):
    n,when,body=chs[i],chs[i+1],chs[i+2]
    body=body.split('\n---')[0].strip()
    subj=re.search(r'^Subject: (.*)$',body,re.M).group(1);prev=re.search(r'^Preview: (.*)$',body,re.M).group(1)
    body=re.sub(r'^(Subject|Preview): .*\n','',body,flags=re.M).strip()
    body=body.replace('Hi {{FirstName | there}},','Hi there,')
    label={'needs-vs-wants':'Play Needs vs Wants','money-health-report':'Take the free check-up','debt-free-grand-prix':'Start the race','debt-payoff-planner':'Build my debt plan','emergency-fund-calculator':'Find my safety-net target','goal-planner':'Plan my goals'}
    h=[];lst=None;para=[]
    for raw in body.split('\n'):
        l=raw.rstrip()
        kind=None
        if l.startswith('- '): kind='ul'
        elif re.match(r'\d+\. ',l): kind='ol'
        if kind:
            if para: h.append('<p style="margin:0 0 8px">'+'<br>'.join(inline(x) for x in para)+'</p>'); para.clear()
            if lst!=kind:
                if lst: h.append(f'</{lst}>')
                h.append(f'<{kind} style="margin:0 0 16px;padding-left:22px">'); lst=kind
            h.append(f'<li style="margin:0 0 6px">{inline(re.sub(r"^(- |\d+\. )","",l))}</li>'); continue
        if lst: h.append(f'</{lst}>'); lst=None
        if not l.strip():
            if para: h.append('<p style="margin:0 0 16px">'+'<br>'.join(inline(x) for x in para)+'</p>'); para.clear()
            continue
        m=re.match(r'^(\S{1,3})\s+(https://moneyviel\.com/[\w\-/]*)$',l)
        if m:
            if para: h.append('<p style="margin:0 0 8px">'+'<br>'.join(inline(x) for x in para)+'</p>'); para.clear()
            slug=m.group(2).rstrip('/').split('/')[-1]
            h.append(f'<p style="margin:6px 0 18px"><a href="{m.group(2)}" style="display:inline-block;background:#5B3FD6;color:#ffffff;text-decoration:none;font-weight:700;padding:12px 22px;border-radius:999px">{html.escape(m.group(1))} {label.get(slug,"Open")} &rarr;</a></p>'); continue
        if re.fullmatch(r'\*\*Chapter .+\*\*',l):
            h.append(f'<h2 style="margin:4px 0 14px;font-size:22px;line-height:1.3;color:#1B1640">{inline(l[2:-2])}</h2>'); continue
        if l in ('**Your turn**','**Your turn: the final step**','**Keep the habit going**'):
            if para: h.append('<p style="margin:0 0 16px">'+'<br>'.join(inline(x) for x in para)+'</p>'); para.clear()
            h.append(f'<div style="margin:22px 0 8px;padding:8px 14px;background:#FFF6DD;border-left:4px solid #FFB020;border-radius:8px;font-weight:800;color:#1B1640">{inline(l[2:-2])}</div>'); continue
        para.append(l)
    if lst: h.append(f'</{lst}>')
    if para: h.append('<p style="margin:0 0 16px">'+'<br>'.join(inline(x) for x in para)+'</p>')
    doc=f'''<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>{html.escape(subj)}</title></head>
<body style="margin:0;padding:0;background:#F3EFFF">
<div style="display:none;max-height:0;overflow:hidden">{html.escape(prev)}</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F3EFFF"><tr><td align="center" style="padding:20px 10px">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:18px;overflow:hidden">
<tr><td style="background:#1B1640;background-image:linear-gradient(135deg,#1B1640,#5B3FD6);padding:22px 28px">
<div style="font-family:Arial,Helvetica,sans-serif;font-size:24px;font-weight:800;color:#ffffff;letter-spacing:.3px">money<span style="color:#FFB020">viel</span></div>
<div style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#D9D2FF;margin-top:4px;letter-spacing:1.5px">THE 7-DAY MONEY RESET · CHAPTER {n} OF 7</div></td></tr>
<tr><td style="padding:28px 28px 8px;font-family:Arial,Helvetica,sans-serif;font-size:16px;line-height:1.6;color:#2A2350">
{''.join(h)}
</td></tr>
<tr><td style="padding:16px 28px 26px;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:1.5;color:#6B6488;border-top:1px solid #EEE9FF">
<p style="margin:0 0 10px">{html.escape(foot)}</p>
<p style="margin:0 0 10px">You're receiving this because you joined MoneyViel Money Tips at moneyviel.com. <a href="{{{{UnsubscribeURL}}}}" style="color:#5B3FD6">Unsubscribe</a></p>
<p style="margin:0 0 8px">{{{{SenderInfoLine}}}}</p>
<p style="margin:0"><a href="{{{{RewardsURL}}}}" style="color:#9A93BF">Powered by EmailOctopus</a></p>
</td></tr></table></td></tr></table></body></html>'''
    open(f'html/ch{n}.html','w').write(doc)
    out[n]={'subject':subj,'preview':prev,'when':when}
json.dump(out,open('html/meta.json','w'),ensure_ascii=False,indent=1)
print(json.dumps(out,ensure_ascii=False,indent=1))
