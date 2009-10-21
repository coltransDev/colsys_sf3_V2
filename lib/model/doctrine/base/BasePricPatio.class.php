<?php

/**
 * BasePricPatio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idpatio
 * @property string $ca_nombre
 * @property string $ca_idciudad
 * @property string $ca_direccion
 * @property Ciudad $Ciudad
 * @property Doctrine_Collection $PricPatioLinea
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BasePricPatio extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_pricpatios');
        $this->hasColumn('ca_idpatio', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idciudad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_direccion', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('PricPatioLinea', array(
             'local' => 'ca_idpatio',
             'foreign' => 'ca_idpatio'));
    }
}