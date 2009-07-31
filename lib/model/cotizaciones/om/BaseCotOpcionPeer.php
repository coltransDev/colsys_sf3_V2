<?php


abstract class BaseCotOpcionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotopciones';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotOpcion';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDOPCION = 'tb_cotopciones.CA_IDOPCION';

	
	const CA_IDCOTIZACION = 'tb_cotopciones.CA_IDCOTIZACION';

	
	const CA_IDPRODUCTO = 'tb_cotopciones.CA_IDPRODUCTO';

	
	const CA_IDCONCEPTO = 'tb_cotopciones.CA_IDCONCEPTO';

	
	const CA_VALOR_TAR = 'tb_cotopciones.CA_VALOR_TAR';

	
	const CA_APLICA_TAR = 'tb_cotopciones.CA_APLICA_TAR';

	
	const CA_VALOR_MIN = 'tb_cotopciones.CA_VALOR_MIN';

	
	const CA_APLICA_MIN = 'tb_cotopciones.CA_APLICA_MIN';

	
	const CA_IDMONEDA = 'tb_cotopciones.CA_IDMONEDA';

	
	const CA_RECARGOS = 'tb_cotopciones.CA_RECARGOS';

	
	const CA_OBSERVACIONES = 'tb_cotopciones.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_cotopciones.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_cotopciones.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_cotopciones.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_cotopciones.CA_USUACTUALIZADO';

	
	const CA_CONSECUTIVO = 'tb_cotopciones.CA_CONSECUTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion', 'CaIdcotizacion', 'CaIdproducto', 'CaIdconcepto', 'CaValorTar', 'CaAplicaTar', 'CaValorMin', 'CaAplicaMin', 'CaIdmoneda', 'CaRecargos', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaConsecutivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdopcion', 'caIdcotizacion', 'caIdproducto', 'caIdconcepto', 'caValorTar', 'caAplicaTar', 'caValorMin', 'caAplicaMin', 'caIdmoneda', 'caRecargos', 'caObservaciones', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDOPCION, self::CA_IDCOTIZACION, self::CA_IDPRODUCTO, self::CA_IDCONCEPTO, self::CA_VALOR_TAR, self::CA_APLICA_TAR, self::CA_VALOR_MIN, self::CA_APLICA_MIN, self::CA_IDMONEDA, self::CA_RECARGOS, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion', 'ca_idcotizacion', 'ca_idproducto', 'ca_idconcepto', 'ca_valor_tar', 'ca_aplica_tar', 'ca_valor_min', 'ca_aplica_min', 'ca_idmoneda', 'ca_recargos', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdopcion' => 0, 'CaIdcotizacion' => 1, 'CaIdproducto' => 2, 'CaIdconcepto' => 3, 'CaValorTar' => 4, 'CaAplicaTar' => 5, 'CaValorMin' => 6, 'CaAplicaMin' => 7, 'CaIdmoneda' => 8, 'CaRecargos' => 9, 'CaObservaciones' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaFchactualizado' => 13, 'CaUsuactualizado' => 14, 'CaConsecutivo' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdopcion' => 0, 'caIdcotizacion' => 1, 'caIdproducto' => 2, 'caIdconcepto' => 3, 'caValorTar' => 4, 'caAplicaTar' => 5, 'caValorMin' => 6, 'caAplicaMin' => 7, 'caIdmoneda' => 8, 'caRecargos' => 9, 'caObservaciones' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caFchactualizado' => 13, 'caUsuactualizado' => 14, 'caConsecutivo' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDOPCION => 0, self::CA_IDCOTIZACION => 1, self::CA_IDPRODUCTO => 2, self::CA_IDCONCEPTO => 3, self::CA_VALOR_TAR => 4, self::CA_APLICA_TAR => 5, self::CA_VALOR_MIN => 6, self::CA_APLICA_MIN => 7, self::CA_IDMONEDA => 8, self::CA_RECARGOS => 9, self::CA_OBSERVACIONES => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_FCHACTUALIZADO => 13, self::CA_USUACTUALIZADO => 14, self::CA_CONSECUTIVO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idopcion' => 0, 'ca_idcotizacion' => 1, 'ca_idproducto' => 2, 'ca_idconcepto' => 3, 'ca_valor_tar' => 4, 'ca_aplica_tar' => 5, 'ca_valor_min' => 6, 'ca_aplica_min' => 7, 'ca_idmoneda' => 8, 'ca_recargos' => 9, 'ca_observaciones' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_fchactualizado' => 13, 'ca_usuactualizado' => 14, 'ca_consecutivo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotOpcionMapBuilder();
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
		return str_replace(CotOpcionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDOPCION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_TAR);

		$criteria->addSelectColumn(CotOpcionPeer::CA_VALOR_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_APLICA_MIN);

		$criteria->addSelectColumn(CotOpcionPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(CotOpcionPeer::CA_RECARGOS);

		$criteria->addSelectColumn(CotOpcionPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotOpcionPeer::CA_CONSECUTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
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
		$objects = CotOpcionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotOpcionPeer::populateObjects(CotOpcionPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotOpcionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotOpcion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdopcion(), (string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdproducto()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotOpcion) {
				$key = serialize(array((string) $value->getCaIdopcion(), (string) $value->getCaIdcotizacion(), (string) $value->getCaIdproducto()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotOpcion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = CotOpcionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotOpcionPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotOpcionPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);
		CotProductoPeer::addSelectColumns($c);

		$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CotProductoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotProductoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotOpcion($obj1);

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

		CotOpcionPeer::addSelectColumns($c);
		$startcol = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotOpcion($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotOpcionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CotProductoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotOpcion($obj1);
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
								$obj3->addCotOpcion($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
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
			CotOpcionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ConceptoPeer::NUM_COLUMNS - ConceptoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotOpcionPeer::CA_IDCONCEPTO,), array(ConceptoPeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotOpcion($obj1);

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

		CotOpcionPeer::addSelectColumns($c);
		$startcol2 = (CotOpcionPeer::NUM_COLUMNS - CotOpcionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotOpcionPeer::CA_IDPRODUCTO,CotOpcionPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotOpcionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotOpcionPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotOpcionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotOpcionPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CotProductoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CotProductoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotOpcion($obj1);

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
		return CotOpcionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotOpcionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(CotOpcionPeer::CA_IDOPCION) && $criteria->keyContainsValue(CotOpcionPeer::CA_IDOPCION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotOpcionPeer::CA_IDOPCION.')');
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

		
    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotOpcionPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDOPCION);
			$selectCriteria->add(CotOpcionPeer::CA_IDOPCION, $criteria->remove(CotOpcionPeer::CA_IDOPCION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotOpcionPeer::CA_IDCOTIZACION, $criteria->remove(CotOpcionPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotOpcionPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotOpcionPeer::CA_IDPRODUCTO, $criteria->remove(CotOpcionPeer::CA_IDPRODUCTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotOpcionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotOpcionPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotOpcionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotOpcionPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotOpcion) {
						CotOpcionPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(CotOpcionPeer::CA_IDOPCION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotOpcionPeer::CA_IDCOTIZACION, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(CotOpcionPeer::CA_IDPRODUCTO, $value[2]));
				$criteria->addOr($criterion);

								CotOpcionPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(CotOpcion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotOpcionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotOpcionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotOpcionPeer::DATABASE_NAME, CotOpcionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotOpcionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idopcion, $ca_idcotizacion, $ca_idproducto, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idopcion, (string) $ca_idcotizacion, (string) $ca_idproducto));
 		if (null !== ($obj = CotOpcionPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);
		$criteria->add(CotOpcionPeer::CA_IDOPCION, $ca_idopcion);
		$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $ca_idproducto);
		$v = CotOpcionPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseCotOpcionPeer::DATABASE_NAME)->addTableBuilder(BaseCotOpcionPeer::TABLE_NAME, BaseCotOpcionPeer::getMapBuilder());

