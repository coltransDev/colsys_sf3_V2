<?php

/**
 * BaseInoViBusqueda
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idmaster
 * @property string $ca_transporte
 * @property string $ca_impoexpo
 * @property string $ca_modalidad
 * @property string $ca_origen
 * @property string $ca_destino
 * @property integer $ca_idlinea
 * @property string $ca_master
 * @property date $ca_fchcreado
 * @property date $ca_fchllegada
 * @property string $ca_doctransporte
 * @property integer $ca_idcliente
 * @property string $ca_vendedor
 * @property string $ca_compania
 * @property integer $ca_idagente
 * @property string $ca_nomagente
 * @property integer $ca_idproveedor
 * @property string $ca_nomlinea
 * @property date $ca_fchcomprobante
 * @property string $ca_consecutivo
 * @property integer $ca_idtipo
 * @property integer $ca_idcomprobante
 * @property string $ca_ciuorigen
 * @property string $ca_ciudestino
 * @property date $ca_fchcerrado
 * @property string $ca_factura
 * @property string $ca_reporte
 * @property timestamp $ca_fchanulado
 * @property timestamp $ca_fchliquidado
 * @property string $ca_cotizacion
 * @property InoMaster $InoMaster
 * @property Doctrine_Collection $InoHouse
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Doctrine_Collection $InoComprobante
 * @property Ids $Ids
 * 
 * @method string              getCaReferencia()      Returns the current record's "ca_referencia" value
 * @method integer             getCaIdmaster()        Returns the current record's "ca_idmaster" value
 * @method string              getCaTransporte()      Returns the current record's "ca_transporte" value
 * @method string              getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method string              getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string              getCaOrigen()          Returns the current record's "ca_origen" value
 * @method string              getCaDestino()         Returns the current record's "ca_destino" value
 * @method integer             getCaIdlinea()         Returns the current record's "ca_idlinea" value
 * @method string              getCaMaster()          Returns the current record's "ca_master" value
 * @method date                getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method date                getCaFchllegada()      Returns the current record's "ca_fchllegada" value
 * @method string              getCaDoctransporte()   Returns the current record's "ca_doctransporte" value
 * @method integer             getCaIdcliente()       Returns the current record's "ca_idcliente" value
 * @method string              getCaVendedor()        Returns the current record's "ca_vendedor" value
 * @method string              getCaCompania()        Returns the current record's "ca_compania" value
 * @method integer             getCaIdagente()        Returns the current record's "ca_idagente" value
 * @method string              getCaNomagente()       Returns the current record's "ca_nomagente" value
 * @method integer             getCaIdproveedor()     Returns the current record's "ca_idproveedor" value
 * @method string              getCaNomlinea()        Returns the current record's "ca_nomlinea" value
 * @method date                getCaFchcomprobante()  Returns the current record's "ca_fchcomprobante" value
 * @method string              getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method integer             getCaIdtipo()          Returns the current record's "ca_idtipo" value
 * @method integer             getCaIdcomprobante()   Returns the current record's "ca_idcomprobante" value
 * @method string              getCaCiuorigen()       Returns the current record's "ca_ciuorigen" value
 * @method string              getCaCiudestino()      Returns the current record's "ca_ciudestino" value
 * @method date                getCaFchcerrado()      Returns the current record's "ca_fchcerrado" value
 * @method string              getCaFactura()         Returns the current record's "ca_factura" value
 * @method string              getCaReporte()         Returns the current record's "ca_reporte" value
 * @method timestamp           getCaFchanulado()      Returns the current record's "ca_fchanulado" value
 * @method timestamp           getCaFchliquidado()    Returns the current record's "ca_fchliquidado" value
 * @method string              getCaCotizacion()      Returns the current record's "ca_cotizacion" value
 * @method InoMaster           getInoMaster()         Returns the current record's "InoMaster" value
 * @method Doctrine_Collection getInoHouse()          Returns the current record's "InoHouse" collection
 * @method Ciudad              getOrigen()            Returns the current record's "Origen" value
 * @method Ciudad              getDestino()           Returns the current record's "Destino" value
 * @method Doctrine_Collection getInoComprobante()    Returns the current record's "InoComprobante" collection
 * @method Ids                 getIds()               Returns the current record's "Ids" value
 * @method InoViBusqueda       setCaReferencia()      Sets the current record's "ca_referencia" value
 * @method InoViBusqueda       setCaIdmaster()        Sets the current record's "ca_idmaster" value
 * @method InoViBusqueda       setCaTransporte()      Sets the current record's "ca_transporte" value
 * @method InoViBusqueda       setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method InoViBusqueda       setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method InoViBusqueda       setCaOrigen()          Sets the current record's "ca_origen" value
 * @method InoViBusqueda       setCaDestino()         Sets the current record's "ca_destino" value
 * @method InoViBusqueda       setCaIdlinea()         Sets the current record's "ca_idlinea" value
 * @method InoViBusqueda       setCaMaster()          Sets the current record's "ca_master" value
 * @method InoViBusqueda       setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoViBusqueda       setCaFchllegada()      Sets the current record's "ca_fchllegada" value
 * @method InoViBusqueda       setCaDoctransporte()   Sets the current record's "ca_doctransporte" value
 * @method InoViBusqueda       setCaIdcliente()       Sets the current record's "ca_idcliente" value
 * @method InoViBusqueda       setCaVendedor()        Sets the current record's "ca_vendedor" value
 * @method InoViBusqueda       setCaCompania()        Sets the current record's "ca_compania" value
 * @method InoViBusqueda       setCaIdagente()        Sets the current record's "ca_idagente" value
 * @method InoViBusqueda       setCaNomagente()       Sets the current record's "ca_nomagente" value
 * @method InoViBusqueda       setCaIdproveedor()     Sets the current record's "ca_idproveedor" value
 * @method InoViBusqueda       setCaNomlinea()        Sets the current record's "ca_nomlinea" value
 * @method InoViBusqueda       setCaFchcomprobante()  Sets the current record's "ca_fchcomprobante" value
 * @method InoViBusqueda       setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method InoViBusqueda       setCaIdtipo()          Sets the current record's "ca_idtipo" value
 * @method InoViBusqueda       setCaIdcomprobante()   Sets the current record's "ca_idcomprobante" value
 * @method InoViBusqueda       setCaCiuorigen()       Sets the current record's "ca_ciuorigen" value
 * @method InoViBusqueda       setCaCiudestino()      Sets the current record's "ca_ciudestino" value
 * @method InoViBusqueda       setCaFchcerrado()      Sets the current record's "ca_fchcerrado" value
 * @method InoViBusqueda       setCaFactura()         Sets the current record's "ca_factura" value
 * @method InoViBusqueda       setCaReporte()         Sets the current record's "ca_reporte" value
 * @method InoViBusqueda       setCaFchanulado()      Sets the current record's "ca_fchanulado" value
 * @method InoViBusqueda       setCaFchliquidado()    Sets the current record's "ca_fchliquidado" value
 * @method InoViBusqueda       setCaCotizacion()      Sets the current record's "ca_cotizacion" value
 * @method InoViBusqueda       setInoMaster()         Sets the current record's "InoMaster" value
 * @method InoViBusqueda       setInoHouse()          Sets the current record's "InoHouse" collection
 * @method InoViBusqueda       setOrigen()            Sets the current record's "Origen" value
 * @method InoViBusqueda       setDestino()           Sets the current record's "Destino" value
 * @method InoViBusqueda       setInoComprobante()    Sets the current record's "InoComprobante" collection
 * @method InoViBusqueda       setIds()               Sets the current record's "Ids" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoViBusqueda extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.vi_busqueda');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idmaster', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idlinea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_master', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchllegada', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_doctransporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_compania', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idagente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nomagente', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nomlinea', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcomprobante', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_consecutivo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idtipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcomprobante', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ciuorigen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ciudestino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcerrado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_factura', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_reporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchliquidado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_cotizacion', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoMaster', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));

        $this->hasMany('InoHouse', array(
             'local' => 'ca_idmaster',
             'foreign' => 'ca_idmaster'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('InoComprobante', array(
             'local' => 'ca_idhouse',
             'foreign' => 'ca_idhouse'));

        $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));
    }
}