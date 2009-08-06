<?php


abstract class BasePricRecargoParametroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricrecargosparametros';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargoParametro';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDLINEA = 'tb_pricrecargosparametros.CA_IDLINEA';

	
	const CA_TRANSPORTE = 'tb_pricrecargosparametros.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_pricrecargosparametros.CA_MODALIDAD';

	
	const CA_IMPOEXPO = 'tb_pricrecargosparametros.CA_IMPOEXPO';

	
	const CA_CONCEPTO = 'tb_pricrecargosparametros.CA_CONCEPTO';

	
	const CA_VALOR = 'tb_pricrecargosparametros.CA_VALOR';

	
	const CA_OBSERVACIONES = 'tb_pricrecargosparametros.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_pricrecargosparametros.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricrecargosparametros.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdlinea', 'CaTransporte', 'CaModalidad', 'CaImpoexpo', 'CaConcepto', 'CaValor', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdlinea', 'caTransporte', 'caModalidad', 'caImpoexpo', 'caConcepto', 'caValor', 'caObservaciones', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDLINEA, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_CONCEPTO, self::CA_VALOR, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idlinea', 'ca_transporte', 'ca_modalidad', 'ca_impoexpo', 'ca_concepto', 'ca_valor', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdlinea' => 0, 'CaTransporte' => 1, 'CaModalidad' => 2, 'CaImpoexpo' => 3, 'CaConcepto' => 4, 'CaValor' => 5, 'CaObservaciones' => 6, 'CaFchcreado' => 7, 'CaUsucreado' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdlinea' => 0, 'caTransporte' => 1, 'caModalidad' => 2, 'caImpoexpo' => 3, 'caConcepto' => 4, 'caValor' => 5, 'caObservaciones' => 6, 'caFchcreado' => 7, 'caUsucreado' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDLINEA => 0, self::CA_TRANSPORTE => 1, self::CA_MODALIDAD => 2, self::CA_IMPOEXPO => 3, self::CA_CONCEPTO => 4, self::CA_VALOR => 5, self::CA_OBSERVACIONES => 6, self::CA_FCHCREADO => 7, self::CA_USUCREADO => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idlinea' => 0, 'ca_transporte' => 1, 'ca_modalidad' => 2, 'ca_impoexpo' => 3, 'ca_concepto' => 4, 'ca_valor' => 5, 'ca_observaciones' => 6, 'ca_fchcreado' => 7, 'ca_usucreado' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargoParametroMapBuilder();
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
		return str_replace(PricRecargoParametroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_IDLINEA);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_CONCEPTO);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_VALOR);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargoParametroPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoParametroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoParametroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $criteria, $con);
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
		$objects = PricRecargoParametroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricRecargoParametroPeer::populateObjects(PricRecargoParametroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargoParametroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricRecargoParametro $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdlinea(), (string) $obj->getCaTransporte(), (string) $obj->getCaModalidad(), (string) $obj->getCaImpoexpo(), (string) $obj->getCaConcepto()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargoParametro) {
				$key = serialize(array((string) $value->getCaIdlinea(), (string) $value->getCaTransporte(), (string) $value->getCaModalidad(), (string) $value->getCaImpoexpo(), (string) $value->getCaConcepto()));
			} elseif (is_array($value) && count($value) === 5) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargoParametro object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = PricRecargoParametroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargoParametroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargoParametroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargoParametroPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoParametroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoParametroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoParametroPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoParametroPeer::addSelectColumns($c);
		$startcol = (PricRecargoParametroPeer::NUM_COLUMNS - PricRecargoParametroPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargoParametroPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoParametroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoParametroPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargoParametroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoParametroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargoParametro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoParametroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoParametroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoParametroPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoParametroPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoParametroPeer::NUM_COLUMNS - PricRecargoParametroPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargoParametroPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoParametroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoParametroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargoParametroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoParametroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargoParametro($obj1);
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
		return PricRecargoParametroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargoParametroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargoParametroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricRecargoParametroPeer::CA_IDLINEA);
			$selectCriteria->add(PricRecargoParametroPeer::CA_IDLINEA, $criteria->remove(PricRecargoParametroPeer::CA_IDLINEA), $comparison);

			$comparison = $criteria->getComparison(PricRecargoParametroPeer::CA_TRANSPORTE);
			$selectCriteria->add(PricRecargoParametroPeer::CA_TRANSPORTE, $criteria->remove(PricRecargoParametroPeer::CA_TRANSPORTE), $comparison);

			$comparison = $criteria->getComparison(PricRecargoParametroPeer::CA_MODALIDAD);
			$selectCriteria->add(PricRecargoParametroPeer::CA_MODALIDAD, $criteria->remove(PricRecargoParametroPeer::CA_MODALIDAD), $comparison);

			$comparison = $criteria->getComparison(PricRecargoParametroPeer::CA_IMPOEXPO);
			$selectCriteria->add(PricRecargoParametroPeer::CA_IMPOEXPO, $criteria->remove(PricRecargoParametroPeer::CA_IMPOEXPO), $comparison);

			$comparison = $criteria->getComparison(PricRecargoParametroPeer::CA_CONCEPTO);
			$selectCriteria->add(PricRecargoParametroPeer::CA_CONCEPTO, $criteria->remove(PricRecargoParametroPeer::CA_CONCEPTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricRecargoParametroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoParametroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargoParametroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricRecargoParametroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricRecargoParametro) {
						PricRecargoParametroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricRecargoParametroPeer::CA_IDLINEA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricRecargoParametroPeer::CA_TRANSPORTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargoParametroPeer::CA_MODALIDAD, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargoParametroPeer::CA_IMPOEXPO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargoParametroPeer::CA_CONCEPTO, $value[4]));
				$criteria->addOr($criterion);

								PricRecargoParametroPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(PricRecargoParametro $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargoParametroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargoParametroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargoParametroPeer::DATABASE_NAME, PricRecargoParametroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargoParametroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idlinea, $ca_transporte, $ca_modalidad, $ca_impoexpo, $ca_concepto, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idlinea, (string) $ca_transporte, (string) $ca_modalidad, (string) $ca_impoexpo, (string) $ca_concepto));
 		if (null !== ($obj = PricRecargoParametroPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricRecargoParametroPeer::DATABASE_NAME);
		$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $ca_idlinea);
		$criteria->add(PricRecargoParametroPeer::CA_TRANSPORTE, $ca_transporte);
		$criteria->add(PricRecargoParametroPeer::CA_MODALIDAD, $ca_modalidad);
		$criteria->add(PricRecargoParametroPeer::CA_IMPOEXPO, $ca_impoexpo);
		$criteria->add(PricRecargoParametroPeer::CA_CONCEPTO, $ca_concepto);
		$v = PricRecargoParametroPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BasePricRecargoParametroPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargoParametroPeer::TABLE_NAME, BasePricRecargoParametroPeer::getMapBuilder());

