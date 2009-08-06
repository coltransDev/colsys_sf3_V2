<?php


abstract class BaseTrayectoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_trayectos';

	
	const CLASS_DEFAULT = 'lib.model.pricing.Trayecto';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const OID = 'tb_trayectos.OID';

	
	const CA_IDTRAYECTO = 'tb_trayectos.CA_IDTRAYECTO';

	
	const CA_ORIGEN = 'tb_trayectos.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_trayectos.CA_DESTINO';

	
	const CA_IDLINEA = 'tb_trayectos.CA_IDLINEA';

	
	const CA_TRANSPORTE = 'tb_trayectos.CA_TRANSPORTE';

	
	const CA_TERMINAL = 'tb_trayectos.CA_TERMINAL';

	
	const CA_IMPOEXPO = 'tb_trayectos.CA_IMPOEXPO';

	
	const CA_FRECUENCIA = 'tb_trayectos.CA_FRECUENCIA';

	
	const CA_TIEMPOTRANSITO = 'tb_trayectos.CA_TIEMPOTRANSITO';

	
	const CA_MODALIDAD = 'tb_trayectos.CA_MODALIDAD';

	
	const CA_FCHCREADO = 'tb_trayectos.CA_FCHCREADO';

	
	const CA_IDTARIFAS = 'tb_trayectos.CA_IDTARIFAS';

	
	const CA_OBSERVACIONES = 'tb_trayectos.CA_OBSERVACIONES';

	
	const CA_IDAGENTE = 'tb_trayectos.CA_IDAGENTE';

	
	const CA_ACTIVO = 'tb_trayectos.CA_ACTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdtrayecto', 'CaOrigen', 'CaDestino', 'CaIdlinea', 'CaTransporte', 'CaTerminal', 'CaImpoexpo', 'CaFrecuencia', 'CaTiempotransito', 'CaModalidad', 'CaFchcreado', 'CaIdtarifas', 'CaObservaciones', 'CaIdagente', 'CaActivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid', 'caIdtrayecto', 'caOrigen', 'caDestino', 'caIdlinea', 'caTransporte', 'caTerminal', 'caImpoexpo', 'caFrecuencia', 'caTiempotransito', 'caModalidad', 'caFchcreado', 'caIdtarifas', 'caObservaciones', 'caIdagente', 'caActivo', ),
		BasePeer::TYPE_COLNAME => array (self::OID, self::CA_IDTRAYECTO, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IDLINEA, self::CA_TRANSPORTE, self::CA_TERMINAL, self::CA_IMPOEXPO, self::CA_FRECUENCIA, self::CA_TIEMPOTRANSITO, self::CA_MODALIDAD, self::CA_FCHCREADO, self::CA_IDTARIFAS, self::CA_OBSERVACIONES, self::CA_IDAGENTE, self::CA_ACTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idtrayecto', 'ca_origen', 'ca_destino', 'ca_idlinea', 'ca_transporte', 'ca_terminal', 'ca_impoexpo', 'ca_frecuencia', 'ca_tiempotransito', 'ca_modalidad', 'ca_fchcreado', 'ca_idtarifas', 'ca_observaciones', 'ca_idagente', 'ca_activo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdtrayecto' => 1, 'CaOrigen' => 2, 'CaDestino' => 3, 'CaIdlinea' => 4, 'CaTransporte' => 5, 'CaTerminal' => 6, 'CaImpoexpo' => 7, 'CaFrecuencia' => 8, 'CaTiempotransito' => 9, 'CaModalidad' => 10, 'CaFchcreado' => 11, 'CaIdtarifas' => 12, 'CaObservaciones' => 13, 'CaIdagente' => 14, 'CaActivo' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid' => 0, 'caIdtrayecto' => 1, 'caOrigen' => 2, 'caDestino' => 3, 'caIdlinea' => 4, 'caTransporte' => 5, 'caTerminal' => 6, 'caImpoexpo' => 7, 'caFrecuencia' => 8, 'caTiempotransito' => 9, 'caModalidad' => 10, 'caFchcreado' => 11, 'caIdtarifas' => 12, 'caObservaciones' => 13, 'caIdagente' => 14, 'caActivo' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::OID => 0, self::CA_IDTRAYECTO => 1, self::CA_ORIGEN => 2, self::CA_DESTINO => 3, self::CA_IDLINEA => 4, self::CA_TRANSPORTE => 5, self::CA_TERMINAL => 6, self::CA_IMPOEXPO => 7, self::CA_FRECUENCIA => 8, self::CA_TIEMPOTRANSITO => 9, self::CA_MODALIDAD => 10, self::CA_FCHCREADO => 11, self::CA_IDTARIFAS => 12, self::CA_OBSERVACIONES => 13, self::CA_IDAGENTE => 14, self::CA_ACTIVO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idtrayecto' => 1, 'ca_origen' => 2, 'ca_destino' => 3, 'ca_idlinea' => 4, 'ca_transporte' => 5, 'ca_terminal' => 6, 'ca_impoexpo' => 7, 'ca_frecuencia' => 8, 'ca_tiempotransito' => 9, 'ca_modalidad' => 10, 'ca_fchcreado' => 11, 'ca_idtarifas' => 12, 'ca_observaciones' => 13, 'ca_idagente' => 14, 'ca_activo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TrayectoMapBuilder();
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
		return str_replace(TrayectoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TrayectoPeer::OID);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(TrayectoPeer::CA_ORIGEN);

		$criteria->addSelectColumn(TrayectoPeer::CA_DESTINO);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDLINEA);

		$criteria->addSelectColumn(TrayectoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(TrayectoPeer::CA_TERMINAL);

		$criteria->addSelectColumn(TrayectoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(TrayectoPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(TrayectoPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(TrayectoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(TrayectoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDTARIFAS);

		$criteria->addSelectColumn(TrayectoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDAGENTE);

		$criteria->addSelectColumn(TrayectoPeer::CA_ACTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrayectoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
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
		$objects = TrayectoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TrayectoPeer::populateObjects(TrayectoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TrayectoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Trayecto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdtrayecto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Trayecto) {
				$key = (string) $value->getCaIdtrayecto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Trayecto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 1] === null) {
			return null;
		}
		return (string) $row[$startcol + 1];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = TrayectoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TrayectoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TrayectoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrayectoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrayectoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrayectoPeer::addSelectColumns($c);
		$startcol = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrayectoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TrayectoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrayectoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addTrayecto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrayectoPeer::addSelectColumns($c);
		$startcol = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);
		AgentePeer::addSelectColumns($c);

		$c->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrayectoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TrayectoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrayectoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AgentePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AgentePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrayecto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrayectoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$criteria->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrayectoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TrayectoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrayectoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addTrayecto($obj1);
			} 
			
			$key3 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = AgentePeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					AgentePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addTrayecto($obj1);
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
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrayectoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(TrayectoPeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrayectoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TrayectoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrayectoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AgentePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrayecto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(TrayectoPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrayectoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrayectoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TrayectoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrayectoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addTrayecto($obj1);

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
		return TrayectoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrayectoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTrayectoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrayectoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TrayectoPeer::CA_IDTRAYECTO);
			$selectCriteria->add(TrayectoPeer::CA_IDTRAYECTO, $criteria->remove(TrayectoPeer::CA_IDTRAYECTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTrayectoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTrayectoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TrayectoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TrayectoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Trayecto) {
						TrayectoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TrayectoPeer::CA_IDTRAYECTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TrayectoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Trayecto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TrayectoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TrayectoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TrayectoPeer::DATABASE_NAME, TrayectoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TrayectoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TrayectoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $pk);

		$v = TrayectoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
			$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $pks, Criteria::IN);
			$objs = TrayectoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTrayectoPeer::DATABASE_NAME)->addTableBuilder(BaseTrayectoPeer::TABLE_NAME, BaseTrayectoPeer::getMapBuilder());

