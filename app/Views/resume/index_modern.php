<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= esc($header['name'] ?? 'Resume') ?> — <?= esc($header['position'] ?? '') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --accent:#0f766e;
  --ink:#111827;
  --muted:#6b7280;
  --line:#e5e7eb;
  --bg:#f5f5f4;
}
body{background:var(--bg);font-family:'Inter',sans-serif;color:var(--ink);font-size:13px;line-height:1.6;-webkit-font-smoothing:antialiased;print-color-adjust:exact}
.resume-wrapper{max-width:820px;margin:40px auto 80px;background:#fff;padding:64px 72px;box-shadow:0 1px 3px rgba(0,0,0,0.04),0 4px 24px rgba(0,0,0,0.06)}

/* Header */
.resume-header{padding-bottom:24px;border-bottom:1px solid var(--line);margin-bottom:32px;display:flex;align-items:flex-start;gap:22px}
.header-photo{width:90px;height:90px;border-radius:10px;object-fit:cover;flex-shrink:0;border:1px solid var(--line)}
.header-text{flex:1;min-width:0}
.header-name{font-size:32px;font-weight:600;letter-spacing:-0.6px;line-height:1.1;color:var(--ink)}
.header-position{margin-top:6px;font-size:14px;font-weight:400;color:var(--accent);letter-spacing:0.2px}
.header-contacts{display:flex;flex-wrap:wrap;gap:18px;margin-top:18px}
.contact-item{display:flex;align-items:center;gap:7px;font-size:12px;color:var(--muted);font-weight:400;text-decoration:none}
.contact-item i{color:var(--accent);font-size:11px;width:12px;text-align:center}
a.contact-item:hover{color:var(--accent)}

/* Sections */
.section{margin-bottom:30px}
.section:last-child{margin-bottom:0}
.section-title{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:2px;color:var(--accent);margin-bottom:14px}
.summary-text{font-size:13.5px;color:#374151;line-height:1.7;font-weight:400}
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:32px}
.entry{margin-bottom:18px;position:relative}
.entry:last-child{margin-bottom:0}
.entry-head{display:flex;justify-content:space-between;align-items:baseline;gap:16px;margin-bottom:3px}
.entry-title{font-weight:600;font-size:13.5px;color:var(--ink)}
.entry-dates{font-size:11.5px;color:var(--muted);font-weight:400;font-variant-numeric:tabular-nums;white-space:nowrap}
.entry-sub{font-size:12.5px;color:var(--accent);font-weight:500;margin-bottom:6px}
.bullet-list{list-style:none;padding:0;margin-top:6px}
.bullet-list li{font-size:12.5px;color:#374151;margin-bottom:4px;line-height:1.6;padding-left:14px;position:relative}
.bullet-list li::before{content:"";position:absolute;left:0;top:9px;width:5px;height:1px;background:var(--accent)}
.tag-list{display:flex;flex-wrap:wrap;gap:6px}
.tag{font-size:11.5px;color:#374151;padding:4px 10px;border:1px solid var(--line);border-radius:3px;background:#fafafa;font-weight:400}
.cert-item{margin-bottom:10px;display:flex;justify-content:space-between;align-items:baseline;gap:12px}
.cert-item:last-child{margin-bottom:0}
.cert-name{font-weight:500;font-size:12.5px;color:var(--ink);line-height:1.45}
.cert-year{font-size:11.5px;color:var(--muted);font-variant-numeric:tabular-nums;white-space:nowrap}
.language-item{display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;font-size:12.5px}
.language-item:last-child{margin-bottom:0}
.lang-name{color:var(--ink);font-weight:500}
.lang-bar{flex:1;margin:0 14px;height:2px;background:var(--line);border-radius:1px;overflow:hidden;max-width:120px}
.lang-fill{height:100%;background:var(--accent)}
.lang-level{font-size:11px;color:var(--muted);min-width:60px;text-align:right}

/* Toolbar */
.toolbar{position:fixed;bottom:18px;right:18px;display:flex;gap:8px;z-index:999;align-items:center}
.toolbar select.format-picker{padding:9px 32px 9px 14px;border-radius:6px;border:none;background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'><path fill='%23111827' d='M0 0l5 6 5-6z'/></svg>") no-repeat right 12px center;font-size:12px;font-family:'Inter',sans-serif;font-weight:500;color:var(--ink);cursor:pointer;box-shadow:0 4px 18px rgba(0,0,0,0.16);appearance:none;-webkit-appearance:none}
.toolbar-btn{display:flex;align-items:center;gap:7px;padding:9px 16px;border:none;border-radius:6px;text-decoration:none;font-size:12px;font-family:'Inter',sans-serif;font-weight:500;cursor:pointer;box-shadow:0 4px 18px rgba(0,0,0,0.16);transition:transform 0.15s,box-shadow 0.15s}
.toolbar-btn:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(0,0,0,0.22)}
.toolbar-btn.print{background:#fff;color:var(--ink)}
.toolbar-btn.manage{background:var(--ink);color:#fff}
.toolbar-btn.logout{background:#dc2626;color:#fff}
.toolbar-btn.login{background:var(--accent);color:#fff}

@media print{
  .toolbar{display:none}
  body{background:#fff}
  .resume-wrapper{margin:0;padding:36px 44px;box-shadow:none;max-width:100%}
  .section{margin-bottom:22px;page-break-inside:avoid}
  .entry{page-break-inside:avoid}
}
@media(max-width:680px){
  .resume-wrapper{padding:32px 24px;margin:16px}
  .grid-2{grid-template-columns:1fr;gap:24px}
  .entry-head{flex-direction:column;gap:2px}
  .header-name{font-size:26px}
  .resume-header{flex-direction:column}
}
</style>
</head>
<body>

<div class="resume-wrapper">

  <!-- HEADER -->
  <header class="resume-header">
    <?php if (!empty($photoUrl)): ?>
      <img src="<?= esc($photoUrl) ?>"
           alt="<?= esc($header['name'] ?? '') ?>"
           class="header-photo"
           style="object-position:<?= esc($photoPosition ?? '50% 50%') ?>">
    <?php endif; ?>
    <div class="header-text">
      <div class="header-name"><?= esc($header['name'] ?? '') ?></div>
      <?php if (!empty($header['position'])): ?>
      <div class="header-position"><?= esc($header['position']) ?></div>
      <?php endif; ?>
      <div class="header-contacts">
        <?php if (!empty($header['email'])): ?>
        <span class="contact-item"><i class="fas fa-envelope"></i><?= esc($header['email']) ?></span>
        <?php endif; ?>
        <?php if (!empty($header['phone'])): ?>
        <span class="contact-item"><i class="fas fa-phone"></i><?= esc($header['phone']) ?></span>
        <?php endif; ?>
        <?php if (!empty($header['location'])): ?>
        <span class="contact-item"><i class="fas fa-map-marker-alt"></i><?= esc($header['location']) ?></span>
        <?php endif; ?>
        <?php if (!empty($header['linkedin'])): ?>
        <span class="contact-item"><i class="fab fa-linkedin"></i><?= esc($header['linkedin']) ?></span>
        <?php endif; ?>
        <?php if (!empty($header['portfolio_url'])): ?>
        <a class="contact-item" href="<?= esc($header['portfolio_url']) ?>" target="_blank" rel="noopener"><i class="fas fa-globe"></i><?= esc($header['portfolio_url']) ?></a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- SUMMARY -->
  <?php if (!empty($summary['content'])): ?>
  <section class="section">
    <div class="section-title">Summary</div>
    <p class="summary-text"><?= esc($summary['content']) ?></p>
  </section>
  <?php endif; ?>

  <!-- EXPERIENCE -->
  <?php if (!empty($history)): ?>
  <section class="section">
    <div class="section-title">Experience</div>
    <?php foreach ($history as $job): ?>
    <div class="entry">
      <div class="entry-head">
        <span class="entry-title"><?= esc($job['role']) ?></span>
        <span class="entry-dates">
          <?= esc($job['start_month']) ?> <?= esc($job['start_year']) ?> &ndash;
          <?= $job['is_current'] ? 'Present' : esc($job['end_month']).' '.esc($job['end_year']) ?>
        </span>
      </div>
      <div class="entry-sub"><?= esc($job['company']) ?></div>
      <?php if (!empty($job['bullets'])): ?>
      <ul class="bullet-list">
        <?php foreach ($job['bullets'] as $b): ?>
        <li><?= esc($b['content']) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endif; ?>

  <!-- EDUCATION -->
  <?php if (!empty($education)): ?>
  <section class="section">
    <div class="section-title">Education</div>
    <?php foreach ($education as $edu): ?>
    <div class="entry">
      <div class="entry-head">
        <span class="entry-title"><?= esc($edu['degree']) ?></span>
        <span class="entry-dates">
          <?= esc($edu['start_month']) ?> <?= esc($edu['start_year']) ?> &ndash;
          <?= esc($edu['end_month']) ?> <?= esc($edu['end_year']) ?>
        </span>
      </div>
      <div class="entry-sub"><?= esc($edu['school']) ?></div>
      <?php if (!empty($edu['bullets'])): ?>
      <ul class="bullet-list">
        <?php foreach ($edu['bullets'] as $b): ?>
        <li><?= esc($b['content']) ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endif; ?>

  <!-- TECH STACK -->
  <?php if (!empty($tech)): ?>
  <section class="section">
    <div class="section-title">Stack of Technologies</div>
    <div class="tag-list">
      <?php foreach ($tech as $t): ?>
      <span class="tag"><?= esc($t['content']) ?></span>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- SKILLS + LANGUAGES -->
  <?php if (!empty($skills) || !empty($languages)): ?>
  <div class="grid-2">
    <?php if (!empty($skills)): ?>
    <section class="section" style="margin-bottom:0">
      <div class="section-title">Personal Skills</div>
      <ul class="bullet-list">
        <?php foreach ($skills as $s): ?>
        <li><?= esc($s['content']) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
    <?php endif; ?>

    <?php if (!empty($languages)): ?>
    <section class="section" style="margin-bottom:0">
      <div class="section-title">Languages</div>
      <?php foreach ($languages as $lang): ?>
      <div class="language-item">
        <span class="lang-name"><?= esc($lang['language']) ?></span>
        <div class="lang-bar">
          <div class="lang-fill" style="width:<?= (int)$lang['mastery'] ?>%"></div>
        </div>
        <span class="lang-level"><?= (int)$lang['mastery'] ?>%</span>
      </div>
      <?php endforeach; ?>
    </section>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <!-- CERTIFICATIONS -->
  <?php if (!empty($certifications)): ?>
  <section class="section" style="margin-top:30px">
    <div class="section-title">Certifications</div>
    <?php foreach ($certifications as $cert): ?>
    <div class="cert-item">
      <span class="cert-name"><?= esc($cert['name']) ?></span>
      <span class="cert-year"><?= esc($cert['year']) ?></span>
    </div>
    <?php endforeach; ?>
  </section>
  <?php endif; ?>

</div>

<!-- FLOATING TOOLBAR -->
<div class="toolbar">
  <select class="format-picker" onchange="window.location.href=this.value" title="Switch resume format">
    <option value="<?= base_url('resume/plain?format=classic') ?>" <?= ($currentFormat ?? 'classic') === 'classic' ? 'selected' : '' ?>>Classic</option>
    <option value="<?= base_url('resume/plain?format=modern') ?>"  <?= ($currentFormat ?? 'classic') === 'modern'  ? 'selected' : '' ?>>Modern</option>
  </select>

  <button type="button" class="toolbar-btn print" onclick="window.print()">
    <i class="fas fa-print"></i>Print
  </button>

  <a href="<?= base_url('resume/download') ?>" class="toolbar-btn manage" style="background:#16a34a">
    <i class="fas fa-file-word"></i>Download DOCX
  </a>

  <?php if (!empty($isLoggedIn)): ?>
    <a href="<?= base_url('admin') ?>" class="toolbar-btn manage"><i class="fas fa-cog"></i>Manage</a>
    <a href="<?= base_url('logout') ?>" class="toolbar-btn logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
  <?php else: ?>
    <a href="<?= base_url('login') ?>" class="toolbar-btn login"><i class="fas fa-lock"></i>Admin</a>
  <?php endif; ?>
</div>

</body>
</html>