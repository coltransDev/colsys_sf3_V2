<?php


abstract class BaseIdsEvaluacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_evaluacion';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsEvaluacion';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDEVALUACION = 'ids.tb_evaluacion.CA_IDEVALUACION';

	
	const CA_ID = 'ids.tb_evaluacion.CA_ID';

	
	const CA_CONCEPTO = 'ids.tb_evaluacion.CA_CONCEPTO';

	
	const CA_TIPO = 'ids.tb_evaluacion.CA_TIPO';

	
	const CA_FCHEVALUACION = 'ids.tb_evaluacion.CA_FCHEVALUACION';

	
	const CA_FCHCREADO = 'ids.tb_evaluacion.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_evaluacion.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdevaluacion', 'CaId', 'CaConcepto', 'CaTipo', 'CaFchevaluacion', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdevaluacion', 'caId', 'caConcepto', 'caTipo', 'caFchevaluacion', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEVALUACION, self::CA_ID, self::CA_CONCEPTO, self::CA_TIPO, self::CA_FCHEVALUACION, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idevaluacion', 'ca_id', 'ca_concepto', 'ca_tipo', 'ca_fchevaluacion', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdevaluacion' => 0, 'CaId' => 1, 'CaConcepto' => 2, 'CaTipo' => 3, 'CaFchevaluacion' => 4, 'CaFchcreado' => 5, 'CaUsucreado' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdevaluacion' => 0, 'caId' => 1, 'caConcepto' => 2, 'caTipo' => 3, 'caFchevaluacion' => 4, 'caFchcreado' => 5, 'caUsucreado' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEVALUACION => 0, self::CA_ID => 1, self::CA_CONCEPTO => 2, self::CA_TIPO => 3, self::CA_FCHEVALUACION => 4, self::CA_FCHCREADO => 5, self::CA_USUCREADO => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idevaluacion' => 0, 'ca_id' => 1, 'ca_concepto' => 2, 'ca_tipo' => 3, 'ca_fchevaluacion' => 4, 'ca_fchcreado' => 5, 'ca_usucreado' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsEvaluacionMapBuilder();
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
		return str_replace(IdsEvaluacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_IDEVALUACION);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_ID);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_CONCEPTO);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_TIPO);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_FCHEVALUACION);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsEvaluacionPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $criteria, $con);
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
		$objects = IdsEvaluacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsEvaluacionPeer::populateObjects(IdsEvaluacionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsEvaluacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsEvaluacion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdevaluacion();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsEvaluacion) {
				$key = (string) $value->getCaIdevaluacion();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsEvaluacion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsEvaluacionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsEvaluacionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsEvaluacionPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsEvaluacionPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinIds(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionPeer::addSelectColumns($c);
		$startcol = (IdsEvaluacionPeer::NUM_COLUMNS - IdsEvaluacionPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsPeer::addSelectColumns($c);

		$c->addJoin(array(IdsEvaluacionPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsEvaluacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacion($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsEvaluacionPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionPeer::addSelectColumns($c);
		$startcol2 = (IdsEvaluacionPeer::NUM_COLUMNS - IdsEvaluacionPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsEvaluacionPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsEvaluacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = IdsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacion($obj1);
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
		return IdsEvaluacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsEvaluacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(IdsEvaluacionPeer::CA_IDEVALUACION) && $criteria->keyContainsValue(IdsEvaluacionPeer::CA_IDEVALUACION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.IdsEvaluacionPeer::CA_IDEVALUACION.')');
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

		
    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsEvaluacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsEvaluacionPeer::CA_IDEVALUACION);
			$selectCriteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, $criteria->remove(IdsEvaluacionPeer::CA_IDEVALUACION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsEvaluacionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsEvaluacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsEvaluacionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsEvaluacion) {
						IdsEvaluacionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsEvaluacionPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsEvaluacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsEvaluacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsEvaluacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsEvaluacionPeer::DATABASE_NAME, IdsEvaluacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsEvaluacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsEvaluacionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
		$criteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, $pk);

		$v = IdsEvaluacionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
			$criteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, $pks, Criteria::IN);
			$objs = IdsEvaluacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsEvaluacionPeer::DATABASE_NAME)->addTableBuilder(BaseIdsEvaluacionPeer::TABLE_NAME, BaseIdsEvaluacionPeer::getMapBuilder());

