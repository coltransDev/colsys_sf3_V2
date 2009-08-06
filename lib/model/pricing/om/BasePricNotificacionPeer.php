<?php


abstract class BasePricNotificacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricnotificaciones';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricNotificacion';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDNOTIFICACION = 'tb_pricnotificaciones.CA_IDNOTIFICACION';

	
	const CA_TITULO = 'tb_pricnotificaciones.CA_TITULO';

	
	const CA_MENSAJE = 'tb_pricnotificaciones.CA_MENSAJE';

	
	const CA_CADUCIDAD = 'tb_pricnotificaciones.CA_CADUCIDAD';

	
	const CA_FCHCREADO = 'tb_pricnotificaciones.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricnotificaciones.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdnotificacion', 'CaTitulo', 'CaMensaje', 'CaCaducidad', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdnotificacion', 'caTitulo', 'caMensaje', 'caCaducidad', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDNOTIFICACION, self::CA_TITULO, self::CA_MENSAJE, self::CA_CADUCIDAD, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idnotificacion', 'ca_titulo', 'ca_mensaje', 'ca_caducidad', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdnotificacion' => 0, 'CaTitulo' => 1, 'CaMensaje' => 2, 'CaCaducidad' => 3, 'CaFchcreado' => 4, 'CaUsucreado' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdnotificacion' => 0, 'caTitulo' => 1, 'caMensaje' => 2, 'caCaducidad' => 3, 'caFchcreado' => 4, 'caUsucreado' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDNOTIFICACION => 0, self::CA_TITULO => 1, self::CA_MENSAJE => 2, self::CA_CADUCIDAD => 3, self::CA_FCHCREADO => 4, self::CA_USUCREADO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idnotificacion' => 0, 'ca_titulo' => 1, 'ca_mensaje' => 2, 'ca_caducidad' => 3, 'ca_fchcreado' => 4, 'ca_usucreado' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricNotificacionMapBuilder();
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
		return str_replace(PricNotificacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricNotificacionPeer::CA_IDNOTIFICACION);

		$criteria->addSelectColumn(PricNotificacionPeer::CA_TITULO);

		$criteria->addSelectColumn(PricNotificacionPeer::CA_MENSAJE);

		$criteria->addSelectColumn(PricNotificacionPeer::CA_CADUCIDAD);

		$criteria->addSelectColumn(PricNotificacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricNotificacionPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricNotificacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricNotificacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricNotificacionPeer', $criteria, $con);
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
		$objects = PricNotificacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricNotificacionPeer::populateObjects(PricNotificacionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricNotificacionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricNotificacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricNotificacion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdnotificacion();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricNotificacion) {
				$key = (string) $value->getCaIdnotificacion();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricNotificacion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = PricNotificacionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricNotificacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricNotificacionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricNotificacionPeer::addInstanceToPool($obj, $key);
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
		return PricNotificacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricNotificacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(PricNotificacionPeer::CA_IDNOTIFICACION) && $criteria->keyContainsValue(PricNotificacionPeer::CA_IDNOTIFICACION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.PricNotificacionPeer::CA_IDNOTIFICACION.')');
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

		
    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricNotificacionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricNotificacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricNotificacionPeer::CA_IDNOTIFICACION);
			$selectCriteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $criteria->remove(PricNotificacionPeer::CA_IDNOTIFICACION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricNotificacionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricNotificacionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricNotificacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricNotificacionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricNotificacion) {
						PricNotificacionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								PricNotificacionPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(PricNotificacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricNotificacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricNotificacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricNotificacionPeer::DATABASE_NAME, PricNotificacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricNotificacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PricNotificacionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);
		$criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $pk);

		$v = PricNotificacionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);
			$criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $pks, Criteria::IN);
			$objs = PricNotificacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasePricNotificacionPeer::DATABASE_NAME)->addTableBuilder(BasePricNotificacionPeer::TABLE_NAME, BasePricNotificacionPeer::getMapBuilder());

