<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php 
shell_exec('sudo /opt/de_GWD/ui-saveDOH');
shell_exec('sudo /opt/de_GWD/ui-dnsCHNW');
shell_exec('sudo systemctl restart v2dns');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>