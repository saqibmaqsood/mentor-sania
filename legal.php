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
<style>
  html { scroll-behavior: smooth; }
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17;overflow-x:hidden">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <header data-screen-label="Page head" style="padding:clamp(118px,13vw,164px) clamp(20px,5vw,64px) clamp(28px,3.4vw,44px)">
    <div style="max-width:1000px;margin:0 auto">
      <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Legal</span>
      <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(34px,4.8vw,60px);line-height:1.04;letter-spacing:-0.025em">Policies, in plain language.</h1>
      <p style="margin:18px 0 0;max-width:600px;font-size:16.5px;line-height:1.64;color:rgba(30,27,23,0.62);text-wrap:pretty">Written to be read, not to be survived. Last updated 1 August 2026. A lawyer should review these before launch — they are drafted as a starting point.</p>
      <div style="margin-top:30px;display:flex;flex-wrap:wrap;gap:9px">
        <sc-for list="{{ tabs }}" as="t" hint-placeholder-count="3">
          <button type="button" onClick="{{ t.pick }}" style="font-family:inherit;font-size:14px;font-weight:600;color:{{ t.color }};background:{{ t.bg }};border:1px solid {{ t.border }};border-radius:999px;padding:11px 20px;min-height:44px;cursor:pointer;transition:background 180ms ease,border-color 180ms ease,color 180ms ease">{{ t.label }}</button>
        </sc-for>
      </div>
    </div>
  </header>

  <section data-screen-label="Policy body" style="padding:clamp(20px,3vw,36px) clamp(20px,5vw,64px) clamp(64px,8vw,110px)">
    <div style="max-width:1000px;margin:0 auto">
      <h2 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,38px);line-height:1.1;letter-spacing:-0.02em">{{ docTitle }}</h2>
      <div style="margin-top:8px;font-size:13.5px;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.42)">{{ docMeta }}</div>
      <div style="margin-top:clamp(28px,3.4vw,44px);display:flex;flex-direction:column;gap:clamp(26px,3vw,38px)">
        <sc-for list="{{ sections }}" as="s" hint-placeholder-count="6">
          <div style="border-top:1px solid #E2D9C9;padding-top:22px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(260px,100%),1fr));gap:20px clamp(24px,4vw,56px);align-items:start">
            <h3 style="margin:0;font-size:17.5px;font-weight:600;line-height:1.4;letter-spacing:-0.005em">{{ s.h }}</h3>
            <div style="display:flex;flex-direction:column;gap:14px">
              <sc-for list="{{ s.ps }}" as="p" hint-placeholder-count="2">
                <p style="margin:0;font-size:16.5px;line-height:1.7;color:rgba(30,27,23,0.72);text-wrap:pretty">{{ p }}</p>
              </sc-for>
            </div>
          </div>
        </sc-for>
      </div>
      <p style="margin:clamp(36px,4vw,56px) 0 0;font-size:15.5px;line-height:1.65;color:rgba(30,27,23,0.6);text-wrap:pretty">Questions about any of this? <a href="/contact" style="font-weight:600">Email me</a> and I'll answer in plain words too.</p>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
const DOCS = {
  privacy: {
    label: 'Privacy', title: 'Privacy Policy', meta: 'Effective 1 August 2026',
    sections: [
      { h: 'What I collect', ps: ['Only what you hand over: your name and email when you use a form, the answers you give in the booking flow, and your email if you subscribe to The Sunday Note.', 'Anonymous, aggregated analytics about which pages get read. No advertising pixels, no cross-site tracking, no session recording.'] },
      { h: 'Why I collect it', ps: ['To reply to you, to run a session properly, to deliver a course you bought, and to send the newsletter you asked for. That is the entire list.'] },
      { h: 'What I never do', ps: ['I do not sell, rent, or trade your data. I do not add you to a mailing list because you filled in a contact form. I do not share booking answers with anyone.'] },
      { h: 'Processors I use', ps: ['Email delivery, course hosting, video calls, and payment processing are handled by third-party providers who each see only the data they need. Each maintains its own privacy policy.'] },
      { h: 'How long it is kept', ps: ['Enquiries for two years. Booking records and session notes for three years, for tax and continuity. Newsletter subscribers until you unsubscribe, which takes one click.'] },
      { h: 'Your rights', ps: ['Ask me for a copy of your data, ask me to correct it, or ask me to delete it — email the address on the contact page and I will action it within 30 days.'] }
    ]
  },
  terms: {
    label: 'Terms', title: 'Terms of Service', meta: 'Effective 1 August 2026',
    sections: [
      { h: 'What you are buying', ps: ['A licence to access course material for your own learning, or a booked block of consulting time. Neither transfers ownership of the material to you.'] },
      { h: 'What you may not do', ps: ['Share logins, resell, redistribute, or republish the course material or templates, in whole or in part, including inside your own paid product.', 'You may absolutely use what you learn commercially — including the templates in your own client work. Teaching my material as your own course is the line.'] },
      { h: 'Sessions and scheduling', ps: ['A session is 30 minutes. You may reschedule once with at least 48 hours notice. No-shows and late cancellations forfeit the slot, because the audit work is already done.'] },
      { h: 'No guarantee of earnings', ps: ['Nothing here is a promise of income. Results depend on your niche, effort, and market conditions. Case studies are real but not typical, and are shared with permission.'] },
      { h: 'Affiliate disclosure', ps: ['Some links on this site earn a commission at no cost to you. Anything I earn from is labelled as such. I only recommend tools I use.'] },
      { h: 'Liability', ps: ['The material is provided as-is, as education. I am not liable for business decisions you make with it, to the maximum extent permitted by law.'] }
    ]
  },
  refunds: {
    label: 'Refunds', title: 'Refund Policy', meta: 'Effective 1 August 2026',
    sections: [
      { h: 'Courses — 14 days', ps: ['Email me within 14 days of purchase and I will refund you in full. No form, no interrogation, no "watch three more modules first".', 'The only exception is repeat abuse: buying, refunding, and re-buying the same course.'] },
      { h: 'Short courses and the grand session', ps: ['One-week courses, the 15-day courses, and the two-hour grand session are refundable up to 24 hours before the first class. Once the first class has run, the fee covers teaching already delivered.'] },
      { h: 'Sessions', ps: ['Full refund any time before I begin the pre-session audit — normally 48 hours before the call. After the audit starts, the fee covers work already done and is non-refundable, but you may reschedule once.'] },
      { h: 'How refunds are paid', ps: ['To the original payment method, within five working days of approval. Your card provider may take a little longer to show it.'] },
      { h: 'How to ask', ps: ['One email to the address on the contact page with your order reference. If you have lost the reference, the email address you paid with is enough.'] }
    ]
  }
};
const ORDER = ['privacy', 'terms', 'refunds'];

class Component extends DCLogic {
  state = { doc: 'privacy' };

  componentDidMount() {
    const h = (window.location.hash || '').replace('#', '');
    if (DOCS[h]) this.setState({ doc: h });
  }

  renderVals() {
    const key = this.state.doc;
    const doc = DOCS[key];
    return {
      tabs: ORDER.map(k => ({
        label: DOCS[k].label,
        bg: key === k ? '#1E1B17' : 'transparent',
        border: key === k ? '#1E1B17' : '#E2D9C9',
        color: key === k ? '#FAF7F2' : '#1E1B17',
        pick: () => { window.history.replaceState(null, '', '#' + k); this.setState({ doc: k }); }
      })),
      docTitle: doc.title,
      docMeta: doc.meta,
      sections: doc.sections.map(s => ({ h: s.h, ps: s.ps }))
    };
  }
}
</script>
</body>
</html>
