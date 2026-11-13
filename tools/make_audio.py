"""Original soft-pop soundtrack + synced game SFX for MoneyViel reels (v2: warmer, modern sound).
usage: python3 make_audio.py <events.json> <duration_sec> <out.wav> [seed]
"""
import sys, json, numpy as np
from scipy.io import wavfile
from scipy.signal import butter, sosfilt
SR = 44100
ev = json.load(open(sys.argv[1])); dur = float(sys.argv[2]); out = sys.argv[3]
seed = int(sys.argv[4]) if len(sys.argv) > 4 else 1
rng = np.random.default_rng(seed)
N = int(dur * SR)
L = np.zeros(N); R = np.zeros(N); FX = np.zeros(N)
OFFSET = 0.25

def midi(n): return 440 * 2 ** ((n - 69) / 12)
def lp(x, fc, order=2): return sosfilt(butter(order, fc, 'low', fs=SR, output='sos'), x)
def hp(x, fc, order=2): return sosfilt(butter(order, fc, 'high', fs=SR, output='sos'), x)
def adsr(n, a=.01, d=.1, s=.7, r=.2):
    e = np.full(n, s, float); ai, di, ri = int(a*SR), int(d*SR), int(r*SR)
    ai = min(ai, n); e[:ai] = np.linspace(0, 1, ai)
    dj = min(n, ai+di); e[ai:dj] = np.linspace(1, s, dj-ai)
    ri = min(ri, n); e[-ri:] *= np.linspace(1, 0, ri); return e
def put(buf, t, w, g=1.0):
    i = int(t*SR)
    if i < 0 or i >= len(buf): return
    j = min(len(buf), i+len(w)); buf[i:j] += w[:j-i]*g
def put2(t, w, g=1.0, pan=0.0):
    put(L, t, w, g*(1-pan)/1.0 if pan > 0 else g); put(R, t, w, g*(1+pan) if pan < 0 else g)

def pad(freqs, d):
    n = int(d*SR); t = np.arange(n)/SR; w = np.zeros(n)
    for f in freqs:
        for det in (-0.12, 0.0, 0.12):  # detuned saws = lush chorus
            ff = f*2**(det/12); w += 2*((t*ff + rng.random()) % 1) - 1
    w = lp(w/(len(freqs)*3), 1400)
    return w*adsr(n, a=.35, d=.3, s=.8, r=.5)
def pluck(f, d):  # Karplus-Strong plucked string
    n = int(d*SR); p = max(2, int(SR/f)); buf = rng.uniform(-1, 1, p); outw = np.zeros(n)
    for i in range(n):
        outw[i] = buf[i % p]; buf[i % p] = .5*(buf[i % p] + buf[(i+1) % p])*.996
    return lp(outw, 4000)*adsr(n, a=.002, d=.05, s=1, r=.08)
def bass(f, d):
    n = int(d*SR); t = np.arange(n)/SR
    w = np.sin(2*np.pi*f*t) + .3*np.sin(4*np.pi*f*t); w = np.tanh(w*1.3)
    return lp(w, 500)*adsr(n, a=.005, d=.15, s=.6, r=.08)
def kick():
    n = int(.35*SR); t = np.arange(n)/SR; f = 45 + 110*np.exp(-t*30)
    return np.sin(2*np.pi*np.cumsum(f)/SR)*np.exp(-t*9)
def clap():
    n = int(.2*SR); nz = rng.uniform(-1, 1, n); e = np.zeros(n)
    for o in (0, .01, .02): e[int(o*SR):] += np.exp(-np.arange(n-int(o*SR))/SR*40)
    return sosfilt(butter(2, [900, 3500], 'band', fs=SR, output='sos'), nz*e)*.8
def hat():
    n = int(.04*SR); return hp(rng.uniform(-1, 1, n), 7000)*np.exp(-np.arange(n)/SR*90)
def bell(f, d=.5):
    n = int(d*SR); t = np.arange(n)/SR
    w = np.sin(2*np.pi*f*t) + .4*np.sin(2*np.pi*f*2.76*t)*np.exp(-t*12) + .2*np.sin(2*np.pi*f*5.4*t)*np.exp(-t*20)
    return w*np.exp(-t*7)*adsr(n, a=.002, d=.01, s=1, r=.05)

# ---- arrangement ----
bpm = int(rng.choice([108, 112, 116])); beat = 60/bpm; bar = beat*4
key = int(rng.choice([57, 60, 62, 64]))
prog = [[0, 7, 9, 5], [0, 9, 5, 7], [9, 5, 0, 7]][int(rng.integers(3))]
arp = [[0, 1, 2, 3, 2, 1, 2, 3], [0, 2, 1, 3, 0, 2, 1, 3], [3, 2, 1, 0, 1, 2, 3, 2]][int(rng.integers(3))]
intro = 2.0; outro_t = ev['outro'] + OFFSET
pl = np.zeros(N)  # pluck bus for echo
t = 0.0; b = 0
while t < dur:
    deg = prog[b % 4]; root = key + deg; minor = deg == 9
    ch = [root, root+(3 if minor else 4), root+7, root+12]
    put2(t, pad([midi(n) for n in ch[:3]], bar*1.05), .22)
    for s in range(8):
        tt = t + s*beat/2
        if tt >= dur: break
        put(pl, tt, pluck(midi(ch[arp[s]]+12), beat*.6), .32 if tt > intro else .18)
    if t >= intro - .01:
        for s in range(4):
            tt = t + s*beat
            put2(tt, bass(midi(root-24), beat*.85), .42)
            put2(tt, kick(), .7)
            if s in (1, 3): put2(tt, clap(), .32)
            put2(tt+beat/2, hat(), .12, pan=.3); put2(tt+beat*.75, hat(), .06, pan=-.3)
    t += bar; b += 1
# stereo ping-pong echo on plucks (3/8 beat)
dl = int(beat*.75*SR); echoL = np.zeros(N); echoR = np.zeros(N)
echoL[dl:] = pl[:-dl]*.35; echoR[2*dl:] = pl[:-2*dl]*.22
L += pl + echoL; R += pl + echoR
# sidechain-style pump: duck music a little on each kick after intro
pump = np.ones(N)
k = intro
while k < dur:
    i = int(k*SR); n = int(beat*.5*SR); j = min(N, i+n); pump[i:j] = np.linspace(.65, 1, n)[:j-i]; k += beat
L *= pump; R *= pump
fade = int(1.0*SR); L[-fade:] *= np.linspace(1, 0, fade); R[-fade:] *= np.linspace(1, 0, fade)

# ---- SFX (soft, bell-like) ----
def good(tt): put(FX, tt, bell(1568, .35), .32); put(FX, tt+.07, bell(2093, .45), .30)
def bad(tt):
    n = int(.45*SR); x = np.arange(n)/SR; f = 330*np.exp(-x*3.0)
    w = np.sin(2*np.pi*np.cumsum(f)/SR) + .3*np.sin(4*np.pi*np.cumsum(f)/SR)
    put(FX, tt, lp(w, 1200)*np.exp(-x*5), .45)
def slide(tt): put(FX, tt, bell(midi(84), .5), .14); put(FX, tt+.05, bell(midi(91), .5), .08)
def level(tt):
    for i, n in enumerate([72, 76, 79, 84]): put(FX, tt+i*.09, bell(midi(n), .6), .28)
for tt, kind in ev['ev']:
    {'good': good, 'bad': bad, 'level': level, 'slide': slide}[kind](tt+OFFSET)
for i, n in enumerate([72, 76, 79, 84, 88]): put(FX, outro_t+i*.11, bell(midi(n), .9), .26)

L += FX; R += FX
st = np.stack([L, R], 1); st = st/np.max(np.abs(st))*.9
wavfile.write(out, SR, (st*32767).astype(np.int16))
print('ok', bpm, key, prog)
