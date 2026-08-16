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
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <header data-screen-label="Page head" style="padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(36px,4vw,52px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(400px,100%),1fr));gap:clamp(28px,4vw,64px);align-items:end">
      <div>
        <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">FAQ</span>
        <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(38px,5.6vw,74px);line-height:1.03;letter-spacing:-0.025em;text-wrap:balance">The honest answers.</h1>
      </div>
      <p style="margin:0;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.66);max-width:440px;text-wrap:pretty">Including the ones that talk you out of buying. If your question isn't here, ask me — it probably belongs on this page.</p>
    </div>
  </header>

  <section data-screen-label="FAQ groups" style="padding:clamp(24px,3vw,40px) clamp(20px,5vw,64px) clamp(64px,8vw,110px)">
    <div style="max-width:1360px;margin:0 auto;display:flex;flex-direction:column;gap:clamp(44px,5vw,72px)">
      <sc-for list="{{ groups }}" as="g" hint-placeholder-count="3">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(280px,100%),1fr));gap:clamp(24px,4vw,64px);align-items:start">
          <div data-reveal="">
            <h2 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,40px);line-height:1.08;letter-spacing:-0.02em">{{ g.title }}</h2>
            <p style="margin:14px 0 0;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.6);max-width:340px;text-wrap:pretty">{{ g.blurb }}</p>
          </div>
          <div style="display:flex;flex-direction:column">
            <sc-for list="{{ g.items }}" as="q" hint-placeholder-count="4">
              <div data-reveal="" style="border-top:1px solid #E2D9C9">
                <button type="button" onClick="{{ q.toggle }}" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:18px;background:transparent;border:0;padding:22px 2px;cursor:pointer;text-align:left;font-family:inherit">
                  <span style="font-size:17.5px;font-weight:600;line-height:1.4;color:#1E1B17">{{ q.q }}</span>
                  <span style="flex:0 0 auto;width:28px;height:28px;border-radius:999px;border:1px solid #E2D9C9;display:flex;align-items:center;justify-content:center;transform:rotate({{ q.deg }});transition:transform 340ms cubic-bezier(0.22,1,0.36,1);color:#8A5A34;font-size:16px;line-height:1">+</span>
                </button>
                <div style="display:grid;grid-template-rows:{{ q.rows }};transition:grid-template-rows 340ms cubic-bezier(0.22,1,0.36,1)">
                  <div style="overflow:hidden">
                    <p style="margin:0;padding:0 2px 24px;font-size:16px;line-height:1.68;color:rgba(30,27,23,0.68);max-width:620px;text-wrap:pretty">{{ q.a }}</p>
                  </div>
                </div>
              </div>
            </sc-for>
            <div style="border-top:1px solid #E2D9C9"></div>
          </div>
        </div>
      </sc-for>
    </div>
  </section>

  <!-- CREATIVE STILL DECIDING SECTION -->
  <section data-screen-label="FAQ CTA" style="background:#1E1B17;color:#FAF7F2;padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px);position:relative;overflow:hidden">
    <div style="max-width:1360px;margin:0 auto">
      <div style="background:rgba(250,247,242,0.04);border:1px solid rgba(250,247,242,0.14);border-radius:24px;padding:clamp(32px,4.5vw,56px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(32px,4vw,64px);align-items:center">
        
        <div>
          <div data-reveal="" style="display:flex;align-items:center;gap:12px">
            <img src="Media/Instructors/sania.jpg" alt="Sania Maqsood" style="width:44px;height:44px;border-radius:999px;object-fit:cover;border:1.5px solid #D9A879;display:block" />
            <div>
              <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#D9A879">Direct Guidance</span>
              <span style="font-size:14px;color:rgba(250,247,242,0.65)">From Sania Maqsood</span>
            </div>
          </div>

          <h2 data-reveal="" style="margin:20px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4.2vw,54px);line-height:1.04;letter-spacing:-0.025em;text-wrap:balance">
            Still deciding? Ask me the awkward question.
          </h2>

          <p data-reveal="" style="margin:16px 0 0;font-size:16.5px;line-height:1.65;color:rgba(250,247,242,0.72);max-width:520px;text-wrap:pretty">
            Not sure if your niche works? Wondering if you need a course or a 1:1 audit first? Ask without fear of a sales pitch. I read every question myself and give an honest answer — even when it means "don't buy anything yet".
          </p>

          <div data-reveal="" style="margin-top:24px;display:flex;align-items:center;gap:10px;font-size:13.5px;color:rgba(250,247,242,0.6)">
            <span style="width:7px;height:7px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>
            Replies within 12–24 hours · No automated responses
          </div>
        </div>

        <!-- ACTION CARDS -->
        <div data-reveal="" style="display:flex;flex-direction:column;gap:16px">
          
          <a href="/contact" style="text-decoration:none;background:#FAF7F2;color:#1E1B17;border-radius:18px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;gap:16px;transition:background 200ms ease,box-shadow 200ms ease" style-hover="background:#EDE4D3;box-shadow:0 10px 28px rgba(0,0,0,0.25)">
            <div>
              <span style="display:block;font-size:12px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#8A5A34">Option 01</span>
              <div style="margin-top:4px;font-family:'Newsreader',Georgia,serif;font-size:22px;font-weight:400;color:#1E1B17">Send an awkward question</div>
              <div style="margin-top:3px;font-size:14px;color:rgba(30,27,23,0.6)">Free email advice directly from Sania</div>
            </div>
            <span style="font-size:20px;color:#8A5A34;font-weight:700">→</span>
          </a>

          <a href="/consulting" style="text-decoration:none;background:rgba(250,247,242,0.06);border:1px solid rgba(250,247,242,0.18);color:#FAF7F2;border-radius:18px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;gap:16px;transition:border-color 200ms ease,background 200ms ease" style-hover="border-color:#D9A879;background:rgba(217,168,121,0.1)">
            <div>
              <span style="display:block;font-size:12px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#D9A879">Option 02</span>
              <div style="margin-top:4px;font-family:'Newsreader',Georgia,serif;font-size:22px;font-weight:400;color:#FAF7F2">Book a 1:1 Strategy Session</div>
              <div style="margin-top:3px;font-size:14px;color:rgba(250,247,242,0.6)">Pre-audited 30-min call + 30-day written plan · PKR 1,000</div>
            </div>
            <span style="font-size:20px;color:#D9A879;font-weight:700">→</span>
          </a>

        </div>

      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
const GROUPS = [
  {
    title: 'Courses', blurb: 'Access, level, and what happens after you buy.',
    items: [
      { q: 'Are the courses beginner-friendly?', a: 'Yes. Every course starts at zero and assumes no audience. Advanced modules are marked so you can skip them and come back once the basics are earning.' },
      { q: 'What time are the classes, and what if I miss one?', a: 'Every class is live on Zoom at 9 PM PKT for one hour, Monday to Friday — weekends off. Miss one and the recording is up the same night; recordings stay yours, and you can rejoin a live batch once for free.' },
      { q: 'How do fees and payment work?', a: 'Courses are one payment, from PKR 2,000 for the grand session up to PKR 15,000 for the longest programmes; Forex and Binary Trading are $200 each. Message me and I will send the payment details and the next batch date.' },
      { q: 'Who teaches which course?', a: 'Sania Maqsood teaches the Pinterest, affiliate and content programmes. M. Saqib teaches website design and development, WordPress, landing pages, SEO, graphics, Shopify and the Meta & Google Ads course. Aqib teaches Forex and Binary Trading. Every course is taught live by the person who does that work.' },
      { q: 'Do you offer certificates?', a: 'No. Nobody has ever hired a creator for a certificate. The portfolio the course helps you build is the credential.' }
    ]
  },
  {
    title: '1:1 sessions', blurb: 'What the call is, and what it is not.',
    items: [
      { q: 'What actually happens in a session?', a: 'You send links and numbers in advance. I audit them and arrive with a shortlist of changes. We spend 30 minutes deciding, and you get a written 30-day plan within 48 hours.' },
      { q: 'Why are there so few slots?', a: 'Because the audit before each session takes two to three hours of my time. Eight a month is what I can do without the quality dropping.' },
      { q: 'Can you just run my accounts instead?', a: 'No — I teach, I do not manage. If you need someone hands-on I am happy to point you at two people I trust.' },
      { q: 'Do you do group coaching?', a: 'Not currently. When the same question comes up in five sessions it becomes a course module instead.' }
    ]
  },
  {
    title: 'Money & policies', blurb: 'Refunds, guarantees, and the fine print in plain words.',
    items: [
      { q: 'What is the refund policy?', a: '14 days on every course, no questions asked. Sessions can be rescheduled once with 48 hours notice, and refunded in full any time before the audit begins.' },
      { q: 'Do you guarantee results?', a: 'No, and be wary of anyone who does. I guarantee the system is the one I use, taught in full, with nothing important hidden behind an upsell.' },
      { q: 'How do you handle affiliate disclosure?', a: 'Anything I earn from is labelled, on this site and inside the courses. The offer-selection material teaches you to do the same, because trust is the asset.' },
      { q: 'Where does my data go?', a: 'Form submissions come to my inbox. The newsletter is a single list you can leave in one click. Nothing is sold or shared — the full detail is in the privacy policy.' }
    ]
  }
];

class Component extends DCLogic {
  state = { open: '0-0' };

  componentDidMount() {
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  renderVals() {
    const open = this.state.open;
    return {
      groups: GROUPS.map((g, gi) => ({
        title: g.title, blurb: g.blurb,
        items: g.items.map((q, qi) => {
          const key = gi + '-' + qi;
          return {
            q: q.q, a: q.a,
            rows: open === key ? '1fr' : '0fr',
            deg: open === key ? '45deg' : '0deg',
            toggle: () => this.setState(s => ({ open: s.open === key ? '' : key }))
          };
        })
      }))
    };
  }
}
</script>
</body>
</html>
