<?php


abstract class BaseCotRecargoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotrecargos';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotRecargo';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCOTIZACION = 'tb_cotrecargos.CA_IDCOTIZACION';

	
	const CA_IDPRODUCTO = 'tb_cotrecargos.CA_IDPRODUCTO';

	
	const CA_IDOPCION = 'tb_cotrecargos.CA_IDOPCION';

	
	const CA_IDCONCEPTO = 'tb_cotrecargos.CA_IDCONCEPTO';

	
	const CA_IDRECARGO = 'tb_cotrecargos.CA_IDRECARGO';

	
	const CA_TIPO = 'tb_cotrecargos.CA_TIPO';

	
	const CA_VALOR_TAR = 'tb_cotrecargos.CA_VALOR_TAR';

	
	const CA_APLICA_TAR = 'tb_cotrecargos.CA_APLICA_TAR';

	
	const CA_VALOR_MIN = 'tb_cotrecargos.CA_VALOR_MIN';

	
	const CA_APLICA_MIN = 'tb_cotrecargos.CA_APLICA_MIN';

	
	const CA_IDMONEDA = 'tb_cotrecargos.CA_IDMONEDA';

	
	const CA_MODALIDAD = 'tb_cotrecargos.CA_MODALIDAD';

	
	const CA_OBSERVACIONES = 'tb_cotrecargos.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_cotrecargos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotrecargos.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotrecargos.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotrecargos.CA_USUACTUALIZADO';

	
	const CA_CONSECUTIVO = 'tb_cotrecargos.CA_CONSECUTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdproducto', 'CaIdopcion', 'CaIdconcepto', 'CaIdrecargo', 'CaTipo', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaModalidad', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdproducto', 'caIdopcion', 'caIdconcepto', 'caIdrecargo', 'caTipo', 'caValorTar', 'caAplicaTar', 'caValorMin', 'caAplicaMin', 'caIdmoneda', 'caModalidad', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDPRODUCTO, self::CA_IDOPCION, self::CA_IDCONCEPTO, self::CA_IDRECARGO, self::CA_TIPO, self::CA_VALOR_TAR, self::CA_APLICA_TAR, self::CA_VALOR_MIN, self::CA_APLICA_MIN, self::CA_IDMONEDA, self::CA_MODALIDAD, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idproducto', 'ca_idopcion', 'ca_idconcepto', 'ca_idrecargo', 'ca_tipo', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_modalidad', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdproducto' => 1, 'CaIdopcion' => 2, 'CaIdconcepto' => 3, 'CaIdrecargo' => 4, 'CaTipo' => 5, 'CaValorTar' => 6, 'CaAplicaTar' => 7, 'CaValorMin' => 8, 'CaAplicaMin' => 9, 'CaIdmoneda' => 10, 'CaModalidad' => 11, 'CaObservaciones' => 12, 'CaFchcreado' => 13, 'CaUsucreado' => 14, 'CaFchactualizado' => 15, 'CaUsuactualizado' => 16, 'CaConsecutivo' => 17, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdproducto' => 1, 'caIdopcion' => 2, 'caIdconcepto' => 3, 'caIdrecargo' => 4, 'caTipo' => 5, 'caValorTar' => 6, 'caAplicaTar' => 7, 'caValorMin' => 8, 'caAplicaMin' => 9, 'caIdmoneda' => 10, 'caModalidad' => 11, 'caObservaciones' => 12, 'caFchcreado' => 13, 'caUsucreado' => 14, 'caFchactualizado' => 15, 'caUsuactualizado' => 16, 'caConsecutivo' => 17, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDPRODUCTO => 1, self::CA_IDOPCION => 2, self::CA_IDCONCEPTO => 3, self::CA_IDRECARGO => 4, self::CA_TIPO => 5, self::CA_VALOR_TAR => 6, self::CA_APLICA_TAR => 7, self::CA_VALOR_MIN => 8, self::CA_APLICA_MIN => 9, self::CA_IDMONEDA => 10, self::CA_MODALIDAD => 11, self::CA_OBSERVACIONES => 12, self::CA_FCHCREADO => 13, self::CA_USUCREADO => 14, self::CA_FCHACTUALIZADO => 15, self::CA_USUACTUALIZADO => 16, self::CA_CONSECUTIVO => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idproducto' => 1, 'ca_idopcion' => 2, 'ca_idconcepto' => 3, 'ca_idrecargo' => 4, 'ca_tipo' => 5, 'ca_valor_tar' => 6, 'ca_aplica_tar' => 7, 'ca_valor_min' => 8, 'ca_aplica_min' => 9, 'ca_idmoneda' => 10, 'ca_modalidad' => 11, 'ca_observaciones' => 12, 'ca_fchcreado' => 13, 'ca_usucreado' => 14, 'ca_fchactualizado' => 15, 'ca_usuactualizado' => 16, 'ca_consecutivo' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotRecargoMapBuilder();
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
		return str_replace(CotRecargoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_TIPO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotRecargoPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotRecargoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotRecargoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(CotRecargoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotRecargoPeer::CA_CONSECUTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
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
		$objects = CotRecargoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotRecargoPeer::populateObjects(CotRecargoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotRecargoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotRecargo $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdproducto(), (string) $obj->getCaIdopcion(), (string) $obj->getCaIdconcepto(), (string) $obj->getCaIdrecargo(), (string) $obj->getCaModalidad()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotRecargo) {
				$key = serialize(array((string) $value->getCaIdcotizacion(), (string) $value->getCaIdproducto(), (string) $value->getCaIdopcion(), (string) $value->getCaIdconcepto(), (string) $value->getCaIdrecargo(), (string) $value->getCaModalidad()));
			} elseif (is_array($value) && count($value) === 6) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3], (string) $value[4], (string) $value[5]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotRecargo object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null && $row[$startcol + 4] === null && $row[$startcol + 11] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3], (string) $row[$startcol + 4], (string) $row[$startcol + 11]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = CotRecargoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotRecargoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotRecargoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotOpcion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCotOpcion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotOpcionPeer::addSelectColumns($c);

		$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotOpcionPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotRecargo($obj1);

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

		CotRecargoPeer::addSelectColumns($c);
		$startcol = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotRecargo($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotRecargoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);
		$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotOpcionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotRecargo($obj1);
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
								$obj3->addCotRecargo($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptCotOpcion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
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
			CotRecargoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptCotOpcion(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotRecargoPeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotRecargo($obj1);

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

		CotRecargoPeer::addSelectColumns($c);
		$startcol2 = (CotRecargoPeer::NUM_COLUMNS - CotRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotOpcionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotRecargoPeer::CA_IDOPCION,), array(CotOpcionPeer::CA_IDOPCION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotRecargoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotRecargoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotRecargoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotRecargoPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CotOpcionPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CotOpcionPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotOpcionPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotRecargo($obj1);

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
		return CotRecargoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotRecargoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotRecargoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotRecargoPeer::CA_IDCOTIZACION, $criteria->remove(CotRecargoPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDPRODUCTO, $criteria->remove(CotRecargoPeer::CA_IDPRODUCTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDOPCION);
			$selectCriteria->add(CotRecargoPeer::CA_IDOPCION, $criteria->remove(CotRecargoPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDCONCEPTO);
			$selectCriteria->add(CotRecargoPeer::CA_IDCONCEPTO, $criteria->remove(CotRecargoPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_IDRECARGO);
			$selectCriteria->add(CotRecargoPeer::CA_IDRECARGO, $criteria->remove(CotRecargoPeer::CA_IDRECARGO), $comparison);

			$comparison = $criteria->getComparison(CotRecargoPeer::CA_MODALIDAD);
			$selectCriteria->add(CotRecargoPeer::CA_MODALIDAD, $criteria->remove(CotRecargoPeer::CA_MODALIDAD), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotRecargoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotRecargoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotRecargoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotRecargoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotRecargo) {
						CotRecargoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(CotRecargoPeer::CA_IDCOTIZACION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDPRODUCTO, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDOPCION, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDCONCEPTO, $value[3]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_IDRECARGO, $value[4]));
				$criterion->addAnd($criteria->getNewCriterion(CotRecargoPeer::CA_MODALIDAD, $value[5]));
				$criteria->addOr($criterion);

								CotRecargoPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(CotRecargo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotRecargoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotRecargoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotRecargoPeer::DATABASE_NAME, CotRecargoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotRecargoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idcotizacion, $ca_idproducto, $ca_idopcion, $ca_idconcepto, $ca_idrecargo, $ca_modalidad, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idcotizacion, (string) $ca_idproducto, (string) $ca_idopcion, (string) $ca_idconcepto, (string) $ca_idrecargo, (string) $ca_modalidad));
 		if (null !== ($obj = CotRecargoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);
		$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$criteria->add(CotRecargoPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $ca_idrecargo);
		$criteria->add(CotRecargoPeer::CA_MODALIDAD, $ca_modalidad);
		$v = CotRecargoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseCotRecargoPeer::DATABASE_NAME)->addTableBuilder(BaseCotRecargoPeer::TABLE_NAME, BaseCotRecargoPeer::getMapBuilder());

