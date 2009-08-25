<?php


abstract class BaseSdnAddressPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_sdnaddress';

	
	const CLASS_DEFAULT = 'lib.model.sdnlist.SdnAddress';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_UID = 'tb_sdnaddress.CA_UID';

	
	const CA_UID_ADDRESS = 'tb_sdnaddress.CA_UID_ADDRESS';

	
	const CA_ADDRESS1 = 'tb_sdnaddress.CA_ADDRESS1';

	
	const CA_ADDRESS2 = 'tb_sdnaddress.CA_ADDRESS2';

	
	const CA_ADDRESS3 = 'tb_sdnaddress.CA_ADDRESS3';

	
	const CA_CITY = 'tb_sdnaddress.CA_CITY';

	
	const CA_STATE = 'tb_sdnaddress.CA_STATE';

	
	const CA_POSTAL = 'tb_sdnaddress.CA_POSTAL';

	
	const CA_COUNTRY = 'tb_sdnaddress.CA_COUNTRY';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaUid', 'CaUidAddress', 'CaAddress1', 'CaAddress2', 'CaAddress3', 'CaCity', 'CaState', 'CaPostal', 'CaCountry', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caUid', 'caUidAddress', 'caAddress1', 'caAddress2', 'caAddress3', 'caCity', 'caState', 'caPostal', 'caCountry', ),
		BasePeer::TYPE_COLNAME => array (self::CA_UID, self::CA_UID_ADDRESS, self::CA_ADDRESS1, self::CA_ADDRESS2, self::CA_ADDRESS3, self::CA_CITY, self::CA_STATE, self::CA_POSTAL, self::CA_COUNTRY, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_uid', 'ca_uid_address', 'ca_address1', 'ca_address2', 'ca_address3', 'ca_city', 'ca_state', 'ca_postal', 'ca_country', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaUid' => 0, 'CaUidAddress' => 1, 'CaAddress1' => 2, 'CaAddress2' => 3, 'CaAddress3' => 4, 'CaCity' => 5, 'CaState' => 6, 'CaPostal' => 7, 'CaCountry' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caUid' => 0, 'caUidAddress' => 1, 'caAddress1' => 2, 'caAddress2' => 3, 'caAddress3' => 4, 'caCity' => 5, 'caState' => 6, 'caPostal' => 7, 'caCountry' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_UID => 0, self::CA_UID_ADDRESS => 1, self::CA_ADDRESS1 => 2, self::CA_ADDRESS2 => 3, self::CA_ADDRESS3 => 4, self::CA_CITY => 5, self::CA_STATE => 6, self::CA_POSTAL => 7, self::CA_COUNTRY => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_uid' => 0, 'ca_uid_address' => 1, 'ca_address1' => 2, 'ca_address2' => 3, 'ca_address3' => 4, 'ca_city' => 5, 'ca_state' => 6, 'ca_postal' => 7, 'ca_country' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new SdnAddressMapBuilder();
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
		return str_replace(SdnAddressPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SdnAddressPeer::CA_UID);

		$criteria->addSelectColumn(SdnAddressPeer::CA_UID_ADDRESS);

		$criteria->addSelectColumn(SdnAddressPeer::CA_ADDRESS1);

		$criteria->addSelectColumn(SdnAddressPeer::CA_ADDRESS2);

		$criteria->addSelectColumn(SdnAddressPeer::CA_ADDRESS3);

		$criteria->addSelectColumn(SdnAddressPeer::CA_CITY);

		$criteria->addSelectColumn(SdnAddressPeer::CA_STATE);

		$criteria->addSelectColumn(SdnAddressPeer::CA_POSTAL);

		$criteria->addSelectColumn(SdnAddressPeer::CA_COUNTRY);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAddressPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAddressPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $criteria, $con);
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
		$objects = SdnAddressPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SdnAddressPeer::populateObjects(SdnAddressPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SdnAddressPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(SdnAddress $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaUid(), (string) $obj->getCaUidAddress()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof SdnAddress) {
				$key = serialize(array((string) $value->getCaUid(), (string) $value->getCaUidAddress()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or SdnAddress object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = SdnAddressPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SdnAddressPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SdnAddressPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SdnAddressPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinSdn(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAddressPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAddressPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SdnAddressPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinSdn(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SdnAddressPeer::addSelectColumns($c);
		$startcol = (SdnAddressPeer::NUM_COLUMNS - SdnAddressPeer::NUM_LAZY_LOAD_COLUMNS);
		SdnPeer::addSelectColumns($c);

		$c->addJoin(array(SdnAddressPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SdnAddressPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SdnAddressPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = SdnAddressPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SdnAddressPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = SdnPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SdnPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SdnPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SdnPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSdnAddress($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAddressPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAddressPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SdnAddressPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SdnAddressPeer::addSelectColumns($c);
		$startcol2 = (SdnAddressPeer::NUM_COLUMNS - SdnAddressPeer::NUM_LAZY_LOAD_COLUMNS);

		SdnPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SdnPeer::NUM_COLUMNS - SdnPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(SdnAddressPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SdnAddressPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SdnAddressPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = SdnAddressPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SdnAddressPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = SdnPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = SdnPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SdnPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SdnPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addSdnAddress($obj1);
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
		return SdnAddressPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSdnAddressPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSdnAddressPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SdnAddressPeer::CA_UID);
			$selectCriteria->add(SdnAddressPeer::CA_UID, $criteria->remove(SdnAddressPeer::CA_UID), $comparison);

			$comparison = $criteria->getComparison(SdnAddressPeer::CA_UID_ADDRESS);
			$selectCriteria->add(SdnAddressPeer::CA_UID_ADDRESS, $criteria->remove(SdnAddressPeer::CA_UID_ADDRESS), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSdnAddressPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSdnAddressPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SdnAddressPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												SdnAddressPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof SdnAddress) {
						SdnAddressPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(SdnAddressPeer::CA_UID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(SdnAddressPeer::CA_UID_ADDRESS, $value[1]));
				$criteria->addOr($criterion);

								SdnAddressPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(SdnAddress $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SdnAddressPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SdnAddressPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SdnAddressPeer::DATABASE_NAME, SdnAddressPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SdnAddressPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_uid, $ca_uid_address, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_uid, (string) $ca_uid_address));
 		if (null !== ($obj = SdnAddressPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SdnAddressPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(SdnAddressPeer::DATABASE_NAME);
		$criteria->add(SdnAddressPeer::CA_UID, $ca_uid);
		$criteria->add(SdnAddressPeer::CA_UID_ADDRESS, $ca_uid_address);
		$v = SdnAddressPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseSdnAddressPeer::DATABASE_NAME)->addTableBuilder(BaseSdnAddressPeer::TABLE_NAME, BaseSdnAddressPeer::getMapBuilder());

