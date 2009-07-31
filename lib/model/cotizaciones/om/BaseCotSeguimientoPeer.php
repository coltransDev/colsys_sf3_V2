<?php


abstract class BaseCotSeguimientoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_cotseguimientos';

	
	const CLASS_DEFAULT = 'lib.model.cotizaciones.CotSeguimiento';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCOTIZACION = 'tb_cotseguimientos.CA_IDCOTIZACION';

	
	const CA_IDPRODUCTO = 'tb_cotseguimientos.CA_IDPRODUCTO';

	
	const CA_FCHSEGUIMIENTO = 'tb_cotseguimientos.CA_FCHSEGUIMIENTO';

	
	const CA_LOGIN = 'tb_cotseguimientos.CA_LOGIN';

	
	const CA_SEGUIMIENTO = 'tb_cotseguimientos.CA_SEGUIMIENTO';

	
	const CA_ETAPA = 'tb_cotseguimientos.CA_ETAPA';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdproducto', 'CaFchseguimiento', 'CaLogin', 'CaSeguimiento', 'CaEtapa', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdproducto', 'caFchseguimiento', 'caLogin', 'caSeguimiento', 'caEtapa', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDPRODUCTO, self::CA_FCHSEGUIMIENTO, self::CA_LOGIN, self::CA_SEGUIMIENTO, self::CA_ETAPA, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idproducto', 'ca_fchseguimiento', 'ca_login', 'ca_seguimiento', 'ca_etapa', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdproducto' => 1, 'CaFchseguimiento' => 2, 'CaLogin' => 3, 'CaSeguimiento' => 4, 'CaEtapa' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdproducto' => 1, 'caFchseguimiento' => 2, 'caLogin' => 3, 'caSeguimiento' => 4, 'caEtapa' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDPRODUCTO => 1, self::CA_FCHSEGUIMIENTO => 2, self::CA_LOGIN => 3, self::CA_SEGUIMIENTO => 4, self::CA_ETAPA => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idproducto' => 1, 'ca_fchseguimiento' => 2, 'ca_login' => 3, 'ca_seguimiento' => 4, 'ca_etapa' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotSeguimientoMapBuilder();
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
		return str_replace(CotSeguimientoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_IDPRODUCTO);

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_FCHSEGUIMIENTO);

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_LOGIN);

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_SEGUIMIENTO);

		$criteria->addSelectColumn(CotSeguimientoPeer::CA_ETAPA);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguimientoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
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
		$objects = CotSeguimientoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return CotSeguimientoPeer::populateObjects(CotSeguimientoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(CotSeguimiento $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaIdcotizacion(), (string) $obj->getCaIdproducto(), (string) $obj->getCaFchseguimiento()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof CotSeguimiento) {
				$key = serialize(array((string) $value->getCaIdcotizacion(), (string) $value->getCaIdproducto(), (string) $value->getCaFchseguimiento()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CotSeguimiento object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = CotSeguimientoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotSeguimientoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotSeguimientoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCotizacion(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguimientoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguimientoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguimientoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotizacionPeer::addSelectColumns($c);

		$c->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);
		CotProductoPeer::addSelectColumns($c);

		$c->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCotSeguimiento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(CotSeguimientoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$criteria->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol2 = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
		$c->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);
			} 
			
			$key3 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = CotProductoPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					CotProductoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotSeguimiento($obj1);
			} 
			
			$key4 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = UsuarioPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					UsuarioPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addCotSeguimiento($obj1);
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
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
				$criteria->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptCotProducto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$criteria->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotSeguimientoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$criteria->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol2 = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);
				$c->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);

			} 
				
				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotSeguimiento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptCotProducto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol2 = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$c->addJoin(array(CotSeguimientoPeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);

			} 
				
				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotSeguimiento($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotSeguimientoPeer::addSelectColumns($c);
		$startcol2 = (CotSeguimientoPeer::NUM_COLUMNS - CotSeguimientoPeer::NUM_LAZY_LOAD_COLUMNS);

		CotizacionPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		CotProductoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (CotProductoPeer::NUM_COLUMNS - CotProductoPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotizacionPeer::CA_IDCOTIZACION,), $join_behavior);
				$c->addJoin(array(CotSeguimientoPeer::CA_IDPRODUCTO,CotSeguimientoPeer::CA_IDCOTIZACION,), array(CotProductoPeer::CA_IDPRODUCTO,CotProductoPeer::CA_IDCOTIZACION,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotSeguimientoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotSeguimientoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = CotSeguimientoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotSeguimientoPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addCotSeguimiento($obj1);

			} 
				
				$key3 = CotProductoPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = CotProductoPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = CotProductoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					CotProductoPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addCotSeguimiento($obj1);

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
		return CotSeguimientoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotSeguimientoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseCotSeguimientoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(CotSeguimientoPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $criteria->remove(CotSeguimientoPeer::CA_IDCOTIZACION), $comparison);

			$comparison = $criteria->getComparison(CotSeguimientoPeer::CA_IDPRODUCTO);
			$selectCriteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $criteria->remove(CotSeguimientoPeer::CA_IDPRODUCTO), $comparison);

			$comparison = $criteria->getComparison(CotSeguimientoPeer::CA_FCHSEGUIMIENTO);
			$selectCriteria->add(CotSeguimientoPeer::CA_FCHSEGUIMIENTO, $criteria->remove(CotSeguimientoPeer::CA_FCHSEGUIMIENTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseCotSeguimientoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseCotSeguimientoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotSeguimientoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												CotSeguimientoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof CotSeguimiento) {
						CotSeguimientoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(CotSeguimientoPeer::CA_IDCOTIZACION, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(CotSeguimientoPeer::CA_IDPRODUCTO, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(CotSeguimientoPeer::CA_FCHSEGUIMIENTO, $value[2]));
				$criteria->addOr($criterion);

								CotSeguimientoPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(CotSeguimiento $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotSeguimientoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotSeguimientoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotSeguimientoPeer::DATABASE_NAME, CotSeguimientoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotSeguimientoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_idcotizacion, $ca_idproducto, $ca_fchseguimiento, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_idcotizacion, (string) $ca_idproducto, (string) $ca_fchseguimiento));
 		if (null !== ($obj = CotSeguimientoPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(CotSeguimientoPeer::DATABASE_NAME);
		$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $ca_idcotizacion);
		$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $ca_idproducto);
		$criteria->add(CotSeguimientoPeer::CA_FCHSEGUIMIENTO, $ca_fchseguimiento);
		$v = CotSeguimientoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseCotSeguimientoPeer::DATABASE_NAME)->addTableBuilder(BaseCotSeguimientoPeer::TABLE_NAME, BaseCotSeguimientoPeer::getMapBuilder());

