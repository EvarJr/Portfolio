<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= esc($header['name'] ?? 'Portfolio') ?> — <?= esc($about['tagline'] ?? 'Portfolio') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Cabinet+Grotesk:wght@300;400;500;700;800;900&family=DM+Mono:ital,wght@0,300;0,400;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ════════════════════════════════════════════
   SIGNAL — Design System
   ════════════════════════════════════════════ */
:root {
  --ink:      #050810;
  --ink-2:    #0b0f1e;
  --ink-3:    #0d1117;
  --slate:    #1a2038;
  --blue:     #3b82f6;
  --blue-v:   #6366f1;
  --purple:   #8b5cf6;
  --cyan:     #06b6d4;
  --green:    #10b981;
  --g-accent: linear-gradient(135deg,#3b82f6 0%,#8b5cf6 50%,#06b6d4 100%);
  --g-hero:   linear-gradient(135deg,#050810 0%,#0f1535 40%,#1a0a3d 100%);
  --g-card:   linear-gradient(145deg,rgba(255,255,255,0.04) 0%,rgba(255,255,255,0.01) 100%);
  --text:     #f1f5f9;
  --text-2:   #94a3b8;
  --text-3:   #475569;
  --border:   rgba(255,255,255,0.07);
  --border-p: rgba(99,102,241,0.3);
  --radius:   18px;
  --nav-h:    70px;
  --font-d:   'Clash Display','Cabinet Grotesk',sans-serif;
  --font-b:   'Cabinet Grotesk',sans-serif;
  --font-m:   'DM Mono',monospace;
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--font-b);background:var(--ink);color:var(--text);overflow-x:hidden;-webkit-font-smoothing:antialiased}

/* ── SCROLL PROGRESS BAR ── */
#scroll-progress{
  position:fixed;top:0;left:0;z-index:9999;
  height:3px;width:0%;
  background:var(--g-accent);
  transition:width 0.1s linear;
  pointer-events:none;
}

/* ── NOISE OVERLAY ── */
body::before{
  content:'';position:fixed;inset:0;z-index:0;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
  opacity:0.35;
}

/* ════════════════════════════════════════════
   NAVBAR
   ════════════════════════════════════════════ */
.navbar{
  position:fixed;top:0;left:0;right:0;z-index:500;
  height:var(--nav-h);
  background:rgba(5,8,16,0.88);
  backdrop-filter:blur(20px) saturate(180%);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;
  padding:0 8vw;gap:28px;
}
.nav-brand{display:flex;align-items:center;gap:11px;text-decoration:none;flex-shrink:0}
.nav-avatar{
  width:38px;height:38px;border-radius:11px;
  background:var(--g-accent);
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-family:var(--font-d);font-size:15px;font-weight:700;
  overflow:hidden;flex-shrink:0;
  box-shadow:0 0 0 1px rgba(139,92,246,0.4),0 4px 16px rgba(99,102,241,0.3);
}
.nav-avatar img{width:100%;height:100%;object-fit:cover}
.nav-name{font-family:var(--font-d);font-size:15px;font-weight:600;color:var(--text);letter-spacing:-0.3px}
.nav-name span{font-weight:300;opacity:0.65}
.nav-links{display:flex;align-items:center;gap:2px;margin-left:auto}
.nav-link{
  padding:7px 14px;border-radius:9px;
  text-decoration:none;font-size:13px;font-weight:500;
  color:var(--text-2);transition:all 0.2s;white-space:nowrap;
  font-family:var(--font-b);
}
.nav-link:hover,.nav-link.active{color:var(--text);background:rgba(255,255,255,0.06)}
.nav-btn{
  padding:9px 22px;background:var(--g-accent);color:#fff;
  border-radius:50px;font-size:12.5px;font-weight:700;
  font-family:var(--font-d);text-decoration:none;
  margin-left:8px;transition:all 0.2s;
  box-shadow:0 4px 20px rgba(99,102,241,0.4);letter-spacing:0.3px;
}
.nav-btn:hover{transform:translateY(-1px);box-shadow:0 8px 28px rgba(99,102,241,0.5)}
.nav-hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:6px;margin-left:12px}
.nav-hamburger span{display:block;width:22px;height:2px;background:var(--text-2);border-radius:2px;transition:all 0.3s}

/* ════════════════════════════════════════════
   HERO
   ════════════════════════════════════════════ */
.hero{
  position:relative;min-height:100vh;
  margin-top:var(--nav-h);
  background:var(--g-hero);
  display:flex;align-items:center;
  padding:60px 8vw 120px;gap:72px;overflow:visible;
  max-width:100%;
}
.hero-orb{position:absolute;border-radius:50%;pointer-events:none;filter:blur(80px)}
.hero-orb-1{width:520px;height:520px;top:-120px;right:-100px;background:radial-gradient(circle,rgba(99,102,241,0.22) 0%,transparent 70%);animation:orbFloat 9s ease-in-out infinite}
.hero-orb-2{width:400px;height:400px;bottom:-60px;left:-80px;background:radial-gradient(circle,rgba(139,92,246,0.14) 0%,transparent 70%);animation:orbFloat 12s ease-in-out infinite reverse}
.hero-orb-3{width:280px;height:280px;top:35%;right:28%;background:radial-gradient(circle,rgba(6,182,212,0.09) 0%,transparent 70%);animation:orbFloat 15s ease-in-out infinite}
@keyframes orbFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-28px) scale(1.04)}}
.hero::after{
  content:'';position:absolute;bottom:-2px;left:0;right:0;height:90px;
  background:var(--ink-3);
  clip-path:polygon(0 55%,100% 0%,100% 100%,0% 100%);
  z-index:2;
}

/* Photo */
.hero-photo-wrap{flex-shrink:0;position:relative;z-index:3;animation:heroPhotoIn 1s cubic-bezier(0.16,1,0.3,1) both}
@keyframes heroPhotoIn{from{opacity:0;transform:translateX(-40px) rotate(-3deg)}to{opacity:1;transform:translateX(0) rotate(0)}}
.hero-photo-frame{
  width:360px;height:440px;border-radius:30px;
  position:relative;overflow:hidden;
  background:linear-gradient(145deg,rgba(99,102,241,0.18),rgba(139,92,246,0.08));
  border:1px solid rgba(99,102,241,0.22);
  box-shadow:0 0 0 1px rgba(99,102,241,0.12),0 32px 80px rgba(0,0,0,0.55),inset 0 1px 0 rgba(255,255,255,0.07);
}
.hero-photo-frame img{width:100%;height:100%;object-fit:cover;object-position:center top;display:block}
.photo-placeholder{width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:80px;color:rgba(99,102,241,0.35)}
.hero-badge{
  position:absolute;bottom:-18px;left:50%;transform:translateX(-50%);
  background:linear-gradient(135deg,#1a2038,#212940);
  border:1px solid rgba(99,102,241,0.4);
  border-radius:50px;padding:8px 18px;
  font-size:11px;font-weight:600;font-family:var(--font-d);
  color:var(--text);white-space:nowrap;
  box-shadow:0 8px 32px rgba(0,0,0,0.4),0 0 0 1px rgba(99,102,241,0.18);
  display:flex;align-items:center;gap:7px;letter-spacing:0.3px;
}
.badge-dot{width:7px;height:7px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,0.22);animation:pulseDot 2s ease-in-out infinite}
@keyframes pulseDot{0%,100%{box-shadow:0 0 0 3px rgba(34,197,94,0.22)}50%{box-shadow:0 0 0 6px rgba(34,197,94,0.08)}}

/* Stats on photo */
.hero-stat{
  position:absolute;background:rgba(5,8,16,0.92);
  backdrop-filter:blur(12px);
  border:1px solid var(--border-p);border-radius:13px;
  padding:10px 13px;box-shadow:0 8px 28px rgba(0,0,0,0.45);
}
.hero-stat-1{top:22px;right:-30px}
.hero-stat-2{top:50%;right:-38px;transform:translateY(-50%)}
.hero-stat .s-val{font-family:var(--font-d);font-size:18px;font-weight:700;color:var(--text)}
.hero-stat .s-lbl{font-size:9px;color:var(--text-3);margin-top:1px;font-family:var(--font-m);text-transform:uppercase;letter-spacing:0.8px}

/* Text */
.hero-text{flex:1;min-width:0;z-index:3;position:relative;animation:heroTextIn 1s cubic-bezier(0.16,1,0.3,1) 0.15s both}
@keyframes heroTextIn{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.hero-mono{font-family:var(--font-m);font-size:11.5px;color:var(--cyan);letter-spacing:2px;text-transform:uppercase;margin-bottom:16px;display:flex;align-items:center;gap:10px}
.hero-mono::before{content:'';display:inline-block;width:30px;height:1px;background:var(--cyan)}
.hero-name{font-family:var(--font-d);font-size:clamp(44px,5.5vw,76px);font-weight:700;line-height:1.0;color:var(--text);margin-bottom:10px;letter-spacing:-2px}
.hero-name-accent{background:var(--g-accent);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;display:block}
.hero-pill{display:inline-flex;align-items:center;gap:7px;background:rgba(99,102,241,0.1);border:1px solid rgba(99,102,241,0.22);border-radius:50px;padding:6px 14px;font-size:11.5px;font-weight:600;color:#a5b4fc;margin-bottom:20px;font-family:var(--font-d);letter-spacing:0.2px}

/* ── CREDENTIAL BADGES ── */
.cred-row{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:22px}
.cred-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(16,185,129,0.08);
  border:1px solid rgba(16,185,129,0.22);
  border-radius:50px;padding:5px 12px;
  font-size:11px;font-weight:500;color:#6ee7b7;
  font-family:var(--font-b);
}
.cred-badge i{font-size:9px;color:#10b981}
.cred-badge.dost{background:rgba(6,182,212,0.08);border-color:rgba(6,182,212,0.22);color:#67e8f9}
.cred-badge.dost i{color:var(--cyan)}
.cred-badge.award{background:rgba(251,191,36,0.08);border-color:rgba(251,191,36,0.2);color:#fde68a}
.cred-badge.award i{color:#fbbf24}

.hero-bio{font-size:15px;line-height:1.85;color:var(--text-2);max-width:580px;margin-bottom:32px;font-weight:400}
.hero-btns{display:flex;gap:13px;flex-wrap:wrap;margin-bottom:30px}
.btn-primary{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;background:var(--g-accent);color:#fff;border-radius:50px;font-size:13.5px;font-weight:700;font-family:var(--font-d);text-decoration:none;transition:all 0.25s;box-shadow:0 4px 22px rgba(99,102,241,0.42);letter-spacing:0.3px}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(99,102,241,0.55)}
.btn-ghost{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:transparent;color:var(--text-2);border-radius:50px;border:1px solid var(--border);font-size:13.5px;font-weight:600;font-family:var(--font-d);text-decoration:none;transition:all 0.25s;letter-spacing:0.3px}
.btn-ghost:hover{border-color:rgba(99,102,241,0.45);color:var(--text);background:rgba(99,102,241,0.07)}
.hero-socials{display:flex;gap:9px}
.social-icon{width:40px;height:40px;border-radius:11px;background:rgba(255,255,255,0.04);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-3);text-decoration:none;font-size:14px;transition:all 0.2s}
.social-icon:hover{background:rgba(99,102,241,0.14);border-color:rgba(99,102,241,0.38);color:#a5b4fc;transform:translateY(-2px)}

/* ── ANIMATED COUNTERS ROW ── */
.counters-row{display:flex;gap:14px;margin-top:28px;flex-wrap:wrap}
.counter-chip{
  display:flex;align-items:center;gap:9px;
  background:rgba(255,255,255,0.03);
  border:1px solid var(--border);
  border-radius:12px;padding:10px 16px;
  transition:border-color 0.3s;
}
.counter-chip:hover{border-color:rgba(99,102,241,0.3)}
.counter-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.counter-icon.blue{background:rgba(99,102,241,0.15);color:#a5b4fc}
.counter-icon.cyan{background:rgba(6,182,212,0.12);color:#67e8f9}
.counter-icon.green{background:rgba(16,185,129,0.12);color:#6ee7b7}
.counter-val{font-family:var(--font-d);font-size:20px;font-weight:700;color:var(--text);line-height:1}
.counter-lbl{font-size:10px;color:var(--text-3);margin-top:2px;font-family:var(--font-m);text-transform:uppercase;letter-spacing:0.7px}

/* ════════════════════════════════════════════
   SHARED SECTION STYLES
   ════════════════════════════════════════════ */
.section-eyebrow{font-family:var(--font-m);font-size:10.5px;letter-spacing:3px;text-transform:uppercase;margin-bottom:9px;display:flex;align-items:center;gap:9px}
.section-eyebrow::before{content:'';display:inline-block;width:22px;height:1px}
.ey-purple{color:var(--purple)}.ey-purple::before{background:var(--purple)}
.ey-cyan{color:var(--cyan)}.ey-cyan::before{background:var(--cyan)}
.ey-blue{color:var(--blue)}.ey-blue::before{background:var(--blue)}
.ey-green{color:var(--green)}.ey-green::before{background:var(--green)}
.section-title{font-family:var(--font-d);font-size:clamp(26px,2.8vw,40px);font-weight:700;color:var(--text);letter-spacing:-1px;line-height:1.1}
.section-title span{background:var(--g-accent);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

/* ════════════════════════════════════════════
   SERVICES
   ════════════════════════════════════════════ */
.services-section{background:var(--ink-3);padding:0 8vw 70px}
.services-header{padding-top:60px;margin-bottom:36px;width:100%}
.services-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px;position:relative;z-index:5}
.service-card{background:var(--g-card);border:1px solid var(--border);border-radius:var(--radius);padding:26px;transition:all 0.3s;position:relative;overflow:hidden}
.service-card::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(99,102,241,0.06) 0%,transparent 60%);opacity:0;transition:opacity 0.3s}
.service-card:hover::before{opacity:1}
.service-card:hover{border-color:rgba(99,102,241,0.28);transform:translateY(-4px);box-shadow:0 20px 56px rgba(0,0,0,0.38),0 0 0 1px rgba(99,102,241,0.14)}
.service-card::after{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--g-accent);opacity:0;transition:opacity 0.3s;border-radius:var(--radius) var(--radius) 0 0}
.service-card:hover::after{opacity:1}
.svc-icon{width:50px;height:50px;border-radius:13px;background:linear-gradient(135deg,rgba(99,102,241,0.18),rgba(139,92,246,0.09));border:1px solid rgba(99,102,241,0.18);display:flex;align-items:center;justify-content:center;font-size:19px;color:#a5b4fc;margin-bottom:18px;transition:all 0.3s}
.service-card:hover .svc-icon{background:linear-gradient(135deg,rgba(99,102,241,0.3),rgba(139,92,246,0.18));box-shadow:0 0 22px rgba(99,102,241,0.22)}
.service-card h3{font-family:var(--font-d);font-size:15.5px;font-weight:700;color:var(--text);margin-bottom:9px;letter-spacing:-0.3px}
.service-card p{font-size:13px;line-height:1.78;color:var(--text-2)}

/* ════════════════════════════════════════════
   PROJECTS — Diagonal cut both sides
   ════════════════════════════════════════════ */
.projects-section{
  position:relative;
  background:linear-gradient(160deg,#0e0825 0%,#110f2e 50%,#0b1a35 100%);
  padding:100px 8vw 80px;
  clip-path:polygon(0 60px,100% 0,100% calc(100% - 60px),0 100%);
  margin:-20px 0;z-index:1;
}
.projects-header{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:36px;flex-wrap:wrap;width:100%}

/* Filter tabs */
.proj-filters{display:flex;gap:7px;flex-wrap:wrap}
.proj-filter{
  padding:7px 16px;border-radius:50px;
  font-size:12.5px;font-weight:600;font-family:var(--font-d);
  border:1px solid var(--border);
  color:var(--text-3);background:transparent;
  cursor:pointer;transition:all 0.2s;letter-spacing:0.2px;
}
.proj-filter:hover{border-color:rgba(99,102,241,0.35);color:var(--text-2)}
.proj-filter.active{background:var(--g-accent);border-color:transparent;color:#fff;box-shadow:0 4px 16px rgba(99,102,241,0.35)}

/* Projects grid */
.proj-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,420px));gap:18px;justify-content:center}
.proj-card{
  background:rgba(255,255,255,0.03);
  border:1px solid rgba(99,102,241,0.14);
  border-radius:var(--radius);overflow:hidden;
  transition:all 0.3s;
  display:flex;flex-direction:column;
}
.proj-card:hover{border-color:rgba(99,102,241,0.32);transform:translateY(-4px);box-shadow:0 20px 56px rgba(0,0,0,0.45)}
.proj-card.featured{border-color:rgba(139,92,246,0.35);box-shadow:0 0 0 1px rgba(139,92,246,0.12)}
.proj-card.featured:hover{border-color:rgba(139,92,246,0.55);box-shadow:0 20px 56px rgba(139,92,246,0.2)}
.proj-card.hidden{display:none}

.proj-thumb{
  height:130px;display:flex;align-items:center;justify-content:center;
  position:relative;overflow:hidden;
}
.proj-thumb-thesis{background:linear-gradient(135deg,rgba(139,92,246,0.18),rgba(99,102,241,0.12))}
.proj-thumb-ot{background:linear-gradient(135deg,rgba(6,182,212,0.14),rgba(59,130,246,0.09))}
.proj-thumb-lgu{background:linear-gradient(135deg,rgba(16,185,129,0.12),rgba(6,182,212,0.07))}
.proj-thumb-personal{background:linear-gradient(135deg,rgba(251,191,36,0.1),rgba(249,115,22,0.07))}
.proj-thumb-icon{opacity:0.5;font-size:36px}
.proj-thumb-icon.thesis{color:#c4b5fd}
.proj-thumb-icon.ot{color:#67e8f9}
.proj-thumb-icon.lgu{color:#6ee7b7}
.proj-thumb-icon.personal{color:#fde68a}
.proj-type-tag{
  position:absolute;top:10px;right:10px;
  font-size:10px;font-weight:700;
  padding:3px 10px;border-radius:20px;letter-spacing:0.3px;
  font-family:var(--font-d);
}
.tag-thesis{background:rgba(139,92,246,0.28);color:#d8b4fe;border:1px solid rgba(139,92,246,0.3)}
.tag-ot{background:rgba(6,182,212,0.18);color:#67e8f9;border:1px solid rgba(6,182,212,0.25)}
.tag-lgu{background:rgba(16,185,129,0.16);color:#6ee7b7;border:1px solid rgba(16,185,129,0.22)}
.tag-personal{background:rgba(251,191,36,0.14);color:#fde68a;border:1px solid rgba(251,191,36,0.2)}

.proj-body{padding:18px 18px 0;flex:1}
.proj-title{font-family:var(--font-d);font-size:14.5px;font-weight:700;color:var(--text);margin-bottom:7px;letter-spacing:-0.3px;line-height:1.35}
.proj-desc{font-size:12.5px;color:var(--text-2);line-height:1.7;margin-bottom:12px}
.proj-tech-row{display:flex;flex-wrap:wrap;gap:5px;margin-bottom:14px}
.proj-tech{font-size:10.5px;color:#818cf8;background:rgba(99,102,241,0.1);padding:2px 8px;border-radius:4px;font-family:var(--font-m)}

.proj-footer{
  display:flex;gap:12px;padding:12px 18px;
  border-top:1px solid rgba(255,255,255,0.04);
}
.proj-link{
  display:inline-flex;align-items:center;gap:5px;
  font-size:12px;color:#818cf8;text-decoration:none;
  font-weight:500;font-family:var(--font-b);
  transition:color 0.2s;
}
.proj-link:hover{color:#a5b4fc}
.proj-link i{font-size:10px}

/* ════════════════════════════════════════════
   TESTIMONIALS
   ════════════════════════════════════════════ */
.testi-section{
  position:relative;
  background:linear-gradient(155deg,#0a0a1a 0%,#0e0825 100%);
  padding:80px 8vw 70px;
  clip-path:polygon(0 50px,100% 0,100% calc(100% - 50px),0 100%);
  margin:-15px 0;z-index:1;
}
.testi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:18px;margin-top:44px}
.testi-card{background:rgba(255,255,255,0.03);border:1px solid rgba(99,102,241,0.13);border-radius:var(--radius);padding:30px;position:relative;transition:all 0.3s}
.testi-card:hover{border-color:rgba(99,102,241,0.28);background:rgba(99,102,241,0.04);transform:translateY(-3px)}
.testi-qmark{font-family:Georgia,serif;font-size:76px;line-height:1;color:rgba(99,102,241,0.18);position:absolute;top:10px;left:22px}
.testi-text{font-size:13.5px;line-height:1.85;color:var(--text-2);margin-bottom:22px;padding-top:26px}
.testi-author{display:flex;align-items:center;gap:12px}
.testi-avatar{width:40px;height:40px;border-radius:50%;background:var(--g-accent);display:flex;align-items:center;justify-content:center;font-family:var(--font-d);font-weight:700;font-size:15px;color:#fff;flex-shrink:0}
.testi-name{font-weight:700;font-size:14px;font-family:var(--font-d);color:var(--text)}
.testi-role{font-size:11.5px;color:var(--text-3);margin-top:1px}

/* ════════════════════════════════════════════
   RESUME STRIP
   ════════════════════════════════════════════ */
.resume-strip{
  position:relative;z-index:2;
  background:var(--ink-2);
  padding:70px 8vw;text-align:center;overflow:hidden;
}
.resume-strip::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 80% 60% at 50% 50%,rgba(99,102,241,0.1) 0%,transparent 70%);pointer-events:none}
.rs-title{font-family:var(--font-d);font-size:clamp(24px,3.2vw,42px);font-weight:700;color:var(--text);margin-bottom:11px;letter-spacing:-1px;position:relative}
.rs-sub{font-size:15px;color:var(--text-2);margin-bottom:34px;position:relative}
.btn-resume{display:inline-flex;align-items:center;gap:10px;padding:15px 34px;background:var(--g-accent);color:#fff;border-radius:50px;font-family:var(--font-d);font-size:14.5px;font-weight:700;text-decoration:none;box-shadow:0 8px 38px rgba(99,102,241,0.4);transition:all 0.25s;position:relative;letter-spacing:0.3px}
.btn-resume:hover{transform:translateY(-3px);box-shadow:0 14px 46px rgba(99,102,241,0.5)}

/* ════════════════════════════════════════════
   CONTACT
   ════════════════════════════════════════════ */
.contact-section{
  position:relative;
  background:linear-gradient(135deg,#0a0a1a 0%,#0f0825 100%);
  padding:80px 8vw 60px;
  clip-path:polygon(0 50px,100% 0,100% 100%,0 100%);
  margin-top:-20px;
}
.contact-inner{max-width:580px;margin:0 auto;text-align:center}
.contact-inner h2{font-family:var(--font-d);font-size:clamp(26px,3.5vw,44px);font-weight:700;margin-bottom:13px;letter-spacing:-1px;color:var(--text)}
.contact-inner p{color:var(--text-2);font-size:15px;margin-bottom:30px;line-height:1.75}
.btn-email{display:inline-flex;align-items:center;gap:9px;padding:14px 30px;background:rgba(99,102,241,0.12);border:1px solid rgba(99,102,241,0.32);color:#a5b4fc;border-radius:50px;font-family:var(--font-d);font-size:14.5px;font-weight:600;text-decoration:none;transition:all 0.25s}
.btn-email:hover{background:rgba(99,102,241,0.22);border-color:rgba(99,102,241,0.55);color:var(--text);transform:translateY(-2px);box-shadow:0 8px 30px rgba(99,102,241,0.22)}

/* ════════════════════════════════════════════
   FOOTER
   ════════════════════════════════════════════ */
footer{background:var(--ink);padding:20px 8vw;border-top:1px solid var(--border);font-size:11.5px;color:var(--text-3)}
.footer-inner{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
.footer-brand{display:flex;align-items:center;gap:8px}
.footer-dot{width:6px;height:6px;border-radius:50%;background:var(--g-accent);display:inline-block}
.footer-admin{display:flex;align-items:center;gap:8px}
.footer-admin-link{font-size:11px;color:rgba(255,255,255,0.13);text-decoration:none;transition:color 0.2s;font-family:var(--font-m)}
.footer-admin-link:hover{color:var(--blue-v)}
.footer-divider{color:var(--border);font-size:11px}

/* ════════════════════════════════════════════
   RESUME MODAL
   ════════════════════════════════════════════ */
.modal-overlay{position:fixed;inset:0;background:rgba(2,4,12,0.9);backdrop-filter:blur(8px);z-index:800;display:flex;align-items:flex-start;justify-content:center;padding:24px;overflow-y:auto;opacity:0;pointer-events:none;transition:opacity 0.3s}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal-box{background:#fff;border-radius:20px;max-width:980px;width:100%;position:relative;animation:modalIn 0.35s cubic-bezier(0.16,1,0.3,1) both;box-shadow:0 40px 120px rgba(0,0,0,0.7)}
@keyframes modalIn{from{transform:translateY(40px) scale(0.97);opacity:0}to{transform:translateY(0) scale(1);opacity:1}}
.modal-bar{display:flex;align-items:center;justify-content:space-between;padding:15px 22px;border-bottom:1px solid #e2e8f0;background:#fafafa;border-radius:20px 20px 0 0}
.modal-bar h3{font-family:'Cabinet Grotesk',sans-serif;font-size:14.5px;font-weight:700;color:#0f172a}
.modal-bar-actions{display:flex;gap:9px;align-items:center}
.btn-print{display:inline-flex;align-items:center;gap:6px;padding:8px 18px;background:linear-gradient(135deg,#3b82f6,#8b5cf6);color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:'Cabinet Grotesk',sans-serif}
.btn-close-modal{width:34px;height:34px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;color:#64748b;transition:all 0.15s}
.btn-close-modal:hover{background:#fee2e2;border-color:#fca5a5;color:#ef4444}
.modal-body{padding:0}
.resume-embed{font-family:'DM Sans',sans-serif;color:#2c3e50;font-size:13px;line-height:1.55}
.re-header{background:#2c3e50;color:#fff;padding:22px 28px;display:flex;justify-content:space-between;align-items:center;gap:20px}
.re-name{font-family:'Sora',sans-serif;font-size:24px;font-weight:700;line-height:1.1}
.re-position{margin-top:4px;font-size:10px;font-weight:300;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.6)}
.re-contacts{display:flex;flex-direction:column;gap:4px;align-items:flex-end}
.re-contact-item{display:flex;align-items:center;gap:6px;font-size:11px;color:rgba(255,255,255,0.8)}
.re-contact-item i{color:#3b82f6;font-size:10px}
.re-body{column-count:2;column-gap:0;background:linear-gradient(to right,#ffffff 50%,#f9fafb 50%);column-rule:2px solid #f0f2f4;display:block;padding:0}
.re-col-l,.re-col-r{display:contents}
.re-section{break-inside:avoid;margin-bottom:16px;padding:16px 20px 0}
.re-section-title{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#2c3e50;padding-bottom:4px;border-bottom:2px solid #3b82f6;margin-bottom:10px}
.re-summary{font-size:12.5px;color:#555;line-height:1.75}
.re-job{margin-bottom:14px;break-inside:avoid}
.re-job-role{display:block;font-weight:700;font-size:13px}
.re-job-meta{display:block;font-size:11px;color:#3b82f6;font-style:italic;margin:1px 0 4px}
.re-ul{padding-left:16px;margin-top:3px}
.re-ul li{font-size:12px;color:#555;margin-bottom:3px;line-height:1.5}
.re-edu{margin-bottom:12px;break-inside:avoid;padding-left:0;margin-left:0}
.re-edu-deg{display:block;font-weight:700;font-size:13px}
.re-edu-sch{display:block;font-size:11.5px;color:#3b82f6;margin:1px 0}
.re-edu-dt{display:block;font-size:11px;color:#888;margin-bottom:4px}
.re-cert{margin-bottom:10px;break-inside:avoid;padding-left:0;margin-left:0}
.re-cert-name{display:block;font-weight:600;font-size:12px;line-height:1.4}
.re-cert-yr{display:block;font-size:11px;color:#3b82f6;margin-top:2px}
.re-lang-item{display:flex;align-items:center;justify-content:space-between;margin-bottom:7px}
.re-lang-dots{display:flex;gap:4px}
.re-dot{width:10px;height:10px;border-radius:50%;background:#d1d5db;border:1.5px solid #c4c9d0}
.re-dot.on{background:#3b82f6;border-color:#2563eb}

/* ── PRINT ── */
@media print{
  *{-webkit-print-color-adjust:exact !important;print-color-adjust:exact !important}
  #scroll-progress,.navbar,.hero,.services-section,.projects-section,.thesis-section,.testi-section,.resume-strip,.contact-section,footer,.modal-bar{display:none !important}
  body{background:#fff !important;margin:0 !important;padding:0 !important;overflow:visible !important}
  .modal-overlay.open{display:block !important;position:absolute !important;inset:0 !important;background:#fff !important;padding:0 !important;overflow:visible !important;opacity:1 !important;z-index:9999 !important}
  .modal-box{max-width:100% !important;width:100% !important;border-radius:0 !important;box-shadow:none !important;animation:none !important}
  .re-body{column-count:2 !important;display:block !important;background:linear-gradient(to right,#ffffff 50%,#f9fafb 50%) !important}
  .re-col-l,.re-col-r{display:contents !important}
  .re-section{break-inside:avoid !important;padding:12px 16px 0 !important}
  .re-header{background:#2c3e50 !important;color:#fff !important}
  .re-job,.re-edu,.re-cert{break-inside:avoid !important}
}

/* ── MOBILE ── */
@media(max-width:768px){
  .hero{flex-direction:column;padding:36px 6vw 100px;gap:28px;text-align:center}
  .hero-photo-frame{width:240px;height:290px}
  .hero-stat{display:none}
  .hero-mono,.hero-btns,.hero-socials,.cred-row,.counters-row{justify-content:center}
  .hero-bio{margin-left:auto;margin-right:auto}
  .nav-links{display:none}
  .nav-hamburger{display:flex}
  .testi-section{clip-path:polygon(0 30px,100% 0,100% calc(100% - 30px),0 100%)}
  .contact-section{clip-path:polygon(0 30px,100% 0,100% 100%,0 100%)}
  .projects-section{clip-path:polygon(0 40px,100% 0,100% calc(100% - 40px),0 100%)}
  .thesis-banner{flex-direction:column}
  .projects-header{flex-direction:column;align-items:flex-start}
}

/* ── ENTRANCE ANIMATIONS ── */
@keyframes fadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}
.anim{opacity:0;animation:fadeUp 0.65s cubic-bezier(0.16,1,0.3,1) forwards;animation-play-state:paused}
.d1{animation-delay:0.05s}.d2{animation-delay:0.15s}.d3{animation-delay:0.25s}.d4{animation-delay:0.35s}

/* ════════════════════════════════════════════
   PROJECT MODAL — Floating cloud popup
   ════════════════════════════════════════════ */
.proj-modal-overlay{
  position:fixed;inset:0;z-index:900;
  display:flex;align-items:center;justify-content:center;
  padding:24px;
  opacity:0;pointer-events:none;
  transition:opacity 0.3s;
  /* Frosted glass backdrop */
  background:rgba(2,4,18,0.7);
  backdrop-filter:blur(16px) saturate(160%);
}
.proj-modal-overlay.open{opacity:1;pointer-events:all}

.proj-modal{
  position:relative;
  background:linear-gradient(145deg,#0f1535 0%,#0b0f1e 60%,#1a0a3d 100%);
  border:1px solid rgba(99,102,241,0.25);
  border-radius:24px;
  width:100%;max-width:820px;
  max-height:88vh;
  overflow-y:auto;
  box-shadow:
    0 0 0 1px rgba(99,102,241,0.12),
    0 40px 120px rgba(0,0,0,0.7),
    0 0 80px rgba(99,102,241,0.08),
    inset 0 1px 0 rgba(255,255,255,0.06);
  transform:translateY(40px) scale(0.97);
  transition:transform 0.4s cubic-bezier(0.16,1,0.3,1);
  scrollbar-width:thin;
  scrollbar-color:rgba(99,102,241,0.2) transparent;
}
.proj-modal-overlay.open .proj-modal{
  transform:translateY(0) scale(1);
}
/* Cloud glow rings */
.proj-modal::before{
  content:'';position:absolute;
  inset:-1px;border-radius:25px;
  background:linear-gradient(135deg,rgba(99,102,241,0.3) 0%,transparent 40%,transparent 60%,rgba(6,182,212,0.2) 100%);
  z-index:-1;pointer-events:none;
}
/* Floating particle dots */
.proj-modal::after{
  content:'';position:absolute;
  top:-40px;left:-40px;right:-40px;bottom:-40px;
  border-radius:32px;
  background:
    radial-gradient(circle 80px at 15% 20%,rgba(99,102,241,0.12) 0%,transparent 100%),
    radial-gradient(circle 60px at 85% 80%,rgba(6,182,212,0.1) 0%,transparent 100%),
    radial-gradient(circle 40px at 70% 15%,rgba(139,92,246,0.1) 0%,transparent 100%);
  pointer-events:none;z-index:-2;
  filter:blur(8px);
}

.pm-header{
  display:flex;align-items:flex-start;justify-content:space-between;
  padding:24px 28px 20px;
  border-bottom:1px solid rgba(255,255,255,0.06);
  gap:16px;
  position:sticky;top:0;z-index:10;
  background:linear-gradient(135deg,rgba(15,21,53,0.98),rgba(11,15,30,0.98));
  backdrop-filter:blur(8px);
  border-radius:24px 24px 0 0;
}
.pm-header-left{flex:1;min-width:0}
.pm-type-tag{
  display:inline-flex;align-items:center;gap:6px;
  font-size:10px;font-weight:700;letter-spacing:0.5px;
  padding:3px 11px;border-radius:20px;
  margin-bottom:10px;font-family:var(--font-d);
}
.pm-title{
  font-family:var(--font-d);font-size:20px;font-weight:700;
  color:var(--text);letter-spacing:-0.4px;line-height:1.3;
}
.pm-close{
  width:36px;height:36px;border-radius:10px;flex-shrink:0;
  background:rgba(255,255,255,0.04);
  border:1px solid rgba(255,255,255,0.08);
  cursor:pointer;display:flex;align-items:center;justify-content:center;
  font-size:15px;color:var(--text-3);
  transition:all 0.2s;
}
.pm-close:hover{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.3);color:#f87171}

.pm-body{padding:24px 28px 28px}
.pm-desc{
  font-size:14px;line-height:1.85;color:var(--text-2);
  margin-bottom:20px;
}
.pm-tech-row{display:flex;flex-wrap:wrap;gap:7px;margin-bottom:24px}
.pm-tech{
  font-size:11.5px;color:#a5b4fc;
  background:rgba(99,102,241,0.12);
  padding:4px 11px;border-radius:6px;
  font-family:var(--font-m);
}
.pm-links{display:flex;gap:10px;margin-bottom:28px;flex-wrap:wrap}
.pm-link-btn{
  display:inline-flex;align-items:center;gap:7px;
  padding:9px 20px;border-radius:50px;
  font-size:13px;font-weight:600;
  font-family:var(--font-d);text-decoration:none;
  transition:all 0.2s;letter-spacing:0.2px;
}
.pm-link-github{
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.1);color:var(--text-2);
}
.pm-link-github:hover{background:rgba(255,255,255,0.1);color:var(--text)}
.pm-link-demo{
  background:var(--g-accent);color:#fff;
  box-shadow:0 4px 16px rgba(99,102,241,0.35);
}
.pm-link-demo:hover{transform:translateY(-1px);box-shadow:0 6px 22px rgba(99,102,241,0.45)}

.pm-divider{height:1px;background:rgba(255,255,255,0.05);margin:20px 0}
.pm-section-label{
  font-family:var(--font-d);font-size:14px;font-weight:700;
  color:var(--text);margin-bottom:14px;letter-spacing:-0.2px;
}

/* Thesis-specific: accordion inside modal */
.pm-accordion{display:flex;flex-direction:column;gap:8px;margin-bottom:24px}
.pm-phase{
  background:rgba(255,255,255,0.02);
  border:1px solid rgba(99,102,241,0.12);
  border-radius:12px;overflow:hidden;
  transition:border-color 0.2s;
}
.pm-phase.open{border-color:rgba(99,102,241,0.3)}
.pm-phase-header{
  display:flex;align-items:center;gap:13px;
  padding:13px 16px;cursor:pointer;
  transition:background 0.2s;
}
.pm-phase-header:hover{background:rgba(255,255,255,0.02)}
.pm-phase-num{
  width:26px;height:26px;border-radius:7px;
  background:linear-gradient(135deg,rgba(99,102,241,0.2),rgba(139,92,246,0.12));
  border:1px solid rgba(99,102,241,0.2);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-m);font-size:10.5px;color:#a5b4fc;
  flex-shrink:0;font-weight:700;
}
.pm-phase-title{font-family:var(--font-d);font-size:13.5px;font-weight:600;color:var(--text);flex:1}
.pm-phase-chevron{color:var(--text-3);font-size:11px;transition:transform 0.25s;flex-shrink:0}
.pm-phase.open .pm-phase-chevron{transform:rotate(180deg)}
.pm-phase-body{max-height:0;overflow:hidden;transition:max-height 0.35s cubic-bezier(0.4,0,0.2,1)}
.pm-phase.open .pm-phase-body{max-height:400px}
.pm-phase-content{
  padding:0 16px 14px;padding-left:55px;
  font-size:12.5px;color:var(--text-2);line-height:1.75;
  border-top:1px solid rgba(255,255,255,0.04);padding-top:12px;
}
.pm-phase-content ul{padding-left:14px}
.pm-phase-content li{margin-bottom:4px}

/* ISO scores inside modal */
.pm-iso-grid{
  display:grid;
  grid-template-columns:repeat(5,1fr);
  gap:10px;
}
.pm-iso-card{
  background:rgba(255,255,255,0.025);
  border:1px solid rgba(99,102,241,0.1);
  border-radius:12px;padding:14px 12px;
  transition:border-color 0.2s;
}
.pm-iso-card:hover{border-color:rgba(99,102,241,0.28)}
.pm-iso-label{
  font-size:9px;color:var(--text-3);
  font-family:var(--font-m);text-transform:uppercase;
  letter-spacing:1px;margin-bottom:8px;
}
.pm-iso-bar-bg{height:4px;background:rgba(255,255,255,0.07);border-radius:2px;overflow:hidden}
.pm-iso-bar-fill{
  height:100%;border-radius:2px;
  background:var(--g-accent);
  transition:width 1s cubic-bezier(0.4,0,0.2,1) 0.2s;
  width:0;
}
.pm-iso-score{
  font-family:var(--font-d);font-size:17px;
  font-weight:700;color:var(--text);margin-top:6px;
}

/* Click cursor on proj cards */
.proj-card{cursor:pointer}
.proj-card:hover .proj-thumb-icon{transform:scale(1.12);transition:transform 0.3s}


/* ════ PROJECT FILTER ANIMATION ════ */
.proj-card {
  transition: opacity 0.35s ease, transform 0.35s cubic-bezier(0.4,0,0.2,1), max-height 0.35s ease;
}
.proj-card.hiding {
  opacity: 0;
  transform: scale(0.92) translateY(8px);
  pointer-events: none;
}
.proj-card.hidden {
  display: none;
}
.proj-card.showing {
  opacity: 0;
  transform: scale(0.92) translateY(8px);
}

/* ════ HERO SWIRL — Animated background ════ */
.hero-swirl{position:absolute;top:-10%;right:-4%;width:52%;height:120%;pointer-events:none;z-index:1;opacity:0.12;overflow:hidden}
.hero-swirl svg{width:100%;height:100%}
.hero-swirl-2{position:absolute;top:15%;right:10%;width:32%;height:65%;pointer-events:none;z-index:1;opacity:0.06;overflow:hidden}
.hero-swirl-2 svg{width:100%;height:100%}
.swirl-path{fill:none;stroke-linecap:round;transform-origin:50% 50%}
.swirl-path:nth-child(1){animation:swirlA 18s ease-in-out infinite}
.swirl-path:nth-child(2){animation:swirlA 23s ease-in-out infinite reverse}
.swirl-path:nth-child(3){animation:swirlB 27s ease-in-out infinite}
.swirl-path:nth-child(4){animation:swirlB 31s ease-in-out infinite reverse}
.swirl-path:nth-child(5){animation:swirlA 21s ease-in-out infinite}
.swirl-path:nth-child(6){animation:swirlB 25s ease-in-out infinite reverse}
.swirl-path:nth-child(7){animation:swirlA 29s ease-in-out infinite}
.swirl-path:nth-child(8){animation:swirlB 17s ease-in-out infinite reverse}
.swirl2-path{fill:none;stroke-linecap:round;transform-origin:50% 50%}
.swirl2-path:nth-child(1){animation:swirlA 22s ease-in-out infinite reverse}
.swirl2-path:nth-child(2){animation:swirlB 28s ease-in-out infinite}
.swirl2-path:nth-child(3){animation:swirlA 19s ease-in-out infinite reverse}
.swirl2-path:nth-child(4){animation:swirlB 34s ease-in-out infinite}
.swirl2-path:nth-child(5){animation:swirlA 24s ease-in-out infinite reverse}
@keyframes swirlA{0%,100%{transform:rotate(0deg) scale(1)}30%{transform:rotate(9deg) scale(1.05)}70%{transform:rotate(-7deg) scale(0.96)}}
@keyframes swirlB{0%,100%{transform:rotate(0deg) scale(1)}40%{transform:rotate(-10deg) scale(1.04)}80%{transform:rotate(6deg) scale(0.97)}}
@media(max-width:768px){.hero-swirl,.hero-swirl-2{display:none}}

/* ════ HERO SWIRL ════ */
.hero-swirl{position:absolute;top:-10%;right:-4%;width:52%;height:120%;pointer-events:none;z-index:1;opacity:0.12;overflow:hidden}
.hero-swirl svg{width:100%;height:100%}
.hero-swirl-2{position:absolute;top:15%;right:10%;width:32%;height:65%;pointer-events:none;z-index:1;opacity:0.06;overflow:hidden}
.hero-swirl-2 svg{width:100%;height:100%}
.swirl-path{fill:none;stroke-linecap:round;transform-origin:50% 50%}
.swirl-path:nth-child(1){animation:swirlA 18s ease-in-out infinite}
.swirl-path:nth-child(2){animation:swirlA 23s ease-in-out infinite reverse}
.swirl-path:nth-child(3){animation:swirlB 27s ease-in-out infinite}
.swirl-path:nth-child(4){animation:swirlB 31s ease-in-out infinite reverse}
.swirl-path:nth-child(5){animation:swirlA 21s ease-in-out infinite}
.swirl-path:nth-child(6){animation:swirlB 25s ease-in-out infinite reverse}
.swirl-path:nth-child(7){animation:swirlA 29s ease-in-out infinite}
.swirl-path:nth-child(8){animation:swirlB 17s ease-in-out infinite reverse}
.swirl2-path{fill:none;stroke-linecap:round;transform-origin:50% 50%}
.swirl2-path:nth-child(1){animation:swirlA 22s ease-in-out infinite reverse}
.swirl2-path:nth-child(2){animation:swirlB 28s ease-in-out infinite}
.swirl2-path:nth-child(3){animation:swirlA 19s ease-in-out infinite reverse}
.swirl2-path:nth-child(4){animation:swirlB 34s ease-in-out infinite}
.swirl2-path:nth-child(5){animation:swirlA 24s ease-in-out infinite reverse}
@keyframes swirlA{0%,100%{transform:rotate(0deg) scale(1)}30%{transform:rotate(9deg) scale(1.05)}70%{transform:rotate(-7deg) scale(0.96)}}
@keyframes swirlB{0%,100%{transform:rotate(0deg) scale(1)}40%{transform:rotate(-10deg) scale(1.04)}80%{transform:rotate(6deg) scale(0.97)}}
/* ════ PROJECT FILTER ANIMATION ════ */
.proj-card{transition:opacity 0.35s ease,transform 0.35s cubic-bezier(0.4,0,0.2,1)}
.proj-card.hiding{opacity:0;transform:scale(0.92) translateY(8px);pointer-events:none}
.proj-card.hidden{display:none}
.proj-card.showing{opacity:0;transform:scale(0.92) translateY(8px)}
@media(max-width:768px){.hero-swirl,.hero-swirl-2{display:none}}
</style>
</head>
<body>

<!-- ── SCROLL PROGRESS ── -->
<div id="scroll-progress"></div>

<!-- ════════ NAVBAR ════════ -->
<nav class="navbar">
  <a class="nav-brand" href="<?= base_url() ?>">
    <div class="nav-avatar">
      <?php if(!empty($about['photo'])): ?>
      <img src="<?= base_url(esc($about['photo'])) ?>" alt="" style="object-position:<?= esc($about['photo_position']??'50% 50%') ?>">
      <?php else: ?>
      <?= strtoupper(substr($header['name']??'A',0,1)) ?>
      <?php endif; ?>
    </div>
    <div class="nav-name">
      <?php $np=explode(' ',trim($header['name']??'Your Name'),2); ?>
      <strong><?= esc($np[0]) ?></strong><?= isset($np[1])?' <span>'.esc($np[1]).'</span>':'' ?>
    </div>
  </a>
  <div class="nav-links">
    <a class="nav-link active" href="#hero">About</a>
    <a class="nav-link" href="#services">Services</a>
    <a class="nav-link" href="#projects">Projects</a>
    <?php if(!empty($testimonials)): ?><a class="nav-link" href="#testimonials">Testimonials</a><?php endif; ?>
    <a class="nav-link" href="#contact">Contact</a>
    <a class="nav-btn" href="#" onclick="openResumeModal(event)">Resume</a>
  </div>
  <div class="nav-hamburger" onclick="toggleMobileNav(this)"><span></span><span></span><span></span></div>
</nav>

<!-- ════════ HERO ════════ -->
<section class="hero" id="hero">
  <div class="hero-orb hero-orb-1"></div>
  <div class="hero-orb hero-orb-2"></div>
  <div class="hero-orb hero-orb-3"></div>

  <div class="hero-swirl" aria-hidden="true">
    <svg viewBox="0 0 600 800" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
      <path class="swirl-path" d="M300,400 C160,180 500,80 440,300 C380,520 100,470 160,270 C220,70 540,130 510,360 C480,590 120,570 140,380 C160,190 560,220 530,450 C500,680 90,650 110,430" stroke="#8b5cf6" stroke-width="30"/>
      <path class="swirl-path" d="M300,400 C180,210 480,100 428,306 C376,512 118,464 172,272 C226,80 528,140 500,364 C472,588 128,564 146,376 C164,188 548,228 520,452 C492,676 98,648 116,428" stroke="#6366f1" stroke-width="22"/>
      <path class="swirl-path" d="M300,400 C196,235 464,118 418,312 C372,506 134,458 183,273 C232,88 517,148 490,368 C463,588 136,558 152,372 C168,186 537,234 512,454 C487,674 106,646 122,426" stroke="#3b82f6" stroke-width="16"/>
      <path class="swirl-path" d="M300,400 C210,255 450,134 408,318 C366,502 148,452 194,274 C240,96 507,155 480,370 C453,585 143,552 158,368 C173,184 527,240 504,456 C481,672 113,644 128,424" stroke="#06b6d4" stroke-width="11"/>
      <path class="swirl-path" d="M300,400 C222,272 436,149 397,323 C358,497 161,447 204,275 C247,103 498,161 472,373 C446,585 150,547 164,364 C178,181 518,245 496,457 C474,669 119,642 133,422" stroke="#a78bfa" stroke-width="7"/>
      <path class="swirl-path" d="M300,400 C232,287 424,162 387,327 C350,492 172,442 214,276 C256,110 490,167 464,375 C438,583 156,542 169,361 C182,180 510,249 490,458 C470,667 124,640 138,421" stroke="#c4b5fd" stroke-width="4"/>
      <path class="swirl-path" d="M300,400 C241,299 413,174 378,330 C343,486 182,437 222,277 C262,117 483,172 457,377 C431,582 161,538 173,358 C185,178 503,253 484,459 C465,665 128,638 142,420" stroke="#7c3aed" stroke-width="2.5"/>
      <path class="swirl-path" d="M300,400 C249,310 403,184 370,333 C337,482 191,433 230,278 C269,123 476,177 451,379 C426,581 166,534 177,356 C188,178 496,257 479,460 C462,663 132,636 146,419" stroke="#4f46e5" stroke-width="1.5"/>
    </svg>
  </div>
  <div class="hero-swirl-2" aria-hidden="true">
    <svg viewBox="0 0 400 500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
      <path class="swirl2-path" d="M200,250 C110,120 330,60 300,195 C270,330 80,295 112,172 C144,49 360,90 335,228 C310,366 70,340 92,216 C114,92 380,136 355,274" stroke="#06b6d4" stroke-width="24"/>
      <path class="swirl2-path" d="M200,250 C122,136 315,74 288,200 C261,326 92,298 121,176 C150,54 350,97 326,232 C302,367 78,338 98,215 C118,92 370,142 347,277" stroke="#8b5cf6" stroke-width="16"/>
      <path class="swirl2-path" d="M200,250 C132,150 302,86 278,204 C254,322 103,300 130,179 C157,58 342,102 318,234 C294,366 85,336 104,214 C123,92 362,147 340,278" stroke="#3b82f6" stroke-width="10"/>
      <path class="swirl2-path" d="M200,250 C140,161 291,97 268,208 C245,319 112,302 138,182 C164,62 335,107 311,236 C287,365 90,334 109,213 C128,92 355,151 334,279" stroke="#c4b5fd" stroke-width="6"/>
      <path class="swirl2-path" d="M200,250 C147,171 281,107 259,211 C237,315 120,303 145,184 C170,65 329,111 305,238 C281,365 95,332 113,212 C131,92 348,154 328,280" stroke="#67e8f9" stroke-width="3"/>
    </svg>
  </div>

  <div class="hero-swirl" aria-hidden="true">
    <svg viewBox="0 0 600 800" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
      <path class="swirl-path" d="M300,400 C160,180 500,80 440,300 C380,520 100,470 160,270 C220,70 540,130 510,360 C480,590 120,570 140,380 C160,190 560,220 530,450 C500,680 90,650 110,430" stroke="#8b5cf6" stroke-width="30"/>
      <path class="swirl-path" d="M300,400 C180,210 480,100 428,306 C376,512 118,464 172,272 C226,80 528,140 500,364 C472,588 128,564 146,376 C164,188 548,228 520,452 C492,676 98,648 116,428" stroke="#6366f1" stroke-width="22"/>
      <path class="swirl-path" d="M300,400 C196,235 464,118 418,312 C372,506 134,458 183,273 C232,88 517,148 490,368 C463,588 136,558 152,372 C168,186 537,234 512,454 C487,674 106,646 122,426" stroke="#3b82f6" stroke-width="16"/>
      <path class="swirl-path" d="M300,400 C210,255 450,134 408,318 C366,502 148,452 194,274 C240,96 507,155 480,370 C453,585 143,552 158,368 C173,184 527,240 504,456 C481,672 113,644 128,424" stroke="#06b6d4" stroke-width="11"/>
      <path class="swirl-path" d="M300,400 C222,272 436,149 397,323 C358,497 161,447 204,275 C247,103 498,161 472,373 C446,585 150,547 164,364 C178,181 518,245 496,457 C474,669 119,642 133,422" stroke="#a78bfa" stroke-width="7"/>
      <path class="swirl-path" d="M300,400 C232,287 424,162 387,327 C350,492 172,442 214,276 C256,110 490,167 464,375 C438,583 156,542 169,361 C182,180 510,249 490,458 C470,667 124,640 138,421" stroke="#c4b5fd" stroke-width="4"/>
      <path class="swirl-path" d="M300,400 C241,299 413,174 378,330 C343,486 182,437 222,277 C262,117 483,172 457,377 C431,582 161,538 173,358 C185,178 503,253 484,459 C465,665 128,638 142,420" stroke="#7c3aed" stroke-width="2.5"/>
      <path class="swirl-path" d="M300,400 C249,310 403,184 370,333 C337,482 191,433 230,278 C269,123 476,177 451,379 C426,581 166,534 177,356 C188,178 496,257 479,460 C462,663 132,636 146,419" stroke="#4f46e5" stroke-width="1.5"/>
    </svg>
  </div>
  <div class="hero-swirl-2" aria-hidden="true">
    <svg viewBox="0 0 400 500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
      <path class="swirl2-path" d="M200,250 C110,120 330,60 300,195 C270,330 80,295 112,172 C144,49 360,90 335,228 C310,366 70,340 92,216 C114,92 380,136 355,274" stroke="#06b6d4" stroke-width="24"/>
      <path class="swirl2-path" d="M200,250 C122,136 315,74 288,200 C261,326 92,298 121,176 C150,54 350,97 326,232 C302,367 78,338 98,215 C118,92 370,142 347,277" stroke="#8b5cf6" stroke-width="16"/>
      <path class="swirl2-path" d="M200,250 C132,150 302,86 278,204 C254,322 103,300 130,179 C157,58 342,102 318,234 C294,366 85,336 104,214 C123,92 362,147 340,278" stroke="#3b82f6" stroke-width="10"/>
      <path class="swirl2-path" d="M200,250 C140,161 291,97 268,208 C245,319 112,302 138,182 C164,62 335,107 311,236 C287,365 90,334 109,213 C128,92 355,151 334,279" stroke="#c4b5fd" stroke-width="6"/>
      <path class="swirl2-path" d="M200,250 C147,171 281,107 259,211 C237,315 120,303 145,184 C170,65 329,111 305,238 C281,365 95,332 113,212 C131,92 348,154 328,280" stroke="#67e8f9" stroke-width="3"/>
    </svg>
  </div>

  <div class="hero-photo-wrap">
    <div class="hero-photo-frame">
      <?php if(!empty($about['photo'])): ?>
      <img src="<?= base_url(esc($about['photo'])) ?>" alt="<?= esc($header['name']??'') ?>" style="object-position:<?= esc($about['photo_position']??'center top') ?>">
      <?php else: ?>
      <div class="photo-placeholder"><i class="fas fa-user"></i></div>
      <?php endif; ?>
    </div>
    <div class="hero-badge"><span class="badge-dot"></span> Available for work</div>
    <div class="hero-stat hero-stat-1">
      <div class="s-val" style="background:var(--g-accent);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">IoT</div>
      <div class="s-lbl">+ ML</div>
    </div>
    <div class="hero-stat hero-stat-2">
      <div class="s-val">CS</div>
      <div class="s-lbl">Scholar</div>
    </div>
  </div>

  <div class="hero-text">
    <div class="hero-mono">Full-Stack Developer</div>
    <?php $np=explode(' ',trim($header['name']??'Your Name'),2); ?>
    <h1 class="hero-name">
      <?= esc($np[0]) ?><br>
      <span class="hero-name-accent"><?= esc($np[1]??'') ?></span>
    </h1>
    <div class="hero-pill"><i class="fas fa-code" style="font-size:10px"></i><?= esc($about['tagline']??'Full-Stack Web Developer') ?></div>

    <!-- CREDENTIAL BADGES -->
    <div class="cred-row">
      <span class="cred-badge"><i class="fas fa-check-circle"></i> Civil Service Professional Eligible</span>
      <span class="cred-badge dost"><i class="fas fa-award"></i> DOST-JLSS Scholar</span>
      <span class="cred-badge award"><i class="fas fa-star"></i> Academic Excellence 2022–2026</span>
    </div>

    <p class="hero-bio"><?= nl2br(esc($about['bio']??'')) ?></p>

    <div class="hero-btns">
      <a href="#" class="btn-primary" onclick="openResumeModal(event)">
        <i class="fas fa-file-alt"></i><?= esc($about['cv_label']??'View Resume') ?>
      </a>
      <?php if(!empty($about['btn_contact_email'])): ?>
      <a href="#" onclick="window.location.href='mai'+'lto:<?= esc($about['btn_contact_email']) ?>'" class="btn-ghost"><?= esc($about['btn_contact_label']??'Hire Me') ?></a>
      <?php else: ?>
      <a href="#contact" class="btn-ghost"><?= esc($about['btn_contact_label']??'Hire Me') ?></a>
      <?php endif; ?>
    </div>

    <div class="hero-socials">
      <?php if(!empty($about['github'])): ?><a href="<?= esc($about['github']) ?>" target="_blank" class="social-icon" title="GitHub"><i class="fab fa-github"></i></a><?php endif; ?>
      <?php if(!empty($about['linkedin_url'])): ?><a href="<?= esc($about['linkedin_url']) ?>" target="_blank" class="social-icon" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a><?php endif; ?>
      <?php if(!empty($about['twitter'])): ?><a href="<?= esc($about['twitter']) ?>" target="_blank" class="social-icon" title="Twitter/X"><i class="fab fa-x-twitter"></i></a><?php endif; ?>
      <?php if(!empty($about['facebook'])): ?><a href="<?= esc($about['facebook']) ?>" target="_blank" class="social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a><?php endif; ?>
      <?php if(!empty($header['email'])): ?><a href="mailto:<?= esc($header['email']) ?>" class="social-icon" title="Email"><i class="fas fa-envelope"></i></a><?php endif; ?>
    </div>

    <!-- ANIMATED COUNTERS -->
    <div class="counters-row" id="counters">
      <div class="counter-chip">
        <div class="counter-icon blue"><i class="fas fa-briefcase"></i></div>
        <div>
          <div class="counter-val" data-target="2" data-suffix="">0</div>
          <div class="counter-lbl">OJT Experiences</div>
        </div>
      </div>
      <div class="counter-chip">
        <div class="counter-icon cyan"><i class="fas fa-code"></i></div>
        <div>
          <div class="counter-val" data-target="9" data-suffix="">0</div>
          <div class="counter-lbl">Technologies</div>
        </div>
      </div>
      <div class="counter-chip">
        <div class="counter-icon green"><i class="fas fa-flask"></i></div>
        <div>
          <div class="counter-val" data-target="1" data-suffix="">0</div>
          <div class="counter-lbl">Research Thesis</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════════ SERVICES ════════ -->
<?php if(!empty($services)): ?>
<div class="services-section" id="services">
  <div class="services-header">
    <div class="section-eyebrow ey-purple">What I Do</div>
    <h2 class="section-title">Services &amp; <span>Expertise</span></h2>
  </div>
  <div class="services-grid">
    <?php foreach($services as $i=>$svc): ?>
    <div class="service-card anim d<?= min($i+1,4) ?>">
      <div class="svc-icon"><i class="<?= esc($svc['icon']) ?>"></i></div>
      <h3><?= esc($svc['title']) ?></h3>
      <p><?= nl2br(esc($svc['description'])) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<!-- ════════ PROJECTS ════════ -->
<section class="projects-section" id="projects">
  <div class="projects-header">
    <div>
      <div class="section-eyebrow ey-cyan">Portfolio</div>
      <h2 class="section-title">Featured <span>Work</span></h2>
    </div>
    <!-- FILTER TABS -->
    <div class="proj-filters">
      <button class="proj-filter active" onclick="filterProjects('all',this)">All</button>
      <button class="proj-filter" onclick="filterProjects('thesis',this)">Thesis</button>
      <button class="proj-filter" onclick="filterProjects('ojt',this)">OJT</button>
      <button class="proj-filter" onclick="filterProjects('lgu',this)">LGU</button>
      <button class="proj-filter" onclick="filterProjects('personal',this)">Personal</button>
    </div>
  </div>

  <div class="proj-grid" id="proj-grid">

    <?php
    $thumbBg   = ['thesis'=>'proj-thumb-thesis','ojt'=>'proj-thumb-ot','lgu'=>'proj-thumb-lgu','personal'=>'proj-thumb-personal'];
    $iconColor = ['thesis'=>'thesis','ojt'=>'ot','lgu'=>'lgu','personal'=>'personal'];
    $tagClass  = ['thesis'=>'tag-thesis','ojt'=>'tag-ot','lgu'=>'tag-lgu','personal'=>'tag-personal'];
    $tagLabel  = ['thesis'=>'&#9733; Thesis','ojt'=>'OJT','lgu'=>'LGU','personal'=>'Personal'];
    foreach($projects as $i => $proj):
        $cat   = $proj['category'] ?? 'personal';
        $projTech  = json_decode($proj['tech'] ?? '[]', true) ?: [];
        $delay = 'd'.min($i+1,4);
    ?>
    <div class="proj-card <?= $cat==='thesis'?'featured':'' ?> anim <?= $delay ?>"
         data-category="<?= esc($cat) ?>"
         data-project="<?= $proj['id'] ?>">
      <div class="proj-thumb <?= $thumbBg[$cat]??'proj-thumb-personal' ?>">
        <i class="<?= esc($proj['icon']) ?> proj-thumb-icon <?= $iconColor[$cat]??'personal' ?>"></i>
        <span class="proj-type-tag <?= $tagClass[$cat]??'tag-personal' ?>"><?= $tagLabel[$cat]??$cat ?></span>
      </div>
      <div class="proj-body">
        <div class="proj-title"><?= esc($proj['title']) ?></div>
        <div class="proj-desc"><?= esc($proj['description']) ?></div>
        <?php if(!empty($projTech)): ?>
        <div class="proj-tech-row">
          <?php foreach($projTech as $t): ?><span class="proj-tech"><?= esc($t) ?></span><?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="proj-footer" style="justify-content:flex-end">
        <span class="proj-link" style="color:var(--text-3);font-size:11px">
          <i class="fas fa-arrow-up-right-from-square" style="font-size:9px"></i> Click to explore
        </span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ════════ TESTIMONIALS ════════ -->
<?php if(!empty($testimonials)): ?>
<section class="testi-section" id="testimonials">
  <div class="section-eyebrow ey-purple">Kind Words</div>
  <h2 class="section-title">What People <span>Say</span></h2>
  <div class="testi-grid">
    <?php foreach($testimonials as $t): ?>
    <div class="testi-card anim d1">
      <div class="testi-qmark">"</div>
      <p class="testi-text"><?= nl2br(esc($t['quote'])) ?></p>
      <div class="testi-author">
        <div class="testi-avatar"><?= strtoupper(substr($t['author'],0,1)) ?></div>
        <div>
          <div class="testi-name"><?= esc($t['author']) ?></div>
          <div class="testi-role"><?= esc($t['role']) ?></div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ════════ RESUME CTA ════════ -->
<div class="resume-strip">
  <h2 class="rs-title">Ready to collaborate?</h2>
  <p class="rs-sub">View my full resume — work history, skills, projects, and certifications.</p>
  <a href="#" class="btn-resume" onclick="openResumeModal(event)">
    <i class="fas fa-file-alt"></i> View Full Resume
  </a>
</div>

<!-- ════════ CONTACT ════════ -->
<section class="contact-section" id="contact">
  <div class="contact-inner">
    <h2>Let's Build <span style="background:var(--g-accent);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Something</span></h2>
    <p>Have a project in mind, an opportunity to share, or a problem to solve? I'd love to hear from you.</p>
    <?php $email=$about['btn_contact_email']?:($header['email']??''); ?>
    <?php if(!empty($email)): ?>
    <a href="#" onclick="window.location.href='mai'+'lto:<?= esc($email) ?>'" class="btn-email">
      <i class="fas fa-envelope"></i><?= esc($email) ?>
    </a>
    <?php endif; ?>
  </div>
</section>

<!-- ════════ FOOTER ════════ -->
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <span class="footer-dot"></span>
      <span>&copy; <?= date('Y') ?> <?= esc($header['name']??'') ?></span>
    </div>
    <?php if(!empty($isLoggedIn)): ?>
    <div class="footer-admin">
      <a href="<?= base_url('admin') ?>" class="footer-admin-link"><i class="fas fa-cog"></i> Dashboard</a>
      <span class="footer-divider">·</span>
      <a href="#" onclick="confirmLogout(event)" class="footer-admin-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <?php else: ?>
    <a href="<?= base_url('login') ?>" class="footer-admin-link">&copy; admin</a>
    <?php endif; ?>
  </div>
</footer>


<!-- ════════ PROJECT MODALS ════════ -->
<div class="proj-modal-overlay" id="projModal" onclick="closeProjModalOnOverlay(event)">
  <div class="proj-modal" id="projModalBox">

    <div class="pm-header">
      <div class="pm-header-left">
        <div class="pm-type-tag" id="pm-type-tag"></div>
        <div class="pm-title" id="pm-title"></div>
      </div>
      <button class="pm-close" onclick="closeProjModal()"><i class="fas fa-times"></i></button>
    </div>

    <div class="pm-body" id="pm-body">
      <!-- Filled by JS per project -->
    </div>

  </div>
</div>

<!-- ════════ RESUME MODAL ════════ -->
<div class="modal-overlay" id="resumeModal">
  <div class="modal-box">
    <div class="modal-bar">
      <h3><i class="fas fa-file-alt" style="color:#3b82f6;margin-right:8px"></i>Resume — <?= esc($header['name']??'') ?></h3>
      <div class="modal-bar-actions">
        <button class="btn-print" onclick="printResume()"><i class="fas fa-print"></i> Print / Save PDF</button>
        <button class="btn-close-modal" onclick="closeResumeModal()"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="modal-body">
      <div class="resume-embed">
        <div class="re-header">
          <div>
            <div class="re-name"><?= esc($header['name']??'') ?></div>
            <div class="re-position"><?= esc($header['position']??'') ?></div>
          </div>
          <div class="re-contacts">
            <?php if(!empty($header['email'])): ?><span class="re-contact-item"><i class="fas fa-envelope"></i><?= esc($header['email']) ?></span><?php endif; ?>
            <?php if(!empty($header['phone'])): ?><span class="re-contact-item"><i class="fas fa-phone"></i><?= esc($header['phone']) ?></span><?php endif; ?>
            <?php if(!empty($header['location'])): ?><span class="re-contact-item"><i class="fas fa-map-marker-alt"></i><?= esc($header['location']) ?></span><?php endif; ?>
            <?php if(!empty($header['linkedin'])): ?><span class="re-contact-item"><i class="fab fa-linkedin"></i><?= esc($header['linkedin']) ?></span><?php endif; ?>
          </div>
        </div>
        <div class="re-body">
          <div class="re-col-l">
            <?php if(!empty($summary['content'])): ?><div class="re-section"><div class="re-section-title">Summary</div><p class="re-summary"><?= esc($summary['content']) ?></p></div><?php endif; ?>
            <?php if(!empty($history)): ?>
            <div class="re-section"><div class="re-section-title">Work History</div>
              <?php foreach($history as $job): ?>
              <div class="re-job">
                <span class="re-job-role"><?= esc($job['role']) ?></span>
                <span class="re-job-meta"><?= esc($job['company']) ?> &middot; <?= esc($job['start_month']) ?> <?= esc($job['start_year']) ?> &ndash; <?= $job['is_current']?'Present':esc($job['end_month']).' '.esc($job['end_year']) ?></span>
                <?php if(!empty($job['bullets'])): ?><ul class="re-ul"><?php foreach($job['bullets'] as $b): ?><li><?= esc($b['content']) ?></li><?php endforeach; ?></ul><?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($skills)): ?><div class="re-section"><div class="re-section-title">Personal Skills</div><ul class="re-ul"><?php foreach($skills as $s): ?><li><?= esc($s['content']) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
          </div>
          <div class="re-col-r">
            <?php if(!empty($tech)): ?><div class="re-section"><div class="re-section-title">Stack of Technologies</div><ul class="re-ul"><?php foreach($tech as $t): ?><li><?= esc($t['content']) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
            <?php if(!empty($languages)): ?>
            <div class="re-section"><div class="re-section-title">Languages</div>
              <?php foreach($languages as $lang): ?>
              <div class="re-lang-item"><span><?= esc($lang['language']) ?></span><div class="re-lang-dots"><?php for($i=1;$i<=5;$i++): ?><span class="re-dot <?= ($lang['mastery']/20)>=$i?'on':'' ?>"></span><?php endfor; ?></div></div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($education)): ?>
            <div class="re-section"><div class="re-section-title">Education</div>
              <?php foreach($education as $edu): ?>
              <div class="re-edu"><div class="re-edu-deg"><?= esc($edu['degree']) ?></div><div class="re-edu-sch"><?= esc($edu['school']) ?></div><div class="re-edu-dt"><?= esc($edu['start_month']) ?> <?= esc($edu['start_year']) ?> &ndash; <?= esc($edu['end_month']) ?> <?= esc($edu['end_year']) ?></div><?php if(!empty($edu['bullets'])): ?><ul class="re-ul"><?php foreach($edu['bullets'] as $b): ?><li><?= esc($b['content']) ?></li><?php endforeach; ?></ul><?php endif; ?></div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($certifications)): ?><div class="re-section"><div class="re-section-title">Certifications</div><?php foreach($certifications as $cert): ?><div class="re-cert"><div class="re-cert-name"><?= esc($cert['name']) ?></div><div class="re-cert-yr"><?= esc($cert['year']) ?></div></div><?php endforeach; ?></div><?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// ── SCROLL PROGRESS ──
window.addEventListener('scroll', () => {
  const el = document.getElementById('scroll-progress');
  const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
  el.style.width = Math.min(pct, 100) + '%';
}, { passive: true });

// ── MODAL ──
function openResumeModal(e) { e&&e.preventDefault(); document.getElementById('resumeModal').classList.add('open'); document.body.style.overflow='hidden'; }
function closeResumeModal() { document.getElementById('resumeModal').classList.remove('open'); document.body.style.overflow=''; }
document.getElementById('resumeModal').addEventListener('click', function(e) { if(e.target===this) closeResumeModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closeResumeModal(); });
function printResume() { document.getElementById('resumeModal').classList.add('open'); setTimeout(()=>window.print(),300); }

// ── LOGOUT ──
function confirmLogout(e) { e.preventDefault(); if(confirm('Are you sure you want to logout?')) window.location.href='<?= base_url('logout') ?>'; }

// ── MOBILE NAV ──
function toggleMobileNav(el) {
  const links = document.querySelector('.nav-links');
  const isOpen = links.style.display === 'flex';
  links.style.cssText = isOpen ? '' : 'display:flex;flex-direction:column;position:fixed;top:70px;left:0;right:0;background:rgba(5,8,16,0.97);backdrop-filter:blur(20px);padding:16px 24px 28px;border-bottom:1px solid rgba(255,255,255,0.07);box-shadow:0 20px 60px rgba(0,0,0,0.5);gap:4px;z-index:499';
}

// ── PROJECT FILTER ──
function filterProjects(cat, btn) {
  document.querySelectorAll('.proj-filter').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');

  const cards = document.querySelectorAll('.proj-card');
  const toShow = [], toHide = [];

  cards.forEach(card => {
    const cats = card.dataset.category || '';
    const visible = cat === 'all' || cats.includes(cat);
    if (visible) toShow.push(card);
    else toHide.push(card);
  });

  // Step 1: fade out cards that need to hide
  toHide.forEach(card => {
    card.classList.remove('showing');
    card.classList.add('hiding');
  });

  // Step 2: after fade out, hide them and reveal new ones
  setTimeout(() => {
    toHide.forEach(card => {
      card.classList.add('hidden');
      card.classList.remove('hiding');
    });

    toShow.forEach(card => {
      card.classList.remove('hidden');
      card.classList.add('showing');
      // Force reflow so transition fires
      card.offsetHeight;
    });

    // Step 3: animate new cards in with stagger
    toShow.forEach((card, i) => {
      setTimeout(() => {
        card.classList.remove('showing');
      }, i * 60);
    });
  }, 280);
}

// ── THESIS ACCORDION ──
function togglePhase(header) {
  const phase = header.closest('.thesis-phase');
  const isOpen = phase.classList.contains('open');
  document.querySelectorAll('.thesis-phase').forEach(p => p.classList.remove('open'));
  if(!isOpen) phase.classList.add('open');
}

// ── INTERSECTION OBSERVER — scroll animations + counters + ISO bars ──
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if(!entry.isIntersecting) return;

    // Entrance animations
    if(entry.target.classList.contains('anim')) {
      entry.target.style.animationPlayState = 'running';
    }

    // Counter animation
    if(entry.target.id === 'counters') {
      entry.target.querySelectorAll('.counter-val[data-target]').forEach(el => {
        const target = parseInt(el.dataset.target);
        const suffix = el.dataset.suffix || '';
        let start = 0;
        const duration = 1400;
        const step = (timestamp) => {
          if(!start) start = timestamp;
          const progress = Math.min((timestamp - start) / duration, 1);
          const ease = 1 - Math.pow(1 - progress, 3);
          el.textContent = Math.round(ease * target) + suffix;
          if(progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
      });
    }

    observer.unobserve(entry.target);
  });
}, { threshold: 0.15 });

document.querySelectorAll('.anim').forEach(el => {
  el.style.animationPlayState = 'paused';
  observer.observe(el);
});
const countersEl=document.getElementById('counters');
const isoGridEl=document.getElementById('iso-grid');
if(countersEl)observer.observe(countersEl);
if(isoGridEl)observer.observe(isoGridEl);


// ════════════════════════════════════════════════
// PROJECT MODAL
// ════════════════════════════════════════════════
const PROJECTS = {
  <?php
  $typeStyles = [
    'thesis'  =>'background:rgba(139,92,246,0.28);color:#d8b4fe;border:1px solid rgba(139,92,246,0.3)',
    'ojt'     =>'background:rgba(6,182,212,0.18);color:#67e8f9;border:1px solid rgba(6,182,212,0.25)',
    'lgu'     =>'background:rgba(16,185,129,0.16);color:#6ee7b7;border:1px solid rgba(16,185,129,0.22)',
    'personal'=>'background:rgba(251,191,36,0.16);color:#fde68a;border:1px solid rgba(251,191,36,0.22)',
  ];
  $typeLabels=['thesis'=>'★ Thesis','ojt'=>'OJT','lgu'=>'LGU','personal'=>'Personal'];
  foreach($projects as $proj):
    $cat = $proj['category'] ?? 'personal';
    $projTech = json_decode($proj['tech'] ?? '[]', true) ?: [];
  ?>
  <?= $proj['id'] ?>: {
    type: <?= json_encode($typeLabels[$cat] ?? $cat) ?>,
    typeStyle: <?= json_encode($typeStyles[$cat] ?? $typeStyles['personal']) ?>,
    title: <?= json_encode($proj['title']) ?>,
    desc: <?= json_encode($proj['description']) ?>,
    tech: <?= json_encode($projTech) ?>,
    github: <?= json_encode($proj['github_url'] ?: null) ?>,
    demo: <?= json_encode($proj['demo_url'] ?: null) ?>,
    extra: <?= json_encode($cat==='thesis' ? 'thesis' : null) ?>,
  },
  <?php endforeach; ?>
}
// Thesis phases — from database
const THESIS_PHASES = <?php
  $thesisPhaseJs = [];
  foreach(($thesisPhases ?? []) as $ph) {
      $thesisPhaseJs[] = [
          'num'     => $ph['num'],
          'title'   => $ph['title'],
          'content' => $ph['content'],
      ];
  }
  echo json_encode($thesisPhaseJs);
?>;

// ISO scores — from database
const ISO_SCORES = <?php
  $isoJs = [];
  foreach(($isoScores ?? []) as $s) {
      $isoJs[] = ['label' => $s['label'], 'score' => (int)$s['score']];
  }
  echo json_encode($isoJs);
?>;

function openProject(id) {
  const p = PROJECTS[id];
  if(!p) return;

  document.getElementById('pm-type-tag').textContent = p.type;
  document.getElementById('pm-type-tag').style.cssText = p.typeStyle;
  document.getElementById('pm-title').textContent = p.title;

  let body = `
    <p class="pm-desc">${p.desc}</p>
    <div class="pm-tech-row">${p.tech.map(t => `<span class="pm-tech">${t}</span>`).join('')}</div>
    <div class="pm-links">
      ${p.github ? `<a href="${p.github}" class="pm-link-btn pm-link-github" target="_blank"><i class="fab fa-github"></i> View on GitHub</a>` : ''}
      ${p.demo ? `<a href="${p.demo}" class="pm-link-btn pm-link-demo" target="_blank"><i class="fas fa-external-link-alt"></i> Live Demo</a>` : ''}
    </div>`;

  if(p.extra === 'thesis') {
    body += `
      <div class="pm-divider"></div>
      <div class="pm-section-label">Development Methodology — Iterative Incremental Model</div>
      <div class="pm-accordion">
        ${THESIS_PHASES.map((ph,i) => `
          <div class="pm-phase${i===0?' open':''}">
            <div class="pm-phase-header" onclick="togglePmPhase(this)">
              <div class="pm-phase-num">${ph.num}</div>
              <div class="pm-phase-title">${ph.title}</div>
              <i class="fas fa-chevron-down pm-phase-chevron"></i>
            </div>
            <div class="pm-phase-body">
              <div class="pm-phase-content">${ph.content}</div>
            </div>
          </div>`).join('')}
      </div>
      <div class="pm-divider"></div>
      <div class="pm-section-label">ISO 25010 Evaluation Results</div>
      <div class="pm-iso-grid">
        ${ISO_SCORES.map(s => `
          <div class="pm-iso-card">
            <div class="pm-iso-label">${s.label}</div>
            <div class="pm-iso-bar-bg"><div class="pm-iso-bar-fill" data-w="${s.score}"></div></div>
            <div class="pm-iso-score">${s.score}%</div>
          </div>`).join('')}
      </div>`;
  }

  document.getElementById('pm-body').innerHTML = body;
  document.getElementById('projModal').classList.add('open');
  document.body.style.overflow = 'hidden';

  // Animate ISO bars after render
  if(p.extra === 'thesis') {
    setTimeout(() => {
      document.querySelectorAll('.pm-iso-bar-fill[data-w]').forEach((bar,i) => {
        setTimeout(() => { bar.style.width = bar.dataset.w + '%'; }, i * 100);
      });
    }, 200);
  }
}

function closeProjModal() {
  document.getElementById('projModal').classList.remove('open');
  document.body.style.overflow = '';
}

function closeProjModalOnOverlay(e) {
  if(e.target === document.getElementById('projModal')) closeProjModal();
}

function togglePmPhase(header) {
  const phase = header.closest('.pm-phase');
  const isOpen = phase.classList.contains('open');
  document.querySelectorAll('.pm-phase').forEach(p => p.classList.remove('open'));
  if(!isOpen) phase.classList.add('open');
}

// Close on Escape
document.addEventListener('keydown', e => {
  if(e.key === 'Escape') { closeProjModal(); closeResumeModal(); }
});

// ════ PROJECT CARD CLICK — Event delegation ════
document.getElementById('proj-grid').addEventListener('click', function(e) {
    const card = e.target.closest('.proj-card');
    if(!card) return;
    const id = card.dataset.project;
    if(id) openProject(id);
});

document.getElementById('proj-grid').addEventListener('click',function(e){
    const card=e.target.closest('.proj-card');
    if(!card)return;
    const id=parseInt(card.dataset.project);
    if(id)openProject(id);
});

// ── NAVBAR ACTIVE ON SCROLL ──
const navSections = ['hero','services','projects','testimonials','contact'];
window.addEventListener('scroll', () => {
  const y = window.scrollY + 90;
  navSections.forEach(id => {
    const el = document.getElementById(id);
    if(!el) return;
    const link = document.querySelector(`.nav-link[href="#${id}"]`);
    if(!link) return;
    if(el.offsetTop <= y && el.offsetTop + el.offsetHeight > y) {
      document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    }
  });
}, { passive: true });
</script>
</body>
</html>