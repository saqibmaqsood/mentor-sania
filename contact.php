<!DOCTYPE html>
<html>
<head>
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
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17;overflow-x:hidden">
  <dc-import name="SiteNav" over-hero="{{ false }}" hint-size="100%,74px"></dc-import>

  <section data-screen-label="Contact" style="padding:clamp(118px,13vw,168px) clamp(20px,5vw,64px) clamp(64px,8vw,110px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:clamp(36px,5vw,80px);align-items:start">
      <div>
        <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Contact</span>
        <h1 style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(36px,5.2vw,66px);line-height:1.03;letter-spacing:-0.025em;text-wrap:balance">Say hello.</h1>
        <p style="margin:22px 0 0;max-width:460px;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.68);text-wrap:pretty">Course access problems, partnership enquiries, or a question before you buy — this reaches me directly. I answer within one working day, usually sooner.</p>

        <div style="margin-top:clamp(32px,4vw,48px);display:flex;flex-direction:column;gap:2px">
          <sc-for list="{{ routes }}" as="r" hint-placeholder-count="3">
            <div style="padding:20px 0;border-top:1px solid #E2D9C9">
              <div style="font-size:12px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(30,27,23,0.42)">{{ r.label }}</div>
              <div style="margin-top:9px;font-size:16.5px;line-height:1.55;color:rgba(30,27,23,0.76);text-wrap:pretty">{{ r.value }}</div>
            </div>
          </sc-for>
          <div style="border-top:1px solid #E2D9C9"></div>
        </div>

        <div style="margin-top:clamp(28px,3.4vw,40px);border:1px solid #E2D9C9;border-radius:16px;background:#EDE4D3;padding:clamp(22px,2.6vw,30px)">
          <div style="display:flex;align-items:center;gap:10px">
            <span style="width:7px;height:7px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>
            <span style="font-size:13px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#8A5A34">Booking a session?</span>
          </div>
          <p style="margin:12px 0 0;font-size:15.5px;line-height:1.6;color:rgba(30,27,23,0.7);text-wrap:pretty">Use the booking form instead — it collects the context I need to audit your account before we talk.</p>
          <a href="consulting.php#book" style="display:inline-block;margin-top:14px;font-size:14.5px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px" style-hover="border-color:#B5794A;color:#8A5A34">Go to the booking form →</a>
        </div>
      </div>

      <div>
        <sc-if value="{{ open }}" hint-placeholder-val="{{ true }}">
          <div style="border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;padding:clamp(26px,3vw,40px);box-shadow:0 8px 30px rgba(30,27,23,0.05)">
            <div style="display:flex;flex-direction:column;gap:18px">
              <label style="display:flex;flex-direction:column;gap:8px;font-size:12.5px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Your name
                <input type="text" value="{{ f.name }}" onInput="{{ setName }}" placeholder="Sana Iqbal" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
              </label>
              <label style="display:flex;flex-direction:column;gap:8px;font-size:12.5px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Email
                <input type="email" value="{{ f.email }}" onInput="{{ setEmail }}" placeholder="you@email.com" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
              </label>
              <div style="display:flex;flex-direction:column;gap:10px">
                <span style="font-size:12.5px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">What's this about?</span>
                <div style="display:flex;flex-wrap:wrap;gap:8px">
                  <sc-for list="{{ topics }}" as="t" hint-placeholder-count="4">
                    <button type="button" onClick="{{ t.pick }}" style="font-family:inherit;font-size:14px;font-weight:500;color:{{ t.color }};background:{{ t.bg }};border:1px solid {{ t.border }};border-radius:999px;padding:11px 17px;min-height:44px;cursor:pointer;transition:background 180ms ease,border-color 180ms ease,color 180ms ease">{{ t.label }}</button>
                  </sc-for>
                </div>
              </div>
              <label style="display:flex;flex-direction:column;gap:8px;font-size:12.5px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Message
                <textarea value="{{ f.message }}" onInput="{{ setMessage }}" rows="6" placeholder="As much or as little detail as you like." style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;line-height:1.6;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:12px;padding:11px 16px;outline:none;resize:vertical" style-focus="border-color:#B5794A;background:#FFFDFA"></textarea>
              </label>
              <sc-if value="{{ hasError }}">
                <span style="font-size:14px;color:#9A4A34">{{ error }}</span>
              </sc-if>
              <button type="button" onClick="{{ submit }}" style="font-family:inherit;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;border:0;border-radius:999px;padding:16px 26px;min-height:44px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">Send message</button>
              <p style="margin:0;font-size:13px;line-height:1.6;color:rgba(30,27,23,0.48)">I reply from a real inbox, not a ticket system. Your address is never added to a list without you asking.</p>
            </div>
          </div>
        </sc-if>

        <sc-if value="{{ sent }}">
          <div style="border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;padding:clamp(30px,4vw,52px);text-align:center;box-shadow:0 8px 30px rgba(30,27,23,0.05)">
            <div style="width:50px;height:50px;border-radius:999px;background:#4C7A5E;color:#FAF7F2;display:flex;align-items:center;justify-content:center;margin:0 auto;font-size:22px">✓</div>
            <h2 style="margin:22px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,3.2vw,38px);line-height:1.1">Message sent, {{ firstName }}.</h2>
            <p style="margin:16px auto 0;max-width:400px;font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.66);text-wrap:pretty">I'll reply within one working day. If it's urgent and course-related, mention "access" in a follow-up and it jumps the queue.</p>
            <button type="button" onClick="{{ reset }}" style="margin-top:24px;font-family:inherit;font-size:15px;font-weight:600;color:#1E1B17;background:transparent;border:1px solid #E2D9C9;border-radius:999px;padding:14px 26px;cursor:pointer">Send another</button>
          </div>
        </sc-if>
      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{}">
const TOPICS = ['Question before buying', 'Course access', 'Partnership', 'Something else'];

class Component extends DCLogic {
  state = { f: { name: '', email: '', topic: '', message: '' }, error: '', sent: false };

  componentDidMount() {
    requestAnimationFrame(() => import('./motion.js').then(m => m.initMotion()).catch(() => {}));
  }

  setF(k, v) { this.setState(s => ({ f: Object.assign({}, s.f, { [k]: v }), error: '' })); }

  submit = () => {
    const f = this.state.f;
    if (f.name.trim().length < 2) return this.setState({ error: 'Please add your name.' });
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(f.email)) return this.setState({ error: 'That email doesn\u2019t look right.' });
    if (!f.topic) return this.setState({ error: 'Pick a topic so it reaches me faster.' });
    if (f.message.trim().length < 10) return this.setState({ error: 'A sentence or two, so I can help properly.' });
    
    const fd = new FormData();
    fd.append('form_type', 'contact');
    fd.append('name', f.name);
    fd.append('email', f.email);
    fd.append('subject', f.topic);
    fd.append('message', f.message);
    fetch('/mail-handler.php', { method: 'POST', body: fd }).catch(() => {});

    this.setState({ sent: true });
  };

  renderVals() {
    const f = this.state.f;
    return {
      f,
      open: !this.state.sent,
      sent: this.state.sent,
      firstName: (f.name.trim().split(' ')[0] || 'friend'),
      hasError: !!this.state.error,
      error: this.state.error,
      setName: e => this.setF('name', e.target.value),
      setEmail: e => this.setF('email', e.target.value),
      setMessage: e => this.setF('message', e.target.value),
      submit: this.submit,
      reset: () => this.setState({ sent: false, f: { name: '', email: '', topic: '', message: '' } }),
      topics: TOPICS.map(label => ({
        label,
        bg: f.topic === label ? '#1E1B17' : 'transparent',
        border: f.topic === label ? '#1E1B17' : '#E2D9C9',
        color: f.topic === label ? '#FAF7F2' : '#1E1B17',
        pick: () => this.setF('topic', label)
      })),
      routes: [
        { label: 'Email', value: 'hello@saniamaqsood.com' },
        { label: 'Response time', value: 'Within one working day, Mon–Fri' },
        { label: 'Based in', value: 'Lahore, Pakistan (PKT) — sessions across US and EU hours' }
      ]
    };
  }
}
</script>
</body>
</html>
