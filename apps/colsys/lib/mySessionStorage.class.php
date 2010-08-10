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
      //store last request time.
      $this->cache->set($this->id."_lr", time());      
      parent::shutdown();
    }
  }

}
