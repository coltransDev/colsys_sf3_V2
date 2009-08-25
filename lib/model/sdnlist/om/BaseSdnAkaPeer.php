<?php


abstract class BaseSdnAkaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_sdnaka';

	
	const CLASS_DEFAULT = 'lib.model.sdnlist.SdnAka';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_UID = 'tb_sdnaka.CA_UID';

	
	const CA_UID_AKA = 'tb_sdnaka.CA_UID_AKA';

	
	const CA_TYPE = 'tb_sdnaka.CA_TYPE';

	
	const CA_CATEGORY = 'tb_sdnaka.CA_CATEGORY';

	
	const CA_FIRSTNAME = 'tb_sdnaka.CA_FIRSTNAME';

	
	const CA_LASTNAME = 'tb_sdnaka.CA_LASTNAME';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaUid', 'CaUidAka', 'CaType', 'CaCategory', 'CaFirstname', 'CaLastname', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caUid', 'caUidAka', 'caType', 'caCategory', 'caFirstname', 'caLastname', ),
		BasePeer::TYPE_COLNAME => array (self::CA_UID, self::CA_UID_AKA, self::CA_TYPE, self::CA_CATEGORY, self::CA_FIRSTNAME, self::CA_LASTNAME, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_uid', 'ca_uid_aka', 'ca_type', 'ca_category', 'ca_firstName', 'ca_lastName', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaUid' => 0, 'CaUidAka' => 1, 'CaType' => 2, 'CaCategory' => 3, 'CaFirstname' => 4, 'CaLastname' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caUid' => 0, 'caUidAka' => 1, 'caType' => 2, 'caCategory' => 3, 'caFirstname' => 4, 'caLastname' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_UID => 0, self::CA_UID_AKA => 1, self::CA_TYPE => 2, self::CA_CATEGORY => 3, self::CA_FIRSTNAME => 4, self::CA_LASTNAME => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_uid' => 0, 'ca_uid_aka' => 1, 'ca_type' => 2, 'ca_category' => 3, 'ca_firstName' => 4, 'ca_lastName' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new SdnAkaMapBuilder();
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
		return str_replace(SdnAkaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SdnAkaPeer::CA_UID);

		$criteria->addSelectColumn(SdnAkaPeer::CA_UID_AKA);

		$criteria->addSelectColumn(SdnAkaPeer::CA_TYPE);

		$criteria->addSelectColumn(SdnAkaPeer::CA_CATEGORY);

		$criteria->addSelectColumn(SdnAkaPeer::CA_FIRSTNAME);

		$criteria->addSelectColumn(SdnAkaPeer::CA_LASTNAME);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAkaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAkaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $criteria, $con);
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
		$objects = SdnAkaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SdnAkaPeer::populateObjects(SdnAkaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SdnAkaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(SdnAka $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaUid(), (string) $obj->getCaUidAka()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof SdnAka) {
				$key = serialize(array((string) $value->getCaUid(), (string) $value->getCaUidAka()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or SdnAka object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = SdnAkaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SdnAkaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SdnAkaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SdnAkaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinSdn(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAkaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAkaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SdnAkaPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SdnAkaPeer::addSelectColumns($c);
		$startcol = (SdnAkaPeer::NUM_COLUMNS - SdnAkaPeer::NUM_LAZY_LOAD_COLUMNS);
		SdnPeer::addSelectColumns($c);

		$c->addJoin(array(SdnAkaPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SdnAkaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SdnAkaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = SdnAkaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SdnAkaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addSdnAka($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(SdnAkaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SdnAkaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(SdnAkaPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SdnAkaPeer::addSelectColumns($c);
		$startcol2 = (SdnAkaPeer::NUM_COLUMNS - SdnAkaPeer::NUM_LAZY_LOAD_COLUMNS);

		SdnPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SdnPeer::NUM_COLUMNS - SdnPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(SdnAkaPeer::CA_UID,), array(SdnPeer::CA_UID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = SdnAkaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = SdnAkaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = SdnAkaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				SdnAkaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addSdnAka($obj1);
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
		return SdnAkaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSdnAkaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSdnAkaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SdnAkaPeer::CA_UID);
			$selectCriteria->add(SdnAkaPeer::CA_UID, $criteria->remove(SdnAkaPeer::CA_UID), $comparison);

			$comparison = $criteria->getComparison(SdnAkaPeer::CA_UID_AKA);
			$selectCriteria->add(SdnAkaPeer::CA_UID_AKA, $criteria->remove(SdnAkaPeer::CA_UID_AKA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSdnAkaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSdnAkaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(SdnAkaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												SdnAkaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof SdnAka) {
						SdnAkaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(SdnAkaPeer::CA_UID, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(SdnAkaPeer::CA_UID_AKA, $value[1]));
				$criteria->addOr($criterion);

								SdnAkaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(SdnAka $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SdnAkaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SdnAkaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SdnAkaPeer::DATABASE_NAME, SdnAkaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SdnAkaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_uid, $ca_uid_aka, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_uid, (string) $ca_uid_aka));
 		if (null !== ($obj = SdnAkaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SdnAkaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(SdnAkaPeer::DATABASE_NAME);
		$criteria->add(SdnAkaPeer::CA_UID, $ca_uid);
		$criteria->add(SdnAkaPeer::CA_UID_AKA, $ca_uid_aka);
		$v = SdnAkaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseSdnAkaPeer::DATABASE_NAME)->addTableBuilder(BaseSdnAkaPeer::TABLE_NAME, BaseSdnAkaPeer::getMapBuilder());

