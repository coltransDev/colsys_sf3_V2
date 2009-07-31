<?php


abstract class BaseRepSeguroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repseguro';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepSeguro';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDREPORTE = 'tb_repseguro.CA_IDREPORTE';

	
	const CA_VLRASEGURADO = 'tb_repseguro.CA_VLRASEGURADO';

	
	const CA_IDMONEDA_VLR = 'tb_repseguro.CA_IDMONEDA_VLR';

	
	const CA_PRIMAVENTA = 'tb_repseguro.CA_PRIMAVENTA';

	
	const CA_MINIMAVENTA = 'tb_repseguro.CA_MINIMAVENTA';

	
	const CA_IDMONEDA_VTA = 'tb_repseguro.CA_IDMONEDA_VTA';

	
	const CA_OBTENCIONPOLIZA = 'tb_repseguro.CA_OBTENCIONPOLIZA';

	
	const CA_IDMONEDA_POL = 'tb_repseguro.CA_IDMONEDA_POL';

	
	const CA_SEGURO_CONF = 'tb_repseguro.CA_SEGURO_CONF';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaVlrasegurado', 'CaIdmonedaVlr', 'CaPrimaventa', 'CaMinimaventa', 'CaIdmonedaVta', 'CaObtencionpoliza', 'CaIdmonedaPol', 'CaSeguroConf', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte', 'caVlrasegurado', 'caIdmonedaVlr', 'caPrimaventa', 'caMinimaventa', 'caIdmonedaVta', 'caObtencionpoliza', 'caIdmonedaPol', 'caSeguroConf', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE, self::CA_VLRASEGURADO, self::CA_IDMONEDA_VLR, self::CA_PRIMAVENTA, self::CA_MINIMAVENTA, self::CA_IDMONEDA_VTA, self::CA_OBTENCIONPOLIZA, self::CA_IDMONEDA_POL, self::CA_SEGURO_CONF, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_vlrasegurado', 'ca_idmoneda_vlr', 'ca_primaventa', 'ca_minimaventa', 'ca_idmoneda_vta', 'ca_obtencionpoliza', 'ca_idmoneda_pol', 'ca_seguro_conf', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaVlrasegurado' => 1, 'CaIdmonedaVlr' => 2, 'CaPrimaventa' => 3, 'CaMinimaventa' => 4, 'CaIdmonedaVta' => 5, 'CaObtencionpoliza' => 6, 'CaIdmonedaPol' => 7, 'CaSeguroConf' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte' => 0, 'caVlrasegurado' => 1, 'caIdmonedaVlr' => 2, 'caPrimaventa' => 3, 'caMinimaventa' => 4, 'caIdmonedaVta' => 5, 'caObtencionpoliza' => 6, 'caIdmonedaPol' => 7, 'caSeguroConf' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE => 0, self::CA_VLRASEGURADO => 1, self::CA_IDMONEDA_VLR => 2, self::CA_PRIMAVENTA => 3, self::CA_MINIMAVENTA => 4, self::CA_IDMONEDA_VTA => 5, self::CA_OBTENCIONPOLIZA => 6, self::CA_IDMONEDA_POL => 7, self::CA_SEGURO_CONF => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_vlrasegurado' => 1, 'ca_idmoneda_vlr' => 2, 'ca_primaventa' => 3, 'ca_minimaventa' => 4, 'ca_idmoneda_vta' => 5, 'ca_obtencionpoliza' => 6, 'ca_idmoneda_pol' => 7, 'ca_seguro_conf' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepSeguroMapBuilder();
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
		return str_replace(RepSeguroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepSeguroPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepSeguroPeer::CA_VLRASEGURADO);

		$criteria->addSelectColumn(RepSeguroPeer::CA_IDMONEDA_VLR);

		$criteria->addSelectColumn(RepSeguroPeer::CA_PRIMAVENTA);

		$criteria->addSelectColumn(RepSeguroPeer::CA_MINIMAVENTA);

		$criteria->addSelectColumn(RepSeguroPeer::CA_IDMONEDA_VTA);

		$criteria->addSelectColumn(RepSeguroPeer::CA_OBTENCIONPOLIZA);

		$criteria->addSelectColumn(RepSeguroPeer::CA_IDMONEDA_POL);

		$criteria->addSelectColumn(RepSeguroPeer::CA_SEGURO_CONF);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $criteria, $con);
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
		$objects = RepSeguroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepSeguroPeer::populateObjects(RepSeguroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepSeguroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepSeguro $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdreporte();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RepSeguro) {
				$key = (string) $value->getCaIdreporte();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepSeguro object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RepSeguroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepSeguroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepSeguroPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepSeguroPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepSeguroPeer::addSelectColumns($c);
		$startcol = (RepSeguroPeer::NUM_COLUMNS - RepSeguroPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepSeguroPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepSeguroPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepSeguroPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->setRepSeguro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepSeguroPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepSeguroPeer::addSelectColumns($c);
		$startcol2 = (RepSeguroPeer::NUM_COLUMNS - RepSeguroPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepSeguroPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepSeguroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepSeguroPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj1->setReporte($obj2);
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
		return RepSeguroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepSeguroPeer::CA_IDREPORTE);
			$selectCriteria->add(RepSeguroPeer::CA_IDREPORTE, $criteria->remove(RepSeguroPeer::CA_IDREPORTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepSeguroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepSeguroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepSeguroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepSeguroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepSeguro) {
						RepSeguroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepSeguroPeer::CA_IDREPORTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepSeguroPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(RepSeguro $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepSeguroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepSeguroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepSeguroPeer::DATABASE_NAME, RepSeguroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepSeguroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepSeguroPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);
		$criteria->add(RepSeguroPeer::CA_IDREPORTE, $pk);

		$v = RepSeguroPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);
			$criteria->add(RepSeguroPeer::CA_IDREPORTE, $pks, Criteria::IN);
			$objs = RepSeguroPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepSeguroPeer::DATABASE_NAME)->addTableBuilder(BaseRepSeguroPeer::TABLE_NAME, BaseRepSeguroPeer::getMapBuilder());

