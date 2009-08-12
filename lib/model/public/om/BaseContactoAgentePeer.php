<?php


abstract class BaseContactoAgentePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_contactos';

	
	const CLASS_DEFAULT = 'lib.model.public.ContactoAgente';

	
	const NUM_COLUMNS = 19;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCONTACTO = 'tb_contactos.CA_IDCONTACTO';

	
	const CA_IDAGENTE = 'tb_contactos.CA_IDAGENTE';

	
	const CA_NOMBRE = 'tb_contactos.CA_NOMBRE';

	
	const CA_APELLIDO = 'tb_contactos.CA_APELLIDO';

	
	const CA_DIRECCION = 'tb_contactos.CA_DIRECCION';

	
	const CA_TELEFONOS = 'tb_contactos.CA_TELEFONOS';

	
	const CA_FAX = 'tb_contactos.CA_FAX';

	
	const CA_IDCIUDAD = 'tb_contactos.CA_IDCIUDAD';

	
	const CA_EMAIL = 'tb_contactos.CA_EMAIL';

	
	const CA_IMPOEXPO = 'tb_contactos.CA_IMPOEXPO';

	
	const CA_TRANSPORTE = 'tb_contactos.CA_TRANSPORTE';

	
	const CA_CARGO = 'tb_contactos.CA_CARGO';

	
	const CA_DETALLE = 'tb_contactos.CA_DETALLE';

	
	const CA_SUGERIDO = 'tb_contactos.CA_SUGERIDO';

	
	const CA_ACTIVO = 'tb_contactos.CA_ACTIVO';

	
	const CA_FCHCREADO = 'tb_contactos.CA_FCHCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_contactos.CA_FCHACTUALIZADO';

	
	const CA_USUCREADO = 'tb_contactos.CA_USUCREADO';

	
	const CA_USUACTUALIZADO = 'tb_contactos.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto', 'CaIdagente', 'CaNombre', 'CaApellido', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaEmail', 'CaImpoexpo', 'CaTransporte', 'CaCargo', 'CaDetalle', 'CaSugerido', 'CaActivo', 'CaFchcreado', 'CaFchactualizado', 'CaUsucreado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto', 'caIdagente', 'caNombre', 'caApellido', 'caDireccion', 'caTelefonos', 'caFax', 'caIdciudad', 'caEmail', 'caImpoexpo', 'caTransporte', 'caCargo', 'caDetalle', 'caSugerido', 'caActivo', 'caFchcreado', 'caFchactualizado', 'caUsucreado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO, self::CA_IDAGENTE, self::CA_NOMBRE, self::CA_APELLIDO, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_EMAIL, self::CA_IMPOEXPO, self::CA_TRANSPORTE, self::CA_CARGO, self::CA_DETALLE, self::CA_SUGERIDO, self::CA_ACTIVO, self::CA_FCHCREADO, self::CA_FCHACTUALIZADO, self::CA_USUCREADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto', 'ca_idagente', 'ca_nombre', 'ca_apellido', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_email', 'ca_impoexpo', 'ca_transporte', 'ca_cargo', 'ca_detalle', 'ca_sugerido', 'ca_activo', 'ca_fchcreado', 'ca_fchactualizado', 'ca_usucreado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto' => 0, 'CaIdagente' => 1, 'CaNombre' => 2, 'CaApellido' => 3, 'CaDireccion' => 4, 'CaTelefonos' => 5, 'CaFax' => 6, 'CaIdciudad' => 7, 'CaEmail' => 8, 'CaImpoexpo' => 9, 'CaTransporte' => 10, 'CaCargo' => 11, 'CaDetalle' => 12, 'CaSugerido' => 13, 'CaActivo' => 14, 'CaFchcreado' => 15, 'CaFchactualizado' => 16, 'CaUsucreado' => 17, 'CaUsuactualizado' => 18, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto' => 0, 'caIdagente' => 1, 'caNombre' => 2, 'caApellido' => 3, 'caDireccion' => 4, 'caTelefonos' => 5, 'caFax' => 6, 'caIdciudad' => 7, 'caEmail' => 8, 'caImpoexpo' => 9, 'caTransporte' => 10, 'caCargo' => 11, 'caDetalle' => 12, 'caSugerido' => 13, 'caActivo' => 14, 'caFchcreado' => 15, 'caFchactualizado' => 16, 'caUsucreado' => 17, 'caUsuactualizado' => 18, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO => 0, self::CA_IDAGENTE => 1, self::CA_NOMBRE => 2, self::CA_APELLIDO => 3, self::CA_DIRECCION => 4, self::CA_TELEFONOS => 5, self::CA_FAX => 6, self::CA_IDCIUDAD => 7, self::CA_EMAIL => 8, self::CA_IMPOEXPO => 9, self::CA_TRANSPORTE => 10, self::CA_CARGO => 11, self::CA_DETALLE => 12, self::CA_SUGERIDO => 13, self::CA_ACTIVO => 14, self::CA_FCHCREADO => 15, self::CA_FCHACTUALIZADO => 16, self::CA_USUCREADO => 17, self::CA_USUACTUALIZADO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto' => 0, 'ca_idagente' => 1, 'ca_nombre' => 2, 'ca_apellido' => 3, 'ca_direccion' => 4, 'ca_telefonos' => 5, 'ca_fax' => 6, 'ca_idciudad' => 7, 'ca_email' => 8, 'ca_impoexpo' => 9, 'ca_transporte' => 10, 'ca_cargo' => 11, 'ca_detalle' => 12, 'ca_sugerido' => 13, 'ca_activo' => 14, 'ca_fchcreado' => 15, 'ca_fchactualizado' => 16, 'ca_usucreado' => 17, 'ca_usuactualizado' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ContactoAgenteMapBuilder();
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
		return str_replace(ContactoAgentePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ContactoAgentePeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_IDAGENTE);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_NOMBRE);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_APELLIDO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_DIRECCION);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_TELEFONOS);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_FAX);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_EMAIL);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_CARGO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_DETALLE);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_SUGERIDO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_ACTIVO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_FCHCREADO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_USUCREADO);

		$criteria->addSelectColumn(ContactoAgentePeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoAgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
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
		$objects = ContactoAgentePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ContactoAgentePeer::populateObjects(ContactoAgentePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ContactoAgentePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(ContactoAgente $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontacto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof ContactoAgente) {
				$key = (string) $value->getCaIdcontacto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or ContactoAgente object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = ContactoAgentePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ContactoAgentePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ContactoAgentePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoAgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoAgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);


    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoAgentePeer::addSelectColumns($c);
		$startcol = (ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS);
		AgentePeer::addSelectColumns($c);

		$c->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoAgentePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ContactoAgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoAgentePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AgentePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AgentePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addContactoAgente($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoAgentePeer::addSelectColumns($c);
		$startcol = (ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoAgentePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ContactoAgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoAgentePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addContactoAgente($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoAgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$criteria->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoAgentePeer::addSelectColumns($c);
		$startcol2 = (ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$c->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoAgentePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ContactoAgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoAgentePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = AgentePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addContactoAgente($obj1);
			} 
			
			$key3 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = CiudadPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					CiudadPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addContactoAgente($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoAgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoAgentePeer::addSelectColumns($c);
		$startcol2 = (ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ContactoAgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoAgentePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ContactoAgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoAgentePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addContactoAgente($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoAgentePeer::addSelectColumns($c);
		$startcol2 = (ContactoAgentePeer::NUM_COLUMNS - ContactoAgentePeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ContactoAgentePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoAgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoAgentePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ContactoAgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoAgentePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = AgentePeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addContactoAgente($obj1);

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
		return ContactoAgentePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactoAgentePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ContactoAgentePeer::CA_IDCONTACTO) && $criteria->keyContainsValue(ContactoAgentePeer::CA_IDCONTACTO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ContactoAgentePeer::CA_IDCONTACTO.')');
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

		
    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactoAgentePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ContactoAgentePeer::CA_IDCONTACTO);
			$selectCriteria->add(ContactoAgentePeer::CA_IDCONTACTO, $criteria->remove(ContactoAgentePeer::CA_IDCONTACTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseContactoAgentePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseContactoAgentePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ContactoAgentePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ContactoAgentePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof ContactoAgente) {
						ContactoAgentePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ContactoAgentePeer::CA_IDCONTACTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ContactoAgentePeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(ContactoAgente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ContactoAgentePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ContactoAgentePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ContactoAgentePeer::DATABASE_NAME, ContactoAgentePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ContactoAgentePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ContactoAgentePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);
		$criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $pk);

		$v = ContactoAgentePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);
			$criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = ContactoAgentePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseContactoAgentePeer::DATABASE_NAME)->addTableBuilder(BaseContactoAgentePeer::TABLE_NAME, BaseContactoAgentePeer::getMapBuilder());

