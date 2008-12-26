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
class FalaHeaderMapBuilder implements MapBuilder {

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
		$this->dbMap = Propel::getDatabaseMap(FalaHeaderPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FalaHeaderPeer::TABLE_NAME);
		$tMap->setPhpName('FalaHeader');
		$tMap->setClassname('FalaHeader');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('CA_IDDOC', 'CaIddoc', 'VARCHAR', true, null);

		$tMap->addColumn('CA_FECHA_CARPETA', 'CaFechaCarpeta', 'DATE', false, null);

		$tMap->addColumn('CA_ARCHIVO_ORIGEN', 'CaArchivoOrigen', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REPORTE', 'CaReporte', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NUM_VIAJE', 'CaNumViaje', 'VARCHAR', false, null);

		$tMap->addColumn('CA_COD_CARRIER', 'CaCodCarrier', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CODIGO_PUERTO_PICKUP', 'CaCodigoPuertoPickup', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CODIGO_PUERTO_DESCARGA', 'CaCodigoPuertoDescarga', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CONTAINER_MODE', 'CaContainerMode', 'VARCHAR', false, null);

		$tMap->addColumn('CA_NOMBRE_PROVEEDOR', 'CaNombreProveedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CAMPO_59', 'CaCampo59', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CODIGO_PROVEEDOR', 'CaCodigoProveedor', 'VARCHAR', false, null);

		$tMap->addColumn('CA_CAMPO_61', 'CaCampo61', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MONTO_INVOICE_MILES', 'CaMontoInvoiceMiles', 'NUMERIC', false, null);

		$tMap->addColumn('CA_PROCESADO', 'CaProcesado', 'BOOLEAN', false, null);

		$tMap->addColumn('CA_TRADER', 'CaTrader', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDOR_ID', 'CaVendorId', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDOR_NAME', 'CaVendorName', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDOR_ADDR1', 'CaVendorAddr1', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDOR_CITY', 'CaVendorCity', 'VARCHAR', false, null);

		$tMap->addColumn('CA_VENDOR_COUNTRY', 'CaVendorCountry', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ESD', 'CaEsd', 'DATE', false, null);

		$tMap->addColumn('CA_LSD', 'CaLsd', 'DATE', false, null);

		$tMap->addColumn('CA_INCOTERMS', 'CaIncoterms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PAYMENT_TERMS', 'CaPaymentTerms', 'VARCHAR', false, null);

		$tMap->addColumn('CA_PROFORMA_NUMBER', 'CaProformaNumber', 'VARCHAR', false, null);

		$tMap->addColumn('CA_ORIGIN', 'CaOrigin', 'VARCHAR', false, null);

		$tMap->addColumn('CA_DESTINATION', 'CaDestination', 'VARCHAR', false, null);

		$tMap->addColumn('CA_TRANS_SHIP_PORT', 'CaTransShipPort', 'VARCHAR', false, null);

		$tMap->addColumn('CA_REQD_DELIVERY', 'CaReqdDelivery', 'DATE', false, null);

		$tMap->addColumn('CA_ORDEN_COMMENTS', 'CaOrdenComments', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MANUFACTURER_CONTACT', 'CaManufacturerContact', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MANUFACTURER_PHONE', 'CaManufacturerPhone', 'VARCHAR', false, null);

		$tMap->addColumn('CA_MANUFACTURER_FAX', 'CaManufacturerFax', 'VARCHAR', false, null);

		$tMap->addColumn('CA_FCHANULADO', 'CaFchanulado', 'TIMESTAMP', false, null);

		$tMap->addColumn('CA_USUANULADO', 'CaUsuanulado', 'VARCHAR', false, null);

	} // doBuild()

} // FalaHeaderMapBuilder
