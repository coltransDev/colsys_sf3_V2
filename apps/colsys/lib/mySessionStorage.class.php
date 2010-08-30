<?php

/*

*/
class mySessionStorage  extends sfCacheSessionStorage
{

    
   /**
   * Executes the shutdown procedure.
   *
   * @throws <b>sfStorageException</b> If an error occurs while shutting down this storage
   */
  public function shutdown()
  {
    // only update cache if session has changed
    if($this->dataChanged === true)
    {
      $module = sfContext::getInstance()->getModuleName ();
   	  $action = sfContext::getInstance()->getActionName ();
      //store last request time.
      if( !($module=="users" && $action=="checkLogin") ){         
        $this->cache->set($this->id."_lr", time());
      }
      $this->cache->set($this->id."_ip", $_SERVER["SERVER_ADDR"]);
      

      parent::shutdown();
    }
  }

}
