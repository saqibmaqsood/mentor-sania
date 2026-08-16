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
    .consulting-sticky-col {
      position: static !important;
      top: auto !important;
      align-self: auto !important;
    }
  }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <!-- HERO -->
  <header data-screen-label="Consulting hero" style="background:#1E1B17;color:#FAF7F2;padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(64px,8vw,104px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(400px,100%),1fr));gap:clamp(36px,5vw,80px);align-items:center">
      <div>
        <div style="display:inline-flex;align-items:center;gap:10px;border:1px solid rgba(250,247,242,0.2);border-radius:999px;padding:7px 15px 7px 11px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#D9A879">
          <span style="width:6px;height:6px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>
          4 of 8 August slots remaining
        </div>
        <h1 style="margin:22px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(38px,5.8vw,76px);line-height:1.02;letter-spacing:-0.025em;text-wrap:balance">30 minutes that replace six months of guessing.</h1>
        <p style="margin:24px 0 0;max-width:540px;font-size:clamp(16.5px,1.2vw,18.5px);line-height:1.64;color:rgba(250,247,242,0.72);text-wrap:pretty">A single, deeply prepared 1:1 session. You send your links and numbers, I audit them before we meet, and we spend the call deciding what happens next — not catching up.</p>
        <div style="margin-top:34px;display:flex;flex-wrap:wrap;align-items:center;gap:14px 24px">
          <a href="#book" style="font-size:15px;font-weight:600;color:#1E1B17;background:#FAF7F2;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 200ms ease" style-hover="background:#EDE4D3">Request a session — PKR 1,000</a>
          <span style="font-size:14.5px;color:rgba(250,247,242,0.55)">Reply within 24 hours · Zoom · recorded</span>
        </div>
      </div>
      <div style="position:relative">
        <div style="aspect-ratio:4/5;border-radius:16px;border:1px solid rgba(250,247,242,0.18);overflow:hidden;background:#1E1B17;display:flex;align-items:center;justify-content:center">
          <img src="Media/sania-hero-laptop.jpg" alt="Sania Maqsood Working on Laptop" style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block" />
        </div>
      </div>
    </div>
  </header>

  <!-- WHO IT'S FOR -->
  <section data-screen-label="Fit" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(28px,4vw,56px)">
      <div data-reveal="" style="border:1px solid #E2D9C9;border-radius:16px;background:#FFFDFA;padding:clamp(26px,3vw,40px)">
        <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#4C7A5E">This is for you if</span>
        <div style="margin-top:20px;display:flex;flex-direction:column;gap:14px">
          <sc-for list="{{ goodFit }}" as="g" hint-placeholder-count="4">
            <div style="display:grid;grid-template-columns:20px 1fr;gap:13px;align-items:start">
              <span style="color:#4C7A5E;font-size:16px;line-height:1.5">✓</span>
              <span style="font-size:16px;line-height:1.6;color:rgba(30,27,23,0.74);text-wrap:pretty">{{ g }}</span>
            </div>
          </sc-for>
        </div>
      </div>
      <div data-reveal="" style="border:1px solid #E2D9C9;border-radius:16px;background:transparent;padding:clamp(26px,3vw,40px)">
        <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:rgba(30,27,23,0.42)">It's not for you if</span>
        <div style="margin-top:20px;display:flex;flex-direction:column;gap:14px">
          <sc-for list="{{ badFit }}" as="b" hint-placeholder-count="3">
            <div style="display:grid;grid-template-columns:20px 1fr;gap:13px;align-items:start">
              <span style="color:rgba(30,27,23,0.35);font-size:16px;line-height:1.5">—</span>
              <span style="font-size:16px;line-height:1.6;color:rgba(30,27,23,0.6);text-wrap:pretty">{{ b }}</span>
            </div>
          </sc-for>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section data-screen-label="How it works" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <h2 data-reveal="" style="margin:0;max-width:640px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4vw,52px);line-height:1.06;letter-spacing:-0.02em">How it works.</h2>
      <div style="margin-top:clamp(32px,4vw,52px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(260px,100%),1fr));gap:20px">
        <sc-for list="{{ steps }}" as="st" hint-placeholder-count="3">
          <div data-reveal="" style="background:#FAF7F2;border:1px solid #D9CDB6;border-radius:16px;padding:clamp(24px,2.6vw,34px);display:flex;flex-direction:column;gap:12px">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:38px;line-height:0.9;color:#B5794A">{{ st.n }}</span>
            <div style="font-size:18px;font-weight:600;letter-spacing:-0.005em">{{ st.title }}</div>
            <div style="font-size:15.5px;line-height:1.62;color:rgba(30,27,23,0.66);text-wrap:pretty">{{ st.body }}</div>
            <span style="margin-top:6px;font-size:12px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">{{ st.when }}</span>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- WHAT YOU GET -->
  <section data-screen-label="Included" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:clamp(32px,5vw,72px);align-items:start">
      <div class="consulting-sticky-col" style="position:sticky;top:104px">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">What's included</span>
        <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4vw,52px);line-height:1.05;letter-spacing:-0.02em">One session, four deliverables.</h2>
        <p data-reveal="" style="margin:20px 0 0;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.66);max-width:440px;text-wrap:pretty">The call is the middle of the work, not all of it. Most of the value is in the audit before and the plan after.</p>
        <div data-reveal="" style="margin-top:30px;border:1px solid #E2D9C9;border-radius:16px;background:#FFFDFA;padding:clamp(24px,2.6vw,32px)">
          <div style="display:flex;align-items:baseline;gap:12px;flex-wrap:wrap">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(38px,4.2vw,50px);line-height:1">PKR 1,000</span>
            <span style="font-size:15.5px;color:rgba(30,27,23,0.55)">per 30-minute session</span>
          </div>
          <p style="margin:16px 0 0;font-size:14.5px;line-height:1.6;color:rgba(30,27,23,0.55)">Reschedule once with 48 hours notice. Full refund any time before the audit begins.</p>
          <a href="#book" style="display:block;margin-top:22px;text-align:center;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:16px 24px;border-radius:999px;transition:background 200ms ease" style-hover="background:#8A5A34">Request a session</a>
        </div>
      </div>
      <div style="display:flex;flex-direction:column;gap:2px">
        <sc-for list="{{ included }}" as="i" hint-placeholder-count="4">
          <div data-reveal="" style="display:grid;grid-template-columns:30px 1fr;gap:16px;padding:22px 0;border-bottom:1px solid #E2D9C9;align-items:start">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:18px;color:#B5794A;line-height:1.4">{{ i.n }}</span>
            <div>
              <div style="font-size:17.5px;font-weight:600;line-height:1.35">{{ i.title }}</div>
              <div style="margin-top:8px;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.65);text-wrap:pretty">{{ i.body }}</div>
            </div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- PROOF -->
  <section data-screen-label="Consulting proof" style="padding:clamp(56px,7vw,96px) clamp(20px,5vw,64px);background:#1E1B17;color:#FAF7F2">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:20px">
      <sc-for list="{{ quotes }}" as="q" hint-placeholder-count="3">
        <figure data-reveal="" style="margin:0;border:1px solid rgba(250,247,242,0.16);border-radius:16px;padding:clamp(24px,2.6vw,34px);display:flex;flex-direction:column;gap:16px;background:rgba(250,247,242,0.03)">
          <blockquote style="margin:0;font-family:'Newsreader',Georgia,serif;font-size:clamp(20px,2vw,25px);line-height:1.26;text-wrap:pretty">"{{ q.quote }}"</blockquote>
          <div style="margin-top:auto;display:flex;align-items:center;justify-content:space-between;gap:14px;padding-top:16px;border-top:1px solid rgba(250,247,242,0.14)">
            <div>
              <div style="font-size:15px;font-weight:600">{{ q.name }}</div>
              <div style="margin-top:3px;font-size:13.5px;color:rgba(250,247,242,0.55)">{{ q.role }}</div>
            </div>
            <span style="font-size:15px;font-weight:700;color:#D9A879">{{ q.result }}</span>
          </div>
        </figure>
      </sc-for>
    </div>
  </section>

  <dc-import name="BookingForm" price="PKR 1,000" hint-size="100%,860px"></dc-import>

  <!-- CONSULTING FAQ -->
  <section data-screen-label="Consulting FAQ" style="padding:clamp(56px,7vw,100px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:clamp(30px,5vw,72px);align-items:start">
      <div class="consulting-sticky-col" style="position:sticky;top:clamp(90px,10vh,120px);align-self:start">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">Session questions</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em">About the 1:1, specifically.</h2>
        <p data-reveal="" style="margin:14px 0 0;max-width:400px;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.64);text-wrap:pretty">Everything you need to know about preparing your links, the pre-session audit, call scheduling, and post-call action plans.</p>
        <a data-reveal="" href="/faq" style="display:inline-block;margin-top:20px;font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px" style-hover="border-color:#B5794A;color:#8A5A34">General FAQ →</a>
      </div>
      <div style="display:flex;flex-direction:column">
        <sc-for list="{{ faqs }}" as="q" hint-placeholder-count="5">
          <div data-reveal="" style="border-top:1px solid #D9CDB6">
            <button type="button" onClick="{{ q.toggle }}" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:18px;background:transparent;border:0;padding:22px 2px;cursor:pointer;text-align:left;font-family:inherit">
              <span style="font-size:17.5px;font-weight:600;line-height:1.4;color:#1E1B17">{{ q.q }}</span>
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
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
class Component extends DCLogic {
  state = { openFaq: 0 };

  componentDidMount() {
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  renderVals() {
    const open = this.state.openFaq;
    const faqs = [
      { q: 'What do I need to send beforehand?', a: 'Links to your site or profile, read-only analytics access if you have it, the affiliate programs you are in, and one paragraph on what is stuck. Ten minutes of work at most.' },
      { q: 'Can we cover more than one topic?', a: 'We can, but I will push you to rank them. Seventy-five minutes spent well on one bottleneck beats four topics half-covered.' },
      { q: 'Do I get a recording?', a: 'Yes — recording, my audit notes, and a written 30-day plan with priorities in order, all within 48 hours.' },
      { q: 'Is this a sales call for your courses?', a: 'No. If a course would genuinely save you time I will say so, and you get a discount code — but plenty of sessions end with "you do not need to buy anything yet".' },
      { q: 'What if I need ongoing help?', a: 'Some people book a follow-up after 60 days, once the plan has data behind it. There is no retainer and no package — one session at a time.' }
    ].map((q, i) => ({
      q: q.q, a: q.a,
      rows: open === i ? '1fr' : '0fr',
      deg: open === i ? '45deg' : '0deg',
      toggle: () => this.setState(s => ({ openFaq: s.openFaq === i ? -1 : i }))
    }));

    return {
      faqs,
      goodFit: [
        'You are already publishing and something is not converting',
        'You have affiliate offers but no idea which deserve your traffic',
        'Pinterest sends you saves and impressions, but not clicks',
        'You want one honest opinion instead of ten conflicting YouTube videos'
      ],
      badFit: [
        'You want someone to run your accounts for you — I teach, I do not manage',
        'You are looking for a guaranteed income figure',
        'You have not published anything yet — start with a course, it is cheaper'
      ],
      steps: [
        { n: '01', title: 'Book & send context', body: 'Request a slot and share links, numbers, and the thing that is stuck.', when: 'Five minutes of your time' },
        { n: '02', title: 'I audit before we meet', body: 'I go through your content, analytics, and offers and arrive with a shortlist — not questions.', when: '2–3 hours of mine' },
        { n: '03', title: '30 minutes, then a plan', body: 'We decide on the call. The written plan lands within 48 hours.', when: 'Zoom · recorded' }
      ],
      included: [
        { n: '01', title: 'Pre-session audit', body: 'A proper look at your content, keywords, analytics, and offer mix before we speak — so the call starts at the real problem.' },
        { n: '02', title: 'The 30-minute session', body: 'Screen-shared, recorded, and structured around decisions. You will leave knowing what to stop doing as clearly as what to start.' },
        { n: '03', title: 'A written 30-day plan', body: 'Priorities in order, with the expected outcome of each, delivered within 48 hours. Short enough to actually follow.' },
        { n: '04', title: 'Two weeks of follow-up', body: 'One round of questions by email as you implement, so you are not stuck on step three for a month.' }
      ],
      quotes: [
        { quote: 'She told me to delete two thirds of my offers. Revenue went up the next month.', name: 'Daniel Okoye', role: 'Tech reviewer', result: '+118%' },
        { quote: 'The audit alone was worth it. I had been optimising the wrong page for a year.', name: 'Ayesha Raza', role: 'Recipe site owner', result: '41K sessions' },
        { quote: 'No fluff, no upsell. A plan I could start on the same evening.', name: 'Marta Kovács', role: 'Travel creator', result: '3 hrs/wk saved' }
      ]
    };
  }
}
</script>
</body>
</html>
