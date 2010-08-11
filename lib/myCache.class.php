<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

class myCache{
    

    protected static $instance = null;

    public static function getInstance() {
        if (is_null(self::$instance)) {
            $memcacheHost = sfConfig::get("app_memcache_host");
            $memcachePort = sfConfig::get("app_memcache_port");
            $memServers = array("localserver"=>array("host"=>$memcacheHost." port: ".$memcachePort.""));
            self::$instance = new sfMemcacheCache(  array( "servers"=>$memServers, "prefix"=>sfConfig::get("app_memcache_prefix") ) );
        }

        return self::$instance;
    }

    public function __construct() {
        $trace = debug_backtrace();
        $caller = $trace[1];

        /*
         * Prevent the method of being called from another method rather than getInstance,
         * populateObjects (in the peer class) or loadDataFromArray (when loading fixtures).
         */
        if ($caller['function'] != 'getInstance' && $caller['function'] != 'populateObjects' && $caller['function'] != 'loadDataFromArray') {
            throw new Exception("You can't create myCache instances directly.");
        }
    }

}

?>