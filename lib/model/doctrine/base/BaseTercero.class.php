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
 * @property Doctrine_Collection $InoHouse
 * @property Doctrine_Collection $Reporte
 * @property Doctrine_Collection $InoClientesSea
 * 
 * @method string              getCaIdtercero()       Returns the current record's "ca_idtercero" value
 * @method string              getCaNombre()          Returns the current record's "ca_nombre" value
 * @method string              getCaContacto()        Returns the current record's "ca_contacto" value
 * @method string              getCaDireccion()       Returns the current record's "ca_direccion" value
 * @method string              getCaTelefonos()       Returns the current record's "ca_telefonos" value
 * @method string              getCaFax()             Returns the current record's "ca_fax" value
 * @method string              getCaIdciudad()        Returns the current record's "ca_idciudad" value
 * @method string              getCaEmail()           Returns the current record's "ca_email" value
 * @method string              getCaVendedor()        Returns the current record's "ca_vendedor" value
 * @method string              getCaTipo()            Returns the current record's "ca_tipo" value
 * @method string              getCaIdentificacion()  Returns the current record's "ca_identificacion" value
 * @method Ciudad              getCiudad()            Returns the current record's "Ciudad" value
 * @method Doctrine_Collection getInoHouse()          Returns the current record's "InoHouse" collection
 * @method Doctrine_Collection getReporte()           Returns the current record's "Reporte" collection
 * @method Doctrine_Collection getInoClientesSea()    Returns the current record's "InoClientesSea" collection
 * @method Tercero             setCaIdtercero()       Sets the current record's "ca_idtercero" value
 * @method Tercero             setCaNombre()          Sets the current record's "ca_nombre" value
 * @method Tercero             setCaContacto()        Sets the current record's "ca_contacto" value
 * @method Tercero             setCaDireccion()       Sets the current record's "ca_direccion" value
 * @method Tercero             setCaTelefonos()       Sets the current record's "ca_telefonos" value
 * @method Tercero             setCaFax()             Sets the current record's "ca_fax" value
 * @method Tercero             setCaIdciudad()        Sets the current record's "ca_idciudad" value
 * @method Tercero             setCaEmail()           Sets the current record's "ca_email" value
 * @method Tercero             setCaVendedor()        Sets the current record's "ca_vendedor" value
 * @method Tercero             setCaTipo()            Sets the current record's "ca_tipo" value
 * @method Tercero             setCaIdentificacion()  Sets the current record's "ca_identificacion" value
 * @method Tercero             setCiudad()            Sets the current record's "Ciudad" value
 * @method Tercero             setInoHouse()          Sets the current record's "InoHouse" collection
 * @method Tercero             setReporte()           Sets the current record's "Reporte" collection
 * @method Tercero             setInoClientesSea()    Sets the current record's "InoClientesSea" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('InoHouse', array(
             'local' => 'ca_idtercero',
             'foreign' => 'ca_idproveedor'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_idtercero',
             'foreign' => 'ca_idproveedor'));

        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_idtercero',
             'foreign' => 'ca_idproveedor'));
    }
}