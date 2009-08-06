<?php


abstract class BasePricRecargoxConceptoLogPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'bs_pricrecargosxconcepto';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargoxConceptoLog';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAYECTO = 'bs_pricrecargosxconcepto.CA_IDTRAYECTO';

	
	const CA_IDCONCEPTO = 'bs_pricrecargosxconcepto.CA_IDCONCEPTO';

	
	const CA_IDRECARGO = 'bs_pricrecargosxconcepto.CA_IDRECARGO';

	
	const CA_VLRRECARGO = 'bs_pricrecargosxconcepto.CA_VLRRECARGO';

	
	const CA_APLICACION = 'bs_pricrecargosxconcepto.CA_APLICACION';

	
	const CA_VLRMINIMO = 'bs_pricrecargosxconcepto.CA_VLRMINIMO';

	
	const CA_APLICACION_MIN = 'bs_pricrecargosxconcepto.CA_APLICACION_MIN';

	
	const CA_OBSERVACIONES = 'bs_pricrecargosxconcepto.CA_OBSERVACIONES';

	
	const CA_IDMONEDA = 'bs_pricrecargosxconcepto.CA_IDMONEDA';

	
	const CA_FCHINICIO = 'bs_pricrecargosxconcepto.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'bs_pricrecargosxconcepto.CA_FCHVENCIMIENTO';

	
	const CA_FCHCREADO = 'bs_pricrecargosxconcepto.CA_FCHCREADO';

	
	const CA_USUCREADO = 'bs_pricrecargosxconcepto.CA_USUCREADO';

	
	const CA_CONSECUTIVO = 'bs_pricrecargosxconcepto.CA_CONSECUTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto', 'CaIdconcepto', 'CaIdrecargo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaIdmoneda', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto', 'caIdconcepto', 'caIdrecargo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caIdmoneda', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO, self::CA_IDCONCEPTO, self::CA_IDRECARGO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_IDMONEDA, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto', 'ca_idconcepto', 'ca_idrecargo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_idmoneda', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto' => 0, 'CaIdconcepto' => 1, 'CaIdrecargo' => 2, 'CaVlrrecargo' => 3, 'CaAplicacion' => 4, 'CaVlrminimo' => 5, 'CaAplicacionMin' => 6, 'CaObservaciones' => 7, 'CaIdmoneda' => 8, 'CaFchinicio' => 9, 'CaFchvencimiento' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaConsecutivo' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto' => 0, 'caIdconcepto' => 1, 'caIdrecargo' => 2, 'caVlrrecargo' => 3, 'caAplicacion' => 4, 'caVlrminimo' => 5, 'caAplicacionMin' => 6, 'caObservaciones' => 7, 'caIdmoneda' => 8, 'caFchinicio' => 9, 'caFchvencimiento' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caConsecutivo' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO => 0, self::CA_IDCONCEPTO => 1, self::CA_IDRECARGO => 2, self::CA_VLRRECARGO => 3, self::CA_APLICACION => 4, self::CA_VLRMINIMO => 5, self::CA_APLICACION_MIN => 6, self::CA_OBSERVACIONES => 7, self::CA_IDMONEDA => 8, self::CA_FCHINICIO => 9, self::CA_FCHVENCIMIENTO => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_CONSECUTIVO => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto' => 0, 'ca_idconcepto' => 1, 'ca_idrecargo' => 2, 'ca_vlrrecargo' => 3, 'ca_aplicacion' => 4, 'ca_vlrminimo' => 5, 'ca_aplicacion_min' => 6, 'ca_observaciones' => 7, 'ca_idmoneda' => 8, 'ca_fchinicio' => 9, 'ca_fchvencimiento' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_consecutivo' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargoxConceptoLogMapBuilder();
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
		return str_replace(PricRecargoxConceptoLogPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
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
		$objects = PricRecargoxConceptoLogPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricRecargoxConceptoLogPeer::populateObjects(PricRecargoxConceptoLogPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricRecargoxConceptoLog $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaConsecutivo();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargoxConceptoLog) {
				$key = (string) $value->getCaConsecutivo();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargoxConceptoLog object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 13] === null) {
			return null;
		}
		return (string) $row[$startcol + 13];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = PricRecargoxConceptoLogPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargoxConceptoLogPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinPricFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTipoRecargo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinPricFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);
		PricFletePeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = PricFletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricFletePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargoxConceptoLog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTipoRecargo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargoxConceptoLog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargoxConceptoLogPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricFletePeer::NUM_COLUMNS - PricFletePeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);
		$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = PricFletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = PricFletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargoxConceptoLog($obj1);
			} 
			
			$key3 = TipoRecargoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TipoRecargoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TipoRecargoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TipoRecargoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addPricRecargoxConceptoLog($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptPricFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTipoRecargo(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptPricFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargoxConceptoLog($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTipoRecargo(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoLogPeer::NUM_COLUMNS - PricRecargoxConceptoLogPeer::NUM_LAZY_LOAD_COLUMNS);

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (PricFletePeer::NUM_COLUMNS - PricFletePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO,PricRecargoxConceptoLogPeer::CA_IDCONCEPTO,), array(PricFletePeer::CA_IDTRAYECTO,PricFletePeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargoxConceptoLogPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargoxConceptoLogPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargoxConceptoLogPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargoxConceptoLogPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = PricFletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = PricFletePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = PricFletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					PricFletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargoxConceptoLog($obj1);

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
		return PricRecargoxConceptoLogPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO);
			$selectCriteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $criteria->remove(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricRecargoxConceptoLogPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargoxConceptoLogPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargoxConceptoLogPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricRecargoxConceptoLogPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricRecargoxConceptoLog) {
						PricRecargoxConceptoLogPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								PricRecargoxConceptoLogPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(PricRecargoxConceptoLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargoxConceptoLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargoxConceptoLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargoxConceptoLogPeer::DATABASE_NAME, PricRecargoxConceptoLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargoxConceptoLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = PricRecargoxConceptoLogPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);
		$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $pk);

		$v = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargoxConceptoLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(PricRecargoxConceptoLogPeer::DATABASE_NAME);
			$criteria->add(PricRecargoxConceptoLogPeer::CA_CONSECUTIVO, $pks, Criteria::IN);
			$objs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BasePricRecargoxConceptoLogPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargoxConceptoLogPeer::TABLE_NAME, BasePricRecargoxConceptoLogPeer::getMapBuilder());

