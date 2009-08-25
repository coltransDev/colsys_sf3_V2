<?php


abstract class BaseFileImportedPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_fileimported';

	
	const CLASS_DEFAULT = 'lib.model.dataimport.FileImported';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDFILEHEADER = 'tb_fileimported.CA_IDFILEHEADER';

	
	const CA_FCHIMPORTACION = 'tb_fileimported.CA_FCHIMPORTACION';

	
	const CA_CONTENT = 'tb_fileimported.CA_CONTENT';

	
	const CA_USUARIO = 'tb_fileimported.CA_USUARIO';

	
	const CA_PROCESADO = 'tb_fileimported.CA_PROCESADO';

	
	const CA_NOMBRE = 'tb_fileimported.CA_NOMBRE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader', 'CaFchimportacion', 'CaContent', 'CaUsuario', 'CaProcesado', 'CaNombre', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader', 'caFchimportacion', 'caContent', 'caUsuario', 'caProcesado', 'caNombre', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER, self::CA_FCHIMPORTACION, self::CA_CONTENT, self::CA_USUARIO, self::CA_PROCESADO, self::CA_NOMBRE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader', 'ca_fchimportacion', 'ca_content', 'ca_usuario', 'ca_procesado', 'ca_nombre', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader' => 0, 'CaFchimportacion' => 1, 'CaContent' => 2, 'CaUsuario' => 3, 'CaProcesado' => 4, 'CaNombre' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader' => 0, 'caFchimportacion' => 1, 'caContent' => 2, 'caUsuario' => 3, 'caProcesado' => 4, 'caNombre' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER => 0, self::CA_FCHIMPORTACION => 1, self::CA_CONTENT => 2, self::CA_USUARIO => 3, self::CA_PROCESADO => 4, self::CA_NOMBRE => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader' => 0, 'ca_fchimportacion' => 1, 'ca_content' => 2, 'ca_usuario' => 3, 'ca_procesado' => 4, 'ca_nombre' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FileImportedMapBuilder();
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
		return str_replace(FileImportedPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FileImportedPeer::CA_IDFILEHEADER);

		$criteria->addSelectColumn(FileImportedPeer::CA_FCHIMPORTACION);

		$criteria->addSelectColumn(FileImportedPeer::CA_CONTENT);

		$criteria->addSelectColumn(FileImportedPeer::CA_USUARIO);

		$criteria->addSelectColumn(FileImportedPeer::CA_PROCESADO);

		$criteria->addSelectColumn(FileImportedPeer::CA_NOMBRE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileImportedPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileImportedPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFileImportedPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $criteria, $con);
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
		$objects = FileImportedPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FileImportedPeer::populateObjects(FileImportedPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FileImportedPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FileImported $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdfileheader(), (string) $obj->getCaFchimportacion(), (string) $obj->getCaNombre()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FileImported) {
				$key = serialize(array((string) $value->getCaIdfileheader(), (string) $value->getCaFchimportacion(), (string) $value->getCaNombre()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FileImported object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 5] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 5]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = FileImportedPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FileImportedPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FileImportedPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FileImportedPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFileHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileImportedPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileImportedPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FileImportedPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFileImportedPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinFileHeader(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileImportedPeer::addSelectColumns($c);
		$startcol = (FileImportedPeer::NUM_COLUMNS - FileImportedPeer::NUM_LAZY_LOAD_COLUMNS);
		FileHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FileImportedPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FileImportedPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FileImportedPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FileImportedPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FileImportedPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = FileHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FileHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FileHeaderPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FileHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFileImported($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileImportedPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileImportedPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FileImportedPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileImportedPeer::addSelectColumns($c);
		$startcol2 = (FileImportedPeer::NUM_COLUMNS - FileImportedPeer::NUM_LAZY_LOAD_COLUMNS);

		FileHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FileHeaderPeer::NUM_COLUMNS - FileHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FileImportedPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FileImportedPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FileImportedPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FileImportedPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FileImportedPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = FileHeaderPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FileHeaderPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FileHeaderPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FileHeaderPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFileImported($obj1);
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
		return FileImportedPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileImportedPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseFileImportedPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileImportedPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FileImportedPeer::CA_IDFILEHEADER);
			$selectCriteria->add(FileImportedPeer::CA_IDFILEHEADER, $criteria->remove(FileImportedPeer::CA_IDFILEHEADER), $comparison);

			$comparison = $criteria->getComparison(FileImportedPeer::CA_FCHIMPORTACION);
			$selectCriteria->add(FileImportedPeer::CA_FCHIMPORTACION, $criteria->remove(FileImportedPeer::CA_FCHIMPORTACION), $comparison);

			$comparison = $criteria->getComparison(FileImportedPeer::CA_NOMBRE);
			$selectCriteria->add(FileImportedPeer::CA_NOMBRE, $criteria->remove(FileImportedPeer::CA_NOMBRE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFileImportedPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFileImportedPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FileImportedPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FileImportedPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FileImported) {
						FileImportedPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(FileImportedPeer::CA_IDFILEHEADER, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(FileImportedPeer::CA_FCHIMPORTACION, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(FileImportedPeer::CA_NOMBRE, $value[2]));
				$criteria->addOr($criterion);

								FileImportedPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(FileImported $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FileImportedPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FileImportedPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FileImportedPeer::DATABASE_NAME, FileImportedPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FileImportedPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idfileheader, $ca_fchimportacion, $ca_nombre, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idfileheader, (string) $ca_fchimportacion, (string) $ca_nombre));
 		if (null !== ($obj = FileImportedPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(FileImportedPeer::DATABASE_NAME);
		$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $ca_idfileheader);
		$criteria->add(FileImportedPeer::CA_FCHIMPORTACION, $ca_fchimportacion);
		$criteria->add(FileImportedPeer::CA_NOMBRE, $ca_nombre);
		$v = FileImportedPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseFileImportedPeer::DATABASE_NAME)->addTableBuilder(BaseFileImportedPeer::TABLE_NAME, BaseFileImportedPeer::getMapBuilder());

