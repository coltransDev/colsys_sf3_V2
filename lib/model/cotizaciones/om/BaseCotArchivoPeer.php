<?php


abstract class BaseCotArchivoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotarchivos';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotArchivo';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDARCHIVO = 'tb_cotarchivos.CA_IDARCHIVO';

	
	const CA_IDCOTIZACION = 'tb_cotarchivos.CA_IDCOTIZACION';

	
	const CA_NOMBRE = 'tb_cotarchivos.CA_NOMBRE';

	
	const CA_TAMANO = 'tb_cotarchivos.CA_TAMANO';

	
	const CA_TIPO = 'tb_cotarchivos.CA_TIPO';

	
	const CA_FCHCREADO = 'tb_cotarchivos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotarchivos.CA_USUCREADO';

	
	const CA_DATOS = 'tb_cotarchivos.CA_DATOS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdarchivo', 'CaIdcotizacion', 'CaNombre', 'CaTamano', 'CaTipo', 'CaFchcreado', 'CaUsucreado', 'CaDatos', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdarchivo', 'caIdcotizacion', 'caNombre', 'caTamano', 'caTipo', 'caFchcreado', 'caUsucreado', 'caDatos', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDARCHIVO, self::CA_IDCOTIZACION, self::CA_NOMBRE, self::CA_TAMANO, self::CA_TIPO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_DATOS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idarchivo', 'ca_idcotizacion', 'ca_nombre', 'ca_tamano', 'ca_tipo', 'ca_fchcreado', 'ca_usucreado', 'ca_datos', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdarchivo' => 0, 'CaIdcotizacion' => 1, 'CaNombre' => 2, 'CaTamano' => 3, 'CaTipo' => 4, 'CaFchcreado' => 5, 'CaUsucreado' => 6, 'CaDatos' => 7, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdarchivo' => 0, 'caIdcotizacion' => 1, 'caNombre' => 2, 'caTamano' => 3, 'caTipo' => 4, 'caFchcreado' => 5, 'caUsucreado' => 6, 'caDatos' => 7, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDARCHIVO => 0, self::CA_IDCOTIZACION => 1, self::CA_NOMBRE => 2, self::CA_TAMANO => 3, self::CA_TIPO => 4, self::CA_FCHCREADO => 5, self::CA_USUCREADO => 6, self::CA_DATOS => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idarchivo' => 0, 'ca_idcotizacion' => 1, 'ca_nombre' => 2, 'ca_tamano' => 3, 'ca_tipo' => 4, 'ca_fchcreado' => 5, 'ca_usucreado' => 6, 'ca_datos' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotArchivoMapBuilder();
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
		return str_replace(CotArchivoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotArchivoPeer::CA_IDARCHIVO);

		$criteria->addSelectColumn(CotArchivoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotArchivoPeer::CA_NOMBRE);

		$criteria->addSelectColumn(CotArchivoPeer::CA_TAMANO);

		$criteria->addSelectColumn(CotArchivoPeer::CA_TIPO);

		$criteria->addSelectColumn(CotArchivoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotArchivoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotArchivoPeer::CA_DATOS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $criteria, $con);
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
		$objects = CotArchivoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotArchivoPeer::populateObjects(CotArchivoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotArchivoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotArchivo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdarchivo();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotArchivo) {
				$key = (string) $value->getCaIdarchivo();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotArchivo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotArchivoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotArchivoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotArchivoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotArchivoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCotizacion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotArchivoPeer::addSelectColumns($c);
		$startcol = (CotArchivoPeer::NUM_COLUMNS - CotArchivoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotArchivoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotArchivoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotArchivoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotArchivoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CotizacionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotizacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotizacionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotizacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotArchivo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotArchivoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotArchivoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotArchivoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotArchivoPeer::addSelectColumns($c);
		$startcol2 = (CotArchivoPeer::NUM_COLUMNS - CotArchivoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotArchivoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotArchivoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotArchivoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotArchivoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotArchivoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CotizacionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotizacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotizacionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotizacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotArchivo($obj1);
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
		return CotArchivoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotArchivoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotArchivoPeer::CA_IDARCHIVO) && $criteria->keyContainsValue(CotArchivoPeer::CA_IDARCHIVO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotArchivoPeer::CA_IDARCHIVO.')');
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

		
    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotArchivoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotArchivoPeer::CA_IDARCHIVO);
			$selectCriteria->add(CotArchivoPeer::CA_IDARCHIVO, $criteria->remove(CotArchivoPeer::CA_IDARCHIVO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotArchivoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotArchivoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotArchivoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotArchivoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotArchivo) {
						CotArchivoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotArchivoPeer::CA_IDARCHIVO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								CotArchivoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(CotArchivo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotArchivoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotArchivoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotArchivoPeer::DATABASE_NAME, CotArchivoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotArchivoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CotArchivoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CotArchivoPeer::DATABASE_NAME);
		$criteria->add(CotArchivoPeer::CA_IDARCHIVO, $pk);

		$v = CotArchivoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CotArchivoPeer::DATABASE_NAME);
			$criteria->add(CotArchivoPeer::CA_IDARCHIVO, $pks, Criteria::IN);
			$objs = CotArchivoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseCotArchivoPeer::DATABASE_NAME)->addTableBuilder(BaseCotArchivoPeer::TABLE_NAME, BaseCotArchivoPeer::getMapBuilder());

