<?php
error_reporting(0);
function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_COOKIE,TRUE);
        curl_setopt($ch, CURLOPT_COOKIEFILE,"COK.TXT");
        curl_setopt($ch, CURLOPT_COOKIEJAR,"COK.TXT");
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }
function save($data,$data_post){
    if(!file_get_contents($data)){
      file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));}
function head(){
  $h[]="content-type: application/x-www-form-urlencoded";
  $h[]="user-agent: Mozilla/5.0 (Linux; Android 7.0; Redmi Note 4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.152 Mobile Safari/537.36";
  return $h;}
function get(){
  $url="https://iqfaucet.com/";
  return curl($url,'',head())[1];}
function login($wl,$token,$header){
  $url="https://iqfaucet.com/";
  $data=http_build_query(array("address"=>$wl,"token"=>$token));
  return curl($url,$data,$header)[1];}
function verif($ve,$token,$header){
  $url="https://iqfaucet.com/verify.php";
  $data=http_build_query(array("verifykey"=>$ve,"token"=>$token));
  return curl($url,$data,$header)[1];}
function captcha($api){
$green2="\e[1;32m";$yellow2="\e[1;33m";
$kirim= file_get_contents("http://2captcha.com/in.php?key=".$api."&method=userrecaptcha&googlekey=6LdGwpwaAAAAAMlDMXJobTE_AEjY7zB9vkea0Qi3&pageurl=https://iqfaucet.com/verify.php");
$first = array($kirim);
$result= explode('OK|',$first[0]);
$hello = $result[1];
$ambil="http://2captcha.com/res.php?key=".$api."&action=get&id=".$hello;
while(true){
timer(70);
$getting = file_get_contents($ambil);
$second = array($getting);
if($getting=="CAPCHA_NOT_READY"){
continue;
}elseif($getting=="ERROR_WRONG_CAPTCHA_ID"){
echo"{$yellow2}Saldo 2captcha habis {$red2}......\n";
break;
}else{
$secondresult = explode('OK|',$second[0]);
$hasil=$secondresult[1];
echo col("Sukses Verif reCaptcha","hp")."\n";
break;
 }
}
return $hasil;
}
function col($str,$color){
$warna=array('x'=>"\033[0m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'px'=>"\033[1;7m",'mp'=>"\033[1;41m",'hp'=>"\033[1;42m",'kp'=>"\033[1;43m",'bp'=>"\033[1;44m",'up'=>"\033[1;45m",'cp'=>"\033[1;46m",'pp'=>"\033[1;47m",'ap'=>"\033[1;100m",'pm'=>"\033[7;41m",);return $warna[$color].$str."\033[0m";}
function ban($msg=null)
{
  $bn="
  
\e[1;31m██╗  ██╗ █████╗ ██╗  ██╗ █████╗ ████████╗ ██████╗      ██╗██╗
██║ ██╔╝██╔══██╗██║ ██╔╝██╔══██╗╚══██╔══╝██╔═══██╗     ██║██║
█████╔╝ ███████║█████╔╝ ███████║   ██║   ██║ \e[1;37m  ██║     ██║██║
██╔═██╗ ██╔══██║██╔═██╗ ██╔══██║   ██║   ██║   ██║██   ██║██║
██║  ██╗██║  ██║██║  ██╗██║  ██║   ██║   ╚██████╔╝╚█████╔╝██║
╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝    ╚═════╝  ╚════╝ ╚═╝
   \e[0m\n";
   $_b=mb_convert_encoding('&#x2591;', 'UTF-8', 'HTML-ENTITIES');
  echo $bn;
  echo col(strtoupper(" author:"),"mp")." ".col(strtoupper("kakatoji"),"c")."\n";
  echo col(strtoupper("youtube:"),"mp")." ".col(strtoupper("bit.ly/2US5PFY"),"k")."\n";
  if($msg){
    echo col(strtoupper(" script:"),"mp")." ".col(strtoupper($msg),"u")."\n";}
  echo str_repeat($_b,61)."\n";
}


function keys(){
  if(!file_exists('key')){
    echo col("link key => ","hp").col("https://duit.cc/Qc26dp","mp")."\n";
    $k=readline("key: ");
    if($k === "kakatoji"){
      echo col("key true....!\r","h")."\n";
      file_put_contents('key',$k);
    }
  }elseif(file_exists('key')){
    $f=file("key")[0];
    if($f !== "kakatoji"){
      unlink("key");exit();
    }
  }
}
function timer($tmr){ 
     $timr=time()+$tmr; 
      while(true): 
      echo "\r                       \r"; 
      $res=$timr-time(); 
      if($res < 1){break;} 
      echo date('H:i:s',$res); 
      sleep(1); 
      endwhile;}
function claim($re,$ve,$token,$header){
  $url="https://iqfaucet.com/index.php?c=1";
  $data=http_build_query(array("g-recaptcha-response"=>$re,"selectedCaptcha"=>1,"verifykey"=>$ve,"token"=>$token));
  return curl($url,$data,$header)[1];}
function acu($header){
  $url="https://iqfaucet.com/account.php";
  return curl($url,'',$header)[1];}
function fp($header){
  $url="https://iqfaucet.com/account.php?withdr=fp";
  return curl($url,'',$header)[1];}
if(!file_exists("walet.json")){
  ban("iqfaucet");
  $a=readline("wallet_Doge: ");
  $d=readline("apiKey_2captcha: ");
  $data=["wallet"=>$a,"api"=>$d];
  save("walet.json",$data);keys();}
system('clear');
$wal=json_decode(file_get_contents('walet.json'),1);
ban('iqfaucet');
keys();
while(1):
keys();
$get=get();
$t=explode("'/>",explode("<input type='hidden' name='token' value='",$get)[1])[0];
$log=login($wal['wallet'],$t,array_merge(head(),array("referer: https://iqfaucet.com?ref=58303")));
$ve=explode("'/>",explode("<input type='hidden' name='verifykey' value='",$log)[1])[0];
$to=explode("'/>",explode("<input type='hidden' name='token' value='",$log)[1])[0];
$veri=verif($ve,$to,array_merge(head(),array("referer: https://iqfaucet.com/index.php")));
$ve=explode("'/>",explode("<input type='hidden' name='verifykey' value='",$veri)[1])[0];
$to=explode("'/>",explode("<input type='hidden' name='token' value='",$veri)[1])[0];
$google=captcha($wal['api']);
$clm=claim($google,$ve,$to,array_merge(head(),array("referer: https://iqfaucet.com/verify.php")));
preg_match("#h3>Address</h3>(.*?)<h3>Balance</h3>
	<h2>(.*?)</h2>#i",$clm,$as);
preg_match_all("#<div class='alert alert-success' role='alert'>(.*?)<br />You can claim again Now!</div>#i",$clm,$succes);
$xc=explode("<div class='alert alert-success' role='alert'>",$succes[1][0])[1];
echo col(strtoupper("address:"),"mp").col($as[1],"c")."\n";
if($as[2] > '0.00000000 DOGE'){
echo col(strtoupper("balance:"),"mp").col($as[2],"c")."\n";}
echo col(strtoupper("status"),"mp").col(" => ".$xc,"h")."\n";
echo str_repeat("~",61)."\n";
if($as[2] >= "0,00013757"){
  $ac=acu(array_merge(head(),array("referer: https://iqfaucet.com/index.php")));
  $fp=fp(array_merge(head(),array("referer: https://iqfaucet.com/account.php")));
  $cy=explode('</div>',explode('<div class="alert alert-success">',$fp)[1])[0];
  echo col(strtoupper($cy),"px")."\n";
  echo str_repeat("~",61)."\n";}
endwhile;
