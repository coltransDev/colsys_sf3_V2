<?php

/**
 * BaseCotTrayectoAduana
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproducto
 * @property integer $ca_idcotizacion
 * @property string $ca_origen
 * @property string $ca_destino
 * @property string $ca_producto
 * @property string $ca_observaciones
 * @property date $ca_vigencia
 * @property string $ca_impoexpo
 * @property string $ca_transporte
 * @property string $ca_modalidad
 * @property string $ca_estado
 * @property string $ca_etapa
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Cotizacion $Cotizacion
 * @property Ciudad $Origen
 * @property Ciudad $Destino
 * @property CotRecargosAduana $CotRecargosAduana
 * @property Cotizacion1 $Cotizacion1
 * @property CotRecargosAduana1 $CotRecargosAduana1
 * 
 * @method integer            getCaIdproducto()       Returns the current record's "ca_idproducto" value
 * @method integer            getCaIdcotizacion()     Returns the current record's "ca_idcotizacion" value
 * @method string             getCaOrigen()           Returns the current record's "ca_origen" value
 * @method string             getCaDestino()          Returns the current record's "ca_destino" value
 * @method string             getCaProducto()         Returns the current record's "ca_producto" value
 * @method string             getCaObservaciones()    Returns the current record's "ca_observaciones" value
 * @method date               getCaVigencia()         Returns the current record's "ca_vigencia" value
 * @method string             getCaImpoexpo()         Returns the current record's "ca_impoexpo" value
 * @method string             getCaTransporte()       Returns the current record's "ca_transporte" value
 * @method string             getCaModalidad()        Returns the current record's "ca_modalidad" value
 * @method string             getCaEstado()           Returns the current record's "ca_estado" value
 * @method string             getCaEtapa()            Returns the current record's "ca_etapa" value
 * @method string             getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp          getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string             getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method timestamp          getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method Cotizacion         getCotizacion()         Returns the current record's "Cotizacion" value
 * @method Ciudad             getOrigen()             Returns the current record's "Origen" value
 * @method Ciudad             getDestino()            Returns the current record's "Destino" value
 * @method CotRecargosAduana  getCotRecargosAduana()  Returns the current record's "CotRecargosAduana" value
 * @method Cotizacion1        getCotizacion1()        Returns the current record's "Cotizacion1" value
 * @method CotRecargosAduana1 getCotRecargosAduana1() Returns the current record's "CotRecargosAduana1" value
 * @method CotTrayectoAduana  setCaIdproducto()       Sets the current record's "ca_idproducto" value
 * @method CotTrayectoAduana  setCaIdcotizacion()     Sets the current record's "ca_idcotizacion" value
 * @method CotTrayectoAduana  setCaOrigen()           Sets the current record's "ca_origen" value
 * @method CotTrayectoAduana  setCaDestino()          Sets the current record's "ca_destino" value
 * @method CotTrayectoAduana  setCaProducto()         Sets the current record's "ca_producto" value
 * @method CotTrayectoAduana  setCaObservaciones()    Sets the current record's "ca_observaciones" value
 * @method CotTrayectoAduana  setCaVigencia()         Sets the current record's "ca_vigencia" value
 * @method CotTrayectoAduana  setCaImpoexpo()         Sets the current record's "ca_impoexpo" value
 * @method CotTrayectoAduana  setCaTransporte()       Sets the current record's "ca_transporte" value
 * @method CotTrayectoAduana  setCaModalidad()        Sets the current record's "ca_modalidad" value
 * @method CotTrayectoAduana  setCaEstado()           Sets the current record's "ca_estado" value
 * @method CotTrayectoAduana  setCaEtapa()            Sets the current record's "ca_etapa" value
 * @method CotTrayectoAduana  setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method CotTrayectoAduana  setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method CotTrayectoAduana  setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method CotTrayectoAduana  setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * @method CotTrayectoAduana  setCotizacion()         Sets the current record's "Cotizacion" value
 * @method CotTrayectoAduana  setOrigen()             Sets the current record's "Origen" value
 * @method CotTrayectoAduana  setDestino()            Sets the current record's "Destino" value
 * @method CotTrayectoAduana  setCotRecargosAduana()  Sets the current record's "CotRecargosAduana" value
 * @method CotTrayectoAduana  setCotizacion1()        Sets the current record's "Cotizacion1" value
 * @method CotTrayectoAduana  setCotRecargosAduana1() Sets the current record's "CotRecargosAduana1" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotTrayectoAduana extends myDoctrineRecord
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
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_producto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vigencia', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', 12, array(
             'type' => 'string',
             'length' => '12',
             ));
        $this->hasColumn('ca_estado', 'string', 16, array(
             'type' => 'string',
             'length' => '16',
             ));
        $this->hasColumn('ca_etapa', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
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

        $this->hasOne('Ciudad as Origen', array(
             'local' => 'ca_origen',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('Ciudad as Destino', array(
             'local' => 'ca_destino',
             'foreign' => 'ca_idciudad'));

        $this->hasOne('CotRecargosAduana', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasOne('Cotizacion1', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasOne('CotRecargosAduana1', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));
    }
}