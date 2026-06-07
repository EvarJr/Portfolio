<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= esc($header['name'] ?? 'Resume') ?> — <?= esc($header['position'] ?? '') ?></title>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Source+Serif+Pro:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{background:#dde1e7;font-family:'Source Sans Pro',sans-serif;color:#2c3e50;font-size:13px;line-height:1.55;print-color-adjust:exact}
.resume-wrapper{max-width:900px;margin:28px auto 60px;background:#fff;box-shadow:0 6px 40px rgba(0,0,0,0.14);border-radius:2px}

/* Header */
.resume-header{background:#2c3e50;color:#fff;padding:24px 36px;display:flex;justify-content:space-between;align-items:center;gap:24px}
.header-left{display:flex;align-items:center;gap:20px;flex:1;min-width:0}
.header-photo{width:90px;height:90px;border-radius:10px;object-fit:cover;flex-shrink:0;border:2px solid rgba(255,255,255,0.2);box-shadow:0 4px 12px rgba(0,0,0,0.25)}
.header-text{min-width:0;display:flex;flex-direction:column;justify-content:center}
.header-name{font-family:'Source Serif Pro',serif;font-size:30px;font-weight:600;letter-spacing:0.4px;line-height:1.15}
.header-position{margin-top:6px;font-size:11px;font-weight:300;letter-spacing:3.5px;text-transform:uppercase;color:rgba(255,255,255,0.65)}
.header-contacts{display:flex;flex-direction:column;gap:6px;align-items:flex-end;flex-shrink:0;justify-content:center}
.contact-item{display:flex;align-items:center;gap:7px;font-size:11.5px;color:rgba(255,255,255,0.82);text-decoration:none;line-height:1.4}
.contact-item i{color:#3498db;font-size:10.5px;width:14px;text-align:center;flex-shrink:0}
a.contact-item:hover{color:#fff;text-decoration:underline}

/* Body */
.resume-body{display:grid;grid-template-columns:1fr 0.62fr}
.col-left{padding:22px 26px 28px;border-right:2px solid #f0f2f4}
.col-right{padding:22px 22px 28px;background:#f9fafb}
.section{margin-bottom:20px}
.section:last-child{margin-bottom:0}
.section-title{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:2.2px;color:#2c3e50;padding-bottom:5px;border-bottom:2px solid #3498db;margin-bottom:11px;display:flex;align-items:center;gap:7px}
.section-title i{color:#3498db;font-size:10px}
.summary-text{font-size:12.5px;color:#555;line-height:1.75}
.history-item{margin-bottom:15px}
.history-item:last-child{margin-bottom:0}
.history-role{display:block;font-weight:700;font-size:13px;color:#1a252f}
.history-meta{display:block;font-size:11px;color:#3498db;font-style:italic;margin-top:1px;margin-bottom:5px}
.bullet-list{padding-left:15px;margin-top:4px}
.bullet-list li{font-size:12px;color:#555;margin-bottom:2.5px;line-height:1.55}
.edu-item{margin-bottom:14px}
.edu-item:last-child{margin-bottom:0}
.edu-degree{font-weight:700;font-size:13px}
.edu-school{font-size:11.5px;color:#3498db;margin:1px 0}
.edu-dates{font-size:11px;color:#888;margin-bottom:5px}
.cert-item{margin-bottom:10px}
.cert-item:last-child{margin-bottom:0}
.cert-name{font-weight:600;font-size:12px;line-height:1.45;color:#1a252f}
.cert-year{font-size:11px;color:#3498db;margin-top:2px}
.language-item{display:flex;align-items:center;justify-content:space-between;margin-bottom:7px}
.language-item:last-child{margin-bottom:0}
.lang-name{font-size:13px;color:#2c3e50}
.lang-dots{display:flex;gap:4px}
.dot{width:11px;height:11px;border-radius:50%;background:#d1d5db;border:1.5px solid #c4c9d0;flex-shrink:0}
.dot.filled{background:#3498db;border-color:#2980b9}

/* Floating Toolbar */
.toolbar{position:fixed;bottom:18px;right:18px;display:flex;gap:8px;z-index:999;align-items:center}
.toolbar select.format-picker{padding:9px 32px 9px 14px;border-radius:8px;border:none;background:#fff url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'><path fill='%232c3e50' d='M0 0l5 6 5-6z'/></svg>") no-repeat right 12px center;font-size:12px;font-family:'Source Sans Pro',sans-serif;font-weight:600;color:#2c3e50;cursor:pointer;box-shadow:0 4px 18px rgba(0,0,0,0.22);appearance:none;-webkit-appearance:none}
.toolbar-btn{display:flex;align-items:center;gap:7px;padding:9px 16px;border:none;border-radius:8px;text-decoration:none;font-size:12px;font-family:'Source Sans Pro',sans-serif;font-weight:600;cursor:pointer;box-shadow:0 4px 18px rgba(0,0,0,0.22);transition:transform 0.15s,box-shadow 0.15s}
.toolbar-btn:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(0,0,0,0.28)}
.toolbar-btn.print{background:#fff;color:#2c3e50}
.toolbar-btn.manage{background:#2c3e50;color:#fff}
.toolbar-btn.logout{background:#e74c3c;color:#fff}
.toolbar-btn.login{background:#3498db;color:#fff}

@media print{.toolbar{display:none}body{background:#fff}.resume-wrapper{margin:0;box-shadow:none}}
@media(max-width:680px){.resume-body{grid-template-columns:1fr}.col-left{border-right:none}.resume-header{flex-direction:column;align-items:flex-start}.header-contacts{align-items:flex-start}.header-left{width:100%}}
</style>
</head>
<body>

<div class="resume-wrapper">

  <!-- HEADER -->
  <header class="resume-header">
    <div class="header-left">
      <?php if (!empty($photoUrl)): ?>
        <img src="<?= esc($photoUrl) ?>"
             alt="<?= esc($header['name'] ?? '') ?>"
             class="header-photo"
             style="object-position:<?= esc($photoPosition ?? '50% 50%') ?>">
      <?php endif; ?>
      <div class="header-text">
        <div class="header-name"><?= esc($header['name'] ?? '') ?></div>
        <div class="header-position"><?= esc($header['position'] ?? '') ?></div>
      </div>
    </div>
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
  </header>

  <!-- BODY -->
  <div class="resume-body">
    <div class="col-left">

      <?php if (!empty($summary['content'])): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-user"></i>Summary</div>
        <p class="summary-text"><?= esc($summary['content']) ?></p>
      </section>
      <?php endif; ?>

      <?php if (!empty($history)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-briefcase"></i>History</div>
        <?php foreach ($history as $job): ?>
        <div class="history-item">
          <span class="history-role"><?= esc($job['role']) ?></span>
          <span class="history-meta">
            <?= esc($job['company']) ?> &nbsp;&middot;&nbsp;
            <?= esc($job['start_month']) ?> <?= esc($job['start_year']) ?> &ndash;
            <?= $job['is_current'] ? 'Present' : esc($job['end_month']).' '.esc($job['end_year']) ?>
          </span>
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

      <?php if (!empty($skills)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-star"></i>Personal Skills</div>
        <ul class="bullet-list">
          <?php foreach ($skills as $s): ?>
          <li><?= esc($s['content']) ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
      <?php endif; ?>

    </div>

    <div class="col-right">

      <?php if (!empty($tech)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-code"></i>Stack of Technologies</div>
        <ul class="bullet-list">
          <?php foreach ($tech as $t): ?>
          <li><?= esc($t['content']) ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
      <?php endif; ?>

      <?php if (!empty($languages)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-globe"></i>Languages</div>
        <?php foreach ($languages as $lang): ?>
        <div class="language-item">
          <span class="lang-name"><?= esc($lang['language']) ?></span>
          <div class="lang-dots">
            <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="dot <?= ($lang['mastery'] / 20) >= $i ? 'filled' : '' ?>"></span>
            <?php endfor; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

      <?php if (!empty($education)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-graduation-cap"></i>Education</div>
        <?php foreach ($education as $edu): ?>
        <div class="edu-item">
          <div class="edu-degree"><?= esc($edu['degree']) ?></div>
          <div class="edu-school"><?= esc($edu['school']) ?></div>
          <div class="edu-dates">
            <?= esc($edu['start_month']) ?> <?= esc($edu['start_year']) ?>
            &ndash; <?= esc($edu['end_month']) ?> <?= esc($edu['end_year']) ?>
          </div>
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

      <?php if (!empty($certifications)): ?>
      <section class="section">
        <div class="section-title"><i class="fas fa-certificate"></i>Certification</div>
        <?php foreach ($certifications as $cert): ?>
        <div class="cert-item">
          <div class="cert-name"><?= esc($cert['name']) ?></div>
          <div class="cert-year"><?= esc($cert['year']) ?></div>
        </div>
        <?php endforeach; ?>
      </section>
      <?php endif; ?>

    </div>
  </div>
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