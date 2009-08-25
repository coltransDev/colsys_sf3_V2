<?php


abstract class BaseAduanaMaestraPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_brk_maestra';

	
	const CLASS_DEFAULT = 'lib.model.aduana.AduanaMaestra';

	
	const NUM_COLUMNS = 27;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_FCHREFERENCIA = 'tb_brk_maestra.CA_FCHREFERENCIA';

	
	const CA_REFERENCIA = 'tb_brk_maestra.CA_REFERENCIA';

	
	const CA_ORIGEN = 'tb_brk_maestra.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_brk_maestra.CA_DESTINO';

	
	const CA_IDCLIENTE = 'tb_brk_maestra.CA_IDCLIENTE';

	
	const CA_VENDEDOR = 'tb_brk_maestra.CA_VENDEDOR';

	
	const CA_COORDINADOR = 'tb_brk_maestra.CA_COORDINADOR';

	
	const CA_PROVEEDOR = 'tb_brk_maestra.CA_PROVEEDOR';

	
	const CA_PEDIDO = 'tb_brk_maestra.CA_PEDIDO';

	
	const CA_PIEZAS = 'tb_brk_maestra.CA_PIEZAS';

	
	const CA_PESO = 'tb_brk_maestra.CA_PESO';

	
	const CA_MERCANCIA = 'tb_brk_maestra.CA_MERCANCIA';

	
	const CA_DEPOSITO = 'tb_brk_maestra.CA_DEPOSITO';

	
	const CA_FCHARRIBO = 'tb_brk_maestra.CA_FCHARRIBO';

	
	const CA_MODALIDAD = 'tb_brk_maestra.CA_MODALIDAD';

	
	const CA_FCHCREADO = 'tb_brk_maestra.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_brk_maestra.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_brk_maestra.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_brk_maestra.CA_USUACTUALIZADO';

	
	const CA_FCHLIQUIDADO = 'tb_brk_maestra.CA_FCHLIQUIDADO';

	
	const CA_USULIQUIDADO = 'tb_brk_maestra.CA_USULIQUIDADO';

	
	const CA_FCHCERRADO = 'tb_brk_maestra.CA_FCHCERRADO';

	
	const CA_USUCERRADO = 'tb_brk_maestra.CA_USUCERRADO';

	
	const CA_NOMBRECONTACTO = 'tb_brk_maestra.CA_NOMBRECONTACTO';

	
	const CA_EMAIL = 'tb_brk_maestra.CA_EMAIL';

	
	const CA_ANALISTA = 'tb_brk_maestra.CA_ANALISTA';

	
	const CA_TRACKINGCODE = 'tb_brk_maestra.CA_TRACKINGCODE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaOrigen', 'CaDestino', 'CaIdcliente', 'CaVendedor', 'CaCoordinador', 'CaProveedor', 'CaPedido', 'CaPiezas', 'CaPeso', 'CaMercancia', 'CaDeposito', 'CaFcharribo', 'CaModalidad', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaNombrecontacto', 'CaEmail', 'CaAnalista', 'CaTrackingcode', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caOrigen', 'caDestino', 'caIdcliente', 'caVendedor', 'caCoordinador', 'caProveedor', 'caPedido', 'caPiezas', 'caPeso', 'caMercancia', 'caDeposito', 'caFcharribo', 'caModalidad', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', 'caNombrecontacto', 'caEmail', 'caAnalista', 'caTrackingcode', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IDCLIENTE, self::CA_VENDEDOR, self::CA_COORDINADOR, self::CA_PROVEEDOR, self::CA_PEDIDO, self::CA_PIEZAS, self::CA_PESO, self::CA_MERCANCIA, self::CA_DEPOSITO, self::CA_FCHARRIBO, self::CA_MODALIDAD, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_NOMBRECONTACTO, self::CA_EMAIL, self::CA_ANALISTA, self::CA_TRACKINGCODE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_origen', 'ca_destino', 'ca_idcliente', 'ca_vendedor', 'ca_coordinador', 'ca_proveedor', 'ca_pedido', 'ca_piezas', 'ca_peso', 'ca_mercancia', 'ca_deposito', 'ca_fcharribo', 'ca_modalidad', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_nombrecontacto', 'ca_email', 'ca_analista', 'ca_trackingcode', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaOrigen' => 2, 'CaDestino' => 3, 'CaIdcliente' => 4, 'CaVendedor' => 5, 'CaCoordinador' => 6, 'CaProveedor' => 7, 'CaPedido' => 8, 'CaPiezas' => 9, 'CaPeso' => 10, 'CaMercancia' => 11, 'CaDeposito' => 12, 'CaFcharribo' => 13, 'CaModalidad' => 14, 'CaFchcreado' => 15, 'CaUsucreado' => 16, 'CaFchactualizado' => 17, 'CaUsuactualizado' => 18, 'CaFchliquidado' => 19, 'CaUsuliquidado' => 20, 'CaFchcerrado' => 21, 'CaUsucerrado' => 22, 'CaNombrecontacto' => 23, 'CaEmail' => 24, 'CaAnalista' => 25, 'CaTrackingcode' => 26, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caOrigen' => 2, 'caDestino' => 3, 'caIdcliente' => 4, 'caVendedor' => 5, 'caCoordinador' => 6, 'caProveedor' => 7, 'caPedido' => 8, 'caPiezas' => 9, 'caPeso' => 10, 'caMercancia' => 11, 'caDeposito' => 12, 'caFcharribo' => 13, 'caModalidad' => 14, 'caFchcreado' => 15, 'caUsucreado' => 16, 'caFchactualizado' => 17, 'caUsuactualizado' => 18, 'caFchliquidado' => 19, 'caUsuliquidado' => 20, 'caFchcerrado' => 21, 'caUsucerrado' => 22, 'caNombrecontacto' => 23, 'caEmail' => 24, 'caAnalista' => 25, 'caTrackingcode' => 26, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_ORIGEN => 2, self::CA_DESTINO => 3, self::CA_IDCLIENTE => 4, self::CA_VENDEDOR => 5, self::CA_COORDINADOR => 6, self::CA_PROVEEDOR => 7, self::CA_PEDIDO => 8, self::CA_PIEZAS => 9, self::CA_PESO => 10, self::CA_MERCANCIA => 11, self::CA_DEPOSITO => 12, self::CA_FCHARRIBO => 13, self::CA_MODALIDAD => 14, self::CA_FCHCREADO => 15, self::CA_USUCREADO => 16, self::CA_FCHACTUALIZADO => 17, self::CA_USUACTUALIZADO => 18, self::CA_FCHLIQUIDADO => 19, self::CA_USULIQUIDADO => 20, self::CA_FCHCERRADO => 21, self::CA_USUCERRADO => 22, self::CA_NOMBRECONTACTO => 23, self::CA_EMAIL => 24, self::CA_ANALISTA => 25, self::CA_TRACKINGCODE => 26, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_origen' => 2, 'ca_destino' => 3, 'ca_idcliente' => 4, 'ca_vendedor' => 5, 'ca_coordinador' => 6, 'ca_proveedor' => 7, 'ca_pedido' => 8, 'ca_piezas' => 9, 'ca_peso' => 10, 'ca_mercancia' => 11, 'ca_deposito' => 12, 'ca_fcharribo' => 13, 'ca_modalidad' => 14, 'ca_fchcreado' => 15, 'ca_usucreado' => 16, 'ca_fchactualizado' => 17, 'ca_usuactualizado' => 18, 'ca_fchliquidado' => 19, 'ca_usuliquidado' => 20, 'ca_fchcerrado' => 21, 'ca_usucerrado' => 22, 'ca_nombrecontacto' => 23, 'ca_email' => 24, 'ca_analista' => 25, 'ca_trackingcode' => 26, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AduanaMaestraMapBuilder();
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
		return str_replace(AduanaMaestraPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ORIGEN);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DESTINO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_VENDEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_COORDINADOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PEDIDO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PIEZAS);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PESO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MERCANCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DEPOSITO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHARRIBO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_NOMBRECONTACTO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_EMAIL);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ANALISTA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_TRACKINGCODE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $criteria, $con);
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
		$objects = AduanaMaestraPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AduanaMaestraPeer::populateObjects(AduanaMaestraPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(AduanaMaestra $obj, $key = null)
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
			if (is_object($value) && $value instanceof AduanaMaestra) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or AduanaMaestra object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = AduanaMaestraPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AduanaMaestraPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AduanaMaestraPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaMaestraPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AduanaMaestraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaMaestraPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAduanaMaestra($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AduanaMaestraPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AduanaMaestraPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol2 = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AduanaMaestraPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AduanaMaestraPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AduanaMaestraPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AduanaMaestraPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AduanaMaestraPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addAduanaMaestra($obj1);
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
		return AduanaMaestraPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaMaestraPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAduanaMaestraPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AduanaMaestraPeer::CA_REFERENCIA);
			$selectCriteria->add(AduanaMaestraPeer::CA_REFERENCIA, $criteria->remove(AduanaMaestraPeer::CA_REFERENCIA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAduanaMaestraPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAduanaMaestraPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AduanaMaestraPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AduanaMaestraPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof AduanaMaestra) {
						AduanaMaestraPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								AduanaMaestraPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(AduanaMaestra $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AduanaMaestraPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AduanaMaestraPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AduanaMaestraPeer::DATABASE_NAME, AduanaMaestraPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AduanaMaestraPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AduanaMaestraPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pk);

		$v = AduanaMaestraPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = AduanaMaestraPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseAduanaMaestraPeer::DATABASE_NAME)->addTableBuilder(BaseAduanaMaestraPeer::TABLE_NAME, BaseAduanaMaestraPeer::getMapBuilder());

