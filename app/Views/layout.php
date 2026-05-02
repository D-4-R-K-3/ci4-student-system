<!DOCTYPE html>
<html lang="en" data-theme="dark" data-bg="grid">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 Student System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        [data-theme="dark"] {
            --bg-1: #080812; --bg-2: #0d0d1a;
            --glass: rgba(10,10,25,.55);
            --glass-bd: rgba(255,255,255,.1);
            --glass-hover: rgba(10,10,25,.65);
            --topbar: rgba(6,6,18,.88);
            --text: #eeeeff; --text-sub: #9090b8; --text-muted: #4a4a6a;
            --accent: #7b68ff; --accent2: #ff6b9d;
            --green: #43e8a0; --green-dim: rgba(67,232,160,.1); --green-bd: rgba(67,232,160,.25);
            --red: #ff6b6b; --red-dim: rgba(255,107,107,.1); --red-bd: rgba(255,107,107,.25);
            --purple-dim: rgba(123,104,255,.12); --purple-bd: rgba(123,104,255,.3);
            --glow: rgba(123,104,255,.2);
            --grid-color: rgba(255,255,255,.04);
            --dot-color: rgba(255,255,255,.06);
        }
        [data-theme="light"] {
            --bg-1: #eef0ff; --bg-2: #e4e6ff;
            --glass: rgba(255,255,255,.55);
            --glass-bd: rgba(180,180,255,.35);
            --glass-hover: rgba(255,255,255,.75);
            --topbar: rgba(238,240,255,.88);
            --text: #12122a; --text-sub: #3a3a6a; --text-muted: #8888aa;
            --accent: #5b4ef0; --accent2: #e0407a;
            --green: #00c97a; --green-dim: rgba(0,201,122,.08); --green-bd: rgba(0,201,122,.25);
            --red: #e05050; --red-dim: rgba(224,80,80,.08); --red-bd: rgba(224,80,80,.25);
            --purple-dim: rgba(91,78,240,.08); --purple-bd: rgba(91,78,240,.25);
            --glow: rgba(91,78,240,.12);
            --grid-color: rgba(0,0,0,.06);
            --dot-color: rgba(0,0,0,.08);
        }

        body {
            background: var(--bg-1);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background .3s, color .3s;
            position: relative;
            overflow-x: hidden;
        }

        /* ── Background Layers ── */
        .bg-layer {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 0;
            transition: opacity .4s;
        }

        /* Gradient glow */
        .bg-glow {
            background:
                radial-gradient(ellipse at 15% 15%, rgba(123,104,255,.18) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 85%, rgba(255,107,157,.12) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 50%, rgba(67,232,160,.06) 0%, transparent 65%);
        }
        [data-theme="light"] .bg-glow {
            background:
                radial-gradient(ellipse at 15% 15%, rgba(91,78,240,.1) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 85%, rgba(224,64,122,.07) 0%, transparent 55%);
        }

        /* Grid pattern */
        [data-bg="grid"] .bg-pattern {
            background-image:
                linear-gradient(var(--grid-color) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-color) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Dots pattern */
        [data-bg="dots"] .bg-pattern {
            background-image: radial-gradient(circle, var(--dot-color) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* Lines pattern */
        [data-bg="lines"] .bg-pattern {
            background-image: repeating-linear-gradient(
                -45deg,
                transparent, transparent 20px,
                var(--grid-color) 20px, var(--grid-color) 21px
            );
        }

        /* Crosshatch */
        [data-bg="crosshatch"] .bg-pattern {
            background-image:
                repeating-linear-gradient(0deg, transparent, transparent 24px, var(--grid-color) 24px, var(--grid-color) 25px),
                repeating-linear-gradient(90deg, transparent, transparent 24px, var(--grid-color) 24px, var(--grid-color) 25px);
        }

        /* None / custom image */
        [data-bg="none"] .bg-pattern { opacity: 0; }
        [data-bg="custom"] .bg-pattern { opacity: 0; }

        /* Custom image */
        .bg-custom-img {
            position: fixed; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; pointer-events: none; z-index: 0;
            transition: opacity .4s;
        }
        [data-bg="custom"] .bg-custom-img { opacity: 1; }

        /* ── Topbar ── */
        .topbar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; height: 58px;
            background: var(--topbar);
            border-bottom: 1px solid var(--glass-bd);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-brand {
            display: flex; align-items: center; gap: 10px;
            font-weight: 700; font-size: 15px; color: var(--text);
            text-decoration: none; letter-spacing: -.3px;
        }
        .brand-icon {
            width: 30px; height: 30px; border-radius: 9px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; box-shadow: 0 4px 14px var(--glow);
            flex-shrink: 0;
        }
        .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar-time {
            font-family: 'JetBrains Mono', monospace; font-size: 11px;
            color: var(--text-muted); background: var(--glass);
            border: 1px solid var(--glass-bd); border-radius: 6px;
            padding: 4px 10px;
        }

        /* ── Toggle ── */
        .toggle { display: flex; align-items: center; gap: 7px; cursor: pointer; user-select: none; }
        .toggle-track {
            width: 42px; height: 23px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            position: relative; transition: all .3s;
            box-shadow: 0 2px 10px var(--glow);
        }
        [data-theme="light"] .toggle-track { background: var(--glass-bd); box-shadow: none; }
        .toggle-thumb {
            width: 17px; height: 17px; background: #fff;
            border-radius: 50%; position: absolute; top: 3px; left: 3px;
            transition: transform .3s; box-shadow: 0 2px 4px rgba(0,0,0,.2);
        }
        [data-theme="dark"] .toggle-thumb { transform: translateX(19px); }
        .toggle-label { font-size: 11px; font-weight: 500; color: var(--text-muted); letter-spacing: .04em; }

        /* ── Settings Button ── */
        .settings-btn {
            width: 34px; height: 34px; border-radius: 9px;
            background: var(--glass); border: 1px solid var(--glass-bd);
            color: var(--text-sub); display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all .2s; font-size: 15px;
            backdrop-filter: blur(8px);
        }
        .settings-btn:hover { background: var(--glass-hover); color: var(--text); transform: rotate(45deg); }

        /* ── Settings Panel ── */
        .settings-panel {
            position: fixed; top: 68px; right: 20px;
            width: 280px; background: var(--topbar);
            border: 1px solid var(--glass-bd); border-radius: 14px;
            backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 16px 48px rgba(0,0,0,.3);
            z-index: 200; padding: 20px;
            opacity: 0; transform: translateY(-10px) scale(.97);
            pointer-events: none; transition: all .2s;
        }
        .settings-panel.open {
            opacity: 1; transform: translateY(0) scale(1);
            pointer-events: all;
        }
        .settings-title {
            font-size: 12px; font-weight: 600; letter-spacing: .08em;
            text-transform: uppercase; color: var(--text-muted);
            margin-bottom: 14px;
        }
        .settings-section { margin-bottom: 18px; }
        .settings-section-label {
            font-size: 11px; color: var(--text-muted); margin-bottom: 8px;
            font-family: 'JetBrains Mono', monospace;
        }
        .bg-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .bg-opt {
            height: 52px; border-radius: 8px; cursor: pointer;
            border: 2px solid var(--glass-bd); overflow: hidden;
            transition: all .2s; position: relative;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; color: var(--text-muted);
            background: var(--glass);
        }
        .bg-opt:hover { border-color: var(--accent); }
        .bg-opt.active { border-color: var(--accent); box-shadow: 0 0 0 1px var(--accent); }
        .bg-opt .opt-preview {
            position: absolute; inset: 0; opacity: .6;
        }
        .bg-opt span { position: relative; z-index: 1; font-weight: 600; font-size: 9px; letter-spacing: .04em; text-transform: uppercase; }

        /* previews */
        .preview-grid { background-image: linear-gradient(rgba(123,104,255,.3) 1px,transparent 1px), linear-gradient(90deg,rgba(123,104,255,.3) 1px,transparent 1px); background-size: 12px 12px; }
        .preview-dots { background-image: radial-gradient(circle, rgba(123,104,255,.5) 1px, transparent 1px); background-size: 8px 8px; }
        .preview-lines { background-image: repeating-linear-gradient(-45deg, transparent, transparent 5px, rgba(123,104,255,.3) 5px, rgba(123,104,255,.3) 6px); }
        .preview-crosshatch { background-image: repeating-linear-gradient(0deg,transparent,transparent 6px,rgba(123,104,255,.3) 6px,rgba(123,104,255,.3) 7px), repeating-linear-gradient(90deg,transparent,transparent 6px,rgba(123,104,255,.3) 6px,rgba(123,104,255,.3) 7px); }

        /* Upload */
        .upload-area {
            border: 2px dashed var(--glass-bd); border-radius: 10px;
            padding: 16px; text-align: center; cursor: pointer;
            transition: all .2s; background: var(--glass);
        }
        .upload-area:hover { border-color: var(--accent); background: var(--purple-dim); }
        .upload-area p { font-size: 11px; color: var(--text-muted); margin-top: 6px; }
        .upload-area .upload-icon { font-size: 22px; }
        #bgUpload { display: none; }

        /* ── Container ── */
        .container { max-width: 1400px; margin: 0 auto; padding: 40px; flex: 1; position: relative; z-index: 1; }

        /* ── Page Header ── */
        .page-header { margin-bottom: 32px; }
        .page-title { font-size: 30px; font-weight: 700; letter-spacing: -.6px; margin-bottom: 6px; }
        .page-title span {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .page-sub { font-size: 12px; color: var(--text-muted); font-family: 'JetBrains Mono', monospace; }

        /* ── Actions Bar ── */
        .actions-bar { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; gap: 12px; }
        .actions-left { display: flex; gap: 8px; }

        /* ── Buttons ── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: 8px; font-size: 13px;
            font-weight: 500; cursor: pointer; text-decoration: none;
            transition: all .2s; border: 1px solid transparent;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary { background: linear-gradient(135deg, var(--accent), var(--accent2)); color: #fff; box-shadow: 0 4px 14px var(--glow); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px var(--glow); opacity: .9; }
        .btn-ghost { background: var(--glass); border-color: var(--glass-bd); color: var(--text-sub); backdrop-filter: blur(8px); }
        .btn-ghost:hover { background: var(--glass-hover); color: var(--text); }
        .btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 6px; }
        .btn-edit { border-color: var(--purple-bd); color: var(--accent); background: var(--purple-dim); }
        .btn-edit:hover { background: rgba(123,104,255,.2); }
        .btn-delete { border-color: var(--red-bd); color: var(--red); background: var(--red-dim); }
        .btn-delete:hover { background: rgba(255,107,107,.2); }
        .btn-success { background: linear-gradient(135deg, var(--green), #00c9a7); color: #000; font-weight: 600; box-shadow: 0 4px 14px var(--green-dim); }
        .btn-success:hover { transform: translateY(-1px); opacity: .9; }
        .btn-cancel { background: var(--glass); border-color: var(--glass-bd); color: var(--text-muted); }
        .btn-cancel:hover { background: var(--glass-hover); }

        /* ── Flash ── */
        .flash { padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 13px; display: flex; align-items: center; gap: 8px; backdrop-filter: blur(8px); }
        .flash-success { background: var(--green-dim); border: 1px solid var(--green-bd); color: var(--green); }
        .flash-error   { background: var(--red-dim);   border: 1px solid var(--red-bd);   color: var(--red); }

        /* ── Glass Card ── */
        .card { background: var(--glass); border: 1px solid var(--glass-bd); border-radius: 16px; overflow: hidden; backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); box-shadow: 0 8px 32px rgba(0,0,0,.2); }
        .card-header { background: rgba(255,255,255,.03); border-bottom: 1px solid var(--glass-bd); padding: 16px 24px; display: flex; align-items: center; gap: 10px; }
        .card-title { font-size: 14px; font-weight: 600; }

        /* ── Badges ── */
        .badge { border-radius: 6px; padding: 3px 10px; font-size: 11px; font-weight: 500; border: 1px solid; font-family: 'JetBrains Mono', monospace; }
        .badge-gray   { background: var(--glass); border-color: var(--glass-bd); color: var(--text-muted); }
        .badge-purple { background: var(--purple-dim); border-color: var(--purple-bd); color: var(--accent); }
        .badge-green  { background: var(--green-dim); border-color: var(--green-bd); color: var(--green); }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { border-bottom: 1px solid var(--glass-bd); }
        th { text-align: left; padding: 14px 24px; font-size: 11px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: var(--text-muted); }
        td { padding: 14px 24px; border-bottom: 1px solid var(--glass-bd); font-size: 13px; color: var(--text-sub); }
        tr:last-child td { border-bottom: none; }
        tbody tr { transition: background .15s; }
        tbody tr:hover td { background: var(--glass-hover); }
        .td-num  { color: var(--text-muted); font-family: 'JetBrains Mono', monospace; font-size: 12px; }
        .td-main { color: var(--text); font-weight: 600; }
        .td-actions { display: flex; gap: 6px; }
        .empty-row td { text-align: center; padding: 60px 24px; color: var(--text-muted); }

        /* ── Form Card (glass) ── */
        .form-card { background: var(--glass); border: 1px solid var(--glass-bd); border-radius: 16px; padding: 36px; backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); box-shadow: 0 8px 40px rgba(0,0,0,.25); width: min(92vw, 820px); max-width: 820px; }
        .form-title { font-size: 22px; font-weight: 700; margin-bottom: 4px; letter-spacing: -.4px; }
        .form-title span { background: linear-gradient(135deg, var(--accent), var(--accent2)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .form-sub { font-size: 12px; color: var(--text-muted); font-family: 'JetBrains Mono', monospace; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 8px; }
        .form-control { width: 100%; background: var(--glass); border: 1px solid var(--glass-bd); border-radius: 8px; color: var(--text); font-family: 'Inter', sans-serif; font-size: 14px; padding: 11px 14px; outline: none; transition: border-color .2s, box-shadow .2s; backdrop-filter: blur(8px); }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--purple-dim); }
        .form-control::placeholder { color: var(--text-muted); }
        .form-actions { display: flex; gap: 10px; margin-top: 32px; }
        .alert-danger { background: var(--red-dim); border: 1px solid var(--red-bd); color: var(--red); border-radius: 10px; padding: 12px 16px; margin-bottom: 24px; font-size: 13px; }

        /* ── Footer ── */
        .footer { border-top: 1px solid var(--glass-bd); padding: 18px 40px; display: flex; flex-wrap: wrap; gap: 8px; align-items: center; background: var(--topbar); backdrop-filter: blur(20px); position: relative; z-index: 1; }
        .tag { background: var(--glass); border: 1px solid var(--glass-bd); border-radius: 20px; padding: 4px 12px; font-size: 11px; color: var(--text-muted); font-family: 'JetBrains Mono', monospace; }
        .tag-green  { background: var(--green-dim); border-color: var(--green-bd); color: var(--green); }
        .tag-purple { background: var(--purple-dim); border-color: var(--purple-bd); color: var(--accent); }

        /* ── Toast Notifications ── */
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 400px; }
        .toast { background: var(--glass); border: 1px solid var(--glass-bd); border-radius: 12px; padding: 16px 20px; margin-bottom: 12px; display: flex; align-items: center; gap: 12px; backdrop-filter: blur(20px); box-shadow: 0 8px 32px rgba(0,0,0,.3); animation: slideIn 0.3s ease-out; min-width: 300px; }
        .toast.success { border-color: var(--green-bd); background: var(--green-dim); }
        .toast.success .toast-icon { color: var(--green); font-weight: bold; }
        .toast.success .toast-message { color: var(--green); }
        .toast.error { border-color: var(--red-bd); background: var(--red-dim); }
        .toast.error .toast-icon { color: var(--red); font-weight: bold; }
        .toast.error .toast-message { color: var(--red); }
        .toast-icon { font-size: 18px; flex-shrink: 0; }
        .toast-message { font-size: 13px; flex: 1; font-weight: 500; }
        .toast-close { cursor: pointer; color: var(--text-muted); font-size: 16px; flex-shrink: 0; }
        .toast-close:hover { color: var(--text); }

        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(400px); opacity: 0; }
        }
        .toast.hide { animation: slideOut 0.3s ease-out forwards; }
    </style>
</head>
<body>

<!-- Background layers -->
<div class="bg-layer bg-glow"></div>
<div class="bg-layer bg-pattern"></div>
<div class="bg-custom-img" id="customBg"></div>

<!-- Toast Notifications Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Settings Panel -->
<div class="settings-panel" id="settingsPanel">
    <div class="settings-title">⚙ Appearance</div>

    <div class="settings-section">
        <div class="settings-section-label">// background pattern</div>
        <div class="bg-options">
            <div class="bg-opt active" data-bg="grid" onclick="setBg('grid', this)">
                <div class="opt-preview preview-grid"></div>
                <span>Grid</span>
            </div>
            <div class="bg-opt" data-bg="dots" onclick="setBg('dots', this)">
                <div class="opt-preview preview-dots"></div>
                <span>Dots</span>
            </div>
            <div class="bg-opt" data-bg="lines" onclick="setBg('lines', this)">
                <div class="opt-preview preview-lines"></div>
                <span>Lines</span>
            </div>
            <div class="bg-opt" data-bg="crosshatch" onclick="setBg('crosshatch', this)">
                <div class="opt-preview preview-crosshatch"></div>
                <span>Cross</span>
            </div>
            <div class="bg-opt" data-bg="none" onclick="setBg('none', this)">
                <span>None</span>
            </div>
            <div class="bg-opt" data-bg="custom" onclick="setBg('custom', this)">
                <span>📷 Custom</span>
            </div>
        </div>
    </div>

    <div class="settings-section">
        <div class="settings-section-label">// upload background</div>
        <div class="upload-area" onclick="document.getElementById('bgUpload').click()">
            <div class="upload-icon">🖼</div>
            <p>Click to upload image</p>
        </div>
        <input type="file" id="bgUpload" accept="image/*">
    </div>
</div>

<!-- Topbar -->
<div class="topbar">
    <a class="topbar-brand" href="/ci4-student-system/public/students">
        <div class="brand-icon">🎓</div>
        CI4 Student System
    </a>
    <div class="topbar-right">
        <span class="topbar-time" id="dt"></span>
        <div class="toggle" onclick="toggleTheme()">
            <div class="toggle-track"><div class="toggle-thumb"></div></div>
            <span class="toggle-label" id="tl">Dark</span>
        </div>
        <div class="settings-btn" id="settingsBtn" onclick="toggleSettings()">⚙</div>
    </div>
</div>

<!-- Main content -->
<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flash flash-success">✓ <?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="flash flash-error">✗ <?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?= $this->renderSection('content') ?>
</div>

<script>
    // Clock
    function tick() {
        const n = new Date();
        const D = ['SUN','MON','TUE','WED','THU','FRI','SAT'];
        const M = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
        let h = n.getHours(), ap = h >= 12 ? 'PM' : 'AM';
        h = h % 12 || 12;
        const mm = String(n.getMinutes()).padStart(2,'0');
        document.getElementById('dt').textContent =
            `${D[n.getDay()]} ${M[n.getMonth()]} ${n.getDate()} — ${String(h).padStart(2,'0')}:${mm} ${ap}`;
    }
    tick(); setInterval(tick, 1000);

    // Dark mode
    function toggleTheme() {
        const h = document.documentElement;
        const dark = h.getAttribute('data-theme') === 'dark';
        h.setAttribute('data-theme', dark ? 'light' : 'dark');
        document.getElementById('tl').textContent = dark ? 'Light' : 'Dark';
        localStorage.setItem('theme', dark ? 'light' : 'dark');
    }
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', savedTheme);
    document.getElementById('tl').textContent = savedTheme === 'dark' ? 'Dark' : 'Light';

    // Settings panel
    function toggleSettings() {
        document.getElementById('settingsPanel').classList.toggle('open');
    }
    document.addEventListener('click', function(e) {
        const panel = document.getElementById('settingsPanel');
        const btn = document.getElementById('settingsBtn');
        if (!panel.contains(e.target) && !btn.contains(e.target)) {
            panel.classList.remove('open');
        }
    });

    // Background pattern
    function setBg(type, el) {
        document.documentElement.setAttribute('data-bg', type);
        localStorage.setItem('bg', type);
        document.querySelectorAll('.bg-opt').forEach(o => o.classList.remove('active'));
        el.classList.add('active');
        if (type === 'custom') document.getElementById('bgUpload').click();
    }
    const savedBg = localStorage.getItem('bg') || 'grid';
    document.documentElement.setAttribute('data-bg', savedBg);
    const activeOpt = document.querySelector(`[data-bg="${savedBg}"]`);
    if (activeOpt) {
        document.querySelectorAll('.bg-opt').forEach(o => o.classList.remove('active'));
        activeOpt.classList.add('active');
    }

    // Custom background upload
    document.getElementById('bgUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            const url = ev.target.result;
            document.getElementById('customBg').style.backgroundImage = `url(${url})`;
            document.getElementById('customBg').style.backgroundSize = 'cover';
            document.getElementById('customBg').style.backgroundPosition = 'center';
            localStorage.setItem('customBgUrl', url);
            document.documentElement.setAttribute('data-bg', 'custom');
            localStorage.setItem('bg', 'custom');
        };
        reader.readAsDataURL(file);
    });
    const savedCustomBg = localStorage.getItem('customBgUrl');
    if (savedCustomBg) {
        document.getElementById('customBg').style.backgroundImage = `url(${savedCustomBg})`;
        document.getElementById('customBg').style.backgroundSize = 'cover';
        document.getElementById('customBg').style.backgroundPosition = 'center';
    }

    // Toast Notifications
    function showToast(message, type = 'success', duration = 4000) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <span class="toast-icon">${type === 'success' ? '✓' : '✗'}</span>
            <span class="toast-message">${message}</span>
            <span class="toast-close" onclick="this.parentElement.remove()">×</span>
        `;
        container.appendChild(toast);
        
        // Auto remove after duration
        setTimeout(() => {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    // Show flash messages as toasts on page load
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session()->getFlashdata('success')): ?>
            showToast('<?= addslashes(session()->getFlashdata('success')) ?>', 'success', 4000);
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            showToast('<?= addslashes(session()->getFlashdata('error')) ?>', 'error', 4000);
        <?php endif; ?>
    });
</script>
</body>
</html>