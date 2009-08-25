<?php


abstract class BaseAduanaEventoExtraPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_brk_eventoextras';

	
	const CLASS_DEFAULT = 'lib.model.aduana.AduanaEventoExtra';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_brk_eventoextras.CA_REFERENCIA';

	
	const CA_IDEVENTO = 'tb_brk_eventoextras.CA_IDEVENTO';

	
	const CA_USUCREADO = 'tb_brk_eventoextras.CA_USUCREADO';

	
	const CA_FCHCREADO = 'tb_brk_eventoextras.CA_FCHCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_brk_eventoextras.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_brk_eventoextras.CA_USUACTUALIZADO';

	
	const CA_TEXTO = 'tb_brk_eventoextras.CA_TEXTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdevento', 'CaUsucreado', 'CaFchcreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaTexto', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdevento', 'caUsucreado', 'caFchcreado', 'caFchactualizado', 'caUsuactualizado', 'caTexto', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDEVENTO, self::CA_USUCREADO, self::CA_FCHCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_TEXTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idevento', 'ca_usucreado', 'ca_fchcreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_texto', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdevento' => 1, 'CaUsucreado' => 2, 'CaFchcreado' => 3, 'CaFchactualizado' => 4, 'CaUsuactualizado' => 5, 'CaTexto' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdevento' => 1, 'caUsucreado' => 2, 'caFchcreado' => 3, 'caFchactualizado' => 4, 'caUsuactualizado' => 5, 'caTexto' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDEVENTO => 1, self::CA_USUCREADO => 2, self::CA_FCHCREADO => 3, self::CA_FCHACTUALIZADO => 4, self::CA_USUACTUALIZADO => 5, self::CA_TEXTO => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idevento' => 1, 'ca_usucreado' => 2, 'ca_fchcreado' => 3, 'ca_fchactualizado' => 4, 'ca_usuactualizado' => 5, 'ca_texto' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AduanaEventoExtraMapBuilder();
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
		return str_replace(AduanaEventoExtraPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_IDEVENTO);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_USUCREADO);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(AduanaEventoExtraPeer::CA_TEXTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoExtraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoExtraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $criteria, $con);
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
		$objects = AduanaEventoExtraPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AduanaEventoExtraPeer::populateObjects(AduanaEventoExtraPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AduanaEventoExtraPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(AduanaEventoExtra $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdevento();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof AduanaEventoExtra) {
				$key = (string) $value->getCaIdevento();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AduanaEventoExtra object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 1] === null) {
			return null;
		}
		return (string) $row[$startcol + 1];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = AduanaEventoExtraPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AduanaEventoExtraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AduanaEventoExtraPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AduanaEventoExtraPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinAduanaMaestra(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoExtraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoExtraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaEventoExtraPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAduanaMaestra(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaEventoExtraPeer::addSelectColumns($c);
		$startcol = (AduanaEventoExtraPeer::NUM_COLUMNS - AduanaEventoExtraPeer::NUM_LAZY_LOAD_COLUMNS);
		AduanaMaestraPeer::addSelectColumns($c);

		$c->addJoin(array(AduanaEventoExtraPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaEventoExtraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaEventoExtraPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AduanaEventoExtraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaEventoExtraPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AduanaMaestraPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AduanaMaestraPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AduanaMaestraPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAduanaEventoExtra($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoExtraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoExtraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaEventoExtraPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaEventoExtraPeer::addSelectColumns($c);
		$startcol2 = (AduanaEventoExtraPeer::NUM_COLUMNS - AduanaEventoExtraPeer::NUM_LAZY_LOAD_COLUMNS);

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AduanaEventoExtraPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaEventoExtraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaEventoExtraPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AduanaEventoExtraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaEventoExtraPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = AduanaMaestraPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AduanaMaestraPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AduanaMaestraPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAduanaEventoExtra($obj1);
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
		return AduanaEventoExtraPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaEventoExtraPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaEventoExtraPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AduanaEventoExtraPeer::CA_IDEVENTO);
			$selectCriteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, $criteria->remove(AduanaEventoExtraPeer::CA_IDEVENTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAduanaEventoExtraPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoExtraPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AduanaEventoExtraPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AduanaEventoExtraPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof AduanaEventoExtra) {
						AduanaEventoExtraPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								AduanaEventoExtraPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(AduanaEventoExtra $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AduanaEventoExtraPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AduanaEventoExtraPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AduanaEventoExtraPeer::DATABASE_NAME, AduanaEventoExtraPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AduanaEventoExtraPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AduanaEventoExtraPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AduanaEventoExtraPeer::DATABASE_NAME);
		$criteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, $pk);

		$v = AduanaEventoExtraPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AduanaEventoExtraPeer::DATABASE_NAME);
			$criteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, $pks, Criteria::IN);
			$objs = AduanaEventoExtraPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseAduanaEventoExtraPeer::DATABASE_NAME)->addTableBuilder(BaseAduanaEventoExtraPeer::TABLE_NAME, BaseAduanaEventoExtraPeer::getMapBuilder());

