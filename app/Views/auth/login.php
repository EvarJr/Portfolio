<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — evarPortfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Clash+Display:wght@400;500;600;700&family=Cabinet+Grotesk:wght@300;400;500;700&family=DM+Mono:wght@300;400&display=swap" rel="stylesheet">
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{
  --ink:#050810;--indigo:#4f46e5;--blue:#3b82f6;--purple:#8b5cf6;--cyan:#06b6d4;
  --g-accent:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 50%,#06b6d4 100%);
  --border:rgba(255,255,255,0.07);--border-p:rgba(99,102,241,0.3);
  --text:#f1f5f9;--text-2:#94a3b8;--text-3:#475569;
  --font-d:'Clash Display',sans-serif;--font-b:'Cabinet Grotesk',sans-serif;--font-m:'DM Mono',monospace;
}
html,body{height:100%;font-family:var(--font-b)}
body{
  background:var(--ink);color:var(--text);
  display:flex;align-items:center;justify-content:center;
  min-height:100vh;overflow:hidden;position:relative;
}

/* ── BACKGROUND ORBS ── */
.orb{position:fixed;border-radius:50%;pointer-events:none;filter:blur(80px);z-index:0}
.orb-1{width:500px;height:500px;top:-150px;right:-100px;background:radial-gradient(circle,rgba(99,102,241,0.2) 0%,transparent 70%);animation:orbFloat 9s ease-in-out infinite}
.orb-2{width:400px;height:400px;bottom:-100px;left:-100px;background:radial-gradient(circle,rgba(139,92,246,0.15) 0%,transparent 70%);animation:orbFloat 12s ease-in-out infinite reverse}
.orb-3{width:300px;height:300px;top:40%;left:30%;background:radial-gradient(circle,rgba(6,182,212,0.08) 0%,transparent 70%);animation:orbFloat 15s ease-in-out infinite}
@keyframes orbFloat{0%,100%{transform:translateY(0) scale(1)}50%{transform:translateY(-30px) scale(1.04)}}

/* ── SWIRL SVG ── */
.swirl{position:fixed;pointer-events:none;z-index:0;opacity:0.1}
.swirl-1{top:-10%;right:-5%;width:55%;height:115%}
.swirl-2{bottom:-10%;left:-5%;width:40%;height:80%;opacity:0.06;transform:rotate(180deg)}
.swirl-path{fill:none;stroke-linecap:round;transform-origin:50% 50%}
.swirl-path:nth-child(1){animation:swirlA 18s ease-in-out infinite}
.swirl-path:nth-child(2){animation:swirlA 23s ease-in-out infinite reverse}
.swirl-path:nth-child(3){animation:swirlB 27s ease-in-out infinite}
.swirl-path:nth-child(4){animation:swirlB 31s ease-in-out infinite reverse}
.swirl-path:nth-child(5){animation:swirlA 21s ease-in-out infinite}
.swirl-path:nth-child(6){animation:swirlB 25s ease-in-out infinite reverse}
.swirl-path:nth-child(7){animation:swirlA 29s ease-in-out infinite}
.swirl-path:nth-child(8){animation:swirlB 17s ease-in-out infinite reverse}
@keyframes swirlA{0%,100%{transform:rotate(0deg) scale(1)}30%{transform:rotate(9deg) scale(1.05)}70%{transform:rotate(-7deg) scale(0.96)}}
@keyframes swirlB{0%,100%{transform:rotate(0deg) scale(1)}40%{transform:rotate(-10deg) scale(1.04)}80%{transform:rotate(6deg) scale(0.97)}}

/* ── NOISE OVERLAY ── */
body::before{
  content:'';position:fixed;inset:0;z-index:0;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
  opacity:0.4;
}

/* ── LOGIN CARD ── */
.login-wrap{position:relative;z-index:10;width:100%;max-width:420px;padding:20px}
.login-card{
  background:linear-gradient(145deg,rgba(15,21,53,0.95),rgba(11,15,30,0.98));
  border:1px solid rgba(99,102,241,0.2);
  border-radius:24px;padding:40px 36px;
  box-shadow:
    0 0 0 1px rgba(99,102,241,0.08),
    0 32px 80px rgba(0,0,0,0.6),
    inset 0 1px 0 rgba(255,255,255,0.05);
  animation:cardIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}
@keyframes cardIn{from{opacity:0;transform:translateY(24px) scale(0.97)}to{opacity:1;transform:translateY(0) scale(1)}}

/* ── LOGO AREA ── */
.login-logo{
  width:52px;height:52px;border-radius:14px;
  background:var(--g-accent);
  display:flex;align-items:center;justify-content:center;
  font-size:22px;color:#fff;margin:0 auto 20px;
  box-shadow:0 0 0 1px rgba(99,102,241,0.4),0 8px 24px rgba(99,102,241,0.35);
}
.login-title{
  font-family:var(--font-d);font-size:26px;font-weight:700;
  color:var(--text);text-align:center;letter-spacing:-0.5px;margin-bottom:6px;
}
.login-subtitle{
  font-size:13.5px;color:var(--text-3);text-align:center;margin-bottom:28px;
  font-family:var(--font-m);
}

/* ── DEFAULT CREDENTIALS HINT ── */
.creds-hint{
  background:rgba(99,102,241,0.08);
  border:1px solid rgba(99,102,241,0.2);
  border-radius:10px;padding:10px 14px;
  margin-bottom:22px;
  display:flex;align-items:flex-start;gap:8px;
}
.creds-hint i{color:var(--indigo);font-size:13px;margin-top:2px;flex-shrink:0}
.creds-hint-text{font-size:12px;color:var(--text-2);line-height:1.5}
.creds-hint-text strong{color:#a5b4fc;font-weight:600}

/* ── FORM ── */
.form-group{margin-bottom:16px}
.form-label{
  display:block;font-size:11px;font-weight:600;
  color:var(--text-2);letter-spacing:1px;text-transform:uppercase;
  margin-bottom:7px;font-family:var(--font-m);
}
.form-input{
  width:100%;padding:12px 16px;
  background:rgba(255,255,255,0.04);
  border:1px solid rgba(99,102,241,0.2);
  border-radius:11px;
  font-size:14px;color:var(--text);
  font-family:var(--font-b);
  outline:none;transition:all 0.2s;
}
.form-input::placeholder{color:var(--text-3)}
.form-input:focus{
  border-color:rgba(99,102,241,0.5);
  background:rgba(99,102,241,0.06);
  box-shadow:0 0 0 3px rgba(99,102,241,0.1);
}
.input-wrap{position:relative}
.input-icon{
  position:absolute;left:14px;top:50%;transform:translateY(-50%);
  color:var(--text-3);font-size:13px;
}
.form-input.with-icon{padding-left:40px}
.toggle-pw{
  position:absolute;right:14px;top:50%;transform:translateY(-50%);
  background:none;border:none;cursor:pointer;
  color:var(--text-3);font-size:13px;padding:0;
  transition:color 0.2s;
}
.toggle-pw:hover{color:var(--text-2)}

/* ── ERROR ── */
.error-msg{
  background:rgba(239,68,68,0.08);
  border:1px solid rgba(239,68,68,0.25);
  border-radius:10px;padding:10px 14px;
  margin-bottom:18px;
  display:flex;align-items:center;gap:8px;
  font-size:13px;color:#fca5a5;
}
.error-msg i{font-size:13px;flex-shrink:0}

/* ── BUTTON ── */
.btn-login{
  width:100%;padding:13px;
  background:var(--g-accent);
  color:#fff;border:none;border-radius:50px;
  font-family:var(--font-d);font-size:15px;font-weight:700;
  cursor:pointer;letter-spacing:0.3px;
  box-shadow:0 4px 22px rgba(99,102,241,0.42);
  transition:all 0.25s;margin-top:6px;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(99,102,241,0.55)}
.btn-login:active{transform:translateY(0);box-shadow:0 4px 16px rgba(99,102,241,0.3)}

/* ── FOOTER LINK ── */
.login-footer{text-align:center;margin-top:22px}
.login-footer a{
  font-size:12.5px;color:var(--text-3);text-decoration:none;
  display:inline-flex;align-items:center;gap:6px;
  transition:color 0.2s;font-family:var(--font-m);
}
.login-footer a:hover{color:#a5b4fc}

/* ── GRID OVERLAY ── */
.grid-overlay{
  position:fixed;inset:0;z-index:0;pointer-events:none;
  background-image:
    linear-gradient(rgba(99,102,241,0.03) 1px,transparent 1px),
    linear-gradient(90deg,rgba(99,102,241,0.03) 1px,transparent 1px);
  background-size:40px 40px;
}
</style>
</head>
<body>

<!-- Background layers -->
<div class="orb orb-1"></div>
<div class="orb orb-2"></div>
<div class="orb orb-3"></div>
<div class="grid-overlay"></div>

<!-- Swirl 1 — top right -->
<svg class="swirl swirl-1" viewBox="0 0 600 800" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
  <path class="swirl-path" d="M300,400 C160,180 500,80 440,300 C380,520 100,470 160,270 C220,70 540,130 510,360 C480,590 120,570 140,380 C160,190 560,220 530,450 C500,680 90,650 110,430" stroke="#8b5cf6" stroke-width="30"/>
  <path class="swirl-path" d="M300,400 C180,210 480,100 428,306 C376,512 118,464 172,272 C226,80 528,140 500,364 C472,588 128,564 146,376 C164,188 548,228 520,452 C492,676 98,648 116,428" stroke="#6366f1" stroke-width="22"/>
  <path class="swirl-path" d="M300,400 C196,235 464,118 418,312 C372,506 134,458 183,273 C232,88 517,148 490,368 C463,588 136,558 152,372 C168,186 537,234 512,454 C487,674 106,646 122,426" stroke="#3b82f6" stroke-width="16"/>
  <path class="swirl-path" d="M300,400 C210,255 450,134 408,318 C366,502 148,452 194,274 C240,96 507,155 480,370 C453,585 143,552 158,368 C173,184 527,240 504,456 C481,672 113,644 128,424" stroke="#06b6d4" stroke-width="11"/>
  <path class="swirl-path" d="M300,400 C222,272 436,149 397,323 C358,497 161,447 204,275 C247,103 498,161 472,373 C446,585 150,547 164,364 C178,181 518,245 496,457 C474,669 119,642 133,422" stroke="#a78bfa" stroke-width="7"/>
  <path class="swirl-path" d="M300,400 C232,287 424,162 387,327 C350,492 172,442 214,276 C256,110 490,167 464,375 C438,583 156,542 169,361 C182,180 510,249 490,458 C470,667 124,640 138,421" stroke="#c4b5fd" stroke-width="4"/>
  <path class="swirl-path" d="M300,400 C241,299 413,174 378,330 C343,486 182,437 222,277 C262,117 483,172 457,377 C431,582 161,538 173,358 C185,178 503,253 484,459 C465,665 128,638 142,420" stroke="#7c3aed" stroke-width="2.5"/>
  <path class="swirl-path" d="M300,400 C249,310 403,184 370,333 C337,482 191,433 230,278 C269,123 476,177 451,379 C426,581 166,534 177,356 C188,178 496,257 479,460 C462,663 132,636 146,419" stroke="#4f46e5" stroke-width="1.5"/>
</svg>

<!-- Swirl 2 — bottom left -->
<svg class="swirl swirl-2" viewBox="0 0 400 500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
  <path class="swirl-path" d="M200,250 C110,120 330,60 300,195 C270,330 80,295 112,172 C144,49 360,90 335,228 C310,366 70,340 92,216 C114,92 380,136 355,274" stroke="#06b6d4" stroke-width="24"/>
  <path class="swirl-path" d="M200,250 C122,136 315,74 288,200 C261,326 92,298 121,176 C150,54 350,97 326,232 C302,367 78,338 98,215 C118,92 370,142 347,277" stroke="#8b5cf6" stroke-width="16"/>
  <path class="swirl-path" d="M200,250 C132,150 302,86 278,204 C254,322 103,300 130,179 C157,58 342,102 318,234 C294,366 85,336 104,214 C123,92 362,147 340,278" stroke="#3b82f6" stroke-width="10"/>
  <path class="swirl-path" d="M200,250 C140,161 291,97 268,208 C245,319 112,302 138,182 C164,62 335,107 311,236 C287,365 90,334 109,213 C128,92 355,151 334,279" stroke="#c4b5fd" stroke-width="6"/>
  <path class="swirl-path" d="M200,250 C147,171 281,107 259,211 C237,315 120,303 145,184 C170,65 329,111 305,238 C281,365 95,332 113,212 C131,92 348,154 328,280" stroke="#67e8f9" stroke-width="3"/>
</svg>

<!-- LOGIN CARD -->
<div class="login-wrap">
  <div class="login-card">

    <div class="login-logo"><i class="fas fa-file-alt"></i></div>
    <div class="login-title">Welcome back</div>
    <div class="login-subtitle">evarPortfolio · Admin</div>

    <?php if(isset($error) && $error): ?>
    <div class="error-msg">
      <i class="fas fa-exclamation-circle"></i>
      <?= esc($error) ?>
    </div>
    <?php endif; ?>

    <?php if(!isset($error) || !$error): ?>
    <div class="creds-hint">
      <i class="fas fa-shield-alt"></i>
      <div class="creds-hint-text">
        Default: <strong>admin</strong> / <strong>admin123</strong><br>
        Change your password after first login.
      </div>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="POST">
      <?= csrf_field() ?>

      <div class="form-group">
        <label class="form-label">Username</label>
        <div class="input-wrap">
          <i class="fas fa-user input-icon"></i>
          <input type="text" name="username" class="form-input with-icon"
            placeholder="Enter username" value="<?= esc(old('username')) ?>"
            autocomplete="username" required>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-wrap">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" name="password" id="pw-input"
            class="form-input with-icon"
            placeholder="Enter password"
            autocomplete="current-password" required>
          <button type="button" class="toggle-pw" onclick="togglePw()" id="toggle-pw-btn">
            <i class="fas fa-eye" id="pw-eye"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="btn-login">
        <i class="fas fa-arrow-right-to-bracket"></i> Sign In
      </button>
    </form>

    <div class="login-footer">
      <a href="<?= base_url() ?>"><i class="fas fa-arrow-left"></i> View Portfolio</a>
    </div>

  </div>
</div>

<script>
function togglePw() {
  const input = document.getElementById('pw-input');
  const eye   = document.getElementById('pw-eye');
  const isHidden = input.type === 'password';
  input.type = isHidden ? 'text' : 'password';
  eye.className = isHidden ? 'fas fa-eye-slash' : 'fas fa-eye';
}
</script>
</body>
</html>