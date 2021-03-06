<?php

/**
 * BaseIdgCausas
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcausa
 * @property integer $ca_idriesgo
 * @property string $ca_causa
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property boolean $ca_nueva
 * @property integer $ca_orden
 * @property IdgRiesgos $IdgRiesgos
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Doctrine_Collection $IdgEventos
 * @property IdgEventoCausa $IdgEventoCausa
 * 
 * @method integer             getCaIdcausa()         Returns the current record's "ca_idcausa" value
 * @method integer             getCaIdriesgo()        Returns the current record's "ca_idriesgo" value
 * @method string              getCaCausa()           Returns the current record's "ca_causa" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method boolean             getCaNueva()           Returns the current record's "ca_nueva" value
 * @method integer             getCaOrden()           Returns the current record's "ca_orden" value
 * @method IdgRiesgos          getIdgRiesgos()        Returns the current record's "IdgRiesgos" value
 * @method Usuario             getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Doctrine_Collection getIdgEventos()        Returns the current record's "IdgEventos" collection
 * @method IdgEventoCausa      getIdgEventoCausa()    Returns the current record's "IdgEventoCausa" value
 * @method IdgCausas           setCaIdcausa()         Sets the current record's "ca_idcausa" value
 * @method IdgCausas           setCaIdriesgo()        Sets the current record's "ca_idriesgo" value
 * @method IdgCausas           setCaCausa()           Sets the current record's "ca_causa" value
 * @method IdgCausas           setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method IdgCausas           setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method IdgCausas           setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method IdgCausas           setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method IdgCausas           setCaNueva()           Sets the current record's "ca_nueva" value
 * @method IdgCausas           setCaOrden()           Sets the current record's "ca_orden" value
 * @method IdgCausas           setIdgRiesgos()        Sets the current record's "IdgRiesgos" value
 * @method IdgCausas           setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method IdgCausas           setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method IdgCausas           setIdgEventos()        Sets the current record's "IdgEventos" collection
 * @method IdgCausas           setIdgEventoCausa()    Sets the current record's "IdgEventoCausa" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdgCausas extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idg.tb_causas');
        $this->hasColumn('ca_idcausa', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idriesgo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_causa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_nueva', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_orden', 'integer', null, array(
             'type' => 'integer',
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

        $this->hasMany('IdgEventos', array(
             'local' => 'ca_idcausa',
             'foreign' => 'ca_idcausa'));

        $this->hasOne('IdgEventoCausa', array(
             'local' => 'ca_idcausa',
             'foreign' => 'ca_idcausa'));
    }
}