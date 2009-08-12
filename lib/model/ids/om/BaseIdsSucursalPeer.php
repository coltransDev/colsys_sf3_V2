<?php


abstract class BaseIdsSucursalPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'ids.tb_sucursales';

	
	const CLASS_DEFAULT = 'lib.model.ids.IdsSucursal';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDSUCURSAL = 'ids.tb_sucursales.CA_IDSUCURSAL';

	
	const CA_ID = 'ids.tb_sucursales.CA_ID';

	
	const CA_PRINCIPAL = 'ids.tb_sucursales.CA_PRINCIPAL';

	
	const CA_DIRECCION = 'ids.tb_sucursales.CA_DIRECCION';

	
	const CA_OFICINA = 'ids.tb_sucursales.CA_OFICINA';

	
	const CA_TORRE = 'ids.tb_sucursales.CA_TORRE';

	
	const CA_BLOQUE = 'ids.tb_sucursales.CA_BLOQUE';

	
	const CA_INTERIOR = 'ids.tb_sucursales.CA_INTERIOR';

	
	const CA_LOCALIDAD = 'ids.tb_sucursales.CA_LOCALIDAD';

	
	const CA_COMPLEMENTO = 'ids.tb_sucursales.CA_COMPLEMENTO';

	
	const CA_TELEFONOS = 'ids.tb_sucursales.CA_TELEFONOS';

	
	const CA_FAX = 'ids.tb_sucursales.CA_FAX';

	
	const CA_IDCIUDAD = 'ids.tb_sucursales.CA_IDCIUDAD';

	
	const CA_ZIPCODE = 'ids.tb_sucursales.CA_ZIPCODE';

	
	const CA_FCHCREADO = 'ids.tb_sucursales.CA_FCHCREADO';

	
	const CA_USUCREADO = 'ids.tb_sucursales.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'ids.tb_sucursales.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'ids.tb_sucursales.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdsucursal', 'CaId', 'CaPrincipal', 'CaDireccion', 'CaOficina', 'CaTorre', 'CaBloque', 'CaInterior', 'CaLocalidad', 'CaComplemento', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaZipcode', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdsucursal', 'caId', 'caPrincipal', 'caDireccion', 'caOficina', 'caTorre', 'caBloque', 'caInterior', 'caLocalidad', 'caComplemento', 'caTelefonos', 'caFax', 'caIdciudad', 'caZipcode', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSUCURSAL, self::CA_ID, self::CA_PRINCIPAL, self::CA_DIRECCION, self::CA_OFICINA, self::CA_TORRE, self::CA_BLOQUE, self::CA_INTERIOR, self::CA_LOCALIDAD, self::CA_COMPLEMENTO, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_ZIPCODE, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idsucursal', 'ca_id', 'ca_principal', 'ca_direccion', 'ca_oficina', 'ca_torre', 'ca_bloque', 'ca_interior', 'ca_localidad', 'ca_complemento', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_zipcode', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdsucursal' => 0, 'CaId' => 1, 'CaPrincipal' => 2, 'CaDireccion' => 3, 'CaOficina' => 4, 'CaTorre' => 5, 'CaBloque' => 6, 'CaInterior' => 7, 'CaLocalidad' => 8, 'CaComplemento' => 9, 'CaTelefonos' => 10, 'CaFax' => 11, 'CaIdciudad' => 12, 'CaZipcode' => 13, 'CaFchcreado' => 14, 'CaUsucreado' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdsucursal' => 0, 'caId' => 1, 'caPrincipal' => 2, 'caDireccion' => 3, 'caOficina' => 4, 'caTorre' => 5, 'caBloque' => 6, 'caInterior' => 7, 'caLocalidad' => 8, 'caComplemento' => 9, 'caTelefonos' => 10, 'caFax' => 11, 'caIdciudad' => 12, 'caZipcode' => 13, 'caFchcreado' => 14, 'caUsucreado' => 15, 'caFchactualizado' => 16, 'caUsuactualizado' => 17, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDSUCURSAL => 0, self::CA_ID => 1, self::CA_PRINCIPAL => 2, self::CA_DIRECCION => 3, self::CA_OFICINA => 4, self::CA_TORRE => 5, self::CA_BLOQUE => 6, self::CA_INTERIOR => 7, self::CA_LOCALIDAD => 8, self::CA_COMPLEMENTO => 9, self::CA_TELEFONOS => 10, self::CA_FAX => 11, self::CA_IDCIUDAD => 12, self::CA_ZIPCODE => 13, self::CA_FCHCREADO => 14, self::CA_USUCREADO => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUACTUALIZADO => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idsucursal' => 0, 'ca_id' => 1, 'ca_principal' => 2, 'ca_direccion' => 3, 'ca_oficina' => 4, 'ca_torre' => 5, 'ca_bloque' => 6, 'ca_interior' => 7, 'ca_localidad' => 8, 'ca_complemento' => 9, 'ca_telefonos' => 10, 'ca_fax' => 11, 'ca_idciudad' => 12, 'ca_zipcode' => 13, 'ca_fchcreado' => 14, 'ca_usucreado' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsSucursalMapBuilder();
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
		return str_replace(IdsSucursalPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(IdsSucursalPeer::CA_IDSUCURSAL);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_ID);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_PRINCIPAL);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_DIRECCION);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_OFICINA);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_TORRE);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_BLOQUE);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_INTERIOR);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_LOCALIDAD);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_COMPLEMENTO);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_FAX);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_ZIPCODE);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_USUCREADO);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(IdsSucursalPeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsSucursalPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
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
		$objects = IdsSucursalPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return IdsSucursalPeer::populateObjects(IdsSucursalPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsSucursalPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(IdsSucursal $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdsucursal();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsSucursal) {
				$key = (string) $value->getCaIdsucursal();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsSucursal object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = IdsSucursalPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsSucursalPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsSucursalPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsSucursalPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsSucursalPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);


    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsSucursalPeer::addSelectColumns($c);
		$startcol = (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsSucursalPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsSucursalPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsSucursalPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsSucursal($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinIds(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsSucursalPeer::addSelectColumns($c);
		$startcol = (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsPeer::addSelectColumns($c);

		$c->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsSucursalPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = IdsSucursalPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsSucursalPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsSucursal($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(IdsSucursalPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$criteria->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsSucursalPeer::addSelectColumns($c);
		$startcol2 = (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$c->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsSucursalPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsSucursalPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsSucursalPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsSucursal($obj1);
			} 
			
			$key3 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = IdsPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = IdsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					IdsPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addIdsSucursal($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptIds(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsSucursalPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsSucursalPeer::addSelectColumns($c);
		$startcol2 = (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsPeer::NUM_COLUMNS - IdsPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsSucursalPeer::CA_ID,), array(IdsPeer::CA_ID,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsSucursalPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsSucursalPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsSucursalPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = IdsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsSucursal($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptIds(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsSucursalPeer::addSelectColumns($c);
		$startcol2 = (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsSucursalPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsSucursalPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = IdsSucursalPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsSucursalPeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CiudadPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addIdsSucursal($obj1);

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
		return IdsSucursalPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsSucursalPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(IdsSucursalPeer::CA_IDSUCURSAL) && $criteria->keyContainsValue(IdsSucursalPeer::CA_IDSUCURSAL) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.IdsSucursalPeer::CA_IDSUCURSAL.')');
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

		
    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseIdsSucursalPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(IdsSucursalPeer::CA_IDSUCURSAL);
			$selectCriteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $criteria->remove(IdsSucursalPeer::CA_IDSUCURSAL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseIdsSucursalPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseIdsSucursalPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsSucursalPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												IdsSucursalPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof IdsSucursal) {
						IdsSucursalPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								IdsSucursalPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(IdsSucursal $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsSucursalPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsSucursalPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsSucursalPeer::DATABASE_NAME, IdsSucursalPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsSucursalPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsSucursalPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
		$criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $pk);

		$v = IdsSucursalPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsSucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsSucursalPeer::DATABASE_NAME);
			$criteria->add(IdsSucursalPeer::CA_IDSUCURSAL, $pks, Criteria::IN);
			$objs = IdsSucursalPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseIdsSucursalPeer::DATABASE_NAME)->addTableBuilder(BaseIdsSucursalPeer::TABLE_NAME, BaseIdsSucursalPeer::getMapBuilder());

