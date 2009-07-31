<?php


abstract class BaseClienteStdPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_stdcliente';

	
	const CLASS_DEFAULT = 'lib.model.public.ClienteStd';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCLIENTE = 'tb_stdcliente.CA_IDCLIENTE';

	
	const CA_FCHESTADO = 'tb_stdcliente.CA_FCHESTADO';

	
	const CA_ESTADO = 'tb_stdcliente.CA_ESTADO';

	
	const CA_EMPRESA = 'tb_stdcliente.CA_EMPRESA';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente', 'CaFchestado', 'CaEstado', 'CaEmpresa', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente', 'caFchestado', 'caEstado', 'caEmpresa', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE, self::CA_FCHESTADO, self::CA_ESTADO, self::CA_EMPRESA, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente', 'ca_fchestado', 'ca_estado', 'ca_empresa', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente' => 0, 'CaFchestado' => 1, 'CaEstado' => 2, 'CaEmpresa' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente' => 0, 'caFchestado' => 1, 'caEstado' => 2, 'caEmpresa' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE => 0, self::CA_FCHESTADO => 1, self::CA_ESTADO => 2, self::CA_EMPRESA => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente' => 0, 'ca_fchestado' => 1, 'ca_estado' => 2, 'ca_empresa' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ClienteStdMapBuilder();
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
		return str_replace(ClienteStdPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClienteStdPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(ClienteStdPeer::CA_FCHESTADO);

		$criteria->addSelectColumn(ClienteStdPeer::CA_ESTADO);

		$criteria->addSelectColumn(ClienteStdPeer::CA_EMPRESA);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClienteStdPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClienteStdPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseClienteStdPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $criteria, $con);
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
		$objects = ClienteStdPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ClienteStdPeer::populateObjects(ClienteStdPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ClienteStdPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(ClienteStd $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdcliente(), (string) $obj->getCaFchestado(), (string) $obj->getCaEmpresa()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ClienteStd) {
				$key = serialize(array((string) $value->getCaIdcliente(), (string) $value->getCaFchestado(), (string) $value->getCaEmpresa()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ClienteStd object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 3]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = ClienteStdPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ClienteStdPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ClienteStdPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ClienteStdPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClienteStdPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClienteStdPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClienteStdPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseClienteStdPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClienteStdPeer::addSelectColumns($c);
		$startcol = (ClienteStdPeer::NUM_COLUMNS - ClienteStdPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(ClienteStdPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClienteStdPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClienteStdPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ClienteStdPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClienteStdPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addClienteStd($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClienteStdPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClienteStdPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClienteStdPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClienteStdPeer::addSelectColumns($c);
		$startcol2 = (ClienteStdPeer::NUM_COLUMNS - ClienteStdPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ClienteStdPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClienteStdPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClienteStdPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ClienteStdPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClienteStdPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addClienteStd($obj1);
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
		return ClienteStdPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseClienteStdPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseClienteStdPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseClienteStdPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ClienteStdPeer::CA_IDCLIENTE);
			$selectCriteria->add(ClienteStdPeer::CA_IDCLIENTE, $criteria->remove(ClienteStdPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(ClienteStdPeer::CA_FCHESTADO);
			$selectCriteria->add(ClienteStdPeer::CA_FCHESTADO, $criteria->remove(ClienteStdPeer::CA_FCHESTADO), $comparison);

			$comparison = $criteria->getComparison(ClienteStdPeer::CA_EMPRESA);
			$selectCriteria->add(ClienteStdPeer::CA_EMPRESA, $criteria->remove(ClienteStdPeer::CA_EMPRESA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseClienteStdPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseClienteStdPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ClienteStdPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ClienteStdPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof ClienteStd) {
						ClienteStdPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(ClienteStdPeer::CA_IDCLIENTE, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(ClienteStdPeer::CA_FCHESTADO, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(ClienteStdPeer::CA_EMPRESA, $value[2]));
				$criteria->addOr($criterion);

								ClienteStdPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(ClienteStd $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClienteStdPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClienteStdPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClienteStdPeer::DATABASE_NAME, ClienteStdPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClienteStdPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idcliente, $ca_fchestado, $ca_empresa, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idcliente, (string) $ca_fchestado, (string) $ca_empresa));
 		if (null !== ($obj = ClienteStdPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(ClienteStdPeer::DATABASE_NAME);
		$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(ClienteStdPeer::CA_FCHESTADO, $ca_fchestado);
		$criteria->add(ClienteStdPeer::CA_EMPRESA, $ca_empresa);
		$v = ClienteStdPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseClienteStdPeer::DATABASE_NAME)->addTableBuilder(BaseClienteStdPeer::TABLE_NAME, BaseClienteStdPeer::getMapBuilder());

