<?php


abstract class BaseRecargoFleteTrafPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_recargosxtraf';

	
	const CLASS_DEFAULT = 'lib.model.pricing.RecargoFleteTraf';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAFICO = 'tb_recargosxtraf.CA_IDTRAFICO';

	
	const CA_IDCIUDAD = 'tb_recargosxtraf.CA_IDCIUDAD';

	
	const CA_IDRECARGO = 'tb_recargosxtraf.CA_IDRECARGO';

	
	const CA_APLICACION = 'tb_recargosxtraf.CA_APLICACION';

	
	const CA_VLRFIJO = 'tb_recargosxtraf.CA_VLRFIJO';

	
	const CA_PORCENTAJE = 'tb_recargosxtraf.CA_PORCENTAJE';

	
	const CA_BASEPORCENTAJE = 'tb_recargosxtraf.CA_BASEPORCENTAJE';

	
	const CA_VLRUNITARIO = 'tb_recargosxtraf.CA_VLRUNITARIO';

	
	const CA_BASEUNITARIO = 'tb_recargosxtraf.CA_BASEUNITARIO';

	
	const CA_RECARGOMINIMO = 'tb_recargosxtraf.CA_RECARGOMINIMO';

	
	const CA_IDMONEDA = 'tb_recargosxtraf.CA_IDMONEDA';

	
	const CA_OBSERVACIONES = 'tb_recargosxtraf.CA_OBSERVACIONES';

	
	const CA_FCHINICIO = 'tb_recargosxtraf.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'tb_recargosxtraf.CA_FCHVENCIMIENTO';

	
	const CA_MODALIDAD = 'tb_recargosxtraf.CA_MODALIDAD';

	
	const CA_IMPOEXPO = 'tb_recargosxtraf.CA_IMPOEXPO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdciudad', 'CaIdrecargo', 'CaAplicacion', 'CaVlrfijo', 'CaPorcentaje', 'CaBaseporcentaje', 'CaVlrunitario', 'CaBaseunitario', 'CaRecargominimo', 'CaIdmoneda', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaModalidad', 'CaImpoexpo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caIdciudad', 'caIdrecargo', 'caAplicacion', 'caVlrfijo', 'caPorcentaje', 'caBaseporcentaje', 'caVlrunitario', 'caBaseunitario', 'caRecargominimo', 'caIdmoneda', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caModalidad', 'caImpoexpo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_IDCIUDAD, self::CA_IDRECARGO, self::CA_APLICACION, self::CA_VLRFIJO, self::CA_PORCENTAJE, self::CA_BASEPORCENTAJE, self::CA_VLRUNITARIO, self::CA_BASEUNITARIO, self::CA_RECARGOMINIMO, self::CA_IDMONEDA, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_MODALIDAD, self::CA_IMPOEXPO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idciudad', 'ca_idrecargo', 'ca_aplicacion', 'ca_vlrfijo', 'ca_porcentaje', 'ca_baseporcentaje', 'ca_vlrunitario', 'ca_baseunitario', 'ca_recargominimo', 'ca_idmoneda', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_modalidad', 'ca_impoexpo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdciudad' => 1, 'CaIdrecargo' => 2, 'CaAplicacion' => 3, 'CaVlrfijo' => 4, 'CaPorcentaje' => 5, 'CaBaseporcentaje' => 6, 'CaVlrunitario' => 7, 'CaBaseunitario' => 8, 'CaRecargominimo' => 9, 'CaIdmoneda' => 10, 'CaObservaciones' => 11, 'CaFchinicio' => 12, 'CaFchvencimiento' => 13, 'CaModalidad' => 14, 'CaImpoexpo' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caIdciudad' => 1, 'caIdrecargo' => 2, 'caAplicacion' => 3, 'caVlrfijo' => 4, 'caPorcentaje' => 5, 'caBaseporcentaje' => 6, 'caVlrunitario' => 7, 'caBaseunitario' => 8, 'caRecargominimo' => 9, 'caIdmoneda' => 10, 'caObservaciones' => 11, 'caFchinicio' => 12, 'caFchvencimiento' => 13, 'caModalidad' => 14, 'caImpoexpo' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_IDCIUDAD => 1, self::CA_IDRECARGO => 2, self::CA_APLICACION => 3, self::CA_VLRFIJO => 4, self::CA_PORCENTAJE => 5, self::CA_BASEPORCENTAJE => 6, self::CA_VLRUNITARIO => 7, self::CA_BASEUNITARIO => 8, self::CA_RECARGOMINIMO => 9, self::CA_IDMONEDA => 10, self::CA_OBSERVACIONES => 11, self::CA_FCHINICIO => 12, self::CA_FCHVENCIMIENTO => 13, self::CA_MODALIDAD => 14, self::CA_IMPOEXPO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idciudad' => 1, 'ca_idrecargo' => 2, 'ca_aplicacion' => 3, 'ca_vlrfijo' => 4, 'ca_porcentaje' => 5, 'ca_baseporcentaje' => 6, 'ca_vlrunitario' => 7, 'ca_baseunitario' => 8, 'ca_recargominimo' => 9, 'ca_idmoneda' => 10, 'ca_observaciones' => 11, 'ca_fchinicio' => 12, 'ca_fchvencimiento' => 13, 'ca_modalidad' => 14, 'ca_impoexpo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RecargoFleteTrafMapBuilder();
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
		return str_replace(RecargoFleteTrafPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_APLICACION);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_VLRFIJO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_PORCENTAJE);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_BASEPORCENTAJE);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_VLRUNITARIO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_BASEUNITARIO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_RECARGOMINIMO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(RecargoFleteTrafPeer::CA_IMPOEXPO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFleteTrafPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFleteTrafPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $criteria, $con);
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
		$objects = RecargoFleteTrafPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RecargoFleteTrafPeer::populateObjects(RecargoFleteTrafPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RecargoFleteTrafPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RecargoFleteTraf $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrafico(), (string) $obj->getCaIdciudad(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaModalidad()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RecargoFleteTraf) {
				$key = serialize(array((string) $value->getCaIdtrafico(), (string) $value->getCaIdciudad(), (string) $value->getCaIdrecargo(), (string) $value->getCaModalidad()));
			} elseif (is_array($value) && count($value) === 4) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RecargoFleteTraf object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 14] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 14]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = RecargoFleteTrafPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RecargoFleteTrafPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RecargoFleteTrafPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RecargoFleteTrafPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTipoRecargo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFleteTrafPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFleteTrafPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RecargoFleteTrafPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTipoRecargo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RecargoFleteTrafPeer::addSelectColumns($c);
		$startcol = (RecargoFleteTrafPeer::NUM_COLUMNS - RecargoFleteTrafPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(RecargoFleteTrafPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFleteTrafPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFleteTrafPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RecargoFleteTrafPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFleteTrafPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TipoRecargoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TipoRecargoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TipoRecargoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRecargoFleteTraf($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFleteTrafPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFleteTrafPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RecargoFleteTrafPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RecargoFleteTrafPeer::addSelectColumns($c);
		$startcol2 = (RecargoFleteTrafPeer::NUM_COLUMNS - RecargoFleteTrafPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RecargoFleteTrafPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFleteTrafPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFleteTrafPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RecargoFleteTrafPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFleteTrafPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TipoRecargoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TipoRecargoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TipoRecargoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRecargoFleteTraf($obj1);
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
		return RecargoFleteTrafPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRecargoFleteTrafPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRecargoFleteTrafPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RecargoFleteTrafPeer::CA_IDTRAFICO);
			$selectCriteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $criteria->remove(RecargoFleteTrafPeer::CA_IDTRAFICO), $comparison);

			$comparison = $criteria->getComparison(RecargoFleteTrafPeer::CA_IDCIUDAD);
			$selectCriteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $criteria->remove(RecargoFleteTrafPeer::CA_IDCIUDAD), $comparison);

			$comparison = $criteria->getComparison(RecargoFleteTrafPeer::CA_IDRECARGO);
			$selectCriteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $criteria->remove(RecargoFleteTrafPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(RecargoFleteTrafPeer::CA_MODALIDAD);
			$selectCriteria->add(RecargoFleteTrafPeer::CA_MODALIDAD, $criteria->remove(RecargoFleteTrafPeer::CA_MODALIDAD), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRecargoFleteTrafPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFleteTrafPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RecargoFleteTrafPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RecargoFleteTrafPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RecargoFleteTraf) {
						RecargoFleteTrafPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(RecargoFleteTrafPeer::CA_IDTRAFICO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(RecargoFleteTrafPeer::CA_IDCIUDAD, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(RecargoFleteTrafPeer::CA_IDRECARGO, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(RecargoFleteTrafPeer::CA_MODALIDAD, $value[3]));
				$criteria->addOr($criterion);

								RecargoFleteTrafPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(RecargoFleteTraf $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RecargoFleteTrafPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RecargoFleteTrafPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RecargoFleteTrafPeer::DATABASE_NAME, RecargoFleteTrafPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RecargoFleteTrafPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idtrafico, $ca_idciudad, $ca_idrecargo, $ca_modalidad, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrafico, (string) $ca_idciudad, (string) $ca_idrecargo, (string) $ca_modalidad));
 		if (null !== ($obj = RecargoFleteTrafPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(RecargoFleteTrafPeer::DATABASE_NAME);
		$criteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $ca_idtrafico);
		$criteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $ca_idciudad);
		$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(RecargoFleteTrafPeer::CA_MODALIDAD, $ca_modalidad);
		$v = RecargoFleteTrafPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseRecargoFleteTrafPeer::DATABASE_NAME)->addTableBuilder(BaseRecargoFleteTrafPeer::TABLE_NAME, BaseRecargoFleteTrafPeer::getMapBuilder());

