<?php


abstract class BaseFileColumnPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_filecolumns';

	
	const CLASS_DEFAULT = 'lib.model.dataimport.FileColumn';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDFILEHEADER = 'tb_filecolumns.CA_IDFILEHEADER';

	
	const CA_IDCOLUMNA = 'tb_filecolumns.CA_IDCOLUMNA';

	
	const CA_COLUMNA = 'tb_filecolumns.CA_COLUMNA';

	
	const CA_LABEL = 'tb_filecolumns.CA_LABEL';

	
	const CA_MASCARA = 'tb_filecolumns.CA_MASCARA';

	
	const CA_TIPO = 'tb_filecolumns.CA_TIPO';

	
	const CA_LONGITUD = 'tb_filecolumns.CA_LONGITUD';

	
	const CA_PRECISION = 'tb_filecolumns.CA_PRECISION';

	
	const CA_IDREGISTRO = 'tb_filecolumns.CA_IDREGISTRO';

	
	const CA_FCHCREADO = 'tb_filecolumns.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_filecolumns.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_filecolumns.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_filecolumns.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader', 'CaIdcolumna', 'CaColumna', 'CaLabel', 'CaMascara', 'CaTipo', 'CaLongitud', 'CaPrecision', 'CaIdregistro', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader', 'caIdcolumna', 'caColumna', 'caLabel', 'caMascara', 'caTipo', 'caLongitud', 'caPrecision', 'caIdregistro', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER, self::CA_IDCOLUMNA, self::CA_COLUMNA, self::CA_LABEL, self::CA_MASCARA, self::CA_TIPO, self::CA_LONGITUD, self::CA_PRECISION, self::CA_IDREGISTRO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader', 'ca_idcolumna', 'ca_columna', 'ca_label', 'ca_mascara', 'ca_tipo', 'ca_longitud', 'ca_precision', 'ca_idregistro', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader' => 0, 'CaIdcolumna' => 1, 'CaColumna' => 2, 'CaLabel' => 3, 'CaMascara' => 4, 'CaTipo' => 5, 'CaLongitud' => 6, 'CaPrecision' => 7, 'CaIdregistro' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader' => 0, 'caIdcolumna' => 1, 'caColumna' => 2, 'caLabel' => 3, 'caMascara' => 4, 'caTipo' => 5, 'caLongitud' => 6, 'caPrecision' => 7, 'caIdregistro' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, 'caFchactualizado' => 11, 'caUsuactualizado' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER => 0, self::CA_IDCOLUMNA => 1, self::CA_COLUMNA => 2, self::CA_LABEL => 3, self::CA_MASCARA => 4, self::CA_TIPO => 5, self::CA_LONGITUD => 6, self::CA_PRECISION => 7, self::CA_IDREGISTRO => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, self::CA_FCHACTUALIZADO => 11, self::CA_USUACTUALIZADO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader' => 0, 'ca_idcolumna' => 1, 'ca_columna' => 2, 'ca_label' => 3, 'ca_mascara' => 4, 'ca_tipo' => 5, 'ca_longitud' => 6, 'ca_precision' => 7, 'ca_idregistro' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FileColumnMapBuilder();
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
		return str_replace(FileColumnPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FileColumnPeer::CA_IDFILEHEADER);

		$criteria->addSelectColumn(FileColumnPeer::CA_IDCOLUMNA);

		$criteria->addSelectColumn(FileColumnPeer::CA_COLUMNA);

		$criteria->addSelectColumn(FileColumnPeer::CA_LABEL);

		$criteria->addSelectColumn(FileColumnPeer::CA_MASCARA);

		$criteria->addSelectColumn(FileColumnPeer::CA_TIPO);

		$criteria->addSelectColumn(FileColumnPeer::CA_LONGITUD);

		$criteria->addSelectColumn(FileColumnPeer::CA_PRECISION);

		$criteria->addSelectColumn(FileColumnPeer::CA_IDREGISTRO);

		$criteria->addSelectColumn(FileColumnPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(FileColumnPeer::CA_USUCREADO);

		$criteria->addSelectColumn(FileColumnPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(FileColumnPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileColumnPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileColumnPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFileColumnPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $criteria, $con);
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
		$objects = FileColumnPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FileColumnPeer::populateObjects(FileColumnPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FileColumnPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FileColumn $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcolumna();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FileColumn) {
				$key = (string) $value->getCaIdcolumna();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FileColumn object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = FileColumnPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FileColumnPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FileColumnPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FileColumnPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFileHeader(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileColumnPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileColumnPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FileColumnPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFileColumnPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileColumnPeer::addSelectColumns($c);
		$startcol = (FileColumnPeer::NUM_COLUMNS - FileColumnPeer::NUM_LAZY_LOAD_COLUMNS);
		FileHeaderPeer::addSelectColumns($c);

		$c->addJoin(array(FileColumnPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FileColumnPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FileColumnPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FileColumnPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FileColumnPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addFileColumn($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileColumnPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileColumnPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FileColumnPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FileColumnPeer::addSelectColumns($c);
		$startcol2 = (FileColumnPeer::NUM_COLUMNS - FileColumnPeer::NUM_LAZY_LOAD_COLUMNS);

		FileHeaderPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FileHeaderPeer::NUM_COLUMNS - FileHeaderPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FileColumnPeer::CA_IDFILEHEADER,), array(FileHeaderPeer::CA_IDFILEHEADER,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FileColumnPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FileColumnPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FileColumnPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FileColumnPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addFileColumn($obj1);
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
		return FileColumnPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileColumnPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(FileColumnPeer::CA_IDCOLUMNA) && $criteria->keyContainsValue(FileColumnPeer::CA_IDCOLUMNA) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.FileColumnPeer::CA_IDCOLUMNA.')');
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

		
    foreach (sfMixer::getCallables('BaseFileColumnPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileColumnPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FileColumnPeer::CA_IDCOLUMNA);
			$selectCriteria->add(FileColumnPeer::CA_IDCOLUMNA, $criteria->remove(FileColumnPeer::CA_IDCOLUMNA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFileColumnPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFileColumnPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FileColumnPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FileColumnPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FileColumn) {
						FileColumnPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FileColumnPeer::CA_IDCOLUMNA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								FileColumnPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(FileColumn $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FileColumnPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FileColumnPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FileColumnPeer::DATABASE_NAME, FileColumnPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FileColumnPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FileColumnPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);
		$criteria->add(FileColumnPeer::CA_IDCOLUMNA, $pk);

		$v = FileColumnPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FileColumnPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FileColumnPeer::DATABASE_NAME);
			$criteria->add(FileColumnPeer::CA_IDCOLUMNA, $pks, Criteria::IN);
			$objs = FileColumnPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseFileColumnPeer::DATABASE_NAME)->addTableBuilder(BaseFileColumnPeer::TABLE_NAME, BaseFileColumnPeer::getMapBuilder());

