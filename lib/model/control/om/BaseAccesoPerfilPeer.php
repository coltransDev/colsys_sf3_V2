<?php


abstract class BaseAccesoPerfilPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'control.tb_accesos_perfiles';

	
	const CLASS_DEFAULT = 'lib.model.control.AccesoPerfil';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_RUTINA = 'control.tb_accesos_perfiles.CA_RUTINA';

	
	const CA_PERFIL = 'control.tb_accesos_perfiles.CA_PERFIL';

	
	const CA_ACCESO = 'control.tb_accesos_perfiles.CA_ACCESO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaRutina', 'CaPerfil', 'CaAcceso', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caRutina', 'caPerfil', 'caAcceso', ),
		BasePeer::TYPE_COLNAME => array (self::CA_RUTINA, self::CA_PERFIL, self::CA_ACCESO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_rutina', 'ca_perfil', 'ca_acceso', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaRutina' => 0, 'CaPerfil' => 1, 'CaAcceso' => 2, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caRutina' => 0, 'caPerfil' => 1, 'caAcceso' => 2, ),
		BasePeer::TYPE_COLNAME => array (self::CA_RUTINA => 0, self::CA_PERFIL => 1, self::CA_ACCESO => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_rutina' => 0, 'ca_perfil' => 1, 'ca_acceso' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AccesoPerfilMapBuilder();
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
		return str_replace(AccesoPerfilPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AccesoPerfilPeer::CA_RUTINA);

		$criteria->addSelectColumn(AccesoPerfilPeer::CA_PERFIL);

		$criteria->addSelectColumn(AccesoPerfilPeer::CA_ACCESO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AccesoPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AccesoPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $criteria, $con);
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
		$objects = AccesoPerfilPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AccesoPerfilPeer::populateObjects(AccesoPerfilPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AccesoPerfilPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(AccesoPerfil $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaRutina(), (string) $obj->getCaPerfil()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof AccesoPerfil) {
				$key = serialize(array((string) $value->getCaRutina(), (string) $value->getCaPerfil()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AccesoPerfil object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = AccesoPerfilPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AccesoPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AccesoPerfilPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AccesoPerfilPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinPerfil(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AccesoPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AccesoPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AccesoPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinPerfil(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AccesoPerfilPeer::addSelectColumns($c);
		$startcol = (AccesoPerfilPeer::NUM_COLUMNS - AccesoPerfilPeer::NUM_LAZY_LOAD_COLUMNS);
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(array(AccesoPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AccesoPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AccesoPerfilPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AccesoPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AccesoPerfilPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = PerfilPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PerfilPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PerfilPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PerfilPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAccesoPerfil($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AccesoPerfilPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AccesoPerfilPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AccesoPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AccesoPerfilPeer::addSelectColumns($c);
		$startcol2 = (AccesoPerfilPeer::NUM_COLUMNS - AccesoPerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		PerfilPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PerfilPeer::NUM_COLUMNS - PerfilPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AccesoPerfilPeer::CA_PERFIL,), array(PerfilPeer::CA_PERFIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AccesoPerfilPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AccesoPerfilPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AccesoPerfilPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AccesoPerfilPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = PerfilPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = PerfilPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PerfilPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PerfilPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAccesoPerfil($obj1);
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
		return AccesoPerfilPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAccesoPerfilPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAccesoPerfilPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AccesoPerfilPeer::CA_RUTINA);
			$selectCriteria->add(AccesoPerfilPeer::CA_RUTINA, $criteria->remove(AccesoPerfilPeer::CA_RUTINA), $comparison);

			$comparison = $criteria->getComparison(AccesoPerfilPeer::CA_PERFIL);
			$selectCriteria->add(AccesoPerfilPeer::CA_PERFIL, $criteria->remove(AccesoPerfilPeer::CA_PERFIL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAccesoPerfilPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAccesoPerfilPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AccesoPerfilPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AccesoPerfilPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof AccesoPerfil) {
						AccesoPerfilPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(AccesoPerfilPeer::CA_RUTINA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(AccesoPerfilPeer::CA_PERFIL, $value[1]));
				$criteria->addOr($criterion);

								AccesoPerfilPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(AccesoPerfil $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AccesoPerfilPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AccesoPerfilPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AccesoPerfilPeer::DATABASE_NAME, AccesoPerfilPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AccesoPerfilPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_rutina, $ca_perfil, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_rutina, (string) $ca_perfil));
 		if (null !== ($obj = AccesoPerfilPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(AccesoPerfilPeer::DATABASE_NAME);
		$criteria->add(AccesoPerfilPeer::CA_RUTINA, $ca_rutina);
		$criteria->add(AccesoPerfilPeer::CA_PERFIL, $ca_perfil);
		$v = AccesoPerfilPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseAccesoPerfilPeer::DATABASE_NAME)->addTableBuilder(BaseAccesoPerfilPeer::TABLE_NAME, BaseAccesoPerfilPeer::getMapBuilder());

