<?php


abstract class BaseRepExpoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_repexpo';

	
	const CLASS_DEFAULT = 'lib.model.reportes.RepExpo';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDREPORTE = 'tb_repexpo.CA_IDREPORTE';

	
	const CA_PESO = 'tb_repexpo.CA_PESO';

	
	const CA_VOLUMEN = 'tb_repexpo.CA_VOLUMEN';

	
	const CA_PIEZAS = 'tb_repexpo.CA_PIEZAS';

	
	const CA_DIMENSIONES = 'tb_repexpo.CA_DIMENSIONES';

	
	const CA_VALORCARGA = 'tb_repexpo.CA_VALORCARGA';

	
	const CA_ANTICIPO = 'tb_repexpo.CA_ANTICIPO';

	
	const CA_IDSIA = 'tb_repexpo.CA_IDSIA';

	
	const CA_TIPOEXPO = 'tb_repexpo.CA_TIPOEXPO';

	
	const CA_IDLINEATERRESTRE = 'tb_repexpo.CA_IDLINEATERRESTRE';

	
	const CA_MOTONAVE = 'tb_repexpo.CA_MOTONAVE';

	
	const CA_EMISIONBL = 'tb_repexpo.CA_EMISIONBL';

	
	const CA_DATOSBL = 'tb_repexpo.CA_DATOSBL';

	
	const CA_NUMBL = 'tb_repexpo.CA_NUMBL';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaPeso', 'CaVolumen', 'CaPiezas', 'CaDimensiones', 'CaValorcarga', 'CaAnticipo', 'CaIdsia', 'CaTipoexpo', 'CaIdlineaterrestre', 'CaMotonave', 'CaEmisionbl', 'CaDatosbl', 'CaNumbl', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte', 'caPeso', 'caVolumen', 'caPiezas', 'caDimensiones', 'caValorcarga', 'caAnticipo', 'caIdsia', 'caTipoexpo', 'caIdlineaterrestre', 'caMotonave', 'caEmisionbl', 'caDatosbl', 'caNumbl', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE, self::CA_PESO, self::CA_VOLUMEN, self::CA_PIEZAS, self::CA_DIMENSIONES, self::CA_VALORCARGA, self::CA_ANTICIPO, self::CA_IDSIA, self::CA_TIPOEXPO, self::CA_IDLINEATERRESTRE, self::CA_MOTONAVE, self::CA_EMISIONBL, self::CA_DATOSBL, self::CA_NUMBL, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_peso', 'ca_volumen', 'ca_piezas', 'ca_dimensiones', 'ca_valorcarga', 'ca_anticipo', 'ca_idsia', 'ca_tipoexpo', 'ca_idlineaterrestre', 'ca_motonave', 'ca_emisionbl', 'ca_datosbl', 'ca_numbl', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaPeso' => 1, 'CaVolumen' => 2, 'CaPiezas' => 3, 'CaDimensiones' => 4, 'CaValorcarga' => 5, 'CaAnticipo' => 6, 'CaIdsia' => 7, 'CaTipoexpo' => 8, 'CaIdlineaterrestre' => 9, 'CaMotonave' => 10, 'CaEmisionbl' => 11, 'CaDatosbl' => 12, 'CaNumbl' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte' => 0, 'caPeso' => 1, 'caVolumen' => 2, 'caPiezas' => 3, 'caDimensiones' => 4, 'caValorcarga' => 5, 'caAnticipo' => 6, 'caIdsia' => 7, 'caTipoexpo' => 8, 'caIdlineaterrestre' => 9, 'caMotonave' => 10, 'caEmisionbl' => 11, 'caDatosbl' => 12, 'caNumbl' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE => 0, self::CA_PESO => 1, self::CA_VOLUMEN => 2, self::CA_PIEZAS => 3, self::CA_DIMENSIONES => 4, self::CA_VALORCARGA => 5, self::CA_ANTICIPO => 6, self::CA_IDSIA => 7, self::CA_TIPOEXPO => 8, self::CA_IDLINEATERRESTRE => 9, self::CA_MOTONAVE => 10, self::CA_EMISIONBL => 11, self::CA_DATOSBL => 12, self::CA_NUMBL => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_peso' => 1, 'ca_volumen' => 2, 'ca_piezas' => 3, 'ca_dimensiones' => 4, 'ca_valorcarga' => 5, 'ca_anticipo' => 6, 'ca_idsia' => 7, 'ca_tipoexpo' => 8, 'ca_idlineaterrestre' => 9, 'ca_motonave' => 10, 'ca_emisionbl' => 11, 'ca_datosbl' => 12, 'ca_numbl' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RepExpoMapBuilder();
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
		return str_replace(RepExpoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepExpoPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepExpoPeer::CA_PESO);

		$criteria->addSelectColumn(RepExpoPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepExpoPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepExpoPeer::CA_DIMENSIONES);

		$criteria->addSelectColumn(RepExpoPeer::CA_VALORCARGA);

		$criteria->addSelectColumn(RepExpoPeer::CA_ANTICIPO);

		$criteria->addSelectColumn(RepExpoPeer::CA_IDSIA);

		$criteria->addSelectColumn(RepExpoPeer::CA_TIPOEXPO);

		$criteria->addSelectColumn(RepExpoPeer::CA_IDLINEATERRESTRE);

		$criteria->addSelectColumn(RepExpoPeer::CA_MOTONAVE);

		$criteria->addSelectColumn(RepExpoPeer::CA_EMISIONBL);

		$criteria->addSelectColumn(RepExpoPeer::CA_DATOSBL);

		$criteria->addSelectColumn(RepExpoPeer::CA_NUMBL);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepExpoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepExpoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRepExpoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $criteria, $con);
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
		$objects = RepExpoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RepExpoPeer::populateObjects(RepExpoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RepExpoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RepExpo $obj, $key = null)
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
			if (is_object($value) && $value instanceof RepExpo) {
				$key = (string) $value->getCaIdreporte();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RepExpo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RepExpoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RepExpoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RepExpoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RepExpoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepExpoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepExpoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepExpoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRepExpoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepExpoPeer::addSelectColumns($c);
		$startcol = (RepExpoPeer::NUM_COLUMNS - RepExpoPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(RepExpoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepExpoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepExpoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RepExpoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepExpoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->setRepExpo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RepExpoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RepExpoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RepExpoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepExpoPeer::addSelectColumns($c);
		$startcol2 = (RepExpoPeer::NUM_COLUMNS - RepExpoPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RepExpoPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RepExpoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RepExpoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RepExpoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RepExpoPeer::addInstanceToPool($obj1, $key1);
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
		return RepExpoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepExpoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseRepExpoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepExpoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RepExpoPeer::CA_IDREPORTE);
			$selectCriteria->add(RepExpoPeer::CA_IDREPORTE, $criteria->remove(RepExpoPeer::CA_IDREPORTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepExpoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepExpoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RepExpoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RepExpoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RepExpo) {
						RepExpoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepExpoPeer::CA_IDREPORTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								RepExpoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(RepExpo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepExpoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepExpoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepExpoPeer::DATABASE_NAME, RepExpoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepExpoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = RepExpoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);
		$criteria->add(RepExpoPeer::CA_IDREPORTE, $pk);

		$v = RepExpoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);
			$criteria->add(RepExpoPeer::CA_IDREPORTE, $pks, Criteria::IN);
			$objs = RepExpoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseRepExpoPeer::DATABASE_NAME)->addTableBuilder(BaseRepExpoPeer::TABLE_NAME, BaseRepExpoPeer::getMapBuilder());

