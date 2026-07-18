<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= esc($header['name'] ?? 'Portfolio') ?> — <?= esc($about['tagline'] ?? 'Portfolio') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ── Variables ── */
:root{
  --blue:#2563eb; --blue-light:#3b82f6; --blue-pale:#eff6ff;
  --dark:#0f172a; --mid:#334155; --muted:#64748b; --border:#e2e8f0;
  --white:#fff; --bg:#f8fafc;
  --radius:16px; --nav-h:68px;
  --font:'Sora',sans-serif; --body-font:'DM Sans',sans-serif;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--body-font);background:var(--bg);color:var(--dark);overflow-x:hidden}

/* ── NAVBAR ── */
.navbar{position:fixed;top:0;left:0;right:0;z-index:500;height:var(--nav-h);background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 36px;gap:32px;box-shadow:0 1px 20px rgba(0,0,0,0.05)}
.nav-brand{display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0}
.nav-avatar{width:40px;height:40px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font);font-size:17px;font-weight:700;overflow:hidden;flex-shrink:0}
.nav-avatar img{width:100%;height:100%;object-fit:cover}
.nav-name{font-family:var(--font);font-size:16px;font-weight:700;color:var(--dark)}
.nav-name span{font-weight:300}
.nav-links{display:flex;align-items:center;gap:4px;margin-left:auto}
.nav-link{padding:7px 14px;border-radius:8px;text-decoration:none;font-size:13.5px;font-weight:500;color:var(--muted);transition:all 0.2s;white-space:nowrap}
.nav-link:hover,.nav-link.active{color:var(--blue);background:var(--blue-pale)}
.nav-btn{padding:8px 18px;background:var(--blue);color:#fff;border-radius:8px;font-size:13px;font-weight:600;font-family:var(--font);text-decoration:none;margin-left:8px;transition:background 0.2s}
.nav-btn:hover{background:#1d4ed8}
.nav-hamburger{display:none;flex-direction:column;gap:4px;cursor:pointer;padding:6px;margin-left:12px}
.nav-hamburger span{display:block;width:22px;height:2px;background:var(--dark);border-radius:2px;transition:all 0.3s}

/* ── HERO SECTION ── */
.hero{min-height:calc(100vh - var(--nav-h));margin-top:var(--nav-h);display:flex;align-items:center;padding:60px 8vw;gap:60px;background:var(--white);position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;right:-120px;top:-120px;width:500px;height:500px;background:radial-gradient(circle,rgba(37,99,235,0.07) 0%,transparent 70%);pointer-events:none}
.hero::after{content:'';position:absolute;left:-80px;bottom:-80px;width:360px;height:360px;background:radial-gradient(circle,rgba(59,130,246,0.05) 0%,transparent 70%);pointer-events:none}

/* Photo */
.hero-photo-wrap{flex-shrink:0;position:relative}
.hero-photo-ring{width:340px;height:340px;border-radius:50%;background:linear-gradient(135deg,#e0eaff 0%,#f0f4ff 100%);display:flex;align-items:center;justify-content:center;position:relative;box-shadow:0 0 0 8px #f0f4ff,0 0 0 16px #e8eeff,0 24px 60px rgba(37,99,235,0.12)}
.hero-photo-ring img,.hero-photo-ring .photo-placeholder{width:300px;height:300px;border-radius:50%;object-fit:cover;object-position:top;display:block}
.photo-placeholder{background:linear-gradient(135deg,#cbd5e1,#94a3b8);display:flex;align-items:center;justify-content:center;color:#fff;font-size:80px}
.hero-photo-badge{position:absolute;bottom:16px;right:8px;background:var(--blue);color:#fff;border-radius:50px;padding:6px 14px;font-size:11px;font-weight:600;font-family:var(--font);letter-spacing:0.5px;box-shadow:0 4px 16px rgba(37,99,235,0.35)}

/* Text */
.hero-text{flex:1;min-width:0}
.hero-tagline{font-size:13px;font-weight:500;color:var(--blue);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:12px}
.hero-name{font-family:var(--font);font-size:clamp(36px,4.5vw,58px);font-weight:800;line-height:1.05;color:var(--dark);margin-bottom:20px}
.hero-name span{font-weight:300}
.hero-bio{font-size:15px;line-height:1.8;color:var(--muted);max-width:520px;margin-bottom:32px}
.hero-btns{display:flex;gap:14px;flex-wrap:wrap}
.btn-cv{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;border:2px solid var(--dark);border-radius:50px;font-size:14px;font-weight:600;font-family:var(--font);color:var(--dark);text-decoration:none;transition:all 0.25s;background:transparent}
.btn-cv:hover{background:var(--dark);color:#fff;border-color:var(--dark)}
.btn-contact{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;border:2px solid transparent;border-radius:50px;font-size:14px;font-weight:600;font-family:var(--font);color:var(--muted);text-decoration:none;transition:all 0.25s;background:var(--bg)}
.btn-contact:hover{border-color:var(--border);color:var(--dark)}

/* Social icons */
.hero-socials{display:flex;gap:10px;margin-top:28px}
.social-icon{width:38px;height:38px;border-radius:10px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);text-decoration:none;font-size:14px;transition:all 0.2s}
.social-icon:hover{background:var(--blue);border-color:var(--blue);color:#fff}

/* ── SECTION COMMON ── */
.section{padding:72px 8vw;background:var(--white)}
.section.alt{background:var(--bg)}
.section-label{display:flex;flex-direction:column;gap:6px;margin-bottom:44px}
.section-label h2{font-family:var(--font);font-size:26px;font-weight:700;color:var(--dark)}
.section-label .underline{width:44px;height:3px;background:var(--blue);border-radius:2px}

/* ── WHAT I DO GRID ── */
.services-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px}
.service-card{display:flex;gap:18px;padding:24px;border-radius:var(--radius);border:1px solid var(--border);background:var(--white);transition:box-shadow 0.25s,transform 0.25s}
.service-card:hover{box-shadow:0 8px 32px rgba(37,99,235,0.1);transform:translateY(-3px)}
.service-icon{width:46px;height:46px;border-radius:12px;background:var(--blue-pale);display:flex;align-items:center;justify-content:center;color:var(--blue);font-size:18px;flex-shrink:0}
.service-body h3{font-family:var(--font);font-size:15px;font-weight:700;margin-bottom:6px;color:var(--dark)}
.service-body p{font-size:13px;line-height:1.75;color:var(--muted)}

/* ── TESTIMONIALS ── */
.testimonials-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:22px}
.testimonial-card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius);padding:28px;position:relative}
.testimonial-card::before{content:'\201C';font-size:64px;font-family:Georgia,serif;color:var(--blue);opacity:0.2;position:absolute;top:12px;left:20px;line-height:1}
.testimonial-quote{font-size:14px;line-height:1.8;color:var(--mid);margin-bottom:20px;padding-top:24px}
.testimonial-author{display:flex;align-items:center;gap:12px}
.testimonial-avatar{width:40px;height:40px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;color:#fff;font-family:var(--font);font-weight:700;font-size:15px;flex-shrink:0}
.testimonial-name{font-weight:600;font-size:14px;font-family:var(--font)}
.testimonial-role{font-size:12px;color:var(--muted)}

/* ── RESUME PREVIEW STRIP ── */
.resume-strip{background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 100%);color:#fff;padding:56px 8vw;text-align:center}
.resume-strip h2{font-family:var(--font);font-size:30px;font-weight:800;margin-bottom:10px}
.resume-strip p{font-size:15px;opacity:0.8;margin-bottom:28px}
.btn-view-resume{display:inline-flex;align-items:center;gap:10px;padding:14px 32px;background:#fff;color:var(--blue);border-radius:50px;font-family:var(--font);font-size:15px;font-weight:700;text-decoration:none;box-shadow:0 8px 32px rgba(0,0,0,0.2);transition:transform 0.2s,box-shadow 0.2s}
.btn-view-resume:hover{transform:translateY(-3px);box-shadow:0 12px 40px rgba(0,0,0,0.25)}

/* ── CONTACT ── */
#contact{padding:72px 8vw;background:var(--white)}
.contact-inner{max-width:580px;margin:0 auto;text-align:center}
.contact-inner h2{font-family:var(--font);font-size:30px;font-weight:800;margin-bottom:10px}
.contact-inner p{color:var(--muted);font-size:15px;margin-bottom:30px}
.btn-email{display:inline-flex;align-items:center;gap:10px;padding:14px 30px;background:var(--blue);color:#fff;border-radius:50px;font-family:var(--font);font-size:15px;font-weight:600;text-decoration:none;transition:background 0.2s}
.btn-email:hover{background:#1d4ed8}

/* ── FOOTER ── */
footer{text-align:center;padding:22px;background:var(--bg);font-size:12px;color:var(--muted);border-top:1px solid var(--border)}

/* ── ADMIN FLOAT ── */
.admin-float{position:fixed;bottom:20px;right:20px;display:flex;gap:8px;z-index:600}
.af-btn{display:flex;align-items:center;gap:7px;padding:9px 16px;border-radius:50px;font-family:var(--font);font-size:12px;font-weight:600;text-decoration:none;box-shadow:0 4px 20px rgba(0,0,0,0.15);transition:transform 0.15s}
.af-btn:hover{transform:translateY(-2px)}
.af-btn.manage{background:#1e293b;color:#fff}
.af-btn.logout{background:#ef4444;color:#fff}
.af-btn.login{background:var(--blue);color:#fff}

/* ── RESUME MODAL ── */
.modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,0.75);z-index:800;display:flex;align-items:flex-start;justify-content:center;padding:24px;overflow-y:auto;opacity:0;pointer-events:none;transition:opacity 0.3s}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal-box{background:#fff;border-radius:20px;max-width:950px;width:100%;position:relative;animation:modalIn 0.35s ease both}
@keyframes modalIn{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
.modal-bar{display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid var(--border)}
.modal-bar h3{font-family:var(--font);font-size:16px;font-weight:700}
.modal-bar-actions{display:flex;gap:10px;align-items:center}
.btn-print{display:inline-flex;align-items:center;gap:7px;padding:8px 18px;background:var(--blue);color:#fff;border:none;border-radius:8px;font-family:var(--font);font-size:13px;font-weight:600;cursor:pointer}
.btn-close-modal{width:34px;height:34px;border-radius:8px;border:1px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;color:var(--muted)}
.modal-body{padding:0}
/* Resume inside modal */
.resume-embed{font-family:'Source Sans Pro',sans-serif;color:#2c3e50;font-size:13px;line-height:1.55}
.re-header{background:#2c3e50;color:#fff;padding:26px 36px;display:flex;justify-content:space-between;align-items:center;gap:20px;border-radius:0 0 0 0}
.re-name{font-family:'Sora',serif;font-size:28px;font-weight:700;line-height:1.1}
.re-position{margin-top:4px;font-size:11px;font-weight:300;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,0.6)}
.re-contacts{display:flex;flex-direction:column;gap:4px;align-items:flex-end}
.re-contact-item{display:flex;align-items:center;gap:6px;font-size:11.5px;color:rgba(255,255,255,0.8)}
.re-contact-item i{color:#3b82f6;font-size:10px}
.re-body{display:grid;grid-template-columns:1fr 0.62fr}
.re-col-l{padding:20px 24px 24px;border-right:2px solid #f0f2f4}
.re-col-r{padding:20px 20px 24px;background:#f9fafb}
.re-section{margin-bottom:18px}
.re-section-title{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:#2c3e50;padding-bottom:4px;border-bottom:2px solid #3b82f6;margin-bottom:10px}
.re-summary{font-size:12.5px;color:#555;line-height:1.75}
.re-job{margin-bottom:14px}
.re-job-role{display:block;font-weight:700;font-size:13px}
.re-job-meta{display:block;font-size:11px;color:#3b82f6;font-style:italic;margin:1px 0 4px}
.re-ul{padding-left:14px;margin-top:3px}
.re-ul li{font-size:12px;color:#555;margin-bottom:2px}
.re-edu{margin-bottom:12px}
.re-edu-deg{font-weight:700;font-size:13px}
.re-edu-sch{font-size:11.5px;color:#3b82f6;margin:1px 0}
.re-edu-dt{font-size:11px;color:#888;margin-bottom:4px}
.re-cert{margin-bottom:10px}
.re-cert-name{font-weight:600;font-size:12px;line-height:1.4}
.re-cert-yr{font-size:11px;color:#3b82f6;margin-top:2px}
.re-lang-item{display:flex;align-items:center;justify-content:space-between;margin-bottom:7px}
.re-lang-dots{display:flex;gap:4px}
.re-dot{width:10px;height:10px;border-radius:50%;background:#d1d5db;border:1.5px solid #c4c9d0}
.re-dot.on{background:#3b82f6;border-color:#2563eb}

@media print {
    * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* Hide everything except modal */
    body > *:not(#resumeModal) {
        display: none !important;
    }

    body {
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
    }

    /* Show modal as full page */
    #resumeModal {
        display: block !important;
        position: static !important;
        background: #fff !important;
        padding: 0 !important;
        overflow: visible !important;
        opacity: 1 !important;
        pointer-events: all !important;
    }

    .modal-box {
        max-width: 100% !important;
        width: 100% !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        animation: none !important;
    }

    /* Hide modal toolbar */
    .modal-bar { display: none !important; }

    /* Fit everything on one page */
    .resume-embed {
        font-size: 10px !important;
        line-height: 1.35 !important;
    }

    /* Dark header */
    .re-header {
        background: #2c3e50 !important;
        color: #fff !important;
        padding: 14px 24px !important;
    }

    .re-name { font-size: 20px !important; }
    .re-position { font-size: 9px !important; }
    .re-contact-item { font-size: 9px !important; }

    /* Two column layout */
    .re-body {
        display: grid !important;
        grid-template-columns: 1fr 0.62fr !important;
    }

    .re-col-l {
        padding: 10px 14px !important;
        border-right: 1px solid #e2e8f0 !important;
    }

    .re-col-r {
        padding: 10px 12px !important;
        background: #f9fafb !important;
    }

    /* Tighten spacing */
    .re-section { margin-bottom: 8px !important; }
    .re-section-title {
        font-size: 8px !important;
        padding-bottom: 2px !important;
        margin-bottom: 5px !important;
        border-bottom: 1.5px solid #3b82f6 !important;
    }

    .re-job { margin-bottom: 7px !important; }
    .re-job-role { font-size: 11px !important; }
    .re-job-meta { font-size: 9px !important; }

    .re-ul li { font-size: 9px !important; margin-bottom: 1px !important; }
    .re-summary { font-size: 10px !important; }

    .re-edu { margin-bottom: 7px !important; }
    .re-edu-deg { font-size: 11px !important; }
    .re-edu-sch { font-size: 9px !important; }
    .re-edu-dt { font-size: 9px !important; }

    .re-cert { margin-bottom: 6px !important; }
    .re-cert-name { font-size: 10px !important; }
    .re-cert-yr { font-size: 9px !important; }

    .re-lang-item { margin-bottom: 4px !important; font-size: 10px !important; }
    .re-dot { width: 8px !important; height: 8px !important; }

    /* Force single page */
    @page {
        size: A4 portrait;
        margin: 0;
    }
}
@media(max-width:700px){.hero{flex-direction:column;padding:40px 6vw;gap:36px;text-align:center}.hero-photo-ring{width:240px;height:240px}.hero-photo-ring img,.hero-photo-ring .photo-placeholder{width:204px;height:204px}.hero-btns{justify-content:center}.hero-socials{justify-content:center}.re-body{grid-template-columns:1fr}.re-col-l{border-right:none}.re-header{flex-direction:column;align-items:flex-start}.re-contacts{align-items:flex-start}.services-grid{grid-template-columns:1fr}.nav-links{display:none}.nav-hamburger{display:flex}}
</style>
</head>
<body>

<!-- ════════ NAVBAR ════════ -->
<nav class="navbar">
  <a class="nav-brand" href="<?= base_url() ?>">
    <div class="nav-avatar">
      <?php if (!empty($about['photo'])): ?>
      <img src="<?= base_url(esc($about['photo'])) ?>" alt="<?= esc($header['name'] ?? '') ?>">
      <?php else: ?>
      <?= strtoupper(substr($header['name'] ?? 'A', 0, 1)) ?>
      <?php endif; ?>
    </div>
    <div class="nav-name">
      <?php $parts = explode(' ', trim($header['name'] ?? 'Your Name'), 2); ?>
      <strong><?= esc($parts[0]) ?></strong><?= isset($parts[1]) ? ' <span>'.esc($parts[1]).'</span>' : '' ?>
    </div>
  </a>
  <div class="nav-links">
    <a class="nav-link active" href="#hero"><?= esc($about['nav_about'] ?? 'About Me') ?></a>
    <a class="nav-link" href="#services">What I Do</a>
    <?php if (!empty($testimonials)): ?>
    <a class="nav-link" href="#testimonials">Testimonials</a>
    <?php endif; ?>
    <a class="nav-link" href="#contact"><?= esc($about['nav_contact'] ?? 'Contact') ?></a>
    <a class="nav-btn" href="#" onclick="openResumeModal(event)"><?= esc($about['nav_resume'] ?? 'Resume') ?></a>
  </div>
  <div class="nav-hamburger" onclick="toggleMobileNav(this)">
    <span></span><span></span><span></span>
  </div>
</nav>

<!-- ════════ HERO ════════ -->
<section class="hero" id="hero">
  <div class="hero-photo-wrap">
    <div class="hero-photo-ring">
      <?php if (!empty($about['photo'])): ?>
      <img src="<?= base_url(esc($about['photo'])) ?>" alt="<?= esc($header['name'] ?? '') ?>">
      <?php else: ?>
      <div class="photo-placeholder"><i class="fas fa-user"></i></div>
      <?php endif; ?>
    </div>
    <div class="hero-photo-badge"><i class="fas fa-circle" style="color:#22c55e;font-size:7px"></i> Available for work</div>
  </div>

  <div class="hero-text">
    <div class="hero-tagline"><?= esc($about['tagline'] ?? '') ?></div>
    <h1 class="hero-name"><?= esc($header['name'] ?? '') ?></h1>
    <p class="hero-bio"><?= nl2br(esc($about['bio'] ?? '')) ?></p>
    <div class="hero-btns">
      <a href="#" class="btn-cv" onclick="openResumeModal(event)">
        <i class="fas fa-file-alt"></i> <?= esc($about['cv_label'] ?? 'Download CV') ?>
      </a>
      <?php if (!empty($about['btn_contact_email'])): ?>
      <a href="mailto:<?= esc($about['btn_contact_email']) ?>" class="btn-contact">
        <?= esc($about['btn_contact_label'] ?? 'Contact') ?>
      </a>
      <?php else: ?>
      <a href="#contact" class="btn-contact">
        <?= esc($about['btn_contact_label'] ?? 'Contact') ?>
      </a>
      <?php endif; ?>
    </div>
    <div class="hero-socials">
      <?php if (!empty($about['github'])): ?>
      <a href="<?= esc($about['github']) ?>" target="_blank" class="social-icon" title="GitHub"><i class="fab fa-github"></i></a>
      <?php endif; ?>
      <?php if (!empty($about['linkedin_url'])): ?>
      <a href="<?= esc($about['linkedin_url']) ?>" target="_blank" class="social-icon" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      <?php endif; ?>
      <?php if (!empty($about['twitter'])): ?>
      <a href="<?= esc($about['twitter']) ?>" target="_blank" class="social-icon" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
      <?php endif; ?>
      <?php if (!empty($about['facebook'])): ?>
      <a href="<?= esc($about['facebook']) ?>" target="_blank" class="social-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
      <?php endif; ?>
      <?php if (!empty($header['email'])): ?>
      <a href="mailto:<?= esc($header['email']) ?>" class="social-icon" title="Email"><i class="fas fa-envelope"></i></a>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- ════════ WHAT I DO ════════ -->
<?php if (!empty($services)): ?>
<section class="section alt" id="services">
  <div class="section-label">
    <h2>What I Do</h2>
    <div class="underline"></div>
  </div>
  <div class="services-grid">
    <?php foreach ($services as $svc): ?>
    <div class="service-card">
      <div class="service-icon"><i class="<?= esc($svc['icon']) ?>"></i></div>
      <div class="service-body">
        <h3><?= esc($svc['title']) ?></h3>
        <p><?= nl2br(esc($svc['description'])) ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ════════ TESTIMONIALS ════════ -->
<?php if (!empty($testimonials)): ?>
<section class="section" id="testimonials">
  <div class="section-label">
    <h2>Testimonials</h2>
    <div class="underline"></div>
  </div>
  <div class="testimonials-grid">
    <?php foreach ($testimonials as $t): ?>
    <div class="testimonial-card">
      <p class="testimonial-quote"><?= nl2br(esc($t['quote'])) ?></p>
      <div class="testimonial-author">
        <div class="testimonial-avatar"><?= strtoupper(substr($t['author'],0,1)) ?></div>
        <div>
          <div class="testimonial-name"><?= esc($t['author']) ?></div>
          <div class="testimonial-role"><?= esc($t['role']) ?></div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>

<!-- ════════ RESUME STRIP ════════ -->
<div class="resume-strip">
  <h2>Interested in working together?</h2>
  <p>View my full resume to see my complete work history, skills, and qualifications.</p>
  <a href="#" class="btn-view-resume" onclick="openResumeModal(event)">
    <i class="fas fa-file-user"></i> View Full Resume
  </a>
</div>

<!-- ════════ CONTACT ════════ -->
<section id="contact">
  <div class="contact-inner">
    <h2>Get In Touch</h2>
    <p>Have a project in mind or just want to say hello? I'd love to hear from you.</p>
    <?php $email = $about['btn_contact_email'] ?: ($header['email'] ?? ''); ?>
    <?php if (!empty($email)): ?>
    <a href="#" onclick="window.location.href='mai'+'lto:<?= esc($email) ?>'" class="btn-email">
      <i class="fas fa-envelope"></i> <?= esc($email) ?>
    </a>
    <?php endif; ?>
  </div>
</section>

<!-- ════════ FOOTER ════════ -->
<footer>
  &copy; <?= date('Y') ?> <?= esc($header['name'] ?? '') ?> &mdash; <?= esc($about['tagline'] ?? '') ?>
</footer>

<!-- ════════ ADMIN FLOAT ════════ -->
<div class="admin-float">
  <?php if (!empty($isLoggedIn)): ?>
    <a href="<?= base_url('admin') ?>" class="af-btn manage"><i class="fas fa-cog"></i> Manage</a>
    <a href="<?= base_url('logout') ?>" class="af-btn logout"><i class="fas fa-sign-out-alt"></i></a>
  <?php else: ?>
    <a href="<?= base_url('login') ?>" class="af-btn login"><i class="fas fa-lock"></i> Admin</a>
  <?php endif; ?>
</div>

<!-- ════════ RESUME MODAL ════════ -->
<div class="modal-overlay" id="resumeModal">
  <div class="modal-box">
    <div class="modal-bar">
      <h3><i class="fas fa-file-alt" style="color:var(--blue);margin-right:8px"></i>Resume — <?= esc($header['name'] ?? '') ?></h3>
      <div class="modal-bar-actions">
        <button class="btn-print" onclick="window.print()"><i class="fas fa-print"></i> Print / Save PDF</button>
        <button class="btn-close-modal" onclick="closeResumeModal()"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="modal-body">
      <div class="resume-embed">

        <!-- RESUME HEADER -->
        <div class="re-header">
          <div>
            <div class="re-name"><?= esc($header['name'] ?? '') ?></div>
            <div class="re-position"><?= esc($header['position'] ?? '') ?></div>
          </div>
          <div class="re-contacts">
            <?php if (!empty($header['email'])): ?>
            <span class="re-contact-item"><i class="fas fa-envelope"></i><?= esc($header['email']) ?></span>
            <?php endif; ?>
            <?php if (!empty($header['phone'])): ?>
            <span class="re-contact-item"><i class="fas fa-phone"></i><?= esc($header['phone']) ?></span>
            <?php endif; ?>
            <?php if (!empty($header['location'])): ?>
            <span class="re-contact-item"><i class="fas fa-map-marker-alt"></i><?= esc($header['location']) ?></span>
            <?php endif; ?>
            <?php if (!empty($header['linkedin'])): ?>
            <span class="re-contact-item"><i class="fab fa-linkedin"></i><?= esc($header['linkedin']) ?></span>
            <?php endif; ?>
          </div>
        </div>

        <!-- RESUME BODY -->
        <div class="re-body">
          <!-- LEFT -->
          <div class="re-col-l">
            <?php if (!empty($summary['content'])): ?>
            <div class="re-section">
              <div class="re-section-title">Summary</div>
              <p class="re-summary"><?= esc($summary['content']) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($history)): ?>
            <div class="re-section">
              <div class="re-section-title">Work History</div>
              <?php foreach ($history as $job): ?>
              <div class="re-job">
                <span class="re-job-role"><?= esc($job['role']) ?></span>
                <span class="re-job-meta">
                  <?= esc($job['company']) ?> &middot;
                  <?= esc($job['start_month']) ?> <?= esc($job['start_year']) ?> &ndash;
                  <?= $job['is_current'] ? 'Present' : esc($job['end_month']).' '.esc($job['end_year']) ?>
                </span>
                <?php if (!empty($job['bullets'])): ?>
                <ul class="re-ul">
                  <?php foreach ($job['bullets'] as $b): ?>
                  <li><?= esc($b['content']) ?></li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($skills)): ?>
            <div class="re-section">
              <div class="re-section-title">Personal Skills</div>
              <ul class="re-ul">
                <?php foreach ($skills as $s): ?>
                <li><?= esc($s['content']) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>
          </div>

          <!-- RIGHT -->
          <div class="re-col-r">
            <?php if (!empty($tech)): ?>
            <div class="re-section">
              <div class="re-section-title">Stack of Technologies</div>
              <ul class="re-ul">
                <?php foreach ($tech as $t): ?>
                <li><?= esc($t['content']) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($languages)): ?>
            <div class="re-section">
              <div class="re-section-title">Languages</div>
              <?php foreach ($languages as $lang): ?>
              <div class="re-lang-item">
                <span><?= esc($lang['language']) ?></span>
                <div class="re-lang-dots">
                  <?php for ($i=1;$i<=5;$i++): ?>
                  <span class="re-dot <?= ($lang['mastery']/20)>=$i?'on':'' ?>"></span>
                  <?php endfor; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($education)): ?>
            <div class="re-section">
              <div class="re-section-title">Education</div>
              <?php foreach ($education as $edu): ?>
              <div class="re-edu">
                <div class="re-edu-deg"><?= esc($edu['degree']) ?></div>
                <div class="re-edu-sch"><?= esc($edu['school']) ?></div>
                <div class="re-edu-dt"><?= esc($edu['start_month']) ?> <?= esc($edu['start_year']) ?> &ndash; <?= esc($edu['end_month']) ?> <?= esc($edu['end_year']) ?></div>
                <?php if (!empty($edu['bullets'])): ?>
                <ul class="re-ul">
                  <?php foreach ($edu['bullets'] as $b): ?>
                  <li><?= esc($b['content']) ?></li>
                  <?php endforeach; ?>
                </ul>
                <?php endif; ?>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($certifications)): ?>
            <div class="re-section">
              <div class="re-section-title">Certifications</div>
              <?php foreach ($certifications as $cert): ?>
              <div class="re-cert">
                <div class="re-cert-name"><?= esc($cert['name']) ?></div>
                <div class="re-cert-yr"><?= esc($cert['year']) ?></div>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
        </div>

      </div><!-- /resume-embed -->
    </div>
  </div>
</div>

<script>
function openResumeModal(e) {
  e && e.preventDefault();
  document.getElementById('resumeModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeResumeModal() {
  document.getElementById('resumeModal').classList.remove('open');
  document.body.style.overflow = '';
}
document.getElementById('resumeModal').addEventListener('click', function(e) {
  if (e.target === this) closeResumeModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeResumeModal(); });

function toggleMobileNav(el) {
  const links = document.querySelector('.nav-links');
  links.style.display = links.style.display === 'flex' ? 'none' : 'flex';
  links.style.flexDirection = 'column';
  links.style.position = 'fixed';
  links.style.top = '68px';
  links.style.left = '0';
  links.style.right = '0';
  links.style.background = '#fff';
  links.style.padding = '16px 24px 24px';
  links.style.borderBottom = '1px solid #e2e8f0';
  links.style.boxShadow = '0 8px 24px rgba(0,0,0,0.08)';
}

// Navbar active on scroll
const sections = ['hero','services','testimonials','contact'];
window.addEventListener('scroll', () => {
  const y = window.scrollY + 80;
  sections.forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    const link = document.querySelector(`.nav-link[href="#${id}"]`);
    if (!link) return;
    if (el.offsetTop <= y && el.offsetTop + el.offsetHeight > y) {
      document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    }
  });
});
</script>

</body>
</html>
