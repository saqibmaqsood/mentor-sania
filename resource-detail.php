<!DOCTYPE html>
<html>
<head>
<base href="/">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17;overflow-x:hidden">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <article>
    <header data-screen-label="Article head" style="padding:clamp(112px,12vw,156px) clamp(20px,5vw,64px) clamp(32px,4vw,48px)">
      <div style="max-width:800px;margin:0 auto">
        <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center">
          <a href="resources.php" style="font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.45);text-decoration:none">Resources</a>
          <span style="color:rgba(30,27,23,0.3)">/</span>
          <span style="font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#B5794A">{{ cat }}</span>
        </div>
        <h1 style="margin:20px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(34px,5vw,62px);line-height:1.04;letter-spacing:-0.025em;text-wrap:balance">{{ title }}</h1>
        <div style="margin-top:24px;display:flex;flex-wrap:wrap;gap:12px 24px;align-items:center;padding-bottom:24px;border-bottom:1px solid #E2D9C9">
          <div style="display:flex;align-items:center;gap:12px">
            <img src="Media/Instructors/sania.jpg" alt="Sania Maqsood" style="width:38px;height:38px;border-radius:999px;object-fit:cover;display:block;border:1px solid #E2D9C9" />
            <span style="font-size:14.5px;font-weight:600">Sania Maqsood</span>
          </div>
          <span style="font-size:14px;color:rgba(30,27,23,0.5)">{{ date }}</span>
          <span style="font-size:14px;color:rgba(30,27,23,0.5)">{{ read }}</span>
        </div>
      </div>
    </header>

    <div style="padding:0 clamp(20px,5vw,64px) clamp(56px,7vw,96px)">
      <div style="max-width:800px;margin:0 auto">
        <div data-reveal="" style="aspect-ratio:16/9;border-radius:16px;border:1px solid #E2D9C9;overflow:hidden;background:#EDE4D3">
          <img src="{{ heroImg }}" alt="{{ title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
        </div>

        <p data-reveal="" style="margin:clamp(32px,4vw,44px) 0 0;font-size:clamp(18px,1.4vw,20.5px);line-height:1.6;color:rgba(30,27,23,0.78);text-wrap:pretty">{{ lead }}</p>

        <sc-for list="{{ blocks }}" as="b" hint-placeholder-count="6">
          <div data-reveal="" style="margin-top:clamp(28px,3.4vw,40px)">
            <sc-if value="{{ b.isHeading }}">
              <h2 style="margin:0 0 14px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(25px,2.8vw,34px);line-height:1.14;letter-spacing:-0.015em">{{ b.heading }}</h2>
            </sc-if>
            <sc-if value="{{ b.isQuote }}">
              <blockquote style="margin:0;padding:clamp(22px,2.6vw,32px);border-left:2px solid #B5794A;background:#EDE4D3;border-radius:0 14px 14px 0;font-family:'Newsreader',Georgia,serif;font-size:clamp(21px,2.2vw,28px);line-height:1.26;text-wrap:pretty">{{ b.quote }}</blockquote>
            </sc-if>
            <sc-if value="{{ b.isList }}">
              <div style="display:flex;flex-direction:column;gap:12px">
                <sc-for list="{{ b.items }}" as="it" hint-placeholder-count="3">
                  <div style="display:grid;grid-template-columns:22px 1fr;gap:14px;align-items:start">
                    <span style="color:#B5794A;font-size:16px;line-height:1.6">→</span>
                    <span style="font-size:17px;line-height:1.7;color:rgba(30,27,23,0.76);text-wrap:pretty">{{ it }}</span>
                  </div>
                </sc-for>
              </div>
            </sc-if>
            <sc-if value="{{ b.isText }}">
              <p style="margin:0;font-size:17.5px;line-height:1.72;color:rgba(30,27,23,0.76);text-wrap:pretty">{{ b.text }}</p>
            </sc-if>
            <sc-if value="{{ b.isImage }}">
              <div style="aspect-ratio:16/9;border-radius:14px;border:1px solid #E2D9C9;overflow:hidden;background:#EDE4D3">
                <img src="{{ b.img }}" alt="{{ b.slot }}" style="width:100%;height:100%;object-fit:cover;display:block" />
              </div>
              <div style="margin-top:12px;font-size:13.5px;line-height:1.55;color:rgba(30,27,23,0.5)">{{ b.caption }}</div>
            </sc-if>
          </div>
        </sc-for>

        <div data-reveal="" style="margin-top:clamp(44px,5vw,64px);border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;padding:clamp(26px,3vw,40px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(240px,100%),1fr));gap:24px;align-items:center">
          <div>
            <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#B5794A">{{ promoTag }}</span>
            <h3 style="margin:12px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(23px,2.4vw,30px);line-height:1.14">{{ promoTitle }}</h3>
            <p style="margin:12px 0 0;font-size:15.5px;line-height:1.6;color:rgba(30,27,23,0.64);text-wrap:pretty">{{ promoBody }}</p>
          </div>
          <a href="{{ promoHref }}" style="justify-self:start;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:16px 28px;border-radius:999px;transition:background 200ms ease" style-hover="background:#8A5A34">{{ promoCta }}</a>
        </div>
      </div>
    </div>
  </article>

  <section data-screen-label="Related" style="padding:clamp(56px,7vw,96px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <h2 data-reveal="" style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,42px);line-height:1.08;letter-spacing:-0.02em">Read next.</h2>
      <div style="margin-top:clamp(26px,3.2vw,42px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(280px,100%),1fr));gap:20px">
        <sc-for list="{{ related }}" as="r" hint-placeholder-count="3">
          <a data-reveal="" href="{{ r.href }}" style="display:flex;flex-direction:column;text-decoration:none;color:inherit;background:#FFFDFA;border:1px solid #D9CDB6;border-radius:16px;overflow:hidden;transition:box-shadow 220ms ease" style-hover="box-shadow:0 12px 34px rgba(30,27,23,0.08)">
            <div style="aspect-ratio:16/10;background:#EDE4D3;overflow:hidden">
              <img src="{{ r.img }}" alt="{{ r.title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
            </div>
            <div style="padding:20px;display:flex;flex-direction:column;gap:10px;flex:1">
              <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#B5794A">{{ r.cat }}</span>
              <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:20px;line-height:1.2">{{ r.title }}</h3>
              <span style="margin-top:auto;font-size:13px;color:rgba(30,27,23,0.5)">{{ r.read }}</span>
            </div>
          </a>
        </sc-for>
      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
const RESOURCES_DATA = {
  'why-pins-get-saved-never-clicked': {
    cat: 'Pinterest',
    title: 'Why your pins get saved but never clicked',
    date: '10 August 2026',
    read: 'Teardown · 9 min read',
    img: 'Media/Resources/pins_saved_never_clicked.jpg',
    lead: 'A save is a bookmarking reflex. A click is a promise being kept. Most pins that stall have solved the first and ignored the second — and the fix is almost always in the words, not the design.',
    blocks: [
      { type: 'heading', heading: 'Saves are cheap. Clicks are earned.' },
      { type: 'text', text: 'Pinterest rewards saves because saves keep people on Pinterest. That is a perfectly reasonable business for Pinterest to be in, and a terrible metric for you to optimise. A save costs a person nothing and commits them to nothing. A click costs them their attention and their next ten minutes, which is why the bar is higher.' },
      { type: 'quote', quote: 'A save says "this is my kind of thing". A click says "I believe this will answer my question right now". Only the second one is worth designing for.' },
      { type: 'heading', heading: 'The three-word fix' },
      { type: 'list', items: [
        'Name the outcome, not the topic. "Small kitchen storage" becomes "Storage for a 4ft kitchen" — one is a category, the other is a person.',
        'Put the constraint in the title. Budget, time, or space. Constraints are what make a promise believable.',
        'Match the first line of the destination page to the pin, word for word. If the pin and the page disagree, the back button wins.'
      ] },
      { type: 'image', slot: 'before / after pin comparison', img: 'Media/Resources/pin_comparison_teardown.jpg', caption: 'Left: the original pin, 214 saves and 3 outbound clicks. Right: same image, retitled around a constraint — 61 saves and 89 clicks.' },
      { type: 'heading', heading: 'What to do this afternoon' },
      { type: 'text', text: 'Open your top ten pins by save rate, sorted by lowest outbound clicks. Those are your best-performing failures. For each one, write down the specific person the destination page actually helps, then retitle the pin for them and republish as a new variant.' }
    ],
    promoTag: 'Go deeper',
    promoTitle: 'The whole system is in Pinterest Affiliate Marketing.',
    promoBody: 'Keyword clusters, the template pack, the publishing cadence, and the offer stack on Amazon, AliExpress, Alibaba and Temu — PKR 10,000 lifetime access.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'See the course'
  },
  '30-pin-starter-calendar': {
    cat: 'Pinterest',
    title: 'The 30-Pin Starter Calendar',
    date: '08 August 2026',
    read: 'Template · 5 min read',
    img: 'Media/Resources/starter_calendar.jpg',
    lead: 'A structured 30-day pin calendar with pre-mapped keyword slots and publishing times designed to build topical authority without burning out on daily ideation.',
    blocks: [
      { type: 'heading', heading: 'The architecture of a 30-day sequence' },
      { type: 'text', text: 'Posting randomly on Pinterest confuses the algorithm. When you cluster pins around related keyword silos for 30 consecutive days, Pinterest learns exactly which search queries your account satisfies.' },
      { type: 'image', slot: 'content cadence tracker', img: 'Media/Flagship/content_calendar.jpg', caption: 'The 4-week publishing cadence: 3 foundational pins, 2 comparison pins, and 1 direct-response pin per cycle.' },
      { type: 'heading', heading: 'How to use this template' },
      { type: 'list', items: [
        'Week 1: Core Problem & Solution pins targeting broad informational keywords.',
        'Week 2: Product comparison and "Top 5" roundups targeting commercial investigation queries.',
        'Week 3: Step-by-step tutorial pins that link directly to detailed affiliate reviews.',
        'Week 4: Seasonal variants and alternative keyword clusters.'
      ] },
      { type: 'quote', quote: 'Consistency on Pinterest is not about posting 20 pins a day; it is about keeping the same keyword thread alive for 90 days.' }
    ],
    promoTag: 'Course Pack',
    promoTitle: 'Get 50+ Editable Canva & PSD Pin Templates',
    promoBody: 'Every pin layout tested for high click-through rates across Pinterest search and home feed feeds.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'Explore Templates'
  },
  'affiliate-offer-audit': {
    cat: 'Affiliate',
    title: 'Affiliate Offer Audit',
    date: '05 August 2026',
    read: 'Checklist · 6 min read',
    img: 'Media/Resources/affiliate_audit.jpg',
    lead: 'Twelve critical questions that tell you whether an affiliate offer deserves your search traffic before you write a single word of content.',
    blocks: [
      { type: 'heading', heading: 'Why bad offers kill good traffic' },
      { type: 'text', text: 'Sending 10,000 visitors to a poorly converting landing page generates zero revenue. An offer audit helps you evaluate payout terms, cookie duration, and vendor credibility before you commit weeks of SEO or Pinterest work.' },
      { type: 'heading', heading: 'The 12-Point Audit Checklist' },
      { type: 'list', items: [
        'Is the cookie duration at least 30 to 90 days for non-impulse purchases?',
        'Does the checkout page support multi-currency payment methods and digital wallets?',
        'What is the vendor refund rate and average customer lifetime value?',
        'Are there recurrent backend upsells that pay ongoing commissions?'
      ] },
      { type: 'quote', quote: 'A 50% commission on a page that converts at 0.5% is worse than a 10% commission on a page that converts at 8%.' }
    ],
    promoTag: 'Advanced Training',
    promoTitle: 'Affiliate Offer Stacking Masterclass',
    promoBody: 'Learn how to weave 3 to 5 non-competing affiliate offers into a single educational post.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'Learn Offer Stacking'
  },
  'first-1000-clicks': {
    cat: 'Pinterest',
    title: 'Your First 1,000 Clicks',
    date: '01 August 2026',
    read: 'Guide · 8 min read',
    img: 'Media/Resources/first_1000_clicks.jpg',
    lead: 'The exact step-by-step roadmap I use to take a fresh Pinterest account from zero impressions to 1,000 steady monthly outbound clicks.',
    blocks: [
      { type: 'heading', heading: 'The Zero-to-1,000 Clicks Roadmap' },
      { type: 'text', text: 'New Pinterest accounts need 30 to 60 days to gain trust. Trying to force traffic with spam tactics gets accounts flagged. Instead, follow a structured sequence from profile SEO to board architecture.' },
      { type: 'image', slot: 'pin design dashboard', img: 'Media/Flagship/main_dashboard.jpg', caption: 'Step 1: Building a standardized keyword-rich pin template system.' },
      { type: 'heading', heading: 'The Four Milestones' },
      { type: 'list', items: [
        'Milestone 1: Domain verification & rich pins setup.',
        'Milestone 2: 5 niche-specific boards populated with 15 highly relevant seed pins.',
        'Milestone 3: 3 fresh daily pins targeting low-competition long-tail keywords.',
        'Milestone 4: Reviewing analytics to double down on winning design formulas.'
      ] }
    ],
    promoTag: 'Complete System',
    promoTitle: 'Scale from 1,000 to 50,000 Clicks',
    promoBody: 'Join 500+ students inside our comprehensive Pinterest Affiliate live batch on Zoom.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'Join the Programme'
  },
  'internal-linking-pass': {
    cat: 'SEO',
    title: 'The internal linking pass nobody does',
    date: '28 July 2026',
    read: 'Guide · 7 min read',
    img: 'Media/Resources/internal_linking.jpg',
    lead: 'Twenty minutes of deliberate internal linking work that moved a plateaued content website from page three to page one on Google.',
    blocks: [
      { type: 'heading', heading: 'Internal linking is free PageRank distribution' },
      { type: 'text', text: 'Most site owners publish new articles and forget existing ones. When you build contextual bridge links from your top-performing authority pages down to newer commercial posts, search bots crawl and index faster.' },
      { type: 'heading', heading: 'The 3-Step Silo Technique' },
      { type: 'list', items: [
        'Identify your top 5 pages by organic impressions in Google Search Console.',
        'Find 3 relevant sub-topics you have published that lack internal links.',
        'Add contextual descriptive anchor text pointing to the newer target page.'
      ] }
    ],
    promoTag: 'Full Course',
    promoTitle: 'Complete SEO & Website Strategy',
    promoBody: 'Master keyword clustering, on-page optimization, site architecture, and technical SEO with live client case studies.',
    promoHref: 'courses/seo',
    promoCta: 'View SEO Course'
  },
  'batch-month-content-day': {
    cat: 'Content',
    title: 'How I batch a month of content in a day',
    date: '24 July 2026',
    read: 'Swipe File · 6 min read',
    img: 'Media/Resources/batch_content.jpg',
    lead: 'The five-stage pipeline and production templates I use to outline, design, and schedule 30 days of high-converting content in a single 6-hour sitting.',
    blocks: [
      { type: 'heading', heading: 'The 5-Stage Batching System' },
      { type: 'text', text: 'Batching fails when you mix creative ideation with technical production. Divide your day into strict phases: research, outline, design, review, and schedule.' },
      { type: 'heading', heading: 'The Daily Workflow' },
      { type: 'list', items: [
        'Hour 1: Keyword mining & topic selection (15 topics).',
        'Hour 2: Hook writing & 3-point outlines.',
        'Hour 3–4: Bulk visual design in template grids.',
        'Hour 5: Final copy review and destination link checks.',
        'Hour 6: Bulk scheduling into publishing queue.'
      ] }
    ],
    promoTag: 'Creator Workflow',
    promoTitle: 'Pinterest + Content Automation',
    promoBody: 'Build a repeatable publishing pipeline that keeps your business earning even on weeks off.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'Enroll in Batch Programme'
  },
  'asking-better-commission-rate': {
    cat: 'Affiliate',
    title: 'Asking for a better commission rate',
    date: '20 July 2026',
    read: 'Swipe File · 5 min read',
    img: 'Media/Resources/commission_rate.jpg',
    lead: 'The exact email script, data attachments, and timing I use to negotiate affiliate commission bumps from 15% to 25%+ with affiliate managers.',
    blocks: [
      { type: 'heading', heading: 'Affiliate managers have discretionary budgets' },
      { type: 'text', text: 'If you send quality sales with low return rates, affiliate managers are incentivized to keep you from promoting competitors. Never ask for a raise without data.' },
      { type: 'heading', heading: 'The Negotiation Email Structure' },
      { type: 'list', items: [
        'Lead with your last 90-day volume and conversion rate stats.',
        'Show where their product is positioned in your highest-traffic articles.',
        'Offer a dedicated newsletter feature or top-of-pin banner in exchange for a custom VIP tier.'
      ] }
    ],
    promoTag: '1:1 Consulting',
    promoTitle: 'Private Strategy Audit',
    promoBody: 'Book a 1:1 strategy audit with Sania to review your current affiliate stack and commission margins.',
    promoHref: 'consulting.php',
    promoCta: 'Book 1:1 Session'
  },
  'one-line-sells-everything': {
    cat: 'Brand',
    title: 'One line that sells everything else',
    date: '15 July 2026',
    read: 'Guide · 8 min read',
    img: 'Media/Resources/one_line_sells.jpg',
    lead: 'Positioning for creators who hate the word positioning. A breakdown of how a single sharp tagline makes every product and service effortless to sell.',
    blocks: [
      { type: 'heading', heading: 'The Clarity Formula' },
      { type: 'text', text: 'If you cannot explain who you help, what specific problem you solve, and what method you use in one sentence, your audience will never remember you.' },
      { type: 'heading', heading: 'The 3-Part Positioning Statement' },
      { type: 'list', items: [
        '[Target Audience] + [Specific Transformation] + [Unique Constraint / Mechanism].',
        'Example: "I help non-technical bloggers build PKR 100K/month affiliate systems using Pinterest search."',
        'Repeat this single line across your bio, header, email signature, and landing pages.'
      ] }
    ],
    promoTag: 'Brand Strategy',
    promoTitle: 'Full Personal Branding Programme',
    promoBody: 'Define your authority positioning, audience persona, and offer ecosystem.',
    promoHref: 'courses/courses.php',
    promoCta: 'Explore Courses'
  },
  'four-metrics-predict-revenue': {
    cat: 'SEO',
    title: 'The four metrics that predict revenue',
    date: '10 July 2026',
    read: 'Guide · 6 min read',
    img: 'Media/Resources/predict_revenue.jpg',
    lead: 'Stop checking vanity impression graphs. These four core analytics metrics predict real cash flow across affiliate and digital product sites.',
    blocks: [
      { type: 'heading', heading: 'Vanity metrics vs Revenue drivers' },
      { type: 'text', text: 'Millions of impressions that never leave Pinterest or Google create zero income. Focus on metrics that signal high commercial intent.' },
      { type: 'image', slot: 'analytics dashboard breakdown', img: 'Media/Flagship/analytics_dashboard.jpg', caption: 'The 4 metrics: Outbound Clicks, Click-Through Rate (CTR), Conversion Rate, and Revenue Per Mille (RPM).' },
      { type: 'heading', heading: 'The 4 Key Numbers to Track Weekly' },
      { type: 'list', items: [
        'Outbound Click Rate: Percentage of viewers who actually leave the platform.',
        'Affiliate Link CTR: Percentage of page visitors who click your product recommendations.',
        'Earnings Per Click (EPC): Average dollar value generated per referral click.',
        'Return on Effort (ROE): Hours spent vs net monthly recurring affiliate payouts.'
      ] }
    ],
    promoTag: 'Mastery',
    promoTitle: 'Analytics & Revenue Tracking Batch',
    promoBody: 'Master data-driven scaling with real student accounts and live weekly audits.',
    promoHref: 'courses/pinterest-affiliate',
    promoCta: 'Join the Batch'
  }
};

const ORDER = Object.keys(RESOURCES_DATA);

class Component extends DCLogic {
  state = { slug: 'why-pins-get-saved-never-clicked' };

  componentDidMount() {
    let q = new URLSearchParams(window.location.search).get('r');
    if (!q) {
      const parts = window.location.pathname.replace(/\/+$/, '').split('/');
      const last = parts[parts.length - 1];
      const prev = parts[parts.length - 2];
      if (prev === 'resources' && last && RESOURCES_DATA[last]) q = last;
    }
    if (q && RESOURCES_DATA[q]) this.setState({ slug: q });
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  renderVals() {
    const slug = this.state.slug || 'why-pins-get-saved-never-clicked';
    const res = RESOURCES_DATA[slug] || RESOURCES_DATA['why-pins-get-saved-never-clicked'];
    const others = ORDER.filter(s => s !== slug).slice(0, 3);

    return {
      cat: res.cat,
      title: res.title,
      date: res.date,
      read: res.read,
      heroImg: res.img,
      lead: res.lead,
      promoTag: res.promoTag,
      promoTitle: res.promoTitle,
      promoBody: res.promoBody,
      promoHref: res.promoHref,
      promoCta: res.promoCta,
      blocks: res.blocks.map(b => ({
        isHeading: b.type === 'heading', heading: b.heading || '',
        isText: b.type === 'text', text: b.text || '',
        isQuote: b.type === 'quote', quote: b.quote || '',
        isList: b.type === 'list', items: b.items || [],
        isImage: b.type === 'image', slot: b.slot || '', img: b.img || '', caption: b.caption || ''
      })),
      related: others.map(s => ({
        cat: RESOURCES_DATA[s].cat,
        title: RESOURCES_DATA[s].title,
        read: RESOURCES_DATA[s].read,
        href: 'resources/' + s,
        img: RESOURCES_DATA[s].img
      }))
    };
  }
}
</script>
</body>
</html>
