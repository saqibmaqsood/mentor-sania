// Shared scroll-motion layer — "restrained premium".
// Uses GSAP + ScrollTrigger when present, IntersectionObserver otherwise.
// Reveals: fade + rise 26px, 0.7s power2.out, once. Tilt: max ±7deg, hover-capable pointers only.

export function initMotion(root) {
  root = root || document.body;
  const g = window.gsap;
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const hoverable = window.matchMedia('(hover: hover)').matches;
  const reveals = Array.from(root.querySelectorAll('[data-reveal]'));

  if (g && window.ScrollTrigger && !reduced) {
    g.registerPlugin(window.ScrollTrigger);
    reveals.forEach(el => g.fromTo(el, { opacity: 0, y: 26 }, {
      opacity: 1, y: 0, duration: 0.7, ease: 'power2.out',
      scrollTrigger: { trigger: el, start: 'top 88%', once: true }
    }));
    root.querySelectorAll('[data-parallax]').forEach(el => g.to(el, {
      yPercent: -14, ease: 'none',
      scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true }
    }));
    const line = root.querySelector('[data-progress-line]');
    if (line) g.to(line, {
      width: '100%', ease: 'none',
      scrollTrigger: { trigger: line.parentElement, start: 'top 78%', end: 'bottom 55%', scrub: 0.4 }
    });
  } else if (!reduced) {
    reveals.forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      el.style.transition = 'opacity 700ms ease, transform 700ms cubic-bezier(0.22,1,0.36,1)';
    });
    const io = new IntersectionObserver(es => es.forEach(e => {
      if (!e.isIntersecting) return;
      e.target.style.opacity = '1';
      e.target.style.transform = 'none';
      io.unobserve(e.target);
    }), { rootMargin: '0px 0px -10% 0px' });
    reveals.forEach(el => io.observe(el));
    const line = root.querySelector('[data-progress-line]');
    if (line) {
      const lio = new IntersectionObserver(es => es.forEach(e => {
        if (!e.isIntersecting) return;
        line.style.transition = 'width 1400ms cubic-bezier(0.22,1,0.36,1)';
        line.style.width = '100%';
        lio.disconnect();
      }), { threshold: 0.05 });
      lio.observe(line.parentElement);
    }
  }

  // counters and result bars — animate once, on first view
  const once = new IntersectionObserver(entries => entries.forEach(e => {
    if (!e.isIntersecting) return;
    const el = e.target;
    once.unobserve(el);
    if (el.hasAttribute('data-bar')) { el.style.width = el.getAttribute('data-bar') + '%'; return; }
    const target = parseFloat(el.getAttribute('data-count'));
    const dec = parseInt(el.getAttribute('data-decimals') || '0', 10);
    const comma = el.getAttribute('data-format') === 'comma';
    const t0 = performance.now(), dur = 1400;
    const tick = now => {
      const p = Math.min(1, (now - t0) / dur);
      const v = target * (1 - Math.pow(1 - p, 3));
      el.textContent = comma ? Math.round(v).toLocaleString('en-US') : v.toFixed(dec);
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }), { threshold: 0.4 });
  root.querySelectorAll('[data-count],[data-bar]').forEach(el => once.observe(el));

  if (!hoverable) return;
  root.querySelectorAll('[data-tilt]').forEach(card => {
    const base = getComputedStyle(card).borderColor;
    card.style.transition = 'border-color 220ms ease';
    card.addEventListener('mouseenter', () => { card.style.borderColor = 'rgba(181,121,74,0.5)'; });
    card.addEventListener('mouseleave', () => { card.style.borderColor = base; });
  });
}
