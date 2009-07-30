<?php


abstract class BaseIdsProveedorPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.ca_idproveedor';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsProveedor';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDPROVEEDOR = 'ids.ca_idproveedor.CA_IDPROVEEDOR';

	
	const CA_TIPO = 'ids.ca_idproveedor.CA_TIPO';

	
	const CA_CRITICO = 'ids.ca_idproveedor.CA_CRITICO';

	
	const CA_CONTROLADOPORSIG = 'ids.ca_idproveedor.CA_CONTROLADOPORSIG';

	
	const CA_FCHAPROBADO = 'ids.ca_idproveedor.CA_FCHAPROBADO';

	
	const CA_USUAPROBADO = 'ids.ca_idproveedor.CA_USUAPROBADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdproveedor', 'CaTipo', 'CaCritico', 'CaControladoporsig', 'CaFchaprobado', 'CaUsuaprobado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdproveedor', 'caTipo', 'caCritico', 'caControladoporsig', 'caFchaprobado', 'caUsuaprobado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPROVEEDOR, self::CA_TIPO, self::CA_CRITICO, self::CA_CONTROLADOPORSIG, self::CA_FCHAPROBADO, self::CA_USUAPROBADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idproveedor', 'ca_tipo', 'ca_critico', 'ca_controladoporsig', 'ca_fchaprobado', 'ca_usuaprobado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdproveedor' => 0, 'CaTipo' => 1, 'CaCritico' => 2, 'CaControladoporsig' => 3, 'CaFchaprobado' => 4, 'CaUsuaprobado' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdproveedor' => 0, 'caTipo' => 1, 'caCritico' => 2, 'caControladoporsig' => 3, 'caFchaprobado' => 4, 'caUsuaprobado' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPROVEEDOR => 0, self::CA_TIPO => 1, self::CA_CRITICO => 2, self::CA_CONTROLADOPORSIG => 3, self::CA_FCHAPROBADO => 4, self::CA_USUAPROBADO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idproveedor' => 0, 'ca_tipo' => 1, 'ca_critico' => 2, 'ca_controladoporsig' => 3, 'ca_fchaprobado' => 4, 'ca_usuaprobado' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsProveedorMapBuilder();
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
		return str_replace(IdsProveedorPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsProveedorPeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(IdsProveedorPeer::CA_TIPO);

		$criteria->addSelectColumn(IdsProveedorPeer::CA_CRITICO);

		$criteria->addSelectColumn(IdsProveedorPeer::CA_CONTROLADOPORSIG);

		$criteria->addSelectColumn(IdsProveedorPeer::CA_FCHAPROBADO);

		$criteria->addSelectColumn(IdsProveedorPeer::CA_USUAPROBADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsProveedorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsProveedorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $criteria, $con);
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
		$objects = IdsProveedorPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsProveedorPeer::populateObjects(IdsProveedorPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsProveedorPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsProveedor $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdproveedor();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsProveedor) {
				$key = (string) $value->getCaIdproveedor();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsProveedor object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsProveedorPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsProveedorPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsProveedorPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsProveedorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsProveedorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsProveedorPeer::CA_IDPROVEEDOR,), array(IdsPeer::CA_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsProveedorPeer::addSelectColumns($c);
		$startcol = (IdsProveedorPeer::NUM_COLUMNS - IdsProveedorPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsPeer::addSelectColumns($c);

		$c->addJoin(array(IdsProveedorPeer::CA_IDPROVEEDOR,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsProveedorPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsProveedorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsProveedorPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->setIdsProveedor($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsProveedorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsProveedorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsProveedorPeer::CA_IDPROVEEDOR,), array(IdsPeer::CA_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsProveedorPeer::addSelectColumns($c);
		$startcol2 = (IdsProveedorPeer::NUM_COLUMNS - IdsProveedorPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsProveedorPeer::CA_IDPROVEEDOR,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsProveedorPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsProveedorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsProveedorPeer::addInstanceToPool($obj1, $key1);
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
								$obj1->setIds($obj2);
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
		return IdsProveedorPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsProveedorPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsProveedorPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsProveedorPeer::CA_IDPROVEEDOR);
			$selectCriteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $criteria->remove(IdsProveedorPeer::CA_IDPROVEEDOR), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsProveedorPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsProveedorPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsProveedorPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsProveedorPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsProveedor) {
						IdsProveedorPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsProveedorPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsProveedor $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsProveedorPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsProveedorPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsProveedorPeer::DATABASE_NAME, IdsProveedorPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsProveedorPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsProveedorPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);
		$criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $pk);

		$v = IdsProveedorPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);
			$criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $pks, Criteria::IN);
			$objs = IdsProveedorPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsProveedorPeer::DATABASE_NAME)->addTableBuilder(BaseIdsProveedorPeer::TABLE_NAME, BaseIdsProveedorPeer::getMapBuilder());

