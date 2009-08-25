<?php


abstract class BaseFileHeaderPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_fileheader';

	
	const CLASS_DEFAULT = 'lib.model.dataimport.FileHeader';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDFILEHEADER = 'tb_fileheader.CA_IDFILEHEADER';

	
	const CA_DESCRIPCION = 'tb_fileheader.CA_DESCRIPCION';

	
	const CA_TIPOARCHIVO = 'tb_fileheader.CA_TIPOARCHIVO';

	
	const CA_SEPARADOR = 'tb_fileheader.CA_SEPARADOR';

	
	const CA_SEPARADORDEC = 'tb_fileheader.CA_SEPARADORDEC';

	
	const CA_FCHCREADO = 'tb_fileheader.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_fileheader.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_fileheader.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_fileheader.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader', 'CaDescripcion', 'CaTipoarchivo', 'CaSeparador', 'CaSeparadordec', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader', 'caDescripcion', 'caTipoarchivo', 'caSeparador', 'caSeparadordec', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER, self::CA_DESCRIPCION, self::CA_TIPOARCHIVO, self::CA_SEPARADOR, self::CA_SEPARADORDEC, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader', 'ca_descripcion', 'ca_tipoarchivo', 'ca_separador', 'ca_separadordec', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdfileheader' => 0, 'CaDescripcion' => 1, 'CaTipoarchivo' => 2, 'CaSeparador' => 3, 'CaSeparadordec' => 4, 'CaFchcreado' => 5, 'CaUsucreado' => 6, 'CaFchactualizado' => 7, 'CaUsuactualizado' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdfileheader' => 0, 'caDescripcion' => 1, 'caTipoarchivo' => 2, 'caSeparador' => 3, 'caSeparadordec' => 4, 'caFchcreado' => 5, 'caUsucreado' => 6, 'caFchactualizado' => 7, 'caUsuactualizado' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDFILEHEADER => 0, self::CA_DESCRIPCION => 1, self::CA_TIPOARCHIVO => 2, self::CA_SEPARADOR => 3, self::CA_SEPARADORDEC => 4, self::CA_FCHCREADO => 5, self::CA_USUCREADO => 6, self::CA_FCHACTUALIZADO => 7, self::CA_USUACTUALIZADO => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idfileheader' => 0, 'ca_descripcion' => 1, 'ca_tipoarchivo' => 2, 'ca_separador' => 3, 'ca_separadordec' => 4, 'ca_fchcreado' => 5, 'ca_usucreado' => 6, 'ca_fchactualizado' => 7, 'ca_usuactualizado' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FileHeaderMapBuilder();
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
		return str_replace(FileHeaderPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FileHeaderPeer::CA_IDFILEHEADER);

		$criteria->addSelectColumn(FileHeaderPeer::CA_DESCRIPCION);

		$criteria->addSelectColumn(FileHeaderPeer::CA_TIPOARCHIVO);

		$criteria->addSelectColumn(FileHeaderPeer::CA_SEPARADOR);

		$criteria->addSelectColumn(FileHeaderPeer::CA_SEPARADORDEC);

		$criteria->addSelectColumn(FileHeaderPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(FileHeaderPeer::CA_USUCREADO);

		$criteria->addSelectColumn(FileHeaderPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(FileHeaderPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FileHeaderPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FileHeaderPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFileHeaderPeer', $criteria, $con);
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
		$objects = FileHeaderPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FileHeaderPeer::populateObjects(FileHeaderPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFileHeaderPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FileHeaderPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(FileHeader $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdfileheader();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof FileHeader) {
				$key = (string) $value->getCaIdfileheader();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or FileHeader object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = FileHeaderPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FileHeaderPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FileHeaderPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FileHeaderPeer::addInstanceToPool($obj, $key);
			} 		}
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
		return FileHeaderPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileHeaderPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(FileHeaderPeer::CA_IDFILEHEADER) && $criteria->keyContainsValue(FileHeaderPeer::CA_IDFILEHEADER) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.FileHeaderPeer::CA_IDFILEHEADER.')');
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

		
    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFileHeaderPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFileHeaderPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FileHeaderPeer::CA_IDFILEHEADER);
			$selectCriteria->add(FileHeaderPeer::CA_IDFILEHEADER, $criteria->remove(FileHeaderPeer::CA_IDFILEHEADER), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFileHeaderPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFileHeaderPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FileHeaderPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FileHeaderPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof FileHeader) {
						FileHeaderPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								FileHeaderPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(FileHeader $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FileHeaderPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FileHeaderPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FileHeaderPeer::DATABASE_NAME, FileHeaderPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FileHeaderPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = FileHeaderPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
		$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $pk);

		$v = FileHeaderPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FileHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(FileHeaderPeer::DATABASE_NAME);
			$criteria->add(FileHeaderPeer::CA_IDFILEHEADER, $pks, Criteria::IN);
			$objs = FileHeaderPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseFileHeaderPeer::DATABASE_NAME)->addTableBuilder(BaseFileHeaderPeer::TABLE_NAME, BaseFileHeaderPeer::getMapBuilder());

