<?php


abstract class BaseCotContinuacionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotcontinuacion';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotContinuacion';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCONTINUACION = 'tb_cotcontinuacion.CA_IDCONTINUACION';

	
	const CA_IDCOTIZACION = 'tb_cotcontinuacion.CA_IDCOTIZACION';

	
	const CA_TIPO = 'tb_cotcontinuacion.CA_TIPO';

	
	const CA_MODALIDAD = 'tb_cotcontinuacion.CA_MODALIDAD';

	
	const CA_ORIGEN = 'tb_cotcontinuacion.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_cotcontinuacion.CA_DESTINO';

	
	const CA_IDCONCEPTO = 'tb_cotcontinuacion.CA_IDCONCEPTO';

	
	const CA_IDMONEDA = 'tb_cotcontinuacion.CA_IDMONEDA';

	
	const CA_IDEQUIPO = 'tb_cotcontinuacion.CA_IDEQUIPO';

	
	const CA_TARIFA = 'tb_cotcontinuacion.CA_TARIFA';

	
	const CA_VALOR_TAR = 'tb_cotcontinuacion.CA_VALOR_TAR';

	
	const CA_VALOR_MIN = 'tb_cotcontinuacion.CA_VALOR_MIN';

	
	const CA_FRECUENCIA = 'tb_cotcontinuacion.CA_FRECUENCIA';

	
	const CA_TIEMPOTRANSITO = 'tb_cotcontinuacion.CA_TIEMPOTRANSITO';

	
	const CA_OBSERVACIONES = 'tb_cotcontinuacion.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_cotcontinuacion.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotcontinuacion.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotcontinuacion.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotcontinuacion.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontinuacion', 'CaIdcotizacion', 'CaTipo', 'CaModalidad', 'CaOrigen', 'CaDestino', 'CaIdconcepto', 'CaIdmoneda', 'CaIdequipo', 'CaTarifa', 'CaValorTar', 'CaValorMin', 'CaFrecuencia', 'CaTiempotransito', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontinuacion', 'caIdcotizacion', 'caTipo', 'caModalidad', 'caOrigen', 'caDestino', 'caIdconcepto', 'caIdmoneda', 'caIdequipo', 'caTarifa', 'caValorTar', 'caValorMin', 'caFrecuencia', 'caTiempotransito', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTINUACION, self::CA_IDCOTIZACION, self::CA_TIPO, self::CA_MODALIDAD, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IDCONCEPTO, self::CA_IDMONEDA, self::CA_IDEQUIPO, self::CA_TARIFA, self::CA_VALOR_TAR, self::CA_VALOR_MIN, self::CA_FRECUENCIA, self::CA_TIEMPOTRANSITO, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontinuacion', 'ca_idcotizacion', 'ca_tipo', 'ca_modalidad', 'ca_origen', 'ca_destino', 'ca_idconcepto', 'ca_idmoneda', 'ca_idequipo', 'ca_tarifa', 'ca_valor_tar', 'ca_valor_min', 'ca_frecuencia', 'ca_tiempotransito', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontinuacion' => 0, 'CaIdcotizacion' => 1, 'CaTipo' => 2, 'CaModalidad' => 3, 'CaOrigen' => 4, 'CaDestino' => 5, 'CaIdconcepto' => 6, 'CaIdmoneda' => 7, 'CaIdequipo' => 8, 'CaTarifa' => 9, 'CaValorTar' => 10, 'CaValorMin' => 11, 'CaFrecuencia' => 12, 'CaTiempotransito' => 13, 'CaObservaciones' => 14, 'CaFchcreado' => 15, 'CaUsucreado' => 16, 'CaFchactualizado' => 17, 'CaUsuactualizado' => 18, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontinuacion' => 0, 'caIdcotizacion' => 1, 'caTipo' => 2, 'caModalidad' => 3, 'caOrigen' => 4, 'caDestino' => 5, 'caIdconcepto' => 6, 'caIdmoneda' => 7, 'caIdequipo' => 8, 'caTarifa' => 9, 'caValorTar' => 10, 'caValorMin' => 11, 'caFrecuencia' => 12, 'caTiempotransito' => 13, 'caObservaciones' => 14, 'caFchcreado' => 15, 'caUsucreado' => 16, 'caFchactualizado' => 17, 'caUsuactualizado' => 18, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTINUACION => 0, self::CA_IDCOTIZACION => 1, self::CA_TIPO => 2, self::CA_MODALIDAD => 3, self::CA_ORIGEN => 4, self::CA_DESTINO => 5, self::CA_IDCONCEPTO => 6, self::CA_IDMONEDA => 7, self::CA_IDEQUIPO => 8, self::CA_TARIFA => 9, self::CA_VALOR_TAR => 10, self::CA_VALOR_MIN => 11, self::CA_FRECUENCIA => 12, self::CA_TIEMPOTRANSITO => 13, self::CA_OBSERVACIONES => 14, self::CA_FCHCREADO => 15, self::CA_USUCREADO => 16, self::CA_FCHACTUALIZADO => 17, self::CA_USUACTUALIZADO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontinuacion' => 0, 'ca_idcotizacion' => 1, 'ca_tipo' => 2, 'ca_modalidad' => 3, 'ca_origen' => 4, 'ca_destino' => 5, 'ca_idconcepto' => 6, 'ca_idmoneda' => 7, 'ca_idequipo' => 8, 'ca_tarifa' => 9, 'ca_valor_tar' => 10, 'ca_valor_min' => 11, 'ca_frecuencia' => 12, 'ca_tiempotransito' => 13, 'ca_observaciones' => 14, 'ca_fchcreado' => 15, 'ca_usucreado' => 16, 'ca_fchactualizado' => 17, 'ca_usuactualizado' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotContinuacionMapBuilder();
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
		return str_replace(CotContinuacionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDCONTINUACION);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TIPO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_ORIGEN);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_DESTINO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_IDEQUIPO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TARIFA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotContinuacionPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContinuacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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
		$objects = CotContinuacionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotContinuacionPeer::populateObjects(CotContinuacionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotContinuacionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotContinuacion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontinuacion();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotContinuacion) {
				$key = (string) $value->getCaIdcontinuacion();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotContinuacion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotContinuacionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotContinuacionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotContinuacionPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContinuacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(CotContinuacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContinuacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotContinuacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContinuacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotContinuacion($obj1);

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

		CotContinuacionPeer::addSelectColumns($c);
		$startcol = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContinuacionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotContinuacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContinuacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotContinuacion($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotContinuacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContinuacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotContinuacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContinuacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotContinuacion($obj1);
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
								$obj3->addCotContinuacion($obj1);
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
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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
			CotContinuacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotContinuacionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContinuacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotContinuacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContinuacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotContinuacion($obj1);

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

		CotContinuacionPeer::addSelectColumns($c);
		$startcol2 = (CotContinuacionPeer::NUM_COLUMNS - CotContinuacionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotContinuacionPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotContinuacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotContinuacionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotContinuacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotContinuacionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotContinuacion($obj1);

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
		return CotContinuacionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotContinuacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotContinuacionPeer::CA_IDCONTINUACION) && $criteria->keyContainsValue(CotContinuacionPeer::CA_IDCONTINUACION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotContinuacionPeer::CA_IDCONTINUACION.')');
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

		
    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotContinuacionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotContinuacionPeer::CA_IDCONTINUACION);
			$selectCriteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $criteria->remove(CotContinuacionPeer::CA_IDCONTINUACION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotContinuacionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotContinuacionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotContinuacionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotContinuacionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotContinuacion) {
						CotContinuacionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								CotContinuacionPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(CotContinuacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotContinuacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotContinuacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotContinuacionPeer::DATABASE_NAME, CotContinuacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotContinuacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CotContinuacionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);
		$criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $pk);

		$v = CotContinuacionPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);
			$criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $pks, Criteria::IN);
			$objs = CotContinuacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseCotContinuacionPeer::DATABASE_NAME)->addTableBuilder(BaseCotContinuacionPeer::TABLE_NAME, BaseCotContinuacionPeer::getMapBuilder());

