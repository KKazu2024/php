<?php
//IP関連の関数・ライブラリ使用不可
$pattern = '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
$digit1 = 32;
$digit2 = 8;
$digit3 = 4;

//サーバ,クライアント
$result = getIpSub();
$sIpAdd = $result[0];
$sSub = $result[1];

$result = getIpSub();
$cIpAdd = $result[0];
$cSub = $result[1];

//ネットワークアドレス計算
$sInt = ipToInt($sIpAdd);
$cInt = ipToInt($cIpAdd);
$sNetAdd = calcNet($sInt, $sSub);
$csNetAdd = calcNet($cInt, $sSub);
$cNetAdd = calcNet($cInt, $cSub);
$scNetAdd = calcNet($sInt, $cSub);

//表示
if($sNetAdd != $csNetAdd){
    $sNetAdd = "\033[0;31m$sNetAdd\033[0m";
    $csNetAdd = "\033[0;31m$csNetAdd\033[0m";
}
if($cNetAdd != $scNetAdd){
    $cNetAdd = "\033[0;31m$cNetAdd\033[0m";
    $scNetAdd = "\033[0;31m$scNetAdd\033[0m";
}
echo "サーバ：\t\t" . $sIpAdd . "\t\t\t\t" . $sSub . PHP_EOL;
echo "クライアント：\t\t" . $cIpAdd . "\t\t\t\t" .  $cSub . PHP_EOL;
echo "サーバ視点\t\tサーバネットワークアドレス\t\t" . $sNetAdd . PHP_EOL;
echo "\t\t\tクライアントネットワークアドレス\t" . $csNetAdd . PHP_EOL;
echo "クライアント視点\tサーバネットワークアドレス\t\t" . $cNetAdd . PHP_EOL;
echo "\t\t\tクライアントネットワークアドレス\t" . $scNetAdd . PHP_EOL;

//IPアドレス,サブネットマスク取得
function getIpSub(){
    global $pattern;
    global $digit1;
    global $digit2;
    global $digit3;
    $judgeCidr = true;

    $ipAdd = trim(fgets(STDIN));
    if (strpos($ipAdd, '/') !== false) {
        $judgeCidr = false;
        $search = strpos($ipAdd, '/');
        $cidr = explode('/', $ipAdd);
        $ipAdd = substr($ipAdd, 0, $search);
    }
    if(!(preg_match($pattern, $ipAdd))){
        echo "\033[0;31m{$ipAdd}は不正なIPアドレスです。\033[0m";
        exit;
    }
    
    if($judgeCidr){
        $sub = trim(fgets(STDIN));
        if(!(preg_match($pattern, $sub))){
            echo "\033[0;31m{$sub}は不正なサブネットマスクです。'\033[0m";
            exit;
        }
    }else{
        $n = 3;
        $intSub = 0;
        $sub = '';
        for($i = $digit1 - 1; $i > 0; $i--){
            if($cidr[1] > 0){
                $intSub += 1 << $i;
                $cidr[1]--;
            }else{
                $intSub += 0 << $i;
            }
        }
        for($i = 0; $i < $digit3; $i++){
            $sub .= ($intSub >> 8 * $n) & 255;
            if($i < $digit3 - 1){
                $sub .= '.';
            }
            $n--;
        }
    }
    return [$ipAdd, $sub];
}

function ipToInt($ip){
    global $digit3;
    $n = 3;
    $ret = 0;
    $value = explode('.', $ip);
    for($i = 0; $i < $digit3; $i++){
        $ret += (int)$value[$i] << 8 * $n;
        $n--;
    }
    return $ret;
}

function calcNet($int, $sub){
    global $digit3;
    $n = 3;
    $ret = '';
    $value = explode('.', $sub);
    for($i = 0; $i < $digit3; $i++){
        $ret .= ($int >> 8 * $n) & $value[$i];
        if($i < $digit3 - 1){
            $ret .= '.';
        }
        $n--;
    }
    return $ret;
}
?>