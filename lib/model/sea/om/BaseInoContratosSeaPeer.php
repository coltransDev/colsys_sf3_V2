<?php


abstract class BaseInoContratosSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inocontratos_sea';

	
	const CLASS_DEFAULT = 'lib.model.sea.InoContratosSea';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_inocontratos_sea.CA_REFERENCIA';

	
	const CA_IDEQUIPO = 'tb_inocontratos_sea.CA_IDEQUIPO';

	
	const CA_IDCONTRATO = 'tb_inocontratos_sea.CA_IDCONTRATO';

	
	const CA_FCHCONTRATO = 'tb_inocontratos_sea.CA_FCHCONTRATO';

	
	const CA_INSPECCION_NTA = 'tb_inocontratos_sea.CA_INSPECCION_NTA';

	
	const CA_INSPECCION_FCH = 'tb_inocontratos_sea.CA_INSPECCION_FCH';

	
	const CA_OBSERVACIONES = 'tb_inocontratos_sea.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_inocontratos_sea.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inocontratos_sea.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_inocontratos_sea.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inocontratos_sea.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdequipo', 'CaIdcontrato', 'CaFchcontrato', 'CaInspeccionNta', 'CaInspeccionFch', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdequipo', 'caIdcontrato', 'caFchcontrato', 'caInspeccionNta', 'caInspeccionFch', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDEQUIPO, self::CA_IDCONTRATO, self::CA_FCHCONTRATO, self::CA_INSPECCION_NTA, self::CA_INSPECCION_FCH, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idequipo', 'ca_idcontrato', 'ca_fchcontrato', 'ca_inspeccion_nta', 'ca_inspeccion_fch', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdequipo' => 1, 'CaIdcontrato' => 2, 'CaFchcontrato' => 3, 'CaInspeccionNta' => 4, 'CaInspeccionFch' => 5, 'CaObservaciones' => 6, 'CaFchcreado' => 7, 'CaUsucreado' => 8, 'CaFchactualizado' => 9, 'CaUsuactualizado' => 10, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdequipo' => 1, 'caIdcontrato' => 2, 'caFchcontrato' => 3, 'caInspeccionNta' => 4, 'caInspeccionFch' => 5, 'caObservaciones' => 6, 'caFchcreado' => 7, 'caUsucreado' => 8, 'caFchactualizado' => 9, 'caUsuactualizado' => 10, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDEQUIPO => 1, self::CA_IDCONTRATO => 2, self::CA_FCHCONTRATO => 3, self::CA_INSPECCION_NTA => 4, self::CA_INSPECCION_FCH => 5, self::CA_OBSERVACIONES => 6, self::CA_FCHCREADO => 7, self::CA_USUCREADO => 8, self::CA_FCHACTUALIZADO => 9, self::CA_USUACTUALIZADO => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idequipo' => 1, 'ca_idcontrato' => 2, 'ca_fchcontrato' => 3, 'ca_inspeccion_nta' => 4, 'ca_inspeccion_fch' => 5, 'ca_observaciones' => 6, 'ca_fchcreado' => 7, 'ca_usucreado' => 8, 'ca_fchactualizado' => 9, 'ca_usuactualizado' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoContratosSeaMapBuilder();
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
		return str_replace(InoContratosSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_IDEQUIPO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_IDCONTRATO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_FCHCONTRATO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_INSPECCION_NTA);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_INSPECCION_FCH);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoContratosSeaPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoContratosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoContratosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $criteria, $con);
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
		$objects = InoContratosSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoContratosSeaPeer::populateObjects(InoContratosSeaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoContratosSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoContratosSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdequipo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoContratosSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdequipo()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoContratosSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = InoContratosSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoContratosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoContratosSeaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoContratosSeaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinInoEquiposSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoContratosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoContratosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoContratosSeaPeer::CA_REFERENCIA,InoContratosSeaPeer::CA_IDEQUIPO,), array(InoEquiposSeaPeer::CA_REFERENCIA,InoEquiposSeaPeer::CA_IDEQUIPO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinInoEquiposSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoContratosSeaPeer::addSelectColumns($c);
		$startcol = (InoContratosSeaPeer::NUM_COLUMNS - InoContratosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoEquiposSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoContratosSeaPeer::CA_REFERENCIA,InoContratosSeaPeer::CA_IDEQUIPO,), array(InoEquiposSeaPeer::CA_REFERENCIA,InoEquiposSeaPeer::CA_IDEQUIPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoContratosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoContratosSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoContratosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoContratosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoEquiposSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoEquiposSeaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoEquiposSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setInoContratosSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoContratosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoContratosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoContratosSeaPeer::CA_REFERENCIA,InoContratosSeaPeer::CA_IDEQUIPO,), array(InoEquiposSeaPeer::CA_REFERENCIA,InoEquiposSeaPeer::CA_IDEQUIPO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoContratosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoContratosSeaPeer::NUM_COLUMNS - InoContratosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoContratosSeaPeer::CA_REFERENCIA,InoContratosSeaPeer::CA_IDEQUIPO,), array(InoEquiposSeaPeer::CA_REFERENCIA,InoEquiposSeaPeer::CA_IDEQUIPO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoContratosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoContratosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoContratosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoContratosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InoEquiposSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoEquiposSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoEquiposSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj1->setInoEquiposSea($obj2);
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
		return InoContratosSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoContratosSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoContratosSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoContratosSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoContratosSeaPeer::CA_REFERENCIA, $criteria->remove(InoContratosSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoContratosSeaPeer::CA_IDEQUIPO);
			$selectCriteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $criteria->remove(InoContratosSeaPeer::CA_IDEQUIPO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoContratosSeaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoContratosSeaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoContratosSeaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoContratosSeaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoContratosSea) {
						InoContratosSeaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoContratosSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoContratosSeaPeer::CA_IDEQUIPO, $value[1]));
				$criteria->addOr($criterion);

								InoContratosSeaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoContratosSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoContratosSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoContratosSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoContratosSeaPeer::DATABASE_NAME, InoContratosSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoContratosSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idequipo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idequipo));
 		if (null !== ($obj = InoContratosSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoContratosSeaPeer::DATABASE_NAME);
		$criteria->add(InoContratosSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $ca_idequipo);
		$v = InoContratosSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoContratosSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoContratosSeaPeer::TABLE_NAME, BaseInoContratosSeaPeer::getMapBuilder());

