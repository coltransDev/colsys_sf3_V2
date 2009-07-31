<?php


abstract class BaseConceptoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_conceptos';

	
	const CLASS_DEFAULT = 'lib.model.public.Concepto';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCONCEPTO = 'tb_conceptos.CA_IDCONCEPTO';

	
	const CA_CONCEPTO = 'tb_conceptos.CA_CONCEPTO';

	
	const CA_UNIDAD = 'tb_conceptos.CA_UNIDAD';

	
	const CA_TRANSPORTE = 'tb_conceptos.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_conceptos.CA_MODALIDAD';

	
	const CA_LIMINFERIOR = 'tb_conceptos.CA_LIMINFERIOR';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdconcepto', 'CaConcepto', 'CaUnidad', 'CaTransporte', 'CaModalidad', 'CaLiminferior', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdconcepto', 'caConcepto', 'caUnidad', 'caTransporte', 'caModalidad', 'caLiminferior', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONCEPTO, self::CA_CONCEPTO, self::CA_UNIDAD, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_LIMINFERIOR, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idconcepto', 'ca_concepto', 'ca_unidad', 'ca_transporte', 'ca_modalidad', 'ca_liminferior', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdconcepto' => 0, 'CaConcepto' => 1, 'CaUnidad' => 2, 'CaTransporte' => 3, 'CaModalidad' => 4, 'CaLiminferior' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdconcepto' => 0, 'caConcepto' => 1, 'caUnidad' => 2, 'caTransporte' => 3, 'caModalidad' => 4, 'caLiminferior' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONCEPTO => 0, self::CA_CONCEPTO => 1, self::CA_UNIDAD => 2, self::CA_TRANSPORTE => 3, self::CA_MODALIDAD => 4, self::CA_LIMINFERIOR => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idconcepto' => 0, 'ca_concepto' => 1, 'ca_unidad' => 2, 'ca_transporte' => 3, 'ca_modalidad' => 4, 'ca_liminferior' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ConceptoMapBuilder();
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
		return str_replace(ConceptoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ConceptoPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(ConceptoPeer::CA_CONCEPTO);

		$criteria->addSelectColumn(ConceptoPeer::CA_UNIDAD);

		$criteria->addSelectColumn(ConceptoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(ConceptoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(ConceptoPeer::CA_LIMINFERIOR);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ConceptoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ConceptoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseConceptoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseConceptoPeer', $criteria, $con);
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
		$objects = ConceptoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ConceptoPeer::populateObjects(ConceptoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseConceptoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ConceptoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Concepto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdconcepto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Concepto) {
				$key = (string) $value->getCaIdconcepto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Concepto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = ConceptoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ConceptoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ConceptoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ConceptoPeer::addInstanceToPool($obj, $key);
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
		return ConceptoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ConceptoPeer::CA_IDCONCEPTO) && $criteria->keyContainsValue(ConceptoPeer::CA_IDCONCEPTO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ConceptoPeer::CA_IDCONCEPTO.')');
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

		
    foreach (sfMixer::getCallables('BaseConceptoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseConceptoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseConceptoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ConceptoPeer::CA_IDCONCEPTO);
			$selectCriteria->add(ConceptoPeer::CA_IDCONCEPTO, $criteria->remove(ConceptoPeer::CA_IDCONCEPTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseConceptoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseConceptoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ConceptoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ConceptoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Concepto) {
						ConceptoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ConceptoPeer::CA_IDCONCEPTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ConceptoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Concepto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ConceptoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ConceptoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ConceptoPeer::DATABASE_NAME, ConceptoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ConceptoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ConceptoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		$criteria->add(ConceptoPeer::CA_IDCONCEPTO, $pk);

		$v = ConceptoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
			$criteria->add(ConceptoPeer::CA_IDCONCEPTO, $pks, Criteria::IN);
			$objs = ConceptoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseConceptoPeer::DATABASE_NAME)->addTableBuilder(BaseConceptoPeer::TABLE_NAME, BaseConceptoPeer::getMapBuilder());

