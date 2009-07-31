<?php


abstract class BaseCotProductoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotproductos';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotProducto';

	
	const NUM_COLUMNS = 24;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDPRODUCTO = 'tb_cotproductos.CA_IDPRODUCTO';

	
	const CA_IDCOTIZACION = 'tb_cotproductos.CA_IDCOTIZACION';

	
	const CA_TRANSPORTE = 'tb_cotproductos.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_cotproductos.CA_MODALIDAD';

	
	const CA_ORIGEN = 'tb_cotproductos.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_cotproductos.CA_DESTINO';

	
	const CA_ESCALA = 'tb_cotproductos.CA_ESCALA';

	
	const CA_IMPOEXPO = 'tb_cotproductos.CA_IMPOEXPO';

	
	const CA_IMPRIMIR = 'tb_cotproductos.CA_IMPRIMIR';

	
	const CA_PRODUCTO = 'tb_cotproductos.CA_PRODUCTO';

	
	const CA_INCOTERMS = 'tb_cotproductos.CA_INCOTERMS';

	
	const CA_FRECUENCIA = 'tb_cotproductos.CA_FRECUENCIA';

	
	const CA_TIEMPOTRANSITO = 'tb_cotproductos.CA_TIEMPOTRANSITO';

	
	const CA_LOCRECARGOS = 'tb_cotproductos.CA_LOCRECARGOS';

	
	const CA_OBSERVACIONES = 'tb_cotproductos.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_cotproductos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotproductos.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotproductos.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotproductos.CA_USUACTUALIZADO';

	
	const CA_DATOSAG = 'tb_cotproductos.CA_DATOSAG';

	
	const CA_IDLINEA = 'tb_cotproductos.CA_IDLINEA';

	
	const CA_POSTULARLINEA = 'tb_cotproductos.CA_POSTULARLINEA';

	
	const CA_ETAPA = 'tb_cotproductos.CA_ETAPA';

	
	const CA_IDTAREA = 'tb_cotproductos.CA_IDTAREA';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdproducto', 'CaIdcotizacion', 'CaTransporte', 'CaModalidad', 'CaOrigen', 'CaDestino', 'CaEscala', 'CaImpoexpo', 'CaImprimir', 'CaProducto', 'CaIncoterms', 'CaFrecuencia', 'CaTiempotransito', 'CaLocrecargos', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaDatosag', 'CaIdlinea', 'CaPostularlinea', 'CaEtapa', 'CaIdtarea', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdproducto', 'caIdcotizacion', 'caTransporte', 'caModalidad', 'caOrigen', 'caDestino', 'caEscala', 'caImpoexpo', 'caImprimir', 'caProducto', 'caIncoterms', 'caFrecuencia', 'caTiempotransito', 'caLocrecargos', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caDatosag', 'caIdlinea', 'caPostularlinea', 'caEtapa', 'caIdtarea', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPRODUCTO, self::CA_IDCOTIZACION, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_ORIGEN, self::CA_DESTINO, self::CA_ESCALA, self::CA_IMPOEXPO, self::CA_IMPRIMIR, self::CA_PRODUCTO, self::CA_INCOTERMS, self::CA_FRECUENCIA, self::CA_TIEMPOTRANSITO, self::CA_LOCRECARGOS, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_DATOSAG, self::CA_IDLINEA, self::CA_POSTULARLINEA, self::CA_ETAPA, self::CA_IDTAREA, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idproducto', 'ca_idcotizacion', 'ca_transporte', 'ca_modalidad', 'ca_origen', 'ca_destino', 'ca_escala', 'ca_impoexpo', 'ca_imprimir', 'ca_producto', 'ca_incoterms', 'ca_frecuencia', 'ca_tiempotransito', 'ca_locrecargos', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_datosag', 'ca_idlinea', 'ca_postularlinea', 'ca_etapa', 'ca_idtarea', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdproducto' => 0, 'CaIdcotizacion' => 1, 'CaTransporte' => 2, 'CaModalidad' => 3, 'CaOrigen' => 4, 'CaDestino' => 5, 'CaEscala' => 6, 'CaImpoexpo' => 7, 'CaImprimir' => 8, 'CaProducto' => 9, 'CaIncoterms' => 10, 'CaFrecuencia' => 11, 'CaTiempotransito' => 12, 'CaLocrecargos' => 13, 'CaObservaciones' => 14, 'CaFchcreado' => 15, 'CaUsucreado' => 16, 'CaFchactualizado' => 17, 'CaUsuactualizado' => 18, 'CaDatosag' => 19, 'CaIdlinea' => 20, 'CaPostularlinea' => 21, 'CaEtapa' => 22, 'CaIdtarea' => 23, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdproducto' => 0, 'caIdcotizacion' => 1, 'caTransporte' => 2, 'caModalidad' => 3, 'caOrigen' => 4, 'caDestino' => 5, 'caEscala' => 6, 'caImpoexpo' => 7, 'caImprimir' => 8, 'caProducto' => 9, 'caIncoterms' => 10, 'caFrecuencia' => 11, 'caTiempotransito' => 12, 'caLocrecargos' => 13, 'caObservaciones' => 14, 'caFchcreado' => 15, 'caUsucreado' => 16, 'caFchactualizado' => 17, 'caUsuactualizado' => 18, 'caDatosag' => 19, 'caIdlinea' => 20, 'caPostularlinea' => 21, 'caEtapa' => 22, 'caIdtarea' => 23, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDPRODUCTO => 0, self::CA_IDCOTIZACION => 1, self::CA_TRANSPORTE => 2, self::CA_MODALIDAD => 3, self::CA_ORIGEN => 4, self::CA_DESTINO => 5, self::CA_ESCALA => 6, self::CA_IMPOEXPO => 7, self::CA_IMPRIMIR => 8, self::CA_PRODUCTO => 9, self::CA_INCOTERMS => 10, self::CA_FRECUENCIA => 11, self::CA_TIEMPOTRANSITO => 12, self::CA_LOCRECARGOS => 13, self::CA_OBSERVACIONES => 14, self::CA_FCHCREADO => 15, self::CA_USUCREADO => 16, self::CA_FCHACTUALIZADO => 17, self::CA_USUACTUALIZADO => 18, self::CA_DATOSAG => 19, self::CA_IDLINEA => 20, self::CA_POSTULARLINEA => 21, self::CA_ETAPA => 22, self::CA_IDTAREA => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idproducto' => 0, 'ca_idcotizacion' => 1, 'ca_transporte' => 2, 'ca_modalidad' => 3, 'ca_origen' => 4, 'ca_destino' => 5, 'ca_escala' => 6, 'ca_impoexpo' => 7, 'ca_imprimir' => 8, 'ca_producto' => 9, 'ca_incoterms' => 10, 'ca_frecuencia' => 11, 'ca_tiempotransito' => 12, 'ca_locrecargos' => 13, 'ca_observaciones' => 14, 'ca_fchcreado' => 15, 'ca_usucreado' => 16, 'ca_fchactualizado' => 17, 'ca_usuactualizado' => 18, 'ca_datosag' => 19, 'ca_idlinea' => 20, 'ca_postularlinea' => 21, 'ca_etapa' => 22, 'ca_idtarea' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotProductoMapBuilder();
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
		return str_replace(CotProductoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotProductoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotProductoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotProductoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(CotProductoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotProductoPeer::CA_ORIGEN);

		$criteria->addSelectColumn(CotProductoPeer::CA_DESTINO);

		$criteria->addSelectColumn(CotProductoPeer::CA_ESCALA);

		$criteria->addSelectColumn(CotProductoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(CotProductoPeer::CA_IMPRIMIR);

		$criteria->addSelectColumn(CotProductoPeer::CA_PRODUCTO);

		$criteria->addSelectColumn(CotProductoPeer::CA_INCOTERMS);

		$criteria->addSelectColumn(CotProductoPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(CotProductoPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(CotProductoPeer::CA_LOCRECARGOS);

		$criteria->addSelectColumn(CotProductoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotProductoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotProductoPeer::CA_DATOSAG);

		$criteria->addSelectColumn(CotProductoPeer::CA_IDLINEA);

		$criteria->addSelectColumn(CotProductoPeer::CA_POSTULARLINEA);

		$criteria->addSelectColumn(CotProductoPeer::CA_ETAPA);

		$criteria->addSelectColumn(CotProductoPeer::CA_IDTAREA);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotProductoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
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
		$objects = CotProductoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotProductoPeer::populateObjects(CotProductoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotProductoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotProducto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdproducto(), (string) $obj->getCaIdcotizacion()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotProducto) {
				$key = serialize(array((string) $value->getCaIdproducto(), (string) $value->getCaIdcotizacion()));
			} elseif (is_array($value) && count($value) === 2) {
								$key = serialize(array((string) $value[0], (string) $value[1]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotProducto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotProductoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotProductoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotProductoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotProductoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotProductoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotProductoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotTareaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotTareaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotProducto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotProductoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$criteria->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol2 = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);
			} 
			
			$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TransportadorPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotProducto($obj1);
			} 
			
			$key4 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = NotTareaPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					NotTareaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addCotProducto($obj1);
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
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$criteria->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotProductoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$criteria->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol2 = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);

			} 
				
				$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = NotTareaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotProducto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol2 = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$c->addJoin(array(CotProductoPeer::CA_IDTAREA,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);

			} 
				
				$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = NotTareaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotProducto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotProductoPeer::addSelectColumns($c);
		$startcol2 = (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotProductoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$c->addJoin(array(CotProductoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotProductoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotProductoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotProductoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotProductoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotProducto($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotProducto($obj1);

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
		return CotProductoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotProductoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotProductoPeer::CA_IDPRODUCTO) && $criteria->keyContainsValue(CotProductoPeer::CA_IDPRODUCTO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotProductoPeer::CA_IDPRODUCTO.')');
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

		
    foreach (sfMixer::getCallables('BaseCotProductoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotProductoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotProductoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotProductoPeer::CA_IDPRODUCTO, $criteria->remove(CotProductoPeer::CA_IDPRODUCTO), $comparison);

			$comparison = $criteria->getComparison(CotProductoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotProductoPeer::CA_IDCOTIZACION, $criteria->remove(CotProductoPeer::CA_IDCOTIZACION), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotProductoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotProductoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotProductoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotProductoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotProducto) {
						CotProductoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(CotProductoPeer::CA_IDPRODUCTO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotProductoPeer::CA_IDCOTIZACION, $value[1]));
				$criteria->addOr($criterion);

								CotProductoPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(CotProducto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotProductoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotProductoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotProductoPeer::DATABASE_NAME, CotProductoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotProductoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idproducto, $ca_idcotizacion, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idproducto, (string) $ca_idcotizacion));
 		if (null !== ($obj = CotProductoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$v = CotProductoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseCotProductoPeer::DATABASE_NAME)->addTableBuilder(BaseCotProductoPeer::TABLE_NAME, BaseCotProductoPeer::getMapBuilder());

