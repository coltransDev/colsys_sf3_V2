<?php


abstract class BaseAduanaEventoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_brk_evento';

	
	const CLASS_DEFAULT = 'lib.model.aduana.AduanaEvento';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_brk_evento.CA_REFERENCIA';

	
	const CA_REALIZADO = 'tb_brk_evento.CA_REALIZADO';

	
	const CA_IDEVENTO = 'tb_brk_evento.CA_IDEVENTO';

	
	const CA_USUARIO = 'tb_brk_evento.CA_USUARIO';

	
	const CA_FCHEVENTO = 'tb_brk_evento.CA_FCHEVENTO';

	
	const CA_NOTAS = 'tb_brk_evento.CA_NOTAS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaRealizado', 'CaIdevento', 'CaUsuario', 'CaFchevento', 'CaNotas', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caRealizado', 'caIdevento', 'caUsuario', 'caFchevento', 'caNotas', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_REALIZADO, self::CA_IDEVENTO, self::CA_USUARIO, self::CA_FCHEVENTO, self::CA_NOTAS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_realizado', 'ca_idevento', 'ca_usuario', 'ca_fchevento', 'ca_notas', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaRealizado' => 1, 'CaIdevento' => 2, 'CaUsuario' => 3, 'CaFchevento' => 4, 'CaNotas' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caRealizado' => 1, 'caIdevento' => 2, 'caUsuario' => 3, 'caFchevento' => 4, 'caNotas' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_REALIZADO => 1, self::CA_IDEVENTO => 2, self::CA_USUARIO => 3, self::CA_FCHEVENTO => 4, self::CA_NOTAS => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_realizado' => 1, 'ca_idevento' => 2, 'ca_usuario' => 3, 'ca_fchevento' => 4, 'ca_notas' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AduanaEventoMapBuilder();
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
		return str_replace(AduanaEventoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AduanaEventoPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(AduanaEventoPeer::CA_REALIZADO);

		$criteria->addSelectColumn(AduanaEventoPeer::CA_IDEVENTO);

		$criteria->addSelectColumn(AduanaEventoPeer::CA_USUARIO);

		$criteria->addSelectColumn(AduanaEventoPeer::CA_FCHEVENTO);

		$criteria->addSelectColumn(AduanaEventoPeer::CA_NOTAS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $criteria, $con);
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
		$objects = AduanaEventoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AduanaEventoPeer::populateObjects(AduanaEventoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AduanaEventoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(AduanaEvento $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdevento()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof AduanaEvento) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdevento()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AduanaEvento object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 2]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = AduanaEventoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AduanaEventoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AduanaEventoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AduanaEventoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinAduanaMaestra(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaEventoPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaEventoPeer::addSelectColumns($c);
		$startcol = (AduanaEventoPeer::NUM_COLUMNS - AduanaEventoPeer::NUM_LAZY_LOAD_COLUMNS);
		AduanaMaestraPeer::addSelectColumns($c);

		$c->addJoin(array(AduanaEventoPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaEventoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaEventoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AduanaEventoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaEventoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAduanaEvento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaEventoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaEventoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaEventoPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaEventoPeer::addSelectColumns($c);
		$startcol2 = (AduanaEventoPeer::NUM_COLUMNS - AduanaEventoPeer::NUM_LAZY_LOAD_COLUMNS);

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AduanaEventoPeer::CA_REFERENCIA,), array(AduanaMaestraPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaEventoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaEventoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AduanaEventoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaEventoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAduanaEvento($obj1);
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
		return AduanaEventoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaEventoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaEventoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AduanaEventoPeer::CA_REFERENCIA);
			$selectCriteria->add(AduanaEventoPeer::CA_REFERENCIA, $criteria->remove(AduanaEventoPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(AduanaEventoPeer::CA_IDEVENTO);
			$selectCriteria->add(AduanaEventoPeer::CA_IDEVENTO, $criteria->remove(AduanaEventoPeer::CA_IDEVENTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAduanaEventoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaEventoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AduanaEventoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AduanaEventoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof AduanaEvento) {
						AduanaEventoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(AduanaEventoPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(AduanaEventoPeer::CA_IDEVENTO, $value[1]));
				$criteria->addOr($criterion);

								AduanaEventoPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(AduanaEvento $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AduanaEventoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AduanaEventoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AduanaEventoPeer::DATABASE_NAME, AduanaEventoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AduanaEventoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idevento, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idevento));
 		if (null !== ($obj = AduanaEventoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(AduanaEventoPeer::DATABASE_NAME);
		$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(AduanaEventoPeer::CA_IDEVENTO, $ca_idevento);
		$v = AduanaEventoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseAduanaEventoPeer::DATABASE_NAME)->addTableBuilder(BaseAduanaEventoPeer::TABLE_NAME, BaseAduanaEventoPeer::getMapBuilder());

