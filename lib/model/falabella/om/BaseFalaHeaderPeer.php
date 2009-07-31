<?php


abstract class BaseFalaHeaderPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_falaheader';

	
	const CLASS_DEFAULT = 'lib.model.falabella.FalaHeader';

	
	const NUM_COLUMNS = 36;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDDOC = 'tb_falaheader.CA_IDDOC';

	
	const CA_FECHA_CARPETA = 'tb_falaheader.CA_FECHA_CARPETA';

	
	const CA_ARCHIVO_ORIGEN = 'tb_falaheader.CA_ARCHIVO_ORIGEN';

	
	const CA_REPORTE = 'tb_falaheader.CA_REPORTE';

	
	const CA_NUM_VIAJE = 'tb_falaheader.CA_NUM_VIAJE';

	
	const CA_COD_CARRIER = 'tb_falaheader.CA_COD_CARRIER';

	
	const CA_CODIGO_PUERTO_PICKUP = 'tb_falaheader.CA_CODIGO_PUERTO_PICKUP';

	
	const CA_CODIGO_PUERTO_DESCARGA = 'tb_falaheader.CA_CODIGO_PUERTO_DESCARGA';

	
	const CA_CONTAINER_MODE = 'tb_falaheader.CA_CONTAINER_MODE';

	
	const CA_NOMBRE_PROVEEDOR = 'tb_falaheader.CA_NOMBRE_PROVEEDOR';

	
	const CA_CAMPO_59 = 'tb_falaheader.CA_CAMPO_59';

	
	const CA_CODIGO_PROVEEDOR = 'tb_falaheader.CA_CODIGO_PROVEEDOR';

	
	const CA_CAMPO_61 = 'tb_falaheader.CA_CAMPO_61';

	
	const CA_MONTO_INVOICE_MILES = 'tb_falaheader.CA_MONTO_INVOICE_MILES';

	
	const CA_PROCESADO = 'tb_falaheader.CA_PROCESADO';

	
	const CA_TRADER = 'tb_falaheader.CA_TRADER';

	
	const CA_VENDOR_ID = 'tb_falaheader.CA_VENDOR_ID';

	
	const CA_VENDOR_NAME = 'tb_falaheader.CA_VENDOR_NAME';

	
	const CA_VENDOR_ADDR1 = 'tb_falaheader.CA_VENDOR_ADDR1';

	
	const CA_VENDOR_CITY = 'tb_falaheader.CA_VENDOR_CITY';

	
	const CA_VENDOR_COUNTRY = 'tb_falaheader.CA_VENDOR_COUNTRY';

	
	const CA_ESD = 'tb_falaheader.CA_ESD';

	
	const CA_LSD = 'tb_falaheader.CA_LSD';

	
	const CA_INCOTERMS = 'tb_falaheader.CA_INCOTERMS';

	
	const CA_PAYMENT_TERMS = 'tb_falaheader.CA_PAYMENT_TERMS';

	
	const CA_PROFORMA_NUMBER = 'tb_falaheader.CA_PROFORMA_NUMBER';

	
	const CA_ORIGIN = 'tb_falaheader.CA_ORIGIN';

	
	const CA_DESTINATION = 'tb_falaheader.CA_DESTINATION';

	
	const CA_TRANS_SHIP_PORT = 'tb_falaheader.CA_TRANS_SHIP_PORT';

	
	const CA_REQD_DELIVERY = 'tb_falaheader.CA_REQD_DELIVERY';

	
	const CA_ORDEN_COMMENTS = 'tb_falaheader.CA_ORDEN_COMMENTS';

	
	const CA_MANUFACTURER_CONTACT = 'tb_falaheader.CA_MANUFACTURER_CONTACT';

	
	const CA_MANUFACTURER_PHONE = 'tb_falaheader.CA_MANUFACTURER_PHONE';

	
	const CA_MANUFACTURER_FAX = 'tb_falaheader.CA_MANUFACTURER_FAX';

	
	const CA_FCHANULADO = 'tb_falaheader.CA_FCHANULADO';

	
	const CA_USUANULADO = 'tb_falaheader.CA_USUANULADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaFechaCarpeta', 'CaArchivoOrigen', 'CaReporte', 'CaNumViaje', 'CaCodCarrier', 'CaCodigoPuertoPickup', 'CaCodigoPuertoDescarga', 'CaContainerMode', 'CaNombreProveedor', 'CaCampo59', 'CaCodigoProveedor', 'CaCampo61', 'CaMontoInvoiceMiles', 'CaProcesado', 'CaTrader', 'CaVendorId', 'CaVendorName', 'CaVendorAddr1', 'CaVendorCity', 'CaVendorCountry', 'CaEsd', 'CaLsd', 'CaIncoterms', 'CaPaymentTerms', 'CaProformaNumber', 'CaOrigin', 'CaDestination', 'CaTransShipPort', 'CaReqdDelivery', 'CaOrdenComments', 'CaManufacturerContact', 'CaManufacturerPhone', 'CaManufacturerFax', 'CaFchanulado', 'CaUsuanulado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caFechaCarpeta', 'caArchivoOrigen', 'caReporte', 'caNumViaje', 'caCodCarrier', 'caCodigoPuertoPickup', 'caCodigoPuertoDescarga', 'caContainerMode', 'caNombreProveedor', 'caCampo59', 'caCodigoProveedor', 'caCampo61', 'caMontoInvoiceMiles', 'caProcesado', 'caTrader', 'caVendorId', 'caVendorName', 'caVendorAddr1', 'caVendorCity', 'caVendorCountry', 'caEsd', 'caLsd', 'caIncoterms', 'caPaymentTerms', 'caProformaNumber', 'caOrigin', 'caDestination', 'caTransShipPort', 'caReqdDelivery', 'caOrdenComments', 'caManufacturerContact', 'caManufacturerPhone', 'caManufacturerFax', 'caFchanulado', 'caUsuanulado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_FECHA_CARPETA, self::CA_ARCHIVO_ORIGEN, self::CA_REPORTE, self::CA_NUM_VIAJE, self::CA_COD_CARRIER, self::CA_CODIGO_PUERTO_PICKUP, self::CA_CODIGO_PUERTO_DESCARGA, self::CA_CONTAINER_MODE, self::CA_NOMBRE_PROVEEDOR, self::CA_CAMPO_59, self::CA_CODIGO_PROVEEDOR, self::CA_CAMPO_61, self::CA_MONTO_INVOICE_MILES, self::CA_PROCESADO, self::CA_TRADER, self::CA_VENDOR_ID, self::CA_VENDOR_NAME, self::CA_VENDOR_ADDR1, self::CA_VENDOR_CITY, self::CA_VENDOR_COUNTRY, self::CA_ESD, self::CA_LSD, self::CA_INCOTERMS, self::CA_PAYMENT_TERMS, self::CA_PROFORMA_NUMBER, self::CA_ORIGIN, self::CA_DESTINATION, self::CA_TRANS_SHIP_PORT, self::CA_REQD_DELIVERY, self::CA_ORDEN_COMMENTS, self::CA_MANUFACTURER_CONTACT, self::CA_MANUFACTURER_PHONE, self::CA_MANUFACTURER_FAX, self::CA_FCHANULADO, self::CA_USUANULADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_fecha_carpeta', 'ca_archivo_origen', 'ca_reporte', 'ca_num_viaje', 'ca_cod_carrier', 'ca_codigo_puerto_pickup', 'ca_codigo_puerto_descarga', 'ca_container_mode', 'ca_nombre_proveedor', 'ca_campo_59', 'ca_codigo_proveedor', 'ca_campo_61', 'ca_monto_invoice_miles', 'ca_procesado', 'ca_trader', 'ca_vendor_id', 'ca_vendor_name', 'ca_vendor_addr1', 'ca_vendor_city', 'ca_vendor_country', 'ca_esd', 'ca_lsd', 'ca_incoterms', 'ca_payment_terms', 'ca_proforma_number', 'ca_origin', 'ca_destination', 'ca_trans_ship_port', 'ca_reqd_delivery', 'ca_orden_comments', 'ca_manufacturer_contact', 'ca_manufacturer_phone', 'ca_manufacturer_fax', 'ca_fchanulado', 'ca_usuanulado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaFechaCarpeta' => 1, 'CaArchivoOrigen' => 2, 'CaReporte' => 3, 'CaNumViaje' => 4, 'CaCodCarrier' => 5, 'CaCodigoPuertoPickup' => 6, 'CaCodigoPuertoDescarga' => 7, 'CaContainerMode' => 8, 'CaNombreProveedor' => 9, 'CaCampo59' => 10, 'CaCodigoProveedor' => 11, 'CaCampo61' => 12, 'CaMontoInvoiceMiles' => 13, 'CaProcesado' => 14, 'CaTrader' => 15, 'CaVendorId' => 16, 'CaVendorName' => 17, 'CaVendorAddr1' => 18, 'CaVendorCity' => 19, 'CaVendorCountry' => 20, 'CaEsd' => 21, 'CaLsd' => 22, 'CaIncoterms' => 23, 'CaPaymentTerms' => 24, 'CaProformaNumber' => 25, 'CaOrigin' => 26, 'CaDestination' => 27, 'CaTransShipPort' => 28, 'CaReqdDelivery' => 29, 'CaOrdenComments' => 30, 'CaManufacturerContact' => 31, 'CaManufacturerPhone' => 32, 'CaManufacturerFax' => 33, 'CaFchanulado' => 34, 'CaUsuanulado' => 35, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caFechaCarpeta' => 1, 'caArchivoOrigen' => 2, 'caReporte' => 3, 'caNumViaje' => 4, 'caCodCarrier' => 5, 'caCodigoPuertoPickup' => 6, 'caCodigoPuertoDescarga' => 7, 'caContainerMode' => 8, 'caNombreProveedor' => 9, 'caCampo59' => 10, 'caCodigoProveedor' => 11, 'caCampo61' => 12, 'caMontoInvoiceMiles' => 13, 'caProcesado' => 14, 'caTrader' => 15, 'caVendorId' => 16, 'caVendorName' => 17, 'caVendorAddr1' => 18, 'caVendorCity' => 19, 'caVendorCountry' => 20, 'caEsd' => 21, 'caLsd' => 22, 'caIncoterms' => 23, 'caPaymentTerms' => 24, 'caProformaNumber' => 25, 'caOrigin' => 26, 'caDestination' => 27, 'caTransShipPort' => 28, 'caReqdDelivery' => 29, 'caOrdenComments' => 30, 'caManufacturerContact' => 31, 'caManufacturerPhone' => 32, 'caManufacturerFax' => 33, 'caFchanulado' => 34, 'caUsuanulado' => 35, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_FECHA_CARPETA => 1, self::CA_ARCHIVO_ORIGEN => 2, self::CA_REPORTE => 3, self::CA_NUM_VIAJE => 4, self::CA_COD_CARRIER => 5, self::CA_CODIGO_PUERTO_PICKUP => 6, self::CA_CODIGO_PUERTO_DESCARGA => 7, self::CA_CONTAINER_MODE => 8, self::CA_NOMBRE_PROVEEDOR => 9, self::CA_CAMPO_59 => 10, self::CA_CODIGO_PROVEEDOR => 11, self::CA_CAMPO_61 => 12, self::CA_MONTO_INVOICE_MILES => 13, self::CA_PROCESADO => 14, self::CA_TRADER => 15, self::CA_VENDOR_ID => 16, self::CA_VENDOR_NAME => 17, self::CA_VENDOR_ADDR1 => 18, self::CA_VENDOR_CITY => 19, self::CA_VENDOR_COUNTRY => 20, self::CA_ESD => 21, self::CA_LSD => 22, self::CA_INCOTERMS => 23, self::CA_PAYMENT_TERMS => 24, self::CA_PROFORMA_NUMBER => 25, self::CA_ORIGIN => 26, self::CA_DESTINATION => 27, self::CA_TRANS_SHIP_PORT => 28, self::CA_REQD_DELIVERY => 29, self::CA_ORDEN_COMMENTS => 30, self::CA_MANUFACTURER_CONTACT => 31, self::CA_MANUFACTURER_PHONE => 32, self::CA_MANUFACTURER_FAX => 33, self::CA_FCHANULADO => 34, self::CA_USUANULADO => 35, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_fecha_carpeta' => 1, 'ca_archivo_origen' => 2, 'ca_reporte' => 3, 'ca_num_viaje' => 4, 'ca_cod_carrier' => 5, 'ca_codigo_puerto_pickup' => 6, 'ca_codigo_puerto_descarga' => 7, 'ca_container_mode' => 8, 'ca_nombre_proveedor' => 9, 'ca_campo_59' => 10, 'ca_codigo_proveedor' => 11, 'ca_campo_61' => 12, 'ca_monto_invoice_miles' => 13, 'ca_procesado' => 14, 'ca_trader' => 15, 'ca_vendor_id' => 16, 'ca_vendor_name' => 17, 'ca_vendor_addr1' => 18, 'ca_vendor_city' => 19, 'ca_vendor_country' => 20, 'ca_esd' => 21, 'ca_lsd' => 22, 'ca_incoterms' => 23, 'ca_payment_terms' => 24, 'ca_proforma_number' => 25, 'ca_origin' => 26, 'ca_destination' => 27, 'ca_trans_ship_port' => 28, 'ca_reqd_delivery' => 29, 'ca_orden_comments' => 30, 'ca_manufacturer_contact' => 31, 'ca_manufacturer_phone' => 32, 'ca_manufacturer_fax' => 33, 'ca_fchanulado' => 34, 'ca_usuanulado' => 35, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaHeaderMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(FalaHeaderPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
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

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaHeaderPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaHeaderPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaHeaderPeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
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
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaHeaderPeer::populateObjects(FalaHeaderPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFalaHeaderPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaHeaderPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FalaHeader $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIddoc();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaHeader) {
				$key = (string) $value->getCaIddoc();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaHeader object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = FalaHeaderPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaHeaderPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaHeaderPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return FalaHeaderPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaHeaderPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaHeaderPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaHeaderPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FalaHeaderPeer::CA_IDDOC);
			$selectCriteria->add(FalaHeaderPeer::CA_IDDOC, $criteria->remove(FalaHeaderPeer::CA_IDDOC), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFalaHeaderPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaHeaderPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaHeaderPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FalaHeaderPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FalaHeader) {
						FalaHeaderPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaHeaderPeer::CA_IDDOC, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								FalaHeaderPeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
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

} 

Propel::getDatabaseMap(BaseFalaHeaderPeer::DATABASE_NAME)->addTableBuilder(BaseFalaHeaderPeer::TABLE_NAME, BaseFalaHeaderPeer::getMapBuilder());

