<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGnum = $_GET['WGnum'];
putenv("keyNUM=$WGnum");
exec('sudo /opt/de_GWD/ui-WGgenCkey $keyNUM');
?>
<?php }?>