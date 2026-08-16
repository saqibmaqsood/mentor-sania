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
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
  .om-scroller { scrollbar-width: none; }
  .om-scroller::-webkit-scrollbar { display: none; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17;overflow-x:hidden">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <header data-screen-label="Page head" style="padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(36px,4vw,52px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(400px,100%),1fr));gap:clamp(28px,4vw,64px);align-items:end">
      <div>
        <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Courses</span>
        <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(38px,5.6vw,74px);line-height:1.03;letter-spacing:-0.025em;text-wrap:balance">Pick the piece you're missing.</h1>
      </div>
      <p style="margin:0;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.66);max-width:460px;text-wrap:pretty">Seventeen live programmes on Zoom. Classes run Monday to Friday at 9 PM PKT — one hour a night, weekends off — and every session is recorded for you.</p>
    </div>
  </header>

  <div style="position:sticky;top:74px;z-index:600;background:rgba(250,247,242,0.94);backdrop-filter:saturate(180%) blur(12px);border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div class="om-scroller" style="max-width:1360px;margin:0 auto;padding:14px clamp(20px,5vw,64px);display:flex;gap:9px;overflow-x:auto">
      <sc-for list="{{ filters }}" as="fl" hint-placeholder-count="6">
        <button type="button" onClick="{{ fl.pick }}" style="flex:0 0 auto;font-family:inherit;font-size:13.5px;font-weight:600;letter-spacing:0.02em;color:{{ fl.color }};background:{{ fl.bg }};border:1px solid {{ fl.border }};border-radius:999px;padding:10px 18px;min-height:40px;cursor:pointer;white-space:nowrap;transition:background 180ms ease,border-color 180ms ease,color 180ms ease">{{ fl.label }}</button>
      </sc-for>
    </div>
  </div>

  <section data-screen-label="Course grid" style="padding:clamp(40px,5vw,68px) clamp(20px,5vw,64px) clamp(60px,7vw,96px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;align-items:baseline;justify-content:space-between;gap:20px;flex-wrap:wrap">
        <span style="font-size:13.5px;color:rgba(30,27,23,0.5)">{{ countLabel }}</span>
        <span style="font-size:13.5px;color:rgba(30,27,23,0.5)">Fees in PKR unless marked in $</span>
      </div>

      <div style="margin-top:26px;display:grid;grid-template-columns:repeat(auto-fill,minmax(min(360px,100%),1fr));gap:22px;align-items:stretch;justify-content:start">
        <sc-for list="{{ visible }}" as="c" hint-placeholder-count="9">
          <div data-tilt="" style="display:flex;flex-direction:{{ c.dir }};color:inherit;border:1px solid {{ c.cardBorder }};border-radius:16px;overflow:hidden;background:{{ c.cardBg }};grid-column:{{ c.span }};transition:box-shadow 240ms ease">
            <div style="position:relative;flex:{{ c.imgFlex }};aspect-ratio:{{ c.ratio }};overflow:hidden;background:#EDE4D3;display:flex;align-items:center;justify-content:center">
              <img src="{{ c.img }}" alt="{{ c.title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
              <sc-if value="{{ c.isFeatured }}">
                <span style="position:absolute;top:14px;left:14px;background:#1E1B17;color:#FAF7F2;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:7px 12px;border-radius:999px">Flagship</span>
              </sc-if>
              <sc-if value="{{ c.isHighlight }}">
                <span style="position:absolute;top:14px;left:14px;background:#B5794A;color:#FAF7F2;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:7px 12px;border-radius:999px">Grand session · 2 hours</span>
              </sc-if>
            </div>
            <div style="padding:clamp(22px,2.4vw,32px);display:flex;flex-direction:column;gap:13px;flex:1">
              <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
                <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#B5794A">{{ c.cat }}</span>
                <a href="{{ c.href }}" style="flex:0 0 auto;font-size:13px;font-weight:600;color:#8A5A34;text-decoration:none;white-space:nowrap;transition:color 200ms ease" style-hover="color:#1E1B17">View details →</a>
              </div>
              <h2 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:{{ c.titleSize }};line-height:1.12;letter-spacing:-0.015em"><a href="{{ c.href }}" style="color:inherit;text-decoration:none">{{ c.title }}</a></h2>
              <p style="margin:0;font-size:15.5px;line-height:1.6;color:rgba(30,27,23,0.65);max-width:480px;text-wrap:pretty">{{ c.desc }}</p>
              <div style="margin-top:auto;padding-top:18px;border-top:1px solid #E2D9C9;display:grid;grid-template-columns:1fr auto;align-items:end;gap:12px 16px">
                <div style="min-width:0">
                  <div style="font-size:16.5px;font-weight:700;letter-spacing:-0.01em;white-space:nowrap">{{ c.days }} · {{ c.time }}</div>
                  <div style="margin-top:3px;font-size:13.5px;color:rgba(30,27,23,0.55);text-wrap:pretty">{{ c.dur }}</div>
                  <div style="margin-top:5px;font-size:13px;font-weight:600;color:#8A5A34">Taught by {{ c.teacher }}</div>
                </div>
                <div style="text-align:right">
                  <div style="font-size:11px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#4C7A5E">{{ c.live }}</div>
                  <div style="margin-top:2px;font-family:'Newsreader',Georgia,serif;font-size:23px;line-height:1.25">{{ c.price }}</div>
                </div>
              </div>
            </div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <section data-screen-label="How classes run" style="padding:clamp(56px,7vw,96px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(30px,4vw,64px);align-items:start">
      <div>
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">How the classes run</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,3.8vw,50px);line-height:1.06;letter-spacing:-0.02em">Live, every weekday night.</h2>
        <p data-reveal="" style="margin:20px 0 0;font-size:17px;line-height:1.65;color:rgba(30,27,23,0.68);max-width:480px;text-wrap:pretty">Same rhythm for every programme, so you can take two courses back to back without rearranging your life. Ask your questions in the class; the recording is up the same night.</p>
        <a data-reveal="" href="contact.php" style="display:inline-block;margin-top:26px;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 200ms ease" style-hover="background:#8A5A34">Ask about the next batch</a>
      </div>
      <div data-reveal="" style="background:#FAF7F2;border:1px solid #D9CDB6;border-radius:18px;overflow:hidden;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(170px,100%),1fr));gap:1px;background-image:linear-gradient(#E2D9C9,#E2D9C9)">
        <sc-for list="{{ runFacts }}" as="f" hint-placeholder-count="4">
          <div style="padding:clamp(20px,2.2vw,26px);background:#FAF7F2">
            <div style="font-size:10.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">{{ f.label }}</div>
            <div style="margin-top:7px;font-family:'Newsreader',Georgia,serif;font-size:24px;line-height:1.15">{{ f.value }}</div>
            <div style="margin-top:6px;font-size:14px;line-height:1.55;color:rgba(30,27,23,0.6);text-wrap:pretty">{{ f.note }}</div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <section data-screen-label="Not sure" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px);background:#1E1B17;color:#FAF7F2">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(28px,4vw,60px);align-items:center">
      <div data-reveal="" style="display:flex;flex-direction:column;gap:22px;align-items:flex-start">
        <span style="font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#D9A879">Pick with help</span>
        <h2 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4.2vw,54px);line-height:1.05;letter-spacing:-0.02em;max-width:600px;text-wrap:balance">Not sure which one you need?</h2>
        <p style="margin:0;font-size:17px;line-height:1.66;color:rgba(250,247,242,0.66);max-width:440px;text-wrap:pretty">Seventeen programmes is a lot to read through, and the wrong order wastes a month. Most people need one course now and one later — not four at once.</p>
        <div style="display:flex;flex-wrap:wrap;gap:10px">
          <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;color:rgba(250,247,242,0.8);border:1px solid rgba(250,247,242,0.24);padding:9px 15px;border-radius:999px">One course at a time</span>
          <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;color:rgba(250,247,242,0.8);border:1px solid rgba(250,247,242,0.24);padding:9px 15px;border-radius:999px">No upselling</span>
          <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;color:rgba(250,247,242,0.8);border:1px solid rgba(250,247,242,0.24);padding:9px 15px;border-radius:999px">Straight answer</span>
        </div>
      </div>
      <div data-reveal="" style="display:flex;flex-direction:column;gap:22px;align-items:stretch">
        <p style="margin:0;font-size:17px;line-height:1.65;color:rgba(250,247,242,0.7);max-width:460px;text-wrap:pretty">Tell me what you sell, what you've already tried, and how much time you have each week. I'll answer with one course — or tell you honestly that none of them fit yet.</p>
        <div style="display:flex;flex-direction:column">
          <div style="display:grid;grid-template-columns:auto 1fr;gap:14px 16px;align-items:baseline;padding:14px 0;border-top:1px solid rgba(250,247,242,0.16)">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#D9A879">01</span>
            <span style="font-size:16px;line-height:1.55;color:rgba(250,247,242,0.82);text-wrap:pretty"><strong style="font-weight:600">Starting from zero?</strong> Pinterest Affiliate Marketing or Website Design — both assume nothing.</span>
          </div>
          <div style="display:grid;grid-template-columns:auto 1fr;gap:14px 16px;align-items:baseline;padding:14px 0;border-top:1px solid rgba(250,247,242,0.16)">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#D9A879">02</span>
            <span style="font-size:16px;line-height:1.55;color:rgba(250,247,242,0.82);text-wrap:pretty"><strong style="font-weight:600">Traffic but no sales?</strong> SEO or Landing Pages — the problem is usually the page, not the audience.</span>
          </div>
          <div style="display:grid;grid-template-columns:auto 1fr;gap:14px 16px;align-items:baseline;padding:14px 0;border-top:1px solid rgba(250,247,242,0.16);border-bottom:1px solid rgba(250,247,242,0.16)">
            <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#D9A879">03</span>
            <span style="font-size:16px;line-height:1.55;color:rgba(250,247,242,0.82);text-wrap:pretty"><strong style="font-weight:600">Selling already?</strong> Shopify Dropshipping or Meta &amp; Google Ads to push volume.</span>
          </div>
        </div>
        <div style="display:flex;flex-wrap:wrap;align-items:center;gap:16px 24px">
          <a href="contact.php" style="font-size:15px;font-weight:600;color:#1E1B17;background:#FAF7F2;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 200ms ease" style-hover="background:#EDE4D3">Ask which course fits</a>
          <span style="font-size:14.5px;color:rgba(250,247,242,0.55)">Reply within one working day · no sales pitch</span>
        </div>
      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>

</x-dc>
<script type="text/x-dc" data-dc-script>
const COURSES = [
  { slug: 'pinterest-affiliate', cat: 'Affiliate marketing', key: 'Affiliate', title: 'Pinterest Affiliate Marketing', desc: 'The full system on Amazon, Alibaba, AliExpress and Temu offers: keyword-led pins, a publishing cadence you can keep, and the offer stack that turns saves into commissions.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Sania Maqsood', price: 'PKR 10,000', featured: true, img: 'Media/Courses/Pinterest-Affiliate-Portrait.jpg' },
  { slug: 'pinterest-gumroad', cat: 'Affiliate marketing', key: 'Affiliate', title: 'Pinterest + Gumroad', desc: 'Sell digital products you make once: what to build, how to price it, and the pin-to-product path that keeps buyers arriving from search.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Sania Maqsood', price: 'PKR 10,000', img: 'Media/Courses/Pinterest-Gumroad.jpeg' },
  { slug: 'pinterest-etsy', cat: 'Affiliate marketing', key: 'Affiliate', title: 'Pinterest + Etsy', desc: 'Listings built around Etsy search, photos you can shoot at home, and Pinterest traffic that lands on the right listing at the right time.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Sania Maqsood', price: 'PKR 15,000', img: 'Media/Courses/Pinterest-Etsy.jpeg' },
  { slug: 'youtube-monetization', cat: 'Content', key: 'Content', title: 'YouTube Monetization', desc: 'From zero to the watch-hour threshold and past it: what to make, how often, and the income streams that pay before AdSense does.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Sania Maqsood', price: 'PKR 8,000', img: 'Media/Courses/YouTube-monetization.jpeg' },
  { slug: 'blogging', cat: 'Content', key: 'Content', title: 'Blogging', desc: 'Fifteen days to a blog with a real topic, a structure that ranks, and ten posts live — plus the habit that keeps it going after the course ends.', days: '11 Days', time: '9 PM PKT', dur: '15 days · Mon–Fri · 1 hour each class', live: '11 Live Classes', teacher: 'Sania Maqsood', price: 'PKR 5,000', img: 'Media/Courses/Blogging.jpeg' },
  { slug: 'seo', cat: 'SEO', key: 'SEO', title: 'SEO', desc: 'Structure, keywords, internal linking, and page intent — the unglamorous work that makes a site rank and keep ranking.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 15,000', img: 'Media/Courses/SEO.jpeg' },
  { slug: 'website-design', cat: 'Web design', key: 'Web', title: 'Website Design', desc: 'Design a site people trust in the first three seconds — layout, typography, colour contrast, and conversion-first user experience.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 10,000', img: 'Media/Courses/Website Design.jpeg' },
  { slug: 'wordpress-design', cat: 'Web design', key: 'Web', title: 'WordPress Design', desc: 'Client-ready WordPress without fighting the builder: theme setup, blocks, plugins worth installing, and a handover the client can actually use.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 10,000', img: 'Media/Courses/WordPress-design.jpeg' },
  { slug: 'landing-pages', cat: 'Web design', key: 'Web', title: 'Landing Pages', desc: 'One week to a page that converts: offer clarity, the blocks that belong above the fold, and the copy tests worth running first.', days: '5 Days', time: '9 PM PKT', dur: '1 week · Mon–Fri · 1 hour each class', live: '5 Live Classes', teacher: 'M. Saqib', price: 'PKR 5,000', img: 'Media/Courses/Landing-Page.jpeg' },
  { slug: 'website-development', cat: 'Development', key: 'Web', title: 'Website Development', desc: 'Build what you designed: clean HTML and CSS, responsive layouts, forms that actually deliver, and a deploy you can repeat without help.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 15,000', img: 'Media/Courses/Website-development.jpeg' },
  { slug: 'graphics-designing', cat: 'Design', key: 'Design', title: 'Graphics Designing', desc: 'Type, colour, grid, and hierarchy applied to the work clients pay for: social sets, thumbnails, packaging mockups, and brand basics.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 10,000', img: 'Media/Courses/Graphics Design.jpeg' },
  { slug: 'shopify-store-setup', cat: 'Ecommerce', key: 'Ecom', title: 'Shopify Store Setup', desc: 'From empty store to first order in a week: product pages that sell, trust signals, payments and shipping for Pakistan, and the apps you can skip.', days: '5 Days', time: '9 PM PKT', dur: '1 week · Mon–Fri · 1 hour each class', live: '5 Live Classes', teacher: 'M. Saqib', price: 'PKR 5,000', img: 'Media/Courses/Shopify-store-setup.jpeg' },
  { slug: 'shopify-dropshipping', cat: 'Ecommerce', key: 'Ecom', title: 'Shopify Dropshipping', desc: 'What still works and what does not: supplier vetting, margin maths before you spend on ads, and the testing budget that tells you to stop.', days: '11 Days', time: '9 PM PKT', dur: '15 days · Mon–Fri · 1 hour each class', live: '11 Live Classes', teacher: 'M. Saqib', price: 'PKR 10,000', img: 'Media/Courses/Shopify-dropshipping.jpeg' },
  { slug: 'meta-google-ads', cat: 'Ads', key: 'Ads', title: 'Meta & Google Ads', desc: 'Campaign structure, creative testing, and the numbers that decide whether to scale or switch off — on a budget that survives learning.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'M. Saqib', price: 'PKR 10,000', img: 'Media/Courses/Meta-Google-Ads.jpeg' },
  { slug: 'landing-page-grand-session', cat: 'Grand session', key: 'Grand', altKeys: ['Web'], highlight: true, title: 'Landing Page Design — Grand Session', desc: 'One two-hour live Zoom session, one finished landing page. You design alongside me from blank canvas to publish-ready.', days: '1 Session', time: '2 hours live', dur: 'One-off live Zoom session', live: '1 Live Session', teacher: 'M. Saqib', price: 'PKR 2,000', img: 'Media/Courses/Landing-Page-2-Hours.jpeg' },
  { slug: 'forex-trading', cat: 'Trading', key: 'Trading', title: 'Forex Trading', desc: 'Charts, risk, and a routine: how to read structure, size a position so one loss cannot end you, and journal trades until the edge is visible.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Aqib', price: '$200', img: 'Media/Courses/Forex-Trading.jpeg' },
  { slug: 'binary-trading', cat: 'Trading', key: 'Trading', title: 'Binary Trading', desc: 'The honest version: how the instrument really pays, which setups have an edge, and the risk rules that keep a bad week from being your last.', days: '22 Days', time: '9 PM PKT', dur: '1 month · Mon–Fri · 1 hour each class', live: '22 Live Classes', teacher: 'Aqib', price: '$200', img: 'Media/Courses/Binary-Trading.jpeg' }
];
const FILTERS = [
  { key: 'All', label: 'All' },
  { key: 'Affiliate', label: 'Affiliate marketing' },
  { key: 'Web', label: 'Web & design' },
  { key: 'Design', label: 'Graphics' },
  { key: 'SEO', label: 'SEO' },
  { key: 'Content', label: 'Content' },
  { key: 'Ecom', label: 'Ecommerce' },
  { key: 'Ads', label: 'Ads' },
  { key: 'Trading', label: 'Trading' },
  { key: 'Grand', label: '★ Grand session' }
];

class Component extends DCLogic {
  state = { filter: 'All', threeUp: typeof window !== 'undefined' && window.innerWidth >= 1250 };

  componentDidMount() {
    this._resize = () => {
      const t = window.innerWidth >= 1250;
      if (t !== this.state.threeUp) this.setState({ threeUp: t });
    };
    window.addEventListener('resize', this._resize);
    this._resize();
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  componentWillUnmount() { window.removeEventListener('resize', this._resize); }

  renderVals() {
    const active = this.state.filter;
    const list = active === 'All' ? COURSES : COURSES.filter(c => c.key === active || (c.altKeys || []).indexOf(active) >= 0);
    return {
      filters: FILTERS.map(f => ({
        label: f.label,
        bg: active === f.key ? '#1E1B17' : (f.key === 'Grand' ? 'rgba(181,121,74,0.12)' : 'transparent'),
        border: active === f.key ? '#1E1B17' : (f.key === 'Grand' ? '#B5794A' : '#E2D9C9'),
        color: active === f.key ? '#FAF7F2' : (f.key === 'Grand' ? '#8A5A34' : '#1E1B17'),
        pick: () => this.setState({ filter: f.key })
      })),
      countLabel: list.length + (list.length === 1 ? ' course' : ' courses'),
      visible: list.map(c => {
        const wide = !!c.featured && active === 'All' && this.state.threeUp;
        return {
          cat: c.cat, title: c.title, desc: c.desc, price: c.price, teacher: c.teacher,
          days: c.days, dur: c.dur, time: c.time, live: c.live, img: c.img,
          href: 'courses/' + c.slug,
          isFeatured: !!c.featured,
          isHighlight: !!c.highlight,
          cardBorder: c.highlight ? '#B5794A' : '#E2D9C9',
          cardBg: c.highlight ? '#FFF8EF' : '#FFFDFA',
          span: wide ? 'span 2' : 'auto',
          dir: wide ? 'row' : 'column',
          imgFlex: wide ? '0 0 44%' : '0 0 auto',
          ratio: wide ? 'auto' : '16/10',
          titleSize: wide ? 'clamp(27px,2.6vw,34px)' : '24px'
        };
      }),
      runFacts: [
        { label: 'Days', value: 'Mon–Fri', note: 'Weekends off, so you can catch up' },
        { label: 'Time', value: '9 PM PKT', note: 'One hour, live on Zoom' },
        { label: 'Recordings', value: 'Same night', note: 'Yours to keep, no expiry' },
        { label: 'Teachers', value: 'Three', note: 'Sania, M. Saqib and Aqib — each in their own field' },
        { label: 'Where', value: 'Zoom', note: 'Link and reminder sent before every class' },
        { label: 'Fees', value: 'One payment', note: 'From PKR 2,000; seat confirmed on payment' }
      ]
    };
  }
}

</script>
</body>
</html>
