<?php


abstract class BaseInoClientesAirPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inoclientes_air';

	
	const CLASS_DEFAULT = 'lib.model.air.InoClientesAir';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_inoclientes_air.CA_REFERENCIA';

	
	const CA_IDCLIENTE = 'tb_inoclientes_air.CA_IDCLIENTE';

	
	const CA_HAWB = 'tb_inoclientes_air.CA_HAWB';

	
	const CA_IDREPORTE = 'tb_inoclientes_air.CA_IDREPORTE';

	
	const CA_IDPROVEEDOR = 'tb_inoclientes_air.CA_IDPROVEEDOR';

	
	const CA_PROVEEDOR = 'tb_inoclientes_air.CA_PROVEEDOR';

	
	const CA_NUMPIEZAS = 'tb_inoclientes_air.CA_NUMPIEZAS';

	
	const CA_PESO = 'tb_inoclientes_air.CA_PESO';

	
	const CA_VOLUMEN = 'tb_inoclientes_air.CA_VOLUMEN';

	
	const CA_NUMORDEN = 'tb_inoclientes_air.CA_NUMORDEN';

	
	const CA_LOGINVENDEDOR = 'tb_inoclientes_air.CA_LOGINVENDEDOR';

	
	const CA_FCHCREADO = 'tb_inoclientes_air.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inoclientes_air.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_inoclientes_air.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inoclientes_air.CA_USUACTUALIZADO';

	
	const CA_IDBODEGA = 'tb_inoclientes_air.CA_IDBODEGA';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHawb', 'CaIdreporte', 'CaIdproveedor', 'CaProveedor', 'CaNumpiezas', 'CaPeso', 'CaVolumen', 'CaNumorden', 'CaLoginvendedor', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaIdbodega', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdcliente', 'caHawb', 'caIdreporte', 'caIdproveedor', 'caProveedor', 'caNumpiezas', 'caPeso', 'caVolumen', 'caNumorden', 'caLoginvendedor', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caIdbodega', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HAWB, self::CA_IDREPORTE, self::CA_IDPROVEEDOR, self::CA_PROVEEDOR, self::CA_NUMPIEZAS, self::CA_PESO, self::CA_VOLUMEN, self::CA_NUMORDEN, self::CA_LOGINVENDEDOR, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_IDBODEGA, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hawb', 'ca_idreporte', 'ca_idproveedor', 'ca_proveedor', 'ca_numpiezas', 'ca_peso', 'ca_volumen', 'ca_numorden', 'ca_loginvendedor', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_idbodega', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHawb' => 2, 'CaIdreporte' => 3, 'CaIdproveedor' => 4, 'CaProveedor' => 5, 'CaNumpiezas' => 6, 'CaPeso' => 7, 'CaVolumen' => 8, 'CaNumorden' => 9, 'CaLoginvendedor' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaFchactualizado' => 13, 'CaUsuactualizado' => 14, 'CaIdbodega' => 15, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdcliente' => 1, 'caHawb' => 2, 'caIdreporte' => 3, 'caIdproveedor' => 4, 'caProveedor' => 5, 'caNumpiezas' => 6, 'caPeso' => 7, 'caVolumen' => 8, 'caNumorden' => 9, 'caLoginvendedor' => 10, 'caFchcreado' => 11, 'caUsucreado' => 12, 'caFchactualizado' => 13, 'caUsuactualizado' => 14, 'caIdbodega' => 15, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDCLIENTE => 1, self::CA_HAWB => 2, self::CA_IDREPORTE => 3, self::CA_IDPROVEEDOR => 4, self::CA_PROVEEDOR => 5, self::CA_NUMPIEZAS => 6, self::CA_PESO => 7, self::CA_VOLUMEN => 8, self::CA_NUMORDEN => 9, self::CA_LOGINVENDEDOR => 10, self::CA_FCHCREADO => 11, self::CA_USUCREADO => 12, self::CA_FCHACTUALIZADO => 13, self::CA_USUACTUALIZADO => 14, self::CA_IDBODEGA => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hawb' => 2, 'ca_idreporte' => 3, 'ca_idproveedor' => 4, 'ca_proveedor' => 5, 'ca_numpiezas' => 6, 'ca_peso' => 7, 'ca_volumen' => 8, 'ca_numorden' => 9, 'ca_loginvendedor' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_fchactualizado' => 13, 'ca_usuactualizado' => 14, 'ca_idbodega' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoClientesAirMapBuilder();
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
		return str_replace(InoClientesAirPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoClientesAirPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_HAWB);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_NUMPIEZAS);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_PESO);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_NUMORDEN);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_LOGINVENDEDOR);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoClientesAirPeer::CA_IDBODEGA);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
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
		$objects = InoClientesAirPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoClientesAirPeer::populateObjects(InoClientesAirPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoClientesAirPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoClientesAir $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHawb()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoClientesAir) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHawb()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoClientesAir object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = InoClientesAirPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoClientesAirPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoClientesAirPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinInoMaestraAir(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TerceroPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TerceroPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinInoMaestraAir(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraAirPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoMaestraAirPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraAirPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoMaestraAirPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$criteria->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol2 = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$c->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ReportePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);
			} 
			
			$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TerceroPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesAir($obj1);
			} 
			
			$key4 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = InoMaestraAirPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = InoMaestraAirPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraAirPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesAir($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptInoMaestraAir(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol2 = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TerceroPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
				
				$key3 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = InoMaestraAirPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = InoMaestraAirPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					InoMaestraAirPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol2 = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ReportePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
				
				$key3 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = InoMaestraAirPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = InoMaestraAirPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					InoMaestraAirPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptInoMaestraAir(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesAirPeer::addSelectColumns($c);
		$startcol2 = (InoClientesAirPeer::NUM_COLUMNS - InoClientesAirPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesAirPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesAirPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesAirPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = ReportePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ReportePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ReportePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ReportePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesAir($obj1);

			} 
				
				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesAir($obj1);

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
		return InoClientesAirPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoClientesAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoClientesAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoClientesAirPeer::CA_REFERENCIA);
			$selectCriteria->add(InoClientesAirPeer::CA_REFERENCIA, $criteria->remove(InoClientesAirPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoClientesAirPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoClientesAirPeer::CA_IDCLIENTE, $criteria->remove(InoClientesAirPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoClientesAirPeer::CA_HAWB);
			$selectCriteria->add(InoClientesAirPeer::CA_HAWB, $criteria->remove(InoClientesAirPeer::CA_HAWB), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoClientesAirPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesAirPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoClientesAirPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoClientesAirPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoClientesAir) {
						InoClientesAirPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoClientesAirPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoClientesAirPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoClientesAirPeer::CA_HAWB, $value[2]));
				$criteria->addOr($criterion);

								InoClientesAirPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoClientesAir $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoClientesAirPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoClientesAirPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoClientesAirPeer::DATABASE_NAME, InoClientesAirPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoClientesAirPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hawb, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hawb));
 		if (null !== ($obj = InoClientesAirPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);
		$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoClientesAirPeer::CA_HAWB, $ca_hawb);
		$v = InoClientesAirPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoClientesAirPeer::DATABASE_NAME)->addTableBuilder(BaseInoClientesAirPeer::TABLE_NAME, BaseInoClientesAirPeer::getMapBuilder());

