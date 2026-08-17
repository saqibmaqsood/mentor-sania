<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>x-dc{display:none!important}.sc-placeholder{display:none!important}</style>
<script src="/support.js?v=20260816_2"></script>
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
  @media (max-width: 768px) {
    .about-stats-grid {
      grid-template-columns: 1fr 1fr !important;
      gap: 18px 14px !important;
      padding: 18px 16px !important;
      border-radius: 16px !important;
      margin-top: 32px !important;
    }
    .about-stat-card {
      border-left: none !important;
      padding-left: 0 !important;
      display: flex !important;
      flex-direction: column !important;
      gap: 5px !important;
    }
    .about-stat-card .stat-num {
      font-size: 28px !important;
      line-height: 1 !important;
    }
    .about-stat-card .stat-title {
      font-size: 13.5px !important;
      line-height: 1.25 !important;
    }
    .about-stat-card .stat-desc {
      font-size: 12px !important;
      line-height: 1.45 !important;
    }
  }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <!-- REDESIGNED HERO SECTION -->
  <header data-screen-label="About hero" style="padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(48px,6vw,80px);border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:inline-flex;align-items:center;gap:10px;border:1px solid #D9CDB6;border-radius:999px;padding:7px 16px;font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#8A5A34;background:#EDE4D3">
        About Sania Maqsood
      </div>
      
      <h1 data-reveal="" style="margin:22px 0 0;max-width:1100px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(38px,6vw,84px);line-height:1.02;letter-spacing:-0.025em;text-wrap:balance">
        I built the income system first. The audience came looking for it.
      </h1>

      <div style="margin-top:clamp(36px,4.5vw,56px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(28px,4vw,64px);align-items:start">
        <p data-reveal="" style="margin:0;font-size:clamp(18px,1.4vw,22px);line-height:1.55;color:#1E1B17;font-weight:500;text-wrap:pretty">
          Six years ago I was writing product roundups nobody read. Today Pinterest sends my content to millions of people a month, and the systems behind it earn whether or not I post. Everything I teach is the boring, repeatable part of that — never the highlight reel.
        </p>
        <div data-reveal="" style="display:flex;flex-direction:column;gap:16px">
          <p style="margin:0;font-size:16.5px;line-height:1.68;color:rgba(30,27,23,0.72);text-wrap:pretty">
            I don't teach theory from slide decks or recycled threads. Every framework, keyword formula, and board structure taught in my live batches is the exact engine running my daily affiliate and digital properties in Pakistan and global markets.
          </p>
          <div style="display:flex;flex-wrap:wrap;align-items:center;gap:12px 20px;padding-top:8px">
            <span style="font-size:13.5px;font-weight:700;color:#4C7A5E;display:flex;align-items:center;gap:8px"><span style="width:6px;height:6px;border-radius:999px;background:#4C7A5E"></span>100% Live Zoom Batches</span>
            <span style="font-size:13.5px;font-weight:700;color:#8A5A34;display:flex;align-items:center;gap:8px"><span style="width:6px;height:6px;border-radius:999px;background:#8A5A34"></span>Updated Every Quarter</span>
          </div>
        </div>
      </div>

      <!-- HIGHLIGHT STATS BAR -->
      <div class="about-stats-grid" data-reveal="" style="margin-top:clamp(40px,5vw,64px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(220px,100%),1fr));gap:16px;background:#FFFDFA;border:1px solid #E2D9C9;border-radius:20px;padding:clamp(24px,3vw,36px)">
        <div class="about-stat-card" style="display:flex;flex-direction:column;gap:6px">
          <span class="stat-num" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(34px,3.8vw,48px);line-height:1;color:#B5794A">500+</span>
          <span class="stat-title" style="font-size:14.5px;font-weight:600;color:#1E1B17">Students taught live</span>
          <span class="stat-desc" style="font-size:13px;color:rgba(30,27,23,0.55)">Interactive batches across Zoom</span>
        </div>
        <div class="about-stat-card" style="display:flex;flex-direction:column;gap:6px;border-left:1px solid #EDE4D3;padding-left:clamp(0px,2vw,24px)">
          <span class="stat-num" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(34px,3.8vw,48px);line-height:1;color:#B5794A">6+ Years</span>
          <span class="stat-title" style="font-size:14.5px;font-weight:600;color:#1E1B17">In affiliate & search</span>
          <span class="stat-desc" style="font-size:13px;color:rgba(30,27,23,0.55)">Testing algorithms & intent</span>
        </div>
        <div class="about-stat-card" style="display:flex;flex-direction:column;gap:6px;border-left:1px solid #EDE4D3;padding-left:clamp(0px,2vw,24px)">
          <span class="stat-num" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(34px,3.8vw,48px);line-height:1;color:#B5794A">4.9 ★</span>
          <span class="stat-title" style="font-size:14.5px;font-weight:600;color:#1E1B17">Verified student rating</span>
          <span class="stat-desc" style="font-size:13px;color:rgba(30,27,23,0.55)">From 140+ documented reviews</span>
        </div>
        <div class="about-stat-card" style="display:flex;flex-direction:column;gap:6px;border-left:1px solid #EDE4D3;padding-left:clamp(0px,2vw,24px)">
          <span class="stat-num" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(34px,3.8vw,48px);line-height:1;color:#4C7A5E">Zero</span>
          <span class="stat-title" style="font-size:14.5px;font-weight:600;color:#1E1B17">Fake revenue promises</span>
          <span class="stat-desc" style="font-size:13px;color:rgba(30,27,23,0.55)">Only repeatable, honest systems</span>
        </div>
      </div>
    </div>
  </header>

  <!-- REDESIGNED EDITORIAL STORY CHAPTERS (CLEAN TYPOGRAPHY GRID) -->
  <section data-screen-label="Story" style="padding:clamp(64px,8vw,112px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;flex-direction:column;gap:12px">
        <span data-reveal="" style="font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">The Journey</span>
        <h2 data-reveal="" style="margin:0;max-width:720px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(32px,4.5vw,56px);line-height:1.05;letter-spacing:-0.02em">
          How the system was built, tested, and refined.
        </h2>
      </div>

      <div style="margin-top:clamp(40px,5vw,64px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(460px,100%),1fr));gap:28px">
        <sc-for list="{{ chapters }}" as="ch" hint-placeholder-count="4">
          <article data-reveal="" style="background:#FFFDFA;border:1px solid #E2D9C9;border-radius:20px;padding:clamp(28px,3.4vw,42px);display:flex;flex-direction:column;gap:20px;transition:border-color 220ms ease,box-shadow 220ms ease" style-hover="border-color:#B5794A;box-shadow:0 12px 32px rgba(30,27,23,0.06)">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;padding-bottom:18px;border-bottom:1px solid #EDE4D3">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:32px;line-height:1;color:#B5794A">{{ ch.num }}</span>
              <span style="font-size:11.5px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#8A5A34;background:#EDE4D3;padding:5px 12px;border-radius:999px">{{ ch.eyebrow }}</span>
            </div>

            <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(23px,2.4vw,30px);line-height:1.15;letter-spacing:-0.015em;text-wrap:pretty;color:#1E1B17">
              {{ ch.title }}
            </h3>

            <p style="margin:0;font-size:16px;line-height:1.66;color:rgba(30,27,23,0.72);text-wrap:pretty">
              {{ ch.body }}
            </p>

            <p style="margin:0;font-size:16px;line-height:1.66;color:rgba(30,27,23,0.72);text-wrap:pretty">
              {{ ch.body2 }}
            </p>
          </article>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- THE SHORT VERSION (PRESERVED) -->
  <section data-screen-label="Timeline" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <h2 data-reveal="" style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,48px);line-height:1.06;letter-spacing:-0.02em">The short version.</h2>
      <div style="margin-top:clamp(34px,4vw,56px);position:relative">
        <div style="position:absolute;left:0;right:0;top:9px;height:1px;background:#D9CDB6"></div>
        <div data-progress-line="" style="position:absolute;left:0;top:9px;height:1px;width:0%;background:#B5794A"></div>
        <div style="position:relative;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(190px,100%),1fr));gap:32px 24px">
          <sc-for list="{{ milestones }}" as="m" hint-placeholder-count="5">
            <div data-reveal="">
              <div style="width:19px;height:19px;border-radius:999px;border:1px solid #C9BCA6;background:#EDE4D3;display:flex;align-items:center;justify-content:center">
                <span style="width:7px;height:7px;border-radius:999px;background:#B5794A;display:block"></span>
              </div>
              <div style="margin-top:18px;font-family:'Newsreader',Georgia,serif;font-size:24px;line-height:1.1">{{ m.year }}</div>
              <div style="margin-top:8px;font-size:14.5px;line-height:1.6;color:rgba(30,27,23,0.64);max-width:230px;text-wrap:pretty">{{ m.text }}</div>
            </div>
          </sc-for>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW I TEACH (PRESERVED) -->
  <section data-screen-label="Principles" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(30px,5vw,72px);align-items:start">
      <div>
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">How I teach</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.8vw,50px);line-height:1.05;letter-spacing:-0.02em">Three rules I don't break.</h2>
        <p data-reveal="" style="margin:20px 0 0;max-width:440px;font-size:16.5px;line-height:1.65;color:rgba(30,27,23,0.68);text-wrap:pretty">
          Every programme is designed around transparency and practical execution. I teach the exact systems I operate daily — with complete workflows, zero hidden upsells, and lessons built to survive platform changes.
        </p>
      </div>
      <div style="display:flex;flex-direction:column;gap:2px">
        <sc-for list="{{ principles }}" as="p" hint-placeholder-count="3">
          <div data-reveal="" style="padding:24px 0;border-bottom:1px solid #E2D9C9">
            <div style="font-size:19px;font-weight:600;letter-spacing:-0.01em">{{ p.title }}</div>
            <div style="margin-top:9px;font-size:16.5px;line-height:1.65;color:rgba(30,27,23,0.66);max-width:560px;text-wrap:pretty">{{ p.body }}</div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- CREATIVE TWO-PATHWAY CTA SECTION -->
  <section data-screen-label="About CTA" style="background:#1E1B17;color:#FAF7F2;padding:clamp(72px,9vw,128px) clamp(20px,5vw,64px);position:relative;overflow:hidden">
    <div style="max-width:1360px;margin:0 auto;position:relative;z-index:1">
      <div style="text-align:center;max-width:760px;margin:0 auto">
        <span data-reveal="" style="display:inline-block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#D9A879;background:rgba(250,247,242,0.08);border:1px solid rgba(250,247,242,0.14);padding:6px 16px;border-radius:999px">Choose Your Pathway</span>
        <h2 data-reveal="" style="margin:20px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(34px,5.2vw,66px);line-height:1.04;letter-spacing:-0.025em;text-wrap:balance">Want the shortcut, or the whole system?</h2>
        <p data-reveal="" style="margin:18px auto 0;font-size:clamp(16px,1.2vw,18px);line-height:1.65;color:rgba(250,247,242,0.72);max-width:560px;text-wrap:pretty">Two distinct ways to work together — whether you need an immediate diagnosis on a stuck bottleneck, or complete step-by-step masterclasses.</p>
      </div>

      <div style="margin-top:clamp(44px,5.5vw,72px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:28px">
        
        <!-- PATHWAY 1: THE SHORTCUT -->
        <div data-reveal="" style="background:rgba(250,247,242,0.04);border:1px solid rgba(217,168,121,0.35);border-radius:24px;padding:clamp(32px,3.8vw,48px);display:flex;flex-direction:column;gap:24px;position:relative;transition:border-color 240ms ease,background 240ms ease" style-hover="background:rgba(250,247,242,0.07);border-color:#D9A879">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#D9A879;background:rgba(217,168,121,0.15);padding:5px 12px;border-radius:999px">Fastest Route · 1:1 Focus</span>
            <span style="font-size:14px;font-weight:700;color:#4C7A5E;display:flex;align-items:center;gap:6px"><span style="width:6px;height:6px;border-radius:999px;background:#4C7A5E"></span>4 Slots Left</span>
          </div>

          <div>
            <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(250,247,242,0.5)">Option 01</span>
            <h3 style="margin:8px 0 0;font-family:'Newsreader',Georgia,serif;font-size:clamp(26px,2.8vw,36px);line-height:1.1;font-weight:400;color:#FAF7F2">The 1:1 Strategy Session</h3>
            <p style="margin:12px 0 0;font-size:15.5px;line-height:1.6;color:rgba(250,247,242,0.68);text-wrap:pretty">One hour dedicated entirely to your numbers. I audit your links, accounts, and offers beforehand so the call starts with decisions, not introductions.</p>
          </div>

          <div style="display:flex;flex-direction:column;gap:12px;padding:18px 0;border-top:1px solid rgba(250,247,242,0.12);border-bottom:1px solid rgba(250,247,242,0.12)">
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Pre-session audit of your content and keywords</span></div>
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Written 30-day action plan within 48 hours</span></div>
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Full Zoom recording + 2 weeks follow-up support</span></div>
          </div>

          <div style="margin-top:auto;display:flex;flex-direction:column;gap:16px">
            <div style="display:flex;align-items:baseline;justify-content:space-between">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:30px;line-height:1;color:#FAF7F2">PKR 1,000</span>
              <span style="font-size:13.5px;color:rgba(250,247,242,0.5)">Single 30-min block</span>
            </div>
            <a href="/consulting" style="display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:600;color:#1E1B17;background:#FAF7F2;text-decoration:none;padding:16px 28px;border-radius:999px;transition:background 200ms ease,box-shadow 200ms ease" style-hover="background:#EDE4D3;box-shadow:0 8px 24px rgba(0,0,0,0.3)">Book a 1:1 Session →</a>
          </div>
        </div>

        <!-- PATHWAY 2: THE WHOLE SYSTEM -->
        <div data-reveal="" style="background:rgba(250,247,242,0.04);border:1px solid rgba(250,247,242,0.16);border-radius:24px;padding:clamp(32px,3.8vw,48px);display:flex;flex-direction:column;gap:24px;position:relative;transition:border-color 240ms ease,background 240ms ease" style-hover="background:rgba(250,247,242,0.07);border-color:rgba(250,247,242,0.35)">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#FAF7F2;background:rgba(250,247,242,0.12);padding:5px 12px;border-radius:999px">Comprehensive · Complete Build</span>
            <span style="font-size:14px;color:rgba(250,247,242,0.6)">17 Live Courses</span>
          </div>

          <div>
            <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(250,247,242,0.5)">Option 02</span>
            <h3 style="margin:8px 0 0;font-family:'Newsreader',Georgia,serif;font-size:clamp(26px,2.8vw,36px);line-height:1.1;font-weight:400;color:#FAF7F2">Live Batch Programmes</h3>
            <p style="margin:12px 0 0;font-size:15.5px;line-height:1.6;color:rgba(250,247,242,0.68);text-wrap:pretty">Master the whole process from blank canvas to revenue. Live evening classes on Zoom with actual practitioners who do the work every day.</p>
          </div>

          <div style="display:flex;flex-direction:column;gap:12px;padding:18px 0;border-top:1px solid rgba(250,247,242,0.12);border-bottom:1px solid rgba(250,247,242,0.12)">
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Pinterest, Web, SEO, Ecom, Ads & Trading</span></div>
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Mon–Fri at 9 PM PKT · Interactive live Zoom</span></div>
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#D9A879;font-size:15px">✓</span><span style="font-size:15px;color:rgba(250,247,242,0.85)">Lifetime recording access with quarterly updates</span></div>
          </div>

          <div style="margin-top:auto;display:flex;flex-direction:column;gap:16px">
            <div style="display:flex;align-items:baseline;justify-content:space-between">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:30px;line-height:1;color:#FAF7F2">From PKR 2,000</span>
              <span style="font-size:13.5px;color:rgba(250,247,242,0.5)">One-time payment</span>
            </div>
            <a href="/courses" style="display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:600;color:#FAF7F2;background:transparent;border:1px solid rgba(250,247,242,0.3);text-decoration:none;padding:16px 28px;border-radius:999px;transition:border-color 200ms ease,background 200ms ease" style-hover="border-color:#D9A879;background:rgba(217,168,121,0.1)">Explore All 17 Courses →</a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
class Component extends DCLogic {
  componentDidMount() {
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  renderVals() {
    const chapters = [
      {
        num: '01',
        eyebrow: '2019 — The Unread Years',
        title: 'Two hundred posts, four hundred readers.',
        body: 'I did what everyone tells you to do: publish constantly and hope. For eighteen months I wrote product roundups that nobody found, because I was writing for an audience I did not have instead of a search query someone was typing.',
        body2: 'The fix was not more content. It was learning what people actually search for, and accepting that the answer is rarely the thing I most wanted to write about.'
      },
      {
        num: '02',
        eyebrow: '2021 — The First System',
        title: 'Pinterest was a search engine all along.',
        body: 'I stopped treating pins as decoration and started treating them as search results. Keywords first, design second, boards structured like a site map. Traffic moved within six weeks — and, more importantly, it kept moving without me.',
        body2: 'That was the month I earned PKR 60,000 from affiliate links for the first time, from four pieces of content and two offers.'
      },
      {
        num: '03',
        eyebrow: '2023 — Teaching It',
        title: 'The first batch broke the course open.',
        body: 'Sixty students in the first live run of the Pinterest Engine, and about a thousand questions I had not anticipated. Every one of them made the material better and the promises smaller.',
        body2: 'It is where the teaching style came from: show the whole system, mark what is advanced, and never hide the important part behind an upsell.'
      },
      {
        num: '04',
        eyebrow: 'Now — Scale & Direct Work',
        title: '500+ students, and eight calls a month.',
        body: 'The courses carry the systems. The 1:1 sessions are where I do my sharpest work — one creator, one bottleneck, thirty minutes and a plan. I keep them limited because the audit before each one takes hours.',
        body2: 'If you are deciding between the two: courses if you need the whole build, a session if you need to know which part is broken.'
      }
    ];

    return {
      chapters,
      milestones: [
        { year: '2019', text: 'Started writing product roundups nobody read. Learned SEO out of frustration.' },
        { year: '2021', text: 'First PKR 60K affiliate month — entirely from Pinterest search traffic.' },
        { year: '2022', text: 'Quit the day job. Full-time income from four content properties.' },
        { year: '2023', text: 'First live batch of the Pinterest Engine: 60 students.' },
        { year: '2026', text: '500+ students taught, live on Zoom, and 1:1 work with creators scaling past their first PKR 100K months.' }
      ],
      principles: [
        { title: 'Show the whole system, including the boring parts', body: 'The keyword spreadsheet is less exciting than the revenue screenshot, and it is the reason the screenshot exists. Nothing important sits behind an upsell.' },
        { title: 'No guarantees, ever', body: 'I can guarantee the method is the one I use and that it is taught in full. Anyone promising you a number is selling you something else.' },
        { title: 'Teach it so it survives the platform', body: 'Pinterest will change its algorithm again. The material is built around search intent and offer economics, which do not.' }
      ]
    };
  }
}
</script>
</body>
</html>
