<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /opt/de_GWD/ui-ddns3322off &');
?>
<?php }?>