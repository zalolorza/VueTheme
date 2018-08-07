<?php

/**
 * 
 * $GLOBALS
 *
 */

$CONFIG = parse_ini_file('config/config.ini',true);

foreach($CONFIG as $KEY => $GLOBAL){
    define($KEY,$GLOBAL);

}

/**
 * 
 *  Include all scripts
 *
 */



foreach (glob(__DIR__."/php/*.php") as $filename)
{
    include_once $filename;
}



