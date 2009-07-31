<?php


abstract class BaseCotSeguroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotseguro';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotSeguro';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDSEGURO = 'tb_cotseguro.CA_IDSEGURO';

	
	const CA_IDCOTIZACION = 'tb_cotseguro.CA_IDCOTIZACION';

	
	const CA_IDMONEDA = 'tb_cotseguro.CA_IDMONEDA';

	
	const CA_PRIMA_TIP = 'tb_cotseguro.CA_PRIMA_TIP';

	
	const CA_PRIMA_VLR = 'tb_cotseguro.CA_PRIMA_VLR';

	
	const CA_PRIMA_MIN = 'tb_cotseguro.CA_PRIMA_MIN';

	
	const CA_OBTENCION = 'tb_cotseguro.CA_OBTENCION';

	
	const CA_OBSERVACIONES = 'tb_cotseguro.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_cotseguro.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotseguro.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotseguro.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotseguro.CA_USUACTUALIZADO';

	
	const CA_TRANSPORTE = 'tb_cotseguro.CA_TRANSPORTE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdseguro', 'CaIdcotizacion', 'CaIdmoneda', 'CaPrimaTip', 'CaPrimaVlr', 'CaPrimaMin', 'CaObtencion', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaTransporte', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdseguro', 'caIdcotizacion', 'caIdmoneda', 'caPrimaTip', 'caPrimaVlr', 'caPrimaMin', 'caObtencion', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caTransporte', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSEGURO, self::CA_IDCOTIZACION, self::CA_IDMONEDA, self::CA_PRIMA_TIP, self::CA_PRIMA_VLR, self::CA_PRIMA_MIN, self::CA_OBTENCION, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_TRANSPORTE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idseguro', 'ca_idcotizacion', 'ca_idmoneda', 'ca_prima_tip', 'ca_prima_vlr', 'ca_prima_min', 'ca_obtencion', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_transporte', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdseguro' => 0, 'CaIdcotizacion' => 1, 'CaIdmoneda' => 2, 'CaPrimaTip' => 3, 'CaPrimaVlr' => 4, 'CaPrimaMin' => 5, 'CaObtencion' => 6, 'CaObservaciones' => 7, 'CaFchcreado' => 8, 'CaUsucreado' => 9, 'CaFchactualizado' => 10, 'CaUsuactualizado' => 11, 'CaTransporte' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdseguro' => 0, 'caIdcotizacion' => 1, 'caIdmoneda' => 2, 'caPrimaTip' => 3, 'caPrimaVlr' => 4, 'caPrimaMin' => 5, 'caObtencion' => 6, 'caObservaciones' => 7, 'caFchcreado' => 8, 'caUsucreado' => 9, 'caFchactualizado' => 10, 'caUsuactualizado' => 11, 'caTransporte' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSEGURO => 0, self::CA_IDCOTIZACION => 1, self::CA_IDMONEDA => 2, self::CA_PRIMA_TIP => 3, self::CA_PRIMA_VLR => 4, self::CA_PRIMA_MIN => 5, self::CA_OBTENCION => 6, self::CA_OBSERVACIONES => 7, self::CA_FCHCREADO => 8, self::CA_USUCREADO => 9, self::CA_FCHACTUALIZADO => 10, self::CA_USUACTUALIZADO => 11, self::CA_TRANSPORTE => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idseguro' => 0, 'ca_idcotizacion' => 1, 'ca_idmoneda' => 2, 'ca_prima_tip' => 3, 'ca_prima_vlr' => 4, 'ca_prima_min' => 5, 'ca_obtencion' => 6, 'ca_observaciones' => 7, 'ca_fchcreado' => 8, 'ca_usucreado' => 9, 'ca_fchactualizado' => 10, 'ca_usuactualizado' => 11, 'ca_transporte' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotSeguroMapBuilder();
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
		return str_replace(CotSeguroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotSeguroPeer::CA_IDSEGURO);

		$criteria->addSelectColumn(CotSeguroPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotSeguroPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotSeguroPeer::CA_PRIMA_TIP);

		$criteria->addSelectColumn(CotSeguroPeer::CA_PRIMA_VLR);

		$criteria->addSelectColumn(CotSeguroPeer::CA_PRIMA_MIN);

		$criteria->addSelectColumn(CotSeguroPeer::CA_OBTENCION);

		$criteria->addSelectColumn(CotSeguroPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotSeguroPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotSeguroPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotSeguroPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotSeguroPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotSeguroPeer::CA_TRANSPORTE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
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
		$objects = CotSeguroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotSeguroPeer::populateObjects(CotSeguroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotSeguroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotSeguro $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdseguro();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotSeguro) {
				$key = (string) $value->getCaIdseguro();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotSeguro object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotSeguroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotSeguroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotSeguroPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinMoneda(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguroPeer::addSelectColumns($c);
		$startcol = (CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguroPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinMoneda(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguroPeer::addSelectColumns($c);
		$startcol = (CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS);
		MonedaPeer::addSelectColumns($c);

		$c->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguroPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguroPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = MonedaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = MonedaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = MonedaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					MonedaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotSeguro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguroPeer::addSelectColumns($c);
		$startcol2 = (CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		MonedaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (MonedaPeer::NUM_COLUMNS - MonedaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguro($obj1);
			} 
			
			$key3 = MonedaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = MonedaPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = MonedaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					MonedaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotSeguro($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptMoneda(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptCotizacion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguroPeer::addSelectColumns($c);
		$startcol2 = (CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS);

		MonedaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (MonedaPeer::NUM_COLUMNS - MonedaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotSeguroPeer::CA_IDMONEDA,), array(MonedaPeer::CA_IDMONEDA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguroPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = MonedaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = MonedaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = MonedaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					MonedaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotSeguro($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptMoneda(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguroPeer::addSelectColumns($c);
		$startcol2 = (CotSeguroPeer::NUM_COLUMNS - CotSeguroPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotSeguroPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguroPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguroPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguroPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguro($obj1);

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
		return CotSeguroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotSeguroPeer::CA_IDSEGURO) && $criteria->keyContainsValue(CotSeguroPeer::CA_IDSEGURO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotSeguroPeer::CA_IDSEGURO.')');
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

		
    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotSeguroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotSeguroPeer::CA_IDSEGURO);
			$selectCriteria->add(CotSeguroPeer::CA_IDSEGURO, $criteria->remove(CotSeguroPeer::CA_IDSEGURO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotSeguroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotSeguroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotSeguroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotSeguro) {
						CotSeguroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotSeguroPeer::CA_IDSEGURO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								CotSeguroPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(CotSeguro $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotSeguroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotSeguroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotSeguroPeer::DATABASE_NAME, CotSeguroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotSeguroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CotSeguroPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);
		$criteria->add(CotSeguroPeer::CA_IDSEGURO, $pk);

		$v = CotSeguroPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);
			$criteria->add(CotSeguroPeer::CA_IDSEGURO, $pks, Criteria::IN);
			$objs = CotSeguroPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseCotSeguroPeer::DATABASE_NAME)->addTableBuilder(BaseCotSeguroPeer::TABLE_NAME, BaseCotSeguroPeer::getMapBuilder());

