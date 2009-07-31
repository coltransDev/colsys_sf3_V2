<?php


abstract class BaseFalaInstructionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_falainstructions';

	
	const CLASS_DEFAULT = 'lib.model.falabella.FalaInstruction';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDDOC = 'tb_falainstructions.CA_IDDOC';

	
	const CA_INSTRUCTIONS = 'tb_falainstructions.CA_INSTRUCTIONS';

	
	const CA_IDFALAINSTRUCTIONS = 'tb_falainstructions.CA_IDFALAINSTRUCTIONS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc', 'CaInstructions', 'CaIdfalainstructions', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc', 'caInstructions', 'caIdfalainstructions', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC, self::CA_INSTRUCTIONS, self::CA_IDFALAINSTRUCTIONS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc', 'ca_instructions', 'ca_idfalainstructions', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIddoc' => 0, 'CaInstructions' => 1, 'CaIdfalainstructions' => 2, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIddoc' => 0, 'caInstructions' => 1, 'caIdfalainstructions' => 2, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDDOC => 0, self::CA_INSTRUCTIONS => 1, self::CA_IDFALAINSTRUCTIONS => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_iddoc' => 0, 'ca_instructions' => 1, 'ca_idfalainstructions' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FalaInstructionMapBuilder();
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
		return str_replace(FalaInstructionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FalaInstructionPeer::CA_IDDOC);

		$criteria->addSelectColumn(FalaInstructionPeer::CA_INSTRUCTIONS);

		$criteria->addSelectColumn(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaInstructionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaInstructionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $criteria, $con);
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
		$objects = FalaInstructionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FalaInstructionPeer::populateObjects(FalaInstructionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FalaInstructionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FalaInstruction $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdfalainstructions();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FalaInstruction) {
				$key = (string) $value->getCaIdfalainstructions();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FalaInstruction object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 2] === null) {
			return null;
		}
		return (string) $row[$startcol + 2];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = FalaInstructionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FalaInstructionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FalaInstructionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FalaInstructionPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFalaHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaInstructionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaInstructionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaInstructionPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaInstructionPeer::addSelectColumns($c);
		$startcol = (FalaInstructionPeer::NUM_COLUMNS - FalaInstructionPeer::NUM_LAZY_LOAD_COLUMNS);
		FalaHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FalaInstructionPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaInstructionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaInstructionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FalaInstructionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaInstructionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addFalaInstruction($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FalaInstructionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FalaInstructionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FalaInstructionPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FalaInstructionPeer::addSelectColumns($c);
		$startcol2 = (FalaInstructionPeer::NUM_COLUMNS - FalaInstructionPeer::NUM_LAZY_LOAD_COLUMNS);

		FalaHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FalaInstructionPeer::CA_IDDOC,), array(FalaHeaderPeer::CA_IDDOC,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FalaInstructionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FalaInstructionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FalaInstructionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FalaInstructionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addFalaInstruction($obj1);
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
		return FalaInstructionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaInstructionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFalaInstructionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS);
			$selectCriteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, $criteria->remove(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFalaInstructionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFalaInstructionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FalaInstructionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FalaInstructionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FalaInstruction) {
						FalaInstructionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								FalaInstructionPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(FalaInstruction $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FalaInstructionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FalaInstructionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FalaInstructionPeer::DATABASE_NAME, FalaInstructionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FalaInstructionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FalaInstructionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(FalaInstructionPeer::DATABASE_NAME);
		$criteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, $pk);

		$v = FalaInstructionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FalaInstructionPeer::DATABASE_NAME);
			$criteria->add(FalaInstructionPeer::CA_IDFALAINSTRUCTIONS, $pks, Criteria::IN);
			$objs = FalaInstructionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseFalaInstructionPeer::DATABASE_NAME)->addTableBuilder(BaseFalaInstructionPeer::TABLE_NAME, BaseFalaInstructionPeer::getMapBuilder());

