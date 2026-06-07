<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Dashboard — Resume CI4</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ──────────── CSS VARIABLES ──────────── */
:root{
  --bg:#f0f2f5; --sidebar-w:245px;
  --accent:#3b82f6; --accent-dark:#2563eb;
  --success:#10b981; --danger:#ef4444; --warning:#f59e0b;
  --card:#fff; --border:#e5e7eb; --text:#1f2937; --muted:#6b7280;
  --radius:10px; --shadow:0 1px 4px rgba(0,0,0,0.08);

  /* Sidebar — matches portfolio midnight theme */
  --sidebar:#05080f;
  --sidebar-2:#0b0f1e;
  --sidebar-border:rgba(99,102,241,0.12);
  --sidebar-accent:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 50%,#06b6d4 100%);
}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--bg);font-family:'DM Sans',sans-serif;color:var(--text);font-size:14px;line-height:1.5}

/* ──────────── LAYOUT ──────────── */
.layout{display:flex;min-height:100vh}

/* ──────────── SIDEBAR ──────────── */
.sidebar{
  width:var(--sidebar-w);background:var(--sidebar);
  display:flex;flex-direction:column;position:fixed;
  top:0;left:0;height:100vh;z-index:200;transition:transform 0.3s;
  border-right:1px solid var(--sidebar-border);
}
/* Subtle noise texture overlay on sidebar */
.sidebar::before{
  content:'';position:absolute;inset:0;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
  opacity:0.5;z-index:0;
}
.sidebar > *{position:relative;z-index:1}
.sb-brand{
  padding:18px 16px;display:flex;align-items:center;gap:11px;
  border-bottom:1px solid var(--sidebar-border);
  background:rgba(99,102,241,0.04);
}
.sb-icon{
  width:36px;height:36px;border-radius:9px;flex-shrink:0;
  background:var(--sidebar-accent);
  display:flex;align-items:center;justify-content:center;
  color:#fff;font-size:15px;
  box-shadow:0 0 0 1px rgba(99,102,241,0.3),0 4px 12px rgba(99,102,241,0.25);
}
.sb-title{color:#f1f5f9;font-size:13.5px;font-weight:600;line-height:1.25;letter-spacing:-0.2px}
.sb-title span{display:block;font-size:10.5px;font-weight:300;color:rgba(255,255,255,0.35);margin-top:1px}
.sb-nav{flex:1;overflow-y:auto;padding:8px 0;scrollbar-width:thin;scrollbar-color:rgba(99,102,241,0.15) transparent}
.sb-label{
  font-size:9.5px;font-weight:700;text-transform:uppercase;
  letter-spacing:1.2px;color:rgba(99,102,241,0.5);
  padding:14px 16px 4px;
}
.nav-link{
  display:flex;align-items:center;gap:10px;
  padding:8px 16px;
  color:rgba(255,255,255,0.45);
  text-decoration:none;font-size:12.5px;cursor:pointer;
  border-left:2px solid transparent;
  transition:all 0.15s;margin:1px 0;
}
.nav-link:hover{color:rgba(255,255,255,0.85);background:rgba(99,102,241,0.07);border-left-color:rgba(99,102,241,0.4)}
.nav-link.active{color:#a5b4fc;background:rgba(99,102,241,0.1);border-left-color:#6366f1}
.nav-link i{width:15px;text-align:center;font-size:11.5px;opacity:0.8}
.sb-footer{
  padding:12px;border-top:1px solid var(--sidebar-border);
  background:rgba(0,0,0,0.15);
}
.btn-preview{
  display:flex;align-items:center;justify-content:center;gap:7px;
  background:var(--sidebar-accent);
  color:#fff;padding:9px;border-radius:8px;
  text-decoration:none;font-size:12px;font-weight:600;
  margin-bottom:7px;transition:opacity 0.2s;
  box-shadow:0 4px 14px rgba(99,102,241,0.3);
}
.btn-preview:hover{opacity:0.88}
.btn-signout{
  display:flex;align-items:center;justify-content:center;gap:7px;
  color:rgba(255,255,255,0.3);font-size:11.5px;text-decoration:none;
  padding:6px;border-radius:6px;transition:color 0.2s;
}
.btn-signout:hover{color:rgba(255,255,255,0.7)}

/* ──────────── MAIN ──────────── */
.main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:#fff;border-bottom:1px solid var(--border);height:58px;padding:0 26px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100;box-shadow:var(--shadow)}
.topbar-title{font-size:15px;font-weight:600;display:flex;align-items:center;gap:8px}
.topbar-title i{color:var(--accent)}
.topbar-right{display:flex;align-items:center;gap:12px}
.user-chip{display:flex;align-items:center;gap:7px;font-size:13px;color:var(--muted);background:#f9fafb;padding:6px 12px;border-radius:20px;border:1px solid var(--border)}
.user-chip i{color:var(--accent)}
.btn-sm-outline{padding:6px 14px;border:1.5px solid var(--border);background:#fff;border-radius:7px;font-size:12px;color:var(--text);text-decoration:none;cursor:pointer;font-family:'DM Sans',sans-serif;display:flex;align-items:center;gap:5px;transition:border-color 0.2s,color 0.2s}
.btn-sm-outline:hover{border-color:var(--accent);color:var(--accent)}

/* ──────────── CONTENT ──────────── */
.content{padding:22px 26px;display:flex;flex-direction:column;gap:20px}

/* ──────────── CARDS ──────────── */
.card{background:var(--card);border-radius:var(--radius);border:1px solid var(--border);overflow:hidden}
.card-head{padding:16px 22px;background:#fafafa;border-bottom:1px solid var(--border);display:flex;align-items:flex-start;gap:12px}
.card-head-icon{width:34px;height:34px;border-radius:8px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:14px;flex-shrink:0;margin-top:1px}
.card-head-text h2{font-size:14px;font-weight:600;margin-bottom:2px}
.card-head-text p{font-size:12px;color:var(--muted)}
.card-body{padding:20px 22px}

/* ──────────── FORMS ──────────── */
.grid-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.grid-1{display:grid;grid-template-columns:1fr;gap:12px;margin-bottom:14px}
.fg{display:flex;flex-direction:column;gap:5px}
.fg label{font-size:11px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:0.5px}
.fg input,.fg textarea,.fg select{padding:8px 12px;border:1.5px solid var(--border);border-radius:7px;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);outline:none;transition:border-color 0.2s;background:#fff;width:100%}
.fg input:focus,.fg textarea:focus,.fg select:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(59,130,246,0.08)}
.fg textarea{resize:vertical;min-height:88px}
.date-row{display:flex;gap:8px}
.date-row select{flex:1}
.check-row{display:flex;align-items:center;gap:7px;font-size:13px;cursor:pointer}
.check-row input[type=checkbox]{width:15px;height:15px;cursor:pointer}

/* ──────────── BUTTONS ──────────── */
.btn-primary{background:var(--accent);color:#fff;border:none;padding:9px 18px;border-radius:7px;font-size:13px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s}
.btn-primary:hover{background:var(--accent-dark)}
.btn-success{background:var(--success);color:#fff;border:none;padding:7px 13px;border-radius:6px;font-size:12px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:4px}
.btn-cancel-soft{background:#f3f4f6;color:var(--text);border:none;padding:7px 13px;border-radius:6px;font-size:12px;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:4px}
.btn-add-item{background:transparent;border:1.5px dashed var(--accent);color:var(--accent);padding:8px 16px;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;margin-top:12px;display:inline-flex;align-items:center;gap:6px;transition:background 0.2s}
.btn-add-item:hover{background:rgba(59,130,246,0.05)}
.btn-add-bullet{background:none;border:none;color:var(--accent);font-size:11.5px;font-weight:500;cursor:pointer;font-family:'DM Sans',sans-serif;padding:4px 0;display:inline-flex;align-items:center;gap:4px;margin-top:4px}
.btn-add-bullet:hover{text-decoration:underline}
.icon-btn{width:26px;height:26px;border-radius:5px;border:1.5px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:10.5px;transition:all 0.15s;flex-shrink:0}
.icon-btn.edit:hover{border-color:var(--accent);color:var(--accent);background:rgba(59,130,246,0.05)}
.icon-btn.del:hover{border-color:var(--danger);color:var(--danger);background:rgba(239,68,68,0.05)}
.xs-btn{padding:3px 8px;border-radius:4px;font-size:10.5px;font-weight:600;cursor:pointer;border:none;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:3px}
.xs-btn.ok{background:var(--success);color:#fff}
.xs-btn.cancel{background:#e5e7eb;color:var(--text)}

/* ──────────── ITEM BLOCKS ──────────── */
.item-block{border:1px solid var(--border);border-radius:8px;padding:13px 15px;margin-bottom:9px;transition:border-color 0.15s}
.item-block:last-of-type{margin-bottom:0}
.item-block:hover{border-color:#c7d2fe}
.ib-header{display:flex;justify-content:space-between;align-items:flex-start}
.ib-title{display:flex;flex-direction:column;gap:1px}
.ib-role{font-weight:600;font-size:13.5px}
.ib-sub{font-size:12px;color:var(--muted)}
.ib-actions{display:flex;gap:5px;flex-shrink:0}
.ib-edit-zone{display:none;margin-top:12px;padding-top:12px;border-top:1px solid var(--border)}
.edit-actions{display:flex;gap:7px;margin-top:10px}

/* ──────────── BULLETS ──────────── */
.bullets-zone{margin-top:10px;padding-top:10px;border-top:1px dashed #e5e7eb}
.bullets-label{font-size:10.5px;font-weight:600;text-transform:uppercase;letter-spacing:0.6px;color:var(--muted);margin-bottom:6px}
.bullets-ul{list-style:none;display:flex;flex-direction:column;gap:3px}
.bullet-li{display:flex;align-items:flex-start;gap:7px;padding:5px 8px;border-radius:5px;background:#fafafa;font-size:12px;min-height:30px}
.b-text{flex:1;line-height:1.5;padding-top:1px}
.b-actions{display:flex;gap:3px;flex-shrink:0;padding-top:1px}
.b-input{flex:1;border:1.5px solid var(--accent);border-radius:5px;padding:3px 8px;font-size:12px;font-family:'DM Sans',sans-serif;outline:none;display:none}
.b-edit-actions{display:none;gap:3px;flex-shrink:0;padding-top:1px}

/* ──────────── SIMPLE LIST ──────────── */
.simple-ul{list-style:none;display:flex;flex-direction:column;gap:4px}
.simple-li{display:flex;align-items:flex-start;gap:8px;padding:7px 10px;border-radius:7px;background:#fafafa;border:1px solid var(--border);font-size:13px}

/* ──────────── LANGUAGE LIST ──────────── */
.lang-ul{list-style:none;display:flex;flex-direction:column;gap:6px}
.lang-li{border:1px solid var(--border);border-radius:8px;padding:11px 14px}
.lang-row{display:flex;align-items:center;gap:10px}
.lang-name-lbl{font-size:13px;font-weight:500;min-width:85px}
.lang-dots-row{display:flex;gap:4px}
.d{width:10px;height:10px;border-radius:50%;background:#e5e7eb;border:1.5px solid #d1d5db}
.d.on{background:var(--accent);border-color:#2563eb}
.lang-pct-lbl{font-size:11px;color:var(--muted);min-width:34px}
.lang-edit-zone{display:none;margin-top:10px;padding-top:10px;border-top:1px solid var(--border)}
input[type=range]{-webkit-appearance:none;width:100%;height:4px;background:var(--border);border-radius:2px;outline:none;padding:0;border:none;cursor:pointer}
input[type=range]::-webkit-slider-thumb{-webkit-appearance:none;width:16px;height:16px;border-radius:50%;background:var(--accent);cursor:pointer}

/* ──────────── CERT LIST ──────────── */
.cert-ul{list-style:none;display:flex;flex-direction:column;gap:6px}
.cert-li{border:1px solid var(--border);border-radius:8px;padding:11px 14px}
.cert-row{display:flex;align-items:flex-start;justify-content:space-between;gap:10px}
.cert-info{flex:1}
.cert-name-lbl{font-size:13px;font-weight:500;line-height:1.4}
.cert-year-lbl{font-size:11px;color:var(--accent);margin-top:2px}
.cert-edit-zone{display:none;margin-top:10px;padding-top:10px;border-top:1px solid var(--border)}

/* ── Icon Picker ── */
.icon-picker-wrap{position:relative}
.icon-search-input{width:100%;padding:8px 12px 8px 36px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:'DM Sans',sans-serif;background:#fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E") no-repeat 10px center;transition:border-color 0.2s}
.icon-search-input:focus{outline:none;border-color:var(--accent)}
.icon-selected-preview{display:flex;align-items:center;gap:8px;padding:7px 12px;background:#eff6ff;border-radius:7px;margin-bottom:8px;font-size:12px;color:var(--accent)}
.icon-selected-preview i{font-size:16px}
.icon-grid-wrap{max-height:220px;overflow-y:auto;border:1.5px solid var(--border);border-radius:8px;background:#fff;margin-top:6px;display:grid;grid-template-columns:repeat(auto-fill,minmax(40px,1fr));gap:2px;padding:6px}
.icon-option{width:38px;height:38px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:15px;color:var(--muted);cursor:pointer;transition:all 0.15s;border:1.5px solid transparent;position:relative}
.icon-option:hover{background:#eff6ff;color:var(--accent);border-color:var(--accent)}
.icon-option.selected{background:var(--accent);color:#fff;border-color:var(--accent)}
.icon-option[title]:hover::after{content:attr(title);position:absolute;bottom:calc(100% + 4px);left:50%;transform:translateX(-50%);background:#1e293b;color:#fff;font-size:10px;padding:3px 7px;border-radius:5px;white-space:nowrap;pointer-events:none;z-index:100}
.icon-load-more{grid-column:1/-1;text-align:center;padding:8px;font-size:12px;color:var(--accent);cursor:pointer;font-weight:600;border-top:1px solid var(--border)}
.icon-load-more:hover{text-decoration:underline}

/* ══ SLIDE-IN EDIT PANEL ══ */
.edit-overlay{position:fixed;inset:0;background:rgba(15,23,42,0.45);z-index:900;opacity:0;pointer-events:none;transition:opacity 0.3s}
.edit-overlay.open{opacity:1;pointer-events:all}
.edit-panel{position:fixed;top:0;right:0;bottom:0;width:480px;max-width:95vw;background:#fff;z-index:901;display:flex;flex-direction:column;box-shadow:-8px 0 40px rgba(0,0,0,0.15);transform:translateX(100%);transition:transform 0.35s cubic-bezier(0.4,0,0.2,1)}
.edit-panel.open{transform:translateX(0)}
.ep-header{padding:20px 24px 18px;border-bottom:1px solid var(--border);display:flex;align-items:flex-start;justify-content:space-between;gap:12px;background:#fafafa;flex-shrink:0}
.ep-header-text{flex:1;min-width:0}
.ep-section-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:var(--accent);margin-bottom:3px}
.ep-title{font-size:16px;font-weight:700;color:var(--text);line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ep-close{width:32px;height:32px;border-radius:8px;border:1px solid var(--border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--muted);flex-shrink:0;transition:all 0.15s}
.ep-close:hover{background:#fee2e2;border-color:#fca5a5;color:#ef4444}
.ep-body{flex:1;overflow-y:auto;padding:24px;display:flex;flex-direction:column;gap:16px}
.ep-body .fg label{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:var(--muted);margin-bottom:5px;display:block}
.ep-body .fg input,.ep-body .fg textarea,.ep-body .fg select{width:100%;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:'DM Sans',sans-serif;color:var(--text);background:#fff;transition:border-color 0.2s,box-shadow 0.2s}
.ep-body .fg input:focus,.ep-body .fg textarea:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(59,130,246,0.1)}
.ep-hint{font-size:11px;color:var(--muted);margin-top:4px;display:flex;align-items:center;gap:4px}
.ep-divider{height:1px;background:var(--border);margin:4px 0}
.ep-footer{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;background:#fafafa;flex-shrink:0}
.ep-footer .btn-primary{flex:1;justify-content:center;padding:11px;font-size:14px}
.ep-footer .btn-cancel-soft{padding:11px 20px;font-size:14px}

/* ══ DELETE CONFIRM MODAL ══ */
.del-modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,0.55);z-index:1000;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity 0.2s}
.del-modal-overlay.open{opacity:1;pointer-events:all}
.del-modal{background:#fff;border-radius:16px;padding:28px;max-width:400px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.2);transform:scale(0.95);transition:transform 0.2s;text-align:center}
.del-modal-overlay.open .del-modal{transform:scale(1)}
.del-modal-icon{width:52px;height:52px;border-radius:50%;background:#fee2e2;display:flex;align-items:center;justify-content:center;color:#ef4444;font-size:22px;margin:0 auto 16px}
.del-modal h3{font-size:17px;font-weight:700;margin-bottom:8px;color:var(--text)}
.del-modal p{font-size:13px;color:var(--muted);margin-bottom:24px;line-height:1.6}
.del-modal p strong{color:var(--text)}
.del-modal-btns{display:flex;gap:10px;justify-content:center}
.btn-del-confirm{padding:10px 24px;background:#ef4444;color:#fff;border:none;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:600;cursor:pointer;transition:background 0.2s;display:flex;align-items:center;gap:7px}
.btn-del-confirm:hover{background:#dc2626}
.btn-del-cancel{padding:10px 24px;background:#fff;color:var(--text);border:1.5px solid var(--border);border-radius:8px;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;transition:all 0.2s}
.btn-del-cancel:hover{border-color:var(--accent);color:var(--accent)}

/* ══ ENHANCED TOAST ══ */
#toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(80px);background:#1e293b;color:#fff;padding:12px 18px;border-radius:12px;font-size:13px;font-weight:500;display:flex;align-items:center;gap:10px;box-shadow:0 8px 32px rgba(0,0,0,0.2);z-index:2000;transition:transform 0.3s ease;max-width:420px;white-space:nowrap}
#toast.show{transform:translateX(-50%) translateY(0)}
#toast.ok{background:#1e293b}
#toast.err{background:#991b1b}
#toast .toast-undo{padding:4px 12px;background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;color:#fff;white-space:nowrap;transition:background 0.15s;margin-left:4px}
#toast .toast-undo:hover{background:rgba(255,255,255,0.25)}
#toast .toast-close{margin-left:auto;cursor:pointer;opacity:0.6;font-size:14px;padding:2px 4px}
#toast .toast-close:hover{opacity:1}

@media(max-width:860px){.grid-2{grid-template-columns:1fr}}
/* ══ RESUME COLLECTION ══ */
.resume-collection-item {
    display:flex; align-items:center; justify-content:space-between;
    padding:16px 22px; border-bottom:1px solid var(--border);
    transition:background 0.15s; gap:16px;
}
.resume-collection-item:last-child { border-bottom:none; }
.resume-collection-item:hover { background:#f9fafb; }
.resume-collection-item.active { background:#f0fdf4; }
body.dark .resume-collection-item:hover  { background:#111827; }
body.dark .resume-collection-item.active { background:#0a1f14; }
.rci-left { display:flex; align-items:center; gap:14px; flex:1; min-width:0; }
.rci-status-dot {
    width:10px; height:10px; border-radius:50%;
    background:#d1d5db; flex-shrink:0;
    border:2px solid #e5e7eb;
}
.rci-status-dot.active {
    background:#10b981; border-color:#059669;
    box-shadow:0 0 0 3px rgba(16,185,129,0.2);
}
.rci-info { min-width:0; }
.rci-name { font-weight:600; font-size:14px; color:var(--text); }
body.dark .rci-name { color:#e2e8f0; }
.rci-meta { margin-top:2px; }
.rci-badge {
    font-size:11px; color:var(--muted);
    display:inline-flex; align-items:center; gap:4px;
}
.rci-badge.active { color:#10b981; font-weight:600; }
.rci-actions { display:flex; gap:6px; flex-shrink:0; align-items:center; flex-wrap:wrap; }
.rci-btn {
    display:inline-flex; align-items:center; gap:5px;
    padding:6px 12px; border-radius:6px; font-size:12px;
    font-weight:500; cursor:pointer; border:1.5px solid var(--border);
    background:#fff; color:var(--text); font-family:'DM Sans',sans-serif;
    transition:all 0.15s; white-space:nowrap;
}
body.dark .rci-btn { background:#111827; border-color:#1e2535; color:#94a3b8; }
.rci-btn:hover { border-color:var(--accent); color:var(--accent); }
.rci-btn.activate { border-color:#10b981; color:#10b981; background:#f0fdf4; }
body.dark .rci-btn.activate { background:#0a1f14; }
.rci-btn.activate:hover { background:#d1fae5; }
.rci-btn.delete { border-color:var(--border); color:var(--muted); }
.rci-btn.delete:hover { border-color:#ef4444; color:#ef4444; background:#fef2f2; }
.rci-btn.edit-btn { border-color:var(--accent); color:var(--accent); }
body.dark .rci-btn.edit-btn { background:rgba(59,130,246,0.1); }

/* Rename inline input */
.rci-name-input {
    font-weight:600; font-size:14px; border:1.5px solid var(--accent);
    border-radius:6px; padding:3px 8px; font-family:'DM Sans',sans-serif;
    outline:none; background:#fff; color:var(--text); width:220px;
}
body.dark .rci-name-input { background:#0f1117; color:#e2e8f0; }

/* ══ DARK MODE ══ */
body.dark {
  --bg:#0f1117; --sidebar:#080b12;
  --card:#161b27; --border:#1e2535;
  --text:#e2e8f0; --muted:#64748b;
  --shadow:0 1px 4px rgba(0,0,0,0.3);
}
body.dark .topbar           { background:#161b27; border-color:#1e2535; }
body.dark .card             { background:#161b27; border-color:#1e2535; }
body.dark .card-head        { background:#111827; border-color:#1e2535; }
body.dark .card-body        { background:#161b27; }
body.dark .fg input,
body.dark .fg textarea,
body.dark .fg select        { background:#0f1117; border-color:#1e2535; color:#e2e8f0; }
body.dark .fg input:focus,
body.dark .fg textarea:focus{ border-color:var(--accent); background:#0f1117; }
body.dark .fg label         { color:#64748b; }
body.dark .simple-li        { background:#111827; border-color:#1e2535; }
body.dark .bullet-li        { background:#111827; }
body.dark .item-block       { border-color:#1e2535; background:#161b27; }
body.dark .item-block:hover { border-color:#3b82f6; }
body.dark .lang-li,
body.dark .cert-li          { border-color:#1e2535; background:#161b27; }
body.dark .icon-btn         { background:#111827; border-color:#1e2535; color:#64748b; }
body.dark .icon-btn.edit:hover { background:rgba(59,130,246,0.1); }
body.dark .icon-btn.del:hover  { background:rgba(239,68,68,0.1); }
body.dark .btn-cancel-soft  { background:#1e2535; color:#94a3b8; }
body.dark .btn-cancel-soft:hover { background:#263147; }
body.dark .user-chip        { background:#111827; border-color:#1e2535; color:#94a3b8; }
body.dark .btn-sm-outline   { background:#111827; border-color:#1e2535; color:#94a3b8; }
body.dark .btn-sm-outline:hover { border-color:var(--accent); color:var(--accent); }
body.dark .sb-label         { color:rgba(99,102,241,0.4); }
body.dark .edit-panel       { background:#161b27; }
body.dark .ep-header        { background:#111827; border-color:#1e2535; }
body.dark .ep-footer        { background:#111827; border-color:#1e2535; }
body.dark .ep-body .fg input,
body.dark .ep-body .fg textarea,
body.dark .ep-body .fg select { background:#0f1117; border-color:#1e2535; color:#e2e8f0; }
body.dark .ep-divider       { background:#1e2535; }
body.dark .ep-hint          { color:#475569; }
body.dark .ep-section-label { color:#60a5fa; }
body.dark .ep-title         { color:#e2e8f0; }
body.dark .ep-close         { background:#111827; border-color:#1e2535; color:#64748b; }
body.dark .ep-close:hover   { background:#2d1b1b; border-color:#991b1b; color:#ef4444; }
body.dark .icon-selected-preview { background:rgba(59,130,246,0.1); }
body.dark .icon-search-input { background:#0f1117; border-color:#1e2535; color:#e2e8f0; }
body.dark .icon-grid-wrap   { background:#0f1117; border-color:#1e2535; }
body.dark .icon-option      { color:#64748b; }
body.dark .icon-option:hover { background:rgba(59,130,246,0.15); color:var(--accent); }
body.dark .bullets-zone     { border-color:#1e2535; }
body.dark .bullets-label    { color:#475569; }
body.dark .b-input          { background:#0f1117; color:#e2e8f0; }
body.dark .date-row select,
body.dark .date-row input   { background:#0f1117; border-color:#1e2535; color:#e2e8f0; }
body.dark .check-row        { color:#94a3b8; }
body.dark .ib-role          { color:#e2e8f0; }
body.dark .ib-sub           { color:#64748b; }
body.dark .cert-name-lbl    { color:#e2e8f0; }
body.dark .lang-name-lbl    { color:#e2e8f0; }
body.dark .sb-brand         { border-color:rgba(99,102,241,0.1); }
body.dark .sb-footer        { border-color:rgba(99,102,241,0.1); }
body.dark [style*="background:#f9fafb"],
body.dark [style*="background: #f9fafb"] { background:#111827 !important; }
body.dark [style*="background:#fafafa"]  { background:#111827 !important; }

/* Dark mode toggle button */
.dark-toggle {
    width:36px; height:36px; border-radius:8px;
    border:1.5px solid var(--border); background:transparent;
    cursor:pointer; display:flex; align-items:center;
    justify-content:center; font-size:15px; color:var(--muted);
    transition:all 0.2s; flex-shrink:0;
}
.dark-toggle:hover { border-color:var(--accent); color:var(--accent); }
body.dark .dark-toggle { background:#111827; border-color:#1e2535; color:#fbbf24; }
body.dark .dark-toggle:hover { border-color:#fbbf24; }

/* ══ LOGOUT MODAL ══ */
.logout-modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity 0.15s}
.logout-modal-overlay.open{opacity:1;pointer-events:all}
.logout-modal{background:#1e293b;border-radius:8px;padding:22px 24px 18px;min-width:300px;max-width:360px;width:90%;box-shadow:0 8px 32px rgba(0,0,0,0.4);transform:translateY(-4px);transition:transform 0.15s}
.logout-modal-overlay.open .logout-modal{transform:translateY(0)}
.logout-modal-title{font-size:13px;font-weight:600;color:#fff;margin-bottom:8px}
.logout-modal-msg{font-size:13px;color:#94a3b8;margin-bottom:20px;line-height:1.5}
.logout-modal-btns{display:flex;gap:8px;justify-content:flex-end}
.logout-btn-cancel{padding:7px 18px;background:#334155;color:#cbd5e1;border:none;border-radius:5px;font-family:'DM Sans',sans-serif;font-size:13px;font-weight:500;cursor:pointer;transition:background 0.15s}
.logout-btn-cancel:hover{background:#475569}
.logout-btn-confirm{padding:7px 18px;background:#3b82f6;color:#fff;border:none;border-radius:5px;font-size:13px;font-weight:500;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;font-family:'DM Sans',sans-serif;transition:background 0.15s}
.logout-btn-confirm:hover{background:#2563eb}

</style>
</head>
<body>

<!-- Toast -->
<div id="toast"></div>

<!-- Edit Panel Overlay -->
<div class="edit-overlay" id="editOverlay" onclick="closeEditPanel()"></div>

<!-- Slide-in Edit Panel -->
<div class="edit-panel" id="editPanel">
    <div class="ep-header">
        <div class="ep-header-text">
            <div class="ep-section-label" id="ep-section-label">Editing</div>
            <div class="ep-title" id="ep-title">—</div>
        </div>
        <button class="ep-close" onclick="closeEditPanel()"><i class="fas fa-times"></i></button>
    </div>
    <div class="ep-body" id="ep-body"></div>
    <div class="ep-footer">
        <button class="btn-cancel-soft" onclick="closeEditPanel()"><i class="fas fa-times"></i> Cancel</button>
        <button class="btn-primary" id="ep-save-btn"><i class="fas fa-check"></i> Save Changes</button>
    </div>
</div>

<!-- Delete Confirm Modal -->
<div class="del-modal-overlay" id="delModal">
    <div class="del-modal">
        <div class="del-modal-icon"><i class="fas fa-trash-alt"></i></div>
        <h3>Delete this item?</h3>
        <p id="del-modal-msg">This action <strong>cannot be undone</strong>.</p>
        <div class="del-modal-btns">
            <button class="btn-del-cancel" onclick="closeDelModal()">Cancel</button>
            <button class="btn-del-confirm" id="del-confirm-btn"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</div>

<div class="layout">

  <!-- ══ SIDEBAR ══ -->
  <aside class="sidebar">
    <div class="sb-brand">
      <div class="sb-icon"><i class="fas fa-file-alt"></i></div>
      <div class="sb-title">Resume CI4<span>Admin Dashboard</span></div>
    </div>
    <nav class="sb-nav">
      <div class="sb-label">Resumes</div>
      <a class="nav-link" onclick="scrollToCard('c-resume-collection')"><i class="fas fa-layer-group"></i>Resume Collection</a>
      <div class="sb-label">Portfolio</div>
      <a class="nav-link" href="<?= base_url('admin/projects') ?>"><i class="fas fa-briefcase"></i>Featured Work</a>
      <div class="sb-label">About Me Page</div>
      <a class="nav-link" onclick="scrollToCard('c-about')"><i class="fas fa-user-circle"></i>About Info</a>
      <a class="nav-link" onclick="scrollToCard('c-services')"><i class="fas fa-th-large"></i>What I Do</a>
      <a class="nav-link" onclick="scrollToCard('c-testimonials')"><i class="fas fa-comment-dots"></i>Testimonials</a>
      <div class="sb-label">Resume Sections</div>
      <a class="nav-link active" onclick="scrollToCard('c-header')"><i class="fas fa-id-card"></i>Header &amp; Contacts</a>
      <a class="nav-link" onclick="scrollToCard('c-summary')"><i class="fas fa-align-left"></i>Summary</a>
      <a class="nav-link" onclick="scrollToCard('c-history')"><i class="fas fa-briefcase"></i>Work History</a>
      <a class="nav-link" onclick="scrollToCard('c-skills')"><i class="fas fa-star"></i>Personal Skills</a>
      <a class="nav-link" onclick="scrollToCard('c-tech')"><i class="fas fa-code"></i>Tech Stack</a>
      <a class="nav-link" onclick="scrollToCard('c-languages')"><i class="fas fa-globe"></i>Languages</a>
      <a class="nav-link" onclick="scrollToCard('c-education')"><i class="fas fa-graduation-cap"></i>Education</a>
      <a class="nav-link" onclick="scrollToCard('c-certs')"><i class="fas fa-certificate"></i>Certifications</a>
      <div class="sb-label">Settings</div>
      <a class="nav-link" onclick="scrollToCard('c-account')"><i class="fas fa-key"></i>Account</a>
    </nav>
    <div class="sb-footer">
      <a href="<?= base_url() ?>" target="_blank" class="btn-preview"><i class="fas fa-eye"></i> View Portfolio</a>
      <a href="#" onclick="confirmLogout(event)" class="btn-signout"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
    </div>
  </aside>

  <!-- ══ MAIN ══ -->
  <main class="main">
    <div class="topbar">
      <div class="topbar-title">
        <i class="fas fa-sliders-h"></i> Resume Management
        <?php if(($editingResumeId??1) != (new App\Models\ResumeCollectionModel())->getActiveId()): ?>
        <span style="font-size:11px;font-weight:400;background:#dbeafe;color:#1d4ed8;padding:3px 10px;border-radius:20px;margin-left:10px">
            <i class="fas fa-edit"></i> Editing: <?= esc(array_values(array_filter($resumes,fn($r)=>$r['id']==($editingResumeId??1)))[0]['name']??'') ?>
        </span>
        <?php endif; ?>
      </div>
      <div class="topbar-right">
        <button class="dark-toggle" onclick="toggleDark()" id="darkToggleBtn" title="Toggle dark mode">
            <i class="fas fa-moon" id="darkToggleIcon"></i>
        </button>
        <div class="user-chip"><i class="fas fa-user-circle"></i><?= esc($adminUsername ?? 'admin') ?></div>
        <a href="<?= base_url() ?>" target="_blank" class="btn-sm-outline"><i class="fas fa-external-link-alt"></i> Preview</a>
      </div>
    </div>

    <div class="content">


      <!-- ══ RESUME COLLECTION ══ -->
      <div class="card" id="c-resume-collection">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-layer-group"></i></div>
          <div class="card-head-text">
            <h2>Resume Collection</h2>
            <p>Manage multiple resumes. The <span style="color:var(--success);font-weight:600">active</span> one is shown on your portfolio.</p>
          </div>
          <button class="btn-primary" style="margin-left:auto;flex-shrink:0" onclick="openNewResumePanel()">
            <i class="fas fa-plus"></i> New Resume
          </button>
        </div>
        <div class="card-body" style="padding:0">
          <div id="resume-collection-list">
            <?php foreach($resumes as $rv): ?>
            <div class="resume-collection-item <?= $rv['is_active']?'active':'' ?>" data-id="<?= $rv['id'] ?>">
              <div class="rci-left">
                <div class="rci-status-dot <?= $rv['is_active']?'active':'' ?>"></div>
                <div class="rci-info">
                  <div class="rci-name" id="rci-name-<?= $rv['id'] ?>"><?= esc($rv['name']) ?></div>
                  <div class="rci-meta">
                    <?= $rv['is_active'] ? '<span class="rci-badge active">● Active — shown on portfolio</span>' : '<span class="rci-badge">Not active</span>' ?>
                  </div>
                </div>
              </div>
              <div class="rci-actions">
                <?php if(!$rv['is_active']): ?>
                <button class="rci-btn activate" onclick="setActiveResume(<?= $rv['id'] ?>)" title="Set as active">
                  <i class="fas fa-check-circle"></i> Set Active
                </button>
                <?php endif; ?>
                <button class="rci-btn edit-btn" onclick="openResumePanel(<?= $rv['id'] ?>, '<?= esc(addslashes($rv['name'])) ?>')" title="Edit resume content">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <button class="rci-btn clone" onclick="cloneResume(<?= $rv['id'] ?>, '<?= esc(addslashes($rv['name'])) ?>')" title="Clone this resume">
                  <i class="fas fa-copy"></i> Clone
                </button>
                <button class="rci-btn rename" onclick="openRenameResume(<?= $rv['id'] ?>, '<?= esc(addslashes($rv['name'])) ?>')" title="Rename">
                  <i class="fas fa-pen"></i>
                </button>
                <?php if(!$rv['is_active']): ?>
                <button class="rci-btn delete" onclick="deleteResume(<?= $rv['id'] ?>, '<?= esc(addslashes($rv['name'])) ?>')" title="Delete">
                  <i class="fas fa-trash"></i>
                </button>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- ══ ABOUT ME INFO ══ -->
      <div class="card" id="c-about">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-user-circle"></i></div>
          <div class="card-head-text"><h2>About Me — Portfolio Page</h2><p>Hero section: tagline, bio, photo, buttons, and social links.</p></div>
        </div>
        <div class="card-body">

          <!-- Photo Upload + Position -->
          <div style="margin-bottom:20px;padding:16px;background:#f9fafb;border-radius:10px;border:1px solid var(--border)">
            <div style="display:flex;align-items:center;gap:20px;margin-bottom:16px">
              <div id="photo-preview" style="width:80px;height:80px;border-radius:50%;overflow:hidden;background:#e5e7eb;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:28px;flex-shrink:0;border:2px solid var(--accent)">
                <?php if(!empty($about['photo'])): ?>
                <img src="<?= base_url(esc($about['photo'])) ?>" id="pos-preview-img"
                     style="width:100%;height:100%;object-fit:cover;object-position:<?= esc($about['photo_position'] ?? '50% 50%') ?>" alt="preview">
                <?php else: ?>
                <i class="fas fa-user"></i>
                <?php endif; ?>
              </div>
              <div>
                <div style="font-weight:600;font-size:13px;margin-bottom:4px">Profile Photo</div>
                <div style="font-size:12px;color:var(--muted);margin-bottom:10px">JPG, PNG or WEBP · Max 5MB</div>
                <label style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;background:var(--accent);color:#fff;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer">
                  <i class="fas fa-upload"></i> Upload Photo
                  <input type="file" accept="image/*" onchange="uploadPhoto(this)" style="display:none">
                </label>
              </div>
            </div>
            <div style="border-top:1px solid var(--border);margin-bottom:14px"></div>
            <div style="font-size:12px;font-weight:600;margin-bottom:10px;color:var(--text);display:flex;align-items:center;gap:6px">
              <i class="fas fa-arrows-alt" style="color:var(--accent)"></i> Photo Position
              <span style="font-weight:400;color:var(--muted);font-size:11px">— drag to reposition</span>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
              <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px">
                  <label style="font-size:11px;color:var(--muted)">⟵ Horizontal ⟶</label>
                  <span id="pos-x-label" style="font-size:11px;color:var(--accent);font-weight:700">50%</span>
                </div>
                <input type="range" id="pos-x" min="0" max="100" value="50" style="width:100%;accent-color:var(--accent)" oninput="updatePhotoPosition()">
              </div>
              <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:5px">
                  <label style="font-size:11px;color:var(--muted)">↑ Vertical ↓</label>
                  <span id="pos-y-label" style="font-size:11px;color:var(--accent);font-weight:700">50%</span>
                </div>
                <input type="range" id="pos-y" min="0" max="100" value="50" style="width:100%;accent-color:var(--accent)" oninput="updatePhotoPosition()">
              </div>
            </div>
            <div style="margin-top:8px;font-size:11px;color:var(--muted);text-align:right">
              Position: <span id="pos-display" style="color:var(--accent);font-weight:600"><?= esc($about['photo_position'] ?? '50% 50%') ?></span>
            </div>
          </div>

          <div class="grid-2">
            <div class="fg"><label>Professional Tagline</label><input type="text" id="ab-tagline" value="<?= esc($about['tagline']??'') ?>" placeholder="e.g. Frontend Developer"></div>
            <div class="fg"><label>Contact Button Email</label><input type="email" id="ab-contact-email" value="<?= esc($about['btn_contact_email']??'') ?>" placeholder="your@email.com"></div>
            <div class="fg"><label>CV / Resume Button Label</label><input type="text" id="ab-cv-label" value="<?= esc($about['cv_label']??'Download CV') ?>" placeholder="Download CV"></div>
            <div class="fg"><label>Contact Button Label</label><input type="text" id="ab-contact-label" value="<?= esc($about['btn_contact_label']??'Contact') ?>" placeholder="Contact"></div>
          </div>
          <div class="fg" style="margin-bottom:14px">
            <label>Bio / Introduction</label>
            <textarea id="ab-bio" rows="4" placeholder="Write your personal introduction..."><?= esc($about['bio']??'') ?></textarea>
          </div>
          <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:10px">Social Links (optional)</div>
          <div class="grid-2">
            <div class="fg"><label><i class="fab fa-github" style="color:#333"></i> GitHub URL</label><input type="url" id="ab-github" value="<?= esc($about['github']??'') ?>" placeholder="https://github.com/you"></div>
            <div class="fg"><label><i class="fab fa-linkedin" style="color:#0077b5"></i> LinkedIn URL</label><input type="url" id="ab-linkedin" value="<?= esc($about['linkedin_url']??'') ?>" placeholder="https://linkedin.com/in/you"></div>
            <div class="fg"><label><i class="fab fa-x-twitter"></i> Twitter/X URL</label><input type="url" id="ab-twitter" value="<?= esc($about['twitter']??'') ?>" placeholder="https://twitter.com/you"></div>
            <div class="fg"><label><i class="fab fa-facebook" style="color:#1877f2"></i> Facebook URL</label><input type="url" id="ab-facebook" value="<?= esc($about['facebook']??'') ?>" placeholder="https://facebook.com/you"></div>
          </div>
          <button class="btn-primary" onclick="saveAbout()"><i class="fas fa-save"></i> Save About Info</button>
        </div>
      </div>

      <!-- ══ WHAT I DO SERVICES ══ -->
      <div class="card" id="c-services">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-th-large"></i></div>
          <div class="card-head-text"><h2>What I Do — Services</h2><p>Service cards shown in the "What I Do" section.</p></div>
        </div>
        <div class="card-body">
          <ul class="cert-ul" id="services-list">
            <?php foreach($services as $svc): ?>
            <li class="cert-li" data-id="<?= $svc['id'] ?>">
              <div class="cert-row">
                <div class="cert-info" style="display:flex;align-items:center;gap:12px">
                  <div style="width:36px;height:36px;border-radius:8px;background:#eff6ff;display:flex;align-items:center;justify-content:center;color:#3b82f6;font-size:16px;flex-shrink:0">
                    <i class="<?= esc($svc['icon']) ?>"></i>
                  </div>
                  <div>
                    <div class="cert-name-lbl"><?= esc($svc['title']) ?></div>
                    <div class="cert-year-lbl" style="color:var(--muted)"><?= esc(mb_substr($svc['description'],0,60)).(strlen($svc['description'])>60?'…':'') ?></div>
                  </div>
                </div>
                <div class="b-actions">
                  <button class="icon-btn edit" onclick="openSvcEdit(this)"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="delSvc(<?= $svc['id'] ?>, this)"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <!-- Hidden data fields for panel to read -->
              <input type="hidden" name="svc-icon"  value="<?= esc($svc['icon']) ?>">
              <input type="hidden" name="svc-title" value="<?= esc($svc['title']) ?>">
              <textarea name="svc-desc" style="display:none"><?= esc($svc['description']) ?></textarea>
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-item" onclick="addSvc()"><i class="fas fa-plus"></i> Add Service</button>
        </div>
      </div>

      <!-- ══ TESTIMONIALS ══ -->
      <div class="card" id="c-testimonials">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-comment-dots"></i></div>
          <div class="card-head-text"><h2>Testimonials</h2><p>Client or colleague testimonials.</p></div>
        </div>
        <div class="card-body">
          <ul class="cert-ul" id="testimonials-list">
            <?php foreach($testimonials as $t): ?>
            <li class="cert-li" data-id="<?= $t['id'] ?>">
              <div class="cert-row">
                <div class="cert-info">
                  <div class="cert-name-lbl"><?= esc($t['author']) ?> <span style="color:var(--muted);font-weight:400">— <?= esc($t['role']) ?></span></div>
                  <div class="cert-year-lbl" style="color:var(--muted)"><?= esc(mb_substr($t['quote'],0,70)).(strlen($t['quote'])>70?'…':'') ?></div>
                </div>
                <div class="b-actions">
                  <button class="icon-btn edit" onclick="openTestiEdit(this)"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="delTesti(<?= $t['id'] ?>, this)"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <input type="hidden" name="t-author" value="<?= esc($t['author']) ?>">
              <input type="hidden" name="t-role"   value="<?= esc($t['role']) ?>">
              <textarea name="t-quote" style="display:none"><?= esc($t['quote']) ?></textarea>
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-item" onclick="addTesti()"><i class="fas fa-plus"></i> Add Testimonial</button>
        </div>
      </div>

      <!-- ══ HEADER ══ -->
      <div class="card" id="c-header">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-id-card"></i></div>
          <div class="card-head-text"><h2>Header &amp; Contacts</h2><p>Name, position and contact details on the resume.</p></div>
        </div>
        <div class="card-body">
          <div class="grid-2">
            <div class="fg"><label>Full Name</label><input type="text" id="h-name" value="<?= esc($header['name'] ?? '') ?>" placeholder="Your full name"></div>
            <div class="fg"><label>Position / Title</label><input type="text" id="h-position" value="<?= esc($header['position']??'') ?>" placeholder="e.g. Web Developer"></div>
            <div class="fg"><label>Email</label><input type="email" id="h-email" value="<?= esc($header['email']??'') ?>" placeholder="email@example.com"></div>
            <div class="fg"><label>Phone</label><input type="text" id="h-phone" value="<?= esc($header['phone']??'') ?>" placeholder="555-0000"></div>
            <div class="fg"><label>Location</label><input type="text" id="h-location" value="<?= esc($header['location']??'') ?>" placeholder="City, State, Country"></div>
            <div class="fg"><label>LinkedIn</label><input type="text" id="h-linkedin" value="<?= esc($header['linkedin']??'') ?>" placeholder="linkedin.com/in/you"></div>
            <div class="fg"><label>Portfolio URL <span style="font-size:11px;color:var(--muted);font-weight:400;text-transform:none">(shows in resume — make it clickable)</span></label><input type="text" id="h-portfolio-url" value="<?= esc($header['portfolio_url']??'') ?>" placeholder="https://evarsanglitan.up.railway.app"></div>
              </div>

              <!-- Show photo on resume toggle -->
              <label style="display:flex;align-items:center;gap:10px;font-size:13px;cursor:pointer;padding:12px 14px;background:#f9fafb;border-radius:8px;border:1.5px solid var(--border);margin-bottom:14px">
                <input type="checkbox" id="h-show-photo" <?= !empty($header['show_photo']) ? 'checked' : '' ?> style="width:16px;height:16px;accent-color:var(--accent)">
                <div>
                  <div style="font-weight:500;color:var(--text)">Show photo on resume</div>
                  <div style="font-size:11px;color:var(--muted);margin-top:2px">Uses your About Me photo. When off, the photo won't appear in either resume format.</div>
                </div>
              </label>
           <button class="btn-primary" onclick="saveHeader()"><i class="fas fa-save"></i> Save Header</button>
        </div>
      </div>

      <!-- ══ SUMMARY ══ -->
      <div class="card" id="c-summary">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-align-left"></i></div>
          <div class="card-head-text"><h2>Summary</h2><p>One paragraph shown at the top of the left column.</p></div>
        </div>
        <div class="card-body">
          <div class="fg" style="margin-bottom:14px">
            <label>Summary Paragraph</label>
            <textarea id="summary-content" rows="4" placeholder="Write a brief professional summary..."><?= esc($summary['content']??'') ?></textarea>
          </div>
          <button class="btn-primary" onclick="saveSummary()"><i class="fas fa-save"></i> Save Summary</button>
        </div>
      </div>

      <!-- ══ WORK HISTORY ══ -->
      <div class="card" id="c-history">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-briefcase"></i></div>
          <div class="card-head-text"><h2>Work History</h2><p>Work experiences with bullet points.</p></div>
        </div>
        <div class="card-body">
          <div id="history-list">
            <?php foreach ($history as $job): ?>
            <div class="item-block" data-id="<?= $job['id'] ?>">
              <div class="ib-header">
                <div class="ib-title">
                  <span class="ib-role"><?= esc($job['role']) ?></span>
                  <span class="ib-sub"><?= esc($job['company']) ?> &middot; <?= esc($job['start_month']).' '.esc($job['start_year']) ?> – <?= $job['is_current'] ? 'Present' : esc($job['end_month']).' '.esc($job['end_year']) ?></span>
                </div>
                <div class="ib-actions">
                  <button class="icon-btn edit" onclick="openHistoryEdit(this)" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="deleteHistory(<?= $job['id'] ?>, this)" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <!-- Hidden data for panel -->
              <input type="hidden" name="job-role"        value="<?= esc($job['role']) ?>">
              <input type="hidden" name="job-company"     value="<?= esc($job['company']) ?>">
              <input type="hidden" name="job-start-month" value="<?= esc($job['start_month']) ?>">
              <input type="hidden" name="job-start-year"  value="<?= esc($job['start_year']) ?>">
              <input type="hidden" name="job-end-month"   value="<?= esc($job['end_month']) ?>">
              <input type="hidden" name="job-end-year"    value="<?= esc($job['end_year']) ?>">
              <input type="hidden" name="job-is-current"  value="<?= $job['is_current'] ? '1' : '0' ?>">
              <div class="bullets-zone" style="display:none">
                <div class="bullets-label">Bullet Points</div>
                <ul class="bullets-ul" id="hb-<?= $job['id'] ?>">
                  <?php foreach ($job['bullets'] as $b): ?>
                  <li class="bullet-li" data-id="<?= $b['id'] ?>">
                    <span class="b-text"><?= esc($b['content']) ?></span>
                    <div class="b-actions">
                      <button class="icon-btn edit" onclick="editBullet(this)"><i class="fas fa-pencil-alt"></i></button>
                      <button class="icon-btn del" onclick="delBullet(<?= $b['id'] ?>, 'history-bullet', this)"><i class="fas fa-trash"></i></button>
                    </div>
                    <input class="b-input" type="text" value="<?= esc($b['content']) ?>">
                    <div class="b-edit-actions">
                      <button class="xs-btn ok" onclick="saveBullet(<?= $b['id'] ?>, 'history-bullet', this)"><i class="fas fa-check"></i></button>
                      <button class="xs-btn cancel" onclick="cancelBullet(this)"><i class="fas fa-times"></i></button>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
                <button class="btn-add-bullet" onclick="addBullet(<?= $job['id'] ?>, 'history')"><i class="fas fa-plus"></i> Add Bullet</button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <button class="btn-add-item" onclick="addHistory()"><i class="fas fa-plus"></i> Add Work Experience</button>
        </div>
      </div>

      <!-- ══ PERSONAL SKILLS ══ -->
      <div class="card" id="c-skills">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-star"></i></div>
          <div class="card-head-text"><h2>Personal Skills</h2><p>Bullet-point list of personal competencies.</p></div>
        </div>
        <div class="card-body">
          <ul class="simple-ul" id="skills-list">
            <?php foreach ($skills as $s): ?>
            <li class="simple-li" data-id="<?= $s['id'] ?>">
              <span class="b-text"><?= esc($s['content']) ?></span>
              <div class="b-actions">
                <button class="icon-btn edit" onclick="openSkillEdit(this, <?= $s['id'] ?>)"><i class="fas fa-pencil-alt"></i></button>
                <button class="icon-btn del" onclick="delSimple('skill', <?= $s['id'] ?>, this)"><i class="fas fa-trash"></i></button>
              </div>
              <input class="b-input" type="text" value="<?= esc($s['content']) ?>">
              <div class="b-edit-actions">
                <button class="xs-btn ok" onclick="saveSimple('skill', <?= $s['id'] ?>, this)"><i class="fas fa-check"></i></button>
                <button class="xs-btn cancel" onclick="cancelBullet(this)"><i class="fas fa-times"></i></button>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-bullet" style="margin-top:10px" onclick="addSimple('skill','New skill')"><i class="fas fa-plus"></i> Add Skill</button>
        </div>
      </div>

      <!-- ══ TECH STACK ══ -->
      <div class="card" id="c-tech">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-code"></i></div>
          <div class="card-head-text"><h2>Stack of Technologies</h2><p>Technologies shown in the right column.</p></div>
        </div>
        <div class="card-body">
          <ul class="simple-ul" id="tech-list">
            <?php foreach ($tech as $t): ?>
            <li class="simple-li" data-id="<?= $t['id'] ?>">
              <span class="b-text"><?= esc($t['content']) ?></span>
              <div class="b-actions">
                <button class="icon-btn edit" onclick="openTechEdit(this, <?= $t['id'] ?>)"><i class="fas fa-pencil-alt"></i></button>
                <button class="icon-btn del" onclick="delSimple('tech', <?= $t['id'] ?>, this)"><i class="fas fa-trash"></i></button>
              </div>
              <input class="b-input" type="text" value="<?= esc($t['content']) ?>">
              <div class="b-edit-actions">
                <button class="xs-btn ok" onclick="saveSimple('tech', <?= $t['id'] ?>, this)"><i class="fas fa-check"></i></button>
                <button class="xs-btn cancel" onclick="cancelBullet(this)"><i class="fas fa-times"></i></button>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-bullet" style="margin-top:10px" onclick="addSimple('tech','New technology')"><i class="fas fa-plus"></i> Add Technology</button>
        </div>
      </div>

      <!-- ══ LANGUAGES ══ -->
      <div class="card" id="c-languages">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-globe"></i></div>
          <div class="card-head-text"><h2>Languages</h2><p>Each language has a mastery percentage shown as 5 dots.</p></div>
        </div>
        <div class="card-body">
          <ul class="lang-ul" id="lang-list">
            <?php foreach ($languages as $lang): ?>
            <li class="lang-li" data-id="<?= $lang['id'] ?>">
              <div class="lang-row">
                <span class="lang-name-lbl"><?= esc($lang['language']) ?></span>
                <div class="lang-dots-row">
                  <?php for ($i=1;$i<=5;$i++): ?>
                  <span class="d <?= ($lang['mastery']/20)>=$i?'on':'' ?>"></span>
                  <?php endfor; ?>
                </div>
                <span class="lang-pct-lbl"><?= $lang['mastery'] ?>%</span>
                <div class="b-actions" style="margin-left:auto">
                  <button class="icon-btn edit" onclick="openLangEditPanel(this)"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="delLang(<?= $lang['id'] ?>, this)"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <input type="hidden" name="lang-name"    value="<?= esc($lang['language']) ?>">
              <input type="hidden" name="lang-mastery" value="<?= esc($lang['mastery']) ?>">
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-item" onclick="addLang()"><i class="fas fa-plus"></i> Add Language</button>
        </div>
      </div>

      <!-- ══ EDUCATION ══ -->
      <div class="card" id="c-education">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-graduation-cap"></i></div>
          <div class="card-head-text"><h2>Education</h2><p>Academic records with optional bullet points.</p></div>
        </div>
        <div class="card-body">
          <div id="edu-list">
            <?php foreach ($education as $edu): ?>
            <div class="item-block" data-id="<?= $edu['id'] ?>">
              <div class="ib-header">
                <div class="ib-title">
                  <span class="ib-role"><?= esc($edu['degree']) ?></span>
                  <span class="ib-sub"><?= esc($edu['school']) ?> &middot; <?= esc($edu['start_month']).' '.esc($edu['start_year']) ?> – <?= esc($edu['end_month']).' '.esc($edu['end_year']) ?></span>
                </div>
                <div class="ib-actions">
                  <button class="icon-btn edit" onclick="openEduEdit(this)"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="deleteEdu(<?= $edu['id'] ?>, this)"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <!-- Hidden data for panel -->
              <input type="hidden" name="edu-degree"      value="<?= esc($edu['degree']) ?>">
              <input type="hidden" name="edu-school"      value="<?= esc($edu['school']) ?>">
              <input type="hidden" name="edu-start-month" value="<?= esc($edu['start_month']) ?>">
              <input type="hidden" name="edu-start-year"  value="<?= esc($edu['start_year']) ?>">
              <input type="hidden" name="edu-end-month"   value="<?= esc($edu['end_month']) ?>">
              <input type="hidden" name="edu-end-year"    value="<?= esc($edu['end_year']) ?>">
              <div class="bullets-zone" style="display:none">
                <div class="bullets-label">Details</div>
                <ul class="bullets-ul" id="eb-<?= $edu['id'] ?>">
                  <?php foreach ($edu['bullets'] as $b): ?>
                  <li class="bullet-li" data-id="<?= $b['id'] ?>">
                    <span class="b-text"><?= esc($b['content']) ?></span>
                    <div class="b-actions">
                      <button class="icon-btn edit" onclick="editBullet(this)"><i class="fas fa-pencil-alt"></i></button>
                      <button class="icon-btn del" onclick="delBullet(<?= $b['id'] ?>, 'education-bullet', this)"><i class="fas fa-trash"></i></button>
                    </div>
                    <input class="b-input" type="text" value="<?= esc($b['content']) ?>">
                    <div class="b-edit-actions">
                      <button class="xs-btn ok" onclick="saveBullet(<?= $b['id'] ?>, 'education-bullet', this)"><i class="fas fa-check"></i></button>
                      <button class="xs-btn cancel" onclick="cancelBullet(this)"><i class="fas fa-times"></i></button>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
                <button class="btn-add-bullet" onclick="addBullet(<?= $edu['id'] ?>, 'education')"><i class="fas fa-plus"></i> Add Detail</button>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <button class="btn-add-item" onclick="addEdu()"><i class="fas fa-plus"></i> Add Education</button>
        </div>
      </div>

      <!-- ══ CERTIFICATIONS ══ -->
      <div class="card" id="c-certs">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-certificate"></i></div>
          <div class="card-head-text"><h2>Certifications</h2><p>Professional certifications with name and year.</p></div>
        </div>
        <div class="card-body">
          <ul class="cert-ul" id="certs-list">
            <?php foreach ($certifications as $cert): ?>
            <li class="cert-li" data-id="<?= $cert['id'] ?>">
              <div class="cert-row">
                <div class="cert-info">
                  <div class="cert-name-lbl"><?= esc($cert['name']) ?></div>
                  <div class="cert-year-lbl"><?= esc($cert['year']) ?></div>
                </div>
                <div class="b-actions">
                  <button class="icon-btn edit" onclick="openCertEdit(this)"><i class="fas fa-pencil-alt"></i></button>
                  <button class="icon-btn del" onclick="delCert(<?= $cert['id'] ?>, this)"><i class="fas fa-trash"></i></button>
                </div>
              </div>
              <input type="hidden" name="cert-name" value="<?= esc($cert['name']) ?>">
              <input type="hidden" name="cert-year" value="<?= esc($cert['year']) ?>">
            </li>
            <?php endforeach; ?>
          </ul>
          <button class="btn-add-item" onclick="addCert()"><i class="fas fa-plus"></i> Add Certification</button>
        </div>
      </div>

      <!-- ══ ACCOUNT ══ -->
      <div class="card" id="c-account">
        <div class="card-head">
          <div class="card-head-icon"><i class="fas fa-key"></i></div>
          <div class="card-head-text"><h2>Account Settings</h2><p>Change your admin login password.</p></div>
        </div>
        <div class="card-body">
          <div class="grid-1" style="max-width:400px">
            <div class="fg"><label>Current Password</label><input type="password" id="pw-cur" placeholder="Current password" autocomplete="current-password"></div>
            <div class="fg"><label>New Password</label><input type="password" id="pw-new" placeholder="New password (min. 6 chars)" autocomplete="new-password"></div>
            <div class="fg"><label>Confirm New Password</label><input type="password" id="pw-conf" placeholder="Repeat new password" autocomplete="new-password"></div>
          </div>
          <button class="btn-primary" onclick="changePw()"><i class="fas fa-save"></i> Update Password</button>
        </div>
      </div>

    </div><!-- /content -->
  </main>
</div>


<!-- Logout Confirm Modal -->
<div class="logout-modal-overlay" id="logoutModal">
    <div class="logout-modal">
        <div class="logout-modal-title">Sign Out</div>
        <p class="logout-modal-msg">Are you sure you want to logout?</p>
        <div class="logout-modal-btns">
            <button class="logout-btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <a href="<?= base_url('logout') ?>" class="logout-btn-confirm">OK</a>
        </div>
    </div>
</div>
<script>
const BASE = '<?= rtrim(base_url(), '/') ?>';

// ════════════════════════════════════════════════
// ENHANCED TOAST
// ════════════════════════════════════════════════
let _toastTimer, _undoCallback = null;

function toast(msg, type = 'ok', undoFn = null) {
    const el = document.getElementById('toast');
    _undoCallback = undoFn;
    const icon    = type === 'ok' ? '<i class="fas fa-check-circle" style="color:#4ade80"></i>' : '<i class="fas fa-exclamation-circle" style="color:#f87171"></i>';
    const undoBtn = undoFn ? `<span class="toast-undo" onclick="triggerUndo()">Undo</span>` : '';
    const closeBtn = `<span class="toast-close" onclick="hideToast()"><i class="fas fa-times"></i></span>`;
    el.className = 'show ' + type;
    el.innerHTML = icon + '<span>' + msg + '</span>' + undoBtn + closeBtn;
    clearTimeout(_toastTimer);
    _toastTimer = setTimeout(hideToast, undoFn ? 6000 : 3500);
}
function hideToast() { document.getElementById('toast').className = ''; _undoCallback = null; }
function triggerUndo() { if (_undoCallback) { _undoCallback(); hideToast(); } }

// ════════════════════════════════════════════════
// EDIT PANEL
// ════════════════════════════════════════════════
function openEditPanel(sectionLabel, title, bodyHTML, saveFn) {
    document.getElementById('ep-section-label').textContent = sectionLabel;
    document.getElementById('ep-title').textContent         = title;
    document.getElementById('ep-body').innerHTML            = bodyHTML;
    document.getElementById('ep-save-btn').onclick          = saveFn;
    document.getElementById('editOverlay').classList.add('open');
    document.getElementById('editPanel').classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(() => { const f = document.querySelector('#ep-body input, #ep-body textarea'); if (f) f.focus(); }, 350);
}
function closeEditPanel() {
    document.getElementById('editOverlay').classList.remove('open');
    document.getElementById('editPanel').classList.remove('open');
    document.body.style.overflow = '';
}

// ════════════════════════════════════════════════
// DELETE CONFIRM MODAL
// ════════════════════════════════════════════════
function confirmDelete(itemName, deleteFn) {
    document.getElementById('del-modal-msg').innerHTML = `Are you sure you want to delete <strong>"${itemName}"</strong>?<br><br>This action <strong>cannot be undone</strong>.`;
    document.getElementById('del-confirm-btn').onclick = () => { closeDelModal(); deleteFn(); };
    document.getElementById('delModal').classList.add('open');
}
function closeDelModal() { document.getElementById('delModal').classList.remove('open'); }

document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeEditPanel(); closeDelModal(); closeLogoutModal(); } });

// ════════════════════════════════════════════════
// API HELPER
// ════════════════════════════════════════════════
async function api(path, data = {}) {
    const r = await fetch(BASE + path, { method:'POST', headers:{'Content-Type':'application/json'}, body:JSON.stringify(data) });
    return r.json();
}

// ════════════════════════════════════════════════
// NAVIGATION
// ════════════════════════════════════════════════
function scrollToCard(id) {
    document.getElementById(id)?.scrollIntoView({ behavior:'smooth', block:'start' });
    document.querySelectorAll('.nav-link').forEach(n => n.classList.remove('active'));
    event.currentTarget.classList.add('active');
}

// ════════════════════════════════════════════════
// ITEM BLOCK HELPERS (kept for compatibility)
// ════════════════════════════════════════════════
function openIbEdit(btn) {} // deprecated — using panels now
function closeIbEdit(btn) {} // deprecated

// ════════════════════════════════════════════════
// BULLET HELPERS
// ════════════════════════════════════════════════
function editBullet(btn) {
    const li = btn.closest('.bullet-li');
    li.querySelector('.b-text').style.display = 'none';
    li.querySelector('.b-actions').style.display = 'none';
    li.querySelector('.b-input').style.display = 'block';
    li.querySelector('.b-input').focus();
    li.querySelector('.b-edit-actions').style.display = 'flex';
}
function cancelBullet(btn) {
    const li = btn.closest('.bullet-li, .simple-li');
    li.querySelector('.b-text').style.display = '';
    li.querySelector('.b-actions').style.display = '';
    if (li.querySelector('.b-input')) li.querySelector('.b-input').style.display = 'none';
    if (li.querySelector('.b-edit-actions')) li.querySelector('.b-edit-actions').style.display = 'none';
}

// ════════════════════════════════════════════════
// HEADER
// ════════════════════════════════════════════════
async function saveHeader() {
    const r = await api('/api/header/update', {
        name: document.getElementById('h-name').value,
        position: document.getElementById('h-position').value,
        email: document.getElementById('h-email').value,
        phone: document.getElementById('h-phone').value,
        location: document.getElementById('h-location').value,
        linkedin: document.getElementById('h-linkedin').value,
        portfolio_url: document.getElementById('h-portfolio-url').value.trim(),
        show_photo: document.getElementById('h-show-photo').checked ? 1 : 0,
    });
    r.success ? toast('Header saved!') : toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// SUMMARY
// ════════════════════════════════════════════════
async function saveSummary() {
    const r = await api('/api/summary/update', { content: document.getElementById('summary-content').value });
    r.success ? toast('Summary saved!') : toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// HISTORY
// ════════════════════════════════════════════════
const MONTHS = ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function openHistoryEdit(btn) {
    const blk = btn.closest('.item-block');
    const id  = blk.dataset.id;
    const d   = {
        role:        blk.querySelector('[name=job-role]').value,
        company:     blk.querySelector('[name=job-company]').value,
        startMonth:  blk.querySelector('[name=job-start-month]').value,
        startYear:   blk.querySelector('[name=job-start-year]').value,
        endMonth:    blk.querySelector('[name=job-end-month]').value,
        endYear:     blk.querySelector('[name=job-end-year]').value,
        isCurrent:   blk.querySelector('[name=job-is-current]').value === '1',
    };
    const monthOpts = (sel) => ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        .map((m,i) => i===0 ? `<option value="">Month</option>` : `<option value="${m}"${m===sel?' selected':''}>${m}</option>`).join('');

    // Collect existing bullets
    const bulletEls = blk.querySelectorAll('.bullet-li');
    const bulletsHTML = [...bulletEls].map(li => {
        const bid     = li.dataset.id;
        const btext   = escHtml(li.querySelector('.b-text').textContent.trim());
        return `<div class="panel-bullet" data-id="${bid}" style="display:flex;align-items:center;gap:8px;padding:8px 10px;background:#f9fafb;border:1px solid var(--border);border-radius:7px;margin-bottom:6px">
            <i class="fas fa-grip-lines" style="color:#d1d5db;font-size:11px;flex-shrink:0"></i>
            <input type="text" class="bullet-input" data-id="${bid}" value="${btext}"
                style="flex:1;border:none;background:transparent;font-size:13px;font-family:inherit;color:var(--text);outline:none;padding:0">
            <button type="button" onclick="removePanelBullet(this,'history-bullet')"
                style="background:none;border:none;cursor:pointer;color:#d1d5db;font-size:12px;padding:2px 4px;flex-shrink:0;transition:color 0.15s"
                onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#d1d5db'">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    }).join('');

    const body = `
        <div class="fg"><label>Role / Position</label>
            <input type="text" name="h-role" value="${escHtml(d.role)}" placeholder="e.g. Senior Developer">
        </div>
        <div class="fg"><label>Company</label>
            <input type="text" name="h-company" value="${escHtml(d.company)}" placeholder="Company name">
        </div>
        <div class="ep-divider"></div>
        <div class="fg"><label>Start Date</label>
            <div style="display:flex;gap:8px">
                <select name="h-start-month" style="flex:1;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">${monthOpts(d.startMonth)}</select>
                <input type="number" name="h-start-year" value="${escHtml(d.startYear)}" placeholder="Year" min="1950" max="2100" style="width:100px;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">
            </div>
        </div>
        <div class="fg" id="end-date-group" style="${d.isCurrent?'opacity:0.4;pointer-events:none':''}">
            <label>End Date</label>
            <div style="display:flex;gap:8px">
                <select name="h-end-month" style="flex:1;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">${monthOpts(d.endMonth)}</select>
                <input type="number" name="h-end-year" value="${escHtml(d.endYear)}" placeholder="Year" min="1950" max="2100" style="width:100px;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">
            </div>
        </div>
        <label style="display:flex;align-items:center;gap:10px;font-size:13px;cursor:pointer;padding:10px 12px;background:#f9fafb;border-radius:8px;border:1.5px solid var(--border)">
            <input type="checkbox" name="h-is-current" ${d.isCurrent?'checked':''} onchange="toggleEndDate(this)" style="width:15px;height:15px">
            Currently working here
        </label>
        <div class="ep-divider"></div>
        <div>
            <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:var(--muted);margin-bottom:10px">
                Bullet Points
            </div>
            <div id="panel-bullets-list">${bulletsHTML}</div>
            <button type="button" onclick="addPanelBullet('${id}','history')"
                style="display:inline-flex;align-items:center;gap:6px;background:none;border:1.5px dashed var(--accent);color:var(--accent);padding:7px 14px;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer;margin-top:4px;font-family:inherit;width:100%;justify-content:center">
                <i class="fas fa-plus"></i> Add Bullet Point
            </button>
        </div>`;

    openEditPanel('Work History', '✏️ ' + d.role, body, () => saveHistoryFromPanel(id, blk));
}

function toggleEndDate(cb) {
    const grp = document.getElementById('end-date-group');
    if (grp) { grp.style.opacity = cb.checked ? '0.4' : '1'; grp.style.pointerEvents = cb.checked ? 'none' : ''; }
}

async function saveHistoryFromPanel(id, blk) {
    const p = document.getElementById('ep-body');
    const role    = p.querySelector('[name=h-role]').value;
    const company = p.querySelector('[name=h-company]').value;
    const sm      = p.querySelector('[name=h-start-month]').value;
    const sy      = p.querySelector('[name=h-start-year]').value;
    const em      = p.querySelector('[name=h-end-month]').value;
    const ey      = p.querySelector('[name=h-end-year]').value;
    const ic      = p.querySelector('[name=h-is-current]').checked ? 1 : 0;

    // Save main job info
    const r = await api(`/api/history/update/${id}`, { role, company, start_month:sm, start_year:sy, end_month:em, end_year:ey, is_current:ic });
    if (!r.success) { toast(r.message || 'Error saving job.', 'err'); return; }

    // Save all existing bullets
    const bulletInputs = p.querySelectorAll('.bullet-input[data-id]');
    await Promise.all([...bulletInputs].map(inp =>
        api(`/api/history-bullet/update/${inp.dataset.id}`, { content: inp.value })
    ));

    // Sync bullets back to DOM
    bulletInputs.forEach(inp => {
        const li = blk.querySelector(`.bullet-li[data-id="${inp.dataset.id}"]`);
        if (li) li.querySelector('.b-text').textContent = inp.value;
    });

    // Update job header
    blk.querySelector('.ib-role').textContent = role;
    blk.querySelector('.ib-sub').textContent  = company + ' · ' + sm + ' ' + sy + ' – ' + (ic ? 'Present' : em + ' ' + ey);
    blk.querySelector('[name=job-role]').value        = role;
    blk.querySelector('[name=job-company]').value     = company;
    blk.querySelector('[name=job-start-month]').value = sm;
    blk.querySelector('[name=job-start-year]').value  = sy;
    blk.querySelector('[name=job-end-month]').value   = em;
    blk.querySelector('[name=job-end-year]').value    = ey;
    blk.querySelector('[name=job-is-current]').value  = ic;
    closeEditPanel(); toast('Work experience saved!');
}

async function deleteHistory(id, btn) {
    const name = btn.closest('.item-block').querySelector('.ib-role').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/history/delete/${id}`);
        if (r.success) { btn.closest('.item-block').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}
async function addHistory() {
    const r = await api('/api/history/add', { resume_id:CURRENT_RESUME_ID, role:'New Role', company:'Company Name', start_year:new Date().getFullYear(), is_current:1 });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// BULLETS
// ════════════════════════════════════════════════
async function saveBullet(id, entity, btn) {
    const li = btn.closest('.bullet-li');
    const val = li.querySelector('.b-input').value;
    const r = await api(`/api/${entity}/update/${id}`, { content: val });
    if (r.success) { li.querySelector('.b-text').textContent = val; cancelBullet(btn); toast('Saved!'); }
    else toast(r.message || 'Error', 'err');
}
async function delBullet(id, entity, btn) {
    confirmDelete('this bullet point', async () => {
        const r = await api(`/api/${entity}/delete/${id}`);
        if (r.success) { btn.closest('.bullet-li').remove(); toast('Deleted!'); }
        else toast(r.message || 'Error', 'err');
    });
}
async function addBullet(parentId, type) {
    const endpoint = type === 'history' ? '/api/history-bullet/add' : '/api/education-bullet/add';
    const field    = type === 'history' ? 'history_id' : 'education_id';
    const r = await api(endpoint, { [field]: parentId, content: 'New bullet point' });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// SIMPLE ITEMS (skills, tech) — panel-based edit
// ════════════════════════════════════════════════
function openSkillEdit(btn, id) {
    const li      = btn.closest('.simple-li');
    const current = li.querySelector('.b-text').textContent;
    const body = `
        <div class="fg"><label>Skill</label>
            <input type="text" name="simple-val" value="${escHtml(current)}" placeholder="e.g. Leadership">
            <div class="ep-hint"><i class="fas fa-info-circle"></i> Keep it concise — one skill per entry</div>
        </div>`;
    openEditPanel('Personal Skills', '✏️ Edit Skill', body, () => saveSimpleFromPanel('skill', id, li));
}

function openTechEdit(btn, id) {
    const li      = btn.closest('.simple-li');
    const current = li.querySelector('.b-text').textContent;
    const body = `
        <div class="fg"><label>Technology</label>
            <input type="text" name="simple-val" value="${escHtml(current)}" placeholder="e.g. Laravel, Vue.js">
            <div class="ep-hint"><i class="fas fa-info-circle"></i> Include version if relevant (e.g. PHP 8.2)</div>
        </div>`;
    openEditPanel('Tech Stack', '✏️ Edit Technology', body, () => saveSimpleFromPanel('tech', id, li));
}

async function saveSimpleFromPanel(entity, id, li) {
    const val = document.getElementById('ep-body').querySelector('[name=simple-val]').value;
    const r   = await api(`/api/${entity}/update/${id}`, { content: val });
    if (r.success) { li.querySelector('.b-text').textContent = val; closeEditPanel(); toast('Saved!'); }
    else toast(r.message || 'Error', 'err');
}

function editSimple(btn) { /* deprecated */ }

async function saveSimple(entity, id, btn) {
    const li = btn.closest('.simple-li');
    const val = li.querySelector('.b-input').value;
    const r = await api(`/api/${entity}/update/${id}`, { content: val });
    if (r.success) { li.querySelector('.b-text').textContent = val; cancelBullet(btn); toast('Saved!'); }
    else toast(r.message || 'Error', 'err');
}
async function delSimple(entity, id, btn) {
    const name = btn.closest('.simple-li, .lang-li, .cert-li').querySelector('.b-text, .lang-name-lbl, .cert-name-lbl')?.textContent || 'this item';
    confirmDelete(name, async () => {
        const r = await api(`/api/${entity}/delete/${id}`);
        if (r.success) { btn.closest('.simple-li, .lang-li, .cert-li').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}
async function addSimple(entity, defaultText) {
    const r = await api(`/api/${entity}/add`, { resume_id:CURRENT_RESUME_ID, content: defaultText });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// LANGUAGES
// ════════════════════════════════════════════════
function openLangEditPanel(btn) {
    const li      = btn.closest('.lang-li');
    const id      = li.dataset.id;
    const name    = li.querySelector('[name=lang-name]').value;
    const mastery = li.querySelector('[name=lang-mastery]').value;

    const body = `
        <div class="fg"><label>Language</label>
            <input type="text" name="l-name" value="${escHtml(name)}" placeholder="e.g. English">
        </div>
        <div class="ep-divider"></div>
        <div class="fg">
            <label>Mastery Level — <span id="mastery-lbl">${mastery}%</span></label>
            <input type="range" name="l-mastery" min="0" max="100" step="20" value="${mastery}"
                style="width:100%;margin-top:8px;accent-color:var(--accent)"
                oninput="document.getElementById('mastery-lbl').textContent=this.value+'%'">
            <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--muted);margin-top:4px">
                <span>Beginner</span><span>Basic</span><span>Intermediate</span><span>Advanced</span><span>Native</span>
            </div>
        </div>
        <div style="display:flex;gap:6px;margin-top:4px" id="lang-dots-preview">
            ${[1,2,3,4,5].map(i => `<span style="width:14px;height:14px;border-radius:50%;background:${(mastery/20)>=i?'var(--accent)':'#e5e7eb'};border:2px solid ${(mastery/20)>=i?'#2563eb':'#d1d5db'};display:inline-block;transition:background 0.2s"></span>`).join('')}
        </div>`;

    openEditPanel('Languages', '✏️ ' + name, body, () => saveLangFromPanel(id, li));

    // Live dot preview on slider change
    setTimeout(() => {
        const slider = document.querySelector('[name=l-mastery]');
        if (slider) slider.addEventListener('input', () => {
            const v = parseInt(slider.value);
            document.querySelectorAll('#lang-dots-preview span').forEach((dot, i) => {
                dot.style.background       = (v/20) >= (i+1) ? 'var(--accent)' : '#e5e7eb';
                dot.style.borderColor      = (v/20) >= (i+1) ? '#2563eb' : '#d1d5db';
            });
        });
    }, 100);
}

async function saveLangFromPanel(id, li) {
    const p       = document.getElementById('ep-body');
    const lang    = p.querySelector('[name=l-name]').value;
    const mastery = parseInt(p.querySelector('[name=l-mastery]').value);
    const r = await api(`/api/language/update/${id}`, { language: lang, mastery });
    if (r.success) {
        li.querySelector('.lang-name-lbl').textContent = lang;
        li.querySelector('.lang-pct-lbl').textContent  = mastery + '%';
        li.querySelectorAll('.d').forEach((d, i) => { d.className = 'd' + ((mastery/20) >= (i+1) ? ' on' : ''); });
        li.querySelector('[name=lang-name]').value    = lang;
        li.querySelector('[name=lang-mastery]').value = mastery;
        closeEditPanel(); toast('Language saved!');
    } else toast(r.message || 'Error', 'err');
}

async function delLang(id, btn) {
    const name = btn.closest('.lang-li').querySelector('.lang-name-lbl').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/language/delete/${id}`);
        if (r.success) { btn.closest('.lang-li').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}

async function addLang() {
    const r = await api('/api/language/add', { resume_id:CURRENT_RESUME_ID, language:'New Language', mastery:60 });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// EDUCATION
// ════════════════════════════════════════════════
function openEduEdit(btn) {
    const blk = btn.closest('.item-block');
    const id  = blk.dataset.id;
    const d   = {
        degree:     blk.querySelector('[name=edu-degree]').value,
        school:     blk.querySelector('[name=edu-school]').value,
        startMonth: blk.querySelector('[name=edu-start-month]').value,
        startYear:  blk.querySelector('[name=edu-start-year]').value,
        endMonth:   blk.querySelector('[name=edu-end-month]').value,
        endYear:    blk.querySelector('[name=edu-end-year]').value,
    };
    const monthOpts = (sel) => ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        .map((m,i) => i===0 ? `<option value="">Month</option>` : `<option value="${m}"${m===sel?' selected':''}>${m}</option>`).join('');

    // Collect existing detail bullets
    const bulletEls  = blk.querySelectorAll('.bullet-li');
    const bulletsHTML = [...bulletEls].map(li => {
        const bid   = li.dataset.id;
        const btext = escHtml(li.querySelector('.b-text').textContent.trim());
        return `<div class="panel-bullet" data-id="${bid}" style="display:flex;align-items:center;gap:8px;padding:8px 10px;background:#f9fafb;border:1px solid var(--border);border-radius:7px;margin-bottom:6px">
            <i class="fas fa-grip-lines" style="color:#d1d5db;font-size:11px;flex-shrink:0"></i>
            <input type="text" class="bullet-input" data-id="${bid}" value="${btext}"
                style="flex:1;border:none;background:transparent;font-size:13px;font-family:inherit;color:var(--text);outline:none;padding:0">
            <button type="button" onclick="removePanelBullet(this,'education-bullet')"
                style="background:none;border:none;cursor:pointer;color:#d1d5db;font-size:12px;padding:2px 4px;flex-shrink:0;transition:color 0.15s"
                onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#d1d5db'">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    }).join('');

    const body = `
        <div class="fg"><label>Degree / Level</label>
            <input type="text" name="e-degree" value="${escHtml(d.degree)}" placeholder="e.g. Bachelor of Science">
        </div>
        <div class="fg"><label>University / School</label>
            <input type="text" name="e-school" value="${escHtml(d.school)}" placeholder="School name">
        </div>
        <div class="ep-divider"></div>
        <div class="fg"><label>Start Date</label>
            <div style="display:flex;gap:8px">
                <select name="e-start-month" style="flex:1;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">${monthOpts(d.startMonth)}</select>
                <input type="number" name="e-start-year" value="${escHtml(d.startYear)}" placeholder="Year" min="1950" max="2100" style="width:100px;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">
            </div>
        </div>
        <div class="fg"><label>End Date</label>
            <div style="display:flex;gap:8px">
                <select name="e-end-month" style="flex:1;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">${monthOpts(d.endMonth)}</select>
                <input type="number" name="e-end-year" value="${escHtml(d.endYear)}" placeholder="Year" min="1950" max="2100" style="width:100px;padding:10px 12px;border:1.5px solid var(--border);border-radius:8px;font-size:13px;font-family:inherit">
            </div>
        </div>
        <div class="ep-divider"></div>
        <div>
            <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.8px;color:var(--muted);margin-bottom:10px">
                Detail Points
            </div>
            <div id="panel-bullets-list">${bulletsHTML}</div>
            <button type="button" onclick="addPanelBullet('${id}','education')"
                style="display:inline-flex;align-items:center;gap:6px;background:none;border:1.5px dashed var(--accent);color:var(--accent);padding:7px 14px;border-radius:7px;font-size:12px;font-weight:500;cursor:pointer;margin-top:4px;font-family:inherit;width:100%;justify-content:center">
                <i class="fas fa-plus"></i> Add Detail Point
            </button>
        </div>`;

    openEditPanel('Education', '✏️ ' + d.degree, body, () => saveEduFromPanel(id, blk));
}

async function saveEduFromPanel(id, blk) {
    const p = document.getElementById('ep-body');
    const degree = p.querySelector('[name=e-degree]').value;
    const school = p.querySelector('[name=e-school]').value;
    const sm     = p.querySelector('[name=e-start-month]').value;
    const sy     = p.querySelector('[name=e-start-year]').value;
    const em     = p.querySelector('[name=e-end-month]').value;
    const ey     = p.querySelector('[name=e-end-year]').value;

    const r = await api(`/api/education/update/${id}`, { degree, school, start_month:sm, start_year:sy, end_month:em, end_year:ey });
    if (!r.success) { toast(r.message || 'Error saving education.', 'err'); return; }

    // Save all existing bullet detail points
    const bulletInputs = p.querySelectorAll('.bullet-input[data-id]');
    await Promise.all([...bulletInputs].map(inp =>
        api(`/api/education-bullet/update/${inp.dataset.id}`, { content: inp.value })
    ));

    // Sync bullets back to DOM
    bulletInputs.forEach(inp => {
        const li = blk.querySelector(`.bullet-li[data-id="${inp.dataset.id}"]`);
        if (li) li.querySelector('.b-text').textContent = inp.value;
    });

    blk.querySelector('.ib-role').textContent = degree;
    blk.querySelector('.ib-sub').textContent  = school + ' · ' + sm + ' ' + sy + ' – ' + em + ' ' + ey;
    blk.querySelector('[name=edu-degree]').value      = degree;
    blk.querySelector('[name=edu-school]').value      = school;
    blk.querySelector('[name=edu-start-month]').value = sm;
    blk.querySelector('[name=edu-start-year]').value  = sy;
    blk.querySelector('[name=edu-end-month]').value   = em;
    blk.querySelector('[name=edu-end-year]').value    = ey;
    closeEditPanel(); toast('Education saved!');
}

async function deleteEdu(id, btn) {
    const name = btn.closest('.item-block').querySelector('.ib-role').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/education/delete/${id}`);
        if (r.success) { btn.closest('.item-block').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}
async function addEdu() {
    const r = await api('/api/education/add', { resume_id:CURRENT_RESUME_ID, degree:'New Degree', school:'School Name', start_year:new Date().getFullYear() });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// CERTIFICATIONS
// ════════════════════════════════════════════════
function openCertEdit(btn) {
    const li   = btn.closest('.cert-li');
    const id   = li.dataset.id;
    const name = li.querySelector('[name=cert-name]').value;
    const year = li.querySelector('[name=cert-year]').value;

    const body = `
        <div class="fg"><label>Certification Name</label>
            <input type="text" name="c-name" value="${escHtml(name)}" placeholder="e.g. AWS Solutions Architect">
        </div>
        <div class="fg"><label>Year Received</label>
            <input type="number" name="c-year" value="${escHtml(year)}" min="1970" max="2100" placeholder="${new Date().getFullYear()}">
        </div>`;

    openEditPanel('Certifications', '✏️ ' + name, body, () => saveCertFromPanel(id, li));
}

async function saveCertFromPanel(id, li) {
    const p    = document.getElementById('ep-body');
    const name = p.querySelector('[name=c-name]').value;
    const year = p.querySelector('[name=c-year]').value;
    const r = await api(`/api/certification/update/${id}`, { name, year });
    if (r.success) {
        li.querySelector('.cert-name-lbl').textContent = name;
        li.querySelector('.cert-year-lbl').textContent = year;
        li.querySelector('[name=cert-name]').value = name;
        li.querySelector('[name=cert-year]').value = year;
        closeEditPanel(); toast('Certification saved!');
    } else toast(r.message || 'Error', 'err');
}

async function delCert(id, btn) {
    const name = btn.closest('.cert-li').querySelector('.cert-name-lbl').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/certification/delete/${id}`);
        if (r.success) { btn.closest('.cert-li').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}

async function addCert() {
    const r = await api('/api/certification/add', { resume_id:CURRENT_RESUME_ID, name:'New Certification', year:new Date().getFullYear() });
    if (r.success) { toast('Added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// PASSWORD
// ════════════════════════════════════════════════
async function changePw() {
    const cur = document.getElementById('pw-cur').value.trim();
    const nw  = document.getElementById('pw-new').value.trim();
    const con = document.getElementById('pw-conf').value.trim();
    if (!cur || !nw || !con) { toast('All fields are required.', 'err'); return; }
    if (nw.length < 6)        { toast('New password must be at least 6 characters.', 'err'); return; }
    if (nw !== con)            { toast('Passwords do not match.', 'err'); return; }
    const r = await api('/api/account/change-password', { current_password:cur, new_password:nw, confirm_password:con });
    if (r.success) {
        toast('Password changed! You are still logged in.');
        document.getElementById('pw-cur').value = document.getElementById('pw-new').value = document.getElementById('pw-conf').value = '';
    } else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// ABOUT ME
// ════════════════════════════════════════════════
async function saveAbout() {
    const x = document.getElementById('pos-x')?.value ?? 50;
    const y = document.getElementById('pos-y')?.value ?? 50;
    const r = await api('/api/about/update', {
        tagline:           document.getElementById('ab-tagline').value,
        bio:               document.getElementById('ab-bio').value,
        photo_position:    x + '% ' + y + '%',
        cv_label:          document.getElementById('ab-cv-label').value,
        btn_contact_label: document.getElementById('ab-contact-label').value,
        btn_contact_email: document.getElementById('ab-contact-email').value,
        github:            document.getElementById('ab-github').value,
        linkedin_url:      document.getElementById('ab-linkedin').value,
        twitter:           document.getElementById('ab-twitter').value,
        facebook:          document.getElementById('ab-facebook').value,
    });
    r.success ? toast('About info saved!') : toast(r.message || 'Error', 'err');
}

async function uploadPhoto(input) {
    if (!input.files[0]) return;
    const fd = new FormData();
    fd.append('photo', input.files[0]);
    const r    = await fetch(BASE + '/api/about/upload-photo', { method:'POST', body:fd });
    const data = await r.json();
    if (data.success) {
        document.getElementById('photo-preview').innerHTML = `<img src="${BASE}/${data.photo}?t=${Date.now()}" id="pos-preview-img" style="width:100%;height:100%;object-fit:cover">`;
        toast('Photo uploaded!');
    } else toast(data.message || 'Upload failed', 'err');
}

// Photo position
(function initPhotoPosition() {
    const saved = '<?= esc($about['photo_position'] ?? '50% 50%') ?>';
    const parts = saved.split(' ');
    const x = parseInt(parts[0]) || 50, y = parseInt(parts[1]) || 50;
    const sx = document.getElementById('pos-x'), sy = document.getElementById('pos-y');
    if (sx) { sx.value = x; document.getElementById('pos-x-label').textContent = x + '%'; }
    if (sy) { sy.value = y; document.getElementById('pos-y-label').textContent = y + '%'; }
})();

function updatePhotoPosition() {
    const x = document.getElementById('pos-x').value, y = document.getElementById('pos-y').value;
    document.getElementById('pos-x-label').textContent = x + '%';
    document.getElementById('pos-y-label').textContent = y + '%';
    document.getElementById('pos-display').textContent  = x + '% ' + y + '%';
    const img = document.getElementById('pos-preview-img');
    if (img) img.style.objectPosition = x + '% ' + y + '%';
}

// ════════════════════════════════════════════════
// SERVICES — uses slide panel (NO inline edit zone)
// ════════════════════════════════════════════════
function openSvcEdit(btn) {
    const li          = btn.closest('.cert-li');
    const id          = li.dataset.id;
    const currentIcon = li.querySelector('[name=svc-icon]').value;
    const title       = li.querySelector('.cert-name-lbl').textContent;
    const desc        = li.querySelector('[name=svc-desc]').value;
    const svcTitle    = li.querySelector('[name=svc-title]').value;

    const body = `
        <div class="fg">
            <label>Icon</label>
            <input type="hidden" name="svc-icon" value="${escHtml(currentIcon)}">
            <div class="icon-picker-wrap">
                <div class="icon-selected-preview">
                    <i class="${escHtml(currentIcon)}"></i>
                    <span class="icon-selected-label">${escHtml(currentIcon)}</span>
                </div>
                <input type="text" class="icon-search-input" placeholder="Search 1,500+ icons... (e.g. code, star)" oninput="filterIconsPanel(this)">
                <div class="icon-grid-wrap"></div>
            </div>
            <div class="ep-hint"><i class="fas fa-info-circle"></i> Type to search all FontAwesome icons</div>
        </div>
        <div class="ep-divider"></div>
        <div class="fg">
            <label>Service Title</label>
            <input type="text" name="svc-title" value="${escHtml(svcTitle)}" placeholder="e.g. Web Development">
        </div>
        <div class="fg">
            <label>Description</label>
            <textarea name="svc-desc" rows="5" placeholder="Describe this service...">${escHtml(desc)}</textarea>
        </div>`;

    openEditPanel('What I Do — Services', '✏️ ' + title, body, () => saveSvcFromPanel(id, li));
    setTimeout(() => initIconPickerPanel(currentIcon), 100);
}

function saveSvcFromPanel(id, li) {
    const panel = document.getElementById('ep-body');
    const icon  = panel.querySelector('[name=svc-icon]').value;
    const title = panel.querySelector('[name=svc-title]').value;
    const desc  = panel.querySelector('[name=svc-desc]').value;
    api(`/api/about-service/update/${id}`, { icon, title, description: desc }).then(r => {
        if (r.success) {
            li.querySelector('.cert-name-lbl').textContent   = title;
            li.querySelector('.cert-year-lbl').textContent   = desc.substring(0, 60) + (desc.length > 60 ? '…' : '');
            li.querySelector('.cert-row .cert-info i').className = icon;
            li.querySelector('[name=svc-icon]').value  = icon;
            li.querySelector('[name=svc-title]').value = title;
            li.querySelector('[name=svc-desc]').value  = desc;
            closeEditPanel();
            toast('✅ Service saved!');
        } else toast(r.message || 'Error saving.', 'err');
    });
}

function delSvc(id, btn) {
    const li   = btn.closest('.cert-li');
    const name = li.querySelector('.cert-name-lbl').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/about-service/delete/${id}`);
        if (r.success) {
            li.remove();
            toast(`Deleted "${name}"`, 'ok', () => { toast('Reloading to restore...'); setTimeout(() => location.reload(), 1000); });
        } else toast(r.message || 'Error', 'err');
    });
}

async function addSvc() {
    const r = await api('/api/about-service/add', { icon:'fas fa-star', title:'New Service', description:'Describe what you do here.' });
    if (r.success) { toast('Service added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// TESTIMONIALS
// ════════════════════════════════════════════════
function openTestiEdit(btn) {
    const li     = btn.closest('.cert-li');
    const id     = li.dataset.id;
    const author = li.querySelector('[name=t-author]').value;
    const role   = li.querySelector('[name=t-role]').value;
    const quote  = li.querySelector('[name=t-quote]').value;

    const body = `
        <div class="fg"><label>Author Name</label>
            <input type="text" name="ti-author" value="${escHtml(author)}" placeholder="e.g. Jane Smith">
        </div>
        <div class="fg"><label>Role / Title</label>
            <input type="text" name="ti-role" value="${escHtml(role)}" placeholder="e.g. CEO at Company">
        </div>
        <div class="ep-divider"></div>
        <div class="fg"><label>Quote / Testimonial</label>
            <textarea name="ti-quote" rows="6" placeholder="Write the testimonial...">${escHtml(quote)}</textarea>
        </div>`;

    openEditPanel('Testimonials', '✏️ ' + author, body, () => saveTestiFromPanel(id, li));
}

async function saveTestiFromPanel(id, li) {
    const p      = document.getElementById('ep-body');
    const author = p.querySelector('[name=ti-author]').value;
    const role   = p.querySelector('[name=ti-role]').value;
    const quote  = p.querySelector('[name=ti-quote]').value;
    const r = await api(`/api/about-testimonial/update/${id}`, { author, role, quote });
    if (r.success) {
        li.querySelector('.cert-name-lbl').textContent = author + ' — ' + role;
        li.querySelector('.cert-year-lbl').textContent = quote.substring(0, 70) + (quote.length > 70 ? '…' : '');
        li.querySelector('[name=t-author]').value = author;
        li.querySelector('[name=t-role]').value   = role;
        li.querySelector('[name=t-quote]').value  = quote;
        closeEditPanel(); toast('Testimonial saved!');
    } else toast(r.message || 'Error', 'err');
}

async function delTesti(id, btn) {
    const name = btn.closest('.cert-li').querySelector('.cert-name-lbl').textContent;
    confirmDelete(name, async () => {
        const r = await api(`/api/about-testimonial/delete/${id}`);
        if (r.success) { btn.closest('.cert-li').remove(); toast(`Deleted "${name}"`); }
        else toast(r.message || 'Error', 'err');
    });
}
async function addTesti() {
    const r = await api('/api/about-testimonial/add', { author:'New Person', role:'Their Role', quote:'Their testimonial here.' });
    if (r.success) { toast('Testimonial added! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

// ════════════════════════════════════════════════
// LOGOUT
// ════════════════════════════════════════════════
function confirmLogout(e) {
    e.preventDefault();
    document.getElementById('logoutModal').classList.add('open');
}
function closeLogoutModal() {
    document.getElementById('logoutModal').classList.remove('open');
}
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('logoutModal');
    if (overlay) overlay.addEventListener('click', e => { if (e.target === overlay) closeLogoutModal(); });
});

// ════════════════════════════════════════════════
// ICON PICKER — Full FA6 Free (live from CDN)
// ════════════════════════════════════════════════
let FA_ICONS = [], iconsLoaded = false;

async function loadFAIcons() {
    if (iconsLoaded) return;
    try {
        const res = await fetch('https://unpkg.com/@fortawesome/fontawesome-free@6.4.0/metadata/icons.json');
        if (!res.ok) throw new Error('fetch failed');
        const data = await res.json();
        FA_ICONS = Object.entries(data)
            .filter(([, v]) => v.styles && v.styles.includes('solid'))
            .map(([name]) => 'fa-' + name).sort();
        iconsLoaded = true;
        console.log('FA Icons loaded:', FA_ICONS.length);
    } catch(e) {
        FA_ICONS = ['fa-address-book','fa-adjust','fa-anchor','fa-archive','fa-arrow-circle-down','fa-arrow-circle-up','fa-at','fa-atom','fa-award','fa-baby','fa-ban','fa-barcode','fa-bars','fa-bath','fa-bed','fa-beer','fa-bell','fa-bicycle','fa-binoculars','fa-birthday-cake','fa-blog','fa-bold','fa-bolt','fa-bomb','fa-bone','fa-book','fa-bookmark','fa-box','fa-brain','fa-briefcase','fa-brush','fa-bug','fa-building','fa-bullhorn','fa-bullseye','fa-bus','fa-calculator','fa-calendar','fa-camera','fa-car','fa-certificate','fa-chart-bar','fa-chart-line','fa-chart-pie','fa-check','fa-check-circle','fa-chess','fa-child','fa-church','fa-circle','fa-city','fa-clipboard','fa-clock','fa-cloud','fa-code','fa-code-branch','fa-coffee','fa-cog','fa-cogs','fa-coins','fa-comment','fa-comments','fa-compass','fa-copy','fa-credit-card','fa-crown','fa-cube','fa-database','fa-desktop','fa-dice','fa-dog','fa-dollar-sign','fa-download','fa-dumbbell','fa-edit','fa-envelope','fa-eraser','fa-eye','fa-file','fa-file-alt','fa-file-code','fa-file-pdf','fa-film','fa-filter','fa-fingerprint','fa-fire','fa-fish','fa-flag','fa-flask','fa-folder','fa-font','fa-forward','fa-gamepad','fa-gem','fa-gift','fa-glasses','fa-globe','fa-graduation-cap','fa-hammer','fa-handshake','fa-hashtag','fa-headphones','fa-heart','fa-helicopter','fa-history','fa-home','fa-hospital','fa-hourglass','fa-id-card','fa-image','fa-inbox','fa-industry','fa-info','fa-key','fa-keyboard','fa-landmark','fa-language','fa-laptop','fa-leaf','fa-lightbulb','fa-link','fa-list','fa-lock','fa-magic','fa-map','fa-map-marker-alt','fa-medal','fa-microphone','fa-minus','fa-mobile','fa-money-bill','fa-moon','fa-mountain','fa-music','fa-network-wired','fa-newspaper','fa-paint-brush','fa-palette','fa-paper-plane','fa-pause','fa-paw','fa-pen','fa-pencil-alt','fa-phone','fa-plane','fa-play','fa-plug','fa-plus','fa-print','fa-project-diagram','fa-puzzle-piece','fa-qrcode','fa-question','fa-quote-left','fa-rocket','fa-route','fa-rss','fa-save','fa-school','fa-search','fa-server','fa-share','fa-shield-alt','fa-ship','fa-shopping-cart','fa-sign-in-alt','fa-signal','fa-sitemap','fa-sliders-h','fa-smile','fa-snowflake','fa-sort','fa-star','fa-store','fa-sync','fa-table','fa-tablet','fa-tag','fa-tasks','fa-terminal','fa-th','fa-thumbs-up','fa-ticket-alt','fa-times','fa-toolbox','fa-tools','fa-trash','fa-tree','fa-trophy','fa-truck','fa-tv','fa-umbrella','fa-undo','fa-university','fa-upload','fa-user','fa-user-circle','fa-user-friends','fa-user-graduate','fa-user-md','fa-user-plus','fa-users','fa-utensils','fa-video','fa-volume-up','fa-wallet','fa-warehouse','fa-wheelchair','fa-wifi','fa-wrench'].sort();
        iconsLoaded = true;
    }
}

const ICONS_PER_PAGE = 80;

async function initIconPickerPanel(selectedClass) {
    const panel = document.getElementById('ep-body');
    const grid  = panel.querySelector('.icon-grid-wrap');
    if (!grid) return;
    grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:20px;font-size:12px;color:var(--muted)"><i class="fas fa-spinner fa-spin"></i> Loading icons...</div>';
    await loadFAIcons();
    grid._page = 1; grid._query = ''; grid._selected = selectedClass || 'fas fa-star';
    renderIconGrid(grid, panel);
}

function filterIconsPanel(input) {
    const panel = document.getElementById('ep-body');
    const grid  = panel.querySelector('.icon-grid-wrap');
    grid._query = input.value.toLowerCase().trim();
    grid._page  = 1;
    renderIconGrid(grid, panel);
}

function renderIconGrid(grid, container) {
    const q = grid._query || '', page = grid._page || 1, selected = grid._selected || '';
    const filtered = q ? FA_ICONS.filter(ic => ic.includes(q)) : FA_ICONS;
    const slice    = filtered.slice(0, page * ICONS_PER_PAGE);
    grid.innerHTML = '';
    if (filtered.length === 0) { grid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:16px;font-size:12px;color:var(--muted)"><i class="fas fa-search" style="margin-right:6px"></i>No icons found.</div>'; return; }
    slice.forEach(icon => {
        const fullClass = 'fas ' + icon;
        const div = document.createElement('div');
        div.className = 'icon-option' + (fullClass === selected ? ' selected' : '');
        div.title     = icon.replace('fa-', '');
        div.innerHTML = `<i class="${fullClass}"></i>`;
        div.onclick   = () => selectIcon(div, fullClass, container);
        grid.appendChild(div);
    });
    if (slice.length < filtered.length) {
        const more = document.createElement('div');
        more.className = 'icon-load-more';
        more.innerHTML = `<i class="fas fa-chevron-down" style="margin-right:4px"></i>Load more — ${filtered.length - slice.length} remaining`;
        more.onclick   = () => { grid._page++; renderIconGrid(grid, container); };
        grid.appendChild(more);
    }
}

function selectIcon(el, fullClass, container) {
    container.querySelector('[name=svc-icon]').value = fullClass;
    const preview = container.querySelector('.icon-selected-preview i');
    const label   = container.querySelector('.icon-selected-label');
    if (preview) preview.className = fullClass;
    if (label)   label.textContent = fullClass;
    const grid = container.querySelector('.icon-grid-wrap');
    grid._selected = fullClass;
    grid.querySelectorAll('.icon-option').forEach(o => o.classList.remove('selected'));
    el.classList.add('selected');
}

// ════════════════════════════════════════════════
// PANEL BULLET HELPERS
// ════════════════════════════════════════════════

// Add new bullet directly via API, then add row to panel
async function addPanelBullet(parentId, type) {
    const endpoint  = type === 'history' ? '/api/history-bullet/add' : '/api/education-bullet/add';
    const fieldName = type === 'history' ? 'history_id' : 'education_id';
    const r = await api(endpoint, { [fieldName]: parentId, content: 'New bullet point' });
    if (!r.success) { toast('Error adding bullet.', 'err'); return; }

    // Add to panel list
    const list = document.getElementById('panel-bullets-list');
    const entity = type === 'history' ? 'history-bullet' : 'education-bullet';
    const div  = document.createElement('div');
    div.className = 'panel-bullet';
    div.dataset.id = r.id;
    div.style.cssText = 'display:flex;align-items:center;gap:8px;padding:8px 10px;background:#f9fafb;border:1px solid var(--border);border-radius:7px;margin-bottom:6px';
    div.innerHTML = `
        <i class="fas fa-grip-lines" style="color:#d1d5db;font-size:11px;flex-shrink:0"></i>
        <input type="text" class="bullet-input" data-id="${r.id}" value="New bullet point"
            style="flex:1;border:none;background:transparent;font-size:13px;font-family:inherit;color:var(--text);outline:none;padding:0">
        <button type="button" onclick="removePanelBullet(this,'${entity}')"
            style="background:none;border:none;cursor:pointer;color:#d1d5db;font-size:12px;padding:2px 4px;flex-shrink:0;transition:color 0.15s"
            onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#d1d5db'">
            <i class="fas fa-times"></i>
        </button>`;
    list.appendChild(div);

    // Also add to the hidden DOM list so it's available after panel closes
    const blkId = type === 'history' ? `hb-${parentId}` : `eb-${parentId}`;
    const ul = document.getElementById(blkId);
    if (ul) {
        const li = document.createElement('li');
        li.className = 'bullet-li';
        li.dataset.id = r.id;
        li.innerHTML = `<span class="b-text">New bullet point</span>
            <div class="b-actions"></div>
            <input class="b-input" type="text" value="New bullet point">
            <div class="b-edit-actions"></div>`;
        ul.appendChild(li);
    }

    // Focus the new input
    setTimeout(() => { div.querySelector('input').select(); }, 50);
    toast('Bullet added!');
}

// Remove bullet from panel and delete via API
async function removePanelBullet(btn, entity) {
    const row = btn.closest('.panel-bullet');
    const id  = row.dataset.id;
    if (!id) { row.remove(); return; } // new unsaved bullet

    const r = await api(`/api/${entity}/delete/${id}`);
    if (r.success) {
        row.remove();
        // Also remove from hidden DOM list
        const li = document.querySelector(`.bullet-li[data-id="${id}"]`);
        if (li) li.remove();
        toast('Bullet removed!');
    } else toast(r.message || 'Error', 'err');
}


// ════════════════════════════════════════════════
// DARK MODE
// ════════════════════════════════════════════════
function toggleDark() {
    const isDark = document.body.classList.toggle('dark');
    localStorage.setItem('adminDarkMode', isDark ? '1' : '0');
    updateDarkIcon(isDark);
}

function updateDarkIcon(isDark) {
    const icon = document.getElementById('darkToggleIcon');
    if (!icon) return;
    icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
}

// Apply on load
(function () {
    const saved = localStorage.getItem('adminDarkMode');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDark = saved !== null ? saved === '1' : prefersDark;
    if (isDark) document.body.classList.add('dark');
    updateDarkIcon(isDark);
})();


// ════════════════════════════════════════════════
// RESUME COLLECTION
// ════════════════════════════════════════════════
const CURRENT_RESUME_ID = <?= $editingResumeId ?? 1 ?>;

function openNewResumePanel() {
    const body = `
        <div style="margin-bottom:18px;padding:14px;background:#f0fdf4;border-radius:8px;border:1px solid #86efac;font-size:13px;color:#166534">
            <i class="fas fa-info-circle" style="margin-right:6px"></i>
            Choose how to create your new resume.
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:20px">
            <label style="display:flex;align-items:center;gap:12px;padding:14px;border:1.5px solid var(--border);border-radius:8px;cursor:pointer;transition:border-color 0.15s" id="opt-blank" onclick="selectResumeType('blank')">
                <input type="radio" name="resume-type" value="blank" style="width:16px;height:16px;accent-color:var(--accent)">
                <div>
                    <div style="font-weight:600;font-size:13px">Start blank</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px">Empty resume — fill everything from scratch</div>
                </div>
            </label>
            <label style="display:flex;align-items:center;gap:12px;padding:14px;border:1.5px solid var(--border);border-radius:8px;cursor:pointer;transition:border-color 0.15s" id="opt-clone" onclick="selectResumeType('clone')">
                <input type="radio" name="resume-type" value="clone" style="width:16px;height:16px;accent-color:var(--accent)">
                <div>
                    <div style="font-weight:600;font-size:13px">Clone active resume</div>
                    <div style="font-size:12px;color:var(--muted);margin-top:2px">Copy all content from the current active resume</div>
                </div>
            </label>
        </div>
        <div class="fg">
            <label>Resume Name</label>
            <input type="text" id="new-resume-name" placeholder="e.g. Full Stack Developer, Backend Engineer..." value="">
            <div class="ep-hint"><i class="fas fa-info-circle"></i> Name it by the role you're targeting</div>
        </div>`;

    openEditPanel('Resume Collection', '✚ Create New Resume', body, createNewResume);
}

function selectResumeType(type) {
    document.querySelectorAll('[id^=opt-]').forEach(el => {
        el.style.borderColor = 'var(--border)';
        el.style.background  = 'transparent';
    });
    const el = document.getElementById('opt-' + type);
    if (el) { el.style.borderColor = 'var(--accent)'; el.style.background = 'rgba(59,130,246,0.04)'; }
}

async function createNewResume() {
    const name = document.getElementById('new-resume-name')?.value.trim();
    if (!name) { toast('Please enter a name for the resume.', 'err'); return; }
    const type = document.querySelector('[name=resume-type]:checked')?.value || 'blank';

    let r;
    if (type === 'clone') {
        r = await api(`/api/resume-collection/clone/${CURRENT_RESUME_ID}`, { name });
        if (r.success) { closeEditPanel(); toast(`Cloned as "${name}"! Reloading…`); setTimeout(() => location.reload(), 1000); }
        else toast(r.message || 'Error cloning.', 'err');
    } else {
        r = await api('/api/resume-collection/create', { name });
        if (r.success) { closeEditPanel(); toast(`Created "${name}"! Reloading…`); setTimeout(() => location.reload(), 1000); }
        else toast(r.message || 'Error creating.', 'err');
    }
}

async function setActiveResume(id) {
    const r = await api(`/api/resume-collection/set-active/${id}`);
    if (r.success) { toast('Resume set as active! Reloading…'); setTimeout(() => location.reload(), 900); }
    else toast(r.message || 'Error', 'err');
}

function openResumePanel(id, name) {
    // Store target resume id in session/localStorage so admin edits that resume
    localStorage.setItem('editingResumeId', id);
    toast(`Now editing: "${name}" — scroll down to edit content.`);
    // Reload with resume id param
    window.location.href = window.location.pathname + '?rid=' + id;
}

function openRenameResume(id, currentName) {
    const item    = document.querySelector(`.resume-collection-item[data-id="${id}"]`);
    const nameEl  = document.getElementById(`rci-name-${id}`);
    const oldName = nameEl.textContent;

    // Replace text with inline input
    nameEl.innerHTML = `<input type="text" class="rci-name-input" id="rename-input-${id}"
        value="${escHtml(oldName)}" onkeydown="handleRenameKey(event,${id})"
        onblur="cancelRename(${id},'${escHtml(oldName)}')">
        <button onclick="saveRename(${id})" style="background:var(--accent);color:#fff;border:none;border-radius:5px;padding:4px 10px;font-size:11px;cursor:pointer;margin-left:6px">Save</button>
        <button onclick="cancelRename(${id},'${escHtml(oldName)}')" style="background:transparent;border:none;color:var(--muted);cursor:pointer;font-size:12px;margin-left:2px">✕</button>`;
    document.getElementById(`rename-input-${id}`)?.select();
}

function handleRenameKey(e, id) {
    if (e.key === 'Enter') saveRename(id);
    if (e.key === 'Escape') cancelRename(id, document.getElementById(`rename-input-${id}`)?.dataset.old || '');
}

async function saveRename(id) {
    const input = document.getElementById(`rename-input-${id}`);
    if (!input) return;
    const name = input.value.trim();
    if (!name) { toast('Name cannot be empty.', 'err'); return; }
    const r = await api(`/api/resume-collection/rename/${id}`, { name });
    if (r.success) {
        document.getElementById(`rci-name-${id}`).textContent = name;
        toast(`Renamed to "${name}"`);
    } else toast(r.message || 'Error', 'err');
}

function cancelRename(id, original) {
    const el = document.getElementById(`rci-name-${id}`);
    if (el) el.textContent = original;
}

async function cloneResume(id, sourceName) {
    const name = prompt(`Clone "${sourceName}" — enter a name for the copy:`, `Copy of ${sourceName}`);
    if (!name) return;
    const r = await api(`/api/resume-collection/clone/${id}`, { name: name.trim() });
    if (r.success) { toast(`Cloned as "${name}"! Reloading…`); setTimeout(() => location.reload(), 1000); }
    else toast(r.message || 'Error cloning.', 'err');
}

async function deleteResume(id, name) {
    confirmDelete(name, async () => {
        const r = await api(`/api/resume-collection/delete/${id}`);
        if (r.success) {
            document.querySelector(`.resume-collection-item[data-id="${id}"]`)?.remove();
            toast(`Deleted "${name}"`);
        } else toast(r.message || 'Error', 'err');
    });
}

// On load — check if we have a rid param to show which resume we're editing
(function checkEditingResume() {
    const params = new URLSearchParams(window.location.search);
    const rid    = params.get('rid');
    if (rid) {
        const item = document.querySelector(`.resume-collection-item[data-id="${rid}"]`);
        if (item) {
            item.style.outline = '2px solid var(--accent)';
            item.style.outlineOffset = '-2px';
            item.scrollIntoView({ behavior:'smooth', block:'center' });
        }
        // Show banner
        const banner = document.createElement('div');
        banner.style.cssText = 'position:fixed;top:58px;left:245px;right:0;z-index:150;background:#1e40af;color:#fff;padding:10px 24px;font-size:13px;font-weight:500;display:flex;align-items:center;justify-content:space-between';
        const name = item?.querySelector('.rci-name')?.textContent || 'Resume #' + rid;
        banner.innerHTML = `<span><i class="fas fa-edit" style="margin-right:8px"></i>Editing: <strong>${name}</strong> — all changes below apply to this resume</span>
            <a href="${window.location.pathname}" style="color:#93c5fd;font-size:12px">← Back to active resume</a>`;
        document.body.appendChild(banner);
    }
})();

function escHtml(str) {
    return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
</body>
</html>
<?php
function monthOpts(string $selected = ''): string {
    $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $out = '<option value="">Month</option>';
    foreach ($months as $m) {
        $sel = ($selected === $m) ? ' selected' : '';
        $out .= "<option value=\"{$m}\"{$sel}>{$m}</option>";
    }
    return $out;
}