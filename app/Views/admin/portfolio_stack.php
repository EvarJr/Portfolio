<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Portfolio Stack — Admin</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{
  --bg:#f0f2f5;--sidebar-w:245px;
  --accent:#3b82f6;--accent-dark:#2563eb;
  --success:#10b981;--danger:#ef4444;
  --card:#fff;--border:#e5e7eb;--text:#1f2937;--muted:#6b7280;
  --radius:10px;--shadow:0 1px 4px rgba(0,0,0,0.08);
  --sidebar:#05080f;--sidebar-2:#0b0f1e;
  --sidebar-border:rgba(99,102,241,0.12);
  --sidebar-accent:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 50%,#06b6d4 100%);
}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg);font-family:'DM Sans',sans-serif;color:var(--text);font-size:14px;line-height:1.5}
.layout{display:flex;min-height:100vh}

/* ── SIDEBAR ── */
.sidebar{width:var(--sidebar-w);background:var(--sidebar);display:flex;flex-direction:column;position:fixed;top:0;left:0;height:100vh;z-index:200;border-right:1px solid var(--sidebar-border)}
.sidebar::before{content:'';position:absolute;inset:0;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");opacity:0.5;z-index:0}
.sidebar>*{position:relative;z-index:1}
.sb-brand{padding:18px 16px;display:flex;align-items:center;gap:11px;border-bottom:1px solid var(--sidebar-border);background:rgba(99,102,241,0.04)}
.sb-icon{width:36px;height:36px;border-radius:9px;flex-shrink:0;background:var(--sidebar-accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:15px;box-shadow:0 0 0 1px rgba(99,102,241,0.3),0 4px 12px rgba(99,102,241,0.25)}
.sb-title{color:#f1f5f9;font-size:13.5px;font-weight:600;line-height:1.25;letter-spacing:-0.2px}
.sb-title span{display:block;font-size:10.5px;font-weight:300;color:rgba(255,255,255,0.35);margin-top:1px}
.sb-nav{flex:1;overflow-y:auto;padding:8px 0;scrollbar-width:thin;scrollbar-color:rgba(99,102,241,0.15) transparent}
.sb-label{font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:1.2px;color:rgba(99,102,241,0.5);padding:14px 16px 4px}
.nav-link{display:flex;align-items:center;gap:10px;padding:8px 16px;color:rgba(255,255,255,0.45);text-decoration:none;font-size:12.5px;cursor:pointer;border-left:2px solid transparent;transition:all 0.15s;margin:1px 0}
.nav-link:hover{color:rgba(255,255,255,0.85);background:rgba(99,102,241,0.07);border-left-color:rgba(99,102,241,0.4)}
.nav-link.active{color:#a5b4fc;background:rgba(99,102,241,0.1);border-left-color:#6366f1}
.nav-link i{width:15px;text-align:center;font-size:11.5px;opacity:0.8}
.sb-footer{padding:12px;border-top:1px solid var(--sidebar-border);background:rgba(0,0,0,0.15)}
.btn-preview{display:flex;align-items:center;justify-content:center;gap:7px;background:var(--sidebar-accent);color:#fff;padding:9px;border-radius:8px;text-decoration:none;font-size:12px;font-weight:600;margin-bottom:7px;transition:opacity 0.2s;box-shadow:0 4px 14px rgba(99,102,241,0.3)}
.btn-preview:hover{opacity:0.88}
.btn-signout{display:flex;align-items:center;justify-content:center;gap:7px;color:rgba(255,255,255,0.3);font-size:11.5px;text-decoration:none;padding:6px;border-radius:6px;transition:color 0.2s}
.btn-signout:hover{color:rgba(255,255,255,0.7)}

/* ── MAIN ── */
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
.btn-add-item{background:transparent;border:1.5px dashed var(--accent);color:var(--accent);padding:8px 16px;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s}
.btn-add-item:hover{background:rgba(59,130,246,0.05)}
.fg{display:flex;flex-direction:column;gap:5px;margin-bottom:14px}
.fg label{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px}
.fg input,.fg textarea{padding:8px 12px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;transition:border-color 0.2s;background:#fff;width:100%}
.fg input:focus,.fg textarea:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(59,130,246,0.08)}

/* ── STACK GRID ── */
.stack-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:14px}
.stack-card{background:#fff;border:1px solid var(--border);border-radius:12px;padding:14px;display:flex;flex-direction:column;align-items:center;gap:8px;position:relative;transition:border-color 0.2s;cursor:grab}
.stack-card:hover{border-color:#c7d2fe}
.stack-card.dragging{opacity:0.4;border-style:dashed}
.stack-card.drag-over{border-color:var(--accent);background:#eff6ff}
.stack-card-drag{position:absolute;top:7px;left:8px;color:#d1d5db;font-size:11px;cursor:grab}
.stack-card-img{width:60px;height:60px;border-radius:12px;background:#f9fafb;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;padding:8px}
.stack-card-img img{width:100%;height:100%;object-fit:contain}
.stack-card-name{font-size:12.5px;font-weight:600;color:var(--text);text-align:center}
.stack-card-meta{font-size:11px;color:var(--muted);text-align:center}
.stack-card-actions{display:flex;gap:5px}
.empty-state{text-align:center;padding:48px 20px;color:var(--muted)}
.empty-state i{font-size:40px;margin-bottom:12px;display:block;opacity:0.3}
.empty-state p{font-size:13px}

/* ── EDIT PANEL ── */
.edit-overlay{position:fixed;inset:0;background:rgba(15,23,42,0.45);z-index:900;opacity:0;pointer-events:none;transition:opacity 0.3s}
.edit-overlay.open{opacity:1;pointer-events:all}
.edit-panel{position:fixed;top:0;right:0;bottom:0;width:480px;max-width:95vw;background:#fff;z-index:901;display:flex;flex-direction:column;box-shadow:-8px 0 40px rgba(0,0,0,0.15);transform:translateX(100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1)}
.edit-panel.open{transform:translateX(0)}
.ep-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:flex-start;justify-content:space-between;gap:12px;background:#fafafa;flex-shrink:0}
.ep-section-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent);margin-bottom:3px}
.ep-title{font-size:16px;font-weight:700;color:var(--text);line-height:1.3}
.ep-close{width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--muted);transition:all 0.15s}
.ep-close:hover{background:#fee2e2;border-color:#fca5a5;color:#ef4444}
.ep-body{flex:1;overflow-y:auto;padding:22px 24px;display:flex;flex-direction:column;gap:0}
.ep-divider{height:1px;background:var(--border);margin:14px 0}
.ep-footer{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;background:#fafafa;flex-shrink:0}
.ep-footer .btn-primary{flex:1;justify-content:center;padding:11px;font-size:14px}
.ep-footer .btn-cancel-soft{padding:11px 20px;font-size:14px}

/* ── IMAGE UPLOAD ── */
.img-upload-area{display:flex;align-items:center;gap:14px;margin-bottom:14px}
.img-preview-box{width:70px;height:70px;border-radius:12px;background:#f9fafb;border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;overflow:hidden;padding:6px;flex-shrink:0}
.img-preview-box img{width:100%;height:100%;object-fit:contain}
.img-upload-btns{display:flex;flex-direction:column;gap:8px;flex:1}
.or-text{font-size:11px;color:var(--muted);text-align:center;font-weight:600;letter-spacing:0.5px}
.upload-file-label{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:8px 14px;background:rgba(59,130,246,0.06);border:1.5px dashed var(--accent);border-radius:7px;font-size:12px;font-weight:500;color:var(--accent);cursor:pointer;transition:background 0.2s}
.upload-file-label:hover{background:rgba(59,130,246,0.12)}

/* ── PROJECT CHECKBOXES ── */
.proj-check-list{max-height:200px;overflow-y:auto;border:1.5px solid var(--border);border-radius:8px;padding:6px;display:flex;flex-direction:column;gap:2px;scrollbar-width:thin;scrollbar-color:rgba(99,102,241,0.2) transparent}
.proj-check-item{display:flex;align-items:center;gap:9px;padding:7px 10px;border-radius:6px;cursor:pointer;transition:background 0.15s}
.proj-check-item:hover{background:#f0f7ff}
.proj-check-item input[type=checkbox]{width:14px;height:14px;accent-color:var(--accent);cursor:pointer;flex-shrink:0}
.proj-check-item label{font-size:13px;color:var(--text);cursor:pointer;flex:1;line-height:1.4}

/* ── DELETE MODAL ── */
.del-modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:1000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity 0.15s}
.del-modal-overlay.open{opacity:1;pointer-events:all}
.del-modal{background:#1e293b;border-radius:8px;padding:22px 24px 18px;min-width:300px;max-width:360px;width:90%;box-shadow:0 8px 32px rgba(0,0,0,0.4);transform:translateY(-4px);transition:transform 0.15s}
.del-modal-overlay.open .del-modal{transform:translateY(0)}
.del-modal h3{font-size:13px;font-weight:600;color:#fff;margin-bottom:8px}
.del-modal p{font-size:13px;color:#94a3b8;margin-bottom:20px;line-height:1.5}
.del-modal p strong{color:#cbd5e1}
.del-modal-btns{display:flex;gap:8px;justify-content:flex-end}
.btn-del-cancel{padding:7px 18px;background:#334155;color:#cbd5e1;border:none;border-radius:5px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer}
.btn-del-cancel:hover{background:#475569}
.btn-del-confirm{padding:7px 18px;background:#ef4444;color:#fff;border:none;border-radius:5px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer}
.btn-del-confirm:hover{background:#dc2626}

/* ── TOAST ── */
#toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(80px);background:#1e293b;color:#fff;padding:12px 18px;border-radius:12px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 32px rgba(0,0,0,0.2);z-index:2000;transition:transform 0.3s ease;white-space:nowrap}
#toast.show{transform:translateX(-50%) translateY(0)}
#toast.ok{background:#1e293b}
#toast.err{background:#991b1b}

/* ── DARK MODE ── */
body.dark{--bg:#0f1117;--card:#161b27;--border:#1e2535;--text:#e2e8f0;--muted:#64748b}
body.dark .topbar{background:#161b27;border-color:#1e2535}
body.dark .card,.dark .stack-card{background:#161b27;border-color:#1e2535}
body.dark .card-head{background:#111827;border-color:#1e2535}
body.dark .fg input,.dark .fg textarea{background:#0f1117;border-color:#1e2535;color:#e2e8f0}
body.dark .edit-panel{background:#161b27}
body.dark .ep-header,.dark .ep-footer{background:#111827;border-color:#1e2535}
body.dark .icon-btn{background:#111827;border-color:#1e2535;color:#64748b}
body.dark .img-preview-box{background:#111827;border-color:#1e2535}
body.dark .proj-check-list{border-color:#1e2535}
body.dark .proj-check-item:hover{background:rgba(99,102,241,0.08)}
body.dark .proj-check-item label{color:#94a3b8}
body.dark .upload-file-label{background:rgba(59,130,246,0.08)}
.dark-toggle{width:36px;height:36px;border-radius:8px;border:1.5px solid var(--border);background:transparent;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;color:var(--muted);transition:all 0.2s}
.dark-toggle:hover{border-color:var(--accent);color:var(--accent)}
body.dark .dark-toggle{background:#111827;border-color:#1e2535;color:#fbbf24}
</style>
</head>
<body>

<div id="toast"></div>
<div class="edit-overlay" id="editOverlay" onclick="closePanel()"></div>

<!-- EDIT PANEL -->
<div class="edit-panel" id="editPanel">
  <div class="ep-header">
    <div>
      <div class="ep-section-label">Portfolio Stack</div>
      <div class="ep-title" id="ep-title">Add Technology</div>
    </div>
    <button class="ep-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
  </div>
  <div class="ep-body" id="ep-body"></div>
  <div class="ep-footer">
    <button class="btn-cancel-soft" onclick="closePanel()"><i class="fas fa-times"></i> Cancel</button>
    <button class="btn-primary" id="ep-save-btn"><i class="fas fa-check"></i> Save</button>
  </div>
</div>

<!-- DELETE MODAL -->
<div class="del-modal-overlay" id="delModal">
  <div class="del-modal">
    <h3>Delete this technology?</h3>
    <p id="del-msg">This action <strong>cannot be undone</strong>.</p>
    <div class="del-modal-btns">
      <button class="btn-del-cancel" onclick="closeDelModal()">Cancel</button>
      <button class="btn-del-confirm" id="del-confirm-btn"><i class="fas fa-trash"></i> Delete</button>
    </div>
  </div>
</div>

<div class="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="sb-brand">
      <div class="sb-icon"><i class="fas fa-file-alt"></i></div>
      <div class="sb-title">Resume CI4<span>Admin Dashboard</span></div>
    </div>
    <nav class="sb-nav">
      <div class="sb-label">Resumes</div>
      <a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-layer-group"></i>Resume Collection</a>
      <div class="sb-label">Portfolio</div>
      <a class="nav-link" href="<?= base_url('admin/projects') ?>"><i class="fas fa-briefcase"></i>Featured Work</a>
      <a class="nav-link active" href="<?= base_url('admin/portfoliostack') ?>"><i class="fas fa-layer-group"></i>Portfolio Stack</a>
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

  <!-- MAIN -->
  <main class="main">
    <div class="topbar">
      <div class="topbar-title"><i class="fas fa-layer-group"></i> Portfolio Stack</div>
      <div class="topbar-right">
        <button class="dark-toggle" onclick="toggleDark()" title="Dark mode"><i class="fas fa-moon" id="darkIcon"></i></button>
        <div class="user-chip"><i class="fas fa-user-circle"></i><?= esc($adminUsername) ?></div>
        <a href="<?= base_url() ?>" target="_blank" class="btn-sm-outline"><i class="fas fa-external-link-alt"></i> Preview</a>
      </div>
    </div>

    <div class="content">
      <div class="card">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-layer-group"></i></div>
          <div class="card-head-text">
            <h2>Portfolio Tech Stack</h2>
            <p>Drag to reorder. Hover on live site to see floating project pills.</p>
          </div>
          <button class="btn-primary" style="margin-left:auto;flex-shrink:0" onclick="openAddPanel()">
            <i class="fas fa-plus"></i> Add Technology
          </button>
        </div>
        <div class="card-body">
          <?php if(empty($techStacks)): ?>
          <div class="empty-state">
            <i class="fas fa-layer-group"></i>
            <p>No technologies yet.<br>Click <strong>Add Technology</strong> to get started.</p>
          </div>
          <?php else: ?>
          <div class="stack-grid" id="stack-grid">
            <?php foreach($techStacks as $stack):
              $projIds = \App\Models\PortfolioStackModel::decodeProjects($stack['project_ids'] ?? '[]');
              $projCount = 0;
              foreach($projects as $p){ if(in_array((int)$p['id'], $projIds)) $projCount++; }
            ?>
            <div class="stack-card" draggable="true" data-id="<?= $stack['id'] ?>">
              <i class="fas fa-grip-vertical stack-card-drag"></i>
              <div class="stack-card-img">
                <?php if(!empty($stack['image_url'])): ?>
                <img src="<?= esc($stack['image_url']) ?>" alt="<?= esc($stack['name']) ?>">
                <?php else: ?>
                <i class="fas fa-code" style="font-size:22px;color:#d1d5db"></i>
                <?php endif; ?>
              </div>
              <div class="stack-card-name"><?= esc($stack['name']) ?></div>
              <div class="stack-card-meta"><?= $projCount ?> project<?= $projCount !== 1 ? 's' : '' ?></div>
              <div class="stack-card-actions">
                <button class="icon-btn edit" onclick="openEditPanel(<?= $stack['id'] ?>)" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                <button class="icon-btn del" onclick="confirmDelete(<?= $stack['id'] ?>, '<?= esc(addslashes($stack['name'])) ?>')" title="Delete"><i class="fas fa-trash"></i></button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
const BASE = '<?= rtrim(base_url(), '/') ?>';

// ── DATA ──
const STACKS_DATA = {
  <?php foreach($techStacks as $s): ?>
  <?= $s['id'] ?>: {
    id: <?= $s['id'] ?>,
    name: <?= json_encode($s['name']) ?>,
    image_url: <?= json_encode($s['image_url']) ?>,
    project_ids: <?= json_encode(\App\Models\PortfolioStackModel::decodeProjects($s['project_ids'] ?? '[]')) ?>,
  },
  <?php endforeach; ?>
};

const PROJECTS_LIST = <?php
  echo json_encode(array_map(fn($p) => ['id' => (int)$p['id'], 'title' => $p['title']], $projects));
?>;

// ── TOAST ──
let _toastTimer;
function toast(msg, type='ok') {
  const el = document.getElementById('toast');
  const icon = type==='ok'
    ? '<i class="fas fa-check-circle" style="color:#4ade80"></i>'
    : '<i class="fas fa-exclamation-circle" style="color:#f87171"></i>';
  el.className = 'show ' + type;
  el.innerHTML = icon + '<span>' + msg + '</span>';
  clearTimeout(_toastTimer);
  _toastTimer = setTimeout(() => el.className='', 3500);
}

// ── API ──
async function api(path, data={}) {
  const r = await fetch(BASE + path, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });
  return r.json();
}

// ── PANEL HELPERS ──
let currentEditId = null;
let uploadedImageUrl = '';

function buildPanelForm(stack) {
  const name      = stack ? escHtml(stack.name) : '';
  const imageUrl  = stack ? escHtml(stack.image_url) : '';
  const projIds   = stack ? stack.project_ids : [];

  const projCheckboxes = PROJECTS_LIST.map(p => `
    <div class="proj-check-item">
      <input type="checkbox" id="pc_${p.id}" value="${p.id}" ${projIds.includes(p.id) ? 'checked' : ''}>
      <label for="pc_${p.id}">${escHtml(p.title)}</label>
    </div>`).join('');

  return `
    <!-- IMAGE -->
    <div class="fg">
      <label>Logo Image</label>
      <div class="img-upload-area">
        <div class="img-preview-box" id="img-preview-box">
          ${imageUrl
            ? `<img src="${imageUrl}" id="img-preview-el">`
            : `<i class="fas fa-image" style="font-size:22px;color:#d1d5db" id="img-preview-icon"></i>`}
        </div>
        <div class="img-upload-btns">
          <label class="upload-file-label">
            <i class="fas fa-upload"></i> Upload File
            <input type="file" id="img-file-input" accept="image/*" style="display:none" onchange="previewFile(this)">
          </label>
          <div class="or-text">— OR —</div>
          <input type="text" id="img-url-input" placeholder="Paste image URL..."
            value="${imageUrl}" oninput="previewUrl(this.value)"
            style="font-size:12px;padding:7px 10px">
        </div>
      </div>
    </div>

    <div class="ep-divider"></div>

    <!-- NAME -->
    <div class="fg">
      <label>Technology Name</label>
      <input type="text" id="tech-name-input" value="${name}" placeholder="e.g. Laravel, React JS, Python...">
    </div>

    <div class="ep-divider"></div>

    <!-- PROJECTS -->
    <div class="fg" style="margin-bottom:0">
      <label>Used In Projects <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted);font-size:10.5px">— select all that apply</span></label>
      <div class="proj-check-list">
        ${projCheckboxes || '<div style="padding:12px;text-align:center;color:var(--muted);font-size:12px">No projects yet. Add projects in Featured Work first.</div>'}
      </div>
    </div>`;
}

function openAddPanel() {
  currentEditId = null;
  uploadedImageUrl = '';
  document.getElementById('ep-title').textContent = '✚ Add Technology';
  document.getElementById('ep-body').innerHTML = buildPanelForm(null);
  document.getElementById('ep-save-btn').onclick = saveStack;
  document.getElementById('editOverlay').classList.add('open');
  document.getElementById('editPanel').classList.add('open');
  document.body.style.overflow = 'hidden';
  setTimeout(() => document.getElementById('tech-name-input')?.focus(), 300);
}

function openEditPanel(id) {
  const s = STACKS_DATA[id];
  if(!s) return;
  currentEditId = id;
  uploadedImageUrl = s.image_url || '';
  document.getElementById('ep-title').textContent = '✏️ ' + s.name;
  document.getElementById('ep-body').innerHTML = buildPanelForm(s);
  document.getElementById('ep-save-btn').onclick = saveStack;
  document.getElementById('editOverlay').classList.add('open');
  document.getElementById('editPanel').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closePanel() {
  document.getElementById('editOverlay').classList.remove('open');
  document.getElementById('editPanel').classList.remove('open');
  document.body.style.overflow = '';
}

// ── IMAGE PREVIEW ──
function previewFile(input) {
  const file = input.files[0];
  if(!file) return;
  uploadedImageUrl = ''; // will be uploaded on save
  const reader = new FileReader();
  reader.onload = e => updatePreview(e.target.result);
  reader.readAsDataURL(file);
}

function previewUrl(url) {
  uploadedImageUrl = '';
  if(url) updatePreview(url);
}

function updatePreview(src) {
  const box = document.getElementById('img-preview-box');
  box.innerHTML = `<img src="${src}" id="img-preview-el" onerror="this.style.display='none'">`;
}

// ── GET CHECKED PROJECTS ──
function getCheckedProjectIds() {
  return Array.from(document.querySelectorAll('.proj-check-list input[type=checkbox]:checked'))
    .map(cb => parseInt(cb.value));
}

// ── SAVE ──
async function saveStack() {
  const name      = document.getElementById('tech-name-input').value.trim();
  const urlInput  = document.getElementById('img-url-input').value.trim();
  const fileInput = document.getElementById('img-file-input');
  const projIds   = getCheckedProjectIds();
  const btn       = document.getElementById('ep-save-btn');

  if(!name) { toast('Please enter a technology name.', 'err'); return; }

  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

  let finalImageUrl = uploadedImageUrl || urlInput;

  // If file selected and no uploaded URL yet — need to upload
  if(fileInput.files.length > 0 && !uploadedImageUrl) {
    // Create/update the entry first to get an ID, then upload
    let targetId = currentEditId;

    if(!targetId) {
      // Create first
      const cr = await api('/api/portfoliostack/add', { name, image_url:'', project_ids: projIds });
      if(!cr.success) {
        toast(cr.message || 'Error creating entry.', 'err');
        btn.disabled = false; btn.innerHTML = '<i class="fas fa-check"></i> Save';
        return;
      }
      targetId = cr.data.id;
    }

    // Upload image
    const fd = new FormData();
    fd.append('image', fileInput.files[0]);
    const upRes = await fetch(BASE + '/api/portfoliostack/upload/' + targetId, { method:'POST', body:fd });
    const upData = await upRes.json();

    if(!upData.success) {
      toast('Image upload failed: ' + (upData.message || 'Unknown error'), 'err');
      btn.disabled = false; btn.innerHTML = '<i class="fas fa-check"></i> Save';
      return;
    }

    finalImageUrl = upData.data.url;

    // Now update with full data
    await api('/api/portfoliostack/update/' + targetId, { name, image_url: finalImageUrl, project_ids: projIds });
    toast('Technology saved!');
    closePanel();
    setTimeout(() => location.reload(), 800);
    return;
  }

  // No file upload needed
  const endpoint = currentEditId
    ? '/api/portfoliostack/update/' + currentEditId
    : '/api/portfoliostack/add';

  const r = await api(endpoint, { name, image_url: finalImageUrl, project_ids: projIds });

  if(r.success) {
    toast('Technology saved!');
    closePanel();
    setTimeout(() => location.reload(), 800);
  } else {
    toast(r.message || 'Error saving.', 'err');
    btn.disabled = false;
    btn.innerHTML = '<i class="fas fa-check"></i> Save';
  }
}

// ── DELETE ──
function confirmDelete(id, name) {
  document.getElementById('del-msg').innerHTML = `Delete <strong>"${name}"</strong>? This cannot be undone.`;
  document.getElementById('del-confirm-btn').onclick = async () => {
    const r = await api('/api/portfoliostack/delete/' + id);
    if(r.success) {
      closeDelModal();
      document.querySelector(`.stack-card[data-id="${id}"]`)?.remove();
      toast(`Deleted "${name}"`);
    } else toast(r.message || 'Error', 'err');
  };
  document.getElementById('delModal').classList.add('open');
}
function closeDelModal() { document.getElementById('delModal').classList.remove('open'); }

// ── DRAG TO REORDER ──
(function initDrag() {
  const grid = document.getElementById('stack-grid');
  if(!grid) return;
  let dragSrc = null;

  grid.querySelectorAll('.stack-card').forEach(card => {
    card.addEventListener('dragstart', () => { dragSrc = card; card.classList.add('dragging'); });
    card.addEventListener('dragend', () => {
      card.classList.remove('dragging');
      grid.querySelectorAll('.stack-card').forEach(c => c.classList.remove('drag-over'));
      const ids = [...grid.querySelectorAll('.stack-card')].map(c => parseInt(c.dataset.id));
      api('/api/portfoliostack/reorder', { order: ids }).then(() => toast('Order saved!'));
    });
    card.addEventListener('dragover', e => {
      e.preventDefault();
      if(card !== dragSrc) {
        grid.querySelectorAll('.stack-card').forEach(c => c.classList.remove('drag-over'));
        card.classList.add('drag-over');
      }
    });
    card.addEventListener('drop', e => {
      e.preventDefault();
      if(dragSrc && dragSrc !== card) {
        const cards = [...grid.querySelectorAll('.stack-card')];
        cards.indexOf(dragSrc) < cards.indexOf(card)
          ? grid.insertBefore(dragSrc, card.nextSibling)
          : grid.insertBefore(dragSrc, card);
      }
      card.classList.remove('drag-over');
    });
  });
})();

// ── DARK MODE ──
function toggleDark() {
  const d = document.body.classList.toggle('dark');
  localStorage.setItem('adminDarkMode', d ? '1' : '0');
  document.getElementById('darkIcon').className = d ? 'fas fa-sun' : 'fas fa-moon';
}
(function() {
  const saved = localStorage.getItem('adminDarkMode');
  const d = saved !== null ? saved === '1' : window.matchMedia('(prefers-color-scheme:dark)').matches;
  if(d) document.body.classList.add('dark');
  const icon = document.getElementById('darkIcon');
  if(icon) icon.className = d ? 'fas fa-sun' : 'fas fa-moon';
})();

document.addEventListener('keydown', e => {
  if(e.key === 'Escape') { closePanel(); closeDelModal(); }
});

function escHtml(str) {
  return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
</body>
</html>