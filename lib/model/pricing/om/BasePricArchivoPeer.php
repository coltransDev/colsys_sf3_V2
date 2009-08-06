<?php


abstract class BasePricArchivoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricarchivos';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricArchivo';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDARCHIVO = 'tb_pricarchivos.CA_IDARCHIVO';

	
	const CA_IDTRAFICO = 'tb_pricarchivos.CA_IDTRAFICO';

	
	const CA_NOMBRE = 'tb_pricarchivos.CA_NOMBRE';

	
	const CA_DESCRIPCION = 'tb_pricarchivos.CA_DESCRIPCION';

	
	const CA_TAMANO = 'tb_pricarchivos.CA_TAMANO';

	
	const CA_TIPO = 'tb_pricarchivos.CA_TIPO';

	
	const CA_FCHCREADO = 'tb_pricarchivos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricarchivos.CA_USUCREADO';

	
	const CA_DATOS = 'tb_pricarchivos.CA_DATOS';

	
	const CA_IMPOEXPO = 'tb_pricarchivos.CA_IMPOEXPO';

	
	const CA_TRANSPORTE = 'tb_pricarchivos.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_pricarchivos.CA_MODALIDAD';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdarchivo', 'CaIdtrafico', 'CaNombre', 'CaDescripcion', 'CaTamano', 'CaTipo', 'CaFchcreado', 'CaUsucreado', 'CaDatos', 'CaImpoexpo', 'CaTransporte', 'CaModalidad', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdarchivo', 'caIdtrafico', 'caNombre', 'caDescripcion', 'caTamano', 'caTipo', 'caFchcreado', 'caUsucreado', 'caDatos', 'caImpoexpo', 'caTransporte', 'caModalidad', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDARCHIVO, self::CA_IDTRAFICO, self::CA_NOMBRE, self::CA_DESCRIPCION, self::CA_TAMANO, self::CA_TIPO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_DATOS, self::CA_IMPOEXPO, self::CA_TRANSPORTE, self::CA_MODALIDAD, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idarchivo', 'ca_idtrafico', 'ca_nombre', 'ca_descripcion', 'ca_tamano', 'ca_tipo', 'ca_fchcreado', 'ca_usucreado', 'ca_datos', 'ca_impoexpo', 'ca_transporte', 'ca_modalidad', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdarchivo' => 0, 'CaIdtrafico' => 1, 'CaNombre' => 2, 'CaDescripcion' => 3, 'CaTamano' => 4, 'CaTipo' => 5, 'CaFchcreado' => 6, 'CaUsucreado' => 7, 'CaDatos' => 8, 'CaImpoexpo' => 9, 'CaTransporte' => 10, 'CaModalidad' => 11, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdarchivo' => 0, 'caIdtrafico' => 1, 'caNombre' => 2, 'caDescripcion' => 3, 'caTamano' => 4, 'caTipo' => 5, 'caFchcreado' => 6, 'caUsucreado' => 7, 'caDatos' => 8, 'caImpoexpo' => 9, 'caTransporte' => 10, 'caModalidad' => 11, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDARCHIVO => 0, self::CA_IDTRAFICO => 1, self::CA_NOMBRE => 2, self::CA_DESCRIPCION => 3, self::CA_TAMANO => 4, self::CA_TIPO => 5, self::CA_FCHCREADO => 6, self::CA_USUCREADO => 7, self::CA_DATOS => 8, self::CA_IMPOEXPO => 9, self::CA_TRANSPORTE => 10, self::CA_MODALIDAD => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idarchivo' => 0, 'ca_idtrafico' => 1, 'ca_nombre' => 2, 'ca_descripcion' => 3, 'ca_tamano' => 4, 'ca_tipo' => 5, 'ca_fchcreado' => 6, 'ca_usucreado' => 7, 'ca_datos' => 8, 'ca_impoexpo' => 9, 'ca_transporte' => 10, 'ca_modalidad' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricArchivoMapBuilder();
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
		return str_replace(PricArchivoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricArchivoPeer::CA_IDARCHIVO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_NOMBRE);

		$criteria->addSelectColumn(PricArchivoPeer::CA_DESCRIPCION);

		$criteria->addSelectColumn(PricArchivoPeer::CA_TAMANO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_TIPO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_DATOS);

		$criteria->addSelectColumn(PricArchivoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricArchivoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(PricArchivoPeer::CA_MODALIDAD);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $criteria, $con);
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
		$objects = PricArchivoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricArchivoPeer::populateObjects(PricArchivoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricArchivoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricArchivo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdarchivo();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricArchivo) {
				$key = (string) $value->getCaIdarchivo();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricArchivo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = PricArchivoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricArchivoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricArchivoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTrafico(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricArchivoPeer::CA_IDTRAFICO,), array(TraficoPeer::CA_IDTRAFICO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTrafico(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricArchivoPeer::addSelectColumns($c);
		$startcol = (PricArchivoPeer::NUM_COLUMNS - PricArchivoPeer::NUM_LAZY_LOAD_COLUMNS);
		TraficoPeer::addSelectColumns($c);

		$c->addJoin(array(PricArchivoPeer::CA_IDTRAFICO,), array(TraficoPeer::CA_IDTRAFICO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricArchivoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricArchivoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricArchivoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TraficoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TraficoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TraficoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TraficoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricArchivo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricArchivoPeer::CA_IDTRAFICO,), array(TraficoPeer::CA_IDTRAFICO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricArchivoPeer::addSelectColumns($c);
		$startcol2 = (PricArchivoPeer::NUM_COLUMNS - PricArchivoPeer::NUM_LAZY_LOAD_COLUMNS);

		TraficoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TraficoPeer::NUM_COLUMNS - TraficoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricArchivoPeer::CA_IDTRAFICO,), array(TraficoPeer::CA_IDTRAFICO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricArchivoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricArchivoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricArchivoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TraficoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TraficoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TraficoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TraficoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricArchivo($obj1);
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
		return PricArchivoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricArchivoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(PricArchivoPeer::CA_IDARCHIVO) && $criteria->keyContainsValue(PricArchivoPeer::CA_IDARCHIVO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.PricArchivoPeer::CA_IDARCHIVO.')');
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

		
    foreach (sfMixer::getCallables('BasePricArchivoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricArchivoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricArchivoPeer::CA_IDARCHIVO);
			$selectCriteria->add(PricArchivoPeer::CA_IDARCHIVO, $criteria->remove(PricArchivoPeer::CA_IDARCHIVO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricArchivoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricArchivoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricArchivoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricArchivoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricArchivo) {
						PricArchivoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricArchivoPeer::CA_IDARCHIVO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								PricArchivoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(PricArchivo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricArchivoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricArchivoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricArchivoPeer::DATABASE_NAME, PricArchivoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricArchivoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PricArchivoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PricArchivoPeer::DATABASE_NAME);
		$criteria->add(PricArchivoPeer::CA_IDARCHIVO, $pk);

		$v = PricArchivoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PricArchivoPeer::DATABASE_NAME);
			$criteria->add(PricArchivoPeer::CA_IDARCHIVO, $pks, Criteria::IN);
			$objs = PricArchivoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasePricArchivoPeer::DATABASE_NAME)->addTableBuilder(BasePricArchivoPeer::TABLE_NAME, BasePricArchivoPeer::getMapBuilder());

