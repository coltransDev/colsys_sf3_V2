<?php


abstract class BaseIdsPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_ids';

	
	const CLASS_DEFAULT = 'lib.model.ids.Ids';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_ID = 'ids.tb_ids.CA_ID';

	
	const CA_DV = 'ids.tb_ids.CA_DV';

	
	const CA_IDALTERNO = 'ids.tb_ids.CA_IDALTERNO';

	
	const CA_TIPOIDENTIFICACION = 'ids.tb_ids.CA_TIPOIDENTIFICACION';

	
	const CA_IDGRUPO = 'ids.tb_ids.CA_IDGRUPO';

	
	const CA_NOMBRE = 'ids.tb_ids.CA_NOMBRE';

	
	const CA_WEBSITE = 'ids.tb_ids.CA_WEBSITE';

	
	const CA_ACTIVIDAD = 'ids.tb_ids.CA_ACTIVIDAD';

	
	const CA_SECTORECO = 'ids.tb_ids.CA_SECTORECO';

	
	const CA_FCHCREADO = 'ids.tb_ids.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_ids.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'ids.tb_ids.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'ids.tb_ids.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaId', 'CaDv', 'CaIdalterno', 'CaTipoidentificacion', 'CaIdgrupo', 'CaNombre', 'CaWebsite', 'CaActividad', 'CaSectoreco', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caId', 'caDv', 'caIdalterno', 'caTipoidentificacion', 'caIdgrupo', 'caNombre', 'caWebsite', 'caActividad', 'caSectoreco', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_ID, self::CA_DV, self::CA_IDALTERNO, self::CA_TIPOIDENTIFICACION, self::CA_IDGRUPO, self::CA_NOMBRE, self::CA_WEBSITE, self::CA_ACTIVIDAD, self::CA_SECTORECO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_id', 'ca_dv', 'ca_idalterno', 'ca_tipoidentificacion', 'ca_idgrupo', 'ca_nombre', 'ca_website', 'ca_actividad', 'ca_sectoreco', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaId' => 0, 'CaDv' => 1, 'CaIdalterno' => 2, 'CaTipoidentificacion' => 3, 'CaIdgrupo' => 4, 'CaNombre' => 5, 'CaWebsite' => 6, 'CaActividad' => 7, 'CaSectoreco' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caId' => 0, 'caDv' => 1, 'caIdalterno' => 2, 'caTipoidentificacion' => 3, 'caIdgrupo' => 4, 'caNombre' => 5, 'caWebsite' => 6, 'caActividad' => 7, 'caSectoreco' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, 'caFchactualizado' => 11, 'caUsuactualizado' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_ID => 0, self::CA_DV => 1, self::CA_IDALTERNO => 2, self::CA_TIPOIDENTIFICACION => 3, self::CA_IDGRUPO => 4, self::CA_NOMBRE => 5, self::CA_WEBSITE => 6, self::CA_ACTIVIDAD => 7, self::CA_SECTORECO => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, self::CA_FCHACTUALIZADO => 11, self::CA_USUACTUALIZADO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_id' => 0, 'ca_dv' => 1, 'ca_idalterno' => 2, 'ca_tipoidentificacion' => 3, 'ca_idgrupo' => 4, 'ca_nombre' => 5, 'ca_website' => 6, 'ca_actividad' => 7, 'ca_sectoreco' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsMapBuilder();
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
		return str_replace(IdsPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsPeer::CA_ID);

		$criteria->addSelectColumn(IdsPeer::CA_DV);

		$criteria->addSelectColumn(IdsPeer::CA_IDALTERNO);

		$criteria->addSelectColumn(IdsPeer::CA_TIPOIDENTIFICACION);

		$criteria->addSelectColumn(IdsPeer::CA_IDGRUPO);

		$criteria->addSelectColumn(IdsPeer::CA_NOMBRE);

		$criteria->addSelectColumn(IdsPeer::CA_WEBSITE);

		$criteria->addSelectColumn(IdsPeer::CA_ACTIVIDAD);

		$criteria->addSelectColumn(IdsPeer::CA_SECTORECO);

		$criteria->addSelectColumn(IdsPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsPeer::CA_USUCREADO);

		$criteria->addSelectColumn(IdsPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(IdsPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsPeer', $criteria, $con);
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
		$objects = IdsPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsPeer::populateObjects(IdsPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Ids $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaId();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Ids) {
				$key = (string) $value->getCaId();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Ids object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsPeer::addInstanceToPool($obj, $key);
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
		return IdsPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseIdsPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsPeer::CA_ID);
			$selectCriteria->add(IdsPeer::CA_ID, $criteria->remove(IdsPeer::CA_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Ids) {
						IdsPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsPeer::CA_ID, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Ids $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsPeer::DATABASE_NAME, IdsPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsPeer::DATABASE_NAME);
		$criteria->add(IdsPeer::CA_ID, $pk);

		$v = IdsPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsPeer::DATABASE_NAME);
			$criteria->add(IdsPeer::CA_ID, $pks, Criteria::IN);
			$objs = IdsPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsPeer::DATABASE_NAME)->addTableBuilder(BaseIdsPeer::TABLE_NAME, BaseIdsPeer::getMapBuilder());

