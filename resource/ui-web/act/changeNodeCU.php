<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodeCUnum = $_GET['nodeCUnum'];
putenv("nodeCUnum=$nodeCUnum");
exec('sudo /opt/de_GWD/ui-changeNodeCU $nodeCUnum &');
?>
<?php }?>