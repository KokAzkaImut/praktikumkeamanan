
<link rel="stylesheet" href="../style.css">
<div class="container">
<h2>Secure File Viewer</h2>
<div class="result">
<?php
$allowed = ["about.txt","help.txt"];
if(in_array($_GET['file'],$allowed)){
 include("files/".$_GET['file']);
}else{
 echo "File tidak diizinkan";
}
?>
</div>
</div>
