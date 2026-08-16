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
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet" />
<style>
@media (max-width: 768px) {
  aside,
  .booking-sticky-aside,
  #book aside,
  section[data-screen-label="Booking form"] aside {
    position: static !important;
    top: auto !important;
    align-self: auto !important;
  }
}
</style>
</helmet>
<section data-screen-label="Booking form" id="book" style="font-family:Manrope,system-ui,sans-serif;color:#1E1B17;padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px);background:#FAF7F2">
  <div style="max-width:1240px;margin:0 auto">
    <sc-if value="{{ formOpen }}" hint-placeholder-val="{{ true }}">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(26px,3.4vw,54px);align-items:start">

        <aside class="booking-sticky-aside" style="position:sticky;top:clamp(90px,10vh,120px);align-self:start;display:flex;flex-direction:column;gap:22px">
          <div>
            <span style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">Booking request</span>
            <h2 style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4vw,50px);line-height:1.05;letter-spacing:-0.02em;text-wrap:balance">Tell me what's stuck.</h2>
            <p style="margin:14px 0 0;max-width:420px;font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.65);text-wrap:pretty">Four short steps. I read every request myself and reply within 24 hours with two confirmed times.</p>
          </div>

          <div style="background:#FFFDFA;border:1px solid #E2D9C9;border-radius:16px;padding:22px 24px;display:flex;flex-direction:column;gap:16px">
            <div style="display:flex;align-items:baseline;justify-content:space-between;gap:14px;flex-wrap:wrap">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(28px,3vw,36px);line-height:1">{{ price }}</span>
              <span style="font-size:14px;color:rgba(30,27,23,0.55)">30 minutes · Zoom</span>
            </div>
            <div style="height:1px;background:#E2D9C9"></div>
            <div style="display:grid;gap:11px">
              <div style="display:grid;grid-template-columns:16px 1fr;gap:12px;align-items:start"><span style="color:#B5794A;font-size:14px;line-height:1.5">✓</span><span style="font-size:15px;line-height:1.55;color:rgba(30,27,23,0.72)">I audit your links and numbers before we talk</span></div>
              <div style="display:grid;grid-template-columns:16px 1fr;gap:12px;align-items:start"><span style="color:#B5794A;font-size:14px;line-height:1.5">✓</span><span style="font-size:15px;line-height:1.55;color:rgba(30,27,23,0.72)">A written 30-day plan within 48 hours</span></div>
              <div style="display:grid;grid-template-columns:16px 1fr;gap:12px;align-items:start"><span style="color:#B5794A;font-size:14px;line-height:1.5">✓</span><span style="font-size:15px;line-height:1.55;color:rgba(30,27,23,0.72)">Recording of the call, plus two weeks of email follow-up</span></div>
            </div>
            <div style="display:flex;align-items:center;gap:10px;padding-top:6px">
              <span style="width:7px;height:7px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>
              <span style="font-size:14px;font-weight:600">{{ slotLine }}</span>
            </div>
          </div>

        </aside>

        <div style="display:flex;flex-direction:column;gap:16px">
          <div style="display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap">
            <sc-for list="{{ stepNav }}" as="s" hint-placeholder-count="4">
              <div style="display:flex;align-items:center;gap:10px;flex:0 0 auto;color:{{ s.color }}">
                <sc-if value="{{ s.notFirst }}">
                  <span style="width:26px;height:1px;background:#D9CDB6;display:block"></span>
                </sc-if>
                <span style="width:20px;height:20px;flex:0 0 auto;border-radius:999px;border:1px solid {{ s.ring }};background:{{ s.fill }};color:{{ s.numColor }};display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700">{{ s.n }}</span>
                <span style="font-size:12.5px;font-weight:{{ s.weight }};letter-spacing:0;white-space:nowrap">{{ s.label }}</span>
              </div>
            </sc-for>
          </div>
          <div style="border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;box-shadow:0 8px 30px rgba(30,27,23,0.05);overflow:hidden">
          <div style="padding:18px clamp(20px,3vw,32px);border-bottom:1px solid #E2D9C9;display:flex;align-items:center;gap:18px">
            <div style="flex:1;height:3px;border-radius:999px;background:#EDE4D3;overflow:hidden">
              <div style="height:100%;border-radius:999px;background:#B5794A;width:{{ progress }};transition:width 420ms cubic-bezier(0.22,1,0.36,1)"></div>
            </div>
            <span style="font-size:12.5px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.5);white-space:nowrap">Step {{ stepLabel }} of 4</span>
          </div>

          <div style="overflow:hidden;height:{{ frameH }};transition:height 460ms cubic-bezier(0.22,1,0.36,1)">
            <div ref="{{ trackRef }}" style="display:flex;width:400%;align-items:flex-start;transform:translateX({{ trackX }});transition:transform 520ms cubic-bezier(0.22,1,0.36,1)">

              <div style="flex:1 1 0;min-width:0;padding:clamp(24px,3vw,38px);visibility:{{ step0Vis }}">
                <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(22px,2.4vw,30px);line-height:1.16;letter-spacing:-0.01em">First, the basics.</div>
                <div style="margin-top:20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(220px,100%),1fr));gap:14px">
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Your name
                    <input type="text" value="{{ f.name }}" onInput="{{ setName }}" placeholder="Sana Iqbal" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
                  </label>
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">WhatsApp (optional)
                    <input type="text" value="{{ f.phone }}" onInput="{{ setPhone }}" placeholder="03xx xxxxxxx" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
                  </label>
                  <label style="display:flex;flex-direction:column;gap:7px;grid-column:1 / -1;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Email
                    <input type="email" value="{{ f.email }}" onInput="{{ setEmail }}" placeholder="you@email.com" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
                  </label>
                </div>
                <div style="margin-top:24px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Where are you right now?</div>
                <div style="margin-top:12px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:10px">
                  <sc-for list="{{ stages }}" as="o" hint-placeholder-count="4">
                    <button type="button" onClick="{{ o.pick }}" style="text-align:left;font-family:inherit;font-size:15px;line-height:1.4;color:#1E1B17;background:{{ o.bg }};border:1px solid {{ o.border }};border-radius:12px;padding:13px 16px;min-height:64px;cursor:pointer;transition:border-color 180ms ease,background 180ms ease">{{ o.label }}</button>
                  </sc-for>
                </div>
              </div>

              <div style="flex:1 1 0;min-width:0;padding:clamp(24px,3vw,38px);visibility:{{ step1Vis }}">
                <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(22px,2.4vw,30px);line-height:1.16;letter-spacing:-0.01em">What's the one thing you want solved?</div>
                <textarea value="{{ f.goal }}" onInput="{{ setGoal }}" rows="5" placeholder="Be specific — “my pins get saves but no clicks”, “I have 3 affiliate offers and no idea which to push”." style="margin-top:18px;width:100%;box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;line-height:1.6;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:12px;padding:13px 15px;outline:none;resize:vertical" style-focus="border-color:#B5794A;background:#FFFDFA"></textarea>
                <div style="margin-top:22px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Current monthly online income</div>
                <p style="margin:8px 0 0;font-size:14px;color:rgba(30,27,23,0.52)">Only so I pitch at the right level. Never shared.</p>
                <div style="margin-top:12px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(150px,100%),1fr));gap:9px">
                  <sc-for list="{{ revenues }}" as="o" hint-placeholder-count="5">
                    <button type="button" onClick="{{ o.pick }}" style="text-align:left;font-family:inherit;font-size:15px;color:#1E1B17;background:{{ o.bg }};border:1px solid {{ o.border }};border-radius:12px;padding:13px 16px;min-height:44px;cursor:pointer;transition:border-color 180ms ease,background 180ms ease">{{ o.label }}</button>
                  </sc-for>
                </div>
                <div style="margin-top:22px;display:flex;gap:12px;align-items:flex-start;border:1px solid #E2D9C9;background:#FAF7F2;border-radius:12px;padding:14px 16px">
                  <span style="font-size:14px;color:#8A5A34;line-height:1.5">★</span>
                  <span style="font-size:14.5px;line-height:1.55;color:rgba(30,27,23,0.62);text-wrap:pretty">Add links in the next email if you have them — content, analytics screenshots, or the page you want fixed. The more I see, the sharper the call.</span>
                </div>
              </div>

              <div style="flex:1 1 0;min-width:0;padding:clamp(24px,3vw,38px);visibility:{{ step2Vis }}">
                <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(22px,2.4vw,30px);line-height:1.16;letter-spacing:-0.01em">When suits you?</div>
                <div style="margin-top:20px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:14px">
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Preferred date
                    <input type="date" value="{{ f.date }}" onInput="{{ setDate }}" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
                  </label>
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Time window
                    <select value="{{ f.time }}" onChange="{{ setTime }}" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none">
                      <option value="evening">Evening (5–9 PKT)</option>
                      <option value="afternoon">Afternoon (12–5 PKT)</option>
                      <option value="morning">Morning (9–12 PKT)</option>
                    </select>
                  </label>
                </div>
                <div style="margin-top:22px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(150px,100%),1fr));gap:12px">
                  <div style="border:1px solid #E2D9C9;background:#FAF7F2;border-radius:12px;padding:14px 16px">
                    <div style="font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.45)">Sessions run</div>
                    <div style="margin-top:7px;font-size:15px;line-height:1.5">Mon–Fri, PKT. Weekends off.</div>
                  </div>
                  <div style="border:1px solid #E2D9C9;background:#FAF7F2;border-radius:12px;padding:14px 16px">
                    <div style="font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.45)">Reschedule</div>
                    <div style="margin-top:7px;font-size:15px;line-height:1.5">Once, with 48 hours notice.</div>
                  </div>
                </div>
              </div>

              <div style="flex:1 1 0;min-width:0;padding:clamp(24px,3vw,38px);visibility:{{ step3Vis }}">
                <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(22px,2.4vw,30px);line-height:1.16;letter-spacing:-0.01em">Payment, then you're booked.</div>
                <p style="margin:12px 0 0;font-size:15px;line-height:1.6;color:rgba(30,27,23,0.6)">Transfer {{ price }} to any account below, then attach the screenshot. I confirm your slot once it lands.</p>

                <div style="margin-top:18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(140px,100%),1fr));gap:9px">
                  <sc-for list="{{ methods }}" as="m" hint-placeholder-count="3">
                    <button type="button" onClick="{{ m.pick }}" style="text-align:left;font-family:inherit;font-size:15px;font-weight:600;color:#1E1B17;background:{{ m.bg }};border:1px solid {{ m.border }};border-radius:12px;padding:13px 16px;min-height:44px;cursor:pointer;transition:border-color 180ms ease,background 180ms ease">{{ m.label }}</button>
                  </sc-for>
                </div>

                <div style="margin-top:14px;border:1px solid #E2D9C9;background:#EDE4D3;border-radius:12px;padding:16px 18px;display:grid;gap:10px">
                  <sc-for list="{{ accountRows }}" as="row" hint-placeholder-count="3">
                    <div style="display:flex;flex-wrap:wrap;align-items:baseline;justify-content:space-between;gap:10px">
                      <span style="font-size:12px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.48)">{{ row.k }}</span>
                      <span style="font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:15px;color:#1E1B17">{{ row.v }}</span>
                    </div>
                  </sc-for>
                </div>

                <div style="margin-top:18px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:14px">
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Transaction ID (optional)
                    <input type="text" value="{{ f.txn }}" onInput="{{ setTxn }}" placeholder="e.g. 4821XXXX93" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
                  </label>
                  <label style="display:flex;flex-direction:column;gap:7px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.5)">Amount sent
                    <input type="text" value="{{ f.amount }}" onInput="{{ setAmount }}" placeholder="{{ price }}" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;font-weight:400;letter-spacing:normal;text-transform:none;color:#1E1B17;background:#FAF7F2;border:1px solid #E2D9C9;border-radius:10px;padding:11px 15px;min-height:44px;outline:none" style-focus="border-color:#B5794A;background:#FFFDFA" />
                  </label>
                </div>

                <label style="margin-top:14px;display:flex;align-items:center;gap:14px;border:1px dashed {{ dropBorder }};background:{{ dropBg }};border-radius:12px;padding:16px 18px;cursor:pointer">
                  <span style="width:38px;height:38px;flex:0 0 auto;border-radius:10px;background:#FAF7F2;border:1px solid #E2D9C9;display:flex;align-items:center;justify-content:center;color:#8A5A34;font-size:16px">⬆</span>
                  <span style="display:flex;flex-direction:column;gap:3px;min-width:0">
                    <span style="font-size:15px;font-weight:600">{{ fileLabel }}</span>
                    <span style="font-size:13.5px;color:rgba(30,27,23,0.52)">PNG or JPG of your payment confirmation</span>
                  </span>
                  <input id="bookingPaymentFile" type="file" accept="image/*" onChange="{{ setFile }}" style="position:absolute;width:1px;height:1px;opacity:0;pointer-events:none" />
                </label>

                <div style="margin-top:18px;border:1px solid #E2D9C9;border-radius:12px;overflow:hidden">
                  <sc-for list="{{ summary }}" as="row" hint-placeholder-count="5">
                    <div style="display:grid;grid-template-columns:minmax(104px,140px) 1fr;gap:14px;padding:10px 15px;border-bottom:1px solid #EDE4D3">
                      <span style="font-size:12px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.45)">{{ row.k }}</span>
                      <span style="font-size:15px;line-height:1.5;color:#1E1B17;text-wrap:pretty">{{ row.v }}</span>
                    </div>
                  </sc-for>
                </div>
              </div>
            </div>
          </div>

          <div style="padding:18px clamp(20px,3vw,32px) clamp(20px,3vw,26px);border-top:1px solid #E2D9C9;display:flex;flex-wrap:wrap;align-items:center;gap:14px;justify-content:space-between">
            <button type="button" onClick="{{ back }}" style="font-family:inherit;font-size:14.5px;font-weight:600;color:rgba(30,27,23,0.55);background:transparent;border:0;padding:11px 4px;min-height:44px;cursor:pointer;visibility:{{ backVis }}">← Back</button>
            <div style="display:flex;flex-wrap:wrap;align-items:center;gap:16px;margin-left:auto">
              <sc-if value="{{ hasError }}">
                <span style="font-size:14px;color:#9A4A34">{{ error }}</span>
              </sc-if>
              <button type="button" onClick="{{ next }}" style="font-family:inherit;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;border:0;border-radius:999px;padding:13px 28px;min-height:46px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">{{ nextLabel }}</button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </sc-if>

    <sc-if value="{{ formSent }}">
      <div style="max-width:640px;margin:0 auto;border:1px solid #E2D9C9;border-radius:18px;background:#FFFDFA;padding:clamp(30px,5vw,58px);text-align:center;box-shadow:0 10px 34px rgba(30,27,23,0.07)">
        <div style="width:54px;height:54px;border-radius:999px;background:#4C7A5E;color:#FAF7F2;display:flex;align-items:center;justify-content:center;margin:0 auto;font-size:24px;line-height:1">✓</div>
        <h2 style="margin:22px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(28px,3.6vw,44px);line-height:1.1;letter-spacing:-0.02em">You're booked, {{ firstName }}.</h2>
        <p style="margin:16px auto 0;max-width:480px;font-size:16.5px;line-height:1.65;color:rgba(30,27,23,0.66);text-wrap:pretty">I'll verify the payment and send your Zoom link with two confirmed times within 24 hours. If anything looks off, I'll email you before charging ahead.</p>
        <div style="margin-top:26px;display:flex;flex-wrap:wrap;gap:12px;justify-content:center">
          <a href="/courses" style="font-size:15px;font-weight:600;color:#FAF7F2;background:#1E1B17;text-decoration:none;padding:14px 26px;border-radius:999px">Browse courses while you wait</a>
          <button type="button" onClick="{{ reset }}" style="font-family:inherit;font-size:15px;font-weight:600;color:#1E1B17;background:transparent;border:1px solid #E2D9C9;border-radius:999px;padding:14px 26px;min-height:46px;cursor:pointer">Send another request</button>
        </div>
      </div>
    </sc-if>
  </div>
</section>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{&quot;$preview&quot;:{&quot;width&quot;:1200,&quot;height&quot;:760},&quot;price&quot;:{&quot;editor&quot;:&quot;text&quot;,&quot;default&quot;:&quot;PKR 1,000&quot;,&quot;tsType&quot;:&quot;string&quot;},&quot;slotsLeft&quot;:{&quot;editor&quot;:&quot;int&quot;,&quot;default&quot;:4,&quot;min&quot;:0,&quot;max&quot;:12,&quot;tsType&quot;:&quot;number&quot;}}">
const STAGES = [
  'Just starting — no audience, no offers yet',
  'Publishing, but income is inconsistent',
  'Earning, want to scale past a plateau',
  'Established — need strategy, not tactics'
];
const REVENUES = ['Nothing yet', 'Under PKR 25K', 'PKR 25K–100K', 'PKR 100K–300K', 'PKR 300K+'];
const ACCOUNTS = {
  Easypaisa: [{ k: 'Account title', v: 'Sania Maqsood' }, { k: 'Number', v: '0301 234 5678' }],
  JazzCash: [{ k: 'Account title', v: 'Sania Maqsood' }, { k: 'Number', v: '0300 987 6543' }],
  'Bank transfer': [{ k: 'Bank', v: 'Meezan Bank' }, { k: 'Account title', v: 'Sania Maqsood' }, { k: 'IBAN', v: 'PK36 MEZN 0001 2345 6789 01' }]
};
const BLANK = { name: '', email: '', phone: '', stage: '', goal: '', revenue: '', date: '', time: 'evening', method: 'Easypaisa', txn: '', amount: '', file: '' };
const STEP_LABELS = ['You', 'Situation', 'Time', 'Payment'];

class Component extends DCLogic {
  state = { step: 0, error: '', sent: false, f: Object.assign({}, BLANK), frameH: 0 };

  componentDidMount() {
    this._measure = () => {
      const t = this._track;
      if (!t) return;
      const el = t.children[this.state.step];
      if (!el) return;
      const h = Math.max(200, Math.ceil(el.getBoundingClientRect().height));
      if (h !== this.state.frameH) this.setState({ frameH: h });
    };
    window.addEventListener('resize', this._measure);
    this._raf = requestAnimationFrame(this._measure);
  }

  componentDidUpdate() { if (this._measure) this._measure(); }

  componentWillUnmount() {
    window.removeEventListener('resize', this._measure);
    if (this._raf) cancelAnimationFrame(this._raf);
  }

  setF(k, v) { this.setState(s => ({ f: Object.assign({}, s.f, { [k]: v }), error: '' })); }

  validate() {
    const f = this.state.f;
    switch (this.state.step) {
      case 0:
        if (f.name.trim().length < 2) return 'Please add your name.';
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(f.email)) return 'That email doesn\u2019t look right.';
        if (!f.stage) return 'Pick the closest stage.';
        return '';
      case 1:
        if (f.goal.trim().length < 13) return 'A sentence or two is plenty.';
        if (!f.revenue) return 'Pick an income range.';
        return '';
      case 2: return f.date ? '' : 'Choose a preferred date.';
      case 3:
        if (!f.file) return 'Attach the payment screenshot.';
        return '';
      default: return '';
    }
  }

  next = () => {
    const err = this.validate();
    if (err) { this.setState({ error: err }); return; }
    if (this.state.step === 3) {
      const fd = new FormData();
      fd.append('form_type', 'consulting');
      fd.append('name', this.state.f.name);
      fd.append('email', this.state.f.email);
      fd.append('phone', this.state.f.phone);
      fd.append('stage', this.state.f.stage);
      fd.append('goal', this.state.f.goal);
      fd.append('revenue', this.state.f.revenue);
      fd.append('preferred_date', this.state.f.date);
      fd.append('preferred_time', this.state.f.time);
      fd.append('method', this.state.f.method || 'Easypaisa');
      fd.append('txn', this.state.f.txn);
      fd.append('amount', this.state.f.amount || 'PKR 1,000');
      
      const fileInput = document.getElementById('bookingPaymentFile') || document.querySelector('input[type="file"]');
      const fileObj = this._fileBlob || window.__lastBookingFile || (fileInput && fileInput.files && fileInput.files[0] ? fileInput.files[0] : null);
      if (fileObj) {
        fd.append('screenshot', fileObj, fileObj.name);
      }
      if (this.state.f.fileData) {
        fd.append('screenshot_data', this.state.f.fileData);
      }
      fd.append('screenshot_name', this.state.f.file || (fileObj ? fileObj.name : ''));
      fd.append('subject', '1:1 Strategy Session Booking');
      fd.append('budget', 'PKR 1,000');
      fd.append('message', 'Stage: ' + this.state.f.stage + ' | Goal: ' + this.state.f.goal + ' | Income: ' + this.state.f.revenue + ' | Date: ' + this.state.f.date + ' ' + this.state.f.time + ' | Method: ' + (this.state.f.method || 'Easypaisa') + ' | Txn: ' + this.state.f.txn);
      fetch('/mail-handler.php', { method: 'POST', body: fd }).catch(() => {});
      this.setState({ sent: true, error: '' });
      return;
    }
    this.setState(s => ({ step: s.step + 1, error: '' }));
  };

  back = () => this.setState(s => ({ step: Math.max(0, s.step - 1), error: '' }));

  renderVals() {
    const st = this.state, f = st.f;
    const price = this.props.price ?? 'PKR 1,000';
    const slots = this.props.slotsLeft ?? 4;
    const timeLabel = { morning: 'Morning (9–12 PKT)', afternoon: 'Afternoon (12–5 PKT)', evening: 'Evening (5–9 PKT)' }[f.time];
    return {
      f, price,
      slotLine: slots + ' slots left this month',
      trackRef: el => { this._track = el; },
      frameH: st.frameH ? st.frameH + 'px' : 'auto',
      firstName: (f.name.trim().split(' ')[0] || 'friend'),
      formOpen: !st.sent,
      formSent: st.sent,
      progress: Math.round(((st.step + 1) / 4) * 100) + '%',
      stepLabel: String(st.step + 1),
      step0Vis: st.step === 0 ? 'visible' : 'hidden',
      step1Vis: st.step === 1 ? 'visible' : 'hidden',
      step2Vis: st.step === 2 ? 'visible' : 'hidden',
      step3Vis: st.step === 3 ? 'visible' : 'hidden',
      trackX: '-' + (st.step * 25).toFixed(4) + '%',
      backVis: st.step === 0 ? 'hidden' : 'visible',
      nextLabel: st.step === 3 ? 'Confirm booking' : 'Continue',
      hasError: !!st.error,
      error: st.error,
      next: this.next,
      back: this.back,
      reset: () => { this._fileBlob = null; window.__lastBookingFile = null; this.setState({ sent: false, step: 0, f: Object.assign({}, BLANK) }); },
      setName: e => this.setF('name', e.target.value),
      setEmail: e => this.setF('email', e.target.value),
      setPhone: e => this.setF('phone', e.target.value),
      setGoal: e => this.setF('goal', e.target.value),
      setDate: e => this.setF('date', e.target.value),
      setTime: e => this.setF('time', e.target.value),
      setTxn: e => this.setF('txn', e.target.value),
      setAmount: e => this.setF('amount', e.target.value),
      setFile: (e) => {
        const file = e.target.files && e.target.files[0];
        if (file) {
          this._fileBlob = file;
          window.__lastBookingFile = file;
          try {
            const reader = new FileReader();
            reader.onload = (re) => {
              this.setF('fileData', re.target.result);
              this.setF('file', file.name);
            };
            reader.readAsDataURL(file);
          } catch(err) {
            this.setF('file', file.name);
          }
        }
      },
      fileLabel: f.file || 'Attach payment screenshot',
      dropBorder: f.file ? '#4C7A5E' : '#C9BCA6',
      dropBg: f.file ? 'rgba(76,122,94,0.07)' : '#FAF7F2',
      stepNav: STEP_LABELS.map((label, i) => ({
        n: String(i + 1), label, notFirst: i > 0,
        color: i === st.step ? '#1E1B17' : 'rgba(30,27,23,0.5)',
        ring: i <= st.step ? '#B5794A' : '#D9CDB6',
        fill: i < st.step ? '#B5794A' : (i === st.step ? '#FAF7F2' : 'transparent'),
        numColor: i < st.step ? '#FAF7F2' : '#8A5A34',
        weight: i === st.step ? '700' : '500',
        flex: i === st.step ? '1 1 auto' : '0 1 auto'
      })),
      stages: STAGES.map(label => ({
        label,
        bg: f.stage === label ? '#EDE4D3' : '#FAF7F2',
        border: f.stage === label ? '#B5794A' : '#E2D9C9',
        pick: () => this.setF('stage', label)
      })),
      revenues: REVENUES.map(label => ({
        label,
        bg: f.revenue === label ? '#EDE4D3' : '#FAF7F2',
        border: f.revenue === label ? '#B5794A' : '#E2D9C9',
        pick: () => this.setF('revenue', label)
      })),
      methods: Object.keys(ACCOUNTS).map(label => ({
        label,
        bg: f.method === label ? '#EDE4D3' : '#FAF7F2',
        border: f.method === label ? '#B5794A' : '#E2D9C9',
        pick: () => this.setF('method', label)
      })),
      accountRows: ACCOUNTS[f.method] || [],
      summary: [
        { k: 'Name', v: f.name || '—' },
        { k: 'Email', v: f.email || '—' },
        { k: 'Preferred', v: (f.date || '—') + ' · ' + timeLabel },
        { k: 'Paid via', v: f.method + (f.txn ? ' · ' + f.txn : '') },
        { k: 'Session', v: price + ' · 30 minutes · Zoom' }
      ]
    };
  }
}
</script>
</body>
</html>
