<?php


abstract class BaseHdeskGroupPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'helpdesk.tb_groups';

	
	const CLASS_DEFAULT = 'lib.model.helpdesk.HdeskGroup';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDGROUP = 'helpdesk.tb_groups.CA_IDGROUP';

	
	const CA_IDDEPARTAMENT = 'helpdesk.tb_groups.CA_IDDEPARTAMENT';

	
	const CA_NAME = 'helpdesk.tb_groups.CA_NAME';

	
	const CA_MAXRESPONSETIME = 'helpdesk.tb_groups.CA_MAXRESPONSETIME';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdgroup', 'CaIddepartament', 'CaName', 'CaMaxresponsetime', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdgroup', 'caIddepartament', 'caName', 'caMaxresponsetime', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDGROUP, self::CA_IDDEPARTAMENT, self::CA_NAME, self::CA_MAXRESPONSETIME, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idgroup', 'ca_iddepartament', 'ca_name', 'ca_maxresponsetime', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdgroup' => 0, 'CaIddepartament' => 1, 'CaName' => 2, 'CaMaxresponsetime' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdgroup' => 0, 'caIddepartament' => 1, 'caName' => 2, 'caMaxresponsetime' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDGROUP => 0, self::CA_IDDEPARTAMENT => 1, self::CA_NAME => 2, self::CA_MAXRESPONSETIME => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idgroup' => 0, 'ca_iddepartament' => 1, 'ca_name' => 2, 'ca_maxresponsetime' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new HdeskGroupMapBuilder();
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
		return str_replace(HdeskGroupPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HdeskGroupPeer::CA_IDGROUP);

		$criteria->addSelectColumn(HdeskGroupPeer::CA_IDDEPARTAMENT);

		$criteria->addSelectColumn(HdeskGroupPeer::CA_NAME);

		$criteria->addSelectColumn(HdeskGroupPeer::CA_MAXRESPONSETIME);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $criteria, $con);
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
		$objects = HdeskGroupPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return HdeskGroupPeer::populateObjects(HdeskGroupPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			HdeskGroupPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(HdeskGroup $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdgroup();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof HdeskGroup) {
				$key = (string) $value->getCaIdgroup();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or HdeskGroup object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = HdeskGroupPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = HdeskGroupPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				HdeskGroupPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinDepartamento(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskGroupPeer::CA_IDDEPARTAMENT,), array(DepartamentoPeer::CA_IDDEPARTAMENTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinDepartamento(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskGroupPeer::addSelectColumns($c);
		$startcol = (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);
		DepartamentoPeer::addSelectColumns($c);

		$c->addJoin(array(HdeskGroupPeer::CA_IDDEPARTAMENT,), array(DepartamentoPeer::CA_IDDEPARTAMENTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskGroupPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = HdeskGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskGroupPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = DepartamentoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = DepartamentoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = DepartamentoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					DepartamentoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskGroup($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(HdeskGroupPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			HdeskGroupPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(HdeskGroupPeer::CA_IDDEPARTAMENT,), array(DepartamentoPeer::CA_IDDEPARTAMENTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HdeskGroupPeer::addSelectColumns($c);
		$startcol2 = (HdeskGroupPeer::NUM_COLUMNS - HdeskGroupPeer::NUM_LAZY_LOAD_COLUMNS);

		DepartamentoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (DepartamentoPeer::NUM_COLUMNS - DepartamentoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(HdeskGroupPeer::CA_IDDEPARTAMENT,), array(DepartamentoPeer::CA_IDDEPARTAMENTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = HdeskGroupPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = HdeskGroupPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = HdeskGroupPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				HdeskGroupPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = DepartamentoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = DepartamentoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = DepartamentoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					DepartamentoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addHdeskGroup($obj1);
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
		return HdeskGroupPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskGroupPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(HdeskGroupPeer::CA_IDGROUP) && $criteria->keyContainsValue(HdeskGroupPeer::CA_IDGROUP) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.HdeskGroupPeer::CA_IDGROUP.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseHdeskGroupPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(HdeskGroupPeer::CA_IDGROUP);
			$selectCriteria->add(HdeskGroupPeer::CA_IDGROUP, $criteria->remove(HdeskGroupPeer::CA_IDGROUP), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseHdeskGroupPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseHdeskGroupPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(HdeskGroupPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												HdeskGroupPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof HdeskGroup) {
						HdeskGroupPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HdeskGroupPeer::CA_IDGROUP, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								HdeskGroupPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(HdeskGroup $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HdeskGroupPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HdeskGroupPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HdeskGroupPeer::DATABASE_NAME, HdeskGroupPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HdeskGroupPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = HdeskGroupPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
		$criteria->add(HdeskGroupPeer::CA_IDGROUP, $pk);

		$v = HdeskGroupPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(HdeskGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(HdeskGroupPeer::DATABASE_NAME);
			$criteria->add(HdeskGroupPeer::CA_IDGROUP, $pks, Criteria::IN);
			$objs = HdeskGroupPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseHdeskGroupPeer::DATABASE_NAME)->addTableBuilder(BaseHdeskGroupPeer::TABLE_NAME, BaseHdeskGroupPeer::getMapBuilder());

