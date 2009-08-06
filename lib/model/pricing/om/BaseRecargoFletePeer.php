<?php


abstract class BaseRecargoFletePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_recargos';

	
	const CLASS_DEFAULT = 'lib.model.pricing.RecargoFlete';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRAYECTO = 'tb_recargos.CA_IDTRAYECTO';

	
	const CA_IDCONCEPTO = 'tb_recargos.CA_IDCONCEPTO';

	
	const CA_IDRECARGO = 'tb_recargos.CA_IDRECARGO';

	
	const CA_APLICACION = 'tb_recargos.CA_APLICACION';

	
	const CA_VLRFIJO = 'tb_recargos.CA_VLRFIJO';

	
	const CA_PORCENTAJE = 'tb_recargos.CA_PORCENTAJE';

	
	const CA_BASEPORCENTAJE = 'tb_recargos.CA_BASEPORCENTAJE';

	
	const CA_VLRUNITARIO = 'tb_recargos.CA_VLRUNITARIO';

	
	const CA_BASEUNITARIO = 'tb_recargos.CA_BASEUNITARIO';

	
	const CA_RECARGOMINIMO = 'tb_recargos.CA_RECARGOMINIMO';

	
	const CA_IDMONEDA = 'tb_recargos.CA_IDMONEDA';

	
	const CA_OBSERVACIONES = 'tb_recargos.CA_OBSERVACIONES';

	
	const CA_FCHINICIO = 'tb_recargos.CA_FCHINICIO';

	
	const CA_FCHVENCIMIENTO = 'tb_recargos.CA_FCHVENCIMIENTO';

	
	const CA_FCHCREADO = 'tb_recargos.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_recargos.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_recargos.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_recargos.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto', 'CaIdconcepto', 'CaIdrecargo', 'CaAplicacion', 'CaVlrfijo', 'CaPorcentaje', 'CaBaseporcentaje', 'CaVlrunitario', 'CaBaseunitario', 'CaRecargominimo', 'CaIdmoneda', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto', 'caIdconcepto', 'caIdrecargo', 'caAplicacion', 'caVlrfijo', 'caPorcentaje', 'caBaseporcentaje', 'caVlrunitario', 'caBaseunitario', 'caRecargominimo', 'caIdmoneda', 'caObservaciones', 'caFchinicio', 'caFchvencimiento', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO, self::CA_IDCONCEPTO, self::CA_IDRECARGO, self::CA_APLICACION, self::CA_VLRFIJO, self::CA_PORCENTAJE, self::CA_BASEPORCENTAJE, self::CA_VLRUNITARIO, self::CA_BASEUNITARIO, self::CA_RECARGOMINIMO, self::CA_IDMONEDA, self::CA_OBSERVACIONES, self::CA_FCHINICIO, self::CA_FCHVENCIMIENTO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto', 'ca_idconcepto', 'ca_idrecargo', 'ca_aplicacion', 'ca_vlrfijo', 'ca_porcentaje', 'ca_baseporcentaje', 'ca_vlrunitario', 'ca_baseunitario', 'ca_recargominimo', 'ca_idmoneda', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto' => 0, 'CaIdconcepto' => 1, 'CaIdrecargo' => 2, 'CaAplicacion' => 3, 'CaVlrfijo' => 4, 'CaPorcentaje' => 5, 'CaBaseporcentaje' => 6, 'CaVlrunitario' => 7, 'CaBaseunitario' => 8, 'CaRecargominimo' => 9, 'CaIdmoneda' => 10, 'CaObservaciones' => 11, 'CaFchinicio' => 12, 'CaFchvencimiento' => 13, 'CaFchcreado' => 14, 'CaUsucreado' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtrayecto' => 0, 'caIdconcepto' => 1, 'caIdrecargo' => 2, 'caAplicacion' => 3, 'caVlrfijo' => 4, 'caPorcentaje' => 5, 'caBaseporcentaje' => 6, 'caVlrunitario' => 7, 'caBaseunitario' => 8, 'caRecargominimo' => 9, 'caIdmoneda' => 10, 'caObservaciones' => 11, 'caFchinicio' => 12, 'caFchvencimiento' => 13, 'caFchcreado' => 14, 'caUsucreado' => 15, 'caFchactualizado' => 16, 'caUsuactualizado' => 17, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRAYECTO => 0, self::CA_IDCONCEPTO => 1, self::CA_IDRECARGO => 2, self::CA_APLICACION => 3, self::CA_VLRFIJO => 4, self::CA_PORCENTAJE => 5, self::CA_BASEPORCENTAJE => 6, self::CA_VLRUNITARIO => 7, self::CA_BASEUNITARIO => 8, self::CA_RECARGOMINIMO => 9, self::CA_IDMONEDA => 10, self::CA_OBSERVACIONES => 11, self::CA_FCHINICIO => 12, self::CA_FCHVENCIMIENTO => 13, self::CA_FCHCREADO => 14, self::CA_USUCREADO => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUACTUALIZADO => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto' => 0, 'ca_idconcepto' => 1, 'ca_idrecargo' => 2, 'ca_aplicacion' => 3, 'ca_vlrfijo' => 4, 'ca_porcentaje' => 5, 'ca_baseporcentaje' => 6, 'ca_vlrunitario' => 7, 'ca_baseunitario' => 8, 'ca_recargominimo' => 9, 'ca_idmoneda' => 10, 'ca_observaciones' => 11, 'ca_fchinicio' => 12, 'ca_fchvencimiento' => 13, 'ca_fchcreado' => 14, 'ca_usucreado' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new RecargoFleteMapBuilder();
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
		return str_replace(RecargoFletePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RecargoFletePeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_IDRECARGO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_APLICACION);

		$criteria->addSelectColumn(RecargoFletePeer::CA_VLRFIJO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_PORCENTAJE);

		$criteria->addSelectColumn(RecargoFletePeer::CA_BASEPORCENTAJE);

		$criteria->addSelectColumn(RecargoFletePeer::CA_VLRUNITARIO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_BASEUNITARIO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_RECARGOMINIMO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_IDMONEDA);

		$criteria->addSelectColumn(RecargoFletePeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(RecargoFletePeer::CA_FCHINICIO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_FCHCREADO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_USUCREADO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(RecargoFletePeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
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
		$objects = RecargoFletePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return RecargoFletePeer::populateObjects(RecargoFletePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			RecargoFletePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(RecargoFlete $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdtrayecto(), (string) $obj->getCaIdconcepto(), (string) $obj->getCaIdrecargo()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof RecargoFlete) {
				$key = serialize(array((string) $value->getCaIdtrayecto(), (string) $value->getCaIdconcepto(), (string) $value->getCaIdrecargo()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or RecargoFlete object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = RecargoFletePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = RecargoFletePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				RecargoFletePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(RecargoFletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RecargoFletePeer::addSelectColumns($c);
		$startcol = (RecargoFletePeer::NUM_COLUMNS - RecargoFletePeer::NUM_LAZY_LOAD_COLUMNS);
		FletePeer::addSelectColumns($c);

		$c->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFletePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RecargoFletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFletePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = FletePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = FletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FletePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					FletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRecargoFlete($obj1);

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

		RecargoFletePeer::addSelectColumns($c);
		$startcol = (RecargoFletePeer::NUM_COLUMNS - RecargoFletePeer::NUM_LAZY_LOAD_COLUMNS);
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFletePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = RecargoFletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFletePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRecargoFlete($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(RecargoFletePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);
		$criteria->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RecargoFletePeer::addSelectColumns($c);
		$startcol2 = (RecargoFletePeer::NUM_COLUMNS - RecargoFletePeer::NUM_LAZY_LOAD_COLUMNS);

		FletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);
		$c->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RecargoFletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFletePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = FletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = FletePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = FletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRecargoFlete($obj1);
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
								$obj3->addRecargoFlete($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptFlete(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
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
			RecargoFletePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptFlete(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RecargoFletePeer::addSelectColumns($c);
		$startcol2 = (RecargoFletePeer::NUM_COLUMNS - RecargoFletePeer::NUM_LAZY_LOAD_COLUMNS);

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TipoRecargoPeer::NUM_COLUMNS - TipoRecargoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RecargoFletePeer::CA_IDRECARGO,), array(TipoRecargoPeer::CA_IDRECARGO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RecargoFletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFletePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addRecargoFlete($obj1);

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

		RecargoFletePeer::addSelectColumns($c);
		$startcol2 = (RecargoFletePeer::NUM_COLUMNS - RecargoFletePeer::NUM_LAZY_LOAD_COLUMNS);

		FletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (FletePeer::NUM_COLUMNS - FletePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(RecargoFletePeer::CA_IDTRAYECTO,RecargoFletePeer::CA_IDCONCEPTO,), array(FletePeer::CA_IDTRAYECTO,FletePeer::CA_IDCONCEPTO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = RecargoFletePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = RecargoFletePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = RecargoFletePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				RecargoFletePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = FletePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = FletePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = FletePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					FletePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addRecargoFlete($obj1);

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
		return RecargoFletePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRecargoFletePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRecargoFletePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(RecargoFletePeer::CA_IDTRAYECTO);
			$selectCriteria->add(RecargoFletePeer::CA_IDTRAYECTO, $criteria->remove(RecargoFletePeer::CA_IDTRAYECTO), $comparison);

			$comparison = $criteria->getComparison(RecargoFletePeer::CA_IDCONCEPTO);
			$selectCriteria->add(RecargoFletePeer::CA_IDCONCEPTO, $criteria->remove(RecargoFletePeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(RecargoFletePeer::CA_IDRECARGO);
			$selectCriteria->add(RecargoFletePeer::CA_IDRECARGO, $criteria->remove(RecargoFletePeer::CA_IDRECARGO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRecargoFletePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRecargoFletePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(RecargoFletePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												RecargoFletePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof RecargoFlete) {
						RecargoFletePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(RecargoFletePeer::CA_IDTRAYECTO, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(RecargoFletePeer::CA_IDCONCEPTO, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(RecargoFletePeer::CA_IDRECARGO, $value[2]));
				$criteria->addOr($criterion);

								RecargoFletePeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(RecargoFlete $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RecargoFletePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RecargoFletePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RecargoFletePeer::DATABASE_NAME, RecargoFletePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RecargoFletePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idtrayecto, $ca_idconcepto, $ca_idrecargo, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idtrayecto, (string) $ca_idconcepto, (string) $ca_idrecargo));
 		if (null !== ($obj = RecargoFletePeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(RecargoFletePeer::DATABASE_NAME);
		$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $ca_idtrayecto);
		$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(RecargoFletePeer::CA_IDRECARGO, $ca_idrecargo);
		$v = RecargoFletePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseRecargoFletePeer::DATABASE_NAME)->addTableBuilder(BaseRecargoFletePeer::TABLE_NAME, BaseRecargoFletePeer::getMapBuilder());

