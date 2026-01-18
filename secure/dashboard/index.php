
<?php session_start(); ?>
<link rel="stylesheet" href="../../style.css">
<button class="toggle" onclick="toggleDark()">🌙</button>

<div class="container">
<h2>Dashboard Aman</h2>
<p>Selamat datang, Anda berhasil login.</p>
<ul>
 <li><a href="../comment.php">Komentar Aman</a></li>
 <li><a href="../file.php?file=about.txt">File Viewer Aman</a></li>
</ul>
</div>

<script>
function toggleDark(){
 document.body.classList.toggle('dark');
}
</script>
