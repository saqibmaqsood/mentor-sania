<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="./support.js"></script>
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
  .om-scroller { scrollbar-width: none; }
  .om-scroller::-webkit-scrollbar { display: none; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <header data-screen-label="Page head" style="padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(32px,4vw,48px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(400px,100%),1fr));gap:clamp(28px,4vw,64px);align-items:end">
      <div>
        <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Resources</span>
        <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(38px,5.6vw,74px);line-height:1.03;letter-spacing:-0.025em;text-wrap:balance">Everything I'd tell a friend, free.</h1>
      </div>
      <p style="margin:0;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.66);max-width:440px;text-wrap:pretty">Teardowns, templates, and the occasional opinion. No gated fluff — the downloads ask for an email, the writing doesn't.</p>
    </div>
  </header>

  <div style="position:sticky;top:74px;z-index:600;background:rgba(250,247,242,0.94);backdrop-filter:saturate(180%) blur(12px);border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div class="om-scroller" style="max-width:1360px;margin:0 auto;padding:14px clamp(20px,5vw,64px);display:flex;gap:9px;overflow-x:auto">
      <sc-for list="{{ filters }}" as="fl" hint-placeholder-count="5">
        <button type="button" onClick="{{ fl.pick }}" style="flex:0 0 auto;font-family:inherit;font-size:13.5px;font-weight:600;color:{{ fl.color }};background:{{ fl.bg }};border:1px solid {{ fl.border }};border-radius:999px;padding:10px 18px;min-height:40px;cursor:pointer;white-space:nowrap;transition:background 180ms ease,border-color 180ms ease,color 180ms ease">{{ fl.label }}</button>
      </sc-for>
    </div>
  </div>

  <section data-screen-label="Featured article" style="padding:clamp(36px,4.5vw,60px) clamp(20px,5vw,64px) 0">
    <a data-reveal="" href="resources/why-pins-get-saved-never-clicked" style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(360px,100%),1fr));gap:clamp(24px,3vw,48px);align-items:center;text-decoration:none;color:inherit;border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;overflow:hidden;padding:0" style-hover="box-shadow:0 14px 40px rgba(30,27,23,0.08)">
      <div style="aspect-ratio:16/11;background:#EDE4D3;overflow:hidden">
        <img src="Media/Resources/pins_saved_never_clicked.jpg" alt="Why your pins get saved but never clicked" style="width:100%;height:100%;object-fit:cover;display:block" />
      </div>
      <div style="padding:clamp(24px,3vw,44px) clamp(24px,3vw,44px) clamp(24px,3vw,44px) 0;display:flex;flex-direction:column;gap:14px">
        <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center">
          <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#FAF7F2;background:#1E1B17;padding:6px 11px;border-radius:999px">Latest</span>
          <span style="font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.45)">Pinterest · 9 min read</span>
        </div>
        <h2 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,42px);line-height:1.1;letter-spacing:-0.02em;text-wrap:balance">Why your pins get saved but never clicked</h2>
        <p style="margin:0;font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.66);max-width:520px;text-wrap:pretty">Saves are a bookmarking habit. Clicks are a promise being kept. A teardown of six pins that got both wrong, and the three-word fix in each title.</p>
        <span style="margin-top:6px;font-size:15px;font-weight:600;color:#8A5A34">Read the teardown →</span>
      </div>
    </a>
  </section>

  <section data-screen-label="Article grid" style="padding:clamp(32px,4vw,52px) clamp(20px,5vw,64px) clamp(60px,7vw,96px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;align-items:baseline;justify-content:space-between;gap:20px;flex-wrap:wrap">
        <span style="font-size:13.5px;color:rgba(30,27,23,0.5)">{{ countLabel }}</span>
        <span style="font-size:13.5px;color:rgba(30,27,23,0.5)">Newest first</span>
      </div>
      <div style="margin-top:26px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:22px">
        <sc-for list="{{ visible }}" as="r" hint-placeholder-count="6">
          <a data-tilt="" href="{{ r.href }}" style="display:flex;flex-direction:column;text-decoration:none;color:inherit;border:1px solid #E2D9C9;border-radius:16px;overflow:hidden;background:#FFFDFA;transition:box-shadow 240ms ease">
            <div style="aspect-ratio:16/10;background:#EDE4D3;overflow:hidden">
              <img src="{{ r.img }}" alt="{{ r.title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
            </div>
            <div style="padding:clamp(22px,2.4vw,28px);display:flex;flex-direction:column;gap:12px;flex:1">
              <div style="display:flex;flex-wrap:wrap;gap:12px;align-items:center">
                <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#B5794A">{{ r.cat }}</span>
                <span style="font-size:12.5px;color:rgba(30,27,23,0.45)">{{ r.read }}</span>
              </div>
              <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:22px;line-height:1.18">{{ r.title }}</h3>
              <p style="margin:0;font-size:15px;line-height:1.6;color:rgba(30,27,23,0.64);text-wrap:pretty">{{ r.desc }}</p>
              <span style="margin-top:auto;font-size:14px;font-weight:600;color:#8A5A34">{{ r.cta }} →</span>
            </div>
          </a>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- CREATIVE NEWSLETTER SECTION -->
  <section data-screen-label="Newsletter" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9">
    <div style="max-width:1180px;margin:0 auto;background:#FAF7F2;border:1px solid #D9CDB6;border-radius:24px;padding:clamp(32px,4vw,56px);box-shadow:0 12px 36px rgba(30,27,23,0.06)">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(32px,4vw,64px);align-items:center">
        
        <div>
          <span data-reveal="" style="display:inline-block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34;background:#EDE4D3;padding:5px 14px;border-radius:999px">Free Weekly Letter · The Sunday Note</span>
          <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,46px);line-height:1.06;letter-spacing:-0.02em;text-wrap:balance">Get these as they're written.</h2>
          <p data-reveal="" style="margin:14px 0 0;max-width:480px;font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.68);text-wrap:pretty">One actionable tactic and one honest teardown every Sunday morning. No recycled threads, no swipe files — real numbers and workflows you can implement before Wednesday.</p>
          
          <div data-reveal="" style="margin-top:24px;display:flex;flex-direction:column;gap:10px">
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#B5794A;font-size:14px">✓</span><span style="font-size:14.5px;color:rgba(30,27,23,0.78)">Weekly keyword teardowns & Pinterest algorithm changes</span></div>
            <div style="display:flex;align-items:baseline;gap:10px"><span style="color:#B5794A;font-size:14px">✓</span><span style="font-size:14.5px;color:rgba(30,27,23,0.78)">Free downloadable templates, swipe files & calendars</span></div>
          </div>

          <div data-reveal="" style="margin-top:26px;display:flex;align-items:center;gap:12px">
            <div style="display:flex;align-items:center">
              <img src="Media/Avatars/ayesha.jpg" alt="Reader" style="width:32px;height:32px;border-radius:999px;object-fit:cover;border:1.5px solid #FAF7F2;display:inline-block" />
              <img src="Media/Avatars/bilal.jpg" alt="Reader" style="width:32px;height:32px;border-radius:999px;margin-left:-10px;object-fit:cover;border:1.5px solid #FAF7F2;display:inline-block" />
              <img src="Media/Avatars/zainab.jpg" alt="Reader" style="width:32px;height:32px;border-radius:999px;margin-left:-10px;object-fit:cover;border:1.5px solid #FAF7F2;display:inline-block" />
            </div>
            <span style="font-size:13.5px;font-weight:600;color:rgba(30,27,23,0.62)">1,200+ readers · 58% open rate</span>
          </div>
        </div>

        <!-- FORM WITH NAME & EMAIL -->
        <form data-reveal="" action="mail-handler.php" method="post" style="background:#FFFDFA;border:1px solid #E2D9C9;border-radius:18px;padding:clamp(24px,3vw,36px);display:flex;flex-direction:column;gap:14px">
          <div style="display:flex;align-items:baseline;justify-content:space-between;gap:12px;padding-bottom:12px;border-bottom:1px solid #EDE4D3">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:22px;line-height:1.15;color:#1E1B17">Join The Sunday Note</span>
            <span style="font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#4C7A5E">Free</span>
          </div>
          
          <input type="hidden" name="list" value="sunday-note" />
          <input type="text" name="hp_field" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0" />

          <label style="display:flex;flex-direction:column;gap:6px">
            <span style="font-size:12.5px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.55)">Your Name</span>
            <input type="text" name="name" required="required" placeholder="e.g. Sana" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:15px;color:#1E1B17;background:#FAF7F2;border:1px solid #D9CDB6;border-radius:12px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
          </label>

          <label style="display:flex;flex-direction:column;gap:6px">
            <span style="font-size:12.5px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.55)">Your Email</span>
            <input type="email" name="email" required="required" placeholder="you@email.com" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:15px;color:#1E1B17;background:#FAF7F2;border:1px solid #D9CDB6;border-radius:12px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
          </label>

          <button type="submit" style="margin-top:6px;font-family:inherit;font-size:15px;font-weight:600;color:#FAF7F2;background:#1E1B17;border:0;border-radius:999px;padding:15px 28px;min-height:46px;cursor:pointer;transition:background 200ms ease" style-hover="background:#B5794A">Send me the next issue →</button>
          <span style="font-size:12px;line-height:1.5;color:rgba(30,27,23,0.48);text-align:center">No spam, ever. 1-click unsubscribe in every email.</span>
        </form>

      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
const ITEMS = [
  { slug: '30-pin-starter-calendar', cat: 'Pinterest', key: 'Pinterest', title: 'The 30-Pin Starter Calendar', desc: 'A month of pin ideas with keyword slots and posting times. Fill in your niche and publish.', read: 'Template', cta: 'Get the template', img: 'Media/Resources/starter_calendar.jpg' },
  { slug: 'affiliate-offer-audit', cat: 'Affiliate', key: 'Affiliate', title: 'Affiliate Offer Audit', desc: 'Twelve questions that tell you whether an offer deserves your traffic before you promote it.', read: 'Checklist', cta: 'Get the checklist', img: 'Media/Resources/affiliate_audit.jpg' },
  { slug: 'first-1000-clicks', cat: 'Pinterest', key: 'Pinterest', title: 'Your First 1,000 Clicks', desc: 'The exact sequence I use to take a brand-new account from zero to consistent outbound clicks.', read: 'Guide', cta: 'Get the guide', img: 'Media/Resources/first_1000_clicks.jpg' },
  { slug: 'internal-linking-pass', cat: 'SEO', key: 'SEO', title: 'The internal linking pass nobody does', desc: 'Twenty minutes of work that moved a plateaued recipe site from page three to page one.', read: '7 min read', cta: 'Read it', img: 'Media/Resources/internal_linking.jpg' },
  { slug: 'batch-month-content-day', cat: 'Content', key: 'Content', title: 'How I batch a month of content in a day', desc: 'The pipeline, the templates, and the two steps I refuse to batch because quality dies there.', read: '6 min read', cta: 'Read it', img: 'Media/Resources/batch_content.jpg' },
  { slug: 'asking-better-commission-rate', cat: 'Affiliate', key: 'Affiliate', title: 'Asking for a better commission rate', desc: 'The email I send, what data to attach, and how often it actually works (about a third of the time).', read: '5 min read', cta: 'Read it', img: 'Media/Resources/commission_rate.jpg' },
  { slug: 'one-line-sells-everything', cat: 'Brand', key: 'Brand', title: 'One line that sells everything else', desc: 'Positioning for people who hate the word positioning. A worked example on three real accounts.', read: '8 min read', cta: 'Read it', img: 'Media/Resources/one_line_sells.jpg' },
  { slug: 'four-metrics-predict-revenue', cat: 'SEO', key: 'SEO', title: 'The four metrics that predict revenue', desc: 'And the five vanity numbers I have stopped opening the dashboard for entirely.', read: '6 min read', cta: 'Read it', img: 'Media/Resources/predict_revenue.jpg' }
];
const FILTERS = ['All', 'Pinterest', 'Affiliate', 'Content', 'SEO', 'Brand'];

class Component extends DCLogic {
  state = { filter: 'All' };

  componentDidMount() {
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  renderVals() {
    const active = this.state.filter;
    const list = active === 'All' ? ITEMS : ITEMS.filter(i => i.key === active);
    return {
      filters: FILTERS.map(label => ({
        label: label === 'Brand' ? 'Personal brand' : label,
        bg: active === label ? '#1E1B17' : 'transparent',
        border: active === label ? '#1E1B17' : '#E2D9C9',
        color: active === label ? '#FAF7F2' : '#1E1B17',
        pick: () => this.setState({ filter: label })
      })),
      countLabel: list.length + (list.length === 1 ? ' resource' : ' resources'),
      visible: list.map(item => ({ ...item, href: 'resources/' + item.slug }))
    };
  }
}
</script>
</body>
</html>
