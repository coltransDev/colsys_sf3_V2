<?php


abstract class BaseParametroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_parametros';

	
	const CLASS_DEFAULT = 'lib.model.public.Parametro';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_CASOUSO = 'tb_parametros.CA_CASOUSO';

	
	const CA_IDENTIFICACION = 'tb_parametros.CA_IDENTIFICACION';

	
	const CA_VALOR = 'tb_parametros.CA_VALOR';

	
	const CA_VALOR2 = 'tb_parametros.CA_VALOR2';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaCasouso', 'CaIdentificacion', 'CaValor', 'CaValor2', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caCasouso', 'caIdentificacion', 'caValor', 'caValor2', ),
		BasePeer::TYPE_COLNAME => array (self::CA_CASOUSO, self::CA_IDENTIFICACION, self::CA_VALOR, self::CA_VALOR2, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_casouso', 'ca_identificacion', 'ca_valor', 'ca_valor2', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaCasouso' => 0, 'CaIdentificacion' => 1, 'CaValor' => 2, 'CaValor2' => 3, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caCasouso' => 0, 'caIdentificacion' => 1, 'caValor' => 2, 'caValor2' => 3, ),
		BasePeer::TYPE_COLNAME => array (self::CA_CASOUSO => 0, self::CA_IDENTIFICACION => 1, self::CA_VALOR => 2, self::CA_VALOR2 => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_casouso' => 0, 'ca_identificacion' => 1, 'ca_valor' => 2, 'ca_valor2' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ParametroMapBuilder();
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
		return str_replace(ParametroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ParametroPeer::CA_CASOUSO);

		$criteria->addSelectColumn(ParametroPeer::CA_IDENTIFICACION);

		$criteria->addSelectColumn(ParametroPeer::CA_VALOR);

		$criteria->addSelectColumn(ParametroPeer::CA_VALOR2);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ParametroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ParametroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseParametroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseParametroPeer', $criteria, $con);
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
		$objects = ParametroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ParametroPeer::populateObjects(ParametroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseParametroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseParametroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ParametroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Parametro $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaCasouso(), (string) $obj->getCaIdentificacion(), (string) $obj->getCaValor()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Parametro) {
				$key = serialize(array((string) $value->getCaCasouso(), (string) $value->getCaIdentificacion(), (string) $value->getCaValor()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Parametro object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = ParametroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ParametroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ParametroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ParametroPeer::addInstanceToPool($obj, $key);
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
		return ParametroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseParametroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseParametroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ParametroPeer::CA_CASOUSO) && $criteria->keyContainsValue(ParametroPeer::CA_CASOUSO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ParametroPeer::CA_CASOUSO.')');
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

		
    foreach (sfMixer::getCallables('BaseParametroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseParametroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseParametroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseParametroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ParametroPeer::CA_CASOUSO);
			$selectCriteria->add(ParametroPeer::CA_CASOUSO, $criteria->remove(ParametroPeer::CA_CASOUSO), $comparison);

			$comparison = $criteria->getComparison(ParametroPeer::CA_IDENTIFICACION);
			$selectCriteria->add(ParametroPeer::CA_IDENTIFICACION, $criteria->remove(ParametroPeer::CA_IDENTIFICACION), $comparison);

			$comparison = $criteria->getComparison(ParametroPeer::CA_VALOR);
			$selectCriteria->add(ParametroPeer::CA_VALOR, $criteria->remove(ParametroPeer::CA_VALOR), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseParametroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseParametroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ParametroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ParametroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Parametro) {
						ParametroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(ParametroPeer::CA_CASOUSO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(ParametroPeer::CA_IDENTIFICACION, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(ParametroPeer::CA_VALOR, $value[2]));
				$criteria->addOr($criterion);

								ParametroPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(Parametro $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ParametroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ParametroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ParametroPeer::DATABASE_NAME, ParametroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ParametroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_casouso, $ca_identificacion, $ca_valor, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_casouso, (string) $ca_identificacion, (string) $ca_valor));
 		if (null !== ($obj = ParametroPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(ParametroPeer::DATABASE_NAME);
		$criteria->add(ParametroPeer::CA_CASOUSO, $ca_casouso);
		$criteria->add(ParametroPeer::CA_IDENTIFICACION, $ca_identificacion);
		$criteria->add(ParametroPeer::CA_VALOR, $ca_valor);
		$v = ParametroPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseParametroPeer::DATABASE_NAME)->addTableBuilder(BaseParametroPeer::TABLE_NAME, BaseParametroPeer::getMapBuilder());

