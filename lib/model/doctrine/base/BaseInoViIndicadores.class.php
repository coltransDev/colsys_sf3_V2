<?php

/**
 * BaseInoViIndicadores
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_ano
 * @property string $ca_mes
 * @property integer $ca_idreporte
 * @property string $ca_consecutivo
 * @property integer $ca_version
 * @property integer $ca_idmaster
 * @property integer $ca_idhouse
 * @property string $ca_sucursal
 * @property string $ca_idtraorigen
 * @property string $ca_traorigen
 * @property string $ca_ciudestino
 * @property string $ca_impoexpo
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property integer $ca_idcliente
 * @property string $ca_doctransporte
 * @property string $ca_compania
 * @property string $ca_referencia
 * @property string $ca_continuacion
 * @property date $ca_fchllegada
 * @property date $ca_fchdesconsolidacion
 * @property date $ca_fchconfirmacion
 * @property date $ca_fchvaciado
 * @property integer $ca_idindicador
 * @property string $ca_idgval
 * @property boolean $ca_idgest
 * @property integer $ca_idgexc
 * @property string $ca_exclusion
 * @property string $ca_observaciones
 * @property date $ca_fchrecibo
 * @property date $ca_fchenvio
 * @property string $ca_usuenvio
 * @property string $ca_idetapa
 * @property string $ca_etapa
 * @property Reporte $Reporte
 * @property InoHouse $InoHouse
 * @property Usuario $Usuario
 * 
 * @method integer          getCaAno()                  Returns the current record's "ca_ano" value
 * @method string           getCaMes()                  Returns the current record's "ca_mes" value
 * @method integer          getCaIdreporte()            Returns the current record's "ca_idreporte" value
 * @method string           getCaConsecutivo()          Returns the current record's "ca_consecutivo" value
 * @method integer          getCaVersion()              Returns the current record's "ca_version" value
 * @method integer          getCaIdmaster()             Returns the current record's "ca_idmaster" value
 * @method integer          getCaIdhouse()              Returns the current record's "ca_idhouse" value
 * @method string           getCaSucursal()             Returns the current record's "ca_sucursal" value
 * @method string           getCaIdtraorigen()          Returns the current record's "ca_idtraorigen" value
 * @method string           getCaTraorigen()            Returns the current record's "ca_traorigen" value
 * @method string           getCaCiudestino()           Returns the current record's "ca_ciudestino" value
 * @method string           getCaImpoexpo()             Returns the current record's "ca_impoexpo" value
 * @method string           getCaTransporte()           Returns the current record's "ca_transporte" value
 * @method string           getCaModalidad()            Returns the current record's "ca_modalidad" value
 * @method integer          getCaIdcliente()            Returns the current record's "ca_idcliente" value
 * @method string           getCaDoctransporte()        Returns the current record's "ca_doctransporte" value
 * @method string           getCaCompania()             Returns the current record's "ca_compania" value
 * @method string           getCaReferencia()           Returns the current record's "ca_referencia" value
 * @method string           getCaContinuacion()         Returns the current record's "ca_continuacion" value
 * @method date             getCaFchllegada()           Returns the current record's "ca_fchllegada" value
 * @method date             getCaFchdesconsolidacion()  Returns the current record's "ca_fchdesconsolidacion" value
 * @method date             getCaFchconfirmacion()      Returns the current record's "ca_fchconfirmacion" value
 * @method date             getCaFchvaciado()           Returns the current record's "ca_fchvaciado" value
 * @method integer          getCaIdindicador()          Returns the current record's "ca_idindicador" value
 * @method string           getCaIdgval()               Returns the current record's "ca_idgval" value
 * @method boolean          getCaIdgest()               Returns the current record's "ca_idgest" value
 * @method integer          getCaIdgexc()               Returns the current record's "ca_idgexc" value
 * @method string           getCaExclusion()            Returns the current record's "ca_exclusion" value
 * @method string           getCaObservaciones()        Returns the current record's "ca_observaciones" value
 * @method date             getCaFchrecibo()            Returns the current record's "ca_fchrecibo" value
 * @method date             getCaFchenvio()             Returns the current record's "ca_fchenvio" value
 * @method string           getCaUsuenvio()             Returns the current record's "ca_usuenvio" value
 * @method string           getCaIdetapa()              Returns the current record's "ca_idetapa" value
 * @method string           getCaEtapa()                Returns the current record's "ca_etapa" value
 * @method Reporte          getReporte()                Returns the current record's "Reporte" value
 * @method InoHouse         getInoHouse()               Returns the current record's "InoHouse" value
 * @method Usuario          getUsuario()                Returns the current record's "Usuario" value
 * @method InoViIndicadores setCaAno()                  Sets the current record's "ca_ano" value
 * @method InoViIndicadores setCaMes()                  Sets the current record's "ca_mes" value
 * @method InoViIndicadores setCaIdreporte()            Sets the current record's "ca_idreporte" value
 * @method InoViIndicadores setCaConsecutivo()          Sets the current record's "ca_consecutivo" value
 * @method InoViIndicadores setCaVersion()              Sets the current record's "ca_version" value
 * @method InoViIndicadores setCaIdmaster()             Sets the current record's "ca_idmaster" value
 * @method InoViIndicadores setCaIdhouse()              Sets the current record's "ca_idhouse" value
 * @method InoViIndicadores setCaSucursal()             Sets the current record's "ca_sucursal" value
 * @method InoViIndicadores setCaIdtraorigen()          Sets the current record's "ca_idtraorigen" value
 * @method InoViIndicadores setCaTraorigen()            Sets the current record's "ca_traorigen" value
 * @method InoViIndicadores setCaCiudestino()           Sets the current record's "ca_ciudestino" value
 * @method InoViIndicadores setCaImpoexpo()             Sets the current record's "ca_impoexpo" value
 * @method InoViIndicadores setCaTransporte()           Sets the current record's "ca_transporte" value
 * @method InoViIndicadores setCaModalidad()            Sets the current record's "ca_modalidad" value
 * @method InoViIndicadores setCaIdcliente()            Sets the current record's "ca_idcliente" value
 * @method InoViIndicadores setCaDoctransporte()        Sets the current record's "ca_doctransporte" value
 * @method InoViIndicadores setCaCompania()             Sets the current record's "ca_compania" value
 * @method InoViIndicadores setCaReferencia()           Sets the current record's "ca_referencia" value
 * @method InoViIndicadores setCaContinuacion()         Sets the current record's "ca_continuacion" value
 * @method InoViIndicadores setCaFchllegada()           Sets the current record's "ca_fchllegada" value
 * @method InoViIndicadores setCaFchdesconsolidacion()  Sets the current record's "ca_fchdesconsolidacion" value
 * @method InoViIndicadores setCaFchconfirmacion()      Sets the current record's "ca_fchconfirmacion" value
 * @method InoViIndicadores setCaFchvaciado()           Sets the current record's "ca_fchvaciado" value
 * @method InoViIndicadores setCaIdindicador()          Sets the current record's "ca_idindicador" value
 * @method InoViIndicadores setCaIdgval()               Sets the current record's "ca_idgval" value
 * @method InoViIndicadores setCaIdgest()               Sets the current record's "ca_idgest" value
 * @method InoViIndicadores setCaIdgexc()               Sets the current record's "ca_idgexc" value
 * @method InoViIndicadores setCaExclusion()            Sets the current record's "ca_exclusion" value
 * @method InoViIndicadores setCaObservaciones()        Sets the current record's "ca_observaciones" value
 * @method InoViIndicadores setCaFchrecibo()            Sets the current record's "ca_fchrecibo" value
 * @method InoViIndicadores setCaFchenvio()             Sets the current record's "ca_fchenvio" value
 * @method InoViIndicadores setCaUsuenvio()             Sets the current record's "ca_usuenvio" value
 * @method InoViIndicadores setCaIdetapa()              Sets the current record's "ca_idetapa" value
 * @method InoViIndicadores setCaEtapa()                Sets the current record's "ca_etapa" value
 * @method InoViIndicadores setReporte()                Sets the current record's "Reporte" value
 * @method InoViIndicadores setInoHouse()               Sets the current record's "InoHouse" value
 * @method InoViIndicadores setUsuario()                Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoViIndicadores extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.vi_indicadores');
        $this->hasColumn('ca_ano', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_mes', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_consecutivo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_version', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idhouse', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_sucursal', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idtraorigen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_traorigen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ciudestino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_doctransporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_compania', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_continuacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchllegada', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchdesconsolidacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchconfirmacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvaciado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_idindicador', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idgval', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idgest', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idgexc', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_exclusion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchrecibo', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchenvio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_usuenvio', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idetapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('InoHouse', array(
             'local' => 'ca_idhouse',
             'foreign' => 'ca_idhouse'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_usuenvio',
             'foreign' => 'ca_login'));
    }
}