<?php

/**
 * BaseFalaHeaderAdu
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_iddoc
 * @property date $ca_fecha_carpeta
 * @property string $ca_archivo_origen
 * @property string $ca_referencia
 * @property string $ca_num_viaje
 * @property string $ca_cod_carrier
 * @property string $ca_codigo_puerto_pickup
 * @property string $ca_codigo_puerto_descarga
 * @property string $ca_container_mode
 * @property string $ca_nombre_proveedor
 * @property string $ca_campo_59
 * @property string $ca_codigo_proveedor
 * @property string $ca_campo_61
 * @property decimal $ca_monto_invoice_miles
 * @property boolean $ca_procesado
 * @property string $ca_trader
 * @property string $ca_vendor_id
 * @property string $ca_vendor_name
 * @property string $ca_vendor_addr1
 * @property string $ca_vendor_city
 * @property string $ca_vendor_country
 * @property date $ca_esd
 * @property date $ca_lsd
 * @property string $ca_incoterms
 * @property string $ca_payment_terms
 * @property string $ca_proforma_number
 * @property string $ca_origin
 * @property string $ca_destination
 * @property string $ca_trans_ship_port
 * @property date $ca_reqd_delivery
 * @property string $ca_orden_comments
 * @property string $ca_manufacturer_contact
 * @property string $ca_manufacturer_phone
 * @property string $ca_manufacturer_fax
 * @property timestamp $ca_fchanulado
 * @property string $ca_usuanulado
 * @property Doctrine_Collection $FalaDetailAdu
 * @property Doctrine_Collection $FalaShipmentInfo
 * @property Doctrine_Collection $FalaInstruction
 * @property FalaDeclaracionImp $FalaDeclaracionImp
 * 
 * @method string              getCaIddoc()                   Returns the current record's "ca_iddoc" value
 * @method date                getCaFechaCarpeta()            Returns the current record's "ca_fecha_carpeta" value
 * @method string              getCaArchivoOrigen()           Returns the current record's "ca_archivo_origen" value
 * @method string              getCaReferencia()              Returns the current record's "ca_referencia" value
 * @method string              getCaNumViaje()                Returns the current record's "ca_num_viaje" value
 * @method string              getCaCodCarrier()              Returns the current record's "ca_cod_carrier" value
 * @method string              getCaCodigoPuertoPickup()      Returns the current record's "ca_codigo_puerto_pickup" value
 * @method string              getCaCodigoPuertoDescarga()    Returns the current record's "ca_codigo_puerto_descarga" value
 * @method string              getCaContainerMode()           Returns the current record's "ca_container_mode" value
 * @method string              getCaNombreProveedor()         Returns the current record's "ca_nombre_proveedor" value
 * @method string              getCaCampo59()                 Returns the current record's "ca_campo_59" value
 * @method string              getCaCodigoProveedor()         Returns the current record's "ca_codigo_proveedor" value
 * @method string              getCaCampo61()                 Returns the current record's "ca_campo_61" value
 * @method decimal             getCaMontoInvoiceMiles()       Returns the current record's "ca_monto_invoice_miles" value
 * @method boolean             getCaProcesado()               Returns the current record's "ca_procesado" value
 * @method string              getCaTrader()                  Returns the current record's "ca_trader" value
 * @method string              getCaVendorId()                Returns the current record's "ca_vendor_id" value
 * @method string              getCaVendorName()              Returns the current record's "ca_vendor_name" value
 * @method string              getCaVendorAddr1()             Returns the current record's "ca_vendor_addr1" value
 * @method string              getCaVendorCity()              Returns the current record's "ca_vendor_city" value
 * @method string              getCaVendorCountry()           Returns the current record's "ca_vendor_country" value
 * @method date                getCaEsd()                     Returns the current record's "ca_esd" value
 * @method date                getCaLsd()                     Returns the current record's "ca_lsd" value
 * @method string              getCaIncoterms()               Returns the current record's "ca_incoterms" value
 * @method string              getCaPaymentTerms()            Returns the current record's "ca_payment_terms" value
 * @method string              getCaProformaNumber()          Returns the current record's "ca_proforma_number" value
 * @method string              getCaOrigin()                  Returns the current record's "ca_origin" value
 * @method string              getCaDestination()             Returns the current record's "ca_destination" value
 * @method string              getCaTransShipPort()           Returns the current record's "ca_trans_ship_port" value
 * @method date                getCaReqdDelivery()            Returns the current record's "ca_reqd_delivery" value
 * @method string              getCaOrdenComments()           Returns the current record's "ca_orden_comments" value
 * @method string              getCaManufacturerContact()     Returns the current record's "ca_manufacturer_contact" value
 * @method string              getCaManufacturerPhone()       Returns the current record's "ca_manufacturer_phone" value
 * @method string              getCaManufacturerFax()         Returns the current record's "ca_manufacturer_fax" value
 * @method timestamp           getCaFchanulado()              Returns the current record's "ca_fchanulado" value
 * @method string              getCaUsuanulado()              Returns the current record's "ca_usuanulado" value
 * @method Doctrine_Collection getFalaDetailAdu()             Returns the current record's "FalaDetailAdu" collection
 * @method Doctrine_Collection getFalaShipmentInfo()          Returns the current record's "FalaShipmentInfo" collection
 * @method Doctrine_Collection getFalaInstruction()           Returns the current record's "FalaInstruction" collection
 * @method FalaDeclaracionImp  getFalaDeclaracionImp()        Returns the current record's "FalaDeclaracionImp" value
 * @method FalaHeaderAdu       setCaIddoc()                   Sets the current record's "ca_iddoc" value
 * @method FalaHeaderAdu       setCaFechaCarpeta()            Sets the current record's "ca_fecha_carpeta" value
 * @method FalaHeaderAdu       setCaArchivoOrigen()           Sets the current record's "ca_archivo_origen" value
 * @method FalaHeaderAdu       setCaReferencia()              Sets the current record's "ca_referencia" value
 * @method FalaHeaderAdu       setCaNumViaje()                Sets the current record's "ca_num_viaje" value
 * @method FalaHeaderAdu       setCaCodCarrier()              Sets the current record's "ca_cod_carrier" value
 * @method FalaHeaderAdu       setCaCodigoPuertoPickup()      Sets the current record's "ca_codigo_puerto_pickup" value
 * @method FalaHeaderAdu       setCaCodigoPuertoDescarga()    Sets the current record's "ca_codigo_puerto_descarga" value
 * @method FalaHeaderAdu       setCaContainerMode()           Sets the current record's "ca_container_mode" value
 * @method FalaHeaderAdu       setCaNombreProveedor()         Sets the current record's "ca_nombre_proveedor" value
 * @method FalaHeaderAdu       setCaCampo59()                 Sets the current record's "ca_campo_59" value
 * @method FalaHeaderAdu       setCaCodigoProveedor()         Sets the current record's "ca_codigo_proveedor" value
 * @method FalaHeaderAdu       setCaCampo61()                 Sets the current record's "ca_campo_61" value
 * @method FalaHeaderAdu       setCaMontoInvoiceMiles()       Sets the current record's "ca_monto_invoice_miles" value
 * @method FalaHeaderAdu       setCaProcesado()               Sets the current record's "ca_procesado" value
 * @method FalaHeaderAdu       setCaTrader()                  Sets the current record's "ca_trader" value
 * @method FalaHeaderAdu       setCaVendorId()                Sets the current record's "ca_vendor_id" value
 * @method FalaHeaderAdu       setCaVendorName()              Sets the current record's "ca_vendor_name" value
 * @method FalaHeaderAdu       setCaVendorAddr1()             Sets the current record's "ca_vendor_addr1" value
 * @method FalaHeaderAdu       setCaVendorCity()              Sets the current record's "ca_vendor_city" value
 * @method FalaHeaderAdu       setCaVendorCountry()           Sets the current record's "ca_vendor_country" value
 * @method FalaHeaderAdu       setCaEsd()                     Sets the current record's "ca_esd" value
 * @method FalaHeaderAdu       setCaLsd()                     Sets the current record's "ca_lsd" value
 * @method FalaHeaderAdu       setCaIncoterms()               Sets the current record's "ca_incoterms" value
 * @method FalaHeaderAdu       setCaPaymentTerms()            Sets the current record's "ca_payment_terms" value
 * @method FalaHeaderAdu       setCaProformaNumber()          Sets the current record's "ca_proforma_number" value
 * @method FalaHeaderAdu       setCaOrigin()                  Sets the current record's "ca_origin" value
 * @method FalaHeaderAdu       setCaDestination()             Sets the current record's "ca_destination" value
 * @method FalaHeaderAdu       setCaTransShipPort()           Sets the current record's "ca_trans_ship_port" value
 * @method FalaHeaderAdu       setCaReqdDelivery()            Sets the current record's "ca_reqd_delivery" value
 * @method FalaHeaderAdu       setCaOrdenComments()           Sets the current record's "ca_orden_comments" value
 * @method FalaHeaderAdu       setCaManufacturerContact()     Sets the current record's "ca_manufacturer_contact" value
 * @method FalaHeaderAdu       setCaManufacturerPhone()       Sets the current record's "ca_manufacturer_phone" value
 * @method FalaHeaderAdu       setCaManufacturerFax()         Sets the current record's "ca_manufacturer_fax" value
 * @method FalaHeaderAdu       setCaFchanulado()              Sets the current record's "ca_fchanulado" value
 * @method FalaHeaderAdu       setCaUsuanulado()              Sets the current record's "ca_usuanulado" value
 * @method FalaHeaderAdu       setFalaDetailAdu()             Sets the current record's "FalaDetailAdu" collection
 * @method FalaHeaderAdu       setFalaShipmentInfo()          Sets the current record's "FalaShipmentInfo" collection
 * @method FalaHeaderAdu       setFalaInstruction()           Sets the current record's "FalaInstruction" collection
 * @method FalaHeaderAdu       setFalaDeclaracionImp()        Sets the current record's "FalaDeclaracionImp" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaHeaderAdu extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_falaheader_adu');
        $this->hasColumn('ca_iddoc', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_fecha_carpeta', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_archivo_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_num_viaje', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cod_carrier', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_codigo_puerto_pickup', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_codigo_puerto_descarga', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_container_mode', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_nombre_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_campo_59', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_codigo_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_campo_61', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_monto_invoice_miles', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_procesado', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_trader', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendor_id', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendor_name', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendor_addr1', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendor_city', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendor_country', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_esd', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_lsd', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_incoterms', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_payment_terms', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_proforma_number', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_origin', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destination', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_trans_ship_port', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_reqd_delivery', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_orden_comments', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_manufacturer_contact', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_manufacturer_phone', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_manufacturer_fax', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', null, array(
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
        $this->hasMany('FalaDetailAdu', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc',
             'orderBy' => 'ca_sku ASC'));

        $this->hasMany('FalaShipmentInfo', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));

        $this->hasMany('FalaInstruction', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));

        $this->hasOne('FalaDeclaracionImp', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}