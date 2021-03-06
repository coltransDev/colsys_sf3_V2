<?php

/**
 * BaseIdgVersion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_version
 * @property integer $ca_idproceso
 * @property string $ca_nombre
 * @property text $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fcheliminado
 * @property string $ca_usueliminado
 * @property IdgProcesos $IdgProcesos
 * @property Usuario $UsuCreado
 * @property Usuario $UsuEliminado
 * 
 * @method integer     getCaId()             Returns the current record's "ca_id" value
 * @method integer     getCaVersion()        Returns the current record's "ca_version" value
 * @method integer     getCaIdproceso()      Returns the current record's "ca_idproceso" value
 * @method string      getCaNombre()         Returns the current record's "ca_nombre" value
 * @method text        getCaObservaciones()  Returns the current record's "ca_observaciones" value
 * @method timestamp   getCaFchcreado()      Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()      Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFcheliminado()   Returns the current record's "ca_fcheliminado" value
 * @method string      getCaUsueliminado()   Returns the current record's "ca_usueliminado" value
 * @method IdgProcesos getIdgProcesos()      Returns the current record's "IdgProcesos" value
 * @method Usuario     getUsuCreado()        Returns the current record's "UsuCreado" value
 * @method Usuario     getUsuEliminado()     Returns the current record's "UsuEliminado" value
 * @method IdgVersion  setCaId()             Sets the current record's "ca_id" value
 * @method IdgVersion  setCaVersion()        Sets the current record's "ca_version" value
 * @method IdgVersion  setCaIdproceso()      Sets the current record's "ca_idproceso" value
 * @method IdgVersion  setCaNombre()         Sets the current record's "ca_nombre" value
 * @method IdgVersion  setCaObservaciones()  Sets the current record's "ca_observaciones" value
 * @method IdgVersion  setCaFchcreado()      Sets the current record's "ca_fchcreado" value
 * @method IdgVersion  setCaUsucreado()      Sets the current record's "ca_usucreado" value
 * @method IdgVersion  setCaFcheliminado()   Sets the current record's "ca_fcheliminado" value
 * @method IdgVersion  setCaUsueliminado()   Sets the current record's "ca_usueliminado" value
 * @method IdgVersion  setIdgProcesos()      Sets the current record's "IdgProcesos" value
 * @method IdgVersion  setUsuCreado()        Sets the current record's "UsuCreado" value
 * @method IdgVersion  setUsuEliminado()     Sets the current record's "UsuEliminado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdgVersion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idg.tb_versiones');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_version', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idproceso', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usueliminado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdgProcesos', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuEliminado', array(
             'local' => 'ca_usueliminado',
             'foreign' => 'ca_login'));
    }
}