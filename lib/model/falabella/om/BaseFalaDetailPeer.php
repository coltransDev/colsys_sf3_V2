<?php


abstract class BaseFalaDetailPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_faladetails';

	
	const CLASS_DEFAULT = 'lib.model.falabella.FalaDetail';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDDOC = 'tb_faladetails.CA_IDDOC';

	
	const CA_SKU = 'tb_faladetails.CA_SKU';

	
	const CA_VPN = 'tb_faladetails.CA_VPN';

	
	const CA_NUM_CONT_PART1 = 'tb_faladetails.CA_NUM_CONT_PART1';

	
	const CA_NUM_CONT_PART2 = 'tb_faladetails.CA_NUM_CONT_PART2';

	
	const CA_NUM_CONT_SELL = 'tb_faladetails.CA_NUM_CONT_SELL';

	
	const CA_CONTAINER_ISO = 'tb_faladetails.CA_CONTAINER_ISO';

	
	const CA_CANTIDAD_PEDIDO = 'tb_faladetails.CA_CANTIDAD_PEDIDO';

	
	const CA_CANTIDAD_MILES = 'tb_faladetails.CA_CANTIDAD_MILES';

	
	const CA_UNIDAD_MEDIDAD_CANTIDAD = 'tb_faladetails.CA_UNIDAD_MEDIDAD_CANTIDAD';

	
	const CA_DESCRIPCION_ITEM = 'tb_faladetails.CA_DESCRIPCION_ITEM';

	
	const CA_CANTIDAD_PAQUETES_MILES = 'tb_faladetails.CA_CANTIDAD_PAQUETES_MILES';

	
	const CA_UNIDAD_MEDIDA_PAQUETES = 'tb_faladetails.CA_UNIDAD_MEDIDA_PAQUETES';

	
	const CA_CANTIDAD_VOLUMEN_MILES = 'tb_faladetails.CA_CANTIDAD_VOLUMEN_MILES';

	
	const CA_UNIDAD_MEDIDA_VOLUMEN = 'tb_faladetails.CA_UNIDAD_MEDIDA_VOLUMEN';

	
	const CA_CANTIDAD_PESO_MILES = 'tb_faladetails.CA_CANTIDAD_PESO_MILES';

	
	const CA_UNIDAD_MEDIDA_PESO = 'tb_faladetails.CA_UNIDAD_MEDIDA_PESO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaSku', 'CaVpn', 'CaNumContPart1', 'CaNumContPart2', 'CaNumContSell', 'CaContainerIso', 'CaCantidadPedido', 'CaCantidadMiles', 'CaUnidadMedidadCantidad', 'CaDescripcionItem', 'CaCantidadPaquetesMiles', 'CaUnidadMedidaPaquetes', 'CaCantidadVolumenMiles', 'CaUnidadMedidaVolumen', 'CaCantidadPesoMiles', 'CaUnidadMedidaPeso', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caSku', 'caVpn', 'caNumContPart1', 'caNumContPart2', 'caNumContSell', 'caContainerIso', 'caCantidadPedido', 'caCantidadMiles', 'caUnidadMedidadCantidad', 'caDescripcionItem', 'caCantidadPaquetesMiles', 'caUnidadMedidaPaquetes', 'caCantidadVolumenMiles', 'caUnidadMedidaVolumen', 'caCantidadPesoMiles', 'caUnidadMedidaPeso', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_SKU, self::CA_VPN, self::CA_NUM_CONT_PART1, self::CA_NUM_CONT_PART2, self::CA_NUM_CONT_SELL, self::CA_CONTAINER_ISO, self::CA_CANTIDAD_PEDIDO, self::CA_CANTIDAD_MILES, self::CA_UNIDAD_MEDIDAD_CANTIDAD, self::CA_DESCRIPCION_ITEM, self::CA_CANTIDAD_PAQUETES_MILES, self::CA_UNIDAD_MEDIDA_PAQUETES, self::CA_CANTIDAD_VOLUMEN_MILES, self::CA_UNIDAD_MEDIDA_VOLUMEN, self::CA_CANTIDAD_PESO_MILES, self::CA_UNIDAD_MEDIDA_PESO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_sku', 'ca_vpn', 'ca_num_cont_part1', 'ca_num_cont_part2', 'ca_num_cont_sell', 'ca_container_iso', 'ca_cantidad_pedido', 'ca_cantidad_miles', 'ca_unidad_medidad_cantidad', 'ca_descripcion_item', 'ca_cantidad_paquetes_miles', 'ca_unidad_medida_paquetes', 'ca_cantidad_volumen_miles', 'ca_unidad_medida_volumen', 'ca_cantidad_peso_miles', 'ca_unidad_medida_peso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaSku' => 1, 'CaVpn' => 2, 'CaNumContPart1' => 3, 'CaNumContPart2' => 4, 'CaNumContSell' => 5, 'CaContainerIso' => 6, 'CaCantidadPedido' => 7, 'CaCantidadMiles' => 8, 'CaUnidadMedidadCantidad' => 9, 'CaDescripcionItem' => 10, 'CaCantidadPaquetesMiles' => 11, 'CaUnidadMedidaPaquetes' => 12, 'CaCantidadVolumenMiles' => 13, 'CaUnidadMedidaVolumen' => 14, 'CaCantidadPesoMiles' => 15, 'CaUnidadMedidaPeso' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caSku' => 1, 'caVpn' => 2, 'caNumContPart1' => 3, 'caNumContPart2' => 4, 'caNumContSell' => 5, 'caContainerIso' => 6, 'caCantidadPedido' => 7, 'caCantidadMiles' => 8, 'caUnidadMedidadCantidad' => 9, 'caDescripcionItem' => 10, 'caCantidadPaquetesMiles' => 11, 'caUnidadMedidaPaquetes' => 12, 'caCantidadVolumenMiles' => 13, 'caUnidadMedidaVolumen' => 14, 'caCantidadPesoMiles' => 15, 'caUnidadMedidaPeso' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_SKU => 1, self::CA_VPN => 2, self::CA_NUM_CONT_PART1 => 3, self::CA_NUM_CONT_PART2 => 4, self::CA_NUM_CONT_SELL => 5, self::CA_CONTAINER_ISO => 6, self::CA_CANTIDAD_PEDIDO => 7, self::CA_CANTIDAD_MILES => 8, self::CA_UNIDAD_MEDIDAD_CANTIDAD => 9, self::CA_DESCRIPCION_ITEM => 10, self::CA_CANTIDAD_PAQUETES_MILES => 11, self::CA_UNIDAD_MEDIDA_PAQUETES => 12, self::CA_CANTIDAD_VOLUMEN_MILES => 13, self::CA_UNIDAD_MEDIDA_VOLUMEN => 14, self::CA_CANTIDAD_PESO_MILES => 15, self::CA_UNIDAD_MEDIDA_PESO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_sku' => 1, 'ca_vpn' => 2, 'ca_num_cont_part1' => 3, 'ca_num_cont_part2' => 4, 'ca_num_cont_sell' => 5, 'ca_container_iso' => 6, 'ca_cantidad_pedido' => 7, 'ca_cantidad_miles' => 8, 'ca_unidad_medidad_cantidad' => 9, 'ca_descripcion_item' => 10, 'ca_cantidad_paquetes_miles' => 11, 'ca_unidad_medida_paquetes' => 12, 'ca_cantidad_volumen_miles' => 13, 'ca_unidad_medida_volumen' => 14, 'ca_cantidad_peso_miles' => 15, 'ca_unidad_medida_peso' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaDetailMapBuilder();
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
		return str_replace(FalaDetailPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaDetailPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaDetailPeer::CA_SKU);

		$criteria->addSelectColumn(FalaDetailPeer::CA_VPN);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_PART1);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_PART2);

		$criteria->addSelectColumn(FalaDetailPeer::CA_NUM_CONT_SELL);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CONTAINER_ISO);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PEDIDO);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDAD_CANTIDAD);

		$criteria->addSelectColumn(FalaDetailPeer::CA_DESCRIPCION_ITEM);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PAQUETES_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_PAQUETES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_VOLUMEN_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_VOLUMEN);

		$criteria->addSelectColumn(FalaDetailPeer::CA_CANTIDAD_PESO_MILES);

		$criteria->addSelectColumn(FalaDetailPeer::CA_UNIDAD_MEDIDA_PESO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaDetailPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaDetailPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $criteria, $con);
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
		$objects = FalaDetailPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaDetailPeer::populateObjects(FalaDetailPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaDetailPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FalaDetail $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIddoc(), (string) $obj->getCaSku()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaDetail) {
				$key = serialize(array((string) $value->getCaIddoc(), (string) $value->getCaSku()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaDetail object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = FalaDetailPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaDetailPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaDetailPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaDetailPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaDetailPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaDetailPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaDetailPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinFalaHeader(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaDetailPeer::addSelectColumns($c);
		$startcol = (FalaDetailPeer::NUM_COLUMNS - FalaDetailPeer::NUM_LAZY_LOAD_COLUMNS);
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FalaDetailPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaDetailPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaDetailPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FalaDetailPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaDetailPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFalaDetail($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaDetailPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaDetailPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaDetailPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaDetailPeer::addSelectColumns($c);
		$startcol2 = (FalaDetailPeer::NUM_COLUMNS - FalaDetailPeer::NUM_LAZY_LOAD_COLUMNS);

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FalaDetailPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaDetailPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaDetailPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FalaDetailPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaDetailPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = FalaHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FalaHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FalaHeaderPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FalaHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFalaDetail($obj1);
			} 
			$results[] = $obj1;
		}
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
		return FalaDetailPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaDetailPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaDetailPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FalaDetailPeer::CA_IDDOC);
			$selectCriteria->add(FalaDetailPeer::CA_IDDOC, $criteria->remove(FalaDetailPeer::CA_IDDOC), $comparison);

			$comparison = $criteria->getComparison(FalaDetailPeer::CA_SKU);
			$selectCriteria->add(FalaDetailPeer::CA_SKU, $criteria->remove(FalaDetailPeer::CA_SKU), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFalaDetailPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaDetailPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaDetailPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FalaDetailPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FalaDetail) {
						FalaDetailPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(FalaDetailPeer::CA_IDDOC, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(FalaDetailPeer::CA_SKU, $value[1]));
				$criteria->addOr($criterion);

								FalaDetailPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(FalaDetail $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaDetailPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaDetailPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FalaDetailPeer::DATABASE_NAME, FalaDetailPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaDetailPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_iddoc, $ca_sku, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_iddoc, (string) $ca_sku));
 		if (null !== ($obj = FalaDetailPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(FalaDetailPeer::DATABASE_NAME);
		$criteria->add(FalaDetailPeer::CA_IDDOC, $ca_iddoc);
		$criteria->add(FalaDetailPeer::CA_SKU, $ca_sku);
		$v = FalaDetailPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseFalaDetailPeer::DATABASE_NAME)->addTableBuilder(BaseFalaDetailPeer::TABLE_NAME, BaseFalaDetailPeer::getMapBuilder());

