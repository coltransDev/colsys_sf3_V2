<?php


abstract class BasePricPatioLineaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricpatioslinea';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricPatioLinea';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDPATIO = 'tb_pricpatioslinea.CA_IDPATIO';

	
	const CA_IDLINEA = 'tb_pricpatioslinea.CA_IDLINEA';

	
	const CA_TRANSPORTE = 'tb_pricpatioslinea.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_pricpatioslinea.CA_MODALIDAD';

	
	const CA_IMPOEXPO = 'tb_pricpatioslinea.CA_IMPOEXPO';

	
	const CA_OBSERVACIONES = 'tb_pricpatioslinea.CA_OBSERVACIONES';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdpatio', 'CaIdlinea', 'CaTransporte', 'CaModalidad', 'CaImpoexpo', 'CaObservaciones', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdpatio', 'caIdlinea', 'caTransporte', 'caModalidad', 'caImpoexpo', 'caObservaciones', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPATIO, self::CA_IDLINEA, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idpatio', 'ca_idlinea', 'ca_transporte', 'ca_modalidad', 'ca_impoexpo', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdpatio' => 0, 'CaIdlinea' => 1, 'CaTransporte' => 2, 'CaModalidad' => 3, 'CaImpoexpo' => 4, 'CaObservaciones' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdpatio' => 0, 'caIdlinea' => 1, 'caTransporte' => 2, 'caModalidad' => 3, 'caImpoexpo' => 4, 'caObservaciones' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPATIO => 0, self::CA_IDLINEA => 1, self::CA_TRANSPORTE => 2, self::CA_MODALIDAD => 3, self::CA_IMPOEXPO => 4, self::CA_OBSERVACIONES => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idpatio' => 0, 'ca_idlinea' => 1, 'ca_transporte' => 2, 'ca_modalidad' => 3, 'ca_impoexpo' => 4, 'ca_observaciones' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricPatioLineaMapBuilder();
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
		return str_replace(PricPatioLineaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_IDPATIO);

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_IDLINEA);

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricPatioLineaPeer::CA_OBSERVACIONES);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricPatioLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
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
		$objects = PricPatioLineaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricPatioLineaPeer::populateObjects(PricPatioLineaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricPatioLinea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdpatio(), (string) $obj->getCaIdlinea(), (string) $obj->getCaTransporte(), (string) $obj->getCaModalidad(), (string) $obj->getCaImpoexpo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricPatioLinea) {
				$key = serialize(array((string) $value->getCaIdpatio(), (string) $value->getCaIdlinea(), (string) $value->getCaTransporte(), (string) $value->getCaModalidad(), (string) $value->getCaImpoexpo()));
			} elseif (is_array($value) && count($value) === 5) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricPatioLinea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = PricPatioLineaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricPatioLineaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricPatioLineaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinPricPatio(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricPatioLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricPatioLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinPricPatio(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricPatioLineaPeer::addSelectColumns($c);
		$startcol = (PricPatioLineaPeer::NUM_COLUMNS - PricPatioLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		PricPatioPeer::addSelectColumns($c);

		$c->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricPatioLineaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricPatioLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricPatioLineaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = PricPatioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PricPatioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricPatioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PricPatioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricPatioLinea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricPatioLineaPeer::addSelectColumns($c);
		$startcol = (PricPatioLineaPeer::NUM_COLUMNS - PricPatioLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricPatioLineaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricPatioLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricPatioLineaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricPatioLinea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricPatioLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);
		$criteria->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricPatioLineaPeer::addSelectColumns($c);
		$startcol2 = (PricPatioLineaPeer::NUM_COLUMNS - PricPatioLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		PricPatioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricPatioPeer::NUM_COLUMNS - PricPatioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);
		$c->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricPatioLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricPatioLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricPatioLineaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = PricPatioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = PricPatioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricPatioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricPatioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricPatioLinea($obj1);
			} 
			
			$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TransportadorPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addPricPatioLinea($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptPricPatio(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricPatioLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptPricPatio(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricPatioLineaPeer::addSelectColumns($c);
		$startcol2 = (PricPatioLineaPeer::NUM_COLUMNS - PricPatioLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricPatioLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricPatioLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricPatioLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricPatioLineaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricPatioLinea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricPatioLineaPeer::addSelectColumns($c);
		$startcol2 = (PricPatioLineaPeer::NUM_COLUMNS - PricPatioLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		PricPatioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricPatioPeer::NUM_COLUMNS - PricPatioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricPatioLineaPeer::CA_IDPATIO,), array(PricPatioPeer::CA_IDPATIO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricPatioLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricPatioLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricPatioLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricPatioLineaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = PricPatioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = PricPatioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = PricPatioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricPatioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricPatioLinea($obj1);

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
		return PricPatioLineaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricPatioLineaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricPatioLineaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricPatioLineaPeer::CA_IDPATIO);
			$selectCriteria->add(PricPatioLineaPeer::CA_IDPATIO, $criteria->remove(PricPatioLineaPeer::CA_IDPATIO), $comparison);

			$comparison = $criteria->getComparison(PricPatioLineaPeer::CA_IDLINEA);
			$selectCriteria->add(PricPatioLineaPeer::CA_IDLINEA, $criteria->remove(PricPatioLineaPeer::CA_IDLINEA), $comparison);

			$comparison = $criteria->getComparison(PricPatioLineaPeer::CA_TRANSPORTE);
			$selectCriteria->add(PricPatioLineaPeer::CA_TRANSPORTE, $criteria->remove(PricPatioLineaPeer::CA_TRANSPORTE), $comparison);

			$comparison = $criteria->getComparison(PricPatioLineaPeer::CA_MODALIDAD);
			$selectCriteria->add(PricPatioLineaPeer::CA_MODALIDAD, $criteria->remove(PricPatioLineaPeer::CA_MODALIDAD), $comparison);

			$comparison = $criteria->getComparison(PricPatioLineaPeer::CA_IMPOEXPO);
			$selectCriteria->add(PricPatioLineaPeer::CA_IMPOEXPO, $criteria->remove(PricPatioLineaPeer::CA_IMPOEXPO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricPatioLineaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricPatioLineaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricPatioLineaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricPatioLineaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricPatioLinea) {
						PricPatioLineaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricPatioLineaPeer::CA_IDPATIO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricPatioLineaPeer::CA_IDLINEA, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(PricPatioLineaPeer::CA_TRANSPORTE, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(PricPatioLineaPeer::CA_MODALIDAD, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(PricPatioLineaPeer::CA_IMPOEXPO, $value[4]));
				$criteria->addOr($criterion);

								PricPatioLineaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(PricPatioLinea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricPatioLineaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricPatioLineaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricPatioLineaPeer::DATABASE_NAME, PricPatioLineaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricPatioLineaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idpatio, $ca_idlinea, $ca_transporte, $ca_modalidad, $ca_impoexpo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idpatio, (string) $ca_idlinea, (string) $ca_transporte, (string) $ca_modalidad, (string) $ca_impoexpo));
 		if (null !== ($obj = PricPatioLineaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricPatioLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricPatioLineaPeer::DATABASE_NAME);
		$criteria->add(PricPatioLineaPeer::CA_IDPATIO, $ca_idpatio);
		$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $ca_idlinea);
		$criteria->add(PricPatioLineaPeer::CA_TRANSPORTE, $ca_transporte);
		$criteria->add(PricPatioLineaPeer::CA_MODALIDAD, $ca_modalidad);
		$criteria->add(PricPatioLineaPeer::CA_IMPOEXPO, $ca_impoexpo);
		$v = PricPatioLineaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BasePricPatioLineaPeer::DATABASE_NAME)->addTableBuilder(BasePricPatioLineaPeer::TABLE_NAME, BasePricPatioLineaPeer::getMapBuilder());

