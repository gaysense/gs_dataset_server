<?php
class data{
    /**
     * @var string
     */
    private static $filename;

    /**
     * @param string $filename
     */
    public static function initialize(string $filename){
        self::$filename=$filename;
    }

    public static function saveToFile(){
        $foundErr=false;
        foreach($_REQUEST['data'] as $single){
            if(isset($single['m_angEyeAngles[0]']) && isset($single['steamid64']) && $single['steamid64']!=0) {
                file_put_contents(self::$filename.$single['steamid64'].".gs", json_encode($single) . PHP_EOL, FILE_APPEND);
            }else {
                $foundErr=true;
            }
        }
        return !$foundErr;
    }
}