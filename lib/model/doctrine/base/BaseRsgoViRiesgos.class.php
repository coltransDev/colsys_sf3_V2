<?php

/**
 * BaseRsgoViRiesgos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_empresa
 * @property integer $ca_idproceso
 * @property string $ca_nombre
 * @property integer $ca_idempresa
 * @property integer $ca_orden
 * @property string $ca_prefijo
 * @property boolean $ca_activo
 * @property integer $ca_idriesgo
 * @property string $ca_codigo
 * @property string $ca_riesgo
 * @property string $ca_clasificacion
 * @property boolean $ca_activo_riesgo
 * @property boolean $ca_aprobado
 * @property RsgoProcesos $RsgoProcesos
 * @property Riesgos $Riesgos
 * @property Empresa $Empresa
 * 
 * @method string        getCaEmpresa()        Returns the current record's "ca_empresa" value
 * @method integer       getCaIdproceso()      Returns the current record's "ca_idproceso" value
 * @method string        getCaNombre()         Returns the current record's "ca_nombre" value
 * @method integer       getCaIdempresa()      Returns the current record's "ca_idempresa" value
 * @method integer       getCaOrden()          Returns the current record's "ca_orden" value
 * @method string        getCaPrefijo()        Returns the current record's "ca_prefijo" value
 * @method boolean       getCaActivo()         Returns the current record's "ca_activo" value
 * @method integer       getCaIdriesgo()       Returns the current record's "ca_idriesgo" value
 * @method string        getCaCodigo()         Returns the current record's "ca_codigo" value
 * @method string        getCaRiesgo()         Returns the current record's "ca_riesgo" value
 * @method string        getCaClasificacion()  Returns the current record's "ca_clasificacion" value
 * @method boolean       getCaActivoRiesgo()   Returns the current record's "ca_activo_riesgo" value
 * @method boolean       getCaAprobado()       Returns the current record's "ca_aprobado" value
 * @method RsgoProcesos  getRsgoProcesos()     Returns the current record's "RsgoProcesos" value
 * @method Riesgos       getRiesgos()          Returns the current record's "Riesgos" value
 * @method Empresa       getEmpresa()          Returns the current record's "Empresa" value
 * @method RsgoViRiesgos setCaEmpresa()        Sets the current record's "ca_empresa" value
 * @method RsgoViRiesgos setCaIdproceso()      Sets the current record's "ca_idproceso" value
 * @method RsgoViRiesgos setCaNombre()         Sets the current record's "ca_nombre" value
 * @method RsgoViRiesgos setCaIdempresa()      Sets the current record's "ca_idempresa" value
 * @method RsgoViRiesgos setCaOrden()          Sets the current record's "ca_orden" value
 * @method RsgoViRiesgos setCaPrefijo()        Sets the current record's "ca_prefijo" value
 * @method RsgoViRiesgos setCaActivo()         Sets the current record's "ca_activo" value
 * @method RsgoViRiesgos setCaIdriesgo()       Sets the current record's "ca_idriesgo" value
 * @method RsgoViRiesgos setCaCodigo()         Sets the current record's "ca_codigo" value
 * @method RsgoViRiesgos setCaRiesgo()         Sets the current record's "ca_riesgo" value
 * @method RsgoViRiesgos setCaClasificacion()  Sets the current record's "ca_clasificacion" value
 * @method RsgoViRiesgos setCaActivoRiesgo()   Sets the current record's "ca_activo_riesgo" value
 * @method RsgoViRiesgos setCaAprobado()       Sets the current record's "ca_aprobado" value
 * @method RsgoViRiesgos setRsgoProcesos()     Sets the current record's "RsgoProcesos" value
 * @method RsgoViRiesgos setRiesgos()          Sets the current record's "Riesgos" value
 * @method RsgoViRiesgos setEmpresa()          Sets the current record's "Empresa" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRsgoViRiesgos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('riesgos.vi_riesgos');
        $this->hasColumn('ca_empresa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idproceso', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_idempresa', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_orden', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_prefijo', 'string', 5, array(
             'type' => 'string',
             'length' => '5',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idriesgo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_codigo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_riesgo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_clasificacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_activo_riesgo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_aprobado', 'boolean', null, array(
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
        $this->hasOne('RsgoProcesos', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasOne('Riesgos', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasOne('Empresa', array(
             'local' => 'ca_idempresa',
             'foreign' => 'ca_idempresa'));
    }
}