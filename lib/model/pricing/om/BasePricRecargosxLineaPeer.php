<?php


abstract class BasePricRecargosxLineaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_pricrecargosxlinea';

	
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargosxLinea';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAFICO = 'tb_pricrecargosxlinea.CA_IDTRAFICO';

	
	const CA_IDLINEA = 'tb_pricrecargosxlinea.CA_IDLINEA';

	
	const CA_IDRECARGO = 'tb_pricrecargosxlinea.CA_IDRECARGO';

	
	const CA_IDCONCEPTO = 'tb_pricrecargosxlinea.CA_IDCONCEPTO';

	
	const CA_MODALIDAD = 'tb_pricrecargosxlinea.CA_MODALIDAD';

	
	const CA_IMPOEXPO = 'tb_pricrecargosxlinea.CA_IMPOEXPO';

	
	const CA_VLRRECARGO = 'tb_pricrecargosxlinea.CA_VLRRECARGO';

	
	const CA_APLICACION = 'tb_pricrecargosxlinea.CA_APLICACION';

	
	const CA_VLRMINIMO = 'tb_pricrecargosxlinea.CA_VLRMINIMO';

	
	const CA_APLICACION_MIN = 'tb_pricrecargosxlinea.CA_APLICACION_MIN';

	
	const CA_OBSERVACIONES = 'tb_pricrecargosxlinea.CA_OBSERVACIONES';

	
	const CA_FCHINICIO = 'tb_pricrecargosxlinea.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'tb_pricrecargosxlinea.CA_FCHVENCIMIENTO';

	
	const CA_FCHCREADO = 'tb_pricrecargosxlinea.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_pricrecargosxlinea.CA_USUCREADO';

	
	const CA_IDMONEDA = 'tb_pricrecargosxlinea.CA_IDMONEDA';

	
	const CA_CONSECUTIVO = 'tb_pricrecargosxlinea.CA_CONSECUTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdlinea', 'CaIdrecargo', 'CaIdconcepto', 'CaModalidad', 'CaImpoexpo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaIdmoneda', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico', 'caIdlinea', 'caIdrecargo', 'caIdconcepto', 'caModalidad', 'caImpoexpo', 'caVlrrecargo', 'caAplicacion', 'caVlrminimo', 'caAplicacionMin', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caIdmoneda', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO, self::CA_IDLINEA, self::CA_IDRECARGO, self::CA_IDCONCEPTO, self::CA_MODALIDAD, self::CA_IMPOEXPO, self::CA_VLRRECARGO, self::CA_APLICACION, self::CA_VLRMINIMO, self::CA_APLICACION_MIN, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_IDMONEDA, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idlinea', 'ca_idrecargo', 'ca_idconcepto', 'ca_modalidad', 'ca_impoexpo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_idmoneda', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdlinea' => 1, 'CaIdrecargo' => 2, 'CaIdconcepto' => 3, 'CaModalidad' => 4, 'CaImpoexpo' => 5, 'CaVlrrecargo' => 6, 'CaAplicacion' => 7, 'CaVlrminimo' => 8, 'CaAplicacionMin' => 9, 'CaObservaciones' => 10, 'CaFchinicio' => 11, 'CaFchvencimiento' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaIdmoneda' => 15, 'CaConsecutivo' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrafico' => 0, 'caIdlinea' => 1, 'caIdrecargo' => 2, 'caIdconcepto' => 3, 'caModalidad' => 4, 'caImpoexpo' => 5, 'caVlrrecargo' => 6, 'caAplicacion' => 7, 'caVlrminimo' => 8, 'caAplicacionMin' => 9, 'caObservaciones' => 10, 'caFchinicio' => 11, 'caFchvencimiento' => 12, 'caFchcreado' => 13, 'caUsucreado' => 14, 'caIdmoneda' => 15, 'caConsecutivo' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAFICO => 0, self::CA_IDLINEA => 1, self::CA_IDRECARGO => 2, self::CA_IDCONCEPTO => 3, self::CA_MODALIDAD => 4, self::CA_IMPOEXPO => 5, self::CA_VLRRECARGO => 6, self::CA_APLICACION => 7, self::CA_VLRMINIMO => 8, self::CA_APLICACION_MIN => 9, self::CA_OBSERVACIONES => 10, self::CA_FCHINICIO => 11, self::CA_FCHVENCIMIENTO => 12, self::CA_FCHCREADO => 13, self::CA_USUCREADO => 14, self::CA_IDMONEDA => 15, self::CA_CONSECUTIVO => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idlinea' => 1, 'ca_idrecargo' => 2, 'ca_idconcepto' => 3, 'ca_modalidad' => 4, 'ca_impoexpo' => 5, 'ca_vlrrecargo' => 6, 'ca_aplicacion' => 7, 'ca_vlrminimo' => 8, 'ca_aplicacion_min' => 9, 'ca_observaciones' => 10, 'ca_fchinicio' => 11, 'ca_fchvencimiento' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_idmoneda' => 15, 'ca_consecutivo' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new PricRecargosxLineaMapBuilder();
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
		return str_replace(PricRecargosxLineaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDLINEA);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargosxLineaPeer::CA_CONSECUTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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
		$objects = PricRecargosxLineaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return PricRecargosxLineaPeer::populateObjects(PricRecargosxLineaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(PricRecargosxLinea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrafico(), (string) $obj->getCaIdlinea(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaIdconcepto(), (string) $obj->getCaModalidad(), (string) $obj->getCaImpoexpo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof PricRecargosxLinea) {
				$key = serialize(array((string) $value->getCaIdtrafico(), (string) $value->getCaIdlinea(), (string) $value->getCaIdrecargo(), (string) $value->getCaIdconcepto(), (string) $value->getCaModalidad(), (string) $value->getCaImpoexpo()));
			} elseif (is_array($value) && count($value) === 6) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4], (string) $value[5]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or PricRecargosxLinea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null && $row[$startcol + 5] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4], (string) $row[$startcol + 5]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = PricRecargosxLineaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = PricRecargosxLineaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				PricRecargosxLineaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxLinea($obj1);

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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargosxLinea($obj1);

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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargosxLinea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(PricRecargosxLineaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxLinea($obj1);
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
								$obj3->addPricRecargosxLinea($obj1);
			} 
			
			$key4 = ConceptoPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = ConceptoPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = ConceptoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ConceptoPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addPricRecargosxLinea($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
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
			PricRecargosxLineaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addPricRecargosxLinea($obj1);

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
								$obj3->addPricRecargosxLinea($obj1);

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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxLinea($obj1);

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
								$obj3->addPricRecargosxLinea($obj1);

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

		PricRecargosxLineaPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxLineaPeer::NUM_COLUMNS - PricRecargosxLineaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(PricRecargosxLineaPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = PricRecargosxLineaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = PricRecargosxLineaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = PricRecargosxLineaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				PricRecargosxLineaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addPricRecargosxLinea($obj1);

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
								$obj3->addPricRecargosxLinea($obj1);

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
		return PricRecargosxLineaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargosxLineaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePricRecargosxLineaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDTRAFICO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $criteria->remove(PricRecargosxLineaPeer::CA_IDTRAFICO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDLINEA);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $criteria->remove(PricRecargosxLineaPeer::CA_IDLINEA), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDRECARGO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $criteria->remove(PricRecargosxLineaPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IDCONCEPTO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $criteria->remove(PricRecargosxLineaPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_MODALIDAD);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $criteria->remove(PricRecargosxLineaPeer::CA_MODALIDAD), $comparison);

			$comparison = $criteria->getComparison(PricRecargosxLineaPeer::CA_IMPOEXPO);
			$selectCriteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $criteria->remove(PricRecargosxLineaPeer::CA_IMPOEXPO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePricRecargosxLineaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePricRecargosxLineaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(PricRecargosxLineaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												PricRecargosxLineaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof PricRecargosxLinea) {
						PricRecargosxLineaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDTRAFICO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDLINEA, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDRECARGO, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IDCONCEPTO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_MODALIDAD, $value[4]));
				$criterion->addAnd($criteria->getNewCriterion(PricRecargosxLineaPeer::CA_IMPOEXPO, $value[5]));
				$criteria->addOr($criterion);

								PricRecargosxLineaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(PricRecargosxLinea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargosxLineaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargosxLineaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargosxLineaPeer::DATABASE_NAME, PricRecargosxLineaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargosxLineaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idtrafico, $ca_idlinea, $ca_idrecargo, $ca_idconcepto, $ca_modalidad, $ca_impoexpo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrafico, (string) $ca_idlinea, (string) $ca_idrecargo, (string) $ca_idconcepto, (string) $ca_modalidad, (string) $ca_impoexpo));
 		if (null !== ($obj = PricRecargosxLineaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(PricRecargosxLineaPeer::DATABASE_NAME);
		$criteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $ca_idtrafico);
		$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $ca_idlinea);
		$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $ca_modalidad);
		$criteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $ca_impoexpo);
		$v = PricRecargosxLineaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BasePricRecargosxLineaPeer::DATABASE_NAME)->addTableBuilder(BasePricRecargosxLineaPeer::TABLE_NAME, BasePricRecargosxLineaPeer::getMapBuilder());

