<?php


abstract class BasePricSeguroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricseguros';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricSeguro';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDGRUPO = 'tb_pricseguros.CA_IDGRUPO';

	
	const CA_TRANSPORTE = 'tb_pricseguros.CA_TRANSPORTE';

	
	const CA_VLRPRIMA = 'tb_pricseguros.CA_VLRPRIMA';

	
	const CA_VLRMINIMA = 'tb_pricseguros.CA_VLRMINIMA';

	
	const CA_VLROBTENCIONPOLIZA = 'tb_pricseguros.CA_VLROBTENCIONPOLIZA';

	
	const CA_IDMONEDA = 'tb_pricseguros.CA_IDMONEDA';

	
	const CA_OBSERVACIONES = 'tb_pricseguros.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_pricseguros.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricseguros.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdgrupo', 'CaTransporte', 'CaVlrprima', 'CaVlrminima', 'CaVlrobtencionpoliza', 'CaIdmoneda', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdgrupo', 'caTransporte', 'caVlrprima', 'caVlrminima', 'caVlrobtencionpoliza', 'caIdmoneda', 'caObservaciones', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDGRUPO, self::CA_TRANSPORTE, self::CA_VLRPRIMA, self::CA_VLRMINIMA, self::CA_VLROBTENCIONPOLIZA, self::CA_IDMONEDA, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idgrupo', 'ca_transporte', 'ca_vlrprima', 'ca_vlrminima', 'ca_vlrobtencionpoliza', 'ca_idmoneda', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdgrupo' => 0, 'CaTransporte' => 1, 'CaVlrprima' => 2, 'CaVlrminima' => 3, 'CaVlrobtencionpoliza' => 4, 'CaIdmoneda' => 5, 'CaObservaciones' => 6, 'CaFchcreado' => 7, 'CaUsucreado' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdgrupo' => 0, 'caTransporte' => 1, 'caVlrprima' => 2, 'caVlrminima' => 3, 'caVlrobtencionpoliza' => 4, 'caIdmoneda' => 5, 'caObservaciones' => 6, 'caFchcreado' => 7, 'caUsucreado' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDGRUPO => 0, self::CA_TRANSPORTE => 1, self::CA_VLRPRIMA => 2, self::CA_VLRMINIMA => 3, self::CA_VLROBTENCIONPOLIZA => 4, self::CA_IDMONEDA => 5, self::CA_OBSERVACIONES => 6, self::CA_FCHCREADO => 7, self::CA_USUCREADO => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idgrupo' => 0, 'ca_transporte' => 1, 'ca_vlrprima' => 2, 'ca_vlrminima' => 3, 'ca_vlrobtencionpoliza' => 4, 'ca_idmoneda' => 5, 'ca_observaciones' => 6, 'ca_fchcreado' => 7, 'ca_usucreado' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricSeguroMapBuilder();
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
		return str_replace(PricSeguroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricSeguroPeer::CA_IDGRUPO);

		$criteria->addSelectColumn(PricSeguroPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(PricSeguroPeer::CA_VLRPRIMA);

		$criteria->addSelectColumn(PricSeguroPeer::CA_VLRMINIMA);

		$criteria->addSelectColumn(PricSeguroPeer::CA_VLROBTENCIONPOLIZA);

		$criteria->addSelectColumn(PricSeguroPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricSeguroPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricSeguroPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricSeguroPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $criteria, $con);
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
		$objects = PricSeguroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricSeguroPeer::populateObjects(PricSeguroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricSeguroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricSeguro $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdgrupo(), (string) $obj->getCaTransporte()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricSeguro) {
				$key = serialize(array((string) $value->getCaIdgrupo(), (string) $value->getCaTransporte()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricSeguro object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = PricSeguroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricSeguroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricSeguroPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTraficoGrupo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricSeguroPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricSeguroPeer::addSelectColumns($c);
		$startcol = (PricSeguroPeer::NUM_COLUMNS - PricSeguroPeer::NUM_LAZY_LOAD_COLUMNS);
		TraficoGrupoPeer::addSelectColumns($c);

		$c->addJoin(array(PricSeguroPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricSeguroPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricSeguroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricSeguro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricSeguroPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricSeguroPeer::addSelectColumns($c);
		$startcol2 = (PricSeguroPeer::NUM_COLUMNS - PricSeguroPeer::NUM_LAZY_LOAD_COLUMNS);

		TraficoGrupoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TraficoGrupoPeer::NUM_COLUMNS - TraficoGrupoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricSeguroPeer::CA_IDGRUPO,), array(TraficoGrupoPeer::CA_IDGRUPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricSeguroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricSeguroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricSeguro($obj1);
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
		return PricSeguroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricSeguroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricSeguroPeer::CA_IDGRUPO);
			$selectCriteria->add(PricSeguroPeer::CA_IDGRUPO, $criteria->remove(PricSeguroPeer::CA_IDGRUPO), $comparison);

			$comparison = $criteria->getComparison(PricSeguroPeer::CA_TRANSPORTE);
			$selectCriteria->add(PricSeguroPeer::CA_TRANSPORTE, $criteria->remove(PricSeguroPeer::CA_TRANSPORTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricSeguroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricSeguroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricSeguroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricSeguroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricSeguro) {
						PricSeguroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricSeguroPeer::CA_IDGRUPO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricSeguroPeer::CA_TRANSPORTE, $value[1]));
				$criteria->addOr($criterion);

								PricSeguroPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(PricSeguro $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricSeguroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricSeguroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricSeguroPeer::DATABASE_NAME, PricSeguroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricSeguroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idgrupo, $ca_transporte, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idgrupo, (string) $ca_transporte));
 		if (null !== ($obj = PricSeguroPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricSeguroPeer::DATABASE_NAME);
		$criteria->add(PricSeguroPeer::CA_IDGRUPO, $ca_idgrupo);
		$criteria->add(PricSeguroPeer::CA_TRANSPORTE, $ca_transporte);
		$v = PricSeguroPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BasePricSeguroPeer::DATABASE_NAME)->addTableBuilder(BasePricSeguroPeer::TABLE_NAME, BasePricSeguroPeer::getMapBuilder());

