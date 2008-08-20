<?php

/**
 * Base static class for performing query and update operations on the 'tb_falaheader' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaHeaderPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_falaheader';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.falabella.FalaHeader';

	/** The total number of columns. */
	const NUM_COLUMNS = 36;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDDOC field */
	const CA_IDDOC = 'tb_falaheader.CA_IDDOC';

	/** the column name for the CA_FECHA_CARPETA field */
	const CA_FECHA_CARPETA = 'tb_falaheader.CA_FECHA_CARPETA';

	/** the column name for the CA_ARCHIVO_ORIGEN field */
	const CA_ARCHIVO_ORIGEN = 'tb_falaheader.CA_ARCHIVO_ORIGEN';

	/** the column name for the CA_REPORTE field */
	const CA_REPORTE = 'tb_falaheader.CA_REPORTE';

	/** the column name for the CA_NUM_VIAJE field */
	const CA_NUM_VIAJE = 'tb_falaheader.CA_NUM_VIAJE';

	/** the column name for the CA_COD_CARRIER field */
	const CA_COD_CARRIER = 'tb_falaheader.CA_COD_CARRIER';

	/** the column name for the CA_CODIGO_PUERTO_PICKUP field */
	const CA_CODIGO_PUERTO_PICKUP = 'tb_falaheader.CA_CODIGO_PUERTO_PICKUP';

	/** the column name for the CA_CODIGO_PUERTO_DESCARGA field */
	const CA_CODIGO_PUERTO_DESCARGA = 'tb_falaheader.CA_CODIGO_PUERTO_DESCARGA';

	/** the column name for the CA_CONTAINER_MODE field */
	const CA_CONTAINER_MODE = 'tb_falaheader.CA_CONTAINER_MODE';

	/** the column name for the CA_NOMBRE_PROVEEDOR field */
	const CA_NOMBRE_PROVEEDOR = 'tb_falaheader.CA_NOMBRE_PROVEEDOR';

	/** the column name for the CA_CAMPO_59 field */
	const CA_CAMPO_59 = 'tb_falaheader.CA_CAMPO_59';

	/** the column name for the CA_CODIGO_PROVEEDOR field */
	const CA_CODIGO_PROVEEDOR = 'tb_falaheader.CA_CODIGO_PROVEEDOR';

	/** the column name for the CA_CAMPO_61 field */
	const CA_CAMPO_61 = 'tb_falaheader.CA_CAMPO_61';

	/** the column name for the CA_MONTO_INVOICE_MILES field */
	const CA_MONTO_INVOICE_MILES = 'tb_falaheader.CA_MONTO_INVOICE_MILES';

	/** the column name for the CA_PROCESADO field */
	const CA_PROCESADO = 'tb_falaheader.CA_PROCESADO';

	/** the column name for the CA_TRADER field */
	const CA_TRADER = 'tb_falaheader.CA_TRADER';

	/** the column name for the CA_VENDOR_ID field */
	const CA_VENDOR_ID = 'tb_falaheader.CA_VENDOR_ID';

	/** the column name for the CA_VENDOR_NAME field */
	const CA_VENDOR_NAME = 'tb_falaheader.CA_VENDOR_NAME';

	/** the column name for the CA_VENDOR_ADDR1 field */
	const CA_VENDOR_ADDR1 = 'tb_falaheader.CA_VENDOR_ADDR1';

	/** the column name for the CA_VENDOR_CITY field */
	const CA_VENDOR_CITY = 'tb_falaheader.CA_VENDOR_CITY';

	/** the column name for the CA_VENDOR_COUNTRY field */
	const CA_VENDOR_COUNTRY = 'tb_falaheader.CA_VENDOR_COUNTRY';

	/** the column name for the CA_ESD field */
	const CA_ESD = 'tb_falaheader.CA_ESD';

	/** the column name for the CA_LSD field */
	const CA_LSD = 'tb_falaheader.CA_LSD';

	/** the column name for the CA_INCOTERMS field */
	const CA_INCOTERMS = 'tb_falaheader.CA_INCOTERMS';

	/** the column name for the CA_PAYMENT_TERMS field */
	const CA_PAYMENT_TERMS = 'tb_falaheader.CA_PAYMENT_TERMS';

	/** the column name for the CA_PROFORMA_NUMBER field */
	const CA_PROFORMA_NUMBER = 'tb_falaheader.CA_PROFORMA_NUMBER';

	/** the column name for the CA_ORIGIN field */
	const CA_ORIGIN = 'tb_falaheader.CA_ORIGIN';

	/** the column name for the CA_DESTINATION field */
	const CA_DESTINATION = 'tb_falaheader.CA_DESTINATION';

	/** the column name for the CA_TRANS_SHIP_PORT field */
	const CA_TRANS_SHIP_PORT = 'tb_falaheader.CA_TRANS_SHIP_PORT';

	/** the column name for the CA_REQD_DELIVERY field */
	const CA_REQD_DELIVERY = 'tb_falaheader.CA_REQD_DELIVERY';

	/** the column name for the CA_ORDEN_COMMENTS field */
	const CA_ORDEN_COMMENTS = 'tb_falaheader.CA_ORDEN_COMMENTS';

	/** the column name for the CA_MANUFACTURER_CONTACT field */
	const CA_MANUFACTURER_CONTACT = 'tb_falaheader.CA_MANUFACTURER_CONTACT';

	/** the column name for the CA_MANUFACTURER_PHONE field */
	const CA_MANUFACTURER_PHONE = 'tb_falaheader.CA_MANUFACTURER_PHONE';

	/** the column name for the CA_MANUFACTURER_FAX field */
	const CA_MANUFACTURER_FAX = 'tb_falaheader.CA_MANUFACTURER_FAX';

	/** the column name for the CA_FCHANULADO field */
	const CA_FCHANULADO = 'tb_falaheader.CA_FCHANULADO';

	/** the column name for the CA_USUANULADO field */
	const CA_USUANULADO = 'tb_falaheader.CA_USUANULADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaFechaCarpeta', 'CaArchivoOrigen', 'CaReporte', 'CaNumViaje', 'CaCodCarrier', 'CaCodigoPuertoPickup', 'CaCodigoPuertoDescarga', 'CaContainerMode', 'CaNombreProveedor', 'CaCampo59', 'CaCodigoProveedor', 'CaCampo61', 'CaMontoInvoiceMiles', 'CaProcesado', 'CaTrader', 'CaVendorId', 'CaVendorName', 'CaVendorAddr1', 'CaVendorCity', 'CaVendorCountry', 'CaEsd', 'CaLsd', 'CaIncoterms', 'CaPaymentTerms', 'CaProformaNumber', 'CaOrigin', 'CaDestination', 'CaTransShipPort', 'CaReqdDelivery', 'CaOrdenComments', 'CaManufacturerContact', 'CaManufacturerPhone', 'CaManufacturerFax', 'CaFchanulado', 'CaUsuanulado', ),
		BasePeer::TYPE_COLNAME => array (FalaHeaderPeer::CA_IDDOC, FalaHeaderPeer::CA_FECHA_CARPETA, FalaHeaderPeer::CA_ARCHIVO_ORIGEN, FalaHeaderPeer::CA_REPORTE, FalaHeaderPeer::CA_NUM_VIAJE, FalaHeaderPeer::CA_COD_CARRIER, FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP, FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA, FalaHeaderPeer::CA_CONTAINER_MODE, FalaHeaderPeer::CA_NOMBRE_PROVEEDOR, FalaHeaderPeer::CA_CAMPO_59, FalaHeaderPeer::CA_CODIGO_PROVEEDOR, FalaHeaderPeer::CA_CAMPO_61, FalaHeaderPeer::CA_MONTO_INVOICE_MILES, FalaHeaderPeer::CA_PROCESADO, FalaHeaderPeer::CA_TRADER, FalaHeaderPeer::CA_VENDOR_ID, FalaHeaderPeer::CA_VENDOR_NAME, FalaHeaderPeer::CA_VENDOR_ADDR1, FalaHeaderPeer::CA_VENDOR_CITY, FalaHeaderPeer::CA_VENDOR_COUNTRY, FalaHeaderPeer::CA_ESD, FalaHeaderPeer::CA_LSD, FalaHeaderPeer::CA_INCOTERMS, FalaHeaderPeer::CA_PAYMENT_TERMS, FalaHeaderPeer::CA_PROFORMA_NUMBER, FalaHeaderPeer::CA_ORIGIN, FalaHeaderPeer::CA_DESTINATION, FalaHeaderPeer::CA_TRANS_SHIP_PORT, FalaHeaderPeer::CA_REQD_DELIVERY, FalaHeaderPeer::CA_ORDEN_COMMENTS, FalaHeaderPeer::CA_MANUFACTURER_CONTACT, FalaHeaderPeer::CA_MANUFACTURER_PHONE, FalaHeaderPeer::CA_MANUFACTURER_FAX, FalaHeaderPeer::CA_FCHANULADO, FalaHeaderPeer::CA_USUANULADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_fecha_carpeta', 'ca_archivo_origen', 'ca_reporte', 'ca_num_viaje', 'ca_cod_carrier', 'ca_codigo_puerto_pickup', 'ca_codigo_puerto_descarga', 'ca_container_mode', 'ca_nombre_proveedor', 'ca_campo_59', 'ca_codigo_proveedor', 'ca_campo_61', 'ca_monto_invoice_miles', 'ca_procesado', 'ca_trader', 'ca_vendor_id', 'ca_vendor_name', 'ca_vendor_addr1', 'ca_vendor_city', 'ca_vendor_country', 'ca_esd', 'ca_lsd', 'ca_incoterms', 'ca_payment_terms', 'ca_proforma_number', 'ca_origin', 'ca_destination', 'ca_trans_ship_port', 'ca_reqd_delivery', 'ca_orden_comments', 'ca_manufacturer_contact', 'ca_manufacturer_phone', 'ca_manufacturer_fax', 'ca_fchanulado', 'ca_usuanulado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaFechaCarpeta' => 1, 'CaArchivoOrigen' => 2, 'CaReporte' => 3, 'CaNumViaje' => 4, 'CaCodCarrier' => 5, 'CaCodigoPuertoPickup' => 6, 'CaCodigoPuertoDescarga' => 7, 'CaContainerMode' => 8, 'CaNombreProveedor' => 9, 'CaCampo59' => 10, 'CaCodigoProveedor' => 11, 'CaCampo61' => 12, 'CaMontoInvoiceMiles' => 13, 'CaProcesado' => 14, 'CaTrader' => 15, 'CaVendorId' => 16, 'CaVendorName' => 17, 'CaVendorAddr1' => 18, 'CaVendorCity' => 19, 'CaVendorCountry' => 20, 'CaEsd' => 21, 'CaLsd' => 22, 'CaIncoterms' => 23, 'CaPaymentTerms' => 24, 'CaProformaNumber' => 25, 'CaOrigin' => 26, 'CaDestination' => 27, 'CaTransShipPort' => 28, 'CaReqdDelivery' => 29, 'CaOrdenComments' => 30, 'CaManufacturerContact' => 31, 'CaManufacturerPhone' => 32, 'CaManufacturerFax' => 33, 'CaFchanulado' => 34, 'CaUsuanulado' => 35, ),
		BasePeer::TYPE_COLNAME => array (FalaHeaderPeer::CA_IDDOC => 0, FalaHeaderPeer::CA_FECHA_CARPETA => 1, FalaHeaderPeer::CA_ARCHIVO_ORIGEN => 2, FalaHeaderPeer::CA_REPORTE => 3, FalaHeaderPeer::CA_NUM_VIAJE => 4, FalaHeaderPeer::CA_COD_CARRIER => 5, FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP => 6, FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA => 7, FalaHeaderPeer::CA_CONTAINER_MODE => 8, FalaHeaderPeer::CA_NOMBRE_PROVEEDOR => 9, FalaHeaderPeer::CA_CAMPO_59 => 10, FalaHeaderPeer::CA_CODIGO_PROVEEDOR => 11, FalaHeaderPeer::CA_CAMPO_61 => 12, FalaHeaderPeer::CA_MONTO_INVOICE_MILES => 13, FalaHeaderPeer::CA_PROCESADO => 14, FalaHeaderPeer::CA_TRADER => 15, FalaHeaderPeer::CA_VENDOR_ID => 16, FalaHeaderPeer::CA_VENDOR_NAME => 17, FalaHeaderPeer::CA_VENDOR_ADDR1 => 18, FalaHeaderPeer::CA_VENDOR_CITY => 19, FalaHeaderPeer::CA_VENDOR_COUNTRY => 20, FalaHeaderPeer::CA_ESD => 21, FalaHeaderPeer::CA_LSD => 22, FalaHeaderPeer::CA_INCOTERMS => 23, FalaHeaderPeer::CA_PAYMENT_TERMS => 24, FalaHeaderPeer::CA_PROFORMA_NUMBER => 25, FalaHeaderPeer::CA_ORIGIN => 26, FalaHeaderPeer::CA_DESTINATION => 27, FalaHeaderPeer::CA_TRANS_SHIP_PORT => 28, FalaHeaderPeer::CA_REQD_DELIVERY => 29, FalaHeaderPeer::CA_ORDEN_COMMENTS => 30, FalaHeaderPeer::CA_MANUFACTURER_CONTACT => 31, FalaHeaderPeer::CA_MANUFACTURER_PHONE => 32, FalaHeaderPeer::CA_MANUFACTURER_FAX => 33, FalaHeaderPeer::CA_FCHANULADO => 34, FalaHeaderPeer::CA_USUANULADO => 35, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_fecha_carpeta' => 1, 'ca_archivo_origen' => 2, 'ca_reporte' => 3, 'ca_num_viaje' => 4, 'ca_cod_carrier' => 5, 'ca_codigo_puerto_pickup' => 6, 'ca_codigo_puerto_descarga' => 7, 'ca_container_mode' => 8, 'ca_nombre_proveedor' => 9, 'ca_campo_59' => 10, 'ca_codigo_proveedor' => 11, 'ca_campo_61' => 12, 'ca_monto_invoice_miles' => 13, 'ca_procesado' => 14, 'ca_trader' => 15, 'ca_vendor_id' => 16, 'ca_vendor_name' => 17, 'ca_vendor_addr1' => 18, 'ca_vendor_city' => 19, 'ca_vendor_country' => 20, 'ca_esd' => 21, 'ca_lsd' => 22, 'ca_incoterms' => 23, 'ca_payment_terms' => 24, 'ca_proforma_number' => 25, 'ca_origin' => 26, 'ca_destination' => 27, 'ca_trans_ship_port' => 28, 'ca_reqd_delivery' => 29, 'ca_orden_comments' => 30, 'ca_manufacturer_contact' => 31, 'ca_manufacturer_phone' => 32, 'ca_manufacturer_fax' => 33, 'ca_fchanulado' => 34, 'ca_usuanulado' => 35, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.falabella.map.FalaHeaderMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FalaHeaderPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. FalaHeaderPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FalaHeaderPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaHeaderPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_FECHA_CARPETA);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_ARCHIVO_ORIGEN);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_REPORTE);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_NUM_VIAJE);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_COD_CARRIER);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CONTAINER_MODE);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_NOMBRE_PROVEEDOR);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CAMPO_59);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CODIGO_PROVEEDOR);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_CAMPO_61);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_MONTO_INVOICE_MILES);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_PROCESADO);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_TRADER);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_VENDOR_ID);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_VENDOR_NAME);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_VENDOR_ADDR1);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_VENDOR_CITY);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_VENDOR_COUNTRY);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_ESD);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_LSD);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_PAYMENT_TERMS);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_PROFORMA_NUMBER);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_ORIGIN);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_DESTINATION);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_TRANS_SHIP_PORT);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_REQD_DELIVERY);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_ORDEN_COMMENTS);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_MANUFACTURER_CONTACT);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_MANUFACTURER_PHONE);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_MANUFACTURER_FAX);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_FCHANULADO);

		$criteria->addSelectColumn(FalaHeaderPeer::CA_USUANULADO);

	}

	const COUNT = 'COUNT(tb_falaheader.CA_IDDOC)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_falaheader.CA_IDDOC)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FalaHeaderPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FalaHeaderPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FalaHeaderPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     FalaHeader
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FalaHeaderPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FalaHeaderPeer::populateObjects(FalaHeaderPeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FalaHeaderPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = FalaHeaderPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return FalaHeaderPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a FalaHeader or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaHeader object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from FalaHeader object
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a FalaHeader or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaHeader object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(FalaHeaderPeer::CA_IDDOC);
			$selectCriteria->add(FalaHeaderPeer::CA_IDDOC, $criteria->remove(FalaHeaderPeer::CA_IDDOC), $comparison);

		} else { // $values is FalaHeader object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_falaheader table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(FalaHeaderPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FalaHeader or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FalaHeader object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof FalaHeader) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaHeaderPeer::CA_IDDOC, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given FalaHeader object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      FalaHeader $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(FalaHeader $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaHeaderPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaHeaderPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(FalaHeaderPeer::DATABASE_NAME, FalaHeaderPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaHeaderPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     FalaHeader
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);

		$criteria->add(FalaHeaderPeer::CA_IDDOC, $pk);


		$v = FalaHeaderPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(FalaHeaderPeer::CA_IDDOC, $pks, Criteria::IN);
			$objs = FalaHeaderPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseFalaHeaderPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseFalaHeaderPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.falabella.map.FalaHeaderMapBuilder');
}
