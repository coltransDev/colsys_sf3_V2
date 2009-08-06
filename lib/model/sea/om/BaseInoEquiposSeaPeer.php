<?php


abstract class BaseInoEquiposSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inoequipos_sea';

	
	const CLASS_DEFAULT = 'lib.model.sea.InoEquiposSea';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_inoequipos_sea.CA_REFERENCIA';

	
	const CA_IDCONCEPTO = 'tb_inoequipos_sea.CA_IDCONCEPTO';

	
	const CA_CANTIDAD = 'tb_inoequipos_sea.CA_CANTIDAD';

	
	const CA_IDEQUIPO = 'tb_inoequipos_sea.CA_IDEQUIPO';

	
	const CA_OBSERVACIONES = 'tb_inoequipos_sea.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_inoequipos_sea.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inoequipos_sea.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_inoequipos_sea.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inoequipos_sea.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdconcepto', 'CaCantidad', 'CaIdequipo', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdconcepto', 'caCantidad', 'caIdequipo', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDCONCEPTO, self::CA_CANTIDAD, self::CA_IDEQUIPO, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idconcepto', 'ca_cantidad', 'ca_idequipo', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdconcepto' => 1, 'CaCantidad' => 2, 'CaIdequipo' => 3, 'CaObservaciones' => 4, 'CaFchcreado' => 5, 'CaUsucreado' => 6, 'CaFchactualizado' => 7, 'CaUsuactualizado' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdconcepto' => 1, 'caCantidad' => 2, 'caIdequipo' => 3, 'caObservaciones' => 4, 'caFchcreado' => 5, 'caUsucreado' => 6, 'caFchactualizado' => 7, 'caUsuactualizado' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDCONCEPTO => 1, self::CA_CANTIDAD => 2, self::CA_IDEQUIPO => 3, self::CA_OBSERVACIONES => 4, self::CA_FCHCREADO => 5, self::CA_USUCREADO => 6, self::CA_FCHACTUALIZADO => 7, self::CA_USUACTUALIZADO => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idconcepto' => 1, 'ca_cantidad' => 2, 'ca_idequipo' => 3, 'ca_observaciones' => 4, 'ca_fchcreado' => 5, 'ca_usucreado' => 6, 'ca_fchactualizado' => 7, 'ca_usuactualizado' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoEquiposSeaMapBuilder();
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
		return str_replace(InoEquiposSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_CANTIDAD);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_IDEQUIPO);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoEquiposSeaPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoEquiposSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
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
		$objects = InoEquiposSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoEquiposSeaPeer::populateObjects(InoEquiposSeaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoEquiposSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdequipo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoEquiposSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdequipo()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoEquiposSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 3]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = InoEquiposSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoEquiposSeaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoEquiposSeaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoEquiposSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(InoEquiposSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol = (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoEquiposSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoEquiposSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoEquiposSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraSeaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoEquiposSea($obj1);

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

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol = (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoEquiposSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoEquiposSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoEquiposSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoEquiposSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoEquiposSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$criteria->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol2 = (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$c->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoEquiposSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoEquiposSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoEquiposSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoEquiposSea($obj1);
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
								$obj3->addInoEquiposSea($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
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
			InoEquiposSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol2 = (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoEquiposSeaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoEquiposSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoEquiposSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoEquiposSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoEquiposSea($obj1);

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

		InoEquiposSeaPeer::addSelectColumns($c);
		$startcol2 = (InoEquiposSeaPeer::NUM_COLUMNS - InoEquiposSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoEquiposSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoEquiposSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoEquiposSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoEquiposSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoEquiposSeaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoEquiposSea($obj1);

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
		return InoEquiposSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoEquiposSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoEquiposSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoEquiposSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $criteria->remove(InoEquiposSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoEquiposSeaPeer::CA_IDEQUIPO);
			$selectCriteria->add(InoEquiposSeaPeer::CA_IDEQUIPO, $criteria->remove(InoEquiposSeaPeer::CA_IDEQUIPO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoEquiposSeaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoEquiposSeaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoEquiposSeaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoEquiposSeaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoEquiposSea) {
						InoEquiposSeaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoEquiposSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoEquiposSeaPeer::CA_IDEQUIPO, $value[1]));
				$criteria->addOr($criterion);

								InoEquiposSeaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoEquiposSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoEquiposSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoEquiposSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoEquiposSeaPeer::DATABASE_NAME, InoEquiposSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoEquiposSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idequipo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idequipo));
 		if (null !== ($obj = InoEquiposSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoEquiposSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoEquiposSeaPeer::DATABASE_NAME);
		$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoEquiposSeaPeer::CA_IDEQUIPO, $ca_idequipo);
		$v = InoEquiposSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoEquiposSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoEquiposSeaPeer::TABLE_NAME, BaseInoEquiposSeaPeer::getMapBuilder());

