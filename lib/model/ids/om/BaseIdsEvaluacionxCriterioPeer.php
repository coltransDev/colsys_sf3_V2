<?php


abstract class BaseIdsEvaluacionxCriterioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_evaluacionxcriterio';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsEvaluacionxCriterio';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDEVALUACION = 'ids.tb_evaluacionxcriterio.CA_IDEVALUACION';

	
	const CA_IDCRITERIO = 'ids.tb_evaluacionxcriterio.CA_IDCRITERIO';

	
	const CA_VALOR = 'ids.tb_evaluacionxcriterio.CA_VALOR';

	
	const CA_PONDERACION = 'ids.tb_evaluacionxcriterio.CA_PONDERACION';

	
	const CA_OBSERVACIONES = 'ids.tb_evaluacionxcriterio.CA_OBSERVACIONES';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdevaluacion', 'CaIdcriterio', 'CaValor', 'CaPonderacion', 'CaObservaciones', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdevaluacion', 'caIdcriterio', 'caValor', 'caPonderacion', 'caObservaciones', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEVALUACION, self::CA_IDCRITERIO, self::CA_VALOR, self::CA_PONDERACION, self::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idevaluacion', 'ca_idcriterio', 'ca_valor', 'ca_ponderacion', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdevaluacion' => 0, 'CaIdcriterio' => 1, 'CaValor' => 2, 'CaPonderacion' => 3, 'CaObservaciones' => 4, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdevaluacion' => 0, 'caIdcriterio' => 1, 'caValor' => 2, 'caPonderacion' => 3, 'caObservaciones' => 4, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEVALUACION => 0, self::CA_IDCRITERIO => 1, self::CA_VALOR => 2, self::CA_PONDERACION => 3, self::CA_OBSERVACIONES => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idevaluacion' => 0, 'ca_idcriterio' => 1, 'ca_valor' => 2, 'ca_ponderacion' => 3, 'ca_observaciones' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsEvaluacionxCriterioMapBuilder();
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
		return str_replace(IdsEvaluacionxCriterioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION);

		$criteria->addSelectColumn(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO);

		$criteria->addSelectColumn(IdsEvaluacionxCriterioPeer::CA_VALOR);

		$criteria->addSelectColumn(IdsEvaluacionxCriterioPeer::CA_PONDERACION);

		$criteria->addSelectColumn(IdsEvaluacionxCriterioPeer::CA_OBSERVACIONES);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionxCriterioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
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
		$objects = IdsEvaluacionxCriterioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsEvaluacionxCriterioPeer::populateObjects(IdsEvaluacionxCriterioPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsEvaluacionxCriterio $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdevaluacion(), (string) $obj->getCaIdcriterio()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsEvaluacionxCriterio) {
				$key = serialize(array((string) $value->getCaIdevaluacion(), (string) $value->getCaIdcriterio()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsEvaluacionxCriterio object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = IdsEvaluacionxCriterioPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIdsEvaluacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionxCriterioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinIdsCriterio(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionxCriterioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinIdsEvaluacion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionxCriterioPeer::addSelectColumns($c);
		$startcol = (IdsEvaluacionxCriterioPeer::NUM_COLUMNS - IdsEvaluacionxCriterioPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsEvaluacionPeer::addSelectColumns($c);

		$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsEvaluacionxCriterioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsEvaluacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsEvaluacionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsEvaluacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacionxCriterio($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinIdsCriterio(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionxCriterioPeer::addSelectColumns($c);
		$startcol = (IdsEvaluacionxCriterioPeer::NUM_COLUMNS - IdsEvaluacionxCriterioPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsCriterioPeer::addSelectColumns($c);

		$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsEvaluacionxCriterioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsCriterioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsCriterioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsCriterioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsCriterioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacionxCriterio($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsEvaluacionxCriterioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);
		$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionxCriterioPeer::addSelectColumns($c);
		$startcol2 = (IdsEvaluacionxCriterioPeer::NUM_COLUMNS - IdsEvaluacionxCriterioPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsEvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsEvaluacionPeer::NUM_COLUMNS - IdsEvaluacionPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsCriterioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (IdsCriterioPeer::NUM_COLUMNS - IdsCriterioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);
		$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsEvaluacionxCriterioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = IdsEvaluacionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsEvaluacionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsEvaluacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacionxCriterio($obj1);
			} 
			
			$key3 = IdsCriterioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = IdsCriterioPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = IdsCriterioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					IdsCriterioPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addIdsEvaluacionxCriterio($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptIdsEvaluacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptIdsCriterio(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptIdsEvaluacion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionxCriterioPeer::addSelectColumns($c);
		$startcol2 = (IdsEvaluacionxCriterioPeer::NUM_COLUMNS - IdsEvaluacionxCriterioPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsCriterioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsCriterioPeer::NUM_COLUMNS - IdsCriterioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO,), array(IdsCriterioPeer::CA_IDCRITERIO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsEvaluacionxCriterioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsCriterioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsCriterioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsCriterioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsCriterioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacionxCriterio($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptIdsCriterio(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsEvaluacionxCriterioPeer::addSelectColumns($c);
		$startcol2 = (IdsEvaluacionxCriterioPeer::NUM_COLUMNS - IdsEvaluacionxCriterioPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsEvaluacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsEvaluacionPeer::NUM_COLUMNS - IdsEvaluacionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION,), array(IdsEvaluacionPeer::CA_IDEVALUACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsEvaluacionxCriterioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsEvaluacionxCriterioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsEvaluacionxCriterioPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsEvaluacionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsEvaluacionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsEvaluacionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsEvaluacionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsEvaluacionxCriterio($obj1);

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
		return IdsEvaluacionxCriterioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION);
			$selectCriteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $criteria->remove(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION), $comparison);

			$comparison = $criteria->getComparison(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO);
			$selectCriteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $criteria->remove(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterioPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsEvaluacionxCriterioPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsEvaluacionxCriterioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsEvaluacionxCriterioPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsEvaluacionxCriterio) {
						IdsEvaluacionxCriterioPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $value[1]));
				$criteria->addOr($criterion);

								IdsEvaluacionxCriterioPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(IdsEvaluacionxCriterio $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsEvaluacionxCriterioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsEvaluacionxCriterioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsEvaluacionxCriterioPeer::DATABASE_NAME, IdsEvaluacionxCriterioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsEvaluacionxCriterioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idevaluacion, $ca_idcriterio, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idevaluacion, (string) $ca_idcriterio));
 		if (null !== ($obj = IdsEvaluacionxCriterioPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(IdsEvaluacionxCriterioPeer::DATABASE_NAME);
		$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $ca_idevaluacion);
		$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $ca_idcriterio);
		$v = IdsEvaluacionxCriterioPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseIdsEvaluacionxCriterioPeer::DATABASE_NAME)->addTableBuilder(BaseIdsEvaluacionxCriterioPeer::TABLE_NAME, BaseIdsEvaluacionxCriterioPeer::getMapBuilder());

