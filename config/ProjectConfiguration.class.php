<?php

$sf_symfony_lib_dir  = 'C:/Desarrollo/htdocs/symfony1.4/lib';

require_once $sf_symfony_lib_dir .'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    //static protected $zendLoaded = false;

    public function setup()
    {
        $this->enableAllPluginsExcept(array('sfPropelPlugin'));

        sfConfig::set('sf_doctrine_dir', sfConfig::get('sf_lib_dir') . '/vendor/doctrine');
    }

  
    /**
    * Configure the Doctrine engine
    **/
    public function configureDoctrine(Doctrine_Manager $manager)
    {
        //$manager->setAttribute(Doctrine::ATTR_QUERY_CACHE, new Doctrine_Cache_Apc());

        $options = array('baseClassName' => 'myDoctrineRecord'); 
        sfConfig::set('doctrine_model_builder_options', $options);

        $manager->setAttribute(Doctrine::ATTR_SEQNAME_FORMAT, '%s_id');

        $manager->registerExtension('Blameable');


    }


}

?>