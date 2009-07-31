<?php


abstract class BaseCostoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_costos';

	
	const CLASS_DEFAULT = 'lib.model.public.Costo';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCOSTO = 'tb_costos.CA_IDCOSTO';

	
	const CA_COSTO = 'tb_costos.CA_COSTO';

	
	const CA_TRANSPORTE = 'tb_costos.CA_TRANSPORTE';

	
	const CA_IMPOEXPO = 'tb_costos.CA_IMPOEXPO';

	
	const CA_MODALIDAD = 'tb_costos.CA_MODALIDAD';

	
	const CA_COMISIONABLE = 'tb_costos.CA_COMISIONABLE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcosto', 'CaCosto', 'CaTransporte', 'CaImpoexpo', 'CaModalidad', 'CaComisionable', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcosto', 'caCosto', 'caTransporte', 'caImpoexpo', 'caModalidad', 'caComisionable', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOSTO, self::CA_COSTO, self::CA_TRANSPORTE, self::CA_IMPOEXPO, self::CA_MODALIDAD, self::CA_COMISIONABLE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcosto', 'ca_costo', 'ca_transporte', 'ca_impoexpo', 'ca_modalidad', 'ca_comisionable', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcosto' => 0, 'CaCosto' => 1, 'CaTransporte' => 2, 'CaImpoexpo' => 3, 'CaModalidad' => 4, 'CaComisionable' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcosto' => 0, 'caCosto' => 1, 'caTransporte' => 2, 'caImpoexpo' => 3, 'caModalidad' => 4, 'caComisionable' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOSTO => 0, self::CA_COSTO => 1, self::CA_TRANSPORTE => 2, self::CA_IMPOEXPO => 3, self::CA_MODALIDAD => 4, self::CA_COMISIONABLE => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcosto' => 0, 'ca_costo' => 1, 'ca_transporte' => 2, 'ca_impoexpo' => 3, 'ca_modalidad' => 4, 'ca_comisionable' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CostoMapBuilder();
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
		return str_replace(CostoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CostoPeer::CA_IDCOSTO);

		$criteria->addSelectColumn(CostoPeer::CA_COSTO);

		$criteria->addSelectColumn(CostoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(CostoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(CostoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CostoPeer::CA_COMISIONABLE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CostoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CostoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCostoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCostoPeer', $criteria, $con);
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
		$objects = CostoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CostoPeer::populateObjects(CostoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCostoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCostoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CostoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Costo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcosto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Costo) {
				$key = (string) $value->getCaIdcosto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Costo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CostoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CostoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CostoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CostoPeer::addInstanceToPool($obj, $key);
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
		return CostoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCostoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCostoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CostoPeer::CA_IDCOSTO) && $criteria->keyContainsValue(CostoPeer::CA_IDCOSTO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CostoPeer::CA_IDCOSTO.')');
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

		
    foreach (sfMixer::getCallables('BaseCostoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCostoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCostoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCostoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CostoPeer::CA_IDCOSTO);
			$selectCriteria->add(CostoPeer::CA_IDCOSTO, $criteria->remove(CostoPeer::CA_IDCOSTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCostoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCostoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CostoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CostoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Costo) {
						CostoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CostoPeer::CA_IDCOSTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								CostoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Costo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CostoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CostoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CostoPeer::DATABASE_NAME, CostoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CostoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CostoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CostoPeer::DATABASE_NAME);
		$criteria->add(CostoPeer::CA_IDCOSTO, $pk);

		$v = CostoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CostoPeer::DATABASE_NAME);
			$criteria->add(CostoPeer::CA_IDCOSTO, $pks, Criteria::IN);
			$objs = CostoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseCostoPeer::DATABASE_NAME)->addTableBuilder(BaseCostoPeer::TABLE_NAME, BaseCostoPeer::getMapBuilder());

