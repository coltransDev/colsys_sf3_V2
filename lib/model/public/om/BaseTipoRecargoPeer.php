<?php


abstract class BaseTipoRecargoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_tiporecargo';

	
	const CLASS_DEFAULT = 'lib.model.public.TipoRecargo';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDRECARGO = 'tb_tiporecargo.CA_IDRECARGO';

	
	const CA_RECARGO = 'tb_tiporecargo.CA_RECARGO';

	
	const CA_TIPO = 'tb_tiporecargo.CA_TIPO';

	
	const CA_TRANSPORTE = 'tb_tiporecargo.CA_TRANSPORTE';

	
	const CA_INCOTERMS = 'tb_tiporecargo.CA_INCOTERMS';

	
	const CA_REPORTE = 'tb_tiporecargo.CA_REPORTE';

	
	const CA_IMPOEXPO = 'tb_tiporecargo.CA_IMPOEXPO';

	
	const CA_APLICACION = 'tb_tiporecargo.CA_APLICACION';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdrecargo', 'CaRecargo', 'CaTipo', 'CaTransporte', 'CaIncoterms', 'CaReporte', 'CaImpoexpo', 'CaAplicacion', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdrecargo', 'caRecargo', 'caTipo', 'caTransporte', 'caIncoterms', 'caReporte', 'caImpoexpo', 'caAplicacion', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDRECARGO, self::CA_RECARGO, self::CA_TIPO, self::CA_TRANSPORTE, self::CA_INCOTERMS, self::CA_REPORTE, self::CA_IMPOEXPO, self::CA_APLICACION, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idrecargo', 'ca_recargo', 'ca_tipo', 'ca_transporte', 'ca_incoterms', 'ca_reporte', 'ca_impoexpo', 'ca_aplicacion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdrecargo' => 0, 'CaRecargo' => 1, 'CaTipo' => 2, 'CaTransporte' => 3, 'CaIncoterms' => 4, 'CaReporte' => 5, 'CaImpoexpo' => 6, 'CaAplicacion' => 7, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdrecargo' => 0, 'caRecargo' => 1, 'caTipo' => 2, 'caTransporte' => 3, 'caIncoterms' => 4, 'caReporte' => 5, 'caImpoexpo' => 6, 'caAplicacion' => 7, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDRECARGO => 0, self::CA_RECARGO => 1, self::CA_TIPO => 2, self::CA_TRANSPORTE => 3, self::CA_INCOTERMS => 4, self::CA_REPORTE => 5, self::CA_IMPOEXPO => 6, self::CA_APLICACION => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idrecargo' => 0, 'ca_recargo' => 1, 'ca_tipo' => 2, 'ca_transporte' => 3, 'ca_incoterms' => 4, 'ca_reporte' => 5, 'ca_impoexpo' => 6, 'ca_aplicacion' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TipoRecargoMapBuilder();
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
		return str_replace(TipoRecargoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TipoRecargoPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_RECARGO);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_TIPO);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_REPORTE);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(TipoRecargoPeer::CA_APLICACION);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TipoRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TipoRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTipoRecargoPeer', $criteria, $con);
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
		$objects = TipoRecargoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TipoRecargoPeer::populateObjects(TipoRecargoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTipoRecargoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TipoRecargoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(TipoRecargo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdrecargo();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TipoRecargo) {
				$key = (string) $value->getCaIdrecargo();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TipoRecargo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TipoRecargoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TipoRecargoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TipoRecargoPeer::addInstanceToPool($obj, $key);
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
		return TipoRecargoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTipoRecargoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(TipoRecargoPeer::CA_IDRECARGO) && $criteria->keyContainsValue(TipoRecargoPeer::CA_IDRECARGO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.TipoRecargoPeer::CA_IDRECARGO.')');
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

		
    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTipoRecargoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTipoRecargoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TipoRecargoPeer::CA_IDRECARGO);
			$selectCriteria->add(TipoRecargoPeer::CA_IDRECARGO, $criteria->remove(TipoRecargoPeer::CA_IDRECARGO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTipoRecargoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTipoRecargoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TipoRecargoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TipoRecargoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof TipoRecargo) {
						TipoRecargoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TipoRecargoPeer::CA_IDRECARGO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TipoRecargoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(TipoRecargo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TipoRecargoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TipoRecargoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TipoRecargoPeer::DATABASE_NAME, TipoRecargoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TipoRecargoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TipoRecargoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		$criteria->add(TipoRecargoPeer::CA_IDRECARGO, $pk);

		$v = TipoRecargoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
			$criteria->add(TipoRecargoPeer::CA_IDRECARGO, $pks, Criteria::IN);
			$objs = TipoRecargoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTipoRecargoPeer::DATABASE_NAME)->addTableBuilder(BaseTipoRecargoPeer::TABLE_NAME, BaseTipoRecargoPeer::getMapBuilder());

