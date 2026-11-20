import json,html
CSS="""<style>.mvw{--ink:#1B1640;--vi:#6C4CF1;--soft:#F4F1FF;color:var(--ink);font-size:17px;line-height:1.65}
.mvw .hero{background:linear-gradient(135deg,#1B1640,#5B3FD6);color:#fff;border-radius:22px;padding:26px 26px 22px;margin:0 0 22px}
.mvw .hero h2{color:#fff;margin:0 0 6px;font-size:28px}.mvw .hero p{margin:0;opacity:.92}
.mvw .flag{display:inline-grid;place-items:center;min-width:54px;height:38px;padding:0 10px;border-radius:12px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.35);font-weight:800;font-size:18px;letter-spacing:1px;margin-bottom:10px}
.mvw .cc{display:inline-grid;place-items:center;min-width:46px;height:32px;padding:0 8px;border-radius:10px;background:linear-gradient(135deg,#6C4CF1,#E0569B);color:#fff;font-weight:800;font-size:15px;letter-spacing:1px;margin-bottom:8px}
.mvw h3{margin:28px 0 10px;font-size:22px}
.mvw .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px}
.mvw .card{background:#fff;border:1px solid #E6E0FF;border-radius:18px;padding:16px 18px;box-shadow:0 6px 18px rgba(27,22,64,.06)}
.mvw .card b{display:block;font-size:17px;margin-bottom:4px}
.mvw .card small{display:block;margin-top:8px;font-size:13.5px;color:#5D5590}
.mvw a.c,.mvw a.c *{color:var(--ink)!important}.mvw a.c small{color:#6C4CF1!important;font-weight:700}.mvw a.c{display:block;text-decoration:none;transition:transform .15s}.mvw a.c:hover{transform:translateY(-3px);border-color:var(--vi)}
.mvw .steps{counter-reset:s;list-style:none;padding:0;margin:0}.mvw .steps li{counter-increment:s;position:relative;padding:10px 12px 10px 52px;margin:0 0 10px;background:var(--soft);border-radius:14px}
.mvw .steps li:before{content:counter(s);position:absolute;left:12px;top:9px;width:28px;height:28px;border-radius:50%;background:var(--vi);color:#fff;font-weight:700;display:grid;place-items:center;font-size:15px}
.mvw .note{margin-top:26px;padding:14px 16px;border-radius:14px;background:#FFF8E6;border:1px solid #F6E2A8;font-size:14.5px}
.mvw .tools a{display:inline-block;margin:4px 6px 4px 0;padding:7px 14px;border-radius:999px;background:var(--soft);border:1px solid #E2DBFF;text-decoration:none;font-weight:600;font-size:15px}
</style>"""
TOOLS='<div class="tools"><a href="/money-tools/">🧰 All money tools</a><a href="/money-tools/debt-free-grand-prix/">🏁 Debt-Free Grand Prix</a><a href="/money-tools/minimum-due-calculator/">💳 Minimum Due Trap</a><a href="/start-here/">🧭 Start Here</a></div>'
SAME="""<h3>🌍 What works the same everywhere</h3><div class="grid">
<div class="card"><b>🛟 A safety cushion first</b>Keep a few months of essential costs in a safe, easy-to-reach account before you take any risks.</div>
<div class="card"><b>💳 Minimum payments keep you in debt</b>Paying only the minimum on a credit card can stretch a small bill over many years. Our race shows how.</div>
<div class="card"><b>📈 Time beats timing</b>Small amounts invested regularly for many years usually matter more than picking the perfect moment.</div>
<div class="card"><b>🚩 If it sounds too good, walk away</b>Guaranteed high returns, pressure to decide today and "keep this secret" are classic signs of a scam.</div></div>
<p style="margin-top:14px">Every MoneyViel tool works in any currency: use the 💱 currency switch above each tool.</p>"""+TOOLS
def card(t,body,src_name,src):
    return f'<div class="card"><b>{t}</b>{body}<small>Check current rules: <a href="{src}" target="_blank" rel="noopener">{src_name}</a></small></div>'
def page(flag,title,intro,cards,steps,extra=''):
    h=f'<div class="mvw">{CSS}<div class="hero"><div class="flag">{flag}</div><h2>{title}</h2><p>{intro}</p></div>'
    h+='<h3>📌 Local things worth knowing</h3><div class="grid">'+''.join(card(*c) for c in cards)+'</div>'
    h+='<h3>✅ Your next three steps</h3><ol class="steps">'+''.join(f'<li>{s}</li>' for s in steps)+'</ol>'
    h+=SAME+extra
    h+='<div class="note">📚 <b>Education only, not financial, tax or legal advice.</b> Rules, limits and rates change, so always check the official website linked on each card before you act. Last reviewed: November 2026. <a href="/money-around-the-world/">← All countries</a></div></div>'
    return h
P={}
P['india']=page('IN','Money basics in India','The Indian rules and accounts most families meet, in plain words. Most MoneyViel examples already use India, so you are in the right place.',[
 ('🧾 Income tax and your PAN','Salaried people usually have tax deducted at source (TDS). You file your return yourself on the official portal, and choose between the old and new tax regimes.','incometax.gov.in','https://www.incometax.gov.in/'),
 ('🏦 EPF for salaried workers','If your employer is covered, part of your salary goes into the Employees\' Provident Fund each month, with a matching employer share. You can track it with your UAN.','epfindia.gov.in','https://www.epfindia.gov.in/'),
 ('🏛️ PPF and NPS','The Public Provident Fund is a long-term, government-backed savings scheme. The National Pension System is a retirement account invested in the markets.','npstrust.org.in','https://npstrust.org.in/'),
 ('🛡️ Bank deposits are insured up to a limit','Deposit insurance (DICGC) protects each depositor at each bank up to a set amount, so very large savings may be safer split across banks.','dicgc.org.in','https://www.dicgc.org.in/'),
 ('📊 Your credit score','Lenders check your credit report before giving loans and cards. You are entitled to a free copy from each credit bureau once a year.','rbi.org.in','https://www.rbi.org.in/'),
 ('🚨 Check before you invest','Use SEBI to check whether an adviser or broker is registered, and RBI\'s Sachet portal to report deposit schemes that look suspicious.','sachet.rbi.org.in','https://sachet.rbi.org.in/')],
 ['Build an emergency fund of a few months of essential costs in a savings account or sweep FD.','List every loan and card with its interest rate, and clear the most expensive one first.','Check your EPF passbook and credit report once a year so nothing surprises you.'])
P['uae']=page('AE','Money basics in the UAE','For families living and working in the UAE, including the many expats who send money home.',[
 ('💼 No personal income tax','The UAE does not tax individuals\' salaries. VAT applies to most things you buy, and you may still owe tax in your home country, depending on its rules.','u.ae','https://u.ae/en/information-and-services/finance-and-investment/taxation'),
 ('🎁 End-of-service gratuity','Private-sector expats usually earn a gratuity after one year of continuous service, based on basic salary (not allowances). Some employers use the newer voluntary savings scheme instead.','u.ae: end-of-service benefits','https://u.ae/en/information-and-services/jobs/Sector-of-employment/employment-in-the-private-sector/end-of-service-benefits-for-employees-in-the-private-sector'),
 ('🧓 Plan your own retirement','Most expats have no state pension in the UAE, so your gratuity and your own savings are your retirement. Start early, even with small amounts.','MoHRE','https://www.mohre.gov.ae/'),
 ('📊 Your credit score','Banks check your Al Etihad Credit Bureau (AECB) score before loans and cards. Late payments and bounced cheques can hurt it.','aecb.gov.ae','https://aecb.gov.ae/'),
 ('🏠 Rent, school fees and bonuses','Big yearly bills like rent cheques and school fees are easier when you save for them every month instead of borrowing.','u.ae','https://u.ae/'),
 ('🚨 Use licensed providers only','Before investing or sending money home, check that the bank, broker or exchange house is licensed by the UAE Central Bank or the right regulator.','centralbank.ae','https://www.centralbank.ae/')],
 ['Keep at least three to six months of costs in cash, more if your visa depends on your job.','Know your basic salary and how much gratuity you have built up, and keep a copy of your contract.','Pay credit cards in full each month: card interest in the UAE can be very high.'])
P['uk']=page('UK','Money basics in the UK','The UK accounts, protections and free help that most households can use.',[
 ('🧾 ISAs: tax-free saving','Individual Savings Accounts let you save or invest up to a yearly allowance with no tax on the interest or growth. The allowance does not roll over.','GOV.UK: ISAs','https://www.gov.uk/individual-savings-accounts'),
 ('🏦 Workplace pensions','Most employees are automatically enrolled in a workplace pension, with money added by you, your employer and tax relief. Opting out means losing your employer\'s share.','GOV.UK: workplace pensions','https://www.gov.uk/workplace-pensions'),
 ('🛡️ Savings protection','The Financial Services Compensation Scheme (FSCS) protects deposits at authorised banks up to a limit per person, per banking licence.','fscs.org.uk','https://www.fscs.org.uk/'),
 ('🧓 State Pension','Your State Pension depends on your National Insurance record. You can check your forecast and any gaps online.','GOV.UK: State Pension forecast','https://www.gov.uk/check-state-pension'),
 ('🤝 Free, impartial help','MoneyHelper is a free, government-backed service for money and pension guidance, including free debt advice.','moneyhelper.org.uk','https://www.moneyhelper.org.uk/'),
 ('🚨 Check before you invest','Use the FCA register to check that a firm is authorised, and its warning list to spot scams.','FCA register','https://register.fca.org.uk/')],
 ['Build an emergency fund in an easy-access savings account or cash ISA.','Stay in your workplace pension and check you are getting the full employer contribution.','If debts feel heavy, get free advice through MoneyHelper before borrowing more.'])
P['usa']=page('US','Money basics in the USA','The American accounts, protections and free resources most families meet.',[
 ('🏦 401(k) and IRAs','A 401(k) is a workplace retirement plan; many employers add a match. An IRA is a retirement account you open yourself. Both have yearly contribution limits.','IRS: retirement plans','https://www.irs.gov/retirement-plans'),
 ('🎯 Don\'t miss the employer match','If your employer matches contributions, saving at least enough to get the full match is like a pay rise you would otherwise leave behind.','IRS: 401(k) plans','https://www.irs.gov/retirement-plans/401k-plans'),
 ('🛡️ Bank deposits are insured','The FDIC insures deposits at member banks up to a limit per depositor, per bank, per ownership category. Credit unions have similar cover through the NCUA.','fdic.gov','https://www.fdic.gov/'),
 ('📊 Free credit reports','You can get your credit reports from the three bureaus for free at the official site. Check them for mistakes before big loans.','annualcreditreport.com','https://www.annualcreditreport.com/'),
 ('💳 Struggling with card payments?','If you cannot pay, call your card company early. Many can change your payment plan, and nonprofit credit counseling can help.','consumerfinance.gov','https://www.consumerfinance.gov/consumer-tools/credit-cards/'),
 ('🚨 Check before you invest','Use FINRA BrokerCheck to look up brokers and advisers before you hand over money.','brokercheck.finra.org','https://brokercheck.finra.org/')],
 ['Build an emergency fund of three to six months of essential costs in an insured savings account.','Pay more than the minimum on credit cards, starting with the highest interest rate.','Save at least enough in your 401(k) to get the full employer match, if you have one.'])
cards=[('IN','India','india','EPF, PPF, NPS, deposit insurance and credit scores.'),('AE','UAE','uae','No income tax, gratuity, AECB score and expat retirement.'),('UK','United Kingdom','uk','ISAs, workplace pensions, FSCS and free MoneyHelper advice.'),('US','United States','usa','401(k), IRAs, FDIC, free credit reports and card help.')]
hub=f'<div class="mvw">{CSS}<div class="hero"><div class="flag">🌍</div><h2>Money made simple, wherever you live</h2><p>Good money habits are the same in every country. The accounts, taxes and safety nets are not. Pick your country for the local basics, with links to the official sources.</p></div><h3>🗺️ Choose your country</h3><div class="grid">'
hub+=''.join(f'<a class="card c" href="/money-around-the-world/{s}/"><span class="cc">{f}</span><b>{n}</b>{d}<small>Read the guide →</small></a>' for f,n,s,d in cards)
hub+='</div><p style="margin-top:14px">Don\'t see your country yet? The tools and the ideas below work everywhere, and more countries are coming.</p>'+SAME
hub+='<div class="note">📚 <b>Education only, not financial, tax or legal advice.</b> Each country guide links to official sources for current rules and limits. Last reviewed: November 2026.</div></div>'
P['hub']=hub
for k,v in P.items(): open(k+'.html','w').write(v)
print({k:len(v) for k,v in P.items()})
