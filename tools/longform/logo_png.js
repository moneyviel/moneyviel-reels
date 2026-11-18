const { chromium } = require('playwright');const fs=require('fs');
(async()=>{fs.writeFileSync(__dirname+'/_logo.html',`<style>@font-face{font-family:Q;src:url(Quicksand.ttf)}</style><div style="font-family:Q">x</div><script src="../logo.js"></script>`);
const b=await chromium.launch();const p=await b.newPage();await p.goto('file://'+__dirname+'/_logo.html');
const d=await p.evaluate(async()=>{await document.fonts.load('700 50px Q');const r=await mvDrawLogo('Q',true);return r.logo.toDataURL('image/png');});
fs.writeFileSync(__dirname+'/logo_light.png',Buffer.from(d.split(',')[1],'base64'));fs.unlinkSync(__dirname+'/_logo.html');await b.close();})();
