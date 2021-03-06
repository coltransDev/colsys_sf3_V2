<?php

/**
 * BaseRiesgos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idriesgo
 * @property integer $ca_idproceso
 * @property string $ca_codigo
 * @property string $ca_riesgo
 * @property string $ca_etapa
 * @property string $ca_potenciador
 * @property string $ca_controles
 * @property string $ca_ap
 * @property string $ca_contingencia
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property integer $ca_impresion
 * @property boolean $ca_laft
 * @property boolean $ca_activo
 * @property boolean $ca_aprobado
 * @property text $ca_clasificacion
 * @property RsgoProcesos $RsgoProcesos
 * @property Doctrine_Collection $RsgoFactor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Doctrine_Collection $RsgoValoracion
 * @property Doctrine_Collection $RsgoEventos
 * @property Doctrine_Collection $RsgoCausas
 * @property Doctrine_Collection $RsgoViRiesgos
 * 
 * @method integer             getCaIdriesgo()        Returns the current record's "ca_idriesgo" value
 * @method integer             getCaIdproceso()       Returns the current record's "ca_idproceso" value
 * @method string              getCaCodigo()          Returns the current record's "ca_codigo" value
 * @method string              getCaRiesgo()          Returns the current record's "ca_riesgo" value
 * @method string              getCaEtapa()           Returns the current record's "ca_etapa" value
 * @method string              getCaPotenciador()     Returns the current record's "ca_potenciador" value
 * @method string              getCaControles()       Returns the current record's "ca_controles" value
 * @method string              getCaAp()              Returns the current record's "ca_ap" value
 * @method string              getCaContingencia()    Returns the current record's "ca_contingencia" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method integer             getCaImpresion()       Returns the current record's "ca_impresion" value
 * @method boolean             getCaLaft()            Returns the current record's "ca_laft" value
 * @method boolean             getCaActivo()          Returns the current record's "ca_activo" value
 * @method boolean             getCaAprobado()        Returns the current record's "ca_aprobado" value
 * @method text                getCaClasificacion()   Returns the current record's "ca_clasificacion" value
 * @method RsgoProcesos        getRsgoProcesos()      Returns the current record's "RsgoProcesos" value
 * @method Doctrine_Collection getRsgoFactor()        Returns the current record's "RsgoFactor" collection
 * @method Usuario             getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario             getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Doctrine_Collection getRsgoValoracion()    Returns the current record's "RsgoValoracion" collection
 * @method Doctrine_Collection getRsgoEventos()       Returns the current record's "RsgoEventos" collection
 * @method Doctrine_Collection getRsgoCausas()        Returns the current record's "RsgoCausas" collection
 * @method Doctrine_Collection getRsgoViRiesgos()     Returns the current record's "RsgoViRiesgos" collection
 * @method Riesgos             setCaIdriesgo()        Sets the current record's "ca_idriesgo" value
 * @method Riesgos             setCaIdproceso()       Sets the current record's "ca_idproceso" value
 * @method Riesgos             setCaCodigo()          Sets the current record's "ca_codigo" value
 * @method Riesgos             setCaRiesgo()          Sets the current record's "ca_riesgo" value
 * @method Riesgos             setCaEtapa()           Sets the current record's "ca_etapa" value
 * @method Riesgos             setCaPotenciador()     Sets the current record's "ca_potenciador" value
 * @method Riesgos             setCaControles()       Sets the current record's "ca_controles" value
 * @method Riesgos             setCaAp()              Sets the current record's "ca_ap" value
 * @method Riesgos             setCaContingencia()    Sets the current record's "ca_contingencia" value
 * @method Riesgos             setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method Riesgos             setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method Riesgos             setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method Riesgos             setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method Riesgos             setCaImpresion()       Sets the current record's "ca_impresion" value
 * @method Riesgos             setCaLaft()            Sets the current record's "ca_laft" value
 * @method Riesgos             setCaActivo()          Sets the current record's "ca_activo" value
 * @method Riesgos             setCaAprobado()        Sets the current record's "ca_aprobado" value
 * @method Riesgos             setCaClasificacion()   Sets the current record's "ca_clasificacion" value
 * @method Riesgos             setRsgoProcesos()      Sets the current record's "RsgoProcesos" value
 * @method Riesgos             setRsgoFactor()        Sets the current record's "RsgoFactor" collection
 * @method Riesgos             setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method Riesgos             setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method Riesgos             setRsgoValoracion()    Sets the current record's "RsgoValoracion" collection
 * @method Riesgos             setRsgoEventos()       Sets the current record's "RsgoEventos" collection
 * @method Riesgos             setRsgoCausas()        Sets the current record's "RsgoCausas" collection
 * @method Riesgos             setRsgoViRiesgos()     Sets the current record's "RsgoViRiesgos" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRiesgos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('riesgos.tb_riesgos');
        $this->hasColumn('ca_idriesgo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idproceso', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_codigo', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '10',
             ));
        $this->hasColumn('ca_riesgo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_potenciador', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_controles', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ap', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_contingencia', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('ca_impresion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_laft', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_aprobado', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_clasificacion', 'text', null, array(
             'type' => 'text',
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

        $this->hasMany('RsgoFactor', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasMany('RsgoValoracion', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasMany('RsgoEventos', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasMany('RsgoCausas', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));

        $this->hasMany('RsgoViRiesgos', array(
             'local' => 'ca_idriesgo',
             'foreign' => 'ca_idriesgo'));
    }
}