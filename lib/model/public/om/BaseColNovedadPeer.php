<?php


abstract class BaseColNovedadPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_colnovedades';

	
	const CLASS_DEFAULT = 'lib.model.public.ColNovedad';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDNOVEDAD = 'tb_colnovedades.CA_IDNOVEDAD';

	
	const CA_FCHPUBLICACION = 'tb_colnovedades.CA_FCHPUBLICACION';

	
	const CA_ASUNTO = 'tb_colnovedades.CA_ASUNTO';

	
	const CA_DETALLE = 'tb_colnovedades.CA_DETALLE';

	
	const CA_FCHARCHIVAR = 'tb_colnovedades.CA_FCHARCHIVAR';

	
	const CA_EXTENSION = 'tb_colnovedades.CA_EXTENSION';

	
	const CA_HEADER_FILE = 'tb_colnovedades.CA_HEADER_FILE';

	
	const CA_CONTENT = 'tb_colnovedades.CA_CONTENT';

	
	const CA_FCHPUBLICADO = 'tb_colnovedades.CA_FCHPUBLICADO';

	
	const CA_USUPUBLICADO = 'tb_colnovedades.CA_USUPUBLICADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdnovedad', 'CaFchpublicacion', 'CaAsunto', 'CaDetalle', 'CaFcharchivar', 'CaExtension', 'CaHeaderFile', 'CaContent', 'CaFchpublicado', 'CaUsupublicado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdnovedad', 'caFchpublicacion', 'caAsunto', 'caDetalle', 'caFcharchivar', 'caExtension', 'caHeaderFile', 'caContent', 'caFchpublicado', 'caUsupublicado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDNOVEDAD, self::CA_FCHPUBLICACION, self::CA_ASUNTO, self::CA_DETALLE, self::CA_FCHARCHIVAR, self::CA_EXTENSION, self::CA_HEADER_FILE, self::CA_CONTENT, self::CA_FCHPUBLICADO, self::CA_USUPUBLICADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idnovedad', 'ca_fchpublicacion', 'ca_asunto', 'ca_detalle', 'ca_fcharchivar', 'ca_extension', 'ca_header_file', 'ca_content', 'ca_fchpublicado', 'ca_usupublicado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdnovedad' => 0, 'CaFchpublicacion' => 1, 'CaAsunto' => 2, 'CaDetalle' => 3, 'CaFcharchivar' => 4, 'CaExtension' => 5, 'CaHeaderFile' => 6, 'CaContent' => 7, 'CaFchpublicado' => 8, 'CaUsupublicado' => 9, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdnovedad' => 0, 'caFchpublicacion' => 1, 'caAsunto' => 2, 'caDetalle' => 3, 'caFcharchivar' => 4, 'caExtension' => 5, 'caHeaderFile' => 6, 'caContent' => 7, 'caFchpublicado' => 8, 'caUsupublicado' => 9, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDNOVEDAD => 0, self::CA_FCHPUBLICACION => 1, self::CA_ASUNTO => 2, self::CA_DETALLE => 3, self::CA_FCHARCHIVAR => 4, self::CA_EXTENSION => 5, self::CA_HEADER_FILE => 6, self::CA_CONTENT => 7, self::CA_FCHPUBLICADO => 8, self::CA_USUPUBLICADO => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idnovedad' => 0, 'ca_fchpublicacion' => 1, 'ca_asunto' => 2, 'ca_detalle' => 3, 'ca_fcharchivar' => 4, 'ca_extension' => 5, 'ca_header_file' => 6, 'ca_content' => 7, 'ca_fchpublicado' => 8, 'ca_usupublicado' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ColNovedadMapBuilder();
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
		return str_replace(ColNovedadPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ColNovedadPeer::CA_IDNOVEDAD);

		$criteria->addSelectColumn(ColNovedadPeer::CA_FCHPUBLICACION);

		$criteria->addSelectColumn(ColNovedadPeer::CA_ASUNTO);

		$criteria->addSelectColumn(ColNovedadPeer::CA_DETALLE);

		$criteria->addSelectColumn(ColNovedadPeer::CA_FCHARCHIVAR);

		$criteria->addSelectColumn(ColNovedadPeer::CA_EXTENSION);

		$criteria->addSelectColumn(ColNovedadPeer::CA_HEADER_FILE);

		$criteria->addSelectColumn(ColNovedadPeer::CA_CONTENT);

		$criteria->addSelectColumn(ColNovedadPeer::CA_FCHPUBLICADO);

		$criteria->addSelectColumn(ColNovedadPeer::CA_USUPUBLICADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ColNovedadPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ColNovedadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseColNovedadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseColNovedadPeer', $criteria, $con);
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
		$objects = ColNovedadPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ColNovedadPeer::populateObjects(ColNovedadPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseColNovedadPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseColNovedadPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ColNovedadPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(ColNovedad $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdnovedad();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ColNovedad) {
				$key = (string) $value->getCaIdnovedad();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ColNovedad object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = ColNovedadPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ColNovedadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ColNovedadPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ColNovedadPeer::addInstanceToPool($obj, $key);
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
		return ColNovedadPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseColNovedadPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseColNovedadPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ColNovedadPeer::CA_IDNOVEDAD) && $criteria->keyContainsValue(ColNovedadPeer::CA_IDNOVEDAD) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ColNovedadPeer::CA_IDNOVEDAD.')');
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

		
    foreach (sfMixer::getCallables('BaseColNovedadPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseColNovedadPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseColNovedadPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseColNovedadPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ColNovedadPeer::CA_IDNOVEDAD);
			$selectCriteria->add(ColNovedadPeer::CA_IDNOVEDAD, $criteria->remove(ColNovedadPeer::CA_IDNOVEDAD), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseColNovedadPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseColNovedadPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ColNovedadPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ColNovedadPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof ColNovedad) {
						ColNovedadPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ColNovedadPeer::CA_IDNOVEDAD, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ColNovedadPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(ColNovedad $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ColNovedadPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ColNovedadPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ColNovedadPeer::DATABASE_NAME, ColNovedadPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ColNovedadPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ColNovedadPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);
		$criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $pk);

		$v = ColNovedadPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);
			$criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $pks, Criteria::IN);
			$objs = ColNovedadPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseColNovedadPeer::DATABASE_NAME)->addTableBuilder(BaseColNovedadPeer::TABLE_NAME, BaseColNovedadPeer::getMapBuilder());

