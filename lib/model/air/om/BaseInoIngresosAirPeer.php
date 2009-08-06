<?php


abstract class BaseInoIngresosAirPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inoingresos_air';

	
	const CLASS_DEFAULT = 'lib.model.air.InoIngresosAir';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_inoingresos_air.CA_REFERENCIA';

	
	const CA_IDCLIENTE = 'tb_inoingresos_air.CA_IDCLIENTE';

	
	const CA_HAWB = 'tb_inoingresos_air.CA_HAWB';

	
	const CA_FACTURA = 'tb_inoingresos_air.CA_FACTURA';

	
	const CA_FCHFACTURA = 'tb_inoingresos_air.CA_FCHFACTURA';

	
	const CA_VALOR = 'tb_inoingresos_air.CA_VALOR';

	
	const CA_RECCAJA = 'tb_inoingresos_air.CA_RECCAJA';

	
	const CA_FCHPAGO = 'tb_inoingresos_air.CA_FCHPAGO';

	
	const CA_TCALAICO = 'tb_inoingresos_air.CA_TCALAICO';

	
	const CA_FCHCREADO = 'tb_inoingresos_air.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_inoingresos_air.CA_USUCREADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHawb', 'CaFactura', 'CaFchfactura', 'CaValor', 'CaReccaja', 'CaFchpago', 'CaTcalaico', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdcliente', 'caHawb', 'caFactura', 'caFchfactura', 'caValor', 'caReccaja', 'caFchpago', 'caTcalaico', 'caFchcreado', 'caUsucreado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HAWB, self::CA_FACTURA, self::CA_FCHFACTURA, self::CA_VALOR, self::CA_RECCAJA, self::CA_FCHPAGO, self::CA_TCALAICO, self::CA_FCHCREADO, self::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hawb', 'ca_factura', 'ca_fchfactura', 'ca_valor', 'ca_reccaja', 'ca_fchpago', 'ca_tcalaico', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHawb' => 2, 'CaFactura' => 3, 'CaFchfactura' => 4, 'CaValor' => 5, 'CaReccaja' => 6, 'CaFchpago' => 7, 'CaTcalaico' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdcliente' => 1, 'caHawb' => 2, 'caFactura' => 3, 'caFchfactura' => 4, 'caValor' => 5, 'caReccaja' => 6, 'caFchpago' => 7, 'caTcalaico' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDCLIENTE => 1, self::CA_HAWB => 2, self::CA_FACTURA => 3, self::CA_FCHFACTURA => 4, self::CA_VALOR => 5, self::CA_RECCAJA => 6, self::CA_FCHPAGO => 7, self::CA_TCALAICO => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hawb' => 2, 'ca_factura' => 3, 'ca_fchfactura' => 4, 'ca_valor' => 5, 'ca_reccaja' => 6, 'ca_fchpago' => 7, 'ca_tcalaico' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoIngresosAirMapBuilder();
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
		return str_replace(InoIngresosAirPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_HAWB);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_FACTURA);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_FCHFACTURA);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_VALOR);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_RECCAJA);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_FCHPAGO);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_TCALAICO);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoIngresosAirPeer::CA_USUCREADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoIngresosAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
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
		$objects = InoIngresosAirPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoIngresosAirPeer::populateObjects(InoIngresosAirPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoIngresosAir $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHawb(), (string) $obj->getCaFactura()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoIngresosAir) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHawb(), (string) $value->getCaFactura()));
			} elseif (is_array($value) && count($value) === 4) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoIngresosAir object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null && $row[$startcol + 1] === null && $row[$startcol + 2] === null && $row[$startcol + 3] === null) {
			return null;
		}
		return serialize(array((string) $row[$startcol + 0], (string) $row[$startcol + 1], (string) $row[$startcol + 2], (string) $row[$startcol + 3]));
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = InoIngresosAirPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoIngresosAirPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoIngresosAirPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinInoMaestraAir(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoIngresosAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(InoIngresosAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinInoMaestraAir(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosAirPeer::addSelectColumns($c);
		$startcol = (InoIngresosAirPeer::NUM_COLUMNS - InoIngresosAirPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraAirPeer::addSelectColumns($c);

		$c->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoIngresosAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosAirPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoIngresosAir($obj1);

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

		InoIngresosAirPeer::addSelectColumns($c);
		$startcol = (InoIngresosAirPeer::NUM_COLUMNS - InoIngresosAirPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosAirPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoIngresosAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosAirPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoIngresosAir($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoIngresosAirPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);
		$criteria->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosAirPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosAirPeer::NUM_COLUMNS - InoIngresosAirPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);
		$c->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoIngresosAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosAirPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InoMaestraAirPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoMaestraAirPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraAirPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoIngresosAir($obj1);
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
								$obj3->addInoIngresosAir($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptInoMaestraAir(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
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
			InoIngresosAirPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptInoMaestraAir(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoIngresosAirPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosAirPeer::NUM_COLUMNS - InoIngresosAirPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoIngresosAirPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoIngresosAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosAirPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoIngresosAir($obj1);

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

		InoIngresosAirPeer::addSelectColumns($c);
		$startcol2 = (InoIngresosAirPeer::NUM_COLUMNS - InoIngresosAirPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraAirPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraAirPeer::NUM_COLUMNS - InoMaestraAirPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoIngresosAirPeer::CA_REFERENCIA,), array(InoMaestraAirPeer::CA_REFERENCIA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoIngresosAirPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoIngresosAirPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoIngresosAirPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoIngresosAirPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoMaestraAirPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoMaestraAirPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoMaestraAirPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraAirPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoIngresosAir($obj1);

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
		return InoIngresosAirPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoIngresosAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoIngresosAirPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoIngresosAirPeer::CA_REFERENCIA);
			$selectCriteria->add(InoIngresosAirPeer::CA_REFERENCIA, $criteria->remove(InoIngresosAirPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoIngresosAirPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $criteria->remove(InoIngresosAirPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoIngresosAirPeer::CA_HAWB);
			$selectCriteria->add(InoIngresosAirPeer::CA_HAWB, $criteria->remove(InoIngresosAirPeer::CA_HAWB), $comparison);

			$comparison = $criteria->getComparison(InoIngresosAirPeer::CA_FACTURA);
			$selectCriteria->add(InoIngresosAirPeer::CA_FACTURA, $criteria->remove(InoIngresosAirPeer::CA_FACTURA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoIngresosAirPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoIngresosAirPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoIngresosAirPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoIngresosAirPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoIngresosAir) {
						InoIngresosAirPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoIngresosAirPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosAirPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosAirPeer::CA_HAWB, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(InoIngresosAirPeer::CA_FACTURA, $value[3]));
				$criteria->addOr($criterion);

								InoIngresosAirPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoIngresosAir $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoIngresosAirPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoIngresosAirPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoIngresosAirPeer::DATABASE_NAME, InoIngresosAirPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoIngresosAirPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hawb, $ca_factura, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hawb, (string) $ca_factura));
 		if (null !== ($obj = InoIngresosAirPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoIngresosAirPeer::DATABASE_NAME);
		$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoIngresosAirPeer::CA_HAWB, $ca_hawb);
		$criteria->add(InoIngresosAirPeer::CA_FACTURA, $ca_factura);
		$v = InoIngresosAirPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoIngresosAirPeer::DATABASE_NAME)->addTableBuilder(BaseInoIngresosAirPeer::TABLE_NAME, BaseInoIngresosAirPeer::getMapBuilder());

