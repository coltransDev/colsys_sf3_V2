<?php

/**
 * BaseRsgoCausas
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
 * @property Riesgos $Riesgos
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Doctrine_Collection $RsgoEventos
 * @property RsgoEventoCausa $RsgoEventoCausa
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
 * @method Riesgos             getRiesgos()           Returns the current record's "Riesgos" value
 * @method Usuario             getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Doctrine_Collection getRsgoEventos()       Returns the current record's "RsgoEventos" collection
 * @method RsgoEventoCausa     getRsgoEventoCausa()   Returns the current record's "RsgoEventoCausa" value
 * @method RsgoCausas          setCaIdcausa()         Sets the current record's "ca_idcausa" value
 * @method RsgoCausas          setCaIdriesgo()        Sets the current record's "ca_idriesgo" value
 * @method RsgoCausas          setCaCausa()           Sets the current record's "ca_causa" value
 * @method RsgoCausas          setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method RsgoCausas          setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method RsgoCausas          setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method RsgoCausas          setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method RsgoCausas          setCaNueva()           Sets the current record's "ca_nueva" value
 * @method RsgoCausas          setCaOrden()           Sets the current record's "ca_orden" value
 * @method RsgoCausas          setRiesgos()           Sets the current record's "Riesgos" value
 * @method RsgoCausas          setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method RsgoCausas          setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method RsgoCausas          setRsgoEventos()       Sets the current record's "RsgoEventos" collection
 * @method RsgoCausas          setRsgoEventoCausa()   Sets the current record's "RsgoEventoCausa" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRsgoCausas extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('riesgos.tb_causas');
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
        $this->hasOne('Riesgos', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasMany('RsgoEventos', array(
             'local' => 'ca_idcausa',
             'foreign' => 'ca_idcausa'));

        $this->hasOne('RsgoEventoCausa', array(
             'local' => 'ca_idcausa',
             'foreign' => 'ca_idcausa'));
    }
}