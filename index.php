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
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;1,6..72,400&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<style>
  html { scroll-behavior: smooth; }
  body { margin: 0; background: #FAF7F2; color: #1E1B17; -webkit-font-smoothing: antialiased; }
  a { color: #B5794A; }
  a:hover { color: #8A5A34; }
  ::selection { background: #EDE4D3; }
  .om-scroller { scrollbar-width: none; -ms-overflow-style: none; }
  .om-scroller::-webkit-scrollbar { display: none; }
  @keyframes omMarqueeL { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
  @keyframes omMarqueeR { 0% { transform: translateX(-50%); } 100% { transform: translateX(0); } }
  @media (prefers-reduced-motion: reduce) { [style*="omMarquee"] { animation: none !important; } }
</style>
</helmet>

<div style="font-family:Manrope,system-ui,sans-serif;background:#FAF7F2;color:#1E1B17;overflow-x:clip">

  <dc-import name="SiteNav" hint-size="100%,74px"></dc-import>

  <!-- HERO -->
  <section data-screen-label="Hero" style="position:relative;padding:clamp(112px,13vw,168px) clamp(20px,5vw,64px) clamp(48px,6vw,80px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(430px,100%),1fr));gap:clamp(40px,5vw,80px);align-items:center">
      <div style="max-width:660px">
        <div data-reveal="" style="display:inline-flex;align-items:center;gap:10px;border:1px solid #E2D9C9;background:rgba(237,228,211,0.5);border-radius:999px;padding:7px 15px 7px 11px;font-size:12.5px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#8A5A34">
          <span style="width:6px;height:6px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>
          {{ slots }} consulting slots left in August
        </div>

        <h1 data-reveal="" style="margin:22px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(40px,6.4vw,84px);line-height:1.04;letter-spacing:-0.02em;text-wrap:balance">
          Build an online business that
          <span style="color:#B5794A;font-style:italic">actually</span>
          works.
        </h1>

        <p data-reveal="" style="margin:26px 0 0;max-width:540px;font-size:clamp(16.5px,1.25vw,18.5px);line-height:1.62;color:rgba(30,27,23,0.68);text-wrap:pretty">
          I'm Sania — I teach creators how to turn Pinterest, affiliate offers, and content that compounds into income that doesn't depend on going viral. Courses for the build, 1:1 sessions for the shortcuts.
        </p>

        <div data-reveal="" style="margin-top:34px;display:flex;flex-wrap:wrap;align-items:center;gap:14px 24px">
          <a href="consulting.php#book" style="font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 220ms ease,box-shadow 220ms ease" style-hover="background:#8A5A34;box-shadow:0 10px 28px rgba(138,90,52,0.26)">Book a 1:1 Session — {{ price }}</a>
          <a href="courses.php" style="font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px;transition:border-color 200ms ease,color 200ms ease" style-hover="border-color:#B5794A;color:#8A5A34">Explore the courses →</a>
        </div>

        <div data-reveal="" style="margin-top:clamp(40px,5vw,58px);padding-top:30px;border-top:1px solid #E2D9C9;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(140px,45%),1fr));gap:26px 20px">
          <div>
            <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(30px,3.2vw,40px);line-height:1;letter-spacing:-0.01em"><span data-count="500" data-format="comma">500</span>+</div>
            <div style="margin-top:8px;font-size:12.5px;font-weight:600;letter-spacing:0.09em;text-transform:uppercase;color:rgba(30,27,23,0.48)">Students taught</div>
          </div>
          <div>
            <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(30px,3.2vw,40px);line-height:1;letter-spacing:-0.01em"><span data-count="17">17</span></div>
            <div style="margin-top:8px;font-size:12.5px;font-weight:600;letter-spacing:0.09em;text-transform:uppercase;color:rgba(30,27,23,0.48)">Live programmes</div>
          </div>
          <div>
            <div style="font-family:'Newsreader',Georgia,serif;font-size:clamp(30px,3.2vw,40px);line-height:1;letter-spacing:-0.01em"><span data-count="4.9" data-decimals="1">4.9</span></div>
            <div style="margin-top:8px;font-size:12.5px;font-weight:600;letter-spacing:0.09em;text-transform:uppercase;color:rgba(30,27,23,0.48)">Average rating</div>
          </div>
        </div>
      </div>

      <div style="position:relative;max-width:460px;width:100%;margin:0 auto">
        <div data-parallax="0.12" style="position:absolute;top:-6%;right:-8%;width:min(70%,340px);aspect-ratio:1;border-radius:999px;background:radial-gradient(circle at 32% 30%,rgba(181,121,74,0.24),rgba(237,228,211,0.55) 62%,rgba(250,247,242,0) 76%);filter:blur(2px)"></div>
        <div data-reveal="" style="position:relative;aspect-ratio:4/5;border-radius:16px;overflow:hidden;border:1px solid #E2D9C9;box-shadow:0 18px 50px rgba(30,27,23,0.09);background:#EDE4D3;display:flex;align-items:center;justify-content:center">
          <img src="Media/sania-hero-laptop.jpg" alt="Sania Maqsood Working on Laptop" style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block" />
        </div>
        <div data-reveal="" style="position:absolute;bottom:clamp(-14px,-1.5vw,-8px);left:clamp(-14px,-1.5vw,-20px);background:#FAF7F2;border:1px solid #E2D9C9;border-radius:14px;padding:14px 18px;box-shadow:0 8px 30px rgba(30,27,23,0.08);max-width:240px">
          <div style="font-family:'Newsreader',Georgia,serif;font-size:18px;line-height:1.25">"First affiliate sale in 11 days."</div>
          <div style="margin-top:6px;font-size:12px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:rgba(30,27,23,0.45)">Hira N. · Pinterest Engine</div>
        </div>
      </div>
    </div>
  </section>

  <!-- PLATFORMS & TOOLS -->
  <section data-screen-label="Platforms & Tools" style="background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9;padding:clamp(36px,4vw,56px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;text-align:center">
      <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">Platforms & Tools Covered</span>
      <h2 data-reveal="" style="margin:10px 0 28px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(22px,2.6vw,32px);line-height:1.15;color:#1E1B17">Master 30+ industry-standard platforms & applications.</h2>
      
      <!-- ROW 1 (16 LOGOS) -->
      <div data-reveal="" style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:14px 18px;margin-bottom:16px">
        <div title="Pinterest" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/pinterest.png" alt="Pinterest" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Amazon" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/amazon.png" alt="Amazon" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Alibaba" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/alibaba.png" alt="Alibaba" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="AliExpress" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/aliexpress.png" alt="AliExpress" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Temu" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/temu.png" alt="Temu" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Gumroad" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/gumroad.png" alt="Gumroad" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Etsy" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/etsy.png" alt="Etsy" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="YouTube" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/youtube.png" alt="YouTube" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="WordPress" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/wordpress.png" alt="WordPress" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Shopify" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/shopify.png" alt="Shopify" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="WooCommerce" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/woocommerce.png" alt="WooCommerce" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Tailwind CSS" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/tailwindcss.png" alt="Tailwind CSS" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Elementor" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/elementor.png" alt="Elementor" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Upwork" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/upwork.png" alt="Upwork" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Fiverr" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/fiverr.png" alt="Fiverr" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Canva" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/canva.png" alt="Canva" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
      </div>

      <!-- ROW 2 (15 LOGOS) -->
      <div data-reveal="" style="display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:14px 18px">
        <div title="Claude" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/claude.png" alt="Claude" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Claude Code" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/claude code.png" alt="Claude Code" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="ChatGPT" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/chatgpt.png" alt="ChatGPT" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Gemini" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/gemini.png" alt="Gemini" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Perplexity" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/perplexity.png" alt="Perplexity" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Antigravity" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/antigravity.png" alt="Antigravity" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Codex" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/codex.png" alt="Codex" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Google Analytics" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/google analytics.png" alt="Google Analytics" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Search Console" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/search console.png" alt="Search Console" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="SEMrush" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/semrush.png" alt="SEMrush" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Ahrefs" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/ahrefs.png" alt="Ahrefs" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Adobe Illustrator" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/illustrator.png" alt="Adobe Illustrator" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="Adobe Photoshop" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/photoshop.png" alt="Adobe Photoshop" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="MetaTrader 5" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/mt5.png" alt="MetaTrader 5" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
        <div title="TradingView" style="border:1px solid #D9CDB6;background:#FAF7F2;padding:8px 18px;border-radius:12px;display:inline-flex;align-items:center;justify-content:center;height:52px;transition:all 200ms ease;box-shadow:0 2px 6px rgba(30,27,23,0.03)" style-hover="border-color:#B5794A;box-shadow:0 6px 16px rgba(30,27,23,0.08)">
          <img src="Media/logos/tradingview.png" alt="TradingView" style="height:28px;width:auto;max-width:140px;object-fit:contain;display:block" />
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT TEASER + TIMELINE -->
  <section data-screen-label="About teaser" style="padding:clamp(72px,9vw,132px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(360px,100%),1fr));gap:clamp(36px,5vw,80px);align-items:center">
        <div data-reveal="" style="position:relative;aspect-ratio:4/5;border-radius:16px;border:1px solid #E2D9C9;overflow:hidden;background:#EDE4D3;display:flex;align-items:center;justify-content:center;max-width:520px;width:100%">
          <img src="Media/sania-about-desk.jpg" alt="Sania Maqsood Desk" style="width:100%;height:100%;object-fit:cover;object-position:center top;display:block" />
        </div>
        <div>
          <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">About Sania</span>
          <blockquote data-reveal="" style="margin:20px 0 0;font-family:'Newsreader',Georgia,serif;font-size:clamp(26px,3.1vw,40px);line-height:1.18;letter-spacing:-0.015em;text-wrap:pretty">
            I didn't grow an audience first and figure out money later. I built the income system, then let the audience follow it.
          </blockquote>
          <p data-reveal="" style="margin:24px 0 0;font-size:17px;line-height:1.68;color:rgba(30,27,23,0.68);max-width:520px;text-wrap:pretty">
            Six years ago I was writing product roundups nobody read. Today Pinterest sends my content to millions of people a month, and the affiliate systems behind it pay whether or not I post. I teach exactly that — the boring, repeatable part.
          </p>
          <a data-reveal="" href="about.php" style="display:inline-block;margin-top:26px;font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px;transition:border-color 200ms ease,color 200ms ease" style-hover="border-color:#B5794A;color:#8A5A34">Read the full story →</a>
        </div>
      </div>

      <div style="margin-top:clamp(56px,7vw,96px);padding-top:clamp(40px,5vw,56px)">
        <div style="position:relative">
          <div style="position:absolute;left:0;right:0;top:9px;height:2px;background:#C9BCA6;opacity:0.6;z-index:0"></div>
          <div data-progress-line="" style="position:absolute;left:0;top:9px;height:2px;width:0%;background:#B5794A;z-index:1"></div>
          <div style="position:relative;z-index:2;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:32px 24px">
            <sc-for list="{{ milestones }}" as="m" hint-placeholder-count="4">
              <div data-reveal="" style="padding-right:16px">
                <div style="width:19px;height:19px;border-radius:999px;border:1px solid #C9BCA6;background:#FAF7F2;display:flex;align-items:center;justify-content:center">
                  <span style="width:7px;height:7px;border-radius:999px;background:#B5794A;display:block"></span>
                </div>
                <div style="margin-top:18px;font-family:'Newsreader',Georgia,serif;font-size:24px;line-height:1.1">{{ m.year }}</div>
                <div style="margin-top:8px;font-size:14.5px;line-height:1.6;color:rgba(30,27,23,0.62);max-width:230px;text-wrap:pretty">{{ m.text }}</div>
              </div>
            </sc-for>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- COURSES -->
  <section data-screen-label="Courses" id="courses" style="padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px);background:#FAF7F2">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;flex-wrap:wrap;align-items:end;justify-content:space-between;gap:20px 40px">
        <div style="max-width:640px">
          <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">The Courses</span>
          <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(32px,4.4vw,58px);line-height:1.06;letter-spacing:-0.02em">Systems, not inspiration.</h2>
        </div>
        <div data-reveal="" style="display:flex;flex-direction:column;gap:10px;align-items:flex-end;text-align:right">
          <span style="font-size:14px;color:rgba(30,27,23,0.6);max-width:300px;text-wrap:pretty">Live on Zoom, one hour a night — from PKR 2,000</span>
          <a href="courses.php" style="font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px;white-space:nowrap;transition:border-color 200ms ease,color 200ms ease" style-hover="border-color:#B5794A;color:#8A5A34">Explore all 17 courses →</a>
        </div>
      </div>

      <div style="margin-top:clamp(36px,4.5vw,56px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:24px">
        <div data-reveal="" data-tilt="" style="grid-column:span 1;display:flex;flex-direction:column;color:inherit;border:1px solid #E2D9C9;border-radius:16px;overflow:hidden;background:#FFFDFA;transition:border-color 220ms ease">
          <div style="position:relative;aspect-ratio:16/10;overflow:hidden;background:#EDE4D3;display:flex;align-items:center;justify-content:center">
            <img src="Media/Courses/Pinterest-Affiliate.jpeg" alt="Pinterest Affiliate Marketing" style="width:100%;height:100%;object-fit:cover;display:block" />
            <span style="position:absolute;top:14px;left:14px;background:#1E1B17;color:#FAF7F2;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:7px 12px;border-radius:999px">Flagship</span>
            <div style="position:absolute;top:14px;right:14px;display:flex;flex-wrap:wrap;justify-content:flex-end;gap:8px">
              <span style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8A5A34;background:rgba(250,247,242,0.94);padding:7px 12px;border-radius:999px">Pinterest</span>
              <span style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8A5A34;background:rgba(250,247,242,0.94);padding:7px 12px;border-radius:999px">Affiliate</span>
            </div>
          </div>
          <div style="padding:clamp(24px,2.6vw,34px);display:flex;flex-direction:column;gap:14px;flex:1">
            <div style="display:flex;align-items:baseline;justify-content:space-between;gap:18px">
              <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(26px,2.8vw,36px);line-height:1.12;letter-spacing:-0.015em"><a href="courses/pinterest-affiliate" style="color:inherit;text-decoration:none">Pinterest Affiliate Marketing</a></h3>
              <a href="courses/pinterest-affiliate" style="flex:0 0 auto;font-size:13.5px;font-weight:600;color:#8A5A34;text-decoration:none;white-space:nowrap;transition:color 200ms ease" style-hover="color:#1E1B17">View details →</a>
            </div>
            <p style="margin:0;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.66);max-width:460px;text-wrap:pretty">The full system on Amazon, Alibaba, AliExpress and Temu offers: keyword-led pin design, the publishing cadence, and the offer stack that turns saves into commissions.</p>
            <div style="margin-top:auto;padding-top:18px;border-top:1px solid #E2D9C9;display:grid;grid-template-columns:1fr auto;align-items:end;gap:12px 18px">
              <div style="min-width:0">
                <div style="font-size:17px;font-weight:700;letter-spacing:-0.01em;white-space:nowrap">22 Days · 9 PM PKT</div>
                <div style="margin-top:3px;font-size:13.5px;color:rgba(30,27,23,0.55);text-wrap:pretty">Mon–Fri · 1 month · 1 hour each class</div>
              </div>
              <div style="text-align:right">
                <div style="font-size:11px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#4C7A5E">22 Live Classes</div>
                <div style="font-family:'Newsreader',Georgia,serif;font-size:26px;line-height:1.25">PKR 10,000</div>
              </div>
            </div>
          </div>
        </div>

        <div style="display:grid;gap:14px;grid-auto-rows:1fr;align-content:stretch">
          <sc-for list="{{ courses }}" as="c" hint-placeholder-count="5">
            <div data-reveal="" data-tilt="" style="display:grid;grid-template-columns:minmax(84px,104px) 1fr;gap:16px;color:inherit;border:1px solid #E2D9C9;border-radius:14px;overflow:hidden;background:#FFFDFA;padding:14px;transition:border-color 220ms ease">
              <div style="border-radius:10px;overflow:hidden;background:#EDE4D3;min-height:78px">
                <img src="{{ c.img }}" alt="{{ c.title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
              </div>
              <div style="display:flex;flex-direction:column;gap:8px;padding:4px 6px 4px 0">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
                  <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#B5794A">{{ c.tag }}</span>
                  <a href="{{ c.href }}" style="flex:0 0 auto;font-size:13px;font-weight:600;color:#8A5A34;text-decoration:none;white-space:nowrap;transition:color 200ms ease" style-hover="color:#1E1B17">View details →</a>
                </div>
                <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:22px;line-height:1.16"><a href="{{ c.href }}" style="color:inherit;text-decoration:none">{{ c.title }}</a></h3>
                <div style="margin-top:auto;display:grid;grid-template-columns:1fr auto;align-items:end;gap:8px 12px">
                  <div style="min-width:0">
                    <div style="font-size:14.5px;font-weight:700;letter-spacing:-0.01em;white-space:nowrap">{{ c.days }} · {{ c.time }}</div>
                    <div style="margin-top:2px;font-size:12.5px;color:rgba(30,27,23,0.55);white-space:nowrap">{{ c.sub }}</div>
                  </div>
                  <div style="text-align:right">
                    <div style="font-size:10.5px;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;color:#4C7A5E">{{ c.live }}</div>
                    <div style="margin-top:2px;font-size:14px;color:rgba(30,27,23,0.62)">{{ c.price }}</div>
                  </div>
                </div>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURED COURSE SPLIT -->
  <section data-screen-label="Featured course" style="padding:clamp(56px,7vw,96px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(380px,100%),1fr));gap:clamp(32px,4vw,64px);align-items:start">
      <div data-reveal="" style="display:flex;flex-direction:column;gap:16px">
        <div style="aspect-ratio:4/3;border-radius:16px;border:1px solid #D9CDB6;overflow:hidden;background:#EDE4D3">
          <img src="Media/Flagship/main_dashboard.jpg" alt="Pinterest Pin Design Dashboard" style="width:100%;height:100%;object-fit:cover;display:block" />
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
          <div style="aspect-ratio:1;border-radius:10px;border:1px solid #D9CDB6;overflow:hidden;background:#EDE4D3">
            <img src="Media/Flagship/pin_template.jpg" alt="Single Pin Template" style="width:100%;height:100%;object-fit:cover;display:block" />
          </div>
          <div style="aspect-ratio:1;border-radius:10px;border:1px solid #D9CDB6;overflow:hidden;background:#EDE4D3">
            <img src="Media/Flagship/content_calendar.jpg" alt="Posting Cadence Tracker" style="width:100%;height:100%;object-fit:cover;display:block" />
          </div>
          <div style="aspect-ratio:1;border-radius:10px;border:1px solid #D9CDB6;overflow:hidden;background:#EDE4D3">
            <img src="Media/Flagship/analytics_dashboard.jpg" alt="Pinterest Analytics Dashboard" style="width:100%;height:100%;object-fit:cover;display:block" />
          </div>
        </div>
      </div>
      <div style="position:sticky;top:100px">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">Inside the flagship</span>
        <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,3.8vw,50px);line-height:1.08;letter-spacing:-0.02em">Everything I'd do if I started again tomorrow.</h2>
        <div style="margin-top:28px;display:flex;flex-direction:column;gap:2px">
          <sc-for list="{{ flagshipPoints }}" as="p" hint-placeholder-count="4">
            <div data-reveal="" style="display:grid;grid-template-columns:26px 1fr;gap:14px;padding:16px 0;border-bottom:1px solid #D9CDB6;align-items:start">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:17px;color:#B5794A;line-height:1.5">{{ p.n }}</span>
              <div>
                <div style="font-size:16.5px;font-weight:600;line-height:1.4">{{ p.title }}</div>
                <div style="margin-top:6px;font-size:15px;line-height:1.6;color:rgba(30,27,23,0.62);text-wrap:pretty">{{ p.body }}</div>
              </div>
            </div>
          </sc-for>
        </div>
        <div data-reveal="" style="margin-top:30px;display:flex;flex-wrap:wrap;align-items:center;gap:14px 22px">
          <a href="courses/pinterest-affiliate" style="font-size:15px;font-weight:600;color:#FAF7F2;background:#1E1B17;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 220ms ease" style-hover="background:#B5794A">See the full curriculum</a>
          <span style="font-size:14.5px;color:rgba(30,27,23,0.55)">PKR 10,000 · live on Zoom · recordings included</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SKILL ECOSYSTEM -->
  <section data-screen-label="Skill ecosystem" style="padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(320px,100%),1fr));gap:clamp(32px,5vw,72px);align-items:start">
      <div style="position:sticky;top:clamp(90px,10vh,120px);align-self:start;z-index:2">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">WHAT YOU'LL LEARN</span>
        <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(32px,4.2vw,54px);line-height:1.06;letter-spacing:-0.02em">Seventeen programmes, one income system.</h2>
        <p data-reveal="" style="margin:22px 0 0;font-size:17px;line-height:1.66;color:rgba(30,27,23,0.66);max-width:420px;text-wrap:pretty">They're taught separately because that's how you learn them. They're designed to stack because that's how they pay.</p>
      </div>
      <div style="display:flex;flex-direction:column;gap:0">
        <sc-for list="{{ skills }}" as="s" hint-placeholder-count="5">
          <div data-reveal="" style="border-top:1px solid #E2D9C9">
            <button type="button" onClick="{{ s.toggle }}" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:18px;background:transparent;border:0;padding:22px 2px;cursor:pointer;text-align:left;font-family:inherit">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(21px,2.2vw,28px);line-height:1.2;color:#1E1B17">{{ s.name }}</span>
              <span style="flex:0 0 auto;width:30px;height:30px;border-radius:999px;border:1px solid #E2D9C9;display:flex;align-items:center;justify-content:center;transform:rotate({{ s.deg }});transition:transform 340ms cubic-bezier(0.22,1,0.36,1);color:#8A5A34;font-size:17px;line-height:1">+</span>
            </button>
            <div style="display:grid;grid-template-rows:{{ s.rows }};transition:grid-template-rows 340ms cubic-bezier(0.22,1,0.36,1)">
              <div style="overflow:hidden">
                <div style="padding:0 2px 24px">
                  <p style="margin:0 0 14px;font-size:16px;line-height:1.62;color:rgba(30,27,23,0.66);max-width:520px;text-wrap:pretty">{{ s.body }}</p>
                  <div style="display:flex;flex-wrap:wrap;gap:8px">
                    <sc-for list="{{ s.tags }}" as="t" hint-placeholder-count="3">
                      <span style="font-size:13px;font-weight:500;color:#8A5A34;border:1px solid #E2D9C9;background:rgba(237,228,211,0.5);padding:7px 13px;border-radius:999px">{{ t }}</span>
                    </sc-for>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </sc-for>
        <div style="border-top:1px solid #E2D9C9"></div>
      </div>
    </div>
  </section>

  <!-- 1:1 CONSULTING BAND -->
  <section data-screen-label="Consulting" id="consulting" style="background:#1E1B17;color:#FAF7F2;padding:clamp(72px,9vw,128px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(360px,100%),1fr));gap:clamp(36px,5vw,80px);align-items:start">
        <div>
          <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#D9A879">1:1 Consulting</span>
          <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(32px,4.6vw,60px);line-height:1.04;letter-spacing:-0.02em">30 minutes that replace six months of guessing.</h2>
          <p data-reveal="" style="margin:24px 0 0;font-size:17.5px;line-height:1.66;color:rgba(250,247,242,0.7);max-width:520px;text-wrap:pretty">You send your links, numbers, and the thing that's stuck. I audit it before we talk. We spend the call deciding, not catching up — and you leave with a written 30-day plan, not a recording to re-watch.</p>

          <div data-reveal="" style="margin-top:32px;display:inline-flex;flex-wrap:wrap;align-items:center;gap:10px 16px;border:1px solid rgba(250,247,242,0.18);border-radius:12px;padding:11px 16px">
            <span style="display:flex;align-items:center;gap:9px;font-size:14px;font-weight:600;color:#FAF7F2"><span style="width:7px;height:7px;border-radius:999px;background:#4C7A5E;display:inline-block"></span>{{ slots }} of 8 August slots remaining</span>
            <span style="font-size:14px;color:rgba(250,247,242,0.5)">Next opening: Aug 19</span>
          </div>

          <div data-reveal="" style="margin-top:34px;display:flex;flex-wrap:wrap;align-items:center;gap:14px 24px">
            <a href="#book" style="font-size:15px;font-weight:600;color:#1E1B17;background:#FAF7F2;text-decoration:none;padding:16px 30px;border-radius:999px;transition:background 220ms ease" style-hover="background:#EDE4D3">Request a session — {{ price }}</a>
            <a href="consulting.php" style="font-size:15px;font-weight:600;color:#FAF7F2;text-decoration:none;border-bottom:1px solid rgba(250,247,242,0.35);padding-bottom:3px" style-hover="border-color:#D9A879;color:#D9A879">What's included →</a>
          </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:14px">
          <sc-for list="{{ steps }}" as="st" hint-placeholder-count="3">
            <div data-reveal="" style="display:grid;grid-template-columns:52px 1fr;gap:20px;align-items:start;border:1px solid rgba(250,247,242,0.14);border-radius:14px;padding:22px 24px;background:rgba(250,247,242,0.03)">
              <span style="font-family:'Newsreader',Georgia,serif;font-size:34px;line-height:0.9;color:#D9A879">{{ st.n }}</span>
              <div>
                <div style="font-size:17px;font-weight:600;letter-spacing:-0.005em">{{ st.title }}</div>
                <div style="margin-top:7px;font-size:15px;line-height:1.62;color:rgba(250,247,242,0.62);text-wrap:pretty">{{ st.body }}</div>
              </div>
            </div>
          </sc-for>
        </div>
      </div>
    </div>
  </section>

  <dc-import name="BookingForm" price="{{ price }}" slots-left="{{ slotsNum }}" hint-size="100%,860px"></dc-import>

  <!-- TESTIMONIALS -->
  <section data-screen-label="Testimonials" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;flex-wrap:wrap;align-items:end;justify-content:space-between;gap:18px 40px">
        <div style="max-width:620px">
          <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">140 reviews and counting</span>
          <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4.2vw,54px);line-height:1.06;letter-spacing:-0.02em">People who stopped guessing.</h2>
        </div>
        <div data-reveal="" style="display:flex;align-items:center;gap:14px">
          <div style="display:flex;align-items:center">
            <img src="Media/Avatars/ayesha.jpg" alt="Ayesha" style="width:34px;height:34px;border-radius:999px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
            <img src="Media/Avatars/bilal.jpg" alt="Bilal" style="width:34px;height:34px;border-radius:999px;margin-left:-11px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
            <img src="Media/Avatars/zainab.jpg" alt="Zainab" style="width:34px;height:34px;border-radius:999px;margin-left:-11px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
            <span style="width:34px;height:34px;border-radius:999px;margin-left:-11px;background:#1E1B17;color:#FAF7F2;border:1.5px solid #EDE4D3;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700">+132</span>
          </div>
          <div>
            <div style="font-size:15px;font-weight:700;letter-spacing:-0.01em">★ 4.9 average</div>
            <div style="margin-top:2px;font-size:13.5px;color:rgba(30,27,23,0.55)">Verified after each batch</div>
          </div>
        </div>
      </div>

      <div style="margin-top:clamp(26px,3.4vw,44px);columns:3 300px;column-gap:16px">
        <sc-for list="{{ testimonials }}" as="t" hint-placeholder-count="8">
          <figure data-tilt="" style="break-inside:avoid;margin:0 0 16px;background:{{ t.bg }};color:{{ t.fg }};border:1px solid {{ t.border }};border-radius:16px;padding:{{ t.pad }};display:flex;flex-direction:column;gap:14px;transition:border-color 220ms ease">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
              <span style="font-size:10.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:{{ t.tagFg }};background:{{ t.tagBg }};padding:5px 10px;border-radius:999px">{{ t.course }}</span>
              <span style="font-size:12px;letter-spacing:0.1em;color:{{ t.stars }}">★★★★★</span>
            </div>
            <blockquote style="margin:0;font-family:'Newsreader',Georgia,serif;font-size:{{ t.size }};line-height:1.3;letter-spacing:-0.01em;text-wrap:pretty">"{{ t.quote }}"</blockquote>
            <div style="margin-top:auto;padding-top:14px;border-top:1px solid {{ t.rule }};display:flex;align-items:center;gap:12px">
              <img src="{{ t.avatar }}" alt="{{ t.name }}" style="width:36px;height:36px;border-radius:999px;flex:0 0 auto;object-fit:cover;border:1px solid {{ t.rule }}" />
              <div style="min-width:0">
                <div style="font-size:14.5px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ t.name }}</div>
                <div style="margin-top:2px;font-size:13px;color:{{ t.roleFg }}">{{ t.role }}</div>
              </div>
              <div style="margin-left:auto;text-align:right;flex:0 0 auto">
                <div style="font-size:14px;font-weight:700;color:{{ t.resultFg }}">{{ t.result }}</div>
                <div style="margin-top:2px;font-size:11.5px;letter-spacing:0.05em;text-transform:uppercase;color:{{ t.windowFg }}">{{ t.window }}</div>
              </div>
            </div>
          </figure>
        </sc-for>
        <a href="resources.php" style="break-inside:avoid;display:flex;flex-direction:column;justify-content:center;gap:8px;margin:0 0 16px;text-decoration:none;color:#FAF7F2;background:#B5794A;border:1px solid #B5794A;border-radius:16px;padding:24px;min-height:132px;transition:background 220ms ease,border-color 220ms ease" style-hover="background:#8A5A34;border-color:#8A5A34">
          <span style="font-family:'Newsreader',Georgia,serif;font-size:26px;line-height:1.1">+132 more reviews</span>
          <span style="font-size:14.5px;color:rgba(250,247,242,0.78)">From every batch since 2023 — read them all →</span>
        </a>
      </div>
    </div>
  </section>

  <!-- CASE STUDIES -->
  <section data-screen-label="Case studies" style="padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <div style="max-width:640px">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Case studies</span>
        <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(32px,4.2vw,54px);line-height:1.06;letter-spacing:-0.02em">Before, strategy, after.</h2>
      </div>

      <div style="margin-top:clamp(36px,4.5vw,56px);display:flex;flex-direction:column;gap:20px">
        <sc-for list="{{ cases }}" as="cs" hint-placeholder-count="2">
          <article data-reveal="" style="border:1px solid #E2D9C9;border-radius:16px;background:#FFFDFA;padding:clamp(24px,3vw,40px)">
            <div style="display:flex;flex-wrap:wrap;align-items:baseline;justify-content:space-between;gap:12px 24px">
              <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(23px,2.4vw,32px);line-height:1.15">{{ cs.who }}</h3>
              <span style="font-size:13px;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.45)">{{ cs.niche }}</span>
            </div>
            <div style="margin-top:26px;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(200px,100%),1fr));gap:20px">
              <div style="border-left:1px solid #E2D9C9;padding-left:18px">
                <div style="font-size:11.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">Before</div>
                <div style="margin-top:9px;font-size:15.5px;line-height:1.58;color:rgba(30,27,23,0.72);text-wrap:pretty">{{ cs.before }}</div>
              </div>
              <div style="border-left:1px solid #E2D9C9;padding-left:18px">
                <div style="font-size:11.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">Strategy</div>
                <div style="margin-top:9px;font-size:15.5px;line-height:1.58;color:rgba(30,27,23,0.72);text-wrap:pretty">{{ cs.strategy }}</div>
              </div>
              <div style="border-left:1px solid #E2D9C9;padding-left:18px">
                <div style="font-size:11.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(30,27,23,0.42)">After</div>
                <div style="margin-top:9px;font-size:15.5px;line-height:1.58;color:rgba(30,27,23,0.72);text-wrap:pretty">{{ cs.after }}</div>
              </div>
              <div style="border-left:1px solid #B5794A;padding-left:18px">
                <div style="font-size:11.5px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#8A5A34">Result</div>
                <div style="margin-top:9px;font-family:'Newsreader',Georgia,serif;font-size:clamp(24px,2.4vw,32px);line-height:1.05">{{ cs.result }}</div>
                <div style="margin-top:12px;height:6px;border-radius:999px;background:#EDE4D3;overflow:hidden">
                  <div data-bar="{{ cs.pct }}" style="height:100%;width:0%;border-radius:999px;background:#B5794A;transition:width 1100ms cubic-bezier(0.22,1,0.36,1)"></div>
                </div>
                <div style="margin-top:8px;font-size:12.5px;color:rgba(30,27,23,0.48)">{{ cs.window }}</div>
              </div>
            </div>
          </article>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- FREE RESOURCES -->
  <section data-screen-label="Free resources" style="padding:clamp(64px,8vw,110px) clamp(20px,5vw,64px);background:#FAF7F2;border-top:1px solid #E2D9C9">
    <div style="max-width:1360px;margin:0 auto">
      <div style="display:flex;flex-wrap:wrap;align-items:end;justify-content:space-between;gap:20px 40px">
        <div style="max-width:560px">
          <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Free to take</span>
          <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,3.8vw,48px);line-height:1.06;letter-spacing:-0.02em">Start with these.</h2>
        </div>
        <a data-reveal="" href="resources.php" style="font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px;white-space:nowrap" style-hover="border-color:#B5794A;color:#8A5A34">All resources →</a>
      </div>
      <div style="margin-top:clamp(30px,4vw,46px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(280px,100%),1fr));gap:20px">
        <sc-for list="{{ freebies }}" as="r" hint-placeholder-count="3">
          <div data-reveal="" style="border:1px solid #E2D9C9;border-radius:16px;background:#FFFDFA;overflow:hidden;display:flex;flex-direction:column">
            <div style="aspect-ratio:16/9;background:#EDE4D3;overflow:hidden">
              <img src="{{ r.img }}" alt="{{ r.title }}" style="width:100%;height:100%;object-fit:cover;display:block" />
            </div>
            <div style="padding:24px;display:flex;flex-direction:column;gap:12px;flex:1">
              <span style="font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#B5794A">{{ r.kind }}</span>
              <h3 style="margin:0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:23px;line-height:1.16">{{ r.title }}</h3>
              <p style="margin:0;font-size:15px;line-height:1.6;color:rgba(30,27,23,0.64);text-wrap:pretty">{{ r.desc }}</p>
              <button type="button" onClick="{{ r.open }}" style="margin-top:auto;align-self:flex-start;font-family:inherit;font-size:14.5px;font-weight:600;color:#1E1B17;background:transparent;border:1px solid #C9BCA6;border-radius:999px;padding:12px 22px;min-height:44px;cursor:pointer;transition:background 200ms ease,border-color 200ms ease,color 200ms ease" style-hover="background:#1E1B17;border-color:#1E1B17;color:#FAF7F2">Get free resource</button>
            </div>
          </div>
        </sc-for>
      </div>
    </div>
  </section>

  <!-- NEWSLETTER -->
  <section data-screen-label="Newsletter" style="padding:clamp(64px,8vw,104px) clamp(20px,5vw,64px);background:#EDE4D3;border-top:1px solid #E2D9C9;border-bottom:1px solid #E2D9C9">
    <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:clamp(28px,4vw,64px);align-items:start">
      <div>
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#8A5A34">Free weekly letter</span>
        <h2 data-reveal="" style="margin:16px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4vw,52px);line-height:1.05;letter-spacing:-0.02em;text-wrap:balance">The Sunday Note</h2>
        <p data-reveal="" style="margin:16px 0 0;max-width:480px;font-size:17px;line-height:1.62;color:rgba(30,27,23,0.65);text-wrap:pretty">One tactic, one teardown, every Sunday. Written the same morning it goes out — no swipe files, no recycled threads.</p>
        <div data-reveal="" style="margin-top:26px;display:grid;gap:12px;max-width:460px">
          <div style="display:flex;gap:12px;align-items:baseline"><span style="font-size:12px;font-weight:700;color:#B5794A;letter-spacing:0.08em">01</span><span style="font-size:15.5px;line-height:1.5;color:rgba(30,27,23,0.78)">One tactic you can run before Wednesday.</span></div>
          <div style="display:flex;gap:12px;align-items:baseline"><span style="font-size:12px;font-weight:700;color:#B5794A;letter-spacing:0.08em">02</span><span style="font-size:15.5px;line-height:1.5;color:rgba(30,27,23,0.78)">A teardown of a real page, funnel, or launch.</span></div>
          <div style="display:flex;gap:12px;align-items:baseline"><span style="font-size:12px;font-weight:700;color:#B5794A;letter-spacing:0.08em">03</span><span style="font-size:15.5px;line-height:1.5;color:rgba(30,27,23,0.78)">The numbers behind it, including what flopped.</span></div>
        </div>
        <div data-reveal="" style="margin-top:26px;display:flex;flex-wrap:wrap;align-items:center;gap:10px 20px">
          <div style="display:flex;align-items:center">
            <img src="Media/Avatars/maryam.jpg" alt="Reader" style="width:30px;height:30px;border-radius:999px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
            <img src="Media/Avatars/ahmed.jpg" alt="Reader" style="width:30px;height:30px;border-radius:999px;margin-left:-10px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
            <img src="Media/Avatars/hina.jpg" alt="Reader" style="width:30px;height:30px;border-radius:999px;margin-left:-10px;object-fit:cover;border:1.5px solid #EDE4D3;display:inline-block" />
          </div>
          <span style="font-size:14px;color:rgba(30,27,23,0.58)">1,200 readers · 58% open rate</span>
        </div>
      </div>

      <form data-reveal="" action="mail-handler.php" method="post" style="background:#FAF7F2;border:1px solid #D9CDB6;border-radius:20px;padding:clamp(26px,3vw,38px);display:flex;flex-direction:column;gap:14px">
        <div style="display:flex;align-items:baseline;justify-content:space-between;gap:16px;padding-bottom:16px;border-bottom:1px solid #E2D9C9">
          <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(20px,2vw,26px);line-height:1.15">Get this Sunday's issue</span>
          <span style="font-size:12px;letter-spacing:0.08em;text-transform:uppercase;color:rgba(30,27,23,0.45);white-space:nowrap">Free</span>
        </div>
        <input type="hidden" name="list" value="sunday-note" />
        <input type="text" name="hp_field" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0" />
        <label style="display:flex;flex-direction:column;gap:7px">
          <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.55)">First name</span>
          <input type="text" name="name" placeholder="Sania" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;color:#1E1B17;background:#FFFDFA;border:1px solid #D9CDB6;border-radius:12px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
        </label>
        <label style="display:flex;flex-direction:column;gap:7px">
          <span style="font-size:13px;font-weight:600;letter-spacing:0.04em;text-transform:uppercase;color:rgba(30,27,23,0.55)">Email</span>
          <input type="email" name="email" required="required" placeholder="you@email.com" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;color:#1E1B17;background:#FFFDFA;border:1px solid #D9CDB6;border-radius:12px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
        </label>
        <button type="submit" style="margin-top:4px;font-family:inherit;font-size:15px;font-weight:600;color:#FAF7F2;background:#1E1B17;border:0;border-radius:999px;padding:16px 30px;min-height:46px;cursor:pointer;transition:background 200ms ease" style-hover="background:#B5794A">Send me the next issue</button>
        <span style="font-size:12.5px;line-height:1.55;color:rgba(30,27,23,0.5)">Unsubscribe in one click. Your address is never sold or shared.</span>
      </form>
    </div>
  </section>

  <!-- FAQ -->
  <section data-screen-label="FAQ" style="padding:clamp(72px,9vw,120px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(min(300px,100%),1fr));gap:clamp(32px,5vw,72px);align-items:start">
      <div style="position:sticky;top:104px">
        <span data-reveal="" style="display:block;font-size:11.5px;font-weight:700;letter-spacing:0.16em;text-transform:uppercase;color:#B5794A">Questions</span>
        <h2 data-reveal="" style="margin:18px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(30px,4vw,50px);line-height:1.06;letter-spacing:-0.02em">Before you buy or book.</h2>
        <p data-reveal="" style="margin:16px 0 0;max-width:400px;font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.62);text-wrap:pretty">The questions people email me most before they hand over money or an hour of their week. Straight answers, no upsell hidden in the last line.</p>
        <a data-reveal="" href="contact.php" style="display:inline-block;margin-top:22px;font-size:15px;font-weight:600;color:#1E1B17;text-decoration:none;border-bottom:1px solid #C9BCA6;padding-bottom:3px" style-hover="border-color:#B5794A;color:#8A5A34">Still unsure? Ask me directly →</a>
      </div>
      <div style="display:flex;flex-direction:column">
        <sc-for list="{{ faqs }}" as="q" hint-placeholder-count="6">
          <div data-reveal="" style="border-top:1px solid #E2D9C9">
            <button type="button" onClick="{{ q.toggle }}" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:18px;background:transparent;border:0;padding:22px 2px;cursor:pointer;text-align:left;font-family:inherit">
              <span style="font-size:17.5px;font-weight:600;line-height:1.4;color:#1E1B17">{{ q.q }}</span>
              <span style="flex:0 0 auto;width:28px;height:28px;border-radius:999px;border:1px solid #E2D9C9;display:flex;align-items:center;justify-content:center;transform:rotate({{ q.deg }});transition:transform 340ms cubic-bezier(0.22,1,0.36,1);color:#8A5A34;font-size:16px;line-height:1">+</span>
            </button>
            <div style="display:grid;grid-template-rows:{{ q.rows }};transition:grid-template-rows 340ms cubic-bezier(0.22,1,0.36,1)">
              <div style="overflow:hidden">
                <p style="margin:0;padding:0 2px 24px;font-size:16px;line-height:1.65;color:rgba(30,27,23,0.66);max-width:560px;text-wrap:pretty">{{ q.a }}</p>
              </div>
            </div>
          </div>
        </sc-for>
        <div style="border-top:1px solid #E2D9C9"></div>
      </div>
    </div>
  </section>

  <!-- FINAL CTA -->
  <section data-screen-label="Final CTA" style="background:#1E1B17;color:#FAF7F2;padding:clamp(72px,9vw,128px) clamp(20px,5vw,64px)">
    <div style="max-width:1360px;margin:0 auto">
      <h2 data-reveal="" style="margin:0;max-width:840px;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(34px,5.4vw,72px);line-height:1.02;letter-spacing:-0.025em;text-wrap:balance">Two ways to start. Both of them today.</h2>
      <div style="margin-top:clamp(38px,5vw,60px);display:grid;grid-template-columns:repeat(auto-fit,minmax(min(340px,100%),1fr));gap:20px">
        <a data-reveal="" href="courses.php" style="text-decoration:none;color:inherit;border:1px solid rgba(250,247,242,0.18);border-radius:18px;padding:clamp(28px,3.4vw,44px);display:flex;flex-direction:column;gap:14px;min-height:260px;transition:background 240ms ease,border-color 240ms ease" style-hover="background:rgba(250,247,242,0.05);border-color:#D9A879">
          <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#D9A879">Learn at your pace</span>
          <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(28px,3.2vw,40px);line-height:1.08">Take a course</span>
          <span style="font-size:16.5px;line-height:1.62;color:rgba(250,247,242,0.66);max-width:380px;text-wrap:pretty">Seventeen live programmes from PKR 2,000. One hour a night on Zoom, Monday to Friday at 9 PM, recordings included.</span>
          <span style="margin-top:auto;font-size:15px;font-weight:600;color:#FAF7F2">Browse the courses →</span>
        </a>
        <a data-reveal="" href="consulting.php" style="text-decoration:none;color:#1E1B17;background:#FAF7F2;border:1px solid #FAF7F2;border-radius:18px;padding:clamp(28px,3.4vw,44px);display:flex;flex-direction:column;gap:14px;min-height:260px;transition:border-color 220ms ease" style-hover="box-shadow:0 16px 40px rgba(0,0,0,0.25)">
          <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#8A5A34">Direct strategy</span>
          <span style="font-family:'Newsreader',Georgia,serif;font-size:clamp(28px,3.2vw,40px);line-height:1.08">1:1 Consulting</span>
          <span style="font-size:16.5px;line-height:1.62;color:rgba(30,27,23,0.68);max-width:380px;text-wrap:pretty">A dedicated 30-minute private strategy session. Pre-session audit with a custom written 30-day action plan. {{ price }} — {{ slots }} slots left this month.</span>
          <span style="margin-top:auto;font-size:15px;font-weight:600;color:#8A5A34">Book a session →</span>
        </a>
      </div>
    </div>
  </section>

  <dc-import name="SiteFooter" hint-size="100%,460px"></dc-import>

  <div style="height:{{ mobileBarSpace }}"></div>

  <!-- MOBILE STICKY CTA -->
  <sc-if value="{{ showMobileBar }}">
    <div style="position:fixed;left:0;right:0;bottom:0;z-index:800;background:rgba(250,247,242,0.96);backdrop-filter:saturate(180%) blur(14px);border-top:1px solid #E2D9C9;padding:12px 16px calc(12px + env(safe-area-inset-bottom));display:flex;align-items:center;gap:12px">
      <div style="flex:1;min-width:0">
        <div style="font-size:14.5px;font-weight:700;letter-spacing:-0.005em">1:1 Session — {{ price }}</div>
        <div style="font-size:12.5px;color:rgba(30,27,23,0.55)">{{ slots }} slots left in August</div>
      </div>
      <a href="#book" style="flex:0 0 auto;font-size:14.5px;font-weight:600;color:#FAF7F2;background:#B5794A;text-decoration:none;padding:14px 22px;border-radius:999px;min-height:48px;display:flex;align-items:center">Book now</a>
    </div>
  </sc-if>

  <!-- LEAD-GEN MODAL -->
  <sc-if value="{{ modalOpen }}">
    <div onClick="{{ closeModal }}" style="position:fixed;inset:0;z-index:1100;background:rgba(30,27,23,0.55);backdrop-filter:blur(4px);display:flex;align-items:center;justify-content:center;padding:20px">
      <div onClick="{{ stop }}" style="width:min(480px,100%);background:#FAF7F2;border:1px solid #E2D9C9;border-radius:18px;padding:clamp(26px,4vw,38px);box-shadow:0 30px 70px rgba(30,27,23,0.3)">
        <sc-if value="{{ modalForm }}" hint-placeholder-val="{{ true }}">
          <div>
            <div style="display:flex;align-items:start;justify-content:space-between;gap:16px">
              <span style="font-size:11.5px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#B5794A">Free download</span>
              <button type="button" onClick="{{ closeModal }}" aria-label="Close" style="background:transparent;border:0;font-size:24px;line-height:1;color:rgba(30,27,23,0.5);cursor:pointer;padding:0;min-width:32px;min-height:32px">&times;</button>
            </div>
            <h3 style="margin:14px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:clamp(24px,3vw,32px);line-height:1.12">{{ modalTitle }}</h3>
            <p style="margin:14px 0 0;font-size:15.5px;line-height:1.6;color:rgba(30,27,23,0.64)">Drop your email and the download link appears right here — no confirmation maze.</p>
            <div style="margin-top:22px;display:flex;flex-direction:column;gap:10px">
              <input type="email" value="{{ leadEmail }}" onInput="{{ setLeadEmail }}" placeholder="you@email.com" style="box-sizing:border-box;font-family:Manrope,system-ui,sans-serif;font-size:16px;color:#1E1B17;background:#FFFDFA;border:1px solid #E2D9C9;border-radius:10px;padding:11px 16px;min-height:44px;outline:none" style-focus="border-color:#B5794A" />
              <button type="button" onClick="{{ submitLead }}" style="font-family:inherit;font-size:15px;font-weight:600;color:#FAF7F2;background:#B5794A;border:0;border-radius:10px;padding:15px 20px;min-height:44px;cursor:pointer;transition:background 200ms ease" style-hover="background:#8A5A34">Send me the file</button>
              <sc-if value="{{ leadError }}">
                <span style="font-size:13.5px;color:#9A4A34">Please enter a valid email address.</span>
              </sc-if>
              <span style="font-size:12.5px;line-height:1.55;color:rgba(30,27,23,0.48)">You'll also get The Sunday Note. One click to leave.</span>
            </div>
          </div>
        </sc-if>
        <sc-if value="{{ modalDone }}">
          <div style="text-align:center">
            <div style="width:46px;height:46px;border-radius:999px;background:#4C7A5E;color:#FAF7F2;display:flex;align-items:center;justify-content:center;margin:0 auto;font-size:21px">✓</div>
            <h3 style="margin:20px 0 0;font-family:'Newsreader',Georgia,serif;font-weight:400;font-size:26px;line-height:1.15">It's yours.</h3>
            <p style="margin:12px 0 0;font-size:15.5px;line-height:1.6;color:rgba(30,27,23,0.64)">Download below — a copy is on its way to your inbox too.</p>
            <a href="#" style="display:inline-block;margin-top:20px;font-size:15px;font-weight:600;color:#FAF7F2;background:#1E1B17;text-decoration:none;padding:15px 26px;border-radius:999px">Download {{ modalTitle }}</a>
            <button type="button" onClick="{{ closeModal }}" style="display:block;margin:16px auto 0;font-family:inherit;font-size:14px;color:rgba(30,27,23,0.5);background:transparent;border:0;cursor:pointer">Close</button>
          </div>
        </sc-if>
      </div>
    </div>
  </sc-if>
</div>
</x-dc>
<script type="text/x-dc" data-dc-script data-props="{&quot;consultingPrice&quot;:{&quot;editor&quot;:&quot;text&quot;,&quot;default&quot;:&quot;PKR 1,000&quot;,&quot;tsType&quot;:&quot;string&quot;,&quot;section&quot;:&quot;Offer&quot;},&quot;slotsLeft&quot;:{&quot;editor&quot;:&quot;int&quot;,&quot;default&quot;:4,&quot;min&quot;:0,&quot;max&quot;:12,&quot;tsType&quot;:&quot;number&quot;,&quot;section&quot;:&quot;Offer&quot;},&quot;showMobileCta&quot;:{&quot;editor&quot;:&quot;boolean&quot;,&quot;default&quot;:true,&quot;tsType&quot;:&quot;boolean&quot;,&quot;section&quot;:&quot;Behaviour&quot;}}">
const TESTIMONIALS = [
  { course: 'Pinterest Affiliate Marketing', quote: 'First affiliate sale in 11 days, and it was from a pin I nearly did not publish.', name: 'Hira Nadeem', role: 'Home & living blogger', result: 'PKR 40K/mo', window: '5 months', avatar: 'Media/Avatars/hina.jpg' },
  { course: '1:1 Session', quote: 'She told me to delete two thirds of my offers. Income went up the next month.', name: 'Bilal Ahmed', role: 'Tech reviewer', result: '+62%', window: '60 days', avatar: 'Media/Avatars/bilal.jpg' },
  { course: 'Website Design', quote: 'I had a live site by the end of the second week. Clients stopped asking who built it.', name: 'Ayesha Raza', role: 'Freelance designer', result: '3 clients', window: '2 months', avatar: 'Media/Avatars/ayesha.jpg' },
  { course: 'Shopify Store Setup', quote: 'Classes at 9 PM meant I could keep my job while setting the store up.', name: 'Zainab Iqbal', role: 'Home-baked goods', result: 'First 30 orders', window: '6 weeks', avatar: 'Media/Avatars/zainab.jpg' },
  { course: 'Graphics Designing', quote: 'Six real pieces in my portfolio, and the first two paid jobs came from them.', name: 'Usman Tariq', role: 'Designer', result: '2 clients', window: '1 month', avatar: 'Media/Avatars/usman.jpg' },
  { course: 'Pinterest + Etsy', quote: 'The listing rewrite alone doubled my views. I stopped guessing at keywords.', name: 'Mahnoor Shah', role: 'Digital printables', result: '18 sales', window: '7 weeks', avatar: 'Media/Avatars/maryam.jpg' },
  { course: 'Landing Pages', quote: 'My page finally says one thing. Enquiries went from rare to weekly.', name: 'Fatima Khalid', role: 'Skincare brand', result: '4x enquiries', window: '5 weeks', avatar: 'Media/Avatars/ayesha.jpg' },
  { course: 'SEO', quote: 'Ranked for a keyword I had chased for two years, in six weeks, by fixing structure.', name: 'Hamza Sheikh', role: 'Recipe site owner', result: '9K sessions', window: '6 weeks', avatar: 'Media/Avatars/saad.jpg' }
];

class Component extends DCLogic {
  state = {
    openSkill: 0, openFaq: -1,
    modal: null, leadEmail: '', leadError: false, leadDone: false,
    narrow: false, pastHero: false
  };

  componentDidMount() {
    this._resize = () => {
      const n = window.innerWidth < 780;
      if (n !== this.state.narrow) this.setState({ narrow: n });
    };
    this._scroll = () => {
      const p = (window.scrollY || 0) > window.innerHeight * 0.85;
      if (p !== this.state.pastHero) this.setState({ pastHero: p });
    };
    window.addEventListener('resize', this._resize);
    window.addEventListener('scroll', this._scroll, { passive: true });
    this._resize(); this._scroll();

    requestAnimationFrame(() => this.initMotion());
  }

  componentWillUnmount() {
    window.removeEventListener('resize', this._resize);
    window.removeEventListener('scroll', this._scroll);
    if (this._io) this._io.disconnect();
    if (window.ScrollTrigger) ScrollTrigger.getAll().forEach(t => t.kill());
  }

  initMotion() {
    const root = document.body;
    const hoverable = window.matchMedia('(hover: hover)').matches;
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const reveals = Array.from(root.querySelectorAll('[data-reveal]'));
    const g = window.gsap;

    if (g && window.ScrollTrigger && !reduced) {
      g.registerPlugin(ScrollTrigger);
      reveals.forEach(el => {
        g.fromTo(el, { opacity: 0, y: 26 }, {
          opacity: 1, y: 0, duration: 0.7, ease: 'power2.out',
          scrollTrigger: { trigger: el, start: 'top 88%', once: true }
        });
      });
      root.querySelectorAll('[data-parallax]').forEach(el => {
        g.to(el, {
          yPercent: -14, ease: 'none',
          scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true }
        });
      });
      const line = root.querySelector('[data-progress-line]');
      if (line) {
        g.to(line, {
          width: '100%', ease: 'none',
          scrollTrigger: { trigger: line.parentElement, start: 'top 78%', end: 'bottom 55%', scrub: 0.4 }
        });
      }
    } else if (!reduced) {
      reveals.forEach(el => { el.style.opacity = '0'; el.style.transform = 'translateY(24px)'; el.style.transition = 'opacity 700ms ease, transform 700ms cubic-bezier(0.22,1,0.36,1)'; });
      const io = new IntersectionObserver(es => es.forEach(e => {
        if (e.isIntersecting) { e.target.style.opacity = '1'; e.target.style.transform = 'none'; io.unobserve(e.target); }
      }), { rootMargin: '0px 0px -10% 0px' });
      reveals.forEach(el => io.observe(el));
      const line = root.querySelector('[data-progress-line]');
      if (line) {
        const lio = new IntersectionObserver(es => es.forEach(e => {
          if (e.isIntersecting) { line.style.transition = 'width 1400ms cubic-bezier(0.22,1,0.36,1)'; line.style.width = '100%'; lio.disconnect(); }
        }), { threshold: 0.05 });
        lio.observe(line.parentElement);
      }
    }

    // counters + result bars — once, on first view
    this._io = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target;
        this._io.unobserve(el);
        if (el.hasAttribute('data-bar')) { el.style.width = el.getAttribute('data-bar') + '%'; return; }
        const target = parseFloat(el.getAttribute('data-count'));
        const dec = parseInt(el.getAttribute('data-decimals') || '0', 10);
        const comma = el.getAttribute('data-format') === 'comma';
        const t0 = performance.now(), dur = 1400;
        const tick = now => {
          const p = Math.min(1, (now - t0) / dur);
          const eased = 1 - Math.pow(1 - p, 3);
          const v = target * eased;
          el.textContent = comma ? Math.round(v).toLocaleString('en-US') : v.toFixed(dec);
          if (p < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
      });
    }, { threshold: 0.4 });
    root.querySelectorAll('[data-count],[data-bar]').forEach(el => this._io.observe(el));

    if (!hoverable) return;
    root.querySelectorAll('[data-tilt]').forEach(card => {
      const base = getComputedStyle(card).borderColor;
      card.style.transition = 'border-color 220ms ease';
      card.addEventListener('mouseenter', () => { card.style.borderColor = 'rgba(181,121,74,0.5)'; });
      card.addEventListener('mouseleave', () => { card.style.borderColor = base; });
    });
  }

  renderVals() {
    const st = this.state;
    const price = this.props.consultingPrice ?? 'PKR 1,000';
    const slots = this.props.slotsLeft ?? 4;

    const skills = [
      { name: 'Pinterest Marketing', body: 'Treat Pinterest as a search engine with a shopping habit — keyword-led pin design, boards that rank, and a publishing cadence you can keep.', tags: ['Keyword research', 'Pin design systems', 'Board architecture', 'Scheduling cadence', 'Analytics reading'] },
      { name: 'Affiliate Marketing', body: 'Choosing offers that convert for your audience, stacking them across a single piece of content, and negotiating better rates once you have data.', tags: ['Offer selection', 'Comparison content', 'Link management', 'Rate negotiation'] },
      { name: 'Content Creation', body: 'A repeatable pipeline: research, outline, produce, repurpose. Enough structure that quality survives a bad week.', tags: ['Content pipeline', 'Repurposing', 'Hooks & titles', 'Batching'] },
      { name: 'SEO & Website Design', body: 'A site that ranks and sells — structure, speed, internal linking, and pages designed around one decision each.', tags: ['On-page SEO', 'Site structure', 'Landing pages', 'Core Web Vitals'] },
      { name: 'Personal Branding', body: 'Positioning that makes the offer obvious. What you are known for, said in one line, repeated everywhere.', tags: ['Positioning', 'Voice & tone', 'Visual identity', 'Proof building'] }
    ].map((s, i) => ({
      name: s.name, body: s.body, tags: s.tags,
      rows: st.openSkill === i ? '1fr' : '0fr',
      deg: st.openSkill === i ? '45deg' : '0deg',
      toggle: () => this.setState(p => ({ openSkill: p.openSkill === i ? -1 : i }))
    }));

    const faqs = [
      { q: 'Are the courses beginner-friendly?', a: 'Yes — every course starts at zero and assumes no audience. If a module is advanced, it is marked so you can come back to it once the basics are earning.' },
      { q: 'How long do I have access?', a: 'Recordings of every class stay yours, and you can rejoin the live batch once for free if life gets in the way.' },
      { q: 'What actually happens in a 1:1 session?', a: 'You send links and numbers in advance. I audit them and arrive with a shortlist of changes. We spend 30 minutes deciding, and you get a written 30-day plan within 48 hours.' },
      { q: 'Do you guarantee results?', a: 'No, and be wary of anyone who does. I guarantee the system is the one I use, taught in full, with no upsell hiding the important part.' },
      { q: 'Is there a refund policy?', a: '14 days on every course, no questions asked. 1:1 sessions can be rescheduled once with 48 hours notice; refunds are available before the audit begins.' },
      { q: 'Who teaches the courses?', a: 'I teach the Pinterest, affiliate and content programmes. M. Saqib teaches web design and development, WordPress, landing pages, SEO, graphics, Shopify and ads; Aqib teaches Forex and Binary Trading. Each course is taught live by the person who does that work daily.' },
      { q: 'What time do the classes run?', a: 'Every class is live on Zoom at 9 PM PKT, one hour, Monday to Friday — weekends off. If you miss one, the recording is up the same night.' }
    ].map((q, i) => ({
      q: q.q, a: q.a,
      rows: st.openFaq === i ? '1fr' : '0fr',
      deg: st.openFaq === i ? '45deg' : '0deg',
      toggle: () => this.setState(p => ({ openFaq: p.openFaq === i ? -1 : i }))
    }));

    const freebies = [
      { kind: 'Template', title: 'The 30-Pin Starter Calendar', desc: 'A month of pin ideas, keyword slots, and posting times — fill in your niche and publish.', img: 'Media/Resources/starter_calendar.jpg' },
      { kind: 'Checklist', title: 'Affiliate Offer Audit', desc: 'Twelve questions that tell you whether an offer is worth your traffic before you promote it.', img: 'Media/Resources/affiliate_audit.jpg' },
      { kind: 'Guide', title: 'Your First 1,000 Clicks', desc: 'The exact sequence I use to take a brand-new account from zero to consistent outbound clicks.', img: 'Media/Resources/first_1000_clicks.jpg' }
    ].map(r => Object.assign({}, r, { open: () => this.setState({ modal: r.title, leadEmail: '', leadError: false, leadDone: false }) }));

    return {
      milestones: [
        { year: '2019', text: 'Started writing product roundups nobody read. Learned SEO out of frustration.' },
        { year: '2021', text: 'First PKR 60K affiliate month — entirely from Pinterest search traffic.' },
        { year: '2023', text: 'Taught the system live to 60 students in the first batch.' },
        { year: '2026', text: '500+ students taught, live on Zoom, and 1:1 work with creators scaling past their first PKR 100K months.' }
      ],
      courses: [
        { tag: 'Affiliate', title: 'Pinterest + Etsy', live: '22 Live Classes', days: '22 Days', time: '9 PM PKT', sub: 'Mon–Fri · 1 month', price: 'PKR 15,000', href: 'courses/pinterest-etsy', img: 'Media/Courses/Pinterest-Etsy.jpeg' },
        { tag: 'Development', title: 'Website Development', live: '22 Live Classes', days: '22 Days', time: '9 PM PKT', sub: 'Mon–Fri · 1 month', price: 'PKR 15,000', href: 'courses/website-development', img: 'Media/Courses/Website-development.jpeg' },
        { tag: 'SEO', title: 'SEO', live: '22 Live Classes', days: '22 Days', time: '9 PM PKT', sub: 'Mon–Fri · 1 month', price: 'PKR 15,000', href: 'courses/seo', img: 'Media/Courses/SEO.jpeg' },
        { tag: 'Ecommerce', title: 'Shopify Dropshipping', live: '11 Live Classes', days: '11 Days', time: '9 PM PKT', sub: 'Mon–Fri · 15 days', price: 'PKR 10,000', href: 'courses/shopify-dropshipping', img: 'Media/Courses/Shopify-dropshipping.jpeg' },
        { tag: 'Trading', title: 'Forex Trading', live: '22 Live Classes', days: '22 Days', time: '9 PM PKT', sub: 'Mon–Fri · 1 month', price: '$200', href: 'courses/forex-trading', img: 'Media/Courses/Forex-Trading.jpeg' }
      ],
      flagshipPoints: [
        { n: '01', title: 'Keyword-led pin design', body: 'Design decisions driven by search intent, not aesthetics — with the templates I actually use.' },
        { n: '02', title: 'The 90-day cadence', body: 'What to publish weekly for a full quarter, and what to ignore while the account matures.' },
        { n: '03', title: 'The offer stack', body: 'How three to five affiliate offers live inside one piece of content without feeling like a sales page.' },
        { n: '04', title: 'Reading the data', body: 'The four Pinterest metrics that predict revenue, and the ones that waste your attention.' }
      ],
      steps: [
        { n: '01', title: 'Book & send context', body: 'Request a slot and share links, numbers, and the thing that is stuck. Takes you five minutes.' },
        { n: '02', title: 'I audit before we meet', body: 'I go through your content, analytics, and offers, and arrive with a shortlist — not questions.' },
        { n: '03', title: '30 minutes, then a plan', body: 'We decide on the call. Within 48 hours you get a written 30-day plan with priorities in order.' }
      ],
      testimonials: TESTIMONIALS.map((t, i) => {
        const dark = i === 1 || i === 5;
        const big = i === 0 || i === 4;
        return Object.assign({}, t, {
          bg: dark ? '#1E1B17' : '#FAF7F2',
          fg: dark ? '#FAF7F2' : '#1E1B17',
          border: dark ? '#1E1B17' : '#E2D9C9',
          rule: dark ? 'rgba(250,247,242,0.18)' : '#E2D9C9',
          tagBg: dark ? 'rgba(250,247,242,0.1)' : '#EDE4D3',
          tagFg: dark ? '#D9A879' : '#8A5A34',
          stars: dark ? '#D9A879' : '#B5794A',
          roleFg: dark ? 'rgba(250,247,242,0.6)' : 'rgba(30,27,23,0.55)',
          resultFg: dark ? '#D9A879' : '#4C7A5E',
          windowFg: dark ? 'rgba(250,247,242,0.45)' : 'rgba(30,27,23,0.42)',
          pad: big ? '26px' : '20px',
          size: big ? 'clamp(21px,1.9vw,25px)' : '18.5px'
        });
      }),
      cases: [
        { who: 'From 400 monthly views to a full-time income', niche: 'Home & living', before: 'Nine months of daily pinning, 400 monthly views, zero commissions.', strategy: 'Rebuilt boards around four keyword clusters; cut posting to three pins a day with intent-led titles.', after: 'Consistent outbound clicks within six weeks; two offers doing 80% of revenue.', result: 'PKR 85K/mo', pct: 86, window: 'month 7' },
        { who: 'A plateaued reviewer who was promoting too much', niche: 'Consumer tech', before: 'PKR 55K/mo across 11 affiliate programs, flat for a year.', strategy: 'Cut to four offers, rebuilt three comparison pages, renegotiated two rates on the back of the data.', after: 'Fewer pages, higher intent traffic, better commission tiers.', result: 'PKR 140K/mo', pct: 68, window: '90 days' }
      ],
      skills, faqs, freebies,

      modalOpen: !!st.modal,
      modalTitle: st.modal || '',
      modalForm: !!st.modal && !st.leadDone,
      modalDone: !!st.modal && st.leadDone,
      leadEmail: st.leadEmail,
      leadError: st.leadError,
      setLeadEmail: e => this.setState({ leadEmail: e.target.value, leadError: false }),
      submitLead: () => {
        const ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(this.state.leadEmail);
        this.setState(ok ? { leadDone: true } : { leadError: true });
      },
      closeModal: () => this.setState({ modal: null }),
      stop: e => e.stopPropagation(),

      price, slots: String(slots), slotsNum: slots,
      showMobileBar: (this.props.showMobileCta !== false) && st.narrow && st.pastHero,
      mobileBarSpace: (this.props.showMobileCta !== false) && st.narrow && st.pastHero ? '78px' : '0px'
    };
  }
}
</script>
</body>
</html>
