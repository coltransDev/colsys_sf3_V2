<?php


abstract class BasePricRecargosxCiudadPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricrecargosxciudad';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargosxCiudad';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAFICO = 'tb_pricrecargosxciudad.CA_IDTRAFICO';

	
	const CA_IDCIUDAD = 'tb_pricrecargosxciudad.CA_IDCIUDAD';

	
	const CA_IDRECARGO = 'tb_pricrecargosxciudad.CA_IDRECARGO';

	
	const CA_MODALIDAD = 'tb_pricrecargosxciudad.CA_MODALIDAD';

	
	const CA_IMPOEXPO = 'tb_pricrecargosxciudad.CA_IMPOEXPO';

	
	const CA_VLRRECARGO = 'tb_pricrecargosxciudad.CA_VLRRECARGO';

	
	const CA_APLICACION = 'tb_pricrecargosxciudad.CA_APLICACION';

	
	const CA_VLRMINIMO = 'tb_pricrecargosxciudad.CA_VLRMINIMO';

	
	const CA_APLICACION_MIN = 'tb_pricrecargosxciudad.CA_APLICACION_MIN';

	
	const CA_OBSERVACIONES = 'tb_pricrecargosxciudad.CA_OBSERVACIONES';

	
	const CA_FCHINICIO = 'tb_pricrecargosxciudad.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'tb_pricrecargosxciudad.CA_FCHVENCIMIENTO';

	
	const CA_FCHCREADO = 'tb_pricrecargosxciudad.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricrecargosxciudad.CA_USUCREADO';

	
	const CA_IDMONEDA = 'tb_pricrecargosxciudad.CA_IDMONEDA';

	
	const CA_CONSECUTIVO = 'tb_pricrecargosxciudad.CA_CONSECUTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdciudad', 'CaIdrecargo', 'CaModalidad', 'CaImpoexpo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaIdmoneda', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caIdciudad', 'caIdrecargo', 'caModalidad', 'caImpoexpo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caIdmoneda', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_IDCIUDAD, self::CA_IDRECARGO, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_IDMONEDA, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idciudad', 'ca_idrecargo', 'ca_modalidad', 'ca_impoexpo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_idmoneda', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdciudad' => 1, 'CaIdrecargo' => 2, 'CaModalidad' => 3, 'CaImpoexpo' => 4, 'CaVlrrecargo' => 5, 'CaAplicacion' => 6, 'CaVlrminimo' => 7, 'CaAplicacionMin' => 8, 'CaObservaciones' => 9, 'CaFchinicio' => 10, 'CaFchvencimiento' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaIdmoneda' => 14, 'CaConsecutivo' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caIdciudad' => 1, 'caIdrecargo' => 2, 'caModalidad' => 3, 'caImpoexpo' => 4, 'caVlrrecargo' => 5, 'caAplicacion' => 6, 'caVlrminimo' => 7, 'caAplicacionMin' => 8, 'caObservaciones' => 9, 'caFchinicio' => 10, 'caFchvencimiento' => 11, 'caFchcreado' => 12, 'caUsucreado' => 13, 'caIdmoneda' => 14, 'caConsecutivo' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_IDCIUDAD => 1, self::CA_IDRECARGO => 2, self::CA_MODALIDAD => 3, self::CA_IMPOEXPO => 4, self::CA_VLRRECARGO => 5, self::CA_APLICACION => 6, self::CA_VLRMINIMO => 7, self::CA_APLICACION_MIN => 8, self::CA_OBSERVACIONES => 9, self::CA_FCHINICIO => 10, self::CA_FCHVENCIMIENTO => 11, self::CA_FCHCREADO => 12, self::CA_USUCREADO => 13, self::CA_IDMONEDA => 14, self::CA_CONSECUTIVO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idciudad' => 1, 'ca_idrecargo' => 2, 'ca_modalidad' => 3, 'ca_impoexpo' => 4, 'ca_vlrrecargo' => 5, 'ca_aplicacion' => 6, 'ca_vlrminimo' => 7, 'ca_aplicacion_min' => 8, 'ca_observaciones' => 9, 'ca_fchinicio' => 10, 'ca_fchvencimiento' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_idmoneda' => 14, 'ca_consecutivo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargosxCiudadMapBuilder();
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
		return str_replace(PricRecargosxCiudadPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargosxCiudadPeer::CA_CONSECUTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxCiudadPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
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
		$objects = PricRecargosxCiudadPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricRecargosxCiudadPeer::populateObjects(PricRecargosxCiudadPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricRecargosxCiudad $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrafico(), (string) $obj->getCaIdciudad(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaModalidad(), (string) $obj->getCaImpoexpo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargosxCiudad) {
				$key = serialize(array((string) $value->getCaIdtrafico(), (string) $value->getCaIdciudad(), (string) $value->getCaIdrecargo(), (string) $value->getCaModalidad(), (string) $value->getCaImpoexpo()));
			} elseif (is_array($value) && count($value) === 5) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargosxCiudad object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = PricRecargosxCiudadPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargosxCiudadPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargosxCiudadPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxCiudadPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(PricRecargosxCiudadPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargosxCiudadPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxCiudad($obj1);

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

		PricRecargosxCiudadPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargosxCiudadPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargosxCiudad($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxCiudadPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxCiudadPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxCiudad($obj1);
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
								$obj3->addPricRecargosxCiudad($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
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
			PricRecargosxCiudadPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxCiudadPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargosxCiudad($obj1);

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

		PricRecargosxCiudadPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadPeer::NUM_COLUMNS - PricRecargosxCiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxCiudadPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxCiudadPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxCiudadPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxCiudadPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxCiudadPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CiudadPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxCiudad($obj1);

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
		return PricRecargosxCiudadPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargosxCiudadPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargosxCiudadPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricRecargosxCiudadPeer::CA_IDTRAFICO);
			$selectCriteria->add(PricRecargosxCiudadPeer::CA_IDTRAFICO, $criteria->remove(PricRecargosxCiudadPeer::CA_IDTRAFICO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxCiudadPeer::CA_IDCIUDAD);
			$selectCriteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $criteria->remove(PricRecargosxCiudadPeer::CA_IDCIUDAD), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxCiudadPeer::CA_IDRECARGO);
			$selectCriteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $criteria->remove(PricRecargosxCiudadPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxCiudadPeer::CA_MODALIDAD);
			$selectCriteria->add(PricRecargosxCiudadPeer::CA_MODALIDAD, $criteria->remove(PricRecargosxCiudadPeer::CA_MODALIDAD), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxCiudadPeer::CA_IMPOEXPO);
			$selectCriteria->add(PricRecargosxCiudadPeer::CA_IMPOEXPO, $criteria->remove(PricRecargosxCiudadPeer::CA_IMPOEXPO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxCiudadPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargosxCiudadPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricRecargosxCiudadPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricRecargosxCiudad) {
						PricRecargosxCiudadPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricRecargosxCiudadPeer::CA_IDTRAFICO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxCiudadPeer::CA_IDCIUDAD, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxCiudadPeer::CA_IDRECARGO, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxCiudadPeer::CA_MODALIDAD, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxCiudadPeer::CA_IMPOEXPO, $value[4]));
				$criteria->addOr($criterion);

								PricRecargosxCiudadPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(PricRecargosxCiudad $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargosxCiudadPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargosxCiudadPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargosxCiudadPeer::DATABASE_NAME, PricRecargosxCiudadPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargosxCiudadPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idtrafico, $ca_idciudad, $ca_idrecargo, $ca_modalidad, $ca_impoexpo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrafico, (string) $ca_idciudad, (string) $ca_idrecargo, (string) $ca_modalidad, (string) $ca_impoexpo));
 		if (null !== ($obj = PricRecargosxCiudadPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxCiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricRecargosxCiudadPeer::DATABASE_NAME);
		$criteria->add(PricRecargosxCiudadPeer::CA_IDTRAFICO, $ca_idtrafico);
		$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $ca_idciudad);
		$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(PricRecargosxCiudadPeer::CA_MODALIDAD, $ca_modalidad);
		$criteria->add(PricRecargosxCiudadPeer::CA_IMPOEXPO, $ca_impoexpo);
		$v = PricRecargosxCiudadPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BasePricRecargosxCiudadPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargosxCiudadPeer::TABLE_NAME, BasePricRecargosxCiudadPeer::getMapBuilder());

