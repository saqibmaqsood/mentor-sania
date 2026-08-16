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
<style>
@keyframes navItemIn { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
</style>
</helmet>
<header style="position:fixed;top:0;left:0;right:0;z-index:900;font-family:Manrope,system-ui,sans-serif;background:{{ barBg }};border-bottom:1px solid {{ barBorder }};backdrop-filter:{{ barBlur }};transition:background 320ms ease,border-color 320ms ease">
  <div style="max-width:1360px;margin:0 auto;padding:0 clamp(20px,5vw,64px);height:74px;display:flex;align-items:center;justify-content:space-between;gap:24px">
    <a href="/" style="font-family:'Newsreader',Georgia,serif;font-size:23px;letter-spacing:-0.01em;color:#1E1B17;text-decoration:none;white-space:nowrap;display:flex;align-items:baseline;gap:7px">
      Sania Maqsood<span style="width:5px;height:5px;border-radius:999px;background:#B5794A;display:inline-block"></span>
    </a>

    <sc-if value="{{ wide }}" hint-placeholder-val="{{ true }}">
      <nav style="display:flex;align-items:center;gap:clamp(18px,2.4vw,34px)">
        <sc-if value="{{ showHome }}">
          <a href="/" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">Home</a>
        </sc-if>
        <a href="/courses" data-nav="/courses" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">Courses</a>
        <a href="/services" data-nav="/services" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">Services</a>
        <a href="/about" data-nav="/about" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">About</a>
        <a href="/resources" data-nav="/resources" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">Resources</a>
        <a href="/faq" data-nav="/faq" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">FAQ</a>
        <a href="/contact" data-nav="/contact" style="font-size:14.5px;font-weight:500;letter-spacing:0.01em;color:#1E1B17;text-decoration:none;padding:6px 0;transition:color 180ms ease" style-hover="color:#8A5A34">Contact</a>
        <a href="/consulting" style="margin-left:6px;font-size:14px;font-weight:600;letter-spacing:0.01em;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:12px 22px;border-radius:999px;white-space:nowrap;transition:background 200ms ease,box-shadow 200ms ease" style-hover="background:#8A5A34;box-shadow:0 8px 22px rgba(138,90,52,0.28)">Book a session</a>
      </nav>
    </sc-if>

    <sc-if value="{{ narrow }}">
      <button type="button" onClick="{{ toggleMenu }}" aria-label="Open menu" style="display:flex;flex-direction:column;justify-content:center;gap:5px;width:46px;height:46px;align-items:flex-end;background:transparent;border:0;cursor:pointer;padding:0">
        <span style="display:block;width:26px;height:1.5px;background:#1E1B17"></span>
        <span style="display:block;width:18px;height:1.5px;background:#1E1B17"></span>
      </button>
    </sc-if>
  </div>
</header>

<sc-if value="{{ menuOpen }}">
  <div style="position:fixed;inset:0;z-index:1000;background:#FAF7F2;font-family:Manrope,system-ui,sans-serif;display:flex;flex-direction:column;padding:clamp(20px,5vw,64px)">
    <div style="height:54px;display:flex;align-items:center;justify-content:space-between">
      <span style="font-family:'Newsreader',Georgia,serif;font-size:22px;color:#1E1B17">Sania Maqsood</span>
      <button type="button" onClick="{{ toggleMenu }}" aria-label="Close menu" style="width:44px;height:44px;background:transparent;border:0;font-size:26px;line-height:1;color:#1E1B17;cursor:pointer">&times;</button>
    </div>
    <nav style="margin-top:8vh;display:flex;flex-direction:column;gap:4px">
      <sc-if value="{{ showHome }}">
        <a href="/" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 30ms forwards">Home</a>
      </sc-if>
      <a href="/courses" data-nav="/courses" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 60ms forwards">Courses</a>
      <a href="/services" data-nav="/services" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 100ms forwards">Services</a>
      <a href="/about" data-nav="/about" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 140ms forwards">About</a>
      <a href="/resources" data-nav="/resources" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 180ms forwards">Resources</a>
      <a href="/faq" data-nav="/faq" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 220ms forwards">FAQ</a>
      <a href="/contact" data-nav="/contact" style="font-family:'Newsreader',Georgia,serif;font-size:clamp(32px,9vw,46px);color:#1E1B17;text-decoration:none;padding:10px 0;border-bottom:1px solid #E2D9C9;opacity:0;animation:navItemIn 380ms cubic-bezier(0.22,1,0.36,1) 260ms forwards">Contact</a>
    </nav>
    <a href="/consulting" style="margin-top:auto;text-align:center;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:18px 24px;border-radius:999px">Book a session</a>
  </div>
</sc-if>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{&quot;$preview&quot;:{&quot;width&quot;:1360,&quot;height&quot;:120},&quot;overHero&quot;:{&quot;editor&quot;:&quot;boolean&quot;,&quot;default&quot;:true,&quot;tsType&quot;:&quot;boolean&quot;}}">
class Component extends DCLogic {
  state = { scrolled: false, open: false, narrow: false, ready: false };

  componentDidMount() {
    this._scroll = () => {
      const s = (window.scrollY || 0) > 24;
      if (s !== this.state.scrolled) this.setState({ scrolled: s });
    };
    this._resize = () => {
      const n = window.innerWidth < 940;
      if (n !== this.state.narrow || !this.state.ready) this.setState({ narrow: n, ready: true, open: n ? this.state.open : false });
    };
    window.addEventListener('scroll', this._scroll, { passive: true });
    window.addEventListener('resize', this._resize);
    this._resize();
    this._scroll();
  }

  componentWillUnmount() {
    window.removeEventListener('scroll', this._scroll);
    window.removeEventListener('resize', this._resize);
  }

  renderVals() {
    const over = this.props.overHero !== false;
    const solid = this.state.scrolled || !over;
    const file = (location.pathname.split('/').pop() || '');
    return {
      showHome: !(file === '' || file === 'index.php' || file === 'Home.dc.html' || file === 'index.html'),
      wide: this.state.ready ? !this.state.narrow : true,
      narrow: this.state.ready && this.state.narrow,
      menuOpen: this.state.open,
      barBg: solid ? 'rgba(250,247,242,0.92)' : 'transparent',
      barBorder: solid ? '#E2D9C9' : 'transparent',
      barBlur: solid ? 'saturate(180%) blur(14px)' : 'none',
      toggleMenu: () => this.setState(s => ({ open: !s.open }))
    };
  }
}
</script>
</body>
</html>
