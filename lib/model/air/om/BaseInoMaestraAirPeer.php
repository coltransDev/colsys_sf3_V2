<?php


abstract class BaseInoMaestraAirPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inomaestra_air';

	
	const CLASS_DEFAULT = 'lib.model.air.InoMaestraAir';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_FCHREFERENCIA = 'tb_inomaestra_air.CA_FCHREFERENCIA';

	
	const CA_REFERENCIA = 'tb_inomaestra_air.CA_REFERENCIA';

	
	const CA_IMPOEXPO = 'tb_inomaestra_air.CA_IMPOEXPO';

	
	const CA_ORIGEN = 'tb_inomaestra_air.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_inomaestra_air.CA_DESTINO';

	
	const CA_MODALIDAD = 'tb_inomaestra_air.CA_MODALIDAD';

	
	const CA_IDLINEA = 'tb_inomaestra_air.CA_IDLINEA';

	
	const CA_MAWB = 'tb_inomaestra_air.CA_MAWB';

	
	const CA_PIEZAS = 'tb_inomaestra_air.CA_PIEZAS';

	
	const CA_PESO = 'tb_inomaestra_air.CA_PESO';

	
	const CA_PESOVOLUMEN = 'tb_inomaestra_air.CA_PESOVOLUMEN';

	
	const CA_OBSERVACIONES = 'tb_inomaestra_air.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_inomaestra_air.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inomaestra_air.CA_USUCREADO';

	
	const CA_FCHPREAVISO = 'tb_inomaestra_air.CA_FCHPREAVISO';

	
	const CA_FCHLLEGADA = 'tb_inomaestra_air.CA_FCHLLEGADA';

	
	const CA_FCHACTUALIZADO = 'tb_inomaestra_air.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inomaestra_air.CA_USUACTUALIZADO';

	
	const CA_FCHLIQUIDADO = 'tb_inomaestra_air.CA_FCHLIQUIDADO';

	
	const CA_USULIQUIDADO = 'tb_inomaestra_air.CA_USULIQUIDADO';

	
	const CA_FCHCERRADO = 'tb_inomaestra_air.CA_FCHCERRADO';

	
	const CA_USUCERRADO = 'tb_inomaestra_air.CA_USUCERRADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaModalidad', 'CaIdlinea', 'CaMawb', 'CaPiezas', 'CaPeso', 'CaPesovolumen', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchpreaviso', 'CaFchllegada', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caImpoexpo', 'caOrigen', 'caDestino', 'caModalidad', 'caIdlinea', 'caMawb', 'caPiezas', 'caPeso', 'caPesovolumen', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchpreaviso', 'caFchllegada', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_IMPOEXPO, self::CA_ORIGEN, self::CA_DESTINO, self::CA_MODALIDAD, self::CA_IDLINEA, self::CA_MAWB, self::CA_PIEZAS, self::CA_PESO, self::CA_PESOVOLUMEN, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHPREAVISO, self::CA_FCHLLEGADA, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_impoexpo', 'ca_origen', 'ca_destino', 'ca_modalidad', 'ca_idlinea', 'ca_mawb', 'ca_piezas', 'ca_peso', 'ca_pesovolumen', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchpreaviso', 'ca_fchllegada', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaImpoexpo' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaModalidad' => 5, 'CaIdlinea' => 6, 'CaMawb' => 7, 'CaPiezas' => 8, 'CaPeso' => 9, 'CaPesovolumen' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaFchpreaviso' => 14, 'CaFchllegada' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, 'CaFchliquidado' => 18, 'CaUsuliquidado' => 19, 'CaFchcerrado' => 20, 'CaUsucerrado' => 21, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caImpoexpo' => 2, 'caOrigen' => 3, 'caDestino' => 4, 'caModalidad' => 5, 'caIdlinea' => 6, 'caMawb' => 7, 'caPiezas' => 8, 'caPeso' => 9, 'caPesovolumen' => 10, 'caObservaciones' => 11, 'caFchcreado' => 12, 'caUsucreado' => 13, 'caFchpreaviso' => 14, 'caFchllegada' => 15, 'caFchactualizado' => 16, 'caUsuactualizado' => 17, 'caFchliquidado' => 18, 'caUsuliquidado' => 19, 'caFchcerrado' => 20, 'caUsucerrado' => 21, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_IMPOEXPO => 2, self::CA_ORIGEN => 3, self::CA_DESTINO => 4, self::CA_MODALIDAD => 5, self::CA_IDLINEA => 6, self::CA_MAWB => 7, self::CA_PIEZAS => 8, self::CA_PESO => 9, self::CA_PESOVOLUMEN => 10, self::CA_OBSERVACIONES => 11, self::CA_FCHCREADO => 12, self::CA_USUCREADO => 13, self::CA_FCHPREAVISO => 14, self::CA_FCHLLEGADA => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUACTUALIZADO => 17, self::CA_FCHLIQUIDADO => 18, self::CA_USULIQUIDADO => 19, self::CA_FCHCERRADO => 20, self::CA_USUCERRADO => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_modalidad' => 5, 'ca_idlinea' => 6, 'ca_mawb' => 7, 'ca_piezas' => 8, 'ca_peso' => 9, 'ca_pesovolumen' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_fchpreaviso' => 14, 'ca_fchllegada' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, 'ca_fchliquidado' => 18, 'ca_usuliquidado' => 19, 'ca_fchcerrado' => 20, 'ca_usucerrado' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoMaestraAirMapBuilder();
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
		return str_replace(InoMaestraAirPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_ORIGEN);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_DESTINO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_IDLINEA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_MAWB);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PIEZAS);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PESO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_PESOVOLUMEN);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHPREAVISO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(InoMaestraAirPeer::CA_USUCERRADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $criteria, $con);
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
		$objects = InoMaestraAirPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoMaestraAirPeer::populateObjects(InoMaestraAirPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoMaestraAir $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaReferencia();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoMaestraAir) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoMaestraAir object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = InoMaestraAirPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoMaestraAirPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoMaestraAirPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoMaestraAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraAirPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoMaestraAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoMaestraAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoMaestraAirPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoMaestraAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraAirPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoMaestraAir($obj1);
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
		return InoMaestraAirPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoMaestraAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoMaestraAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoMaestraAirPeer::CA_REFERENCIA);
			$selectCriteria->add(InoMaestraAirPeer::CA_REFERENCIA, $criteria->remove(InoMaestraAirPeer::CA_REFERENCIA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoMaestraAirPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoMaestraAirPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraAirPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoMaestraAirPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoMaestraAir) {
						InoMaestraAirPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								InoMaestraAirPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(InoMaestraAir $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoMaestraAirPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoMaestraAirPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoMaestraAirPeer::DATABASE_NAME, InoMaestraAirPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoMaestraAirPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = InoMaestraAirPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $pk);

		$v = InoMaestraAirPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
			$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraAirPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseInoMaestraAirPeer::DATABASE_NAME)->addTableBuilder(BaseInoMaestraAirPeer::TABLE_NAME, BaseInoMaestraAirPeer::getMapBuilder());

