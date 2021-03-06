<?php

/**
 * BaseColsysConfig
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_idconfig
 * @property string $ca_module
 * @property string $ca_param
 * @property string $ca_description
 * @property Doctrine_Collection $ColsysConfigValue
 * 
 * @method string              getCaIdconfig()        Returns the current record's "ca_idconfig" value
 * @method string              getCaModule()          Returns the current record's "ca_module" value
 * @method string              getCaParam()           Returns the current record's "ca_param" value
 * @method string              getCaDescription()     Returns the current record's "ca_description" value
 * @method Doctrine_Collection getColsysConfigValue() Returns the current record's "ColsysConfigValue" collection
 * @method ColsysConfig        setCaIdconfig()        Sets the current record's "ca_idconfig" value
 * @method ColsysConfig        setCaModule()          Sets the current record's "ca_module" value
 * @method ColsysConfig        setCaParam()           Sets the current record's "ca_param" value
 * @method ColsysConfig        setCaDescription()     Sets the current record's "ca_description" value
 * @method ColsysConfig        setColsysConfigValue() Sets the current record's "ColsysConfigValue" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseColsysConfig extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_config');
        $this->hasColumn('ca_idconfig', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_module', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_param', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_description', 'string', null, array(
             'type' => 'string',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('ColsysConfigValue', array(
             'local' => 'ca_idconfig',
             'foreign' => 'ca_idconfig'));
    }
}