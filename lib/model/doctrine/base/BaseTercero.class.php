<?php

/**
 * BaseTercero
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_idtercero
 * @property string $ca_nombre
 * @property string $ca_contacto
 * @property string $ca_direccion
 * @property string $ca_telefonos
 * @property string $ca_fax
 * @property string $ca_idciudad
 * @property string $ca_email
 * @property string $ca_vendedor
 * @property string $ca_tipo
 * @property string $ca_identificacion
 * @property Ciudad $Ciudad
 * @property Doctrine_Collection $Reporte
 * @property Doctrine_Collection $InoClientesSea
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseTercero extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_terceros');
        $this->hasColumn('ca_idtercero', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_contacto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_direccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_telefonos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fax', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idciudad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_email', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_identificacion', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Ciudad', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_idtercero',
             'foreign' => 'ca_idproveedor'));

        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_idtercero',
             'foreign' => 'ca_idproveedor'));
    }
}