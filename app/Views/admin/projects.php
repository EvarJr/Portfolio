<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Projects — Admin</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<style>
:root{
  --bg:#f0f2f5;--sidebar:#1a1f2e;--sidebar-w:245px;
  --accent:#3b82f6;--accent-dark:#2563eb;
  --success:#10b981;--danger:#ef4444;--warning:#f59e0b;
  --card:#fff;--border:#e5e7eb;--text:#1f2937;--muted:#6b7280;
  --radius:10px;--shadow:0 1px 4px rgba(0,0,0,0.08);
}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg);font-family:'DM Sans',sans-serif;color:var(--text);font-size:14px;line-height:1.5}
.layout{display:flex;min-height:100vh}
.sidebar{width:var(--sidebar-w);background:var(--sidebar);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:200}
.sb-brand{padding:20px 18px;display:flex;align-items:center;gap:11px;border-bottom:1px solid rgba(255,255,255,0.07)}
.sb-icon{width:38px;height:38px;background:var(--accent);border-radius:9px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:16px;flex-shrink:0}
.sb-title{color:#fff;font-size:14px;font-weight:600;line-height:1.25}
.sb-title span{display:block;font-size:11px;font-weight:300;color:rgba(255,255,255,0.45);margin-top:1px}
.sb-nav{flex:1;overflow-y:auto;padding:10px 0}
.sb-label{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.3);padding:14px 18px 5px}
.nav-link{display:flex;align-items:center;gap:10px;padding:9px 18px;color:rgba(255,255,255,0.62);text-decoration:none;font-size:13px;cursor:pointer;border-left:3px solid transparent;transition:all 0.15s}
.nav-link:hover,.nav-link.active{color:#fff;background:rgba(255,255,255,0.06);border-left-color:var(--accent)}
.nav-link i{width:16px;text-align:center;font-size:12px}
.sb-footer{padding:14px;border-top:1px solid rgba(255,255,255,0.07)}
.btn-preview{display:flex;align-items:center;justify-content:center;gap:7px;background:var(--accent);color:#fff;padding:9px;border-radius:8px;text-decoration:none;font-size:12px;font-weight:500;margin-bottom:8px;transition:opacity 0.2s}
.btn-preview:hover{opacity:0.88}
.btn-signout{display:flex;align-items:center;justify-content:center;gap:7px;color:rgba(255,255,255,0.45);font-size:12px;text-decoration:none;padding:6px;border-radius:6px;transition:color 0.2s}
.btn-signout:hover{color:#fff}
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:#fff;border-bottom:1px solid var(--border);height:58px;padding:0 26px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:var(--shadow)}
.topbar-title{font-size:15px;font-weight:600;display:flex;align-items:center;gap:8px}
.topbar-title i{color:var(--accent)}
.topbar-right{display:flex;align-items:center;gap:12px}
.user-chip{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--muted);background:#f9fafb;padding:6px 12px;border-radius:20px;border:1px solid var(--border)}
.user-chip i{color:var(--accent)}
.btn-sm-outline{padding:6px 14px;border:1.5px solid var(--border);background:#fff;border-radius:7px;font-size:12px;color:var(--text);text-decoration:none;cursor:pointer;font-family:'DM Sans',sans-serif;display:flex;align-items:center;gap:5px;transition:border-color 0.2s,color 0.2s}
.btn-sm-outline:hover{border-color:var(--accent);color:var(--accent)}
.content{padding:22px 26px;display:flex;flex-direction:column;gap:20px}
.card{background:var(--card);border-radius:var(--radius);border:1px solid var(--border);overflow:hidden}
.card-head{padding:16px 22px;background:#fafafa;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px}
.card-head-icon{width:34px;height:34px;border-radius:8px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:14px;flex-shrink:0}
.card-head-text h2{font-size:14px;font-weight:600;margin-bottom:2px}
.card-head-text p{font-size:12px;color:var(--muted)}
.card-body{padding:20px 22px}
.btn-primary{background:var(--accent);color:#fff;border:none;padding:9px 18px;border-radius:7px;font-size:13px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s}
.btn-primary:hover{background:var(--accent-dark)}
.btn-cancel-soft{background:#f3f4f6;color:var(--text);border:none;padding:7px 13px;border-radius:6px;font-size:12px;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:4px}
.icon-btn{width:26px;height:26px;border-radius:5px;border:1.5px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:10.5px;transition:all 0.15s;flex-shrink:0}
.icon-btn.edit:hover{border-color:var(--accent);color:var(--accent);background:rgba(59,130,246,0.05)}
.icon-btn.del:hover{border-color:var(--danger);color:var(--danger);background:rgba(239,68,68,0.05)}
.btn-add-item{background:transparent;border:1.5px dashed var(--accent);color:var(--accent);padding:8px 16px;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer;font-family:"DM Sans",sans-serif;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s}
.btn-add-item:hover{background:rgba(59,130,246,0.05)}
.proj-list{display:flex;flex-direction:column;gap:8px}
.proj-row{display:flex;align-items:center;gap:12px;padding:12px 14px;border:1px solid var(--border);border-radius:8px;background:#fff;transition:border-color 0.15s;cursor:grab}
.proj-row:hover{border-color:#c7d2fe}
.proj-row.dragging{opacity:0.4;border-style:dashed}
.proj-row.drag-over{border-color:var(--accent);background:#eff6ff}
.proj-row:active{cursor:grabbing}
.proj-row-drag{color:#d1d5db;font-size:12px;flex-shrink:0}
.proj-row-icon{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.proj-row-info{flex:1;min-width:0}
.proj-row-title{font-size:13px;font-weight:600;color:var(--text)}
.proj-row-meta{font-size:11px;color:var(--muted);margin-top:1px;display:flex;align-items:center;gap:8px}
.cat-badge{font-size:10px;font-weight:600;padding:2px 8px;border-radius:20px;text-transform:uppercase;letter-spacing:0.3px}
.cat-thesis{background:rgba(139,92,246,0.12);color:#7c3aed}
.cat-ojt{background:rgba(6,182,212,0.1);color:#0891b2}
.cat-lgu{background:rgba(16,185,129,0.1);color:#059669}
.cat-personal{background:rgba(251,191,36,0.1);color:#d97706}
.proj-row-actions{display:flex;gap:5px;flex-shrink:0}
.feat-toggle{display:flex;align-items:center;gap:5px;font-size:11px;color:var(--muted);cursor:pointer;padding:3px 8px;border-radius:4px;background:#f9fafb;border:1px solid var(--border);transition:all 0.15s;white-space:nowrap}
.feat-toggle.on{background:#f0fdf4;border-color:#86efac;color:#16a34a}
.feat-toggle:hover{border-color:var(--accent)}
.fg{display:flex;flex-direction:column;gap:5px;margin-bottom:14px}
.fg label{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px}
.fg input,.fg textarea,.fg select{padding:8px 12px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;transition:border-color 0.2s;background:#fff;width:100%}
.fg input:focus,.fg textarea:focus,.fg select:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(59,130,246,0.08)}
.fg textarea{resize:vertical;min-height:80px}
.tech-pills-wrap{display:flex;flex-wrap:wrap;gap:6px;padding:8px 10px;border:1.5px solid var(--border);border-radius:7px;min-height:42px;cursor:text;background:#fff;transition:border-color 0.2s}
.tech-pills-wrap:focus-within{border-color:var(--accent);box-shadow:0 0 0 3px rgba(59,130,246,0.08)}
.tech-pill-item{display:inline-flex;align-items:center;gap:5px;background:#eff6ff;color:#1d4ed8;border-radius:4px;padding:3px 8px;font-size:12px;font-weight:500}
.tech-pill-item button{background:none;border:none;cursor:pointer;color:#93c5fd;font-size:11px;padding:0;line-height:1;transition:color 0.15s}
.tech-pill-item button:hover{color:#ef4444}
.tech-input{border:none;outline:none;font-size:12px;font-family:'DM Sans',sans-serif;background:transparent;min-width:120px;flex:1;padding:2px 0}
.edit-overlay{position:fixed;inset:0;background:rgba(15,23,42,0.45);z-index:900;opacity:0;pointer-events:none;transition:opacity 0.3s}
.edit-overlay.open{opacity:1;pointer-events:all}
.edit-panel{position:fixed;top:0;right:0;bottom:0;width:520px;max-width:95vw;background:#fff;z-index:901;display:flex;flex-direction:column;box-shadow:-8px 0 40px rgba(0,0,0,0.15);transform:translateX(100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1)}
.edit-panel.open{transform:translateX(0)}
.ep-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:flex-start;justify-content:space-between;gap:12px;background:#fafafa;flex-shrink:0}
.ep-section-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent);margin-bottom:3px}
.ep-title{font-size:16px;font-weight:700;color:var(--text);line-height:1.3}
.ep-close{width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--muted);transition:all 0.15s}
.ep-close:hover{background:#fee2e2;border-color:#fca5a5;color:#ef4444}
.ep-body{flex:1;overflow-y:auto;padding:22px 24px}
.ep-divider{height:1px;background:var(--border);margin:14px 0}
.ep-footer{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;background:#fafafa;flex-shrink:0}
.ep-footer .btn-primary{flex:1;justify-content:center;padding:11px;font-size:14px}
.ep-footer .btn-cancel-soft{padding:11px 20px;font-size:14px}
.icon-search-input{width:100%;padding:8px 12px 8px 34px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:'DM Sans',sans-serif;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E") no-repeat 9px center;transition:border-color 0.2s}
.icon-search-input:focus{outline:none;border-color:var(--accent)}
.icon-selected-preview{display:flex;align-items:center;gap:8px;padding:7px 12px;background:#eff6ff;border-radius:7px;margin-bottom:8px;font-size:12px;color:var(--accent)}
.icon-selected-preview i{font-size:16px}
.icon-grid-wrap{max-height:200px;overflow-y:auto;border:1.5px solid var(--border);border-radius:8px;background:#fff;margin-top:6px;display:grid;grid-template-columns:repeat(auto-fill,minmax(40px,1fr));gap:2px;padding:6px}
.icon-option{width:38px;height:38px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:15px;color:var(--muted);cursor:pointer;transition:all 0.15s;border:1.5px solid transparent}
.icon-option:hover{background:#eff6ff;color:var(--accent);border-color:var(--accent)}
.icon-option.selected{background:var(--accent);color:#fff;border-color:var(--accent)}
.icon-load-more{grid-column:1/-1;text-align:center;padding:8px;font-size:12px;color:var(--accent);cursor:pointer;font-weight:600;border-top:1px solid var(--border)}
.icon-load-more:hover{text-decoration:underline}
.del-modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:1000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity 0.15s}
.del-modal-overlay.open{opacity:1;pointer-events:all}
.del-modal{background:#1e293b;border-radius:8px;padding:22px 24px 18px;min-width:300px;max-width:360px;width:90%;box-shadow:0 8px 32px rgba(0,0,0,0.4);transform:translateY(-4px);transition:transform 0.15s}
.del-modal-overlay.open .del-modal{transform:translateY(0)}
.del-modal h3{font-size:13px;font-weight:600;color:#fff;margin-bottom:8px}
.del-modal p{font-size:13px;color:#94a3b8;margin-bottom:20px;line-height:1.5}
.del-modal p strong{color:#cbd5e1;font-weight:400}
.del-modal-btns{display:flex;gap:8px;justify-content:flex-end}
.btn-del-cancel{padding:7px 18px;background:#334155;color:#cbd5e1;border:none;border-radius:5px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:background 0.15s}
.btn-del-cancel:hover{background:#475569}
.btn-del-confirm{padding:7px 18px;background:#ef4444;color:#fff;border:none;border-radius:5px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:background 0.15s}
.btn-del-confirm:hover{background:#dc2626}
#toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(80px);background:#1e293b;color:#fff;padding:12px 18px;border-radius:12px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 32px rgba(0,0,0,0.2);z-index:2000;transition:transform 0.3s ease;white-space:nowrap}
#toast.show{transform:translateX(-50%) translateY(0)}
#toast.ok{background:#1e293b}
#toast.err{background:#991b1b}
body.dark{--bg:#0f1117;--card:#161b27;--border:#1e2535;--text:#e2e8f0;--muted:#64748b}
body.dark .topbar{background:#161b27;border-color:#1e2535}
body.dark .card{background:#161b27;border-color:#1e2535}
body.dark .card-head{background:#111827;border-color:#1e2535}
body.dark .fg input,.dark .fg textarea,.dark .fg select{background:#0f1117;border-color:#1e2535;color:#e2e8f0}
body.dark .proj-row{background:#161b27;border-color:#1e2535}
body.dark .tech-pills-wrap{background:#0f1117;border-color:#1e2535}
body.dark .edit-panel{background:#161b27}
body.dark .ep-header,.dark .ep-footer{background:#111827;border-color:#1e2535}
body.dark .icon-btn{background:#111827;border-color:#1e2535;color:#64748b}
body.dark .feat-toggle{background:#111827;border-color:#1e2535}
.dark-toggle{width:36px;height:36px;border-radius:8px;border:1.5px solid var(--border);background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;color:var(--muted);transition:all 0.2s}
.dark-toggle:hover{border-color:var(--accent);color:var(--accent)}
body.dark .dark-toggle{background:#111827;border-color:#1e2535;color:#fbbf24}
.thesis-card{margin-top:20px}
.thesis-tabs{display:flex;gap:4px;margin-bottom:18px}
.thesis-tab{padding:7px 18px;border-radius:7px;font-size:13px;font-weight:500;cursor:pointer;border:1.5px solid var(--border);background:#fff;color:var(--muted);font-family:'DM Sans',sans-serif;transition:all 0.15s}
.thesis-tab.active{background:var(--accent);color:#fff;border-color:var(--accent)}
.thesis-tab:hover:not(.active){border-color:var(--accent);color:var(--accent)}
.thesis-panel{display:none}
.thesis-panel.active{display:block}
.phase-list{display:flex;flex-direction:column;gap:8px}
.phase-row{border:1px solid var(--border);border-radius:8px;overflow:hidden;background:#fff;transition:border-color 0.15s}
.phase-row:hover{border-color:#c7d2fe}
.phase-row.dragging{opacity:0.4;border-style:dashed}
.phase-row.drag-over{border-color:var(--accent);background:#eff6ff}
.phase-header{display:flex;align-items:center;gap:10px;padding:11px 14px;cursor:pointer}
.phase-num-badge{width:26px;height:26px;border-radius:6px;background:rgba(99,102,241,0.1);color:var(--accent);font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.phase-title-txt{flex:1;font-size:13px;font-weight:600;color:var(--text)}
.phase-chevron{font-size:11px;color:var(--muted);transition:transform 0.2s;flex-shrink:0}
.phase-row.open .phase-chevron{transform:rotate(180deg)}
.phase-body{display:none;padding:0 14px 14px;padding-left:50px;border-top:1px solid var(--border)}
.phase-row.open .phase-body{display:block}
.phase-drag-handle{color:#d1d5db;font-size:11px;cursor:grab;flex-shrink:0}
.phase-drag-handle:active{cursor:grabbing}
.iso-list{display:flex;flex-direction:column;gap:8px}
.iso-row{display:flex;align-items:center;gap:12px;padding:10px 14px;border:1px solid var(--border);border-radius:8px;background:#fff}
.iso-label-input{flex:1;border:none;background:transparent;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;font-weight:500}
.iso-score-wrap{display:flex;align-items:center;gap:8px}
.iso-score-input{width:64px;padding:5px 8px;border:1.5px solid var(--border);border-radius:6px;font-size:13px;font-family:'DM Sans',sans-serif;text-align:center;outline:none;transition:border-color 0.2s}
.iso-score-input:focus{border-color:var(--accent)}
.iso-bar{flex:1;height:4px;background:#e5e7eb;border-radius:2px;overflow:hidden;min-width:80px}
.iso-bar-fill{height:100%;background:linear-gradient(90deg,#3b82f6,#8b5cf6);border-radius:2px;transition:width 0.3s}
</style>
</head>
<body>

<div id="toast"></div>
<div class="edit-overlay" id="editOverlay" onclick="closePanel()"></div>

<div class="edit-panel" id="editPanel">
  <div class="ep-header">
    <div>
      <div class="ep-section-label">Featured Work</div>
      <div class="ep-title" id="ep-title">Project</div>
    </div>
    <button class="ep-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
  </div>
  <div class="ep-body" id="ep-body"></div>
  <div class="ep-footer">
    <button class="btn-cancel-soft" onclick="closePanel()"><i class="fas fa-times"></i> Cancel</button>
    <button class="btn-primary" id="ep-save-btn"><i class="fas fa-check"></i> Save Project</button>
  </div>
</div>

<div class="del-modal-overlay" id="delModal">
  <div class="del-modal">
    <h3>Delete this project?</h3>
    <p id="del-msg">This action <strong>cannot be undone</strong>.</p>
    <div class="del-modal-btns">
      <button class="btn-del-cancel" onclick="closeDelModal()">Cancel</button>
      <button class="btn-del-confirm" id="del-confirm-btn">Delete</button>
    </div>
  </div>
</div>

<div class="layout">
  <aside class="sidebar">
    <div class="sb-brand">
      <div class="sb-icon"><i class="fas fa-file-alt"></i></div>
      <div class="sb-title">Resume CI4<span>Admin Dashboard</span></div>
    </div>
    <nav class="sb-nav">
      <div class="sb-label">Resumes</div>
      <a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-layer-group"></i>Resume Collection</a>
      <div class="sb-label">Portfolio</div>
      <a class="nav-link active" href="<?= base_url('admin/projects') ?>"><i class="fas fa-briefcase"></i>Featured Work</a>
      <div class="sb-label">About Me Page</div>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-about"><i class="fas fa-user-circle"></i>About Info</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-services"><i class="fas fa-th-large"></i>What I Do</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-testimonials"><i class="fas fa-comment-dots"></i>Testimonials</a>
      <div class="sb-label">Resume Sections</div>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-header"><i class="fas fa-id-card"></i>Header &amp; Contacts</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-summary"><i class="fas fa-align-left"></i>Summary</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-history"><i class="fas fa-briefcase"></i>Work History</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-skills"><i class="fas fa-star"></i>Personal Skills</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-tech"><i class="fas fa-code"></i>Tech Stack</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-languages"><i class="fas fa-globe"></i>Languages</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-education"><i class="fas fa-graduation-cap"></i>Education</a>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-certs"><i class="fas fa-certificate"></i>Certifications</a>
      <div class="sb-label">Settings</div>
      <a class="nav-link" href="<?= base_url('admin') ?>#c-account"><i class="fas fa-key"></i>Account</a>
    </nav>
    <div class="sb-footer">
      <a href="<?= base_url() ?>" target="_blank" class="btn-preview"><i class="fas fa-eye"></i> View Portfolio</a>
      <a href="<?= base_url('logout') ?>" class="btn-signout"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
    </div>
  </aside>

  <main class="main">
    <div class="topbar">
      <div class="topbar-title"><i class="fas fa-briefcase"></i> Featured Work</div>
      <div class="topbar-right">
        <button class="dark-toggle" onclick="toggleDark()" title="Dark mode"><i class="fas fa-moon" id="darkIcon"></i></button>
        <div class="user-chip"><i class="fas fa-user-circle"></i><?= esc($adminUsername ?? 'admin') ?></div>
        <a href="<?= base_url() ?>" target="_blank" class="btn-sm-outline"><i class="fas fa-external-link-alt"></i> Preview</a>
      </div>
    </div>

    <div class="content">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-briefcase"></i></div>
          <div class="card-head-text">
            <h2>Featured Work — Projects</h2>
            <p>Drag rows to reorder. Changes reflect instantly on your portfolio.</p>
          </div>
          <button class="btn-primary" style="margin-left:auto;flex-shrink:0" onclick="openAddPanel()">
            <i class="fas fa-plus"></i> Add Project
          </button>
        </div>
        <div class="card-body">
          <div class="proj-list" id="proj-list">
            <?php foreach($projects as $p): ?>
            <?php $tech = json_decode($p['tech'] ?? '[]', true) ?? []; ?>
            <div class="proj-row" draggable="true" data-id="<?= $p['id'] ?>">
              <div class="proj-row-drag"><i class="fas fa-grip-vertical"></i></div>
              <div class="proj-row-icon" style="background:<?= match($p['category']){
                'thesis'=>'rgba(139,92,246,0.15)',
                'ojt'=>'rgba(6,182,212,0.12)',
                'lgu'=>'rgba(16,185,129,0.12)',
                default=>'rgba(251,191,36,0.1)'
              } ?>;color:<?= match($p['category']){
                'thesis'=>'#7c3aed','ojt'=>'#0891b2','lgu'=>'#059669',default=>'#d97706'
              } ?>">
                <i class="<?= esc($p['icon']) ?>"></i>
              </div>
              <div class="proj-row-info">
                <div class="proj-row-title"><?= esc($p['title']) ?></div>
                <div class="proj-row-meta">
                  <span class="cat-badge cat-<?= esc($p['category']) ?>"><?= esc($p['category']) ?></span>
                  <?php if(!empty($tech)): ?>
                  <span style="color:var(--muted);font-size:11px"><?= esc(implode(' · ', array_slice($tech, 0, 3))) ?><?= count($tech)>3?' +'.(count($tech)-3).' more':'' ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <button class="feat-toggle <?= $p['is_featured']?'on':'' ?>" onclick="toggleFeatured(<?= $p['id'] ?>, this)" title="Toggle visibility">
                <i class="fas fa-eye<?= $p['is_featured']?'':'-slash' ?>"></i>
                <?= $p['is_featured']?'Shown':'Hidden' ?>
              </button>
              <div class="proj-row-actions">
                <button class="icon-btn" style="width:auto;padding:0 8px;font-size:11px;gap:4px;color:#7c3aed;border-color:rgba(139,92,246,0.3)"
                  data-pid="<?= $p['id'] ?>" data-ptitle="<?= esc(htmlspecialchars($p['title'], ENT_QUOTES)) ?>"
                  onclick="openMethodology(parseInt(this.dataset.pid), this.dataset.ptitle)" title="Edit methodology & scores">
                  <i class="fas fa-flask"></i> Methodology
                </button>
                <button class="icon-btn edit" onclick="openEditPanel(<?= $p['id'] ?>)" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button class="icon-btn del" onclick="confirmDelete(<?= $p['id'] ?>, '<?= esc(addslashes($p['title'])) ?>')" title="Delete"><i class="fas fa-trash"></i></button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php if(empty($projects)): ?>
          <div style="text-align:center;padding:40px;color:var(--muted)">
            <i class="fas fa-folder-open" style="font-size:32px;margin-bottom:12px;opacity:0.4"></i>
            <p>No projects yet. Click <strong>Add Project</strong> to get started.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card thesis-card" id="methodology-card" style="display:none">
        <div class="card-head">
          <div class="card-head-icon" style="background:rgba(139,92,246,0.1);color:#7c3aed"><i class="fas fa-flask"></i></div>
          <div class="card-head-text">
            <h2>Methodology & Evaluation — <span id="methodology-project-title">Project</span></h2>
            <p>Edit development methodology phases and ISO evaluation scores for this project.</p>
          </div>
          <button class="btn-cancel-soft" style="margin-left:auto;flex-shrink:0" onclick="closeMethodology()">
            <i class="fas fa-times"></i> Close
          </button>
        </div>
        <div class="card-body">
          <div class="thesis-tabs">
            <button class="thesis-tab active" data-tab="phases" onclick="switchTab(this.dataset.tab,this)"><i class="fas fa-list-ol" style="margin-right:6px"></i>Methodology Phases</button>
            <button class="thesis-tab" data-tab="iso" onclick="switchTab(this.dataset.tab,this)"><i class="fas fa-chart-bar" style="margin-right:6px"></i>ISO / Evaluation Scores</button>
          </div>
          <div class="thesis-panel active" id="panel-phases">
            <div class="phase-list" id="phase-list"></div>
            <button class="btn-add-item" style="margin-top:12px" onclick="addPhase()"><i class="fas fa-plus"></i> Add Phase</button>
          </div>
          <div class="thesis-panel" id="panel-iso">
            <div class="iso-list" id="iso-list"></div>
            <div style="display:flex;gap:10px;margin-top:14px;align-items:center">
              <button class="btn-add-item" style="margin-top:0" onclick="addIsoRow()"><i class="fas fa-plus"></i> Add Criterion</button>
              <button class="btn-primary" onclick="saveIsoScores()"><i class="fas fa-save"></i> Save All Scores</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
const BASE = '<?= rtrim(base_url(), '/') ?>';

function getCsrfToken() {
  return { name: '<?= csrf_token() ?>', value: '<?= csrf_hash() ?>' };
}

const PROJECTS_DATA = {
  <?php foreach($projects as $p): ?>
  <?= $p['id'] ?>: {
    id: <?= $p['id'] ?>,
    title: <?= json_encode($p['title']) ?>,
    description: <?= json_encode($p['description']) ?>,
    category: <?= json_encode($p['category']) ?>,
    icon: <?= json_encode($p['icon']) ?>,
    tech: <?= json_encode(json_decode($p['tech'] ?: '[]', true) ?: []) ?>,
    github_url: <?= json_encode($p['github_url'] ?? '') ?>,
    demo_url: <?= json_encode($p['demo_url'] ?? '') ?>,
    media_urls: <?= json_encode($p['media_urls'] ?? '') ?>,
    is_featured: <?= (int)$p['is_featured'] ?>,
  },
  <?php endforeach; ?>
};

const ALL_PHASES = <?= json_encode($projectPhases ?? []) ?>;
const ALL_ISO    = <?= json_encode($projectIso ?? []) ?>;

let _toastTimer;
function toast(msg, type='ok') {
  const el = document.getElementById('toast');
  const icon = type==='ok' ? '<i class="fas fa-check-circle" style="color:#4ade80"></i>' : '<i class="fas fa-exclamation-circle" style="color:#f87171"></i>';
  el.className = 'show ' + type;
  el.innerHTML = icon + '<span>' + msg + '</span>';
  clearTimeout(_toastTimer);
  _toastTimer = setTimeout(() => el.className='', 3000);
}

async function api(path, data={}) {
  const csrf = getCsrfToken();
  const headers = { 'Content-Type': 'application/json' };
  headers[csrf.name] = csrf.value;
  const r = await fetch(BASE + path, { method:'POST', headers, body:JSON.stringify(data) });
  const newToken = r.headers.get('X-CSRF-TOKEN');
  if (newToken) { const meta = document.querySelector('meta[name="csrf-token"]'); if (meta) meta.content = newToken; }
  return r.json();
}

let currentEditId = null;

function openAddPanel() {
  currentEditId = null;
  document.getElementById('ep-title').textContent = '✚ New Project';
  document.getElementById('ep-body').innerHTML = buildPanelForm(null);
  document.getElementById('ep-save-btn').onclick = saveProject;
  document.getElementById('editOverlay').classList.add('open');
  document.getElementById('editPanel').classList.add('open');
  document.body.style.overflow = 'hidden';
  setTimeout(() => initIconPicker('fas fa-code'), 100);
}

function openEditPanel(id) {
  const p = PROJECTS_DATA[id];
  if (!p) return;
  currentEditId = id;
  document.getElementById('ep-title').textContent = '✏️ ' + p.title;
  document.getElementById('ep-body').innerHTML = buildPanelForm(p);
  document.getElementById('ep-save-btn').onclick = saveProject;
  document.getElementById('editOverlay').classList.add('open');
  document.getElementById('editPanel').classList.add('open');
  document.body.style.overflow = 'hidden';
  setTimeout(() => {
    initIconPicker(p.icon);
    if (p.tech && p.tech.length) renderTechPills(p.tech);
    if (p.media_urls) renderMediaPreviews(p.media_urls);
  }, 100);
}

function closePanel() {
  document.getElementById('editOverlay').classList.remove('open');
  document.getElementById('editPanel').classList.remove('open');
  document.body.style.overflow = '';
}

function buildPanelForm(p) {
  const v = (f) => p ? escHtml(p[f] || '') : '';
  const cats = ['thesis','ojt','lgu','personal'];
  const catOpts = cats.map(c => `<option value="${c}"${p&&p.category===c?' selected':''}>${c.toUpperCase()}</option>`).join('');
  return `
    <div class="fg"><label>Project Title</label>
      <input type="text" id="pf-title" value="${v('title')}" placeholder="e.g. Self-Updating Predictive Platform">
    </div>
    <div class="fg"><label>Description</label>
      <textarea id="pf-desc" rows="4" placeholder="What does this project do?">${v('description')}</textarea>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
      <div class="fg" style="margin:0"><label>Category</label><select id="pf-cat">${catOpts}</select></div>
      <div class="fg" style="margin:0"><label>Featured</label>
        <select id="pf-feat">
          <option value="1"${!p||p.is_featured?' selected':''}>Shown on portfolio</option>
          <option value="0"${p&&!p.is_featured?' selected':''}>Hidden</option>
        </select>
      </div>
    </div>
    <div class="ep-divider"></div>
    <div class="fg"><label>Thumbnail Icon</label>
      <input type="hidden" id="pf-icon" value="${v('icon')||'fas fa-code'}">
      <div class="icon-selected-preview">
        <i class="${v('icon')||'fas fa-code'}" id="icon-preview-i"></i>
        <span id="icon-preview-label">${v('icon')||'fas fa-code'}</span>
      </div>
      <input type="text" class="icon-search-input" placeholder="Search icons… (e.g. microchip, globe)" oninput="filterIcons(this)">
      <div class="icon-grid-wrap" id="icon-grid"></div>
    </div>
    <div class="ep-divider"></div>
    <div class="fg"><label>Tech Stack <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted)">— press Enter or comma to add</span></label>
      <div class="tech-pills-wrap" id="tech-pills-wrap" onclick="document.getElementById('tech-input').focus()">
        <input type="text" id="tech-input" class="tech-input" placeholder="Add technology…" onkeydown="techKeydown(event)" oninput="techInput(this)">
      </div>
      <input type="hidden" id="pf-tech" value="${p ? escHtml(JSON.stringify(p.tech||[])) : '[]'}">
    </div>
    <div class="ep-divider"></div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
      <div class="fg" style="margin:0"><label><i class="fab fa-github"></i> GitHub URL</label>
        <input type="url" id="pf-github" value="${v('github_url')}" placeholder="https://github.com/you/repo">
      </div>
      <div class="fg" style="margin:0"><label><i class="fas fa-external-link-alt"></i> Demo URL</label>
        <input type="url" id="pf-demo" value="${v('demo_url')}" placeholder="https://your-demo.com">
      </div>
    </div>
    <div class="ep-divider"></div>
    <div class="fg">
      <label><i class="fas fa-images" style="color:var(--accent)"></i> Project Media
        <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted);font-size:10.5px"> — upload images &amp; videos, managed independently from Save</span>
      </label>
      <div id="media-preview-list" style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:10px"></div>
      <label style="display:flex;align-items:center;gap:8px;padding:10px 14px;background:rgba(59,130,246,0.06);border:1.5px dashed var(--accent);border-radius:9px;cursor:pointer;font-size:13px;color:var(--accent);font-weight:500;transition:background 0.2s" id="media-upload-label">
        <i class="fas fa-upload"></i> Upload Photo or Video
        <input type="file" id="media-file-input" accept="image/*,video/mp4,video/webm" multiple style="display:none" onchange="handleMediaUpload(this)">
      </label>
      <div style="font-size:11px;color:var(--muted);margin-top:6px;line-height:1.6">
        <i class="fas fa-circle-info" style="color:var(--accent)"></i>
        JPG, PNG, GIF, WEBP, MP4, WEBM · Max 100MB each · Multiple files allowed<br>
        Uploads save instantly — no need to click Save Project.<br>
        You can also paste a <strong>YouTube link</strong> below and click Save Project:
      </div>
      <input type="text" id="pf-youtube" placeholder="https://youtu.be/abc123  (optional YouTube link)" style="margin-top:8px;font-size:12px">
    </div>
  `;
}

// ── SAVE PROJECT ──
// ★ FIX: media_urls is NOT included in this payload.
// Media is managed independently via uploadMedia / deleteMedia API calls.
// Including media_urls here would overwrite the DB value with a stale
// copy from PROJECTS_DATA, losing any uploads done in this session.
async function saveProject() {
  const title  = document.getElementById('pf-title').value.trim();
  const desc   = document.getElementById('pf-desc').value.trim();
  const cat    = document.getElementById('pf-cat').value;
  const feat   = parseInt(document.getElementById('pf-feat').value);
  const icon   = document.getElementById('pf-icon').value;
  const github = document.getElementById('pf-github').value.trim();
  const demo   = document.getElementById('pf-demo').value.trim();

  // Handle YouTube link — save it directly via a separate media update
  const ytEl = document.getElementById('pf-youtube');
  if (ytEl && ytEl.value.trim() && currentEditId) {
    const ytUrl = ytEl.value.trim();
    const ytR = await api(`/api/project/add-youtube/${currentEditId}`, { url: ytUrl });
    if (ytR.success) {
      PROJECTS_DATA[currentEditId].media_urls = ytR.media_urls;
      ytEl.value = '';
    }
  }

  const techRaw = document.getElementById('pf-tech').value;
  let tech = [];
  try { tech = JSON.parse(techRaw); } catch(e) {}
  if (!title) { toast('Title is required.', 'err'); return; }

  // ★ No media_urls in payload — controller's update() will not touch it
  const payload = { title, description:desc, category:cat, icon, tech, github_url:github, demo_url:demo, is_featured:feat };
  const path = currentEditId ? `/api/project/update/${currentEditId}` : '/api/project/add';
  const r = await api(path, payload);
  if (r.success) {
    if (currentEditId && PROJECTS_DATA[currentEditId]) {
      PROJECTS_DATA[currentEditId] = { ...PROJECTS_DATA[currentEditId], title, description:desc, category:cat, icon, tech, github_url:github, demo_url:demo, is_featured:feat };
    }
    toast(currentEditId ? 'Project updated!' : 'Project added!');
    closePanel();
    setTimeout(() => location.reload(), 800);
  } else toast(r.message || 'Error saving.', 'err');
}

function renderMediaPreviews(mediaUrls) {
  const list = document.getElementById('media-preview-list');
  if (!list) return;
  const urls = mediaUrls.split(/[\n,]+/).map(u => u.trim()).filter(Boolean);
  if (!urls.length) { list.innerHTML = ''; return; }
  list.innerHTML = urls.map(url => {
    const isYt  = url.includes('youtube') || url.includes('youtu.be');
    const isVid = url.match(/\.(mp4|webm)$/i) || isYt;
    const thumb = isYt
      ? `<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#0f1117;color:#f87171"><i class="fab fa-youtube" style="font-size:20px"></i></div>`
      : isVid
        ? `<video src="${url}" style="width:100%;height:100%;object-fit:cover" muted></video>`
        : `<img src="${url}" style="width:100%;height:100%;object-fit:cover" onerror="this.parentElement.parentElement.style.display='none'">`;
    return `<div style="position:relative;width:80px;height:80px;border-radius:8px;overflow:hidden;border:1.5px solid var(--border);flex-shrink:0">
      ${thumb}
      <button onclick="deleteMediaItem('${url.replace(/'/g, "\\'")}')"
        style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;background:rgba(239,68,68,0.9);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#fff;font-size:10px">
        <i class="fas fa-times"></i>
      </button>
    </div>`;
  }).join('');
}

async function handleMediaUpload(input) {
  if (!currentEditId) { toast('Save the project first, then add media.', 'err'); return; }
  const files = Array.from(input.files);
  if (!files.length) return;
  const label = document.getElementById('media-upload-label');
  label.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
  const csrf = getCsrfToken();
  for (const file of files) {
    const fd = new FormData();
    fd.append('media', file);
    fd.append(csrf.name, csrf.value);
    try {
      const r = await fetch(BASE + '/api/project/upload-media/' + currentEditId, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest', [csrf.name]: csrf.value },
        body: fd,
      });
      if (!r.ok) {
        const text = await r.text();
        toast('Upload failed (' + r.status + '): ' + (text.substring(0, 80) || 'Server error'), 'err');
        continue;
      }
      const data = await r.json();
      const newToken = r.headers.get('X-CSRF-TOKEN');
      if (newToken) { const meta = document.querySelector('meta[name="csrf-token"]'); if (meta) meta.content = newToken; }
      if (data.success) {
        renderMediaPreviews(data.media_urls);
        // Sync PROJECTS_DATA so panel always shows latest media
        if (PROJECTS_DATA[currentEditId]) PROJECTS_DATA[currentEditId].media_urls = data.media_urls;
        toast('Uploaded: ' + file.name);
      } else {
        toast(data.message || 'Upload failed', 'err');
      }
    } catch(e) {
      toast('Upload error: ' + e.message, 'err');
    }
  }
  label.innerHTML = '<i class="fas fa-upload"></i> Upload Photo or Video';
  input.value = '';
}

async function deleteMediaItem(url) {
  if (!currentEditId) return;
  const r = await api('/api/project/delete-media/' + currentEditId, { url });
  if (r.success) {
    renderMediaPreviews(r.media_urls);
    if (PROJECTS_DATA[currentEditId]) PROJECTS_DATA[currentEditId].media_urls = r.media_urls;
    toast('Media removed.');
  } else toast(r.message || 'Error', 'err');
}

async function toggleFeatured(id, btn) {
  const isOn = btn.classList.contains('on');
  const r = await api(`/api/project/update/${id}`, { is_featured: isOn ? 0 : 1 });
  if (r.success) {
    btn.classList.toggle('on');
    const newOn = btn.classList.contains('on');
    btn.innerHTML = `<i class="fas fa-eye${newOn?'':'-slash'}"></i> ${newOn?'Shown':'Hidden'}`;
    toast(newOn ? 'Project shown on portfolio.' : 'Project hidden from portfolio.');
  } else toast(r.message || 'Error', 'err');
}

function confirmDelete(id, name) {
  document.getElementById('del-msg').innerHTML = `Delete <strong>"${name}"</strong>? This cannot be undone.`;
  document.getElementById('del-confirm-btn').onclick = async () => {
    const r = await api(`/api/project/delete/${id}`);
    if (r.success) {
      closeDelModal();
      document.querySelector(`.proj-row[data-id="${id}"]`)?.remove();
      toast(`Deleted "${name}"`);
    } else toast(r.message || 'Error', 'err');
  };
  document.getElementById('delModal').classList.add('open');
}
function closeDelModal() { document.getElementById('delModal').classList.remove('open'); }

function renderTechPills(techArr) {
  const wrap = document.getElementById('tech-pills-wrap');
  const input = document.getElementById('tech-input');
  wrap.querySelectorAll('.tech-pill-item').forEach(el => el.remove());
  techArr.forEach(t => addTechPill(t));
  wrap.appendChild(input);
  syncTechHidden();
}
function addTechPill(text) {
  if (!text.trim()) return;
  const wrap = document.getElementById('tech-pills-wrap');
  const input = document.getElementById('tech-input');
  const div = document.createElement('div');
  div.className = 'tech-pill-item';
  div.dataset.val = text.trim();
  div.innerHTML = `${escHtml(text.trim())} <button type="button" onclick="removeTechPill(this)"><i class="fas fa-times"></i></button>`;
  wrap.insertBefore(div, input);
  syncTechHidden();
}
function removeTechPill(btn) { btn.closest('.tech-pill-item').remove(); syncTechHidden(); }
function syncTechHidden() {
  const pills = document.querySelectorAll('.tech-pill-item');
  const arr = [...pills].map(p => p.dataset.val);
  const h = document.getElementById('pf-tech');
  if (h) h.value = JSON.stringify(arr);
}
function techKeydown(e) {
  if (e.key === 'Enter' || e.key === ',') {
    e.preventDefault();
    const val = e.target.value.replace(',','').trim();
    if (val) { addTechPill(val); e.target.value = ''; }
  } else if (e.key === 'Backspace' && !e.target.value) {
    const pills = document.querySelectorAll('.tech-pill-item');
    if (pills.length) { pills[pills.length-1].remove(); syncTechHidden(); }
  }
}
function techInput(inp) {
  if (inp.value.endsWith(',')) { const val = inp.value.slice(0,-1).trim(); if (val) { addTechPill(val); inp.value = ''; } }
}

let FA_ICONS = [], iconsLoaded = false;
const ICONS_PER_PAGE = 80;
async function loadFAIcons() {
  if (iconsLoaded) return;
  FA_ICONS = ['fa-address-book','fa-address-card','fa-align-center','fa-align-left','fa-align-right','fa-ambulance','fa-anchor','fa-archive','fa-award','fa-ban','fa-bars','fa-bell','fa-bolt','fa-book','fa-book-open','fa-bookmark','fa-brain','fa-briefcase','fa-broadcast-tower','fa-bug','fa-building','fa-bullhorn','fa-calendar','fa-calendar-alt','fa-calendar-check','fa-camera','fa-certificate','fa-chart-bar','fa-chart-line','fa-chart-pie','fa-check','fa-check-circle','fa-check-square','fa-clipboard','fa-clipboard-check','fa-clipboard-list','fa-clock','fa-cloud','fa-code','fa-code-branch','fa-cog','fa-cogs','fa-comment','fa-comment-dots','fa-compass','fa-copy','fa-cube','fa-cubes','fa-database','fa-desktop','fa-download','fa-edit','fa-envelope','fa-eye','fa-file','fa-file-alt','fa-file-code','fa-file-csv','fa-file-excel','fa-file-pdf','fa-file-upload','fa-filter','fa-fingerprint','fa-fire','fa-flag','fa-flask','fa-folder','fa-folder-open','fa-gamepad','fa-globe','fa-graduation-cap','fa-hard-hat','fa-hashtag','fa-heart','fa-home','fa-id-badge','fa-id-card','fa-image','fa-inbox','fa-industry','fa-infinity','fa-info-circle','fa-key','fa-keyboard','fa-laptop','fa-laptop-code','fa-layer-group','fa-leaf','fa-link','fa-list','fa-lock','fa-magic','fa-map','fa-map-marker-alt','fa-memory','fa-microchip','fa-microphone','fa-mobile','fa-mobile-alt','fa-network-wired','fa-newspaper','fa-palette','fa-paper-plane','fa-pen','fa-pencil-alt','fa-phone','fa-plug','fa-print','fa-project-diagram','fa-puzzle-piece','fa-qrcode','fa-robot','fa-rocket','fa-route','fa-satellite','fa-satellite-dish','fa-save','fa-search','fa-server','fa-share-alt','fa-shield-alt','fa-signal','fa-sitemap','fa-sliders-h','fa-sort','fa-star','fa-sticky-note','fa-stopwatch','fa-stream','fa-sync','fa-table','fa-tablet','fa-tag','fa-tags','fa-tasks','fa-terminal','fa-thumbs-up','fa-tools','fa-trophy','fa-truck','fa-tv','fa-university','fa-upload','fa-user','fa-user-cog','fa-user-graduate','fa-user-shield','fa-users','fa-video','fa-wifi','fa-wrench','fa-water','fa-seedling','fa-tree','fa-recycle','fa-solar-panel','fa-dna','fa-atom','fa-vial','fa-microscope','fa-stethoscope','fa-car','fa-bus','fa-plane','fa-ship','fa-th','fa-th-large','fa-th-list','fa-tachometer-alt','fa-gauge','fa-exclamation-circle','fa-exclamation-triangle','fa-times-circle','fa-check-double','fa-columns','fa-shield','fa-lock-open','fa-eye-slash','fa-map-signs','fa-directions','fa-road','fa-heart-pulse','fa-weight'].sort();
  iconsLoaded = true;
}
async function initIconPicker(selected) {
  const grid = document.getElementById('icon-grid');
  if (!grid) return;
  grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:16px;font-size:12px;color:var(--muted)"><i class="fas fa-spinner fa-spin"></i> Loading icons...</div>';
  await loadFAIcons();
  grid._page = 1; grid._query = ''; grid._selected = selected || 'fas fa-code';
  renderIconGrid(grid);
}
function filterIcons(inp) {
  const grid = document.getElementById('icon-grid');
  if (!grid) return;
  grid._query = inp.value.toLowerCase().trim();
  grid._page = 1;
  renderIconGrid(grid);
}
function renderIconGrid(grid) {
  const q = grid._query || '', page = grid._page || 1, sel = grid._selected || '';
  const filtered = q ? FA_ICONS.filter(ic=>ic.includes(q)) : FA_ICONS;
  const slice = filtered.slice(0, page * ICONS_PER_PAGE);
  grid.innerHTML = '';
  if (!filtered.length) { grid.innerHTML='<div style="grid-column:1/-1;text-align:center;padding:12px;font-size:12px;color:var(--muted)">No icons found.</div>'; return; }
  slice.forEach(icon => {
    const fc = 'fas ' + icon;
    const div = document.createElement('div');
    div.className = 'icon-option' + (fc===sel?' selected':'');
    div.title = icon.replace('fa-','');
    div.innerHTML = `<i class="${fc}"></i>`;
    div.onclick = () => selectIcon(div, fc);
    grid.appendChild(div);
  });
  if (slice.length < filtered.length) {
    const more = document.createElement('div');
    more.className = 'icon-load-more';
    more.innerHTML = `<i class="fas fa-chevron-down" style="margin-right:4px"></i>Load more (${filtered.length-slice.length} remaining)`;
    more.onclick = () => { grid._page++; renderIconGrid(grid); };
    grid.appendChild(more);
  }
}
function selectIcon(el, fc) {
  document.getElementById('pf-icon').value = fc;
  const pi = document.getElementById('icon-preview-i');
  const pl = document.getElementById('icon-preview-label');
  if (pi) pi.className = fc;
  if (pl) pl.textContent = fc;
  const grid = document.getElementById('icon-grid');
  if (grid) { grid._selected = fc; grid.querySelectorAll('.icon-option').forEach(o=>o.classList.remove('selected')); el.classList.add('selected'); }
}

let dragSrc = null;
document.addEventListener('DOMContentLoaded', () => { initDrag(); });
function initDrag() {
  document.querySelectorAll('.proj-row').forEach(row => {
    row.addEventListener('dragstart', e => { dragSrc = row; row.classList.add('dragging'); e.dataTransfer.effectAllowed = 'move'; });
    row.addEventListener('dragend', () => { row.classList.remove('dragging'); document.querySelectorAll('.proj-row').forEach(r => r.classList.remove('drag-over')); saveOrder(); });
    row.addEventListener('dragover', e => { e.preventDefault(); e.dataTransfer.dropEffect = 'move'; if (row !== dragSrc) { document.querySelectorAll('.proj-row').forEach(r=>r.classList.remove('drag-over')); row.classList.add('drag-over'); } });
    row.addEventListener('drop', e => { e.preventDefault(); if (dragSrc && dragSrc !== row) { const list = document.getElementById('proj-list'); const rows = [...list.querySelectorAll('.proj-row')]; if (rows.indexOf(dragSrc) < rows.indexOf(row)) list.insertBefore(dragSrc, row.nextSibling); else list.insertBefore(dragSrc, row); } row.classList.remove('drag-over'); });
  });
}
async function saveOrder() {
  const ids = [...document.querySelectorAll('.proj-row')].map(r => parseInt(r.dataset.id));
  const r = await api('/api/project/reorder', { order: ids });
  if (r.success) toast('Order saved!');
  else toast('Error saving order.', 'err');
}

function toggleDark() {
  const d = document.body.classList.toggle('dark');
  localStorage.setItem('adminDarkMode', d ? '1' : '0');
  document.getElementById('darkIcon').className = d ? 'fas fa-sun' : 'fas fa-moon';
}
(function() {
  const saved = localStorage.getItem('adminDarkMode');
  const d = saved !== null ? saved === '1' : window.matchMedia('(prefers-color-scheme:dark)').matches;
  if (d) document.body.classList.add('dark');
  const icon = document.getElementById('darkIcon');
  if (icon) icon.className = d ? 'fas fa-sun' : 'fas fa-moon';
})();

document.addEventListener('keydown', e => { if (e.key === 'Escape') { closePanel(); closeDelModal(); } });

let _currentMethodologyProjectId = null;
function openMethodology(projectId, projectTitle) {
  _currentMethodologyProjectId = projectId;
  document.getElementById('methodology-project-title').textContent = projectTitle;
  document.getElementById('methodology-card').style.display = 'block';
  setTimeout(() => document.getElementById('methodology-card').scrollIntoView({ behavior:'smooth', block:'start' }), 50);
  loadPhases(projectId);
  loadIsoScores(projectId);
}
function closeMethodology() { document.getElementById('methodology-card').style.display = 'none'; _currentMethodologyProjectId = null; }
function switchTab(tab, btn) {
  document.querySelectorAll('.thesis-tab').forEach(b => b.classList.remove('active'));
  document.querySelectorAll('.thesis-panel').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('panel-' + tab).classList.add('active');
}
function loadPhases(projectId) { renderPhases(ALL_PHASES[projectId] || []); }
function renderPhases(phases) {
  const list = document.getElementById('phase-list');
  if (!phases.length) { list.innerHTML = '<div style="padding:20px;text-align:center;color:var(--muted)"><i class="fas fa-inbox" style="font-size:24px;opacity:0.3;display:block;margin-bottom:8px"></i>No phases yet. Click Add Phase to get started.</div>'; return; }
  list.innerHTML = phases.map(ph => `
    <div class="phase-row" data-id="${ph.id}" draggable="true">
      <div class="phase-header" onclick="togglePhaseRow(this)">
        <i class="fas fa-grip-vertical phase-drag-handle" onclick="event.stopPropagation()"></i>
        <div class="phase-num-badge">${escHtml(ph.num)}</div>
        <div class="phase-title-txt">${escHtml(ph.title)}</div>
        <div style="display:flex;gap:5px;flex-shrink:0" onclick="event.stopPropagation()">
          <button class="icon-btn del" onclick="deletePhase(${ph.id},this)" title="Delete"><i class="fas fa-trash"></i></button>
        </div>
        <i class="fas fa-chevron-down phase-chevron"></i>
      </div>
      <div class="phase-body">
        <div style="display:grid;grid-template-columns:80px 1fr;gap:10px;margin:12px 0 10px">
          <div class="fg" style="margin:0"><label>Number</label><input type="text" name="ph-num" value="${escHtml(ph.num)}" placeholder="01" maxlength="4"></div>
          <div class="fg" style="margin:0"><label>Phase Title</label><input type="text" name="ph-title" value="${escHtml(ph.title)}" placeholder="e.g. Planning & Requirement Analysis"></div>
        </div>
        <div class="fg" style="margin-bottom:10px">
          <label>Content <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted)">(HTML — use &lt;ul&gt;&lt;li&gt; format)</span></label>
          <textarea name="ph-content" rows="5" style="font-family:monospace;font-size:12px">${escHtml(ph.content)}</textarea>
        </div>
        <button class="btn-primary" style="font-size:12px;padding:7px 16px" onclick="savePhase(${ph.id},this)"><i class="fas fa-check"></i> Save Phase</button>
      </div>
    </div>`).join('');
  initPhaseDrag();
}
function togglePhaseRow(header) { header.closest('.phase-row').classList.toggle('open'); }
async function savePhase(id, btn) {
  const row = btn.closest('.phase-row');
  const num = row.querySelector('[name=ph-num]').value.trim();
  const title = row.querySelector('[name=ph-title]').value.trim();
  const content = row.querySelector('[name=ph-content]').value.trim();
  if (!title) { toast('Phase title is required.', 'err'); return; }
  const r = await api(`/api/thesis/phase/update/${id}`, { num, title, content });
  if (r.success) {
    row.querySelector('.phase-num-badge').textContent = num;
    row.querySelector('.phase-title-txt').textContent = title;
    if (ALL_PHASES[_currentMethodologyProjectId]) { const ph = ALL_PHASES[_currentMethodologyProjectId].find(p => p.id == id); if (ph) { ph.num = num; ph.title = title; ph.content = content; } }
    toast('Phase saved!');
  } else toast(r.message || 'Error', 'err');
}
async function addPhase() {
  if (!_currentMethodologyProjectId) return;
  const count = document.querySelectorAll('.phase-row').length;
  const r = await api('/api/thesis/phase/add', { project_id: _currentMethodologyProjectId, num: String(count+1).padStart(2,'0'), title:'New Phase', content:'<ul><li>Add content here</li></ul>' });
  if (r.success) {
    toast('Phase added!');
    if (!ALL_PHASES[_currentMethodologyProjectId]) ALL_PHASES[_currentMethodologyProjectId] = [];
    ALL_PHASES[_currentMethodologyProjectId].push({ id:r.id, num:String(count+1).padStart(2,'0'), title:'New Phase', content:'<ul><li>Add content here</li></ul>', sort_order:ALL_PHASES[_currentMethodologyProjectId].length+1 });
    loadPhases(_currentMethodologyProjectId);
    setTimeout(() => { const rows = document.querySelectorAll('.phase-row'); if (rows.length) rows[rows.length-1].querySelector('.phase-header').click(); }, 100);
  } else toast(r.message || 'Error', 'err');
}
async function deletePhase(id, btn) {
  const title = btn.closest('.phase-row').querySelector('.phase-title-txt').textContent;
  document.getElementById('del-msg').innerHTML = `Delete phase <strong>"${title}"</strong>?`;
  document.getElementById('del-confirm-btn').onclick = async () => {
    const r = await api(`/api/thesis/phase/delete/${id}`);
    if (r.success) { closeDelModal(); btn.closest('.phase-row').remove(); if (ALL_PHASES[_currentMethodologyProjectId]) ALL_PHASES[_currentMethodologyProjectId] = ALL_PHASES[_currentMethodologyProjectId].filter(p => p.id != id); toast('Phase deleted.'); }
    else toast(r.message || 'Error', 'err');
  };
  document.getElementById('delModal').classList.add('open');
}
function initPhaseDrag() {
  let src = null;
  const list = document.getElementById('phase-list');
  if (!list) return;
  list.querySelectorAll('.phase-row').forEach(row => {
    row.addEventListener('dragstart', e => { src = row; row.classList.add('dragging'); });
    row.addEventListener('dragend', () => { list.querySelectorAll('.phase-row').forEach(r => r.classList.remove('dragging','drag-over')); const ids = [...list.querySelectorAll('.phase-row')].map(r => parseInt(r.dataset.id)); api('/api/thesis/phase/reorder', { order: ids }); });
    row.addEventListener('dragover', e => { e.preventDefault(); if (row !== src) { list.querySelectorAll('.phase-row').forEach(r=>r.classList.remove('drag-over')); row.classList.add('drag-over'); } });
    row.addEventListener('drop', e => { e.preventDefault(); if (src && row !== src) { const rows = [...list.querySelectorAll('.phase-row')]; rows.indexOf(src) < rows.indexOf(row) ? list.insertBefore(src, row.nextSibling) : list.insertBefore(src, row); row.classList.remove('drag-over'); } });
  });
}
function loadIsoScores(projectId) { renderIsoScores(ALL_ISO[projectId] || []); }
function renderIsoScores(scores) {
  const list = document.getElementById('iso-list');
  if (!scores.length) { list.innerHTML = '<div style="padding:20px;text-align:center;color:var(--muted)"><i class="fas fa-inbox" style="font-size:24px;opacity:0.3;display:block;margin-bottom:8px"></i>No scores yet. Click Add Criterion.</div>'; return; }
  list.innerHTML = scores.map(s => `
    <div class="iso-row" data-id="${s.id}">
      <i class="fas fa-grip-vertical" style="color:#d1d5db;font-size:11px;cursor:grab;flex-shrink:0"></i>
      <input type="text" class="iso-label-input" value="${escHtml(s.label)}" placeholder="Criterion name">
      <div class="iso-bar"><div class="iso-bar-fill" style="width:${s.score}%"></div></div>
      <div class="iso-score-wrap">
        <input type="number" class="iso-score-input" value="${s.score}" min="0" max="100" oninput="updateIsoBar(this)">
        <span style="font-size:12px;color:var(--muted)">%</span>
      </div>
      <button class="icon-btn del" onclick="removeIsoRow(this)" title="Remove"><i class="fas fa-trash"></i></button>
    </div>`).join('');
}
function updateIsoBar(input) { const val = Math.max(0,Math.min(100,parseInt(input.value)||0)); input.closest('.iso-row').querySelector('.iso-bar-fill').style.width = val+'%'; }
function addIsoRow() {
  const list = document.getElementById('iso-list');
  if (list.querySelector('div[style*="padding"]')) list.innerHTML = '';
  const div = document.createElement('div');
  div.className = 'iso-row'; div.dataset.id = '0';
  div.innerHTML = `<i class="fas fa-grip-vertical" style="color:#d1d5db;font-size:11px;cursor:grab;flex-shrink:0"></i>
    <input type="text" class="iso-label-input" value="New Criterion" placeholder="Criterion name">
    <div class="iso-bar"><div class="iso-bar-fill" style="width:80%"></div></div>
    <div class="iso-score-wrap"><input type="number" class="iso-score-input" value="80" min="0" max="100" oninput="updateIsoBar(this)"><span style="font-size:12px;color:var(--muted)">%</span></div>
    <button class="icon-btn del" onclick="removeIsoRow(this)" title="Remove"><i class="fas fa-trash"></i></button>`;
  list.appendChild(div);
}
function removeIsoRow(btn) { btn.closest('.iso-row').remove(); }
async function saveIsoScores() {
  if (!_currentMethodologyProjectId) return;
  const rows = document.querySelectorAll('#iso-list .iso-row');
  const scores = [...rows].map(row => ({ label: row.querySelector('.iso-label-input').value.trim(), score: parseInt(row.querySelector('.iso-score-input').value)||0 })).filter(s => s.label);
  const r = await api('/api/thesis/iso/update', { project_id: _currentMethodologyProjectId, scores });
  if (r.success) toast('Scores saved!');
  else toast(r.message || 'Error', 'err');
}

function escHtml(str) {
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
</body>
</html>