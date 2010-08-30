<?php

/**
 * BaseIdsContacto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcontacto
 * @property integer $ca_idsucursal
 * @property string $ca_nombres
 * @property string $ca_papellido
 * @property string $ca_sapellido
 * @property string $ca_saludo
 * @property string $ca_direccion
 * @property string $ca_telefonos
 * @property string $ca_fax
 * @property string $ca_email
 * @property string $ca_impoexpo
 * @property string $ca_transporte
 * @property string $ca_cargo
 * @property string $ca_departamento
 * @property string $ca_observaciones
 * @property boolean $ca_sugerido
 * @property integer $ca_visibilidad
 * @property boolean $ca_activo
 * @property string $ca_codigoarea
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property timestamp $ca_fcheliminado
 * @property string $ca_usueliminado
 * @property IdsSucursal $IdsSucursal
 * @property Doctrine_Collection $CotContactoAg
 * 
 * @method integer             getCaIdcontacto()      Returns the current record's "ca_idcontacto" value
 * @method integer             getCaIdsucursal()      Returns the current record's "ca_idsucursal" value
 * @method string              getCaNombres()         Returns the current record's "ca_nombres" value
 * @method string              getCaPapellido()       Returns the current record's "ca_papellido" value
 * @method string              getCaSapellido()       Returns the current record's "ca_sapellido" value
 * @method string              getCaSaludo()          Returns the current record's "ca_saludo" value
 * @method string              getCaDireccion()       Returns the current record's "ca_direccion" value
 * @method string              getCaTelefonos()       Returns the current record's "ca_telefonos" value
 * @method string              getCaFax()             Returns the current record's "ca_fax" value
 * @method string              getCaEmail()           Returns the current record's "ca_email" value
 * @method string              getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method string              getCaTransporte()      Returns the current record's "ca_transporte" value
 * @method string              getCaCargo()           Returns the current record's "ca_cargo" value
 * @method string              getCaDepartamento()    Returns the current record's "ca_departamento" value
 * @method string              getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method boolean             getCaSugerido()        Returns the current record's "ca_sugerido" value
 * @method integer             getCaVisibilidad()     Returns the current record's "ca_visibilidad" value
 * @method boolean             getCaActivo()          Returns the current record's "ca_activo" value
 * @method string              getCaCodigoarea()      Returns the current record's "ca_codigoarea" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method timestamp           getCaFcheliminado()    Returns the current record's "ca_fcheliminado" value
 * @method string              getCaUsueliminado()    Returns the current record's "ca_usueliminado" value
 * @method IdsSucursal         getIdsSucursal()       Returns the current record's "IdsSucursal" value
 * @method Doctrine_Collection getCotContactoAg()     Returns the current record's "CotContactoAg" collection
 * @method IdsContacto         setCaIdcontacto()      Sets the current record's "ca_idcontacto" value
 * @method IdsContacto         setCaIdsucursal()      Sets the current record's "ca_idsucursal" value
 * @method IdsContacto         setCaNombres()         Sets the current record's "ca_nombres" value
 * @method IdsContacto         setCaPapellido()       Sets the current record's "ca_papellido" value
 * @method IdsContacto         setCaSapellido()       Sets the current record's "ca_sapellido" value
 * @method IdsContacto         setCaSaludo()          Sets the current record's "ca_saludo" value
 * @method IdsContacto         setCaDireccion()       Sets the current record's "ca_direccion" value
 * @method IdsContacto         setCaTelefonos()       Sets the current record's "ca_telefonos" value
 * @method IdsContacto         setCaFax()             Sets the current record's "ca_fax" value
 * @method IdsContacto         setCaEmail()           Sets the current record's "ca_email" value
 * @method IdsContacto         setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method IdsContacto         setCaTransporte()      Sets the current record's "ca_transporte" value
 * @method IdsContacto         setCaCargo()           Sets the current record's "ca_cargo" value
 * @method IdsContacto         setCaDepartamento()    Sets the current record's "ca_departamento" value
 * @method IdsContacto         setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method IdsContacto         setCaSugerido()        Sets the current record's "ca_sugerido" value
 * @method IdsContacto         setCaVisibilidad()     Sets the current record's "ca_visibilidad" value
 * @method IdsContacto         setCaActivo()          Sets the current record's "ca_activo" value
 * @method IdsContacto         setCaCodigoarea()      Sets the current record's "ca_codigoarea" value
 * @method IdsContacto         setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdsContacto         setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdsContacto         setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdsContacto         setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdsContacto         setCaFcheliminado()    Sets the current record's "ca_fcheliminado" value
 * @method IdsContacto         setCaUsueliminado()    Sets the current record's "ca_usueliminado" value
 * @method IdsContacto         setIdsSucursal()       Sets the current record's "IdsSucursal" value
 * @method IdsContacto         setCotContactoAg()     Sets the current record's "CotContactoAg" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsContacto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_contactos');
        $this->hasColumn('ca_idcontacto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idsucursal', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombres', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_papellido', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_sapellido', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_saludo', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_direccion', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ca_telefonos', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_fax', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_email', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cargo', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_departamento', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_observaciones', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ca_sugerido', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_visibilidad', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_codigoarea', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usueliminado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdsSucursal', array(
             'local' => 'ca_idsucursal',
             'foreign' => 'ca_idsucursal'));

        $this->hasMany('CotContactoAg', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));
    }
}