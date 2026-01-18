<?php
session_start();

$mode = isset($_GET['mode']) ? $_GET['mode'] : 'vulnerable';
$page = isset($_GET['page']) ? $_GET['page'] : 'login';

$allowed_pages = ['login', 'xss', 'lfi'];
if (!in_array($page, $allowed_pages)) {
    $page = 'login';
}

$target_file = "$mode/$page.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Security Testing Lab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="cyber-shell">

    <!-- ================= SIDEBAR ================= -->
    <aside class="cyber-sidebar">

        <div class="brand">
            <div class="logo">
                <i class="fas fa-shield-halved"></i>
            </div>
            <h2>SECURITY LAB</h2>
            <span style="font-size:.65rem;color:#94a3b8;">Web Vulnerability Simulator</span>
        </div>

        <nav class="cyber-nav">
            <a href="?mode=<?= $mode ?>&page=login"
               class="nav-item <?= $page == 'login' ? 'active' : '' ?>">
                <i class="fas fa-lock"></i> Auth Bypass
            </a>

            <a href="?mode=<?= $mode ?>&page=xss"
               class="nav-item <?= $page == 'xss' ? 'active' : '' ?>">
                <i class="fas fa-code"></i> XSS Injection
            </a>

            <a href="?mode=<?= $mode ?>&page=lfi"
               class="nav-item <?= $page == 'lfi' ? 'active' : '' ?>">
                <i class="fas fa-folder-open"></i> LFI / Traversal
            </a>
        </nav>

        <!-- MODE SWITCH -->
        <div class="mode-switch">
            <a href="?mode=vulnerable&page=<?= $page ?>"
               class="mode vulnerable <?= $mode == 'vulnerable' ? 'active' : '' ?>">
                VULNERABLE
            </a>

            <a href="?mode=secure&page=<?= $page ?>"
               class="mode secure <?= $mode == 'secure' ? 'active' : '' ?>">
                SECURE
            </a>
        </div>

    </aside>

    <!-- ================= MAIN ================= -->
    <main class="cyber-main">

        <!-- HEADER -->
        <header class="cyber-header">
            <div>
                <h1>Web Application Security Test</h1>
                <p style="font-size:.75rem;color:#94a3b8;">
                    Environment Mode: <?= strtoupper($mode) ?>
                </p>
            </div>

            <div class="status <?= $mode == 'vulnerable' ? 'danger' : 'safe' ?>">
                <?= $mode == 'vulnerable'
                    ? '<i class="fas fa-triangle-exclamation"></i> SYSTEM AT RISK'
                    : '<i class="fas fa-circle-check"></i> SYSTEM SECURED' ?>
            </div>
        </header>

        <!-- ================= GRID ================= -->
        <section class="cyber-grid">

            <div class="panel wide">
                <h3>Attack Simulation Panel</h3>
                <p style="font-size:.8rem;color:#94a3b8;">
                    Modul ini digunakan untuk mensimulasikan serangan keamanan web
                    dalam lingkungan terkontrol untuk tujuan edukasi.
                </p>
            </div>

            <div class="panel">
                <h3>Threat Level</h3>
                <span class="big danger">
                    <?= $mode == 'vulnerable' ? 'HIGH' : 'LOW' ?>
                </span>
            </div>

            <div class="panel">
                <h3>Security Status</h3>
                <span class="big <?= $mode == 'vulnerable' ? 'danger' : 'safe' ?>">
                    <?= $mode == 'vulnerable' ? 'UNSECURED' : 'PROTECTED' ?>
                </span>
            </div>

            <!-- ================= MAIN CONTENT ================= -->
            <div class="panel wide">
                <h3>Execution Console</h3>

                <div style="margin-top:20px;">
                    <?php
                    if (file_exists($target_file)) {
                        include($target_file);
                    } else {
                        echo "<p style='color:red'>File not found.</p>";
                    }
                    ?>
                </div>
            </div>

        </section>

        <!-- FOOTER -->
        <footer class="cyber-footer">
            © 2026 — Security Testing Lab |
            Muhammad Rikza Rizqi Al Azka
        </footer>

    </main>

</div>

</body>
</html>
