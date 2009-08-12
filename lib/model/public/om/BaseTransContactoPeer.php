<?php


abstract class BaseTransContactoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_transporcontac';

	
	const CLASS_DEFAULT = 'lib.model.public.TransContacto';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRANSPORTISTA = 'tb_transporcontac.CA_IDTRANSPORTISTA';

	
	const CA_IDCONTACTO = 'tb_transporcontac.CA_IDCONTACTO';

	
	const CA_NOMBRE = 'tb_transporcontac.CA_NOMBRE';

	
	const CA_TELEFONOS = 'tb_transporcontac.CA_TELEFONOS';

	
	const CA_FAX = 'tb_transporcontac.CA_FAX';

	
	const CA_EMAIL = 'tb_transporcontac.CA_EMAIL';

	
	const CA_OBSERVACIONES = 'tb_transporcontac.CA_OBSERVACIONES';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtransportista', 'CaIdcontacto', 'CaNombre', 'CaTelefonos', 'CaFax', 'CaEmail', 'CaObservaciones', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtransportista', 'caIdcontacto', 'caNombre', 'caTelefonos', 'caFax', 'caEmail', 'caObservaciones', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRANSPORTISTA, self::CA_IDCONTACTO, self::CA_NOMBRE, self::CA_TELEFONOS, self::CA_FAX, self::CA_EMAIL, self::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtransportista', 'ca_idcontacto', 'ca_nombre', 'ca_telefonos', 'ca_fax', 'ca_email', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtransportista' => 0, 'CaIdcontacto' => 1, 'CaNombre' => 2, 'CaTelefonos' => 3, 'CaFax' => 4, 'CaEmail' => 5, 'CaObservaciones' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtransportista' => 0, 'caIdcontacto' => 1, 'caNombre' => 2, 'caTelefonos' => 3, 'caFax' => 4, 'caEmail' => 5, 'caObservaciones' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRANSPORTISTA => 0, self::CA_IDCONTACTO => 1, self::CA_NOMBRE => 2, self::CA_TELEFONOS => 3, self::CA_FAX => 4, self::CA_EMAIL => 5, self::CA_OBSERVACIONES => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtransportista' => 0, 'ca_idcontacto' => 1, 'ca_nombre' => 2, 'ca_telefonos' => 3, 'ca_fax' => 4, 'ca_email' => 5, 'ca_observaciones' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TransContactoMapBuilder();
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
		return str_replace(TransContactoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TransContactoPeer::CA_IDTRANSPORTISTA);

		$criteria->addSelectColumn(TransContactoPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(TransContactoPeer::CA_NOMBRE);

		$criteria->addSelectColumn(TransContactoPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(TransContactoPeer::CA_FAX);

		$criteria->addSelectColumn(TransContactoPeer::CA_EMAIL);

		$criteria->addSelectColumn(TransContactoPeer::CA_OBSERVACIONES);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTransContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $criteria, $con);
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
		$objects = TransContactoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TransContactoPeer::populateObjects(TransContactoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TransContactoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(TransContacto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontacto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TransContacto) {
				$key = (string) $value->getCaIdcontacto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TransContacto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TransContactoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TransContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TransContactoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TransContactoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportista(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TransContactoPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTransContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTransportista(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransContactoPeer::addSelectColumns($c);
		$startcol = (TransContactoPeer::NUM_COLUMNS - TransContactoPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportistaPeer::addSelectColumns($c);

		$c->addJoin(array(TransContactoPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransContactoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TransContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportistaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportistaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportistaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportistaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransContacto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TransContactoPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransContactoPeer::addSelectColumns($c);
		$startcol2 = (TransContactoPeer::NUM_COLUMNS - TransContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportistaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportistaPeer::NUM_COLUMNS - TransportistaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(TransContactoPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransContactoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TransContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TransportistaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TransportistaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportistaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportistaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransContacto($obj1);
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
		return TransContactoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTransContactoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TransContactoPeer::CA_IDCONTACTO);
			$selectCriteria->add(TransContactoPeer::CA_IDCONTACTO, $criteria->remove(TransContactoPeer::CA_IDCONTACTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTransContactoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTransContactoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TransContactoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TransContactoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof TransContacto) {
						TransContactoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TransContactoPeer::CA_IDCONTACTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TransContactoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(TransContacto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TransContactoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TransContactoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TransContactoPeer::DATABASE_NAME, TransContactoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TransContactoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TransContactoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TransContactoPeer::DATABASE_NAME);
		$criteria->add(TransContactoPeer::CA_IDCONTACTO, $pk);

		$v = TransContactoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TransContactoPeer::DATABASE_NAME);
			$criteria->add(TransContactoPeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = TransContactoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTransContactoPeer::DATABASE_NAME)->addTableBuilder(BaseTransContactoPeer::TABLE_NAME, BaseTransContactoPeer::getMapBuilder());

