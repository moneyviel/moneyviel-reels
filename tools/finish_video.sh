#!/usr/bin/env bash
# usage: finish_video.sh <recording.webm> <events.json> <out.mp4> <seed>
set -e
D="$(cd "$(dirname "$0")" && pwd)"
dur=$(ffprobe -v error -show_entries format=duration -of csv=p=0 "$1")
python3 "$D/make_audio.py" "$2" "$dur" /tmp/_aud_$$.wav "$4" >/dev/null
ffmpeg -y -loglevel error -i "$1" -i /tmp/_aud_$$.wav -map 0:v -map 1:a -vf "fps=30,format=yuv420p" -c:v libx264 -preset veryfast -crf 21 -af "loudnorm=I=-14:TP=-1.5:LRA=11" -c:a aac -b:a 192k -ar 44100 -shortest -movflags +faststart "$3"
rm -f /tmp/_aud_$$.wav
