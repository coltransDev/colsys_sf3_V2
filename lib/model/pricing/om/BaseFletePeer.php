<?php


abstract class BaseFletePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_fletes';

	
	const CLASS_DEFAULT = 'lib.model.pricing.Flete';

	
	const NUM_COLUMNS = 12;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAYECTO = 'tb_fletes.CA_IDTRAYECTO';

	
	const CA_IDCONCEPTO = 'tb_fletes.CA_IDCONCEPTO';

	
	const CA_VLRNETO = 'tb_fletes.CA_VLRNETO';

	
	const CA_VLRMINIMO = 'tb_fletes.CA_VLRMINIMO';

	
	const CA_FLETEMINIMO = 'tb_fletes.CA_FLETEMINIMO';

	
	const CA_FCHINICIO = 'tb_fletes.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'tb_fletes.CA_FCHVENCIMIENTO';

	
	const CA_IDMONEDA = 'tb_fletes.CA_IDMONEDA';

	
	const CA_OBSERVACIONES = 'tb_fletes.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_fletes.CA_FCHCREADO';

	
	const CA_SUGERIDA = 'tb_fletes.CA_SUGERIDA';

	
	const CA_MANTENIMIENTO = 'tb_fletes.CA_MANTENIMIENTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto', 'CaIdconcepto', 'CaVlrneto', 'CaVlrminimo', 'CaFleteminimo', 'CaFchinicio', 'CaFchvencimiento', 'CaIdmoneda', 'CaObservaciones', 'CaFchcreado', 'CaSugerida', 'CaMantenimiento', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto', 'caIdconcepto', 'caVlrneto', 'caVlrminimo', 'caFleteminimo', 'caFchinicio', 'caFchvencimiento', 'caIdmoneda', 'caObservaciones', 'caFchcreado', 'caSugerida', 'caMantenimiento', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO, self::CA_IDCONCEPTO, self::CA_VLRNETO, self::CA_VLRMINIMO, self::CA_FLETEMINIMO, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_IDMONEDA, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_SUGERIDA, self::CA_MANTENIMIENTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto', 'ca_idconcepto', 'ca_vlrneto', 'ca_vlrminimo', 'ca_fleteminimo', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_idmoneda', 'ca_observaciones', 'ca_fchcreado', 'ca_sugerida', 'ca_mantenimiento', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto' => 0, 'CaIdconcepto' => 1, 'CaVlrneto' => 2, 'CaVlrminimo' => 3, 'CaFleteminimo' => 4, 'CaFchinicio' => 5, 'CaFchvencimiento' => 6, 'CaIdmoneda' => 7, 'CaObservaciones' => 8, 'CaFchcreado' => 9, 'CaSugerida' => 10, 'CaMantenimiento' => 11, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto' => 0, 'caIdconcepto' => 1, 'caVlrneto' => 2, 'caVlrminimo' => 3, 'caFleteminimo' => 4, 'caFchinicio' => 5, 'caFchvencimiento' => 6, 'caIdmoneda' => 7, 'caObservaciones' => 8, 'caFchcreado' => 9, 'caSugerida' => 10, 'caMantenimiento' => 11, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO => 0, self::CA_IDCONCEPTO => 1, self::CA_VLRNETO => 2, self::CA_VLRMINIMO => 3, self::CA_FLETEMINIMO => 4, self::CA_FCHINICIO => 5, self::CA_FCHVENCIMIENTO => 6, self::CA_IDMONEDA => 7, self::CA_OBSERVACIONES => 8, self::CA_FCHCREADO => 9, self::CA_SUGERIDA => 10, self::CA_MANTENIMIENTO => 11, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto' => 0, 'ca_idconcepto' => 1, 'ca_vlrneto' => 2, 'ca_vlrminimo' => 3, 'ca_fleteminimo' => 4, 'ca_fchinicio' => 5, 'ca_fchvencimiento' => 6, 'ca_idmoneda' => 7, 'ca_observaciones' => 8, 'ca_fchcreado' => 9, 'ca_sugerida' => 10, 'ca_mantenimiento' => 11, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new FleteMapBuilder();
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
		return str_replace(FletePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FletePeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(FletePeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(FletePeer::CA_VLRNETO);

		$criteria->addSelectColumn(FletePeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(FletePeer::CA_FLETEMINIMO);

		$criteria->addSelectColumn(FletePeer::CA_FCHINICIO);

		$criteria->addSelectColumn(FletePeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(FletePeer::CA_IDMONEDA);

		$criteria->addSelectColumn(FletePeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(FletePeer::CA_FCHCREADO);

		$criteria->addSelectColumn(FletePeer::CA_SUGERIDA);

		$criteria->addSelectColumn(FletePeer::CA_MANTENIMIENTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
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
		$objects = FletePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return FletePeer::populateObjects(FletePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFletePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			FletePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Flete $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrayecto(), (string) $obj->getCaIdconcepto()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Flete) {
				$key = serialize(array((string) $value->getCaIdtrayecto(), (string) $value->getCaIdconcepto()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Flete object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = FletePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = FletePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				FletePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTrayecto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTrayecto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFletePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FletePeer::addSelectColumns($c);
		$startcol = (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);
		TrayectoPeer::addSelectColumns($c);

		$c->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FletePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FletePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TrayectoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TrayectoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TrayectoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TrayectoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFlete($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FletePeer::addSelectColumns($c);
		$startcol = (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FletePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = FletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FletePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ConceptoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ConceptoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFlete($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(FletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);
		$criteria->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseFletePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FletePeer::addSelectColumns($c);
		$startcol2 = (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);

		TrayectoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);
		$c->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FletePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TrayectoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TrayectoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TrayectoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TrayectoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFlete($obj1);
			} 
			
			$key3 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = ConceptoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ConceptoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addFlete($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptTrayecto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			FletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptTrayecto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseFletePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FletePeer::addSelectColumns($c);
		$startcol2 = (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(FletePeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FletePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ConceptoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ConceptoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFlete($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FletePeer::addSelectColumns($c);
		$startcol2 = (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);

		TrayectoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(FletePeer::CA_IDTRAYECTO,), array(TrayectoPeer::CA_IDTRAYECTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = FletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = FletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = FletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				FletePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TrayectoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TrayectoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TrayectoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TrayectoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addFlete($obj1);

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
		return FletePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFletePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFletePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseFletePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFletePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFletePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(FletePeer::CA_IDTRAYECTO);
			$selectCriteria->add(FletePeer::CA_IDTRAYECTO, $criteria->remove(FletePeer::CA_IDTRAYECTO), $comparison);

			$comparison = $criteria->getComparison(FletePeer::CA_IDCONCEPTO);
			$selectCriteria->add(FletePeer::CA_IDCONCEPTO, $criteria->remove(FletePeer::CA_IDCONCEPTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFletePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFletePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(FletePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												FletePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Flete) {
						FletePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(FletePeer::CA_IDTRAYECTO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(FletePeer::CA_IDCONCEPTO, $value[1]));
				$criteria->addOr($criterion);

								FletePeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(Flete $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FletePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FletePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FletePeer::DATABASE_NAME, FletePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FletePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idtrayecto, $ca_idconcepto, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrayecto, (string) $ca_idconcepto));
 		if (null !== ($obj = FletePeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(FletePeer::DATABASE_NAME);
		$criteria->add(FletePeer::CA_IDTRAYECTO, $ca_idtrayecto);
		$criteria->add(FletePeer::CA_IDCONCEPTO, $ca_idconcepto);
		$v = FletePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseFletePeer::DATABASE_NAME)->addTableBuilder(BaseFletePeer::TABLE_NAME, BaseFletePeer::getMapBuilder());

