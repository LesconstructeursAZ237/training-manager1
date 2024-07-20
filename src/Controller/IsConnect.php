<?php

declare(strict_types=1);

namespace App\Controller;

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'autoload.php';



class IsConnect {

    public static $statu;
    
    public static function IfConnect($statu=false, array $Session) {
        if(empty($Session) || $statu==false){
            return 0;
        }
        else{
            $statu=true;
            return $Session;
        }
    }

   
    public static function getIfConnect(){
        return self::$statu; 
    }
}



