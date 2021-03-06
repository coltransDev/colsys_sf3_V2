<?php

/**
 * BaseCargosIso
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property smallint $ca_idcargo
 * @property string $ca_cargoiso
 * @property integer $ca_idempresa
 * @property string $ca_datos
 * @property string $ca_usucreado
 * @property date $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property date $ca_fchactualizado
 * @property boolean $ca_activo
 * @property Empresa $Empresa
 * @property Usuario $Usucreado
 * @property Usuario $Usuactualizado
 * 
 * @method smallint  getCaIdcargo()         Returns the current record's "ca_idcargo" value
 * @method string    getCaCargoiso()        Returns the current record's "ca_cargoiso" value
 * @method integer   getCaIdempresa()       Returns the current record's "ca_idempresa" value
 * @method string    getCaDatos()           Returns the current record's "ca_datos" value
 * @method string    getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method date      getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string    getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method date      getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method boolean   getCaActivo()          Returns the current record's "ca_activo" value
 * @method Empresa   getEmpresa()           Returns the current record's "Empresa" value
 * @method Usuario   getUsucreado()         Returns the current record's "Usucreado" value
 * @method Usuario   getUsuactualizado()    Returns the current record's "Usuactualizado" value
 * @method CargosIso setCaIdcargo()         Sets the current record's "ca_idcargo" value
 * @method CargosIso setCaCargoiso()        Sets the current record's "ca_cargoiso" value
 * @method CargosIso setCaIdempresa()       Sets the current record's "ca_idempresa" value
 * @method CargosIso setCaDatos()           Sets the current record's "ca_datos" value
 * @method CargosIso setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CargosIso setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CargosIso setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CargosIso setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CargosIso setCaActivo()          Sets the current record's "ca_activo" value
 * @method CargosIso setEmpresa()           Sets the current record's "Empresa" value
 * @method CargosIso setUsucreado()         Sets the current record's "Usucreado" value
 * @method CargosIso setUsuactualizado()    Sets the current record's "Usuactualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCargosIso extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_cargos_iso');
        $this->hasColumn('ca_idcargo', 'smallint', null, array(
             'type' => 'smallint',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_cargoiso', 'string', 70, array(
             'type' => 'string',
             'length' => '70',
             ));
        $this->hasColumn('ca_idempresa', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_datos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Empresa', array(
             'local' => 'ca_idempresa',
             'foreign' => 'ca_idempresa'));

        $this->hasOne('Usuario as Usucreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Usuactualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}