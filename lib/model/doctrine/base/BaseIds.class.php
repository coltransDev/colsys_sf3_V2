<?php

/**
 * BaseIds
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_dv
 * @property string $ca_idalterno
 * @property integer $ca_tipoidentificacion
 * @property integer $ca_idgrupo
 * @property string $ca_nombre
 * @property string $ca_website
 * @property integer $ca_tipopersona
 * @property integer $ca_regimen
 * @property string $ca_actividad
 * @property string $ca_sectoreco
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_datos
 * @property Doctrine_Collection $IdsSucursal
 * @property IdsAgente $IdsAgente
 * @property IdsProveedor $IdsProveedor
 * @property IdsCliente $IdsCliente
 * @property IdsEmpresa $IdsEmpresa
 * @property Doctrine_Collection $IdsDocumento
 * @property Doctrine_Collection $IdsBalance
 * @property Doctrine_Collection $IdsEvento
 * @property Doctrine_Collection $IdsSeguimiento
 * @property IdsTipoIdentificacion $IdsTipoIdentificacion
 * @property Doctrine_Collection $IdsRestrictivas
 * @property Doctrine_Collection $IdsBanco
 * @property Doctrine_Collection $IdsCredito
 * @property IdsEstadoSap $IdsEstadoSap
 * @property Doctrine_Collection $Empresa
 * @property Doctrine_Collection $tb_resultado_encuestas
 * @property Doctrine_Collection $tb_control_encuestas
 * @property Doctrine_Collection $IdsEvaluacion
 * @property Doctrine_Collection $Cliente
 * @property Doctrine_Collection $InoCosto
 * @property Doctrine_Collection $InoComprobante
 * @property Doctrine_Collection $InoDetalle
 * @property Doctrine_Collection $InoViConsComprobante
 * @property Doctrine_Collection $InoViBusqueda
 * @property Doctrine_Collection $InoClientesSea
 * @property Doctrine_Collection $ExpoCarrier
 * @property Doctrine_Collection $AduCliente
 * 
 * @method integer               getCaId()                   Returns the current record's "ca_id" value
 * @method integer               getCaDv()                   Returns the current record's "ca_dv" value
 * @method string                getCaIdalterno()            Returns the current record's "ca_idalterno" value
 * @method integer               getCaTipoidentificacion()   Returns the current record's "ca_tipoidentificacion" value
 * @method integer               getCaIdgrupo()              Returns the current record's "ca_idgrupo" value
 * @method string                getCaNombre()               Returns the current record's "ca_nombre" value
 * @method string                getCaWebsite()              Returns the current record's "ca_website" value
 * @method integer               getCaTipopersona()          Returns the current record's "ca_tipopersona" value
 * @method integer               getCaRegimen()              Returns the current record's "ca_regimen" value
 * @method string                getCaActividad()            Returns the current record's "ca_actividad" value
 * @method string                getCaSectoreco()            Returns the current record's "ca_sectoreco" value
 * @method string                getCaUsucreado()            Returns the current record's "ca_usucreado" value
 * @method timestamp             getCaFchcreado()            Returns the current record's "ca_fchcreado" value
 * @method string                getCaUsuactualizado()       Returns the current record's "ca_usuactualizado" value
 * @method timestamp             getCaFchactualizado()       Returns the current record's "ca_fchactualizado" value
 * @method string                getCaDatos()                Returns the current record's "ca_datos" value
 * @method Doctrine_Collection   getIdsSucursal()            Returns the current record's "IdsSucursal" collection
 * @method IdsAgente             getIdsAgente()              Returns the current record's "IdsAgente" value
 * @method IdsProveedor          getIdsProveedor()           Returns the current record's "IdsProveedor" value
 * @method IdsCliente            getIdsCliente()             Returns the current record's "IdsCliente" value
 * @method IdsEmpresa            getIdsEmpresa()             Returns the current record's "IdsEmpresa" value
 * @method Doctrine_Collection   getIdsDocumento()           Returns the current record's "IdsDocumento" collection
 * @method Doctrine_Collection   getIdsBalance()             Returns the current record's "IdsBalance" collection
 * @method Doctrine_Collection   getIdsEvento()              Returns the current record's "IdsEvento" collection
 * @method Doctrine_Collection   getIdsSeguimiento()         Returns the current record's "IdsSeguimiento" collection
 * @method IdsTipoIdentificacion getIdsTipoIdentificacion()  Returns the current record's "IdsTipoIdentificacion" value
 * @method Doctrine_Collection   getIdsRestrictivas()        Returns the current record's "IdsRestrictivas" collection
 * @method Doctrine_Collection   getIdsBanco()               Returns the current record's "IdsBanco" collection
 * @method Doctrine_Collection   getIdsCredito()             Returns the current record's "IdsCredito" collection
 * @method IdsEstadoSap          getIdsEstadoSap()           Returns the current record's "IdsEstadoSap" value
 * @method Doctrine_Collection   getEmpresa()                Returns the current record's "Empresa" collection
 * @method Doctrine_Collection   getTbResultadoEncuestas()   Returns the current record's "tb_resultado_encuestas" collection
 * @method Doctrine_Collection   getTbControlEncuestas()     Returns the current record's "tb_control_encuestas" collection
 * @method Doctrine_Collection   getIdsEvaluacion()          Returns the current record's "IdsEvaluacion" collection
 * @method Doctrine_Collection   getInoCosto()               Returns the current record's "InoCosto" collection
 * @method Doctrine_Collection   getInoComprobante()         Returns the current record's "InoComprobante" collection
 * @method Doctrine_Collection   getInoDetalle()             Returns the current record's "InoDetalle" collection
 * @method Doctrine_Collection   getInoViConsComprobante()   Returns the current record's "InoViConsComprobante" collection
 * @method Doctrine_Collection   getInoViBusqueda()          Returns the current record's "InoViBusqueda" collection
 * @method Doctrine_Collection   getInoClientesSea()         Returns the current record's "InoClientesSea" collection
 * @method Doctrine_Collection   getExpoCarrier()            Returns the current record's "ExpoCarrier" collection
 * @method Doctrine_Collection   getAduCliente()             Returns the current record's "AduCliente" collection
 * @method Ids                   setCaId()                   Sets the current record's "ca_id" value
 * @method Ids                   setCaDv()                   Sets the current record's "ca_dv" value
 * @method Ids                   setCaIdalterno()            Sets the current record's "ca_idalterno" value
 * @method Ids                   setCaTipoidentificacion()   Sets the current record's "ca_tipoidentificacion" value
 * @method Ids                   setCaIdgrupo()              Sets the current record's "ca_idgrupo" value
 * @method Ids                   setCaNombre()               Sets the current record's "ca_nombre" value
 * @method Ids                   setCaWebsite()              Sets the current record's "ca_website" value
 * @method Ids                   setCaTipopersona()          Sets the current record's "ca_tipopersona" value
 * @method Ids                   setCaRegimen()              Sets the current record's "ca_regimen" value
 * @method Ids                   setCaActividad()            Sets the current record's "ca_actividad" value
 * @method Ids                   setCaSectoreco()            Sets the current record's "ca_sectoreco" value
 * @method Ids                   setCaUsucreado()            Sets the current record's "ca_usucreado" value
 * @method Ids                   setCaFchcreado()            Sets the current record's "ca_fchcreado" value
 * @method Ids                   setCaUsuactualizado()       Sets the current record's "ca_usuactualizado" value
 * @method Ids                   setCaFchactualizado()       Sets the current record's "ca_fchactualizado" value
 * @method Ids                   setCaDatos()                Sets the current record's "ca_datos" value
 * @method Ids                   setIdsSucursal()            Sets the current record's "IdsSucursal" collection
 * @method Ids                   setIdsAgente()              Sets the current record's "IdsAgente" value
 * @method Ids                   setIdsProveedor()           Sets the current record's "IdsProveedor" value
 * @method Ids                   setIdsCliente()             Sets the current record's "IdsCliente" value
 * @method Ids                   setIdsEmpresa()             Sets the current record's "IdsEmpresa" value
 * @method Ids                   setIdsDocumento()           Sets the current record's "IdsDocumento" collection
 * @method Ids                   setIdsBalance()             Sets the current record's "IdsBalance" collection
 * @method Ids                   setIdsEvento()              Sets the current record's "IdsEvento" collection
 * @method Ids                   setIdsSeguimiento()         Sets the current record's "IdsSeguimiento" collection
 * @method Ids                   setIdsTipoIdentificacion()  Sets the current record's "IdsTipoIdentificacion" value
 * @method Ids                   setIdsRestrictivas()        Sets the current record's "IdsRestrictivas" collection
 * @method Ids                   setIdsBanco()               Sets the current record's "IdsBanco" collection
 * @method Ids                   setIdsCredito()             Sets the current record's "IdsCredito" collection
 * @method Ids                   setIdsEstadoSap()           Sets the current record's "IdsEstadoSap" value
 * @method Ids                   setEmpresa()                Sets the current record's "Empresa" collection
 * @method Ids                   setTbResultadoEncuestas()   Sets the current record's "tb_resultado_encuestas" collection
 * @method Ids                   setTbControlEncuestas()     Sets the current record's "tb_control_encuestas" collection
 * @method Ids                   setIdsEvaluacion()          Sets the current record's "IdsEvaluacion" collection
 * @method Ids                   setInoCosto()               Sets the current record's "InoCosto" collection
 * @method Ids                   setInoComprobante()         Sets the current record's "InoComprobante" collection
 * @method Ids                   setInoDetalle()             Sets the current record's "InoDetalle" collection
 * @method Ids                   setInoViConsComprobante()   Sets the current record's "InoViConsComprobante" collection
 * @method Ids                   setInoViBusqueda()          Sets the current record's "InoViBusqueda" collection
 * @method Ids                   setInoClientesSea()         Sets the current record's "InoClientesSea" collection
 * @method Ids                   setExpoCarrier()            Sets the current record's "ExpoCarrier" collection
 * @method Ids                   setAduCliente()             Sets the current record's "AduCliente" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIds extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_ids');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_dv', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idalterno', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_tipoidentificacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idgrupo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombre', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_website', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_tipopersona', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_regimen', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_actividad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sectoreco', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
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
        $this->hasColumn('ca_datos', 'string', null, array(
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
        $this->hasMany('IdsSucursal', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsAgente', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idagente'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('IdsCliente', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('IdsEmpresa', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idempresa'));

        $this->hasMany('IdsDocumento', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsBalance', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsEvento', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsSeguimiento', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsTipoIdentificacion', array(
             'local' => 'ca_tipoidentificacion',
             'foreign' => 'ca_tipoidentificacion'));

        $this->hasMany('IdsRestrictivas', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsBanco', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsCredito', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasOne('IdsEstadoSap', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('Empresa', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('ResultadoEncuesta as tb_resultado_encuestas', array(
             'local' => 'ca_id',
             'foreign' => 'tb_ids_ca_id'));

        $this->hasMany('ControlEncuesta as tb_control_encuestas', array(
             'local' => 'ca_id',
             'foreign' => 'tb_ids_ca_id'));

        $this->hasMany('IdsEvaluacion', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('Cliente', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoCosto', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idproveedor'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('InoDetalle', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('InoViConsComprobante', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('InoViBusqueda', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idagente'));

        $this->hasMany('ExpoCarrier', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idcarrier'));

        $this->hasMany('AduCliente', array(
             'local' => 'ca_id',
             'foreign' => 'ca_idagaduana'));
    }
}