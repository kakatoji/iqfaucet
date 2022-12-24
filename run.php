<?php


error_reporting(0);include("data.php");system("clear");$res="\033[7m";$hitam="\033[0;30m";$abu2="\033[1;30m";$putih="\033[0;37m";$putih2="\033[1;37m";$red="\033[0;31m";$red2="\033[1;31m";$green="\033[0;32m";$green2="\033[1;32m";$yellow="\033[0;33m";$yellow2="\033[1;33m";$blue="\033[0;34m";$blue2="\033[1;34m";$purple="\033[0;35m";$purple2="\033[1;35m";$lblue="\033[0;36m";$lblue2="\033[1;36m";
$header = array("User-Agent: ".$useragent,"cookie:$cookie");while(1){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://iqfaucet.com/index.php");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HTTPHEADER, $header);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);$index = curl_exec($ch);$address = explode("<h3>",explode("<h3>Address</h3>",$index)[1])[0];$balance = explode("</h2>",explode("<h3>Balance</h3>
	<h2>",$index)[1])[0];$verifykey = explode("'/>",explode("<input type='hidden' name='verifykey' value='",$index)[1])[0];$token = explode("'/>",explode("<input type='hidden' name='token' value='",$index)[1])[0];
echo$green2."Your account address is ".$red2.$address."\n";echo$purple2."**************************************\n";
if(empty($address)){system("exit");}$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://iqfaucet.com/verify.php");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_HTTPHEADER, $header);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);$data = "verifykey=$verifykey&token=$token";curl_setopt($ch, CURLOPT_POSTFIELDS, $data);$verify = curl_exec($ch);$verifykey1 = explode("'/>",explode("<input type='hidden' name='verifykey' value='",$verify)[1])[0];
$token1 = explode("'/>",explode("<input type='hidden' name='token' value='",$verify)[1])[0];
$claim = explode("</div>",explode("<div class=\"alert alert-success\">",$index)[1])[0];
echo$yellow."You can claim again Now!".$red2.$claim."\n";echo$yellow."\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://azcaptcha.com/in.php?key=$apikey&method=userrecaptcha&json=1&googlekey=6LdGwpwaAAAAAMlDMXJobTE_AEjY7zB9vkea0Qi3&pageurl=https://iqfaucet.com/verify.php");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$captcha = curl_exec($ch);$captchaid = jsondecode($captcha)["request"];
while(1){$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "http://azcaptcha.com/res.php?key=$apikey&action=get&json=1&id=$captchaid");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);####################################################################################################################################
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);####################################################################################################################################
$respond = curl_exec($ch);$status = jsondecode($respond)["status"];####################################################################################################################################
if($status==0){sleep(2);}if($status==1){$request = jsondecode($respond)["request"];break;}}
$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://iqfaucet.com/index.php?c=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);$data = "g-recaptcha-response=$request&selectedCaptcha=1&verifykey=$verifykey1&token=$token1";curl_setopt($ch, CURLOPT_POSTFIELDS, $data);$ptcverify = curl_exec($ch);$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://iqfaucet.com/account.php");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);$account = curl_exec($ch);$ch = curl_init();curl_setopt($ch, CURLOPT_URL, "https://iqfaucet.com/account.php?withdr=fp");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HTTPHEADER, $header);curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);$withdraw = curl_exec($ch);$pay = explode("</div>",explode("<div class=\"alert alert-success\">",$withdraw)[1])[0];echo$green2.$pay."\n";}function jsondecode($data, $isarray = true){return json_decode($data,$isarray);}
?> ############################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################################

