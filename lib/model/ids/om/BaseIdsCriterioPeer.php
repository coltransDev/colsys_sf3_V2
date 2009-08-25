<?php


abstract class BaseIdsCriterioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_criterios';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsCriterio';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCRITERIO = 'ids.tb_criterios.CA_IDCRITERIO';

	
	const CA_TIPO = 'ids.tb_criterios.CA_TIPO';

	
	const CA_TIPOCRITERIO = 'ids.tb_criterios.CA_TIPOCRITERIO';

	
	const CA_CRITERIO = 'ids.tb_criterios.CA_CRITERIO';

	
	const CA_ACTIVO = 'ids.tb_criterios.CA_ACTIVO';

	
	const CA_PONDERACION = 'ids.tb_criterios.CA_PONDERACION';

	
	const CA_FCHCREADO = 'ids.tb_criterios.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_criterios.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'ids.tb_criterios.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'ids.tb_criterios.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcriterio', 'CaTipo', 'CaTipocriterio', 'CaCriterio', 'CaActivo', 'CaPonderacion', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcriterio', 'caTipo', 'caTipocriterio', 'caCriterio', 'caActivo', 'caPonderacion', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCRITERIO, self::CA_TIPO, self::CA_TIPOCRITERIO, self::CA_CRITERIO, self::CA_ACTIVO, self::CA_PONDERACION, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcriterio', 'ca_tipo', 'ca_tipocriterio', 'ca_criterio', 'ca_activo', 'ca_ponderacion', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcriterio' => 0, 'CaTipo' => 1, 'CaTipocriterio' => 2, 'CaCriterio' => 3, 'CaActivo' => 4, 'CaPonderacion' => 5, 'CaFchcreado' => 6, 'CaUsucreado' => 7, 'CaFchactualizado' => 8, 'CaUsuactualizado' => 9, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcriterio' => 0, 'caTipo' => 1, 'caTipocriterio' => 2, 'caCriterio' => 3, 'caActivo' => 4, 'caPonderacion' => 5, 'caFchcreado' => 6, 'caUsucreado' => 7, 'caFchactualizado' => 8, 'caUsuactualizado' => 9, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCRITERIO => 0, self::CA_TIPO => 1, self::CA_TIPOCRITERIO => 2, self::CA_CRITERIO => 3, self::CA_ACTIVO => 4, self::CA_PONDERACION => 5, self::CA_FCHCREADO => 6, self::CA_USUCREADO => 7, self::CA_FCHACTUALIZADO => 8, self::CA_USUACTUALIZADO => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcriterio' => 0, 'ca_tipo' => 1, 'ca_tipocriterio' => 2, 'ca_criterio' => 3, 'ca_activo' => 4, 'ca_ponderacion' => 5, 'ca_fchcreado' => 6, 'ca_usucreado' => 7, 'ca_fchactualizado' => 8, 'ca_usuactualizado' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsCriterioMapBuilder();
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
		return str_replace(IdsCriterioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsCriterioPeer::CA_IDCRITERIO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_TIPO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_TIPOCRITERIO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_CRITERIO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_ACTIVO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_PONDERACION);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_USUCREADO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(IdsCriterioPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsCriterioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsCriterioPeer', $criteria, $con);
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
		$objects = IdsCriterioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsCriterioPeer::populateObjects(IdsCriterioPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsCriterioPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsCriterioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsCriterio $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcriterio();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsCriterio) {
				$key = (string) $value->getCaIdcriterio();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsCriterio object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsCriterioPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsCriterioPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsCriterioPeer::addInstanceToPool($obj, $key);
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
		return IdsCriterioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsCriterioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(IdsCriterioPeer::CA_IDCRITERIO) && $criteria->keyContainsValue(IdsCriterioPeer::CA_IDCRITERIO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.IdsCriterioPeer::CA_IDCRITERIO.')');
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

		
    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsCriterioPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsCriterioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsCriterioPeer::CA_IDCRITERIO);
			$selectCriteria->add(IdsCriterioPeer::CA_IDCRITERIO, $criteria->remove(IdsCriterioPeer::CA_IDCRITERIO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsCriterioPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsCriterioPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsCriterioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsCriterioPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsCriterio) {
						IdsCriterioPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsCriterioPeer::CA_IDCRITERIO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsCriterioPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsCriterio $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsCriterioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsCriterioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsCriterioPeer::DATABASE_NAME, IdsCriterioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsCriterioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsCriterioPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		$criteria->add(IdsCriterioPeer::CA_IDCRITERIO, $pk);

		$v = IdsCriterioPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
			$criteria->add(IdsCriterioPeer::CA_IDCRITERIO, $pks, Criteria::IN);
			$objs = IdsCriterioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsCriterioPeer::DATABASE_NAME)->addTableBuilder(BaseIdsCriterioPeer::TABLE_NAME, BaseIdsCriterioPeer::getMapBuilder());

