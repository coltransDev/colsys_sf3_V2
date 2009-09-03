<?php


abstract class BaseTransportadorPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'vi_transporlineas';

	
	const CLASS_DEFAULT = 'lib.model.public.Transportador';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDLINEA = 'vi_transporlineas.CA_IDLINEA';

	
	const CA_IDTRANSPORTISTA = 'vi_transporlineas.CA_IDTRANSPORTISTA';

	
	const CA_NOMBRE = 'vi_transporlineas.CA_NOMBRE';

	
	const CA_SIGLA = 'vi_transporlineas.CA_SIGLA';

	
	const CA_TRANSPORTE = 'vi_transporlineas.CA_TRANSPORTE';

	
	const CA_ACTIVO = 'vi_transporlineas.CA_ACTIVO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdlinea', 'CaIdtransportista', 'CaNombre', 'CaSigla', 'CaTransporte', 'CaActivo', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdlinea', 'caIdtransportista', 'caNombre', 'caSigla', 'caTransporte', 'caActivo', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDLINEA, self::CA_IDTRANSPORTISTA, self::CA_NOMBRE, self::CA_SIGLA, self::CA_TRANSPORTE, self::CA_ACTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idlinea', 'ca_idtransportista', 'ca_nombre', 'ca_sigla', 'ca_transporte', 'ca_activo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdlinea' => 0, 'CaIdtransportista' => 1, 'CaNombre' => 2, 'CaSigla' => 3, 'CaTransporte' => 4, 'CaActivo' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdlinea' => 0, 'caIdtransportista' => 1, 'caNombre' => 2, 'caSigla' => 3, 'caTransporte' => 4, 'caActivo' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDLINEA => 0, self::CA_IDTRANSPORTISTA => 1, self::CA_NOMBRE => 2, self::CA_SIGLA => 3, self::CA_TRANSPORTE => 4, self::CA_ACTIVO => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idlinea' => 0, 'ca_idtransportista' => 1, 'ca_nombre' => 2, 'ca_sigla' => 3, 'ca_transporte' => 4, 'ca_activo' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TransportadorMapBuilder();
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
		return str_replace(TransportadorPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TransportadorPeer::CA_IDLINEA);

		$criteria->addSelectColumn(TransportadorPeer::CA_IDTRANSPORTISTA);

		$criteria->addSelectColumn(TransportadorPeer::CA_NOMBRE);

		$criteria->addSelectColumn(TransportadorPeer::CA_SIGLA);

		$criteria->addSelectColumn(TransportadorPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(TransportadorPeer::CA_ACTIVO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransportadorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
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
		$objects = TransportadorPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TransportadorPeer::populateObjects(TransportadorPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TransportadorPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Transportador $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdlinea();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Transportador) {
				$key = (string) $value->getCaIdlinea();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Transportador object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = TransportadorPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TransportadorPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TransportadorPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinIdsProveedor(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransportadorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTransportista(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransportadorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinIdsProveedor(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransportadorPeer::addSelectColumns($c);
		$startcol = (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsProveedorPeer::addSelectColumns($c);

		$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransportadorPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TransportadorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransportadorPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsProveedorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsProveedorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsProveedorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransportador($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTransportista(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransportadorPeer::addSelectColumns($c);
		$startcol = (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportistaPeer::addSelectColumns($c);

		$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransportadorPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TransportadorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransportadorPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportistaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportistaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportistaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportistaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransportador($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransportadorPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);
		$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransportadorPeer::addSelectColumns($c);
		$startcol2 = (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsProveedorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsProveedorPeer::NUM_COLUMNS - IdsProveedorPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportistaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportistaPeer::NUM_COLUMNS - TransportistaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);
		$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransportadorPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TransportadorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransportadorPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = IdsProveedorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsProveedorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsProveedorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransportador($obj1);
			} 
			
			$key3 = TransportistaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TransportistaPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TransportistaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportistaPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addTransportador($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptIdsProveedor(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTransportista(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportadorPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptIdsProveedor(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransportadorPeer::addSelectColumns($c);
		$startcol2 = (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportistaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportistaPeer::NUM_COLUMNS - TransportistaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(TransportistaPeer::CA_IDTRANSPORTISTA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransportadorPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TransportadorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransportadorPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TransportistaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportistaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportistaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportistaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransportador($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTransportista(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TransportadorPeer::addSelectColumns($c);
		$startcol2 = (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsProveedorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsProveedorPeer::NUM_COLUMNS - IdsProveedorPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(TransportadorPeer::CA_IDTRANSPORTISTA,), array(IdsProveedorPeer::CA_IDPROVEEDOR,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TransportadorPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TransportadorPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TransportadorPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TransportadorPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsProveedorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsProveedorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsProveedorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsProveedorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTransportador($obj1);

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
		return TransportadorPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransportadorPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTransportadorPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransportadorPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TransportadorPeer::CA_IDLINEA);
			$selectCriteria->add(TransportadorPeer::CA_IDLINEA, $criteria->remove(TransportadorPeer::CA_IDLINEA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTransportadorPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTransportadorPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TransportadorPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TransportadorPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Transportador) {
						TransportadorPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TransportadorPeer::CA_IDLINEA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TransportadorPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Transportador $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TransportadorPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TransportadorPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TransportadorPeer::DATABASE_NAME, TransportadorPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TransportadorPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TransportadorPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		$criteria->add(TransportadorPeer::CA_IDLINEA, $pk);

		$v = TransportadorPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
			$criteria->add(TransportadorPeer::CA_IDLINEA, $pks, Criteria::IN);
			$objs = TransportadorPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTransportadorPeer::DATABASE_NAME)->addTableBuilder(BaseTransportadorPeer::TABLE_NAME, BaseTransportadorPeer::getMapBuilder());

