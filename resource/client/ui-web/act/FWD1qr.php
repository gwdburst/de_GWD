<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$FWD1index = $_GET['FWD1index'];

$de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf'));
$serverDomain = $de_GWDconf->address->serverName;
$FWD1port = $de_GWDconf->FORWARD->FWD1->port;
$FWD1uuid = $de_GWDconf->FORWARD->FWD1->uuid[$FWD1index-1]->FWD1uuid;

print("vmess://tcp:$FWD1uuid-0@$serverDomain:$FWD1port/?query=none&tfo=1#$serverDomain");
?>
<?php }?>
