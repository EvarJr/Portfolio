<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= esc($header['name'] ?? 'Resume') ?> — <?= esc($header['position'] ?? '') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&family=Lora:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ─── Reset ─── */
*{margin:0;padding:0;box-sizing:border-box}

/* ─── Page ─── */
body{
  background:#e8e8e4;
  font-family:'Lato',sans-serif;
  color:#1a1a1a;
  font-size:10.5pt;
  line-height:1.55;
  print-color-adjust:exact;
  -webkit-print-color-adjust:exact;
}

/* ─── Paper wrapper ─── */
.page{
  max-width:820px;
  margin:32px auto 64px;
  background:#fff;
  box-shadow:0 2px 32px rgba(0,0,0,0.10);
}

/* ─── TOP HEADER BAND ─── */
.resume-header{
  padding:28px 44px 20px;
  display:flex;
  align-items:center;
  gap:22px;
}
.header-photo{
  width:82px;height:82px;border-radius:8px;
  object-fit:cover;flex-shrink:0;
  border:1.5px solid #ccc;
}
.header-text{flex:1;min-width:0}
.header-name{
  font-family:'Lora',serif;
  font-size:26pt;font-weight:600;
  letter-spacing:-0.3px;line-height:1.05;
  color:#1a1a1a;
}
.header-title{
  font-size:10pt;font-weight:700;
  text-transform:uppercase;letter-spacing:2px;
  color:#555;margin-top:4px;
}
.header-contacts{
  display:flex;flex-wrap:wrap;
  gap:4px 20px;margin-top:10px;
}
.contact-item{
  font-size:9.5pt;color:#333;
  display:flex;align-items:center;gap:5px;
  text-decoration:none;
}
.contact-item i{font-size:9pt;color:#555;width:12px;text-align:center}
a.contact-item:hover{color:#000;text-decoration:underline}

/* ─── Body ─── */
.resume-body{padding:0 44px 36px;border-top:2px solid #1a1a1a}

/* ─── SECTION ─── */
.section{margin-top:20px}

/* Section heading — mimics image 2 exactly */
.section-heading{
  font-family:'Lato',sans-serif;
  font-size:9.5pt;
  font-weight:900;
  text-transform:uppercase;
  letter-spacing:2px;
  color:#1a1a1a;
  padding-bottom:5px;
  border-bottom:1.5px solid #1a1a1a;   /* ← the separator line */
  margin-bottom:12px;
}

/* ─── Summary ─── */
.summary-text{font-size:10.5pt;line-height:1.65;color:#222}

/* ─── Experience / Education entry ─── */
.entry{margin-bottom:14px}
.entry:last-child{margin-bottom:0}
.entry-top{display:flex;justify-content:space-between;align-items:baseline;gap:16px}
.entry-title{font-weight:700;font-size:10.5pt;color:#1a1a1a}
.entry-dates{font-size:9.5pt;color:#555;white-space:nowrap;flex-shrink:0;font-weight:400}
.entry-org{font-size:10pt;color:#444;margin-top:1px;margin-bottom:6px;font-style:italic}
.entry-bullets{list-style:none;padding:0;margin:0}
.entry-bullets li{
  font-size:10pt;color:#333;
  padding-left:14px;position:relative;
  margin-bottom:3px;line-height:1.55;
}
.entry-bullets li::before{
  content:"–";position:absolute;left:0;color:#666;font-weight:700;
}

/* ─── Skills (plain text, ATS-safe) ─── */
.skills-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:3px 32px;
}
.skill-item{
  font-size:10pt;color:#333;
  padding-left:14px;position:relative;
  line-height:1.6;
}
.skill-item::before{content:"–";position:absolute;left:0;color:#666;font-weight:700}

/* ─── Tech stack (comma-separated paragraph — most ATS-safe) ─── */
.tech-paragraph{font-size:10pt;color:#333;line-height:1.7}
.tech-category{font-weight:700;color:#1a1a1a}

/* ─── Languages (plain text, no bars/dots) ─── */
.lang-row{
  display:flex;gap:4px 28px;
  flex-wrap:wrap;font-size:10pt;color:#333;
}
.lang-item{display:flex;gap:6px;align-items:center}
.lang-name{font-weight:700;color:#1a1a1a}
.lang-level{color:#555;font-size:9.5pt}

/* ─── Certifications ─── */
.cert-item{
  display:flex;justify-content:space-between;
  align-items:baseline;gap:12px;
  font-size:10pt;color:#333;
  padding:3px 0;border-bottom:1px solid #ebebeb;
}
.cert-item:last-child{border-bottom:none}
.cert-name{flex:1;line-height:1.45}
.cert-year{color:#555;font-size:9.5pt;white-space:nowrap;flex-shrink:0}

/* ─── Floating Toolbar ─── */
.toolbar{
  position:fixed;bottom:18px;right:18px;
  display:flex;gap:8px;z-index:999;align-items:center;
}
.toolbar select.format-picker{
  padding:9px 32px 9px 14px;border-radius:6px;border:none;
  background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'><path fill='%231a1a1a' d='M0 0l5 6 5-6z'/></svg>") no-repeat right 12px center;
  font-size:12px;font-family:'Lato',sans-serif;font-weight:700;
  color:#1a1a1a;cursor:pointer;
  box-shadow:0 4px 18px rgba(0,0,0,0.16);
  appearance:none;-webkit-appearance:none;
}
.toolbar-btn{
  display:flex;align-items:center;gap:7px;
  padding:9px 16px;border:none;border-radius:6px;
  text-decoration:none;font-size:12px;
  font-family:'Lato',sans-serif;font-weight:700;
  cursor:pointer;box-shadow:0 4px 18px rgba(0,0,0,0.16);
  transition:transform 0.15s,box-shadow 0.15s;
}
.toolbar-btn:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(0,0,0,0.22)}
.toolbar-btn.print{background:#fff;color:#1a1a1a}
.toolbar-btn.manage{background:#1a1a1a;color:#fff}
.toolbar-btn.logout{background:#dc2626;color:#fff}
.toolbar-btn.login{background:#374151;color:#fff}

/* ─── Print ─── */
@media print{
  .toolbar{display:none}
  body{background:#fff}
  .page{margin:0;box-shadow:none;max-width:100%}
  .section{page-break-inside:avoid}
  .entry{page-break-inside:avoid}
  /* Hide photo if you want a pure ATS version — toggle by commenting out */
  /* .header-photo{display:none} */
}

/* ─── Responsive ─── */
@media(max-width:680px){
  .resume-header{flex-direction:column;align-items:flex-start;padding:24px 24px 20px}
  .resume-body{padding:0 24px 28px}
  .skills-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<div class="page">

  <!-- ════ HEADER ════ -->
  <header class="resume-header">
    <?php if (!empty($photoUrl)): ?>
    <img src="<?= esc($photoUrl) ?>"
         alt="<?= esc($header['name'] ?? '') ?>"
         class="header-photo"
         style="object-fit:cover;object-position:<?= esc($photoPosition ?? '50% 50%') ?> !important">
    <?php endif; ?>
    <div class="header-text">
      <div class="header-name"><?= esc($header['name'] ?? '') ?></div>
      <?php if (!empty($header['position'])): ?>
      <div class="header-title"><?= esc($header['position']) ?></div>
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
        <a class="contact-item" href="<?= esc($header['portfolio_url']) ?>" target="_blank" rel="noopener">
          <i class="fas fa-globe"></i><?= esc($header['portfolio_url']) ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- ════ BODY ════ -->
  <div class="resume-body">

    <!-- ── SUMMARY ── -->
    <?php if (!empty($summary['content'])): ?>
    <section class="section">
      <div class="section-heading">Summary</div>
      <p class="summary-text"><?= esc($summary['content']) ?></p>
    </section>
    <?php endif; ?>

    <!-- ── EXPERIENCE ── -->
    <?php if (!empty($history)): ?>
    <section class="section">
      <div class="section-heading">Experience</div>
      <?php foreach ($history as $job): ?>
      <div class="entry">
        <div class="entry-top">
          <span class="entry-title"><?= esc($job['role']) ?></span>
          <span class="entry-dates">
            <?= esc($job['start_month']) ?> <?= esc($job['start_year']) ?> &ndash;
            <?= $job['is_current'] ? 'Present' : esc($job['end_month']).' '.esc($job['end_year']) ?>
          </span>
        </div>
        <div class="entry-org"><?= esc($job['company']) ?></div>
        <?php if (!empty($job['bullets'])): ?>
        <ul class="entry-bullets">
          <?php foreach ($job['bullets'] as $b): ?>
          <li><?= esc($b['content']) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </section>
    <?php endif; ?>

    <!-- ── EDUCATION ── -->
    <?php if (!empty($education)): ?>
    <section class="section">
      <div class="section-heading">Education</div>
      <?php foreach ($education as $edu): ?>
      <div class="entry">
        <div class="entry-top">
          <span class="entry-title"><?= esc($edu['degree']) ?></span>
          <span class="entry-dates">
            <?= esc($edu['start_month']) ?> <?= esc($edu['start_year']) ?> &ndash;
            <?= esc($edu['end_month']) ?> <?= esc($edu['end_year']) ?>
          </span>
        </div>
        <div class="entry-org"><?= esc($edu['school']) ?></div>
        <?php if (!empty($edu['bullets'])): ?>
        <ul class="entry-bullets">
          <?php foreach ($edu['bullets'] as $b): ?>
          <li><?= esc($b['content']) ?></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </section>
    <?php endif; ?>

    <!-- ── STACK OF TECHNOLOGIES ── -->
    <?php if (!empty($tech)): ?>
    <section class="section">
      <div class="section-heading">Technical Skills</div>
      <p class="tech-paragraph">
        <?= esc(implode(' | ', array_column($tech, 'content'))) ?>
      </p>
    </section>
    <?php endif; ?>

    <!-- ── PERSONAL SKILLS ── -->
    <?php if (!empty($skills)): ?>
    <section class="section">
      <div class="section-heading">Personal Skills</div>
      <div class="skills-grid">
        <?php foreach ($skills as $s): ?>
        <div class="skill-item"><?= esc($s['content']) ?></div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- ── LANGUAGES ── -->
    <?php if (!empty($languages)): ?>
    <section class="section">
      <div class="section-heading">Languages</div>
      <div class="lang-row">
        <?php
        $levels = [100=>'Native',80=>'Proficient',60=>'Intermediate',40=>'Basic',20=>'Beginner'];
        foreach ($languages as $lang):
          $mastery = (int)$lang['mastery'];
          $level = 'Familiar';
          foreach($levels as $pct=>$lbl){ if($mastery>=$pct){ $level=$lbl; break; } }
        ?>
        <div class="lang-item">
          <span class="lang-name"><?= esc($lang['language']) ?></span>
          <span class="lang-level">(<?= $level ?>)</span>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- ── CERTIFICATIONS ── -->
    <?php if (!empty($certifications)): ?>
    <section class="section">
      <div class="section-heading">Certifications &amp; Achievements</div>
      <?php foreach ($certifications as $cert): ?>
      <div class="cert-item">
        <span class="cert-name"><?= esc($cert['name']) ?></span>
        <span class="cert-year"><?= esc($cert['year']) ?></span>
      </div>
      <?php endforeach; ?>
    </section>
    <?php endif; ?>

  </div><!-- /resume-body -->
</div><!-- /page -->

<!-- ════ FLOATING TOOLBAR ════ -->
<div class="toolbar">
  <select class="format-picker" onchange="window.location.href=this.value" title="Switch resume format">
    <option value="<?= base_url('resume/plain?format=classic') ?>" <?= ($currentFormat??'classic')==='classic'?'selected':'' ?>>Classic</option>
    <option value="<?= base_url('resume/plain?format=modern') ?>"  <?= ($currentFormat??'classic')==='modern' ?'selected':'' ?>>Modern</option>
    <option value="<?= base_url('resume/plain?format=ats') ?>"     <?= ($currentFormat??'classic')==='ats'    ?'selected':'' ?>>ATS</option>
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