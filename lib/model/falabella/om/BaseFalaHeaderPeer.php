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

	/**
	 * An identiy map to hold any loaded instances of FalaHeader objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array FalaHeader[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaFechaCarpeta', 'CaArchivoOrigen', 'CaReporte', 'CaNumViaje', 'CaCodCarrier', 'CaCodigoPuertoPickup', 'CaCodigoPuertoDescarga', 'CaContainerMode', 'CaNombreProveedor', 'CaCampo59', 'CaCodigoProveedor', 'CaCampo61', 'CaMontoInvoiceMiles', 'CaProcesado', 'CaTrader', 'CaVendorId', 'CaVendorName', 'CaVendorAddr1', 'CaVendorCity', 'CaVendorCountry', 'CaEsd', 'CaLsd', 'CaIncoterms', 'CaPaymentTerms', 'CaProformaNumber', 'CaOrigin', 'CaDestination', 'CaTransShipPort', 'CaReqdDelivery', 'CaOrdenComments', 'CaManufacturerContact', 'CaManufacturerPhone', 'CaManufacturerFax', 'CaFchanulado', 'CaUsuanulado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caFechaCarpeta', 'caArchivoOrigen', 'caReporte', 'caNumViaje', 'caCodCarrier', 'caCodigoPuertoPickup', 'caCodigoPuertoDescarga', 'caContainerMode', 'caNombreProveedor', 'caCampo59', 'caCodigoProveedor', 'caCampo61', 'caMontoInvoiceMiles', 'caProcesado', 'caTrader', 'caVendorId', 'caVendorName', 'caVendorAddr1', 'caVendorCity', 'caVendorCountry', 'caEsd', 'caLsd', 'caIncoterms', 'caPaymentTerms', 'caProformaNumber', 'caOrigin', 'caDestination', 'caTransShipPort', 'caReqdDelivery', 'caOrdenComments', 'caManufacturerContact', 'caManufacturerPhone', 'caManufacturerFax', 'caFchanulado', 'caUsuanulado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_FECHA_CARPETA, self::CA_ARCHIVO_ORIGEN, self::CA_REPORTE, self::CA_NUM_VIAJE, self::CA_COD_CARRIER, self::CA_CODIGO_PUERTO_PICKUP, self::CA_CODIGO_PUERTO_DESCARGA, self::CA_CONTAINER_MODE, self::CA_NOMBRE_PROVEEDOR, self::CA_CAMPO_59, self::CA_CODIGO_PROVEEDOR, self::CA_CAMPO_61, self::CA_MONTO_INVOICE_MILES, self::CA_PROCESADO, self::CA_TRADER, self::CA_VENDOR_ID, self::CA_VENDOR_NAME, self::CA_VENDOR_ADDR1, self::CA_VENDOR_CITY, self::CA_VENDOR_COUNTRY, self::CA_ESD, self::CA_LSD, self::CA_INCOTERMS, self::CA_PAYMENT_TERMS, self::CA_PROFORMA_NUMBER, self::CA_ORIGIN, self::CA_DESTINATION, self::CA_TRANS_SHIP_PORT, self::CA_REQD_DELIVERY, self::CA_ORDEN_COMMENTS, self::CA_MANUFACTURER_CONTACT, self::CA_MANUFACTURER_PHONE, self::CA_MANUFACTURER_FAX, self::CA_FCHANULADO, self::CA_USUANULADO, ),
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
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caFechaCarpeta' => 1, 'caArchivoOrigen' => 2, 'caReporte' => 3, 'caNumViaje' => 4, 'caCodCarrier' => 5, 'caCodigoPuertoPickup' => 6, 'caCodigoPuertoDescarga' => 7, 'caContainerMode' => 8, 'caNombreProveedor' => 9, 'caCampo59' => 10, 'caCodigoProveedor' => 11, 'caCampo61' => 12, 'caMontoInvoiceMiles' => 13, 'caProcesado' => 14, 'caTrader' => 15, 'caVendorId' => 16, 'caVendorName' => 17, 'caVendorAddr1' => 18, 'caVendorCity' => 19, 'caVendorCountry' => 20, 'caEsd' => 21, 'caLsd' => 22, 'caIncoterms' => 23, 'caPaymentTerms' => 24, 'caProformaNumber' => 25, 'caOrigin' => 26, 'caDestination' => 27, 'caTransShipPort' => 28, 'caReqdDelivery' => 29, 'caOrdenComments' => 30, 'caManufacturerContact' => 31, 'caManufacturerPhone' => 32, 'caManufacturerFax' => 33, 'caFchanulado' => 34, 'caUsuanulado' => 35, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_FECHA_CARPETA => 1, self::CA_ARCHIVO_ORIGEN => 2, self::CA_REPORTE => 3, self::CA_NUM_VIAJE => 4, self::CA_COD_CARRIER => 5, self::CA_CODIGO_PUERTO_PICKUP => 6, self::CA_CODIGO_PUERTO_DESCARGA => 7, self::CA_CONTAINER_MODE => 8, self::CA_NOMBRE_PROVEEDOR => 9, self::CA_CAMPO_59 => 10, self::CA_CODIGO_PROVEEDOR => 11, self::CA_CAMPO_61 => 12, self::CA_MONTO_INVOICE_MILES => 13, self::CA_PROCESADO => 14, self::CA_TRADER => 15, self::CA_VENDOR_ID => 16, self::CA_VENDOR_NAME => 17, self::CA_VENDOR_ADDR1 => 18, self::CA_VENDOR_CITY => 19, self::CA_VENDOR_COUNTRY => 20, self::CA_ESD => 21, self::CA_LSD => 22, self::CA_INCOTERMS => 23, self::CA_PAYMENT_TERMS => 24, self::CA_PROFORMA_NUMBER => 25, self::CA_ORIGIN => 26, self::CA_DESTINATION => 27, self::CA_TRANS_SHIP_PORT => 28, self::CA_REQD_DELIVERY => 29, self::CA_ORDEN_COMMENTS => 30, self::CA_MANUFACTURER_CONTACT => 31, self::CA_MANUFACTURER_PHONE => 32, self::CA_MANUFACTURER_FAX => 33, self::CA_FCHANULADO => 34, self::CA_USUANULADO => 35, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_fecha_carpeta' => 1, 'ca_archivo_origen' => 2, 'ca_reporte' => 3, 'ca_num_viaje' => 4, 'ca_cod_carrier' => 5, 'ca_codigo_puerto_pickup' => 6, 'ca_codigo_puerto_descarga' => 7, 'ca_container_mode' => 8, 'ca_nombre_proveedor' => 9, 'ca_campo_59' => 10, 'ca_codigo_proveedor' => 11, 'ca_campo_61' => 12, 'ca_monto_invoice_miles' => 13, 'ca_procesado' => 14, 'ca_trader' => 15, 'ca_vendor_id' => 16, 'ca_vendor_name' => 17, 'ca_vendor_addr1' => 18, 'ca_vendor_city' => 19, 'ca_vendor_country' => 20, 'ca_esd' => 21, 'ca_lsd' => 22, 'ca_incoterms' => 23, 'ca_payment_terms' => 24, 'ca_proforma_number' => 25, 'ca_origin' => 26, 'ca_destination' => 27, 'ca_trans_ship_port' => 28, 'ca_reqd_delivery' => 29, 'ca_orden_comments' => 30, 'ca_manufacturer_contact' => 31, 'ca_manufacturer_phone' => 32, 'ca_manufacturer_fax' => 33, 'ca_fchanulado' => 34, 'ca_usuanulado' => 35, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaHeaderMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
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
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
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

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(FalaHeaderPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaHeaderPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     FalaHeader
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
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
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaHeaderPeer::populateObjects(FalaHeaderPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaHeaderPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      FalaHeader $value A FalaHeader object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(FalaHeader $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIddoc();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A FalaHeader object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaHeader) {
				$key = (string) $value->getCaIddoc();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaHeader object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     FalaHeader Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = FalaHeaderPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaHeaderPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaHeaderPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
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
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a FalaHeader or Criteria object.
	 *
	 * @param      mixed $values Criteria or FalaHeader object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaHeaderPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a FalaHeader or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or FalaHeader object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			FalaHeaderPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof FalaHeader) {
			// invalidate the cache for this single object
			FalaHeaderPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaHeaderPeer::CA_IDDOC, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				FalaHeaderPeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
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

			foreach ($cols as $colName) {
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
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     FalaHeader
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FalaHeaderPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);
			$criteria->add(FalaHeaderPeer::CA_IDDOC, $pks, Criteria::IN);
			$objs = FalaHeaderPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseFalaHeaderPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the FalaHeaderPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the FalaHeaderPeer class:
//
// Propel::getDatabaseMap(FalaHeaderPeer::DATABASE_NAME)->addTableBuilder(FalaHeaderPeer::TABLE_NAME, FalaHeaderPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseFalaHeaderPeer::DATABASE_NAME)->addTableBuilder(BaseFalaHeaderPeer::TABLE_NAME, BaseFalaHeaderPeer::getMapBuilder());

