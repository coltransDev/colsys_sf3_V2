<?php

/**
 * BaseIdsSucursal
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idsucursal
 * @property integer $ca_id
 * @property boolean $ca_principal
 * @property string $ca_direccion
 * @property string $ca_oficina
 * @property string $ca_torre
 * @property string $ca_bloque
 * @property string $ca_interior
 * @property string $ca_localidad
 * @property string $ca_complemento
 * @property string $ca_telefonos
 * @property string $ca_fax
 * @property string $ca_idciudad
 * @property string $ca_zipcode
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Ids $Ids
 * @property Ids $Grupo
 * @property Ciudad $Ciudad
 * @property Doctrine_Collection $IdsContacto
 * 
 * @method integer             getCaIdsucursal()      Returns the current record's "ca_idsucursal" value
 * @method integer             getCaId()              Returns the current record's "ca_id" value
 * @method boolean             getCaPrincipal()       Returns the current record's "ca_principal" value
 * @method string              getCaDireccion()       Returns the current record's "ca_direccion" value
 * @method string              getCaOficina()         Returns the current record's "ca_oficina" value
 * @method string              getCaTorre()           Returns the current record's "ca_torre" value
 * @method string              getCaBloque()          Returns the current record's "ca_bloque" value
 * @method string              getCaInterior()        Returns the current record's "ca_interior" value
 * @method string              getCaLocalidad()       Returns the current record's "ca_localidad" value
 * @method string              getCaComplemento()     Returns the current record's "ca_complemento" value
 * @method string              getCaTelefonos()       Returns the current record's "ca_telefonos" value
 * @method string              getCaFax()             Returns the current record's "ca_fax" value
 * @method string              getCaIdciudad()        Returns the current record's "ca_idciudad" value
 * @method string              getCaZipcode()         Returns the current record's "ca_zipcode" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method Ids                 getIds()               Returns the current record's "Ids" value
 * @method Ids                 getGrupo()             Returns the current record's "Grupo" value
 * @method Ciudad              getCiudad()            Returns the current record's "Ciudad" value
 * @method Doctrine_Collection getIdsContacto()       Returns the current record's "IdsContacto" collection
 * @method IdsSucursal         setCaIdsucursal()      Sets the current record's "ca_idsucursal" value
 * @method IdsSucursal         setCaId()              Sets the current record's "ca_id" value
 * @method IdsSucursal         setCaPrincipal()       Sets the current record's "ca_principal" value
 * @method IdsSucursal         setCaDireccion()       Sets the current record's "ca_direccion" value
 * @method IdsSucursal         setCaOficina()         Sets the current record's "ca_oficina" value
 * @method IdsSucursal         setCaTorre()           Sets the current record's "ca_torre" value
 * @method IdsSucursal         setCaBloque()          Sets the current record's "ca_bloque" value
 * @method IdsSucursal         setCaInterior()        Sets the current record's "ca_interior" value
 * @method IdsSucursal         setCaLocalidad()       Sets the current record's "ca_localidad" value
 * @method IdsSucursal         setCaComplemento()     Sets the current record's "ca_complemento" value
 * @method IdsSucursal         setCaTelefonos()       Sets the current record's "ca_telefonos" value
 * @method IdsSucursal         setCaFax()             Sets the current record's "ca_fax" value
 * @method IdsSucursal         setCaIdciudad()        Sets the current record's "ca_idciudad" value
 * @method IdsSucursal         setCaZipcode()         Sets the current record's "ca_zipcode" value
 * @method IdsSucursal         setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdsSucursal         setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdsSucursal         setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdsSucursal         setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdsSucursal         setIds()               Sets the current record's "Ids" value
 * @method IdsSucursal         setGrupo()             Sets the current record's "Grupo" value
 * @method IdsSucursal         setCiudad()            Sets the current record's "Ciudad" value
 * @method IdsSucursal         setIdsContacto()       Sets the current record's "IdsContacto" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseIdsSucursal extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_sucursales');
        $this->hasColumn('ca_idsucursal', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_principal', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_direccion', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ca_oficina', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_torre', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_bloque', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_interior', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_localidad', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_complemento', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_telefonos', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_fax', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_idciudad', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));
        $this->hasColumn('ca_zipcode', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('Ids as Grupo', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idgrupo'));

        $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('IdsContacto', array(
             'local' => 'ca_idsucursal',
             'foreign' => 'ca_idsucursal'));
    }
}