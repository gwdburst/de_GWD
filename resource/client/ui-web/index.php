<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="de_GWD">
  <meta name="author" content="JacyL4">

<title>寒月</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/animation.css" rel="stylesheet">

  <link href="favicon.ico" rel="icon" type="image/x-icon" />

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled fixed-padding">
<?php $de_GWDconf = json_decode(file_get_contents('/opt/de_GWD/0conf')); ?>
<?php $v2dnsConf = file_get_contents('/opt/de_GWD/v2dns/config.json'); ?>
<?php $DoG = $de_GWDconf->dns->DoG; ?>

<?php $checkJellyfin = $de_GWDconf->app->jellyfin; ?>
<?php $checkFileRun = file_exists('/var/www/html/filerun'); ?>
<?php $checkBitwarden = $de_GWDconf->app->bitwarden; ?>

<?php $FileRunWebConf = file_get_contents ('/etc/nginx/conf.d/filerun.conf'); preg_match_all('/(?<=\blisten )\S+/is', $FileRunWebConf, $FileRunPort); $FileRunPort = $FileRunPort[0][0] ?>
<?php $WebConf = file_get_contents ('/etc/nginx/conf.d/default.conf'); preg_match_all('/(?<=\bserver_name )\S+/is', $WebConf, $serverName); $serverName = rtrim($serverName[0][0],";") ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="javascript:void(0)" onclick="window.open('https://t.me/de_GWD_DQ')">寒月</a>
    <button class="btn btn-sm btn-outline-light mx-3" data-toggle="modal" data-target="#markThis">备注本机</button>

    <button id="sidebarToggle" class="btn btn-link btn-sm text-white order-1 order-sm-0" href="#">
      <i class="fas fa-bars"></i>
    </button>
<span class="float-right badge text-info"><?php passthru('sudo /opt/de_GWD/ui-checkEditionARM');?></span>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkFileRun === true) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(<?php if ($serverName != "de_GWD") echo "'https://$serverName:$FileRunPort'"; else echo "location.origin+':$FileRunPort'" ?>)">
          <i class="fas fa-folder"></i>
          <span>FileRun</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkJellyfin === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8097')">
          <i class="fab fa-youtube"></i>
          <span>Jellyfin</span>
        </a>
      </li>

      <li class="nav-item no-arrow mx-1" style="display:<?php if ($checkBitwarden === installed) echo 'block'; else echo 'none';?>">
        <a class="nav-link" href="javascript:void(0)" onclick="window.open(location.origin+':8099')">
          <i class="fas fa-shield-alt"></i>
          <span>Bitwarden</span>
        </a>
      </li>
      
      <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="/admin/" onclick="javascript:event.target.port=location.port" target="_blank">
          <i class="fab fa-raspberry-pi"></i>
          <span>Pi-Hole</span>
        </a>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav toggled">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-tachometer-alt"></i>
          <span>概览</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forward.php">
          <i class="fas fa-project-diagram"></i>
          <span>中转</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ddns.php">
          <i class="fas fa-ethernet"></i>
          <span>DDNS & WG</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="app.php">
          <i class="fab fa-app-store-ios"></i>
          <span>应用</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listBW.php">
          <i class="fas fa-th-list"></i>
          <span>黑白名单</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nodeMAN.php">
          <i class="fas fa-stream"></i>
          <span>节点管理</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update.php">
          <i class="fas fa-arrow-alt-circle-up"></i>
          <span>更新</span></a>
      </li>
      <li class="nav-item">
        <a id="buttonLogout" class="nav-link" href="javascript:void(0)">
          <i class="fas fa-sign-out-alt"></i>
          <span>注销</span></a>
      </li>
    </ul>

    <div id="content-wrapper" class="mx-auto" style="max-width: 1600px;">

      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">概览</a>
          </li>
          <li class="breadcrumb-item active">状态</li>
        </ol>

        <!-- Icon Cards -->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-rocket"></i>
                </div>
                <div class="form-row align-items-center">联网状态</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="testBaidu" class="float-left"></span>
                <span id="testYoutue" class="float-right"></span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="form-row align-items-center">版本检测</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 class="float-left" style="margin-bottom: 0"><span id="currentver" class="" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;"></span></h6>
                <h6 class="float-right" style="margin-bottom: 0"><span id="remotever" class="" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;"></span></h6>
              </a>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-toggle-on"></i>
                </div>
                <div class="form-row align-items-center">
                  <span>代理开关</span>
                  <span id="buttonProxyLoading"></span>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <h6 id="buttonProxyRestart" class="float-left" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;">重启代理</button></h6>
                <h6 id="buttonProxyStop" class="float-right" style="margin-bottom: 0"><button class="btn btn-light" style="font-size:0.75rem;font-weight:600;line-height:0.35;border-radius:10rem;">关闭代理</button></h6>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-clock"></i>
                </div>
                  <div class="form-row align-items-center">运行时长</div>
              </div>
              <a class="card-footer text-white clearfix small z-1">
                <span id="uptime" class="float-left"></span>
                <span class="float-right"><?php $kernelV=exec('sudo uname -r'); echo str_replace("-arm64", "", str_replace("-amd64", "", $kernelV));?></span>
              </a>
            </div>
          </div>
        </div>


<!-- Modal -->
<div id="markThis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="markThisLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="markThisLabel" class="modal-title">备注本机</h5>
      </div>
      <div class="modal-body">
        <input id="markName" type="text" class="form-control" placeholder="备注名" required="required" value="<?php echo $de_GWDconf->address->alias; ?>">
      </div>
      <div class="modal-footer">
        <button id="buttonMarkThis" type="button" class="btn btn-outline-dark btn-sm">应用</button>
      </div>
    </div>
  </div>
</div>

<div id="nodeCUrules" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <textarea id="nodeCUrulesTxt" class="form-control" rows="12" placeholder="纯字符串：google.com&#13;子域名：domain:google.com&#13;完整匹配：full:google.com&#13;预定义域名列表：geosite:google&#13;正则：regexp:\\.google.*\\.com$"><?php $customDomainList = $de_GWDconf->v2nodeDIV->nodeCU->rules; foreach ( $customDomainList as $k => $v) {if (end($customDomainList) == $v) echo "$v"; else echo "$v\n";} ?></textarea>
      </div>
      <div class="modal-footer">
        <button id="buttonNodeCUrules" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonNodeCUrulesloading"></span>
          <span>规则写入</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="ssDetail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
      <div class="input-group">
        <div class="input-group-prepend ">
          <span class="input-group-text">地址</span>
        </div>
          <input id="ssAddress" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssAddress; ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">端口</span>
        </div>
          <input id="ssPort" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssPort; ?>">
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">加密方式</span>
        </div>
        <div class="input-group-prepend input-group-append">
          <button id="ssMethod" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssMethod; ?>"><?php echo $de_GWDconf->v2nodeDIV->ss->ssMethod; ?></button>
          <div class="dropdown-menu">
            <a class='dropdown-item' href='#' id="ssAES256">AES-256-GCM</a>
            <a class='dropdown-item' href='#' id="ssAES128">AES-128-GCM</a>
            <a class='dropdown-item' href='#' id="ssChaCha20">ChaCha20-IETF-Poly1305</a>
          </div>
        </div>
        <div class="input-group-prepend input-group-append">
          <span class="input-group-text">密码</span>
        </div>
          <input id="ssSecure" class="form-control" value="<?php echo $de_GWDconf->v2nodeDIV->ss->ssSecure; ?>">
      </div>
      </div>
      <div class="modal-footer">
        <button id="buttonSSclear" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonSSclearloading"></span>
          <span>清除</span>
        </button>

        <button id="buttonSSsubmit" type="button" class="btn btn-outline-secondary btn-sm">
          <span id="buttonSSsubmitloading"></span>
          <span>应用</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="editADlists" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="row col-12 justify-content-center">ADlist订阅:</h5>
        <button id="adlistURLload" type="button" class="btn btn-secondary btn-sm col-12 justify-content-center" style="border-Radius: 0px;">加载预置</button>
        <textarea id="adlistsURL" class="form-control" style="border-Radius: 0px;" rows="8" placeholder="ADlists URL"><?php print(implode("\n", $de_GWDconf->dns->adlistsURL)) ?></textarea>

        <h5 class="row col-12 justify-content-center mt-3">Regex规则:</h5>
        <button id="regexRuleLoad" type="button" class="btn btn-secondary btn-sm col-12 justify-content-center" style="border-Radius: 0px;">加载预置</button>
        <textarea id="regexRule" class="form-control" style="border-Radius: 0px;" rows="8" placeholder="ADlists URL"><?php print(implode("\n", $de_GWDconf->dns->regexRule)) ?></textarea>
      </div>
      <div class="modal-footer">
        <button id="buttonADlistsURL" type="button" class="btn btn-secondary btn-sm">
          <span id="buttonADlistsURLloading"></span>
          <span>应用</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div id="reboot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reboot" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <span class="modal-title">确认重启并清理内核</span>
      </div>

      <div class="modal-footer">
        <button id="buttonReboot" type="button" class="btn btn-sm btn-danger" style="border-radius: 0px;">立即重启</button>
      </div>
    </div>
  </div>
</div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-stream"></i>
            节点列表
         <span class="float-right mt-n1 mb-n2">
                <button id="buttonclearDIV" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonclearDIVloading"></span>
                  <span>清理分流</span>
                </button>

                <button id="buttonSSdetail" type="button" class="btn <?php passthru('/opt/de_GWD/ui-checkNodeSS &'); ?> btn-sm mt-1" style="border-radius: 0px;" data-toggle="modal" data-target="#ssDetail">
                  <span>SS</span>
                </button>
          </span>
          </div>
          <div style="display: flex;flex-wrap: wrap;">
            <button id="buttonPingTCP" type="button" class="btn btn-outline-success btn-sm col-12" style="border-radius: 0px;">Ping (TCP)</button>
          </div>

          <div class="card-body">
<div class="form-row">
<?php $nodeDT = $de_GWDconf->v2nodeDIV->nodeDT->display; ?>
<div class="ml-4 mb-3 mr-auto">
<div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text">内网设备 & BT</label>
  </div>
  <div id="nodeDTlist" class="input-group-prepend" style="display:<?php if($nodeDT == on) echo 'block'; else echo 'none'; ?>">
    <button id="nodeDTshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php passthru('/opt/de_GWD/ui-checkNodeDT &'); ?></button>
    <div id="nodeDT" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeDT$i' onclick="buttonNodeDT(this)">$name</a>
EOT;
}
?>
    </div>
  </div>
  <div id="nodeDTip" class="input-group-prepend" style="display:<?php if($nodeDT == on) echo 'block'; else echo 'none'; ?>">
    <input id="nodeDTtext" type="text" class="form-control" placeholder="内网设备IP 空格分隔" value="<?php foreach ($de_GWDconf->v2nodeDIV->nodeDT->ip as $k => $v) {echo "$v ";} ?>">
  </div>
  <div id="nodeDTipButton" class="input-group-prepend" style="display:<?php if($nodeDT == on) echo 'block'; else echo 'none'; ?>">
    <button id="buttonSubmitDivertIP" class="btn btn-outline-secondary" type="button">
      <span id="buttonSubmitDivertIPloading"></span>
      <span>IP写入</span>
    </button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeDTswitch(this)">
      <span id="buttonNodeDTloading"></span>
      <span id="nodeDTtext"><?php if($nodeDT == on) echo 'OFF'; else echo 'ON'; ?></span>
    </button>
  </div>
</div>
</div>

<?php $nodeCU = $de_GWDconf->v2nodeDIV->nodeCU->display; ?>
<div class="ml-4 mb-3">
<div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text">自定义</label>
  </div>
  <div id="nodeCUlist" class="input-group-prepend" style="display:<?php if($nodeCU == on) echo 'block'; else echo 'none'; ?>">
    <button id="nodeCUshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php passthru('/opt/de_GWD/ui-checkNodeCU &'); ?></button>
    <div id="nodeCU" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeCU$i' onclick="buttonNodeCU(this)">$name</a>
EOT;
}
?>
    </div>
  </div>
  <div id="nodeCUrulesButton" class="input-group-prepend" style="display:<?php if($nodeCU == on) echo 'block'; else echo 'none'; ?>">
    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#nodeCUrules">规则</button>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeCUswitch(this)">
      <span id="buttonNodeCUloading"></span>
      <span id="nodeCUtext"><?php if($nodeCU == on) echo 'OFF'; else echo 'ON'; ?></span>
    </button>
  </div>
</div>
</div>

<?php $nodeNF = $de_GWDconf->v2nodeDIV->nodeNF->display; ?>
<div class="ml-4 mr-4 mb-3">
<div class="input-group">
  <div class="input-group-prepend">
    <label class="input-group-text">Netflix</label>
  </div>
  <div id="nodeNFlist" class="input-group-prepend" style="display:<?php if($nodeNF == on) echo 'block'; else echo 'none'; ?>">
    <button id="nodeNFshow" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php passthru('/opt/de_GWD/ui-checkNodeNF &'); ?></button>
    <div id="nodeNF" class="dropdown-menu">
<?php
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $name = $de_GWDconf->v2node[$i]->name;
print <<<EOT
<a class='dropdown-item' href='#' id='nodeNF$i' onclick="buttonNodeNF(this)">$name</a>
EOT;
}
?>
    </div>
  </div>
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" onclick="nodeNFswitch(this)">
      <span id="buttonNodeNFloading"></span>
      <span id="nodeNFtext"><?php if($nodeNF == on) echo 'OFF'; else echo 'ON'; ?></span>
    </button>
  </div>
</div>
</div>
</div>

            <div class="table-responsive">
              <table class="table table-bordered table-hover text-center text-nowrap my-2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>节点地址</th>
                    <th class="text-left">节点名</th>
                    <th>延迟(ms)</th>
                    <th>速度(MB/s)</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody id="nodeTable">
<?php
  $checkNode = exec('/opt/de_GWD/ui-checkNode');
for( $i=0; $i<count($de_GWDconf->v2node); $i++){
  $nodeNUM = $i+1;
  $domain = $de_GWDconf->v2node[$i]->domain;
  $name = $de_GWDconf->v2node[$i]->name;
  if ($checkNode == $i) $checkStatus = "btn-success"; else $checkStatus = "btn-outline-secondary";
print <<<EOT
                  <tr> 
                    <td class="align-middle">$nodeNUM</td>
                    <td class="align-middle"><span id="nodeDomain${i}">${domain}</span></td>
                    <td class="text-left"><span id="nodeshow${i}">${name}</span></td>
                    <td class="align-middle"><span id="ping${i}" class='text-success'></span></td>
                    <td class="align-middle"><span id="speed${i}" class='text-success'><a href="javascript:void(0)" class="text-success" onclick="buttonSpeed(this)"><i class="far fa-play-circle fa-lg"></i></a></span></td>
                    <td class="align-middle"><button id="switch${i}" type="button" class="btn $checkStatus btn-sm" onclick="buttonSwitch(this)">切换</button></td>
                  </tr>
EOT;
}
?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- row2 -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="far fa-compass"></i>
            DNS
          <span class="float-right mt-n1 mb-n2">
              <div class="btn-group">
                <button id="buttonOffSTEAM" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOffSTEAMloading"></span>
                  <span>关闭</span>
                </button>
                <button id="buttonOnSTEAM" type="button" class="btn btn-<?php if(strpos($v2dnsConf,'geosite:category-games@cn') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOnSTEAMloading"></span>
                  <span>Steam...国内解析</span>
                </button>
              </div>

              <div class="btn-group">
                <button id="buttonOffAPPLE" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOffAPPLEloading"></span>
                  <span>关闭</span>
                </button>
                <button id="buttonOnAPPLE" type="button" class="btn btn-<?php if(strpos($v2dnsConf,'geosite:apple') !== false) echo 'success'; else echo 'outline-secondary'; ?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOnAPPLEloading"></span>
                  <span>Apple国内解析</span>
                </button>
              </div>

                <button type="button" class="btn btn-secondary btn-sm mt-1 mx-2" style="border-radius: 0px;" data-toggle="modal" data-target="#editADlists">
                  <span>ADlists</span>
                </button>
                <button id="buttonSubmitDNS" type="button" class="btn btn-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonSubmitDNSloading"></span>
                  <span>应用 & 清理缓存</span>
                </button>
          </span>
          </div>

<?php $smartdnsConf = file_get_contents ('/etc/smartdns/smartdns.conf'); preg_match_all('/(?<=\bhttps:\/\/)\S+/is', $smartdnsConf, $DOHstr); preg_match_all('/(?<=\bhost-name )\S+/is', $smartdnsConf, $DOHdomain);?>
          <div class="card-body">
            <div class="form-row">
              <div class="col-md-5">
              <div class="input-group my-2 mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DNS over gRPC</span>
                </div>
                <input type="text" id="DoGc" class="form-control" placeholder="域名:端口" required="required" value="<?php echo $DoG ?>" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                <div id="DoGping" class="input-group-prepend input-group-append" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                  <span id="pingDoG" class="form-control input-group-text text-success"></span>
                </div>
                <div id="DoGpingMS" class="input-group-append" style="display:<?php if (empty($DoG) === false) echo 'block'; else echo 'none';?>">
                  <span class="input-group-text text-secondary">ms</span>
                </div>
                <div id="DoGbutton" class="input-group-prepend" style="display:<?php if (empty($DoG) === true) echo 'block'; else echo 'none';?>">
                  <button id="openDoG" class="form-control btn btn-outline-secondary" type="button"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DoH 1</span>
                </div>
                <input type="text" id="DoH1" class="form-control" placeholder="域名:端口/dq" required="required" value="<?php echo $DOHdomain[0][0]; echo preg_replace('/\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}/', '', $DOHstr[0][0]);?>">
                <div class="input-group-append">
                  <span id="pingDOH1" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text" style="min-width: 75px">DoH 2</span>
                </div>
                <input type="text" id="DoH2" class="form-control" placeholder="域名:端口/dq" required="required" value="<?php echo $DOHdomain[0][1]; echo preg_replace('/\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}/', '', $DOHstr[0][1]);?>">
                <div class="input-group-append">
                  <span id="pingDOH2" class="input-group-text text-success"></span><span class="input-group-text text-secondary">ms</span>
                </div>
              </div>
              </div>

              <div class="col-md-3">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  DNS<br>
                  国内<br>
                  </span>
                </div>
                  <textarea id="dnsChina" class="form-control" aria-label="dnsChina" rows="6"><?php
preg_match_all('/(?<=\bserver )\S+/is', $smartdnsConf, $dnsClist);
if(($index = array_search('1.1.1.1',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
if(($index = array_search('8.8.8.8',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
if(($index = array_search('127.0.0.1:5330',$dnsClist[0]))){
unset($dnsClist[0][$index]);
}
foreach($dnsClist[0] as $k => $v){
  if ($v == end($dnsClist[0]))
    echo $v;
  else
    echo "$v\n";
}
?></textarea>
                </div>
              </div>

              <div class="col-md-4">
                <div class="input-group my-2">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  hosts<br>
                  静态<br>
                  </span>
                </div>
                  <textarea id="hostsCustomize" class="form-control" aria-label="hostsCustomize" rows="6" placeholder="IP 空格 域名"><?php passthru("sudo /opt/de_GWD/ui-hostsCustomize"); ?></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- row3 -->
        <div class="form-row">
        <!-- 静态地址 -->
          <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-exchange-alt"></i>
            IP地址
          <span class="float-right mt-n1 mb-n2">
                <button type="button" class="btn btn-secondary btn-sm mt-1" style="border-radius: 0px;" data-toggle="modal" data-target="#reboot">应用 & 重启</button>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="localip" type="text" class="form-control" placeholder="本机地址" required="required" value="<?php echo $de_GWDconf->address->localIP; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">本机</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="upstreamip" type="text" class="form-control" placeholder="上级地址" required="required" value="<?php echo $de_GWDconf->address->upstreamIP; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">上级</span>
                </div>
                </div>
                </div>
                </div>
          </div>
          </div>
          </div>

        <!-- DHCP -->
          <div class="col-md-6">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-network-wired"></i>
            DHCP
          <span class="float-right mt-n1 mb-n2">
                <a class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;" href="admin/settings.php?tab=piholedhcp" target="_blank">详情</a>
              <div class="btn-group">
                <button id="buttonOffDHCP" type="button" class="btn btn-outline-secondary btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOffDHCPloading"></span>
                  <span>关闭</span>
                </button>
                <button id="buttonOnDHCP" type="button" class="btn btn-<?php passthru('sudo /opt/de_GWD/ui-checkDhcp');?> btn-sm mt-1" style="border-radius: 0px;">
                  <span id="buttonOnDHCPloading"></span>
                  <span>应用</span>
                </button>
              </div>
          </span>
          </div>
          <div class="card-body">
                <div class="form-row">
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpStart" type="text" class="form-control" placeholder="起始IP" required="required" value="<?php echo $de_GWDconf->address->dhcpStart; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">起始</span>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="input-group my-2">
                  <input id="dhcpEnd" type="text" class="form-control" placeholder="结束IP" required="required" value="<?php echo $de_GWDconf->address->dhcpEnd; ?>">
                <div class="input-group-append">
                  <span class="input-group-text text-secondary">结束</span>
                </div>
                </div>
                </div>
                </div>
          </div>
          </div>
          </div>
        </div>



        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © de_GWD by JacyL4 2017 ~ 2022</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script>
function checklink(){
$.get('./act/testBaidu.php',function(data){
var checklink1 = data
if ( $.trim(checklink1) == "ONLINE" ) {
$('#testBaidu').text("✓ 国内线路畅通")
} else {
$('#testBaidu').text("✗ 国内线路不通")
}
})

$.get('./act/testGoogle.php',function(data){
var checklink2 = data
if ( $.trim(checklink2) == "ONLINE" ) {
$('#testYoutue').text("✓ 国外线路畅通")
} else {
$('#testYoutue').text("✗ 国外线路不通")
}
})

$.get("./act/version.php", function(data){
var currentvernum = data.split("-")[0]
var remotevernum = data.split("-")[1]
var vera = $.trim(currentvernum)
var verb = $.trim(remotevernum)
$('#currentver').attr('class','btn btn-light').html(currentvernum+'本机')
$('#remotever').attr('class','btn btn-light').html(remotevernum+' 发布')
if (vera != verb) {
$('#remotever').attr('class','btn btn-warning')
}
})
}

function nodeDTswitch(nodeDTswitch){
$("#buttonNodeDTloading").attr("class", "spinner-border spinner-border-sm")
var nodeDTtext = $(nodeDTswitch).find('#nodeDTtext').html()
if (nodeDTtext == 'OFF'){
$.get('./act/NodeDTswitch.php', {switchNodeDT:"NodeDThide"}, function(result){
  $("#nodeDTlist").css("display", "none")
  $("#nodeDTip").css("display", "none")
  $("#nodeDTipButton").css("display", "none")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTtext").html("ON")
})
}
else {
$.get('./act/NodeDTswitch.php', {switchNodeDT:"NodeDTshow"}, function(data){
  $("#nodeDTlist").css("display", "block")
  $("#nodeDTip").css("display", "block")
  $("#nodeDTipButton").css("display", "block")
  $("#buttonNodeDTloading").removeClass()
  $("#nodeDTshow").html(data)
  $("#nodeDTtext").html("OFF")
})
}
}

function nodeCUswitch(nodeCUswitch){
$("#buttonNodeCUloading").attr("class", "spinner-border spinner-border-sm")
var nodeCUtext = $(nodeCUswitch).find('#nodeCUtext').html()
if (nodeCUtext == 'OFF'){
$.get('./act/NodeCUswitch.php', {switchNodeCU:"NodeCUhide"}, function(result){
  $("#nodeCUlist").css("display", "none")
  $("#nodeCUrulesButton").css("display", "none")
  $("#buttonNodeCUloading").removeClass()
  $("#nodeCUtext").html("ON")
})
}
else {
$.get('./act/NodeCUswitch.php', {switchNodeCU:"NodeCUshow"}, function(data){
  $("#nodeCUlist").css("display", "block")
  $("#nodeCUrulesButton").css("display", "block")
  $("#buttonNodeCUloading").removeClass()
  $("#nodeCUshow").html(data)
  $("#nodeCUtext").html("OFF")
})
}
}

function nodeNFswitch(nodeNFswitch){
$("#buttonNodeNFloading").attr("class", "spinner-border spinner-border-sm")
var nodeNFtext = $(nodeNFswitch).find('#nodeNFtext').html()
if (nodeNFtext == 'OFF'){
$.get('./act/NodeNFswitch.php', {switchNodeNF:"NodeNFhide"}, function(result){
  $("#nodeNFlist").css("display", "none")
  $("#buttonNodeNFloading").removeClass()
  $("#nodeNFtext").html("ON")
})
}
else {
$.get('./act/NodeNFswitch.php', {switchNodeNF:"NodeNFshow"}, function(data){
  $("#nodeNFlist").css("display", "block")
  $("#buttonNodeNFloading").removeClass()
  $("#nodeNFshow").html(data)
  $("#nodeNFtext").html("OFF")
})
}
}

function buttonSpeed(buttonSpeed){
var SPEEDobj = $(buttonSpeed).parent().parent().parent().parent().find('tr')
var SPEEDindex = SPEEDobj.index($(buttonSpeed).parent().parent().parent()[0])
$('#speed'+SPEEDindex).empty()
$('#speed'+SPEEDindex).attr('class', 'cloud')
$.get("./act/speedT.php", {speedT:SPEEDindex}, function(data){$('#speed'+SPEEDindex).attr('class', 'text-success'); $('#speed'+SPEEDindex).text(data)})
}

function buttonSwitch(buttonSwitch){
var SWITCHobj = $(buttonSwitch).parent().parent().parent().find('tr')
var SWITCHindex = SWITCHobj.index($(buttonSwitch).parent().parent()[0])
$("#nodeTable td:nth-child(6) button").attr('class', "btn btn-outline-secondary btn-sm")
$("#buttonSSdetail").attr('class','btn btn-outline-secondary btn-sm mt-1')
$('#switch'+SWITCHindex).attr('class', 'btn btn-success btn-sm');
$.get("./act/changeNode.php", {nodenum:SWITCHindex}, function(){})
}

function buttonNodeDT(buttonNodeDT){
var NodeDTobj = $(buttonNodeDT).parent().find('a')
var NodeDTindex = NodeDTobj.index($(buttonNodeDT))
var NodeDTname = $('#nodeDT'+NodeDTindex).html()
$('#nodeDTshow').html(NodeDTname)
$.get("./act/changeNodeDT.php", {nodeDTnum:NodeDTindex}, function(){})
}

function buttonNodeCU(buttonNodeCU){
var NodeCUobj = $(buttonNodeCU).parent().find('a')
var NodeCUindex = NodeCUobj.index($(buttonNodeCU))
var NodeCUname = $('#nodeCU'+NodeCUindex).html()
$('#nodeCUshow').html(NodeCUname)
$.get("./act/changeNodeCU.php", {nodeCUnum:NodeCUindex}, function(){})
}

function buttonNodeNF(buttonNodeNF){
var NodeNFobj = $(buttonNodeNF).parent().find('a')
var NodeNFindex = NodeNFobj.index($(buttonNodeNF))
var NodeNFname = $('#nodeNF'+NodeNFindex).html()
$('#nodeNFshow').html(NodeNFname)
$.get("./act/changeNodeNF.php", {nodeNFnum:NodeNFindex}, function(){})
}

$(function(){
$('#buttonLogout').click(function(){
$.get('auth.php', {logout:'true'}, function(result){window.location.href="index.php"})
})

$('#buttonMarkThis').click(function(){
markNametxt=$('#markName').val()
$.get('./act/markThis.php', {markName:markNametxt}, function(result){window.location.reload()})
})

$('#currentver').click(function(){
window.open("https://github.com/jacyl4/de_GWD/releases")
})

$('#remotever').click(function(){
window.open("https://t.me/de_GWD_info")
})

$('#buttonProxyRestart').click(function(){
$("#buttonProxyLoading").attr("class", "spinner-border spinner-border-sm ml-2")
$.get('./act/proxyRestart.php', function(result){
  $("#buttonProxyLoading").removeClass()
})
})

$('#buttonProxyStop').click(function(){
$("#buttonProxyLoading").attr("class", "spinner-border spinner-border-sm ml-2")
$.get('./act/proxyStop.php', function(result){
  $("#buttonProxyLoading").removeClass()
})
})

$.get('./act/uptime.php', function(data){$('#uptime').text(data)})

$('#buttonPingTCP').click(function(){
$('#nodeTable tr').each(function(i){
$.get("./act/pingTCP.php", {pingTCP:i}, function(data){ $('#ping'+i).text(data) })
})
$.get("./act/pingTCPDOH1.php", function(data) { $('#pingDOH1').text(data) })
$.get("./act/pingTCPDOH2.php", function(data) { $('#pingDOH2').text(data) })
$.get("./act/pingTCPDoG.php", function(data) { $('#pingDoG').text(data) })
})

$('#buttonclearDIV').click(function(){
$("#buttonclearDIVloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/NodeOne.php', function(result){
  $("#buttonclearDIVloading").removeClass()
  window.location.reload()
})
})

$('#buttonSubmitDivertIP').click(function(){
$("#buttonSubmitDivertIPloading").attr("class", "spinner-border spinner-border-sm")
divertIP=$('#nodeDTtext').val()
$.get('./act/NodeDTswitchIP.php', {divertIP:divertIP}, function(result){
  $("#buttonSubmitDivertIPloading").removeClass()
})
})

$('#buttonNodeCUrules').click(function(){
$("#buttonNodeCUrulesloading").attr("class", "spinner-border spinner-border-sm")
customDomain=$('#nodeCUrulesTxt').val()
$.get('./act/NodeCUswitchRules.php', {customDomain:customDomain}, function(result){
  $("#buttonNodeCUrulesloading").removeClass()
  $("#nodeCUrules").modal('hide')
})
})

$('#ssAES256').click(function(){
$('#ssMethod').html("AES-256-GCM")
$('#ssMethod').val("aes-256-gcm")
})

$('#ssAES128').click(function(){
$('#ssMethod').html("AES-128-GCM")
$('#ssMethod').val("aes-128-gcm")
})

$('#ssChaCha20').click(function(){
$('#ssMethod').html("ChaCha20-IETF-Poly1305")
$('#ssMethod').val("chacha20-ietf-poly1305")
})

$('#buttonSSclear').click(function(){
$("#buttonSSclearloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/changeNodeSS0.php', function(result){
  $("#buttonSSclearloading").removeClass()
  window.location.reload()
})
})

$('#buttonSSsubmit').click(function(){
$("#buttonSSsubmitloading").attr("class", "spinner-border spinner-border-sm")
ssAddress=$('#ssAddress').val()
ssPort=$('#ssPort').val()
ssMethod=$('#ssMethod').val()
ssSecure=$('#ssSecure').val()
$.get('./act/changeNodeSS.php', {ssAddress:ssAddress, ssPort:ssPort, ssMethod:ssMethod, ssSecure:ssSecure}, function(result){
  $("#buttonSSsubmitloading").removeClass()
  $("#ssDetail").modal('hide')
  $("#buttonSSdetail").attr('class','btn btn-success btn-sm mt-1')
  $("#nodeTable td:nth-child(6) button").attr('class', "btn btn-outline-secondary btn-sm")
})
})

$('#openDoG').click(function(){
$("#DoGc").css("display", "block")
$("#DoGping").css("display", "block")
$("#DoGpingMS").css("display", "block")
$("#DoGbutton").css("display", "none")
})

$('#adlistURLload').click(function(){
var adlistURLloadDefault=$.ajax({url:"/act/DefaultADlist",async:false})
$("#adlistsURL").val(adlistURLloadDefault.responseText)
})

$('#regexRuleLoad').click(function(){
var regexRuleLoadDefault=$.ajax({url:"/act/DefaultRegexRule",async:false})
$("#regexRule").val(regexRuleLoadDefault.responseText)
})

$('#buttonADlistsURL').click(function(){
$("#buttonADlistsURLloading").attr("class", "spinner-border spinner-border-sm")
adlistsURL=$('#adlistsURL').val()
regexRule=$('#regexRule').val()
$.get("./act/adlistsSubmit.php", {adlistsURL:adlistsURL, regexRule:regexRule}, function(result){
  $("#buttonADlistsURLloading").removeClass()
  window.location.reload()
})
})

$('#buttonSubmitDNS').click(function(){
$("#buttonSubmitDNSloading").attr("class", "spinner-border spinner-border-sm")
DoGc=$('#DoGc').val()
doh1txt=$('#DoH1').val()
doh2txt=$('#DoH2').val()
dnsChina=$("#dnsChina").val()
hostsCustomize=$("#hostsCustomize").val()
$.get("./act/saveDNS.php", {DoGc:DoGc, DoH1:doh1txt, DoH2:doh2txt, dnsChina:dnsChina, hostsCustomize:hostsCustomize}, function(result){
  $("#buttonSubmitDNSloading").removeClass()
  window.location.reload()
})
})

$('#buttonOnSTEAM').click(function(){
$("#buttonOnSTEAMloading").attr("class", "spinner-border spinner-border-sm")
STEAMcn="on"
$.get('./act/DNSsteam.php', {STEAMcn:STEAMcn}, function(result){
  $("#buttonOnSTEAMloading").removeClass()
  $("#buttonOnSTEAM").attr("class", "btn btn-success btn-sm mt-1")
})
})

$('#buttonOffSTEAM').click(function(){
$("#buttonOffSTEAMloading").attr("class", "spinner-border spinner-border-sm")
STEAMcn="off"
$.get('./act/DNSsteam.php', {STEAMcn:STEAMcn}, function(result){
  $("#buttonOffSTEAMloading").removeClass()
  $("#buttonOnSTEAM").attr("class", "btn btn-outline-secondary btn-sm mt-1")
})
})

$('#buttonOnAPPLE').click(function(){
$("#buttonOnAPPLEloading").attr("class", "spinner-border spinner-border-sm")
APPLEcn="on"
$.get('./act/DNSapple.php', {APPLEcn:APPLEcn}, function(result){
  $("#buttonOnAPPLEloading").removeClass()
  $("#buttonOnAPPLE").attr("class", "btn btn-success btn-sm mt-1")
})
})

$('#buttonOffAPPLE').click(function(){
$("#buttonOffAPPLEloading").attr("class", "spinner-border spinner-border-sm")
APPLEcn="off"
$.get('./act/DNSapple.php', {APPLEcn:APPLEcn}, function(result){
  $("#buttonOffAPPLEloading").removeClass()
  $("#buttonOnAPPLE").attr("class", "btn btn-outline-secondary btn-sm mt-1")
})
})

$('#buttonReboot').click(function(){
staticip1=$('#localip').val()
staticip2=$('#upstreamip').val()
$.get('./act/reboot.php', {localip:staticip1, upstreamip:staticip2}, function(result){window.location.reload()})
})

$('#buttonOnDHCP').click(function(){
$("#buttonOnDHCPloading").attr("class", "spinner-border spinner-border-sm")
dhcpStarttxt=$('#dhcpStart').val()
dhcpEndtxt=$('#dhcpEnd').val()
$.get('./act/onDHCP.php', {dhcpStart:dhcpStarttxt, dhcpEnd:dhcpEndtxt, dhcp:"on"}, function(result){
  $("#buttonOnDHCPloading").removeClass()
  $("#buttonOnDHCP").attr("class", "btn btn-success btn-sm mt-1")
})
})

$('#buttonOffDHCP').click(function(){
$("#buttonOffDHCPloading").attr("class", "spinner-border spinner-border-sm")
$.get('./act/offDHCP.php', function(result){
  $("#buttonOffDHCPloading").removeClass()
  $("#buttonOnDHCP").attr("class", "btn btn-outline-secondary btn-sm mt-1")
})
})

setInterval(function() {
checklink()
}, 1800)

})
</script>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  
</body>

</html>

<?php }?>
<?php  if(!$auth){ ?>
<?php header('Location: login.php');} ?>
