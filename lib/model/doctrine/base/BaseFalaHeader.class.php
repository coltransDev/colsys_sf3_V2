<?php

/**
 * BaseFalaHeader
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_iddoc
 * @property date $ca_fecha_carpeta
 * @property string $ca_archivo_origen
 * @property string $ca_reporte
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
 * @property Doctrine_Collection $FalaDetail
 * @property Doctrine_Collection $FalaShipmentInfo
 * @property Doctrine_Collection $FalaInstruction
 * @property Doctrine_Collection $FalaShipmentInfoAdu
 * @property Doctrine_Collection $FalaInstructionAdu
 * 
 * @method string              getCaIddoc()                   Returns the current record's "ca_iddoc" value
 * @method date                getCaFechaCarpeta()            Returns the current record's "ca_fecha_carpeta" value
 * @method string              getCaArchivoOrigen()           Returns the current record's "ca_archivo_origen" value
 * @method string              getCaReporte()                 Returns the current record's "ca_reporte" value
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
 * @method Doctrine_Collection getFalaDetail()                Returns the current record's "FalaDetail" collection
 * @method Doctrine_Collection getFalaShipmentInfo()          Returns the current record's "FalaShipmentInfo" collection
 * @method Doctrine_Collection getFalaInstruction()           Returns the current record's "FalaInstruction" collection
 * @method Doctrine_Collection getFalaShipmentInfoAdu()       Returns the current record's "FalaShipmentInfoAdu" collection
 * @method Doctrine_Collection getFalaInstructionAdu()        Returns the current record's "FalaInstructionAdu" collection
 * @method FalaHeader          setCaIddoc()                   Sets the current record's "ca_iddoc" value
 * @method FalaHeader          setCaFechaCarpeta()            Sets the current record's "ca_fecha_carpeta" value
 * @method FalaHeader          setCaArchivoOrigen()           Sets the current record's "ca_archivo_origen" value
 * @method FalaHeader          setCaReporte()                 Sets the current record's "ca_reporte" value
 * @method FalaHeader          setCaNumViaje()                Sets the current record's "ca_num_viaje" value
 * @method FalaHeader          setCaCodCarrier()              Sets the current record's "ca_cod_carrier" value
 * @method FalaHeader          setCaCodigoPuertoPickup()      Sets the current record's "ca_codigo_puerto_pickup" value
 * @method FalaHeader          setCaCodigoPuertoDescarga()    Sets the current record's "ca_codigo_puerto_descarga" value
 * @method FalaHeader          setCaContainerMode()           Sets the current record's "ca_container_mode" value
 * @method FalaHeader          setCaNombreProveedor()         Sets the current record's "ca_nombre_proveedor" value
 * @method FalaHeader          setCaCampo59()                 Sets the current record's "ca_campo_59" value
 * @method FalaHeader          setCaCodigoProveedor()         Sets the current record's "ca_codigo_proveedor" value
 * @method FalaHeader          setCaCampo61()                 Sets the current record's "ca_campo_61" value
 * @method FalaHeader          setCaMontoInvoiceMiles()       Sets the current record's "ca_monto_invoice_miles" value
 * @method FalaHeader          setCaProcesado()               Sets the current record's "ca_procesado" value
 * @method FalaHeader          setCaTrader()                  Sets the current record's "ca_trader" value
 * @method FalaHeader          setCaVendorId()                Sets the current record's "ca_vendor_id" value
 * @method FalaHeader          setCaVendorName()              Sets the current record's "ca_vendor_name" value
 * @method FalaHeader          setCaVendorAddr1()             Sets the current record's "ca_vendor_addr1" value
 * @method FalaHeader          setCaVendorCity()              Sets the current record's "ca_vendor_city" value
 * @method FalaHeader          setCaVendorCountry()           Sets the current record's "ca_vendor_country" value
 * @method FalaHeader          setCaEsd()                     Sets the current record's "ca_esd" value
 * @method FalaHeader          setCaLsd()                     Sets the current record's "ca_lsd" value
 * @method FalaHeader          setCaIncoterms()               Sets the current record's "ca_incoterms" value
 * @method FalaHeader          setCaPaymentTerms()            Sets the current record's "ca_payment_terms" value
 * @method FalaHeader          setCaProformaNumber()          Sets the current record's "ca_proforma_number" value
 * @method FalaHeader          setCaOrigin()                  Sets the current record's "ca_origin" value
 * @method FalaHeader          setCaDestination()             Sets the current record's "ca_destination" value
 * @method FalaHeader          setCaTransShipPort()           Sets the current record's "ca_trans_ship_port" value
 * @method FalaHeader          setCaReqdDelivery()            Sets the current record's "ca_reqd_delivery" value
 * @method FalaHeader          setCaOrdenComments()           Sets the current record's "ca_orden_comments" value
 * @method FalaHeader          setCaManufacturerContact()     Sets the current record's "ca_manufacturer_contact" value
 * @method FalaHeader          setCaManufacturerPhone()       Sets the current record's "ca_manufacturer_phone" value
 * @method FalaHeader          setCaManufacturerFax()         Sets the current record's "ca_manufacturer_fax" value
 * @method FalaHeader          setCaFchanulado()              Sets the current record's "ca_fchanulado" value
 * @method FalaHeader          setCaUsuanulado()              Sets the current record's "ca_usuanulado" value
 * @method FalaHeader          setFalaDetail()                Sets the current record's "FalaDetail" collection
 * @method FalaHeader          setFalaShipmentInfo()          Sets the current record's "FalaShipmentInfo" collection
 * @method FalaHeader          setFalaInstruction()           Sets the current record's "FalaInstruction" collection
 * @method FalaHeader          setFalaShipmentInfoAdu()       Sets the current record's "FalaShipmentInfoAdu" collection
 * @method FalaHeader          setFalaInstructionAdu()        Sets the current record's "FalaInstructionAdu" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaHeader extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_falaheader');
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
        $this->hasColumn('ca_reporte', 'string', null, array(
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
        $this->hasMany('FalaDetail', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc',
             'orderBy' => 'ca_sku ASC'));

        $this->hasMany('FalaShipmentInfo', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));

        $this->hasMany('FalaInstruction', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));

        $this->hasMany('FalaShipmentInfoAdu', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));

        $this->hasMany('FalaInstructionAdu', array(
             'local' => 'ca_iddoc',
             'foreign' => 'ca_iddoc'));
    }
}