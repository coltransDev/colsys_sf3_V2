<?php


/**
 * This class adds structure of 'tb_falaheader' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.falabella.map
 */
class FalaHeaderMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.falabella.map.FalaHeaderMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('tb_falaheader');
		$tMap->setPhpName('FalaHeader');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDDOC', 'CaIddoc', 'string', CreoleTypes::VARCHAR, true, null);

		$tMap->addColumn('CA_FECHA_CARPETA', 'CaFechaCarpeta', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_ARCHIVO_ORIGEN', 'CaArchivoOrigen', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_REPORTE', 'CaReporte', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NUM_VIAJE', 'CaNumViaje', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_COD_CARRIER', 'CaCodCarrier', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CODIGO_PUERTO_PICKUP', 'CaCodigoPuertoPickup', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CODIGO_PUERTO_DESCARGA', 'CaCodigoPuertoDescarga', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CONTAINER_MODE', 'CaContainerMode', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_NOMBRE_PROVEEDOR', 'CaNombreProveedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CAMPO_59', 'CaCampo59', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CODIGO_PROVEEDOR', 'CaCodigoProveedor', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_CAMPO_61', 'CaCampo61', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MONTO_INVOICE_MILES', 'CaMontoInvoiceMiles', 'double', CreoleTypes::NUMERIC, false, null);

		$tMap->addColumn('CA_PROCESADO', 'CaProcesado', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('CA_TRADER', 'CaTrader', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDOR_ID', 'CaVendorId', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDOR_NAME', 'CaVendorName', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDOR_ADDR1', 'CaVendorAddr1', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDOR_CITY', 'CaVendorCity', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_VENDOR_COUNTRY', 'CaVendorCountry', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ESD', 'CaEsd', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_LSD', 'CaLsd', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PAYMENT_TERMS', 'CaPaymentTerms', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_PROFORMA_NUMBER', 'CaProformaNumber', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_ORIGIN', 'CaOrigin', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_DESTINATION', 'CaDestination', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_TRANS_SHIP_PORT', 'CaTransShipPort', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_REQD_DELIVERY', 'CaReqdDelivery', 'int', CreoleTypes::DATE, false, null);

		$tMap->addColumn('CA_ORDEN_COMMENTS', 'CaOrdenComments', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MANUFACTURER_CONTACT', 'CaManufacturerContact', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MANUFACTURER_PHONE', 'CaManufacturerPhone', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_MANUFACTURER_FAX', 'CaManufacturerFax', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'string', CreoleTypes::VARCHAR, false, null);

	} // doBuild()

} // FalaHeaderMapBuilder
