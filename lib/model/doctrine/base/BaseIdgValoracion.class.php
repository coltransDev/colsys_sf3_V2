<?php

/**
 * BaseIdgValoracion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idvaloracion
 * @property integer $ca_idriesgo
 * @property integer $ca_ano
 * @property integer $ca_operativo
 * @property integer $ca_legal
 * @property integer $ca_economico
 * @property integer $ca_comercial
 * @property integer $ca_peso
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property jsonb $ca_datos
 * @property IdgRiesgos $IdgRiesgos
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @method integer       getCaIdvaloracion()    Returns the current record's "ca_idvaloracion" value
 * @method integer       getCaIdriesgo()        Returns the current record's "ca_idriesgo" value
 * @method integer       getCaAno()             Returns the current record's "ca_ano" value
 * @method integer       getCaOperativo()       Returns the current record's "ca_operativo" value
 * @method integer       getCaLegal()           Returns the current record's "ca_legal" value
 * @method integer       getCaEconomico()       Returns the current record's "ca_economico" value
 * @method integer       getCaComercial()       Returns the current record's "ca_comercial" value
 * @method integer       getCaPeso()            Returns the current record's "ca_peso" value
 * @method string        getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp     getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string        getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp     getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method jsonb         getCaDatos()           Returns the current record's "ca_datos" value
 * @method IdgRiesgos    getIdgRiesgos()        Returns the current record's "IdgRiesgos" value
 * @method Usuario       getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario       getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method IdgValoracion setCaIdvaloracion()    Sets the current record's "ca_idvaloracion" value
 * @method IdgValoracion setCaIdriesgo()        Sets the current record's "ca_idriesgo" value
 * @method IdgValoracion setCaAno()             Sets the current record's "ca_ano" value
 * @method IdgValoracion setCaOperativo()       Sets the current record's "ca_operativo" value
 * @method IdgValoracion setCaLegal()           Sets the current record's "ca_legal" value
 * @method IdgValoracion setCaEconomico()       Sets the current record's "ca_economico" value
 * @method IdgValoracion setCaComercial()       Sets the current record's "ca_comercial" value
 * @method IdgValoracion setCaPeso()            Sets the current record's "ca_peso" value
 * @method IdgValoracion setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdgValoracion setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdgValoracion setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdgValoracion setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdgValoracion setCaDatos()           Sets the current record's "ca_datos" value
 * @method IdgValoracion setIdgRiesgos()        Sets the current record's "IdgRiesgos" value
 * @method IdgValoracion setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method IdgValoracion setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdgValoracion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idg.tb_valoracion');
        $this->hasColumn('ca_idvaloracion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idriesgo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ano', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_operativo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_legal', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_economico', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_comercial', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_peso', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_datos', 'jsonb', null, array(
             'type' => 'jsonb',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdgRiesgos', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}