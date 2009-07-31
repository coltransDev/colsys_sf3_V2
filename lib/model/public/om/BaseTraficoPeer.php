<?php


abstract class BaseTraficoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_traficos';

	
	const CLASS_DEFAULT = 'lib.model.public.Trafico';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAFICO = 'tb_traficos.CA_IDTRAFICO';

	
	const CA_NOMBRE = 'tb_traficos.CA_NOMBRE';

	
	const CA_BANDERA = 'tb_traficos.CA_BANDERA';

	
	const CA_IDMONEDA = 'tb_traficos.CA_IDMONEDA';

	
	const CA_IDGRUPO = 'tb_traficos.CA_IDGRUPO';

	
	const CA_LINK = 'tb_traficos.CA_LINK';

	
	const CA_CONCEPTOS = 'tb_traficos.CA_CONCEPTOS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaNombre', 'CaBandera', 'CaIdmoneda', 'CaIdgrupo', 'CaLink', 'CaConceptos', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caNombre', 'caBandera', 'caIdmoneda', 'caIdgrupo', 'caLink', 'caConceptos', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_NOMBRE, self::CA_BANDERA, self::CA_IDMONEDA, self::CA_IDGRUPO, self::CA_LINK, self::CA_CONCEPTOS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_nombre', 'ca_bandera', 'ca_idmoneda', 'ca_idgrupo', 'ca_link', 'ca_conceptos', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaNombre' => 1, 'CaBandera' => 2, 'CaIdmoneda' => 3, 'CaIdgrupo' => 4, 'CaLink' => 5, 'CaConceptos' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caNombre' => 1, 'caBandera' => 2, 'caIdmoneda' => 3, 'caIdgrupo' => 4, 'caLink' => 5, 'caConceptos' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_NOMBRE => 1, self::CA_BANDERA => 2, self::CA_IDMONEDA => 3, self::CA_IDGRUPO => 4, self::CA_LINK => 5, self::CA_CONCEPTOS => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_nombre' => 1, 'ca_bandera' => 2, 'ca_idmoneda' => 3, 'ca_idgrupo' => 4, 'ca_link' => 5, 'ca_conceptos' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TraficoMapBuilder();
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
		return str_replace(TraficoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TraficoPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(TraficoPeer::CA_NOMBRE);

		$criteria->addSelectColumn(TraficoPeer::CA_BANDERA);

		$criteria->addSelectColumn(TraficoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(TraficoPeer::CA_IDGRUPO);

		$criteria->addSelectColumn(TraficoPeer::CA_LINK);

		$criteria->addSelectColumn(TraficoPeer::CA_CONCEPTOS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TraficoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TraficoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTraficoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $criteria, $con);
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
		$objects = TraficoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TraficoPeer::populateObjects(TraficoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTraficoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TraficoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Trafico $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdtrafico();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Trafico) {
				$key = (string) $value->getCaIdtrafico();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Trafico object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TraficoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TraficoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TraficoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TraficoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTraficoGrupo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TraficoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TraficoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TraficoPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTraficoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTraficoGrupo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseTraficoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TraficoPeer::addSelectColumns($c);
		$startcol = (TraficoPeer::NUM_COLUMNS - TraficoPeer::NUM_LAZY_LOAD_COLUMNS);
		TraficoGrupoPeer::addSelectColumns($c);

		$c->addJoin(array(TraficoPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TraficoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TraficoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TraficoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TraficoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TraficoGrupoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TraficoGrupoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TraficoGrupoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TraficoGrupoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrafico($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TraficoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TraficoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TraficoPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTraficoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTraficoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TraficoPeer::addSelectColumns($c);
		$startcol2 = (TraficoPeer::NUM_COLUMNS - TraficoPeer::NUM_LAZY_LOAD_COLUMNS);

		TraficoGrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TraficoGrupoPeer::NUM_COLUMNS - TraficoGrupoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(TraficoPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TraficoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TraficoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TraficoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TraficoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TraficoGrupoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TraficoGrupoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TraficoGrupoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TraficoGrupoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrafico($obj1);
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
		return TraficoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTraficoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTraficoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(TraficoPeer::CA_IDTRAFICO) && $criteria->keyContainsValue(TraficoPeer::CA_IDTRAFICO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.TraficoPeer::CA_IDTRAFICO.')');
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

		
    foreach (sfMixer::getCallables('BaseTraficoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTraficoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTraficoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TraficoPeer::CA_IDTRAFICO);
			$selectCriteria->add(TraficoPeer::CA_IDTRAFICO, $criteria->remove(TraficoPeer::CA_IDTRAFICO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTraficoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTraficoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TraficoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TraficoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Trafico) {
						TraficoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TraficoPeer::CA_IDTRAFICO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TraficoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Trafico $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TraficoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TraficoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TraficoPeer::DATABASE_NAME, TraficoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TraficoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TraficoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		$criteria->add(TraficoPeer::CA_IDTRAFICO, $pk);

		$v = TraficoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
			$criteria->add(TraficoPeer::CA_IDTRAFICO, $pks, Criteria::IN);
			$objs = TraficoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTraficoPeer::DATABASE_NAME)->addTableBuilder(BaseTraficoPeer::TABLE_NAME, BaseTraficoPeer::getMapBuilder());

