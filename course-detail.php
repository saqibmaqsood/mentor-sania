<!DOCTYPE html>
<html>
<head>
<base href="/">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>x-dc{display:none!important}.sc-placeholder{display:none!important}</style>
<script src="/support.js"></script>
</head>
<body>
<x-dc>
<helmet>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<style>
  html { scroll-behavior: smooth; }
  html, body { overflow-x: clip; }
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <header data-screen-label="Course hero" style="padding:clamp(112px,12vw,156px) clamp(20px,5vw,64px) clamp(48px,6vw,80px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(400px,100%),1fr));gap:clamp(32px,4vw,72px);align-items:center">
      <div>
        <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center">
          <a href="/courses" style="font-size:13px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.45);text-decoration:none">Courses</a>
          <span style="color:rgba(30,27,23,0.3)">/</span>
          <span style="font-size:13px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#B5794A">{{ cat }}</span>
        </div>
        <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(36px,5.2vw,68px);line-height:1.03;letter-spacing:-0.025em;text-wrap:balance">{{ title }}</h1>
        <p style="margin:22px 0 0;max-width:540px;font-size:clamp(16.5px,1.2vw,18.5px);line-height:1.64;color:rgba(30,27,23,0.68);text-wrap:pretty">{{ lead }}</p>
        <div style="margin-top:26px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(150px,100%),1fr));gap:14px;max-width:560px">
          <div style="border:1px solid #E2D9C9;background:#FFFDFA;border-radius:12px;padding:13px 15px">
            <div style="font-size:10.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">Duration</div>
            <div style="margin-top:5px;font-size:17px;font-weight:700;letter-spacing:-0.01em">{{ days }}</div>
          </div>
          <div style="border:1px solid #E2D9C9;background:#FFFDFA;border-radius:12px;padding:13px 15px">
            <div style="font-size:10.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">Class time</div>
            <div style="margin-top:5px;font-size:17px;font-weight:700;letter-spacing:-0.01em">{{ time }}</div>
          </div>
          <div style="border:1px solid #E2D9C9;background:#FFFDFA;border-radius:12px;padding:13px 15px">
            <div style="font-size:10.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#4C7A5E">Live</div>
            <div style="margin-top:5px;font-size:17px;font-weight:700;letter-spacing:-0.01em">{{ live }}</div>
          </div>
        </div>
        <div style="margin-top:14px;font-size:14.5px;color:rgba(30,27,23,0.6)">{{ dur }}</div>
        <div style="margin-top:8px;font-size:14.5px;font-weight:600;color:#8A5A34">Taught by {{ teacher }} · {{ teacherRole }}</div>
        <div style="margin-top:30px;display:flex;flex-wrap:wrap;align-items:center;gap:14px 24px">
          <button type="button" onClick="{{ openEnrollModal }}" style="font-family:inherit;font-size:15px;font-weight:700;color:#FAF7F2;background:#B5794A;border:0;padding:16px 32px;border-radius:999px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">{{ enrolLabel }}</button>
          <span style="font-size:14.5px;color:rgba(30,27,23,0.55)">Live on Zoom · recordings included</span>
        </div>
      </div>
      <div style="position:relative">
        <div style="aspect-ratio:4/3;border-radius:16px;border:1px solid #E2D9C9;overflow:hidden;background:#EDE4D3;display:flex;align-items:center;justify-content:center;box-shadow:0 18px 50px rgba(30,27,23,0.09)">
          <img src="{{ img }}" alt="{{ title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
        </div>
      </div>
    </div>
  </header>

  <section data-screen-label="Outcomes" style="padding:clamp(48px,6vw,88px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <h2 data-reveal="" style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,42px);line-height:1.08;letter-spacing:-0.02em">By the end, you'll have.</h2>
      <div style="margin-top:clamp(28px,3.4vw,44px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(250px,100%),1fr));gap:22px">
        <sc-for list="{{ outcomes }}" as="o" hint-placeholder-count="4">
          <div data-reveal="" style="border-top:1px solid #D9CDB6;padding-top:18px">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#B5794A">{{ o.n }}</span>
            <div style="margin-top:10px;font-size:16.5px;line-height:1.6;color:rgba(30,27,23,0.74);text-wrap:pretty">{{ o.text }}</div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <section data-screen-label="Curriculum" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(360px,100%),1fr));gap:clamp(32px,4vw,64px);align-items:start">
      <div>
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Curriculum</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em">{{ modulesHeading }}</h2>
        <div style="margin-top:clamp(26px,3vw,38px);display:flex;flex-direction:column">
          <sc-for list="{{ modules }}" as="m" hint-placeholder-count="5">
            <div data-reveal="" style="border-top:1px solid #E2D9C9">
              <button type="button" onClick="{{ m.toggle }}" style="width:100%;display:grid;grid-template-columns:34px 1fr 28px;gap:14px;align-items:center;background:transparent;border:0;padding:20px 2px;cursor:pointer;text-align:left;font-family:inherit">
                <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#B5794A">{{ m.n }}</span>
                <span>
                  <span style="display:block;font-size:17px;font-weight:600;line-height:1.35">{{ m.title }}</span>
                  <span style="display:block;margin-top:5px;font-size:13.5px;color:rgba(30,27,23,0.5)">{{ m.meta }}</span>
                </span>
                <span style="width:28px;height:28px;border-radius:999px;border:1px solid #E2D9C9;display:flex;align-items:center;justify-content:center;transform:rotate({{ m.deg }});transition:transform 340ms cubic-bezier(0.22,1,0.36,1);color:#8A5A34;font-size:16px;line-height:1">+</span>
              </button>
              <div style="display:grid;grid-template-rows:{{ m.rows }};transition:grid-template-rows 340ms cubic-bezier(0.22,1,0.36,1)">
                <div style="overflow:hidden">
                  <div style="padding:0 2px 22px 48px;display:flex;flex-direction:column;gap:10px">
                    <sc-for list="{{ m.lessons }}" as="l" hint-placeholder-count="4">
                      <div style="display:flex;align-items:baseline;gap:12px;font-size:15.5px;line-height:1.5;color:rgba(30,27,23,0.68)">
                        <span style="width:5px;height:5px;border-radius:999px;background:#C9BCA6;flex:0 0 auto;transform:translateY(-3px)"></span>
                        <span style="text-wrap:pretty">{{ l }}</span>
                      </div>
                    </sc-for>
                  </div>
                </div>
              </div>
            </div>
          </sc-for>
          <div style="border-top:1px solid #E2D9C9"></div>
        </div>
      </div>

      <aside style="position:sticky;top:100px;display:flex;flex-direction:column;gap:18px">
        <div data-reveal="" style="border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;padding:clamp(24px,2.8vw,34px);box-shadow:0 8px 30px rgba(30,27,23,0.06)">
          <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(36px,4vw,48px);line-height:1">{{ price }}</span>
            <span style="font-size:15px;color:rgba(30,27,23,0.5)">{{ priceNote }}</span>
          </div>
          <div style="margin-top:20px;display:flex;flex-direction:column;gap:11px">
            <sc-for list="{{ includes }}" as="i" hint-placeholder-count="5">
              <div style="display:grid;grid-template-columns:18px 1fr;gap:12px;align-items:start">
                <span style="color:#B5794A;font-size:15px;line-height:1.5">✓</span>
                <span style="font-size:15.5px;line-height:1.55;color:rgba(30,27,23,0.72)">{{ i }}</span>
              </div>
            </sc-for>
          </div>
          <button type="button" onClick="{{ openEnrollModal }}" style="width:100%;box-sizing:border-box;display:block;margin-top:24px;text-align:center;font-family:inherit;font-size:15px;font-weight:700;color:#FAF7F2;background:#B5794A;border:0;padding:16px 24px;border-radius:999px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">Enroll now →</button>
          <p style="margin:14px 0 0;text-align:center;font-size:13px;line-height:1.55;color:rgba(30,27,23,0.5)">Seat confirmed once payment is received. Message me first if you have questions.</p>
        </div>
        <div data-reveal="" style="border:1px solid #E2D9C9;border-radius:18px;padding:clamp(22px,2.6vw,30px)">
          <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(30,27,23,0.42)">Other courses</span>
          <div style="margin-top:14px;display:flex;flex-direction:column;gap:12px">
            <sc-for list="{{ related }}" as="r" hint-placeholder-count="3">
              <a href="{{ r.href }}" style="display:flex;align-items:baseline;justify-content:space-between;gap:12px;text-decoration:none;color:inherit;border-bottom:1px solid #EDE4D3;padding-bottom:10px">
                <span style="font-size:15.5px;font-weight:600;line-height:1.4">{{ r.title }}</span>
                <span style="flex:0 0 auto;font-size:14px;color:rgba(30,27,23,0.55)">{{ r.price }}</span>
              </a>
            </sc-for>
          </div>
          <a href="/courses" style="display:inline-block;margin-top:16px;font-size:14.5px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px" style-hover="border-color:#B5794A;color:#8A5A34">See all courses →</a>
        </div>
      </aside>
    </div>
  </section>

  <section data-screen-label="Instructor" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px);background:#1E1B17;color:#FAF7F2">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:clamp(32px,4vw,72px);align-items:center">
      <div data-reveal="" style="aspect-ratio:1;max-width:380px;width:100%;border-radius:16px;border:1px solid rgba(250,247,242,0.18);overflow:hidden;background:#24201C;display:flex;align-items:center;justify-content:center">
        <sc-if value="{{ hasTeacherImg }}">
          <img src="{{ teacherImg }}" alt="{{ teacher }}" style="width:100%;height:100%;object-fit:cover;display:block" />
        </sc-if>
        <sc-if value="{{ noTeacherImg }}">
          <span style="font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:10.5px;letter-spacing:0.08em;text-transform:uppercase;color:#D9A879;background:rgba(30,27,23,0.7);padding:7px 11px;border-radius:5px">{{ teacher }} portrait · 1:1</span>
        </sc-if>
      </div>
      <div>
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#D9A879">Your instructor</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em">{{ teacher }}</h2>
        <div data-reveal="" style="margin-top:10px;font-size:14px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:#D9A879">{{ teacherRole }}</div>
        <p data-reveal="" style="margin:20px 0 0;font-size:17px;line-height:1.66;color:rgba(250,247,242,0.7);max-width:520px;text-wrap:pretty">{{ teacherBio }}</p>
        <a data-reveal="" href="/about" style="display:inline-block;margin-top:22px;font-size:15px;font-weight:600;color:#FAF7F2;text-decoration:none;border-bottom:1px solid rgba(250,247,242,0.35);padding-bottom:3px" style-hover="border-color:#D9A879;color:#D9A879">More about me →</a>
      </div>
    </div>
  </section>

  <section data-screen-label="Course reviews" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;flex-wrap:wrap;align-items:end;justify-content:space-between;gap:18px 40px">
        <h2 data-reveal="" style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em">What students say.</h2>
        <span data-reveal="" style="font-size:14px;color:rgba(30,27,23,0.5)">★ 4.9 average from 140+ reviews</span>
      </div>
      <div style="margin-top:clamp(28px,3.4vw,44px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:20px">
        <sc-for list="{{ reviews }}" as="r" hint-placeholder-count="3">
          <figure data-tilt="" style="margin:0;border:1px solid #E2D9C9;border-radius:16px;background:#FFFDFA;padding:clamp(24px,2.6vw,32px);display:flex;flex-direction:column;gap:16px;transition:border-color 220ms ease">
            <span style="font-size:14px;color:#B5794A;letter-spacing:0.14em">★★★★★</span>
            <blockquote style="margin:0;font-family:'Newsreader',Georgia,serif;font-size:clamp(19px,1.9vw,23px);line-height:1.3;text-wrap:pretty">"{{ r.quote }}"</blockquote>
            <div style="margin-top:auto;padding-top:16px;border-top:1px solid #E2D9C9;display:flex;align-items:center;justify-content:space-between;gap:12px">
              <div style="display:flex;align-items:center;gap:12px">
                <img src="{{ r.avatar }}" alt="{{ r.name }}" style="width:38px;height:38px;border-radius:999px;object-fit:cover;display:block;border:1px solid #E2D9C9" />
                <div>
                  <div style="font-size:15px;font-weight:600">{{ r.name }}</div>
                  <div style="margin-top:3px;font-size:13.5px;color:rgba(30,27,23,0.55)">{{ r.role }}</div>
                </div>
              </div>
              <span style="font-size:14.5px;font-weight:700;color:#4C7A5E">{{ r.result }}</span>
            </div>
          </figure>
        </sc-for>
      </div>
    </div>
  </section>

  <section data-screen-label="Course FAQ" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:clamp(30px,5vw,72px);align-items:start">
      <div>
        <h2 data-reveal="" style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em">Course questions.</h2>
        <p data-reveal="" style="margin:14px 0 0;max-width:400px;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.64);text-wrap:pretty">Commonly asked questions regarding live Zoom schedules, session recordings, payment methods, and ongoing support for this batch.</p>
        <a data-reveal="" href="/contact" style="display:inline-block;margin-top:20px;font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px" style-hover="border-color:#B5794A;color:#8A5A34">Have another question? Ask me directly →</a>
      </div>
      <div style="display:flex;flex-direction:column">
        <sc-for list="{{ faqs }}" as="q" hint-placeholder-count="4">
          <div data-reveal="" style="border-top:1px solid #D9CDB6">
            <button type="button" onClick="{{ q.toggle }}" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:18px;background:transparent;border:0;padding:22px 2px;cursor:pointer;text-align:left;font-family:inherit">
              <span style="font-size:17px;font-weight:600;line-height:1.4;color:#1E1B17">{{ q.q }}</span>
              <span style="flex:0 0 auto;width:28px;height:28px;border-radius:999px;border:1px solid #D9CDB6;display:flex;align-items:center;justify-content:center;transform:rotate({{ q.deg }});transition:transform 340ms cubic-bezier(0.22,1,0.36,1);color:#8A5A34;font-size:16px;line-height:1">+</span>
            </button>
            <div style="display:grid;grid-template-rows:{{ q.rows }};transition:grid-template-rows 340ms cubic-bezier(0.22,1,0.36,1)">
              <div style="overflow:hidden">
                <p style="margin:0;padding:0 2px 24px;font-size:16px;line-height:1.65;color:rgba(30,27,23,0.68);max-width:560px;text-wrap:pretty">{{ q.a }}</p>
              </div>
            </div>
          </div>
        </sc-for>
        <div style="border-top:1px solid #D9CDB6"></div>
      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>

  <!-- CREATIVE FLOATING STICKY ENROLLMENT BAR -->
  <sc-if value="{{ showBar }}">
    <div style="position:fixed;left:0;right:0;bottom:24px;z-index:820;pointer-events:none">
      <div style="max-width:1360px;margin:0 auto;padding:0 clamp(20px,5vw,64px);width:100%;box-sizing:border-box">
        <div style="pointer-events:auto;background:rgba(30,27,23,0.94);backdrop-filter:saturate(180%) blur(16px);-webkit-backdrop-filter:saturate(180%) blur(16px);color:#FAF7F2;border:1px solid rgba(217,168,121,0.3);border-radius:20px;padding:12px 24px;box-shadow:0 16px 48px rgba(0,0,0,0.35);display:flex;align-items:center;justify-content:space-between;gap:16px 24px">
          <div style="min-width:0">
            <div style="font-size:15.5px;font-weight:700;letter-spacing:-0.01em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#FAF7F2">{{ title }}</div>
            <div style="margin-top:2px;font-size:13px;color:rgba(250,247,242,0.65);white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ barMeta }}</div>
          </div>
          <div style="display:flex;align-items:center;gap:18px;flex:0 0 auto">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:26px;color:#FAF7F2;font-weight:400">{{ price }}</span>
            <button type="button" onClick="{{ openEnrollModal }}" style="font-family:inherit;font-size:14.5px;font-weight:700;color:#1E1B17;background:#D9A879;border:0;border-radius:999px;padding:13px 26px;min-height:46px;cursor:pointer;transition:background 200ms ease;white-space:nowrap" style-hover="background:#FAF7F2">Enroll Now →</button>
          </div>
        </div>
      </div>
    </div>
  </sc-if>

  <!-- INTERACTIVE ENROLLMENT MODAL -->
  <sc-if value="{{ showEnrollModal }}">
    <div style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:999;background:rgba(18,15,12,0.75);backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);display:flex;align-items:center;justify-content:center;padding:20px;box-sizing:border-box">
      <div style="position:relative;background:#FFFDFA;color:#1E1B17;border:1px solid #E2D9C9;border-radius:24px;max-width:520px;width:100%;padding:clamp(24px,4vw,36px);box-shadow:0 24px 60px rgba(0,0,0,0.3);box-sizing:border-box">
        <button type="button" onClick="{{ closeEnrollModal }}" style="position:absolute;top:18px;right:18px;background:transparent;border:0;font-size:22px;color:rgba(30,27,23,0.4);cursor:pointer;padding:8px" style-hover="color:#1E1B17">✕</button>

        <sc-if value="{{ enrolled }}">
          <div style="text-align:center;padding:12px 0">
            <div style="width:60px;height:60px;border-radius:999px;background:rgba(76,122,94,0.12);color:#4C7A5E;display:flex;align-items:center;justify-content:center;font-size:28px;margin:0 auto">✓</div>
            <h3 style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-size:28px;font-weight:400">Seat Reserved, {{ studentName }}!</h3>
            <p style="margin:12px 0 0;font-size:15px;line-height:1.6;color:rgba(30,27,23,0.68)">We have received your enrollment request for <strong>{{ title }}</strong>. Complete payment instructions have been sent to <strong>{{ studentEmail }}</strong>.</p>
            <div style="margin-top:20px;background:#EDE4D3;border-radius:14px;padding:16px;font-size:14px;color:#8A5A34">
              Total Fee: <strong>{{ price }}</strong> · Live Zoom Batch
            </div>
            <div style="margin-top:24px;display:flex;flex-direction:column;gap:12px">
              <a href="https://wa.me/923000000000?text=Hi%20Sania,%20I%20just%20enrolled%20in%20{{ title }}" target="_blank" style="display:block;text-align:center;font-size:15px;font-weight:700;color:#FAF7F2;background:#4C7A5E;text-decoration:none;padding:15px;border-radius:999px">Chat on WhatsApp for Instant Confirmation →</a>
              <button type="button" onClick="{{ closeEnrollModal }}" style="font-family:inherit;font-size:14px;font-weight:600;color:rgba(30,27,23,0.6);background:transparent;border:0;cursor:pointer;padding:8px">Close window</button>
            </div>
          </div>
        </sc-if>

        <sc-if value="{{ notEnrolled }}">
          <div>
            <div style="display:flex;align-items:center;gap:10px">
              <span style="font-size:11.5px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#B5794A;background:rgba(181,121,74,0.12);padding:5px 12px;border-radius:999px">Live Batch Enrollment</span>
            </div>
            <h3 style="margin:14px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3vw,34px);line-height:1.1">Enroll in {{ title }}</h3>
            <p style="margin:8px 0 0;font-size:14.5px;color:rgba(30,27,23,0.6)">{{ live }} · Fee: <strong>{{ price }}</strong> · Live on Zoom</p>

            <form id="enrollFormEl" action="/mail-handler.php" method="post" onSubmit="{{ submitEnroll }}" style="margin-top:22px;display:flex;flex-direction:column;gap:14px">
              <input type="hidden" name="form_type" value="course" />
              <input type="hidden" name="course" value="{{ title }}" />
              <input type="hidden" name="budget" value="{{ price }}" />
              <div>
                <label style="display:block;font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);margin-bottom:6px">Your Full Name</label>
                <input type="text" name="name" required="required" placeholder="e.g. Ayesha Khan" value="{{ studentName }}" onInput="{{ updateName }}" onChange="{{ updateName }}" style="width:100%;box-sizing:border-box;font-family:inherit;font-size:15px;padding:12px 16px;border:1px solid #D9CDB6;border-radius:12px;background:#FAF7F2;outline:none" />
              </div>
              <div>
                <label style="display:block;font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);margin-bottom:6px">Email Address</label>
                <input type="email" name="email" required="required" placeholder="you@example.com" value="{{ studentEmail }}" onInput="{{ updateEmail }}" onChange="{{ updateEmail }}" style="width:100%;box-sizing:border-box;font-family:inherit;font-size:15px;padding:12px 16px;border:1px solid #D9CDB6;border-radius:12px;background:#FAF7F2;outline:none" />
              </div>
              <div>
                <label style="display:block;font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);margin-bottom:6px">WhatsApp Number</label>
                <input type="tel" name="phone" required="required" placeholder="+92 300 1234567" value="{{ studentPhone }}" onInput="{{ updatePhone }}" onChange="{{ updatePhone }}" style="width:100%;box-sizing:border-box;font-family:inherit;font-size:15px;padding:12px 16px;border:1px solid #D9CDB6;border-radius:12px;background:#FAF7F2;outline:none" />
              </div>
              <div>
                <label style="display:block;font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.6);margin-bottom:6px">Payment Option</label>
                <select name="payment_option" value="{{ paymentMethod }}" onInput="{{ updatePayment }}" onChange="{{ updatePayment }}" style="width:100%;box-sizing:border-box;font-family:inherit;font-size:15px;padding:12px 16px;border:1px solid #D9CDB6;border-radius:12px;background:#FAF7F2;outline:none">
                  <option value="Bank Transfer">Bank Transfer (HBL / Meezan / Nayapay)</option>
                  <option value="JazzCash / EasyPaisa">JazzCash / EasyPaisa</option>
                  <option value="Card Payment">International Credit / Debit Card ($ USD)</option>
                </select>
              </div>

              <button type="submit" style="margin-top:10px;font-family:inherit;font-size:15px;font-weight:700;color:#FAF7F2;background:#B5794A;border:0;border-radius:999px;padding:16px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">Confirm Enrollment Request →</button>
            </form>
          </div>
        </sc-if>
      </div>
    </div>
  </sc-if>
  <div style="height:{{ barSpace }}"></div>
</div>

</x-dc>
<script type="text/x-dc" data-dc-script>
const M = (title, meta, lessons) => ({ title, meta, lessons });
const MONTH = '1 month · Mon–Fri · 1 hour each class';
const HALF = '15 days · Mon–Fri · 1 hour each class';
const WEEK = '1 week · Mon–Fri · 1 hour each class';

const COURSES = {
  'pinterest-affiliate': {
    teacher: 'Sania Maqsood', cat: 'Affiliate marketing', title: 'Pinterest Affiliate Marketing', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'affiliate', img: 'Media/Courses/Pinterest-Affiliate.jpeg',
    lead: 'The complete system for turning Pinterest search traffic into affiliate income on Amazon, Alibaba, AliExpress and Temu: keyword-led pin design, a publishing cadence you can actually keep, and the offer stack that converts saves into commissions.',
    outcomes: ['A keyword sheet with four clusters worth publishing against, not forty maybes.', 'A pin template system you can produce a month of content from in one sitting.', 'Accounts approved and links working on Amazon, AliExpress, Alibaba and Temu.', 'A 90-day cadence and a review checklist, so you know when to change course.'],
    modules: [
      M('How Pinterest actually ranks', 'Week 1 · 4 classes', ['Search intent vs. social discovery', 'The four signals that matter', 'Business account setup, properly', 'Reading the search bar like a keyword tool']),
      M('Keyword research that finds buyers', 'Week 1–2 · 5 classes', ['Building your first keyword sheet', 'Commercial vs. informational intent', 'Seasonal demand and how early to publish', 'Competitor board teardown']),
      M('Pin design as a search result', 'Week 2–3 · 5 classes', ['The template system, with files', 'Text hierarchy that survives a small screen', 'Five variants without redesigning', 'What actually gets clicked']),
      M('Offers: Amazon, AliExpress, Alibaba, Temu', 'Week 3–4 · 5 classes', ['Approval and account setup for each platform', 'Reading a commission structure', 'Stacking three to five offers in one post', 'Disclosure and link management done properly']),
      M('Cadence, data, and scaling', 'Week 4 · 3 classes', ['The weekly publishing rhythm', 'The four metrics that predict revenue', 'What to do in a bad week', 'Reviewing at day 30, 60, 90'])
    ]
  },
  'pinterest-gumroad': {
    teacher: 'Sania Maqsood', cat: 'Affiliate marketing', title: 'Pinterest + Gumroad', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'affiliate', img: 'Media/Courses/Pinterest-Gumroad.jpeg',
    lead: 'Make the product once and let search sell it. We build a small digital product, price it honestly, put it on Gumroad, and drive buyers to it with pins built around what people are already searching for.',
    outcomes: ['One digital product finished, priced, and live on Gumroad.', 'A product page that answers the three questions buyers always ask.', 'A pin set that sends search traffic straight to the buy button.', 'A restock plan: what to make second, and when.'],
    modules: [
      M('Choosing a product that sells', 'Week 1 · 4 classes', ['Templates, printables, presets, guides — what fits you', 'Validating demand before you build', 'Scoping v1 so it ships in a week', 'Pricing without undercharging']),
      M('Building it', 'Week 2 · 5 classes', ['Production workflow and file hygiene', 'Covers and mockups that look trustworthy', 'Writing the product description', 'Delivery, licences, and refunds']),
      M('Gumroad setup', 'Week 2–3 · 4 classes', ['Store and payout setup from Pakistan', 'Discounts, bundles, and upsells', 'Email capture and the follow-up sequence', 'Reading Gumroad analytics']),
      M('Pinterest traffic', 'Week 3–4 · 6 classes', ['Keyword clusters for a product, not a blog', 'Pin design for a paid offer', 'Landing page vs. direct-to-product', 'Publishing cadence and scheduling']),
      M('Scaling the catalogue', 'Week 4 · 3 classes', ['Reading what sold and why', 'Product two and three', 'Seasonal pushes', 'When to raise your price'])
    ]
  },
  'pinterest-etsy': {
    teacher: 'Sania Maqsood', cat: 'Affiliate marketing', title: 'Pinterest + Etsy', price: 'PKR 15,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'affiliate', img: 'Media/Courses/Pinterest-Etsy.jpeg',
    lead: 'An Etsy shop built for Etsy search, then fed with Pinterest traffic. Listings, photography you can shoot at home, pricing that survives fees, and the pin-to-listing path that keeps orders arriving.',
    outcomes: ['A shop with ten listings written for how Etsy search actually works.', 'Product photos you shot yourself that do not look homemade.', 'Pricing that survives fees, shipping, and a sale.', 'A Pinterest routine that keeps traffic coming without ads.'],
    modules: [
      M('Shop foundations', 'Week 1 · 4 classes', ['Niche and product decisions', 'Shop setup, policies, and payouts from Pakistan', 'Etsy fees, honestly', 'Competitor research that is not copying']),
      M('Listings that rank', 'Week 1–2 · 5 classes', ['Titles, tags, and attributes', 'Writing descriptions people finish', 'Variations and inventory', 'Renewals and what actually affects ranking']),
      M('Photography at home', 'Week 2–3 · 4 classes', ['Light, background, and a phone', 'The five shots every listing needs', 'Editing without over-editing', 'Video that increases conversion']),
      M('Pinterest for Etsy', 'Week 3–4 · 6 classes', ['Keyword clusters that match buyer intent', 'Pin design for physical products', 'Rich pins and linking correctly', 'A weekly publishing rhythm']),
      M('Orders, reviews, repeat', 'Week 4 · 3 classes', ['Packaging and shipping choices', 'The review loop that keeps you ranking', 'Handling problem orders', 'Reading stats and restocking'])
    ]
  },
  'youtube-monetization': {
    teacher: 'Sania Maqsood', cat: 'Content', title: 'YouTube Monetization', price: 'PKR 8,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'content', img: 'Media/Courses/YouTube-monetization.jpeg',
    lead: 'From zero to monetised and past it. What to make, how often to publish, how to survive the first fifty videos, and the income streams that start paying before AdSense approval does.',
    outcomes: ['A channel positioning you can explain in one sentence.', 'A repeatable production routine that fits a job or studies.', 'Titles, thumbnails, and hooks tested against real click data.', 'Three income streams live, not just ad revenue waiting on approval.'],
    modules: [
      M('Channel strategy', 'Week 1 · 4 classes', ['Picking a lane you will not quit in month two', 'Format decisions: long, shorts, or both', 'Studying a competitor properly', 'Channel setup and branding basics']),
      M('Making the video', 'Week 1–2 · 5 classes', ['Scripting hooks and retention beats', 'Filming with what you already own', 'Editing rhythm for watch time', 'Batching so you publish weekly']),
      M('Titles, thumbnails, clicks', 'Week 2–3 · 4 classes', ['Thumbnail design rules that hold up', 'Title patterns and A/B testing', 'Reading CTR and retention graphs', 'Fixing an underperforming video']),
      M('Monetization paths', 'Week 3–4 · 6 classes', ['Watch hours and subscriber thresholds', 'AdSense reality and RPM by niche', 'Affiliate income in descriptions', 'Sponsorships: rates, pitching, deliverables']),
      M('Growth and consistency', 'Week 4 · 3 classes', ['Analytics review routine', 'Repurposing to shorts and Pinterest', 'Community and comments', 'Planning the next 90 days'])
    ]
  },
  'blogging': {
    teacher: 'Sania Maqsood', cat: 'Content', title: 'Blogging', price: 'PKR 5,000', days: '11 Days', time: '9 PM PKT', live: '11 Live Classes', dur: HALF, set: 'content', img: 'Media/Courses/Blogging.jpeg',
    lead: 'Fifteen days to a blog that exists, has a point, and can rank: a topic worth owning, a structure search engines understand, ten posts live, and a habit that survives after the classes end.',
    outcomes: ['A niche and content plan for the next thirty posts.', 'A blog live with clean structure and internal linking.', 'Ten published posts written to a repeatable template.', 'A monetisation plan that fits your traffic level, not someone else\'s.'],
    modules: [
      M('Topic and setup', 'Days 1–3 · 2 classes', ['Choosing a niche with demand and patience', 'Domain, hosting, and a fast theme', 'Site structure and categories', 'The pages every blog needs']),
      M('Writing posts that rank', 'Days 4–7 · 4 classes', ['Keyword research for beginners', 'The post template that works', 'Editing for clarity and skimmers', 'Images, alt text, and speed']),
      M('Getting read', 'Days 8–11 · 2 classes', ['Internal linking done right', 'Pinterest and search as your two channels', 'Email list from day one', 'Guest posts and honest outreach']),
      M('Making money from it', 'Days 12–14 · 2 classes', ['Affiliate placement that does not annoy', 'Display ads: when it is worth it', 'Digital products from your best posts', 'Sponsored content rules']),
      M('The habit', 'Day 15 · 1 class', ['A weekly writing routine', 'Batching and scheduling', 'What to review monthly', 'When to update instead of publishing new'])
    ]
  },
  'seo': {
    teacher: 'M. Saqib', cat: 'SEO', title: 'SEO', price: 'PKR 15,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'web', img: 'Media/Courses/SEO.jpeg',
    lead: 'The unglamorous work that makes a site rank and keep ranking: search intent, structure, internal links, technical hygiene, and content that answers the query better than the page currently winning.',
    outcomes: ['A keyword map for a real site, clustered by intent.', 'A technical audit completed and the fixes shipped.', 'An internal linking structure that spreads authority on purpose.', 'A reporting habit that separates movement from noise.'],
    modules: [
      M('How search works now', 'Week 1 · 4 classes', ['Crawling, indexing, ranking', 'Intent types and SERP reading', 'What AI results changed and what they did not', 'Setting up Search Console and GA4']),
      M('Keyword research and mapping', 'Week 1–2 · 5 classes', ['Finding queries with commercial value', 'Clustering into topics', 'Mapping keywords to pages, one intent each', 'Cannibalisation and how to fix it']),
      M('On-page and content', 'Week 2–3 · 5 classes', ['Titles, headings, and structure', 'Writing to beat the page that ranks', 'Schema that is worth adding', 'Refreshing old content for gains']),
      M('Technical SEO', 'Week 3–4 · 4 classes', ['Site speed and Core Web Vitals', 'Sitemaps, robots, canonicals', 'Redirects and migrations without losses', 'Common WordPress and Shopify pitfalls']),
      M('Links and reporting', 'Week 4 · 4 classes', ['Internal linking as a system', 'Earning links without buying them', 'Local SEO essentials', 'A monthly report that answers "did it work"'])
    ]
  },
  'website-design': {
    teacher: 'M. Saqib', cat: 'Web design', title: 'Website Design', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'web', img: 'Media/Courses/Website Design.jpeg',
    lead: 'Design a site people trust in the first three seconds. Layout, type, colour, and the single decision each page has to earn — taken from a blank canvas to finished, buildable pages.',
    outcomes: ['A five-page site designed from scratch, desktop and mobile.', 'A type and colour system you can reuse on every project.', 'Components and states, so a developer never has to guess.', 'A presentation you can walk a client through and get signed off.'],
    modules: [
      M('Design and the fundamentals', 'Week 1 · 4 classes', ['Frames, visual grids, and modern layout', 'Type scale and spacing that hold together', 'Colour with contrast that passes', 'Hierarchy: what the eye reads first']),
      M('Page anatomy', 'Week 1–2 · 5 classes', ['The one job of a home page', 'Above the fold, honestly', 'Service, about, and contact pages', 'Trust: proof, pricing, and clarity']),
      M('Components and systems', 'Week 2–3 · 5 classes', ['Buttons, inputs, cards, and states', 'Navigation patterns that work on mobile', 'Reusable sections and variants', 'Handoff notes developers thank you for']),
      M('Responsive and detail', 'Week 3–4 · 4 classes', ['Designing mobile without shrinking desktop', 'Images, aspect ratios, and placeholders', 'Micro-copy and empty states', 'Accessibility basics you should never skip']),
      M('Client work', 'Week 4 · 4 classes', ['Briefs and scoping', 'Presenting so the work is understood', 'Feedback rounds without redesigning twice', 'Pricing, invoices, and delivery'])
    ]
  },
  'wordpress-design': {
    teacher: 'M. Saqib', cat: 'Web design', title: 'WordPress Design', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'web', img: 'Media/Courses/WordPress-design.jpeg',
    lead: 'Client-ready WordPress without fighting the builder: hosting and theme setup, blocks and templates, the plugins actually worth installing, and a handover the client can maintain without calling you weekly.',
    outcomes: ['A live WordPress site built from a design, not a demo import.', 'A block/template setup the client can edit safely.', 'A speed, backup, and security baseline in place.', 'A maintenance offer you can charge monthly for.'],
    modules: [
      M('Setup that does not haunt you', 'Week 1 · 4 classes', ['Hosting, domains, staging', 'Choosing a theme (and when to use none)', 'Settings, permalinks, users', 'Backups from day one']),
      M('Building pages', 'Week 1–2 · 5 classes', ['Block editor and patterns', 'Templates and template parts', 'Global styles: type, colour, spacing', 'Rebuilding a custom design faithfully']),
      M('Plugins and features', 'Week 2–3 · 5 classes', ['Forms that deliver mail reliably', 'SEO plugin setup, correctly', 'Galleries, sliders, and what to avoid', 'WooCommerce basics if the client sells']),
      M('Speed, security, SEO', 'Week 3–4 · 4 classes', ['Caching and image optimisation', 'Core Web Vitals on real hosting', 'Hardening and updates', 'Redirects and indexing checks']),
      M('Handover and retainers', 'Week 4 · 4 classes', ['Client training and documentation', 'Care plans and monthly pricing', 'Contracts and scope creep', 'Getting the second project'])
    ]
  },
  'landing-pages': {
    teacher: 'M. Saqib', cat: 'Web design', title: 'Landing Pages', price: 'PKR 5,000', days: '5 Days', time: '9 PM PKT', live: '5 Live Classes', dur: WEEK, set: 'web', img: 'Media/Courses/Landing-Page.jpeg',
    lead: 'One week to a page that converts: offer clarity, the blocks that belong above the fold, proof placed where doubt appears, and the copy tests worth running before you spend on traffic.',
    outcomes: ['One landing page finished, written and designed.', 'An offer statement that survives a stranger reading it once.', 'A test list ranked by likely impact.', 'A checklist you can reuse for every future page.'],
    modules: [
      M('The offer', 'Day 1 · 1 class', ['Who it is for and what changes for them', 'One page, one action', 'Objections you must answer', 'Pricing presentation']),
      M('Structure', 'Day 2 · 1 class', ['The six blocks above the fold', 'Proof placement', 'Long vs. short page', 'Mobile-first order of sections']),
      M('Copy', 'Day 3 · 1 class', ['Headline patterns that are not hype', 'Benefits without adjectives', 'Microcopy on the button', 'Cutting 30% without losing meaning']),
      M('Design and build', 'Day 4 · 1 class', ['Visual hierarchy and whitespace', 'Images vs. illustration vs. nothing', 'Forms that get finished', 'Speed as a conversion factor']),
      M('Test and launch', 'Day 5 · 1 class', ['What to test first', 'Reading results honestly', 'Analytics and event tracking', 'Launch checklist'])
    ]
  },
  'website-development': {
    teacher: 'M. Saqib', cat: 'Development', title: 'Website Development', price: 'PKR 15,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'web', img: 'Media/Courses/Website-development.jpeg',
    lead: 'Build what you designed: clean HTML and CSS, layouts that hold on every screen, forms that actually deliver mail, and a deploy process you can repeat without asking anyone for help.',
    outcomes: ['A multi-page responsive site you built line by line.', 'Layout confidence with flexbox and grid.', 'A working contact form and basic JavaScript interactions.', 'A deployed site with a domain, HTTPS, and a repeatable workflow.'],
    modules: [
      M('HTML that means something', 'Week 1 · 4 classes', ['Document structure and semantics', 'Forms and inputs', 'Images, media, and accessibility', 'Dev tools as your first debugger']),
      M('CSS layout', 'Week 1–2 · 6 classes', ['Box model and spacing systems', 'Flexbox in practice', 'Grid for real layouts', 'Responsive without a hundred breakpoints']),
      M('Interaction with JavaScript', 'Week 2–3 · 5 classes', ['Selecting and changing the DOM', 'Events, menus, accordions, tabs', 'Form validation and feedback', 'Fetching data and rendering it']),
      M('Building the real thing', 'Week 3–4 · 4 classes', ['From design file to page', 'Reusable components without a framework', 'Performance and image handling', 'Cross-browser and mobile checks']),
      M('Ship it', 'Week 4 · 3 classes', ['Git basics you will actually use', 'Hosting, domains, HTTPS', 'Contact form delivery that works', 'Handover and future edits'])
    ]
  },
  'graphics-designing': {
    teacher: 'M. Saqib', cat: 'Design', title: 'Graphics Designing', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'web', img: 'Media/Courses/Graphics Design.jpeg',
    lead: 'Type, colour, grid, and hierarchy applied to the work clients actually pay for: social sets, thumbnails, packaging mockups, and the brand basics that make a small business look established.',
    outcomes: ['A portfolio of six finished pieces, not exercises.', 'A working understanding of type and colour, not templates.', 'A brand basics kit: logo use, palette, type, and rules.', 'File delivery clients can use without coming back confused.'],
    modules: [
      M('Fundamentals', 'Week 1 · 5 classes', ['Type anatomy and pairing', 'Colour systems and contrast', 'Grid, alignment, and balance', 'Hierarchy and visual weight']),
      M('Tools in practice', 'Week 1–2 · 5 classes', ['Canva and modern design tools for production speed', 'Vector basics and shapes', 'Masks, exports, and file formats', 'Building reusable templates']),
      M('Client formats', 'Week 2–3 · 5 classes', ['Social sets and carousels', 'Thumbnails that earn clicks', 'Flyers, menus, and print basics', 'Packaging and product mockups']),
      M('Brand basics', 'Week 3–4 · 4 classes', ['Logo usage and lockups', 'Palette and type systems', 'Writing a one-page brand guide', 'Presenting concepts to clients']),
      M('Working as a designer', 'Week 4 · 3 classes', ['Pricing and scope', 'Feedback and revisions', 'Portfolio and Behance presentation', 'Finding the first paid clients'])
    ]
  },
  'shopify-store-setup': {
    teacher: 'M. Saqib', cat: 'Ecommerce', title: 'Shopify Store Setup', price: 'PKR 5,000', days: '5 Days', time: '9 PM PKT', live: '5 Live Classes', dur: WEEK, set: 'ecom', img: 'Media/Courses/Shopify-store-setup.jpeg',
    lead: 'From empty store to ready-for-orders in a week: product pages that sell, trust signals, payments and shipping configured for Pakistan, and a clear view of which apps you can safely skip.',
    outcomes: ['A live store with real products, policies, and checkout tested.', 'Product pages written to answer buying questions in order.', 'Payments and shipping configured for local and international orders.', 'A launch checklist and a plan for the first ten orders.'],
    modules: [
      M('Store foundations', 'Day 1 · 1 class', ['Plans, domains, and store settings', 'Theme choice and customisation limits', 'Navigation and collections', 'Brand basics inside Shopify']),
      M('Products that sell', 'Day 2 · 1 class', ['Titles, descriptions, and specs', 'Photography and video requirements', 'Variants, inventory, and SKUs', 'Pricing and compare-at pricing']),
      M('Trust and checkout', 'Day 3 · 1 class', ['Policies, contact, and about pages', 'Reviews and social proof', 'Checkout settings and abandoned carts', 'Taxes and order notifications']),
      M('Payments and shipping', 'Day 4 · 1 class', ['Payment options available in Pakistan', 'COD workflows and fraud checks', 'Shipping zones and rates', 'Couriers and fulfilment apps']),
      M('Launch', 'Day 5 · 1 class', ['Apps worth installing (and skipping)', 'Speed and mobile checks', 'Launch checklist', 'First traffic without burning budget'])
    ]
  },
  'shopify-dropshipping': {
    teacher: 'M. Saqib', cat: 'Ecommerce', title: 'Shopify Dropshipping', price: 'PKR 10,000', days: '11 Days', time: '9 PM PKT', live: '11 Live Classes', dur: HALF, set: 'ecom', img: 'Media/Courses/Shopify-dropshipping.jpeg',
    lead: 'What still works and what does not. Product research with real demand checks, supplier vetting, margin maths done before you spend on ads, and a testing budget that tells you when to stop.',
    outcomes: ['A validated product list with margins calculated, not guessed.', 'Suppliers vetted with samples and shipping times confirmed.', 'A store built to convert cold traffic.', 'A testing framework with clear kill rules.'],
    modules: [
      M('The honest model', 'Days 1–3 · 3 classes', ['Where dropshipping still works', 'Margin maths before anything else', 'Legal, tax, and refund reality', 'Setting a budget you can lose']),
      M('Product research', 'Days 4–6 · 3 classes', ['Demand signals that are not TikTok hype', 'Competition and saturation checks', 'Pricing for ad spend', 'Building a shortlist of five']),
      M('Suppliers and logistics', 'Days 7–9 · 3 classes', ['Vetting suppliers and ordering samples', 'Shipping times customers accept', 'Handling delays and refunds', 'Local sourcing vs. overseas']),
      M('Store and offer', 'Days 10–12 · 1 class', ['Product page structure for cold traffic', 'Offer, bundles, and free shipping maths', 'Trust elements that matter', 'Post-purchase flow']),
      M('Testing', 'Days 13–15 · 1 class', ['Creative testing on a small budget', 'Metrics that decide scale or stop', 'When to change product vs. creative', 'Reinvesting profit'])
    ]
  },
  'meta-google-ads': {
    teacher: 'M. Saqib', cat: 'Ads', title: 'Meta & Google Ads', price: 'PKR 10,000', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'ecom', img: 'Media/Courses/Meta-Google-Ads.jpeg',
    lead: 'Campaign structure, creative testing, and the numbers that decide whether to scale or switch off — taught on budgets that survive the learning phase instead of vanishing in a weekend.',
    outcomes: ['Accounts, pixels, and conversions set up and verified.', 'A campaign structure you can explain and repeat.', 'A creative testing routine with clear winners and losers.', 'Reporting that ties spend to revenue, not vanity metrics.'],
    modules: [
      M('Setup and tracking', 'Week 1 · 5 classes', ['Business Manager and ad accounts', 'Pixel, Conversions API, and events', 'Google Ads account structure and tags', 'Verifying data before you spend']),
      M('Meta campaigns', 'Week 1–2 · 5 classes', ['Objectives and what they optimise for', 'Audiences: broad, interest, lookalike', 'Budgets, learning phase, and patience', 'Retargeting that is not creepy']),
      M('Google campaigns', 'Week 2–3 · 5 classes', ['Search intent and keyword match types', 'Ad copy and extensions', 'Performance Max, carefully', 'Negative keywords and wasted spend']),
      M('Creative', 'Week 3–4 · 4 classes', ['Hooks, angles, and formats', 'UGC-style ads on a small budget', 'Testing frameworks that isolate variables', 'Refreshing before fatigue kills results']),
      M('Scaling and reporting', 'Week 4 · 3 classes', ['CAC, ROAS, and contribution margin', 'Scaling without breaking performance', 'Diagnosing a drop', 'A weekly reporting rhythm'])
    ]
  },
  'landing-page-grand-session': {
    teacher: 'M. Saqib', cat: 'Grand session', title: 'Landing Page Design — Grand Session', price: 'PKR 2,000', days: '1 Session', time: '2 hours live', live: '1 Live Session', dur: 'One-off live Zoom session · recording included', set: 'web', img: 'Media/Courses/Landing-Page-2-Hours.jpeg',
    lead: 'One two-hour live Zoom session, one finished landing page. You design alongside me from blank canvas to publish-ready, with the decisions explained as they happen — and the recording to rewatch.',
    outcomes: ['A complete landing page designed during the session.', 'The block-by-block structure you can reuse forever.', 'Copy prompts for each section, filled in as we go.', 'The recording plus the working file.'],
    modules: [
      M('Hour 1 — offer and structure', 'Live · 60 minutes', ['Clarifying the offer in one sentence', 'Choosing the section order', 'Wireframing above the fold', 'Writing the headline together']),
      M('Hour 2 — design and finish', 'Live · 60 minutes', ['Type, colour, and spacing decisions', 'Proof, pricing, and the form', 'Mobile version in minutes', 'Export, publish, and a test list'])
    ]
  },
  'forex-trading': {
    teacher: 'Aqib', cat: 'Trading', title: 'Forex Trading', price: '$200', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'trading', img: 'Media/Courses/Forex-Trading.jpeg',
    lead: 'Charts, risk, and a routine. How to read market structure, size a position so one loss cannot end you, and journal trades until your edge is visible in the numbers instead of in your feelings.',
    outcomes: ['A written trading plan with entry, exit, and risk rules.', 'Position sizing you can calculate in seconds.', 'A journal with 30+ logged trades and a review habit.', 'A demo track record before real money is involved.'],
    modules: [
      M('Market basics', 'Week 1 · 4 classes', ['Pairs, spreads, leverage, and lots', 'Broker choice and platform setup', 'Sessions and volatility', 'Why most beginners lose']),
      M('Reading the chart', 'Week 1–2 · 6 classes', ['Structure: highs, lows, and trend', 'Support, resistance, and liquidity', 'Candles and momentum', 'Higher timeframe context first']),
      M('Strategy', 'Week 2–3 · 5 classes', ['Two setups, learned properly', 'Entry triggers and invalidation', 'Stops and targets with reasons', 'Backtesting by hand']),
      M('Risk and psychology', 'Week 3–4 · 4 classes', ['Risk per trade and drawdown maths', 'Position sizing calculator', 'Revenge trading and overtrading', 'Rules for a losing week']),
      M('Routine', 'Week 4 · 3 classes', ['Pre-market checklist', 'Journaling every trade', 'Weekly review of the numbers', 'Moving from demo to small live'])
    ]
  },
  'binary-trading': {
    teacher: 'Aqib', cat: 'Trading', title: 'Binary Trading', price: '$200', days: '22 Days', time: '9 PM PKT', live: '22 Live Classes', dur: MONTH, set: 'trading', img: 'Media/Courses/Binary-Trading.jpeg',
    lead: 'The honest version: how the instrument really pays, which setups carry an edge, and the risk rules that stop a bad week from being your last. Taught with the maths on screen, not screenshots of wins.',
    outcomes: ['A clear understanding of payout maths and required win rate.', 'Two setups with defined entries and expiry logic.', 'Strict risk rules and a daily loss limit.', 'A journal that shows whether the edge is real.'],
    modules: [
      M('How it actually works', 'Week 1 · 4 classes', ['Payouts, expiry, and the house edge', 'Platform and asset selection', 'Break-even win rate maths', 'Scams and red flags']),
      M('Reading price', 'Week 1–2 · 6 classes', ['Structure and trend on short timeframes', 'Support, resistance, and reaction zones', 'Momentum and exhaustion candles', 'News events and when to stand aside']),
      M('Setups', 'Week 2–3 · 5 classes', ['Two entry models, in detail', 'Choosing expiry for the setup', 'Filters that cut low-quality trades', 'Manual backtesting method']),
      M('Risk control', 'Week 3–4 · 4 classes', ['Fixed stake vs. percentage', 'Daily loss limits and stopping rules', 'Why martingale ends accounts', 'Handling a losing streak']),
      M('Discipline', 'Week 4 · 3 classes', ['Session routine and checklist', 'Journaling and weekly review', 'Demo to live transition', 'Knowing when to quit for the day'])
    ]
  }
};

const REVIEWS = {
  affiliate: [
    { quote: 'First affiliate sale in 11 days, from a pin I nearly did not publish.', name: 'Hira Nadeem', role: 'Home & living blogger', result: 'PKR 40K/mo', avatar: 'Media/Avatars/hina.jpg' },
    { quote: 'I was promoting the wrong things. Week 3 alone paid for the course.', name: 'Areeba Malik', role: 'Product reviewer', result: '+PKR 55K/mo', avatar: 'Media/Avatars/maryam.jpg' },
    { quote: 'I finally understand why some pins work. It is the query, not the design.', name: 'Nadia Farooq', role: 'Beauty creator', result: '38K monthly views', avatar: 'Media/Avatars/zainab.jpg' }
  ],
  web: [
    { quote: 'I stopped guessing. Every page now has one job and my clients notice.', name: 'Usman Tariq', role: 'Freelance designer', result: '3 clients in 6 weeks', avatar: 'Media/Avatars/usman.jpg' },
    { quote: 'The handover section alone changed how I charge. No more free revisions.', name: 'Zainab Ali', role: 'Web designer', result: 'Rates doubled', avatar: 'Media/Avatars/zainab.jpg' },
    { quote: 'Built and deployed my first real site during the course, not after it.', name: 'Bilal Ahmed', role: 'Career switcher', result: 'First paid project', avatar: 'Media/Avatars/bilal.jpg' }
  ],
  ecom: [
    { quote: 'The margin maths saved me from a product I was about to spend on ads for.', name: 'Fatima Sheikh', role: 'Store owner', result: 'Break-even in month 1', avatar: 'Media/Avatars/ayesha.jpg' },
    { quote: 'Store was live in a week and the first order came before class five.', name: 'Hamza Iqbal', role: 'Shopify seller', result: '18 orders/mo', avatar: 'Media/Avatars/saad.jpg' },
    { quote: 'Finally someone explained COD and courier reality for Pakistan.', name: 'Sana Rauf', role: 'Home-brand founder', result: 'Returns down 40%', avatar: 'Media/Avatars/maryam.jpg' }
  ],
  content: [
    { quote: 'Publishing weekly stopped being a fight once I learned to batch.', name: 'Ayesha Khan', role: 'YouTuber', result: '4K watch hours', avatar: 'Media/Avatars/ayesha.jpg' },
    { quote: 'My thumbnails were the problem all along. CTR went from 2% to 7%.', name: 'Talha Aziz', role: 'Tech channel', result: 'Monetised in 3 months', avatar: 'Media/Avatars/ahmed.jpg' },
    { quote: 'Ten posts live and two already ranking. I had been stuck for a year.', name: 'Maryam Javed', role: 'Blogger', result: '1.2K visits/mo', avatar: 'Media/Avatars/maryam.jpg' }
  ],
  trading: [
    { quote: 'The risk module is the whole course. I stopped blowing accounts.', name: 'Ahmed Raza', role: 'Part-time trader', result: '3 months green', avatar: 'Media/Avatars/ahmed.jpg' },
    { quote: 'No hype, no signals. Just structure, sizing, and a journal I actually keep.', name: 'Saad Mehmood', role: 'Student', result: 'Demo to live', avatar: 'Media/Avatars/saad.jpg' },
    { quote: 'She showed the losing trades too. That is why I trusted the method.', name: 'Kashif Anwar', role: 'Trader', result: 'Rules-based now', avatar: 'Media/Avatars/bilal.jpg' }
  ]
};

const TEACHERS = {
  'Sania Maqsood': {
    role: 'Pinterest, affiliate & content',
    bio: 'I run content properties on the exact system taught here, and I update the material every quarter because the platforms keep moving. 500+ students taught live on Zoom, and I still answer every question in class myself.',
    img: 'Media/Instructors/sania.jpg'
  },
  'M. Saqib': {
    role: 'Web, SEO, ecommerce & ads',
    bio: 'Saqib builds, ranks and advertises sites for a living — client websites, WordPress builds, SEO retainers, Shopify stores and paid campaigns. He teaches the exact process he uses on client work, deadlines and all.',
    img: 'Media/Instructors/saqib.jpg'
  },
  'Aqib': {
    role: 'Forex & binary trading',
    bio: 'Aqib trades forex and binary full time and teaches it the honest way: structure, risk, and a journal. No signals, no screenshots of wins — the losing trades get shown too, because that is where the lesson is.',
    img: 'Media/Instructors/aqib.jpg'
  }
};

const ORDER = Object.keys(COURSES);

class Component extends DCLogic {
  state = {
    openModule: 0, openFaq: -1, pastHero: false, slug: null,
    showEnrollModal: false, enrolled: false,
    studentName: '', studentEmail: '', studentPhone: '', paymentMethod: 'Bank Transfer'
  };

  componentDidMount() {
    let q = new URLSearchParams(window.location.search).get('c');
    if (!q) {
      const parts = window.location.pathname.replace(/\/+$/, '').split('/');
      const last = parts[parts.length - 1];
      const prev = parts[parts.length - 2];
      if (prev === 'courses' && last && COURSES[last]) q = last;
    }
    if (q && COURSES[q]) this.setState({ slug: q });
    this._scroll = () => {
      const scrollY = window.scrollY || 0;
      const viewportH = window.innerHeight || 0;
      const docH = document.documentElement.scrollHeight || document.body.scrollHeight || 0;
      const pastHero = scrollY > 520;
      const nearFooter = (docH - (scrollY + viewportH)) < 440;
      const showBar = pastHero && !nearFooter;
      if (showBar !== this.state.pastHero) this.setState({ pastHero: showBar });
    };
    window.addEventListener('scroll', this._scroll, { passive: true });
    this._scroll();
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  componentWillUnmount() { window.removeEventListener('scroll', this._scroll); }

  renderVals() {
    const slug = this.state.slug || 'pinterest-affiliate';
    const c = COURSES[slug];
    const om = this.state.openModule, of = this.state.openFaq;
    const others = ORDER.filter(s => s !== slug).slice(0, 4);
    const isSession = slug === 'landing-page-grand-session';
    const isPrivate = false;
    const teacherData = TEACHERS[c.teacher] || {};
    const teacherImg = teacherData.img || '';
    return {
      cat: c.cat, title: c.title, lead: c.lead, price: c.price, days: c.days, time: c.time, live: c.live, dur: c.dur, img: c.img,
      teacher: c.teacher, teacherRole: teacherData.role, teacherBio: teacherData.bio,
      hasTeacherImg: !!teacherImg,
      noTeacherImg: !teacherImg,
      teacherImg: teacherImg,
      priceNote: c.priceNote || 'one payment',
      enrolLabel: 'Enroll — ' + c.price,
      barMeta: c.live + ' · ' + c.dur,
      modulesHeading: c.modules.length + (c.modules.length === 1 ? ' module, start to finish.' : ' modules, in order.'),
      showBar: this.state.pastHero,
      barSpace: this.state.pastHero ? '92px' : '0px',
      showEnrollModal: this.state.showEnrollModal,
      enrolled: this.state.enrolled,
      notEnrolled: !this.state.enrolled,
      studentName: this.state.studentName,
      studentEmail: this.state.studentEmail,
      studentPhone: this.state.studentPhone,
      paymentMethod: this.state.paymentMethod,
      openEnrollModal: () => this.setState({ showEnrollModal: true, enrolled: false }),
      closeEnrollModal: () => this.setState({ showEnrollModal: false }),
      submitEnroll: (e) => {
        if (e && e.preventDefault) e.preventDefault();
        const formEl = document.getElementById('enrollFormEl');
        const formFd = formEl ? new FormData(formEl) : new FormData();

        const nameVal = formFd.get('name') || this.state.studentName || 'Student';
        const emailVal = formFd.get('email') || this.state.studentEmail || '';
        const phoneVal = formFd.get('phone') || this.state.studentPhone || '';
        const payVal = formFd.get('payment_option') || this.state.paymentMethod || 'Bank Transfer';

        const fd = new FormData();
        fd.append('form_type', 'course');
        fd.append('name', nameVal);
        fd.append('email', emailVal);
        fd.append('phone', phoneVal);
        fd.append('course', c.title);
        fd.append('budget', c.price);
        fd.append('payment_option', payVal);
        fd.append('message', 'Course Enrollment in ' + c.title + ' (' + c.price + ') | Preferred Payment: ' + payVal);

        fetch('/mail-handler.php', { method: 'POST', body: fd })
          .then(res => res.json())
          .then(data => console.log('Enroll result:', data))
          .catch(err => console.error('Enroll error:', err));

        this.setState({ enrolled: true, studentName: nameVal, studentEmail: emailVal });
      },
      updateName: (e) => this.setState({ studentName: e.target.value }),
      updateEmail: (e) => this.setState({ studentEmail: e.target.value }),
      updatePhone: (e) => this.setState({ studentPhone: e.target.value }),
      updatePayment: (e) => this.setState({ paymentMethod: e.target.value }),
      outcomes: c.outcomes.map((text, i) => ({ n: '0' + (i + 1), text })),
      modules: c.modules.map((m, i) => ({
        n: '0' + (i + 1), title: m.title, meta: m.meta, lessons: m.lessons,
        rows: om === i ? '1fr' : '0fr',
        deg: om === i ? '45deg' : '0deg',
        toggle: () => this.setState(s => ({ openModule: s.openModule === i ? -1 : i }))
      })),
      includes: [
        isSession ? 'One live two-hour Zoom session with ' + c.teacher : (isPrivate ? '22 private one-to-one classes on Zoom' : c.live + ' on Zoom with ' + c.teacher),
        isSession ? 'The working file from the session' : 'Recordings of every class, yours to keep',
        isPrivate ? 'Your trade journal reviewed weekly' : 'Templates, checklists, and worked examples',
        'Questions answered live in class',
        'WhatsApp group for your batch'
      ],
      related: others.map(s => ({ title: COURSES[s].title, price: COURSES[s].price, href: 'courses/' + s })),
      reviews: REVIEWS[c.set] || REVIEWS.web,
      faqs: [
        { q: 'Is this beginner friendly?', a: 'Yes. ' + c.title + ' starts from zero and assumes no prior experience. If you already know the basics, the later classes still go deeper than most paid courses.' },
        { q: 'What if I miss a class?', a: 'The recording is uploaded the same night and stays yours. You can also ask your question in the next live class — nothing is left unanswered.' },
        { q: 'What do the classes need from me?', a: isSession ? 'Two hours, a laptop, and your offer or product details ready before we start.' : 'One hour a night, Monday to Friday, on Zoom — plus about an hour of practice on your own. Weekends are off.' },
        { q: 'How do I pay and confirm my seat?', a: 'Fill in the enrollment form above or message me from the contact page and I will send the payment details and the next batch date. Your seat is confirmed once payment is received; fees are in ' + (c.price.charAt(0) === '$' ? 'US dollars for this programme' : 'Pakistani rupees') + '.' }
      ].map((q, i) => ({
        q: q.q, a: q.a,
        rows: of === i ? '1fr' : '0fr',
        deg: of === i ? '45deg' : '0deg',
        toggle: () => this.setState(s => ({ openFaq: s.openFaq === i ? -1 : i }))
      }))
    };
  }
}

</script>
</body>
</html>
