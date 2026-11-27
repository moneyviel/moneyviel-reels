/**
 * MoneyViel – Snippet 19: interactive article format (Nov 2026)
 *
 * On grown-up posts (categories Articles 38 and Smart Money Habits 66; never kids posts):
 *  - reading progress bar
 *  - top card: "⚡ The 60-second version" (post meta mv_tldr, one point per line; falls back to the excerpt),
 *    read time, and a clickable "🗺️ Your path" flow made from the H2 headings
 *  - bottom: "✅ Try this today" box (meta mv_try) with an "I'll do it" button (saved in the reader's browser)
 *  - bottom: "🧠 2-question check" quiz (meta mv_quiz, JSON: [{"q":"","o":["","",""],"a":0,"why":""}, ...])
 * Meta fields are writable through the REST API ("meta" in POST /wp/v2/posts), so the autopilot fills them.
 */
add_action( 'init', function () {
	foreach ( array( 'mv_tldr', 'mv_try', 'mv_quiz' ) as $k ) {
		register_post_meta( 'post', $k, array(
			'type'          => 'string',
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		) );
	}
} );

function mvx_applies() {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return false;
	}
	$cats = wp_get_post_categories( get_the_ID() );
	return ! in_array( 67, $cats, true ) && ( in_array( 38, $cats, true ) || in_array( 66, $cats, true ) );
}

add_filter( 'the_content', function ( $content ) {
	if ( ! mvx_applies() ) {
		return $content;
	}
	$id   = get_the_ID();
	$tldr = trim( (string) get_post_meta( $id, 'mv_tldr', true ) );
	$try  = trim( (string) get_post_meta( $id, 'mv_try', true ) );
	$quiz = json_decode( (string) get_post_meta( $id, 'mv_quiz', true ), true );
	$words = str_word_count( wp_strip_all_tags( $content ) );
	$mins  = max( 1, (int) round( $words / 200 ) );

	// Give every H2 an id so the path chips can jump to it.
	$steps = array();
	$n     = 0;
	$content = preg_replace_callback( '#<h2([^>]*)>(.*?)</h2>#is', function ( $m ) use ( &$steps, &$n ) {
		$n++;
		$txt = trim( wp_strip_all_tags( $m[2] ) );
		if ( preg_match( '/id="([^"]+)"/', $m[1], $idm ) ) {
			$hid = $idm[1];
			$att = $m[1];
		} else {
			$hid = 'mvx-s' . $n;
			$att = $m[1] . ' id="' . $hid . '"';
		}
		$steps[] = array( $hid, $txt );
		return '<h2' . $att . '>' . $m[2] . '</h2>';
	}, $content );

	$css = '<style id="mvx-css">
.mvx-prog{position:fixed;left:0;top:0;height:4px;width:0;z-index:99999;background:linear-gradient(90deg,#5b3fd6,#e8457a);transition:width .1s}
.mvx-top{background:linear-gradient(135deg,#f3efff,#fff0f5);border:1px solid #ece6ff;border-radius:22px;padding:18px 18px 14px;margin:0 0 22px;font-size:16px;line-height:1.5}
.mvx-top .k{display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:0 0 8px}
.mvx-pill{display:inline-block;font-size:12px;font-weight:800;letter-spacing:.03em;text-transform:uppercase;padding:4px 10px;border-radius:999px;background:#5b3fd6;color:#fff}
.mvx-pill.l{background:#fff;color:#5b3fd6}
.mvx-top ul{margin:6px 0 0;padding:0;list-style:none}
.mvx-top li{display:flex;gap:10px;margin:7px 0;font-weight:600}
.mvx-top li:before{content:"✅";flex:none}
.mvx-path{display:flex;flex-wrap:wrap;align-items:center;gap:6px;margin:12px 0 0}
.mvx-path a{display:inline-flex;align-items:center;gap:6px;background:#fff;border:1.5px solid #ddd3ff;border-radius:999px;padding:6px 12px;font-size:13.5px;font-weight:700;color:#3b2a9e!important;text-decoration:none!important}
.mvx-path a b{display:inline-flex;width:20px;height:20px;border-radius:50%;background:#5b3fd6;color:#fff;font-size:11px;align-items:center;justify-content:center}
.mvx-path a:hover{background:#5b3fd6;color:#fff!important}
.mvx-path i{color:#b9adf0;font-style:normal;font-weight:800}
.mvx-try{display:flex;gap:14px;align-items:flex-start;background:#e9f9ee;border:2px dashed #34c26b;border-radius:22px;padding:18px;margin:26px 0}
.mvx-try .e{font-size:40px;line-height:1}
.mvx-try b.h{display:block;font-size:19px;margin-bottom:4px}
.mvx-btn{all:unset;cursor:pointer;display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:10px 18px;border-radius:999px;font-weight:800;background:#16a34a;color:#fff}
.mvx-btn.done{background:#fff;color:#16a34a;border:2px solid #16a34a}
.mvx-quiz{background:#fff;border:1px solid #ece6ff;border-radius:22px;padding:18px;margin:26px 0;box-shadow:0 6px 22px rgba(27,19,64,.07)}
.mvx-quiz .q{font-weight:800;font-size:17px;margin:14px 0 8px}
.mvx-quiz .o{all:unset;box-sizing:border-box;cursor:pointer;display:block;width:100%;padding:11px 14px;margin:6px 0;border-radius:14px;border:2px solid #ece7ff;font-weight:600}
.mvx-quiz .o:hover{border-color:#5b3fd6;background:#faf8ff}
.mvx-quiz .o.ok{border-color:#16a34a;background:#e9f9ee}
.mvx-quiz .o.no{border-color:#e8457a;background:#fff0f5}
.mvx-quiz .why{font-size:14.5px;background:#fff8e6;border-radius:12px;padding:8px 12px;margin:6px 0 0;display:none}
.mvx-score{font-weight:800;font-size:18px;margin-top:14px;display:none}
</style>';

	$top  = '<div class="mvx-prog" aria-hidden="true"></div><div class="mvx-top"><div class="k"><span class="mvx-pill">⚡ The 60-second version</span><span class="mvx-pill l">⏱️ ' . $mins . '-min read</span></div>';
	$pts  = array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\n|\|/', $tldr ) ) ) );
	if ( $pts ) {
		$top .= '<ul>';
		foreach ( array_slice( $pts, 0, 4 ) as $p ) {
			$top .= '<li>' . esc_html( $p ) . '</li>';
		}
		$top .= '</ul>';
	} elseif ( has_excerpt( $id ) ) {
		$top .= '<p style="margin:0;font-weight:600">' . esc_html( wp_strip_all_tags( get_the_excerpt( $id ) ) ) . '</p>';
	}
	if ( count( $steps ) >= 2 ) {
		$top .= '<div class="mvx-path" aria-label="Sections in this article"><span style="font-size:13px;font-weight:800;color:#5b4fa0">🗺️ Your path:</span>';
		foreach ( $steps as $i => $s ) {
			$top .= ( $i ? '<i>→</i>' : '' ) . '<a href="#' . esc_attr( $s[0] ) . '"><b>' . ( $i + 1 ) . '</b>' . esc_html( mb_strimwidth( $s[1], 0, 42, '…' ) ) . '</a>';
		}
		$top .= '</div>';
	}
	$top .= '</div>';

	$bottom = '';
	if ( $try ) {
		$bottom .= '<div class="mvx-try" data-id="' . (int) $id . '"><div class="e">🎯</div><div><b class="h">Try this today</b><div>' . esc_html( $try ) . '</div><button type="button" class="mvx-btn">✋ I\'ll do it today</button></div></div>';
	}
	if ( is_array( $quiz ) && count( $quiz ) ) {
		$bottom .= '<div class="mvx-quiz" data-id="' . (int) $id . '"><span class="mvx-pill">🧠 Quick check: ' . count( $quiz ) . ' question' . ( count( $quiz ) > 1 ? 's' : '' ) . '</span>';
		foreach ( array_slice( $quiz, 0, 3 ) as $qi => $q ) {
			if ( empty( $q['q'] ) || empty( $q['o'] ) || ! isset( $q['a'] ) ) {
				continue;
			}
			$bottom .= '<div class="qq" data-a="' . (int) $q['a'] . '"><div class="q">' . ( $qi + 1 ) . '. ' . esc_html( $q['q'] ) . '</div>';
			foreach ( array_slice( (array) $q['o'], 0, 4 ) as $oi => $o ) {
				$bottom .= '<button type="button" class="o" data-i="' . (int) $oi . '">' . esc_html( $o ) . '</button>';
			}
			$bottom .= '<div class="why">💡 ' . esc_html( (string) ( $q['why'] ?? '' ) ) . '</div></div>';
		}
		$bottom .= '<div class="mvx-score"></div></div>';
	}

	$js = '<script>(function(){var p=document.querySelector(".mvx-prog"),art=document.querySelector(".mvx-top");if(p){var f=function(){var c=art?art.closest("article,.entry-content,main")||document.body:document.body,r=c.getBoundingClientRect(),h=r.height-innerHeight;p.style.width=Math.max(0,Math.min(100,(-r.top)/(h>0?h:1)*100))+"%"};addEventListener("scroll",f,{passive:true});f()}
function ls(k,v){try{if(v===undefined)return JSON.parse(localStorage.getItem(k)||"null");localStorage.setItem(k,JSON.stringify(v))}catch(e){return null}}
function conf(){if(window.MVP&&MVP.conf)return MVP.conf();var c=document.createElement("div");c.style.cssText="position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden";for(var i=0;i<50;i++){var s=document.createElement("i");s.style.cssText="position:absolute;top:-20px;left:"+Math.random()*100+"%;width:9px;height:13px;border-radius:3px;background:"+["#5b3fd6","#e8457a","#ffb800","#16a34a"][i%4]+";transition:transform 1.6s linear,opacity 1.6s";c.appendChild(s)}document.body.appendChild(c);requestAnimationFrame(function(){[].forEach.call(c.children,function(s){s.style.transform="translateY(110vh) rotate(540deg)"})});setTimeout(function(){c.remove()},1800)}
var t=document.querySelector(".mvx-try");if(t){var b=t.querySelector(".mvx-btn"),id=t.dataset.id,todo=ls("mvTodo")||{};var paint=function(){if(todo[id]){b.textContent="✅ On my list. You\'ve got this!";b.classList.add("done")}};paint();b.onclick=function(){if(todo[id])return;todo[id]=Date.now();ls("mvTodo",todo);paint();conf()}}
var qz=document.querySelector(".mvx-quiz");if(qz){var qs=qz.querySelectorAll(".qq"),got=0,ans=0;[].forEach.call(qs,function(q){var a=+q.dataset.a,done=false;[].forEach.call(q.querySelectorAll(".o"),function(o){o.onclick=function(){if(done)return;done=true;ans++;var i=+o.dataset.i;if(i===a){o.classList.add("ok");o.textContent="✅ "+o.textContent;got++}else{o.classList.add("no");q.querySelectorAll(".o")[a].classList.add("ok")}q.querySelector(".why").style.display="block";if(ans===qs.length){var s=qz.querySelector(".mvx-score");s.style.display="block";s.textContent=got===qs.length?"🏆 "+got+"/"+qs.length+" – perfect! You really got this.":"⭐ "+got+"/"+qs.length+" – nice! Every question makes your money brain stronger.";if(got===qs.length)conf()}}})})}})();</script>';

	return $css . $top . $content . $bottom . $js;
}, 20 );
