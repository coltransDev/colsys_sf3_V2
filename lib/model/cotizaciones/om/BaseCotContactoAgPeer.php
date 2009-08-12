<?php


abstract class BaseCotContactoAgPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotcontactosag';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotContactoAg';

	
	const NUM_COLUMNS = 2;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCOTIZACION = 'tb_cotcontactosag.CA_IDCOTIZACION';

	
	const CA_IDCONTACTO = 'tb_cotcontactosag.CA_IDCONTACTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdcontacto', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdcontacto', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDCONTACTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idcontacto', ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdcontacto' => 1, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdcontacto' => 1, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDCONTACTO => 1, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idcontacto' => 1, ),
		BasePeer::TYPE_NUM => array (0, 1, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotContactoAgMapBuilder();
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
		return str_replace(CotContactoAgPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotContactoAgPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotContactoAgPeer::CA_IDCONTACTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContactoAgPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContactoAgPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $criteria, $con);
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
		$objects = CotContactoAgPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotContactoAgPeer::populateObjects(CotContactoAgPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotContactoAgPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotContactoAg $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdcontacto()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotContactoAg) {
				$key = serialize(array((string) $value->getCaIdcotizacion(), (string) $value->getCaIdcontacto()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotContactoAg object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotContactoAgPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotContactoAgPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotContactoAgPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotContactoAgPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContactoAgPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContactoAgPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotContactoAgPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCotizacion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContactoAgPeer::addSelectColumns($c);
		$startcol = (CotContactoAgPeer::NUM_COLUMNS - CotContactoAgPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotContactoAgPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContactoAgPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContactoAgPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotContactoAgPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContactoAgPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CotizacionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotizacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotizacionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotizacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotContactoAg($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContactoAgPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContactoAgPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotContactoAgPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContactoAgPeer::addSelectColumns($c);
		$startcol2 = (CotContactoAgPeer::NUM_COLUMNS - CotContactoAgPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotContactoAgPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContactoAgPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContactoAgPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotContactoAgPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContactoAgPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CotizacionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotizacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotizacionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotizacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotContactoAg($obj1);
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
		return CotContactoAgPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotContactoAgPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotContactoAgPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotContactoAgPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $criteria->remove(CotContactoAgPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotContactoAgPeer::CA_IDCONTACTO);
			$selectCriteria->add(CotContactoAgPeer::CA_IDCONTACTO, $criteria->remove(CotContactoAgPeer::CA_IDCONTACTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotContactoAgPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotContactoAgPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotContactoAgPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotContactoAgPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotContactoAg) {
						CotContactoAgPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(CotContactoAgPeer::CA_IDCOTIZACION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotContactoAgPeer::CA_IDCONTACTO, $value[1]));
				$criteria->addOr($criterion);

								CotContactoAgPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(CotContactoAg $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotContactoAgPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotContactoAgPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotContactoAgPeer::DATABASE_NAME, CotContactoAgPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotContactoAgPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idcotizacion, $ca_idcontacto, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idcotizacion, (string) $ca_idcontacto));
 		if (null !== ($obj = CotContactoAgPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotContactoAgPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotContactoAgPeer::DATABASE_NAME);
		$criteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotContactoAgPeer::CA_IDCONTACTO, $ca_idcontacto);
		$v = CotContactoAgPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseCotContactoAgPeer::DATABASE_NAME)->addTableBuilder(BaseCotContactoAgPeer::TABLE_NAME, BaseCotContactoAgPeer::getMapBuilder());

