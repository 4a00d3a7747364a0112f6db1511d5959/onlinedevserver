<?php
error_reporting(0);
include_once("class.emailtodb.php");

$cfg["db_host"] = 'localhost';
$cfg["db_user"] = 'unitetoh_emailda';
$cfg["db_pass"] = '2Zdo$5=SUc}t';
$cfg["db_name"] = 'unitetoh_emaildata';

$mysql_pconnect = mysql_pconnect($cfg["db_host"], $cfg["db_user"], $cfg["db_pass"]);
if(!$mysql_pconnect){echo "Connection Failed"; exit; }
$db = mysql_select_db($cfg["db_name"], $mysql_pconnect);
if(!$db){echo"DB Select Failed"; exit;}

$usID=$_REQUEST['st'];
 if($_REQUEST['sta']=='a'){
getleavevalue($usID,'YES');
}
if($_REQUEST['sta']=='d'){
getleavevalue($usID,'NO');
}
$edb = new EMAIL_TO_DB();
$edb->connect('mail.uniterrene.com', '/pop3:110/notls', 'pms@uniterrene.com', '123456@123');
$edb->do_action();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$('select').on('change', function() {
  var cc=this.value;
  window.location = "emailaction.php?EmailTo=" + cc;
})
</script>