<?php

$sf_symfony_lib_dir  = 'D:\Desarrollo\symfony\lib';

require_once $sf_symfony_lib_dir .'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
  }
}

?>