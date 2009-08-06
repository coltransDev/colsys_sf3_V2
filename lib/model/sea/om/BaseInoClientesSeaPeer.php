<?php


abstract class BaseInoClientesSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inoclientes_sea';

	
	const CLASS_DEFAULT = 'lib.model.sea.InoClientesSea';

	
	const NUM_COLUMNS = 26;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const OID = 'tb_inoclientes_sea.OID';

	
	const CA_REFERENCIA = 'tb_inoclientes_sea.CA_REFERENCIA';

	
	const CA_IDCLIENTE = 'tb_inoclientes_sea.CA_IDCLIENTE';

	
	const CA_HBLS = 'tb_inoclientes_sea.CA_HBLS';

	
	const CA_IDREPORTE = 'tb_inoclientes_sea.CA_IDREPORTE';

	
	const CA_IDPROVEEDOR = 'tb_inoclientes_sea.CA_IDPROVEEDOR';

	
	const CA_PROVEEDOR = 'tb_inoclientes_sea.CA_PROVEEDOR';

	
	const CA_NUMPIEZAS = 'tb_inoclientes_sea.CA_NUMPIEZAS';

	
	const CA_PESO = 'tb_inoclientes_sea.CA_PESO';

	
	const CA_VOLUMEN = 'tb_inoclientes_sea.CA_VOLUMEN';

	
	const CA_NUMORDEN = 'tb_inoclientes_sea.CA_NUMORDEN';

	
	const CA_CONFIRMAR = 'tb_inoclientes_sea.CA_CONFIRMAR';

	
	const CA_LOGIN = 'tb_inoclientes_sea.CA_LOGIN';

	
	const CA_OBSERVACIONES = 'tb_inoclientes_sea.CA_OBSERVACIONES';

	
	const CA_FCHLIBERACION = 'tb_inoclientes_sea.CA_FCHLIBERACION';

	
	const CA_NOTALIBERACION = 'tb_inoclientes_sea.CA_NOTALIBERACION';

	
	const CA_FCHCREADO = 'tb_inoclientes_sea.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inoclientes_sea.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_inoclientes_sea.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_inoclientes_sea.CA_USUACTUALIZADO';

	
	const CA_FCHLIBERADO = 'tb_inoclientes_sea.CA_FCHLIBERADO';

	
	const CA_USULIBERADO = 'tb_inoclientes_sea.CA_USULIBERADO';

	
	const CA_MENSAJE = 'tb_inoclientes_sea.CA_MENSAJE';

	
	const CA_CONTINUACION = 'tb_inoclientes_sea.CA_CONTINUACION';

	
	const CA_CONTINUACION_DEST = 'tb_inoclientes_sea.CA_CONTINUACION_DEST';

	
	const CA_IDBODEGA = 'tb_inoclientes_sea.CA_IDBODEGA';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaReferencia', 'CaIdcliente', 'CaHbls', 'CaIdreporte', 'CaIdproveedor', 'CaProveedor', 'CaNumpiezas', 'CaPeso', 'CaVolumen', 'CaNumorden', 'CaConfirmar', 'CaLogin', 'CaObservaciones', 'CaFchliberacion', 'CaNotaliberacion', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliberado', 'CaUsuliberado', 'CaMensaje', 'CaContinuacion', 'CaContinuacionDest', 'CaIdbodega', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid', 'caReferencia', 'caIdcliente', 'caHbls', 'caIdreporte', 'caIdproveedor', 'caProveedor', 'caNumpiezas', 'caPeso', 'caVolumen', 'caNumorden', 'caConfirmar', 'caLogin', 'caObservaciones', 'caFchliberacion', 'caNotaliberacion', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliberado', 'caUsuliberado', 'caMensaje', 'caContinuacion', 'caContinuacionDest', 'caIdbodega', ),
		BasePeer::TYPE_COLNAME => array (self::OID, self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HBLS, self::CA_IDREPORTE, self::CA_IDPROVEEDOR, self::CA_PROVEEDOR, self::CA_NUMPIEZAS, self::CA_PESO, self::CA_VOLUMEN, self::CA_NUMORDEN, self::CA_CONFIRMAR, self::CA_LOGIN, self::CA_OBSERVACIONES, self::CA_FCHLIBERACION, self::CA_NOTALIBERACION, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIBERADO, self::CA_USULIBERADO, self::CA_MENSAJE, self::CA_CONTINUACION, self::CA_CONTINUACION_DEST, self::CA_IDBODEGA, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_idreporte', 'ca_idproveedor', 'ca_proveedor', 'ca_numpiezas', 'ca_peso', 'ca_volumen', 'ca_numorden', 'ca_confirmar', 'ca_login', 'ca_observaciones', 'ca_fchliberacion', 'ca_notaliberacion', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliberado', 'ca_usuliberado', 'ca_mensaje', 'ca_continuacion', 'ca_continuacion_dest', 'ca_idbodega', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaReferencia' => 1, 'CaIdcliente' => 2, 'CaHbls' => 3, 'CaIdreporte' => 4, 'CaIdproveedor' => 5, 'CaProveedor' => 6, 'CaNumpiezas' => 7, 'CaPeso' => 8, 'CaVolumen' => 9, 'CaNumorden' => 10, 'CaConfirmar' => 11, 'CaLogin' => 12, 'CaObservaciones' => 13, 'CaFchliberacion' => 14, 'CaNotaliberacion' => 15, 'CaFchcreado' => 16, 'CaUsucreado' => 17, 'CaFchactualizado' => 18, 'CaUsuactualizado' => 19, 'CaFchliberado' => 20, 'CaUsuliberado' => 21, 'CaMensaje' => 22, 'CaContinuacion' => 23, 'CaContinuacionDest' => 24, 'CaIdbodega' => 25, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('oid' => 0, 'caReferencia' => 1, 'caIdcliente' => 2, 'caHbls' => 3, 'caIdreporte' => 4, 'caIdproveedor' => 5, 'caProveedor' => 6, 'caNumpiezas' => 7, 'caPeso' => 8, 'caVolumen' => 9, 'caNumorden' => 10, 'caConfirmar' => 11, 'caLogin' => 12, 'caObservaciones' => 13, 'caFchliberacion' => 14, 'caNotaliberacion' => 15, 'caFchcreado' => 16, 'caUsucreado' => 17, 'caFchactualizado' => 18, 'caUsuactualizado' => 19, 'caFchliberado' => 20, 'caUsuliberado' => 21, 'caMensaje' => 22, 'caContinuacion' => 23, 'caContinuacionDest' => 24, 'caIdbodega' => 25, ),
		BasePeer::TYPE_COLNAME => array (self::OID => 0, self::CA_REFERENCIA => 1, self::CA_IDCLIENTE => 2, self::CA_HBLS => 3, self::CA_IDREPORTE => 4, self::CA_IDPROVEEDOR => 5, self::CA_PROVEEDOR => 6, self::CA_NUMPIEZAS => 7, self::CA_PESO => 8, self::CA_VOLUMEN => 9, self::CA_NUMORDEN => 10, self::CA_CONFIRMAR => 11, self::CA_LOGIN => 12, self::CA_OBSERVACIONES => 13, self::CA_FCHLIBERACION => 14, self::CA_NOTALIBERACION => 15, self::CA_FCHCREADO => 16, self::CA_USUCREADO => 17, self::CA_FCHACTUALIZADO => 18, self::CA_USUACTUALIZADO => 19, self::CA_FCHLIBERADO => 20, self::CA_USULIBERADO => 21, self::CA_MENSAJE => 22, self::CA_CONTINUACION => 23, self::CA_CONTINUACION_DEST => 24, self::CA_IDBODEGA => 25, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_referencia' => 1, 'ca_idcliente' => 2, 'ca_hbls' => 3, 'ca_idreporte' => 4, 'ca_idproveedor' => 5, 'ca_proveedor' => 6, 'ca_numpiezas' => 7, 'ca_peso' => 8, 'ca_volumen' => 9, 'ca_numorden' => 10, 'ca_confirmar' => 11, 'ca_login' => 12, 'ca_observaciones' => 13, 'ca_fchliberacion' => 14, 'ca_notaliberacion' => 15, 'ca_fchcreado' => 16, 'ca_usucreado' => 17, 'ca_fchactualizado' => 18, 'ca_usuactualizado' => 19, 'ca_fchliberado' => 20, 'ca_usuliberado' => 21, 'ca_mensaje' => 22, 'ca_continuacion' => 23, 'ca_continuacion_dest' => 24, 'ca_idbodega' => 25, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoClientesSeaMapBuilder();
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
		return str_replace(InoClientesSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoClientesSeaPeer::OID);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMPIEZAS);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_PESO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NUMORDEN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONFIRMAR);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_LOGIN);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_NOTALIBERACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_FCHLIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_USULIBERADO);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_MENSAJE);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_CONTINUACION_DEST);

		$criteria->addSelectColumn(InoClientesSeaPeer::CA_IDBODEGA);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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
		$objects = InoClientesSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoClientesSeaPeer::populateObjects(InoClientesSeaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoClientesSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHbls()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoClientesSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHbls()));
			} elseif (is_array($value) && count($value) === 3) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoClientesSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = InoClientesSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoClientesSeaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoClientesSeaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ReportePeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraSeaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoClientesSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoClientesSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);
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
								$obj3->addInoClientesSea($obj1);
			} 
			
			$key4 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = ClientePeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ClientePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesSea($obj1);
			} 
			
			$key5 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = InoMaestraSeaPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					InoMaestraSeaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addInoClientesSea($obj1);
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
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptInoMaestraSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoClientesSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

			} 
				
				$key3 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ClientePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ClientePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesSea($obj1);

			} 
				
				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesSea($obj1);

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

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

			} 
				
				$key3 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = ClientePeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					ClientePeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoClientesSea($obj1);

			} 
				
				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

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
								$obj3->addInoClientesSea($obj1);

			} 
				
				$key4 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = InoMaestraSeaPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					InoMaestraSeaPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptInoMaestraSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol2 = (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoClientesSeaPeer::CA_IDREPORTE,), array(ReportePeer::CA_IDREPORTE,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(InoClientesSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoClientesSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoClientesSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoClientesSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoClientesSea($obj1);

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
								$obj3->addInoClientesSea($obj1);

			} 
				
				$key4 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = ClientePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					ClientePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoClientesSea($obj1);

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
		return InoClientesSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoClientesSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoClientesSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoClientesSeaPeer::CA_REFERENCIA, $criteria->remove(InoClientesSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $criteria->remove(InoClientesSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoClientesSeaPeer::CA_HBLS);
			$selectCriteria->add(InoClientesSeaPeer::CA_HBLS, $criteria->remove(InoClientesSeaPeer::CA_HBLS), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoClientesSeaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoClientesSeaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoClientesSeaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoClientesSeaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoClientesSea) {
						InoClientesSeaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoClientesSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoClientesSeaPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoClientesSeaPeer::CA_HBLS, $value[2]));
				$criteria->addOr($criterion);

								InoClientesSeaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoClientesSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoClientesSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoClientesSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoClientesSeaPeer::DATABASE_NAME, InoClientesSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoClientesSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hbls, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hbls));
 		if (null !== ($obj = InoClientesSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoClientesSeaPeer::CA_HBLS, $ca_hbls);
		$v = InoClientesSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoClientesSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoClientesSeaPeer::TABLE_NAME, BaseInoClientesSeaPeer::getMapBuilder());

