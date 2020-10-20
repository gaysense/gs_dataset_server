<?php
function dec($str){
    return json_decode($str,true);
}

function enc($arr){
    return json_encode($arr);
}
class Runtime
{
    public static $t;

    public static function start()
    {
        self::$t = microtime();
    }

    public static function end()
    {
        $t1 = microtime();
        list($m0, $s0) = explode(" ", self::$t);
        list($m1, $s1) = explode(" ", $t1);
        return sprintf("%.3f ms", ($s1 + $m1 - $s0 - $m0) * 1000);
    }
}

class RetVal
{
    public static function positive($message)
    {
        self::printResp(1, $message);
    }

    public static function negative($message)
    {
        self::printResp(0, $message);
    }

    private static function printResp($status, $message)
    {
        header("content-type: application/json; charset=utf-8");
        echo enc([
            'status' => $status,
            'message' => $message,
            'time' => time(),
            'memory_peak_usage' => memory_get_peak_usage(),
            'req_processing_delay' => Runtime::end(),
//            'opcached'=>opcache_is_script_cached('api.php'),
            "GAYSENSE_TM_API_version"=> "弌"
        ]);
        exit;
    }
}
class Utils{
    public static function checkData(){
        if(empty($_POST['data'])){
            RetVal::negative(['error' => '无效的数据！']);
        }
        $_POST['data'] = json_decode(base64_decode($_POST['data']), true);
        if(empty($_POST['data'])){
            RetVal::negative(['error' => '无效的数据！']);
        }
    }
}