<?php


abstract class BaseInoAvisosSeaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_inoavisos_sea';

	
	const CLASS_DEFAULT = 'lib.model.sea.InoAvisosSea';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_REFERENCIA = 'tb_inoavisos_sea.CA_REFERENCIA';

	
	const CA_IDCLIENTE = 'tb_inoavisos_sea.CA_IDCLIENTE';

	
	const CA_HBLS = 'tb_inoavisos_sea.CA_HBLS';

	
	const CA_IDEMAIL = 'tb_inoavisos_sea.CA_IDEMAIL';

	
	const CA_FCHAVISO = 'tb_inoavisos_sea.CA_FCHAVISO';

	
	const CA_AVISO = 'tb_inoavisos_sea.CA_AVISO';

	
	const CA_IDBODEGA = 'tb_inoavisos_sea.CA_IDBODEGA';

	
	const CA_FCHLLEGADA = 'tb_inoavisos_sea.CA_FCHLLEGADA';

	
	const CA_FCHENVIO = 'tb_inoavisos_sea.CA_FCHENVIO';

	
	const CA_USUENVIO = 'tb_inoavisos_sea.CA_USUENVIO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHbls', 'CaIdemail', 'CaFchaviso', 'CaAviso', 'CaIdbodega', 'CaFchllegada', 'CaFchenvio', 'CaUsuenvio', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia', 'caIdcliente', 'caHbls', 'caIdemail', 'caFchaviso', 'caAviso', 'caIdbodega', 'caFchllegada', 'caFchenvio', 'caUsuenvio', ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA, self::CA_IDCLIENTE, self::CA_HBLS, self::CA_IDEMAIL, self::CA_FCHAVISO, self::CA_AVISO, self::CA_IDBODEGA, self::CA_FCHLLEGADA, self::CA_FCHENVIO, self::CA_USUENVIO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_idemail', 'ca_fchaviso', 'ca_aviso', 'ca_idbodega', 'ca_fchllegada', 'ca_fchenvio', 'ca_usuenvio', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHbls' => 2, 'CaIdemail' => 3, 'CaFchaviso' => 4, 'CaAviso' => 5, 'CaIdbodega' => 6, 'CaFchllegada' => 7, 'CaFchenvio' => 8, 'CaUsuenvio' => 9, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caReferencia' => 0, 'caIdcliente' => 1, 'caHbls' => 2, 'caIdemail' => 3, 'caFchaviso' => 4, 'caAviso' => 5, 'caIdbodega' => 6, 'caFchllegada' => 7, 'caFchenvio' => 8, 'caUsuenvio' => 9, ),
		BasePeer::TYPE_COLNAME => array (self::CA_REFERENCIA => 0, self::CA_IDCLIENTE => 1, self::CA_HBLS => 2, self::CA_IDEMAIL => 3, self::CA_FCHAVISO => 4, self::CA_AVISO => 5, self::CA_IDBODEGA => 6, self::CA_FCHLLEGADA => 7, self::CA_FCHENVIO => 8, self::CA_USUENVIO => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hbls' => 2, 'ca_idemail' => 3, 'ca_fchaviso' => 4, 'ca_aviso' => 5, 'ca_idbodega' => 6, 'ca_fchllegada' => 7, 'ca_fchenvio' => 8, 'ca_usuenvio' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoAvisosSeaMapBuilder();
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
		return str_replace(InoAvisosSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHAVISO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_AVISO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDBODEGA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_USUENVIO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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
		$objects = InoAvisosSeaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return InoAvisosSeaPeer::populateObjects(InoAvisosSeaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(InoAvisosSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = serialize(array((string) $obj->getCaReferencia(), (string) $obj->getCaIdcliente(), (string) $obj->getCaHbls(), (string) $obj->getCaIdemail()));
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoAvisosSea) {
				$key = serialize(array((string) $value->getCaReferencia(), (string) $value->getCaIdcliente(), (string) $value->getCaHbls(), (string) $value->getCaIdemail()));
			} elseif (is_array($value) && count($value) === 4) {
								$key = serialize(array((string) $value[0], (string) $value[1], (string) $value[2], (string) $value[3]));
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoAvisosSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = InoAvisosSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoAvisosSeaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoAvisosSeaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinInoClientesSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinInoClientesSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoClientesSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = InoClientesSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoClientesSeaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					InoClientesSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

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

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoAvisosSea($obj1);

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

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addInoAvisosSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		EmailPeer::addSelectColumns($c);

		$c->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = EmailPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = EmailPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(InoAvisosSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
		$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
		$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
		$c->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$c->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = InoClientesSeaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = InoClientesSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoClientesSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);
			} 
			
			$key3 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = InoMaestraSeaPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					InoMaestraSeaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoAvisosSea($obj1);
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
								$obj4->addInoAvisosSea($obj1);
			} 
			
			$key5 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = EmailPeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					EmailPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addInoAvisosSea($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptInoClientesSea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
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
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoAvisosSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$criteria->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptInoClientesSea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoMaestraSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoMaestraSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

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
								$obj3->addInoAvisosSea($obj1);

			} 
				
				$key4 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = EmailPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					EmailPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoAvisosSea($obj1);

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

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoClientesSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoClientesSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoClientesSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

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
								$obj3->addInoAvisosSea($obj1);

			} 
				
				$key4 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = EmailPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					EmailPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoAvisosSea($obj1);

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

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoClientesSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoClientesSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoClientesSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

			} 
				
				$key3 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = InoMaestraSeaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					InoMaestraSeaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoAvisosSea($obj1);

			} 
				
				$key4 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = EmailPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					EmailPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addInoAvisosSea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoClientesSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (InoClientesSeaPeer::NUM_COLUMNS - InoClientesSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,InoAvisosSeaPeer::CA_IDCLIENTE,InoAvisosSeaPeer::CA_HBLS,), array(InoClientesSeaPeer::CA_REFERENCIA,InoClientesSeaPeer::CA_IDCLIENTE,InoClientesSeaPeer::CA_HBLS,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_REFERENCIA,), array(InoMaestraSeaPeer::CA_REFERENCIA,), $join_behavior);
				$c->addJoin(array(InoAvisosSeaPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoAvisosSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoAvisosSeaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = InoAvisosSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoAvisosSeaPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = InoClientesSeaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = InoClientesSeaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = InoClientesSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					InoClientesSeaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addInoAvisosSea($obj1);

			} 
				
				$key3 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = InoMaestraSeaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = InoMaestraSeaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					InoMaestraSeaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addInoAvisosSea($obj1);

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
								$obj4->addInoAvisosSea($obj1);

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
		return InoAvisosSeaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoAvisosSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInoAvisosSeaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $criteria->remove(InoAvisosSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $criteria->remove(InoAvisosSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_HBLS);
			$selectCriteria->add(InoAvisosSeaPeer::CA_HBLS, $criteria->remove(InoAvisosSeaPeer::CA_HBLS), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_IDEMAIL);
			$selectCriteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $criteria->remove(InoAvisosSeaPeer::CA_IDEMAIL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInoAvisosSeaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInoAvisosSeaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoAvisosSeaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												InoAvisosSeaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof InoAvisosSea) {
						InoAvisosSeaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
												if (count($values) == count($values, COUNT_RECURSIVE)) {
								$values = array($values);
			}

			foreach ($values as $value) {

				$criterion = $criteria->getNewCriterion(InoAvisosSeaPeer::CA_REFERENCIA, $value[0]);
				$criterion->addAnd($criteria->getNewCriterion(InoAvisosSeaPeer::CA_IDCLIENTE, $value[1]));
				$criterion->addAnd($criteria->getNewCriterion(InoAvisosSeaPeer::CA_HBLS, $value[2]));
				$criterion->addAnd($criteria->getNewCriterion(InoAvisosSeaPeer::CA_IDEMAIL, $value[3]));
				$criteria->addOr($criterion);

								InoAvisosSeaPeer::removeInstanceFromPool($value);
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

	
	public static function doValidate(InoAvisosSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoAvisosSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoAvisosSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoAvisosSeaPeer::DATABASE_NAME, InoAvisosSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoAvisosSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($ca_referencia, $ca_idcliente, $ca_hbls, $ca_idemail, PropelPDO $con = null) {
		$key = serialize(array((string) $ca_referencia, (string) $ca_idcliente, (string) $ca_hbls, (string) $ca_idemail));
 		if (null !== ($obj = InoAvisosSeaPeer::getInstanceFromPool($key))) {
 			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$criteria = new Criteria(InoAvisosSeaPeer::DATABASE_NAME);
		$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoAvisosSeaPeer::CA_HBLS, $ca_hbls);
		$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $ca_idemail);
		$v = InoAvisosSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 

Propel::getDatabaseMap(BaseInoAvisosSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoAvisosSeaPeer::TABLE_NAME, BaseInoAvisosSeaPeer::getMapBuilder());

