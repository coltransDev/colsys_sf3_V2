<?php

/**
 * BaseCotProducto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproducto
 * @property integer $ca_idcotizacion
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_origen
 * @property string $ca_destino
 * @property string $ca_escala
 * @property string $ca_impoexpo
 * @property string $ca_imprimir
 * @property string $ca_producto
 * @property string $ca_incoterms
 * @property string $ca_frecuencia
 * @property string $ca_tiempotransito
 * @property string $ca_observaciones
 * @property string $ca_idlinea
 * @property boolean $ca_postularlinea
 * @property string $ca_etapa
 * @property integer $ca_idtarea
 * @property date $ca_vigencia
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Cotizacion $Cotizacion
 * @property Doctrine_Collection $CotOpcion
 * @property IdsProveedor $IdsProveedor
 * @property NotTarea $NotTarea
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property Doctrine_Collection $CotSeguimiento
 * 
 * @method integer             getCaIdproducto()      Returns the current record's "ca_idproducto" value
 * @method integer             getCaIdcotizacion()    Returns the current record's "ca_idcotizacion" value
 * @method string              getCaTransporte()      Returns the current record's "ca_transporte" value
 * @method string              getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method string              getCaOrigen()          Returns the current record's "ca_origen" value
 * @method string              getCaDestino()         Returns the current record's "ca_destino" value
 * @method string              getCaEscala()          Returns the current record's "ca_escala" value
 * @method string              getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method string              getCaImprimir()        Returns the current record's "ca_imprimir" value
 * @method string              getCaProducto()        Returns the current record's "ca_producto" value
 * @method string              getCaIncoterms()       Returns the current record's "ca_incoterms" value
 * @method string              getCaFrecuencia()      Returns the current record's "ca_frecuencia" value
 * @method string              getCaTiempotransito()  Returns the current record's "ca_tiempotransito" value
 * @method string              getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method string              getCaIdlinea()         Returns the current record's "ca_idlinea" value
 * @method boolean             getCaPostularlinea()   Returns the current record's "ca_postularlinea" value
 * @method string              getCaEtapa()           Returns the current record's "ca_etapa" value
 * @method integer             getCaIdtarea()         Returns the current record's "ca_idtarea" value
 * @method date                getCaVigencia()        Returns the current record's "ca_vigencia" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method Cotizacion          getCotizacion()        Returns the current record's "Cotizacion" value
 * @method Doctrine_Collection getCotOpcion()         Returns the current record's "CotOpcion" collection
 * @method IdsProveedor        getIdsProveedor()      Returns the current record's "IdsProveedor" value
 * @method NotTarea            getNotTarea()          Returns the current record's "NotTarea" value
 * @method Ciudad              getOrigen()            Returns the current record's "Origen" value
 * @method Ciudad              getDestino()           Returns the current record's "Destino" value
 * @method Doctrine_Collection getCotSeguimiento()    Returns the current record's "CotSeguimiento" collection
 * @method CotProducto         setCaIdproducto()      Sets the current record's "ca_idproducto" value
 * @method CotProducto         setCaIdcotizacion()    Sets the current record's "ca_idcotizacion" value
 * @method CotProducto         setCaTransporte()      Sets the current record's "ca_transporte" value
 * @method CotProducto         setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method CotProducto         setCaOrigen()          Sets the current record's "ca_origen" value
 * @method CotProducto         setCaDestino()         Sets the current record's "ca_destino" value
 * @method CotProducto         setCaEscala()          Sets the current record's "ca_escala" value
 * @method CotProducto         setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method CotProducto         setCaImprimir()        Sets the current record's "ca_imprimir" value
 * @method CotProducto         setCaProducto()        Sets the current record's "ca_producto" value
 * @method CotProducto         setCaIncoterms()       Sets the current record's "ca_incoterms" value
 * @method CotProducto         setCaFrecuencia()      Sets the current record's "ca_frecuencia" value
 * @method CotProducto         setCaTiempotransito()  Sets the current record's "ca_tiempotransito" value
 * @method CotProducto         setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method CotProducto         setCaIdlinea()         Sets the current record's "ca_idlinea" value
 * @method CotProducto         setCaPostularlinea()   Sets the current record's "ca_postularlinea" value
 * @method CotProducto         setCaEtapa()           Sets the current record's "ca_etapa" value
 * @method CotProducto         setCaIdtarea()         Sets the current record's "ca_idtarea" value
 * @method CotProducto         setCaVigencia()        Sets the current record's "ca_vigencia" value
 * @method CotProducto         setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CotProducto         setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CotProducto         setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CotProducto         setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CotProducto         setCotizacion()        Sets the current record's "Cotizacion" value
 * @method CotProducto         setCotOpcion()         Sets the current record's "CotOpcion" collection
 * @method CotProducto         setIdsProveedor()      Sets the current record's "IdsProveedor" value
 * @method CotProducto         setNotTarea()          Sets the current record's "NotTarea" value
 * @method CotProducto         setOrigen()            Sets the current record's "Origen" value
 * @method CotProducto         setDestino()           Sets the current record's "Destino" value
 * @method CotProducto         setCotSeguimiento()    Sets the current record's "CotSeguimiento" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseCotProducto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotproductos');
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
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
        $this->hasColumn('ca_escala', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_imprimir', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_producto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_incoterms', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_frecuencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tiempotransito', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idlinea', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_postularlinea', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_vigencia', 'date', null, array(
             'type' => 'date',
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


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cotizacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotOpcion', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));

        $this->hasOne('IdsProveedor', array(
             'local' => 'ca_idlinea',
             'foreign' => 'ca_idproveedor'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('CotSeguimiento', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));
    }
}