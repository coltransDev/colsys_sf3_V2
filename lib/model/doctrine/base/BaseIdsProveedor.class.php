<?php

/**
 * BaseIdsProveedor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproveedor
 * @property string $ca_tipo
 * @property boolean $ca_critico
 * @property integer $ca_controladoporsig
 * @property string $ca_jefecuenta
 * @property timestamp $ca_fchaprobado
 * @property string $ca_usuaprobado
 * @property string $ca_ususolicitud
 * @property string $ca_sigla
 * @property string $ca_transporte
 * @property string $ca_empresa
 * @property boolean $ca_activo
 * @property boolean $ca_activo_impo
 * @property boolean $ca_activo_expo
 * @property boolean $ca_contrato_comodato
 * @property boolean $ca_vetado
 * @property integer $ca_idclasificacion
 * @property date $ca_fchvencimiento
 * @property boolean $ca_esporadico
 * @property boolean $ca_tercero
 * @property date $ca_fchcircular
 * @property date $ca_fchvencircular
 * @property string $ca_nvlriesgo
 * @property date $ca_fchcotratoag
 * @property text $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchfinanciero
 * @property string $ca_usufinanciero
 * @property Ids $Ids
 * @property IdsTipo $IdsTipo
 * @property Usuario $Usuario
 * @property Usuario $Jefe
 * @property MaestraClasificacion $MaestraClasificacion
 * @property Doctrine_Collection $TransporteAdu
 * @property Doctrine_Collection $InoMaestraAir
 * @property Doctrine_Collection $CotProducto
 * @property Doctrine_Collection $InoMaster
 * @property Doctrine_Collection $InoMaestraSea
 * @property Doctrine_Collection $Trayecto
 * @property Doctrine_Collection $PricRecargoxLinea
 * @property Doctrine_Collection $PricRecargoxLineaBs
 * @property Doctrine_Collection $PricRecargoxLineaLog
 * @property Doctrine_Collection $PricPatioLinea
 * @property Doctrine_Collection $PricRecargoParametro
 * @property Doctrine_Collection $Reporte
 * @property Doctrine_Collection $RepOtm
 * @property Doctrine_Collection $CotProducto1
 * 
 * @method integer              getCaIdproveedor()        Returns the current record's "ca_idproveedor" value
 * @method string               getCaTipo()               Returns the current record's "ca_tipo" value
 * @method boolean              getCaCritico()            Returns the current record's "ca_critico" value
 * @method integer              getCaControladoporsig()   Returns the current record's "ca_controladoporsig" value
 * @method string               getCaJefecuenta()         Returns the current record's "ca_jefecuenta" value
 * @method timestamp            getCaFchaprobado()        Returns the current record's "ca_fchaprobado" value
 * @method string               getCaUsuaprobado()        Returns the current record's "ca_usuaprobado" value
 * @method string               getCaUsusolicitud()       Returns the current record's "ca_ususolicitud" value
 * @method string               getCaSigla()              Returns the current record's "ca_sigla" value
 * @method string               getCaTransporte()         Returns the current record's "ca_transporte" value
 * @method string               getCaEmpresa()            Returns the current record's "ca_empresa" value
 * @method boolean              getCaActivo()             Returns the current record's "ca_activo" value
 * @method boolean              getCaActivoImpo()         Returns the current record's "ca_activo_impo" value
 * @method boolean              getCaActivoExpo()         Returns the current record's "ca_activo_expo" value
 * @method boolean              getCaContratoComodato()   Returns the current record's "ca_contrato_comodato" value
 * @method boolean              getCaVetado()             Returns the current record's "ca_vetado" value
 * @method integer              getCaIdclasificacion()    Returns the current record's "ca_idclasificacion" value
 * @method date                 getCaFchvencimiento()     Returns the current record's "ca_fchvencimiento" value
 * @method boolean              getCaEsporadico()         Returns the current record's "ca_esporadico" value
 * @method boolean              getCaTercero()            Returns the current record's "ca_tercero" value
 * @method date                 getCaFchcircular()        Returns the current record's "ca_fchcircular" value
 * @method date                 getCaFchvencircular()     Returns the current record's "ca_fchvencircular" value
 * @method string               getCaNvlriesgo()          Returns the current record's "ca_nvlriesgo" value
 * @method text                 getCaObservaciones()      Returns the current record's "ca_observaciones" value
 * @method timestamp            getCaFchcreado()          Returns the current record's "ca_fchcreado" value
 * @method string               getCaUsucreado()          Returns the current record's "ca_usucreado" value
 * @method timestamp            getCaFchactualizado()     Returns the current record's "ca_fchactualizado" value
 * @method string               getCaUsuactualizado()     Returns the current record's "ca_usuactualizado" value
 * @method timestamp            getCaFchfinanciero()      Returns the current record's "ca_fchfinanciero" value
 * @method string               getCaUsufinanciero()      Returns the current record's "ca_usufinanciero" value
 * @method Ids                  getIds()                  Returns the current record's "Ids" value
 * @method IdsTipo              getIdsTipo()              Returns the current record's "IdsTipo" value
 * @method Usuario              getUsuario()              Returns the current record's "Usuario" value
 * @method Usuario              getJefe()                 Returns the current record's "Jefe" value
 * @method MaestraClasificacion getMaestraClasificacion() Returns the current record's "MaestraClasificacion" value
 * @method Doctrine_Collection  getTransporteAdu()        Returns the current record's "TransporteAdu" collection
 * @method Doctrine_Collection  getInoMaestraAir()        Returns the current record's "InoMaestraAir" collection
 * @method Doctrine_Collection  getCotProducto()          Returns the current record's "CotProducto" collection
 * @method Doctrine_Collection  getInoMaster()            Returns the current record's "InoMaster" collection
 * @method Doctrine_Collection  getInoMaestraSea()        Returns the current record's "InoMaestraSea" collection
 * @method Doctrine_Collection  getTrayecto()             Returns the current record's "Trayecto" collection
 * @method Doctrine_Collection  getPricRecargoxLinea()    Returns the current record's "PricRecargoxLinea" collection
 * @method Doctrine_Collection  getPricRecargoxLineaBs()  Returns the current record's "PricRecargoxLineaBs" collection
 * @method Doctrine_Collection  getPricRecargoxLineaLog() Returns the current record's "PricRecargoxLineaLog" collection
 * @method Doctrine_Collection  getPricPatioLinea()       Returns the current record's "PricPatioLinea" collection
 * @method Doctrine_Collection  getPricRecargoParametro() Returns the current record's "PricRecargoParametro" collection
 * @method Doctrine_Collection  getReporte()              Returns the current record's "Reporte" collection
 * @method Doctrine_Collection  getRepOtm()               Returns the current record's "RepOtm" collection
 * @method Doctrine_Collection  getCotProducto1()         Returns the current record's "CotProducto1" collection
 * @method IdsProveedor         setCaIdproveedor()        Sets the current record's "ca_idproveedor" value
 * @method IdsProveedor         setCaTipo()               Sets the current record's "ca_tipo" value
 * @method IdsProveedor         setCaCritico()            Sets the current record's "ca_critico" value
 * @method IdsProveedor         setCaControladoporsig()   Sets the current record's "ca_controladoporsig" value
 * @method IdsProveedor         setCaJefecuenta()         Sets the current record's "ca_jefecuenta" value
 * @method IdsProveedor         setCaFchaprobado()        Sets the current record's "ca_fchaprobado" value
 * @method IdsProveedor         setCaUsuaprobado()        Sets the current record's "ca_usuaprobado" value
 * @method IdsProveedor         setCaUsusolicitud()       Sets the current record's "ca_ususolicitud" value
 * @method IdsProveedor         setCaSigla()              Sets the current record's "ca_sigla" value
 * @method IdsProveedor         setCaTransporte()         Sets the current record's "ca_transporte" value
 * @method IdsProveedor         setCaEmpresa()            Sets the current record's "ca_empresa" value
 * @method IdsProveedor         setCaActivo()             Sets the current record's "ca_activo" value
 * @method IdsProveedor         setCaActivoImpo()         Sets the current record's "ca_activo_impo" value
 * @method IdsProveedor         setCaActivoExpo()         Sets the current record's "ca_activo_expo" value
 * @method IdsProveedor         setCaContratoComodato()   Sets the current record's "ca_contrato_comodato" value
 * @method IdsProveedor         setCaVetado()             Sets the current record's "ca_vetado" value
 * @method IdsProveedor         setCaIdclasificacion()    Sets the current record's "ca_idclasificacion" value
 * @method IdsProveedor         setCaFchvencimiento()     Sets the current record's "ca_fchvencimiento" value
 * @method IdsProveedor         setCaEsporadico()         Sets the current record's "ca_esporadico" value
 * @method IdsProveedor         setCaTercero()            Sets the current record's "ca_tercero" value
 * @method IdsProveedor         setCaFchcircular()        Sets the current record's "ca_fchcircular" value
 * @method IdsProveedor         setCaFchvencircular()     Sets the current record's "ca_fchvencircular" value
 * @method IdsProveedor         setCaNvlriesgo()          Sets the current record's "ca_nvlriesgo" value
 * @method IdsProveedor         setCaObservaciones()      Sets the current record's "ca_observaciones" value
 * @method IdsProveedor         setCaFchcreado()          Sets the current record's "ca_fchcreado" value
 * @method IdsProveedor         setCaUsucreado()          Sets the current record's "ca_usucreado" value
 * @method IdsProveedor         setCaFchactualizado()     Sets the current record's "ca_fchactualizado" value
 * @method IdsProveedor         setCaUsuactualizado()     Sets the current record's "ca_usuactualizado" value
 * @method IdsProveedor         setCaFchfinanciero()      Sets the current record's "ca_fchfinanciero" value
 * @method IdsProveedor         setCaUsufinanciero()      Sets the current record's "ca_usufinanciero" value
 * @method IdsProveedor         setIds()                  Sets the current record's "Ids" value
 * @method IdsProveedor         setIdsTipo()              Sets the current record's "IdsTipo" value
 * @method IdsProveedor         setUsuario()              Sets the current record's "Usuario" value
 * @method IdsProveedor         setJefe()                 Sets the current record's "Jefe" value
 * @method IdsProveedor         setMaestraClasificacion() Sets the current record's "MaestraClasificacion" value
 * @method IdsProveedor         setTransporteAdu()        Sets the current record's "TransporteAdu" collection
 * @method IdsProveedor         setInoMaestraAir()        Sets the current record's "InoMaestraAir" collection
 * @method IdsProveedor         setCotProducto()          Sets the current record's "CotProducto" collection
 * @method IdsProveedor         setInoMaster()            Sets the current record's "InoMaster" collection
 * @method IdsProveedor         setInoMaestraSea()        Sets the current record's "InoMaestraSea" collection
 * @method IdsProveedor         setTrayecto()             Sets the current record's "Trayecto" collection
 * @method IdsProveedor         setPricRecargoxLinea()    Sets the current record's "PricRecargoxLinea" collection
 * @method IdsProveedor         setPricRecargoxLineaBs()  Sets the current record's "PricRecargoxLineaBs" collection
 * @method IdsProveedor         setPricRecargoxLineaLog() Sets the current record's "PricRecargoxLineaLog" collection
 * @method IdsProveedor         setPricPatioLinea()       Sets the current record's "PricPatioLinea" collection
 * @method IdsProveedor         setPricRecargoParametro() Sets the current record's "PricRecargoParametro" collection
 * @method IdsProveedor         setReporte()              Sets the current record's "Reporte" collection
 * @method IdsProveedor         setRepOtm()               Sets the current record's "RepOtm" collection
 * @method IdsProveedor         setCotProducto1()         Sets the current record's "CotProducto1" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsProveedor extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_proveedores');
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_tipo', 'string', 5, array(
             'type' => 'string',
             'length' => '5',
             ));
        $this->hasColumn('ca_critico', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_controladoporsig', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_jefecuenta', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchaprobado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuaprobado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_ususolicitud', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_sigla', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_transporte', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
        $this->hasColumn('ca_empresa', 'string', 8, array(
             'type' => 'string',
             'length' => '8',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_activo_impo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_activo_expo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_contrato_comodato', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_vetado', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idclasificacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchvencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_esporadico', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_tercero', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_fchcircular', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvencircular', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_nvlriesgo', 'string', null, array(
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
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchfinanciero', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usufinanciero', 'string', null, array(
             'type' => 'string',
             ));
        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Ids', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsTipo', array(
             'local' => 'ca_tipo',
             'foreign' => 'ca_tipo'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_ususolicitud',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Jefe', array(
             'local' => 'ca_jefecuenta',
             'foreign' => 'ca_login'));

        $this->hasOne('MaestraClasificacion', array(
             'local' => 'ca_idclasificacion',
             'foreign' => 'ca_idclasificacion'));

        $this->hasMany('TransporteAdu', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idtransportista'));

        $this->hasMany('InoMaestraAir', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('CotProducto', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('InoMaster', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('InoMaestraSea', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('Trayecto', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('PricRecargoxLinea', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('PricRecargoxLineaBs', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('PricRecargoxLineaLog', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('PricPatioLinea', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('PricRecargoParametro', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));

        $this->hasMany('RepOtm', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idtransportador'));

        $this->hasMany('CotProducto1', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idlinea'));
    }
}