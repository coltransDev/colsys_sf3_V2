<?php

if (null !== $lib_dir = sfConfig::get('sf_swift_lib_dir'))
{
  require_once(sfConfig::get('sf_swift_lib_dir') . DIRECTORY_SEPARATOR . 'Swift.php');
}
else
{
  require_once('Swift' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Swift.php');
}

/**
 * This class makes easy to use Swift classes within symfony
 */
class sfSwiftMailerBridge
{
  public static function autoload($class)
  {
    return Swift_ClassLoader::load($class);
  }
}