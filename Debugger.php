<?php

// written by Yohei Okubo Jul28 2015

//------------------------------------------------
// Debug mode
define('DEBUG', 0); // 0: Production, 1: DebugMode

//-------------------------------------------------
if (DEBUG == 1) { // debug
    ini_set( 'display_errors', 1);
    //ini_set('log_errors','On');
    // ログの保存先
    ini_set('error_log','../tmp/logs/debug_log');
} elseif ( DEBUG == 0) { // production
    // 本番環境ではログに記録する
    ini_set('log_errors','On');
    // ログの保存先
    ini_set('error_log','../tmp/logs/error_log');
}
//------------------------------------------------

class Debugger {

    // for debug function 
    // if you pass nothing to args, echo a line.
    public static function dump($object = null)
    {
        if (DEBUG == 0) { return; }
        echo "<div class=\"debug\">";
        foreach ( self::contents($object) as $c) { echo $c; };
        echo "</div>";
    }

    public static function log($obj, $print = false) {
        if ($print == true) { self::dump($obj); }
        $logfile_path = '../tmp/logs/debug_log';
        error_log(var_export($obj,true), 3, $logfile_path);
    }

    private static function contents($object=nil) 
    {
        $style='color:#000; background-color:#CCC';
        if ( empty($object) ) {
            return ["<pre style=\"$style\">",
                    "------------------------------\n",
                    "</pre>"];
        }else{
            return ["<pre style=\"$style\">",
                    var_export($object, true),
                    "</pre>"];
        }
    }
}